#!/usr/bin/perl -w

# logging Temperature/Humidity Sensors from IPSymcon viaJSON API
# requires IPSymcon V3.1+
# (http://www.ip-symcon.de/service/dokumentation/entwicklerbereich/datenaustausch/)
# see http://www.tdressler.net/ipsymcon/icinga_ips.html
# (C) Thomas Dressler 2013-2014 
# V4.0 13.02.2014

use strict;
use FindBin qw($Bin);
use lib "$Bin";
use Getopt::Std;
use File::Basename;
use IPS_JSON;

sub usage();
sub ask_ips($$);

#nagios/icinga return codes

our %retcode=(RC_OK=>0,RC_WARNING=>1,RC_ERROR=>2,RC_CRITICAL=>2,RC_UNKNOWN=>3);
our %retstatus=(0=>'OK',1=>'WARNING',2=>'CRITICAL',3=>'UNKNOWN');

my $lastfile="./".basename($0)."-";
my %opts;
my ($value,$last,$name,$suffix,$type,$digits,$res,$perf,$var,$diff);
my $config='IPS_JSON_config.cfg';


getopts('H:p:t:f:a:c:h',\%opts);
if ($opts{'h'}) {
	usage();
	exit($retcode{RC_OK});
}

if ($opts{'h'}) {
	usage();
	exit($retcode{RC_OK});
}

$config=$opts{'c'} if $opts{'c'};
our ($host,$port,$user,$password,$age);
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
my $tempid=$opts{'t'} if exists($opts{'t'});
my $humid=$opts{'f'};

$res='';
$perf='';
$last=0;
if (!($user&& $password)) {
	print "UNKNOWN: need API Username & password\n";
	exit($retcode{RC_UNKNOWN});
}
#reate api url
my $url="http://".$host.":".$port."/api/";#need trailing slash!
our $ips=IPS_JSON->new($url,$user,$password,2);

my ($prev_temp,$prev_hum);
my ($temp,$hum,$cmd,$ret,$data);
if (!defined($tempid)) {
	print "UNKNOWN: need atleast ID for temperatur\n";
	exit($retcode{RC_UNKNOWN});
}
$lastfile.=$tempid.".last";
if (-r $lastfile) {
	if(open (IN,"<",$lastfile )){
		($prev_temp,$prev_hum)=<IN>;
		chop $prev_temp if $prev_temp;
		chop $prev_hum if $prev_hum;
		close IN;
	}
}
#temperature
$data=ask_ips($tempid,$age);
if ($data) {
	($temp,$last)=split(/\n/,$data);
	if (defined($prev_temp)) {
		if (abs($temp-$prev_temp)>5) {
			print "UNKNOWN:  $temp °C differs too much from previous value ($prev_temp)\n";
			exit($retcode{RC_UNKNOWN});
		}
	}			 
	$res="Temperatur:".$temp."°C, Age=".$last."s";
	$perf.="Temp=$temp";
}else{
	print "UNKNOWN:  No data for Variable $tempid\n";
	exit($retcode{RC_UNKNOWN});
}
	
#humidity(if set)
if (defined($humid)) {
	$data=ask_ips($humid,$age);
	if ($data) {
		($hum,$last)=split(/\n/,$data);
		$res.=" Humidity:".$hum."%, Age=".$last."s";
		$perf.=" Humidity=$hum%";
	}
		
}
#store last value
if(open (OUT,">",$lastfile )){
#open (OUT,">",$lastfile );
      print OUT $temp."\n";
      print OUT $hum."\n" if defined($hum);
      close OUT;
}
	
print "OK - ".$res." |".$perf.";;;;\n";
exit ($retcode{RC_OK});

sub ask_ips($$) {
my ($cmd,$ret,$code,$var);
	my $id=shift;
	my $age=shift;
	my $sensorid=int($id);
	$var=$ips->get_var($sensorid,$age);	
	if(!$var){
		if ($ips->getError) {
		#error occured, data contains return code
			print "UNKNOWN - ".$ips->getError;
		
		}else{
			print "UNKNOWN - No data returned";	
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
	return "$value\n$diff";
}
sub usage() {
	print "$0 [-H <IPSHOST>] [-P <IPSPORT>] -t <ID Temperature> [-f <ID Humidity>] [-a <maxage> in sec ] [-u <APIUSER>] [-p <APIPASS>] [-h]\n";
}
