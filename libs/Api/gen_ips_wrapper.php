<?php
/**
 * @file gen_ips_wrapper.php
 * 
 * generiert include Script um die vorhandenen IPS Funktionen über JSON-API auszuführen
 * verwendet IPS_JSON class
 * 
 * @see http://www.tdressler.net/ipsymcon/jsonapi.html
 * @see http://www.ip-symcon.de/service/dokumentation/befehlsreferenz/programminformationen/ips-getfunctionlist/
 *
 * @copyright (C) Thomas Dreßler 2013-2016
 * @version V0.5 01.05.2016
 */
ini_set('max_execution_time',600);

require ('IPS_JSON.php');

if ( !class_exists('IPS_JSON'))
{
	print "This requires PHP JSON and IPS_JSON class\n";
	exit;
}

//default configuration
$date=date('Y-m-d');
$file="ips_wrapper.php";
$host="localhost";
$port="3777";
$user='lizenz@email.ips';
$password='fernsteuer-password';
$config='IPS_JSON_config.cfg';
//read commandline options
$options=getopt("c:P:H:u:p:f:h");
//print_r($options);
if (isset($options['h'])) {
	usage();
	exit;
}
if (isset($options['c'])) {$config=$options['c'];}
//overwrite default configuration as above with your settings if needed 
if (file_exists($config))  {
	$config_data=file_get_contents($config);
	$res=eval($config_data);
	if ($res===false) {
		echo "eval of $config failed. Hint:Use code only, no leading php tags\n";
		exit;
	}
}
//commandline parameters have precedence

if (isset($options['P'])) $port=$options['P'];
if (isset($options['H'])) {$host=$options['H'];}
if (isset($options['u'])) {$user=$options['u'];}
if (isset($options['p'])) {$password=$options['p'];}
if (isset($options['f'])) {$file=$options['f'];}
$log=fopen($file,"w");
if (!$log) {
	echo "cannot write to '$file'\n";
	exit;
}
if (empty($user) || empty($password)) {
	echo "API username or Password missed\n";
	exit;
}
$url="http://".$host.":".$port."/api/";

/**
* @var IPS_JSON $rpc
*/
$rpc = new IPS_JSON($url,$user,$password);
//$typestr = Array("boolean", "integer", "float", "string", "variant", "array");
$typestr = $rpc->get_ips_vartypes();
array_walk ($typestr, function(&$item, $key){
		$item = str_replace("Value","",$item);
	});
//query version
$version=$rpc->IPS_GetKernelVersion();
if (!$version) {
		echo "IPS_GetKernelVersion Request failed:".$rpc->getErrorMessage();
		exit;
}

//build header
$header="
/**
 * @file
 * @brief generated ipsymcon functions wrapper using gen_ips_wrapper.php
 *
 * This wrapper helps you to execute Scripts written for IPSymcon also on other PHP boxes
 * using IPSymcon JSON API. It defines all of known functions and map this to a JSON call
 *
 * @pre All functions are located in ips_wrapper.php. You need the class file IPS_JSON.php as well. 
 * @copyright Thomas Dressler 2013-2016
 * @version 0.5 (gen_ips_wrapper.php)
 * @version $version (IPSymcon)
 * @date $date (generated)
 * @see http://www.tdressler.net/ipsymcon/funktionsliste.html
 * @see http://www.tdressler.net/ipsymcon/jsonapi.html
 * @see http://www.ip-symcon.de/service/dokumentation/befehlsreferenz/programminformationen/ips-getfunctionlist/
 * 
 */

";

$header.='
require ("IPS_JSON.php");
if ( !class_exists("IPS_JSON"))
{
	print "This requires PHP JSON and IPS_JSON class\n";
	exit;
}

//default configuration
';
$header .='
$config="IPS_JSON_config.cfg";
$host="localhost";
$port="3777";
$user="lizenz@email.ips";
$password="secret";

$header.='//overwrite default configuration as above with your settings if needed 
if (file_exists($config))  {
	$config_data=file_get_contents($config);
	$res=eval($config_data);
}
if (empty($user) || empty($password)) {
	echo "API username or Password missed\n";
	exit;
}
$url="http://".$host.":".$port."/api/";

/**
* @var IPS_JSON \$rpc
*/
$rpc = new IPS_JSON($url,$user,$password);
';

//retrieve function list
$instanceid = 0; //0 = Alle Funktionen, sonst Filter auf InstanzID
$fs = $rpc->IPS_GetFunctionList($instanceid);
if (!$fs) {
		echo "IPS_GetFunctionList Request failed:".$rpc->getErrorMessage();
		exit;
}
asort($fs);

//start writing 
fwrite ($log,"<?php"."\n");
fwrite ($log,$header."\n");
//loop trough instances
foreach($fs as $fn) {
   $f = $rpc->IPS_GetFunction($fn);
   $fun=$f['FunctionName'];
   $res=$f['Result'];
   $proto='';
   
   //write phpdoc header
   fwrite ($log,"\n"."/**"."\n");
   fwrite ($log,"* ".$fun."\n");
   fwrite ($log,"* "."\n");
   fwrite ($log,"* @returns ".$typestr[$res['Type_']]. "\n");
   
   //build parameter list  
   $a = Array();
   foreach($f['Parameters'] as $p) {
	  $enum=null;
	  if(isset($p['Enumeration']) && sizeof($p['Enumeration']) > 0) {
		 $b=Array();
		 foreach($p['Enumeration'] as $k => $v) {
				 $b[] = $k."=".$v;
		 }
		 $type = "integer";
			 $enum= "enum[".implode(", ", $b)."]";
	  } else {
		 $type = $typestr[$p['Type_']];
	  }
	  $pname=$p['Description'];
	  $pname=preg_replace("/[\(\)]+/","",$pname);
	 $proto.="$".$pname.",";
	 fwrite ($log,"* @param ". $type. ' $'.$pname. "\n");
		 if ($enum) fwrite ($log,"*   ".$enum."\n");
	 }
	 fwrite ($log,"*/"."\n"."\n");
	 $proto=substr($proto,0,strlen($proto)-1);
	 
	 //write function block
	 $txt="function ".$fn."( ".$proto." ){"."\n";
	 $txt.="\t".'$rpc=$GLOBALS["rpc"];'."\n";
	 $txt.="\t".'$result=$rpc->'.$fn."( ".$proto." );"."\n";
	 $txt.="\t".'return $result;'."\n";
	 $txt.="}"."\n";
	 fwrite ($log,$txt);
}
fwrite ($log, "?>"."\n");
fflush($log);
fclose($log);
//control: output written file to screen
//$all=file_get_contents($file);
//echo $all;
echo "finished"."\n";

/**
 * print usage information
 */
function usage() {
	echo "Usage: gen_ips_wrapper.php [-h] [-f <target_filename>] | [-c <config_file>|-H <ipshost> -P <port> -u <apiuser> -p <api_password>]\n";
	exit;
}
?>