<?php

/**
 * @file
 * @brief generated ipsymcon functions wrapper using gen_ips_wrapper.php
 *
 * This wrapper helps you to execute Scripts written for IPSymcon also on other PHP boxes
 * using IPSymcon JSON API. It defines all of known functions and map this to a JSON call
 *
 * @pre All functions are located in ips_wrapper.php. You need the class file IPS_JSON.php as well. 
 * @copyright Thomas Dressler 2013-2016
 * @version 0.6 (gen_ips_wrapper.php)
 * @version 4.00 (IPSymcon)
 * @date 2016-05-08 (generated)
 * @see http://www.tdressler.net/ipsymcon/funktionsliste.html
 * @see http://www.tdressler.net/ipsymcon/jsonapi.html
 * @see http://www.ip-symcon.de/service/dokumentation/befehlsreferenz/programminformationen/ips-getfunctionlist/
 * 
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
$config=dirname(__FILE__)."/IPS_JSON_config.cfg";
/*
 * host to connect
 */
$host="localhost";
/*
 * API Port to connect (usually 3777 or 82)
 */
$port="82";
/*
 * License user name (eg. email)
 */
$user="lizenz@email.ips";
/*
 * ips password
 */
$password="secret";
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
* @var $rpc
*/
$rpc = new IPS_JSON($url,$user,$password);


/**
* AC_ChangeVariableID
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $OldVariableID
* @param integer $NewVariableID
*/

function AC_ChangeVariableID( $InstanceID,$OldVariableID,$NewVariableID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AC_ChangeVariableID( $InstanceID,$OldVariableID,$NewVariableID );
	return $result;
}

/**
* AC_DeleteVariableData
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $VariableID
* @param integer $StartTime
* @param integer $EndTime
*/

function AC_DeleteVariableData( $InstanceID,$VariableID,$StartTime,$EndTime ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AC_DeleteVariableData( $InstanceID,$VariableID,$StartTime,$EndTime );
	return $result;
}

/**
* AC_GetAggregatedValues
* 
* @returns array
* @param integer $InstanceID
* @param integer $VariableID
* @param integer $AggregationSpan
*   enum[0=agHour, 1=agDay, 2=agWeek, 3=agMonth, 4=agYear, 5=ag5Minutes, 6=ag1Minute, 7=agChanges]
* @param integer $StartTime
* @param integer $EndTime
* @param integer $Limit
*/

function AC_GetAggregatedValues( $InstanceID,$VariableID,$AggregationSpan,$StartTime,$EndTime,$Limit ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AC_GetAggregatedValues( $InstanceID,$VariableID,$AggregationSpan,$StartTime,$EndTime,$Limit );
	return $result;
}

/**
* AC_GetAggregationType
* 
* @returns integer
* @param integer $InstanceID
* @param integer $VariableID
*/

function AC_GetAggregationType( $InstanceID,$VariableID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AC_GetAggregationType( $InstanceID,$VariableID );
	return $result;
}

/**
* AC_GetAggregationVariables
* 
* @returns array
* @param integer $InstanceID
* @param boolean $CalculateStatistics
*/

function AC_GetAggregationVariables( $InstanceID,$CalculateStatistics ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AC_GetAggregationVariables( $InstanceID,$CalculateStatistics );
	return $result;
}

/**
* AC_GetGraphStatus
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $VariableID
*/

function AC_GetGraphStatus( $InstanceID,$VariableID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AC_GetGraphStatus( $InstanceID,$VariableID );
	return $result;
}

/**
* AC_GetLoggedValues
* 
* @returns array
* @param integer $InstanceID
* @param integer $VariableID
* @param integer $StartTime
* @param integer $EndTime
* @param integer $Limit
*/

function AC_GetLoggedValues( $InstanceID,$VariableID,$StartTime,$EndTime,$Limit ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AC_GetLoggedValues( $InstanceID,$VariableID,$StartTime,$EndTime,$Limit );
	return $result;
}

/**
* AC_GetLoggingStatus
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $VariableID
*/

function AC_GetLoggingStatus( $InstanceID,$VariableID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AC_GetLoggingStatus( $InstanceID,$VariableID );
	return $result;
}

/**
* AC_ReAggregateVariable
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $VariableID
*/

function AC_ReAggregateVariable( $InstanceID,$VariableID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AC_ReAggregateVariable( $InstanceID,$VariableID );
	return $result;
}

/**
* AC_SetAggregationType
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $VariableID
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
* @returns boolean
* @param integer $InstanceID
* @param integer $VariableID
* @param boolean $Active
*/

function AC_SetGraphStatus( $InstanceID,$VariableID,$Active ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AC_SetGraphStatus( $InstanceID,$VariableID,$Active );
	return $result;
}

/**
* AC_SetLoggingStatus
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $VariableID
* @param boolean $Active
*/

function AC_SetLoggingStatus( $InstanceID,$VariableID,$Active ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AC_SetLoggingStatus( $InstanceID,$VariableID,$Active );
	return $result;
}

/**
* AESGI_RequestCurrentLimit
* 
* @returns boolean
* @param integer $InstanceID
*/

function AESGI_RequestCurrentLimit( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AESGI_RequestCurrentLimit( $InstanceID );
	return $result;
}

/**
* AESGI_RequestErrors
* 
* @returns boolean
* @param integer $InstanceID
*/

function AESGI_RequestErrors( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AESGI_RequestErrors( $InstanceID );
	return $result;
}

/**
* AESGI_RequestPowerReduction
* 
* @returns boolean
* @param integer $InstanceID
*/

function AESGI_RequestPowerReduction( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AESGI_RequestPowerReduction( $InstanceID );
	return $result;
}

/**
* AESGI_RequestRunMode
* 
* @returns boolean
* @param integer $InstanceID
*/

function AESGI_RequestRunMode( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AESGI_RequestRunMode( $InstanceID );
	return $result;
}

/**
* AESGI_RequestStatus
* 
* @returns boolean
* @param integer $InstanceID
*/

function AESGI_RequestStatus( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AESGI_RequestStatus( $InstanceID );
	return $result;
}

/**
* AESGI_RequestType
* 
* @returns boolean
* @param integer $InstanceID
*/

function AESGI_RequestType( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AESGI_RequestType( $InstanceID );
	return $result;
}

/**
* AESGI_SetCurrentLimit
* 
* @returns boolean
* @param integer $InstanceID
* @param float $Limit
*/

function AESGI_SetCurrentLimit( $InstanceID,$Limit ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AESGI_SetCurrentLimit( $InstanceID,$Limit );
	return $result;
}

/**
* AESGI_SetPowerReduction
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Percent
*/

function AESGI_SetPowerReduction( $InstanceID,$Percent ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AESGI_SetPowerReduction( $InstanceID,$Percent );
	return $result;
}

/**
* AESGI_SetRunMode
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Mode
* @param float $PowerLimit
*/

function AESGI_SetRunMode( $InstanceID,$Mode,$PowerLimit ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AESGI_SetRunMode( $InstanceID,$Mode,$PowerLimit );
	return $result;
}

/**
* AHA_Query
* 
* @returns variant
* @param integer $InstanceID
*/

function AHA_Query( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AHA_Query( $InstanceID );
	return $result;
}

/**
* AHA_SwitchMode
* 
* @returns variant
* @param integer $InstanceID
* @param variant $ain
* @param variant $val
*/

function AHA_SwitchMode( $InstanceID,$ain,$val ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AHA_SwitchMode( $InstanceID,$ain,$val );
	return $result;
}

/**
* AHA_UpdateEvent
* 
* @returns variant
* @param integer $InstanceID
*/

function AHA_UpdateEvent( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AHA_UpdateEvent( $InstanceID );
	return $result;
}

/**
* ALL_ReadConfiguration
* 
* @returns boolean
* @param integer $InstanceID
*/

function ALL_ReadConfiguration( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ALL_ReadConfiguration( $InstanceID );
	return $result;
}

/**
* ALL_SwitchActor
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $ChannelID
* @param boolean $DeviceOn
*/

function ALL_SwitchActor( $InstanceID,$ChannelID,$DeviceOn ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ALL_SwitchActor( $InstanceID,$ChannelID,$DeviceOn );
	return $result;
}

/**
* ALL_SwitchMode
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $DeviceOn
*/

function ALL_SwitchMode( $InstanceID,$DeviceOn ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ALL_SwitchMode( $InstanceID,$DeviceOn );
	return $result;
}

/**
* ALL_UpdateValues
* 
* @returns boolean
* @param integer $InstanceID
*/

function ALL_UpdateValues( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ALL_UpdateValues( $InstanceID );
	return $result;
}

/**
* CC_GetURL
* 
* @returns string
* @param integer $InstanceID
*/

function CC_GetURL( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->CC_GetURL( $InstanceID );
	return $result;
}

/**
* CSCK_SendText
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Text
*/

function CSCK_SendText( $InstanceID,$Text ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->CSCK_SendText( $InstanceID,$Text );
	return $result;
}

/**
* CUL_ReInitEvent
* 
* @returns variant
* @param integer $InstanceID
*/

function CUL_ReInitEvent( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->CUL_ReInitEvent( $InstanceID );
	return $result;
}

/**
* Cutter_ClearBuffer
* 
* @returns boolean
* @param integer $InstanceID
*/

function Cutter_ClearBuffer( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->Cutter_ClearBuffer( $InstanceID );
	return $result;
}

/**
* DMX_FadeChannel
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Channel
* @param integer $Value
* @param float $FadingSeconds
*/

function DMX_FadeChannel( $InstanceID,$Channel,$Value,$FadingSeconds ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DMX_FadeChannel( $InstanceID,$Channel,$Value,$FadingSeconds );
	return $result;
}

/**
* DMX_FadeChannelDelayed
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Channel
* @param integer $Value
* @param float $FadingSeconds
* @param float $DelayedSeconds
*/

function DMX_FadeChannelDelayed( $InstanceID,$Channel,$Value,$FadingSeconds,$DelayedSeconds ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DMX_FadeChannelDelayed( $InstanceID,$Channel,$Value,$FadingSeconds,$DelayedSeconds );
	return $result;
}

/**
* DMX_FadeRGB
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $R
* @param integer $G
* @param integer $B
* @param float $FadingSeconds
*/

function DMX_FadeRGB( $InstanceID,$R,$G,$B,$FadingSeconds ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DMX_FadeRGB( $InstanceID,$R,$G,$B,$FadingSeconds );
	return $result;
}

/**
* DMX_FadeRGBDelayed
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $R
* @param integer $G
* @param integer $B
* @param float $FadingSeconds
* @param float $DelayedSeconds
*/

function DMX_FadeRGBDelayed( $InstanceID,$R,$G,$B,$FadingSeconds,$DelayedSeconds ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DMX_FadeRGBDelayed( $InstanceID,$R,$G,$B,$FadingSeconds,$DelayedSeconds );
	return $result;
}

/**
* DMX_RequestInfo
* 
* @returns boolean
* @param integer $InstanceID
*/

function DMX_RequestInfo( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DMX_RequestInfo( $InstanceID );
	return $result;
}

/**
* DMX_ResetInterface
* 
* @returns boolean
* @param integer $InstanceID
*/

function DMX_ResetInterface( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DMX_ResetInterface( $InstanceID );
	return $result;
}

/**
* DMX_SetBlackOut
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $BlackoutOn
*/

function DMX_SetBlackOut( $InstanceID,$BlackoutOn ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DMX_SetBlackOut( $InstanceID,$BlackoutOn );
	return $result;
}

/**
* DMX_SetChannel
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Channel
* @param integer $Value
*/

function DMX_SetChannel( $InstanceID,$Channel,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DMX_SetChannel( $InstanceID,$Channel,$Value );
	return $result;
}

/**
* DMX_SetRGB
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $R
* @param integer $G
* @param integer $B
*/

function DMX_SetRGB( $InstanceID,$R,$G,$B ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DMX_SetRGB( $InstanceID,$R,$G,$B );
	return $result;
}

/**
* DS_CallScene
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $SceneID
*/

function DS_CallScene( $InstanceID,$SceneID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DS_CallScene( $InstanceID,$SceneID );
	return $result;
}

/**
* DS_DimSet
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Intensity
*/

function DS_DimSet( $InstanceID,$Intensity ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DS_DimSet( $InstanceID,$Intensity );
	return $result;
}

/**
* DS_GetKnownDevices
* 
* @returns array
* @param integer $InstanceID
*/

function DS_GetKnownDevices( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DS_GetKnownDevices( $InstanceID );
	return $result;
}

/**
* DS_RequestStatus
* 
* @returns boolean
* @param integer $InstanceID
*/

function DS_RequestStatus( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DS_RequestStatus( $InstanceID );
	return $result;
}

/**
* DS_RequestToken
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Username
* @param string $Password
*/

function DS_RequestToken( $InstanceID,$Username,$Password ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DS_RequestToken( $InstanceID,$Username,$Password );
	return $result;
}

/**
* DS_SaveScene
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $SceneID
*/

function DS_SaveScene( $InstanceID,$SceneID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DS_SaveScene( $InstanceID,$SceneID );
	return $result;
}

/**
* DS_ShutterMove
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Position
*/

function DS_ShutterMove( $InstanceID,$Position ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DS_ShutterMove( $InstanceID,$Position );
	return $result;
}

/**
* DS_ShutterMoveDown
* 
* @returns boolean
* @param integer $InstanceID
*/

function DS_ShutterMoveDown( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DS_ShutterMoveDown( $InstanceID );
	return $result;
}

/**
* DS_ShutterMoveUp
* 
* @returns boolean
* @param integer $InstanceID
*/

function DS_ShutterMoveUp( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DS_ShutterMoveUp( $InstanceID );
	return $result;
}

/**
* DS_ShutterStop
* 
* @returns boolean
* @param integer $InstanceID
*/

function DS_ShutterStop( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DS_ShutterStop( $InstanceID );
	return $result;
}

/**
* DS_SwitchMode
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $DeviceOn
*/

function DS_SwitchMode( $InstanceID,$DeviceOn ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DS_SwitchMode( $InstanceID,$DeviceOn );
	return $result;
}

/**
* DS_UndoScene
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $SceneID
*/

function DS_UndoScene( $InstanceID,$SceneID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DS_UndoScene( $InstanceID,$SceneID );
	return $result;
}

/**
* EIB_Char
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Value
*/

function EIB_Char( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_Char( $InstanceID,$Value );
	return $result;
}

/**
* EIB_Counter16bit
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
*/

function EIB_Counter16bit( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_Counter16bit( $InstanceID,$Value );
	return $result;
}

/**
* EIB_Counter32bit
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
*/

function EIB_Counter32bit( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_Counter32bit( $InstanceID,$Value );
	return $result;
}

/**
* EIB_Counter8bit
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
*/

function EIB_Counter8bit( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_Counter8bit( $InstanceID,$Value );
	return $result;
}

/**
* EIB_Date
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Value
*/

function EIB_Date( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_Date( $InstanceID,$Value );
	return $result;
}

/**
* EIB_DimControl
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
*/

function EIB_DimControl( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_DimControl( $InstanceID,$Value );
	return $result;
}

/**
* EIB_DimValue
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
*/

function EIB_DimValue( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_DimValue( $InstanceID,$Value );
	return $result;
}

/**
* EIB_DriveBladeValue
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
*/

function EIB_DriveBladeValue( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_DriveBladeValue( $InstanceID,$Value );
	return $result;
}

/**
* EIB_DriveMove
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $Value
*/

function EIB_DriveMove( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_DriveMove( $InstanceID,$Value );
	return $result;
}

/**
* EIB_DriveShutterValue
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
*/

function EIB_DriveShutterValue( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_DriveShutterValue( $InstanceID,$Value );
	return $result;
}

/**
* EIB_DriveStep
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $Value
*/

function EIB_DriveStep( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_DriveStep( $InstanceID,$Value );
	return $result;
}

/**
* EIB_FloatValue
* 
* @returns boolean
* @param integer $InstanceID
* @param float $Value
*/

function EIB_FloatValue( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_FloatValue( $InstanceID,$Value );
	return $result;
}

/**
* EIB_GetKnownDevices
* 
* @returns array
* @param integer $InstanceID
*/

function EIB_GetKnownDevices( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_GetKnownDevices( $InstanceID );
	return $result;
}

/**
* EIB_Move
* 
* @returns boolean
* @param integer $InstanceID
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
* @returns boolean
* @param integer $InstanceID
* @param integer $Position
*/

function EIB_Position( $InstanceID,$Position ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_Position( $InstanceID,$Position );
	return $result;
}

/**
* EIB_PriorityControl
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
*/

function EIB_PriorityControl( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_PriorityControl( $InstanceID,$Value );
	return $result;
}

/**
* EIB_PriorityPosition
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $Value
*/

function EIB_PriorityPosition( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_PriorityPosition( $InstanceID,$Value );
	return $result;
}

/**
* EIB_RequestInfo
* 
* @returns boolean
* @param integer $InstanceID
*/

function EIB_RequestInfo( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_RequestInfo( $InstanceID );
	return $result;
}

/**
* EIB_RequestStatus
* 
* @returns boolean
* @param integer $InstanceID
*/

function EIB_RequestStatus( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_RequestStatus( $InstanceID );
	return $result;
}

/**
* EIB_Scale
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
*/

function EIB_Scale( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_Scale( $InstanceID,$Value );
	return $result;
}

/**
* EIB_SearchDevices
* 
* @returns boolean
* @param integer $InstanceID
*/

function EIB_SearchDevices( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_SearchDevices( $InstanceID );
	return $result;
}

/**
* EIB_SetRGB
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $R
* @param integer $G
* @param integer $B
*/

function EIB_SetRGB( $InstanceID,$R,$G,$B ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_SetRGB( $InstanceID,$R,$G,$B );
	return $result;
}

/**
* EIB_SetRGBW
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $R
* @param integer $G
* @param integer $B
* @param integer $W
*/

function EIB_SetRGBW( $InstanceID,$R,$G,$B,$W ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_SetRGBW( $InstanceID,$R,$G,$B,$W );
	return $result;
}

/**
* EIB_Str
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Value
*/

function EIB_Str( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_Str( $InstanceID,$Value );
	return $result;
}

/**
* EIB_Switch
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $Value
*/

function EIB_Switch( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_Switch( $InstanceID,$Value );
	return $result;
}

/**
* EIB_Time
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Value
*/

function EIB_Time( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_Time( $InstanceID,$Value );
	return $result;
}

/**
* EIB_UploadDataPointFile
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Content
*/

function EIB_UploadDataPointFile( $InstanceID,$Content ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_UploadDataPointFile( $InstanceID,$Content );
	return $result;
}

/**
* EIB_Value
* 
* @returns boolean
* @param integer $InstanceID
* @param float $Value
*/

function EIB_Value( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_Value( $InstanceID,$Value );
	return $result;
}

/**
* END_SendDataToParent
* 
* @returns variant
* @param integer $InstanceID
* @param variant $Data
*/

function END_SendDataToParent( $InstanceID,$Data ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->END_SendDataToParent( $InstanceID,$Data );
	return $result;
}

/**
* ENO_DimSet
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Intensity
*/

function ENO_DimSet( $InstanceID,$Intensity ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_DimSet( $InstanceID,$Intensity );
	return $result;
}

/**
* ENO_SendCST
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $value
*/

function ENO_SendCST( $InstanceID,$value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SendCST( $InstanceID,$value );
	return $result;
}

/**
* ENO_SendCTM
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $value
*/

function ENO_SendCTM( $InstanceID,$value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SendCTM( $InstanceID,$value );
	return $result;
}

/**
* ENO_SendCV
* 
* @returns boolean
* @param integer $InstanceID
* @param float $value
*/

function ENO_SendCV( $InstanceID,$value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SendCV( $InstanceID,$value );
	return $result;
}

/**
* ENO_SendERH
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $value
*/

function ENO_SendERH( $InstanceID,$value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SendERH( $InstanceID,$value );
	return $result;
}

/**
* ENO_SendFANOR
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $value
*/

function ENO_SendFANOR( $InstanceID,$value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SendFANOR( $InstanceID,$value );
	return $result;
}

/**
* ENO_SendFANOR_2
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $value
*/

function ENO_SendFANOR_2( $InstanceID,$value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SendFANOR_2( $InstanceID,$value );
	return $result;
}

/**
* ENO_SendLearn
* 
* @returns boolean
* @param integer $InstanceID
*/

function ENO_SendLearn( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SendLearn( $InstanceID );
	return $result;
}

/**
* ENO_SendRO
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $value
*/

function ENO_SendRO( $InstanceID,$value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SendRO( $InstanceID,$value );
	return $result;
}

/**
* ENO_SendSPS
* 
* @returns boolean
* @param integer $InstanceID
* @param float $value
*/

function ENO_SendSPS( $InstanceID,$value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SendSPS( $InstanceID,$value );
	return $result;
}

/**
* ENO_SetActiveMessage
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Message
*/

function ENO_SetActiveMessage( $InstanceID,$Message ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SetActiveMessage( $InstanceID,$Message );
	return $result;
}

/**
* ENO_SetButtonLock
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $Active
*/

function ENO_SetButtonLock( $InstanceID,$Active ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SetButtonLock( $InstanceID,$Active );
	return $result;
}

/**
* ENO_SetFanStage
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $FanStage
*/

function ENO_SetFanStage( $InstanceID,$FanStage ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SetFanStage( $InstanceID,$FanStage );
	return $result;
}

/**
* ENO_SetIntensity
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $DeviceOn
* @param integer $Intensity
*/

function ENO_SetIntensity( $InstanceID,$DeviceOn,$Intensity ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SetIntensity( $InstanceID,$DeviceOn,$Intensity );
	return $result;
}

/**
* ENO_SetLockFanStage
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $Locked
*/

function ENO_SetLockFanStage( $InstanceID,$Locked ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SetLockFanStage( $InstanceID,$Locked );
	return $result;
}

/**
* ENO_SetLockRoomOccupancy
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $Locked
*/

function ENO_SetLockRoomOccupancy( $InstanceID,$Locked ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SetLockRoomOccupancy( $InstanceID,$Locked );
	return $result;
}

/**
* ENO_SetMeasureTemperature
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $Active
*/

function ENO_SetMeasureTemperature( $InstanceID,$Active ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SetMeasureTemperature( $InstanceID,$Active );
	return $result;
}

/**
* ENO_SetMode
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Mode
*/

function ENO_SetMode( $InstanceID,$Mode ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SetMode( $InstanceID,$Mode );
	return $result;
}

/**
* ENO_SetPosition
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Position
*/

function ENO_SetPosition( $InstanceID,$Position ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SetPosition( $InstanceID,$Position );
	return $result;
}

/**
* ENO_SetRoomOccupancy
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $Occupied
*/

function ENO_SetRoomOccupancy( $InstanceID,$Occupied ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SetRoomOccupancy( $InstanceID,$Occupied );
	return $result;
}

/**
* ENO_SetTemperature
* 
* @returns boolean
* @param integer $InstanceID
* @param float $Temperature
*/

function ENO_SetTemperature( $InstanceID,$Temperature ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SetTemperature( $InstanceID,$Temperature );
	return $result;
}

/**
* ENO_SetTemperature1
* 
* @returns boolean
* @param integer $InstanceID
* @param float $Temperature
*/

function ENO_SetTemperature1( $InstanceID,$Temperature ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SetTemperature1( $InstanceID,$Temperature );
	return $result;
}

/**
* ENO_ShutterMoveDown
* 
* @returns boolean
* @param integer $InstanceID
*/

function ENO_ShutterMoveDown( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_ShutterMoveDown( $InstanceID );
	return $result;
}

/**
* ENO_ShutterMoveUp
* 
* @returns boolean
* @param integer $InstanceID
*/

function ENO_ShutterMoveUp( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_ShutterMoveUp( $InstanceID );
	return $result;
}

/**
* ENO_ShutterStop
* 
* @returns boolean
* @param integer $InstanceID
*/

function ENO_ShutterStop( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_ShutterStop( $InstanceID );
	return $result;
}

/**
* ENO_SwitchMode
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $DeviceOn
*/

function ENO_SwitchMode( $InstanceID,$DeviceOn ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SwitchMode( $InstanceID,$DeviceOn );
	return $result;
}

/**
* ENO_SwitchModeEx
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $DeviceOn
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
* @returns boolean
* @param integer $InstanceID
*/

function FHT_RequestData( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->FHT_RequestData( $InstanceID );
	return $result;
}

/**
* FHT_SetDay
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
*/

function FHT_SetDay( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->FHT_SetDay( $InstanceID,$Value );
	return $result;
}

/**
* FHT_SetHour
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
*/

function FHT_SetHour( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->FHT_SetHour( $InstanceID,$Value );
	return $result;
}

/**
* FHT_SetMinute
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
*/

function FHT_SetMinute( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->FHT_SetMinute( $InstanceID,$Value );
	return $result;
}

/**
* FHT_SetMode
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Mode
*/

function FHT_SetMode( $InstanceID,$Mode ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->FHT_SetMode( $InstanceID,$Mode );
	return $result;
}

/**
* FHT_SetMonth
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
*/

function FHT_SetMonth( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->FHT_SetMonth( $InstanceID,$Value );
	return $result;
}

/**
* FHT_SetTemperature
* 
* @returns boolean
* @param integer $InstanceID
* @param float $Temperature
*/

function FHT_SetTemperature( $InstanceID,$Temperature ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->FHT_SetTemperature( $InstanceID,$Temperature );
	return $result;
}

/**
* FHT_SetYear
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
*/

function FHT_SetYear( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->FHT_SetYear( $InstanceID,$Value );
	return $result;
}

/**
* FHZ_GetFHTQueue
* 
* @returns array
* @param integer $InstanceID
*/

function FHZ_GetFHTQueue( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->FHZ_GetFHTQueue( $InstanceID );
	return $result;
}

/**
* FHZ_GetFreeBuffer
* 
* @returns integer
* @param integer $InstanceID
*/

function FHZ_GetFreeBuffer( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->FHZ_GetFreeBuffer( $InstanceID );
	return $result;
}

/**
* FS20_DimDown
* 
* @returns boolean
* @param integer $InstanceID
*/

function FS20_DimDown( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->FS20_DimDown( $InstanceID );
	return $result;
}

/**
* FS20_DimUp
* 
* @returns boolean
* @param integer $InstanceID
*/

function FS20_DimUp( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->FS20_DimUp( $InstanceID );
	return $result;
}

/**
* FS20_SetIntensity
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Intensity
* @param integer $Duration
*/

function FS20_SetIntensity( $InstanceID,$Intensity,$Duration ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->FS20_SetIntensity( $InstanceID,$Intensity,$Duration );
	return $result;
}

/**
* FS20_SwitchDuration
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $DeviceOn
* @param integer $Duration
*/

function FS20_SwitchDuration( $InstanceID,$DeviceOn,$Duration ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->FS20_SwitchDuration( $InstanceID,$DeviceOn,$Duration );
	return $result;
}

/**
* FS20_SwitchMode
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $DeviceOn
*/

function FS20_SwitchMode( $InstanceID,$DeviceOn ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->FS20_SwitchMode( $InstanceID,$DeviceOn );
	return $result;
}

/**
* GetValue
* 
* @returns variant
* @param integer $VariableID
*/

function GetValue( $VariableID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->GetValue( $VariableID );
	return $result;
}

/**
* GetValueBoolean
* 
* @returns boolean
* @param integer $VariableID
*/

function GetValueBoolean( $VariableID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->GetValueBoolean( $VariableID );
	return $result;
}

/**
* GetValueFloat
* 
* @returns float
* @param integer $VariableID
*/

function GetValueFloat( $VariableID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->GetValueFloat( $VariableID );
	return $result;
}

/**
* GetValueFormatted
* 
* @returns string
* @param integer $VariableID
*/

function GetValueFormatted( $VariableID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->GetValueFormatted( $VariableID );
	return $result;
}

/**
* GetValueInteger
* 
* @returns integer
* @param integer $VariableID
*/

function GetValueInteger( $VariableID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->GetValueInteger( $VariableID );
	return $result;
}

/**
* GetValueString
* 
* @returns string
* @param integer $VariableID
*/

function GetValueString( $VariableID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->GetValueString( $VariableID );
	return $result;
}

/**
* HC_TargetValue
* 
* @returns boolean
* @param integer $InstanceID
* @param float $Value
*/

function HC_TargetValue( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HC_TargetValue( $InstanceID,$Value );
	return $result;
}

/**
* HID_SendEvent
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $ReportID
* @param string $Text
*/

function HID_SendEvent( $InstanceID,$ReportID,$Text ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HID_SendEvent( $InstanceID,$ReportID,$Text );
	return $result;
}

/**
* HMS_ReleaseFI
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Delay
*/

function HMS_ReleaseFI( $InstanceID,$Delay ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HMS_ReleaseFI( $InstanceID,$Delay );
	return $result;
}

/**
* HM_GetKnownDevices
* 
* @returns array
* @param integer $InstanceID
*/

function HM_GetKnownDevices( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HM_GetKnownDevices( $InstanceID );
	return $result;
}

/**
* HM_LoadDevices
* 
* @returns boolean
* @param integer $InstanceID
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
* @returns array
* @param integer $InstanceID
*/

function HM_ReadServiceMessages( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HM_ReadServiceMessages( $InstanceID );
	return $result;
}

/**
* HM_RequestStatus
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Parameter
*/

function HM_RequestStatus( $InstanceID,$Parameter ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HM_RequestStatus( $InstanceID,$Parameter );
	return $result;
}

/**
* HM_WriteValueBoolean
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Parameter
* @param boolean $Value
*/

function HM_WriteValueBoolean( $InstanceID,$Parameter,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HM_WriteValueBoolean( $InstanceID,$Parameter,$Value );
	return $result;
}

/**
* HM_WriteValueFloat
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Parameter
* @param float $Value
*/

function HM_WriteValueFloat( $InstanceID,$Parameter,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HM_WriteValueFloat( $InstanceID,$Parameter,$Value );
	return $result;
}

/**
* HM_WriteValueInteger
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Parameter
* @param integer $Value
*/

function HM_WriteValueInteger( $InstanceID,$Parameter,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HM_WriteValueInteger( $InstanceID,$Parameter,$Value );
	return $result;
}

/**
* HM_WriteValueString
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Parameter
* @param string $Value
*/

function HM_WriteValueString( $InstanceID,$Parameter,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HM_WriteValueString( $InstanceID,$Parameter,$Value );
	return $result;
}

/**
* IG_UpdateImage
* 
* @returns boolean
* @param integer $InstanceID
*/

function IG_UpdateImage( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IG_UpdateImage( $InstanceID );
	return $result;
}

/**
* IMAP_GetCachedMails
* 
* @returns array
* @param integer $InstanceID
*/

function IMAP_GetCachedMails( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IMAP_GetCachedMails( $InstanceID );
	return $result;
}

/**
* IMAP_GetMailEx
* 
* @returns array
* @param integer $InstanceID
* @param string $UID
*/

function IMAP_GetMailEx( $InstanceID,$UID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IMAP_GetMailEx( $InstanceID,$UID );
	return $result;
}

/**
* IMAP_UpdateCache
* 
* @returns boolean
* @param integer $InstanceID
*/

function IMAP_UpdateCache( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IMAP_UpdateCache( $InstanceID );
	return $result;
}

/**
* IPS_ApplyChanges
* 
* @returns boolean
* @param integer $InstanceID
*/

function IPS_ApplyChanges( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_ApplyChanges( $InstanceID );
	return $result;
}

/**
* IPS_CategoryExists
* 
* @returns boolean
* @param integer $CategoryID
*/

function IPS_CategoryExists( $CategoryID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_CategoryExists( $CategoryID );
	return $result;
}

/**
* IPS_ConnectInstance
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $ParentID
*/

function IPS_ConnectInstance( $InstanceID,$ParentID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_ConnectInstance( $InstanceID,$ParentID );
	return $result;
}

/**
* IPS_CreateCategory
* 
* @returns integer
*/

function IPS_CreateCategory(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_CreateCategory(  );
	return $result;
}

/**
* IPS_CreateEvent
* 
* @returns integer
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
* @returns integer
* @param string $ModuleID
*/

function IPS_CreateInstance( $ModuleID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_CreateInstance( $ModuleID );
	return $result;
}

/**
* IPS_CreateLink
* 
* @returns integer
*/

function IPS_CreateLink(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_CreateLink(  );
	return $result;
}

/**
* IPS_CreateMedia
* 
* @returns integer
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
* @returns integer
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
* @returns integer
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
* @returns boolean
* @param string $ProfileName
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
* @returns boolean
* @param integer $CategoryID
*/

function IPS_DeleteCategory( $CategoryID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_DeleteCategory( $CategoryID );
	return $result;
}

/**
* IPS_DeleteEvent
* 
* @returns boolean
* @param integer $EventID
*/

function IPS_DeleteEvent( $EventID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_DeleteEvent( $EventID );
	return $result;
}

/**
* IPS_DeleteInstance
* 
* @returns boolean
* @param integer $InstanceID
*/

function IPS_DeleteInstance( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_DeleteInstance( $InstanceID );
	return $result;
}

/**
* IPS_DeleteLink
* 
* @returns boolean
* @param integer $LinkID
*/

function IPS_DeleteLink( $LinkID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_DeleteLink( $LinkID );
	return $result;
}

/**
* IPS_DeleteMedia
* 
* @returns boolean
* @param integer $MediaID
* @param boolean $DeleteFile
*/

function IPS_DeleteMedia( $MediaID,$DeleteFile ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_DeleteMedia( $MediaID,$DeleteFile );
	return $result;
}

/**
* IPS_DeleteScript
* 
* @returns boolean
* @param integer $ScriptID
* @param boolean $DeleteFile
*/

function IPS_DeleteScript( $ScriptID,$DeleteFile ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_DeleteScript( $ScriptID,$DeleteFile );
	return $result;
}

/**
* IPS_DeleteVariable
* 
* @returns boolean
* @param integer $VariableID
*/

function IPS_DeleteVariable( $VariableID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_DeleteVariable( $VariableID );
	return $result;
}

/**
* IPS_DeleteVariableProfile
* 
* @returns boolean
* @param string $ProfileName
*/

function IPS_DeleteVariableProfile( $ProfileName ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_DeleteVariableProfile( $ProfileName );
	return $result;
}

/**
* IPS_DisableAction
* 
* @returns boolean
* @param integer $InstanceID
* @param string $VariableIdent
*/

function IPS_DisableAction( $InstanceID,$VariableIdent ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_DisableAction( $InstanceID,$VariableIdent );
	return $result;
}

/**
* IPS_DisableDebug
* 
* @returns boolean
* @param integer $ID
*/

function IPS_DisableDebug( $ID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_DisableDebug( $ID );
	return $result;
}

/**
* IPS_DisconnectInstance
* 
* @returns boolean
* @param integer $InstanceID
*/

function IPS_DisconnectInstance( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_DisconnectInstance( $InstanceID );
	return $result;
}

/**
* IPS_EnableAction
* 
* @returns boolean
* @param integer $InstanceID
* @param string $VariableIdent
*/

function IPS_EnableAction( $InstanceID,$VariableIdent ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_EnableAction( $InstanceID,$VariableIdent );
	return $result;
}

/**
* IPS_EnableDebug
* 
* @returns boolean
* @param integer $ID
* @param integer $Duration
*/

function IPS_EnableDebug( $ID,$Duration ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_EnableDebug( $ID,$Duration );
	return $result;
}

/**
* IPS_EventExists
* 
* @returns boolean
* @param integer $EventID
*/

function IPS_EventExists( $EventID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_EventExists( $EventID );
	return $result;
}

/**
* IPS_Execute
* 
* @returns string
* @param string $Filename
* @param string $Parameter
* @param boolean $ShowWindow
* @param boolean $WaitResult
*/

function IPS_Execute( $Filename,$Parameter,$ShowWindow,$WaitResult ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_Execute( $Filename,$Parameter,$ShowWindow,$WaitResult );
	return $result;
}

/**
* IPS_ExecuteEx
* 
* @returns string
* @param string $Filename
* @param string $Parameter
* @param boolean $ShowWindow
* @param boolean $WaitResult
* @param integer $SessionID
*/

function IPS_ExecuteEx( $Filename,$Parameter,$ShowWindow,$WaitResult,$SessionID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_ExecuteEx( $Filename,$Parameter,$ShowWindow,$WaitResult,$SessionID );
	return $result;
}

/**
* IPS_FunctionExists
* 
* @returns boolean
* @param string $FunctionName
*/

function IPS_FunctionExists( $FunctionName ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_FunctionExists( $FunctionName );
	return $result;
}

/**
* IPS_GetCategory
* 
* @returns array
* @param integer $CategoryID
*/

function IPS_GetCategory( $CategoryID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetCategory( $CategoryID );
	return $result;
}

/**
* IPS_GetCategoryIDByName
* 
* @returns integer
* @param string $Name
* @param integer $ParentID
*/

function IPS_GetCategoryIDByName( $Name,$ParentID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetCategoryIDByName( $Name,$ParentID );
	return $result;
}

/**
* IPS_GetCategoryList
* 
* @returns array
*/

function IPS_GetCategoryList(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetCategoryList(  );
	return $result;
}

/**
* IPS_GetChildrenIDs
* 
* @returns array
* @param integer $ID
*/

function IPS_GetChildrenIDs( $ID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetChildrenIDs( $ID );
	return $result;
}

/**
* IPS_GetCompatibleInstances
* 
* @returns array
* @param integer $InstanceID
*/

function IPS_GetCompatibleInstances( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetCompatibleInstances( $InstanceID );
	return $result;
}

/**
* IPS_GetCompatibleModules
* 
* @returns array
* @param string $ModuleID
*/

function IPS_GetCompatibleModules( $ModuleID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetCompatibleModules( $ModuleID );
	return $result;
}

/**
* IPS_GetConfiguration
* 
* @returns string
* @param integer $InstanceID
*/

function IPS_GetConfiguration( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetConfiguration( $InstanceID );
	return $result;
}

/**
* IPS_GetConfigurationForParent
* 
* @returns string
* @param integer $InstanceID
*/

function IPS_GetConfigurationForParent( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetConfigurationForParent( $InstanceID );
	return $result;
}

/**
* IPS_GetConfigurationForm
* 
* @returns string
* @param integer $InstanceID
*/

function IPS_GetConfigurationForm( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetConfigurationForm( $InstanceID );
	return $result;
}

/**
* IPS_GetDemoExpiration
* 
* @returns integer
*/

function IPS_GetDemoExpiration(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetDemoExpiration(  );
	return $result;
}

/**
* IPS_GetEvent
* 
* @returns array
* @param integer $EventID
*/

function IPS_GetEvent( $EventID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetEvent( $EventID );
	return $result;
}

/**
* IPS_GetEventIDByName
* 
* @returns integer
* @param string $Name
* @param integer $ParentID
*/

function IPS_GetEventIDByName( $Name,$ParentID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetEventIDByName( $Name,$ParentID );
	return $result;
}

/**
* IPS_GetEventList
* 
* @returns array
*/

function IPS_GetEventList(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetEventList(  );
	return $result;
}

/**
* IPS_GetEventListByType
* 
* @returns array
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
* @returns array
* @param string $FunctionName
*/

function IPS_GetFunction( $FunctionName ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetFunction( $FunctionName );
	return $result;
}

/**
* IPS_GetFunctionList
* 
* @returns array
* @param integer $InstanceID
*/

function IPS_GetFunctionList( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetFunctionList( $InstanceID );
	return $result;
}

/**
* IPS_GetFunctionListByModuleID
* 
* @returns array
* @param string $ModuleID
*/

function IPS_GetFunctionListByModuleID( $ModuleID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetFunctionListByModuleID( $ModuleID );
	return $result;
}

/**
* IPS_GetFunctions
* 
* @returns array
* @param array $Parameter
*/

function IPS_GetFunctions( $Parameter ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetFunctions( $Parameter );
	return $result;
}

/**
* IPS_GetFunctionsMap
* 
* @returns array
* @param array $Parameter
*/

function IPS_GetFunctionsMap( $Parameter ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetFunctionsMap( $Parameter );
	return $result;
}

/**
* IPS_GetInstance
* 
* @returns array
* @param integer $InstanceID
*/

function IPS_GetInstance( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetInstance( $InstanceID );
	return $result;
}

/**
* IPS_GetInstanceIDByName
* 
* @returns integer
* @param string $Name
* @param integer $ParentID
*/

function IPS_GetInstanceIDByName( $Name,$ParentID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetInstanceIDByName( $Name,$ParentID );
	return $result;
}

/**
* IPS_GetInstanceList
* 
* @returns array
*/

function IPS_GetInstanceList(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetInstanceList(  );
	return $result;
}

/**
* IPS_GetInstanceListByModuleID
* 
* @returns array
* @param string $ModuleID
*/

function IPS_GetInstanceListByModuleID( $ModuleID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetInstanceListByModuleID( $ModuleID );
	return $result;
}

/**
* IPS_GetInstanceListByModuleType
* 
* @returns array
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
* @returns string
*/

function IPS_GetKernelDir(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetKernelDir(  );
	return $result;
}

/**
* IPS_GetKernelDirEx
* 
* @returns string
*/

function IPS_GetKernelDirEx(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetKernelDirEx(  );
	return $result;
}

/**
* IPS_GetKernelRunlevel
* 
* @returns integer
*/

function IPS_GetKernelRunlevel(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetKernelRunlevel(  );
	return $result;
}

/**
* IPS_GetKernelStartTime
* 
* @returns integer
*/

function IPS_GetKernelStartTime(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetKernelStartTime(  );
	return $result;
}

/**
* IPS_GetKernelVersion
* 
* @returns string
*/

function IPS_GetKernelVersion(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetKernelVersion(  );
	return $result;
}

/**
* IPS_GetLibraries
* 
* @returns array
* @param array $Parameter
*/

function IPS_GetLibraries( $Parameter ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetLibraries( $Parameter );
	return $result;
}

/**
* IPS_GetLibrary
* 
* @returns array
* @param string $LibraryID
*/

function IPS_GetLibrary( $LibraryID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetLibrary( $LibraryID );
	return $result;
}

/**
* IPS_GetLibraryList
* 
* @returns array
*/

function IPS_GetLibraryList(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetLibraryList(  );
	return $result;
}

/**
* IPS_GetLibraryModules
* 
* @returns array
* @param string $LibraryID
*/

function IPS_GetLibraryModules( $LibraryID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetLibraryModules( $LibraryID );
	return $result;
}

/**
* IPS_GetLicensee
* 
* @returns string
*/

function IPS_GetLicensee(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetLicensee(  );
	return $result;
}

/**
* IPS_GetLimitDemo
* 
* @returns integer
*/

function IPS_GetLimitDemo(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetLimitDemo(  );
	return $result;
}

/**
* IPS_GetLimitServer
* 
* @returns string
*/

function IPS_GetLimitServer(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetLimitServer(  );
	return $result;
}

/**
* IPS_GetLimitVariables
* 
* @returns integer
*/

function IPS_GetLimitVariables(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetLimitVariables(  );
	return $result;
}

/**
* IPS_GetLimitWebFront
* 
* @returns integer
*/

function IPS_GetLimitWebFront(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetLimitWebFront(  );
	return $result;
}

/**
* IPS_GetLink
* 
* @returns array
* @param integer $LinkID
*/

function IPS_GetLink( $LinkID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetLink( $LinkID );
	return $result;
}

/**
* IPS_GetLinkIDByName
* 
* @returns integer
* @param string $Name
* @param integer $ParentID
*/

function IPS_GetLinkIDByName( $Name,$ParentID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetLinkIDByName( $Name,$ParentID );
	return $result;
}

/**
* IPS_GetLinkList
* 
* @returns array
*/

function IPS_GetLinkList(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetLinkList(  );
	return $result;
}

/**
* IPS_GetLiveConsoleCRC
* 
* @returns string
*/

function IPS_GetLiveConsoleCRC(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetLiveConsoleCRC(  );
	return $result;
}

/**
* IPS_GetLiveConsoleFile
* 
* @returns string
*/

function IPS_GetLiveConsoleFile(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetLiveConsoleFile(  );
	return $result;
}

/**
* IPS_GetLiveUpdateVersion
* 
* @returns string
*/

function IPS_GetLiveUpdateVersion(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetLiveUpdateVersion(  );
	return $result;
}

/**
* IPS_GetLocation
* 
* @returns string
* @param integer $ID
*/

function IPS_GetLocation( $ID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetLocation( $ID );
	return $result;
}

/**
* IPS_GetLogDir
* 
* @returns string
*/

function IPS_GetLogDir(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetLogDir(  );
	return $result;
}

/**
* IPS_GetMedia
* 
* @returns array
* @param integer $MediaID
*/

function IPS_GetMedia( $MediaID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetMedia( $MediaID );
	return $result;
}

/**
* IPS_GetMediaContent
* 
* @returns string
* @param integer $MediaID
*/

function IPS_GetMediaContent( $MediaID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetMediaContent( $MediaID );
	return $result;
}

/**
* IPS_GetMediaIDByFile
* 
* @returns integer
* @param string $FilePath
*/

function IPS_GetMediaIDByFile( $FilePath ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetMediaIDByFile( $FilePath );
	return $result;
}

/**
* IPS_GetMediaIDByName
* 
* @returns integer
* @param string $Name
* @param integer $ParentID
*/

function IPS_GetMediaIDByName( $Name,$ParentID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetMediaIDByName( $Name,$ParentID );
	return $result;
}

/**
* IPS_GetMediaList
* 
* @returns array
*/

function IPS_GetMediaList(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetMediaList(  );
	return $result;
}

/**
* IPS_GetMediaListByType
* 
* @returns array
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
* @returns array
* @param string $ModuleID
*/

function IPS_GetModule( $ModuleID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetModule( $ModuleID );
	return $result;
}

/**
* IPS_GetModuleList
* 
* @returns array
*/

function IPS_GetModuleList(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetModuleList(  );
	return $result;
}

/**
* IPS_GetModuleListByType
* 
* @returns array
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
* @returns array
* @param array $Parameter
*/

function IPS_GetModules( $Parameter ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetModules( $Parameter );
	return $result;
}

/**
* IPS_GetName
* 
* @returns string
* @param integer $ID
*/

function IPS_GetName( $ID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetName( $ID );
	return $result;
}

/**
* IPS_GetObject
* 
* @returns array
* @param integer $ID
*/

function IPS_GetObject( $ID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetObject( $ID );
	return $result;
}

/**
* IPS_GetObjectIDByIdent
* 
* @returns integer
* @param string $Ident
* @param integer $ParentID
*/

function IPS_GetObjectIDByIdent( $Ident,$ParentID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetObjectIDByIdent( $Ident,$ParentID );
	return $result;
}

/**
* IPS_GetObjectIDByName
* 
* @returns integer
* @param string $Name
* @param integer $ParentID
*/

function IPS_GetObjectIDByName( $Name,$ParentID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetObjectIDByName( $Name,$ParentID );
	return $result;
}

/**
* IPS_GetObjectList
* 
* @returns array
*/

function IPS_GetObjectList(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetObjectList(  );
	return $result;
}

/**
* IPS_GetOption
* 
* @returns integer
* @param string $Option
*/

function IPS_GetOption( $Option ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetOption( $Option );
	return $result;
}

/**
* IPS_GetParent
* 
* @returns integer
* @param integer $ID
*/

function IPS_GetParent( $ID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetParent( $ID );
	return $result;
}

/**
* IPS_GetProperty
* 
* @returns variant
* @param integer $InstanceID
* @param string $Name
*/

function IPS_GetProperty( $InstanceID,$Name ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetProperty( $InstanceID,$Name );
	return $result;
}

/**
* IPS_GetScript
* 
* @returns array
* @param integer $ScriptID
*/

function IPS_GetScript( $ScriptID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetScript( $ScriptID );
	return $result;
}

/**
* IPS_GetScriptContent
* 
* @returns string
* @param integer $ScriptID
*/

function IPS_GetScriptContent( $ScriptID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetScriptContent( $ScriptID );
	return $result;
}

/**
* IPS_GetScriptEventList
* 
* @returns array
* @param integer $ScriptID
*/

function IPS_GetScriptEventList( $ScriptID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetScriptEventList( $ScriptID );
	return $result;
}

/**
* IPS_GetScriptFile
* 
* @returns string
* @param integer $ScriptID
*/

function IPS_GetScriptFile( $ScriptID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetScriptFile( $ScriptID );
	return $result;
}

/**
* IPS_GetScriptIDByFile
* 
* @returns integer
* @param string $FilePath
*/

function IPS_GetScriptIDByFile( $FilePath ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetScriptIDByFile( $FilePath );
	return $result;
}

/**
* IPS_GetScriptIDByName
* 
* @returns integer
* @param string $Name
* @param integer $ParentID
*/

function IPS_GetScriptIDByName( $Name,$ParentID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetScriptIDByName( $Name,$ParentID );
	return $result;
}

/**
* IPS_GetScriptList
* 
* @returns array
*/

function IPS_GetScriptList(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetScriptList(  );
	return $result;
}

/**
* IPS_GetScriptThread
* 
* @returns array
* @param integer $ThreadID
*/

function IPS_GetScriptThread( $ThreadID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetScriptThread( $ThreadID );
	return $result;
}

/**
* IPS_GetScriptThreadList
* 
* @returns array
*/

function IPS_GetScriptThreadList(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetScriptThreadList(  );
	return $result;
}

/**
* IPS_GetScriptThreads
* 
* @returns array
* @param array $Parameter
*/

function IPS_GetScriptThreads( $Parameter ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetScriptThreads( $Parameter );
	return $result;
}

/**
* IPS_GetScriptTimer
* 
* @returns integer
* @param integer $ScriptID
*/

function IPS_GetScriptTimer( $ScriptID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetScriptTimer( $ScriptID );
	return $result;
}

/**
* IPS_GetSnapshot
* 
* @returns array
*/

function IPS_GetSnapshot(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetSnapshot(  );
	return $result;
}

/**
* IPS_GetSnapshotChanges
* 
* @returns array
* @param integer $LastTimestamp
*/

function IPS_GetSnapshotChanges( $LastTimestamp ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetSnapshotChanges( $LastTimestamp );
	return $result;
}

/**
* IPS_GetTimer
* 
* @returns array
* @param integer $TimerID
*/

function IPS_GetTimer( $TimerID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetTimer( $TimerID );
	return $result;
}

/**
* IPS_GetTimerList
* 
* @returns array
*/

function IPS_GetTimerList(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetTimerList(  );
	return $result;
}

/**
* IPS_GetTimers
* 
* @returns array
* @param array $Parameter
*/

function IPS_GetTimers( $Parameter ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetTimers( $Parameter );
	return $result;
}

/**
* IPS_GetVariable
* 
* @returns array
* @param integer $VariableID
*/

function IPS_GetVariable( $VariableID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetVariable( $VariableID );
	return $result;
}

/**
* IPS_GetVariableEventList
* 
* @returns array
* @param integer $VariableID
*/

function IPS_GetVariableEventList( $VariableID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetVariableEventList( $VariableID );
	return $result;
}

/**
* IPS_GetVariableIDByName
* 
* @returns integer
* @param string $Name
* @param integer $ParentID
*/

function IPS_GetVariableIDByName( $Name,$ParentID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetVariableIDByName( $Name,$ParentID );
	return $result;
}

/**
* IPS_GetVariableList
* 
* @returns array
*/

function IPS_GetVariableList(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetVariableList(  );
	return $result;
}

/**
* IPS_GetVariableProfile
* 
* @returns array
* @param string $ProfileName
*/

function IPS_GetVariableProfile( $ProfileName ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetVariableProfile( $ProfileName );
	return $result;
}

/**
* IPS_GetVariableProfileList
* 
* @returns array
*/

function IPS_GetVariableProfileList(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetVariableProfileList(  );
	return $result;
}

/**
* IPS_GetVariableProfileListByType
* 
* @returns array
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
* @returns boolean
* @param integer $InstanceID
*/

function IPS_HasChanges( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_HasChanges( $InstanceID );
	return $result;
}

/**
* IPS_HasChildren
* 
* @returns boolean
* @param integer $ID
*/

function IPS_HasChildren( $ID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_HasChildren( $ID );
	return $result;
}

/**
* IPS_InstanceExists
* 
* @returns boolean
* @param integer $InstanceID
*/

function IPS_InstanceExists( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_InstanceExists( $InstanceID );
	return $result;
}

/**
* IPS_IsChild
* 
* @returns boolean
* @param integer $ID
* @param integer $ParentID
* @param boolean $Recursive
*/

function IPS_IsChild( $ID,$ParentID,$Recursive ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_IsChild( $ID,$ParentID,$Recursive );
	return $result;
}

/**
* IPS_IsInstanceCompatible
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $ParentInstanceID
*/

function IPS_IsInstanceCompatible( $InstanceID,$ParentInstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_IsInstanceCompatible( $InstanceID,$ParentInstanceID );
	return $result;
}

/**
* IPS_IsModuleCompatible
* 
* @returns boolean
* @param string $ModuleID
* @param string $ParentModuleID
*/

function IPS_IsModuleCompatible( $ModuleID,$ParentModuleID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_IsModuleCompatible( $ModuleID,$ParentModuleID );
	return $result;
}

/**
* IPS_IsSearching
* 
* @returns boolean
* @param integer $InstanceID
*/

function IPS_IsSearching( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_IsSearching( $InstanceID );
	return $result;
}

/**
* IPS_LibraryExists
* 
* @returns boolean
* @param string $LibraryID
*/

function IPS_LibraryExists( $LibraryID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_LibraryExists( $LibraryID );
	return $result;
}

/**
* IPS_LinkExists
* 
* @returns boolean
* @param integer $LinkID
*/

function IPS_LinkExists( $LinkID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_LinkExists( $LinkID );
	return $result;
}

/**
* IPS_LogMessage
* 
* @returns boolean
* @param string $Sender
* @param string $Message
*/

function IPS_LogMessage( $Sender,$Message ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_LogMessage( $Sender,$Message );
	return $result;
}

/**
* IPS_MediaExists
* 
* @returns boolean
* @param integer $MediaID
*/

function IPS_MediaExists( $MediaID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_MediaExists( $MediaID );
	return $result;
}

/**
* IPS_ModuleExists
* 
* @returns boolean
* @param string $ModuleID
*/

function IPS_ModuleExists( $ModuleID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_ModuleExists( $ModuleID );
	return $result;
}

/**
* IPS_ObjectExists
* 
* @returns boolean
* @param integer $ID
*/

function IPS_ObjectExists( $ID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_ObjectExists( $ID );
	return $result;
}

/**
* IPS_RegisterPropertyBoolean
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Name
* @param boolean $DefaultValue
*/

function IPS_RegisterPropertyBoolean( $InstanceID,$Name,$DefaultValue ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_RegisterPropertyBoolean( $InstanceID,$Name,$DefaultValue );
	return $result;
}

/**
* IPS_RegisterPropertyFloat
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Name
* @param float $DefaultValue
*/

function IPS_RegisterPropertyFloat( $InstanceID,$Name,$DefaultValue ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_RegisterPropertyFloat( $InstanceID,$Name,$DefaultValue );
	return $result;
}

/**
* IPS_RegisterPropertyInteger
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Name
* @param integer $DefaultValue
*/

function IPS_RegisterPropertyInteger( $InstanceID,$Name,$DefaultValue ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_RegisterPropertyInteger( $InstanceID,$Name,$DefaultValue );
	return $result;
}

/**
* IPS_RegisterPropertyString
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Name
* @param string $DefaultValue
*/

function IPS_RegisterPropertyString( $InstanceID,$Name,$DefaultValue ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_RegisterPropertyString( $InstanceID,$Name,$DefaultValue );
	return $result;
}

/**
* IPS_RequestAction
* 
* @returns boolean
* @param integer $InstanceID
* @param string $VariableIdent
* @param variant $Value
*/

function IPS_RequestAction( $InstanceID,$VariableIdent,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_RequestAction( $InstanceID,$VariableIdent,$Value );
	return $result;
}

/**
* IPS_ResetChanges
* 
* @returns boolean
* @param integer $InstanceID
*/

function IPS_ResetChanges( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_ResetChanges( $InstanceID );
	return $result;
}

/**
* IPS_RunScript
* 
* @returns boolean
* @param integer $ScriptID
*/

function IPS_RunScript( $ScriptID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_RunScript( $ScriptID );
	return $result;
}

/**
* IPS_RunScriptEx
* 
* @returns boolean
* @param integer $ScriptID
* @param array $Parameters
*/

function IPS_RunScriptEx( $ScriptID,$Parameters ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_RunScriptEx( $ScriptID,$Parameters );
	return $result;
}

/**
* IPS_RunScriptText
* 
* @returns boolean
* @param string $ScriptText
*/

function IPS_RunScriptText( $ScriptText ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_RunScriptText( $ScriptText );
	return $result;
}

/**
* IPS_RunScriptTextEx
* 
* @returns boolean
* @param string $ScriptText
* @param array $Parameters
*/

function IPS_RunScriptTextEx( $ScriptText,$Parameters ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_RunScriptTextEx( $ScriptText,$Parameters );
	return $result;
}

/**
* IPS_RunScriptTextWait
* 
* @returns string
* @param string $ScriptText
*/

function IPS_RunScriptTextWait( $ScriptText ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_RunScriptTextWait( $ScriptText );
	return $result;
}

/**
* IPS_RunScriptTextWaitEx
* 
* @returns string
* @param string $ScriptText
* @param array $Parameters
*/

function IPS_RunScriptTextWaitEx( $ScriptText,$Parameters ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_RunScriptTextWaitEx( $ScriptText,$Parameters );
	return $result;
}

/**
* IPS_RunScriptWait
* 
* @returns string
* @param integer $ScriptID
*/

function IPS_RunScriptWait( $ScriptID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_RunScriptWait( $ScriptID );
	return $result;
}

/**
* IPS_RunScriptWaitEx
* 
* @returns string
* @param integer $ScriptID
* @param array $Parameters
*/

function IPS_RunScriptWaitEx( $ScriptID,$Parameters ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_RunScriptWaitEx( $ScriptID,$Parameters );
	return $result;
}

/**
* IPS_ScriptExists
* 
* @returns boolean
* @param integer $ScriptID
*/

function IPS_ScriptExists( $ScriptID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_ScriptExists( $ScriptID );
	return $result;
}

/**
* IPS_ScriptThreadExists
* 
* @returns boolean
* @param integer $ThreadID
*/

function IPS_ScriptThreadExists( $ThreadID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_ScriptThreadExists( $ThreadID );
	return $result;
}

/**
* IPS_SemaphoreEnter
* 
* @returns boolean
* @param string $Name
* @param integer $Milliseconds
*/

function IPS_SemaphoreEnter( $Name,$Milliseconds ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SemaphoreEnter( $Name,$Milliseconds );
	return $result;
}

/**
* IPS_SemaphoreLeave
* 
* @returns boolean
* @param string $Name
*/

function IPS_SemaphoreLeave( $Name ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SemaphoreLeave( $Name );
	return $result;
}

/**
* IPS_SendDataToChildren
* 
* @returns boolean
* @param integer $InstanceID
* @param string $JSONData
*/

function IPS_SendDataToChildren( $InstanceID,$JSONData ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SendDataToChildren( $InstanceID,$JSONData );
	return $result;
}

/**
* IPS_SendDataToParent
* 
* @returns string
* @param integer $InstanceID
* @param string $JSONData
*/

function IPS_SendDataToParent( $InstanceID,$JSONData ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SendDataToParent( $InstanceID,$JSONData );
	return $result;
}

/**
* IPS_SendDebug
* 
* @returns boolean
* @param integer $SenderID
* @param string $Message
* @param string $Data
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
* @returns boolean
* @param integer $MediaID
*/

function IPS_SendMediaEvent( $MediaID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SendMediaEvent( $MediaID );
	return $result;
}

/**
* IPS_SetConfiguration
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Configuration
*/

function IPS_SetConfiguration( $InstanceID,$Configuration ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetConfiguration( $InstanceID,$Configuration );
	return $result;
}

/**
* IPS_SetDisabled
* 
* @returns boolean
* @param integer $ID
* @param boolean $Disabled
*/

function IPS_SetDisabled( $ID,$Disabled ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetDisabled( $ID,$Disabled );
	return $result;
}

/**
* IPS_SetEventActive
* 
* @returns boolean
* @param integer $EventID
* @param boolean $Active
*/

function IPS_SetEventActive( $EventID,$Active ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetEventActive( $EventID,$Active );
	return $result;
}

/**
* IPS_SetEventCyclic
* 
* @returns boolean
* @param integer $EventID
* @param integer $DateType
*   enum[0=cdtNone, 1=cdtOnce, 2=cdtDay, 3=cdtWeek, 4=cdtMonth, 5=cdtYear]
* @param integer $DateValue
* @param integer $DateDay
* @param integer $DateDayValue
* @param integer $TimeType
*   enum[0=cttOnce, 1=cttSecond, 2=cttMinute, 3=cttHour]
* @param integer $TimeValue
*/

function IPS_SetEventCyclic( $EventID,$DateType,$DateValue,$DateDay,$DateDayValue,$TimeType,$TimeValue ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetEventCyclic( $EventID,$DateType,$DateValue,$DateDay,$DateDayValue,$TimeType,$TimeValue );
	return $result;
}

/**
* IPS_SetEventCyclicDateFrom
* 
* @returns boolean
* @param integer $EventID
* @param integer $Day
* @param integer $Month
* @param integer $Year
*/

function IPS_SetEventCyclicDateFrom( $EventID,$Day,$Month,$Year ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetEventCyclicDateFrom( $EventID,$Day,$Month,$Year );
	return $result;
}

/**
* IPS_SetEventCyclicDateTo
* 
* @returns boolean
* @param integer $EventID
* @param integer $Day
* @param integer $Month
* @param integer $Year
*/

function IPS_SetEventCyclicDateTo( $EventID,$Day,$Month,$Year ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetEventCyclicDateTo( $EventID,$Day,$Month,$Year );
	return $result;
}

/**
* IPS_SetEventCyclicTimeFrom
* 
* @returns boolean
* @param integer $EventID
* @param integer $Hour
* @param integer $Minute
* @param integer $Second
*/

function IPS_SetEventCyclicTimeFrom( $EventID,$Hour,$Minute,$Second ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetEventCyclicTimeFrom( $EventID,$Hour,$Minute,$Second );
	return $result;
}

/**
* IPS_SetEventCyclicTimeTo
* 
* @returns boolean
* @param integer $EventID
* @param integer $Hour
* @param integer $Minute
* @param integer $Second
*/

function IPS_SetEventCyclicTimeTo( $EventID,$Hour,$Minute,$Second ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetEventCyclicTimeTo( $EventID,$Hour,$Minute,$Second );
	return $result;
}

/**
* IPS_SetEventLimit
* 
* @returns boolean
* @param integer $EventID
* @param integer $Count
*/

function IPS_SetEventLimit( $EventID,$Count ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetEventLimit( $EventID,$Count );
	return $result;
}

/**
* IPS_SetEventScheduleAction
* 
* @returns boolean
* @param integer $EventID
* @param integer $ActionID
* @param string $Name
* @param integer $Color
* @param string $ScriptText
*/

function IPS_SetEventScheduleAction( $EventID,$ActionID,$Name,$Color,$ScriptText ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetEventScheduleAction( $EventID,$ActionID,$Name,$Color,$ScriptText );
	return $result;
}

/**
* IPS_SetEventScheduleGroup
* 
* @returns boolean
* @param integer $EventID
* @param integer $GroupID
* @param integer $Days
*/

function IPS_SetEventScheduleGroup( $EventID,$GroupID,$Days ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetEventScheduleGroup( $EventID,$GroupID,$Days );
	return $result;
}

/**
* IPS_SetEventScheduleGroupPoint
* 
* @returns boolean
* @param integer $EventID
* @param integer $GroupID
* @param integer $PointID
* @param integer $StartHour
* @param integer $StartMinute
* @param integer $StartSecond
* @param integer $ActionID
*/

function IPS_SetEventScheduleGroupPoint( $EventID,$GroupID,$PointID,$StartHour,$StartMinute,$StartSecond,$ActionID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetEventScheduleGroupPoint( $EventID,$GroupID,$PointID,$StartHour,$StartMinute,$StartSecond,$ActionID );
	return $result;
}

/**
* IPS_SetEventScript
* 
* @returns boolean
* @param integer $EventID
* @param string $EventScript
*/

function IPS_SetEventScript( $EventID,$EventScript ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetEventScript( $EventID,$EventScript );
	return $result;
}

/**
* IPS_SetEventTrigger
* 
* @returns boolean
* @param integer $EventID
* @param integer $TriggerType
*   enum[0=evtOnUpdate, 1=evtOnChange, 2=evtOnLimitExceed, 3=evtOnLimitDrop, 4=evtOnValue]
* @param integer $TriggerVariableID
*/

function IPS_SetEventTrigger( $EventID,$TriggerType,$TriggerVariableID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetEventTrigger( $EventID,$TriggerType,$TriggerVariableID );
	return $result;
}

/**
* IPS_SetEventTriggerSubsequentExecution
* 
* @returns boolean
* @param integer $EventID
* @param boolean $AllowSubsequentExecutions
*/

function IPS_SetEventTriggerSubsequentExecution( $EventID,$AllowSubsequentExecutions ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetEventTriggerSubsequentExecution( $EventID,$AllowSubsequentExecutions );
	return $result;
}

/**
* IPS_SetEventTriggerValue
* 
* @returns boolean
* @param integer $EventID
* @param variant $TriggerValue
*/

function IPS_SetEventTriggerValue( $EventID,$TriggerValue ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetEventTriggerValue( $EventID,$TriggerValue );
	return $result;
}

/**
* IPS_SetHidden
* 
* @returns boolean
* @param integer $ID
* @param boolean $Hidden
*/

function IPS_SetHidden( $ID,$Hidden ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetHidden( $ID,$Hidden );
	return $result;
}

/**
* IPS_SetIcon
* 
* @returns boolean
* @param integer $ID
* @param string $Icon
*/

function IPS_SetIcon( $ID,$Icon ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetIcon( $ID,$Icon );
	return $result;
}

/**
* IPS_SetIdent
* 
* @returns boolean
* @param integer $ID
* @param string $Ident
*/

function IPS_SetIdent( $ID,$Ident ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetIdent( $ID,$Ident );
	return $result;
}

/**
* IPS_SetInfo
* 
* @returns boolean
* @param integer $ID
* @param string $Info
*/

function IPS_SetInfo( $ID,$Info ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetInfo( $ID,$Info );
	return $result;
}

/**
* IPS_SetInstanceStatus
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Status
*/

function IPS_SetInstanceStatus( $InstanceID,$Status ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetInstanceStatus( $InstanceID,$Status );
	return $result;
}

/**
* IPS_SetLicense
* 
* @returns boolean
* @param string $Licensee
* @param string $LicenseContent
*/

function IPS_SetLicense( $Licensee,$LicenseContent ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetLicense( $Licensee,$LicenseContent );
	return $result;
}

/**
* IPS_SetLinkTargetID
* 
* @returns boolean
* @param integer $LinkID
* @param integer $ChildID
*/

function IPS_SetLinkTargetID( $LinkID,$ChildID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetLinkTargetID( $LinkID,$ChildID );
	return $result;
}

/**
* IPS_SetMediaCached
* 
* @returns boolean
* @param integer $MediaID
* @param boolean $Cached
*/

function IPS_SetMediaCached( $MediaID,$Cached ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetMediaCached( $MediaID,$Cached );
	return $result;
}

/**
* IPS_SetMediaContent
* 
* @returns boolean
* @param integer $MediaID
* @param string $Content
*/

function IPS_SetMediaContent( $MediaID,$Content ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetMediaContent( $MediaID,$Content );
	return $result;
}

/**
* IPS_SetMediaFile
* 
* @returns boolean
* @param integer $MediaID
* @param string $FilePath
* @param boolean $FileMustExists
*/

function IPS_SetMediaFile( $MediaID,$FilePath,$FileMustExists ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetMediaFile( $MediaID,$FilePath,$FileMustExists );
	return $result;
}

/**
* IPS_SetName
* 
* @returns boolean
* @param integer $ID
* @param string $Name
*/

function IPS_SetName( $ID,$Name ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetName( $ID,$Name );
	return $result;
}

/**
* IPS_SetOption
* 
* @returns boolean
* @param string $Option
* @param integer $Value
*/

function IPS_SetOption( $Option,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetOption( $Option,$Value );
	return $result;
}

/**
* IPS_SetParent
* 
* @returns boolean
* @param integer $ID
* @param integer $ParentID
*/

function IPS_SetParent( $ID,$ParentID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetParent( $ID,$ParentID );
	return $result;
}

/**
* IPS_SetPosition
* 
* @returns boolean
* @param integer $ID
* @param integer $Position
*/

function IPS_SetPosition( $ID,$Position ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetPosition( $ID,$Position );
	return $result;
}

/**
* IPS_SetProperty
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Name
* @param variant $Value
*/

function IPS_SetProperty( $InstanceID,$Name,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetProperty( $InstanceID,$Name,$Value );
	return $result;
}

/**
* IPS_SetScriptContent
* 
* @returns boolean
* @param integer $ScriptID
* @param string $Content
*/

function IPS_SetScriptContent( $ScriptID,$Content ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetScriptContent( $ScriptID,$Content );
	return $result;
}

/**
* IPS_SetScriptFile
* 
* @returns boolean
* @param integer $ScriptID
* @param string $FilePath
*/

function IPS_SetScriptFile( $ScriptID,$FilePath ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetScriptFile( $ScriptID,$FilePath );
	return $result;
}

/**
* IPS_SetScriptTimer
* 
* @returns boolean
* @param integer $ScriptID
* @param integer $Interval
*/

function IPS_SetScriptTimer( $ScriptID,$Interval ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetScriptTimer( $ScriptID,$Interval );
	return $result;
}

/**
* IPS_SetVariableCustomAction
* 
* @returns boolean
* @param integer $VariableID
* @param integer $ScriptID
*/

function IPS_SetVariableCustomAction( $VariableID,$ScriptID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetVariableCustomAction( $VariableID,$ScriptID );
	return $result;
}

/**
* IPS_SetVariableCustomProfile
* 
* @returns boolean
* @param integer $VariableID
* @param string $ProfileName
*/

function IPS_SetVariableCustomProfile( $VariableID,$ProfileName ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetVariableCustomProfile( $VariableID,$ProfileName );
	return $result;
}

/**
* IPS_SetVariableProfileAssociation
* 
* @returns boolean
* @param string $ProfileName
* @param float $AssociationValue
* @param string $AssociationName
* @param string $AssociationIcon
* @param integer $AssociationColor
*/

function IPS_SetVariableProfileAssociation( $ProfileName,$AssociationValue,$AssociationName,$AssociationIcon,$AssociationColor ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetVariableProfileAssociation( $ProfileName,$AssociationValue,$AssociationName,$AssociationIcon,$AssociationColor );
	return $result;
}

/**
* IPS_SetVariableProfileDigits
* 
* @returns boolean
* @param string $ProfileName
* @param integer $Digits
*/

function IPS_SetVariableProfileDigits( $ProfileName,$Digits ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetVariableProfileDigits( $ProfileName,$Digits );
	return $result;
}

/**
* IPS_SetVariableProfileIcon
* 
* @returns boolean
* @param string $ProfileName
* @param string $Icon
*/

function IPS_SetVariableProfileIcon( $ProfileName,$Icon ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetVariableProfileIcon( $ProfileName,$Icon );
	return $result;
}

/**
* IPS_SetVariableProfileText
* 
* @returns boolean
* @param string $ProfileName
* @param string $Prefix
* @param string $Suffix
*/

function IPS_SetVariableProfileText( $ProfileName,$Prefix,$Suffix ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetVariableProfileText( $ProfileName,$Prefix,$Suffix );
	return $result;
}

/**
* IPS_SetVariableProfileValues
* 
* @returns boolean
* @param string $ProfileName
* @param float $MinValue
* @param float $MaxValue
* @param float $StepSize
*/

function IPS_SetVariableProfileValues( $ProfileName,$MinValue,$MaxValue,$StepSize ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetVariableProfileValues( $ProfileName,$MinValue,$MaxValue,$StepSize );
	return $result;
}

/**
* IPS_Sleep
* 
* @returns integer
* @param integer $Milliseconds
*/

function IPS_Sleep( $Milliseconds ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_Sleep( $Milliseconds );
	return $result;
}

/**
* IPS_StartSearch
* 
* @returns boolean
* @param integer $InstanceID
*/

function IPS_StartSearch( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_StartSearch( $InstanceID );
	return $result;
}

/**
* IPS_StopSearch
* 
* @returns boolean
* @param integer $InstanceID
*/

function IPS_StopSearch( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_StopSearch( $InstanceID );
	return $result;
}

/**
* IPS_SupportsSearching
* 
* @returns boolean
* @param integer $InstanceID
*/

function IPS_SupportsSearching( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SupportsSearching( $InstanceID );
	return $result;
}

/**
* IPS_TimerExists
* 
* @returns boolean
* @param integer $TimerID
*/

function IPS_TimerExists( $TimerID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_TimerExists( $TimerID );
	return $result;
}

/**
* IPS_VariableExists
* 
* @returns boolean
* @param integer $VariableID
*/

function IPS_VariableExists( $VariableID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_VariableExists( $VariableID );
	return $result;
}

/**
* IPS_VariableProfileExists
* 
* @returns boolean
* @param string $ProfileName
*/

function IPS_VariableProfileExists( $ProfileName ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_VariableProfileExists( $ProfileName );
	return $result;
}

/**
* IRT_ListButtons
* 
* @returns array
* @param integer $InstanceID
* @param string $Remote
*/

function IRT_ListButtons( $InstanceID,$Remote ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IRT_ListButtons( $InstanceID,$Remote );
	return $result;
}

/**
* IRT_ListRemotes
* 
* @returns array
* @param integer $InstanceID
*/

function IRT_ListRemotes( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IRT_ListRemotes( $InstanceID );
	return $result;
}

/**
* IRT_SendOnce
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Remote
* @param string $Button
*/

function IRT_SendOnce( $InstanceID,$Remote,$Button ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IRT_SendOnce( $InstanceID,$Remote,$Button );
	return $result;
}

/**
* LCN_AddGroup
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Group
*/

function LCN_AddGroup( $InstanceID,$Group ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_AddGroup( $InstanceID,$Group );
	return $result;
}

/**
* LCN_AddIntensity
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Intensity
*/

function LCN_AddIntensity( $InstanceID,$Intensity ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_AddIntensity( $InstanceID,$Intensity );
	return $result;
}

/**
* LCN_Beep
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $SpecialTone
* @param integer $Count
*/

function LCN_Beep( $InstanceID,$SpecialTone,$Count ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_Beep( $InstanceID,$SpecialTone,$Count );
	return $result;
}

/**
* LCN_DeductIntensity
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Intensity
*/

function LCN_DeductIntensity( $InstanceID,$Intensity ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_DeductIntensity( $InstanceID,$Intensity );
	return $result;
}

/**
* LCN_Fadeout
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Intensity
* @param integer $Ramp
*/

function LCN_Fadeout( $InstanceID,$Intensity,$Ramp ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_Fadeout( $InstanceID,$Intensity,$Ramp );
	return $result;
}

/**
* LCN_FlipRelay
* 
* @returns boolean
* @param integer $InstanceID
*/

function LCN_FlipRelay( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_FlipRelay( $InstanceID );
	return $result;
}

/**
* LCN_GetKnownDevices
* 
* @returns array
* @param integer $InstanceID
*/

function LCN_GetKnownDevices( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_GetKnownDevices( $InstanceID );
	return $result;
}

/**
* LCN_LimitOutput
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
* @param integer $Time
* @param string $TimeType
*/

function LCN_LimitOutput( $InstanceID,$Value,$Time,$TimeType ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_LimitOutput( $InstanceID,$Value,$Time,$TimeType );
	return $result;
}

/**
* LCN_LoadScene
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Scene
*/

function LCN_LoadScene( $InstanceID,$Scene ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_LoadScene( $InstanceID,$Scene );
	return $result;
}

/**
* LCN_LockTargetValue
* 
* @returns boolean
* @param integer $InstanceID
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
* @returns boolean
* @param integer $InstanceID
*/

function LCN_RampStop( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_RampStop( $InstanceID );
	return $result;
}

/**
* LCN_ReleaseTargetValue
* 
* @returns boolean
* @param integer $InstanceID
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
* @returns boolean
* @param integer $InstanceID
* @param integer $Group
*/

function LCN_RemoveGroup( $InstanceID,$Group ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_RemoveGroup( $InstanceID,$Group );
	return $result;
}

/**
* LCN_RequestLights
* 
* @returns boolean
* @param integer $InstanceID
*/

function LCN_RequestLights( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_RequestLights( $InstanceID );
	return $result;
}

/**
* LCN_RequestRead
* 
* @returns boolean
* @param integer $InstanceID
*/

function LCN_RequestRead( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_RequestRead( $InstanceID );
	return $result;
}

/**
* LCN_RequestStatus
* 
* @returns boolean
* @param integer $InstanceID
*/

function LCN_RequestStatus( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_RequestStatus( $InstanceID );
	return $result;
}

/**
* LCN_RequestThresholds
* 
* @returns boolean
* @param integer $InstanceID
*/

function LCN_RequestThresholds( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_RequestThresholds( $InstanceID );
	return $result;
}

/**
* LCN_SaveScene
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Scene
*/

function LCN_SaveScene( $InstanceID,$Scene ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_SaveScene( $InstanceID,$Scene );
	return $result;
}

/**
* LCN_SearchDevices
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Segment
*/

function LCN_SearchDevices( $InstanceID,$Segment ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_SearchDevices( $InstanceID,$Segment );
	return $result;
}

/**
* LCN_SelectSceneRegister
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Register
*/

function LCN_SelectSceneRegister( $InstanceID,$Register ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_SelectSceneRegister( $InstanceID,$Register );
	return $result;
}

/**
* LCN_SendCommand
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Function
* @param string $Data
*/

function LCN_SendCommand( $InstanceID,$Function,$Data ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_SendCommand( $InstanceID,$Function,$Data );
	return $result;
}

/**
* LCN_SetIntensity
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Intensity
* @param integer $Ramp
*/

function LCN_SetIntensity( $InstanceID,$Intensity,$Ramp ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_SetIntensity( $InstanceID,$Intensity,$Ramp );
	return $result;
}

/**
* LCN_SetLamp
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Lamp
* @param string $Action
*/

function LCN_SetLamp( $InstanceID,$Lamp,$Action ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_SetLamp( $InstanceID,$Lamp,$Action );
	return $result;
}

/**
* LCN_SetRelay
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Value
*/

function LCN_SetRelay( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_SetRelay( $InstanceID,$Value );
	return $result;
}

/**
* LCN_SetTargetValue
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Target
*   enum[0=ltR1, 1=ltR2, 2=ltS1, 3=ltS2]
* @param float $Value
*/

function LCN_SetTargetValue( $InstanceID,$Target,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_SetTargetValue( $InstanceID,$Target,$Value );
	return $result;
}

/**
* LCN_ShiftTargetValue
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Target
*   enum[0=ltR1, 1=ltR2, 2=ltS1, 3=ltS2]
* @param float $RelativeValue
*/

function LCN_ShiftTargetValue( $InstanceID,$Target,$RelativeValue ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_ShiftTargetValue( $InstanceID,$Target,$RelativeValue );
	return $result;
}

/**
* LCN_ShutterMoveDown
* 
* @returns boolean
* @param integer $InstanceID
*/

function LCN_ShutterMoveDown( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_ShutterMoveDown( $InstanceID );
	return $result;
}

/**
* LCN_ShutterMoveUp
* 
* @returns boolean
* @param integer $InstanceID
*/

function LCN_ShutterMoveUp( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_ShutterMoveUp( $InstanceID );
	return $result;
}

/**
* LCN_ShutterStop
* 
* @returns boolean
* @param integer $InstanceID
*/

function LCN_ShutterStop( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_ShutterStop( $InstanceID );
	return $result;
}

/**
* LCN_StartFlicker
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Depth
* @param string $Speed
* @param integer $Count
*/

function LCN_StartFlicker( $InstanceID,$Depth,$Speed,$Count ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_StartFlicker( $InstanceID,$Depth,$Speed,$Count );
	return $result;
}

/**
* LCN_StopFlicker
* 
* @returns boolean
* @param integer $InstanceID
*/

function LCN_StopFlicker( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_StopFlicker( $InstanceID );
	return $result;
}

/**
* LCN_SwitchDurationMin
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Minutes
* @param string $Fadeout
* @param boolean $Retentive
*/

function LCN_SwitchDurationMin( $InstanceID,$Minutes,$Fadeout,$Retentive ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_SwitchDurationMin( $InstanceID,$Minutes,$Fadeout,$Retentive );
	return $result;
}

/**
* LCN_SwitchDurationSec
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Seconds
* @param string $Fadeout
* @param boolean $Retentive
*/

function LCN_SwitchDurationSec( $InstanceID,$Seconds,$Fadeout,$Retentive ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_SwitchDurationSec( $InstanceID,$Seconds,$Fadeout,$Retentive );
	return $result;
}

/**
* LCN_SwitchMemory
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Ramp
*/

function LCN_SwitchMemory( $InstanceID,$Ramp ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_SwitchMemory( $InstanceID,$Ramp );
	return $result;
}

/**
* LCN_SwitchMode
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Ramp
*/

function LCN_SwitchMode( $InstanceID,$Ramp ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_SwitchMode( $InstanceID,$Ramp );
	return $result;
}

/**
* LCN_SwitchRelay
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $SwitchOn
*/

function LCN_SwitchRelay( $InstanceID,$SwitchOn ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_SwitchRelay( $InstanceID,$SwitchOn );
	return $result;
}

/**
* MBUS_UpdateValues
* 
* @returns boolean
* @param integer $InstanceID
*/

function MBUS_UpdateValues( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MBUS_UpdateValues( $InstanceID );
	return $result;
}

/**
* MC_CreateModule
* 
* @returns boolean
* @param integer $InstanceID
* @param string $ModuleURL
*/

function MC_CreateModule( $InstanceID,$ModuleURL ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MC_CreateModule( $InstanceID,$ModuleURL );
	return $result;
}

/**
* MC_DeleteModule
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Module
*/

function MC_DeleteModule( $InstanceID,$Module ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MC_DeleteModule( $InstanceID,$Module );
	return $result;
}

/**
* MC_GetModuleList
* 
* @returns array
* @param integer $InstanceID
*/

function MC_GetModuleList( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MC_GetModuleList( $InstanceID );
	return $result;
}

/**
* MC_GetModuleRepositoryInfo
* 
* @returns array
* @param integer $InstanceID
* @param string $Module
*/

function MC_GetModuleRepositoryInfo( $InstanceID,$Module ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MC_GetModuleRepositoryInfo( $InstanceID,$Module );
	return $result;
}

/**
* MC_UpdateModule
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Module
*/

function MC_UpdateModule( $InstanceID,$Module ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MC_UpdateModule( $InstanceID,$Module );
	return $result;
}

/**
* MXC_DimBrighter
* 
* @returns boolean
* @param integer $InstanceID
*/

function MXC_DimBrighter( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MXC_DimBrighter( $InstanceID );
	return $result;
}

/**
* MXC_DimDarker
* 
* @returns boolean
* @param integer $InstanceID
*/

function MXC_DimDarker( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MXC_DimDarker( $InstanceID );
	return $result;
}

/**
* MXC_DimSet
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Intensity
*/

function MXC_DimSet( $InstanceID,$Intensity ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MXC_DimSet( $InstanceID,$Intensity );
	return $result;
}

/**
* MXC_DimStop
* 
* @returns boolean
* @param integer $InstanceID
*/

function MXC_DimStop( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MXC_DimStop( $InstanceID );
	return $result;
}

/**
* MXC_GetKnownDevices
* 
* @returns array
* @param integer $InstanceID
*/

function MXC_GetKnownDevices( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MXC_GetKnownDevices( $InstanceID );
	return $result;
}

/**
* MXC_RequestInfo
* 
* @returns boolean
* @param integer $InstanceID
*/

function MXC_RequestInfo( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MXC_RequestInfo( $InstanceID );
	return $result;
}

/**
* MXC_RequestStatus
* 
* @returns boolean
* @param integer $InstanceID
*/

function MXC_RequestStatus( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MXC_RequestStatus( $InstanceID );
	return $result;
}

/**
* MXC_SearchDevices
* 
* @returns boolean
* @param integer $InstanceID
*/

function MXC_SearchDevices( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MXC_SearchDevices( $InstanceID );
	return $result;
}

/**
* MXC_SendBoolean
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $Value
*/

function MXC_SendBoolean( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MXC_SendBoolean( $InstanceID,$Value );
	return $result;
}

/**
* MXC_SendFloat
* 
* @returns boolean
* @param integer $InstanceID
* @param float $Value
*/

function MXC_SendFloat( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MXC_SendFloat( $InstanceID,$Value );
	return $result;
}

/**
* MXC_SendInteger
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
*/

function MXC_SendInteger( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MXC_SendInteger( $InstanceID,$Value );
	return $result;
}

/**
* MXC_SetTemperature
* 
* @returns boolean
* @param integer $InstanceID
* @param float $Temperature
*/

function MXC_SetTemperature( $InstanceID,$Temperature ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MXC_SetTemperature( $InstanceID,$Temperature );
	return $result;
}

/**
* MXC_ShutterMoveDown
* 
* @returns boolean
* @param integer $InstanceID
*/

function MXC_ShutterMoveDown( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MXC_ShutterMoveDown( $InstanceID );
	return $result;
}

/**
* MXC_ShutterMoveUp
* 
* @returns boolean
* @param integer $InstanceID
*/

function MXC_ShutterMoveUp( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MXC_ShutterMoveUp( $InstanceID );
	return $result;
}

/**
* MXC_ShutterStepDown
* 
* @returns boolean
* @param integer $InstanceID
*/

function MXC_ShutterStepDown( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MXC_ShutterStepDown( $InstanceID );
	return $result;
}

/**
* MXC_ShutterStepUp
* 
* @returns boolean
* @param integer $InstanceID
*/

function MXC_ShutterStepUp( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MXC_ShutterStepUp( $InstanceID );
	return $result;
}

/**
* MXC_ShutterStop
* 
* @returns boolean
* @param integer $InstanceID
*/

function MXC_ShutterStop( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MXC_ShutterStop( $InstanceID );
	return $result;
}

/**
* MXC_SwitchMode
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $DeviceOn
*/

function MXC_SwitchMode( $InstanceID,$DeviceOn ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MXC_SwitchMode( $InstanceID,$DeviceOn );
	return $result;
}

/**
* MXC_UploadDataPointFile
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Content
*/

function MXC_UploadDataPointFile( $InstanceID,$Content ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MXC_UploadDataPointFile( $InstanceID,$Content );
	return $result;
}

/**
* ModBus_RequestRead
* 
* @returns boolean
* @param integer $InstanceID
*/

function ModBus_RequestRead( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ModBus_RequestRead( $InstanceID );
	return $result;
}

/**
* ModBus_WriteCoil
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $Value
*/

function ModBus_WriteCoil( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ModBus_WriteCoil( $InstanceID,$Value );
	return $result;
}

/**
* ModBus_WriteRegister
* 
* @returns boolean
* @param integer $InstanceID
* @param float $Value
*/

function ModBus_WriteRegister( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ModBus_WriteRegister( $InstanceID,$Value );
	return $result;
}

/**
* ModBus_WriteRegisterByte
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
*/

function ModBus_WriteRegisterByte( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ModBus_WriteRegisterByte( $InstanceID,$Value );
	return $result;
}

/**
* ModBus_WriteRegisterDWord
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
*/

function ModBus_WriteRegisterDWord( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ModBus_WriteRegisterDWord( $InstanceID,$Value );
	return $result;
}

/**
* ModBus_WriteRegisterInt64
* 
* @returns boolean
* @param integer $InstanceID
* @param float $Value
*/

function ModBus_WriteRegisterInt64( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ModBus_WriteRegisterInt64( $InstanceID,$Value );
	return $result;
}

/**
* ModBus_WriteRegisterInteger
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
*/

function ModBus_WriteRegisterInteger( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ModBus_WriteRegisterInteger( $InstanceID,$Value );
	return $result;
}

/**
* ModBus_WriteRegisterReal
* 
* @returns boolean
* @param integer $InstanceID
* @param float $Value
*/

function ModBus_WriteRegisterReal( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ModBus_WriteRegisterReal( $InstanceID,$Value );
	return $result;
}

/**
* ModBus_WriteRegisterReal64
* 
* @returns boolean
* @param integer $InstanceID
* @param float $Value
*/

function ModBus_WriteRegisterReal64( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ModBus_WriteRegisterReal64( $InstanceID,$Value );
	return $result;
}

/**
* ModBus_WriteRegisterShortInt
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
*/

function ModBus_WriteRegisterShortInt( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ModBus_WriteRegisterShortInt( $InstanceID,$Value );
	return $result;
}

/**
* ModBus_WriteRegisterSmallInt
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
*/

function ModBus_WriteRegisterSmallInt( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ModBus_WriteRegisterSmallInt( $InstanceID,$Value );
	return $result;
}

/**
* ModBus_WriteRegisterWord
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
*/

function ModBus_WriteRegisterWord( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ModBus_WriteRegisterWord( $InstanceID,$Value );
	return $result;
}

/**
* NC_ActivateServer
* 
* @returns boolean
* @param integer $InstanceID
*/

function NC_ActivateServer( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->NC_ActivateServer( $InstanceID );
	return $result;
}

/**
* NC_AddDevice
* 
* @returns string
* @param integer $InstanceID
* @param string $Token
* @param string $Provider
* @param string $DeviceID
* @param string $Name
* @param integer $WebFrontConfiguratorID
*/

function NC_AddDevice( $InstanceID,$Token,$Provider,$DeviceID,$Name,$WebFrontConfiguratorID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->NC_AddDevice( $InstanceID,$Token,$Provider,$DeviceID,$Name,$WebFrontConfiguratorID );
	return $result;
}

/**
* NC_GetDevices
* 
* @returns array
* @param integer $InstanceID
*/

function NC_GetDevices( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->NC_GetDevices( $InstanceID );
	return $result;
}

/**
* NC_RemoveDevice
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $DeviceID
*/

function NC_RemoveDevice( $InstanceID,$DeviceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->NC_RemoveDevice( $InstanceID,$DeviceID );
	return $result;
}

/**
* NC_RemoveDeviceConfigurator
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $DeviceID
* @param integer $WebFrontConfiguratorID
*/

function NC_RemoveDeviceConfigurator( $InstanceID,$DeviceID,$WebFrontConfiguratorID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->NC_RemoveDeviceConfigurator( $InstanceID,$DeviceID,$WebFrontConfiguratorID );
	return $result;
}

/**
* NC_SetDeviceConfigurator
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $DeviceID
* @param integer $WebFrontConfiguratorID
* @param boolean $Enabled
*/

function NC_SetDeviceConfigurator( $InstanceID,$DeviceID,$WebFrontConfiguratorID,$Enabled ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->NC_SetDeviceConfigurator( $InstanceID,$DeviceID,$WebFrontConfiguratorID,$Enabled );
	return $result;
}

/**
* NC_SetDeviceName
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $DeviceID
* @param string $Name
*/

function NC_SetDeviceName( $InstanceID,$DeviceID,$Name ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->NC_SetDeviceName( $InstanceID,$DeviceID,$Name );
	return $result;
}

/**
* NC_TestDevice
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $DeviceID
*/

function NC_TestDevice( $InstanceID,$DeviceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->NC_TestDevice( $InstanceID,$DeviceID );
	return $result;
}

/**
* NUT_Query
* 
* @returns variant
* @param integer $InstanceID
*/

function NUT_Query( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->NUT_Query( $InstanceID );
	return $result;
}

/**
* NUT_SendDataToChildren
* 
* @returns variant
* @param integer $InstanceID
* @param variant $Data
*/

function NUT_SendDataToChildren( $InstanceID,$Data ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->NUT_SendDataToChildren( $InstanceID,$Data );
	return $result;
}

/**
* NUT_UpdateEvent
* 
* @returns variant
* @param integer $InstanceID
*/

function NUT_UpdateEvent( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->NUT_UpdateEvent( $InstanceID );
	return $result;
}

/**
* OWN_Query
* 
* @returns variant
* @param integer $InstanceID
*/

function OWN_Query( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OWN_Query( $InstanceID );
	return $result;
}

/**
* OWN_SendDataToChildren
* 
* @returns variant
* @param integer $InstanceID
* @param variant $Data
*/

function OWN_SendDataToChildren( $InstanceID,$Data ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OWN_SendDataToChildren( $InstanceID,$Data );
	return $result;
}

/**
* OWN_UpdateEvent
* 
* @returns variant
* @param integer $InstanceID
*/

function OWN_UpdateEvent( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OWN_UpdateEvent( $InstanceID );
	return $result;
}

/**
* OW_GetKnownDevices
* 
* @returns array
* @param integer $InstanceID
*/

function OW_GetKnownDevices( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OW_GetKnownDevices( $InstanceID );
	return $result;
}

/**
* OW_RequestStatus
* 
* @returns boolean
* @param integer $InstanceID
*/

function OW_RequestStatus( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OW_RequestStatus( $InstanceID );
	return $result;
}

/**
* OW_SetPin
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Pin
* @param boolean $SwitchOn
*/

function OW_SetPin( $InstanceID,$Pin,$SwitchOn ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OW_SetPin( $InstanceID,$Pin,$SwitchOn );
	return $result;
}

/**
* OW_SetPort
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
*/

function OW_SetPort( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OW_SetPort( $InstanceID,$Value );
	return $result;
}

/**
* OW_SetPosition
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
*/

function OW_SetPosition( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OW_SetPosition( $InstanceID,$Value );
	return $result;
}

/**
* OW_SetStrobe
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $Status
*/

function OW_SetStrobe( $InstanceID,$Status ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OW_SetStrobe( $InstanceID,$Status );
	return $result;
}

/**
* OW_SwitchMode
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $SwitchOn
*/

function OW_SwitchMode( $InstanceID,$SwitchOn ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OW_SwitchMode( $InstanceID,$SwitchOn );
	return $result;
}

/**
* OW_ToggleMode
* 
* @returns boolean
* @param integer $InstanceID
*/

function OW_ToggleMode( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OW_ToggleMode( $InstanceID );
	return $result;
}

/**
* OW_WriteBytes
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Data
*/

function OW_WriteBytes( $InstanceID,$Data ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OW_WriteBytes( $InstanceID,$Data );
	return $result;
}

/**
* OW_WriteBytesMasked
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Data
* @param integer $Mask
*/

function OW_WriteBytesMasked( $InstanceID,$Data,$Mask ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OW_WriteBytesMasked( $InstanceID,$Data,$Mask );
	return $result;
}

/**
* OZW_GetKnownDevices
* 
* @returns array
* @param integer $InstanceID
*/

function OZW_GetKnownDevices( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OZW_GetKnownDevices( $InstanceID );
	return $result;
}

/**
* OZW_GetKnownItems
* 
* @returns array
* @param integer $InstanceID
* @param integer $RootID
*/

function OZW_GetKnownItems( $InstanceID,$RootID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OZW_GetKnownItems( $InstanceID,$RootID );
	return $result;
}

/**
* OZW_RequestStatus
* 
* @returns boolean
* @param integer $InstanceID
*/

function OZW_RequestStatus( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OZW_RequestStatus( $InstanceID );
	return $result;
}

/**
* OZW_WriteDataPoint
* 
* @returns boolean
* @param integer $InstanceID
* @param variant $Value
*/

function OZW_WriteDataPoint( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OZW_WriteDataPoint( $InstanceID,$Value );
	return $result;
}

/**
* PJ_Backlight
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $Status
*/

function PJ_Backlight( $InstanceID,$Status ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->PJ_Backlight( $InstanceID,$Status );
	return $result;
}

/**
* PJ_Beep
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $TenthOfASecond
*/

function PJ_Beep( $InstanceID,$TenthOfASecond ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->PJ_Beep( $InstanceID,$TenthOfASecond );
	return $result;
}

/**
* PJ_DimRGBW
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $R
* @param integer $RTime
* @param integer $G
* @param integer $GTime
* @param integer $B
* @param integer $BTime
* @param integer $W
* @param integer $WTime
*/

function PJ_DimRGBW( $InstanceID,$R,$RTime,$G,$GTime,$B,$BTime,$W,$WTime ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->PJ_DimRGBW( $InstanceID,$R,$RTime,$G,$GTime,$B,$BTime,$W,$WTime );
	return $result;
}

/**
* PJ_DimServo
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Channel
* @param integer $Value
* @param integer $Steps
*/

function PJ_DimServo( $InstanceID,$Channel,$Value,$Steps ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->PJ_DimServo( $InstanceID,$Channel,$Value,$Steps );
	return $result;
}

/**
* PJ_LCDText
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Line
* @param string $Text
*/

function PJ_LCDText( $InstanceID,$Line,$Text ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->PJ_LCDText( $InstanceID,$Line,$Text );
	return $result;
}

/**
* PJ_RequestStatus
* 
* @returns boolean
* @param integer $InstanceID
*/

function PJ_RequestStatus( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->PJ_RequestStatus( $InstanceID );
	return $result;
}

/**
* PJ_RunProgram
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Type
*/

function PJ_RunProgram( $InstanceID,$Type ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->PJ_RunProgram( $InstanceID,$Type );
	return $result;
}

/**
* PJ_SetLEDs
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $Green
* @param boolean $Yellow
* @param boolean $Red
*/

function PJ_SetLEDs( $InstanceID,$Green,$Yellow,$Red ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->PJ_SetLEDs( $InstanceID,$Green,$Yellow,$Red );
	return $result;
}

/**
* PJ_SetRGBW
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $R
* @param integer $G
* @param integer $B
* @param integer $W
*/

function PJ_SetRGBW( $InstanceID,$R,$G,$B,$W ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->PJ_SetRGBW( $InstanceID,$R,$G,$B,$W );
	return $result;
}

/**
* PJ_SetServo
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Channel
* @param integer $Value
*/

function PJ_SetServo( $InstanceID,$Channel,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->PJ_SetServo( $InstanceID,$Channel,$Value );
	return $result;
}

/**
* PJ_SwitchDuration
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $DeviceOn
* @param integer $Duration
*/

function PJ_SwitchDuration( $InstanceID,$DeviceOn,$Duration ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->PJ_SwitchDuration( $InstanceID,$DeviceOn,$Duration );
	return $result;
}

/**
* PJ_SwitchLED
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $LED
* @param boolean $Status
*/

function PJ_SwitchLED( $InstanceID,$LED,$Status ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->PJ_SwitchLED( $InstanceID,$LED,$Status );
	return $result;
}

/**
* PJ_SwitchMode
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $DeviceOn
*/

function PJ_SwitchMode( $InstanceID,$DeviceOn ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->PJ_SwitchMode( $InstanceID,$DeviceOn );
	return $result;
}

/**
* POP3_GetCachedMails
* 
* @returns array
* @param integer $InstanceID
*/

function POP3_GetCachedMails( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->POP3_GetCachedMails( $InstanceID );
	return $result;
}

/**
* POP3_GetMailEx
* 
* @returns array
* @param integer $InstanceID
* @param string $UID
*/

function POP3_GetMailEx( $InstanceID,$UID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->POP3_GetMailEx( $InstanceID,$UID );
	return $result;
}

/**
* POP3_UpdateCache
* 
* @returns boolean
* @param integer $InstanceID
*/

function POP3_UpdateCache( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->POP3_UpdateCache( $InstanceID );
	return $result;
}

/**
* RegVar_GetBuffer
* 
* @returns string
* @param integer $InstanceID
*/

function RegVar_GetBuffer( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->RegVar_GetBuffer( $InstanceID );
	return $result;
}

/**
* RegVar_SendText
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Text
*/

function RegVar_SendText( $InstanceID,$Text ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->RegVar_SendText( $InstanceID,$Text );
	return $result;
}

/**
* RegVar_SetBuffer
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Text
*/

function RegVar_SetBuffer( $InstanceID,$Text ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->RegVar_SetBuffer( $InstanceID,$Text );
	return $result;
}

/**
* S7_RequestRead
* 
* @returns boolean
* @param integer $InstanceID
*/

function S7_RequestRead( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->S7_RequestRead( $InstanceID );
	return $result;
}

/**
* S7_Write
* 
* @returns boolean
* @param integer $InstanceID
* @param float $Value
*/

function S7_Write( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->S7_Write( $InstanceID,$Value );
	return $result;
}

/**
* S7_WriteBit
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $Value
*/

function S7_WriteBit( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->S7_WriteBit( $InstanceID,$Value );
	return $result;
}

/**
* S7_WriteByte
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
*/

function S7_WriteByte( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->S7_WriteByte( $InstanceID,$Value );
	return $result;
}

/**
* S7_WriteDWord
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
*/

function S7_WriteDWord( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->S7_WriteDWord( $InstanceID,$Value );
	return $result;
}

/**
* S7_WriteInteger
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
*/

function S7_WriteInteger( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->S7_WriteInteger( $InstanceID,$Value );
	return $result;
}

/**
* S7_WriteReal
* 
* @returns boolean
* @param integer $InstanceID
* @param float $Value
*/

function S7_WriteReal( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->S7_WriteReal( $InstanceID,$Value );
	return $result;
}

/**
* S7_WriteShortInt
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
*/

function S7_WriteShortInt( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->S7_WriteShortInt( $InstanceID,$Value );
	return $result;
}

/**
* S7_WriteSmallInt
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
*/

function S7_WriteSmallInt( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->S7_WriteSmallInt( $InstanceID,$Value );
	return $result;
}

/**
* S7_WriteWord
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
*/

function S7_WriteWord( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->S7_WriteWord( $InstanceID,$Value );
	return $result;
}

/**
* SC_CreateSkin
* 
* @returns boolean
* @param integer $InstanceID
* @param string $SkinURL
*/

function SC_CreateSkin( $InstanceID,$SkinURL ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SC_CreateSkin( $InstanceID,$SkinURL );
	return $result;
}

/**
* SC_DeleteSkin
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Skin
*/

function SC_DeleteSkin( $InstanceID,$Skin ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SC_DeleteSkin( $InstanceID,$Skin );
	return $result;
}

/**
* SC_GetSkin
* 
* @returns array
* @param integer $InstanceID
* @param string $Skin
*/

function SC_GetSkin( $InstanceID,$Skin ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SC_GetSkin( $InstanceID,$Skin );
	return $result;
}

/**
* SC_GetSkinIconContent
* 
* @returns string
* @param integer $InstanceID
* @param string $Skin
* @param string $Icon
*/

function SC_GetSkinIconContent( $InstanceID,$Skin,$Icon ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SC_GetSkinIconContent( $InstanceID,$Skin,$Icon );
	return $result;
}

/**
* SC_GetSkinList
* 
* @returns array
* @param integer $InstanceID
*/

function SC_GetSkinList( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SC_GetSkinList( $InstanceID );
	return $result;
}

/**
* SC_GetSkinRepositoryInfo
* 
* @returns array
* @param integer $InstanceID
* @param string $Skin
*/

function SC_GetSkinRepositoryInfo( $InstanceID,$Skin ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SC_GetSkinRepositoryInfo( $InstanceID,$Skin );
	return $result;
}

/**
* SC_Move
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Position
*/

function SC_Move( $InstanceID,$Position ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SC_Move( $InstanceID,$Position );
	return $result;
}

/**
* SC_MoveDown
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Duration
*/

function SC_MoveDown( $InstanceID,$Duration ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SC_MoveDown( $InstanceID,$Duration );
	return $result;
}

/**
* SC_MoveUp
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Duration
*/

function SC_MoveUp( $InstanceID,$Duration ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SC_MoveUp( $InstanceID,$Duration );
	return $result;
}

/**
* SC_Stop
* 
* @returns boolean
* @param integer $InstanceID
*/

function SC_Stop( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SC_Stop( $InstanceID );
	return $result;
}

/**
* SC_UpdateSkin
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Skin
*/

function SC_UpdateSkin( $InstanceID,$Skin ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SC_UpdateSkin( $InstanceID,$Skin );
	return $result;
}

/**
* SMS_RequestBalance
* 
* @returns float
* @param integer $InstanceID
*/

function SMS_RequestBalance( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SMS_RequestBalance( $InstanceID );
	return $result;
}

/**
* SMS_RequestStatus
* 
* @returns string
* @param integer $InstanceID
* @param string $MsgID
*/

function SMS_RequestStatus( $InstanceID,$MsgID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SMS_RequestStatus( $InstanceID,$MsgID );
	return $result;
}

/**
* SMS_Send
* 
* @returns string
* @param integer $InstanceID
* @param string $Number
* @param string $Text
*/

function SMS_Send( $InstanceID,$Number,$Text ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SMS_Send( $InstanceID,$Number,$Text );
	return $result;
}

/**
* SMTP_SendMail
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Subject
* @param string $Textg
*/

function SMTP_SendMail( $InstanceID,$Subject,$Textg ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SMTP_SendMail( $InstanceID,$Subject,$Textg );
	return $result;
}

/**
* SMTP_SendMailAttachment
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Subject
* @param string $Text
* @param string $Filename
*/

function SMTP_SendMailAttachment( $InstanceID,$Subject,$Text,$Filename ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SMTP_SendMailAttachment( $InstanceID,$Subject,$Text,$Filename );
	return $result;
}

/**
* SMTP_SendMailAttachmentEx
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Address
* @param string $Subject
* @param string $Text
* @param string $Filename
*/

function SMTP_SendMailAttachmentEx( $InstanceID,$Address,$Subject,$Text,$Filename ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SMTP_SendMailAttachmentEx( $InstanceID,$Address,$Subject,$Text,$Filename );
	return $result;
}

/**
* SMTP_SendMailEx
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Address
* @param string $Subject
* @param string $Text
*/

function SMTP_SendMailEx( $InstanceID,$Address,$Subject,$Text ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SMTP_SendMailEx( $InstanceID,$Address,$Subject,$Text );
	return $result;
}

/**
* SMTP_SendMailMedia
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Subject
* @param string $Text
* @param integer $MediaID
*/

function SMTP_SendMailMedia( $InstanceID,$Subject,$Text,$MediaID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SMTP_SendMailMedia( $InstanceID,$Subject,$Text,$MediaID );
	return $result;
}

/**
* SMTP_SendMailMediaEx
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Address
* @param string $Subject
* @param string $Text
* @param integer $MediaID
*/

function SMTP_SendMailMediaEx( $InstanceID,$Address,$Subject,$Text,$MediaID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SMTP_SendMailMediaEx( $InstanceID,$Address,$Subject,$Text,$MediaID );
	return $result;
}

/**
* SPRT_SendText
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Text
*/

function SPRT_SendText( $InstanceID,$Text ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SPRT_SendText( $InstanceID,$Text );
	return $result;
}

/**
* SPRT_SetBreak
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $OnOff
*/

function SPRT_SetBreak( $InstanceID,$OnOff ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SPRT_SetBreak( $InstanceID,$OnOff );
	return $result;
}

/**
* SPRT_SetDTR
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $OnOff
*/

function SPRT_SetDTR( $InstanceID,$OnOff ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SPRT_SetDTR( $InstanceID,$OnOff );
	return $result;
}

/**
* SPRT_SetRTS
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $OnOff
*/

function SPRT_SetRTS( $InstanceID,$OnOff ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SPRT_SetRTS( $InstanceID,$OnOff );
	return $result;
}

/**
* SSCK_SendText
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Text
*/

function SSCK_SendText( $InstanceID,$Text ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SSCK_SendText( $InstanceID,$Text );
	return $result;
}

/**
* SWD_DimDown
* 
* @returns variant
* @param integer $InstanceID
*/

function SWD_DimDown( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SWD_DimDown( $InstanceID );
	return $result;
}

/**
* SWD_DimUp
* 
* @returns variant
* @param integer $InstanceID
*/

function SWD_DimUp( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SWD_DimUp( $InstanceID );
	return $result;
}

/**
* SWD_SendDataToParent
* 
* @returns variant
* @param integer $InstanceID
* @param variant $Data
*/

function SWD_SendDataToParent( $InstanceID,$Data ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SWD_SendDataToParent( $InstanceID,$Data );
	return $result;
}

/**
* SWD_SetDuration
* 
* @returns variant
* @param integer $InstanceID
* @param variant $duration
*/

function SWD_SetDuration( $InstanceID,$duration ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SWD_SetDuration( $InstanceID,$duration );
	return $result;
}

/**
* SWD_SetIntensity
* 
* @returns variant
* @param integer $InstanceID
* @param variant $percent
*/

function SWD_SetIntensity( $InstanceID,$percent ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SWD_SetIntensity( $InstanceID,$percent );
	return $result;
}

/**
* SWD_SetSwitchMode
* 
* @returns variant
* @param integer $InstanceID
* @param variant $val
*/

function SWD_SetSwitchMode( $InstanceID,$val ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SWD_SetSwitchMode( $InstanceID,$val );
	return $result;
}

/**
* SWD_TimerEvent
* 
* @returns variant
* @param integer $InstanceID
*/

function SWD_TimerEvent( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SWD_TimerEvent( $InstanceID );
	return $result;
}

/**
* SetValue
* 
* @returns boolean
* @param integer $VariableID
* @param variant $Value
*/

function SetValue( $VariableID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SetValue( $VariableID,$Value );
	return $result;
}

/**
* SetValueBoolean
* 
* @returns boolean
* @param integer $VariableID
* @param boolean $Value
*/

function SetValueBoolean( $VariableID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SetValueBoolean( $VariableID,$Value );
	return $result;
}

/**
* SetValueFloat
* 
* @returns boolean
* @param integer $VariableID
* @param float $Value
*/

function SetValueFloat( $VariableID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SetValueFloat( $VariableID,$Value );
	return $result;
}

/**
* SetValueInteger
* 
* @returns boolean
* @param integer $VariableID
* @param integer $Value
*/

function SetValueInteger( $VariableID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SetValueInteger( $VariableID,$Value );
	return $result;
}

/**
* SetValueString
* 
* @returns boolean
* @param integer $VariableID
* @param string $Value
*/

function SetValueString( $VariableID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SetValueString( $VariableID,$Value );
	return $result;
}

/**
* Sys_GetBattery
* 
* @returns array
*/

function Sys_GetBattery(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->Sys_GetBattery(  );
	return $result;
}

/**
* Sys_GetCPUInfo
* 
* @returns array
*/

function Sys_GetCPUInfo(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->Sys_GetCPUInfo(  );
	return $result;
}

/**
* Sys_GetHardDiskInfo
* 
* @returns array
*/

function Sys_GetHardDiskInfo(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->Sys_GetHardDiskInfo(  );
	return $result;
}

/**
* Sys_GetMemoryInfo
* 
* @returns array
*/

function Sys_GetMemoryInfo(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->Sys_GetMemoryInfo(  );
	return $result;
}

/**
* Sys_GetNetworkInfo
* 
* @returns array
*/

function Sys_GetNetworkInfo(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->Sys_GetNetworkInfo(  );
	return $result;
}

/**
* Sys_GetProcessInfo
* 
* @returns array
*/

function Sys_GetProcessInfo(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->Sys_GetProcessInfo(  );
	return $result;
}

/**
* Sys_GetSpooler
* 
* @returns array
*/

function Sys_GetSpooler(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->Sys_GetSpooler(  );
	return $result;
}

/**
* Sys_GetURLContent
* 
* @returns string
* @param string $URL
*/

function Sys_GetURLContent( $URL ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->Sys_GetURLContent( $URL );
	return $result;
}

/**
* Sys_GetURLContentEx
* 
* @returns string
* @param string $URL
* @param array $Options
*/

function Sys_GetURLContentEx( $URL,$Options ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->Sys_GetURLContentEx( $URL,$Options );
	return $result;
}

/**
* Sys_Ping
* 
* @returns boolean
* @param string $Host
* @param integer $Timeout
*/

function Sys_Ping( $Host,$Timeout ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->Sys_Ping( $Host,$Timeout );
	return $result;
}

/**
* TE923_Query
* 
* @returns variant
* @param integer $InstanceID
*/

function TE923_Query( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TE923_Query( $InstanceID );
	return $result;
}

/**
* TE923_SendDataToChildren
* 
* @returns variant
* @param integer $InstanceID
* @param variant $Data
*/

function TE923_SendDataToChildren( $InstanceID,$Data ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TE923_SendDataToChildren( $InstanceID,$Data );
	return $result;
}

/**
* TE923_UpdateEvent
* 
* @returns variant
* @param integer $InstanceID
*/

function TE923_UpdateEvent( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TE923_UpdateEvent( $InstanceID );
	return $result;
}

/**
* TTS_GenerateFile
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Text
* @param string $Filename
* @param integer $Format
*/

function TTS_GenerateFile( $InstanceID,$Text,$Filename,$Format ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TTS_GenerateFile( $InstanceID,$Text,$Filename,$Format );
	return $result;
}

/**
* TTS_Speak
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Text
* @param boolean $Wait
*/

function TTS_Speak( $InstanceID,$Text,$Wait ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TTS_Speak( $InstanceID,$Text,$Wait );
	return $result;
}

/**
* UC_FindInFiles
* 
* @returns array
* @param integer $InstanceID
* @param array $Files
* @param string $SearchStr
*/

function UC_FindInFiles( $InstanceID,$Files,$SearchStr ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->UC_FindInFiles( $InstanceID,$Files,$SearchStr );
	return $result;
}

/**
* UC_RenameScript
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $ScriptID
* @param string $Filename
*/

function UC_RenameScript( $InstanceID,$ScriptID,$Filename ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->UC_RenameScript( $InstanceID,$ScriptID,$Filename );
	return $result;
}

/**
* UC_ReplaceInFiles
* 
* @returns array
* @param integer $InstanceID
* @param array $Files
* @param string $SearchStr
* @param string $ReplaceStr
*/

function UC_ReplaceInFiles( $InstanceID,$Files,$SearchStr,$ReplaceStr ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->UC_ReplaceInFiles( $InstanceID,$Files,$SearchStr,$ReplaceStr );
	return $result;
}

/**
* USCK_SendText
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Text
*/

function USCK_SendText( $InstanceID,$Text ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->USCK_SendText( $InstanceID,$Text );
	return $result;
}

/**
* UVR_UpdateValues
* 
* @returns boolean
* @param integer $InstanceID
*/

function UVR_UpdateValues( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->UVR_UpdateValues( $InstanceID );
	return $result;
}

/**
* VELLEUSB_ReadAnalogChannel
* 
* @returns integer
* @param integer $InstanceID
* @param integer $Channel
*/

function VELLEUSB_ReadAnalogChannel( $InstanceID,$Channel ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VELLEUSB_ReadAnalogChannel( $InstanceID,$Channel );
	return $result;
}

/**
* VELLEUSB_ReadCounter
* 
* @returns integer
* @param integer $InstanceID
* @param integer $Counter
*/

function VELLEUSB_ReadCounter( $InstanceID,$Counter ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VELLEUSB_ReadCounter( $InstanceID,$Counter );
	return $result;
}

/**
* VELLEUSB_ReadDigital
* 
* @returns integer
* @param integer $InstanceID
*/

function VELLEUSB_ReadDigital( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VELLEUSB_ReadDigital( $InstanceID );
	return $result;
}

/**
* VELLEUSB_ReadDigitalChannel
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Channel
*/

function VELLEUSB_ReadDigitalChannel( $InstanceID,$Channel ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VELLEUSB_ReadDigitalChannel( $InstanceID,$Channel );
	return $result;
}

/**
* VELLEUSB_ResetCounter
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Counter
*/

function VELLEUSB_ResetCounter( $InstanceID,$Counter ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VELLEUSB_ResetCounter( $InstanceID,$Counter );
	return $result;
}

/**
* VELLEUSB_SetCounterDebounceTime
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Counter
* @param integer $Time
*/

function VELLEUSB_SetCounterDebounceTime( $InstanceID,$Counter,$Time ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VELLEUSB_SetCounterDebounceTime( $InstanceID,$Counter,$Time );
	return $result;
}

/**
* VELLEUSB_WriteAnalogChannel
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Channel
* @param integer $Value
*/

function VELLEUSB_WriteAnalogChannel( $InstanceID,$Channel,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VELLEUSB_WriteAnalogChannel( $InstanceID,$Channel,$Value );
	return $result;
}

/**
* VELLEUSB_WriteDigital
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
*/

function VELLEUSB_WriteDigital( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VELLEUSB_WriteDigital( $InstanceID,$Value );
	return $result;
}

/**
* VELLEUSB_WriteDigitalChannel
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Channel
* @param boolean $Value
*/

function VELLEUSB_WriteDigitalChannel( $InstanceID,$Channel,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VELLEUSB_WriteDigitalChannel( $InstanceID,$Channel,$Value );
	return $result;
}

/**
* VIO_PushText
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Text
*/

function VIO_PushText( $InstanceID,$Text ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VIO_PushText( $InstanceID,$Text );
	return $result;
}

/**
* VIO_PushTextHEX
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Text
*/

function VIO_PushTextHEX( $InstanceID,$Text ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VIO_PushTextHEX( $InstanceID,$Text );
	return $result;
}

/**
* VIO_SendText
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Text
*/

function VIO_SendText( $InstanceID,$Text ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VIO_SendText( $InstanceID,$Text );
	return $result;
}

/**
* WAC_AddFile
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Filename
*/

function WAC_AddFile( $InstanceID,$Filename ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WAC_AddFile( $InstanceID,$Filename );
	return $result;
}

/**
* WAC_ClearPlaylist
* 
* @returns boolean
* @param integer $InstanceID
*/

function WAC_ClearPlaylist( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WAC_ClearPlaylist( $InstanceID );
	return $result;
}

/**
* WAC_GetPlaylistFile
* 
* @returns string
* @param integer $InstanceID
* @param integer $Position
*/

function WAC_GetPlaylistFile( $InstanceID,$Position ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WAC_GetPlaylistFile( $InstanceID,$Position );
	return $result;
}

/**
* WAC_GetPlaylistLength
* 
* @returns integer
* @param integer $InstanceID
*/

function WAC_GetPlaylistLength( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WAC_GetPlaylistLength( $InstanceID );
	return $result;
}

/**
* WAC_GetPlaylistPosition
* 
* @returns integer
* @param integer $InstanceID
*/

function WAC_GetPlaylistPosition( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WAC_GetPlaylistPosition( $InstanceID );
	return $result;
}

/**
* WAC_GetPlaylistTitle
* 
* @returns string
* @param integer $InstanceID
* @param integer $Position
*/

function WAC_GetPlaylistTitle( $InstanceID,$Position ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WAC_GetPlaylistTitle( $InstanceID,$Position );
	return $result;
}

/**
* WAC_Next
* 
* @returns boolean
* @param integer $InstanceID
*/

function WAC_Next( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WAC_Next( $InstanceID );
	return $result;
}

/**
* WAC_Pause
* 
* @returns boolean
* @param integer $InstanceID
*/

function WAC_Pause( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WAC_Pause( $InstanceID );
	return $result;
}

/**
* WAC_Play
* 
* @returns boolean
* @param integer $InstanceID
*/

function WAC_Play( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WAC_Play( $InstanceID );
	return $result;
}

/**
* WAC_PlayFile
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Filename
*/

function WAC_PlayFile( $InstanceID,$Filename ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WAC_PlayFile( $InstanceID,$Filename );
	return $result;
}

/**
* WAC_Prev
* 
* @returns boolean
* @param integer $InstanceID
*/

function WAC_Prev( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WAC_Prev( $InstanceID );
	return $result;
}

/**
* WAC_SetPlaylistPosition
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Position
*/

function WAC_SetPlaylistPosition( $InstanceID,$Position ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WAC_SetPlaylistPosition( $InstanceID,$Position );
	return $result;
}

/**
* WAC_SetPosition
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Seconds
*/

function WAC_SetPosition( $InstanceID,$Seconds ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WAC_SetPosition( $InstanceID,$Seconds );
	return $result;
}

/**
* WAC_SetRepeat
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $DoRepeat
*/

function WAC_SetRepeat( $InstanceID,$DoRepeat ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WAC_SetRepeat( $InstanceID,$DoRepeat );
	return $result;
}

/**
* WAC_SetShuffle
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $DoShuffle
*/

function WAC_SetShuffle( $InstanceID,$DoShuffle ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WAC_SetShuffle( $InstanceID,$DoShuffle );
	return $result;
}

/**
* WAC_SetVolume
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Volume
*/

function WAC_SetVolume( $InstanceID,$Volume ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WAC_SetVolume( $InstanceID,$Volume );
	return $result;
}

/**
* WAC_Stop
* 
* @returns boolean
* @param integer $InstanceID
*/

function WAC_Stop( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WAC_Stop( $InstanceID );
	return $result;
}

/**
* WDE1_ReInitEvent
* 
* @returns variant
* @param integer $InstanceID
*/

function WDE1_ReInitEvent( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WDE1_ReInitEvent( $InstanceID );
	return $result;
}

/**
* WDE1_ReadRecord
* 
* @returns variant
* @param integer $InstanceID
* @param variant $inbuf
*/

function WDE1_ReadRecord( $InstanceID,$inbuf ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WDE1_ReadRecord( $InstanceID,$inbuf );
	return $result;
}

/**
* WDE1_SendDataToChildren
* 
* @returns variant
* @param integer $InstanceID
* @param variant $Data
*/

function WDE1_SendDataToChildren( $InstanceID,$Data ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WDE1_SendDataToChildren( $InstanceID,$Data );
	return $result;
}

/**
* WDE1_SendDataToParent
* 
* @returns variant
* @param integer $InstanceID
* @param variant $Data
*/

function WDE1_SendDataToParent( $InstanceID,$Data ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WDE1_SendDataToParent( $InstanceID,$Data );
	return $result;
}

/**
* WDE1_SetRainPerCount
* 
* @returns variant
* @param integer $InstanceID
* @param variant $rainpercount
*/

function WDE1_SetRainPerCount( $InstanceID,$rainpercount ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WDE1_SetRainPerCount( $InstanceID,$rainpercount );
	return $result;
}

/**
* WFC_AddItem
* 
* @returns boolean
* @param integer $InstanceID
* @param string $ID
* @param string $ClassName
* @param string $Configuration
* @param string $ParentID
*/

function WFC_AddItem( $InstanceID,$ID,$ClassName,$Configuration,$ParentID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_AddItem( $InstanceID,$ID,$ClassName,$Configuration,$ParentID );
	return $result;
}

/**
* WFC_AudioNotification
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Title
* @param integer $MediaID
*/

function WFC_AudioNotification( $InstanceID,$Title,$MediaID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_AudioNotification( $InstanceID,$Title,$MediaID );
	return $result;
}

/**
* WFC_DeleteItem
* 
* @returns boolean
* @param integer $InstanceID
* @param string $ID
*/

function WFC_DeleteItem( $InstanceID,$ID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_DeleteItem( $InstanceID,$ID );
	return $result;
}

/**
* WFC_Execute
* 
* @returns string
* @param integer $InstanceID
* @param integer $ActionID
* @param integer $TargetID
* @param variant $Value
*/

function WFC_Execute( $InstanceID,$ActionID,$TargetID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_Execute( $InstanceID,$ActionID,$TargetID,$Value );
	return $result;
}

/**
* WFC_GetAggregatedValues
* 
* @returns array
* @param integer $InstanceID
* @param integer $VariableID
* @param integer $AggregationSpan
*   enum[0=agHour, 1=agDay, 2=agWeek, 3=agMonth, 4=agYear, 5=ag5Minutes, 6=ag1Minute, 7=agChanges]
* @param integer $StartTime
* @param integer $EndTime
* @param integer $Limit
*/

function WFC_GetAggregatedValues( $InstanceID,$VariableID,$AggregationSpan,$StartTime,$EndTime,$Limit ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_GetAggregatedValues( $InstanceID,$VariableID,$AggregationSpan,$StartTime,$EndTime,$Limit );
	return $result;
}

/**
* WFC_GetItems
* 
* @returns array
* @param integer $InstanceID
*/

function WFC_GetItems( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_GetItems( $InstanceID );
	return $result;
}

/**
* WFC_GetLoggedValues
* 
* @returns array
* @param integer $InstanceID
* @param integer $VariableID
* @param integer $StartTime
* @param integer $EndTime
* @param integer $Limit
*/

function WFC_GetLoggedValues( $InstanceID,$VariableID,$StartTime,$EndTime,$Limit ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_GetLoggedValues( $InstanceID,$VariableID,$StartTime,$EndTime,$Limit );
	return $result;
}

/**
* WFC_GetSnapshot
* 
* @returns string
* @param integer $InstanceID
*/

function WFC_GetSnapshot( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_GetSnapshot( $InstanceID );
	return $result;
}

/**
* WFC_GetSnapshotChanges
* 
* @returns string
* @param integer $InstanceID
* @param integer $LastTimeStamp
*/

function WFC_GetSnapshotChanges( $InstanceID,$LastTimeStamp ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_GetSnapshotChanges( $InstanceID,$LastTimeStamp );
	return $result;
}

/**
* WFC_GetSnapshotChangesEx
* 
* @returns string
* @param integer $InstanceID
* @param integer $CategoryID
* @param integer $LastTimeStamp
*/

function WFC_GetSnapshotChangesEx( $InstanceID,$CategoryID,$LastTimeStamp ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_GetSnapshotChangesEx( $InstanceID,$CategoryID,$LastTimeStamp );
	return $result;
}

/**
* WFC_GetSnapshotEx
* 
* @returns string
* @param integer $InstanceID
* @param integer $CategoryID
*/

function WFC_GetSnapshotEx( $InstanceID,$CategoryID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_GetSnapshotEx( $InstanceID,$CategoryID );
	return $result;
}

/**
* WFC_PushNotification
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Title
* @param string $Text
* @param string $Sound
* @param integer $TargetID
*/

function WFC_PushNotification( $InstanceID,$Title,$Text,$Sound,$TargetID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_PushNotification( $InstanceID,$Title,$Text,$Sound,$TargetID );
	return $result;
}

/**
* WFC_RegisterPNS
* 
* @returns string
* @param integer $InstanceID
* @param string $Token
* @param string $Provider
* @param string $DeviceID
* @param string $DeviceName
*/

function WFC_RegisterPNS( $InstanceID,$Token,$Provider,$DeviceID,$DeviceName ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_RegisterPNS( $InstanceID,$Token,$Provider,$DeviceID,$DeviceName );
	return $result;
}

/**
* WFC_Reload
* 
* @returns boolean
* @param integer $InstanceID
*/

function WFC_Reload( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_Reload( $InstanceID );
	return $result;
}

/**
* WFC_RenderChart
* 
* @returns string
* @param integer $InstanceID
* @param integer $ObjectID
* @param integer $StartTime
* @param integer $TimeSpan
*   enum[0=tsHour, 1=tsDay, 2=tsWeek, 3=tsMonth, 4=tsYear, 5=tsDecade]
* @param boolean $IsHD
* @param boolean $IsExtrema
* @param boolean $IsDyn
* @param integer $Width
* @param integer $Height
*/

function WFC_RenderChart( $InstanceID,$ObjectID,$StartTime,$TimeSpan,$IsHD,$IsExtrema,$IsDyn,$Width,$Height ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_RenderChart( $InstanceID,$ObjectID,$StartTime,$TimeSpan,$IsHD,$IsExtrema,$IsDyn,$Width,$Height );
	return $result;
}

/**
* WFC_SendNotification
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Title
* @param string $Text
* @param string $Icon
* @param integer $Timeout
*/

function WFC_SendNotification( $InstanceID,$Title,$Text,$Icon,$Timeout ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_SendNotification( $InstanceID,$Title,$Text,$Icon,$Timeout );
	return $result;
}

/**
* WFC_SendPopup
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Title
* @param string $Text
*/

function WFC_SendPopup( $InstanceID,$Title,$Text ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_SendPopup( $InstanceID,$Title,$Text );
	return $result;
}

/**
* WFC_SetItems
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Items
*/

function WFC_SetItems( $InstanceID,$Items ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_SetItems( $InstanceID,$Items );
	return $result;
}

/**
* WFC_SwitchPage
* 
* @returns boolean
* @param integer $InstanceID
* @param string $PageName
*/

function WFC_SwitchPage( $InstanceID,$PageName ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_SwitchPage( $InstanceID,$PageName );
	return $result;
}

/**
* WFC_UpdateConfiguration
* 
* @returns boolean
* @param integer $InstanceID
* @param string $ID
* @param string $Configuration
*/

function WFC_UpdateConfiguration( $InstanceID,$ID,$Configuration ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_UpdateConfiguration( $InstanceID,$ID,$Configuration );
	return $result;
}

/**
* WFC_UpdateParentID
* 
* @returns boolean
* @param integer $InstanceID
* @param string $ID
* @param string $ParentID
*/

function WFC_UpdateParentID( $InstanceID,$ID,$ParentID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_UpdateParentID( $InstanceID,$ID,$ParentID );
	return $result;
}

/**
* WFC_UpdatePosition
* 
* @returns boolean
* @param integer $InstanceID
* @param string $ID
* @param integer $Position
*/

function WFC_UpdatePosition( $InstanceID,$ID,$Position ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_UpdatePosition( $InstanceID,$ID,$Position );
	return $result;
}

/**
* WFC_UpdateVisibility
* 
* @returns boolean
* @param integer $InstanceID
* @param string $ID
* @param boolean $Visible
*/

function WFC_UpdateVisibility( $InstanceID,$ID,$Visible ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_UpdateVisibility( $InstanceID,$ID,$Visible );
	return $result;
}

/**
* WS2500PC_Query
* 
* @returns variant
* @param integer $InstanceID
*/

function WS2500PC_Query( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WS2500PC_Query( $InstanceID );
	return $result;
}

/**
* WS2500PC_SendDataToChildren
* 
* @returns variant
* @param integer $InstanceID
* @param variant $Data
*/

function WS2500PC_SendDataToChildren( $InstanceID,$Data ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WS2500PC_SendDataToChildren( $InstanceID,$Data );
	return $result;
}

/**
* WS2500PC_UpdateEvent
* 
* @returns variant
* @param integer $InstanceID
*/

function WS2500PC_UpdateEvent( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WS2500PC_UpdateEvent( $InstanceID );
	return $result;
}

/**
* WS300PC_GetHistoryCount
* 
* @returns variant
* @param integer $InstanceID
*/

function WS300PC_GetHistoryCount( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WS300PC_GetHistoryCount( $InstanceID );
	return $result;
}

/**
* WS300PC_GetVersion
* 
* @returns variant
* @param integer $InstanceID
*/

function WS300PC_GetVersion( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WS300PC_GetVersion( $InstanceID );
	return $result;
}

/**
* WS300PC_ReInitEvent
* 
* @returns variant
* @param integer $InstanceID
*/

function WS300PC_ReInitEvent( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WS300PC_ReInitEvent( $InstanceID );
	return $result;
}

/**
* WS300PC_ReadCurrentRecord
* 
* @returns variant
* @param integer $InstanceID
*/

function WS300PC_ReadCurrentRecord( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WS300PC_ReadCurrentRecord( $InstanceID );
	return $result;
}

/**
* WS300PC_ReadNextRecord
* 
* @returns variant
* @param integer $InstanceID
*/

function WS300PC_ReadNextRecord( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WS300PC_ReadNextRecord( $InstanceID );
	return $result;
}

/**
* WS300PC_SendDataToChildren
* 
* @returns variant
* @param integer $InstanceID
* @param variant $Data
*/

function WS300PC_SendDataToChildren( $InstanceID,$Data ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WS300PC_SendDataToChildren( $InstanceID,$Data );
	return $result;
}

/**
* WS300PC_SendDataToParent
* 
* @returns variant
* @param integer $InstanceID
* @param variant $Data
*/

function WS300PC_SendDataToParent( $InstanceID,$Data ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WS300PC_SendDataToParent( $InstanceID,$Data );
	return $result;
}

/**
* WS300PC_SetHistoryCount
* 
* @returns variant
* @param integer $InstanceID
* @param variant $val
*/

function WS300PC_SetHistoryCount( $InstanceID,$val ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WS300PC_SetHistoryCount( $InstanceID,$val );
	return $result;
}

/**
* WS300PC_UpdateEvent
* 
* @returns variant
* @param integer $InstanceID
*/

function WS300PC_UpdateEvent( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WS300PC_UpdateEvent( $InstanceID );
	return $result;
}

/**
* WS300PC_WriteConfig
* 
* @returns variant
* @param integer $InstanceID
*/

function WS300PC_WriteConfig( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WS300PC_WriteConfig( $InstanceID );
	return $result;
}

/**
* WUE_ReInitEvent
* 
* @returns variant
* @param integer $InstanceID
*/

function WUE_ReInitEvent( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WUE_ReInitEvent( $InstanceID );
	return $result;
}

/**
* WUE_SendDataToParent
* 
* @returns variant
* @param integer $InstanceID
* @param variant $Data
*/

function WUE_SendDataToParent( $InstanceID,$Data ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WUE_SendDataToParent( $InstanceID,$Data );
	return $result;
}

/**
* WUE_SetRainPerCount
* 
* @returns variant
* @param integer $InstanceID
* @param variant $rainpercount
*/

function WUE_SetRainPerCount( $InstanceID,$rainpercount ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WUE_SetRainPerCount( $InstanceID,$rainpercount );
	return $result;
}

/**
* WWW_UpdatePage
* 
* @returns boolean
* @param integer $InstanceID
*/

function WWW_UpdatePage( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WWW_UpdatePage( $InstanceID );
	return $result;
}

/**
* WinLIRC_SendOnce
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Remote
* @param string $Button
*/

function WinLIRC_SendOnce( $InstanceID,$Remote,$Button ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WinLIRC_SendOnce( $InstanceID,$Remote,$Button );
	return $result;
}

/**
* WuT_SwitchMode
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $DeviceOn
*/

function WuT_SwitchMode( $InstanceID,$DeviceOn ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WuT_SwitchMode( $InstanceID,$DeviceOn );
	return $result;
}

/**
* WuT_UpdateValue
* 
* @returns boolean
* @param integer $InstanceID
*/

function WuT_UpdateValue( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WuT_UpdateValue( $InstanceID );
	return $result;
}

/**
* WuT_UpdateValues
* 
* @returns boolean
* @param integer $InstanceID
*/

function WuT_UpdateValues( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WuT_UpdateValues( $InstanceID );
	return $result;
}

/**
* XBee_SendBuffer
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $DestinationDevice
* @param string $Buffer
*/

function XBee_SendBuffer( $InstanceID,$DestinationDevice,$Buffer ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->XBee_SendBuffer( $InstanceID,$DestinationDevice,$Buffer );
	return $result;
}

/**
* XBee_SendCommand
* 
* @returns string
* @param integer $InstanceID
* @param string $Command
*/

function XBee_SendCommand( $InstanceID,$Command ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->XBee_SendCommand( $InstanceID,$Command );
	return $result;
}

/**
* XS1_SwitchMode
* 
* @returns variant
* @param integer $InstanceID
* @param variant $dev
* @param variant $val
*/

function XS1_SwitchMode( $InstanceID,$dev,$val ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->XS1_SwitchMode( $InstanceID,$dev,$val );
	return $result;
}

/**
* XS1_UpdateEvent
* 
* @returns variant
* @param integer $InstanceID
*/

function XS1_UpdateEvent( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->XS1_UpdateEvent( $InstanceID );
	return $result;
}

/**
* ZW_AssociationAddToGroup
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Group
* @param integer $Node
*/

function ZW_AssociationAddToGroup( $InstanceID,$Group,$Node ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_AssociationAddToGroup( $InstanceID,$Group,$Node );
	return $result;
}

/**
* ZW_AssociationRemoveFromGroup
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Group
* @param integer $Node
*/

function ZW_AssociationRemoveFromGroup( $InstanceID,$Group,$Node ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_AssociationRemoveFromGroup( $InstanceID,$Group,$Node );
	return $result;
}

/**
* ZW_Basic
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
*/

function ZW_Basic( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_Basic( $InstanceID,$Value );
	return $result;
}

/**
* ZW_CheckCapability
* 
* @returns boolean
* @param integer $InstanceID
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
* @returns integer
* @param integer $InstanceID
* @param integer $Parameter
*/

function ZW_ConfigurationGetValue( $InstanceID,$Parameter ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_ConfigurationGetValue( $InstanceID,$Parameter );
	return $result;
}

/**
* ZW_ConfigurationResetValue
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Parameter
*/

function ZW_ConfigurationResetValue( $InstanceID,$Parameter ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_ConfigurationResetValue( $InstanceID,$Parameter );
	return $result;
}

/**
* ZW_ConfigurationSetValue
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Parameter
* @param integer $Value
*/

function ZW_ConfigurationSetValue( $InstanceID,$Parameter,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_ConfigurationSetValue( $InstanceID,$Parameter,$Value );
	return $result;
}

/**
* ZW_ConfigurationSetValueEx
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Parameter
* @param integer $Size
* @param integer $Value
*/

function ZW_ConfigurationSetValueEx( $InstanceID,$Parameter,$Size,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_ConfigurationSetValueEx( $InstanceID,$Parameter,$Size,$Value );
	return $result;
}

/**
* ZW_DeleteFailedDevice
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $NodeID
*/

function ZW_DeleteFailedDevice( $InstanceID,$NodeID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_DeleteFailedDevice( $InstanceID,$NodeID );
	return $result;
}

/**
* ZW_DimSet
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Intensity
*/

function ZW_DimSet( $InstanceID,$Intensity ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_DimSet( $InstanceID,$Intensity );
	return $result;
}

/**
* ZW_DimStop
* 
* @returns boolean
* @param integer $InstanceID
*/

function ZW_DimStop( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_DimStop( $InstanceID );
	return $result;
}

/**
* ZW_GetCapabilities
* 
* @returns array
* @param integer $InstanceID
*/

function ZW_GetCapabilities( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_GetCapabilities( $InstanceID );
	return $result;
}

/**
* ZW_GetDevices
* 
* @returns array
* @param integer $InstanceID
*/

function ZW_GetDevices( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_GetDevices( $InstanceID );
	return $result;
}

/**
* ZW_GetHomeID
* 
* @returns string
* @param integer $InstanceID
*/

function ZW_GetHomeID( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_GetHomeID( $InstanceID );
	return $result;
}

/**
* ZW_GetKnownDevices
* 
* @returns array
* @param integer $InstanceID
*/

function ZW_GetKnownDevices( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_GetKnownDevices( $InstanceID );
	return $result;
}

/**
* ZW_GetNodeID
* 
* @returns integer
* @param integer $InstanceID
*/

function ZW_GetNodeID( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_GetNodeID( $InstanceID );
	return $result;
}

/**
* ZW_GetSUCID
* 
* @returns integer
* @param integer $InstanceID
*/

function ZW_GetSUCID( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_GetSUCID( $InstanceID );
	return $result;
}

/**
* ZW_GetType
* 
* @returns integer
* @param integer $InstanceID
*/

function ZW_GetType( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_GetType( $InstanceID );
	return $result;
}

/**
* ZW_GetVersion
* 
* @returns string
* @param integer $InstanceID
*/

function ZW_GetVersion( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_GetVersion( $InstanceID );
	return $result;
}

/**
* ZW_LockMode
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $Locked
*/

function ZW_LockMode( $InstanceID,$Locked ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_LockMode( $InstanceID,$Locked );
	return $result;
}

/**
* ZW_MeterReset
* 
* @returns boolean
* @param integer $InstanceID
*/

function ZW_MeterReset( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_MeterReset( $InstanceID );
	return $result;
}

/**
* ZW_ProtectionSet
* 
* @returns boolean
* @param integer $InstanceID
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
* @returns boolean
* @param integer $InstanceID
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
* @returns boolean
* @param integer $InstanceID
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
* @returns boolean
* @param integer $InstanceID
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
* @returns boolean
* @param integer $InstanceID
* @param integer $SetPoint
*   enum[0=ptspNormalHeat, 1=ptspNormalCool, 2=ptspNormalAuto, 3=ptspEconomyHeat, 4=ptspEconomyCool, 5=ptspEconomyAutoHeat, 6=ptspEconomyAutoCool]
* @param float $Value
*/

function ZW_PulseThermostatSetPointSet( $InstanceID,$SetPoint,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_PulseThermostatSetPointSet( $InstanceID,$SetPoint,$Value );
	return $result;
}

/**
* ZW_RequestAssociations
* 
* @returns array
* @param integer $InstanceID
*/

function ZW_RequestAssociations( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_RequestAssociations( $InstanceID );
	return $result;
}

/**
* ZW_RequestInfo
* 
* @returns boolean
* @param integer $InstanceID
*/

function ZW_RequestInfo( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_RequestInfo( $InstanceID );
	return $result;
}

/**
* ZW_RequestStatus
* 
* @returns boolean
* @param integer $InstanceID
*/

function ZW_RequestStatus( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_RequestStatus( $InstanceID );
	return $result;
}

/**
* ZW_RequestVersion
* 
* @returns array
* @param integer $InstanceID
*/

function ZW_RequestVersion( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_RequestVersion( $InstanceID );
	return $result;
}

/**
* ZW_RequestWakeUpInterval
* 
* @returns array
* @param integer $InstanceID
*/

function ZW_RequestWakeUpInterval( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_RequestWakeUpInterval( $InstanceID );
	return $result;
}

/**
* ZW_ResetToDefault
* 
* @returns boolean
* @param integer $InstanceID
*/

function ZW_ResetToDefault( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_ResetToDefault( $InstanceID );
	return $result;
}

/**
* ZW_RoutingAssignReturnRoute
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $NodeID
*/

function ZW_RoutingAssignReturnRoute( $InstanceID,$NodeID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_RoutingAssignReturnRoute( $InstanceID,$NodeID );
	return $result;
}

/**
* ZW_RoutingGetNodes
* 
* @returns array
* @param integer $InstanceID
* @param integer $NodeID
*/

function ZW_RoutingGetNodes( $InstanceID,$NodeID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_RoutingGetNodes( $InstanceID,$NodeID );
	return $result;
}

/**
* ZW_RoutingOptimize
* 
* @returns boolean
* @param integer $InstanceID
*/

function ZW_RoutingOptimize( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_RoutingOptimize( $InstanceID );
	return $result;
}

/**
* ZW_RoutingOptimizeNode
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $NodeID
*/

function ZW_RoutingOptimizeNode( $InstanceID,$NodeID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_RoutingOptimizeNode( $InstanceID,$NodeID );
	return $result;
}

/**
* ZW_RoutingTestNode
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $NodeID
*/

function ZW_RoutingTestNode( $InstanceID,$NodeID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_RoutingTestNode( $InstanceID,$NodeID );
	return $result;
}

/**
* ZW_SearchDevices
* 
* @returns boolean
* @param integer $InstanceID
*/

function ZW_SearchDevices( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_SearchDevices( $InstanceID );
	return $result;
}

/**
* ZW_SearchMainDevice
* 
* @returns integer
* @param integer $InstanceID
*/

function ZW_SearchMainDevice( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_SearchMainDevice( $InstanceID );
	return $result;
}

/**
* ZW_SearchSubDevices
* 
* @returns array
* @param integer $InstanceID
*/

function ZW_SearchSubDevices( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_SearchSubDevices( $InstanceID );
	return $result;
}

/**
* ZW_ShutterMoveDown
* 
* @returns boolean
* @param integer $InstanceID
*/

function ZW_ShutterMoveDown( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_ShutterMoveDown( $InstanceID );
	return $result;
}

/**
* ZW_ShutterMoveUp
* 
* @returns boolean
* @param integer $InstanceID
*/

function ZW_ShutterMoveUp( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_ShutterMoveUp( $InstanceID );
	return $result;
}

/**
* ZW_ShutterStop
* 
* @returns boolean
* @param integer $InstanceID
*/

function ZW_ShutterStop( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_ShutterStop( $InstanceID );
	return $result;
}

/**
* ZW_StartAddDevice
* 
* @returns boolean
* @param integer $InstanceID
*/

function ZW_StartAddDevice( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_StartAddDevice( $InstanceID );
	return $result;
}

/**
* ZW_StartAddNewPrimaryController
* 
* @returns boolean
* @param integer $InstanceID
*/

function ZW_StartAddNewPrimaryController( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_StartAddNewPrimaryController( $InstanceID );
	return $result;
}

/**
* ZW_StartRemoveDevice
* 
* @returns boolean
* @param integer $InstanceID
*/

function ZW_StartRemoveDevice( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_StartRemoveDevice( $InstanceID );
	return $result;
}

/**
* ZW_StopAddDevice
* 
* @returns boolean
* @param integer $InstanceID
*/

function ZW_StopAddDevice( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_StopAddDevice( $InstanceID );
	return $result;
}

/**
* ZW_StopAddNewPrimaryController
* 
* @returns boolean
* @param integer $InstanceID
*/

function ZW_StopAddNewPrimaryController( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_StopAddNewPrimaryController( $InstanceID );
	return $result;
}

/**
* ZW_StopRemoveDevice
* 
* @returns boolean
* @param integer $InstanceID
*/

function ZW_StopRemoveDevice( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_StopRemoveDevice( $InstanceID );
	return $result;
}

/**
* ZW_SwitchMode
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $DeviceOn
*/

function ZW_SwitchMode( $InstanceID,$DeviceOn ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_SwitchMode( $InstanceID,$DeviceOn );
	return $result;
}

/**
* ZW_ThermostatFanModeSet
* 
* @returns boolean
* @param integer $InstanceID
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
* @returns boolean
* @param integer $InstanceID
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
* @returns boolean
* @param integer $InstanceID
* @param integer $SetPoint
*   enum[0=tspInvalid, 1=tspHeating, 2=tspCooling, 3=tspFurnace, 4=tspDryAir, 5=tspMoistAir, 6=tspAutoChangeover]
* @param float $Value
*/

function ZW_ThermostatSetPointSet( $InstanceID,$SetPoint,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_ThermostatSetPointSet( $InstanceID,$SetPoint,$Value );
	return $result;
}

/**
* ZW_WakeUpComplete
* 
* @returns boolean
* @param integer $InstanceID
*/

function ZW_WakeUpComplete( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_WakeUpComplete( $InstanceID );
	return $result;
}

/**
* ZW_WakeUpKeepAlive
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $KeepAlive
*/

function ZW_WakeUpKeepAlive( $InstanceID,$KeepAlive ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_WakeUpKeepAlive( $InstanceID,$KeepAlive );
	return $result;
}

/**
* ZW_WakeUpSetInterval
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Seconds
*/

function ZW_WakeUpSetInterval( $InstanceID,$Seconds ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_WakeUpSetInterval( $InstanceID,$Seconds );
	return $result;
}
?>
