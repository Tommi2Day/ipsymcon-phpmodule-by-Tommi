<?php
/**
 * @file
 * @brief
 * Demo script for switching an actor via JSON API
 * requires IPSymcon V3.0+
 *
 * @copyright Thomas Dressler 2013-2018
 * @version 0.3
 * @date 25.02.2018
 *
 * @see http://www.ip-symcon.de/service/dokumentation/entwicklerbereich/datenaustausch/
 * @see http://www.tdressler.net/ipsymcon/ipsymcon_api.html

 * @include examples/fs20_json.php
 */
include ('../IPS_JSON.php');
//default configuration
$id=undef;
$host="";
$port="3777";
$user="apiuser";
$password="apipassword";
$config='IPS_JSON_config.cfg';
//read commandline options
$options=getopt("i:H:P:u:p:s:c:h");
//print_r($options);
if (isset($options['h'])) {
	usage();
	exit(0);
}
if (isset($options['c'])) {$config=$options['c'];}
//overwrite default configuration as above with your settings if needed 
if (file_exists($config))  {
	$config_data=file_get_contents($config);
	$res=eval($config_data);
	if ($res===false) {
		print "Error - eval of $config failed. Hint:Use code only, no leading php tags\n";
		exit(1);
	}
}
//commandline parameters have precedence
if (isset($options['P'])) $port=$options['P'];
if (isset($options['H'])) {$host=$options['H'];}
if (isset($options['u'])) {$user=$options['u'];}
if (isset($options['p'])) {$password=$options['p'];}
if (isset($options['i'])) {$id=$options['i'];}
if (isset($options['s'])) {$state=$options['s'];}

if (is_null($id) || is_null($state)) {
	print "Error - need atleast FS20 Instance ID and switch state\n";
    usage();
	exit(0) ;
}

if (!is_numeric($id)){
	print "Error - ID $id looks not as a number\n";
	exit(1);
}
$id=(integer)$id;
if (!class_exists('IPS_JSON'))
{
	print "Error - This requires IPS_JSON class\n";
	exit(1);
}
if (empty($user) || empty($password)) {
	echo "API username or Password missed\n";
	exit;
}
$url="http://".$host.":".$port."/api/";


try {
	/**
	* @var IPS_JSON $ips
	*/
	$ips = new IPS_JSON($url,$user,$password);
	$res=$ips->IPS_InstanceExists($id);
	if (!isset($res)) {
		print "Error - IPS_InstanceExists Request failed:".$ips->getErrorMessage()."\n";
		exit(1);
	}
	if ($res===false) {
		print "Error - Instance $id doesnt exists\n";
		exit(1);
	}
	$inst=$ips->IPS_GetInstance($id);
	if (!$inst) {
		print "Error - IPS_GetInstance Request failed=".$ips->getErrorMessage()."\n";
		exit(1);
	}
	$name=$inst['ModuleInfo']['ModuleName'];
	if ($name == "FS20") {
		$switch=preg_match("/On|Ein|1/i",$state)?true:false;
		$res=$ips->FS20_SwitchMode($id,$switch);
		if (!$res) {
			print "Error - Set FS20 Switch $id to ".($switch?"On":"Off")." failed=".$ips->getErrorMessage()."\n";
			exit(1);
			
		}else{
			print "OK - Set FS20 Switch $id to ".($switch?"On":"Off")." successfully\n";
		}
	}else{
		print "Error - Instance $id is not an instance of FS20 module\n";
		exit(1);
	}

}catch (Exception $e) {
	echo "Error - Request failed->";
	echo $e->getMessage()."\n";
	exit(1);
}
exit (0);


/**
 * print usage information
 */
function usage(){
    print "usage: ".basename(__FILE__)." -i <instanceid> -s <state> [-h] [-c <config_file>] | [-H <ipshost> -P <apiport> -u <apiuser> -p <apipass>] \n";
    print "state: use On|Ein|1 for 'on', others means 'off'>\n";
}
?>