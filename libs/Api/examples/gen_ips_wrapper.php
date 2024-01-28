<?php
/**
 * @file gen_ips_wrapper.php
 *
 * generate include Script to allow run of  internal IPS function over JSON-API
 *
 * @see https://www.symcon.de
 * @see https://www.tdressler.net/ipsymcon/jsonapi.html
 * @see https://www.symcon.de/service/dokumentation/befehlsreferenz/programminformationen/ips-getfunctionlist/
 *
 * @copyright (C) Thomas Dreßler 2013-2024
 * @version V0.9 28.01.2024
 *
 * @include gen_ips_wrapper.php
 */

if (!function_exists('IPS_GetKernelVersion')) {

    print "This requires native IPS Environment";
    exit;
}
//default configuration
$script_version='0.9';
$date=date('Y-m-d');
$file="ips_wrapper.php";
$config=dirname(__FILE__).'/IPS_JSON_config.cfg';
//read commandline options

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

$log=fopen($file,"w");
if (!$log) {
    echo "cannot write to '$file'\n";
    exit;
}

// https://www.symcon.de/de/service/dokumentation/befehlsreferenz/programminformationen/ips-getfunction/
// Variablentyp des Parameters/Rückgabewerts: 0=Boolean, 1=Integer, 2=Float, 3=String, 4=Variant, 5=Array
$typestr = Array("bool", "int", "float", "string", "mixed", "array");
array_walk ($typestr, function(&$item ){
    $item = str_replace("Value","",$item);
});
//query version
$version=IPS_GetKernelVersion();
if (!$version) {
    echo "IPS_GetKernelVersion Request failed:";
    exit;
}

//build header
$header="
 
/**
 * @file
 * @brief generated ipsymcon functions wrapper using gen_ips_wrapper.php
 *
 * This wrapper helps you to execute Scripts written for IPSymcon also on other PHP boxes
 * using IPSymcon JSON API. It defines all known functions and map this to a JSON call
 *
 * @pre All functions are located in ips_wrapper.php. You need the class file IPS_JSON.php as well.
 * @copyright Thomas Dressler 2013-2024
 * @version $script_version (gen_ips_wrapper.php)
 * @version $version (IPSymcon)
 * @date $date (generated)
 * @see https://www.tdressler.net/ipsymcon/jsonapi.html
 * @see https://www.symcon.de/service/dokumentation/befehlsreferenz/programminformationen/ips-getfunctionlist/
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
/*
 * name and path of config file
 */
$config=dirname(__FILE__)."/IPS_JSON_config.cfg";
/*
 * host to connect
 */
$host="localhost";
/*
 * API Port to connect (usually 3777 or 82)
 */
$port="3777";
/*
 * License user name (eg. email)
 */
$user="lizenz@email.ips";
/*
 * ips password
 */
$password="secret";
';
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
* IPS_JSON object
*
* @var IPS_JSON $rpc
*/
$rpc = null;
';

//retrieve function list
$instanceid = 0; //0 = Alle Funktionen, sonst Filter auf InstanzID
$fs = IPS_GetFunctionList($instanceid);
if (!$fs) {
    echo "IPS_GetFunctionList Request failed";
    exit;
}
asort($fs);

//start writing
fwrite ($log,"<?php"."\n");
fwrite ($log,$header."\n");
//loop trough instances
foreach($fs as $fn) {
    $f = IPS_GetFunction($fn);
    $fun=$f['FunctionName'];
    $res=$f['Result'];
    $proto='';
    $fproto='';

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
            $type = "int";
            $enum= "enum[".implode(", ", $b)."]";
        } else {
            $type = $typestr[$p['Type_']];
        }

        $pname=$p['Description'];
        $pname=preg_replace("/[\(\)]+/","",$pname);
        $fproto.=$type." $".$pname.",";
        $proto.="$".$pname.",";
        fwrite ($log,"* @param ". $type. ' $'.$pname. "\n");
        if ($enum) fwrite ($log,"*   ".$enum."\n");
    }
    fwrite ($log,"*/"."\n"."\n");
    $proto=substr($proto,0,strlen($proto)-1);
    $fproto=substr($fproto,0,strlen($fproto)-1);

    //write function block
    $txt="function ".$fn."( ".$fproto." ):".$typestr[$res['Type_']]." {"."\n";
    $txt.="\t".'$rpc=$GLOBALS["rpc"];'."\n";
    $txt.="\t".'return $rpc->'.$fn."( ".$proto." );"."\n";
    $txt.="}"."\n";
    fwrite ($log,$txt);
}

fflush($log);
fclose($log);
//control: output written file to screen
//$all=file_get_contents($file);
//echo $all;
echo "finished"."\n";


