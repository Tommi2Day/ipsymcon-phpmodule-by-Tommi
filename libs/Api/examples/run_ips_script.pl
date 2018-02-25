#!/usr/bin/env perl
#
# Demo script for running an IPS_Script via JSON API
# requires IPSymcon V3.1+
# see http://www.ip-symcon.de/service/dokumentation/entwicklerbereich/datenaustausch/
# see http://www.tdressler.net/ipsymcon/ipsymcon_api.html
# (C) Thomas Dressler 2013-2014 
# V1.0 23.02.2014

use strict;
use FindBin qw($Bin);
use lib "$Bin:$BIN/../";
use Getopt::Std;
use File::Basename;
use IPS_JSON;
my %opts;
our ($port,$user,$password,$config,$host,$url,$ips,$timeout);
my ($res,$script_id);


getopts('H:P:u:p:s:c:t:h',\%opts);
if ($opts{'h'}) {
	usage();
	exit(2);
}

$config='IPS_JSON_config.cfg';
$timeout=2;
$config=$opts{'c'} if $opts{'c'};
#set config
if (-r $config) {
	do($config);
}
#commandline parameters have precedence
$port=$opts{'P'} if $opts{'P'};
$user=$opts{'u'} if $opts{'u'};
$password=$opts{'p'} if $opts{'p'};
$script_id=$opts{'s'} if exists($opts{'s'});
$timeout=$opts{'t'} if exists($opts{'t'});

#must have an id
if (!defined($script_id)) {
	print "UNKNOWN: need atleast ID for Script\n";
	usage();
	exit 2;
}
if (!($user&& $password)) {
	print "UNKNOWN: need API Username & password\n";
	exit 2;
}
#reate api url
$url="http://".$host.":".$port."/api/";#need trailing slash!
$ips=IPS_JSON->new($url,$user,$password,$timeout);


if ($ips->is_int($script_id)) {
	$script_id=int($script_id);
	my $data=$ips->get_script($script_id);
	if (!$data) {
		if ($ips->getError) {
		#error occured, data contains return code
			print "Error - ".$ips->getError."\n";
		}else {
			print "unknown Error retrieving Script ".$script_id."\n";
		}
		exit 1;
	}
	print "Start script ID ".$script_id." '".$data->{name}."' (".$data->{file}.")\n";
	$res=$ips->IPS_RunScriptWait($script_id+0); #make sure $script_id is it not a string
	#script must return a value via print output to fill $res
	if($res){
		print "Script execution ID $script_id returned: $res \n";
		exit (0);
	}else{	
		if ($ips->getError) {
		#error occured, data contains return code
			print "Error - ".$ips->getError."\n";
		}
	}
}
exit 1;

sub usage {
	print "$0 [-H <IPSHOST>] [-P <IPSPORT>] -s <Script-ID> [-u <APIUSER>] [-p <APIPASS>] [-t <timeout>] [-h]\n";
}
