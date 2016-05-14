#!/usr/bin/perl
#** @file
# read historic records from ws300pc using symcon JSON API and write it to csv
# Usage: ws300pc_history.pl [<api_config_file>]
# Descriptions :
# @see http://www.tdressler.net/ipsymcon/jsonapi.html
# @see http://www.symcon.de/service/dokumentation/entwicklerbereich/datenaustausch/
# @author Thomas Dressler
# @copyright Thomas Dressler 2009-2016
# @version 4.0
# @date 2016-05-14
#*

use strict;
use lib '../Api';
use IPS_JSON;
use Time::Piece;
use File::Basename;

#id ws300pc instance
our $id_ws300=53828;
#id lastdate variable
our $id_last=31378;
#csv filename
our $log="ws300data.csv";
#ips host
our $host='localhost';
#ips port
our $port=3777;
#license username
our $user='lizenz@email.de';
#remote access password
our $password='secret';
#http timeout
our $timeout=5;
#debug
our $debug=$ENV{DEBUG};

#take commandline argument(if any) as config filename
my $config=$1 ;
$config=dirname($0)."/IPS_JSON_config.cfg" if !$config;
if (-r $config) {
        do($config);
}

#try to open csv file
if (!open(L,">>",$log))  {
	print "Cannot open $log\n";
	exit(1);
}

# URL endpoint
my $url="http://$host:$port/api/";
our $rpc=new IPS_JSON($url,$user,$password,$timeout);

#retrieve last record date from ips to check API
our $lastdate=$rpc->GetValueString($id_last);
my $error=$rpc->getError();
if ($error) {
           	print "Error: $error \n";
           	exit(1);
}

#start work
print "Start with $lastdate on $url\n";
our $rec=0;
our $retry=0;
our $rec=0;
#do the magic (recursiv)
$rec=read_data($rec);

#finish
close (L);
$lastdate=$rpc->GetValueString($id_last);
print "Last record ".$lastdate." ($rec) \n";
#---------SUB--------------
sub read_data() {
    my $curr=shift;
	my $lastdate;
	$retry++;
	#get next record
	my $data=$rpc->WS300PC_ReadNextRecord($id_ws300);
	my $error=$rpc->getError();
	print "Error: $error\n" if($error); 
	while( $data ) {
	    #got data
		$lastdate=undef;
		#write to csv
		$curr++;
		print L $data;
   		$lastdate=$rpc->GetValueString($id_last);
   		print "$lastdate - Rec $curr\n" if ($debug);
		#get next
		$data=$rpc->WS300PC_ReadNextRecord($id_ws300);
	}
	#check timediff if extracting records ends premature
 	$lastdate=$rpc->GetValueString($id_last);
	if ($lastdate) {
		my $d2=time();
 		my $d1 = Time::Piece->strptime($lastdate,"%Y-%m-%dT%H:%M:%S%z");
		my $sec=$d2-($d1->epoch);
		print "Date:'$lastdate' D1: ".$d1->epoch.", D2: $d2 Diff: $sec\n" if ($debug);
		#restart myself in recursion if i expect more records up to last hour
		if ( ($sec>3600) && ($retry<10) ) {
			$curr=read_data($curr);
		}
	}
	return $curr;
}

