<?php

/** @file ips_wrapper.php
 *
 *
 * Wrapper for IP-Symcon function calls to be executed via JSON API.
 *
 * This wrapper helps you to execute scripts written for IPSymcon also on other PHP boxes
 * using IPSymcon JSON API. It defines all of known functions and map this to a JSON call.
 *
 * Usage:
 *@code {.php}
//include wrapper only if not in native IPS
if (!function_exists('IPS_GetKernelVersion')) {
   //we are outside of IPS and need the JSON wrapper
   include('ips_wrapper.php');
}
//now you can call ips functions as usual
$version=IPS_GetKernelVersion();
print $version;
@endcode
 *
 * @pre All functions are located in ips_wrapper.php. You need the class file IPS_JSON.php as well.
 *
 * @pre you may create an additional file IPS_JSON_config.cfg which will summarize your JSON API settings as below.
 * This will have precendence over the generated values.
 * @code {.php}
$config='IPS_JSON_config.cfg';
// IPsymcon API Definitions
$host='localhost';
$port='82';
$user='lizenz benutzer name';
$password='fernzugriff-kennword';
@endcode
 *
 * This wrapper has been generated using gen_ips_wrapper.php
 *
 * @version 0.4 (gen_ips_wrapper.php)
 * @version 4.00 (IPSymcon)
 * @date 2016-05-01 (generated)
 * @copyright Thomas Dressler 2013-2016
 *
 * @see http://www.tdressler.net/ipsymcon/funktionsliste.html#wrapper
 * @see http://www.tdressler.net/ipsymcon/jsonapi.html

 */

require ("IPS_JSON.php");
if ( !class_exists("IPS_JSON"))
{
	print "This requires PHP JSON and IPS_JSON class\n";
	exit;
}

//default configuration
/*
 * name and path of config file
 */
$config="IPS_JSON_config.cfg";
/*
 * host to connect
 */
$host='localhost';
/*
 * API Port to connect (usually 3777 or 82)
 */
$port='3777';
/*
 * License user name (eg. email)
 */
$user='lizenz benutzer name';
/*
 * ips password
 */
$password='fernzugriff-kennword';
//overwrite default configuration as above with your settings if needed
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
* @var IPS_JSON $rpc
*/
$rpc = new IPS_JSON($url,$user,$password);


/**
* AC_ChangeVariableID
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $OldVariableID
* @param Integer $NewVariableID
*/

function AC_ChangeVariableID( $InstanceID,$OldVariableID,$NewVariableID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AC_ChangeVariableID( $InstanceID,$OldVariableID,$NewVariableID );
	return $result;
}

/**
* AC_DeleteVariableData
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $VariableID
* @param Integer $StartTime
* @param Integer $EndTime
*/

function AC_DeleteVariableData( $InstanceID,$VariableID,$StartTime,$EndTime ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AC_DeleteVariableData( $InstanceID,$VariableID,$StartTime,$EndTime );
	return $result;
}

/**
* AC_GetAggregatedValues
* 
* @returns Variant
* @param Integer $InstanceID
* @param Integer $VariableID
* @param integer $AggregationSpan
*   enum[0=agHour, 1=agDay, 2=agWeek, 3=agMonth, 4=agYear, 5=ag5Minutes, 6=ag1Minute, 7=agChanges]
* @param Integer $StartTime
* @param Integer $EndTime
* @param Integer $Limit
*/

function AC_GetAggregatedValues( $InstanceID,$VariableID,$AggregationSpan,$StartTime,$EndTime,$Limit ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AC_GetAggregatedValues( $InstanceID,$VariableID,$AggregationSpan,$StartTime,$EndTime,$Limit );
	return $result;
}

/**
* AC_GetAggregationType
* 
* @returns Integer
* @param Integer $InstanceID
* @param Integer $VariableID
*/

function AC_GetAggregationType( $InstanceID,$VariableID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AC_GetAggregationType( $InstanceID,$VariableID );
	return $result;
}

/**
* AC_GetAggregationVariables
* 
* @returns Variant
* @param Integer $InstanceID
* @param Boolean $CalculateStatistics
*/

function AC_GetAggregationVariables( $InstanceID,$CalculateStatistics ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AC_GetAggregationVariables( $InstanceID,$CalculateStatistics );
	return $result;
}

/**
* AC_GetGraphStatus
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $VariableID
*/

function AC_GetGraphStatus( $InstanceID,$VariableID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AC_GetGraphStatus( $InstanceID,$VariableID );
	return $result;
}

/**
* AC_GetLoggedValues
* 
* @returns Variant
* @param Integer $InstanceID
* @param Integer $VariableID
* @param Integer $StartTime
* @param Integer $EndTime
* @param Integer $Limit
*/

function AC_GetLoggedValues( $InstanceID,$VariableID,$StartTime,$EndTime,$Limit ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AC_GetLoggedValues( $InstanceID,$VariableID,$StartTime,$EndTime,$Limit );
	return $result;
}

/**
* AC_GetLoggingStatus
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $VariableID
*/

function AC_GetLoggingStatus( $InstanceID,$VariableID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AC_GetLoggingStatus( $InstanceID,$VariableID );
	return $result;
}

/**
* AC_ReAggregateVariable
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $VariableID
*/

function AC_ReAggregateVariable( $InstanceID,$VariableID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AC_ReAggregateVariable( $InstanceID,$VariableID );
	return $result;
}

/**
* AC_SetAggregationType
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $VariableID
* @param integer $AggregationType
*   enum[0=asGauge, 1=asCounter]
*/

function AC_SetAggregationType( $InstanceID,$VariableID,$AggregationType ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AC_SetAggregationType( $InstanceID,$VariableID,$AggregationType );
	return $result;
}

/**
* AC_SetGraphStatus
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $VariableID
* @param Boolean $Active
*/

function AC_SetGraphStatus( $InstanceID,$VariableID,$Active ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AC_SetGraphStatus( $InstanceID,$VariableID,$Active );
	return $result;
}

/**
* AC_SetLoggingStatus
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $VariableID
* @param Boolean $Active
*/

function AC_SetLoggingStatus( $InstanceID,$VariableID,$Active ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AC_SetLoggingStatus( $InstanceID,$VariableID,$Active );
	return $result;
}

/**
* AESGI_RequestCurrentLimit
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function AESGI_RequestCurrentLimit( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AESGI_RequestCurrentLimit( $InstanceID );
	return $result;
}

/**
* AESGI_RequestErrors
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function AESGI_RequestErrors( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AESGI_RequestErrors( $InstanceID );
	return $result;
}

/**
* AESGI_RequestPowerReduction
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function AESGI_RequestPowerReduction( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AESGI_RequestPowerReduction( $InstanceID );
	return $result;
}

/**
* AESGI_RequestRunMode
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function AESGI_RequestRunMode( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AESGI_RequestRunMode( $InstanceID );
	return $result;
}

/**
* AESGI_RequestStatus
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function AESGI_RequestStatus( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AESGI_RequestStatus( $InstanceID );
	return $result;
}

/**
* AESGI_RequestType
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function AESGI_RequestType( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AESGI_RequestType( $InstanceID );
	return $result;
}

/**
* AESGI_SetCurrentLimit
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Float $Limit
*/

function AESGI_SetCurrentLimit( $InstanceID,$Limit ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AESGI_SetCurrentLimit( $InstanceID,$Limit );
	return $result;
}

/**
* AESGI_SetPowerReduction
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Percent
*/

function AESGI_SetPowerReduction( $InstanceID,$Percent ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AESGI_SetPowerReduction( $InstanceID,$Percent );
	return $result;
}

/**
* AESGI_SetRunMode
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Mode
* @param Float $PowerLimit
*/

function AESGI_SetRunMode( $InstanceID,$Mode,$PowerLimit ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AESGI_SetRunMode( $InstanceID,$Mode,$PowerLimit );
	return $result;
}

/**
* AHA_Query
* 
* @returns Array
* @param Integer $InstanceID
*/

function AHA_Query( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AHA_Query( $InstanceID );
	return $result;
}

/**
* AHA_SwitchMode
* 
* @returns Array
* @param Integer $InstanceID
* @param Array $ain
* @param Array $val
*/

function AHA_SwitchMode( $InstanceID,$ain,$val ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AHA_SwitchMode( $InstanceID,$ain,$val );
	return $result;
}

/**
* AHA_UpdateEvent
* 
* @returns Array
* @param Integer $InstanceID
*/

function AHA_UpdateEvent( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AHA_UpdateEvent( $InstanceID );
	return $result;
}

/**
* ALL_ReadConfiguration
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function ALL_ReadConfiguration( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ALL_ReadConfiguration( $InstanceID );
	return $result;
}

/**
* ALL_SwitchActor
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $ChannelID
* @param Boolean $DeviceOn
*/

function ALL_SwitchActor( $InstanceID,$ChannelID,$DeviceOn ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ALL_SwitchActor( $InstanceID,$ChannelID,$DeviceOn );
	return $result;
}

/**
* ALL_SwitchMode
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Boolean $DeviceOn
*/

function ALL_SwitchMode( $InstanceID,$DeviceOn ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ALL_SwitchMode( $InstanceID,$DeviceOn );
	return $result;
}

/**
* ALL_UpdateValues
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function ALL_UpdateValues( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ALL_UpdateValues( $InstanceID );
	return $result;
}

/**
* CC_GetURL
* 
* @returns String
* @param Integer $InstanceID
*/

function CC_GetURL( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->CC_GetURL( $InstanceID );
	return $result;
}

/**
* CSCK_SendText
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Text
*/

function CSCK_SendText( $InstanceID,$Text ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->CSCK_SendText( $InstanceID,$Text );
	return $result;
}

/**
* CUL_ReInitEvent
* 
* @returns Array
* @param Integer $InstanceID
*/

function CUL_ReInitEvent( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->CUL_ReInitEvent( $InstanceID );
	return $result;
}

/**
* Cutter_ClearBuffer
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function Cutter_ClearBuffer( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->Cutter_ClearBuffer( $InstanceID );
	return $result;
}

/**
* DMX_FadeChannel
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Channel
* @param Integer $Value
* @param Float $FadingSeconds
*/

function DMX_FadeChannel( $InstanceID,$Channel,$Value,$FadingSeconds ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DMX_FadeChannel( $InstanceID,$Channel,$Value,$FadingSeconds );
	return $result;
}

/**
* DMX_FadeChannelDelayed
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Channel
* @param Integer $Value
* @param Float $FadingSeconds
* @param Float $DelayedSeconds
*/

function DMX_FadeChannelDelayed( $InstanceID,$Channel,$Value,$FadingSeconds,$DelayedSeconds ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DMX_FadeChannelDelayed( $InstanceID,$Channel,$Value,$FadingSeconds,$DelayedSeconds );
	return $result;
}

/**
* DMX_FadeRGB
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $R
* @param Integer $G
* @param Integer $B
* @param Float $FadingSeconds
*/

function DMX_FadeRGB( $InstanceID,$R,$G,$B,$FadingSeconds ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DMX_FadeRGB( $InstanceID,$R,$G,$B,$FadingSeconds );
	return $result;
}

/**
* DMX_FadeRGBDelayed
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $R
* @param Integer $G
* @param Integer $B
* @param Float $FadingSeconds
* @param Float $DelayedSeconds
*/

function DMX_FadeRGBDelayed( $InstanceID,$R,$G,$B,$FadingSeconds,$DelayedSeconds ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DMX_FadeRGBDelayed( $InstanceID,$R,$G,$B,$FadingSeconds,$DelayedSeconds );
	return $result;
}

/**
* DMX_RequestInfo
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function DMX_RequestInfo( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DMX_RequestInfo( $InstanceID );
	return $result;
}

/**
* DMX_ResetInterface
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function DMX_ResetInterface( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DMX_ResetInterface( $InstanceID );
	return $result;
}

/**
* DMX_SetBlackOut
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Boolean $BlackoutOn
*/

function DMX_SetBlackOut( $InstanceID,$BlackoutOn ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DMX_SetBlackOut( $InstanceID,$BlackoutOn );
	return $result;
}

/**
* DMX_SetChannel
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Channel
* @param Integer $Value
*/

function DMX_SetChannel( $InstanceID,$Channel,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DMX_SetChannel( $InstanceID,$Channel,$Value );
	return $result;
}

/**
* DMX_SetRGB
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $R
* @param Integer $G
* @param Integer $B
*/

function DMX_SetRGB( $InstanceID,$R,$G,$B ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DMX_SetRGB( $InstanceID,$R,$G,$B );
	return $result;
}

/**
* DS_CallScene
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $SceneID
*/

function DS_CallScene( $InstanceID,$SceneID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DS_CallScene( $InstanceID,$SceneID );
	return $result;
}

/**
* DS_DimSet
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Intensity
*/

function DS_DimSet( $InstanceID,$Intensity ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DS_DimSet( $InstanceID,$Intensity );
	return $result;
}

/**
* DS_GetKnownDevices
* 
* @returns Variant
* @param Integer $InstanceID
*/

function DS_GetKnownDevices( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DS_GetKnownDevices( $InstanceID );
	return $result;
}

/**
* DS_RequestStatus
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function DS_RequestStatus( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DS_RequestStatus( $InstanceID );
	return $result;
}

/**
* DS_RequestToken
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Username
* @param String $Password
*/

function DS_RequestToken( $InstanceID,$Username,$Password ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DS_RequestToken( $InstanceID,$Username,$Password );
	return $result;
}

/**
* DS_SaveScene
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $SceneID
*/

function DS_SaveScene( $InstanceID,$SceneID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DS_SaveScene( $InstanceID,$SceneID );
	return $result;
}

/**
* DS_ShutterMove
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Position
*/

function DS_ShutterMove( $InstanceID,$Position ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DS_ShutterMove( $InstanceID,$Position );
	return $result;
}

/**
* DS_ShutterMoveDown
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function DS_ShutterMoveDown( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DS_ShutterMoveDown( $InstanceID );
	return $result;
}

/**
* DS_ShutterMoveUp
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function DS_ShutterMoveUp( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DS_ShutterMoveUp( $InstanceID );
	return $result;
}

/**
* DS_ShutterStop
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function DS_ShutterStop( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DS_ShutterStop( $InstanceID );
	return $result;
}

/**
* DS_SwitchMode
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Boolean $DeviceOn
*/

function DS_SwitchMode( $InstanceID,$DeviceOn ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DS_SwitchMode( $InstanceID,$DeviceOn );
	return $result;
}

/**
* DS_UndoScene
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $SceneID
*/

function DS_UndoScene( $InstanceID,$SceneID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DS_UndoScene( $InstanceID,$SceneID );
	return $result;
}

/**
* EIB_Char
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Value
*/

function EIB_Char( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_Char( $InstanceID,$Value );
	return $result;
}

/**
* EIB_Counter16bit
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Value
*/

function EIB_Counter16bit( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_Counter16bit( $InstanceID,$Value );
	return $result;
}

/**
* EIB_Counter32bit
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Value
*/

function EIB_Counter32bit( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_Counter32bit( $InstanceID,$Value );
	return $result;
}

/**
* EIB_Counter8bit
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Value
*/

function EIB_Counter8bit( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_Counter8bit( $InstanceID,$Value );
	return $result;
}

/**
* EIB_Date
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Value
*/

function EIB_Date( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_Date( $InstanceID,$Value );
	return $result;
}

/**
* EIB_DimControl
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Value
*/

function EIB_DimControl( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_DimControl( $InstanceID,$Value );
	return $result;
}

/**
* EIB_DimValue
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Value
*/

function EIB_DimValue( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_DimValue( $InstanceID,$Value );
	return $result;
}

/**
* EIB_DriveBladeValue
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Value
*/

function EIB_DriveBladeValue( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_DriveBladeValue( $InstanceID,$Value );
	return $result;
}

/**
* EIB_DriveMove
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Boolean $Value
*/

function EIB_DriveMove( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_DriveMove( $InstanceID,$Value );
	return $result;
}

/**
* EIB_DriveShutterValue
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Value
*/

function EIB_DriveShutterValue( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_DriveShutterValue( $InstanceID,$Value );
	return $result;
}

/**
* EIB_DriveStep
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Boolean $Value
*/

function EIB_DriveStep( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_DriveStep( $InstanceID,$Value );
	return $result;
}

/**
* EIB_FloatValue
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Float $Value
*/

function EIB_FloatValue( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_FloatValue( $InstanceID,$Value );
	return $result;
}

/**
* EIB_GetKnownDevices
* 
* @returns Variant
* @param Integer $InstanceID
*/

function EIB_GetKnownDevices( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_GetKnownDevices( $InstanceID );
	return $result;
}

/**
* EIB_Move
* 
* @returns Boolean
* @param Integer $InstanceID
* @param integer $Command
*   enum[0=emcOpen, 1=emcStepOpen, 2=emcStop, 3=emcStepClose, 4=emcClose]
*/

function EIB_Move( $InstanceID,$Command ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_Move( $InstanceID,$Command );
	return $result;
}

/**
* EIB_Position
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Position
*/

function EIB_Position( $InstanceID,$Position ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_Position( $InstanceID,$Position );
	return $result;
}

/**
* EIB_PriorityControl
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Value
*/

function EIB_PriorityControl( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_PriorityControl( $InstanceID,$Value );
	return $result;
}

/**
* EIB_PriorityPosition
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Boolean $Value
*/

function EIB_PriorityPosition( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_PriorityPosition( $InstanceID,$Value );
	return $result;
}

/**
* EIB_RequestInfo
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function EIB_RequestInfo( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_RequestInfo( $InstanceID );
	return $result;
}

/**
* EIB_RequestStatus
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function EIB_RequestStatus( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_RequestStatus( $InstanceID );
	return $result;
}

/**
* EIB_Scale
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Value
*/

function EIB_Scale( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_Scale( $InstanceID,$Value );
	return $result;
}

/**
* EIB_SearchDevices
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function EIB_SearchDevices( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_SearchDevices( $InstanceID );
	return $result;
}

/**
* EIB_SetRGB
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $R
* @param Integer $G
* @param Integer $B
*/

function EIB_SetRGB( $InstanceID,$R,$G,$B ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_SetRGB( $InstanceID,$R,$G,$B );
	return $result;
}

/**
* EIB_SetRGBW
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $R
* @param Integer $G
* @param Integer $B
* @param Integer $W
*/

function EIB_SetRGBW( $InstanceID,$R,$G,$B,$W ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_SetRGBW( $InstanceID,$R,$G,$B,$W );
	return $result;
}

/**
* EIB_Str
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Value
*/

function EIB_Str( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_Str( $InstanceID,$Value );
	return $result;
}

/**
* EIB_Switch
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Boolean $Value
*/

function EIB_Switch( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_Switch( $InstanceID,$Value );
	return $result;
}

/**
* EIB_Time
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Value
*/

function EIB_Time( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_Time( $InstanceID,$Value );
	return $result;
}

/**
* EIB_UploadDataPointFile
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Content
*/

function EIB_UploadDataPointFile( $InstanceID,$Content ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_UploadDataPointFile( $InstanceID,$Content );
	return $result;
}

/**
* EIB_Value
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Float $Value
*/

function EIB_Value( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_Value( $InstanceID,$Value );
	return $result;
}

/**
* END_SendDataToParent
* 
* @returns Array
* @param Integer $InstanceID
* @param Array $Data
*/

function END_SendDataToParent( $InstanceID,$Data ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->END_SendDataToParent( $InstanceID,$Data );
	return $result;
}

/**
* ENO_DimSet
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Intensity
*/

function ENO_DimSet( $InstanceID,$Intensity ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_DimSet( $InstanceID,$Intensity );
	return $result;
}

/**
* ENO_SendCST
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Boolean $value
*/

function ENO_SendCST( $InstanceID,$value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SendCST( $InstanceID,$value );
	return $result;
}

/**
* ENO_SendCTM
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $value
*/

function ENO_SendCTM( $InstanceID,$value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SendCTM( $InstanceID,$value );
	return $result;
}

/**
* ENO_SendCV
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Float $value
*/

function ENO_SendCV( $InstanceID,$value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SendCV( $InstanceID,$value );
	return $result;
}

/**
* ENO_SendERH
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Boolean $value
*/

function ENO_SendERH( $InstanceID,$value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SendERH( $InstanceID,$value );
	return $result;
}

/**
* ENO_SendFANOR
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $value
*/

function ENO_SendFANOR( $InstanceID,$value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SendFANOR( $InstanceID,$value );
	return $result;
}

/**
* ENO_SendFANOR_2
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Boolean $value
*/

function ENO_SendFANOR_2( $InstanceID,$value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SendFANOR_2( $InstanceID,$value );
	return $result;
}

/**
* ENO_SendLearn
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function ENO_SendLearn( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SendLearn( $InstanceID );
	return $result;
}

/**
* ENO_SendRO
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $value
*/

function ENO_SendRO( $InstanceID,$value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SendRO( $InstanceID,$value );
	return $result;
}

/**
* ENO_SendSPS
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Float $value
*/

function ENO_SendSPS( $InstanceID,$value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SendSPS( $InstanceID,$value );
	return $result;
}

/**
* ENO_SetActiveMessage
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Message
*/

function ENO_SetActiveMessage( $InstanceID,$Message ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SetActiveMessage( $InstanceID,$Message );
	return $result;
}

/**
* ENO_SetButtonLock
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Boolean $Active
*/

function ENO_SetButtonLock( $InstanceID,$Active ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SetButtonLock( $InstanceID,$Active );
	return $result;
}

/**
* ENO_SetFanStage
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $FanStage
*/

function ENO_SetFanStage( $InstanceID,$FanStage ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SetFanStage( $InstanceID,$FanStage );
	return $result;
}

/**
* ENO_SetIntensity
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Boolean $DeviceOn
* @param Integer $Intensity
*/

function ENO_SetIntensity( $InstanceID,$DeviceOn,$Intensity ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SetIntensity( $InstanceID,$DeviceOn,$Intensity );
	return $result;
}

/**
* ENO_SetLockFanStage
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Boolean $Locked
*/

function ENO_SetLockFanStage( $InstanceID,$Locked ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SetLockFanStage( $InstanceID,$Locked );
	return $result;
}

/**
* ENO_SetLockRoomOccupancy
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Boolean $Locked
*/

function ENO_SetLockRoomOccupancy( $InstanceID,$Locked ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SetLockRoomOccupancy( $InstanceID,$Locked );
	return $result;
}

/**
* ENO_SetMeasureTemperature
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Boolean $Active
*/

function ENO_SetMeasureTemperature( $InstanceID,$Active ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SetMeasureTemperature( $InstanceID,$Active );
	return $result;
}

/**
* ENO_SetMode
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Mode
*/

function ENO_SetMode( $InstanceID,$Mode ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SetMode( $InstanceID,$Mode );
	return $result;
}

/**
* ENO_SetPosition
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Position
*/

function ENO_SetPosition( $InstanceID,$Position ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SetPosition( $InstanceID,$Position );
	return $result;
}

/**
* ENO_SetRoomOccupancy
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Boolean $Occupied
*/

function ENO_SetRoomOccupancy( $InstanceID,$Occupied ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SetRoomOccupancy( $InstanceID,$Occupied );
	return $result;
}

/**
* ENO_SetTemperature
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Float $Temperature
*/

function ENO_SetTemperature( $InstanceID,$Temperature ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SetTemperature( $InstanceID,$Temperature );
	return $result;
}

/**
* ENO_SetTemperature1
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Float $Temperature
*/

function ENO_SetTemperature1( $InstanceID,$Temperature ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SetTemperature1( $InstanceID,$Temperature );
	return $result;
}

/**
* ENO_ShutterMoveDown
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function ENO_ShutterMoveDown( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_ShutterMoveDown( $InstanceID );
	return $result;
}

/**
* ENO_ShutterMoveUp
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function ENO_ShutterMoveUp( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_ShutterMoveUp( $InstanceID );
	return $result;
}

/**
* ENO_ShutterStop
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function ENO_ShutterStop( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_ShutterStop( $InstanceID );
	return $result;
}

/**
* ENO_SwitchMode
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Boolean $DeviceOn
*/

function ENO_SwitchMode( $InstanceID,$DeviceOn ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SwitchMode( $InstanceID,$DeviceOn );
	return $result;
}

/**
* ENO_SwitchModeEx
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Boolean $DeviceOn
* @param integer $SendMode
*   enum[0=smNMessage, 1=smUMessage, 2=smBoth]
*/

function ENO_SwitchModeEx( $InstanceID,$DeviceOn,$SendMode ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SwitchModeEx( $InstanceID,$DeviceOn,$SendMode );
	return $result;
}

/**
* FHT_RequestData
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function FHT_RequestData( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->FHT_RequestData( $InstanceID );
	return $result;
}

/**
* FHT_SetDay
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Value
*/

function FHT_SetDay( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->FHT_SetDay( $InstanceID,$Value );
	return $result;
}

/**
* FHT_SetHour
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Value
*/

function FHT_SetHour( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->FHT_SetHour( $InstanceID,$Value );
	return $result;
}

/**
* FHT_SetMinute
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Value
*/

function FHT_SetMinute( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->FHT_SetMinute( $InstanceID,$Value );
	return $result;
}

/**
* FHT_SetMode
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Mode
*/

function FHT_SetMode( $InstanceID,$Mode ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->FHT_SetMode( $InstanceID,$Mode );
	return $result;
}

/**
* FHT_SetMonth
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Value
*/

function FHT_SetMonth( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->FHT_SetMonth( $InstanceID,$Value );
	return $result;
}

/**
* FHT_SetTemperature
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Float $Temperature
*/

function FHT_SetTemperature( $InstanceID,$Temperature ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->FHT_SetTemperature( $InstanceID,$Temperature );
	return $result;
}

/**
* FHT_SetYear
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Value
*/

function FHT_SetYear( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->FHT_SetYear( $InstanceID,$Value );
	return $result;
}

/**
* FHZ_GetFHTQueue
* 
* @returns Variant
* @param Integer $InstanceID
*/

function FHZ_GetFHTQueue( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->FHZ_GetFHTQueue( $InstanceID );
	return $result;
}

/**
* FHZ_GetFreeBuffer
* 
* @returns Integer
* @param Integer $InstanceID
*/

function FHZ_GetFreeBuffer( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->FHZ_GetFreeBuffer( $InstanceID );
	return $result;
}

/**
* FS20_DimDown
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function FS20_DimDown( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->FS20_DimDown( $InstanceID );
	return $result;
}

/**
* FS20_DimUp
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function FS20_DimUp( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->FS20_DimUp( $InstanceID );
	return $result;
}

/**
* FS20_SetIntensity
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Intensity
* @param Integer $Duration
*/

function FS20_SetIntensity( $InstanceID,$Intensity,$Duration ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->FS20_SetIntensity( $InstanceID,$Intensity,$Duration );
	return $result;
}

/**
* FS20_SwitchDuration
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Boolean $DeviceOn
* @param Integer $Duration
*/

function FS20_SwitchDuration( $InstanceID,$DeviceOn,$Duration ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->FS20_SwitchDuration( $InstanceID,$DeviceOn,$Duration );
	return $result;
}

/**
* FS20_SwitchMode
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Boolean $DeviceOn
*/

function FS20_SwitchMode( $InstanceID,$DeviceOn ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->FS20_SwitchMode( $InstanceID,$DeviceOn );
	return $result;
}

/**
* GetValue
* 
* @returns Array
* @param Integer $VariableID
*/

function GetValue( $VariableID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->GetValue( $VariableID );
	return $result;
}

/**
* GetValueBoolean
* 
* @returns Boolean
* @param Integer $VariableID
*/

function GetValueBoolean( $VariableID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->GetValueBoolean( $VariableID );
	return $result;
}

/**
* GetValueFloat
* 
* @returns Float
* @param Integer $VariableID
*/

function GetValueFloat( $VariableID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->GetValueFloat( $VariableID );
	return $result;
}

/**
* GetValueFormatted
* 
* @returns String
* @param Integer $VariableID
*/

function GetValueFormatted( $VariableID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->GetValueFormatted( $VariableID );
	return $result;
}

/**
* GetValueInteger
* 
* @returns Integer
* @param Integer $VariableID
*/

function GetValueInteger( $VariableID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->GetValueInteger( $VariableID );
	return $result;
}

/**
* GetValueString
* 
* @returns String
* @param Integer $VariableID
*/

function GetValueString( $VariableID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->GetValueString( $VariableID );
	return $result;
}

/**
* HC_TargetValue
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Float $Value
*/

function HC_TargetValue( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HC_TargetValue( $InstanceID,$Value );
	return $result;
}

/**
* HID_SendEvent
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $ReportID
* @param String $Text
*/

function HID_SendEvent( $InstanceID,$ReportID,$Text ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HID_SendEvent( $InstanceID,$ReportID,$Text );
	return $result;
}

/**
* HMS_ReleaseFI
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Delay
*/

function HMS_ReleaseFI( $InstanceID,$Delay ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HMS_ReleaseFI( $InstanceID,$Delay );
	return $result;
}

/**
* HM_GetKnownDevices
* 
* @returns Variant
* @param Integer $InstanceID
*/

function HM_GetKnownDevices( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HM_GetKnownDevices( $InstanceID );
	return $result;
}

/**
* HM_LoadDevices
* 
* @returns Boolean
* @param Integer $InstanceID
* @param integer $Protocol
*   enum[0=hmpRadio, 1=hmpWired]
*/

function HM_LoadDevices( $InstanceID,$Protocol ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HM_LoadDevices( $InstanceID,$Protocol );
	return $result;
}

/**
* HM_ReadServiceMessages
* 
* @returns Variant
* @param Integer $InstanceID
*/

function HM_ReadServiceMessages( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HM_ReadServiceMessages( $InstanceID );
	return $result;
}

/**
* HM_RequestStatus
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Parameter
*/

function HM_RequestStatus( $InstanceID,$Parameter ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HM_RequestStatus( $InstanceID,$Parameter );
	return $result;
}

/**
* HM_WriteValueBoolean
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Parameter
* @param Boolean $Value
*/

function HM_WriteValueBoolean( $InstanceID,$Parameter,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HM_WriteValueBoolean( $InstanceID,$Parameter,$Value );
	return $result;
}

/**
* HM_WriteValueFloat
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Parameter
* @param Float $Value
*/

function HM_WriteValueFloat( $InstanceID,$Parameter,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HM_WriteValueFloat( $InstanceID,$Parameter,$Value );
	return $result;
}

/**
* HM_WriteValueInteger
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Parameter
* @param Integer $Value
*/

function HM_WriteValueInteger( $InstanceID,$Parameter,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HM_WriteValueInteger( $InstanceID,$Parameter,$Value );
	return $result;
}

/**
* HM_WriteValueString
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Parameter
* @param String $Value
*/

function HM_WriteValueString( $InstanceID,$Parameter,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HM_WriteValueString( $InstanceID,$Parameter,$Value );
	return $result;
}

/**
* IG_UpdateImage
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function IG_UpdateImage( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IG_UpdateImage( $InstanceID );
	return $result;
}

/**
* IMAP_GetCachedMails
* 
* @returns Variant
* @param Integer $InstanceID
*/

function IMAP_GetCachedMails( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IMAP_GetCachedMails( $InstanceID );
	return $result;
}

/**
* IMAP_GetMailEx
* 
* @returns Variant
* @param Integer $InstanceID
* @param String $UID
*/

function IMAP_GetMailEx( $InstanceID,$UID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IMAP_GetMailEx( $InstanceID,$UID );
	return $result;
}

/**
* IMAP_UpdateCache
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function IMAP_UpdateCache( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IMAP_UpdateCache( $InstanceID );
	return $result;
}

/**
* IPS_ApplyChanges
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function IPS_ApplyChanges( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_ApplyChanges( $InstanceID );
	return $result;
}

/**
* IPS_CategoryExists
* 
* @returns Boolean
* @param Integer $CategoryID
*/

function IPS_CategoryExists( $CategoryID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_CategoryExists( $CategoryID );
	return $result;
}

/**
* IPS_ConnectInstance
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $ParentID
*/

function IPS_ConnectInstance( $InstanceID,$ParentID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_ConnectInstance( $InstanceID,$ParentID );
	return $result;
}

/**
* IPS_CreateCategory
* 
* @returns Integer
*/

function IPS_CreateCategory(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_CreateCategory(  );
	return $result;
}

/**
* IPS_CreateEvent
* 
* @returns Integer
* @param integer $EventType
*   enum[0=etTrigger, 1=etCyclic, 2=etSchedule]
*/

function IPS_CreateEvent( $EventType ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_CreateEvent( $EventType );
	return $result;
}

/**
* IPS_CreateInstance
* 
* @returns Integer
* @param String $ModuleID
*/

function IPS_CreateInstance( $ModuleID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_CreateInstance( $ModuleID );
	return $result;
}

/**
* IPS_CreateLink
* 
* @returns Integer
*/

function IPS_CreateLink(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_CreateLink(  );
	return $result;
}

/**
* IPS_CreateMedia
* 
* @returns Integer
* @param integer $MediaType
*   enum[0=mtForm, 1=mtImage, 2=mtSound, 3=mtStream, 4=mtChart]
*/

function IPS_CreateMedia( $MediaType ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_CreateMedia( $MediaType );
	return $result;
}

/**
* IPS_CreateScript
* 
* @returns Integer
* @param integer $ScriptType
*   enum[0=stPHPScript, 1=stMacroScript, 2=stBrickScript]
*/

function IPS_CreateScript( $ScriptType ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_CreateScript( $ScriptType );
	return $result;
}

/**
* IPS_CreateVariable
* 
* @returns Integer
* @param integer $VariableType
*   enum[0=vtBoolean, 1=vtInteger, 2=vtFloat, 3=vtString]
*/

function IPS_CreateVariable( $VariableType ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_CreateVariable( $VariableType );
	return $result;
}

/**
* IPS_CreateVariableProfile
* 
* @returns Boolean
* @param String $ProfileName
* @param integer $ProfileType
*   enum[0=vtBoolean, 1=vtInteger, 2=vtFloat, 3=vtString]
*/

function IPS_CreateVariableProfile( $ProfileName,$ProfileType ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_CreateVariableProfile( $ProfileName,$ProfileType );
	return $result;
}

/**
* IPS_DeleteCategory
* 
* @returns Boolean
* @param Integer $CategoryID
*/

function IPS_DeleteCategory( $CategoryID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_DeleteCategory( $CategoryID );
	return $result;
}

/**
* IPS_DeleteEvent
* 
* @returns Boolean
* @param Integer $EventID
*/

function IPS_DeleteEvent( $EventID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_DeleteEvent( $EventID );
	return $result;
}

/**
* IPS_DeleteInstance
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function IPS_DeleteInstance( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_DeleteInstance( $InstanceID );
	return $result;
}

/**
* IPS_DeleteLink
* 
* @returns Boolean
* @param Integer $LinkID
*/

function IPS_DeleteLink( $LinkID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_DeleteLink( $LinkID );
	return $result;
}

/**
* IPS_DeleteMedia
* 
* @returns Boolean
* @param Integer $MediaID
* @param Boolean $DeleteFile
*/

function IPS_DeleteMedia( $MediaID,$DeleteFile ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_DeleteMedia( $MediaID,$DeleteFile );
	return $result;
}

/**
* IPS_DeleteScript
* 
* @returns Boolean
* @param Integer $ScriptID
* @param Boolean $DeleteFile
*/

function IPS_DeleteScript( $ScriptID,$DeleteFile ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_DeleteScript( $ScriptID,$DeleteFile );
	return $result;
}

/**
* IPS_DeleteVariable
* 
* @returns Boolean
* @param Integer $VariableID
*/

function IPS_DeleteVariable( $VariableID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_DeleteVariable( $VariableID );
	return $result;
}

/**
* IPS_DeleteVariableProfile
* 
* @returns Boolean
* @param String $ProfileName
*/

function IPS_DeleteVariableProfile( $ProfileName ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_DeleteVariableProfile( $ProfileName );
	return $result;
}

/**
* IPS_DisableAction
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $VariableIdent
*/

function IPS_DisableAction( $InstanceID,$VariableIdent ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_DisableAction( $InstanceID,$VariableIdent );
	return $result;
}

/**
* IPS_DisableDebug
* 
* @returns Boolean
* @param Integer $ID
*/

function IPS_DisableDebug( $ID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_DisableDebug( $ID );
	return $result;
}

/**
* IPS_DisconnectInstance
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function IPS_DisconnectInstance( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_DisconnectInstance( $InstanceID );
	return $result;
}

/**
* IPS_EnableAction
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $VariableIdent
*/

function IPS_EnableAction( $InstanceID,$VariableIdent ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_EnableAction( $InstanceID,$VariableIdent );
	return $result;
}

/**
* IPS_EnableDebug
* 
* @returns Boolean
* @param Integer $ID
* @param Integer $Duration
*/

function IPS_EnableDebug( $ID,$Duration ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_EnableDebug( $ID,$Duration );
	return $result;
}

/**
* IPS_EventExists
* 
* @returns Boolean
* @param Integer $EventID
*/

function IPS_EventExists( $EventID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_EventExists( $EventID );
	return $result;
}

/**
* IPS_Execute
* 
* @returns String
* @param String $Filename
* @param String $Parameter
* @param Boolean $ShowWindow
* @param Boolean $WaitResult
*/

function IPS_Execute( $Filename,$Parameter,$ShowWindow,$WaitResult ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_Execute( $Filename,$Parameter,$ShowWindow,$WaitResult );
	return $result;
}

/**
* IPS_ExecuteEx
* 
* @returns String
* @param String $Filename
* @param String $Parameter
* @param Boolean $ShowWindow
* @param Boolean $WaitResult
* @param Integer $SessionID
*/

function IPS_ExecuteEx( $Filename,$Parameter,$ShowWindow,$WaitResult,$SessionID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_ExecuteEx( $Filename,$Parameter,$ShowWindow,$WaitResult,$SessionID );
	return $result;
}

/**
* IPS_FunctionExists
* 
* @returns Boolean
* @param String $FunctionName
*/

function IPS_FunctionExists( $FunctionName ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_FunctionExists( $FunctionName );
	return $result;
}

/**
* IPS_GetCategory
* 
* @returns Variant
* @param Integer $CategoryID
*/

function IPS_GetCategory( $CategoryID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetCategory( $CategoryID );
	return $result;
}

/**
* IPS_GetCategoryIDByName
* 
* @returns Integer
* @param String $Name
* @param Integer $ParentID
*/

function IPS_GetCategoryIDByName( $Name,$ParentID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetCategoryIDByName( $Name,$ParentID );
	return $result;
}

/**
* IPS_GetCategoryList
* 
* @returns Variant
*/

function IPS_GetCategoryList(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetCategoryList(  );
	return $result;
}

/**
* IPS_GetChildrenIDs
* 
* @returns Variant
* @param Integer $ID
*/

function IPS_GetChildrenIDs( $ID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetChildrenIDs( $ID );
	return $result;
}

/**
* IPS_GetCompatibleInstances
* 
* @returns Variant
* @param Integer $InstanceID
*/

function IPS_GetCompatibleInstances( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetCompatibleInstances( $InstanceID );
	return $result;
}

/**
* IPS_GetCompatibleModules
* 
* @returns Variant
* @param String $ModuleID
*/

function IPS_GetCompatibleModules( $ModuleID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetCompatibleModules( $ModuleID );
	return $result;
}

/**
* IPS_GetConfiguration
* 
* @returns String
* @param Integer $InstanceID
*/

function IPS_GetConfiguration( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetConfiguration( $InstanceID );
	return $result;
}

/**
* IPS_GetConfigurationForParent
* 
* @returns String
* @param Integer $InstanceID
*/

function IPS_GetConfigurationForParent( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetConfigurationForParent( $InstanceID );
	return $result;
}

/**
* IPS_GetConfigurationForm
* 
* @returns String
* @param Integer $InstanceID
*/

function IPS_GetConfigurationForm( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetConfigurationForm( $InstanceID );
	return $result;
}

/**
* IPS_GetDemoExpiration
* 
* @returns Integer
*/

function IPS_GetDemoExpiration(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetDemoExpiration(  );
	return $result;
}

/**
* IPS_GetEvent
* 
* @returns Variant
* @param Integer $EventID
*/

function IPS_GetEvent( $EventID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetEvent( $EventID );
	return $result;
}

/**
* IPS_GetEventIDByName
* 
* @returns Integer
* @param String $Name
* @param Integer $ParentID
*/

function IPS_GetEventIDByName( $Name,$ParentID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetEventIDByName( $Name,$ParentID );
	return $result;
}

/**
* IPS_GetEventList
* 
* @returns Variant
*/

function IPS_GetEventList(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetEventList(  );
	return $result;
}

/**
* IPS_GetEventListByType
* 
* @returns Variant
* @param integer $EventType
*   enum[0=etTrigger, 1=etCyclic, 2=etSchedule]
*/

function IPS_GetEventListByType( $EventType ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetEventListByType( $EventType );
	return $result;
}

/**
* IPS_GetFunction
* 
* @returns Variant
* @param String $FunctionName
*/

function IPS_GetFunction( $FunctionName ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetFunction( $FunctionName );
	return $result;
}

/**
* IPS_GetFunctionList
* 
* @returns Variant
* @param Integer $InstanceID
*/

function IPS_GetFunctionList( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetFunctionList( $InstanceID );
	return $result;
}

/**
* IPS_GetFunctionListByModuleID
* 
* @returns Variant
* @param String $ModuleID
*/

function IPS_GetFunctionListByModuleID( $ModuleID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetFunctionListByModuleID( $ModuleID );
	return $result;
}

/**
* IPS_GetFunctions
* 
* @returns Variant
* @param Variant $Parameter
*/

function IPS_GetFunctions( $Parameter ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetFunctions( $Parameter );
	return $result;
}

/**
* IPS_GetFunctionsMap
* 
* @returns Variant
* @param Variant $Parameter
*/

function IPS_GetFunctionsMap( $Parameter ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetFunctionsMap( $Parameter );
	return $result;
}

/**
* IPS_GetInstance
* 
* @returns Variant
* @param Integer $InstanceID
*/

function IPS_GetInstance( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetInstance( $InstanceID );
	return $result;
}

/**
* IPS_GetInstanceIDByName
* 
* @returns Integer
* @param String $Name
* @param Integer $ParentID
*/

function IPS_GetInstanceIDByName( $Name,$ParentID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetInstanceIDByName( $Name,$ParentID );
	return $result;
}

/**
* IPS_GetInstanceList
* 
* @returns Variant
*/

function IPS_GetInstanceList(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetInstanceList(  );
	return $result;
}

/**
* IPS_GetInstanceListByModuleID
* 
* @returns Variant
* @param String $ModuleID
*/

function IPS_GetInstanceListByModuleID( $ModuleID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetInstanceListByModuleID( $ModuleID );
	return $result;
}

/**
* IPS_GetInstanceListByModuleType
* 
* @returns Variant
* @param integer $ModuleType
*   enum[0=mtCore, 1=mtIO, 2=mtSplitter, 3=mtDevice, 4=mtConfigurator]
*/

function IPS_GetInstanceListByModuleType( $ModuleType ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetInstanceListByModuleType( $ModuleType );
	return $result;
}

/**
* IPS_GetKernelDir
* 
* @returns String
*/

function IPS_GetKernelDir(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetKernelDir(  );
	return $result;
}

/**
* IPS_GetKernelDirEx
* 
* @returns String
*/

function IPS_GetKernelDirEx(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetKernelDirEx(  );
	return $result;
}

/**
* IPS_GetKernelRunlevel
* 
* @returns Integer
*/

function IPS_GetKernelRunlevel(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetKernelRunlevel(  );
	return $result;
}

/**
* IPS_GetKernelStartTime
* 
* @returns Integer
*/

function IPS_GetKernelStartTime(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetKernelStartTime(  );
	return $result;
}

/**
* IPS_GetKernelVersion
* 
* @returns String
*/

function IPS_GetKernelVersion(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetKernelVersion(  );
	return $result;
}

/**
* IPS_GetLibraries
* 
* @returns Variant
* @param Variant $Parameter
*/

function IPS_GetLibraries( $Parameter ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetLibraries( $Parameter );
	return $result;
}

/**
* IPS_GetLibrary
* 
* @returns Variant
* @param String $LibraryID
*/

function IPS_GetLibrary( $LibraryID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetLibrary( $LibraryID );
	return $result;
}

/**
* IPS_GetLibraryList
* 
* @returns Variant
*/

function IPS_GetLibraryList(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetLibraryList(  );
	return $result;
}

/**
* IPS_GetLibraryModules
* 
* @returns Variant
* @param String $LibraryID
*/

function IPS_GetLibraryModules( $LibraryID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetLibraryModules( $LibraryID );
	return $result;
}

/**
* IPS_GetLicensee
* 
* @returns String
*/

function IPS_GetLicensee(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetLicensee(  );
	return $result;
}

/**
* IPS_GetLimitDemo
* 
* @returns Integer
*/

function IPS_GetLimitDemo(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetLimitDemo(  );
	return $result;
}

/**
* IPS_GetLimitServer
* 
* @returns String
*/

function IPS_GetLimitServer(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetLimitServer(  );
	return $result;
}

/**
* IPS_GetLimitVariables
* 
* @returns Integer
*/

function IPS_GetLimitVariables(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetLimitVariables(  );
	return $result;
}

/**
* IPS_GetLimitWebFront
* 
* @returns Integer
*/

function IPS_GetLimitWebFront(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetLimitWebFront(  );
	return $result;
}

/**
* IPS_GetLink
* 
* @returns Variant
* @param Integer $LinkID
*/

function IPS_GetLink( $LinkID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetLink( $LinkID );
	return $result;
}

/**
* IPS_GetLinkIDByName
* 
* @returns Integer
* @param String $Name
* @param Integer $ParentID
*/

function IPS_GetLinkIDByName( $Name,$ParentID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetLinkIDByName( $Name,$ParentID );
	return $result;
}

/**
* IPS_GetLinkList
* 
* @returns Variant
*/

function IPS_GetLinkList(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetLinkList(  );
	return $result;
}

/**
* IPS_GetLiveConsoleCRC
* 
* @returns String
*/

function IPS_GetLiveConsoleCRC(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetLiveConsoleCRC(  );
	return $result;
}

/**
* IPS_GetLiveConsoleFile
* 
* @returns String
*/

function IPS_GetLiveConsoleFile(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetLiveConsoleFile(  );
	return $result;
}

/**
* IPS_GetLiveUpdateVersion
* 
* @returns String
*/

function IPS_GetLiveUpdateVersion(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetLiveUpdateVersion(  );
	return $result;
}

/**
* IPS_GetLocation
* 
* @returns String
* @param Integer $ID
*/

function IPS_GetLocation( $ID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetLocation( $ID );
	return $result;
}

/**
* IPS_GetLogDir
* 
* @returns String
*/

function IPS_GetLogDir(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetLogDir(  );
	return $result;
}

/**
* IPS_GetMedia
* 
* @returns Variant
* @param Integer $MediaID
*/

function IPS_GetMedia( $MediaID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetMedia( $MediaID );
	return $result;
}

/**
* IPS_GetMediaContent
* 
* @returns String
* @param Integer $MediaID
*/

function IPS_GetMediaContent( $MediaID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetMediaContent( $MediaID );
	return $result;
}

/**
* IPS_GetMediaIDByFile
* 
* @returns Integer
* @param String $FilePath
*/

function IPS_GetMediaIDByFile( $FilePath ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetMediaIDByFile( $FilePath );
	return $result;
}

/**
* IPS_GetMediaIDByName
* 
* @returns Integer
* @param String $Name
* @param Integer $ParentID
*/

function IPS_GetMediaIDByName( $Name,$ParentID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetMediaIDByName( $Name,$ParentID );
	return $result;
}

/**
* IPS_GetMediaList
* 
* @returns Variant
*/

function IPS_GetMediaList(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetMediaList(  );
	return $result;
}

/**
* IPS_GetMediaListByType
* 
* @returns Variant
* @param integer $MediaType
*   enum[0=mtForm, 1=mtImage, 2=mtSound, 3=mtStream, 4=mtChart]
*/

function IPS_GetMediaListByType( $MediaType ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetMediaListByType( $MediaType );
	return $result;
}

/**
* IPS_GetModule
* 
* @returns Variant
* @param String $ModuleID
*/

function IPS_GetModule( $ModuleID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetModule( $ModuleID );
	return $result;
}

/**
* IPS_GetModuleList
* 
* @returns Variant
*/

function IPS_GetModuleList(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetModuleList(  );
	return $result;
}

/**
* IPS_GetModuleListByType
* 
* @returns Variant
* @param integer $ModuleType
*   enum[0=mtCore, 1=mtIO, 2=mtSplitter, 3=mtDevice, 4=mtConfigurator]
*/

function IPS_GetModuleListByType( $ModuleType ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetModuleListByType( $ModuleType );
	return $result;
}

/**
* IPS_GetModules
* 
* @returns Variant
* @param Variant $Parameter
*/

function IPS_GetModules( $Parameter ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetModules( $Parameter );
	return $result;
}

/**
* IPS_GetName
* 
* @returns String
* @param Integer $ID
*/

function IPS_GetName( $ID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetName( $ID );
	return $result;
}

/**
* IPS_GetObject
* 
* @returns Variant
* @param Integer $ID
*/

function IPS_GetObject( $ID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetObject( $ID );
	return $result;
}

/**
* IPS_GetObjectIDByIdent
* 
* @returns Integer
* @param String $Ident
* @param Integer $ParentID
*/

function IPS_GetObjectIDByIdent( $Ident,$ParentID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetObjectIDByIdent( $Ident,$ParentID );
	return $result;
}

/**
* IPS_GetObjectIDByName
* 
* @returns Integer
* @param String $Name
* @param Integer $ParentID
*/

function IPS_GetObjectIDByName( $Name,$ParentID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetObjectIDByName( $Name,$ParentID );
	return $result;
}

/**
* IPS_GetObjectList
* 
* @returns Variant
*/

function IPS_GetObjectList(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetObjectList(  );
	return $result;
}

/**
* IPS_GetOption
* 
* @returns Integer
* @param String $Option
*/

function IPS_GetOption( $Option ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetOption( $Option );
	return $result;
}

/**
* IPS_GetParent
* 
* @returns Integer
* @param Integer $ID
*/

function IPS_GetParent( $ID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetParent( $ID );
	return $result;
}

/**
* IPS_GetProperty
* 
* @returns Array
* @param Integer $InstanceID
* @param String $Name
*/

function IPS_GetProperty( $InstanceID,$Name ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetProperty( $InstanceID,$Name );
	return $result;
}

/**
* IPS_GetScript
* 
* @returns Variant
* @param Integer $ScriptID
*/

function IPS_GetScript( $ScriptID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetScript( $ScriptID );
	return $result;
}

/**
* IPS_GetScriptContent
* 
* @returns String
* @param Integer $ScriptID
*/

function IPS_GetScriptContent( $ScriptID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetScriptContent( $ScriptID );
	return $result;
}

/**
* IPS_GetScriptEventList
* 
* @returns Variant
* @param Integer $ScriptID
*/

function IPS_GetScriptEventList( $ScriptID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetScriptEventList( $ScriptID );
	return $result;
}

/**
* IPS_GetScriptFile
* 
* @returns String
* @param Integer $ScriptID
*/

function IPS_GetScriptFile( $ScriptID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetScriptFile( $ScriptID );
	return $result;
}

/**
* IPS_GetScriptIDByFile
* 
* @returns Integer
* @param String $FilePath
*/

function IPS_GetScriptIDByFile( $FilePath ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetScriptIDByFile( $FilePath );
	return $result;
}

/**
* IPS_GetScriptIDByName
* 
* @returns Integer
* @param String $Name
* @param Integer $ParentID
*/

function IPS_GetScriptIDByName( $Name,$ParentID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetScriptIDByName( $Name,$ParentID );
	return $result;
}

/**
* IPS_GetScriptList
* 
* @returns Variant
*/

function IPS_GetScriptList(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetScriptList(  );
	return $result;
}

/**
* IPS_GetScriptThread
* 
* @returns Variant
* @param Integer $ThreadID
*/

function IPS_GetScriptThread( $ThreadID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetScriptThread( $ThreadID );
	return $result;
}

/**
* IPS_GetScriptThreadList
* 
* @returns Variant
*/

function IPS_GetScriptThreadList(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetScriptThreadList(  );
	return $result;
}

/**
* IPS_GetScriptThreads
* 
* @returns Variant
* @param Variant $Parameter
*/

function IPS_GetScriptThreads( $Parameter ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetScriptThreads( $Parameter );
	return $result;
}

/**
* IPS_GetScriptTimer
* 
* @returns Integer
* @param Integer $ScriptID
*/

function IPS_GetScriptTimer( $ScriptID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetScriptTimer( $ScriptID );
	return $result;
}

/**
* IPS_GetSnapshot
* 
* @returns Variant
*/

function IPS_GetSnapshot(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetSnapshot(  );
	return $result;
}

/**
* IPS_GetSnapshotChanges
* 
* @returns Variant
* @param Integer $LastTimestamp
*/

function IPS_GetSnapshotChanges( $LastTimestamp ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetSnapshotChanges( $LastTimestamp );
	return $result;
}

/**
* IPS_GetTimer
* 
* @returns Variant
* @param Integer $TimerID
*/

function IPS_GetTimer( $TimerID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetTimer( $TimerID );
	return $result;
}

/**
* IPS_GetTimerList
* 
* @returns Variant
*/

function IPS_GetTimerList(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetTimerList(  );
	return $result;
}

/**
* IPS_GetTimers
* 
* @returns Variant
* @param Variant $Parameter
*/

function IPS_GetTimers( $Parameter ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetTimers( $Parameter );
	return $result;
}

/**
* IPS_GetVariable
* 
* @returns Variant
* @param Integer $VariableID
*/

function IPS_GetVariable( $VariableID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetVariable( $VariableID );
	return $result;
}

/**
* IPS_GetVariableEventList
* 
* @returns Variant
* @param Integer $VariableID
*/

function IPS_GetVariableEventList( $VariableID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetVariableEventList( $VariableID );
	return $result;
}

/**
* IPS_GetVariableIDByName
* 
* @returns Integer
* @param String $Name
* @param Integer $ParentID
*/

function IPS_GetVariableIDByName( $Name,$ParentID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetVariableIDByName( $Name,$ParentID );
	return $result;
}

/**
* IPS_GetVariableList
* 
* @returns Variant
*/

function IPS_GetVariableList(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetVariableList(  );
	return $result;
}

/**
* IPS_GetVariableProfile
* 
* @returns Variant
* @param String $ProfileName
*/

function IPS_GetVariableProfile( $ProfileName ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetVariableProfile( $ProfileName );
	return $result;
}

/**
* IPS_GetVariableProfileList
* 
* @returns Variant
*/

function IPS_GetVariableProfileList(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetVariableProfileList(  );
	return $result;
}

/**
* IPS_GetVariableProfileListByType
* 
* @returns Variant
* @param integer $ProfileType
*   enum[0=vtBoolean, 1=vtInteger, 2=vtFloat, 3=vtString]
*/

function IPS_GetVariableProfileListByType( $ProfileType ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetVariableProfileListByType( $ProfileType );
	return $result;
}

/**
* IPS_HasChanges
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function IPS_HasChanges( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_HasChanges( $InstanceID );
	return $result;
}

/**
* IPS_HasChildren
* 
* @returns Boolean
* @param Integer $ID
*/

function IPS_HasChildren( $ID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_HasChildren( $ID );
	return $result;
}

/**
* IPS_InstanceExists
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function IPS_InstanceExists( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_InstanceExists( $InstanceID );
	return $result;
}

/**
* IPS_IsChild
* 
* @returns Boolean
* @param Integer $ID
* @param Integer $ParentID
* @param Boolean $Recursive
*/

function IPS_IsChild( $ID,$ParentID,$Recursive ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_IsChild( $ID,$ParentID,$Recursive );
	return $result;
}

/**
* IPS_IsInstanceCompatible
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $ParentInstanceID
*/

function IPS_IsInstanceCompatible( $InstanceID,$ParentInstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_IsInstanceCompatible( $InstanceID,$ParentInstanceID );
	return $result;
}

/**
* IPS_IsModuleCompatible
* 
* @returns Boolean
* @param String $ModuleID
* @param String $ParentModuleID
*/

function IPS_IsModuleCompatible( $ModuleID,$ParentModuleID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_IsModuleCompatible( $ModuleID,$ParentModuleID );
	return $result;
}

/**
* IPS_IsSearching
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function IPS_IsSearching( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_IsSearching( $InstanceID );
	return $result;
}

/**
* IPS_LibraryExists
* 
* @returns Boolean
* @param String $LibraryID
*/

function IPS_LibraryExists( $LibraryID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_LibraryExists( $LibraryID );
	return $result;
}

/**
* IPS_LinkExists
* 
* @returns Boolean
* @param Integer $LinkID
*/

function IPS_LinkExists( $LinkID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_LinkExists( $LinkID );
	return $result;
}

/**
* IPS_LogMessage
* 
* @returns Boolean
* @param String $Sender
* @param String $Message
*/

function IPS_LogMessage( $Sender,$Message ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_LogMessage( $Sender,$Message );
	return $result;
}

/**
* IPS_MediaExists
* 
* @returns Boolean
* @param Integer $MediaID
*/

function IPS_MediaExists( $MediaID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_MediaExists( $MediaID );
	return $result;
}

/**
* IPS_ModuleExists
* 
* @returns Boolean
* @param String $ModuleID
*/

function IPS_ModuleExists( $ModuleID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_ModuleExists( $ModuleID );
	return $result;
}

/**
* IPS_ObjectExists
* 
* @returns Boolean
* @param Integer $ID
*/

function IPS_ObjectExists( $ID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_ObjectExists( $ID );
	return $result;
}

/**
* IPS_RegisterPropertyBoolean
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Name
* @param Boolean $DefaultValue
*/

function IPS_RegisterPropertyBoolean( $InstanceID,$Name,$DefaultValue ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_RegisterPropertyBoolean( $InstanceID,$Name,$DefaultValue );
	return $result;
}

/**
* IPS_RegisterPropertyFloat
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Name
* @param Float $DefaultValue
*/

function IPS_RegisterPropertyFloat( $InstanceID,$Name,$DefaultValue ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_RegisterPropertyFloat( $InstanceID,$Name,$DefaultValue );
	return $result;
}

/**
* IPS_RegisterPropertyInteger
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Name
* @param Integer $DefaultValue
*/

function IPS_RegisterPropertyInteger( $InstanceID,$Name,$DefaultValue ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_RegisterPropertyInteger( $InstanceID,$Name,$DefaultValue );
	return $result;
}

/**
* IPS_RegisterPropertyString
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Name
* @param String $DefaultValue
*/

function IPS_RegisterPropertyString( $InstanceID,$Name,$DefaultValue ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_RegisterPropertyString( $InstanceID,$Name,$DefaultValue );
	return $result;
}

/**
* IPS_RequestAction
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $VariableIdent
* @param Array $Value
*/

function IPS_RequestAction( $InstanceID,$VariableIdent,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_RequestAction( $InstanceID,$VariableIdent,$Value );
	return $result;
}

/**
* IPS_ResetChanges
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function IPS_ResetChanges( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_ResetChanges( $InstanceID );
	return $result;
}

/**
* IPS_RunScript
* 
* @returns Boolean
* @param Integer $ScriptID
*/

function IPS_RunScript( $ScriptID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_RunScript( $ScriptID );
	return $result;
}

/**
* IPS_RunScriptEx
* 
* @returns Boolean
* @param Integer $ScriptID
* @param Variant $Parameters
*/

function IPS_RunScriptEx( $ScriptID,$Parameters ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_RunScriptEx( $ScriptID,$Parameters );
	return $result;
}

/**
* IPS_RunScriptText
* 
* @returns Boolean
* @param String $ScriptText
*/

function IPS_RunScriptText( $ScriptText ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_RunScriptText( $ScriptText );
	return $result;
}

/**
* IPS_RunScriptTextEx
* 
* @returns Boolean
* @param String $ScriptText
* @param Variant $Parameters
*/

function IPS_RunScriptTextEx( $ScriptText,$Parameters ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_RunScriptTextEx( $ScriptText,$Parameters );
	return $result;
}

/**
* IPS_RunScriptTextWait
* 
* @returns String
* @param String $ScriptText
*/

function IPS_RunScriptTextWait( $ScriptText ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_RunScriptTextWait( $ScriptText );
	return $result;
}

/**
* IPS_RunScriptTextWaitEx
* 
* @returns String
* @param String $ScriptText
* @param Variant $Parameters
*/

function IPS_RunScriptTextWaitEx( $ScriptText,$Parameters ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_RunScriptTextWaitEx( $ScriptText,$Parameters );
	return $result;
}

/**
* IPS_RunScriptWait
* 
* @returns String
* @param Integer $ScriptID
*/

function IPS_RunScriptWait( $ScriptID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_RunScriptWait( $ScriptID );
	return $result;
}

/**
* IPS_RunScriptWaitEx
* 
* @returns String
* @param Integer $ScriptID
* @param Variant $Parameters
*/

function IPS_RunScriptWaitEx( $ScriptID,$Parameters ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_RunScriptWaitEx( $ScriptID,$Parameters );
	return $result;
}

/**
* IPS_ScriptExists
* 
* @returns Boolean
* @param Integer $ScriptID
*/

function IPS_ScriptExists( $ScriptID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_ScriptExists( $ScriptID );
	return $result;
}

/**
* IPS_ScriptThreadExists
* 
* @returns Boolean
* @param Integer $ThreadID
*/

function IPS_ScriptThreadExists( $ThreadID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_ScriptThreadExists( $ThreadID );
	return $result;
}

/**
* IPS_SemaphoreEnter
* 
* @returns Boolean
* @param String $Name
* @param Integer $Milliseconds
*/

function IPS_SemaphoreEnter( $Name,$Milliseconds ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SemaphoreEnter( $Name,$Milliseconds );
	return $result;
}

/**
* IPS_SemaphoreLeave
* 
* @returns Boolean
* @param String $Name
*/

function IPS_SemaphoreLeave( $Name ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SemaphoreLeave( $Name );
	return $result;
}

/**
* IPS_SendDataToChildren
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $JSONData
*/

function IPS_SendDataToChildren( $InstanceID,$JSONData ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SendDataToChildren( $InstanceID,$JSONData );
	return $result;
}

/**
* IPS_SendDataToParent
* 
* @returns String
* @param Integer $InstanceID
* @param String $JSONData
*/

function IPS_SendDataToParent( $InstanceID,$JSONData ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SendDataToParent( $InstanceID,$JSONData );
	return $result;
}

/**
* IPS_SendDebug
* 
* @returns Boolean
* @param Integer $SenderID
* @param String $Message
* @param String $Data
* @param integer $Format
*   enum[0=dfText, 1=dfBinary]
*/

function IPS_SendDebug( $SenderID,$Message,$Data,$Format ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SendDebug( $SenderID,$Message,$Data,$Format );
	return $result;
}

/**
* IPS_SendMediaEvent
* 
* @returns Boolean
* @param Integer $MediaID
*/

function IPS_SendMediaEvent( $MediaID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SendMediaEvent( $MediaID );
	return $result;
}

/**
* IPS_SetConfiguration
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Configuration
*/

function IPS_SetConfiguration( $InstanceID,$Configuration ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetConfiguration( $InstanceID,$Configuration );
	return $result;
}

/**
* IPS_SetDisabled
* 
* @returns Boolean
* @param Integer $ID
* @param Boolean $Disabled
*/

function IPS_SetDisabled( $ID,$Disabled ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetDisabled( $ID,$Disabled );
	return $result;
}

/**
* IPS_SetEventActive
* 
* @returns Boolean
* @param Integer $EventID
* @param Boolean $Active
*/

function IPS_SetEventActive( $EventID,$Active ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetEventActive( $EventID,$Active );
	return $result;
}

/**
* IPS_SetEventCyclic
* 
* @returns Boolean
* @param Integer $EventID
* @param integer $DateType
*   enum[0=cdtNone, 1=cdtOnce, 2=cdtDay, 3=cdtWeek, 4=cdtMonth, 5=cdtYear]
* @param Integer $DateValue
* @param Integer $DateDay
* @param Integer $DateDayValue
* @param integer $TimeType
*   enum[0=cttOnce, 1=cttSecond, 2=cttMinute, 3=cttHour]
* @param Integer $TimeValue
*/

function IPS_SetEventCyclic( $EventID,$DateType,$DateValue,$DateDay,$DateDayValue,$TimeType,$TimeValue ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetEventCyclic( $EventID,$DateType,$DateValue,$DateDay,$DateDayValue,$TimeType,$TimeValue );
	return $result;
}

/**
* IPS_SetEventCyclicDateFrom
* 
* @returns Boolean
* @param Integer $EventID
* @param Integer $Day
* @param Integer $Month
* @param Integer $Year
*/

function IPS_SetEventCyclicDateFrom( $EventID,$Day,$Month,$Year ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetEventCyclicDateFrom( $EventID,$Day,$Month,$Year );
	return $result;
}

/**
* IPS_SetEventCyclicDateTo
* 
* @returns Boolean
* @param Integer $EventID
* @param Integer $Day
* @param Integer $Month
* @param Integer $Year
*/

function IPS_SetEventCyclicDateTo( $EventID,$Day,$Month,$Year ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetEventCyclicDateTo( $EventID,$Day,$Month,$Year );
	return $result;
}

/**
* IPS_SetEventCyclicTimeFrom
* 
* @returns Boolean
* @param Integer $EventID
* @param Integer $Hour
* @param Integer $Minute
* @param Integer $Second
*/

function IPS_SetEventCyclicTimeFrom( $EventID,$Hour,$Minute,$Second ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetEventCyclicTimeFrom( $EventID,$Hour,$Minute,$Second );
	return $result;
}

/**
* IPS_SetEventCyclicTimeTo
* 
* @returns Boolean
* @param Integer $EventID
* @param Integer $Hour
* @param Integer $Minute
* @param Integer $Second
*/

function IPS_SetEventCyclicTimeTo( $EventID,$Hour,$Minute,$Second ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetEventCyclicTimeTo( $EventID,$Hour,$Minute,$Second );
	return $result;
}

/**
* IPS_SetEventLimit
* 
* @returns Boolean
* @param Integer $EventID
* @param Integer $Count
*/

function IPS_SetEventLimit( $EventID,$Count ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetEventLimit( $EventID,$Count );
	return $result;
}

/**
* IPS_SetEventScheduleAction
* 
* @returns Boolean
* @param Integer $EventID
* @param Integer $ActionID
* @param String $Name
* @param Integer $Color
* @param String $ScriptText
*/

function IPS_SetEventScheduleAction( $EventID,$ActionID,$Name,$Color,$ScriptText ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetEventScheduleAction( $EventID,$ActionID,$Name,$Color,$ScriptText );
	return $result;
}

/**
* IPS_SetEventScheduleGroup
* 
* @returns Boolean
* @param Integer $EventID
* @param Integer $GroupID
* @param Integer $Days
*/

function IPS_SetEventScheduleGroup( $EventID,$GroupID,$Days ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetEventScheduleGroup( $EventID,$GroupID,$Days );
	return $result;
}

/**
* IPS_SetEventScheduleGroupPoint
* 
* @returns Boolean
* @param Integer $EventID
* @param Integer $GroupID
* @param Integer $PointID
* @param Integer $StartHour
* @param Integer $StartMinute
* @param Integer $StartSecond
* @param Integer $ActionID
*/

function IPS_SetEventScheduleGroupPoint( $EventID,$GroupID,$PointID,$StartHour,$StartMinute,$StartSecond,$ActionID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetEventScheduleGroupPoint( $EventID,$GroupID,$PointID,$StartHour,$StartMinute,$StartSecond,$ActionID );
	return $result;
}

/**
* IPS_SetEventScript
* 
* @returns Boolean
* @param Integer $EventID
* @param String $EventScript
*/

function IPS_SetEventScript( $EventID,$EventScript ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetEventScript( $EventID,$EventScript );
	return $result;
}

/**
* IPS_SetEventTrigger
* 
* @returns Boolean
* @param Integer $EventID
* @param integer $TriggerType
*   enum[0=evtOnUpdate, 1=evtOnChange, 2=evtOnLimitExceed, 3=evtOnLimitDrop, 4=evtOnValue]
* @param Integer $TriggerVariableID
*/

function IPS_SetEventTrigger( $EventID,$TriggerType,$TriggerVariableID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetEventTrigger( $EventID,$TriggerType,$TriggerVariableID );
	return $result;
}

/**
* IPS_SetEventTriggerSubsequentExecution
* 
* @returns Boolean
* @param Integer $EventID
* @param Boolean $AllowSubsequentExecutions
*/

function IPS_SetEventTriggerSubsequentExecution( $EventID,$AllowSubsequentExecutions ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetEventTriggerSubsequentExecution( $EventID,$AllowSubsequentExecutions );
	return $result;
}

/**
* IPS_SetEventTriggerValue
* 
* @returns Boolean
* @param Integer $EventID
* @param Array $TriggerValue
*/

function IPS_SetEventTriggerValue( $EventID,$TriggerValue ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetEventTriggerValue( $EventID,$TriggerValue );
	return $result;
}

/**
* IPS_SetHidden
* 
* @returns Boolean
* @param Integer $ID
* @param Boolean $Hidden
*/

function IPS_SetHidden( $ID,$Hidden ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetHidden( $ID,$Hidden );
	return $result;
}

/**
* IPS_SetIcon
* 
* @returns Boolean
* @param Integer $ID
* @param String $Icon
*/

function IPS_SetIcon( $ID,$Icon ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetIcon( $ID,$Icon );
	return $result;
}

/**
* IPS_SetIdent
* 
* @returns Boolean
* @param Integer $ID
* @param String $Ident
*/

function IPS_SetIdent( $ID,$Ident ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetIdent( $ID,$Ident );
	return $result;
}

/**
* IPS_SetInfo
* 
* @returns Boolean
* @param Integer $ID
* @param String $Info
*/

function IPS_SetInfo( $ID,$Info ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetInfo( $ID,$Info );
	return $result;
}

/**
* IPS_SetInstanceStatus
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Status
*/

function IPS_SetInstanceStatus( $InstanceID,$Status ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetInstanceStatus( $InstanceID,$Status );
	return $result;
}

/**
* IPS_SetLicense
* 
* @returns Boolean
* @param String $Licensee
* @param String $LicenseContent
*/

function IPS_SetLicense( $Licensee,$LicenseContent ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetLicense( $Licensee,$LicenseContent );
	return $result;
}

/**
* IPS_SetLinkTargetID
* 
* @returns Boolean
* @param Integer $LinkID
* @param Integer $ChildID
*/

function IPS_SetLinkTargetID( $LinkID,$ChildID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetLinkTargetID( $LinkID,$ChildID );
	return $result;
}

/**
* IPS_SetMediaCached
* 
* @returns Boolean
* @param Integer $MediaID
* @param Boolean $Cached
*/

function IPS_SetMediaCached( $MediaID,$Cached ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetMediaCached( $MediaID,$Cached );
	return $result;
}

/**
* IPS_SetMediaContent
* 
* @returns Boolean
* @param Integer $MediaID
* @param String $Content
*/

function IPS_SetMediaContent( $MediaID,$Content ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetMediaContent( $MediaID,$Content );
	return $result;
}

/**
* IPS_SetMediaFile
* 
* @returns Boolean
* @param Integer $MediaID
* @param String $FilePath
* @param Boolean $FileMustExists
*/

function IPS_SetMediaFile( $MediaID,$FilePath,$FileMustExists ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetMediaFile( $MediaID,$FilePath,$FileMustExists );
	return $result;
}

/**
* IPS_SetName
* 
* @returns Boolean
* @param Integer $ID
* @param String $Name
*/

function IPS_SetName( $ID,$Name ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetName( $ID,$Name );
	return $result;
}

/**
* IPS_SetOption
* 
* @returns Boolean
* @param String $Option
* @param Integer $Value
*/

function IPS_SetOption( $Option,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetOption( $Option,$Value );
	return $result;
}

/**
* IPS_SetParent
* 
* @returns Boolean
* @param Integer $ID
* @param Integer $ParentID
*/

function IPS_SetParent( $ID,$ParentID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetParent( $ID,$ParentID );
	return $result;
}

/**
* IPS_SetPosition
* 
* @returns Boolean
* @param Integer $ID
* @param Integer $Position
*/

function IPS_SetPosition( $ID,$Position ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetPosition( $ID,$Position );
	return $result;
}

/**
* IPS_SetProperty
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Name
* @param Array $Value
*/

function IPS_SetProperty( $InstanceID,$Name,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetProperty( $InstanceID,$Name,$Value );
	return $result;
}

/**
* IPS_SetScriptContent
* 
* @returns Boolean
* @param Integer $ScriptID
* @param String $Content
*/

function IPS_SetScriptContent( $ScriptID,$Content ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetScriptContent( $ScriptID,$Content );
	return $result;
}

/**
* IPS_SetScriptFile
* 
* @returns Boolean
* @param Integer $ScriptID
* @param String $FilePath
*/

function IPS_SetScriptFile( $ScriptID,$FilePath ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetScriptFile( $ScriptID,$FilePath );
	return $result;
}

/**
* IPS_SetScriptTimer
* 
* @returns Boolean
* @param Integer $ScriptID
* @param Integer $Interval
*/

function IPS_SetScriptTimer( $ScriptID,$Interval ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetScriptTimer( $ScriptID,$Interval );
	return $result;
}

/**
* IPS_SetVariableCustomAction
* 
* @returns Boolean
* @param Integer $VariableID
* @param Integer $ScriptID
*/

function IPS_SetVariableCustomAction( $VariableID,$ScriptID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetVariableCustomAction( $VariableID,$ScriptID );
	return $result;
}

/**
* IPS_SetVariableCustomProfile
* 
* @returns Boolean
* @param Integer $VariableID
* @param String $ProfileName
*/

function IPS_SetVariableCustomProfile( $VariableID,$ProfileName ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetVariableCustomProfile( $VariableID,$ProfileName );
	return $result;
}

/**
* IPS_SetVariableProfileAssociation
* 
* @returns Boolean
* @param String $ProfileName
* @param Float $AssociationValue
* @param String $AssociationName
* @param String $AssociationIcon
* @param Integer $AssociationColor
*/

function IPS_SetVariableProfileAssociation( $ProfileName,$AssociationValue,$AssociationName,$AssociationIcon,$AssociationColor ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetVariableProfileAssociation( $ProfileName,$AssociationValue,$AssociationName,$AssociationIcon,$AssociationColor );
	return $result;
}

/**
* IPS_SetVariableProfileDigits
* 
* @returns Boolean
* @param String $ProfileName
* @param Integer $Digits
*/

function IPS_SetVariableProfileDigits( $ProfileName,$Digits ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetVariableProfileDigits( $ProfileName,$Digits );
	return $result;
}

/**
* IPS_SetVariableProfileIcon
* 
* @returns Boolean
* @param String $ProfileName
* @param String $Icon
*/

function IPS_SetVariableProfileIcon( $ProfileName,$Icon ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetVariableProfileIcon( $ProfileName,$Icon );
	return $result;
}

/**
* IPS_SetVariableProfileText
* 
* @returns Boolean
* @param String $ProfileName
* @param String $Prefix
* @param String $Suffix
*/

function IPS_SetVariableProfileText( $ProfileName,$Prefix,$Suffix ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetVariableProfileText( $ProfileName,$Prefix,$Suffix );
	return $result;
}

/**
* IPS_SetVariableProfileValues
* 
* @returns Boolean
* @param String $ProfileName
* @param Float $MinValue
* @param Float $MaxValue
* @param Float $StepSize
*/

function IPS_SetVariableProfileValues( $ProfileName,$MinValue,$MaxValue,$StepSize ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetVariableProfileValues( $ProfileName,$MinValue,$MaxValue,$StepSize );
	return $result;
}

/**
* IPS_Sleep
* 
* @returns Integer
* @param Integer $Milliseconds
*/

function IPS_Sleep( $Milliseconds ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_Sleep( $Milliseconds );
	return $result;
}

/**
* IPS_StartSearch
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function IPS_StartSearch( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_StartSearch( $InstanceID );
	return $result;
}

/**
* IPS_StopSearch
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function IPS_StopSearch( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_StopSearch( $InstanceID );
	return $result;
}

/**
* IPS_SupportsSearching
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function IPS_SupportsSearching( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SupportsSearching( $InstanceID );
	return $result;
}

/**
* IPS_TimerExists
* 
* @returns Boolean
* @param Integer $TimerID
*/

function IPS_TimerExists( $TimerID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_TimerExists( $TimerID );
	return $result;
}

/**
* IPS_VariableExists
* 
* @returns Boolean
* @param Integer $VariableID
*/

function IPS_VariableExists( $VariableID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_VariableExists( $VariableID );
	return $result;
}

/**
* IPS_VariableProfileExists
* 
* @returns Boolean
* @param String $ProfileName
*/

function IPS_VariableProfileExists( $ProfileName ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_VariableProfileExists( $ProfileName );
	return $result;
}

/**
* IRT_ListButtons
* 
* @returns Variant
* @param Integer $InstanceID
* @param String $Remote
*/

function IRT_ListButtons( $InstanceID,$Remote ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IRT_ListButtons( $InstanceID,$Remote );
	return $result;
}

/**
* IRT_ListRemotes
* 
* @returns Variant
* @param Integer $InstanceID
*/

function IRT_ListRemotes( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IRT_ListRemotes( $InstanceID );
	return $result;
}

/**
* IRT_SendOnce
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Remote
* @param String $Button
*/

function IRT_SendOnce( $InstanceID,$Remote,$Button ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IRT_SendOnce( $InstanceID,$Remote,$Button );
	return $result;
}

/**
* LCN_AddGroup
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Group
*/

function LCN_AddGroup( $InstanceID,$Group ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_AddGroup( $InstanceID,$Group );
	return $result;
}

/**
* LCN_AddIntensity
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Intensity
*/

function LCN_AddIntensity( $InstanceID,$Intensity ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_AddIntensity( $InstanceID,$Intensity );
	return $result;
}

/**
* LCN_Beep
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Boolean $SpecialTone
* @param Integer $Count
*/

function LCN_Beep( $InstanceID,$SpecialTone,$Count ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_Beep( $InstanceID,$SpecialTone,$Count );
	return $result;
}

/**
* LCN_DeductIntensity
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Intensity
*/

function LCN_DeductIntensity( $InstanceID,$Intensity ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_DeductIntensity( $InstanceID,$Intensity );
	return $result;
}

/**
* LCN_Fadeout
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Intensity
* @param Integer $Ramp
*/

function LCN_Fadeout( $InstanceID,$Intensity,$Ramp ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_Fadeout( $InstanceID,$Intensity,$Ramp );
	return $result;
}

/**
* LCN_FlipRelay
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function LCN_FlipRelay( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_FlipRelay( $InstanceID );
	return $result;
}

/**
* LCN_GetKnownDevices
* 
* @returns Variant
* @param Integer $InstanceID
*/

function LCN_GetKnownDevices( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_GetKnownDevices( $InstanceID );
	return $result;
}

/**
* LCN_LimitOutput
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Value
* @param Integer $Time
* @param String $TimeType
*/

function LCN_LimitOutput( $InstanceID,$Value,$Time,$TimeType ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_LimitOutput( $InstanceID,$Value,$Time,$TimeType );
	return $result;
}

/**
* LCN_LoadScene
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Scene
*/

function LCN_LoadScene( $InstanceID,$Scene ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_LoadScene( $InstanceID,$Scene );
	return $result;
}

/**
* LCN_LockTargetValue
* 
* @returns Boolean
* @param Integer $InstanceID
* @param integer $Target
*   enum[0=ltR1, 1=ltR2, 2=ltS1, 3=ltS2]
*/

function LCN_LockTargetValue( $InstanceID,$Target ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_LockTargetValue( $InstanceID,$Target );
	return $result;
}

/**
* LCN_RampStop
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function LCN_RampStop( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_RampStop( $InstanceID );
	return $result;
}

/**
* LCN_ReleaseTargetValue
* 
* @returns Boolean
* @param Integer $InstanceID
* @param integer $Target
*   enum[0=ltR1, 1=ltR2, 2=ltS1, 3=ltS2]
*/

function LCN_ReleaseTargetValue( $InstanceID,$Target ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_ReleaseTargetValue( $InstanceID,$Target );
	return $result;
}

/**
* LCN_RemoveGroup
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Group
*/

function LCN_RemoveGroup( $InstanceID,$Group ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_RemoveGroup( $InstanceID,$Group );
	return $result;
}

/**
* LCN_RequestLights
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function LCN_RequestLights( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_RequestLights( $InstanceID );
	return $result;
}

/**
* LCN_RequestRead
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function LCN_RequestRead( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_RequestRead( $InstanceID );
	return $result;
}

/**
* LCN_RequestStatus
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function LCN_RequestStatus( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_RequestStatus( $InstanceID );
	return $result;
}

/**
* LCN_RequestThresholds
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function LCN_RequestThresholds( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_RequestThresholds( $InstanceID );
	return $result;
}

/**
* LCN_SaveScene
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Scene
*/

function LCN_SaveScene( $InstanceID,$Scene ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_SaveScene( $InstanceID,$Scene );
	return $result;
}

/**
* LCN_SearchDevices
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Segment
*/

function LCN_SearchDevices( $InstanceID,$Segment ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_SearchDevices( $InstanceID,$Segment );
	return $result;
}

/**
* LCN_SelectSceneRegister
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Register
*/

function LCN_SelectSceneRegister( $InstanceID,$Register ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_SelectSceneRegister( $InstanceID,$Register );
	return $result;
}

/**
* LCN_SendCommand
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Function
* @param String $Data
*/

function LCN_SendCommand( $InstanceID,$Function,$Data ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_SendCommand( $InstanceID,$Function,$Data );
	return $result;
}

/**
* LCN_SetIntensity
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Intensity
* @param Integer $Ramp
*/

function LCN_SetIntensity( $InstanceID,$Intensity,$Ramp ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_SetIntensity( $InstanceID,$Intensity,$Ramp );
	return $result;
}

/**
* LCN_SetLamp
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Lamp
* @param String $Action
*/

function LCN_SetLamp( $InstanceID,$Lamp,$Action ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_SetLamp( $InstanceID,$Lamp,$Action );
	return $result;
}

/**
* LCN_SetRelay
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Value
*/

function LCN_SetRelay( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_SetRelay( $InstanceID,$Value );
	return $result;
}

/**
* LCN_SetTargetValue
* 
* @returns Boolean
* @param Integer $InstanceID
* @param integer $Target
*   enum[0=ltR1, 1=ltR2, 2=ltS1, 3=ltS2]
* @param Float $Value
*/

function LCN_SetTargetValue( $InstanceID,$Target,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_SetTargetValue( $InstanceID,$Target,$Value );
	return $result;
}

/**
* LCN_ShiftTargetValue
* 
* @returns Boolean
* @param Integer $InstanceID
* @param integer $Target
*   enum[0=ltR1, 1=ltR2, 2=ltS1, 3=ltS2]
* @param Float $RelativeValue
*/

function LCN_ShiftTargetValue( $InstanceID,$Target,$RelativeValue ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_ShiftTargetValue( $InstanceID,$Target,$RelativeValue );
	return $result;
}

/**
* LCN_ShutterMoveDown
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function LCN_ShutterMoveDown( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_ShutterMoveDown( $InstanceID );
	return $result;
}

/**
* LCN_ShutterMoveUp
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function LCN_ShutterMoveUp( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_ShutterMoveUp( $InstanceID );
	return $result;
}

/**
* LCN_ShutterStop
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function LCN_ShutterStop( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_ShutterStop( $InstanceID );
	return $result;
}

/**
* LCN_StartFlicker
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Depth
* @param String $Speed
* @param Integer $Count
*/

function LCN_StartFlicker( $InstanceID,$Depth,$Speed,$Count ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_StartFlicker( $InstanceID,$Depth,$Speed,$Count );
	return $result;
}

/**
* LCN_StopFlicker
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function LCN_StopFlicker( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_StopFlicker( $InstanceID );
	return $result;
}

/**
* LCN_SwitchDurationMin
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Minutes
* @param String $Fadeout
* @param Boolean $Retentive
*/

function LCN_SwitchDurationMin( $InstanceID,$Minutes,$Fadeout,$Retentive ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_SwitchDurationMin( $InstanceID,$Minutes,$Fadeout,$Retentive );
	return $result;
}

/**
* LCN_SwitchDurationSec
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Seconds
* @param String $Fadeout
* @param Boolean $Retentive
*/

function LCN_SwitchDurationSec( $InstanceID,$Seconds,$Fadeout,$Retentive ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_SwitchDurationSec( $InstanceID,$Seconds,$Fadeout,$Retentive );
	return $result;
}

/**
* LCN_SwitchMemory
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Ramp
*/

function LCN_SwitchMemory( $InstanceID,$Ramp ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_SwitchMemory( $InstanceID,$Ramp );
	return $result;
}

/**
* LCN_SwitchMode
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Ramp
*/

function LCN_SwitchMode( $InstanceID,$Ramp ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_SwitchMode( $InstanceID,$Ramp );
	return $result;
}

/**
* LCN_SwitchRelay
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Boolean $SwitchOn
*/

function LCN_SwitchRelay( $InstanceID,$SwitchOn ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_SwitchRelay( $InstanceID,$SwitchOn );
	return $result;
}

/**
* MBUS_UpdateValues
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function MBUS_UpdateValues( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MBUS_UpdateValues( $InstanceID );
	return $result;
}

/**
* MC_CreateModule
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $ModuleURL
*/

function MC_CreateModule( $InstanceID,$ModuleURL ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MC_CreateModule( $InstanceID,$ModuleURL );
	return $result;
}

/**
* MC_DeleteModule
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Module
*/

function MC_DeleteModule( $InstanceID,$Module ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MC_DeleteModule( $InstanceID,$Module );
	return $result;
}

/**
* MC_GetModuleList
* 
* @returns Variant
* @param Integer $InstanceID
*/

function MC_GetModuleList( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MC_GetModuleList( $InstanceID );
	return $result;
}

/**
* MC_GetModuleRepositoryInfo
* 
* @returns Variant
* @param Integer $InstanceID
* @param String $Module
*/

function MC_GetModuleRepositoryInfo( $InstanceID,$Module ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MC_GetModuleRepositoryInfo( $InstanceID,$Module );
	return $result;
}

/**
* MC_UpdateModule
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Module
*/

function MC_UpdateModule( $InstanceID,$Module ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MC_UpdateModule( $InstanceID,$Module );
	return $result;
}

/**
* MXC_DimBrighter
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function MXC_DimBrighter( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MXC_DimBrighter( $InstanceID );
	return $result;
}

/**
* MXC_DimDarker
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function MXC_DimDarker( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MXC_DimDarker( $InstanceID );
	return $result;
}

/**
* MXC_DimSet
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Intensity
*/

function MXC_DimSet( $InstanceID,$Intensity ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MXC_DimSet( $InstanceID,$Intensity );
	return $result;
}

/**
* MXC_DimStop
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function MXC_DimStop( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MXC_DimStop( $InstanceID );
	return $result;
}

/**
* MXC_GetKnownDevices
* 
* @returns Variant
* @param Integer $InstanceID
*/

function MXC_GetKnownDevices( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MXC_GetKnownDevices( $InstanceID );
	return $result;
}

/**
* MXC_RequestInfo
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function MXC_RequestInfo( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MXC_RequestInfo( $InstanceID );
	return $result;
}

/**
* MXC_RequestStatus
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function MXC_RequestStatus( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MXC_RequestStatus( $InstanceID );
	return $result;
}

/**
* MXC_SearchDevices
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function MXC_SearchDevices( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MXC_SearchDevices( $InstanceID );
	return $result;
}

/**
* MXC_SendBoolean
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Boolean $Value
*/

function MXC_SendBoolean( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MXC_SendBoolean( $InstanceID,$Value );
	return $result;
}

/**
* MXC_SendFloat
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Float $Value
*/

function MXC_SendFloat( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MXC_SendFloat( $InstanceID,$Value );
	return $result;
}

/**
* MXC_SendInteger
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Value
*/

function MXC_SendInteger( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MXC_SendInteger( $InstanceID,$Value );
	return $result;
}

/**
* MXC_SetTemperature
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Float $Temperature
*/

function MXC_SetTemperature( $InstanceID,$Temperature ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MXC_SetTemperature( $InstanceID,$Temperature );
	return $result;
}

/**
* MXC_ShutterMoveDown
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function MXC_ShutterMoveDown( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MXC_ShutterMoveDown( $InstanceID );
	return $result;
}

/**
* MXC_ShutterMoveUp
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function MXC_ShutterMoveUp( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MXC_ShutterMoveUp( $InstanceID );
	return $result;
}

/**
* MXC_ShutterStepDown
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function MXC_ShutterStepDown( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MXC_ShutterStepDown( $InstanceID );
	return $result;
}

/**
* MXC_ShutterStepUp
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function MXC_ShutterStepUp( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MXC_ShutterStepUp( $InstanceID );
	return $result;
}

/**
* MXC_ShutterStop
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function MXC_ShutterStop( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MXC_ShutterStop( $InstanceID );
	return $result;
}

/**
* MXC_SwitchMode
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Boolean $DeviceOn
*/

function MXC_SwitchMode( $InstanceID,$DeviceOn ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MXC_SwitchMode( $InstanceID,$DeviceOn );
	return $result;
}

/**
* MXC_UploadDataPointFile
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Content
*/

function MXC_UploadDataPointFile( $InstanceID,$Content ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MXC_UploadDataPointFile( $InstanceID,$Content );
	return $result;
}

/**
* ModBus_RequestRead
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function ModBus_RequestRead( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ModBus_RequestRead( $InstanceID );
	return $result;
}

/**
* ModBus_WriteCoil
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Boolean $Value
*/

function ModBus_WriteCoil( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ModBus_WriteCoil( $InstanceID,$Value );
	return $result;
}

/**
* ModBus_WriteRegister
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Float $Value
*/

function ModBus_WriteRegister( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ModBus_WriteRegister( $InstanceID,$Value );
	return $result;
}

/**
* ModBus_WriteRegisterByte
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Value
*/

function ModBus_WriteRegisterByte( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ModBus_WriteRegisterByte( $InstanceID,$Value );
	return $result;
}

/**
* ModBus_WriteRegisterDWord
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Value
*/

function ModBus_WriteRegisterDWord( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ModBus_WriteRegisterDWord( $InstanceID,$Value );
	return $result;
}

/**
* ModBus_WriteRegisterInt64
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Float $Value
*/

function ModBus_WriteRegisterInt64( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ModBus_WriteRegisterInt64( $InstanceID,$Value );
	return $result;
}

/**
* ModBus_WriteRegisterInteger
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Value
*/

function ModBus_WriteRegisterInteger( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ModBus_WriteRegisterInteger( $InstanceID,$Value );
	return $result;
}

/**
* ModBus_WriteRegisterReal
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Float $Value
*/

function ModBus_WriteRegisterReal( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ModBus_WriteRegisterReal( $InstanceID,$Value );
	return $result;
}

/**
* ModBus_WriteRegisterReal64
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Float $Value
*/

function ModBus_WriteRegisterReal64( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ModBus_WriteRegisterReal64( $InstanceID,$Value );
	return $result;
}

/**
* ModBus_WriteRegisterShortInt
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Value
*/

function ModBus_WriteRegisterShortInt( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ModBus_WriteRegisterShortInt( $InstanceID,$Value );
	return $result;
}

/**
* ModBus_WriteRegisterSmallInt
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Value
*/

function ModBus_WriteRegisterSmallInt( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ModBus_WriteRegisterSmallInt( $InstanceID,$Value );
	return $result;
}

/**
* ModBus_WriteRegisterWord
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Value
*/

function ModBus_WriteRegisterWord( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ModBus_WriteRegisterWord( $InstanceID,$Value );
	return $result;
}

/**
* NC_ActivateServer
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function NC_ActivateServer( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->NC_ActivateServer( $InstanceID );
	return $result;
}

/**
* NC_AddDevice
* 
* @returns String
* @param Integer $InstanceID
* @param String $Token
* @param String $Provider
* @param String $DeviceID
* @param String $Name
* @param Integer $WebFrontConfiguratorID
*/

function NC_AddDevice( $InstanceID,$Token,$Provider,$DeviceID,$Name,$WebFrontConfiguratorID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->NC_AddDevice( $InstanceID,$Token,$Provider,$DeviceID,$Name,$WebFrontConfiguratorID );
	return $result;
}

/**
* NC_GetDevices
* 
* @returns Variant
* @param Integer $InstanceID
*/

function NC_GetDevices( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->NC_GetDevices( $InstanceID );
	return $result;
}

/**
* NC_RemoveDevice
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $DeviceID
*/

function NC_RemoveDevice( $InstanceID,$DeviceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->NC_RemoveDevice( $InstanceID,$DeviceID );
	return $result;
}

/**
* NC_RemoveDeviceConfigurator
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $DeviceID
* @param Integer $WebFrontConfiguratorID
*/

function NC_RemoveDeviceConfigurator( $InstanceID,$DeviceID,$WebFrontConfiguratorID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->NC_RemoveDeviceConfigurator( $InstanceID,$DeviceID,$WebFrontConfiguratorID );
	return $result;
}

/**
* NC_SetDeviceConfigurator
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $DeviceID
* @param Integer $WebFrontConfiguratorID
* @param Boolean $Enabled
*/

function NC_SetDeviceConfigurator( $InstanceID,$DeviceID,$WebFrontConfiguratorID,$Enabled ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->NC_SetDeviceConfigurator( $InstanceID,$DeviceID,$WebFrontConfiguratorID,$Enabled );
	return $result;
}

/**
* NC_SetDeviceName
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $DeviceID
* @param String $Name
*/

function NC_SetDeviceName( $InstanceID,$DeviceID,$Name ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->NC_SetDeviceName( $InstanceID,$DeviceID,$Name );
	return $result;
}

/**
* NC_TestDevice
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $DeviceID
*/

function NC_TestDevice( $InstanceID,$DeviceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->NC_TestDevice( $InstanceID,$DeviceID );
	return $result;
}

/**
* NUT_Query
* 
* @returns Array
* @param Integer $InstanceID
*/

function NUT_Query( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->NUT_Query( $InstanceID );
	return $result;
}

/**
* NUT_SendDataToChildren
* 
* @returns Array
* @param Integer $InstanceID
* @param Array $Data
*/

function NUT_SendDataToChildren( $InstanceID,$Data ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->NUT_SendDataToChildren( $InstanceID,$Data );
	return $result;
}

/**
* NUT_UpdateEvent
* 
* @returns Array
* @param Integer $InstanceID
*/

function NUT_UpdateEvent( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->NUT_UpdateEvent( $InstanceID );
	return $result;
}

/**
* OW_GetKnownDevices
* 
* @returns Variant
* @param Integer $InstanceID
*/

function OW_GetKnownDevices( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OW_GetKnownDevices( $InstanceID );
	return $result;
}

/**
* OW_RequestStatus
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function OW_RequestStatus( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OW_RequestStatus( $InstanceID );
	return $result;
}

/**
* OW_SetPin
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Pin
* @param Boolean $SwitchOn
*/

function OW_SetPin( $InstanceID,$Pin,$SwitchOn ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OW_SetPin( $InstanceID,$Pin,$SwitchOn );
	return $result;
}

/**
* OW_SetPort
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Value
*/

function OW_SetPort( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OW_SetPort( $InstanceID,$Value );
	return $result;
}

/**
* OW_SetPosition
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Value
*/

function OW_SetPosition( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OW_SetPosition( $InstanceID,$Value );
	return $result;
}

/**
* OW_SetStrobe
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Boolean $Status
*/

function OW_SetStrobe( $InstanceID,$Status ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OW_SetStrobe( $InstanceID,$Status );
	return $result;
}

/**
* OW_SwitchMode
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Boolean $SwitchOn
*/

function OW_SwitchMode( $InstanceID,$SwitchOn ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OW_SwitchMode( $InstanceID,$SwitchOn );
	return $result;
}

/**
* OW_ToggleMode
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function OW_ToggleMode( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OW_ToggleMode( $InstanceID );
	return $result;
}

/**
* OW_WriteBytes
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Data
*/

function OW_WriteBytes( $InstanceID,$Data ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OW_WriteBytes( $InstanceID,$Data );
	return $result;
}

/**
* OW_WriteBytesMasked
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Data
* @param Integer $Mask
*/

function OW_WriteBytesMasked( $InstanceID,$Data,$Mask ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OW_WriteBytesMasked( $InstanceID,$Data,$Mask );
	return $result;
}

/**
* OZW_GetKnownDevices
* 
* @returns Variant
* @param Integer $InstanceID
*/

function OZW_GetKnownDevices( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OZW_GetKnownDevices( $InstanceID );
	return $result;
}

/**
* OZW_GetKnownItems
* 
* @returns Variant
* @param Integer $InstanceID
* @param Integer $RootID
*/

function OZW_GetKnownItems( $InstanceID,$RootID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OZW_GetKnownItems( $InstanceID,$RootID );
	return $result;
}

/**
* OZW_RequestStatus
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function OZW_RequestStatus( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OZW_RequestStatus( $InstanceID );
	return $result;
}

/**
* OZW_WriteDataPoint
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Array $Value
*/

function OZW_WriteDataPoint( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OZW_WriteDataPoint( $InstanceID,$Value );
	return $result;
}

/**
* PJ_Backlight
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Boolean $Status
*/

function PJ_Backlight( $InstanceID,$Status ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->PJ_Backlight( $InstanceID,$Status );
	return $result;
}

/**
* PJ_Beep
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $TenthOfASecond
*/

function PJ_Beep( $InstanceID,$TenthOfASecond ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->PJ_Beep( $InstanceID,$TenthOfASecond );
	return $result;
}

/**
* PJ_DimRGBW
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $R
* @param Integer $RTime
* @param Integer $G
* @param Integer $GTime
* @param Integer $B
* @param Integer $BTime
* @param Integer $W
* @param Integer $WTime
*/

function PJ_DimRGBW( $InstanceID,$R,$RTime,$G,$GTime,$B,$BTime,$W,$WTime ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->PJ_DimRGBW( $InstanceID,$R,$RTime,$G,$GTime,$B,$BTime,$W,$WTime );
	return $result;
}

/**
* PJ_DimServo
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Channel
* @param Integer $Value
* @param Integer $Steps
*/

function PJ_DimServo( $InstanceID,$Channel,$Value,$Steps ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->PJ_DimServo( $InstanceID,$Channel,$Value,$Steps );
	return $result;
}

/**
* PJ_LCDText
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Line
* @param String $Text
*/

function PJ_LCDText( $InstanceID,$Line,$Text ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->PJ_LCDText( $InstanceID,$Line,$Text );
	return $result;
}

/**
* PJ_RequestStatus
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function PJ_RequestStatus( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->PJ_RequestStatus( $InstanceID );
	return $result;
}

/**
* PJ_RunProgram
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Type
*/

function PJ_RunProgram( $InstanceID,$Type ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->PJ_RunProgram( $InstanceID,$Type );
	return $result;
}

/**
* PJ_SetLEDs
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Boolean $Green
* @param Boolean $Yellow
* @param Boolean $Red
*/

function PJ_SetLEDs( $InstanceID,$Green,$Yellow,$Red ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->PJ_SetLEDs( $InstanceID,$Green,$Yellow,$Red );
	return $result;
}

/**
* PJ_SetRGBW
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $R
* @param Integer $G
* @param Integer $B
* @param Integer $W
*/

function PJ_SetRGBW( $InstanceID,$R,$G,$B,$W ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->PJ_SetRGBW( $InstanceID,$R,$G,$B,$W );
	return $result;
}

/**
* PJ_SetServo
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Channel
* @param Integer $Value
*/

function PJ_SetServo( $InstanceID,$Channel,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->PJ_SetServo( $InstanceID,$Channel,$Value );
	return $result;
}

/**
* PJ_SwitchDuration
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Boolean $DeviceOn
* @param Integer $Duration
*/

function PJ_SwitchDuration( $InstanceID,$DeviceOn,$Duration ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->PJ_SwitchDuration( $InstanceID,$DeviceOn,$Duration );
	return $result;
}

/**
* PJ_SwitchLED
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $LED
* @param Boolean $Status
*/

function PJ_SwitchLED( $InstanceID,$LED,$Status ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->PJ_SwitchLED( $InstanceID,$LED,$Status );
	return $result;
}

/**
* PJ_SwitchMode
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Boolean $DeviceOn
*/

function PJ_SwitchMode( $InstanceID,$DeviceOn ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->PJ_SwitchMode( $InstanceID,$DeviceOn );
	return $result;
}

/**
* POP3_GetCachedMails
* 
* @returns Variant
* @param Integer $InstanceID
*/

function POP3_GetCachedMails( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->POP3_GetCachedMails( $InstanceID );
	return $result;
}

/**
* POP3_GetMailEx
* 
* @returns Variant
* @param Integer $InstanceID
* @param String $UID
*/

function POP3_GetMailEx( $InstanceID,$UID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->POP3_GetMailEx( $InstanceID,$UID );
	return $result;
}

/**
* POP3_UpdateCache
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function POP3_UpdateCache( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->POP3_UpdateCache( $InstanceID );
	return $result;
}

/**
* RegVar_GetBuffer
* 
* @returns String
* @param Integer $InstanceID
*/

function RegVar_GetBuffer( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->RegVar_GetBuffer( $InstanceID );
	return $result;
}

/**
* RegVar_SendText
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Text
*/

function RegVar_SendText( $InstanceID,$Text ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->RegVar_SendText( $InstanceID,$Text );
	return $result;
}

/**
* RegVar_SetBuffer
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Text
*/

function RegVar_SetBuffer( $InstanceID,$Text ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->RegVar_SetBuffer( $InstanceID,$Text );
	return $result;
}

/**
* S7_RequestRead
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function S7_RequestRead( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->S7_RequestRead( $InstanceID );
	return $result;
}

/**
* S7_Write
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Float $Value
*/

function S7_Write( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->S7_Write( $InstanceID,$Value );
	return $result;
}

/**
* S7_WriteBit
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Boolean $Value
*/

function S7_WriteBit( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->S7_WriteBit( $InstanceID,$Value );
	return $result;
}

/**
* S7_WriteByte
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Value
*/

function S7_WriteByte( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->S7_WriteByte( $InstanceID,$Value );
	return $result;
}

/**
* S7_WriteDWord
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Value
*/

function S7_WriteDWord( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->S7_WriteDWord( $InstanceID,$Value );
	return $result;
}

/**
* S7_WriteInteger
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Value
*/

function S7_WriteInteger( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->S7_WriteInteger( $InstanceID,$Value );
	return $result;
}

/**
* S7_WriteReal
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Float $Value
*/

function S7_WriteReal( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->S7_WriteReal( $InstanceID,$Value );
	return $result;
}

/**
* S7_WriteShortInt
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Value
*/

function S7_WriteShortInt( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->S7_WriteShortInt( $InstanceID,$Value );
	return $result;
}

/**
* S7_WriteSmallInt
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Value
*/

function S7_WriteSmallInt( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->S7_WriteSmallInt( $InstanceID,$Value );
	return $result;
}

/**
* S7_WriteWord
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Value
*/

function S7_WriteWord( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->S7_WriteWord( $InstanceID,$Value );
	return $result;
}

/**
* SC_CreateSkin
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $SkinURL
*/

function SC_CreateSkin( $InstanceID,$SkinURL ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SC_CreateSkin( $InstanceID,$SkinURL );
	return $result;
}

/**
* SC_DeleteSkin
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Skin
*/

function SC_DeleteSkin( $InstanceID,$Skin ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SC_DeleteSkin( $InstanceID,$Skin );
	return $result;
}

/**
* SC_GetSkin
* 
* @returns Variant
* @param Integer $InstanceID
* @param String $Skin
*/

function SC_GetSkin( $InstanceID,$Skin ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SC_GetSkin( $InstanceID,$Skin );
	return $result;
}

/**
* SC_GetSkinIconContent
* 
* @returns String
* @param Integer $InstanceID
* @param String $Skin
* @param String $Icon
*/

function SC_GetSkinIconContent( $InstanceID,$Skin,$Icon ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SC_GetSkinIconContent( $InstanceID,$Skin,$Icon );
	return $result;
}

/**
* SC_GetSkinList
* 
* @returns Variant
* @param Integer $InstanceID
*/

function SC_GetSkinList( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SC_GetSkinList( $InstanceID );
	return $result;
}

/**
* SC_GetSkinRepositoryInfo
* 
* @returns Variant
* @param Integer $InstanceID
* @param String $Skin
*/

function SC_GetSkinRepositoryInfo( $InstanceID,$Skin ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SC_GetSkinRepositoryInfo( $InstanceID,$Skin );
	return $result;
}

/**
* SC_Move
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Position
*/

function SC_Move( $InstanceID,$Position ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SC_Move( $InstanceID,$Position );
	return $result;
}

/**
* SC_MoveDown
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Duration
*/

function SC_MoveDown( $InstanceID,$Duration ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SC_MoveDown( $InstanceID,$Duration );
	return $result;
}

/**
* SC_MoveUp
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Duration
*/

function SC_MoveUp( $InstanceID,$Duration ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SC_MoveUp( $InstanceID,$Duration );
	return $result;
}

/**
* SC_Stop
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function SC_Stop( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SC_Stop( $InstanceID );
	return $result;
}

/**
* SC_UpdateSkin
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Skin
*/

function SC_UpdateSkin( $InstanceID,$Skin ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SC_UpdateSkin( $InstanceID,$Skin );
	return $result;
}

/**
* SMS_RequestBalance
* 
* @returns Float
* @param Integer $InstanceID
*/

function SMS_RequestBalance( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SMS_RequestBalance( $InstanceID );
	return $result;
}

/**
* SMS_RequestStatus
* 
* @returns String
* @param Integer $InstanceID
* @param String $MsgID
*/

function SMS_RequestStatus( $InstanceID,$MsgID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SMS_RequestStatus( $InstanceID,$MsgID );
	return $result;
}

/**
* SMS_Send
* 
* @returns String
* @param Integer $InstanceID
* @param String $Number
* @param String $Text
*/

function SMS_Send( $InstanceID,$Number,$Text ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SMS_Send( $InstanceID,$Number,$Text );
	return $result;
}

/**
* SMTP_SendMail
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Subject
* @param String $Textg
*/

function SMTP_SendMail( $InstanceID,$Subject,$Textg ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SMTP_SendMail( $InstanceID,$Subject,$Textg );
	return $result;
}

/**
* SMTP_SendMailAttachment
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Subject
* @param String $Text
* @param String $Filename
*/

function SMTP_SendMailAttachment( $InstanceID,$Subject,$Text,$Filename ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SMTP_SendMailAttachment( $InstanceID,$Subject,$Text,$Filename );
	return $result;
}

/**
* SMTP_SendMailAttachmentEx
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Address
* @param String $Subject
* @param String $Text
* @param String $Filename
*/

function SMTP_SendMailAttachmentEx( $InstanceID,$Address,$Subject,$Text,$Filename ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SMTP_SendMailAttachmentEx( $InstanceID,$Address,$Subject,$Text,$Filename );
	return $result;
}

/**
* SMTP_SendMailEx
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Address
* @param String $Subject
* @param String $Text
*/

function SMTP_SendMailEx( $InstanceID,$Address,$Subject,$Text ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SMTP_SendMailEx( $InstanceID,$Address,$Subject,$Text );
	return $result;
}

/**
* SMTP_SendMailMedia
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Subject
* @param String $Text
* @param Integer $MediaID
*/

function SMTP_SendMailMedia( $InstanceID,$Subject,$Text,$MediaID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SMTP_SendMailMedia( $InstanceID,$Subject,$Text,$MediaID );
	return $result;
}

/**
* SMTP_SendMailMediaEx
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Address
* @param String $Subject
* @param String $Text
* @param Integer $MediaID
*/

function SMTP_SendMailMediaEx( $InstanceID,$Address,$Subject,$Text,$MediaID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SMTP_SendMailMediaEx( $InstanceID,$Address,$Subject,$Text,$MediaID );
	return $result;
}

/**
* SPRT_SendText
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Text
*/

function SPRT_SendText( $InstanceID,$Text ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SPRT_SendText( $InstanceID,$Text );
	return $result;
}

/**
* SPRT_SetBreak
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Boolean $OnOff
*/

function SPRT_SetBreak( $InstanceID,$OnOff ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SPRT_SetBreak( $InstanceID,$OnOff );
	return $result;
}

/**
* SPRT_SetDTR
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Boolean $OnOff
*/

function SPRT_SetDTR( $InstanceID,$OnOff ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SPRT_SetDTR( $InstanceID,$OnOff );
	return $result;
}

/**
* SPRT_SetRTS
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Boolean $OnOff
*/

function SPRT_SetRTS( $InstanceID,$OnOff ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SPRT_SetRTS( $InstanceID,$OnOff );
	return $result;
}

/**
* SSCK_SendText
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Text
*/

function SSCK_SendText( $InstanceID,$Text ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SSCK_SendText( $InstanceID,$Text );
	return $result;
}

/**
* SWD_DimDown
* 
* @returns Array
* @param Integer $InstanceID
*/

function SWD_DimDown( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SWD_DimDown( $InstanceID );
	return $result;
}

/**
* SWD_DimUp
* 
* @returns Array
* @param Integer $InstanceID
*/

function SWD_DimUp( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SWD_DimUp( $InstanceID );
	return $result;
}

/**
* SWD_SendDataToParent
* 
* @returns Array
* @param Integer $InstanceID
* @param Array $Data
*/

function SWD_SendDataToParent( $InstanceID,$Data ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SWD_SendDataToParent( $InstanceID,$Data );
	return $result;
}

/**
* SWD_SetDuration
* 
* @returns Array
* @param Integer $InstanceID
* @param Array $duration
*/

function SWD_SetDuration( $InstanceID,$duration ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SWD_SetDuration( $InstanceID,$duration );
	return $result;
}

/**
* SWD_SetIntensity
* 
* @returns Array
* @param Integer $InstanceID
* @param Array $percent
*/

function SWD_SetIntensity( $InstanceID,$percent ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SWD_SetIntensity( $InstanceID,$percent );
	return $result;
}

/**
* SWD_SetSwitchMode
* 
* @returns Array
* @param Integer $InstanceID
* @param Array $val
*/

function SWD_SetSwitchMode( $InstanceID,$val ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SWD_SetSwitchMode( $InstanceID,$val );
	return $result;
}

/**
* SWD_TimerEvent
* 
* @returns Array
* @param Integer $InstanceID
*/

function SWD_TimerEvent( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SWD_TimerEvent( $InstanceID );
	return $result;
}

/**
* SetValue
* 
* @returns Boolean
* @param Integer $VariableID
* @param Array $Value
*/

function SetValue( $VariableID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SetValue( $VariableID,$Value );
	return $result;
}

/**
* SetValueBoolean
* 
* @returns Boolean
* @param Integer $VariableID
* @param Boolean $Value
*/

function SetValueBoolean( $VariableID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SetValueBoolean( $VariableID,$Value );
	return $result;
}

/**
* SetValueFloat
* 
* @returns Boolean
* @param Integer $VariableID
* @param Float $Value
*/

function SetValueFloat( $VariableID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SetValueFloat( $VariableID,$Value );
	return $result;
}

/**
* SetValueInteger
* 
* @returns Boolean
* @param Integer $VariableID
* @param Integer $Value
*/

function SetValueInteger( $VariableID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SetValueInteger( $VariableID,$Value );
	return $result;
}

/**
* SetValueString
* 
* @returns Boolean
* @param Integer $VariableID
* @param String $Value
*/

function SetValueString( $VariableID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SetValueString( $VariableID,$Value );
	return $result;
}

/**
* Sys_GetBattery
* 
* @returns Variant
*/

function Sys_GetBattery(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->Sys_GetBattery(  );
	return $result;
}

/**
* Sys_GetCPUInfo
* 
* @returns Variant
*/

function Sys_GetCPUInfo(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->Sys_GetCPUInfo(  );
	return $result;
}

/**
* Sys_GetHardDiskInfo
* 
* @returns Variant
*/

function Sys_GetHardDiskInfo(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->Sys_GetHardDiskInfo(  );
	return $result;
}

/**
* Sys_GetMemoryInfo
* 
* @returns Variant
*/

function Sys_GetMemoryInfo(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->Sys_GetMemoryInfo(  );
	return $result;
}

/**
* Sys_GetNetworkInfo
* 
* @returns Variant
*/

function Sys_GetNetworkInfo(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->Sys_GetNetworkInfo(  );
	return $result;
}

/**
* Sys_GetProcessInfo
* 
* @returns Variant
*/

function Sys_GetProcessInfo(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->Sys_GetProcessInfo(  );
	return $result;
}

/**
* Sys_GetSpooler
* 
* @returns Variant
*/

function Sys_GetSpooler(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->Sys_GetSpooler(  );
	return $result;
}

/**
* Sys_GetURLContent
* 
* @returns String
* @param String $URL
*/

function Sys_GetURLContent( $URL ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->Sys_GetURLContent( $URL );
	return $result;
}

/**
* Sys_GetURLContentEx
* 
* @returns String
* @param String $URL
* @param Variant $Options
*/

function Sys_GetURLContentEx( $URL,$Options ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->Sys_GetURLContentEx( $URL,$Options );
	return $result;
}

/**
* Sys_Ping
* 
* @returns Boolean
* @param String $Host
* @param Integer $Timeout
*/

function Sys_Ping( $Host,$Timeout ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->Sys_Ping( $Host,$Timeout );
	return $result;
}

/**
* TE923_Query
* 
* @returns Array
* @param Integer $InstanceID
*/

function TE923_Query( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TE923_Query( $InstanceID );
	return $result;
}

/**
* TE923_SendDataToChildren
* 
* @returns Array
* @param Integer $InstanceID
* @param Array $Data
*/

function TE923_SendDataToChildren( $InstanceID,$Data ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TE923_SendDataToChildren( $InstanceID,$Data );
	return $result;
}

/**
* TE923_UpdateEvent
* 
* @returns Array
* @param Integer $InstanceID
*/

function TE923_UpdateEvent( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TE923_UpdateEvent( $InstanceID );
	return $result;
}

/**
* TTS_GenerateFile
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Text
* @param String $Filename
* @param Integer $Format
*/

function TTS_GenerateFile( $InstanceID,$Text,$Filename,$Format ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TTS_GenerateFile( $InstanceID,$Text,$Filename,$Format );
	return $result;
}

/**
* TTS_Speak
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Text
* @param Boolean $Wait
*/

function TTS_Speak( $InstanceID,$Text,$Wait ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TTS_Speak( $InstanceID,$Text,$Wait );
	return $result;
}

/**
* UC_FindInFiles
* 
* @returns Variant
* @param Integer $InstanceID
* @param Variant $Files
* @param String $SearchStr
*/

function UC_FindInFiles( $InstanceID,$Files,$SearchStr ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->UC_FindInFiles( $InstanceID,$Files,$SearchStr );
	return $result;
}

/**
* UC_RenameScript
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $ScriptID
* @param String $Filename
*/

function UC_RenameScript( $InstanceID,$ScriptID,$Filename ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->UC_RenameScript( $InstanceID,$ScriptID,$Filename );
	return $result;
}

/**
* UC_ReplaceInFiles
* 
* @returns Variant
* @param Integer $InstanceID
* @param Variant $Files
* @param String $SearchStr
* @param String $ReplaceStr
*/

function UC_ReplaceInFiles( $InstanceID,$Files,$SearchStr,$ReplaceStr ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->UC_ReplaceInFiles( $InstanceID,$Files,$SearchStr,$ReplaceStr );
	return $result;
}

/**
* USCK_SendText
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Text
*/

function USCK_SendText( $InstanceID,$Text ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->USCK_SendText( $InstanceID,$Text );
	return $result;
}

/**
* UVR_UpdateValues
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function UVR_UpdateValues( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->UVR_UpdateValues( $InstanceID );
	return $result;
}

/**
* VELLEUSB_ReadAnalogChannel
* 
* @returns Integer
* @param Integer $InstanceID
* @param Integer $Channel
*/

function VELLEUSB_ReadAnalogChannel( $InstanceID,$Channel ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VELLEUSB_ReadAnalogChannel( $InstanceID,$Channel );
	return $result;
}

/**
* VELLEUSB_ReadCounter
* 
* @returns Integer
* @param Integer $InstanceID
* @param Integer $Counter
*/

function VELLEUSB_ReadCounter( $InstanceID,$Counter ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VELLEUSB_ReadCounter( $InstanceID,$Counter );
	return $result;
}

/**
* VELLEUSB_ReadDigital
* 
* @returns Integer
* @param Integer $InstanceID
*/

function VELLEUSB_ReadDigital( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VELLEUSB_ReadDigital( $InstanceID );
	return $result;
}

/**
* VELLEUSB_ReadDigitalChannel
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Channel
*/

function VELLEUSB_ReadDigitalChannel( $InstanceID,$Channel ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VELLEUSB_ReadDigitalChannel( $InstanceID,$Channel );
	return $result;
}

/**
* VELLEUSB_ResetCounter
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Counter
*/

function VELLEUSB_ResetCounter( $InstanceID,$Counter ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VELLEUSB_ResetCounter( $InstanceID,$Counter );
	return $result;
}

/**
* VELLEUSB_SetCounterDebounceTime
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Counter
* @param Integer $Time
*/

function VELLEUSB_SetCounterDebounceTime( $InstanceID,$Counter,$Time ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VELLEUSB_SetCounterDebounceTime( $InstanceID,$Counter,$Time );
	return $result;
}

/**
* VELLEUSB_WriteAnalogChannel
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Channel
* @param Integer $Value
*/

function VELLEUSB_WriteAnalogChannel( $InstanceID,$Channel,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VELLEUSB_WriteAnalogChannel( $InstanceID,$Channel,$Value );
	return $result;
}

/**
* VELLEUSB_WriteDigital
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Value
*/

function VELLEUSB_WriteDigital( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VELLEUSB_WriteDigital( $InstanceID,$Value );
	return $result;
}

/**
* VELLEUSB_WriteDigitalChannel
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Channel
* @param Boolean $Value
*/

function VELLEUSB_WriteDigitalChannel( $InstanceID,$Channel,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VELLEUSB_WriteDigitalChannel( $InstanceID,$Channel,$Value );
	return $result;
}

/**
* VIO_PushText
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Text
*/

function VIO_PushText( $InstanceID,$Text ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VIO_PushText( $InstanceID,$Text );
	return $result;
}

/**
* VIO_PushTextHEX
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Text
*/

function VIO_PushTextHEX( $InstanceID,$Text ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VIO_PushTextHEX( $InstanceID,$Text );
	return $result;
}

/**
* VIO_SendText
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Text
*/

function VIO_SendText( $InstanceID,$Text ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VIO_SendText( $InstanceID,$Text );
	return $result;
}

/**
* WAC_AddFile
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Filename
*/

function WAC_AddFile( $InstanceID,$Filename ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WAC_AddFile( $InstanceID,$Filename );
	return $result;
}

/**
* WAC_ClearPlaylist
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function WAC_ClearPlaylist( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WAC_ClearPlaylist( $InstanceID );
	return $result;
}

/**
* WAC_GetPlaylistFile
* 
* @returns String
* @param Integer $InstanceID
* @param Integer $Position
*/

function WAC_GetPlaylistFile( $InstanceID,$Position ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WAC_GetPlaylistFile( $InstanceID,$Position );
	return $result;
}

/**
* WAC_GetPlaylistLength
* 
* @returns Integer
* @param Integer $InstanceID
*/

function WAC_GetPlaylistLength( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WAC_GetPlaylistLength( $InstanceID );
	return $result;
}

/**
* WAC_GetPlaylistPosition
* 
* @returns Integer
* @param Integer $InstanceID
*/

function WAC_GetPlaylistPosition( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WAC_GetPlaylistPosition( $InstanceID );
	return $result;
}

/**
* WAC_GetPlaylistTitle
* 
* @returns String
* @param Integer $InstanceID
* @param Integer $Position
*/

function WAC_GetPlaylistTitle( $InstanceID,$Position ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WAC_GetPlaylistTitle( $InstanceID,$Position );
	return $result;
}

/**
* WAC_Next
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function WAC_Next( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WAC_Next( $InstanceID );
	return $result;
}

/**
* WAC_Pause
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function WAC_Pause( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WAC_Pause( $InstanceID );
	return $result;
}

/**
* WAC_Play
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function WAC_Play( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WAC_Play( $InstanceID );
	return $result;
}

/**
* WAC_PlayFile
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Filename
*/

function WAC_PlayFile( $InstanceID,$Filename ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WAC_PlayFile( $InstanceID,$Filename );
	return $result;
}

/**
* WAC_Prev
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function WAC_Prev( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WAC_Prev( $InstanceID );
	return $result;
}

/**
* WAC_SetPlaylistPosition
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Position
*/

function WAC_SetPlaylistPosition( $InstanceID,$Position ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WAC_SetPlaylistPosition( $InstanceID,$Position );
	return $result;
}

/**
* WAC_SetPosition
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Seconds
*/

function WAC_SetPosition( $InstanceID,$Seconds ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WAC_SetPosition( $InstanceID,$Seconds );
	return $result;
}

/**
* WAC_SetRepeat
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Boolean $DoRepeat
*/

function WAC_SetRepeat( $InstanceID,$DoRepeat ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WAC_SetRepeat( $InstanceID,$DoRepeat );
	return $result;
}

/**
* WAC_SetShuffle
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Boolean $DoShuffle
*/

function WAC_SetShuffle( $InstanceID,$DoShuffle ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WAC_SetShuffle( $InstanceID,$DoShuffle );
	return $result;
}

/**
* WAC_SetVolume
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Volume
*/

function WAC_SetVolume( $InstanceID,$Volume ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WAC_SetVolume( $InstanceID,$Volume );
	return $result;
}

/**
* WAC_Stop
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function WAC_Stop( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WAC_Stop( $InstanceID );
	return $result;
}

/**
* WDE1_ReInitEvent
* 
* @returns Array
* @param Integer $InstanceID
*/

function WDE1_ReInitEvent( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WDE1_ReInitEvent( $InstanceID );
	return $result;
}

/**
* WDE1_SendDataToChildren
* 
* @returns Array
* @param Integer $InstanceID
* @param Array $Data
*/

function WDE1_SendDataToChildren( $InstanceID,$Data ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WDE1_SendDataToChildren( $InstanceID,$Data );
	return $result;
}

/**
* WDE1_SendDataToParent
* 
* @returns Array
* @param Integer $InstanceID
* @param Array $Data
*/

function WDE1_SendDataToParent( $InstanceID,$Data ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WDE1_SendDataToParent( $InstanceID,$Data );
	return $result;
}

/**
* WDE1_SetRainPerCount
* 
* @returns Array
* @param Integer $InstanceID
* @param Array $rainpercount
*/

function WDE1_SetRainPerCount( $InstanceID,$rainpercount ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WDE1_SetRainPerCount( $InstanceID,$rainpercount );
	return $result;
}

/**
* WFC_AddItem
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $ID
* @param String $ClassName
* @param String $Configuration
* @param String $ParentID
*/

function WFC_AddItem( $InstanceID,$ID,$ClassName,$Configuration,$ParentID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_AddItem( $InstanceID,$ID,$ClassName,$Configuration,$ParentID );
	return $result;
}

/**
* WFC_AudioNotification
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Title
* @param Integer $MediaID
*/

function WFC_AudioNotification( $InstanceID,$Title,$MediaID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_AudioNotification( $InstanceID,$Title,$MediaID );
	return $result;
}

/**
* WFC_DeleteItem
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $ID
*/

function WFC_DeleteItem( $InstanceID,$ID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_DeleteItem( $InstanceID,$ID );
	return $result;
}

/**
* WFC_Execute
* 
* @returns String
* @param Integer $InstanceID
* @param Integer $ActionID
* @param Integer $TargetID
* @param Array $Value
*/

function WFC_Execute( $InstanceID,$ActionID,$TargetID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_Execute( $InstanceID,$ActionID,$TargetID,$Value );
	return $result;
}

/**
* WFC_GetAggregatedValues
* 
* @returns Variant
* @param Integer $InstanceID
* @param Integer $VariableID
* @param integer $AggregationSpan
*   enum[0=agHour, 1=agDay, 2=agWeek, 3=agMonth, 4=agYear, 5=ag5Minutes, 6=ag1Minute, 7=agChanges]
* @param Integer $StartTime
* @param Integer $EndTime
* @param Integer $Limit
*/

function WFC_GetAggregatedValues( $InstanceID,$VariableID,$AggregationSpan,$StartTime,$EndTime,$Limit ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_GetAggregatedValues( $InstanceID,$VariableID,$AggregationSpan,$StartTime,$EndTime,$Limit );
	return $result;
}

/**
* WFC_GetItems
* 
* @returns Variant
* @param Integer $InstanceID
*/

function WFC_GetItems( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_GetItems( $InstanceID );
	return $result;
}

/**
* WFC_GetLoggedValues
* 
* @returns Variant
* @param Integer $InstanceID
* @param Integer $VariableID
* @param Integer $StartTime
* @param Integer $EndTime
* @param Integer $Limit
*/

function WFC_GetLoggedValues( $InstanceID,$VariableID,$StartTime,$EndTime,$Limit ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_GetLoggedValues( $InstanceID,$VariableID,$StartTime,$EndTime,$Limit );
	return $result;
}

/**
* WFC_GetSnapshot
* 
* @returns String
* @param Integer $InstanceID
*/

function WFC_GetSnapshot( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_GetSnapshot( $InstanceID );
	return $result;
}

/**
* WFC_GetSnapshotChanges
* 
* @returns String
* @param Integer $InstanceID
* @param Integer $LastTimeStamp
*/

function WFC_GetSnapshotChanges( $InstanceID,$LastTimeStamp ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_GetSnapshotChanges( $InstanceID,$LastTimeStamp );
	return $result;
}

/**
* WFC_GetSnapshotChangesEx
* 
* @returns String
* @param Integer $InstanceID
* @param Integer $CategoryID
* @param Integer $LastTimeStamp
*/

function WFC_GetSnapshotChangesEx( $InstanceID,$CategoryID,$LastTimeStamp ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_GetSnapshotChangesEx( $InstanceID,$CategoryID,$LastTimeStamp );
	return $result;
}

/**
* WFC_GetSnapshotEx
* 
* @returns String
* @param Integer $InstanceID
* @param Integer $CategoryID
*/

function WFC_GetSnapshotEx( $InstanceID,$CategoryID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_GetSnapshotEx( $InstanceID,$CategoryID );
	return $result;
}

/**
* WFC_PushNotification
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Title
* @param String $Text
* @param String $Sound
* @param Integer $TargetID
*/

function WFC_PushNotification( $InstanceID,$Title,$Text,$Sound,$TargetID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_PushNotification( $InstanceID,$Title,$Text,$Sound,$TargetID );
	return $result;
}

/**
* WFC_RegisterPNS
* 
* @returns String
* @param Integer $InstanceID
* @param String $Token
* @param String $Provider
* @param String $DeviceID
* @param String $DeviceName
*/

function WFC_RegisterPNS( $InstanceID,$Token,$Provider,$DeviceID,$DeviceName ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_RegisterPNS( $InstanceID,$Token,$Provider,$DeviceID,$DeviceName );
	return $result;
}

/**
* WFC_Reload
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function WFC_Reload( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_Reload( $InstanceID );
	return $result;
}

/**
* WFC_RenderChart
* 
* @returns String
* @param Integer $InstanceID
* @param Integer $ObjectID
* @param Integer $StartTime
* @param integer $TimeSpan
*   enum[0=tsHour, 1=tsDay, 2=tsWeek, 3=tsMonth, 4=tsYear, 5=tsDecade]
* @param Boolean $IsHD
* @param Boolean $IsExtrema
* @param Boolean $IsDyn
* @param Integer $Width
* @param Integer $Height
*/

function WFC_RenderChart( $InstanceID,$ObjectID,$StartTime,$TimeSpan,$IsHD,$IsExtrema,$IsDyn,$Width,$Height ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_RenderChart( $InstanceID,$ObjectID,$StartTime,$TimeSpan,$IsHD,$IsExtrema,$IsDyn,$Width,$Height );
	return $result;
}

/**
* WFC_SendNotification
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Title
* @param String $Text
* @param String $Icon
* @param Integer $Timeout
*/

function WFC_SendNotification( $InstanceID,$Title,$Text,$Icon,$Timeout ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_SendNotification( $InstanceID,$Title,$Text,$Icon,$Timeout );
	return $result;
}

/**
* WFC_SendPopup
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Title
* @param String $Text
*/

function WFC_SendPopup( $InstanceID,$Title,$Text ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_SendPopup( $InstanceID,$Title,$Text );
	return $result;
}

/**
* WFC_SetItems
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Items
*/

function WFC_SetItems( $InstanceID,$Items ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_SetItems( $InstanceID,$Items );
	return $result;
}

/**
* WFC_SwitchPage
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $PageName
*/

function WFC_SwitchPage( $InstanceID,$PageName ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_SwitchPage( $InstanceID,$PageName );
	return $result;
}

/**
* WFC_UpdateConfiguration
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $ID
* @param String $Configuration
*/

function WFC_UpdateConfiguration( $InstanceID,$ID,$Configuration ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_UpdateConfiguration( $InstanceID,$ID,$Configuration );
	return $result;
}

/**
* WFC_UpdateParentID
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $ID
* @param String $ParentID
*/

function WFC_UpdateParentID( $InstanceID,$ID,$ParentID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_UpdateParentID( $InstanceID,$ID,$ParentID );
	return $result;
}

/**
* WFC_UpdatePosition
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $ID
* @param Integer $Position
*/

function WFC_UpdatePosition( $InstanceID,$ID,$Position ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_UpdatePosition( $InstanceID,$ID,$Position );
	return $result;
}

/**
* WFC_UpdateVisibility
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $ID
* @param Boolean $Visible
*/

function WFC_UpdateVisibility( $InstanceID,$ID,$Visible ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_UpdateVisibility( $InstanceID,$ID,$Visible );
	return $result;
}

/**
* WS300PC_GetHistoryCount
* 
* @returns Array
* @param Integer $InstanceID
*/

function WS300PC_GetHistoryCount( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WS300PC_GetHistoryCount( $InstanceID );
	return $result;
}

/**
* WS300PC_GetVersion
* 
* @returns Array
* @param Integer $InstanceID
*/

function WS300PC_GetVersion( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WS300PC_GetVersion( $InstanceID );
	return $result;
}

/**
* WS300PC_ReInitEvent
* 
* @returns Array
* @param Integer $InstanceID
*/

function WS300PC_ReInitEvent( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WS300PC_ReInitEvent( $InstanceID );
	return $result;
}

/**
* WS300PC_ReadCurrentRecord
* 
* @returns Array
* @param Integer $InstanceID
*/

function WS300PC_ReadCurrentRecord( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WS300PC_ReadCurrentRecord( $InstanceID );
	return $result;
}

/**
* WS300PC_ReadNextRecord
* 
* @returns Array
* @param Integer $InstanceID
*/

function WS300PC_ReadNextRecord( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WS300PC_ReadNextRecord( $InstanceID );
	return $result;
}

/**
* WS300PC_SendDataToChildren
* 
* @returns Array
* @param Integer $InstanceID
* @param Array $Data
*/

function WS300PC_SendDataToChildren( $InstanceID,$Data ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WS300PC_SendDataToChildren( $InstanceID,$Data );
	return $result;
}

/**
* WS300PC_SendDataToParent
* 
* @returns Array
* @param Integer $InstanceID
* @param Array $Data
*/

function WS300PC_SendDataToParent( $InstanceID,$Data ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WS300PC_SendDataToParent( $InstanceID,$Data );
	return $result;
}

/**
* WS300PC_SetHistoryCount
* 
* @returns Array
* @param Integer $InstanceID
* @param Array $val
*/

function WS300PC_SetHistoryCount( $InstanceID,$val ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WS300PC_SetHistoryCount( $InstanceID,$val );
	return $result;
}

/**
* WS300PC_UpdateEvent
* 
* @returns Array
* @param Integer $InstanceID
*/

function WS300PC_UpdateEvent( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WS300PC_UpdateEvent( $InstanceID );
	return $result;
}

/**
* WS300PC_WriteConfig
* 
* @returns Array
* @param Integer $InstanceID
*/

function WS300PC_WriteConfig( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WS300PC_WriteConfig( $InstanceID );
	return $result;
}

/**
* WUE_ReInitEvent
* 
* @returns Array
* @param Integer $InstanceID
*/

function WUE_ReInitEvent( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WUE_ReInitEvent( $InstanceID );
	return $result;
}

/**
* WUE_SendDataToParent
* 
* @returns Array
* @param Integer $InstanceID
* @param Array $Data
*/

function WUE_SendDataToParent( $InstanceID,$Data ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WUE_SendDataToParent( $InstanceID,$Data );
	return $result;
}

/**
* WUE_SetRainPerCount
* 
* @returns Array
* @param Integer $InstanceID
* @param Array $rainpercount
*/

function WUE_SetRainPerCount( $InstanceID,$rainpercount ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WUE_SetRainPerCount( $InstanceID,$rainpercount );
	return $result;
}

/**
* WWW_UpdatePage
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function WWW_UpdatePage( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WWW_UpdatePage( $InstanceID );
	return $result;
}

/**
* WinLIRC_SendOnce
* 
* @returns Boolean
* @param Integer $InstanceID
* @param String $Remote
* @param String $Button
*/

function WinLIRC_SendOnce( $InstanceID,$Remote,$Button ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WinLIRC_SendOnce( $InstanceID,$Remote,$Button );
	return $result;
}

/**
* WuT_SwitchMode
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Boolean $DeviceOn
*/

function WuT_SwitchMode( $InstanceID,$DeviceOn ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WuT_SwitchMode( $InstanceID,$DeviceOn );
	return $result;
}

/**
* WuT_UpdateValue
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function WuT_UpdateValue( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WuT_UpdateValue( $InstanceID );
	return $result;
}

/**
* WuT_UpdateValues
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function WuT_UpdateValues( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WuT_UpdateValues( $InstanceID );
	return $result;
}

/**
* XBee_SendBuffer
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $DestinationDevice
* @param String $Buffer
*/

function XBee_SendBuffer( $InstanceID,$DestinationDevice,$Buffer ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->XBee_SendBuffer( $InstanceID,$DestinationDevice,$Buffer );
	return $result;
}

/**
* XBee_SendCommand
* 
* @returns String
* @param Integer $InstanceID
* @param String $Command
*/

function XBee_SendCommand( $InstanceID,$Command ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->XBee_SendCommand( $InstanceID,$Command );
	return $result;
}

/**
* ZW_AssociationAddToGroup
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Group
* @param Integer $Node
*/

function ZW_AssociationAddToGroup( $InstanceID,$Group,$Node ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_AssociationAddToGroup( $InstanceID,$Group,$Node );
	return $result;
}

/**
* ZW_AssociationRemoveFromGroup
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Group
* @param Integer $Node
*/

function ZW_AssociationRemoveFromGroup( $InstanceID,$Group,$Node ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_AssociationRemoveFromGroup( $InstanceID,$Group,$Node );
	return $result;
}

/**
* ZW_Basic
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Value
*/

function ZW_Basic( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_Basic( $InstanceID,$Value );
	return $result;
}

/**
* ZW_CheckCapability
* 
* @returns Boolean
* @param Integer $InstanceID
* @param integer $Cap
*   enum[0=zcPrimaryController, 1=zcSecondaryController, 2=zcIsSUC, 3=zcHasSIS]
*/

function ZW_CheckCapability( $InstanceID,$Cap ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_CheckCapability( $InstanceID,$Cap );
	return $result;
}

/**
* ZW_ConfigurationGetValue
* 
* @returns Integer
* @param Integer $InstanceID
* @param Integer $Parameter
*/

function ZW_ConfigurationGetValue( $InstanceID,$Parameter ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_ConfigurationGetValue( $InstanceID,$Parameter );
	return $result;
}

/**
* ZW_ConfigurationResetValue
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Parameter
*/

function ZW_ConfigurationResetValue( $InstanceID,$Parameter ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_ConfigurationResetValue( $InstanceID,$Parameter );
	return $result;
}

/**
* ZW_ConfigurationSetValue
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Parameter
* @param Integer $Value
*/

function ZW_ConfigurationSetValue( $InstanceID,$Parameter,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_ConfigurationSetValue( $InstanceID,$Parameter,$Value );
	return $result;
}

/**
* ZW_ConfigurationSetValueEx
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Parameter
* @param Integer $Size
* @param Integer $Value
*/

function ZW_ConfigurationSetValueEx( $InstanceID,$Parameter,$Size,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_ConfigurationSetValueEx( $InstanceID,$Parameter,$Size,$Value );
	return $result;
}

/**
* ZW_DeleteFailedDevice
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $NodeID
*/

function ZW_DeleteFailedDevice( $InstanceID,$NodeID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_DeleteFailedDevice( $InstanceID,$NodeID );
	return $result;
}

/**
* ZW_DimSet
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Intensity
*/

function ZW_DimSet( $InstanceID,$Intensity ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_DimSet( $InstanceID,$Intensity );
	return $result;
}

/**
* ZW_DimStop
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function ZW_DimStop( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_DimStop( $InstanceID );
	return $result;
}

/**
* ZW_GetCapabilities
* 
* @returns Variant
* @param Integer $InstanceID
*/

function ZW_GetCapabilities( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_GetCapabilities( $InstanceID );
	return $result;
}

/**
* ZW_GetDevices
* 
* @returns Variant
* @param Integer $InstanceID
*/

function ZW_GetDevices( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_GetDevices( $InstanceID );
	return $result;
}

/**
* ZW_GetHomeID
* 
* @returns String
* @param Integer $InstanceID
*/

function ZW_GetHomeID( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_GetHomeID( $InstanceID );
	return $result;
}

/**
* ZW_GetKnownDevices
* 
* @returns Variant
* @param Integer $InstanceID
*/

function ZW_GetKnownDevices( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_GetKnownDevices( $InstanceID );
	return $result;
}

/**
* ZW_GetNodeID
* 
* @returns Integer
* @param Integer $InstanceID
*/

function ZW_GetNodeID( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_GetNodeID( $InstanceID );
	return $result;
}

/**
* ZW_GetSUCID
* 
* @returns Integer
* @param Integer $InstanceID
*/

function ZW_GetSUCID( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_GetSUCID( $InstanceID );
	return $result;
}

/**
* ZW_GetType
* 
* @returns Integer
* @param Integer $InstanceID
*/

function ZW_GetType( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_GetType( $InstanceID );
	return $result;
}

/**
* ZW_GetVersion
* 
* @returns String
* @param Integer $InstanceID
*/

function ZW_GetVersion( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_GetVersion( $InstanceID );
	return $result;
}

/**
* ZW_LockMode
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Boolean $Locked
*/

function ZW_LockMode( $InstanceID,$Locked ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_LockMode( $InstanceID,$Locked );
	return $result;
}

/**
* ZW_MeterReset
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function ZW_MeterReset( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_MeterReset( $InstanceID );
	return $result;
}

/**
* ZW_ProtectionSet
* 
* @returns Boolean
* @param Integer $InstanceID
* @param integer $Mode
*   enum[0=pOff, 1=pLimited, 2=pOn]
*/

function ZW_ProtectionSet( $InstanceID,$Mode ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_ProtectionSet( $InstanceID,$Mode );
	return $result;
}

/**
* ZW_PulseThermostatFanModeSet
* 
* @returns Boolean
* @param Integer $InstanceID
* @param integer $FanMode
*   enum[0=ptfmAuto, 1=ptfmLow, 2=ptfmMedium, 3=ptfmHigh, 4=ptfmOff]
*/

function ZW_PulseThermostatFanModeSet( $InstanceID,$FanMode ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_PulseThermostatFanModeSet( $InstanceID,$FanMode );
	return $result;
}

/**
* ZW_PulseThermostatModeSet
* 
* @returns Boolean
* @param Integer $InstanceID
* @param integer $Mode
*   enum[0=ptmHeat, 1=ptmCool, 2=ptmAutoChangeover]
*/

function ZW_PulseThermostatModeSet( $InstanceID,$Mode ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_PulseThermostatModeSet( $InstanceID,$Mode );
	return $result;
}

/**
* ZW_PulseThermostatPowerModeSet
* 
* @returns Boolean
* @param Integer $InstanceID
* @param integer $PowerMode
*   enum[0=ptpmOff, 1=ptpmNormal, 2=ptpmEconomy]
*/

function ZW_PulseThermostatPowerModeSet( $InstanceID,$PowerMode ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_PulseThermostatPowerModeSet( $InstanceID,$PowerMode );
	return $result;
}

/**
* ZW_PulseThermostatSetPointSet
* 
* @returns Boolean
* @param Integer $InstanceID
* @param integer $SetPoint
*   enum[0=ptspNormalHeat, 1=ptspNormalCool, 2=ptspNormalAuto, 3=ptspEconomyHeat, 4=ptspEconomyCool, 5=ptspEconomyAutoHeat, 6=ptspEconomyAutoCool]
* @param Float $Value
*/

function ZW_PulseThermostatSetPointSet( $InstanceID,$SetPoint,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_PulseThermostatSetPointSet( $InstanceID,$SetPoint,$Value );
	return $result;
}

/**
* ZW_RequestAssociations
* 
* @returns Variant
* @param Integer $InstanceID
*/

function ZW_RequestAssociations( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_RequestAssociations( $InstanceID );
	return $result;
}

/**
* ZW_RequestInfo
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function ZW_RequestInfo( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_RequestInfo( $InstanceID );
	return $result;
}

/**
* ZW_RequestStatus
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function ZW_RequestStatus( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_RequestStatus( $InstanceID );
	return $result;
}

/**
* ZW_RequestVersion
* 
* @returns Variant
* @param Integer $InstanceID
*/

function ZW_RequestVersion( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_RequestVersion( $InstanceID );
	return $result;
}

/**
* ZW_RequestWakeUpInterval
* 
* @returns Variant
* @param Integer $InstanceID
*/

function ZW_RequestWakeUpInterval( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_RequestWakeUpInterval( $InstanceID );
	return $result;
}

/**
* ZW_ResetToDefault
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function ZW_ResetToDefault( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_ResetToDefault( $InstanceID );
	return $result;
}

/**
* ZW_RoutingAssignReturnRoute
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $NodeID
*/

function ZW_RoutingAssignReturnRoute( $InstanceID,$NodeID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_RoutingAssignReturnRoute( $InstanceID,$NodeID );
	return $result;
}

/**
* ZW_RoutingGetNodes
* 
* @returns Variant
* @param Integer $InstanceID
* @param Integer $NodeID
*/

function ZW_RoutingGetNodes( $InstanceID,$NodeID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_RoutingGetNodes( $InstanceID,$NodeID );
	return $result;
}

/**
* ZW_RoutingOptimize
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function ZW_RoutingOptimize( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_RoutingOptimize( $InstanceID );
	return $result;
}

/**
* ZW_RoutingOptimizeNode
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $NodeID
*/

function ZW_RoutingOptimizeNode( $InstanceID,$NodeID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_RoutingOptimizeNode( $InstanceID,$NodeID );
	return $result;
}

/**
* ZW_RoutingTestNode
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $NodeID
*/

function ZW_RoutingTestNode( $InstanceID,$NodeID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_RoutingTestNode( $InstanceID,$NodeID );
	return $result;
}

/**
* ZW_SearchDevices
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function ZW_SearchDevices( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_SearchDevices( $InstanceID );
	return $result;
}

/**
* ZW_SearchMainDevice
* 
* @returns Integer
* @param Integer $InstanceID
*/

function ZW_SearchMainDevice( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_SearchMainDevice( $InstanceID );
	return $result;
}

/**
* ZW_SearchSubDevices
* 
* @returns Variant
* @param Integer $InstanceID
*/

function ZW_SearchSubDevices( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_SearchSubDevices( $InstanceID );
	return $result;
}

/**
* ZW_ShutterMoveDown
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function ZW_ShutterMoveDown( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_ShutterMoveDown( $InstanceID );
	return $result;
}

/**
* ZW_ShutterMoveUp
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function ZW_ShutterMoveUp( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_ShutterMoveUp( $InstanceID );
	return $result;
}

/**
* ZW_ShutterStop
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function ZW_ShutterStop( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_ShutterStop( $InstanceID );
	return $result;
}

/**
* ZW_StartAddDevice
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function ZW_StartAddDevice( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_StartAddDevice( $InstanceID );
	return $result;
}

/**
* ZW_StartAddNewPrimaryController
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function ZW_StartAddNewPrimaryController( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_StartAddNewPrimaryController( $InstanceID );
	return $result;
}

/**
* ZW_StartRemoveDevice
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function ZW_StartRemoveDevice( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_StartRemoveDevice( $InstanceID );
	return $result;
}

/**
* ZW_StopAddDevice
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function ZW_StopAddDevice( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_StopAddDevice( $InstanceID );
	return $result;
}

/**
* ZW_StopAddNewPrimaryController
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function ZW_StopAddNewPrimaryController( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_StopAddNewPrimaryController( $InstanceID );
	return $result;
}

/**
* ZW_StopRemoveDevice
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function ZW_StopRemoveDevice( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_StopRemoveDevice( $InstanceID );
	return $result;
}

/**
* ZW_SwitchMode
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Boolean $DeviceOn
*/

function ZW_SwitchMode( $InstanceID,$DeviceOn ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_SwitchMode( $InstanceID,$DeviceOn );
	return $result;
}

/**
* ZW_ThermostatFanModeSet
* 
* @returns Boolean
* @param Integer $InstanceID
* @param integer $FanMode
*   enum[0=tfmAutoLow, 1=tfmOnLow, 2=tfmAutoHigh, 3=tfmOnHigh]
*/

function ZW_ThermostatFanModeSet( $InstanceID,$FanMode ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_ThermostatFanModeSet( $InstanceID,$FanMode );
	return $result;
}

/**
* ZW_ThermostatModeSet
* 
* @returns Boolean
* @param Integer $InstanceID
* @param integer $Mode
*   enum[0=tmOff, 1=tmHeat, 2=tmCool, 3=tmAuto, 4=tmAuxiliary, 5=tmResume, 6=tmFanOnly, 7=tmFurnace, 8=tmDryAir, 9=tmMoistAir, 10=tmAutoChangeover]
*/

function ZW_ThermostatModeSet( $InstanceID,$Mode ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_ThermostatModeSet( $InstanceID,$Mode );
	return $result;
}

/**
* ZW_ThermostatSetPointSet
* 
* @returns Boolean
* @param Integer $InstanceID
* @param integer $SetPoint
*   enum[0=tspInvalid, 1=tspHeating, 2=tspCooling, 3=tspFurnace, 4=tspDryAir, 5=tspMoistAir, 6=tspAutoChangeover]
* @param Float $Value
*/

function ZW_ThermostatSetPointSet( $InstanceID,$SetPoint,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_ThermostatSetPointSet( $InstanceID,$SetPoint,$Value );
	return $result;
}

/**
* ZW_WakeUpComplete
* 
* @returns Boolean
* @param Integer $InstanceID
*/

function ZW_WakeUpComplete( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_WakeUpComplete( $InstanceID );
	return $result;
}

/**
* ZW_WakeUpKeepAlive
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Boolean $KeepAlive
*/

function ZW_WakeUpKeepAlive( $InstanceID,$KeepAlive ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_WakeUpKeepAlive( $InstanceID,$KeepAlive );
	return $result;
}

/**
* ZW_WakeUpSetInterval
* 
* @returns Boolean
* @param Integer $InstanceID
* @param Integer $Seconds
*/

function ZW_WakeUpSetInterval( $InstanceID,$Seconds ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_WakeUpSetInterval( $InstanceID,$Seconds );
	return $result;
}
?>
