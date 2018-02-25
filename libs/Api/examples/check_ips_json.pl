#!/usr/bin/perl -w


# IPSymcon Variable Check via JSON API
# requires IPSymcon V3.1+
# (http://www.ip-symcon.de/service/dokumentation/entwicklerbereich/datenaustausch/)
# retrieves value of a given variable via id using json interface
# see http://www.tdressler.net/ipsymcon/icinga_ips.html
# (C) Thomas Dressler 2013-2018
# version 4.4
# date 25.02.2018
#

use strict;
use FindBin qw($Bin);
use lib "$Bin:$BIN/../";
use Getopt::Std;
use IPS_JSON;

#nagios/icinga return codes
our %retcode=(RC_OK=>0,RC_WARNING=>1,RC_ERROR=>2,RC_CRITICAL=>2,RC_UNKNOWN=>3);
our %retstatus=(0=>'OK',1=>'WARNING',2=>'CRITICAL',3=>'UNKNOWN');

my %opts;
my ($var_id,$value,$last,$name,$suffix,$type,$digits,$res,$perf,%data,$var,$diff);
my $config='IPS_JSON_config.cfg';

getopts('H:P:i:a:u:p:c:w:f:h',\%opts);
if ($opts{'h'}) {
	usage();
	exit($retcode{RC_UNKNOWN});
}

$config=$opts{'f'} if $opts{'f'};
our ($host,$port,$user,$password,$age,$critical,$warning);

#API Access ,see http://www.ip-symcon.de/service/dokumentation/komponenten/verwaltungskonsole/
$host="";
$port="3777";
$user='lizenz@email.ips';
$password='fernsteuer-password';

#default age
$age=3600;
#set config
if (-r $config) {
	do($config);
}
#commandline parameters have precedence
$host=$opts{'H'} if $opts{'H'};
$port=$opts{'P'} if $opts{'P'};
$user=$opts{'u'} if $opts{'u'};
$password=$opts{'p'} if $opts{'p'};
$age=$opts{'a'} if $opts{'a'};
$var_id=$opts{'i'} if $opts{'i'};
$critical=$opts{'c'} if $opts{'c'};
$warning=$opts{'w'} if $opts{'w'};
#must have an id
if (!defined($var_id)) {
	print "UNKNOWN: need atleast ID for Sensor Variable\n";
	usage();
	exit($retcode{RC_UNKNOWN});
}
if (!($user&& $password)) {
	print "UNKNOWN: need API Username & password\n";
	exit($retcode{RC_UNKNOWN});
}
#reate api url
my $url="http://".$host.":".$port."/api/";#need trailing slash!
my $ips=IPS_JSON->new($url,$user,$password,2);


if ($ips->is_int($var_id)) {
	$var_id=int($var_id);
	$var=$ips->get_var($var_id,$age);	
	if(!$var){
		if ($ips->getError) {
		#error occured, data contains return code
			print "UNKNOWN - ".$ips->getError;
		
		}else{
			print "UNKNWOWN - No data returned";	
		}
		
		exit ($retcode{RC_UNKNOWN});
	}
	
	$value=$var->{value};
	$last=$var->{last};
	$name=$var->{name};
	$suffix=$var->{suffix};
	$type=$var->{type};
	$digits=$var->{digits};
	if (length($last)<1) {
		print "WARNING - $name:$value, but has no timestamp\n";
		exit($retcode{RC_WARNING});
	}
	
	$diff=time()-int($last);
	if ($diff>$age) {
		print "WARNING - $name:$value, but to old (actual ".$diff."s > max ". $age."s)\n";
		exit($retcode{RC_WARNING});
	}
	if ($ips->is_int($digits)) {
		$value=sprintf("%0.".$digits."f",$value);
	}
}else{
	print "UNKNOWN - Sensorid $var_id is not a integer\n";
	exit($retcode{RC_UNKNOWN});
}
#performance data
if ($type == 1 ||$type==2) {
	#'label'=value[UOM];[warn];[crit];[min];[max]
	$perf=" |$name=$value;;;;";
}

#check level
if (defined($value) && (defined($critical) || defined($warning))) {
	#extract absolute value 
	if ($value=~ /-([\d\.]+)/) {
		my $data=$1;
	
	
		if (defined($critical) && ($data >= $critical)) {
			print "CRITICAL - $name : Value $data above critical level ($critical)  !".$perf."\n";
			exit($retcode{RC_CRITICAL});
		}
		if (defined($warning) && ($data >= $warning)) {
			print "WARNING - $name: Value $data above warning level ($warning) !".$perf."\n";
			exit($retcode{RC_WARNING});
		}
	}
}
#output
$res="$name:".$value.$suffix.", Age=".$diff."s";


print "OK - ".$res.$perf."\n";
exit ($retcode{RC_OK});


sub usage {
	print "Usage:$0  [-h]| -i <VariableID> [-c <critical level>(absolute)] [-w <warning level>(absolute)] [-f <config_file>] | [-H <IPSHOST> -P <IPSAPIPORT> [-a <maxage> in sec ] [-u <apiuser>] [-p <apipassword>] [-h]\n";
}

