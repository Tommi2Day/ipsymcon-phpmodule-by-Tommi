#!/usr/bin/php
<?php
/**
 * @file
 *
 * WS300PC IPSymcon PHP History Reader
 *
 * @author Thomas Dressler
 * @copyright Thomas Dressler 2009-2016
 * @version 2.1
 * @date 2016-05-01
 */
if (!function_exists('IPS_GetKernelVersion')) {
   //we are outside of IPS and need the JSON wrapper
   require_once('../Api/ips_wrapper.php');
}
if (!function_exists('IPS_GetKernelVersion')) {
	print "Need IPSymcon functions\n";
	exit(1);
}
$id_ws300=53828;
$id_last=31378;
$log="ws300data.csv";
$fh=fopen($log,"a+");
if (!$fh ) {
	print "Cannot open $log\n";
	exit(1);
}
$rec=0;
$retry=0;
$rec=read_data($rec);
$lastdate=GetValueString($id_last);
fclose ($fh);
print $lastdate." ($rec) - Ende\n";

function read_data($rec) {
 	$myrec=$rec;
	global $retry;
	global $id_ws300;
	global $id_last;
	global $fh;
	$retry++;
	$data=WS300PC_ReadNextRecord($id_ws300);
	while( $data <> '' ) {
		$myrec++;
		fwrite ($fh,$data);
   		//$lastdate=GetValueString($id_last);
   		//print "$lastdate - Rec $myrec\n";
		#get next
		$data=WS300PC_ReadNextRecord($id_ws300);
	}
 	$lastdate=GetValueString($id_last);
	$d1=strtotime($lastdate);
	$d2=strtotime('now');
	$sec=$d2-$d1;
	#recursion
	if ($lastdate && ($sec>3600) && ($retry<10)) $myrec=read_data($myrec); 
	return $myrec;
}
?>
