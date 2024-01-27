<?php

 
/**
 * @file
 * @brief generated ipsymcon functions wrapper using gen_ips_wrapper.php
 *
 * This wrapper helps you to execute Scripts written for IPSymcon also on other PHP boxes
 * using IPSymcon JSON API. It defines all of known functions and map this to a JSON call
 *
 * @pre All functions are located in ips_wrapper.php. You need the class file IPS_JSON.php as well.
 * @copyright Thomas Dressler 2013-2018
 * @version 0.8 (gen_ips_wrapper.php)
 * @version 7.0 (IPSymcon)
 * @date 2024-01-27 (generated)
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
$port="3777";
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
* IPS_JSON object
*
* @var IPS_JSON $rpc
*/
$rpc = new IPS_JSON($url,$user,$password);


/**
* AA_BaseApplyChanges
* 
* @returns variant
* @param integer $InstanceID
*/

function AA_BaseApplyChanges( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AA_BaseApplyChanges( $InstanceID );
	return $result;
}

/**
* AA_BaseCreate
* 
* @returns variant
* @param integer $InstanceID
*/

function AA_BaseCreate( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AA_BaseCreate( $InstanceID );
	return $result;
}

/**
* AA_BaseGetConfigurationForm
* 
* @returns variant
* @param integer $InstanceID
*/

function AA_BaseGetConfigurationForm( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AA_BaseGetConfigurationForm( $InstanceID );
	return $result;
}

/**
* AA_UIAddSearchedDevices
* 
* @returns variant
* @param integer $InstanceID
* @param array $CurrentDevices
* @param array $NewDevices
*/

function AA_UIAddSearchedDevices( $InstanceID,$CurrentDevices,$NewDevices ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AA_UIAddSearchedDevices( $InstanceID,$CurrentDevices,$NewDevices );
	return $result;
}

/**
* AA_UIRepairIDs
* 
* @returns variant
* @param integer $InstanceID
* @param array $ListValues
*/

function AA_UIRepairIDs( $InstanceID,$ListValues ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AA_UIRepairIDs( $InstanceID,$ListValues );
	return $result;
}

/**
* AA_UIStartDeviceSearch
* 
* @returns variant
* @param integer $InstanceID
* @param array $ListValues
*/

function AA_UIStartDeviceSearch( $InstanceID,$ListValues ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AA_UIStartDeviceSearch( $InstanceID,$ListValues );
	return $result;
}

/**
* AA_UIUpdateExpertVisibility
* 
* @returns variant
* @param integer $InstanceID
* @param boolean $ShowExpertDevices
*/

function AA_UIUpdateExpertVisibility( $InstanceID,$ShowExpertDevices ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AA_UIUpdateExpertVisibility( $InstanceID,$ShowExpertDevices );
	return $result;
}

/**
* AA_UIUpdateNextID
* 
* @returns variant
* @param integer $InstanceID
* @param array $ListValues
*/

function AA_UIUpdateNextID( $InstanceID,$ListValues ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AA_UIUpdateNextID( $InstanceID,$ListValues );
	return $result;
}

/**
* AC_AddLoggedValues
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $VariableID
* @param array $Values
*/

function AC_AddLoggedValues( $InstanceID,$VariableID,$Values ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AC_AddLoggedValues( $InstanceID,$VariableID,$Values );
	return $result;
}

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
* @returns integer
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
* AC_FetchChartData
* 
* @returns array
* @param integer $InstanceID
* @param integer $ObjectID
* @param integer $StartTime
* @param integer $TimeSpan
*   enum[0=tsHour, 1=tsDay, 2=tsWeek, 3=tsMonth, 4=tsYear, 5=tsDecade]
* @param integer $Density
*   enum[0=gdNormal, 1=gdHD, 2=gdRaw]
*/

function AC_FetchChartData( $InstanceID,$ObjectID,$StartTime,$TimeSpan,$Density ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AC_FetchChartData( $InstanceID,$ObjectID,$StartTime,$TimeSpan,$Density );
	return $result;
}

/**
* AC_FetchChartDataEx
* 
* @returns array
* @param integer $InstanceID
* @param integer $ObjectID
* @param integer $StartTime
* @param integer $TimeSpan
*   enum[0=tsHour, 1=tsDay, 2=tsWeek, 3=tsMonth, 4=tsYear, 5=tsDecade]
* @param integer $Density
*   enum[0=gdNormal, 1=gdHD, 2=gdRaw]
* @param array $Visibility
*/

function AC_FetchChartDataEx( $InstanceID,$ObjectID,$StartTime,$TimeSpan,$Density,$Visibility ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AC_FetchChartDataEx( $InstanceID,$ObjectID,$StartTime,$TimeSpan,$Density,$Visibility );
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
* AC_GetCompaction
* 
* @returns array
* @param integer $InstanceID
* @param integer $VariableID
*/

function AC_GetCompaction( $InstanceID,$VariableID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AC_GetCompaction( $InstanceID,$VariableID );
	return $result;
}

/**
* AC_GetCounterIgnoreZeros
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $VariableID
*/

function AC_GetCounterIgnoreZeros( $InstanceID,$VariableID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AC_GetCounterIgnoreZeros( $InstanceID,$VariableID );
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
* AC_RenderChart
* 
* @returns string
* @param integer $InstanceID
* @param integer $ObjectID
* @param integer $StartTime
* @param integer $TimeSpan
*   enum[0=tsHour, 1=tsDay, 2=tsWeek, 3=tsMonth, 4=tsYear, 5=tsDecade]
* @param integer $Density
*   enum[0=gdNormal, 1=gdHD, 2=gdRaw]
* @param boolean $IsExtrema
* @param boolean $IsDyn
* @param integer $Width
* @param integer $Height
*/

function AC_RenderChart( $InstanceID,$ObjectID,$StartTime,$TimeSpan,$Density,$IsExtrema,$IsDyn,$Width,$Height ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AC_RenderChart( $InstanceID,$ObjectID,$StartTime,$TimeSpan,$Density,$IsExtrema,$IsDyn,$Width,$Height );
	return $result;
}

/**
* AC_RenderChartEx
* 
* @returns string
* @param integer $InstanceID
* @param integer $ObjectID
* @param integer $StartTime
* @param integer $TimeSpan
*   enum[0=tsHour, 1=tsDay, 2=tsWeek, 3=tsMonth, 4=tsYear, 5=tsDecade]
* @param integer $Density
*   enum[0=gdNormal, 1=gdHD, 2=gdRaw]
* @param boolean $IsExtrema
* @param boolean $IsDyn
* @param integer $Width
* @param integer $Height
* @param array $Visibility
*/

function AC_RenderChartEx( $InstanceID,$ObjectID,$StartTime,$TimeSpan,$Density,$IsExtrema,$IsDyn,$Width,$Height,$Visibility ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AC_RenderChartEx( $InstanceID,$ObjectID,$StartTime,$TimeSpan,$Density,$IsExtrema,$IsDyn,$Width,$Height,$Visibility );
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
* AC_SetCompaction
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $VariableID
* @param integer $MonthOffset
* @param integer $CompactionType
*   enum[0=ctNoCompaction, 1=ct1Minute, 2=ct5Minutes, 3=ctHour, 4=ctDay, 5=ctWeek, 6=ctMonth, 7=ctYear, 8=ctDelete]
*/

function AC_SetCompaction( $InstanceID,$VariableID,$MonthOffset,$CompactionType ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AC_SetCompaction( $InstanceID,$VariableID,$MonthOffset,$CompactionType );
	return $result;
}

/**
* AC_SetCounterIgnoreZeros
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $VariableID
* @param boolean $IgnoreZeros
*/

function AC_SetCounterIgnoreZeros( $InstanceID,$VariableID,$IgnoreZeros ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AC_SetCounterIgnoreZeros( $InstanceID,$VariableID,$IgnoreZeros );
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
* AHA_Parse
* 
* @returns variant
* @param integer $InstanceID
* @param string $xmlstring
*/

function AHA_Parse( $InstanceID,$xmlstring ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->AHA_Parse( $InstanceID,$xmlstring );
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
* @param string $ain
* @param boolean $val
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
* ALL_SetAnalog
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $ChannelID
* @param float $Value
*/

function ALL_SetAnalog( $InstanceID,$ChannelID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ALL_SetAnalog( $InstanceID,$ChannelID,$Value );
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
* APCUPSD_Query
* 
* @returns variant
* @param integer $InstanceID
*/

function APCUPSD_Query( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->APCUPSD_Query( $InstanceID );
	return $result;
}

/**
* APCUPSD_UpdateEvent
* 
* @returns variant
* @param integer $InstanceID
*/

function APCUPSD_UpdateEvent( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->APCUPSD_UpdateEvent( $InstanceID );
	return $result;
}

/**
* BAC_RelinquishPresetValue
* 
* @returns boolean
* @param integer $InstanceID
*/

function BAC_RelinquishPresetValue( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->BAC_RelinquishPresetValue( $InstanceID );
	return $result;
}

/**
* BAC_RequestDeviceList
* 
* @returns boolean
* @param integer $InstanceID
*/

function BAC_RequestDeviceList( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->BAC_RequestDeviceList( $InstanceID );
	return $result;
}

/**
* BAC_RequestStatus
* 
* @returns boolean
* @param integer $InstanceID
*/

function BAC_RequestStatus( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->BAC_RequestStatus( $InstanceID );
	return $result;
}

/**
* BAC_RequestStatusAll
* 
* @returns boolean
* @param integer $InstanceID
*/

function BAC_RequestStatusAll( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->BAC_RequestStatusAll( $InstanceID );
	return $result;
}

/**
* BAC_WritePresetValue
* 
* @returns boolean
* @param integer $InstanceID
* @param variant $Value
*/

function BAC_WritePresetValue( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->BAC_WritePresetValue( $InstanceID,$Value );
	return $result;
}

/**
* CC_ActivateServer
* 
* @returns boolean
* @param integer $InstanceID
*/

function CC_ActivateServer( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->CC_ActivateServer( $InstanceID );
	return $result;
}

/**
* CC_GetConnectURL
* 
* @returns string
* @param integer $InstanceID
*/

function CC_GetConnectURL( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->CC_GetConnectURL( $InstanceID );
	return $result;
}

/**
* CC_GetGoogleAssistantLimitCount
* 
* @returns integer
* @param integer $InstanceID
*/

function CC_GetGoogleAssistantLimitCount( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->CC_GetGoogleAssistantLimitCount( $InstanceID );
	return $result;
}

/**
* CC_GetQRCodeSVG
* 
* @returns string
* @param integer $InstanceID
* @param integer $WebFrontID
*/

function CC_GetQRCodeSVG( $InstanceID,$WebFrontID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->CC_GetQRCodeSVG( $InstanceID,$WebFrontID );
	return $result;
}

/**
* CC_GetRequestLimitCount
* 
* @returns integer
* @param integer $InstanceID
*/

function CC_GetRequestLimitCount( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->CC_GetRequestLimitCount( $InstanceID );
	return $result;
}

/**
* CC_GetTrafficCounter
* 
* @returns array
* @param integer $InstanceID
*/

function CC_GetTrafficCounter( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->CC_GetTrafficCounter( $InstanceID );
	return $result;
}

/**
* CC_GetTrafficStatistics
* 
* @returns array
* @param integer $InstanceID
*/

function CC_GetTrafficStatistics( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->CC_GetTrafficStatistics( $InstanceID );
	return $result;
}

/**
* CC_MakeRequest
* 
* @returns string
* @param integer $InstanceID
* @param string $Endpoint
* @param string $RequestData
*/

function CC_MakeRequest( $InstanceID,$Endpoint,$RequestData ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->CC_MakeRequest( $InstanceID,$Endpoint,$RequestData );
	return $result;
}

/**
* CC_SendGoogleAssistantStateReport
* 
* @returns boolean
* @param integer $InstanceID
* @param string $States
*/

function CC_SendGoogleAssistantStateReport( $InstanceID,$States ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->CC_SendGoogleAssistantStateReport( $InstanceID,$States );
	return $result;
}

/**
* CMI_UpdateValues
* 
* @returns boolean
* @param integer $InstanceID
*/

function CMI_UpdateValues( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->CMI_UpdateValues( $InstanceID );
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
* CSCK_UpdateFormUseSSL
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $UseSSL
*/

function CSCK_UpdateFormUseSSL( $InstanceID,$UseSSL ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->CSCK_UpdateFormUseSSL( $InstanceID,$UseSSL );
	return $result;
}

/**
* CUL_Parse
* 
* @returns variant
* @param integer $InstanceID
* @param string $line
*/

function CUL_Parse( $InstanceID,$line ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->CUL_Parse( $InstanceID,$line );
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
* DKN_RequestRead
* 
* @returns variant
* @param integer $InstanceID
*/

function DKN_RequestRead( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DKN_RequestRead( $InstanceID );
	return $result;
}

/**
* DKN_SetBoosterValue
* 
* @returns variant
* @param integer $InstanceID
* @param boolean $Value
*/

function DKN_SetBoosterValue( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DKN_SetBoosterValue( $InstanceID,$Value );
	return $result;
}

/**
* DKN_SetFanDirValue
* 
* @returns variant
* @param integer $InstanceID
* @param integer $Value
*/

function DKN_SetFanDirValue( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DKN_SetFanDirValue( $InstanceID,$Value );
	return $result;
}

/**
* DKN_SetFanRateValue
* 
* @returns variant
* @param integer $InstanceID
* @param integer $Value
*/

function DKN_SetFanRateValue( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DKN_SetFanRateValue( $InstanceID,$Value );
	return $result;
}

/**
* DKN_SetHomeKitState
* 
* @returns variant
* @param integer $InstanceID
* @param integer $Value
*/

function DKN_SetHomeKitState( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DKN_SetHomeKitState( $InstanceID,$Value );
	return $result;
}

/**
* DKN_SetHumidityValue
* 
* @returns variant
* @param integer $InstanceID
* @param integer $Value
*/

function DKN_SetHumidityValue( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DKN_SetHumidityValue( $InstanceID,$Value );
	return $result;
}

/**
* DKN_SetModeValue
* 
* @returns variant
* @param integer $InstanceID
* @param integer $Value
*/

function DKN_SetModeValue( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DKN_SetModeValue( $InstanceID,$Value );
	return $result;
}

/**
* DKN_SetPowerSwitch
* 
* @returns variant
* @param integer $InstanceID
* @param boolean $Value
*/

function DKN_SetPowerSwitch( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DKN_SetPowerSwitch( $InstanceID,$Value );
	return $result;
}

/**
* DKN_SetStreamerValue
* 
* @returns variant
* @param integer $InstanceID
* @param boolean $Value
*/

function DKN_SetStreamerValue( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DKN_SetStreamerValue( $InstanceID,$Value );
	return $result;
}

/**
* DKN_SetTempValue
* 
* @returns variant
* @param integer $InstanceID
* @param float $Value
*/

function DKN_SetTempValue( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DKN_SetTempValue( $InstanceID,$Value );
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
* DMX_UIChangeMode
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Mode
*   enum[0=gmDMX4ALL, 1=gmArtNet, 2=gmDMX4ALLoverTCP]
*/

function DMX_UIChangeMode( $InstanceID,$Mode ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DMX_UIChangeMode( $InstanceID,$Mode );
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
* DS_MakeRequest
* 
* @returns string
* @param integer $InstanceID
* @param string $Request
* @param string $Data
*/

function DS_MakeRequest( $InstanceID,$Request,$Data ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DS_MakeRequest( $InstanceID,$Request,$Data );
	return $result;
}

/**
* DS_RequestBinaryInputs
* 
* @returns boolean
* @param integer $InstanceID
*/

function DS_RequestBinaryInputs( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DS_RequestBinaryInputs( $InstanceID );
	return $result;
}

/**
* DS_RequestSensorInputs
* 
* @returns boolean
* @param integer $InstanceID
*/

function DS_RequestSensorInputs( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DS_RequestSensorInputs( $InstanceID );
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
* DS_ShutterStepDown
* 
* @returns boolean
* @param integer $InstanceID
*/

function DS_ShutterStepDown( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DS_ShutterStepDown( $InstanceID );
	return $result;
}

/**
* DS_ShutterStepUp
* 
* @returns boolean
* @param integer $InstanceID
*/

function DS_ShutterStepUp( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->DS_ShutterStepUp( $InstanceID );
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
* EIB_BladePosition
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Position
*/

function EIB_BladePosition( $InstanceID,$Position ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_BladePosition( $InstanceID,$Position );
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
* EIB_GetDecryptedKeyring
* 
* @returns array
* @param integer $InstanceID
*/

function EIB_GetDecryptedKeyring( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_GetDecryptedKeyring( $InstanceID );
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
* EIB_SetProgrammingMode
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $Enable
*/

function EIB_SetProgrammingMode( $InstanceID,$Enable ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_SetProgrammingMode( $InstanceID,$Enable );
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
* EIB_UIUpdateGatewayMode
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $GatewayMode
*/

function EIB_UIUpdateGatewayMode( $InstanceID,$GatewayMode ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_UIUpdateGatewayMode( $InstanceID,$GatewayMode );
	return $result;
}

/**
* EIB_UpdateFormExportMode
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $ExportMode
*/

function EIB_UpdateFormExportMode( $InstanceID,$ExportMode ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->EIB_UpdateFormExportMode( $InstanceID,$ExportMode );
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
* ENO_ConfigureEnergyMeasurement
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $AutoReporting
* @param integer $ReportingDeltaWh
* @param integer $ReportingMinInterval
* @param integer $ReportingMaxInterval
* @param boolean $ResetCounter
*/

function ENO_ConfigureEnergyMeasurement( $InstanceID,$AutoReporting,$ReportingDeltaWh,$ReportingMinInterval,$ReportingMaxInterval,$ResetCounter ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_ConfigureEnergyMeasurement( $InstanceID,$AutoReporting,$ReportingDeltaWh,$ReportingMinInterval,$ReportingMaxInterval,$ResetCounter );
	return $result;
}

/**
* ENO_ConfigurePowerMeasurement
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $AutoReporting
* @param integer $ReportingDeltaW
* @param integer $ReportingMinInterval
* @param integer $ReportingMaxInterval
*/

function ENO_ConfigurePowerMeasurement( $InstanceID,$AutoReporting,$ReportingDeltaW,$ReportingMinInterval,$ReportingMaxInterval ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_ConfigurePowerMeasurement( $InstanceID,$AutoReporting,$ReportingDeltaW,$ReportingMinInterval,$ReportingMaxInterval );
	return $result;
}

/**
* ENO_DimColdWhite
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Intensity
*/

function ENO_DimColdWhite( $InstanceID,$Intensity ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_DimColdWhite( $InstanceID,$Intensity );
	return $result;
}

/**
* ENO_DimColor
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Color
*/

function ENO_DimColor( $InstanceID,$Color ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_DimColor( $InstanceID,$Color );
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
* ENO_DimWarmWhite
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Intensity
*/

function ENO_DimWarmWhite( $InstanceID,$Intensity ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_DimWarmWhite( $InstanceID,$Intensity );
	return $result;
}

/**
* ENO_DimWhite
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $White
*/

function ENO_DimWhite( $InstanceID,$White ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_DimWhite( $InstanceID,$White );
	return $result;
}

/**
* ENO_RequestStatus
* 
* @returns boolean
* @param integer $InstanceID
*/

function ENO_RequestStatus( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_RequestStatus( $InstanceID );
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
* ENO_SendLearnEx
* 
* @returns boolean
* @param integer $InstanceID
*/

function ENO_SendLearnEx( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SendLearnEx( $InstanceID );
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
* ENO_SetOverride
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Override
*/

function ENO_SetOverride( $InstanceID,$Override ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SetOverride( $InstanceID,$Override );
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
* ENO_SetSmartAckLearn
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $Enabled
*/

function ENO_SetSmartAckLearn( $InstanceID,$Enabled ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SetSmartAckLearn( $InstanceID,$Enabled );
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
* ENO_ShutterMoveDownEx
* 
* @returns boolean
* @param integer $InstanceID
* @param float $Seconds
*/

function ENO_ShutterMoveDownEx( $InstanceID,$Seconds ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_ShutterMoveDownEx( $InstanceID,$Seconds );
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
* ENO_ShutterMoveUpEx
* 
* @returns boolean
* @param integer $InstanceID
* @param float $Seconds
*/

function ENO_ShutterMoveUpEx( $InstanceID,$Seconds ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_ShutterMoveUpEx( $InstanceID,$Seconds );
	return $result;
}

/**
* ENO_ShutterStepDown
* 
* @returns boolean
* @param integer $InstanceID
*/

function ENO_ShutterStepDown( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_ShutterStepDown( $InstanceID );
	return $result;
}

/**
* ENO_ShutterStepUp
* 
* @returns boolean
* @param integer $InstanceID
*/

function ENO_ShutterStepUp( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_ShutterStepUp( $InstanceID );
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
* ENO_SwitchLockingMode
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
*/

function ENO_SwitchLockingMode( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SwitchLockingMode( $InstanceID,$Value );
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
* ENO_SwitchRotationAngle
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
*/

function ENO_SwitchRotationAngle( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SwitchRotationAngle( $InstanceID,$Value );
	return $result;
}

/**
* ENO_SwitchShutterAction
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
*/

function ENO_SwitchShutterAction( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SwitchShutterAction( $InstanceID,$Value );
	return $result;
}

/**
* ENO_SwitchVacationMode
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $Value
*/

function ENO_SwitchVacationMode( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SwitchVacationMode( $InstanceID,$Value );
	return $result;
}

/**
* ENO_SwitchVerticalPosition
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
*/

function ENO_SwitchVerticalPosition( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_SwitchVerticalPosition( $InstanceID,$Value );
	return $result;
}

/**
* ENO_UpdateFreeDeviceIDInForm
* 
* @returns boolean
* @param integer $InstanceID
*/

function ENO_UpdateFreeDeviceIDInForm( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ENO_UpdateFreeDeviceIDInForm( $InstanceID );
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
* GetValueFormattedEx
* 
* @returns string
* @param integer $VariableID
* @param variant $Value
*/

function GetValueFormattedEx( $VariableID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->GetValueFormattedEx( $VariableID,$Value );
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
* HC_CheckServerEvents
* 
* @returns variant
* @param integer $InstanceID
*/

function HC_CheckServerEvents( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HC_CheckServerEvents( $InstanceID );
	return $result;
}

/**
* HC_InitializeDevice
* 
* @returns variant
* @param integer $InstanceID
*/

function HC_InitializeDevice( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HC_InitializeDevice( $InstanceID );
	return $result;
}

/**
* HC_Register
* 
* @returns variant
* @param integer $InstanceID
*/

function HC_Register( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HC_Register( $InstanceID );
	return $result;
}

/**
* HC_RegisterServerEvents
* 
* @returns variant
* @param integer $InstanceID
*/

function HC_RegisterServerEvents( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HC_RegisterServerEvents( $InstanceID );
	return $result;
}

/**
* HC_ResetRateLimit
* 
* @returns variant
* @param integer $InstanceID
*/

function HC_ResetRateLimit( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HC_ResetRateLimit( $InstanceID );
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
* HC_deleteRequest
* 
* @returns variant
* @param integer $InstanceID
* @param string $endpoint
*/

function HC_deleteRequest( $InstanceID,$endpoint ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HC_deleteRequest( $InstanceID,$endpoint );
	return $result;
}

/**
* HC_getRequest
* 
* @returns variant
* @param integer $InstanceID
* @param string $endpoint
*/

function HC_getRequest( $InstanceID,$endpoint ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HC_getRequest( $InstanceID,$endpoint );
	return $result;
}

/**
* HC_putRequest
* 
* @returns variant
* @param integer $InstanceID
* @param string $endpoint
* @param string $payload
*/

function HC_putRequest( $InstanceID,$endpoint,$payload ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HC_putRequest( $InstanceID,$endpoint,$payload );
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
* HM_GetDeviceDescription
* 
* @returns string
* @param integer $InstanceID
*/

function HM_GetDeviceDescription( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HM_GetDeviceDescription( $InstanceID );
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
* HM_GetParamsetDescription
* 
* @returns string
* @param integer $InstanceID
*/

function HM_GetParamsetDescription( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HM_GetParamsetDescription( $InstanceID );
	return $result;
}

/**
* HM_LoadDevices
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Protocol
*   enum[0=hmpRadio, 1=hmpWired, 2=hmpIP, 3=hmpGroups]
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
* HM_UpdateFormUseSSL
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $UseSSL
*/

function HM_UpdateFormUseSSL( $InstanceID,$UseSSL ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HM_UpdateFormUseSSL( $InstanceID,$UseSSL );
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
* HPSensor_ApplyJsonData
* 
* @returns variant
* @param integer $InstanceID
* @param string $jsonString
*/

function HPSensor_ApplyJsonData( $InstanceID,$jsonString ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HPSensor_ApplyJsonData( $InstanceID,$jsonString );
	return $result;
}

/**
* HPSensor_DirectionDown
* 
* @returns variant
* @param integer $InstanceID
*/

function HPSensor_DirectionDown( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HPSensor_DirectionDown( $InstanceID );
	return $result;
}

/**
* HPSensor_DirectionStop
* 
* @returns variant
* @param integer $InstanceID
*/

function HPSensor_DirectionStop( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HPSensor_DirectionStop( $InstanceID );
	return $result;
}

/**
* HPSensor_DirectionUp
* 
* @returns variant
* @param integer $InstanceID
*/

function HPSensor_DirectionUp( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HPSensor_DirectionUp( $InstanceID );
	return $result;
}

/**
* HPSensor_GetAutomatic
* 
* @returns variant
* @param integer $InstanceID
*/

function HPSensor_GetAutomatic( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HPSensor_GetAutomatic( $InstanceID );
	return $result;
}

/**
* HPSensor_GetBridge
* 
* @returns variant
* @param integer $InstanceID
*/

function HPSensor_GetBridge( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HPSensor_GetBridge( $InstanceID );
	return $result;
}

/**
* HPSensor_GetPosition
* 
* @returns variant
* @param integer $InstanceID
*/

function HPSensor_GetPosition( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HPSensor_GetPosition( $InstanceID );
	return $result;
}

/**
* HPSensor_GetProductInfoFromDeviceNumber
* 
* @returns variant
* @param integer $InstanceID
* @param variant $ProductId
*/

function HPSensor_GetProductInfoFromDeviceNumber( $InstanceID,$ProductId ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HPSensor_GetProductInfoFromDeviceNumber( $InstanceID,$ProductId );
	return $result;
}

/**
* HPSensor_GetState
* 
* @returns variant
* @param integer $InstanceID
*/

function HPSensor_GetState( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HPSensor_GetState( $InstanceID );
	return $result;
}

/**
* HPSensor_GetValue
* 
* @returns variant
* @param integer $InstanceID
* @param variant $Ident
*/

function HPSensor_GetValue( $InstanceID,$Ident ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HPSensor_GetValue( $InstanceID,$Ident );
	return $result;
}

/**
* HPSensor_RequestData
* 
* @returns variant
* @param integer $InstanceID
*/

function HPSensor_RequestData( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HPSensor_RequestData( $InstanceID );
	return $result;
}

/**
* HPSensor_SetAutomatic
* 
* @returns variant
* @param integer $InstanceID
* @param boolean $value
*/

function HPSensor_SetAutomatic( $InstanceID,$value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HPSensor_SetAutomatic( $InstanceID,$value );
	return $result;
}

/**
* HPSensor_SetPosition
* 
* @returns variant
* @param integer $InstanceID
* @param float $value
*/

function HPSensor_SetPosition( $InstanceID,$value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HPSensor_SetPosition( $InstanceID,$value );
	return $result;
}

/**
* HPSensor_SetState
* 
* @returns variant
* @param integer $InstanceID
* @param boolean $value
*/

function HPSensor_SetState( $InstanceID,$value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HPSensor_SetState( $InstanceID,$value );
	return $result;
}

/**
* HP_ApplyJsonData
* 
* @returns variant
* @param integer $InstanceID
* @param string $jsonString
*/

function HP_ApplyJsonData( $InstanceID,$jsonString ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HP_ApplyJsonData( $InstanceID,$jsonString );
	return $result;
}

/**
* HP_DirectionDown
* 
* @returns variant
* @param integer $InstanceID
*/

function HP_DirectionDown( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HP_DirectionDown( $InstanceID );
	return $result;
}

/**
* HP_DirectionStop
* 
* @returns variant
* @param integer $InstanceID
*/

function HP_DirectionStop( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HP_DirectionStop( $InstanceID );
	return $result;
}

/**
* HP_DirectionUp
* 
* @returns variant
* @param integer $InstanceID
*/

function HP_DirectionUp( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HP_DirectionUp( $InstanceID );
	return $result;
}

/**
* HP_GetAutomatic
* 
* @returns variant
* @param integer $InstanceID
*/

function HP_GetAutomatic( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HP_GetAutomatic( $InstanceID );
	return $result;
}

/**
* HP_GetBridge
* 
* @returns variant
* @param integer $InstanceID
*/

function HP_GetBridge( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HP_GetBridge( $InstanceID );
	return $result;
}

/**
* HP_GetDeviceByUniqueId
* 
* @returns variant
* @param integer $InstanceID
* @param string $uniqueId
*/

function HP_GetDeviceByUniqueId( $InstanceID,$uniqueId ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HP_GetDeviceByUniqueId( $InstanceID,$uniqueId );
	return $result;
}

/**
* HP_GetHomePilotCategory
* 
* @returns variant
* @param integer $InstanceID
*/

function HP_GetHomePilotCategory( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HP_GetHomePilotCategory( $InstanceID );
	return $result;
}

/**
* HP_GetHomePilotSensorCategory
* 
* @returns variant
* @param integer $InstanceID
*/

function HP_GetHomePilotSensorCategory( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HP_GetHomePilotSensorCategory( $InstanceID );
	return $result;
}

/**
* HP_GetHomePilotVersion
* 
* @returns variant
* @param integer $InstanceID
*/

function HP_GetHomePilotVersion( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HP_GetHomePilotVersion( $InstanceID );
	return $result;
}

/**
* HP_GetHost
* 
* @returns variant
* @param integer $InstanceID
*/

function HP_GetHost( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HP_GetHost( $InstanceID );
	return $result;
}

/**
* HP_GetPosition
* 
* @returns variant
* @param integer $InstanceID
*/

function HP_GetPosition( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HP_GetPosition( $InstanceID );
	return $result;
}

/**
* HP_GetProductInfoFromDeviceNumber
* 
* @returns variant
* @param integer $InstanceID
* @param variant $ProductId
*/

function HP_GetProductInfoFromDeviceNumber( $InstanceID,$ProductId ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HP_GetProductInfoFromDeviceNumber( $InstanceID,$ProductId );
	return $result;
}

/**
* HP_GetState
* 
* @returns variant
* @param integer $InstanceID
*/

function HP_GetState( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HP_GetState( $InstanceID );
	return $result;
}

/**
* HP_GetValue
* 
* @returns variant
* @param integer $InstanceID
* @param variant $Ident
*/

function HP_GetValue( $InstanceID,$Ident ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HP_GetValue( $InstanceID,$Ident );
	return $result;
}

/**
* HP_NodeGuid
* 
* @returns variant
* @param integer $InstanceID
*/

function HP_NodeGuid( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HP_NodeGuid( $InstanceID );
	return $result;
}

/**
* HP_ProtocolVersion
* 
* @returns variant
* @param integer $InstanceID
*/

function HP_ProtocolVersion( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HP_ProtocolVersion( $InstanceID );
	return $result;
}

/**
* HP_RegisterTimer
* 
* @returns variant
* @param integer $InstanceID
* @param variant $ident
* @param variant $interval
* @param variant $script
*/

function HP_RegisterTimer( $InstanceID,$ident,$interval,$script ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HP_RegisterTimer( $InstanceID,$ident,$interval,$script );
	return $result;
}

/**
* HP_Request
* 
* @returns variant
* @param integer $InstanceID
* @param string $path
*/

function HP_Request( $InstanceID,$path ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HP_Request( $InstanceID,$path );
	return $result;
}

/**
* HP_RequestData
* 
* @returns variant
* @param integer $InstanceID
*/

function HP_RequestData( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HP_RequestData( $InstanceID );
	return $result;
}

/**
* HP_SensorGuid
* 
* @returns variant
* @param integer $InstanceID
*/

function HP_SensorGuid( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HP_SensorGuid( $InstanceID );
	return $result;
}

/**
* HP_SetAutomatic
* 
* @returns variant
* @param integer $InstanceID
* @param boolean $value
*/

function HP_SetAutomatic( $InstanceID,$value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HP_SetAutomatic( $InstanceID,$value );
	return $result;
}

/**
* HP_SetPosition
* 
* @returns variant
* @param integer $InstanceID
* @param float $value
*/

function HP_SetPosition( $InstanceID,$value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HP_SetPosition( $InstanceID,$value );
	return $result;
}

/**
* HP_SetState
* 
* @returns variant
* @param integer $InstanceID
* @param boolean $value
*/

function HP_SetState( $InstanceID,$value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HP_SetState( $InstanceID,$value );
	return $result;
}

/**
* HP_SyncDevices
* 
* @returns variant
* @param integer $InstanceID
*/

function HP_SyncDevices( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HP_SyncDevices( $InstanceID );
	return $result;
}

/**
* HP_SyncNodes
* 
* @returns variant
* @param integer $InstanceID
*/

function HP_SyncNodes( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HP_SyncNodes( $InstanceID );
	return $result;
}

/**
* HP_SyncSensors
* 
* @returns variant
* @param integer $InstanceID
*/

function HP_SyncSensors( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HP_SyncSensors( $InstanceID );
	return $result;
}

/**
* HP_SyncStates
* 
* @returns variant
* @param integer $InstanceID
*/

function HP_SyncStates( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HP_SyncStates( $InstanceID );
	return $result;
}

/**
* HasAction
* 
* @returns boolean
* @param integer $VariableID
*/

function HasAction( $VariableID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->HasAction( $VariableID );
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
* IMAP_DeleteMail
* 
* @returns boolean
* @param integer $InstanceID
* @param string $UID
*/

function IMAP_DeleteMail( $InstanceID,$UID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IMAP_DeleteMail( $InstanceID,$UID );
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
* IMAP_UpdateFormUseSSL
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $UseSSL
*/

function IMAP_UpdateFormUseSSL( $InstanceID,$UseSSL ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IMAP_UpdateFormUseSSL( $InstanceID,$UseSSL );
	return $result;
}

/**
* IPS_AbortScript
* 
* @returns boolean
* @param integer $ScriptID
*/

function IPS_AbortScript( $ScriptID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_AbortScript( $ScriptID );
	return $result;
}

/**
* IPS_ActionExists
* 
* @returns boolean
* @param string $ActionID
*/

function IPS_ActionExists( $ActionID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_ActionExists( $ActionID );
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
* IPS_CandidateMediaStream
* 
* @returns boolean
* @param string $SessionID
* @param string $ICE
*/

function IPS_CandidateMediaStream( $SessionID,$ICE ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_CandidateMediaStream( $SessionID,$ICE );
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
* IPS_ConfigureMediaStream
* 
* @returns boolean
* @param string $SessionID
* @param string $SessionDescription
*/

function IPS_ConfigureMediaStream( $SessionID,$SessionDescription ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_ConfigureMediaStream( $SessionID,$SessionDescription );
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
* IPS_ConnectMediaStream
* 
* @returns array
* @param integer $MediaID
*/

function IPS_ConnectMediaStream( $MediaID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_ConnectMediaStream( $MediaID );
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
*   enum[0=mtIPSView, 1=mtImage, 2=mtSound, 3=mtStream, 4=mtChart, 5=mtDocument]
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
*   enum[0=stPHPScript, 1=stFlowScript, 2=stIPSWorkflow]
*/

function IPS_CreateScript( $ScriptType ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_CreateScript( $ScriptType );
	return $result;
}

/**
* IPS_CreateTemporaryMediaStreamToken
* 
* @returns string
* @param integer $MediaID
* @param integer $ValidForSeconds
*/

function IPS_CreateTemporaryMediaStreamToken( $MediaID,$ValidForSeconds ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_CreateTemporaryMediaStreamToken( $MediaID,$ValidForSeconds );
	return $result;
}

/**
* IPS_CreateTemporaryToken
* 
* @returns string
* @param integer $ValidForSeconds
*/

function IPS_CreateTemporaryToken( $ValidForSeconds ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_CreateTemporaryToken( $ValidForSeconds );
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
* IPS_DisableDebugFile
* 
* @returns boolean
* @param integer $ID
*/

function IPS_DisableDebugFile( $ID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_DisableDebugFile( $ID );
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
* IPS_DisconnectMediaStream
* 
* @returns boolean
* @param string $SessionID
*/

function IPS_DisconnectMediaStream( $SessionID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_DisconnectMediaStream( $SessionID );
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
* IPS_EnableDebugFile
* 
* @returns boolean
* @param integer $ID
*/

function IPS_EnableDebugFile( $ID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_EnableDebugFile( $ID );
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
* IPS_FindObjectIDByIdent
* 
* @returns integer
* @param string $Ident
* @param integer $ParentID
*/

function IPS_FindObjectIDByIdent( $Ident,$ParentID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_FindObjectIDByIdent( $Ident,$ParentID );
	return $result;
}

/**
* IPS_FindObjectIDByName
* 
* @returns integer
* @param string $Name
* @param integer $ParentID
*/

function IPS_FindObjectIDByName( $Name,$ParentID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_FindObjectIDByName( $Name,$ParentID );
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
* IPS_GetActionForm
* 
* @returns string
* @param string $ActionID
* @param array $Parameters
*/

function IPS_GetActionForm( $ActionID,$Parameters ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetActionForm( $ActionID,$Parameters );
	return $result;
}

/**
* IPS_GetActionReadableCode
* 
* @returns string
* @param string $ActionID
* @param array $Parameters
*/

function IPS_GetActionReadableCode( $ActionID,$Parameters ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetActionReadableCode( $ActionID,$Parameters );
	return $result;
}

/**
* IPS_GetActions
* 
* @returns string
*/

function IPS_GetActions(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetActions(  );
	return $result;
}

/**
* IPS_GetActionsByEnvironment
* 
* @returns string
* @param integer $TargetID
* @param string $Environment
* @param boolean $IncludeDefault
*/

function IPS_GetActionsByEnvironment( $TargetID,$Environment,$IncludeDefault ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetActionsByEnvironment( $TargetID,$Environment,$IncludeDefault );
	return $result;
}

/**
* IPS_GetActiveProxyConnections
* 
* @returns integer
*/

function IPS_GetActiveProxyConnections(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetActiveProxyConnections(  );
	return $result;
}

/**
* IPS_GetActiveWebRTCConnections
* 
* @returns integer
*/

function IPS_GetActiveWebRTCConnections(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetActiveWebRTCConnections(  );
	return $result;
}

/**
* IPS_GetActiveWebServerConnections
* 
* @returns integer
*/

function IPS_GetActiveWebServerConnections(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetActiveWebServerConnections(  );
	return $result;
}

/**
* IPS_GetActiveWebSocketConnections
* 
* @returns integer
*/

function IPS_GetActiveWebSocketConnections(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetActiveWebSocketConnections(  );
	return $result;
}

/**
* IPS_GetAvailableUpdates
* 
* @returns array
*/

function IPS_GetAvailableUpdates(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetAvailableUpdates(  );
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
* IPS_GetConfigurationsFromChildren
* 
* @returns array
* @param array $Parameter
*/

function IPS_GetConfigurationsFromChildren( $Parameter ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetConfigurationsFromChildren( $Parameter );
	return $result;
}

/**
* IPS_GetConnectionList
* 
* @returns array
*/

function IPS_GetConnectionList(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetConnectionList(  );
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
* IPS_GetFlowScriptStatistic
* 
* @returns array
* @param integer $ScriptID
*/

function IPS_GetFlowScriptStatistic( $ScriptID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetFlowScriptStatistic( $ScriptID );
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
* @param array $InstanceIDs
*/

function IPS_GetFunctions( $InstanceIDs ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetFunctions( $InstanceIDs );
	return $result;
}

/**
* IPS_GetFunctionsMap
* 
* @returns array
* @param array $InstanceIDs
*/

function IPS_GetFunctionsMap( $InstanceIDs ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetFunctionsMap( $InstanceIDs );
	return $result;
}

/**
* IPS_GetIcons
* 
* @returns array
* @param array $Parameter
*/

function IPS_GetIcons( $Parameter ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetIcons( $Parameter );
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
* IPS_GetInstanceDataFlowStatistics
* 
* @returns array
*/

function IPS_GetInstanceDataFlowStatistics(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetInstanceDataFlowStatistics(  );
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
*   enum[0=mtCore, 1=mtIO, 2=mtSplitter, 3=mtDevice, 4=mtConfigurator, 5=mtDiscovery, 6=mtVisualization]
*/

function IPS_GetInstanceListByModuleType( $ModuleType ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetInstanceListByModuleType( $ModuleType );
	return $result;
}

/**
* IPS_GetInstanceMessageQueueSize
* 
* @returns integer
*/

function IPS_GetInstanceMessageQueueSize(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetInstanceMessageQueueSize(  );
	return $result;
}

/**
* IPS_GetInstanceMessageStatistics
* 
* @returns array
*/

function IPS_GetInstanceMessageStatistics(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetInstanceMessageStatistics(  );
	return $result;
}

/**
* IPS_GetKernelArchitecture
* 
* @returns string
*/

function IPS_GetKernelArchitecture(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetKernelArchitecture(  );
	return $result;
}

/**
* IPS_GetKernelDate
* 
* @returns integer
*/

function IPS_GetKernelDate(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetKernelDate(  );
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
* IPS_GetKernelDirSpace
* 
* @returns array
*/

function IPS_GetKernelDirSpace(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetKernelDirSpace(  );
	return $result;
}

/**
* IPS_GetKernelPlatform
* 
* @returns string
*/

function IPS_GetKernelPlatform(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetKernelPlatform(  );
	return $result;
}

/**
* IPS_GetKernelRevision
* 
* @returns string
*/

function IPS_GetKernelRevision(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetKernelRevision(  );
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
* @param array $LibraryIDs
*/

function IPS_GetLibraries( $LibraryIDs ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetLibraries( $LibraryIDs );
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
* IPS_GetLimitFeatures
* 
* @returns array
*/

function IPS_GetLimitFeatures(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetLimitFeatures(  );
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
*   enum[0=mtIPSView, 1=mtImage, 2=mtSound, 3=mtStream, 4=mtChart, 5=mtDocument]
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
*   enum[0=mtCore, 1=mtIO, 2=mtSplitter, 3=mtDevice, 4=mtConfigurator, 5=mtDiscovery, 6=mtVisualization]
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
* @param array $ModuleIDs
*/

function IPS_GetModules( $ModuleIDs ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetModules( $ModuleIDs );
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
* @returns variant
* @param string $Option
*/

function IPS_GetOption( $Option ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetOption( $Option );
	return $result;
}

/**
* IPS_GetOptionEx
* 
* @returns array
* @param string $Option
*/

function IPS_GetOptionEx( $Option ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetOptionEx( $Option );
	return $result;
}

/**
* IPS_GetOptionList
* 
* @returns array
*/

function IPS_GetOptionList(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetOptionList(  );
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
* IPS_GetReferenceList
* 
* @returns array
* @param integer $InstanceID
*/

function IPS_GetReferenceList( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetReferenceList( $InstanceID );
	return $result;
}

/**
* IPS_GetReplicationConfiguration
* 
* @returns string
*/

function IPS_GetReplicationConfiguration(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetReplicationConfiguration(  );
	return $result;
}

/**
* IPS_GetReplicationSyncTime
* 
* @returns integer
*/

function IPS_GetReplicationSyncTime(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetReplicationSyncTime(  );
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
* @param array $ThreadIDs
*/

function IPS_GetScriptThreads( $ThreadIDs ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetScriptThreads( $ThreadIDs );
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
* IPS_GetSecurityMode
* 
* @returns integer
*/

function IPS_GetSecurityMode(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetSecurityMode(  );
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
* IPS_GetSubscriptionExpiration
* 
* @returns integer
*/

function IPS_GetSubscriptionExpiration(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetSubscriptionExpiration(  );
	return $result;
}

/**
* IPS_GetSystemLanguage
* 
* @returns string
*/

function IPS_GetSystemLanguage(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetSystemLanguage(  );
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
* @param array $TimerIDs
*/

function IPS_GetTimers( $TimerIDs ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetTimers( $TimerIDs );
	return $result;
}

/**
* IPS_GetUpdateChannel
* 
* @returns string
*/

function IPS_GetUpdateChannel(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_GetUpdateChannel(  );
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
* IPS_IsConditionPassing
* 
* @returns boolean
* @param string $Conditions
*/

function IPS_IsConditionPassing( $Conditions ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_IsConditionPassing( $Conditions );
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
* IPS_IsLicenseChangePending
* 
* @returns boolean
*/

function IPS_IsLicenseChangePending(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_IsLicenseChangePending(  );
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
* IPS_IsReplicationActive
* 
* @returns boolean
*/

function IPS_IsReplicationActive(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_IsReplicationActive(  );
	return $result;
}

/**
* IPS_IsReplicationMaster
* 
* @returns boolean
*/

function IPS_IsReplicationMaster(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_IsReplicationMaster(  );
	return $result;
}

/**
* IPS_IsReplicationOnStandBy
* 
* @returns boolean
*/

function IPS_IsReplicationOnStandBy(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_IsReplicationOnStandBy(  );
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
* IPS_MakeCrash
* 
* @returns boolean
*/

function IPS_MakeCrash(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_MakeCrash(  );
	return $result;
}

/**
* IPS_MakeLeak
* 
* @returns boolean
*/

function IPS_MakeLeak(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_MakeLeak(  );
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
* IPS_RunAction
* 
* @returns boolean
* @param string $ActionID
* @param array $Parameters
*/

function IPS_RunAction( $ActionID,$Parameters ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_RunAction( $ActionID,$Parameters );
	return $result;
}

/**
* IPS_RunActionWait
* 
* @returns string
* @param string $ActionID
* @param array $Parameters
*/

function IPS_RunActionWait( $ActionID,$Parameters ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_RunActionWait( $ActionID,$Parameters );
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
* IPS_SetEventAction
* 
* @returns boolean
* @param integer $EventID
* @param string $ActionID
* @param array $ActionParameters
*/

function IPS_SetEventAction( $EventID,$ActionID,$ActionParameters ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetEventAction( $EventID,$ActionID,$ActionParameters );
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
* IPS_SetEventCondition
* 
* @returns boolean
* @param integer $EventID
* @param integer $ConditionID
* @param integer $ParentID
* @param integer $Operation
*   enum[0=eoAND, 1=eoOR, 2=eoNAND, 3=eoNOR]
*/

function IPS_SetEventCondition( $EventID,$ConditionID,$ParentID,$Operation ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetEventCondition( $EventID,$ConditionID,$ParentID,$Operation );
	return $result;
}

/**
* IPS_SetEventConditionDateRule
* 
* @returns boolean
* @param integer $EventID
* @param integer $ConditionID
* @param integer $RuleID
* @param integer $Comparison
*   enum[0=ecEqual, 1=ecNotEqual, 2=ecGreater, 3=ecGreaterOrEqual, 4=ecSmaller, 5=ecSmallerOrEqual]
* @param integer $Day
* @param integer $Month
* @param integer $Year
*/

function IPS_SetEventConditionDateRule( $EventID,$ConditionID,$RuleID,$Comparison,$Day,$Month,$Year ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetEventConditionDateRule( $EventID,$ConditionID,$RuleID,$Comparison,$Day,$Month,$Year );
	return $result;
}

/**
* IPS_SetEventConditionDayOfTheWeekRule
* 
* @returns boolean
* @param integer $EventID
* @param integer $ConditionID
* @param integer $RuleID
* @param integer $Comparison
*   enum[0=ecEqual, 1=ecNotEqual, 2=ecGreater, 3=ecGreaterOrEqual, 4=ecSmaller, 5=ecSmallerOrEqual]
* @param integer $Value
*/

function IPS_SetEventConditionDayOfTheWeekRule( $EventID,$ConditionID,$RuleID,$Comparison,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetEventConditionDayOfTheWeekRule( $EventID,$ConditionID,$RuleID,$Comparison,$Value );
	return $result;
}

/**
* IPS_SetEventConditionTimeRule
* 
* @returns boolean
* @param integer $EventID
* @param integer $ConditionID
* @param integer $RuleID
* @param integer $Comparison
*   enum[0=ecEqual, 1=ecNotEqual, 2=ecGreater, 3=ecGreaterOrEqual, 4=ecSmaller, 5=ecSmallerOrEqual]
* @param integer $Hour
* @param integer $Minute
* @param integer $Second
*/

function IPS_SetEventConditionTimeRule( $EventID,$ConditionID,$RuleID,$Comparison,$Hour,$Minute,$Second ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetEventConditionTimeRule( $EventID,$ConditionID,$RuleID,$Comparison,$Hour,$Minute,$Second );
	return $result;
}

/**
* IPS_SetEventConditionVariableDynamicRule
* 
* @returns boolean
* @param integer $EventID
* @param integer $ConditionID
* @param integer $RuleID
* @param integer $VariableID
* @param integer $Comparison
*   enum[0=ecEqual, 1=ecNotEqual, 2=ecGreater, 3=ecGreaterOrEqual, 4=ecSmaller, 5=ecSmallerOrEqual]
* @param integer $CompareVariableID
*/

function IPS_SetEventConditionVariableDynamicRule( $EventID,$ConditionID,$RuleID,$VariableID,$Comparison,$CompareVariableID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetEventConditionVariableDynamicRule( $EventID,$ConditionID,$RuleID,$VariableID,$Comparison,$CompareVariableID );
	return $result;
}

/**
* IPS_SetEventConditionVariableRule
* 
* @returns boolean
* @param integer $EventID
* @param integer $ConditionID
* @param integer $RuleID
* @param integer $VariableID
* @param integer $Comparison
*   enum[0=ecEqual, 1=ecNotEqual, 2=ecGreater, 3=ecGreaterOrEqual, 4=ecSmaller, 5=ecSmallerOrEqual]
* @param variant $Value
*/

function IPS_SetEventConditionVariableRule( $EventID,$ConditionID,$RuleID,$VariableID,$Comparison,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetEventConditionVariableRule( $EventID,$ConditionID,$RuleID,$VariableID,$Comparison,$Value );
	return $result;
}

/**
* IPS_SetEventConditionVariableStaticRule
* 
* @returns boolean
* @param integer $EventID
* @param integer $ConditionID
* @param integer $RuleID
* @param integer $VariableID
* @param integer $Comparison
*   enum[0=ecEqual, 1=ecNotEqual, 2=ecGreater, 3=ecGreaterOrEqual, 4=ecSmaller, 5=ecSmallerOrEqual]
* @param variant $Value
*/

function IPS_SetEventConditionVariableStaticRule( $EventID,$ConditionID,$RuleID,$VariableID,$Comparison,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetEventConditionVariableStaticRule( $EventID,$ConditionID,$RuleID,$VariableID,$Comparison,$Value );
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
* @param integer $ScheduleActionID
* @param string $Name
* @param integer $Color
* @param string $ScriptText
*/

function IPS_SetEventScheduleAction( $EventID,$ScheduleActionID,$Name,$Color,$ScriptText ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetEventScheduleAction( $EventID,$ScheduleActionID,$Name,$Color,$ScriptText );
	return $result;
}

/**
* IPS_SetEventScheduleActionEx
* 
* @returns boolean
* @param integer $EventID
* @param integer $ScheduleActionID
* @param string $Name
* @param integer $Color
* @param string $ActionID
* @param array $ActionParameters
*/

function IPS_SetEventScheduleActionEx( $EventID,$ScheduleActionID,$Name,$Color,$ActionID,$ActionParameters ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetEventScheduleActionEx( $EventID,$ScheduleActionID,$Name,$Color,$ActionID,$ActionParameters );
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
* @param integer $TargetID
*/

function IPS_SetLinkTargetID( $LinkID,$TargetID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetLinkTargetID( $LinkID,$TargetID );
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
* @param variant $Value
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
* IPS_SetReplicationConfiguration
* 
* @returns boolean
* @param string $Configuration
*/

function IPS_SetReplicationConfiguration( $Configuration ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetReplicationConfiguration( $Configuration );
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
* IPS_SetSecurity
* 
* @returns boolean
* @param integer $Mode
* @param string $Password
*/

function IPS_SetSecurity( $Mode,$Password ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_SetSecurity( $Mode,$Password );
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
* @param variant $AssociationValue
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
* @returns boolean
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
* IPS_StopKernel
* 
* @returns boolean
*/

function IPS_StopKernel(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_StopKernel(  );
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
* IPS_Translate
* 
* @returns string
* @param integer $InstanceID
* @param string $Text
*/

function IPS_Translate( $InstanceID,$Text ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_Translate( $InstanceID,$Text );
	return $result;
}

/**
* IPS_TrimKernel
* 
* @returns boolean
*/

function IPS_TrimKernel(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_TrimKernel(  );
	return $result;
}

/**
* IPS_UpdateFormField
* 
* @returns boolean
* @param string $Name
* @param string $Parameter
* @param variant $Value
* @param string $SessionID
*/

function IPS_UpdateFormField( $Name,$Parameter,$Value,$SessionID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_UpdateFormField( $Name,$Parameter,$Value,$SessionID );
	return $result;
}

/**
* IPS_UpdateSubscriptionExpiration
* 
* @returns boolean
*/

function IPS_UpdateSubscriptionExpiration(  ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IPS_UpdateSubscriptionExpiration(  );
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
* IRT_UpdateFormButtons
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Remote
*/

function IRT_UpdateFormButtons( $InstanceID,$Remote ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IRT_UpdateFormButtons( $InstanceID,$Remote );
	return $result;
}

/**
* IRT_UpdateFormRemotes
* 
* @returns boolean
* @param integer $InstanceID
*/

function IRT_UpdateFormRemotes( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->IRT_UpdateFormRemotes( $InstanceID );
	return $result;
}

/**
* KNX_DoWrite
* 
* @returns boolean
* @param integer $InstanceID
* @param variant $Value
*/

function KNX_DoWrite( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_DoWrite( $InstanceID,$Value );
	return $result;
}

/**
* KNX_RenameVariables
* 
* @returns boolean
* @param integer $InstanceID
*/

function KNX_RenameVariables( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_RenameVariables( $InstanceID );
	return $result;
}

/**
* KNX_RequestStatus
* 
* @returns boolean
* @param integer $InstanceID
*/

function KNX_RequestStatus( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_RequestStatus( $InstanceID );
	return $result;
}

/**
* KNX_WriteDPT1
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $B
*/

function KNX_WriteDPT1( $InstanceID,$B ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT1( $InstanceID,$B );
	return $result;
}

/**
* KNX_WriteDPT10
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $WeekDay
* @param integer $TimeOfDay
*/

function KNX_WriteDPT10( $InstanceID,$WeekDay,$TimeOfDay ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT10( $InstanceID,$WeekDay,$TimeOfDay );
	return $result;
}

/**
* KNX_WriteDPT11
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Date
*/

function KNX_WriteDPT11( $InstanceID,$Date ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT11( $InstanceID,$Date );
	return $result;
}

/**
* KNX_WriteDPT12
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
*/

function KNX_WriteDPT12( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT12( $InstanceID,$Value );
	return $result;
}

/**
* KNX_WriteDPT13
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
*/

function KNX_WriteDPT13( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT13( $InstanceID,$Value );
	return $result;
}

/**
* KNX_WriteDPT14
* 
* @returns boolean
* @param integer $InstanceID
* @param float $Value
*/

function KNX_WriteDPT14( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT14( $InstanceID,$Value );
	return $result;
}

/**
* KNX_WriteDPT15
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $D1
* @param integer $D2
* @param integer $D3
* @param integer $D4
* @param integer $D5
* @param integer $D6
* @param boolean $E
* @param boolean $P
* @param boolean $D
* @param boolean $C
* @param integer $Index
*/

function KNX_WriteDPT15( $InstanceID,$D1,$D2,$D3,$D4,$D5,$D6,$E,$P,$D,$C,$Index ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT15( $InstanceID,$D1,$D2,$D3,$D4,$D5,$D6,$E,$P,$D,$C,$Index );
	return $result;
}

/**
* KNX_WriteDPT16
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Value
*/

function KNX_WriteDPT16( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT16( $InstanceID,$Value );
	return $result;
}

/**
* KNX_WriteDPT17
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
*/

function KNX_WriteDPT17( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT17( $InstanceID,$Value );
	return $result;
}

/**
* KNX_WriteDPT18
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $C
* @param integer $SceneNumber
*/

function KNX_WriteDPT18( $InstanceID,$C,$SceneNumber ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT18( $InstanceID,$C,$SceneNumber );
	return $result;
}

/**
* KNX_WriteDPT19
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Time
* @param integer $WeekDay
* @param boolean $F
* @param boolean $WD
* @param boolean $NWD
* @param boolean $NY
* @param boolean $ND
* @param boolean $NDOW
* @param boolean $NT
* @param boolean $SUTI
* @param boolean $CLQ
*/

function KNX_WriteDPT19( $InstanceID,$Time,$WeekDay,$F,$WD,$NWD,$NY,$ND,$NDOW,$NT,$SUTI,$CLQ ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT19( $InstanceID,$Time,$WeekDay,$F,$WD,$NWD,$NY,$ND,$NDOW,$NT,$SUTI,$CLQ );
	return $result;
}

/**
* KNX_WriteDPT2
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $C
* @param boolean $V
*/

function KNX_WriteDPT2( $InstanceID,$C,$V ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT2( $InstanceID,$C,$V );
	return $result;
}

/**
* KNX_WriteDPT20
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
*/

function KNX_WriteDPT20( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT20( $InstanceID,$Value );
	return $result;
}

/**
* KNX_WriteDPT200
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Z
* @param boolean $B
*/

function KNX_WriteDPT200( $InstanceID,$Z,$B ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT200( $InstanceID,$Z,$B );
	return $result;
}

/**
* KNX_WriteDPT201
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Z
* @param integer $N
*/

function KNX_WriteDPT201( $InstanceID,$Z,$N ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT201( $InstanceID,$Z,$N );
	return $result;
}

/**
* KNX_WriteDPT202
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $U
* @param integer $Z
*/

function KNX_WriteDPT202( $InstanceID,$U,$Z ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT202( $InstanceID,$U,$Z );
	return $result;
}

/**
* KNX_WriteDPT203
* 
* @returns boolean
* @param integer $InstanceID
* @param float $U
* @param integer $Z
*/

function KNX_WriteDPT203( $InstanceID,$U,$Z ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT203( $InstanceID,$U,$Z );
	return $result;
}

/**
* KNX_WriteDPT204
* 
* @returns boolean
* @param integer $InstanceID
* @param float $Value
* @param integer $Z
*/

function KNX_WriteDPT204( $InstanceID,$Value,$Z ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT204( $InstanceID,$Value,$Z );
	return $result;
}

/**
* KNX_WriteDPT205
* 
* @returns boolean
* @param integer $InstanceID
* @param float $Value
* @param integer $Z
*/

function KNX_WriteDPT205( $InstanceID,$Value,$Z ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT205( $InstanceID,$Value,$Z );
	return $result;
}

/**
* KNX_WriteDPT206
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Time
* @param integer $Mode
*/

function KNX_WriteDPT206( $InstanceID,$Time,$Mode ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT206( $InstanceID,$Time,$Mode );
	return $result;
}

/**
* KNX_WriteDPT207
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
* @param boolean $Attr0
* @param boolean $Attr1
* @param boolean $Attr2
* @param boolean $Attr3
* @param boolean $Attr4
* @param boolean $Attr5
* @param boolean $Attr6
* @param boolean $Attr7
*/

function KNX_WriteDPT207( $InstanceID,$Value,$Attr0,$Attr1,$Attr2,$Attr3,$Attr4,$Attr5,$Attr6,$Attr7 ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT207( $InstanceID,$Value,$Attr0,$Attr1,$Attr2,$Attr3,$Attr4,$Attr5,$Attr6,$Attr7 );
	return $result;
}

/**
* KNX_WriteDPT209
* 
* @returns boolean
* @param integer $InstanceID
* @param float $Temperature
* @param boolean $Attr0
* @param boolean $Attr1
* @param boolean $Attr2
* @param boolean $Attr3
* @param boolean $Attr4
*/

function KNX_WriteDPT209( $InstanceID,$Temperature,$Attr0,$Attr1,$Attr2,$Attr3,$Attr4 ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT209( $InstanceID,$Temperature,$Attr0,$Attr1,$Attr2,$Attr3,$Attr4 );
	return $result;
}

/**
* KNX_WriteDPT21
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $Bit0
* @param boolean $Bit1
* @param boolean $Bit2
* @param boolean $Bit3
* @param boolean $Bit4
* @param boolean $Bit5
* @param boolean $Bit6
* @param boolean $Bit7
*/

function KNX_WriteDPT21( $InstanceID,$Bit0,$Bit1,$Bit2,$Bit3,$Bit4,$Bit5,$Bit6,$Bit7 ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT21( $InstanceID,$Bit0,$Bit1,$Bit2,$Bit3,$Bit4,$Bit5,$Bit6,$Bit7 );
	return $result;
}

/**
* KNX_WriteDPT210
* 
* @returns boolean
* @param integer $InstanceID
* @param float $Temperature
* @param boolean $Attr0
* @param boolean $Attr1
* @param boolean $Attr2
* @param boolean $Attr3
* @param boolean $Attr4
* @param boolean $Attr5
* @param boolean $Attr6
* @param boolean $Attr7
* @param boolean $Attr8
* @param boolean $Attr9
* @param boolean $Attr10
* @param boolean $Attr11
*/

function KNX_WriteDPT210( $InstanceID,$Temperature,$Attr0,$Attr1,$Attr2,$Attr3,$Attr4,$Attr5,$Attr6,$Attr7,$Attr8,$Attr9,$Attr10,$Attr11 ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT210( $InstanceID,$Temperature,$Attr0,$Attr1,$Attr2,$Attr3,$Attr4,$Attr5,$Attr6,$Attr7,$Attr8,$Attr9,$Attr10,$Attr11 );
	return $result;
}

/**
* KNX_WriteDPT211
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Demand
* @param integer $ControllerMode
*/

function KNX_WriteDPT211( $InstanceID,$Demand,$ControllerMode ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT211( $InstanceID,$Demand,$ControllerMode );
	return $result;
}

/**
* KNX_WriteDPT212
* 
* @returns boolean
* @param integer $InstanceID
* @param float $TempSetpoint1
* @param float $TempSetpoint2
* @param float $TempSetpoint3
*/

function KNX_WriteDPT212( $InstanceID,$TempSetpoint1,$TempSetpoint2,$TempSetpoint3 ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT212( $InstanceID,$TempSetpoint1,$TempSetpoint2,$TempSetpoint3 );
	return $result;
}

/**
* KNX_WriteDPT213
* 
* @returns boolean
* @param integer $InstanceID
* @param float $TempSetpoint1
* @param float $TempSetpoint2
* @param float $TempSetpoint3
* @param float $TempSetpoint4
*/

function KNX_WriteDPT213( $InstanceID,$TempSetpoint1,$TempSetpoint2,$TempSetpoint3,$TempSetpoint4 ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT213( $InstanceID,$TempSetpoint1,$TempSetpoint2,$TempSetpoint3,$TempSetpoint4 );
	return $result;
}

/**
* KNX_WriteDPT214
* 
* @returns boolean
* @param integer $InstanceID
* @param float $Temperature
* @param integer $Demand
* @param boolean $Attr0
* @param boolean $Attr1
* @param boolean $Attr2
* @param boolean $Attr3
* @param boolean $Attr4
* @param boolean $Attr5
*/

function KNX_WriteDPT214( $InstanceID,$Temperature,$Demand,$Attr0,$Attr1,$Attr2,$Attr3,$Attr4,$Attr5 ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT214( $InstanceID,$Temperature,$Demand,$Attr0,$Attr1,$Attr2,$Attr3,$Attr4,$Attr5 );
	return $result;
}

/**
* KNX_WriteDPT215
* 
* @returns boolean
* @param integer $InstanceID
* @param float $Temperature
* @param integer $Power
* @param boolean $Attr0
* @param boolean $Attr1
* @param boolean $Attr2
* @param boolean $Attr3
* @param boolean $Attr4
* @param boolean $Attr5
* @param boolean $Attr6
* @param boolean $Attr7
* @param boolean $Attr8
* @param boolean $Attr9
* @param boolean $Attr10
* @param boolean $Attr11
*/

function KNX_WriteDPT215( $InstanceID,$Temperature,$Power,$Attr0,$Attr1,$Attr2,$Attr3,$Attr4,$Attr5,$Attr6,$Attr7,$Attr8,$Attr9,$Attr10,$Attr11 ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT215( $InstanceID,$Temperature,$Power,$Attr0,$Attr1,$Attr2,$Attr3,$Attr4,$Attr5,$Attr6,$Attr7,$Attr8,$Attr9,$Attr10,$Attr11 );
	return $result;
}

/**
* KNX_WriteDPT216
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Pnom
* @param integer $BstageLimit
* @param integer $BurnerType
* @param boolean $OilSupport
* @param boolean $GasSupport
* @param boolean $SolidSupport
*/

function KNX_WriteDPT216( $InstanceID,$Pnom,$BstageLimit,$BurnerType,$OilSupport,$GasSupport,$SolidSupport ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT216( $InstanceID,$Pnom,$BstageLimit,$BurnerType,$OilSupport,$GasSupport,$SolidSupport );
	return $result;
}

/**
* KNX_WriteDPT217
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Magic
* @param integer $Version
* @param integer $Revision
*/

function KNX_WriteDPT217( $InstanceID,$Magic,$Version,$Revision ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT217( $InstanceID,$Magic,$Version,$Revision );
	return $result;
}

/**
* KNX_WriteDPT218
* 
* @returns boolean
* @param integer $InstanceID
* @param float $Volume
* @param integer $Z
*/

function KNX_WriteDPT218( $InstanceID,$Volume,$Z ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT218( $InstanceID,$Volume,$Z );
	return $result;
}

/**
* KNX_WriteDPT219
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $LogNumber
* @param integer $AlarmPriority
* @param integer $ApplicationArea
* @param integer $ErrorClass
* @param boolean $Attribut0
* @param boolean $Attribut1
* @param boolean $Attribut2
* @param boolean $Attribut3
* @param boolean $AlarmStatus0
* @param boolean $AlarmStatus1
* @param boolean $AlarmStatus2
*/

function KNX_WriteDPT219( $InstanceID,$LogNumber,$AlarmPriority,$ApplicationArea,$ErrorClass,$Attribut0,$Attribut1,$Attribut2,$Attribut3,$AlarmStatus0,$AlarmStatus1,$AlarmStatus2 ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT219( $InstanceID,$LogNumber,$AlarmPriority,$ApplicationArea,$ErrorClass,$Attribut0,$Attribut1,$Attribut2,$Attribut3,$AlarmStatus0,$AlarmStatus1,$AlarmStatus2 );
	return $result;
}

/**
* KNX_WriteDPT22
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $Bit0
* @param boolean $Bit1
* @param boolean $Bit2
* @param boolean $Bit3
* @param boolean $Bit4
* @param boolean $Bit5
* @param boolean $Bit6
* @param boolean $Bit7
* @param boolean $Bit8
* @param boolean $Bit9
* @param boolean $Bit10
* @param boolean $Bit11
* @param boolean $Bit12
* @param boolean $Bit13
* @param boolean $Bit14
* @param boolean $Bit15
*/

function KNX_WriteDPT22( $InstanceID,$Bit0,$Bit1,$Bit2,$Bit3,$Bit4,$Bit5,$Bit6,$Bit7,$Bit8,$Bit9,$Bit10,$Bit11,$Bit12,$Bit13,$Bit14,$Bit15 ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT22( $InstanceID,$Bit0,$Bit1,$Bit2,$Bit3,$Bit4,$Bit5,$Bit6,$Bit7,$Bit8,$Bit9,$Bit10,$Bit11,$Bit12,$Bit13,$Bit14,$Bit15 );
	return $result;
}

/**
* KNX_WriteDPT220
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $DelayTime
* @param float $Temp
*/

function KNX_WriteDPT220( $InstanceID,$DelayTime,$Temp ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT220( $InstanceID,$DelayTime,$Temp );
	return $result;
}

/**
* KNX_WriteDPT221
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $ManufacturerCode
* @param integer $IncrementedNumber
*/

function KNX_WriteDPT221( $InstanceID,$ManufacturerCode,$IncrementedNumber ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT221( $InstanceID,$ManufacturerCode,$IncrementedNumber );
	return $result;
}

/**
* KNX_WriteDPT222
* 
* @returns boolean
* @param integer $InstanceID
* @param float $Comfort
* @param float $Standby
* @param float $Economy
*/

function KNX_WriteDPT222( $InstanceID,$Comfort,$Standby,$Economy ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT222( $InstanceID,$Comfort,$Standby,$Economy );
	return $result;
}

/**
* KNX_WriteDPT223
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $EnergyDem
* @param integer $ControllerMode
* @param integer $EmergencyMode
*/

function KNX_WriteDPT223( $InstanceID,$EnergyDem,$ControllerMode,$EmergencyMode ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT223( $InstanceID,$EnergyDem,$ControllerMode,$EmergencyMode );
	return $result;
}

/**
* KNX_WriteDPT224
* 
* @returns boolean
* @param integer $InstanceID
* @param float $Cooling
* @param float $Heating
* @param integer $ControllerMode
* @param integer $EmergencyMode
*/

function KNX_WriteDPT224( $InstanceID,$Cooling,$Heating,$ControllerMode,$EmergencyMode ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT224( $InstanceID,$Cooling,$Heating,$ControllerMode,$EmergencyMode );
	return $result;
}

/**
* KNX_WriteDPT225
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value0
* @param integer $Value1
*/

function KNX_WriteDPT225( $InstanceID,$Value0,$Value1 ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT225( $InstanceID,$Value0,$Value1 );
	return $result;
}

/**
* KNX_WriteDPT229
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $V
* @param integer $Z
*/

function KNX_WriteDPT229( $InstanceID,$V,$Z ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT229( $InstanceID,$V,$Z );
	return $result;
}

/**
* KNX_WriteDPT23
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
*/

function KNX_WriteDPT23( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT23( $InstanceID,$Value );
	return $result;
}

/**
* KNX_WriteDPT230
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $ManufactID
* @param integer $IdentNumber
* @param integer $Version
* @param integer $Medium
*/

function KNX_WriteDPT230( $InstanceID,$ManufactID,$IdentNumber,$Version,$Medium ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT230( $InstanceID,$ManufactID,$IdentNumber,$Version,$Medium );
	return $result;
}

/**
* KNX_WriteDPT231
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Language
* @param string $Region
*/

function KNX_WriteDPT231( $InstanceID,$Language,$Region ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT231( $InstanceID,$Language,$Region );
	return $result;
}

/**
* KNX_WriteDPT232
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $R
* @param integer $G
* @param integer $B
*/

function KNX_WriteDPT232( $InstanceID,$R,$G,$B ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT232( $InstanceID,$R,$G,$B );
	return $result;
}

/**
* KNX_WriteDPT234
* 
* @returns boolean
* @param integer $InstanceID
* @param string $LanguageCode
*/

function KNX_WriteDPT234( $InstanceID,$LanguageCode ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT234( $InstanceID,$LanguageCode );
	return $result;
}

/**
* KNX_WriteDPT235
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $ActiveElectricalEnergy
* @param integer $Tariff
* @param boolean $E
* @param boolean $T
*/

function KNX_WriteDPT235( $InstanceID,$ActiveElectricalEnergy,$Tariff,$E,$T ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT235( $InstanceID,$ActiveElectricalEnergy,$Tariff,$E,$T );
	return $result;
}

/**
* KNX_WriteDPT236
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $D
* @param integer $P
* @param integer $M
*/

function KNX_WriteDPT236( $InstanceID,$D,$P,$M ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT236( $InstanceID,$D,$P,$M );
	return $result;
}

/**
* KNX_WriteDPT237
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $CE
* @param boolean $BF
* @param boolean $LF
* @param boolean $RR
* @param boolean $AI
* @param integer $Addr
*/

function KNX_WriteDPT237( $InstanceID,$CE,$BF,$LF,$RR,$AI,$Addr ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT237( $InstanceID,$CE,$BF,$LF,$RR,$AI,$Addr );
	return $result;
}

/**
* KNX_WriteDPT238
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $B7
* @param boolean $B6
* @param integer $Value
*/

function KNX_WriteDPT238( $InstanceID,$B7,$B6,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT238( $InstanceID,$B7,$B6,$Value );
	return $result;
}

/**
* KNX_WriteDPT239
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $SetValue
* @param boolean $ChannelActivation
*/

function KNX_WriteDPT239( $InstanceID,$SetValue,$ChannelActivation ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT239( $InstanceID,$SetValue,$ChannelActivation );
	return $result;
}

/**
* KNX_WriteDPT240
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $HeightPos
* @param integer $SlatsPos
* @param boolean $ValidHeightPos
* @param boolean $ValidSlatsPos
*/

function KNX_WriteDPT240( $InstanceID,$HeightPos,$SlatsPos,$ValidHeightPos,$ValidSlatsPos ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT240( $InstanceID,$HeightPos,$SlatsPos,$ValidHeightPos,$ValidSlatsPos );
	return $result;
}

/**
* KNX_WriteDPT241
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $HeightPos
* @param integer $SlatsPos
* @param boolean $A
* @param boolean $B
* @param boolean $C
* @param boolean $D
* @param boolean $E
* @param boolean $F
* @param boolean $G
* @param boolean $H
* @param boolean $I
* @param boolean $J
* @param boolean $K
* @param boolean $L
* @param boolean $M
* @param boolean $N
* @param boolean $O
* @param boolean $P
*/

function KNX_WriteDPT241( $InstanceID,$HeightPos,$SlatsPos,$A,$B,$C,$D,$E,$F,$G,$H,$I,$J,$K,$L,$M,$N,$O,$P ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT241( $InstanceID,$HeightPos,$SlatsPos,$A,$B,$C,$D,$E,$F,$G,$H,$I,$J,$K,$L,$M,$N,$O,$P );
	return $result;
}

/**
* KNX_WriteDPT242
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $XAxis
* @param integer $YAxis
* @param integer $Brightness
* @param boolean $C
* @param boolean $B
*/

function KNX_WriteDPT242( $InstanceID,$XAxis,$YAxis,$Brightness,$C,$B ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT242( $InstanceID,$XAxis,$YAxis,$Brightness,$C,$B );
	return $result;
}

/**
* KNX_WriteDPT249
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $TimePeriod
* @param integer $AbsoluteColourTemperature
* @param integer $AbsoluteBrightness
* @param boolean $B0
* @param boolean $B1
* @param boolean $B2
*/

function KNX_WriteDPT249( $InstanceID,$TimePeriod,$AbsoluteColourTemperature,$AbsoluteBrightness,$B0,$B1,$B2 ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT249( $InstanceID,$TimePeriod,$AbsoluteColourTemperature,$AbsoluteBrightness,$B0,$B1,$B2 );
	return $result;
}

/**
* KNX_WriteDPT25
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Busy
* @param integer $Nak
*/

function KNX_WriteDPT25( $InstanceID,$Busy,$Nak ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT25( $InstanceID,$Busy,$Nak );
	return $result;
}

/**
* KNX_WriteDPT251
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $R
* @param integer $G
* @param integer $B
* @param integer $W
* @param boolean $ValidR
* @param boolean $ValidG
* @param boolean $ValidB
* @param boolean $ValidW
*/

function KNX_WriteDPT251( $InstanceID,$R,$G,$B,$W,$ValidR,$ValidG,$ValidB,$ValidW ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT251( $InstanceID,$R,$G,$B,$W,$ValidR,$ValidG,$ValidB,$ValidW );
	return $result;
}

/**
* KNX_WriteDPT26
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $SceneNumber
* @param boolean $B
*/

function KNX_WriteDPT26( $InstanceID,$SceneNumber,$B ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT26( $InstanceID,$SceneNumber,$B );
	return $result;
}

/**
* KNX_WriteDPT27
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $S0
* @param boolean $S1
* @param boolean $S2
* @param boolean $S3
* @param boolean $S4
* @param boolean $S5
* @param boolean $S6
* @param boolean $S7
* @param boolean $S8
* @param boolean $S9
* @param boolean $S10
* @param boolean $S11
* @param boolean $S12
* @param boolean $S13
* @param boolean $S14
* @param boolean $S15
* @param boolean $M0
* @param boolean $M1
* @param boolean $M2
* @param boolean $M3
* @param boolean $M4
* @param boolean $M5
* @param boolean $M6
* @param boolean $M7
* @param boolean $M8
* @param boolean $M9
* @param boolean $M10
* @param boolean $M11
* @param boolean $M12
* @param boolean $M13
* @param boolean $M14
* @param boolean $M15
*/

function KNX_WriteDPT27( $InstanceID,$S0,$S1,$S2,$S3,$S4,$S5,$S6,$S7,$S8,$S9,$S10,$S11,$S12,$S13,$S14,$S15,$M0,$M1,$M2,$M3,$M4,$M5,$M6,$M7,$M8,$M9,$M10,$M11,$M12,$M13,$M14,$M15 ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT27( $InstanceID,$S0,$S1,$S2,$S3,$S4,$S5,$S6,$S7,$S8,$S9,$S10,$S11,$S12,$S13,$S14,$S15,$M0,$M1,$M2,$M3,$M4,$M5,$M6,$M7,$M8,$M9,$M10,$M11,$M12,$M13,$M14,$M15 );
	return $result;
}

/**
* KNX_WriteDPT275
* 
* @returns boolean
* @param integer $InstanceID
* @param float $TempSetpoint1
* @param float $TempSetpoint2
* @param float $TempSetpoint3
* @param float $TempSetpoint4
*/

function KNX_WriteDPT275( $InstanceID,$TempSetpoint1,$TempSetpoint2,$TempSetpoint3,$TempSetpoint4 ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT275( $InstanceID,$TempSetpoint1,$TempSetpoint2,$TempSetpoint3,$TempSetpoint4 );
	return $result;
}

/**
* KNX_WriteDPT29
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
*/

function KNX_WriteDPT29( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT29( $InstanceID,$Value );
	return $result;
}

/**
* KNX_WriteDPT3
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $C
* @param integer $StepCode
*/

function KNX_WriteDPT3( $InstanceID,$C,$StepCode ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT3( $InstanceID,$C,$StepCode );
	return $result;
}

/**
* KNX_WriteDPT30
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $Bit0
* @param boolean $Bit1
* @param boolean $Bit2
* @param boolean $Bit3
* @param boolean $Bit4
* @param boolean $Bit5
* @param boolean $Bit6
* @param boolean $Bit7
* @param boolean $Bit8
* @param boolean $Bit9
* @param boolean $Bit10
* @param boolean $Bit11
* @param boolean $Bit12
* @param boolean $Bit13
* @param boolean $Bit14
* @param boolean $Bit15
* @param boolean $Bit16
* @param boolean $Bit17
* @param boolean $Bit18
* @param boolean $Bit19
* @param boolean $Bit20
* @param boolean $Bit21
* @param boolean $Bit22
* @param boolean $Bit23
*/

function KNX_WriteDPT30( $InstanceID,$Bit0,$Bit1,$Bit2,$Bit3,$Bit4,$Bit5,$Bit6,$Bit7,$Bit8,$Bit9,$Bit10,$Bit11,$Bit12,$Bit13,$Bit14,$Bit15,$Bit16,$Bit17,$Bit18,$Bit19,$Bit20,$Bit21,$Bit22,$Bit23 ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT30( $InstanceID,$Bit0,$Bit1,$Bit2,$Bit3,$Bit4,$Bit5,$Bit6,$Bit7,$Bit8,$Bit9,$Bit10,$Bit11,$Bit12,$Bit13,$Bit14,$Bit15,$Bit16,$Bit17,$Bit18,$Bit19,$Bit20,$Bit21,$Bit22,$Bit23 );
	return $result;
}

/**
* KNX_WriteDPT31
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
*/

function KNX_WriteDPT31( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT31( $InstanceID,$Value );
	return $result;
}

/**
* KNX_WriteDPT4
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Value
*/

function KNX_WriteDPT4( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT4( $InstanceID,$Value );
	return $result;
}

/**
* KNX_WriteDPT5
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $U
*/

function KNX_WriteDPT5( $InstanceID,$U ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT5( $InstanceID,$U );
	return $result;
}

/**
* KNX_WriteDPT6
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $A
* @param boolean $B
* @param boolean $C
* @param boolean $D
* @param boolean $E
* @param integer $F
*/

function KNX_WriteDPT6( $InstanceID,$A,$B,$C,$D,$E,$F ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT6( $InstanceID,$A,$B,$C,$D,$E,$F );
	return $result;
}

/**
* KNX_WriteDPT7
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
*/

function KNX_WriteDPT7( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT7( $InstanceID,$Value );
	return $result;
}

/**
* KNX_WriteDPT8
* 
* @returns boolean
* @param integer $InstanceID
* @param float $Value
*/

function KNX_WriteDPT8( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT8( $InstanceID,$Value );
	return $result;
}

/**
* KNX_WriteDPT9
* 
* @returns boolean
* @param integer $InstanceID
* @param float $Value
*/

function KNX_WriteDPT9( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->KNX_WriteDPT9( $InstanceID,$Value );
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
* LCN_AddThresholdCurrent
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Register
* @param integer $Threshold
* @param float $Value
*/

function LCN_AddThresholdCurrent( $InstanceID,$Register,$Threshold,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_AddThresholdCurrent( $InstanceID,$Register,$Threshold,$Value );
	return $result;
}

/**
* LCN_AddThresholdDefined
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Register
* @param integer $Threshold
* @param float $Value
*/

function LCN_AddThresholdDefined( $InstanceID,$Register,$Threshold,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_AddThresholdDefined( $InstanceID,$Register,$Threshold,$Value );
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
* LCN_DeductThresholdCurrent
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Register
* @param integer $Threshold
* @param float $Value
*/

function LCN_DeductThresholdCurrent( $InstanceID,$Register,$Threshold,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_DeductThresholdCurrent( $InstanceID,$Register,$Threshold,$Value );
	return $result;
}

/**
* LCN_DeductThresholdDefined
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Register
* @param integer $Threshold
* @param float $Value
*/

function LCN_DeductThresholdDefined( $InstanceID,$Register,$Threshold,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_DeductThresholdDefined( $InstanceID,$Register,$Threshold,$Value );
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
* LCN_SetDisplayText
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Row
* @param string $Text
*/

function LCN_SetDisplayText( $InstanceID,$Row,$Text ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_SetDisplayText( $InstanceID,$Row,$Text );
	return $result;
}

/**
* LCN_SetDisplayTime
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Row
* @param integer $Duration
*/

function LCN_SetDisplayTime( $InstanceID,$Row,$Duration ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_SetDisplayTime( $InstanceID,$Row,$Duration );
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
* LCN_SetRGBW
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $R
* @param integer $G
* @param integer $B
* @param integer $W
*/

function LCN_SetRGBW( $InstanceID,$R,$G,$B,$W ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_SetRGBW( $InstanceID,$R,$G,$B,$W );
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
* LCN_ShutterMove
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Position
*/

function LCN_ShutterMove( $InstanceID,$Position ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_ShutterMove( $InstanceID,$Position );
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
* LCN_SwitchRelayTimer
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Timerfactor
*/

function LCN_SwitchRelayTimer( $InstanceID,$Timerfactor ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->LCN_SwitchRelayTimer( $InstanceID,$Timerfactor );
	return $result;
}

/**
* MBUS_SearchDevices
* 
* @returns boolean
* @param integer $InstanceID
*/

function MBUS_SearchDevices( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MBUS_SearchDevices( $InstanceID );
	return $result;
}

/**
* MBUS_UpdateFormAddressing
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $UseSecondaryAddress
*/

function MBUS_UpdateFormAddressing( $InstanceID,$UseSecondaryAddress ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MBUS_UpdateFormAddressing( $InstanceID,$UseSecondaryAddress );
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
* MC_GetModule
* 
* @returns array
* @param integer $InstanceID
* @param string $Module
*/

function MC_GetModule( $InstanceID,$Module ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MC_GetModule( $InstanceID,$Module );
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
* MC_GetModuleRepositoryLocalBranchList
* 
* @returns array
* @param integer $InstanceID
* @param string $Module
*/

function MC_GetModuleRepositoryLocalBranchList( $InstanceID,$Module ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MC_GetModuleRepositoryLocalBranchList( $InstanceID,$Module );
	return $result;
}

/**
* MC_GetModuleRepositoryRemoteBranchList
* 
* @returns array
* @param integer $InstanceID
* @param string $Module
*/

function MC_GetModuleRepositoryRemoteBranchList( $InstanceID,$Module ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MC_GetModuleRepositoryRemoteBranchList( $InstanceID,$Module );
	return $result;
}

/**
* MC_IsModuleClean
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Module
*/

function MC_IsModuleClean( $InstanceID,$Module ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MC_IsModuleClean( $InstanceID,$Module );
	return $result;
}

/**
* MC_IsModuleUpdateAvailable
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Module
*/

function MC_IsModuleUpdateAvailable( $InstanceID,$Module ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MC_IsModuleUpdateAvailable( $InstanceID,$Module );
	return $result;
}

/**
* MC_IsModuleValid
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Module
*/

function MC_IsModuleValid( $InstanceID,$Module ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MC_IsModuleValid( $InstanceID,$Module );
	return $result;
}

/**
* MC_ReloadModule
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Module
*/

function MC_ReloadModule( $InstanceID,$Module ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MC_ReloadModule( $InstanceID,$Module );
	return $result;
}

/**
* MC_RevertModule
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Module
*/

function MC_RevertModule( $InstanceID,$Module ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MC_RevertModule( $InstanceID,$Module );
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
* MC_UpdateModuleRepositoryBranch
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Module
* @param string $Branch
*/

function MC_UpdateModuleRepositoryBranch( $InstanceID,$Module,$Branch ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MC_UpdateModuleRepositoryBranch( $InstanceID,$Module,$Branch );
	return $result;
}

/**
* MQTTPUB_Publish
* 
* @returns variant
* @param integer $InstanceID
* @param integer $id
*/

function MQTTPUB_Publish( $InstanceID,$id ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MQTTPUB_Publish( $InstanceID,$id );
	return $result;
}

/**
* MQTTPUB_Subscribe
* 
* @returns variant
* @param integer $InstanceID
* @param integer $id
*/

function MQTTPUB_Subscribe( $InstanceID,$id ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MQTTPUB_Subscribe( $InstanceID,$id );
	return $result;
}

/**
* MQTTPUB_Subscribe_All
* 
* @returns variant
* @param integer $InstanceID
* @param integer $id
* @param string $ident
*/

function MQTTPUB_Subscribe_All( $InstanceID,$id,$ident ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MQTTPUB_Subscribe_All( $InstanceID,$id,$ident );
	return $result;
}

/**
* MQTTPUB_UnSubscribe
* 
* @returns variant
* @param integer $InstanceID
* @param integer $id
*/

function MQTTPUB_UnSubscribe( $InstanceID,$id ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MQTTPUB_UnSubscribe( $InstanceID,$id );
	return $result;
}

/**
* MQTTPUB_UnSubscribe_All
* 
* @returns variant
* @param integer $InstanceID
* @param integer $id
* @param string $ident
*/

function MQTTPUB_UnSubscribe_All( $InstanceID,$id,$ident ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MQTTPUB_UnSubscribe_All( $InstanceID,$id,$ident );
	return $result;
}

/**
* MQTT_ClearRetainedMessages
* 
* @returns boolean
* @param integer $InstanceID
*/

function MQTT_ClearRetainedMessages( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MQTT_ClearRetainedMessages( $InstanceID );
	return $result;
}

/**
* MQTT_ClearTopics
* 
* @returns boolean
* @param integer $InstanceID
*/

function MQTT_ClearTopics( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MQTT_ClearTopics( $InstanceID );
	return $result;
}

/**
* MQTT_GetKnownDevices
* 
* @returns array
* @param integer $InstanceID
*/

function MQTT_GetKnownDevices( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MQTT_GetKnownDevices( $InstanceID );
	return $result;
}

/**
* MQTT_GetRetainedMessage
* 
* @returns array
* @param integer $InstanceID
* @param string $Topic
*/

function MQTT_GetRetainedMessage( $InstanceID,$Topic ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MQTT_GetRetainedMessage( $InstanceID,$Topic );
	return $result;
}

/**
* MQTT_GetRetainedMessageTopicList
* 
* @returns array
* @param integer $InstanceID
*/

function MQTT_GetRetainedMessageTopicList( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MQTT_GetRetainedMessageTopicList( $InstanceID );
	return $result;
}

/**
* MQTT_RemoveRetainedMessage
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Topic
*/

function MQTT_RemoveRetainedMessage( $InstanceID,$Topic ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MQTT_RemoveRetainedMessage( $InstanceID,$Topic );
	return $result;
}

/**
* MQTT_UIChangeSendTopic
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $Active
*/

function MQTT_UIChangeSendTopic( $InstanceID,$Active ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MQTT_UIChangeSendTopic( $InstanceID,$Active );
	return $result;
}

/**
* MQTT_UIChangeType
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Type
*/

function MQTT_UIChangeType( $InstanceID,$Type ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MQTT_UIChangeType( $InstanceID,$Type );
	return $result;
}

/**
* MSCK_SendPacket
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Text
* @param string $ClientIP
* @param integer $ClientPort
*/

function MSCK_SendPacket( $InstanceID,$Text,$ClientIP,$ClientPort ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MSCK_SendPacket( $InstanceID,$Text,$ClientIP,$ClientPort );
	return $result;
}

/**
* MSCK_SendText
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Text
*/

function MSCK_SendText( $InstanceID,$Text ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->MSCK_SendText( $InstanceID,$Text );
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
* ModBus_UIChangeMode
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Mode
*   enum[0=mbgmTCP, 1=mbgmRTU, 2=mbgmRTUoverTCP, 3=mbgmTCPoverUDP, 4=mbgmSymBoxRTU, 5=mbgmSymBoxASCII, 6=mbgmRTUoverUDP, 7=mbgmASCII, 8=mbgmASCIIoverTCP, 9=mbgmASCIIoverUDP]
*/

function ModBus_UIChangeMode( $InstanceID,$Mode ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ModBus_UIChangeMode( $InstanceID,$Mode );
	return $result;
}

/**
* ModBus_UIExportTemplate
* 
* @returns string
* @param integer $InstanceID
*/

function ModBus_UIExportTemplate( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ModBus_UIExportTemplate( $InstanceID );
	return $result;
}

/**
* ModBus_UIForm
* 
* @returns string
* @param integer $InstanceID
* @param integer $DataType
*   enum[0=mbBit, 1=mbUInt8MSB, 2=mbUInt16, 3=mbUInt32, 4=mbInt8MSB, 5=mbInt16, 6=mbInt32, 7=mbFloat32, 8=mbInt64, 9=mbFloat64, 10=mbStringPlain, 11=mbUInt64, 12=mbUInt8LSB, 13=mbInt8LSB, 14=mbStringHex]
* @param float $Factor
*/

function ModBus_UIForm( $InstanceID,$DataType,$Factor ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ModBus_UIForm( $InstanceID,$DataType,$Factor );
	return $result;
}

/**
* ModBus_UIFormVirtual
* 
* @returns string
* @param integer $InstanceID
* @param integer $VariableType
*   enum[0=vtBoolean, 1=vtInteger, 2=vtFloat, 3=vtString]
*/

function ModBus_UIFormVirtual( $InstanceID,$VariableType ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ModBus_UIFormVirtual( $InstanceID,$VariableType );
	return $result;
}

/**
* ModBus_UIImportTemplate
* 
* @returns boolean
* @param integer $InstanceID
* @param string $ImportData
*/

function ModBus_UIImportTemplate( $InstanceID,$ImportData ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ModBus_UIImportTemplate( $InstanceID,$ImportData );
	return $result;
}

/**
* ModBus_UIUpdate
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $DataType
*   enum[0=mbBit, 1=mbUInt8MSB, 2=mbUInt16, 3=mbUInt32, 4=mbInt8MSB, 5=mbInt16, 6=mbInt32, 7=mbFloat32, 8=mbInt64, 9=mbFloat64, 10=mbStringPlain, 11=mbUInt64, 12=mbUInt8LSB, 13=mbInt8LSB, 14=mbStringHex]
* @param integer $ReadFunctionCode
* @param integer $WriteFunctionCode
* @param float $Factor
*/

function ModBus_UIUpdate( $InstanceID,$DataType,$ReadFunctionCode,$WriteFunctionCode,$Factor ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ModBus_UIUpdate( $InstanceID,$DataType,$ReadFunctionCode,$WriteFunctionCode,$Factor );
	return $result;
}

/**
* ModBus_UIUpdateVirtual
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $VariableType
*   enum[0=vtBoolean, 1=vtInteger, 2=vtFloat, 3=vtString]
*/

function ModBus_UIUpdateVirtual( $InstanceID,$VariableType ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ModBus_UIUpdateVirtual( $InstanceID,$VariableType );
	return $result;
}

/**
* ModBus_UIValidateTemplate
* 
* @returns boolean
* @param integer $InstanceID
* @param string $ImportData
*/

function ModBus_UIValidateTemplate( $InstanceID,$ImportData ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ModBus_UIValidateTemplate( $InstanceID,$ImportData );
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
* ModBus_WriteRegisterString
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Value
*/

function ModBus_WriteRegisterString( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ModBus_WriteRegisterString( $InstanceID,$Value );
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
* @param integer $VisualizationID
*/

function NC_AddDevice( $InstanceID,$Token,$Provider,$DeviceID,$Name,$VisualizationID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->NC_AddDevice( $InstanceID,$Token,$Provider,$DeviceID,$Name,$VisualizationID );
	return $result;
}

/**
* NC_DeleteNotification
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $NotificationID
*/

function NC_DeleteNotification( $InstanceID,$NotificationID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->NC_DeleteNotification( $InstanceID,$NotificationID );
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
* NC_GetNotification
* 
* @returns array
* @param integer $InstanceID
* @param integer $NotificationID
*/

function NC_GetNotification( $InstanceID,$NotificationID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->NC_GetNotification( $InstanceID,$NotificationID );
	return $result;
}

/**
* NC_GetNotifications
* 
* @returns array
* @param integer $InstanceID
*/

function NC_GetNotifications( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->NC_GetNotifications( $InstanceID );
	return $result;
}

/**
* NC_GetRequestLimitCount
* 
* @returns integer
* @param integer $InstanceID
*/

function NC_GetRequestLimitCount( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->NC_GetRequestLimitCount( $InstanceID );
	return $result;
}

/**
* NC_PushNotification
* 
* @returns integer
* @param integer $InstanceID
* @param integer $VisualizationID
* @param string $Title
* @param string $Body
* @param string $Sound
*/

function NC_PushNotification( $InstanceID,$VisualizationID,$Title,$Body,$Sound ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->NC_PushNotification( $InstanceID,$VisualizationID,$Title,$Body,$Sound );
	return $result;
}

/**
* NC_ReadNotification
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $NotificationID
*/

function NC_ReadNotification( $InstanceID,$NotificationID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->NC_ReadNotification( $InstanceID,$NotificationID );
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
* NC_RemoveDeviceVisualization
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $DeviceID
* @param integer $VisualizationID
*/

function NC_RemoveDeviceVisualization( $InstanceID,$DeviceID,$VisualizationID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->NC_RemoveDeviceVisualization( $InstanceID,$DeviceID,$VisualizationID );
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
* NC_SetDeviceVisualization
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $DeviceID
* @param integer $VisualizationID
* @param boolean $Enabled
*/

function NC_SetDeviceVisualization( $InstanceID,$DeviceID,$VisualizationID,$Enabled ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->NC_SetDeviceVisualization( $InstanceID,$DeviceID,$VisualizationID,$Enabled );
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
* NC_UpdateFormList
* 
* @returns boolean
* @param integer $InstanceID
*/

function NC_UpdateFormList( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->NC_UpdateFormList( $InstanceID );
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
* OC_PushMessage
* 
* @returns boolean
* @param integer $InstanceID
* @param string $ClientID
* @param string $Data
*/

function OC_PushMessage( $InstanceID,$ClientID,$Data ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OC_PushMessage( $InstanceID,$ClientID,$Data );
	return $result;
}

/**
* OPCUA_BrowseNode
* 
* @returns boolean
* @param integer $InstanceID
* @param string $NodeId
*/

function OPCUA_BrowseNode( $InstanceID,$NodeId ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OPCUA_BrowseNode( $InstanceID,$NodeId );
	return $result;
}

/**
* OPCUA_ClearNodes
* 
* @returns boolean
* @param integer $InstanceID
*/

function OPCUA_ClearNodes( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OPCUA_ClearNodes( $InstanceID );
	return $result;
}

/**
* OPCUA_GetKnownNodes
* 
* @returns array
* @param integer $InstanceID
*/

function OPCUA_GetKnownNodes( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OPCUA_GetKnownNodes( $InstanceID );
	return $result;
}

/**
* OPCUA_RequestStatus
* 
* @returns boolean
* @param integer $InstanceID
*/

function OPCUA_RequestStatus( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OPCUA_RequestStatus( $InstanceID );
	return $result;
}

/**
* OPCUA_Subscribe
* 
* @returns boolean
* @param integer $InstanceID
*/

function OPCUA_Subscribe( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OPCUA_Subscribe( $InstanceID );
	return $result;
}

/**
* OPCUA_WriteValue
* 
* @returns boolean
* @param integer $InstanceID
* @param variant $Value
*/

function OPCUA_WriteValue( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OPCUA_WriteValue( $InstanceID,$Value );
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
*/

function OZW_GetKnownItems( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OZW_GetKnownItems( $InstanceID );
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
* OZW_UpdateItems
* 
* @returns boolean
* @param integer $InstanceID
*/

function OZW_UpdateItems( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OZW_UpdateItems( $InstanceID );
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
* OZW_WriteDataPointEx
* 
* @returns boolean
* @param integer $InstanceID
* @param string $DataPoint
* @param variant $Value
*/

function OZW_WriteDataPointEx( $InstanceID,$DataPoint,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OZW_WriteDataPointEx( $InstanceID,$DataPoint,$Value );
	return $result;
}

/**
* OpenWeatherData_CalcAbsoluteHumidity
* 
* @returns variant
* @param integer $InstanceID
* @param float $temp
* @param float $humidity
*/

function OpenWeatherData_CalcAbsoluteHumidity( $InstanceID,$temp,$humidity ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OpenWeatherData_CalcAbsoluteHumidity( $InstanceID,$temp,$humidity );
	return $result;
}

/**
* OpenWeatherData_CalcAbsolutePressure
* 
* @returns variant
* @param integer $InstanceID
* @param float $pressure
* @param float $temp
* @param float $altitude
*/

function OpenWeatherData_CalcAbsolutePressure( $InstanceID,$pressure,$temp,$altitude ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OpenWeatherData_CalcAbsolutePressure( $InstanceID,$pressure,$temp,$altitude );
	return $result;
}

/**
* OpenWeatherData_CalcDewpoint
* 
* @returns variant
* @param integer $InstanceID
* @param float $temp
* @param float $humidity
*/

function OpenWeatherData_CalcDewpoint( $InstanceID,$temp,$humidity ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OpenWeatherData_CalcDewpoint( $InstanceID,$temp,$humidity );
	return $result;
}

/**
* OpenWeatherData_CalcHeatindex
* 
* @returns variant
* @param integer $InstanceID
* @param float $temp
* @param float $hum
*/

function OpenWeatherData_CalcHeatindex( $InstanceID,$temp,$hum ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OpenWeatherData_CalcHeatindex( $InstanceID,$temp,$hum );
	return $result;
}

/**
* OpenWeatherData_CalcWindchill
* 
* @returns variant
* @param integer $InstanceID
* @param float $temp
* @param integer $speed
*/

function OpenWeatherData_CalcWindchill( $InstanceID,$temp,$speed ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OpenWeatherData_CalcWindchill( $InstanceID,$temp,$speed );
	return $result;
}

/**
* OpenWeatherData_ConvertWindDirection2Text
* 
* @returns variant
* @param integer $InstanceID
* @param integer $dir
*/

function OpenWeatherData_ConvertWindDirection2Text( $InstanceID,$dir ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OpenWeatherData_ConvertWindDirection2Text( $InstanceID,$dir );
	return $result;
}

/**
* OpenWeatherData_ConvertWindSpeed2Strength
* 
* @returns variant
* @param integer $InstanceID
* @param integer $speed
*/

function OpenWeatherData_ConvertWindSpeed2Strength( $InstanceID,$speed ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OpenWeatherData_ConvertWindSpeed2Strength( $InstanceID,$speed );
	return $result;
}

/**
* OpenWeatherData_ConvertWindStrength2Text
* 
* @returns variant
* @param integer $InstanceID
* @param integer $bft
*/

function OpenWeatherData_ConvertWindStrength2Text( $InstanceID,$bft ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OpenWeatherData_ConvertWindStrength2Text( $InstanceID,$bft );
	return $result;
}

/**
* OpenWeatherData_GetRawData
* 
* @returns variant
* @param integer $InstanceID
* @param string $name
*/

function OpenWeatherData_GetRawData( $InstanceID,$name ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OpenWeatherData_GetRawData( $InstanceID,$name );
	return $result;
}

/**
* OpenWeatherData_UpdateCurrent
* 
* @returns variant
* @param integer $InstanceID
*/

function OpenWeatherData_UpdateCurrent( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OpenWeatherData_UpdateCurrent( $InstanceID );
	return $result;
}

/**
* OpenWeatherData_UpdateData
* 
* @returns variant
* @param integer $InstanceID
*/

function OpenWeatherData_UpdateData( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OpenWeatherData_UpdateData( $InstanceID );
	return $result;
}

/**
* OpenWeatherData_UpdateHourlyForecast
* 
* @returns variant
* @param integer $InstanceID
*/

function OpenWeatherData_UpdateHourlyForecast( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OpenWeatherData_UpdateHourlyForecast( $InstanceID );
	return $result;
}

/**
* OpenWeatherOneCall_CalcAbsoluteHumidity
* 
* @returns variant
* @param integer $InstanceID
* @param float $temp
* @param float $humidity
*/

function OpenWeatherOneCall_CalcAbsoluteHumidity( $InstanceID,$temp,$humidity ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OpenWeatherOneCall_CalcAbsoluteHumidity( $InstanceID,$temp,$humidity );
	return $result;
}

/**
* OpenWeatherOneCall_CalcAbsolutePressure
* 
* @returns variant
* @param integer $InstanceID
* @param float $pressure
* @param float $temp
* @param float $altitude
*/

function OpenWeatherOneCall_CalcAbsolutePressure( $InstanceID,$pressure,$temp,$altitude ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OpenWeatherOneCall_CalcAbsolutePressure( $InstanceID,$pressure,$temp,$altitude );
	return $result;
}

/**
* OpenWeatherOneCall_CalcHeatindex
* 
* @returns variant
* @param integer $InstanceID
* @param float $temp
* @param float $hum
*/

function OpenWeatherOneCall_CalcHeatindex( $InstanceID,$temp,$hum ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OpenWeatherOneCall_CalcHeatindex( $InstanceID,$temp,$hum );
	return $result;
}

/**
* OpenWeatherOneCall_ConvertWindDirection2Text
* 
* @returns variant
* @param integer $InstanceID
* @param integer $dir
*/

function OpenWeatherOneCall_ConvertWindDirection2Text( $InstanceID,$dir ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OpenWeatherOneCall_ConvertWindDirection2Text( $InstanceID,$dir );
	return $result;
}

/**
* OpenWeatherOneCall_ConvertWindSpeed2Strength
* 
* @returns variant
* @param integer $InstanceID
* @param integer $speed
*/

function OpenWeatherOneCall_ConvertWindSpeed2Strength( $InstanceID,$speed ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OpenWeatherOneCall_ConvertWindSpeed2Strength( $InstanceID,$speed );
	return $result;
}

/**
* OpenWeatherOneCall_ConvertWindStrength2Text
* 
* @returns variant
* @param integer $InstanceID
* @param integer $bft
*/

function OpenWeatherOneCall_ConvertWindStrength2Text( $InstanceID,$bft ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OpenWeatherOneCall_ConvertWindStrength2Text( $InstanceID,$bft );
	return $result;
}

/**
* OpenWeatherOneCall_GetRawData
* 
* @returns variant
* @param integer $InstanceID
*/

function OpenWeatherOneCall_GetRawData( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OpenWeatherOneCall_GetRawData( $InstanceID );
	return $result;
}

/**
* OpenWeatherOneCall_UpdateData
* 
* @returns variant
* @param integer $InstanceID
*/

function OpenWeatherOneCall_UpdateData( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OpenWeatherOneCall_UpdateData( $InstanceID );
	return $result;
}

/**
* OpenWeatherStation_DeleteStation
* 
* @returns variant
* @param integer $InstanceID
* @param string $station_id
*/

function OpenWeatherStation_DeleteStation( $InstanceID,$station_id ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OpenWeatherStation_DeleteStation( $InstanceID,$station_id );
	return $result;
}

/**
* OpenWeatherStation_FetchMeasurements
* 
* @returns variant
* @param integer $InstanceID
* @param integer $from
* @param integer $to
* @param string $type
* @param integer $limit
*/

function OpenWeatherStation_FetchMeasurements( $InstanceID,$from,$to,$type,$limit ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OpenWeatherStation_FetchMeasurements( $InstanceID,$from,$to,$type,$limit );
	return $result;
}

/**
* OpenWeatherStation_ListStations
* 
* @returns variant
* @param integer $InstanceID
*/

function OpenWeatherStation_ListStations( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OpenWeatherStation_ListStations( $InstanceID );
	return $result;
}

/**
* OpenWeatherStation_RegisterStation
* 
* @returns variant
* @param integer $InstanceID
*/

function OpenWeatherStation_RegisterStation( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OpenWeatherStation_RegisterStation( $InstanceID );
	return $result;
}

/**
* OpenWeatherStation_TransmitMeasurements
* 
* @returns variant
* @param integer $InstanceID
*/

function OpenWeatherStation_TransmitMeasurements( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OpenWeatherStation_TransmitMeasurements( $InstanceID );
	return $result;
}

/**
* OpenWeatherStation_UpdateStation
* 
* @returns variant
* @param integer $InstanceID
*/

function OpenWeatherStation_UpdateStation( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->OpenWeatherStation_UpdateStation( $InstanceID );
	return $result;
}

/**
* PC_Enter
* 
* @returns boolean
* @param integer $InstanceID
*/

function PC_Enter( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->PC_Enter( $InstanceID );
	return $result;
}

/**
* PC_Leave
* 
* @returns boolean
* @param integer $InstanceID
*/

function PC_Leave( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->PC_Leave( $InstanceID );
	return $result;
}

/**
* PF_GetALLDevices
* 
* @returns variant
* @param integer $InstanceID
*/

function PF_GetALLDevices( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->PF_GetALLDevices( $InstanceID );
	return $result;
}

/**
* PF_GetConfiguration
* 
* @returns variant
* @param integer $InstanceID
*/

function PF_GetConfiguration( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->PF_GetConfiguration( $InstanceID );
	return $result;
}

/**
* PF_GetCurrentData
* 
* @returns variant
* @param integer $InstanceID
*/

function PF_GetCurrentData( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->PF_GetCurrentData( $InstanceID );
	return $result;
}

/**
* PF_GetHistory
* 
* @returns variant
* @param integer $InstanceID
*/

function PF_GetHistory( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->PF_GetHistory( $InstanceID );
	return $result;
}

/**
* PF_GetHistoryDevice
* 
* @returns variant
* @param integer $InstanceID
*/

function PF_GetHistoryDevice( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->PF_GetHistoryDevice( $InstanceID );
	return $result;
}

/**
* PF_GetHistoryDeviceCSV
* 
* @returns variant
* @param integer $InstanceID
*/

function PF_GetHistoryDeviceCSV( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->PF_GetHistoryDeviceCSV( $InstanceID );
	return $result;
}

/**
* PF_GetHistoryDeviceInterval
* 
* @returns variant
* @param integer $InstanceID
* @param integer $year
* @param integer $month
* @param integer $day
* @param integer $fromhour
*/

function PF_GetHistoryDeviceInterval( $InstanceID,$year,$month,$day,$fromhour ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->PF_GetHistoryDeviceInterval( $InstanceID,$year,$month,$day,$fromhour );
	return $result;
}

/**
* PF_GetHistoryDevices
* 
* @returns variant
* @param integer $InstanceID
*/

function PF_GetHistoryDevices( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->PF_GetHistoryDevices( $InstanceID );
	return $result;
}

/**
* PF_GetHistoryInterval
* 
* @returns variant
* @param integer $InstanceID
* @param integer $year
* @param integer $month
* @param integer $day
* @param integer $fromhour
*/

function PF_GetHistoryInterval( $InstanceID,$year,$month,$day,$fromhour ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->PF_GetHistoryInterval( $InstanceID,$year,$month,$day,$fromhour );
	return $result;
}

/**
* PF_GetPowerHistory
* 
* @returns variant
* @param integer $InstanceID
*/

function PF_GetPowerHistory( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->PF_GetPowerHistory( $InstanceID );
	return $result;
}

/**
* PF_GetPowerHistoryCSV
* 
* @returns variant
* @param integer $InstanceID
*/

function PF_GetPowerHistoryCSV( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->PF_GetPowerHistoryCSV( $InstanceID );
	return $result;
}

/**
* PF_Send
* 
* @returns variant
* @param integer $InstanceID
* @param string $Text
*/

function PF_Send( $InstanceID,$Text ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->PF_Send( $InstanceID,$Text );
	return $result;
}

/**
* PF_SetBidirectional_counter
* 
* @returns variant
* @param integer $InstanceID
* @param boolean $value
*/

function PF_SetBidirectional_counter( $InstanceID,$value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->PF_SetBidirectional_counter( $InstanceID,$value );
	return $result;
}

/**
* PF_SetWebFrontVariable
* 
* @returns variant
* @param integer $InstanceID
* @param string $ident
* @param boolean $value
*/

function PF_SetWebFrontVariable( $InstanceID,$ident,$value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->PF_SetWebFrontVariable( $InstanceID,$ident,$value );
	return $result;
}

/**
* PF_UpdateStatus
* 
* @returns variant
* @param integer $InstanceID
*/

function PF_UpdateStatus( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->PF_UpdateStatus( $InstanceID );
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
* PJ_SetVoltage
* 
* @returns boolean
* @param integer $InstanceID
* @param float $Voltage
*/

function PJ_SetVoltage( $InstanceID,$Voltage ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->PJ_SetVoltage( $InstanceID,$Voltage );
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
* POP3_DeleteMail
* 
* @returns boolean
* @param integer $InstanceID
* @param string $UID
*/

function POP3_DeleteMail( $InstanceID,$UID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->POP3_DeleteMail( $InstanceID,$UID );
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
* POP3_UpdateFormUseSSL
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $UseSSL
*/

function POP3_UpdateFormUseSSL( $InstanceID,$UseSSL ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->POP3_UpdateFormUseSSL( $InstanceID,$UseSSL );
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
* RegVar_SendEvent
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $ReportID
* @param string $Text
*/

function RegVar_SendEvent( $InstanceID,$ReportID,$Text ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->RegVar_SendEvent( $InstanceID,$ReportID,$Text );
	return $result;
}

/**
* RegVar_SendPacket
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Text
* @param string $ClientIP
* @param integer $ClientPort
*/

function RegVar_SendPacket( $InstanceID,$Text,$ClientIP,$ClientPort ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->RegVar_SendPacket( $InstanceID,$Text,$ClientIP,$ClientPort );
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
* RequestAction
* 
* @returns boolean
* @param integer $VariableID
* @param variant $Value
*/

function RequestAction( $VariableID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->RequestAction( $VariableID,$Value );
	return $result;
}

/**
* RequestActionEx
* 
* @returns boolean
* @param integer $VariableID
* @param variant $Value
* @param string $Sender
*/

function RequestActionEx( $VariableID,$Value,$Sender ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->RequestActionEx( $VariableID,$Value,$Sender );
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
* S7_WriteChar
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
*/

function S7_WriteChar( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->S7_WriteChar( $InstanceID,$Value );
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
* S7_WriteShort
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
*/

function S7_WriteShort( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->S7_WriteShort( $InstanceID,$Value );
	return $result;
}

/**
* S7_WriteString
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Value
*/

function S7_WriteString( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->S7_WriteString( $InstanceID,$Value );
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
* SC_DeleteModule
* 
* @returns boolean
* @param integer $InstanceID
* @param string $BundleID
*/

function SC_DeleteModule( $InstanceID,$BundleID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SC_DeleteModule( $InstanceID,$BundleID );
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
* SC_GetLastConfirmedStoreConditions
* 
* @returns integer
* @param integer $InstanceID
*/

function SC_GetLastConfirmedStoreConditions( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SC_GetLastConfirmedStoreConditions( $InstanceID );
	return $result;
}

/**
* SC_GetModuleInfoList
* 
* @returns array
* @param integer $InstanceID
*/

function SC_GetModuleInfoList( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SC_GetModuleInfoList( $InstanceID );
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
* SC_GetSkinRepositoryLocalBranchList
* 
* @returns array
* @param integer $InstanceID
* @param string $Skin
*/

function SC_GetSkinRepositoryLocalBranchList( $InstanceID,$Skin ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SC_GetSkinRepositoryLocalBranchList( $InstanceID,$Skin );
	return $result;
}

/**
* SC_GetSkinRepositoryRemoteBranchList
* 
* @returns array
* @param integer $InstanceID
* @param string $Skin
*/

function SC_GetSkinRepositoryRemoteBranchList( $InstanceID,$Skin ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SC_GetSkinRepositoryRemoteBranchList( $InstanceID,$Skin );
	return $result;
}

/**
* SC_InstallModule
* 
* @returns boolean
* @param integer $InstanceID
* @param string $BundleID
* @param integer $Channel
*   enum[0=scStable, 1=scBeta, 2=scTesting]
* @param integer $ReleaseID
*/

function SC_InstallModule( $InstanceID,$BundleID,$Channel,$ReleaseID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SC_InstallModule( $InstanceID,$BundleID,$Channel,$ReleaseID );
	return $result;
}

/**
* SC_IsSkinClean
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Skin
*/

function SC_IsSkinClean( $InstanceID,$Skin ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SC_IsSkinClean( $InstanceID,$Skin );
	return $result;
}

/**
* SC_IsSkinUpdateAvailable
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Skin
*/

function SC_IsSkinUpdateAvailable( $InstanceID,$Skin ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SC_IsSkinUpdateAvailable( $InstanceID,$Skin );
	return $result;
}

/**
* SC_IsSkinValid
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Skin
*/

function SC_IsSkinValid( $InstanceID,$Skin ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SC_IsSkinValid( $InstanceID,$Skin );
	return $result;
}

/**
* SC_MakeRequest
* 
* @returns string
* @param integer $InstanceID
* @param string $Endpoint
* @param string $Method
* @param string $Body
*/

function SC_MakeRequest( $InstanceID,$Endpoint,$Method,$Body ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SC_MakeRequest( $InstanceID,$Endpoint,$Method,$Body );
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
* SC_RevertSkin
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Skin
*/

function SC_RevertSkin( $InstanceID,$Skin ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SC_RevertSkin( $InstanceID,$Skin );
	return $result;
}

/**
* SC_SetLastConfirmedStoreConditions
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $LastConfirmedStoreConditions
*/

function SC_SetLastConfirmedStoreConditions( $InstanceID,$LastConfirmedStoreConditions ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SC_SetLastConfirmedStoreConditions( $InstanceID,$LastConfirmedStoreConditions );
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
* SC_UpdateSkinRepositoryBranch
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Skin
* @param string $Branch
*/

function SC_UpdateSkinRepositoryBranch( $InstanceID,$Skin,$Branch ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SC_UpdateSkinRepositoryBranch( $InstanceID,$Skin,$Branch );
	return $result;
}

/**
* SMAModbus_ReconnectParentSocket
* 
* @returns variant
* @param integer $InstanceID
* @param variant $force
*/

function SMAModbus_ReconnectParentSocket( $InstanceID,$force ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SMAModbus_ReconnectParentSocket( $InstanceID,$force );
	return $result;
}

/**
* SMAModbus_Update
* 
* @returns variant
* @param integer $InstanceID
*/

function SMAModbus_Update( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SMAModbus_Update( $InstanceID );
	return $result;
}

/**
* SMAModbus_UpdateCurrent
* 
* @returns variant
* @param integer $InstanceID
*/

function SMAModbus_UpdateCurrent( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SMAModbus_UpdateCurrent( $InstanceID );
	return $result;
}

/**
* SMAModbus_UpdateDevice
* 
* @returns variant
* @param integer $InstanceID
* @param variant $applied
*/

function SMAModbus_UpdateDevice( $InstanceID,$applied ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SMAModbus_UpdateDevice( $InstanceID,$applied );
	return $result;
}

/**
* SMAModbus_UpdateValues
* 
* @returns variant
* @param integer $InstanceID
* @param variant $applied
*/

function SMAModbus_UpdateValues( $InstanceID,$applied ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SMAModbus_UpdateValues( $InstanceID,$applied );
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
* @param string $Body
*/

function SMTP_SendMail( $InstanceID,$Subject,$Body ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SMTP_SendMail( $InstanceID,$Subject,$Body );
	return $result;
}

/**
* SMTP_SendMailAttachment
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Subject
* @param string $Body
* @param string $Filename
*/

function SMTP_SendMailAttachment( $InstanceID,$Subject,$Body,$Filename ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SMTP_SendMailAttachment( $InstanceID,$Subject,$Body,$Filename );
	return $result;
}

/**
* SMTP_SendMailAttachmentEx
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Address
* @param string $Subject
* @param string $Body
* @param string $Filename
*/

function SMTP_SendMailAttachmentEx( $InstanceID,$Address,$Subject,$Body,$Filename ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SMTP_SendMailAttachmentEx( $InstanceID,$Address,$Subject,$Body,$Filename );
	return $result;
}

/**
* SMTP_SendMailEx
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Address
* @param string $Subject
* @param string $Body
*/

function SMTP_SendMailEx( $InstanceID,$Address,$Subject,$Body ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SMTP_SendMailEx( $InstanceID,$Address,$Subject,$Body );
	return $result;
}

/**
* SMTP_SendMailMedia
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Subject
* @param string $Body
* @param integer $MediaID
*/

function SMTP_SendMailMedia( $InstanceID,$Subject,$Body,$MediaID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SMTP_SendMailMedia( $InstanceID,$Subject,$Body,$MediaID );
	return $result;
}

/**
* SMTP_SendMailMediaEx
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Address
* @param string $Subject
* @param string $Body
* @param integer $MediaID
*/

function SMTP_SendMailMediaEx( $InstanceID,$Address,$Subject,$Body,$MediaID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SMTP_SendMailMediaEx( $InstanceID,$Address,$Subject,$Body,$MediaID );
	return $result;
}

/**
* SMTP_UpdateFormUseSSL
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $UseSSL
*/

function SMTP_UpdateFormUseSSL( $InstanceID,$UseSSL ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SMTP_UpdateFormUseSSL( $InstanceID,$UseSSL );
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
* SSCK_SendPacket
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Text
* @param string $ClientIP
* @param integer $ClientPort
*/

function SSCK_SendPacket( $InstanceID,$Text,$ClientIP,$ClientPort ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SSCK_SendPacket( $InstanceID,$Text,$ClientIP,$ClientPort );
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
* SSCK_UpdateFormUseSSL
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $UseSSL
*/

function SSCK_UpdateFormUseSSL( $InstanceID,$UseSSL ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SSCK_UpdateFormUseSSL( $InstanceID,$UseSSL );
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
* SWD_SetDuration
* 
* @returns variant
* @param integer $InstanceID
* @param integer $duration
* @param string $action
*/

function SWD_SetDuration( $InstanceID,$duration,$action ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->SWD_SetDuration( $InstanceID,$duration,$action );
	return $result;
}

/**
* SWD_SetIntensity
* 
* @returns variant
* @param integer $InstanceID
* @param integer $percent
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
* @param boolean $val
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
* TC_AddLanguage
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Language
*/

function TC_AddLanguage( $InstanceID,$Language ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TC_AddLanguage( $InstanceID,$Language );
	return $result;
}

/**
* TC_AddTranslation
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Language
* @param string $SourceText
* @param string $TranslatedText
* @param string $Reference
* @param string $Status
*/

function TC_AddTranslation( $InstanceID,$Language,$SourceText,$TranslatedText,$Reference,$Status ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TC_AddTranslation( $InstanceID,$Language,$SourceText,$TranslatedText,$Reference,$Status );
	return $result;
}

/**
* TC_CleanupLanguage
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Language
*/

function TC_CleanupLanguage( $InstanceID,$Language ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TC_CleanupLanguage( $InstanceID,$Language );
	return $result;
}

/**
* TC_GetLanguages
* 
* @returns array
* @param integer $InstanceID
*/

function TC_GetLanguages( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TC_GetLanguages( $InstanceID );
	return $result;
}

/**
* TC_RemoveLanguage
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Language
*/

function TC_RemoveLanguage( $InstanceID,$Language ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TC_RemoveLanguage( $InstanceID,$Language );
	return $result;
}

/**
* TC_RemoveTranslation
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Language
* @param string $SourceText
*/

function TC_RemoveTranslation( $InstanceID,$Language,$SourceText ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TC_RemoveTranslation( $InstanceID,$Language,$SourceText );
	return $result;
}

/**
* TC_TranslateLanguage
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Language
*/

function TC_TranslateLanguage( $InstanceID,$Language ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TC_TranslateLanguage( $InstanceID,$Language );
	return $result;
}

/**
* TC_UpdateLanguage
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Language
*/

function TC_UpdateLanguage( $InstanceID,$Language ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TC_UpdateLanguage( $InstanceID,$Language );
	return $result;
}

/**
* TC_UpdateTranslation
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Language
* @param string $SourceText
* @param string $TranslatedText
* @param string $Reference
* @param string $Status
*/

function TC_UpdateTranslation( $InstanceID,$Language,$SourceText,$TranslatedText,$Reference,$Status ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TC_UpdateTranslation( $InstanceID,$Language,$SourceText,$TranslatedText,$Reference,$Status );
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
* TasmotaConfig_restart
* 
* @returns variant
* @param integer $InstanceID
*/

function TasmotaConfig_restart( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TasmotaConfig_restart( $InstanceID );
	return $result;
}

/**
* TasmotaConfig_sendMQTTCommand
* 
* @returns variant
* @param integer $InstanceID
* @param string $command
* @param string $msg
*/

function TasmotaConfig_sendMQTTCommand( $InstanceID,$command,$msg ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TasmotaConfig_sendMQTTCommand( $InstanceID,$command,$msg );
	return $result;
}

/**
* TasmotaConfig_setPower
* 
* @returns variant
* @param integer $InstanceID
* @param integer $power
* @param boolean $Value
*/

function TasmotaConfig_setPower( $InstanceID,$power,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TasmotaConfig_setPower( $InstanceID,$power,$Value );
	return $result;
}

/**
* TasmotaConfig_setPowerOnState
* 
* @returns variant
* @param integer $InstanceID
* @param integer $value
*/

function TasmotaConfig_setPowerOnState( $InstanceID,$value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TasmotaConfig_setPowerOnState( $InstanceID,$value );
	return $result;
}

/**
* TasmotaFingerprint_countFP
* 
* @returns variant
* @param integer $InstanceID
*/

function TasmotaFingerprint_countFP( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TasmotaFingerprint_countFP( $InstanceID );
	return $result;
}

/**
* TasmotaFingerprint_deleteFP
* 
* @returns variant
* @param integer $InstanceID
* @param integer $value
*/

function TasmotaFingerprint_deleteFP( $InstanceID,$value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TasmotaFingerprint_deleteFP( $InstanceID,$value );
	return $result;
}

/**
* TasmotaFingerprint_enrollFP
* 
* @returns variant
* @param integer $InstanceID
* @param integer $value
*/

function TasmotaFingerprint_enrollFP( $InstanceID,$value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TasmotaFingerprint_enrollFP( $InstanceID,$value );
	return $result;
}

/**
* TasmotaFingerprint_restart
* 
* @returns variant
* @param integer $InstanceID
*/

function TasmotaFingerprint_restart( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TasmotaFingerprint_restart( $InstanceID );
	return $result;
}

/**
* TasmotaFingerprint_sendMQTTCommand
* 
* @returns variant
* @param integer $InstanceID
* @param string $command
* @param string $msg
*/

function TasmotaFingerprint_sendMQTTCommand( $InstanceID,$command,$msg ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TasmotaFingerprint_sendMQTTCommand( $InstanceID,$command,$msg );
	return $result;
}

/**
* TasmotaFingerprint_setPower
* 
* @returns variant
* @param integer $InstanceID
* @param integer $power
* @param boolean $Value
*/

function TasmotaFingerprint_setPower( $InstanceID,$power,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TasmotaFingerprint_setPower( $InstanceID,$power,$Value );
	return $result;
}

/**
* TasmotaFingerprint_setPowerOnState
* 
* @returns variant
* @param integer $InstanceID
* @param integer $value
*/

function TasmotaFingerprint_setPowerOnState( $InstanceID,$value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TasmotaFingerprint_setPowerOnState( $InstanceID,$value );
	return $result;
}

/**
* TasmotaLED_restart
* 
* @returns variant
* @param integer $InstanceID
*/

function TasmotaLED_restart( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TasmotaLED_restart( $InstanceID );
	return $result;
}

/**
* TasmotaLED_sendMQTTCommand
* 
* @returns variant
* @param integer $InstanceID
* @param string $command
* @param string $msg
*/

function TasmotaLED_sendMQTTCommand( $InstanceID,$command,$msg ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TasmotaLED_sendMQTTCommand( $InstanceID,$command,$msg );
	return $result;
}

/**
* TasmotaLED_setCT
* 
* @returns variant
* @param integer $InstanceID
* @param integer $value
*/

function TasmotaLED_setCT( $InstanceID,$value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TasmotaLED_setCT( $InstanceID,$value );
	return $result;
}

/**
* TasmotaLED_setColorHex
* 
* @returns variant
* @param integer $InstanceID
* @param string $color
*/

function TasmotaLED_setColorHex( $InstanceID,$color ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TasmotaLED_setColorHex( $InstanceID,$color );
	return $result;
}

/**
* TasmotaLED_setDimmer
* 
* @returns variant
* @param integer $InstanceID
* @param integer $value
*/

function TasmotaLED_setDimmer( $InstanceID,$value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TasmotaLED_setDimmer( $InstanceID,$value );
	return $result;
}

/**
* TasmotaLED_setFade
* 
* @returns variant
* @param integer $InstanceID
* @param boolean $value
*/

function TasmotaLED_setFade( $InstanceID,$value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TasmotaLED_setFade( $InstanceID,$value );
	return $result;
}

/**
* TasmotaLED_setLED
* 
* @returns variant
* @param integer $InstanceID
* @param integer $LED
* @param string $color
*/

function TasmotaLED_setLED( $InstanceID,$LED,$color ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TasmotaLED_setLED( $InstanceID,$LED,$color );
	return $result;
}

/**
* TasmotaLED_setPixel
* 
* @returns variant
* @param integer $InstanceID
* @param integer $count
*/

function TasmotaLED_setPixel( $InstanceID,$count ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TasmotaLED_setPixel( $InstanceID,$count );
	return $result;
}

/**
* TasmotaLED_setPower
* 
* @returns variant
* @param integer $InstanceID
* @param integer $power
* @param boolean $Value
*/

function TasmotaLED_setPower( $InstanceID,$power,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TasmotaLED_setPower( $InstanceID,$power,$Value );
	return $result;
}

/**
* TasmotaLED_setPowerOnState
* 
* @returns variant
* @param integer $InstanceID
* @param integer $value
*/

function TasmotaLED_setPowerOnState( $InstanceID,$value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TasmotaLED_setPowerOnState( $InstanceID,$value );
	return $result;
}

/**
* TasmotaLED_setScheme
* 
* @returns variant
* @param integer $InstanceID
* @param integer $schemeID
*/

function TasmotaLED_setScheme( $InstanceID,$schemeID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TasmotaLED_setScheme( $InstanceID,$schemeID );
	return $result;
}

/**
* TasmotaLED_setSpeed
* 
* @returns variant
* @param integer $InstanceID
* @param integer $value
*/

function TasmotaLED_setSpeed( $InstanceID,$value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TasmotaLED_setSpeed( $InstanceID,$value );
	return $result;
}

/**
* TasmotaLED_setWhite
* 
* @returns variant
* @param integer $InstanceID
* @param integer $value
*/

function TasmotaLED_setWhite( $InstanceID,$value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TasmotaLED_setWhite( $InstanceID,$value );
	return $result;
}

/**
* TasmotaSwitchTopic_restart
* 
* @returns variant
* @param integer $InstanceID
*/

function TasmotaSwitchTopic_restart( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TasmotaSwitchTopic_restart( $InstanceID );
	return $result;
}

/**
* TasmotaSwitchTopic_sendMQTTCommand
* 
* @returns variant
* @param integer $InstanceID
* @param string $command
* @param string $msg
*/

function TasmotaSwitchTopic_sendMQTTCommand( $InstanceID,$command,$msg ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TasmotaSwitchTopic_sendMQTTCommand( $InstanceID,$command,$msg );
	return $result;
}

/**
* TasmotaSwitchTopic_setPower
* 
* @returns variant
* @param integer $InstanceID
* @param integer $power
* @param boolean $Value
*/

function TasmotaSwitchTopic_setPower( $InstanceID,$power,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TasmotaSwitchTopic_setPower( $InstanceID,$power,$Value );
	return $result;
}

/**
* TasmotaSwitchTopic_setPowerOnState
* 
* @returns variant
* @param integer $InstanceID
* @param integer $value
*/

function TasmotaSwitchTopic_setPowerOnState( $InstanceID,$value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->TasmotaSwitchTopic_setPowerOnState( $InstanceID,$value );
	return $result;
}

/**
* Tasmota_restart
* 
* @returns variant
* @param integer $InstanceID
*/

function Tasmota_restart( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->Tasmota_restart( $InstanceID );
	return $result;
}

/**
* Tasmota_sendMQTTCommand
* 
* @returns variant
* @param integer $InstanceID
* @param string $command
* @param string $msg
*/

function Tasmota_sendMQTTCommand( $InstanceID,$command,$msg ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->Tasmota_sendMQTTCommand( $InstanceID,$command,$msg );
	return $result;
}

/**
* Tasmota_setFanSpeed
* 
* @returns variant
* @param integer $InstanceID
* @param integer $value
*/

function Tasmota_setFanSpeed( $InstanceID,$value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->Tasmota_setFanSpeed( $InstanceID,$value );
	return $result;
}

/**
* Tasmota_setMaxPower
* 
* @returns variant
* @param integer $InstanceID
* @param integer $value
*/

function Tasmota_setMaxPower( $InstanceID,$value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->Tasmota_setMaxPower( $InstanceID,$value );
	return $result;
}

/**
* Tasmota_setMaxPowerHold
* 
* @returns variant
* @param integer $InstanceID
* @param integer $value
*/

function Tasmota_setMaxPowerHold( $InstanceID,$value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->Tasmota_setMaxPowerHold( $InstanceID,$value );
	return $result;
}

/**
* Tasmota_setMaxPowerWindow
* 
* @returns variant
* @param integer $InstanceID
* @param integer $value
*/

function Tasmota_setMaxPowerWindow( $InstanceID,$value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->Tasmota_setMaxPowerWindow( $InstanceID,$value );
	return $result;
}

/**
* Tasmota_setPower
* 
* @returns variant
* @param integer $InstanceID
* @param integer $power
* @param boolean $Value
*/

function Tasmota_setPower( $InstanceID,$power,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->Tasmota_setPower( $InstanceID,$power,$Value );
	return $result;
}

/**
* Tasmota_setPowerOnState
* 
* @returns variant
* @param integer $InstanceID
* @param integer $value
*/

function Tasmota_setPowerOnState( $InstanceID,$value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->Tasmota_setPowerOnState( $InstanceID,$value );
	return $result;
}

/**
* UC_DeleteObjects
* 
* @returns boolean
* @param integer $InstanceID
* @param array $IDs
*/

function UC_DeleteObjects( $InstanceID,$IDs ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->UC_DeleteObjects( $InstanceID,$IDs );
	return $result;
}

/**
* UC_DuplicateObject
* 
* @returns integer
* @param integer $InstanceID
* @param integer $ID
* @param integer $ParentID
* @param boolean $Recursive
*/

function UC_DuplicateObject( $InstanceID,$ID,$ParentID,$Recursive ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->UC_DuplicateObject( $InstanceID,$ID,$ParentID,$Recursive );
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
* UC_FindInvalidStrings
* 
* @returns array
* @param integer $InstanceID
*/

function UC_FindInvalidStrings( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->UC_FindInvalidStrings( $InstanceID );
	return $result;
}

/**
* UC_FindReferences
* 
* @returns array
* @param integer $InstanceID
* @param integer $ID
*/

function UC_FindReferences( $InstanceID,$ID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->UC_FindReferences( $InstanceID,$ID );
	return $result;
}

/**
* UC_FindShortTags
* 
* @returns array
* @param integer $InstanceID
*/

function UC_FindShortTags( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->UC_FindShortTags( $InstanceID );
	return $result;
}

/**
* UC_FixInvalidStrings
* 
* @returns boolean
* @param integer $InstanceID
* @param array $References
*/

function UC_FixInvalidStrings( $InstanceID,$References ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->UC_FixInvalidStrings( $InstanceID,$References );
	return $result;
}

/**
* UC_FixShortTags
* 
* @returns boolean
* @param integer $InstanceID
* @param array $References
*/

function UC_FixShortTags( $InstanceID,$References ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->UC_FixShortTags( $InstanceID,$References );
	return $result;
}

/**
* UC_GetEventStatistics
* 
* @returns array
* @param integer $InstanceID
*/

function UC_GetEventStatistics( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->UC_GetEventStatistics( $InstanceID );
	return $result;
}

/**
* UC_GetIconContent
* 
* @returns string
* @param integer $InstanceID
* @param string $Icon
*/

function UC_GetIconContent( $InstanceID,$Icon ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->UC_GetIconContent( $InstanceID,$Icon );
	return $result;
}

/**
* UC_GetIconList
* 
* @returns array
* @param integer $InstanceID
*/

function UC_GetIconList( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->UC_GetIconList( $InstanceID );
	return $result;
}

/**
* UC_GetKernelStatistics
* 
* @returns array
* @param integer $InstanceID
*/

function UC_GetKernelStatistics( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->UC_GetKernelStatistics( $InstanceID );
	return $result;
}

/**
* UC_GetLastLogMessages
* 
* @returns array
* @param integer $InstanceID
* @param integer $Type
*   enum[0=lmtDefault, 1=lmtSuccess, 2=lmtNotify, 3=lmtWarning, 4=lmtError, 5=lmtDebug, 6=lmtCustom]
*/

function UC_GetLastLogMessages( $InstanceID,$Type ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->UC_GetLastLogMessages( $InstanceID,$Type );
	return $result;
}

/**
* UC_GetLogMessageStatistics
* 
* @returns array
* @param integer $InstanceID
*/

function UC_GetLogMessageStatistics( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->UC_GetLogMessageStatistics( $InstanceID );
	return $result;
}

/**
* UC_GetMessageSenderIDList
* 
* @returns array
* @param integer $InstanceID
*/

function UC_GetMessageSenderIDList( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->UC_GetMessageSenderIDList( $InstanceID );
	return $result;
}

/**
* UC_GetMessageSenderIDSizeList
* 
* @returns array
* @param integer $InstanceID
*/

function UC_GetMessageSenderIDSizeList( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->UC_GetMessageSenderIDSizeList( $InstanceID );
	return $result;
}

/**
* UC_GetMessageTypeList
* 
* @returns array
* @param integer $InstanceID
*/

function UC_GetMessageTypeList( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->UC_GetMessageTypeList( $InstanceID );
	return $result;
}

/**
* UC_GetScriptSenderList
* 
* @returns array
* @param integer $InstanceID
*/

function UC_GetScriptSenderList( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->UC_GetScriptSenderList( $InstanceID );
	return $result;
}

/**
* UC_MigrateWorkflow
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $ScriptID
*/

function UC_MigrateWorkflow( $InstanceID,$ScriptID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->UC_MigrateWorkflow( $InstanceID,$ScriptID );
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
* UC_ResetLastLogMessages
* 
* @returns boolean
* @param integer $InstanceID
*/

function UC_ResetLastLogMessages( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->UC_ResetLastLogMessages( $InstanceID );
	return $result;
}

/**
* UC_ResetLogMessageStatistics
* 
* @returns boolean
* @param integer $InstanceID
*/

function UC_ResetLogMessageStatistics( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->UC_ResetLogMessageStatistics( $InstanceID );
	return $result;
}

/**
* UC_SendUsageData
* 
* @returns boolean
* @param integer $InstanceID
*/

function UC_SendUsageData( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->UC_SendUsageData( $InstanceID );
	return $result;
}

/**
* UC_UpdateLicenseData
* 
* @returns boolean
* @param integer $InstanceID
*/

function UC_UpdateLicenseData( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->UC_UpdateLicenseData( $InstanceID );
	return $result;
}

/**
* USCK_SendPacket
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Text
* @param string $ClientIP
* @param integer $ClientPort
*/

function USCK_SendPacket( $InstanceID,$Text,$ClientIP,$ClientPort ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->USCK_SendPacket( $InstanceID,$Text,$ClientIP,$ClientPort );
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
* VIO_Connect
* 
* @returns boolean
* @param integer $InstanceID
* @param string $ClientIP
* @param integer $ClientPort
*/

function VIO_Connect( $InstanceID,$ClientIP,$ClientPort ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VIO_Connect( $InstanceID,$ClientIP,$ClientPort );
	return $result;
}

/**
* VIO_Disconnect
* 
* @returns boolean
* @param integer $InstanceID
* @param string $ClientIP
* @param integer $ClientPort
*/

function VIO_Disconnect( $InstanceID,$ClientIP,$ClientPort ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VIO_Disconnect( $InstanceID,$ClientIP,$ClientPort );
	return $result;
}

/**
* VIO_GetPacketList
* 
* @returns array
* @param integer $InstanceID
*/

function VIO_GetPacketList( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VIO_GetPacketList( $InstanceID );
	return $result;
}

/**
* VIO_GetTextList
* 
* @returns array
* @param integer $InstanceID
*/

function VIO_GetTextList( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VIO_GetTextList( $InstanceID );
	return $result;
}

/**
* VIO_HTTPResponse
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Route
* @param string $Method
* @param string $Data
*/

function VIO_HTTPResponse( $InstanceID,$Route,$Method,$Data ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VIO_HTTPResponse( $InstanceID,$Route,$Method,$Data );
	return $result;
}

/**
* VIO_PushData
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Event
* @param string $Data
* @param string $Retry
* @param string $ID
*/

function VIO_PushData( $InstanceID,$Event,$Data,$Retry,$ID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VIO_PushData( $InstanceID,$Event,$Data,$Retry,$ID );
	return $result;
}

/**
* VIO_PushPacket
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Text
* @param string $ClientIP
* @param integer $ClientPort
*/

function VIO_PushPacket( $InstanceID,$Text,$ClientIP,$ClientPort ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VIO_PushPacket( $InstanceID,$Text,$ClientIP,$ClientPort );
	return $result;
}

/**
* VIO_PushPacketHEX
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Text
* @param string $ClientIP
* @param integer $ClientPort
*/

function VIO_PushPacketHEX( $InstanceID,$Text,$ClientIP,$ClientPort ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VIO_PushPacketHEX( $InstanceID,$Text,$ClientIP,$ClientPort );
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
* VIO_SendPacket
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Text
* @param string $ClientIP
* @param integer $ClientPort
*/

function VIO_SendPacket( $InstanceID,$Text,$ClientIP,$ClientPort ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VIO_SendPacket( $InstanceID,$Text,$ClientIP,$ClientPort );
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
* VISU_CandidateMediaStream
* 
* @returns boolean
* @param integer $InstanceID
* @param string $SessionID
* @param string $ICE
*/

function VISU_CandidateMediaStream( $InstanceID,$SessionID,$ICE ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VISU_CandidateMediaStream( $InstanceID,$SessionID,$ICE );
	return $result;
}

/**
* VISU_ChangeVisibleGreetingFields
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Value
*/

function VISU_ChangeVisibleGreetingFields( $InstanceID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VISU_ChangeVisibleGreetingFields( $InstanceID,$Value );
	return $result;
}

/**
* VISU_ConfigureMediaStream
* 
* @returns boolean
* @param integer $InstanceID
* @param string $SessionID
* @param string $SessionDescription
*/

function VISU_ConfigureMediaStream( $InstanceID,$SessionID,$SessionDescription ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VISU_ConfigureMediaStream( $InstanceID,$SessionID,$SessionDescription );
	return $result;
}

/**
* VISU_ConnectMediaStream
* 
* @returns string
* @param integer $InstanceID
* @param integer $MediaID
*/

function VISU_ConnectMediaStream( $InstanceID,$MediaID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VISU_ConnectMediaStream( $InstanceID,$MediaID );
	return $result;
}

/**
* VISU_DeleteNotification
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $NotificationID
*/

function VISU_DeleteNotification( $InstanceID,$NotificationID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VISU_DeleteNotification( $InstanceID,$NotificationID );
	return $result;
}

/**
* VISU_DeleteNotifications
* 
* @returns boolean
* @param integer $InstanceID
*/

function VISU_DeleteNotifications( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VISU_DeleteNotifications( $InstanceID );
	return $result;
}

/**
* VISU_DisconnectMediaStream
* 
* @returns boolean
* @param integer $InstanceID
* @param string $SessionID
*/

function VISU_DisconnectMediaStream( $InstanceID,$SessionID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VISU_DisconnectMediaStream( $InstanceID,$SessionID );
	return $result;
}

/**
* VISU_Execute
* 
* @returns string
* @param integer $InstanceID
* @param integer $ActionID
* @param integer $TargetID
* @param variant $Value
*/

function VISU_Execute( $InstanceID,$ActionID,$TargetID,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VISU_Execute( $InstanceID,$ActionID,$TargetID,$Value );
	return $result;
}

/**
* VISU_FetchChartData
* 
* @returns array
* @param integer $InstanceID
* @param integer $ObjectID
* @param integer $StartTime
* @param integer $TimeSpan
*   enum[0=tsHour, 1=tsDay, 2=tsWeek, 3=tsMonth, 4=tsYear, 5=tsDecade]
* @param integer $Density
*   enum[0=gdNormal, 1=gdHD, 2=gdRaw]
*/

function VISU_FetchChartData( $InstanceID,$ObjectID,$StartTime,$TimeSpan,$Density ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VISU_FetchChartData( $InstanceID,$ObjectID,$StartTime,$TimeSpan,$Density );
	return $result;
}

/**
* VISU_FetchChartDataEx
* 
* @returns array
* @param integer $InstanceID
* @param integer $ObjectID
* @param integer $StartTime
* @param integer $TimeSpan
*   enum[0=tsHour, 1=tsDay, 2=tsWeek, 3=tsMonth, 4=tsYear, 5=tsDecade]
* @param integer $Density
*   enum[0=gdNormal, 1=gdHD, 2=gdRaw]
* @param array $Visibility
*/

function VISU_FetchChartDataEx( $InstanceID,$ObjectID,$StartTime,$TimeSpan,$Density,$Visibility ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VISU_FetchChartDataEx( $InstanceID,$ObjectID,$StartTime,$TimeSpan,$Density,$Visibility );
	return $result;
}

/**
* VISU_GetAggregatedValues
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

function VISU_GetAggregatedValues( $InstanceID,$VariableID,$AggregationSpan,$StartTime,$EndTime,$Limit ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VISU_GetAggregatedValues( $InstanceID,$VariableID,$AggregationSpan,$StartTime,$EndTime,$Limit );
	return $result;
}

/**
* VISU_GetLoggedValues
* 
* @returns array
* @param integer $InstanceID
* @param integer $VariableID
* @param integer $StartTime
* @param integer $EndTime
* @param integer $Limit
*/

function VISU_GetLoggedValues( $InstanceID,$VariableID,$StartTime,$EndTime,$Limit ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VISU_GetLoggedValues( $InstanceID,$VariableID,$StartTime,$EndTime,$Limit );
	return $result;
}

/**
* VISU_GetMail
* 
* @returns array
* @param integer $InstanceID
* @param integer $VariableID
* @param string $UID
*/

function VISU_GetMail( $InstanceID,$VariableID,$UID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VISU_GetMail( $InstanceID,$VariableID,$UID );
	return $result;
}

/**
* VISU_GetMailList
* 
* @returns array
* @param integer $InstanceID
* @param integer $VariableID
*/

function VISU_GetMailList( $InstanceID,$VariableID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VISU_GetMailList( $InstanceID,$VariableID);
	return $result;
}

/**
* VISU_GetMediaContent
* 
* @returns string
* @param integer $InstanceID
* @param integer $MediaID
*/

function VISU_GetMediaContent( $InstanceID,$MediaID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VISU_GetMediaContent( $InstanceID,$MediaID );
	return $result;
}

/**
* VISU_GetNotifications
* 
* @returns array
* @param integer $InstanceID
*/

function VISU_GetNotifications( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VISU_GetNotifications( $InstanceID );
	return $result;
}

/**
* VISU_GetSnapshot
* 
* @returns array
* @param integer $InstanceID
*/

function VISU_GetSnapshot( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VISU_GetSnapshot( $InstanceID );
	return $result;
}

/**
* VISU_PostNotification
* 
* @returns integer
* @param integer $InstanceID
* @param string $Title
* @param string $Text
* @param string $Type
* @param integer $TargetID
*/

function VISU_PostNotification( $InstanceID,$Title,$Text,$Type,$TargetID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VISU_PostNotification( $InstanceID,$Title,$Text,$Type,$TargetID );
	return $result;
}

/**
* VISU_PostNotificationEx
* 
* @returns integer
* @param integer $InstanceID
* @param string $Title
* @param string $Text
* @param string $Icon
* @param string $Sound
* @param integer $TargetID
*/

function VISU_PostNotificationEx( $InstanceID,$Title,$Text,$Icon,$Sound,$TargetID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VISU_PostNotificationEx( $InstanceID,$Title,$Text,$Icon,$Sound,$TargetID );
	return $result;
}

/**
* VISU_ReadNotification
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $NotificationID
*/

function VISU_ReadNotification( $InstanceID,$NotificationID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VISU_ReadNotification( $InstanceID,$NotificationID );
	return $result;
}

/**
* VISU_ReadNotifications
* 
* @returns boolean
* @param integer $InstanceID
*/

function VISU_ReadNotifications( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VISU_ReadNotifications( $InstanceID );
	return $result;
}

/**
* VISU_RegisterPNS
* 
* @returns string
* @param integer $InstanceID
* @param string $Token
* @param string $Provider
* @param string $DeviceID
* @param string $DeviceName
*/

function VISU_RegisterPNS( $InstanceID,$Token,$Provider,$DeviceID,$DeviceName ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VISU_RegisterPNS( $InstanceID,$Token,$Provider,$DeviceID,$DeviceName );
	return $result;
}

/**
* VISU_Reload
* 
* @returns boolean
* @param integer $InstanceID
*/

function VISU_Reload( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VISU_Reload( $InstanceID );
	return $result;
}

/**
* VISU_RenderChart
* 
* @returns string
* @param integer $InstanceID
* @param integer $ObjectID
* @param integer $StartTime
* @param integer $TimeSpan
*   enum[0=tsHour, 1=tsDay, 2=tsWeek, 3=tsMonth, 4=tsYear, 5=tsDecade]
* @param integer $Density
*   enum[0=gdNormal, 1=gdHD, 2=gdRaw]
* @param boolean $IsExtrema
* @param boolean $IsDyn
* @param integer $Width
* @param integer $Height
*/

function VISU_RenderChart( $InstanceID,$ObjectID,$StartTime,$TimeSpan,$Density,$IsExtrema,$IsDyn,$Width,$Height ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VISU_RenderChart( $InstanceID,$ObjectID,$StartTime,$TimeSpan,$Density,$IsExtrema,$IsDyn,$Width,$Height );
	return $result;
}

/**
* VISU_RenderChartEx
* 
* @returns string
* @param integer $InstanceID
* @param integer $ObjectID
* @param integer $StartTime
* @param integer $TimeSpan
*   enum[0=tsHour, 1=tsDay, 2=tsWeek, 3=tsMonth, 4=tsYear, 5=tsDecade]
* @param integer $Density
*   enum[0=gdNormal, 1=gdHD, 2=gdRaw]
* @param boolean $IsExtrema
* @param boolean $IsDyn
* @param integer $Width
* @param integer $Height
* @param array $Visibility
*/

function VISU_RenderChartEx( $InstanceID,$ObjectID,$StartTime,$TimeSpan,$Density,$IsExtrema,$IsDyn,$Width,$Height,$Visibility ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VISU_RenderChartEx( $InstanceID,$ObjectID,$StartTime,$TimeSpan,$Density,$IsExtrema,$IsDyn,$Width,$Height,$Visibility );
	return $result;
}

/**
* VISU_RunScriptWait
* 
* @returns string
* @param integer $InstanceID
* @param integer $ScriptID
*/

function VISU_RunScriptWait( $InstanceID,$ScriptID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VISU_RunScriptWait( $InstanceID,$ScriptID );
	return $result;
}

/**
* VISU_SaveGridConfiguration
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Configuration
*/

function VISU_SaveGridConfiguration( $InstanceID,$Configuration ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VISU_SaveGridConfiguration( $InstanceID,$Configuration );
	return $result;
}

/**
* VISU_SetEvent
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $EventID
* @param string $EventChanges
*/

function VISU_SetEvent( $InstanceID,$EventID,$EventChanges ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VISU_SetEvent( $InstanceID,$EventID,$EventChanges );
	return $result;
}

/**
* VISU_UpdateFormGraphDefaults
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $GraphRawDensity
*/

function VISU_UpdateFormGraphDefaults( $InstanceID,$GraphRawDensity ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VISU_UpdateFormGraphDefaults( $InstanceID,$GraphRawDensity );
	return $result;
}

/**
* VISU_UpdateFormNotificationValues
* 
* @returns boolean
* @param integer $InstanceID
*/

function VISU_UpdateFormNotificationValues( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VISU_UpdateFormNotificationValues( $InstanceID );
	return $result;
}

/**
* VISU_UpdateFormSecurityWarning
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $AllowPasswordlessOnWAN
*/

function VISU_UpdateFormSecurityWarning( $InstanceID,$AllowPasswordlessOnWAN ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VISU_UpdateFormSecurityWarning( $InstanceID,$AllowPasswordlessOnWAN );
	return $result;
}

/**
* VS_UpdateSource
* 
* @returns boolean
* @param integer $InstanceID
* @param string $ContentSource
*/

function VS_UpdateSource( $InstanceID,$ContentSource ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VS_UpdateSource( $InstanceID,$ContentSource );
	return $result;
}

/**
* VoIP_AcceptCall
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $ConnectionID
*/

function VoIP_AcceptCall( $InstanceID,$ConnectionID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VoIP_AcceptCall( $InstanceID,$ConnectionID );
	return $result;
}

/**
* VoIP_Connect
* 
* @returns integer
* @param integer $InstanceID
* @param string $Number
*/

function VoIP_Connect( $InstanceID,$Number ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VoIP_Connect( $InstanceID,$Number );
	return $result;
}

/**
* VoIP_Disconnect
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $ConnectionID
*/

function VoIP_Disconnect( $InstanceID,$ConnectionID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VoIP_Disconnect( $InstanceID,$ConnectionID );
	return $result;
}

/**
* VoIP_GetConnection
* 
* @returns array
* @param integer $InstanceID
* @param integer $ConnectionID
*/

function VoIP_GetConnection( $InstanceID,$ConnectionID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VoIP_GetConnection( $InstanceID,$ConnectionID );
	return $result;
}

/**
* VoIP_GetData
* 
* @returns string
* @param integer $InstanceID
* @param integer $ConnectionID
*/

function VoIP_GetData( $InstanceID,$ConnectionID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VoIP_GetData( $InstanceID,$ConnectionID );
	return $result;
}

/**
* VoIP_PlayWave
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $ConnectionID
* @param string $Filename
*/

function VoIP_PlayWave( $InstanceID,$ConnectionID,$Filename ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VoIP_PlayWave( $InstanceID,$ConnectionID,$Filename );
	return $result;
}

/**
* VoIP_RejectCall
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $ConnectionID
*/

function VoIP_RejectCall( $InstanceID,$ConnectionID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VoIP_RejectCall( $InstanceID,$ConnectionID );
	return $result;
}

/**
* VoIP_SendDTMF
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $ConnectionID
* @param string $Digit
*/

function VoIP_SendDTMF( $InstanceID,$ConnectionID,$Digit ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VoIP_SendDTMF( $InstanceID,$ConnectionID,$Digit );
	return $result;
}

/**
* VoIP_SetData
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $ConnectionID
* @param string $Data
*/

function VoIP_SetData( $InstanceID,$ConnectionID,$Data ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->VoIP_SetData( $InstanceID,$ConnectionID,$Data );
	return $result;
}

/**
* WC_PushMessage
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Hook
* @param string $Data
*/

function WC_PushMessage( $InstanceID,$Hook,$Data ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WC_PushMessage( $InstanceID,$Hook,$Data );
	return $result;
}

/**
* WC_PushMessageBinary
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Hook
* @param string $Data
*/

function WC_PushMessageBinary( $InstanceID,$Hook,$Data ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WC_PushMessageBinary( $InstanceID,$Hook,$Data );
	return $result;
}

/**
* WC_PushMessageBinaryEx
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Hook
* @param string $Data
* @param string $RemoteIP
* @param integer $RemotePort
*/

function WC_PushMessageBinaryEx( $InstanceID,$Hook,$Data,$RemoteIP,$RemotePort ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WC_PushMessageBinaryEx( $InstanceID,$Hook,$Data,$RemoteIP,$RemotePort );
	return $result;
}

/**
* WC_PushMessageEx
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Hook
* @param string $Data
* @param string $RemoteIP
* @param integer $RemotePort
*/

function WC_PushMessageEx( $InstanceID,$Hook,$Data,$RemoteIP,$RemotePort ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WC_PushMessageEx( $InstanceID,$Hook,$Data,$RemoteIP,$RemotePort );
	return $result;
}

/**
* WC_PushMessageText
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Hook
* @param string $Data
*/

function WC_PushMessageText( $InstanceID,$Hook,$Data ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WC_PushMessageText( $InstanceID,$Hook,$Data );
	return $result;
}

/**
* WC_PushMessageTextEx
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Hook
* @param string $Data
* @param string $RemoteIP
* @param integer $RemotePort
*/

function WC_PushMessageTextEx( $InstanceID,$Hook,$Data,$RemoteIP,$RemotePort ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WC_PushMessageTextEx( $InstanceID,$Hook,$Data,$RemoteIP,$RemotePort );
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
* @param string $inbuf
*/

function WDE1_ReadRecord( $InstanceID,$inbuf ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WDE1_ReadRecord( $InstanceID,$inbuf );
	return $result;
}

/**
* WDE1_SetRainPerCount
* 
* @returns variant
* @param integer $InstanceID
* @param integer $rainpercount
*/

function WDE1_SetRainPerCount( $InstanceID,$rainpercount ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WDE1_SetRainPerCount( $InstanceID,$rainpercount );
	return $result;
}

/**
* WEB_UpdateFormEnableSSL
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $EnableSSL
*/

function WEB_UpdateFormEnableSSL( $InstanceID,$EnableSSL ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WEB_UpdateFormEnableSSL( $InstanceID,$EnableSSL );
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
* WFC_CandidateMediaStream
* 
* @returns boolean
* @param integer $InstanceID
* @param string $SessionID
* @param string $ICE
*/

function WFC_CandidateMediaStream( $InstanceID,$SessionID,$ICE ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_CandidateMediaStream( $InstanceID,$SessionID,$ICE );
	return $result;
}

/**
* WFC_ConfigureMediaStream
* 
* @returns boolean
* @param integer $InstanceID
* @param string $SessionID
* @param string $SessionDescription
*/

function WFC_ConfigureMediaStream( $InstanceID,$SessionID,$SessionDescription ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_ConfigureMediaStream( $InstanceID,$SessionID,$SessionDescription );
	return $result;
}

/**
* WFC_ConnectMediaStream
* 
* @returns string
* @param integer $InstanceID
* @param integer $MediaID
*/

function WFC_ConnectMediaStream( $InstanceID,$MediaID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_ConnectMediaStream( $InstanceID,$MediaID );
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
* WFC_DisconnectMediaStream
* 
* @returns boolean
* @param integer $InstanceID
* @param string $SessionID
*/

function WFC_DisconnectMediaStream( $InstanceID,$SessionID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_DisconnectMediaStream( $InstanceID,$SessionID );
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
* WFC_FetchChartData
* 
* @returns array
* @param integer $InstanceID
* @param integer $ObjectID
* @param integer $StartTime
* @param integer $TimeSpan
*   enum[0=tsHour, 1=tsDay, 2=tsWeek, 3=tsMonth, 4=tsYear, 5=tsDecade]
* @param integer $Density
*   enum[0=gdNormal, 1=gdHD, 2=gdRaw]
*/

function WFC_FetchChartData( $InstanceID,$ObjectID,$StartTime,$TimeSpan,$Density ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_FetchChartData( $InstanceID,$ObjectID,$StartTime,$TimeSpan,$Density );
	return $result;
}

/**
* WFC_FetchChartDataEx
* 
* @returns array
* @param integer $InstanceID
* @param integer $ObjectID
* @param integer $StartTime
* @param integer $TimeSpan
*   enum[0=tsHour, 1=tsDay, 2=tsWeek, 3=tsMonth, 4=tsYear, 5=tsDecade]
* @param integer $Density
*   enum[0=gdNormal, 1=gdHD, 2=gdRaw]
* @param array $Visibility
*/

function WFC_FetchChartDataEx( $InstanceID,$ObjectID,$StartTime,$TimeSpan,$Density,$Visibility ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_FetchChartDataEx( $InstanceID,$ObjectID,$StartTime,$TimeSpan,$Density,$Visibility );
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
* @returns array
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
* @returns array
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
* @returns array
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
* @returns array
* @param integer $InstanceID
* @param integer $CategoryID
*/

function WFC_GetSnapshotEx( $InstanceID,$CategoryID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_GetSnapshotEx( $InstanceID,$CategoryID );
	return $result;
}

/**
* WFC_OpenCategory
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $CategoryID
*/

function WFC_OpenCategory( $InstanceID,$CategoryID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_OpenCategory( $InstanceID,$CategoryID );
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
* @param integer $Density
*   enum[0=gdNormal, 1=gdHD, 2=gdRaw]
* @param boolean $IsExtrema
* @param boolean $IsDyn
* @param integer $Width
* @param integer $Height
*/

function WFC_RenderChart( $InstanceID,$ObjectID,$StartTime,$TimeSpan,$Density,$IsExtrema,$IsDyn,$Width,$Height ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_RenderChart( $InstanceID,$ObjectID,$StartTime,$TimeSpan,$Density,$IsExtrema,$IsDyn,$Width,$Height );
	return $result;
}

/**
* WFC_RenderChartEx
* 
* @returns string
* @param integer $InstanceID
* @param integer $ObjectID
* @param integer $StartTime
* @param integer $TimeSpan
*   enum[0=tsHour, 1=tsDay, 2=tsWeek, 3=tsMonth, 4=tsYear, 5=tsDecade]
* @param integer $Density
*   enum[0=gdNormal, 1=gdHD, 2=gdRaw]
* @param boolean $IsExtrema
* @param boolean $IsDyn
* @param integer $Width
* @param integer $Height
* @param array $Visibility
*/

function WFC_RenderChartEx( $InstanceID,$ObjectID,$StartTime,$TimeSpan,$Density,$IsExtrema,$IsDyn,$Width,$Height,$Visibility ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_RenderChartEx( $InstanceID,$ObjectID,$StartTime,$TimeSpan,$Density,$IsExtrema,$IsDyn,$Width,$Height,$Visibility );
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
* WFC_UpdateFormGraphDefaults
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $GraphRawDensity
*/

function WFC_UpdateFormGraphDefaults( $InstanceID,$GraphRawDensity ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_UpdateFormGraphDefaults( $InstanceID,$GraphRawDensity );
	return $result;
}

/**
* WFC_UpdateFormNotificationValues
* 
* @returns boolean
* @param integer $InstanceID
*/

function WFC_UpdateFormNotificationValues( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_UpdateFormNotificationValues( $InstanceID );
	return $result;
}

/**
* WFC_UpdateFormSecurityWarning
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $AllowPasswordlessOnWAN
*/

function WFC_UpdateFormSecurityWarning( $InstanceID,$AllowPasswordlessOnWAN ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WFC_UpdateFormSecurityWarning( $InstanceID,$AllowPasswordlessOnWAN );
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
* WS300PC_SetHistoryCount
* 
* @returns variant
* @param integer $InstanceID
* @param integer $val
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
* WSC_SendMessage
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Message
*/

function WSC_SendMessage( $InstanceID,$Message ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->WSC_SendMessage( $InstanceID,$Message );
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
* WUE_SetRainPerCount
* 
* @returns variant
* @param integer $InstanceID
* @param integer $rainpercount
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
* XC_Configure
* 
* @returns boolean
* @param integer $InstanceID
* @param string $Configuration
*/

function XC_Configure( $InstanceID,$Configuration ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->XC_Configure( $InstanceID,$Configuration );
	return $result;
}

/**
* XC_Update
* 
* @returns boolean
* @param integer $InstanceID
*/

function XC_Update( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->XC_Update( $InstanceID );
	return $result;
}

/**
* YC_SearchDevices
* 
* @returns array
* @param integer $InstanceID
* @param string $SearchTarget
*/

function YC_SearchDevices( $InstanceID,$SearchTarget ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->YC_SearchDevices( $InstanceID,$SearchTarget );
	return $result;
}

/**
* ZC_QueryService
* 
* @returns array
* @param integer $InstanceID
* @param string $Name
* @param string $Type
* @param string $Domain
*/

function ZC_QueryService( $InstanceID,$Name,$Type,$Domain ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZC_QueryService( $InstanceID,$Name,$Type,$Domain );
	return $result;
}

/**
* ZC_QueryServiceEx
* 
* @returns array
* @param integer $InstanceID
* @param string $Name
* @param string $Type
* @param string $Domain
* @param integer $Timeout
*/

function ZC_QueryServiceEx( $InstanceID,$Name,$Type,$Domain,$Timeout ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZC_QueryServiceEx( $InstanceID,$Name,$Type,$Domain,$Timeout );
	return $result;
}

/**
* ZC_QueryServiceType
* 
* @returns array
* @param integer $InstanceID
* @param string $Type
* @param string $Domain
*/

function ZC_QueryServiceType( $InstanceID,$Type,$Domain ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZC_QueryServiceType( $InstanceID,$Type,$Domain );
	return $result;
}

/**
* ZC_QueryServiceTypeEx
* 
* @returns array
* @param integer $InstanceID
* @param string $Type
* @param string $Domain
* @param integer $Timeout
*/

function ZC_QueryServiceTypeEx( $InstanceID,$Type,$Domain,$Timeout ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZC_QueryServiceTypeEx( $InstanceID,$Type,$Domain,$Timeout );
	return $result;
}

/**
* ZC_QueryServiceTypes
* 
* @returns array
* @param integer $InstanceID
*/

function ZC_QueryServiceTypes( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZC_QueryServiceTypes( $InstanceID );
	return $result;
}

/**
* ZC_QueryServiceTypesEx
* 
* @returns array
* @param integer $InstanceID
* @param integer $Timeout
*/

function ZC_QueryServiceTypesEx( $InstanceID,$Timeout ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZC_QueryServiceTypesEx( $InstanceID,$Timeout );
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
* ZW_AssociationAddToGroupEx
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Group
* @param integer $Node
* @param integer $Channel
*/

function ZW_AssociationAddToGroupEx( $InstanceID,$Group,$Node,$Channel ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_AssociationAddToGroupEx( $InstanceID,$Group,$Node,$Channel );
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
* ZW_AssociationRemoveFromGroupEx
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Group
* @param integer $Node
* @param integer $Channel
*/

function ZW_AssociationRemoveFromGroupEx( $InstanceID,$Group,$Node,$Channel ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_AssociationRemoveFromGroupEx( $InstanceID,$Group,$Node,$Channel );
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
* ZW_ClearWakeUpQueue
* 
* @returns boolean
* @param integer $InstanceID
*/

function ZW_ClearWakeUpQueue( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_ClearWakeUpQueue( $InstanceID );
	return $result;
}

/**
* ZW_ColorCW
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $ColdWhite
*/

function ZW_ColorCW( $InstanceID,$ColdWhite ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_ColorCW( $InstanceID,$ColdWhite );
	return $result;
}

/**
* ZW_ColorRGB
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Red
* @param integer $Green
* @param integer $Blue
*/

function ZW_ColorRGB( $InstanceID,$Red,$Green,$Blue ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_ColorRGB( $InstanceID,$Red,$Green,$Blue );
	return $result;
}

/**
* ZW_ColorRGBWW
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Red
* @param integer $Green
* @param integer $Blue
* @param integer $WarmWhite
* @param integer $ColdWhite
*/

function ZW_ColorRGBWW( $InstanceID,$Red,$Green,$Blue,$WarmWhite,$ColdWhite ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_ColorRGBWW( $InstanceID,$Red,$Green,$Blue,$WarmWhite,$ColdWhite );
	return $result;
}

/**
* ZW_ColorWW
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $WarmWhite
*/

function ZW_ColorWW( $InstanceID,$WarmWhite ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_ColorWW( $InstanceID,$WarmWhite );
	return $result;
}

/**
* ZW_ConfigurationAddCustom
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Parameter
* @param string $Description
*/

function ZW_ConfigurationAddCustom( $InstanceID,$Parameter,$Description ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_ConfigurationAddCustom( $InstanceID,$Parameter,$Description );
	return $result;
}

/**
* ZW_ConfigurationGetValue
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Parameter
*/

function ZW_ConfigurationGetValue( $InstanceID,$Parameter ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_ConfigurationGetValue( $InstanceID,$Parameter );
	return $result;
}

/**
* ZW_ConfigurationRemoveCustom
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Parameter
*/

function ZW_ConfigurationRemoveCustom( $InstanceID,$Parameter ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_ConfigurationRemoveCustom( $InstanceID,$Parameter );
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
* ZW_DimDown
* 
* @returns boolean
* @param integer $InstanceID
*/

function ZW_DimDown( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_DimDown( $InstanceID );
	return $result;
}

/**
* ZW_DimDownEx
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Duration
*/

function ZW_DimDownEx( $InstanceID,$Duration ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_DimDownEx( $InstanceID,$Duration );
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
* ZW_DimSetEx
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Intensity
* @param integer $Duration
*/

function ZW_DimSetEx( $InstanceID,$Intensity,$Duration ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_DimSetEx( $InstanceID,$Intensity,$Duration );
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
* ZW_DimUp
* 
* @returns boolean
* @param integer $InstanceID
*/

function ZW_DimUp( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_DimUp( $InstanceID );
	return $result;
}

/**
* ZW_DimUpEx
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Duration
*/

function ZW_DimUpEx( $InstanceID,$Duration ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_DimUpEx( $InstanceID,$Duration );
	return $result;
}

/**
* ZW_DoorLockOperation
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Mode
*/

function ZW_DoorLockOperation( $InstanceID,$Mode ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_DoorLockOperation( $InstanceID,$Mode );
	return $result;
}

/**
* ZW_GetInformation
* 
* @returns string
* @param integer $InstanceID
*/

function ZW_GetInformation( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_GetInformation( $InstanceID );
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
* ZW_GetSupportedVersions
* 
* @returns array
* @param integer $InstanceID
*/

function ZW_GetSupportedVersions( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_GetSupportedVersions( $InstanceID );
	return $result;
}

/**
* ZW_GetWakeUpQueue
* 
* @returns array
* @param integer $InstanceID
*/

function ZW_GetWakeUpQueue( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_GetWakeUpQueue( $InstanceID );
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
* ZW_Optimize
* 
* @returns boolean
* @param integer $InstanceID
*/

function ZW_Optimize( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_Optimize( $InstanceID );
	return $result;
}

/**
* ZW_ProtectionSet
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Mode
*   enum[0=pUnprotected, 1=pProtectedBySequence, 2=pNoOperationPossible]
*/

function ZW_ProtectionSet( $InstanceID,$Mode ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_ProtectionSet( $InstanceID,$Mode );
	return $result;
}

/**
* ZW_ProtectionSetEx
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Mode
*   enum[0=pUnprotected, 1=pProtectedBySequence, 2=pNoOperationPossible]
* @param integer $ModeRF
*   enum[0=prfUnprotected, 1=prfNoRFControl, 2=prfNoRFResponse]
*/

function ZW_ProtectionSetEx( $InstanceID,$Mode,$ModeRF ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_ProtectionSetEx( $InstanceID,$Mode,$ModeRF );
	return $result;
}

/**
* ZW_ReactivateFailedNode
* 
* @returns boolean
* @param integer $InstanceID
*/

function ZW_ReactivateFailedNode( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_ReactivateFailedNode( $InstanceID );
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
* ZW_RequestPriorityRoute
* 
* @returns array
* @param integer $InstanceID
*/

function ZW_RequestPriorityRoute( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_RequestPriorityRoute( $InstanceID );
	return $result;
}

/**
* ZW_RequestRoutingList
* 
* @returns array
* @param integer $InstanceID
* @param boolean $RemoveBad
* @param boolean $RemoveNonRepeaters
*/

function ZW_RequestRoutingList( $InstanceID,$RemoveBad,$RemoveNonRepeaters ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_RequestRoutingList( $InstanceID,$RemoveBad,$RemoveNonRepeaters );
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
* ZW_ResetStatistics
* 
* @returns boolean
* @param integer $InstanceID
*/

function ZW_ResetStatistics( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_ResetStatistics( $InstanceID );
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
* ZW_SwitchAllMode
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Mode
*/

function ZW_SwitchAllMode( $InstanceID,$Mode ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_SwitchAllMode( $InstanceID,$Mode );
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
* ZW_SwitchModeEx
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $DeviceOn
* @param integer $Duration
*/

function ZW_SwitchModeEx( $InstanceID,$DeviceOn,$Duration ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_SwitchModeEx( $InstanceID,$DeviceOn,$Duration );
	return $result;
}

/**
* ZW_Test
* 
* @returns boolean
* @param integer $InstanceID
*/

function ZW_Test( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_Test( $InstanceID );
	return $result;
}

/**
* ZW_TestDevice
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $NodeID
*/

function ZW_TestDevice( $InstanceID,$NodeID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_TestDevice( $InstanceID,$NodeID );
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
*   enum[0=tspInvalid, 1=tspHeating, 2=tspCooling, 3=tspFurnace, 4=tspDryAir, 5=tspMoistAir, 6=tspAutoChangeover, 7=tspEnergySaveHeating, 8=tspEnergySaveCooling, 9=tspAwayHeating, 10=tspAwayCooling, 11=tspFullPower]
* @param float $Value
*/

function ZW_ThermostatSetPointSet( $InstanceID,$SetPoint,$Value ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_ThermostatSetPointSet( $InstanceID,$SetPoint,$Value );
	return $result;
}

/**
* ZW_UIAddAssociation
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $GroupID
*/

function ZW_UIAddAssociation( $InstanceID,$GroupID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_UIAddAssociation( $InstanceID,$GroupID );
	return $result;
}

/**
* ZW_UIAddParameter
* 
* @returns boolean
* @param integer $InstanceID
*/

function ZW_UIAddParameter( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_UIAddParameter( $InstanceID );
	return $result;
}

/**
* ZW_UICancelUserCode
* 
* @returns boolean
* @param integer $InstanceID
*/

function ZW_UICancelUserCode( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_UICancelUserCode( $InstanceID );
	return $result;
}

/**
* ZW_UICloseAddAssociationDialog
* 
* @returns boolean
* @param integer $InstanceID
*/

function ZW_UICloseAddAssociationDialog( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_UICloseAddAssociationDialog( $InstanceID );
	return $result;
}

/**
* ZW_UIIsParameterQueued
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $ID
*/

function ZW_UIIsParameterQueued( $InstanceID,$ID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_UIIsParameterQueued( $InstanceID,$ID );
	return $result;
}

/**
* ZW_UIOpenEditParameterDialog
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $ID
* @param string $Name
* @param string $Enum
*/

function ZW_UIOpenEditParameterDialog( $InstanceID,$ID,$Name,$Enum ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_UIOpenEditParameterDialog( $InstanceID,$ID,$Name,$Enum );
	return $result;
}

/**
* ZW_UIReadCustomValues
* 
* @returns boolean
* @param integer $InstanceID
*/

function ZW_UIReadCustomValues( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_UIReadCustomValues( $InstanceID );
	return $result;
}

/**
* ZW_UIReadValues
* 
* @returns boolean
* @param integer $InstanceID
*/

function ZW_UIReadValues( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_UIReadValues( $InstanceID );
	return $result;
}

/**
* ZW_UISendCurrentConfigurationParameters
* 
* @returns boolean
* @param integer $InstanceID
*/

function ZW_UISendCurrentConfigurationParameters( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_UISendCurrentConfigurationParameters( $InstanceID );
	return $result;
}

/**
* ZW_UISetRoutingOptions
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $ShowRepeating
* @param boolean $ShowResponding
*/

function ZW_UISetRoutingOptions( $InstanceID,$ShowRepeating,$ShowResponding ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_UISetRoutingOptions( $InstanceID,$ShowRepeating,$ShowResponding );
	return $result;
}

/**
* ZW_UIUpdateAssociations
* 
* @returns boolean
* @param integer $InstanceID
*/

function ZW_UIUpdateAssociations( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_UIUpdateAssociations( $InstanceID );
	return $result;
}

/**
* ZW_UIUpdateConfigurationParameters
* 
* @returns boolean
* @param integer $InstanceID
*/

function ZW_UIUpdateConfigurationParameters( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_UIUpdateConfigurationParameters( $InstanceID );
	return $result;
}

/**
* ZW_UIUpdateParameterSelection
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $ParameterValue
*/

function ZW_UIUpdateParameterSelection( $InstanceID,$ParameterValue ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_UIUpdateParameterSelection( $InstanceID,$ParameterValue );
	return $result;
}

/**
* ZW_UIUpdateUserCodeList
* 
* @returns boolean
* @param integer $InstanceID
*/

function ZW_UIUpdateUserCodeList( $InstanceID ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_UIUpdateUserCodeList( $InstanceID );
	return $result;
}

/**
* ZW_UpdatePriorityReturnRoute
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $DestinationID
* @param array $Route
* @param integer $Speed
*/

function ZW_UpdatePriorityReturnRoute( $InstanceID,$DestinationID,$Route,$Speed ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_UpdatePriorityReturnRoute( $InstanceID,$DestinationID,$Route,$Speed );
	return $result;
}

/**
* ZW_UpdatePriorityRoute
* 
* @returns boolean
* @param integer $InstanceID
* @param array $Route
* @param integer $Speed
*/

function ZW_UpdatePriorityRoute( $InstanceID,$Route,$Speed ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_UpdatePriorityRoute( $InstanceID,$Route,$Speed );
	return $result;
}

/**
* ZW_UserCodeLearn
* 
* @returns boolean
* @param integer $InstanceID
* @param boolean $Enabled
*/

function ZW_UserCodeLearn( $InstanceID,$Enabled ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_UserCodeLearn( $InstanceID,$Enabled );
	return $result;
}

/**
* ZW_UserCodeRemove
* 
* @returns boolean
* @param integer $InstanceID
* @param integer $Identifier
*/

function ZW_UserCodeRemove( $InstanceID,$Identifier ){
	$rpc=$GLOBALS["rpc"];
	$result=$rpc->ZW_UserCodeRemove( $InstanceID,$Identifier );
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
