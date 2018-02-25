#!/usr/bin/env php
<?php
/**
 * @file
 * @brief
 * Run  a script with a given script id using json api (need IPS V3.1+)
 * requires IPSymcon V3.0+
 *
 * @copyright Thomas Dressler 2013-2018
 * @version 1.1
 * @date 25.02.2018
 *
 * @see http://www.ip-symcon.de/service/dokumentation/entwicklerbereich/datenaustausch/
 * @see http://www.tdressler.net/ipsymcon/ipsymcon_api.html

 * * @include examples/run_ips_script.php
 */
//JSON API
require ("../IPS_JSON.php");
if ( !class_exists("IPS_JSON"))
{
	print "This requires PHP JSON and IPS_JSON class\n";
	exit($retcode['RC_UNKNOWN']) ;
}
$config='IPS_JSON_config.cfg';
//read commandline options
$options=getopt("H:P:u:p:s:c:h");

if (isset($options['h'])) {
	usage();
	exit(1);
}
if (isset($options['c'])) {$config=$options['c'];}
//overwrite default configuration as above with your settings if needed 
if (file_exists($config))  {
	$config_data=file_get_contents($config);
	$res=eval($config_data);
	if ($res===false) {
		echo "UNKNOWN eval of $config failed. Hint:Use code only, no leading php tags\n";
		exit(1);
	}
}

//commandline parameters have precedence
if (isset($options['P'])) $port=$options['P'];
if (isset($options['H'])) {$host=$options['H'];}
if (isset($options['u'])) {$user=$options['u'];}
if (isset($options['p'])) {$password=$options['p'];}
if (isset($options['s'])) {$script_id=$options['s'];}

if (empty($host) || empty($script_id)) {
	echo "UNKNOWN Host or ID missed\n";
	usage();
	exit(1);
}
if (empty($user) || empty($password)) {
	echo "UNKNOWN API username or Password\n";
	usage();
	exit(1);
}

#create api url
$url="http://".$host.":".$port."/api/";
$script_id=(integer)$script_id;
$url="http://".$host.":".$port."/api/";#need trailing slash!
$ips=new IPS_JSON($url,$user,$password,2);


	$data=$ips->get_script($script_id);
	if (!$data) {
		if ($ips->isError()) {
		#error occured, data contains return code
			print "Error - ".$ips->getErrorMessage()."\n";
		}else {
			print "unknown Error retrieving Script $script_id\n";
		}
		exit (1);
	}
	print "Start script ID $script_id '".$data['name']."' (".$data['file'].")\n";
	$res=$ips->IPS_RunScriptWait($script_id);	//must return a value by print
	if($res){
			print "Script execution ID $script_id returned:$res\n";
			exit (0);
	}else{	
		if ($ips->getError) {
		#error occured, data contains return code
			print "Error - ".$ips->getErrorMessage()."\n";
		}
	}

exit (1);

function usage() {
	print "$0 [-H <IPSHOST>] [-P <IPSPORT>] -s <Script-ID> [-u <APIUSER>] [-p <APIPASS>] [-h]\n";
}
?>