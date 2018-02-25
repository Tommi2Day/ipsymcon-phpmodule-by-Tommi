#!/usr/bin/perl -w

# Demo script for switching an actor via JSON API
# requires IPSymcon V3.0+
# see http://www.ip-symcon.de/service/dokumentation/entwicklerbereich/datenaustausch/
# see http://www.tdressler.net/ipsymcon/ipsymcon_api.html
# (C) Thomas Dressler 2013-2014 
# V0.2 04.01.2014

use strict;
use FindBin qw($Bin);
use lib "$Bin:$Bin/../";
use Getopt::Std;
use IPS_JSON;
my %opts;
getopts('H:P:i:s:u:p:c:h',\%opts);
if ($opts{'h'}) {
	usage();
	exit;
}
my $config='IPS_JSON_config.cfg';
$config=$opts{'c'} if $opts{'c'};
our ($host,$port,$user,$password);
#API Access ,see http://www.ip-symcon.de/service/dokumentation/komponenten/verwaltungskonsole/
$host='localhost';
$port=3777;
$user='lizenz@email.ips';
$password='fernzugriff Kennword';

#set config from file if available
if (-r $config) {
	do($config);
}
#commandline parameters have precedence
$host=$opts{'H'} if $opts{'H'};
$port=$opts{'P'} if $opts{'P'};
$user=$opts{'u'} if $opts{'u'};
$password=$opts{'p'} if $opts{'p'};
my $state=$opts{'s'} if exists($opts{s});
my $var_id=$opts{'i'} if $opts{'i'};
if (!($user&& $password)) {
	print "UNKNOWN: need API Username & password\n";
	exit;
}
#reate api url
my $url="http://".$host.":".$port."/api/";#need trailing slash!
my $ips=IPS_JSON->new($url,$user,$password,2);
#if (!$ips->is_string($var_id) || !$ips->is_string($state)) {
if (!defined($var_id) || !defined($state)) {
	print "Error - need atleast FS20 Instance ID and switch state\n";
    usage();
	exit(1);
}

my ($res,$error);
if (!$ips->is_int($var_id)) {
	print "Error VariableID $var_id is not integer\n";
	exit(1);
}

$var_id=int($var_id);#must be integer
$res=$ips->IPS_InstanceExists($var_id);
if (!defined($res)) {
    $error=$ips->getError;
    print "Error - IPS_InstanceExists Request failed:$error\n";
	exit(1);
    
}
if (!$res) {
	print "Error - Instance $var_id doesnt exist on Server $host\n";
	exit(1);
}

my $inst=$ips->IPS_GetInstance($var_id);
if (!$inst) {
    $error=$ips->getError();
    print "Error - IPS_GetInstance Request failed:$error\n";
	exit(1);
}
 
my $name=$inst->{ModuleInfo}{ModuleName};
if ($name eq "FS20") {
    my $action=$ips->bool($state=~/On|Ein|1/i);
    $res=$ips->FS20_SwitchMode($var_id,$action);
    if ($res) {
        print "OK - Set FS20 Switch $var_id to ".(($state=~/On|Ein|1/i)?"On":"Off")." successfully\n";
        exit (0);
    }else{
		$error=$ips->getError();
        print "Error - Set FS20 Switch $var_id to ".(($state=~/On|Ein|1/i)?"On":"Off")." failed:$error\n";
		exit(1);
    }
    
}else{
    print "Error - ID $var_id is not a FS20 instance\n";
	exit(1);
}

sub usage{
    print "usage: $0 -i <instanceid> -s <state> [-c <config_file>]| [-H <ipshost>] [-P <apiport>] [-u <apiuser> -p <apipass>]\n";
    print "state: use On|Ein|1 for 'on', others means 'off'>\n";
}