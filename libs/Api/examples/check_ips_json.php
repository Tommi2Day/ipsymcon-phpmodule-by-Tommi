#!/usr/bin/env php
<?php
/**
 * @file
 * @brief
 * Nagios/Icinga check plugin for IP-Symcon
 * (https://www.symcon.de)
 * retrieves value of a given variable via id using json api (need IPS V3.1+)
 *
 * @copyright Thomas Dreßler 2013-2024
 * @version 2.3
 * @date 27.02.2024
 *
 * @see http://www.ip-symcon.de/service/dokumentation/entwicklerbereich/datenaustausch/
 * @see http://www.tdressler.net/ipsymcon/ipsymcon_api.html
 *
 * @include examples/check_ips_json.php

 */

//nagios/icinga return codes
$retcode=array('RC_OK'=>0,'RC_WARNING'=>1,'RC_CRITICAL'=>2,'RC_UNKNOWN'=>3);
$retstatus=array(0=>'OK',1=>'WARNING',2=>'CRITICAL',3=>'UNKNOWN');

//JSON API
require ("../IPS_JSON.php");
if ( !class_exists("IPS_JSON"))
{
	print "This requires PHP JSON and IPS_JSON class\n";
	exit($retcode['RC_UNKNOWN']) ;
}

//default configuration

$host="";
$port="3777";
$user='lizenz@email.ips';
$password='fernsteuer-password';
$age=3600;
$config='IPS_JSON_config.cfg';
//read commandline options
$options=getopt("H:P:u:p:i:c:w:a:f:h");
//print_r($options);
if (isset($options['h'])) {
	usage();
	exit($retcode['RC_UNKNOWN']);
}
if (isset($options['f'])) {$config=$options['f'];}
//overwrite default configuration as above with your settings if needed 
if (file_exists($config))  {
	$config_data=file_get_contents($config);
	$res=eval($config_data);
	if ($res===false) {
		echo "UNKNOWN eval of $config failed. Hint:Use code only, no leading php tags\n";
		exit($retcode['RC_UNKNOWN']);
	}
}
//commandline parameters have precedence

if (isset($options['P'])) $port=$options['P'];
if (isset($options['H'])) {$host=$options['H'];}
if (isset($options['u'])) {$user=$options['u'];}
if (isset($options['p'])) {$password=$options['p'];}
if (isset($options['i'])) {$id=$options['i'];}
if (isset($options['a'])) {$age=$options['a'];}
if (isset($options['c'])) {$critical=$options['c'];}
if (isset($options['w'])) {$warning=$options['w'];}


if (empty($host) || empty($id)) {
	echo "UNKNOWN Host or ID missed\n";
	usage();
	exit($retcode['RC_UNKNOWN']);
}
if (empty($user) || empty($password)) {
	echo "UNKNOWN API username or Password\n";
	usage();
	exit($retcode['RC_UNKNOWN']);
}
$url="http://".$host.":".$port."/api/";

$id=(integer)$id;
$age=(integer)$age;

//start query IPS
try {
	//new object
	$rpc = new IPS_JSON($url,$user,$password);
	
	//check if IPS is available
	$version=$rpc->IPS_GetKernelVersion();
	if (!$version) {
		echo "UNKNOWN IPS Request failed:".$rpc->getErrorMessage()."\n";
		exit ($retcode['RC_UNKNOWN']);
	}
	//retrieve variable data
	$var=$rpc->get_var($id);
	//print_r($var);
	if (!$var) {
		echo "UNKNOWN ".$rpc->getErrorMessage()."\n";
		exit ($retcode['RC_UNKNOWN']);
	}

}catch (Exception $e) {
	echo "UNKNOWN IPS Call failed->".$e->getMessage()."\n";
	exit ($retcode['RC_UNKNOWN']);
}

//assign result
$name=$var["name"];
$value=$var["value"];
$digits=$var["digits"];
$last=$var["last"];
$type=$var["type"];
$suffix=$var["suffix"];

//last updated/age check
if (is_null($last)) {
		echo "WARNING - $name:$value, but has no timestamp\n";
		exit($retcode['RC_WARNING']);
	}
$diff=time()-$last;
if ($diff>$age) {
		echo "WARNING - $name:$value, but to old (actual ".$diff."s > max ". $age."s)\n";
		exit ($retcode['RC_WARNING']);
}

//formatting digits from profile
if (is_integer($digits)) {
	$value=sprintf("%0.".$digits."f",$value);
}

//generate output
$perf='';
$res="$name:".$value.$suffix.", Age=".$diff."s";
#only integer and float values are qualified as performance data
if ($type == 1 ||$type==2) {
//'label'=value[UOM];[warn];[crit];[min];[max]
	$perf=" |$name=$value;;;;";
}
#check level
if (isset($value) && (isset($critical) || isset($warning))) {
	#extract absolute value 
	if (preg_match('/-([\d\.]+)/',$value,$v)) {
		$data=$v[1];
	
	
		if (isset($critical) && ($data >= $critical)) {
			print "CRITICAL - $name : Value $data above critical level ($critical)  !".$perf."\n";
			exit($retcode['RC_CRITICAL']);
		}
		if (defined($warning) && ($data >= $warning)) {
			print "WARNING - $name: Value $data above warning level ($warning) !".$perf."\n";
			exit($retcode['RC_WARNING']);
		}
	}
}
#output
$res="$name:".$value.$suffix.", Age=".$diff."s";
//exit
echo "OK - ".$res.$perf."\n";
exit ($retcode['RC_OK']);

/**
 * print usage information
 *
 * @return void
 */
function usage():void {
	echo "Usage: check_ips_json.php [-h]|-i <VariableID> [-c <critical level>(absolute)] [-w <warning level>(absolute)] [-f <config_file>] | [-H <IPSHOST> -P <IPSAPIPORT> [-a <maxage> in sec ] [-u <apiuser>] [-p <apipassword>]\n";
	exit (3);
}
