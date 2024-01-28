<?php

 
/**
 * @file
 * @brief generated ipsymcon functions wrapper using gen_ips_wrapper.php
 *
 * This wrapper helps you to execute Scripts written for IPSymcon also on other PHP boxes
 * using IPSymcon JSON API. It defines all known functions and map this to a JSON call
 *
 * @pre All functions are located in ips_wrapper.php. You need the class file IPS_JSON.php as well.
 * @copyright Thomas Dressler 2013-2024
 * @version 0.9 (gen_ips_wrapper.php)
 * @version 7.0 (IPSymcon)
 * @date 2024-01-28 (generated)
 * @see https://www.tdressler.net/ipsymcon/jsonapi.html
 * @see https://www.symcon.de/service/dokumentation/befehlsreferenz/programminformationen/ips-getfunctionlist/
 *
 * @requires PHP >= 8.0
 * @requires MBString extension
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
$rpc = null;


/**
* AA_BaseApplyChanges
* 
* @returns mixed
* @param int $InstanceID
*/

function AA_BaseApplyChanges( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->AA_BaseApplyChanges( $InstanceID );
}

/**
* AA_BaseCreate
* 
* @returns mixed
* @param int $InstanceID
*/

function AA_BaseCreate( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->AA_BaseCreate( $InstanceID );
}

/**
* AA_BaseGetConfigurationForm
* 
* @returns mixed
* @param int $InstanceID
*/

function AA_BaseGetConfigurationForm( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->AA_BaseGetConfigurationForm( $InstanceID );
}

/**
* AA_UIAddSearchedDevices
* 
* @returns mixed
* @param int $InstanceID
* @param array $CurrentDevices
* @param array $NewDevices
*/

function AA_UIAddSearchedDevices( int $InstanceID,array $CurrentDevices,array $NewDevices ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->AA_UIAddSearchedDevices( $InstanceID,$CurrentDevices,$NewDevices );
}

/**
* AA_UIRepairIDs
* 
* @returns mixed
* @param int $InstanceID
* @param array $ListValues
*/

function AA_UIRepairIDs( int $InstanceID,array $ListValues ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->AA_UIRepairIDs( $InstanceID,$ListValues );
}

/**
* AA_UIStartDeviceSearch
* 
* @returns mixed
* @param int $InstanceID
* @param array $ListValues
*/

function AA_UIStartDeviceSearch( int $InstanceID,array $ListValues ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->AA_UIStartDeviceSearch( $InstanceID,$ListValues );
}

/**
* AA_UIUpdateExpertVisibility
* 
* @returns mixed
* @param int $InstanceID
* @param bool $ShowExpertDevices
*/

function AA_UIUpdateExpertVisibility( int $InstanceID,bool $ShowExpertDevices ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->AA_UIUpdateExpertVisibility( $InstanceID,$ShowExpertDevices );
}

/**
* AA_UIUpdateNextID
* 
* @returns mixed
* @param int $InstanceID
* @param array $ListValues
*/

function AA_UIUpdateNextID( int $InstanceID,array $ListValues ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->AA_UIUpdateNextID( $InstanceID,$ListValues );
}

/**
* AC_AddLoggedValues
* 
* @returns bool
* @param int $InstanceID
* @param int $VariableID
* @param array $Values
*/

function AC_AddLoggedValues( int $InstanceID,int $VariableID,array $Values ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->AC_AddLoggedValues( $InstanceID,$VariableID,$Values );
}

/**
* AC_ChangeVariableID
* 
* @returns bool
* @param int $InstanceID
* @param int $OldVariableID
* @param int $NewVariableID
*/

function AC_ChangeVariableID( int $InstanceID,int $OldVariableID,int $NewVariableID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->AC_ChangeVariableID( $InstanceID,$OldVariableID,$NewVariableID );
}

/**
* AC_DeleteVariableData
* 
* @returns int
* @param int $InstanceID
* @param int $VariableID
* @param int $StartTime
* @param int $EndTime
*/

function AC_DeleteVariableData( int $InstanceID,int $VariableID,int $StartTime,int $EndTime ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->AC_DeleteVariableData( $InstanceID,$VariableID,$StartTime,$EndTime );
}

/**
* AC_FetchChartData
* 
* @returns array
* @param int $InstanceID
* @param int $ObjectID
* @param int $StartTime
* @param int $TimeSpan
*   enum[0=tsHour, 1=tsDay, 2=tsWeek, 3=tsMonth, 4=tsYear, 5=tsDecade]
* @param int $Density
*   enum[0=gdNormal, 1=gdHD, 2=gdRaw]
*/

function AC_FetchChartData( int $InstanceID,int $ObjectID,int $StartTime,int $TimeSpan,int $Density ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->AC_FetchChartData( $InstanceID,$ObjectID,$StartTime,$TimeSpan,$Density );
}

/**
* AC_FetchChartDataEx
* 
* @returns array
* @param int $InstanceID
* @param int $ObjectID
* @param int $StartTime
* @param int $TimeSpan
*   enum[0=tsHour, 1=tsDay, 2=tsWeek, 3=tsMonth, 4=tsYear, 5=tsDecade]
* @param int $Density
*   enum[0=gdNormal, 1=gdHD, 2=gdRaw]
* @param array $Visibility
*/

function AC_FetchChartDataEx( int $InstanceID,int $ObjectID,int $StartTime,int $TimeSpan,int $Density,array $Visibility ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->AC_FetchChartDataEx( $InstanceID,$ObjectID,$StartTime,$TimeSpan,$Density,$Visibility );
}

/**
* AC_GetAggregatedValues
* 
* @returns array
* @param int $InstanceID
* @param int $VariableID
* @param int $AggregationSpan
*   enum[0=agHour, 1=agDay, 2=agWeek, 3=agMonth, 4=agYear, 5=ag5Minutes, 6=ag1Minute, 7=agChanges]
* @param int $StartTime
* @param int $EndTime
* @param int $Limit
*/

function AC_GetAggregatedValues( int $InstanceID,int $VariableID,int $AggregationSpan,int $StartTime,int $EndTime,int $Limit ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->AC_GetAggregatedValues( $InstanceID,$VariableID,$AggregationSpan,$StartTime,$EndTime,$Limit );
}

/**
* AC_GetAggregationType
* 
* @returns int
* @param int $InstanceID
* @param int $VariableID
*/

function AC_GetAggregationType( int $InstanceID,int $VariableID ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->AC_GetAggregationType( $InstanceID,$VariableID );
}

/**
* AC_GetAggregationVariables
* 
* @returns array
* @param int $InstanceID
* @param bool $CalculateStatistics
*/

function AC_GetAggregationVariables( int $InstanceID,bool $CalculateStatistics ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->AC_GetAggregationVariables( $InstanceID,$CalculateStatistics );
}

/**
* AC_GetCompaction
* 
* @returns array
* @param int $InstanceID
* @param int $VariableID
*/

function AC_GetCompaction( int $InstanceID,int $VariableID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->AC_GetCompaction( $InstanceID,$VariableID );
}

/**
* AC_GetCounterIgnoreZeros
* 
* @returns bool
* @param int $InstanceID
* @param int $VariableID
*/

function AC_GetCounterIgnoreZeros( int $InstanceID,int $VariableID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->AC_GetCounterIgnoreZeros( $InstanceID,$VariableID );
}

/**
* AC_GetGraphStatus
* 
* @returns bool
* @param int $InstanceID
* @param int $VariableID
*/

function AC_GetGraphStatus( int $InstanceID,int $VariableID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->AC_GetGraphStatus( $InstanceID,$VariableID );
}

/**
* AC_GetLoggedValues
* 
* @returns array
* @param int $InstanceID
* @param int $VariableID
* @param int $StartTime
* @param int $EndTime
* @param int $Limit
*/

function AC_GetLoggedValues( int $InstanceID,int $VariableID,int $StartTime,int $EndTime,int $Limit ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->AC_GetLoggedValues( $InstanceID,$VariableID,$StartTime,$EndTime,$Limit );
}

/**
* AC_GetLoggingStatus
* 
* @returns bool
* @param int $InstanceID
* @param int $VariableID
*/

function AC_GetLoggingStatus( int $InstanceID,int $VariableID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->AC_GetLoggingStatus( $InstanceID,$VariableID );
}

/**
* AC_ReAggregateVariable
* 
* @returns bool
* @param int $InstanceID
* @param int $VariableID
*/

function AC_ReAggregateVariable( int $InstanceID,int $VariableID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->AC_ReAggregateVariable( $InstanceID,$VariableID );
}

/**
* AC_RenderChart
* 
* @returns string
* @param int $InstanceID
* @param int $ObjectID
* @param int $StartTime
* @param int $TimeSpan
*   enum[0=tsHour, 1=tsDay, 2=tsWeek, 3=tsMonth, 4=tsYear, 5=tsDecade]
* @param int $Density
*   enum[0=gdNormal, 1=gdHD, 2=gdRaw]
* @param bool $IsExtrema
* @param bool $IsDyn
* @param int $Width
* @param int $Height
*/

function AC_RenderChart( int $InstanceID,int $ObjectID,int $StartTime,int $TimeSpan,int $Density,bool $IsExtrema,bool $IsDyn,int $Width,int $Height ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->AC_RenderChart( $InstanceID,$ObjectID,$StartTime,$TimeSpan,$Density,$IsExtrema,$IsDyn,$Width,$Height );
}

/**
* AC_RenderChartEx
* 
* @returns string
* @param int $InstanceID
* @param int $ObjectID
* @param int $StartTime
* @param int $TimeSpan
*   enum[0=tsHour, 1=tsDay, 2=tsWeek, 3=tsMonth, 4=tsYear, 5=tsDecade]
* @param int $Density
*   enum[0=gdNormal, 1=gdHD, 2=gdRaw]
* @param bool $IsExtrema
* @param bool $IsDyn
* @param int $Width
* @param int $Height
* @param array $Visibility
*/

function AC_RenderChartEx( int $InstanceID,int $ObjectID,int $StartTime,int $TimeSpan,int $Density,bool $IsExtrema,bool $IsDyn,int $Width,int $Height,array $Visibility ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->AC_RenderChartEx( $InstanceID,$ObjectID,$StartTime,$TimeSpan,$Density,$IsExtrema,$IsDyn,$Width,$Height,$Visibility );
}

/**
* AC_SetAggregationType
* 
* @returns bool
* @param int $InstanceID
* @param int $VariableID
* @param int $AggregationType
*   enum[0=asGauge, 1=asCounter]
*/

function AC_SetAggregationType( int $InstanceID,int $VariableID,int $AggregationType ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->AC_SetAggregationType( $InstanceID,$VariableID,$AggregationType );
}

/**
* AC_SetCompaction
* 
* @returns bool
* @param int $InstanceID
* @param int $VariableID
* @param int $MonthOffset
* @param int $CompactionType
*   enum[0=ctNoCompaction, 1=ct1Minute, 2=ct5Minutes, 3=ctHour, 4=ctDay, 5=ctWeek, 6=ctMonth, 7=ctYear, 8=ctDelete]
*/

function AC_SetCompaction( int $InstanceID,int $VariableID,int $MonthOffset,int $CompactionType ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->AC_SetCompaction( $InstanceID,$VariableID,$MonthOffset,$CompactionType );
}

/**
* AC_SetCounterIgnoreZeros
* 
* @returns bool
* @param int $InstanceID
* @param int $VariableID
* @param bool $IgnoreZeros
*/

function AC_SetCounterIgnoreZeros( int $InstanceID,int $VariableID,bool $IgnoreZeros ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->AC_SetCounterIgnoreZeros( $InstanceID,$VariableID,$IgnoreZeros );
}

/**
* AC_SetGraphStatus
* 
* @returns bool
* @param int $InstanceID
* @param int $VariableID
* @param bool $Active
*/

function AC_SetGraphStatus( int $InstanceID,int $VariableID,bool $Active ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->AC_SetGraphStatus( $InstanceID,$VariableID,$Active );
}

/**
* AC_SetLoggingStatus
* 
* @returns bool
* @param int $InstanceID
* @param int $VariableID
* @param bool $Active
*/

function AC_SetLoggingStatus( int $InstanceID,int $VariableID,bool $Active ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->AC_SetLoggingStatus( $InstanceID,$VariableID,$Active );
}

/**
* AHA_Parse
* 
* @returns mixed
* @param int $InstanceID
* @param string $xmlstring
*/

function AHA_Parse( int $InstanceID,string $xmlstring ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->AHA_Parse( $InstanceID,$xmlstring );
}

/**
* AHA_Query
* 
* @returns mixed
* @param int $InstanceID
*/

function AHA_Query( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->AHA_Query( $InstanceID );
}

/**
* AHA_SwitchMode
* 
* @returns mixed
* @param int $InstanceID
* @param string $ain
* @param bool $val
*/

function AHA_SwitchMode( int $InstanceID,string $ain,bool $val ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->AHA_SwitchMode( $InstanceID,$ain,$val );
}

/**
* AHA_UpdateEvent
* 
* @returns mixed
* @param int $InstanceID
*/

function AHA_UpdateEvent( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->AHA_UpdateEvent( $InstanceID );
}

/**
* ALL_ReadConfiguration
* 
* @returns bool
* @param int $InstanceID
*/

function ALL_ReadConfiguration( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ALL_ReadConfiguration( $InstanceID );
}

/**
* ALL_SetAnalog
* 
* @returns bool
* @param int $InstanceID
* @param int $ChannelID
* @param float $Value
*/

function ALL_SetAnalog( int $InstanceID,int $ChannelID,float $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ALL_SetAnalog( $InstanceID,$ChannelID,$Value );
}

/**
* ALL_SwitchActor
* 
* @returns bool
* @param int $InstanceID
* @param int $ChannelID
* @param bool $DeviceOn
*/

function ALL_SwitchActor( int $InstanceID,int $ChannelID,bool $DeviceOn ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ALL_SwitchActor( $InstanceID,$ChannelID,$DeviceOn );
}

/**
* ALL_SwitchMode
* 
* @returns bool
* @param int $InstanceID
* @param bool $DeviceOn
*/

function ALL_SwitchMode( int $InstanceID,bool $DeviceOn ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ALL_SwitchMode( $InstanceID,$DeviceOn );
}

/**
* ALL_UpdateValues
* 
* @returns bool
* @param int $InstanceID
*/

function ALL_UpdateValues( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ALL_UpdateValues( $InstanceID );
}

/**
* APCUPSD_Query
* 
* @returns mixed
* @param int $InstanceID
*/

function APCUPSD_Query( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->APCUPSD_Query( $InstanceID );
}

/**
* APCUPSD_UpdateEvent
* 
* @returns mixed
* @param int $InstanceID
*/

function APCUPSD_UpdateEvent( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->APCUPSD_UpdateEvent( $InstanceID );
}

/**
* BAC_RelinquishPresetValue
* 
* @returns bool
* @param int $InstanceID
*/

function BAC_RelinquishPresetValue( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->BAC_RelinquishPresetValue( $InstanceID );
}

/**
* BAC_RequestDeviceList
* 
* @returns bool
* @param int $InstanceID
*/

function BAC_RequestDeviceList( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->BAC_RequestDeviceList( $InstanceID );
}

/**
* BAC_RequestStatus
* 
* @returns bool
* @param int $InstanceID
*/

function BAC_RequestStatus( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->BAC_RequestStatus( $InstanceID );
}

/**
* BAC_RequestStatusAll
* 
* @returns bool
* @param int $InstanceID
*/

function BAC_RequestStatusAll( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->BAC_RequestStatusAll( $InstanceID );
}

/**
* BAC_WritePresetValue
* 
* @returns bool
* @param int $InstanceID
* @param mixed $Value
*/

function BAC_WritePresetValue( int $InstanceID,mixed $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->BAC_WritePresetValue( $InstanceID,$Value );
}

/**
* CC_ActivateServer
* 
* @returns bool
* @param int $InstanceID
*/

function CC_ActivateServer( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->CC_ActivateServer( $InstanceID );
}

/**
* CC_GetConnectURL
* 
* @returns string
* @param int $InstanceID
*/

function CC_GetConnectURL( int $InstanceID ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->CC_GetConnectURL( $InstanceID );
}

/**
* CC_GetGoogleAssistantLimitCount
* 
* @returns int
* @param int $InstanceID
*/

function CC_GetGoogleAssistantLimitCount( int $InstanceID ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->CC_GetGoogleAssistantLimitCount( $InstanceID );
}

/**
* CC_GetQRCodeSVG
* 
* @returns string
* @param int $InstanceID
* @param int $WebFrontID
*/

function CC_GetQRCodeSVG( int $InstanceID,int $WebFrontID ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->CC_GetQRCodeSVG( $InstanceID,$WebFrontID );
}

/**
* CC_GetRequestLimitCount
* 
* @returns int
* @param int $InstanceID
*/

function CC_GetRequestLimitCount( int $InstanceID ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->CC_GetRequestLimitCount( $InstanceID );
}

/**
* CC_GetTrafficCounter
* 
* @returns array
* @param int $InstanceID
*/

function CC_GetTrafficCounter( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->CC_GetTrafficCounter( $InstanceID );
}

/**
* CC_GetTrafficStatistics
* 
* @returns array
* @param int $InstanceID
*/

function CC_GetTrafficStatistics( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->CC_GetTrafficStatistics( $InstanceID );
}

/**
* CC_MakeRequest
* 
* @returns string
* @param int $InstanceID
* @param string $Endpoint
* @param string $RequestData
*/

function CC_MakeRequest( int $InstanceID,string $Endpoint,string $RequestData ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->CC_MakeRequest( $InstanceID,$Endpoint,$RequestData );
}

/**
* CC_SendGoogleAssistantStateReport
* 
* @returns bool
* @param int $InstanceID
* @param string $States
*/

function CC_SendGoogleAssistantStateReport( int $InstanceID,string $States ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->CC_SendGoogleAssistantStateReport( $InstanceID,$States );
}

/**
* CMI_UpdateValues
* 
* @returns bool
* @param int $InstanceID
*/

function CMI_UpdateValues( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->CMI_UpdateValues( $InstanceID );
}

/**
* CSCK_SendText
* 
* @returns bool
* @param int $InstanceID
* @param string $Text
*/

function CSCK_SendText( int $InstanceID,string $Text ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->CSCK_SendText( $InstanceID,$Text );
}

/**
* CSCK_UpdateFormUseSSL
* 
* @returns bool
* @param int $InstanceID
* @param bool $UseSSL
*/

function CSCK_UpdateFormUseSSL( int $InstanceID,bool $UseSSL ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->CSCK_UpdateFormUseSSL( $InstanceID,$UseSSL );
}

/**
* CUL_Parse
* 
* @returns mixed
* @param int $InstanceID
* @param string $line
*/

function CUL_Parse( int $InstanceID,string $line ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->CUL_Parse( $InstanceID,$line );
}

/**
* CUL_ReInitEvent
* 
* @returns mixed
* @param int $InstanceID
*/

function CUL_ReInitEvent( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->CUL_ReInitEvent( $InstanceID );
}

/**
* Cutter_ClearBuffer
* 
* @returns bool
* @param int $InstanceID
*/

function Cutter_ClearBuffer( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->Cutter_ClearBuffer( $InstanceID );
}

/**
* DKN_RequestRead
* 
* @returns mixed
* @param int $InstanceID
*/

function DKN_RequestRead( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->DKN_RequestRead( $InstanceID );
}

/**
* DKN_SetBoosterValue
* 
* @returns mixed
* @param int $InstanceID
* @param bool $Value
*/

function DKN_SetBoosterValue( int $InstanceID,bool $Value ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->DKN_SetBoosterValue( $InstanceID,$Value );
}

/**
* DKN_SetFanDirValue
* 
* @returns mixed
* @param int $InstanceID
* @param int $Value
*/

function DKN_SetFanDirValue( int $InstanceID,int $Value ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->DKN_SetFanDirValue( $InstanceID,$Value );
}

/**
* DKN_SetFanRateValue
* 
* @returns mixed
* @param int $InstanceID
* @param int $Value
*/

function DKN_SetFanRateValue( int $InstanceID,int $Value ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->DKN_SetFanRateValue( $InstanceID,$Value );
}

/**
* DKN_SetHomeKitState
* 
* @returns mixed
* @param int $InstanceID
* @param int $Value
*/

function DKN_SetHomeKitState( int $InstanceID,int $Value ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->DKN_SetHomeKitState( $InstanceID,$Value );
}

/**
* DKN_SetHumidityValue
* 
* @returns mixed
* @param int $InstanceID
* @param int $Value
*/

function DKN_SetHumidityValue( int $InstanceID,int $Value ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->DKN_SetHumidityValue( $InstanceID,$Value );
}

/**
* DKN_SetModeValue
* 
* @returns mixed
* @param int $InstanceID
* @param int $Value
*/

function DKN_SetModeValue( int $InstanceID,int $Value ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->DKN_SetModeValue( $InstanceID,$Value );
}

/**
* DKN_SetPowerSwitch
* 
* @returns mixed
* @param int $InstanceID
* @param bool $Value
*/

function DKN_SetPowerSwitch( int $InstanceID,bool $Value ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->DKN_SetPowerSwitch( $InstanceID,$Value );
}

/**
* DKN_SetStreamerValue
* 
* @returns mixed
* @param int $InstanceID
* @param bool $Value
*/

function DKN_SetStreamerValue( int $InstanceID,bool $Value ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->DKN_SetStreamerValue( $InstanceID,$Value );
}

/**
* DKN_SetTempValue
* 
* @returns mixed
* @param int $InstanceID
* @param float $Value
*/

function DKN_SetTempValue( int $InstanceID,float $Value ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->DKN_SetTempValue( $InstanceID,$Value );
}

/**
* DMX_FadeChannel
* 
* @returns bool
* @param int $InstanceID
* @param int $Channel
* @param int $Value
* @param float $FadingSeconds
*/

function DMX_FadeChannel( int $InstanceID,int $Channel,int $Value,float $FadingSeconds ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->DMX_FadeChannel( $InstanceID,$Channel,$Value,$FadingSeconds );
}

/**
* DMX_FadeChannelDelayed
* 
* @returns bool
* @param int $InstanceID
* @param int $Channel
* @param int $Value
* @param float $FadingSeconds
* @param float $DelayedSeconds
*/

function DMX_FadeChannelDelayed( int $InstanceID,int $Channel,int $Value,float $FadingSeconds,float $DelayedSeconds ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->DMX_FadeChannelDelayed( $InstanceID,$Channel,$Value,$FadingSeconds,$DelayedSeconds );
}

/**
* DMX_FadeRGB
* 
* @returns bool
* @param int $InstanceID
* @param int $R
* @param int $G
* @param int $B
* @param float $FadingSeconds
*/

function DMX_FadeRGB( int $InstanceID,int $R,int $G,int $B,float $FadingSeconds ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->DMX_FadeRGB( $InstanceID,$R,$G,$B,$FadingSeconds );
}

/**
* DMX_FadeRGBDelayed
* 
* @returns bool
* @param int $InstanceID
* @param int $R
* @param int $G
* @param int $B
* @param float $FadingSeconds
* @param float $DelayedSeconds
*/

function DMX_FadeRGBDelayed( int $InstanceID,int $R,int $G,int $B,float $FadingSeconds,float $DelayedSeconds ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->DMX_FadeRGBDelayed( $InstanceID,$R,$G,$B,$FadingSeconds,$DelayedSeconds );
}

/**
* DMX_RequestInfo
* 
* @returns bool
* @param int $InstanceID
*/

function DMX_RequestInfo( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->DMX_RequestInfo( $InstanceID );
}

/**
* DMX_ResetInterface
* 
* @returns bool
* @param int $InstanceID
*/

function DMX_ResetInterface( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->DMX_ResetInterface( $InstanceID );
}

/**
* DMX_SetBlackOut
* 
* @returns bool
* @param int $InstanceID
* @param bool $BlackoutOn
*/

function DMX_SetBlackOut( int $InstanceID,bool $BlackoutOn ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->DMX_SetBlackOut( $InstanceID,$BlackoutOn );
}

/**
* DMX_SetChannel
* 
* @returns bool
* @param int $InstanceID
* @param int $Channel
* @param int $Value
*/

function DMX_SetChannel( int $InstanceID,int $Channel,int $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->DMX_SetChannel( $InstanceID,$Channel,$Value );
}

/**
* DMX_SetRGB
* 
* @returns bool
* @param int $InstanceID
* @param int $R
* @param int $G
* @param int $B
*/

function DMX_SetRGB( int $InstanceID,int $R,int $G,int $B ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->DMX_SetRGB( $InstanceID,$R,$G,$B );
}

/**
* DMX_UIChangeMode
* 
* @returns bool
* @param int $InstanceID
* @param int $Mode
*   enum[0=gmDMX4ALL, 1=gmArtNet, 2=gmDMX4ALLoverTCP]
*/

function DMX_UIChangeMode( int $InstanceID,int $Mode ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->DMX_UIChangeMode( $InstanceID,$Mode );
}

/**
* DS_CallScene
* 
* @returns bool
* @param int $InstanceID
* @param int $SceneID
*/

function DS_CallScene( int $InstanceID,int $SceneID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->DS_CallScene( $InstanceID,$SceneID );
}

/**
* DS_DimSet
* 
* @returns bool
* @param int $InstanceID
* @param int $Intensity
*/

function DS_DimSet( int $InstanceID,int $Intensity ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->DS_DimSet( $InstanceID,$Intensity );
}

/**
* DS_GetKnownDevices
* 
* @returns array
* @param int $InstanceID
*/

function DS_GetKnownDevices( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->DS_GetKnownDevices( $InstanceID );
}

/**
* DS_MakeRequest
* 
* @returns string
* @param int $InstanceID
* @param string $Request
* @param string $Data
*/

function DS_MakeRequest( int $InstanceID,string $Request,string $Data ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->DS_MakeRequest( $InstanceID,$Request,$Data );
}

/**
* DS_RequestBinaryInputs
* 
* @returns bool
* @param int $InstanceID
*/

function DS_RequestBinaryInputs( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->DS_RequestBinaryInputs( $InstanceID );
}

/**
* DS_RequestSensorInputs
* 
* @returns bool
* @param int $InstanceID
*/

function DS_RequestSensorInputs( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->DS_RequestSensorInputs( $InstanceID );
}

/**
* DS_RequestStatus
* 
* @returns bool
* @param int $InstanceID
*/

function DS_RequestStatus( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->DS_RequestStatus( $InstanceID );
}

/**
* DS_RequestToken
* 
* @returns bool
* @param int $InstanceID
* @param string $Username
* @param string $Password
*/

function DS_RequestToken( int $InstanceID,string $Username,string $Password ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->DS_RequestToken( $InstanceID,$Username,$Password );
}

/**
* DS_SaveScene
* 
* @returns bool
* @param int $InstanceID
* @param int $SceneID
*/

function DS_SaveScene( int $InstanceID,int $SceneID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->DS_SaveScene( $InstanceID,$SceneID );
}

/**
* DS_ShutterMove
* 
* @returns bool
* @param int $InstanceID
* @param int $Position
*/

function DS_ShutterMove( int $InstanceID,int $Position ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->DS_ShutterMove( $InstanceID,$Position );
}

/**
* DS_ShutterMoveDown
* 
* @returns bool
* @param int $InstanceID
*/

function DS_ShutterMoveDown( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->DS_ShutterMoveDown( $InstanceID );
}

/**
* DS_ShutterMoveUp
* 
* @returns bool
* @param int $InstanceID
*/

function DS_ShutterMoveUp( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->DS_ShutterMoveUp( $InstanceID );
}

/**
* DS_ShutterStepDown
* 
* @returns bool
* @param int $InstanceID
*/

function DS_ShutterStepDown( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->DS_ShutterStepDown( $InstanceID );
}

/**
* DS_ShutterStepUp
* 
* @returns bool
* @param int $InstanceID
*/

function DS_ShutterStepUp( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->DS_ShutterStepUp( $InstanceID );
}

/**
* DS_ShutterStop
* 
* @returns bool
* @param int $InstanceID
*/

function DS_ShutterStop( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->DS_ShutterStop( $InstanceID );
}

/**
* DS_SwitchMode
* 
* @returns bool
* @param int $InstanceID
* @param bool $DeviceOn
*/

function DS_SwitchMode( int $InstanceID,bool $DeviceOn ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->DS_SwitchMode( $InstanceID,$DeviceOn );
}

/**
* DS_UndoScene
* 
* @returns bool
* @param int $InstanceID
* @param int $SceneID
*/

function DS_UndoScene( int $InstanceID,int $SceneID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->DS_UndoScene( $InstanceID,$SceneID );
}

/**
* EIB_BladePosition
* 
* @returns bool
* @param int $InstanceID
* @param int $Position
*/

function EIB_BladePosition( int $InstanceID,int $Position ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->EIB_BladePosition( $InstanceID,$Position );
}

/**
* EIB_Char
* 
* @returns bool
* @param int $InstanceID
* @param string $Value
*/

function EIB_Char( int $InstanceID,string $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->EIB_Char( $InstanceID,$Value );
}

/**
* EIB_Counter16bit
* 
* @returns bool
* @param int $InstanceID
* @param int $Value
*/

function EIB_Counter16bit( int $InstanceID,int $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->EIB_Counter16bit( $InstanceID,$Value );
}

/**
* EIB_Counter32bit
* 
* @returns bool
* @param int $InstanceID
* @param int $Value
*/

function EIB_Counter32bit( int $InstanceID,int $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->EIB_Counter32bit( $InstanceID,$Value );
}

/**
* EIB_Counter8bit
* 
* @returns bool
* @param int $InstanceID
* @param int $Value
*/

function EIB_Counter8bit( int $InstanceID,int $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->EIB_Counter8bit( $InstanceID,$Value );
}

/**
* EIB_Date
* 
* @returns bool
* @param int $InstanceID
* @param string $Value
*/

function EIB_Date( int $InstanceID,string $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->EIB_Date( $InstanceID,$Value );
}

/**
* EIB_DimControl
* 
* @returns bool
* @param int $InstanceID
* @param int $Value
*/

function EIB_DimControl( int $InstanceID,int $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->EIB_DimControl( $InstanceID,$Value );
}

/**
* EIB_DimValue
* 
* @returns bool
* @param int $InstanceID
* @param int $Value
*/

function EIB_DimValue( int $InstanceID,int $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->EIB_DimValue( $InstanceID,$Value );
}

/**
* EIB_DriveBladeValue
* 
* @returns bool
* @param int $InstanceID
* @param int $Value
*/

function EIB_DriveBladeValue( int $InstanceID,int $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->EIB_DriveBladeValue( $InstanceID,$Value );
}

/**
* EIB_DriveMove
* 
* @returns bool
* @param int $InstanceID
* @param bool $Value
*/

function EIB_DriveMove( int $InstanceID,bool $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->EIB_DriveMove( $InstanceID,$Value );
}

/**
* EIB_DriveShutterValue
* 
* @returns bool
* @param int $InstanceID
* @param int $Value
*/

function EIB_DriveShutterValue( int $InstanceID,int $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->EIB_DriveShutterValue( $InstanceID,$Value );
}

/**
* EIB_DriveStep
* 
* @returns bool
* @param int $InstanceID
* @param bool $Value
*/

function EIB_DriveStep( int $InstanceID,bool $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->EIB_DriveStep( $InstanceID,$Value );
}

/**
* EIB_FloatValue
* 
* @returns bool
* @param int $InstanceID
* @param float $Value
*/

function EIB_FloatValue( int $InstanceID,float $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->EIB_FloatValue( $InstanceID,$Value );
}

/**
* EIB_GetDecryptedKeyring
* 
* @returns array
* @param int $InstanceID
*/

function EIB_GetDecryptedKeyring( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->EIB_GetDecryptedKeyring( $InstanceID );
}

/**
* EIB_Move
* 
* @returns bool
* @param int $InstanceID
* @param int $Command
*   enum[0=emcOpen, 1=emcStepOpen, 2=emcStop, 3=emcStepClose, 4=emcClose]
*/

function EIB_Move( int $InstanceID,int $Command ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->EIB_Move( $InstanceID,$Command );
}

/**
* EIB_Position
* 
* @returns bool
* @param int $InstanceID
* @param int $Position
*/

function EIB_Position( int $InstanceID,int $Position ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->EIB_Position( $InstanceID,$Position );
}

/**
* EIB_PriorityControl
* 
* @returns bool
* @param int $InstanceID
* @param int $Value
*/

function EIB_PriorityControl( int $InstanceID,int $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->EIB_PriorityControl( $InstanceID,$Value );
}

/**
* EIB_PriorityPosition
* 
* @returns bool
* @param int $InstanceID
* @param bool $Value
*/

function EIB_PriorityPosition( int $InstanceID,bool $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->EIB_PriorityPosition( $InstanceID,$Value );
}

/**
* EIB_RequestInfo
* 
* @returns bool
* @param int $InstanceID
*/

function EIB_RequestInfo( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->EIB_RequestInfo( $InstanceID );
}

/**
* EIB_RequestStatus
* 
* @returns bool
* @param int $InstanceID
*/

function EIB_RequestStatus( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->EIB_RequestStatus( $InstanceID );
}

/**
* EIB_Scale
* 
* @returns bool
* @param int $InstanceID
* @param int $Value
*/

function EIB_Scale( int $InstanceID,int $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->EIB_Scale( $InstanceID,$Value );
}

/**
* EIB_SetProgrammingMode
* 
* @returns bool
* @param int $InstanceID
* @param bool $Enable
*/

function EIB_SetProgrammingMode( int $InstanceID,bool $Enable ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->EIB_SetProgrammingMode( $InstanceID,$Enable );
}

/**
* EIB_SetRGB
* 
* @returns bool
* @param int $InstanceID
* @param int $R
* @param int $G
* @param int $B
*/

function EIB_SetRGB( int $InstanceID,int $R,int $G,int $B ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->EIB_SetRGB( $InstanceID,$R,$G,$B );
}

/**
* EIB_SetRGBW
* 
* @returns bool
* @param int $InstanceID
* @param int $R
* @param int $G
* @param int $B
* @param int $W
*/

function EIB_SetRGBW( int $InstanceID,int $R,int $G,int $B,int $W ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->EIB_SetRGBW( $InstanceID,$R,$G,$B,$W );
}

/**
* EIB_Str
* 
* @returns bool
* @param int $InstanceID
* @param string $Value
*/

function EIB_Str( int $InstanceID,string $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->EIB_Str( $InstanceID,$Value );
}

/**
* EIB_Switch
* 
* @returns bool
* @param int $InstanceID
* @param bool $Value
*/

function EIB_Switch( int $InstanceID,bool $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->EIB_Switch( $InstanceID,$Value );
}

/**
* EIB_Time
* 
* @returns bool
* @param int $InstanceID
* @param string $Value
*/

function EIB_Time( int $InstanceID,string $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->EIB_Time( $InstanceID,$Value );
}

/**
* EIB_UIUpdateGatewayMode
* 
* @returns bool
* @param int $InstanceID
* @param int $GatewayMode
*/

function EIB_UIUpdateGatewayMode( int $InstanceID,int $GatewayMode ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->EIB_UIUpdateGatewayMode( $InstanceID,$GatewayMode );
}

/**
* EIB_UpdateFormExportMode
* 
* @returns bool
* @param int $InstanceID
* @param int $ExportMode
*/

function EIB_UpdateFormExportMode( int $InstanceID,int $ExportMode ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->EIB_UpdateFormExportMode( $InstanceID,$ExportMode );
}

/**
* EIB_Value
* 
* @returns bool
* @param int $InstanceID
* @param float $Value
*/

function EIB_Value( int $InstanceID,float $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->EIB_Value( $InstanceID,$Value );
}

/**
* ENO_ConfigureEnergyMeasurement
* 
* @returns bool
* @param int $InstanceID
* @param bool $AutoReporting
* @param int $ReportingDeltaWh
* @param int $ReportingMinInterval
* @param int $ReportingMaxInterval
* @param bool $ResetCounter
*/

function ENO_ConfigureEnergyMeasurement( int $InstanceID,bool $AutoReporting,int $ReportingDeltaWh,int $ReportingMinInterval,int $ReportingMaxInterval,bool $ResetCounter ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ENO_ConfigureEnergyMeasurement( $InstanceID,$AutoReporting,$ReportingDeltaWh,$ReportingMinInterval,$ReportingMaxInterval,$ResetCounter );
}

/**
* ENO_ConfigurePowerMeasurement
* 
* @returns bool
* @param int $InstanceID
* @param bool $AutoReporting
* @param int $ReportingDeltaW
* @param int $ReportingMinInterval
* @param int $ReportingMaxInterval
*/

function ENO_ConfigurePowerMeasurement( int $InstanceID,bool $AutoReporting,int $ReportingDeltaW,int $ReportingMinInterval,int $ReportingMaxInterval ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ENO_ConfigurePowerMeasurement( $InstanceID,$AutoReporting,$ReportingDeltaW,$ReportingMinInterval,$ReportingMaxInterval );
}

/**
* ENO_DimColdWhite
* 
* @returns bool
* @param int $InstanceID
* @param int $Intensity
*/

function ENO_DimColdWhite( int $InstanceID,int $Intensity ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ENO_DimColdWhite( $InstanceID,$Intensity );
}

/**
* ENO_DimColor
* 
* @returns bool
* @param int $InstanceID
* @param int $Color
*/

function ENO_DimColor( int $InstanceID,int $Color ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ENO_DimColor( $InstanceID,$Color );
}

/**
* ENO_DimSet
* 
* @returns bool
* @param int $InstanceID
* @param int $Intensity
*/

function ENO_DimSet( int $InstanceID,int $Intensity ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ENO_DimSet( $InstanceID,$Intensity );
}

/**
* ENO_DimWarmWhite
* 
* @returns bool
* @param int $InstanceID
* @param int $Intensity
*/

function ENO_DimWarmWhite( int $InstanceID,int $Intensity ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ENO_DimWarmWhite( $InstanceID,$Intensity );
}

/**
* ENO_DimWhite
* 
* @returns bool
* @param int $InstanceID
* @param int $White
*/

function ENO_DimWhite( int $InstanceID,int $White ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ENO_DimWhite( $InstanceID,$White );
}

/**
* ENO_RequestStatus
* 
* @returns bool
* @param int $InstanceID
*/

function ENO_RequestStatus( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ENO_RequestStatus( $InstanceID );
}

/**
* ENO_SendCST
* 
* @returns bool
* @param int $InstanceID
* @param bool $value
*/

function ENO_SendCST( int $InstanceID,bool $value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ENO_SendCST( $InstanceID,$value );
}

/**
* ENO_SendCTM
* 
* @returns bool
* @param int $InstanceID
* @param int $value
*/

function ENO_SendCTM( int $InstanceID,int $value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ENO_SendCTM( $InstanceID,$value );
}

/**
* ENO_SendCV
* 
* @returns bool
* @param int $InstanceID
* @param float $value
*/

function ENO_SendCV( int $InstanceID,float $value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ENO_SendCV( $InstanceID,$value );
}

/**
* ENO_SendERH
* 
* @returns bool
* @param int $InstanceID
* @param bool $value
*/

function ENO_SendERH( int $InstanceID,bool $value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ENO_SendERH( $InstanceID,$value );
}

/**
* ENO_SendFANOR
* 
* @returns bool
* @param int $InstanceID
* @param int $value
*/

function ENO_SendFANOR( int $InstanceID,int $value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ENO_SendFANOR( $InstanceID,$value );
}

/**
* ENO_SendFANOR_2
* 
* @returns bool
* @param int $InstanceID
* @param bool $value
*/

function ENO_SendFANOR_2( int $InstanceID,bool $value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ENO_SendFANOR_2( $InstanceID,$value );
}

/**
* ENO_SendLearn
* 
* @returns bool
* @param int $InstanceID
*/

function ENO_SendLearn( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ENO_SendLearn( $InstanceID );
}

/**
* ENO_SendLearnEx
* 
* @returns bool
* @param int $InstanceID
*/

function ENO_SendLearnEx( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ENO_SendLearnEx( $InstanceID );
}

/**
* ENO_SendRO
* 
* @returns bool
* @param int $InstanceID
* @param int $value
*/

function ENO_SendRO( int $InstanceID,int $value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ENO_SendRO( $InstanceID,$value );
}

/**
* ENO_SendSPS
* 
* @returns bool
* @param int $InstanceID
* @param float $value
*/

function ENO_SendSPS( int $InstanceID,float $value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ENO_SendSPS( $InstanceID,$value );
}

/**
* ENO_SetActiveMessage
* 
* @returns bool
* @param int $InstanceID
* @param int $Message
*/

function ENO_SetActiveMessage( int $InstanceID,int $Message ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ENO_SetActiveMessage( $InstanceID,$Message );
}

/**
* ENO_SetButtonLock
* 
* @returns bool
* @param int $InstanceID
* @param bool $Active
*/

function ENO_SetButtonLock( int $InstanceID,bool $Active ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ENO_SetButtonLock( $InstanceID,$Active );
}

/**
* ENO_SetFanStage
* 
* @returns bool
* @param int $InstanceID
* @param int $FanStage
*/

function ENO_SetFanStage( int $InstanceID,int $FanStage ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ENO_SetFanStage( $InstanceID,$FanStage );
}

/**
* ENO_SetIntensity
* 
* @returns bool
* @param int $InstanceID
* @param bool $DeviceOn
* @param int $Intensity
*/

function ENO_SetIntensity( int $InstanceID,bool $DeviceOn,int $Intensity ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ENO_SetIntensity( $InstanceID,$DeviceOn,$Intensity );
}

/**
* ENO_SetLockFanStage
* 
* @returns bool
* @param int $InstanceID
* @param bool $Locked
*/

function ENO_SetLockFanStage( int $InstanceID,bool $Locked ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ENO_SetLockFanStage( $InstanceID,$Locked );
}

/**
* ENO_SetLockRoomOccupancy
* 
* @returns bool
* @param int $InstanceID
* @param bool $Locked
*/

function ENO_SetLockRoomOccupancy( int $InstanceID,bool $Locked ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ENO_SetLockRoomOccupancy( $InstanceID,$Locked );
}

/**
* ENO_SetMode
* 
* @returns bool
* @param int $InstanceID
* @param int $Mode
*/

function ENO_SetMode( int $InstanceID,int $Mode ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ENO_SetMode( $InstanceID,$Mode );
}

/**
* ENO_SetOverride
* 
* @returns bool
* @param int $InstanceID
* @param int $Override
*/

function ENO_SetOverride( int $InstanceID,int $Override ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ENO_SetOverride( $InstanceID,$Override );
}

/**
* ENO_SetPosition
* 
* @returns bool
* @param int $InstanceID
* @param int $Position
*/

function ENO_SetPosition( int $InstanceID,int $Position ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ENO_SetPosition( $InstanceID,$Position );
}

/**
* ENO_SetRoomOccupancy
* 
* @returns bool
* @param int $InstanceID
* @param bool $Occupied
*/

function ENO_SetRoomOccupancy( int $InstanceID,bool $Occupied ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ENO_SetRoomOccupancy( $InstanceID,$Occupied );
}

/**
* ENO_SetSmartAckLearn
* 
* @returns bool
* @param int $InstanceID
* @param bool $Enabled
*/

function ENO_SetSmartAckLearn( int $InstanceID,bool $Enabled ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ENO_SetSmartAckLearn( $InstanceID,$Enabled );
}

/**
* ENO_SetTemperature
* 
* @returns bool
* @param int $InstanceID
* @param float $Temperature
*/

function ENO_SetTemperature( int $InstanceID,float $Temperature ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ENO_SetTemperature( $InstanceID,$Temperature );
}

/**
* ENO_SetTemperature1
* 
* @returns bool
* @param int $InstanceID
* @param float $Temperature
*/

function ENO_SetTemperature1( int $InstanceID,float $Temperature ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ENO_SetTemperature1( $InstanceID,$Temperature );
}

/**
* ENO_ShutterMoveDown
* 
* @returns bool
* @param int $InstanceID
*/

function ENO_ShutterMoveDown( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ENO_ShutterMoveDown( $InstanceID );
}

/**
* ENO_ShutterMoveDownEx
* 
* @returns bool
* @param int $InstanceID
* @param float $Seconds
*/

function ENO_ShutterMoveDownEx( int $InstanceID,float $Seconds ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ENO_ShutterMoveDownEx( $InstanceID,$Seconds );
}

/**
* ENO_ShutterMoveUp
* 
* @returns bool
* @param int $InstanceID
*/

function ENO_ShutterMoveUp( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ENO_ShutterMoveUp( $InstanceID );
}

/**
* ENO_ShutterMoveUpEx
* 
* @returns bool
* @param int $InstanceID
* @param float $Seconds
*/

function ENO_ShutterMoveUpEx( int $InstanceID,float $Seconds ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ENO_ShutterMoveUpEx( $InstanceID,$Seconds );
}

/**
* ENO_ShutterStepDown
* 
* @returns bool
* @param int $InstanceID
*/

function ENO_ShutterStepDown( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ENO_ShutterStepDown( $InstanceID );
}

/**
* ENO_ShutterStepUp
* 
* @returns bool
* @param int $InstanceID
*/

function ENO_ShutterStepUp( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ENO_ShutterStepUp( $InstanceID );
}

/**
* ENO_ShutterStop
* 
* @returns bool
* @param int $InstanceID
*/

function ENO_ShutterStop( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ENO_ShutterStop( $InstanceID );
}

/**
* ENO_SwitchLockingMode
* 
* @returns bool
* @param int $InstanceID
* @param int $Value
*/

function ENO_SwitchLockingMode( int $InstanceID,int $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ENO_SwitchLockingMode( $InstanceID,$Value );
}

/**
* ENO_SwitchMode
* 
* @returns bool
* @param int $InstanceID
* @param bool $DeviceOn
*/

function ENO_SwitchMode( int $InstanceID,bool $DeviceOn ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ENO_SwitchMode( $InstanceID,$DeviceOn );
}

/**
* ENO_SwitchModeEx
* 
* @returns bool
* @param int $InstanceID
* @param bool $DeviceOn
* @param int $SendMode
*   enum[0=smNMessage, 1=smUMessage, 2=smBoth]
*/

function ENO_SwitchModeEx( int $InstanceID,bool $DeviceOn,int $SendMode ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ENO_SwitchModeEx( $InstanceID,$DeviceOn,$SendMode );
}

/**
* ENO_SwitchRotationAngle
* 
* @returns bool
* @param int $InstanceID
* @param int $Value
*/

function ENO_SwitchRotationAngle( int $InstanceID,int $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ENO_SwitchRotationAngle( $InstanceID,$Value );
}

/**
* ENO_SwitchShutterAction
* 
* @returns bool
* @param int $InstanceID
* @param int $Value
*/

function ENO_SwitchShutterAction( int $InstanceID,int $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ENO_SwitchShutterAction( $InstanceID,$Value );
}

/**
* ENO_SwitchVacationMode
* 
* @returns bool
* @param int $InstanceID
* @param bool $Value
*/

function ENO_SwitchVacationMode( int $InstanceID,bool $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ENO_SwitchVacationMode( $InstanceID,$Value );
}

/**
* ENO_SwitchVerticalPosition
* 
* @returns bool
* @param int $InstanceID
* @param int $Value
*/

function ENO_SwitchVerticalPosition( int $InstanceID,int $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ENO_SwitchVerticalPosition( $InstanceID,$Value );
}

/**
* ENO_UpdateFreeDeviceIDInForm
* 
* @returns bool
* @param int $InstanceID
*/

function ENO_UpdateFreeDeviceIDInForm( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ENO_UpdateFreeDeviceIDInForm( $InstanceID );
}

/**
* FHT_RequestData
* 
* @returns bool
* @param int $InstanceID
*/

function FHT_RequestData( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->FHT_RequestData( $InstanceID );
}

/**
* FHT_SetDay
* 
* @returns bool
* @param int $InstanceID
* @param int $Value
*/

function FHT_SetDay( int $InstanceID,int $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->FHT_SetDay( $InstanceID,$Value );
}

/**
* FHT_SetHour
* 
* @returns bool
* @param int $InstanceID
* @param int $Value
*/

function FHT_SetHour( int $InstanceID,int $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->FHT_SetHour( $InstanceID,$Value );
}

/**
* FHT_SetMinute
* 
* @returns bool
* @param int $InstanceID
* @param int $Value
*/

function FHT_SetMinute( int $InstanceID,int $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->FHT_SetMinute( $InstanceID,$Value );
}

/**
* FHT_SetMode
* 
* @returns bool
* @param int $InstanceID
* @param int $Mode
*/

function FHT_SetMode( int $InstanceID,int $Mode ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->FHT_SetMode( $InstanceID,$Mode );
}

/**
* FHT_SetMonth
* 
* @returns bool
* @param int $InstanceID
* @param int $Value
*/

function FHT_SetMonth( int $InstanceID,int $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->FHT_SetMonth( $InstanceID,$Value );
}

/**
* FHT_SetTemperature
* 
* @returns bool
* @param int $InstanceID
* @param float $Temperature
*/

function FHT_SetTemperature( int $InstanceID,float $Temperature ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->FHT_SetTemperature( $InstanceID,$Temperature );
}

/**
* FHT_SetYear
* 
* @returns bool
* @param int $InstanceID
* @param int $Value
*/

function FHT_SetYear( int $InstanceID,int $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->FHT_SetYear( $InstanceID,$Value );
}

/**
* FHZ_GetFHTQueue
* 
* @returns array
* @param int $InstanceID
*/

function FHZ_GetFHTQueue( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->FHZ_GetFHTQueue( $InstanceID );
}

/**
* FHZ_GetFreeBuffer
* 
* @returns int
* @param int $InstanceID
*/

function FHZ_GetFreeBuffer( int $InstanceID ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->FHZ_GetFreeBuffer( $InstanceID );
}

/**
* FS20_DimDown
* 
* @returns bool
* @param int $InstanceID
*/

function FS20_DimDown( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->FS20_DimDown( $InstanceID );
}

/**
* FS20_DimUp
* 
* @returns bool
* @param int $InstanceID
*/

function FS20_DimUp( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->FS20_DimUp( $InstanceID );
}

/**
* FS20_SetIntensity
* 
* @returns bool
* @param int $InstanceID
* @param int $Intensity
* @param int $Duration
*/

function FS20_SetIntensity( int $InstanceID,int $Intensity,int $Duration ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->FS20_SetIntensity( $InstanceID,$Intensity,$Duration );
}

/**
* FS20_SwitchDuration
* 
* @returns bool
* @param int $InstanceID
* @param bool $DeviceOn
* @param int $Duration
*/

function FS20_SwitchDuration( int $InstanceID,bool $DeviceOn,int $Duration ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->FS20_SwitchDuration( $InstanceID,$DeviceOn,$Duration );
}

/**
* FS20_SwitchMode
* 
* @returns bool
* @param int $InstanceID
* @param bool $DeviceOn
*/

function FS20_SwitchMode( int $InstanceID,bool $DeviceOn ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->FS20_SwitchMode( $InstanceID,$DeviceOn );
}

/**
* GetValue
* 
* @returns mixed
* @param int $VariableID
*/

function GetValue( int $VariableID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->GetValue( $VariableID );
}

/**
* GetValueBoolean
* 
* @returns bool
* @param int $VariableID
*/

function GetValueBoolean( int $VariableID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->GetValueBoolean( $VariableID );
}

/**
* GetValueFloat
* 
* @returns float
* @param int $VariableID
*/

function GetValueFloat( int $VariableID ):float {
	$rpc=$GLOBALS["rpc"];
	return $rpc->GetValueFloat( $VariableID );
}

/**
* GetValueFormatted
* 
* @returns string
* @param int $VariableID
*/

function GetValueFormatted( int $VariableID ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->GetValueFormatted( $VariableID );
}

/**
* GetValueFormattedEx
* 
* @returns string
* @param int $VariableID
* @param mixed $Value
*/

function GetValueFormattedEx( int $VariableID,mixed $Value ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->GetValueFormattedEx( $VariableID,$Value );
}

/**
* GetValueInteger
* 
* @returns int
* @param int $VariableID
*/

function GetValueInteger( int $VariableID ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->GetValueInteger( $VariableID );
}

/**
* GetValueString
* 
* @returns string
* @param int $VariableID
*/

function GetValueString( int $VariableID ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->GetValueString( $VariableID );
}

/**
* HC_CheckServerEvents
* 
* @returns mixed
* @param int $InstanceID
*/

function HC_CheckServerEvents( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HC_CheckServerEvents( $InstanceID );
}

/**
* HC_InitializeDevice
* 
* @returns mixed
* @param int $InstanceID
*/

function HC_InitializeDevice( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HC_InitializeDevice( $InstanceID );
}

/**
* HC_Register
* 
* @returns mixed
* @param int $InstanceID
*/

function HC_Register( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HC_Register( $InstanceID );
}

/**
* HC_RegisterServerEvents
* 
* @returns mixed
* @param int $InstanceID
*/

function HC_RegisterServerEvents( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HC_RegisterServerEvents( $InstanceID );
}

/**
* HC_ResetRateLimit
* 
* @returns mixed
* @param int $InstanceID
*/

function HC_ResetRateLimit( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HC_ResetRateLimit( $InstanceID );
}

/**
* HC_TargetValue
* 
* @returns bool
* @param int $InstanceID
* @param float $Value
*/

function HC_TargetValue( int $InstanceID,float $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HC_TargetValue( $InstanceID,$Value );
}

/**
* HC_deleteRequest
* 
* @returns mixed
* @param int $InstanceID
* @param string $endpoint
*/

function HC_deleteRequest( int $InstanceID,string $endpoint ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HC_deleteRequest( $InstanceID,$endpoint );
}

/**
* HC_getRequest
* 
* @returns mixed
* @param int $InstanceID
* @param string $endpoint
*/

function HC_getRequest( int $InstanceID,string $endpoint ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HC_getRequest( $InstanceID,$endpoint );
}

/**
* HC_putRequest
* 
* @returns mixed
* @param int $InstanceID
* @param string $endpoint
* @param string $payload
*/

function HC_putRequest( int $InstanceID,string $endpoint,string $payload ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HC_putRequest( $InstanceID,$endpoint,$payload );
}

/**
* HID_SendEvent
* 
* @returns bool
* @param int $InstanceID
* @param int $ReportID
* @param string $Text
*/

function HID_SendEvent( int $InstanceID,int $ReportID,string $Text ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HID_SendEvent( $InstanceID,$ReportID,$Text );
}

/**
* HMS_ReleaseFI
* 
* @returns bool
* @param int $InstanceID
* @param int $Delay
*/

function HMS_ReleaseFI( int $InstanceID,int $Delay ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HMS_ReleaseFI( $InstanceID,$Delay );
}

/**
* HM_GetDeviceDescription
* 
* @returns string
* @param int $InstanceID
*/

function HM_GetDeviceDescription( int $InstanceID ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HM_GetDeviceDescription( $InstanceID );
}

/**
* HM_GetKnownDevices
* 
* @returns array
* @param int $InstanceID
*/

function HM_GetKnownDevices( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HM_GetKnownDevices( $InstanceID );
}

/**
* HM_GetParamsetDescription
* 
* @returns string
* @param int $InstanceID
*/

function HM_GetParamsetDescription( int $InstanceID ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HM_GetParamsetDescription( $InstanceID );
}

/**
* HM_LoadDevices
* 
* @returns bool
* @param int $InstanceID
* @param int $Protocol
*   enum[0=hmpRadio, 1=hmpWired, 2=hmpIP, 3=hmpGroups]
*/

function HM_LoadDevices( int $InstanceID,int $Protocol ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HM_LoadDevices( $InstanceID,$Protocol );
}

/**
* HM_ReadServiceMessages
* 
* @returns array
* @param int $InstanceID
*/

function HM_ReadServiceMessages( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HM_ReadServiceMessages( $InstanceID );
}

/**
* HM_RequestStatus
* 
* @returns bool
* @param int $InstanceID
* @param string $Parameter
*/

function HM_RequestStatus( int $InstanceID,string $Parameter ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HM_RequestStatus( $InstanceID,$Parameter );
}

/**
* HM_UpdateFormUseSSL
* 
* @returns bool
* @param int $InstanceID
* @param bool $UseSSL
*/

function HM_UpdateFormUseSSL( int $InstanceID,bool $UseSSL ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HM_UpdateFormUseSSL( $InstanceID,$UseSSL );
}

/**
* HM_WriteValueBoolean
* 
* @returns bool
* @param int $InstanceID
* @param string $Parameter
* @param bool $Value
*/

function HM_WriteValueBoolean( int $InstanceID,string $Parameter,bool $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HM_WriteValueBoolean( $InstanceID,$Parameter,$Value );
}

/**
* HM_WriteValueFloat
* 
* @returns bool
* @param int $InstanceID
* @param string $Parameter
* @param float $Value
*/

function HM_WriteValueFloat( int $InstanceID,string $Parameter,float $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HM_WriteValueFloat( $InstanceID,$Parameter,$Value );
}

/**
* HM_WriteValueInteger
* 
* @returns bool
* @param int $InstanceID
* @param string $Parameter
* @param int $Value
*/

function HM_WriteValueInteger( int $InstanceID,string $Parameter,int $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HM_WriteValueInteger( $InstanceID,$Parameter,$Value );
}

/**
* HM_WriteValueString
* 
* @returns bool
* @param int $InstanceID
* @param string $Parameter
* @param string $Value
*/

function HM_WriteValueString( int $InstanceID,string $Parameter,string $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HM_WriteValueString( $InstanceID,$Parameter,$Value );
}

/**
* HPSensor_ApplyJsonData
* 
* @returns mixed
* @param int $InstanceID
* @param string $jsonString
*/

function HPSensor_ApplyJsonData( int $InstanceID,string $jsonString ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HPSensor_ApplyJsonData( $InstanceID,$jsonString );
}

/**
* HPSensor_DirectionDown
* 
* @returns mixed
* @param int $InstanceID
*/

function HPSensor_DirectionDown( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HPSensor_DirectionDown( $InstanceID );
}

/**
* HPSensor_DirectionStop
* 
* @returns mixed
* @param int $InstanceID
*/

function HPSensor_DirectionStop( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HPSensor_DirectionStop( $InstanceID );
}

/**
* HPSensor_DirectionUp
* 
* @returns mixed
* @param int $InstanceID
*/

function HPSensor_DirectionUp( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HPSensor_DirectionUp( $InstanceID );
}

/**
* HPSensor_GetAutomatic
* 
* @returns mixed
* @param int $InstanceID
*/

function HPSensor_GetAutomatic( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HPSensor_GetAutomatic( $InstanceID );
}

/**
* HPSensor_GetBridge
* 
* @returns mixed
* @param int $InstanceID
*/

function HPSensor_GetBridge( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HPSensor_GetBridge( $InstanceID );
}

/**
* HPSensor_GetPosition
* 
* @returns mixed
* @param int $InstanceID
*/

function HPSensor_GetPosition( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HPSensor_GetPosition( $InstanceID );
}

/**
* HPSensor_GetProductInfoFromDeviceNumber
* 
* @returns mixed
* @param int $InstanceID
* @param mixed $ProductId
*/

function HPSensor_GetProductInfoFromDeviceNumber( int $InstanceID,mixed $ProductId ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HPSensor_GetProductInfoFromDeviceNumber( $InstanceID,$ProductId );
}

/**
* HPSensor_GetState
* 
* @returns mixed
* @param int $InstanceID
*/

function HPSensor_GetState( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HPSensor_GetState( $InstanceID );
}

/**
* HPSensor_GetValue
* 
* @returns mixed
* @param int $InstanceID
* @param mixed $Ident
*/

function HPSensor_GetValue( int $InstanceID,mixed $Ident ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HPSensor_GetValue( $InstanceID,$Ident );
}

/**
* HPSensor_RequestData
* 
* @returns mixed
* @param int $InstanceID
*/

function HPSensor_RequestData( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HPSensor_RequestData( $InstanceID );
}

/**
* HPSensor_SetAutomatic
* 
* @returns mixed
* @param int $InstanceID
* @param bool $value
*/

function HPSensor_SetAutomatic( int $InstanceID,bool $value ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HPSensor_SetAutomatic( $InstanceID,$value );
}

/**
* HPSensor_SetPosition
* 
* @returns mixed
* @param int $InstanceID
* @param float $value
*/

function HPSensor_SetPosition( int $InstanceID,float $value ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HPSensor_SetPosition( $InstanceID,$value );
}

/**
* HPSensor_SetState
* 
* @returns mixed
* @param int $InstanceID
* @param bool $value
*/

function HPSensor_SetState( int $InstanceID,bool $value ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HPSensor_SetState( $InstanceID,$value );
}

/**
* HP_ApplyJsonData
* 
* @returns mixed
* @param int $InstanceID
* @param string $jsonString
*/

function HP_ApplyJsonData( int $InstanceID,string $jsonString ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HP_ApplyJsonData( $InstanceID,$jsonString );
}

/**
* HP_DirectionDown
* 
* @returns mixed
* @param int $InstanceID
*/

function HP_DirectionDown( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HP_DirectionDown( $InstanceID );
}

/**
* HP_DirectionStop
* 
* @returns mixed
* @param int $InstanceID
*/

function HP_DirectionStop( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HP_DirectionStop( $InstanceID );
}

/**
* HP_DirectionUp
* 
* @returns mixed
* @param int $InstanceID
*/

function HP_DirectionUp( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HP_DirectionUp( $InstanceID );
}

/**
* HP_GetAutomatic
* 
* @returns mixed
* @param int $InstanceID
*/

function HP_GetAutomatic( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HP_GetAutomatic( $InstanceID );
}

/**
* HP_GetBridge
* 
* @returns mixed
* @param int $InstanceID
*/

function HP_GetBridge( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HP_GetBridge( $InstanceID );
}

/**
* HP_GetDeviceByUniqueId
* 
* @returns mixed
* @param int $InstanceID
* @param string $uniqueId
*/

function HP_GetDeviceByUniqueId( int $InstanceID,string $uniqueId ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HP_GetDeviceByUniqueId( $InstanceID,$uniqueId );
}

/**
* HP_GetHomePilotCategory
* 
* @returns mixed
* @param int $InstanceID
*/

function HP_GetHomePilotCategory( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HP_GetHomePilotCategory( $InstanceID );
}

/**
* HP_GetHomePilotSensorCategory
* 
* @returns mixed
* @param int $InstanceID
*/

function HP_GetHomePilotSensorCategory( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HP_GetHomePilotSensorCategory( $InstanceID );
}

/**
* HP_GetHomePilotVersion
* 
* @returns mixed
* @param int $InstanceID
*/

function HP_GetHomePilotVersion( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HP_GetHomePilotVersion( $InstanceID );
}

/**
* HP_GetHost
* 
* @returns mixed
* @param int $InstanceID
*/

function HP_GetHost( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HP_GetHost( $InstanceID );
}

/**
* HP_GetPosition
* 
* @returns mixed
* @param int $InstanceID
*/

function HP_GetPosition( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HP_GetPosition( $InstanceID );
}

/**
* HP_GetProductInfoFromDeviceNumber
* 
* @returns mixed
* @param int $InstanceID
* @param mixed $ProductId
*/

function HP_GetProductInfoFromDeviceNumber( int $InstanceID,mixed $ProductId ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HP_GetProductInfoFromDeviceNumber( $InstanceID,$ProductId );
}

/**
* HP_GetState
* 
* @returns mixed
* @param int $InstanceID
*/

function HP_GetState( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HP_GetState( $InstanceID );
}

/**
* HP_GetValue
* 
* @returns mixed
* @param int $InstanceID
* @param mixed $Ident
*/

function HP_GetValue( int $InstanceID,mixed $Ident ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HP_GetValue( $InstanceID,$Ident );
}

/**
* HP_NodeGuid
* 
* @returns mixed
* @param int $InstanceID
*/

function HP_NodeGuid( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HP_NodeGuid( $InstanceID );
}

/**
* HP_ProtocolVersion
* 
* @returns mixed
* @param int $InstanceID
*/

function HP_ProtocolVersion( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HP_ProtocolVersion( $InstanceID );
}

/**
* HP_RegisterTimer
* 
* @returns mixed
* @param int $InstanceID
* @param mixed $ident
* @param mixed $interval
* @param mixed $script
*/

function HP_RegisterTimer( int $InstanceID,mixed $ident,mixed $interval,mixed $script ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HP_RegisterTimer( $InstanceID,$ident,$interval,$script );
}

/**
* HP_Request
* 
* @returns mixed
* @param int $InstanceID
* @param string $path
*/

function HP_Request( int $InstanceID,string $path ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HP_Request( $InstanceID,$path );
}

/**
* HP_RequestData
* 
* @returns mixed
* @param int $InstanceID
*/

function HP_RequestData( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HP_RequestData( $InstanceID );
}

/**
* HP_SensorGuid
* 
* @returns mixed
* @param int $InstanceID
*/

function HP_SensorGuid( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HP_SensorGuid( $InstanceID );
}

/**
* HP_SetAutomatic
* 
* @returns mixed
* @param int $InstanceID
* @param bool $value
*/

function HP_SetAutomatic( int $InstanceID,bool $value ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HP_SetAutomatic( $InstanceID,$value );
}

/**
* HP_SetPosition
* 
* @returns mixed
* @param int $InstanceID
* @param float $value
*/

function HP_SetPosition( int $InstanceID,float $value ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HP_SetPosition( $InstanceID,$value );
}

/**
* HP_SetState
* 
* @returns mixed
* @param int $InstanceID
* @param bool $value
*/

function HP_SetState( int $InstanceID,bool $value ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HP_SetState( $InstanceID,$value );
}

/**
* HP_SyncDevices
* 
* @returns mixed
* @param int $InstanceID
*/

function HP_SyncDevices( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HP_SyncDevices( $InstanceID );
}

/**
* HP_SyncNodes
* 
* @returns mixed
* @param int $InstanceID
*/

function HP_SyncNodes( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HP_SyncNodes( $InstanceID );
}

/**
* HP_SyncSensors
* 
* @returns mixed
* @param int $InstanceID
*/

function HP_SyncSensors( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HP_SyncSensors( $InstanceID );
}

/**
* HP_SyncStates
* 
* @returns mixed
* @param int $InstanceID
*/

function HP_SyncStates( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HP_SyncStates( $InstanceID );
}

/**
* HasAction
* 
* @returns bool
* @param int $VariableID
*/

function HasAction( int $VariableID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->HasAction( $VariableID );
}

/**
* IG_UpdateImage
* 
* @returns bool
* @param int $InstanceID
*/

function IG_UpdateImage( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IG_UpdateImage( $InstanceID );
}

/**
* IMAP_DeleteMail
* 
* @returns bool
* @param int $InstanceID
* @param string $UID
*/

function IMAP_DeleteMail( int $InstanceID,string $UID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IMAP_DeleteMail( $InstanceID,$UID );
}

/**
* IMAP_GetCachedMails
* 
* @returns array
* @param int $InstanceID
*/

function IMAP_GetCachedMails( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IMAP_GetCachedMails( $InstanceID );
}

/**
* IMAP_GetMailEx
* 
* @returns array
* @param int $InstanceID
* @param string $UID
*/

function IMAP_GetMailEx( int $InstanceID,string $UID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IMAP_GetMailEx( $InstanceID,$UID );
}

/**
* IMAP_UpdateCache
* 
* @returns bool
* @param int $InstanceID
*/

function IMAP_UpdateCache( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IMAP_UpdateCache( $InstanceID );
}

/**
* IMAP_UpdateFormUseSSL
* 
* @returns bool
* @param int $InstanceID
* @param bool $UseSSL
*/

function IMAP_UpdateFormUseSSL( int $InstanceID,bool $UseSSL ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IMAP_UpdateFormUseSSL( $InstanceID,$UseSSL );
}

/**
* IPS_AbortScript
* 
* @returns bool
* @param int $ScriptID
*/

function IPS_AbortScript( int $ScriptID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_AbortScript( $ScriptID );
}

/**
* IPS_ActionExists
* 
* @returns bool
* @param string $ActionID
*/

function IPS_ActionExists( string $ActionID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_ActionExists( $ActionID );
}

/**
* IPS_ApplyChanges
* 
* @returns bool
* @param int $InstanceID
*/

function IPS_ApplyChanges( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_ApplyChanges( $InstanceID );
}

/**
* IPS_CandidateMediaStream
* 
* @returns bool
* @param string $SessionID
* @param string $ICE
*/

function IPS_CandidateMediaStream( string $SessionID,string $ICE ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_CandidateMediaStream( $SessionID,$ICE );
}

/**
* IPS_CategoryExists
* 
* @returns bool
* @param int $CategoryID
*/

function IPS_CategoryExists( int $CategoryID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_CategoryExists( $CategoryID );
}

/**
* IPS_ConfigureMediaStream
* 
* @returns bool
* @param string $SessionID
* @param string $SessionDescription
*/

function IPS_ConfigureMediaStream( string $SessionID,string $SessionDescription ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_ConfigureMediaStream( $SessionID,$SessionDescription );
}

/**
* IPS_ConnectInstance
* 
* @returns bool
* @param int $InstanceID
* @param int $ParentID
*/

function IPS_ConnectInstance( int $InstanceID,int $ParentID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_ConnectInstance( $InstanceID,$ParentID );
}

/**
* IPS_ConnectMediaStream
* 
* @returns array
* @param int $MediaID
*/

function IPS_ConnectMediaStream( int $MediaID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_ConnectMediaStream( $MediaID );
}

/**
* IPS_CreateCategory
* 
* @returns int
*/

function IPS_CreateCategory(  ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_CreateCategory(  );
}

/**
* IPS_CreateEvent
* 
* @returns int
* @param int $EventType
*   enum[0=etTrigger, 1=etCyclic, 2=etSchedule]
*/

function IPS_CreateEvent( int $EventType ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_CreateEvent( $EventType );
}

/**
* IPS_CreateInstance
* 
* @returns int
* @param string $ModuleID
*/

function IPS_CreateInstance( string $ModuleID ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_CreateInstance( $ModuleID );
}

/**
* IPS_CreateLink
* 
* @returns int
*/

function IPS_CreateLink(  ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_CreateLink(  );
}

/**
* IPS_CreateMedia
* 
* @returns int
* @param int $MediaType
*   enum[0=mtIPSView, 1=mtImage, 2=mtSound, 3=mtStream, 4=mtChart, 5=mtDocument]
*/

function IPS_CreateMedia( int $MediaType ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_CreateMedia( $MediaType );
}

/**
* IPS_CreateScript
* 
* @returns int
* @param int $ScriptType
*   enum[0=stPHPScript, 1=stFlowScript, 2=stIPSWorkflow]
*/

function IPS_CreateScript( int $ScriptType ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_CreateScript( $ScriptType );
}

/**
* IPS_CreateTemporaryMediaStreamToken
* 
* @returns string
* @param int $MediaID
* @param int $ValidForSeconds
*/

function IPS_CreateTemporaryMediaStreamToken( int $MediaID,int $ValidForSeconds ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_CreateTemporaryMediaStreamToken( $MediaID,$ValidForSeconds );
}

/**
* IPS_CreateTemporaryToken
* 
* @returns string
* @param int $ValidForSeconds
*/

function IPS_CreateTemporaryToken( int $ValidForSeconds ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_CreateTemporaryToken( $ValidForSeconds );
}

/**
* IPS_CreateVariable
* 
* @returns int
* @param int $VariableType
*   enum[0=vtBoolean, 1=vtInteger, 2=vtFloat, 3=vtString]
*/

function IPS_CreateVariable( int $VariableType ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_CreateVariable( $VariableType );
}

/**
* IPS_CreateVariableProfile
* 
* @returns bool
* @param string $ProfileName
* @param int $ProfileType
*   enum[0=vtBoolean, 1=vtInteger, 2=vtFloat, 3=vtString]
*/

function IPS_CreateVariableProfile( string $ProfileName,int $ProfileType ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_CreateVariableProfile( $ProfileName,$ProfileType );
}

/**
* IPS_DeleteCategory
* 
* @returns bool
* @param int $CategoryID
*/

function IPS_DeleteCategory( int $CategoryID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_DeleteCategory( $CategoryID );
}

/**
* IPS_DeleteEvent
* 
* @returns bool
* @param int $EventID
*/

function IPS_DeleteEvent( int $EventID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_DeleteEvent( $EventID );
}

/**
* IPS_DeleteInstance
* 
* @returns bool
* @param int $InstanceID
*/

function IPS_DeleteInstance( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_DeleteInstance( $InstanceID );
}

/**
* IPS_DeleteLink
* 
* @returns bool
* @param int $LinkID
*/

function IPS_DeleteLink( int $LinkID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_DeleteLink( $LinkID );
}

/**
* IPS_DeleteMedia
* 
* @returns bool
* @param int $MediaID
* @param bool $DeleteFile
*/

function IPS_DeleteMedia( int $MediaID,bool $DeleteFile ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_DeleteMedia( $MediaID,$DeleteFile );
}

/**
* IPS_DeleteScript
* 
* @returns bool
* @param int $ScriptID
* @param bool $DeleteFile
*/

function IPS_DeleteScript( int $ScriptID,bool $DeleteFile ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_DeleteScript( $ScriptID,$DeleteFile );
}

/**
* IPS_DeleteVariable
* 
* @returns bool
* @param int $VariableID
*/

function IPS_DeleteVariable( int $VariableID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_DeleteVariable( $VariableID );
}

/**
* IPS_DeleteVariableProfile
* 
* @returns bool
* @param string $ProfileName
*/

function IPS_DeleteVariableProfile( string $ProfileName ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_DeleteVariableProfile( $ProfileName );
}

/**
* IPS_DisableDebug
* 
* @returns bool
* @param int $ID
*/

function IPS_DisableDebug( int $ID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_DisableDebug( $ID );
}

/**
* IPS_DisableDebugFile
* 
* @returns bool
* @param int $ID
*/

function IPS_DisableDebugFile( int $ID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_DisableDebugFile( $ID );
}

/**
* IPS_DisconnectInstance
* 
* @returns bool
* @param int $InstanceID
*/

function IPS_DisconnectInstance( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_DisconnectInstance( $InstanceID );
}

/**
* IPS_DisconnectMediaStream
* 
* @returns bool
* @param string $SessionID
*/

function IPS_DisconnectMediaStream( string $SessionID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_DisconnectMediaStream( $SessionID );
}

/**
* IPS_EnableDebug
* 
* @returns bool
* @param int $ID
* @param int $Duration
*/

function IPS_EnableDebug( int $ID,int $Duration ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_EnableDebug( $ID,$Duration );
}

/**
* IPS_EnableDebugFile
* 
* @returns bool
* @param int $ID
*/

function IPS_EnableDebugFile( int $ID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_EnableDebugFile( $ID );
}

/**
* IPS_EventExists
* 
* @returns bool
* @param int $EventID
*/

function IPS_EventExists( int $EventID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_EventExists( $EventID );
}

/**
* IPS_Execute
* 
* @returns string
* @param string $Filename
* @param string $Parameter
* @param bool $ShowWindow
* @param bool $WaitResult
*/

function IPS_Execute( string $Filename,string $Parameter,bool $ShowWindow,bool $WaitResult ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_Execute( $Filename,$Parameter,$ShowWindow,$WaitResult );
}

/**
* IPS_ExecuteEx
* 
* @returns string
* @param string $Filename
* @param string $Parameter
* @param bool $ShowWindow
* @param bool $WaitResult
* @param int $SessionID
*/

function IPS_ExecuteEx( string $Filename,string $Parameter,bool $ShowWindow,bool $WaitResult,int $SessionID ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_ExecuteEx( $Filename,$Parameter,$ShowWindow,$WaitResult,$SessionID );
}

/**
* IPS_FindObjectIDByIdent
* 
* @returns int
* @param string $Ident
* @param int $ParentID
*/

function IPS_FindObjectIDByIdent( string $Ident,int $ParentID ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_FindObjectIDByIdent( $Ident,$ParentID );
}

/**
* IPS_FindObjectIDByName
* 
* @returns int
* @param string $Name
* @param int $ParentID
*/

function IPS_FindObjectIDByName( string $Name,int $ParentID ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_FindObjectIDByName( $Name,$ParentID );
}

/**
* IPS_FunctionExists
* 
* @returns bool
* @param string $FunctionName
*/

function IPS_FunctionExists( string $FunctionName ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_FunctionExists( $FunctionName );
}

/**
* IPS_GetActionForm
* 
* @returns string
* @param string $ActionID
* @param array $Parameters
*/

function IPS_GetActionForm( string $ActionID,array $Parameters ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetActionForm( $ActionID,$Parameters );
}

/**
* IPS_GetActionReadableCode
* 
* @returns string
* @param string $ActionID
* @param array $Parameters
*/

function IPS_GetActionReadableCode( string $ActionID,array $Parameters ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetActionReadableCode( $ActionID,$Parameters );
}

/**
* IPS_GetActions
* 
* @returns string
*/

function IPS_GetActions(  ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetActions(  );
}

/**
* IPS_GetActionsByEnvironment
* 
* @returns string
* @param int $TargetID
* @param string $Environment
* @param bool $IncludeDefault
*/

function IPS_GetActionsByEnvironment( int $TargetID,string $Environment,bool $IncludeDefault ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetActionsByEnvironment( $TargetID,$Environment,$IncludeDefault );
}

/**
* IPS_GetActiveProxyConnections
* 
* @returns int
*/

function IPS_GetActiveProxyConnections(  ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetActiveProxyConnections(  );
}

/**
* IPS_GetActiveWebRTCConnections
* 
* @returns int
*/

function IPS_GetActiveWebRTCConnections(  ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetActiveWebRTCConnections(  );
}

/**
* IPS_GetActiveWebServerConnections
* 
* @returns int
*/

function IPS_GetActiveWebServerConnections(  ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetActiveWebServerConnections(  );
}

/**
* IPS_GetActiveWebSocketConnections
* 
* @returns int
*/

function IPS_GetActiveWebSocketConnections(  ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetActiveWebSocketConnections(  );
}

/**
* IPS_GetAvailableUpdates
* 
* @returns array
*/

function IPS_GetAvailableUpdates(  ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetAvailableUpdates(  );
}

/**
* IPS_GetCategory
* 
* @returns array
* @param int $CategoryID
*/

function IPS_GetCategory( int $CategoryID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetCategory( $CategoryID );
}

/**
* IPS_GetCategoryIDByName
* 
* @returns int
* @param string $Name
* @param int $ParentID
*/

function IPS_GetCategoryIDByName( string $Name,int $ParentID ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetCategoryIDByName( $Name,$ParentID );
}

/**
* IPS_GetCategoryList
* 
* @returns array
*/

function IPS_GetCategoryList(  ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetCategoryList(  );
}

/**
* IPS_GetChildrenIDs
* 
* @returns array
* @param int $ID
*/

function IPS_GetChildrenIDs( int $ID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetChildrenIDs( $ID );
}

/**
* IPS_GetCompatibleInstances
* 
* @returns array
* @param int $InstanceID
*/

function IPS_GetCompatibleInstances( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetCompatibleInstances( $InstanceID );
}

/**
* IPS_GetCompatibleModules
* 
* @returns array
* @param string $ModuleID
*/

function IPS_GetCompatibleModules( string $ModuleID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetCompatibleModules( $ModuleID );
}

/**
* IPS_GetConfiguration
* 
* @returns string
* @param int $InstanceID
*/

function IPS_GetConfiguration( int $InstanceID ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetConfiguration( $InstanceID );
}

/**
* IPS_GetConfigurationForParent
* 
* @returns string
* @param int $InstanceID
*/

function IPS_GetConfigurationForParent( int $InstanceID ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetConfigurationForParent( $InstanceID );
}

/**
* IPS_GetConfigurationForm
* 
* @returns string
* @param int $InstanceID
*/

function IPS_GetConfigurationForm( int $InstanceID ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetConfigurationForm( $InstanceID );
}

/**
* IPS_GetConfigurationsFromChildren
* 
* @returns array
* @param array $Parameter
*/

function IPS_GetConfigurationsFromChildren( array $Parameter ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetConfigurationsFromChildren( $Parameter );
}

/**
* IPS_GetConnectionList
* 
* @returns array
*/

function IPS_GetConnectionList(  ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetConnectionList(  );
}

/**
* IPS_GetDemoExpiration
* 
* @returns int
*/

function IPS_GetDemoExpiration(  ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetDemoExpiration(  );
}

/**
* IPS_GetEvent
* 
* @returns array
* @param int $EventID
*/

function IPS_GetEvent( int $EventID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetEvent( $EventID );
}

/**
* IPS_GetEventIDByName
* 
* @returns int
* @param string $Name
* @param int $ParentID
*/

function IPS_GetEventIDByName( string $Name,int $ParentID ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetEventIDByName( $Name,$ParentID );
}

/**
* IPS_GetEventList
* 
* @returns array
*/

function IPS_GetEventList(  ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetEventList(  );
}

/**
* IPS_GetEventListByType
* 
* @returns array
* @param int $EventType
*   enum[0=etTrigger, 1=etCyclic, 2=etSchedule]
*/

function IPS_GetEventListByType( int $EventType ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetEventListByType( $EventType );
}

/**
* IPS_GetFlowScriptStatistic
* 
* @returns array
* @param int $ScriptID
*/

function IPS_GetFlowScriptStatistic( int $ScriptID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetFlowScriptStatistic( $ScriptID );
}

/**
* IPS_GetFunction
* 
* @returns array
* @param string $FunctionName
*/

function IPS_GetFunction( string $FunctionName ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetFunction( $FunctionName );
}

/**
* IPS_GetFunctionList
* 
* @returns array
* @param int $InstanceID
*/

function IPS_GetFunctionList( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetFunctionList( $InstanceID );
}

/**
* IPS_GetFunctionListByModuleID
* 
* @returns array
* @param string $ModuleID
*/

function IPS_GetFunctionListByModuleID( string $ModuleID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetFunctionListByModuleID( $ModuleID );
}

/**
* IPS_GetFunctions
* 
* @returns array
* @param array $InstanceIDs
*/

function IPS_GetFunctions( array $InstanceIDs ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetFunctions( $InstanceIDs );
}

/**
* IPS_GetFunctionsMap
* 
* @returns array
* @param array $InstanceIDs
*/

function IPS_GetFunctionsMap( array $InstanceIDs ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetFunctionsMap( $InstanceIDs );
}

/**
* IPS_GetIcons
* 
* @returns array
* @param array $Parameter
*/

function IPS_GetIcons( array $Parameter ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetIcons( $Parameter );
}

/**
* IPS_GetInstance
* 
* @returns array
* @param int $InstanceID
*/

function IPS_GetInstance( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetInstance( $InstanceID );
}

/**
* IPS_GetInstanceDataFlowStatistics
* 
* @returns array
*/

function IPS_GetInstanceDataFlowStatistics(  ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetInstanceDataFlowStatistics(  );
}

/**
* IPS_GetInstanceIDByName
* 
* @returns int
* @param string $Name
* @param int $ParentID
*/

function IPS_GetInstanceIDByName( string $Name,int $ParentID ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetInstanceIDByName( $Name,$ParentID );
}

/**
* IPS_GetInstanceList
* 
* @returns array
*/

function IPS_GetInstanceList(  ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetInstanceList(  );
}

/**
* IPS_GetInstanceListByModuleID
* 
* @returns array
* @param string $ModuleID
*/

function IPS_GetInstanceListByModuleID( string $ModuleID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetInstanceListByModuleID( $ModuleID );
}

/**
* IPS_GetInstanceListByModuleType
* 
* @returns array
* @param int $ModuleType
*   enum[0=mtCore, 1=mtIO, 2=mtSplitter, 3=mtDevice, 4=mtConfigurator, 5=mtDiscovery, 6=mtVisualization]
*/

function IPS_GetInstanceListByModuleType( int $ModuleType ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetInstanceListByModuleType( $ModuleType );
}

/**
* IPS_GetInstanceMessageQueueSize
* 
* @returns int
*/

function IPS_GetInstanceMessageQueueSize(  ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetInstanceMessageQueueSize(  );
}

/**
* IPS_GetInstanceMessageStatistics
* 
* @returns array
*/

function IPS_GetInstanceMessageStatistics(  ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetInstanceMessageStatistics(  );
}

/**
* IPS_GetKernelArchitecture
* 
* @returns string
*/

function IPS_GetKernelArchitecture(  ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetKernelArchitecture(  );
}

/**
* IPS_GetKernelDate
* 
* @returns int
*/

function IPS_GetKernelDate(  ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetKernelDate(  );
}

/**
* IPS_GetKernelDir
* 
* @returns string
*/

function IPS_GetKernelDir(  ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetKernelDir(  );
}

/**
* IPS_GetKernelDirEx
* 
* @returns string
*/

function IPS_GetKernelDirEx(  ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetKernelDirEx(  );
}

/**
* IPS_GetKernelDirSpace
* 
* @returns array
*/

function IPS_GetKernelDirSpace(  ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetKernelDirSpace(  );
}

/**
* IPS_GetKernelPlatform
* 
* @returns string
*/

function IPS_GetKernelPlatform(  ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetKernelPlatform(  );
}

/**
* IPS_GetKernelRevision
* 
* @returns string
*/

function IPS_GetKernelRevision(  ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetKernelRevision(  );
}

/**
* IPS_GetKernelRunlevel
* 
* @returns int
*/

function IPS_GetKernelRunlevel(  ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetKernelRunlevel(  );
}

/**
* IPS_GetKernelStartTime
* 
* @returns int
*/

function IPS_GetKernelStartTime(  ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetKernelStartTime(  );
}

/**
* IPS_GetKernelVersion
* 
* @returns string
*/

function IPS_GetKernelVersion(  ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetKernelVersion(  );
}

/**
* IPS_GetLibraries
* 
* @returns array
* @param array $LibraryIDs
*/

function IPS_GetLibraries( array $LibraryIDs ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetLibraries( $LibraryIDs );
}

/**
* IPS_GetLibrary
* 
* @returns array
* @param string $LibraryID
*/

function IPS_GetLibrary( string $LibraryID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetLibrary( $LibraryID );
}

/**
* IPS_GetLibraryList
* 
* @returns array
*/

function IPS_GetLibraryList(  ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetLibraryList(  );
}

/**
* IPS_GetLibraryModules
* 
* @returns array
* @param string $LibraryID
*/

function IPS_GetLibraryModules( string $LibraryID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetLibraryModules( $LibraryID );
}

/**
* IPS_GetLicensee
* 
* @returns string
*/

function IPS_GetLicensee(  ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetLicensee(  );
}

/**
* IPS_GetLimitDemo
* 
* @returns int
*/

function IPS_GetLimitDemo(  ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetLimitDemo(  );
}

/**
* IPS_GetLimitFeatures
* 
* @returns array
*/

function IPS_GetLimitFeatures(  ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetLimitFeatures(  );
}

/**
* IPS_GetLimitServer
* 
* @returns string
*/

function IPS_GetLimitServer(  ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetLimitServer(  );
}

/**
* IPS_GetLimitVariables
* 
* @returns int
*/

function IPS_GetLimitVariables(  ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetLimitVariables(  );
}

/**
* IPS_GetLimitWebFront
* 
* @returns int
*/

function IPS_GetLimitWebFront(  ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetLimitWebFront(  );
}

/**
* IPS_GetLink
* 
* @returns array
* @param int $LinkID
*/

function IPS_GetLink( int $LinkID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetLink( $LinkID );
}

/**
* IPS_GetLinkIDByName
* 
* @returns int
* @param string $Name
* @param int $ParentID
*/

function IPS_GetLinkIDByName( string $Name,int $ParentID ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetLinkIDByName( $Name,$ParentID );
}

/**
* IPS_GetLinkList
* 
* @returns array
*/

function IPS_GetLinkList(  ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetLinkList(  );
}

/**
* IPS_GetLiveUpdateVersion
* 
* @returns string
*/

function IPS_GetLiveUpdateVersion(  ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetLiveUpdateVersion(  );
}

/**
* IPS_GetLocation
* 
* @returns string
* @param int $ID
*/

function IPS_GetLocation( int $ID ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetLocation( $ID );
}

/**
* IPS_GetLogDir
* 
* @returns string
*/

function IPS_GetLogDir(  ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetLogDir(  );
}

/**
* IPS_GetMedia
* 
* @returns array
* @param int $MediaID
*/

function IPS_GetMedia( int $MediaID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetMedia( $MediaID );
}

/**
* IPS_GetMediaContent
* 
* @returns string
* @param int $MediaID
*/

function IPS_GetMediaContent( int $MediaID ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetMediaContent( $MediaID );
}

/**
* IPS_GetMediaIDByFile
* 
* @returns int
* @param string $FilePath
*/

function IPS_GetMediaIDByFile( string $FilePath ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetMediaIDByFile( $FilePath );
}

/**
* IPS_GetMediaIDByName
* 
* @returns int
* @param string $Name
* @param int $ParentID
*/

function IPS_GetMediaIDByName( string $Name,int $ParentID ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetMediaIDByName( $Name,$ParentID );
}

/**
* IPS_GetMediaList
* 
* @returns array
*/

function IPS_GetMediaList(  ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetMediaList(  );
}

/**
* IPS_GetMediaListByType
* 
* @returns array
* @param int $MediaType
*   enum[0=mtIPSView, 1=mtImage, 2=mtSound, 3=mtStream, 4=mtChart, 5=mtDocument]
*/

function IPS_GetMediaListByType( int $MediaType ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetMediaListByType( $MediaType );
}

/**
* IPS_GetModule
* 
* @returns array
* @param string $ModuleID
*/

function IPS_GetModule( string $ModuleID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetModule( $ModuleID );
}

/**
* IPS_GetModuleList
* 
* @returns array
*/

function IPS_GetModuleList(  ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetModuleList(  );
}

/**
* IPS_GetModuleListByType
* 
* @returns array
* @param int $ModuleType
*   enum[0=mtCore, 1=mtIO, 2=mtSplitter, 3=mtDevice, 4=mtConfigurator, 5=mtDiscovery, 6=mtVisualization]
*/

function IPS_GetModuleListByType( int $ModuleType ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetModuleListByType( $ModuleType );
}

/**
* IPS_GetModules
* 
* @returns array
* @param array $ModuleIDs
*/

function IPS_GetModules( array $ModuleIDs ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetModules( $ModuleIDs );
}

/**
* IPS_GetName
* 
* @returns string
* @param int $ID
*/

function IPS_GetName( int $ID ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetName( $ID );
}

/**
* IPS_GetObject
* 
* @returns array
* @param int $ID
*/

function IPS_GetObject( int $ID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetObject( $ID );
}

/**
* IPS_GetObjectIDByIdent
* 
* @returns int
* @param string $Ident
* @param int $ParentID
*/

function IPS_GetObjectIDByIdent( string $Ident,int $ParentID ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetObjectIDByIdent( $Ident,$ParentID );
}

/**
* IPS_GetObjectIDByName
* 
* @returns int
* @param string $Name
* @param int $ParentID
*/

function IPS_GetObjectIDByName( string $Name,int $ParentID ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetObjectIDByName( $Name,$ParentID );
}

/**
* IPS_GetObjectList
* 
* @returns array
*/

function IPS_GetObjectList(  ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetObjectList(  );
}

/**
* IPS_GetOption
* 
* @returns mixed
* @param string $Option
*/

function IPS_GetOption( string $Option ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetOption( $Option );
}

/**
* IPS_GetOptionEx
* 
* @returns array
* @param string $Option
*/

function IPS_GetOptionEx( string $Option ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetOptionEx( $Option );
}

/**
* IPS_GetOptionList
* 
* @returns array
*/

function IPS_GetOptionList(  ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetOptionList(  );
}

/**
* IPS_GetParent
* 
* @returns int
* @param int $ID
*/

function IPS_GetParent( int $ID ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetParent( $ID );
}

/**
* IPS_GetProperty
* 
* @returns mixed
* @param int $InstanceID
* @param string $Name
*/

function IPS_GetProperty( int $InstanceID,string $Name ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetProperty( $InstanceID,$Name );
}

/**
* IPS_GetReferenceList
* 
* @returns array
* @param int $InstanceID
*/

function IPS_GetReferenceList( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetReferenceList( $InstanceID );
}

/**
* IPS_GetReplicationConfiguration
* 
* @returns string
*/

function IPS_GetReplicationConfiguration(  ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetReplicationConfiguration(  );
}

/**
* IPS_GetReplicationSyncTime
* 
* @returns int
*/

function IPS_GetReplicationSyncTime(  ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetReplicationSyncTime(  );
}

/**
* IPS_GetScript
* 
* @returns array
* @param int $ScriptID
*/

function IPS_GetScript( int $ScriptID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetScript( $ScriptID );
}

/**
* IPS_GetScriptContent
* 
* @returns string
* @param int $ScriptID
*/

function IPS_GetScriptContent( int $ScriptID ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetScriptContent( $ScriptID );
}

/**
* IPS_GetScriptEventList
* 
* @returns array
* @param int $ScriptID
*/

function IPS_GetScriptEventList( int $ScriptID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetScriptEventList( $ScriptID );
}

/**
* IPS_GetScriptFile
* 
* @returns string
* @param int $ScriptID
*/

function IPS_GetScriptFile( int $ScriptID ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetScriptFile( $ScriptID );
}

/**
* IPS_GetScriptIDByFile
* 
* @returns int
* @param string $FilePath
*/

function IPS_GetScriptIDByFile( string $FilePath ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetScriptIDByFile( $FilePath );
}

/**
* IPS_GetScriptIDByName
* 
* @returns int
* @param string $Name
* @param int $ParentID
*/

function IPS_GetScriptIDByName( string $Name,int $ParentID ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetScriptIDByName( $Name,$ParentID );
}

/**
* IPS_GetScriptList
* 
* @returns array
*/

function IPS_GetScriptList(  ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetScriptList(  );
}

/**
* IPS_GetScriptThread
* 
* @returns array
* @param int $ThreadID
*/

function IPS_GetScriptThread( int $ThreadID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetScriptThread( $ThreadID );
}

/**
* IPS_GetScriptThreadList
* 
* @returns array
*/

function IPS_GetScriptThreadList(  ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetScriptThreadList(  );
}

/**
* IPS_GetScriptThreads
* 
* @returns array
* @param array $ThreadIDs
*/

function IPS_GetScriptThreads( array $ThreadIDs ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetScriptThreads( $ThreadIDs );
}

/**
* IPS_GetScriptTimer
* 
* @returns int
* @param int $ScriptID
*/

function IPS_GetScriptTimer( int $ScriptID ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetScriptTimer( $ScriptID );
}

/**
* IPS_GetSecurityMode
* 
* @returns int
*/

function IPS_GetSecurityMode(  ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetSecurityMode(  );
}

/**
* IPS_GetSnapshot
* 
* @returns array
*/

function IPS_GetSnapshot(  ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetSnapshot(  );
}

/**
* IPS_GetSnapshotChanges
* 
* @returns array
* @param int $LastTimestamp
*/

function IPS_GetSnapshotChanges( int $LastTimestamp ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetSnapshotChanges( $LastTimestamp );
}

/**
* IPS_GetSubscriptionExpiration
* 
* @returns int
*/

function IPS_GetSubscriptionExpiration(  ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetSubscriptionExpiration(  );
}

/**
* IPS_GetSystemLanguage
* 
* @returns string
*/

function IPS_GetSystemLanguage(  ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetSystemLanguage(  );
}

/**
* IPS_GetTimer
* 
* @returns array
* @param int $TimerID
*/

function IPS_GetTimer( int $TimerID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetTimer( $TimerID );
}

/**
* IPS_GetTimerList
* 
* @returns array
*/

function IPS_GetTimerList(  ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetTimerList(  );
}

/**
* IPS_GetTimers
* 
* @returns array
* @param array $TimerIDs
*/

function IPS_GetTimers( array $TimerIDs ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetTimers( $TimerIDs );
}

/**
* IPS_GetUpdateChannel
* 
* @returns string
*/

function IPS_GetUpdateChannel(  ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetUpdateChannel(  );
}

/**
* IPS_GetVariable
* 
* @returns array
* @param int $VariableID
*/

function IPS_GetVariable( int $VariableID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetVariable( $VariableID );
}

/**
* IPS_GetVariableEventList
* 
* @returns array
* @param int $VariableID
*/

function IPS_GetVariableEventList( int $VariableID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetVariableEventList( $VariableID );
}

/**
* IPS_GetVariableIDByName
* 
* @returns int
* @param string $Name
* @param int $ParentID
*/

function IPS_GetVariableIDByName( string $Name,int $ParentID ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetVariableIDByName( $Name,$ParentID );
}

/**
* IPS_GetVariableList
* 
* @returns array
*/

function IPS_GetVariableList(  ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetVariableList(  );
}

/**
* IPS_GetVariableProfile
* 
* @returns array
* @param string $ProfileName
*/

function IPS_GetVariableProfile( string $ProfileName ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetVariableProfile( $ProfileName );
}

/**
* IPS_GetVariableProfileList
* 
* @returns array
*/

function IPS_GetVariableProfileList(  ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetVariableProfileList(  );
}

/**
* IPS_GetVariableProfileListByType
* 
* @returns array
* @param int $ProfileType
*   enum[0=vtBoolean, 1=vtInteger, 2=vtFloat, 3=vtString]
*/

function IPS_GetVariableProfileListByType( int $ProfileType ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_GetVariableProfileListByType( $ProfileType );
}

/**
* IPS_HasChanges
* 
* @returns bool
* @param int $InstanceID
*/

function IPS_HasChanges( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_HasChanges( $InstanceID );
}

/**
* IPS_HasChildren
* 
* @returns bool
* @param int $ID
*/

function IPS_HasChildren( int $ID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_HasChildren( $ID );
}

/**
* IPS_InstanceExists
* 
* @returns bool
* @param int $InstanceID
*/

function IPS_InstanceExists( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_InstanceExists( $InstanceID );
}

/**
* IPS_IsChild
* 
* @returns bool
* @param int $ID
* @param int $ParentID
* @param bool $Recursive
*/

function IPS_IsChild( int $ID,int $ParentID,bool $Recursive ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_IsChild( $ID,$ParentID,$Recursive );
}

/**
* IPS_IsConditionPassing
* 
* @returns bool
* @param string $Conditions
*/

function IPS_IsConditionPassing( string $Conditions ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_IsConditionPassing( $Conditions );
}

/**
* IPS_IsInstanceCompatible
* 
* @returns bool
* @param int $InstanceID
* @param int $ParentInstanceID
*/

function IPS_IsInstanceCompatible( int $InstanceID,int $ParentInstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_IsInstanceCompatible( $InstanceID,$ParentInstanceID );
}

/**
* IPS_IsLicenseChangePending
* 
* @returns bool
*/

function IPS_IsLicenseChangePending(  ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_IsLicenseChangePending(  );
}

/**
* IPS_IsModuleCompatible
* 
* @returns bool
* @param string $ModuleID
* @param string $ParentModuleID
*/

function IPS_IsModuleCompatible( string $ModuleID,string $ParentModuleID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_IsModuleCompatible( $ModuleID,$ParentModuleID );
}

/**
* IPS_IsReplicationActive
* 
* @returns bool
*/

function IPS_IsReplicationActive(  ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_IsReplicationActive(  );
}

/**
* IPS_IsReplicationMaster
* 
* @returns bool
*/

function IPS_IsReplicationMaster(  ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_IsReplicationMaster(  );
}

/**
* IPS_IsReplicationOnStandBy
* 
* @returns bool
*/

function IPS_IsReplicationOnStandBy(  ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_IsReplicationOnStandBy(  );
}

/**
* IPS_IsSearching
* 
* @returns bool
* @param int $InstanceID
*/

function IPS_IsSearching( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_IsSearching( $InstanceID );
}

/**
* IPS_LibraryExists
* 
* @returns bool
* @param string $LibraryID
*/

function IPS_LibraryExists( string $LibraryID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_LibraryExists( $LibraryID );
}

/**
* IPS_LinkExists
* 
* @returns bool
* @param int $LinkID
*/

function IPS_LinkExists( int $LinkID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_LinkExists( $LinkID );
}

/**
* IPS_LogMessage
* 
* @returns bool
* @param string $Sender
* @param string $Message
*/

function IPS_LogMessage( string $Sender,string $Message ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_LogMessage( $Sender,$Message );
}

/**
* IPS_MakeCrash
* 
* @returns bool
*/

function IPS_MakeCrash(  ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_MakeCrash(  );
}

/**
* IPS_MakeLeak
* 
* @returns bool
*/

function IPS_MakeLeak(  ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_MakeLeak(  );
}

/**
* IPS_MediaExists
* 
* @returns bool
* @param int $MediaID
*/

function IPS_MediaExists( int $MediaID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_MediaExists( $MediaID );
}

/**
* IPS_ModuleExists
* 
* @returns bool
* @param string $ModuleID
*/

function IPS_ModuleExists( string $ModuleID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_ModuleExists( $ModuleID );
}

/**
* IPS_ObjectExists
* 
* @returns bool
* @param int $ID
*/

function IPS_ObjectExists( int $ID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_ObjectExists( $ID );
}

/**
* IPS_RequestAction
* 
* @returns bool
* @param int $InstanceID
* @param string $VariableIdent
* @param mixed $Value
*/

function IPS_RequestAction( int $InstanceID,string $VariableIdent,mixed $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_RequestAction( $InstanceID,$VariableIdent,$Value );
}

/**
* IPS_ResetChanges
* 
* @returns bool
* @param int $InstanceID
*/

function IPS_ResetChanges( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_ResetChanges( $InstanceID );
}

/**
* IPS_RunAction
* 
* @returns bool
* @param string $ActionID
* @param array $Parameters
*/

function IPS_RunAction( string $ActionID,array $Parameters ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_RunAction( $ActionID,$Parameters );
}

/**
* IPS_RunActionWait
* 
* @returns string
* @param string $ActionID
* @param array $Parameters
*/

function IPS_RunActionWait( string $ActionID,array $Parameters ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_RunActionWait( $ActionID,$Parameters );
}

/**
* IPS_RunScript
* 
* @returns bool
* @param int $ScriptID
*/

function IPS_RunScript( int $ScriptID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_RunScript( $ScriptID );
}

/**
* IPS_RunScriptEx
* 
* @returns bool
* @param int $ScriptID
* @param array $Parameters
*/

function IPS_RunScriptEx( int $ScriptID,array $Parameters ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_RunScriptEx( $ScriptID,$Parameters );
}

/**
* IPS_RunScriptText
* 
* @returns bool
* @param string $ScriptText
*/

function IPS_RunScriptText( string $ScriptText ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_RunScriptText( $ScriptText );
}

/**
* IPS_RunScriptTextEx
* 
* @returns bool
* @param string $ScriptText
* @param array $Parameters
*/

function IPS_RunScriptTextEx( string $ScriptText,array $Parameters ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_RunScriptTextEx( $ScriptText,$Parameters );
}

/**
* IPS_RunScriptTextWait
* 
* @returns string
* @param string $ScriptText
*/

function IPS_RunScriptTextWait( string $ScriptText ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_RunScriptTextWait( $ScriptText );
}

/**
* IPS_RunScriptTextWaitEx
* 
* @returns string
* @param string $ScriptText
* @param array $Parameters
*/

function IPS_RunScriptTextWaitEx( string $ScriptText,array $Parameters ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_RunScriptTextWaitEx( $ScriptText,$Parameters );
}

/**
* IPS_RunScriptWait
* 
* @returns string
* @param int $ScriptID
*/

function IPS_RunScriptWait( int $ScriptID ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_RunScriptWait( $ScriptID );
}

/**
* IPS_RunScriptWaitEx
* 
* @returns string
* @param int $ScriptID
* @param array $Parameters
*/

function IPS_RunScriptWaitEx( int $ScriptID,array $Parameters ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_RunScriptWaitEx( $ScriptID,$Parameters );
}

/**
* IPS_ScriptExists
* 
* @returns bool
* @param int $ScriptID
*/

function IPS_ScriptExists( int $ScriptID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_ScriptExists( $ScriptID );
}

/**
* IPS_ScriptThreadExists
* 
* @returns bool
* @param int $ThreadID
*/

function IPS_ScriptThreadExists( int $ThreadID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_ScriptThreadExists( $ThreadID );
}

/**
* IPS_SemaphoreEnter
* 
* @returns bool
* @param string $Name
* @param int $Milliseconds
*/

function IPS_SemaphoreEnter( string $Name,int $Milliseconds ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SemaphoreEnter( $Name,$Milliseconds );
}

/**
* IPS_SemaphoreLeave
* 
* @returns bool
* @param string $Name
*/

function IPS_SemaphoreLeave( string $Name ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SemaphoreLeave( $Name );
}

/**
* IPS_SendDebug
* 
* @returns bool
* @param int $SenderID
* @param string $Message
* @param string $Data
* @param int $Format
*   enum[0=dfText, 1=dfBinary]
*/

function IPS_SendDebug( int $SenderID,string $Message,string $Data,int $Format ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SendDebug( $SenderID,$Message,$Data,$Format );
}

/**
* IPS_SendMediaEvent
* 
* @returns bool
* @param int $MediaID
*/

function IPS_SendMediaEvent( int $MediaID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SendMediaEvent( $MediaID );
}

/**
* IPS_SetConfiguration
* 
* @returns bool
* @param int $InstanceID
* @param string $Configuration
*/

function IPS_SetConfiguration( int $InstanceID,string $Configuration ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetConfiguration( $InstanceID,$Configuration );
}

/**
* IPS_SetDisabled
* 
* @returns bool
* @param int $ID
* @param bool $Disabled
*/

function IPS_SetDisabled( int $ID,bool $Disabled ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetDisabled( $ID,$Disabled );
}

/**
* IPS_SetEventAction
* 
* @returns bool
* @param int $EventID
* @param string $ActionID
* @param array $ActionParameters
*/

function IPS_SetEventAction( int $EventID,string $ActionID,array $ActionParameters ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetEventAction( $EventID,$ActionID,$ActionParameters );
}

/**
* IPS_SetEventActive
* 
* @returns bool
* @param int $EventID
* @param bool $Active
*/

function IPS_SetEventActive( int $EventID,bool $Active ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetEventActive( $EventID,$Active );
}

/**
* IPS_SetEventCondition
* 
* @returns bool
* @param int $EventID
* @param int $ConditionID
* @param int $ParentID
* @param int $Operation
*   enum[0=eoAND, 1=eoOR, 2=eoNAND, 3=eoNOR]
*/

function IPS_SetEventCondition( int $EventID,int $ConditionID,int $ParentID,int $Operation ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetEventCondition( $EventID,$ConditionID,$ParentID,$Operation );
}

/**
* IPS_SetEventConditionDateRule
* 
* @returns bool
* @param int $EventID
* @param int $ConditionID
* @param int $RuleID
* @param int $Comparison
*   enum[0=ecEqual, 1=ecNotEqual, 2=ecGreater, 3=ecGreaterOrEqual, 4=ecSmaller, 5=ecSmallerOrEqual]
* @param int $Day
* @param int $Month
* @param int $Year
*/

function IPS_SetEventConditionDateRule( int $EventID,int $ConditionID,int $RuleID,int $Comparison,int $Day,int $Month,int $Year ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetEventConditionDateRule( $EventID,$ConditionID,$RuleID,$Comparison,$Day,$Month,$Year );
}

/**
* IPS_SetEventConditionDayOfTheWeekRule
* 
* @returns bool
* @param int $EventID
* @param int $ConditionID
* @param int $RuleID
* @param int $Comparison
*   enum[0=ecEqual, 1=ecNotEqual, 2=ecGreater, 3=ecGreaterOrEqual, 4=ecSmaller, 5=ecSmallerOrEqual]
* @param int $Value
*/

function IPS_SetEventConditionDayOfTheWeekRule( int $EventID,int $ConditionID,int $RuleID,int $Comparison,int $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetEventConditionDayOfTheWeekRule( $EventID,$ConditionID,$RuleID,$Comparison,$Value );
}

/**
* IPS_SetEventConditionTimeRule
* 
* @returns bool
* @param int $EventID
* @param int $ConditionID
* @param int $RuleID
* @param int $Comparison
*   enum[0=ecEqual, 1=ecNotEqual, 2=ecGreater, 3=ecGreaterOrEqual, 4=ecSmaller, 5=ecSmallerOrEqual]
* @param int $Hour
* @param int $Minute
* @param int $Second
*/

function IPS_SetEventConditionTimeRule( int $EventID,int $ConditionID,int $RuleID,int $Comparison,int $Hour,int $Minute,int $Second ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetEventConditionTimeRule( $EventID,$ConditionID,$RuleID,$Comparison,$Hour,$Minute,$Second );
}

/**
* IPS_SetEventConditionVariableDynamicRule
* 
* @returns bool
* @param int $EventID
* @param int $ConditionID
* @param int $RuleID
* @param int $VariableID
* @param int $Comparison
*   enum[0=ecEqual, 1=ecNotEqual, 2=ecGreater, 3=ecGreaterOrEqual, 4=ecSmaller, 5=ecSmallerOrEqual]
* @param int $CompareVariableID
*/

function IPS_SetEventConditionVariableDynamicRule( int $EventID,int $ConditionID,int $RuleID,int $VariableID,int $Comparison,int $CompareVariableID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetEventConditionVariableDynamicRule( $EventID,$ConditionID,$RuleID,$VariableID,$Comparison,$CompareVariableID );
}

/**
* IPS_SetEventConditionVariableRule
* 
* @returns bool
* @param int $EventID
* @param int $ConditionID
* @param int $RuleID
* @param int $VariableID
* @param int $Comparison
*   enum[0=ecEqual, 1=ecNotEqual, 2=ecGreater, 3=ecGreaterOrEqual, 4=ecSmaller, 5=ecSmallerOrEqual]
* @param mixed $Value
*/

function IPS_SetEventConditionVariableRule( int $EventID,int $ConditionID,int $RuleID,int $VariableID,int $Comparison,mixed $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetEventConditionVariableRule( $EventID,$ConditionID,$RuleID,$VariableID,$Comparison,$Value );
}

/**
* IPS_SetEventConditionVariableStaticRule
* 
* @returns bool
* @param int $EventID
* @param int $ConditionID
* @param int $RuleID
* @param int $VariableID
* @param int $Comparison
*   enum[0=ecEqual, 1=ecNotEqual, 2=ecGreater, 3=ecGreaterOrEqual, 4=ecSmaller, 5=ecSmallerOrEqual]
* @param mixed $Value
*/

function IPS_SetEventConditionVariableStaticRule( int $EventID,int $ConditionID,int $RuleID,int $VariableID,int $Comparison,mixed $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetEventConditionVariableStaticRule( $EventID,$ConditionID,$RuleID,$VariableID,$Comparison,$Value );
}

/**
* IPS_SetEventCyclic
* 
* @returns bool
* @param int $EventID
* @param int $DateType
*   enum[0=cdtNone, 1=cdtOnce, 2=cdtDay, 3=cdtWeek, 4=cdtMonth, 5=cdtYear]
* @param int $DateValue
* @param int $DateDay
* @param int $DateDayValue
* @param int $TimeType
*   enum[0=cttOnce, 1=cttSecond, 2=cttMinute, 3=cttHour]
* @param int $TimeValue
*/

function IPS_SetEventCyclic( int $EventID,int $DateType,int $DateValue,int $DateDay,int $DateDayValue,int $TimeType,int $TimeValue ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetEventCyclic( $EventID,$DateType,$DateValue,$DateDay,$DateDayValue,$TimeType,$TimeValue );
}

/**
* IPS_SetEventCyclicDateFrom
* 
* @returns bool
* @param int $EventID
* @param int $Day
* @param int $Month
* @param int $Year
*/

function IPS_SetEventCyclicDateFrom( int $EventID,int $Day,int $Month,int $Year ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetEventCyclicDateFrom( $EventID,$Day,$Month,$Year );
}

/**
* IPS_SetEventCyclicDateTo
* 
* @returns bool
* @param int $EventID
* @param int $Day
* @param int $Month
* @param int $Year
*/

function IPS_SetEventCyclicDateTo( int $EventID,int $Day,int $Month,int $Year ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetEventCyclicDateTo( $EventID,$Day,$Month,$Year );
}

/**
* IPS_SetEventCyclicTimeFrom
* 
* @returns bool
* @param int $EventID
* @param int $Hour
* @param int $Minute
* @param int $Second
*/

function IPS_SetEventCyclicTimeFrom( int $EventID,int $Hour,int $Minute,int $Second ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetEventCyclicTimeFrom( $EventID,$Hour,$Minute,$Second );
}

/**
* IPS_SetEventCyclicTimeTo
* 
* @returns bool
* @param int $EventID
* @param int $Hour
* @param int $Minute
* @param int $Second
*/

function IPS_SetEventCyclicTimeTo( int $EventID,int $Hour,int $Minute,int $Second ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetEventCyclicTimeTo( $EventID,$Hour,$Minute,$Second );
}

/**
* IPS_SetEventLimit
* 
* @returns bool
* @param int $EventID
* @param int $Count
*/

function IPS_SetEventLimit( int $EventID,int $Count ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetEventLimit( $EventID,$Count );
}

/**
* IPS_SetEventScheduleAction
* 
* @returns bool
* @param int $EventID
* @param int $ScheduleActionID
* @param string $Name
* @param int $Color
* @param string $ScriptText
*/

function IPS_SetEventScheduleAction( int $EventID,int $ScheduleActionID,string $Name,int $Color,string $ScriptText ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetEventScheduleAction( $EventID,$ScheduleActionID,$Name,$Color,$ScriptText );
}

/**
* IPS_SetEventScheduleActionEx
* 
* @returns bool
* @param int $EventID
* @param int $ScheduleActionID
* @param string $Name
* @param int $Color
* @param string $ActionID
* @param array $ActionParameters
*/

function IPS_SetEventScheduleActionEx( int $EventID,int $ScheduleActionID,string $Name,int $Color,string $ActionID,array $ActionParameters ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetEventScheduleActionEx( $EventID,$ScheduleActionID,$Name,$Color,$ActionID,$ActionParameters );
}

/**
* IPS_SetEventScheduleGroup
* 
* @returns bool
* @param int $EventID
* @param int $GroupID
* @param int $Days
*/

function IPS_SetEventScheduleGroup( int $EventID,int $GroupID,int $Days ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetEventScheduleGroup( $EventID,$GroupID,$Days );
}

/**
* IPS_SetEventScheduleGroupPoint
* 
* @returns bool
* @param int $EventID
* @param int $GroupID
* @param int $PointID
* @param int $StartHour
* @param int $StartMinute
* @param int $StartSecond
* @param int $ActionID
*/

function IPS_SetEventScheduleGroupPoint( int $EventID,int $GroupID,int $PointID,int $StartHour,int $StartMinute,int $StartSecond,int $ActionID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetEventScheduleGroupPoint( $EventID,$GroupID,$PointID,$StartHour,$StartMinute,$StartSecond,$ActionID );
}

/**
* IPS_SetEventScript
* 
* @returns bool
* @param int $EventID
* @param string $EventScript
*/

function IPS_SetEventScript( int $EventID,string $EventScript ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetEventScript( $EventID,$EventScript );
}

/**
* IPS_SetEventTrigger
* 
* @returns bool
* @param int $EventID
* @param int $TriggerType
*   enum[0=evtOnUpdate, 1=evtOnChange, 2=evtOnLimitExceed, 3=evtOnLimitDrop, 4=evtOnValue]
* @param int $TriggerVariableID
*/

function IPS_SetEventTrigger( int $EventID,int $TriggerType,int $TriggerVariableID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetEventTrigger( $EventID,$TriggerType,$TriggerVariableID );
}

/**
* IPS_SetEventTriggerSubsequentExecution
* 
* @returns bool
* @param int $EventID
* @param bool $AllowSubsequentExecutions
*/

function IPS_SetEventTriggerSubsequentExecution( int $EventID,bool $AllowSubsequentExecutions ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetEventTriggerSubsequentExecution( $EventID,$AllowSubsequentExecutions );
}

/**
* IPS_SetEventTriggerValue
* 
* @returns bool
* @param int $EventID
* @param mixed $TriggerValue
*/

function IPS_SetEventTriggerValue( int $EventID,mixed $TriggerValue ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetEventTriggerValue( $EventID,$TriggerValue );
}

/**
* IPS_SetHidden
* 
* @returns bool
* @param int $ID
* @param bool $Hidden
*/

function IPS_SetHidden( int $ID,bool $Hidden ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetHidden( $ID,$Hidden );
}

/**
* IPS_SetIcon
* 
* @returns bool
* @param int $ID
* @param string $Icon
*/

function IPS_SetIcon( int $ID,string $Icon ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetIcon( $ID,$Icon );
}

/**
* IPS_SetIdent
* 
* @returns bool
* @param int $ID
* @param string $Ident
*/

function IPS_SetIdent( int $ID,string $Ident ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetIdent( $ID,$Ident );
}

/**
* IPS_SetInfo
* 
* @returns bool
* @param int $ID
* @param string $Info
*/

function IPS_SetInfo( int $ID,string $Info ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetInfo( $ID,$Info );
}

/**
* IPS_SetLicense
* 
* @returns bool
* @param string $Licensee
* @param string $LicenseContent
*/

function IPS_SetLicense( string $Licensee,string $LicenseContent ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetLicense( $Licensee,$LicenseContent );
}

/**
* IPS_SetLinkTargetID
* 
* @returns bool
* @param int $LinkID
* @param int $TargetID
*/

function IPS_SetLinkTargetID( int $LinkID,int $TargetID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetLinkTargetID( $LinkID,$TargetID );
}

/**
* IPS_SetMediaCached
* 
* @returns bool
* @param int $MediaID
* @param bool $Cached
*/

function IPS_SetMediaCached( int $MediaID,bool $Cached ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetMediaCached( $MediaID,$Cached );
}

/**
* IPS_SetMediaContent
* 
* @returns bool
* @param int $MediaID
* @param string $Content
*/

function IPS_SetMediaContent( int $MediaID,string $Content ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetMediaContent( $MediaID,$Content );
}

/**
* IPS_SetMediaFile
* 
* @returns bool
* @param int $MediaID
* @param string $FilePath
* @param bool $FileMustExists
*/

function IPS_SetMediaFile( int $MediaID,string $FilePath,bool $FileMustExists ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetMediaFile( $MediaID,$FilePath,$FileMustExists );
}

/**
* IPS_SetName
* 
* @returns bool
* @param int $ID
* @param string $Name
*/

function IPS_SetName( int $ID,string $Name ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetName( $ID,$Name );
}

/**
* IPS_SetOption
* 
* @returns bool
* @param string $Option
* @param mixed $Value
*/

function IPS_SetOption( string $Option,mixed $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetOption( $Option,$Value );
}

/**
* IPS_SetParent
* 
* @returns bool
* @param int $ID
* @param int $ParentID
*/

function IPS_SetParent( int $ID,int $ParentID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetParent( $ID,$ParentID );
}

/**
* IPS_SetPosition
* 
* @returns bool
* @param int $ID
* @param int $Position
*/

function IPS_SetPosition( int $ID,int $Position ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetPosition( $ID,$Position );
}

/**
* IPS_SetProperty
* 
* @returns bool
* @param int $InstanceID
* @param string $Name
* @param mixed $Value
*/

function IPS_SetProperty( int $InstanceID,string $Name,mixed $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetProperty( $InstanceID,$Name,$Value );
}

/**
* IPS_SetReplicationConfiguration
* 
* @returns bool
* @param string $Configuration
*/

function IPS_SetReplicationConfiguration( string $Configuration ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetReplicationConfiguration( $Configuration );
}

/**
* IPS_SetScriptContent
* 
* @returns bool
* @param int $ScriptID
* @param string $Content
*/

function IPS_SetScriptContent( int $ScriptID,string $Content ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetScriptContent( $ScriptID,$Content );
}

/**
* IPS_SetScriptFile
* 
* @returns bool
* @param int $ScriptID
* @param string $FilePath
*/

function IPS_SetScriptFile( int $ScriptID,string $FilePath ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetScriptFile( $ScriptID,$FilePath );
}

/**
* IPS_SetScriptTimer
* 
* @returns bool
* @param int $ScriptID
* @param int $Interval
*/

function IPS_SetScriptTimer( int $ScriptID,int $Interval ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetScriptTimer( $ScriptID,$Interval );
}

/**
* IPS_SetSecurity
* 
* @returns bool
* @param int $Mode
* @param string $Password
*/

function IPS_SetSecurity( int $Mode,string $Password ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetSecurity( $Mode,$Password );
}

/**
* IPS_SetVariableCustomAction
* 
* @returns bool
* @param int $VariableID
* @param int $ScriptID
*/

function IPS_SetVariableCustomAction( int $VariableID,int $ScriptID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetVariableCustomAction( $VariableID,$ScriptID );
}

/**
* IPS_SetVariableCustomProfile
* 
* @returns bool
* @param int $VariableID
* @param string $ProfileName
*/

function IPS_SetVariableCustomProfile( int $VariableID,string $ProfileName ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetVariableCustomProfile( $VariableID,$ProfileName );
}

/**
* IPS_SetVariableProfileAssociation
* 
* @returns bool
* @param string $ProfileName
* @param mixed $AssociationValue
* @param string $AssociationName
* @param string $AssociationIcon
* @param int $AssociationColor
*/

function IPS_SetVariableProfileAssociation( string $ProfileName,mixed $AssociationValue,string $AssociationName,string $AssociationIcon,int $AssociationColor ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetVariableProfileAssociation( $ProfileName,$AssociationValue,$AssociationName,$AssociationIcon,$AssociationColor );
}

/**
* IPS_SetVariableProfileDigits
* 
* @returns bool
* @param string $ProfileName
* @param int $Digits
*/

function IPS_SetVariableProfileDigits( string $ProfileName,int $Digits ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetVariableProfileDigits( $ProfileName,$Digits );
}

/**
* IPS_SetVariableProfileIcon
* 
* @returns bool
* @param string $ProfileName
* @param string $Icon
*/

function IPS_SetVariableProfileIcon( string $ProfileName,string $Icon ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetVariableProfileIcon( $ProfileName,$Icon );
}

/**
* IPS_SetVariableProfileText
* 
* @returns bool
* @param string $ProfileName
* @param string $Prefix
* @param string $Suffix
*/

function IPS_SetVariableProfileText( string $ProfileName,string $Prefix,string $Suffix ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetVariableProfileText( $ProfileName,$Prefix,$Suffix );
}

/**
* IPS_SetVariableProfileValues
* 
* @returns bool
* @param string $ProfileName
* @param float $MinValue
* @param float $MaxValue
* @param float $StepSize
*/

function IPS_SetVariableProfileValues( string $ProfileName,float $MinValue,float $MaxValue,float $StepSize ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SetVariableProfileValues( $ProfileName,$MinValue,$MaxValue,$StepSize );
}

/**
* IPS_Sleep
* 
* @returns bool
* @param int $Milliseconds
*/

function IPS_Sleep( int $Milliseconds ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_Sleep( $Milliseconds );
}

/**
* IPS_StartSearch
* 
* @returns bool
* @param int $InstanceID
*/

function IPS_StartSearch( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_StartSearch( $InstanceID );
}

/**
* IPS_StopKernel
* 
* @returns bool
*/

function IPS_StopKernel(  ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_StopKernel(  );
}

/**
* IPS_StopSearch
* 
* @returns bool
* @param int $InstanceID
*/

function IPS_StopSearch( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_StopSearch( $InstanceID );
}

/**
* IPS_SupportsSearching
* 
* @returns bool
* @param int $InstanceID
*/

function IPS_SupportsSearching( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_SupportsSearching( $InstanceID );
}

/**
* IPS_TimerExists
* 
* @returns bool
* @param int $TimerID
*/

function IPS_TimerExists( int $TimerID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_TimerExists( $TimerID );
}

/**
* IPS_Translate
* 
* @returns string
* @param int $InstanceID
* @param string $Text
*/

function IPS_Translate( int $InstanceID,string $Text ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_Translate( $InstanceID,$Text );
}

/**
* IPS_TrimKernel
* 
* @returns bool
*/

function IPS_TrimKernel(  ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_TrimKernel(  );
}

/**
* IPS_UpdateFormField
* 
* @returns bool
* @param string $Name
* @param string $Parameter
* @param mixed $Value
* @param string $SessionID
*/

function IPS_UpdateFormField( string $Name,string $Parameter,mixed $Value,string $SessionID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_UpdateFormField( $Name,$Parameter,$Value,$SessionID );
}

/**
* IPS_UpdateSubscriptionExpiration
* 
* @returns bool
*/

function IPS_UpdateSubscriptionExpiration(  ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_UpdateSubscriptionExpiration(  );
}

/**
* IPS_VariableExists
* 
* @returns bool
* @param int $VariableID
*/

function IPS_VariableExists( int $VariableID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_VariableExists( $VariableID );
}

/**
* IPS_VariableProfileExists
* 
* @returns bool
* @param string $ProfileName
*/

function IPS_VariableProfileExists( string $ProfileName ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IPS_VariableProfileExists( $ProfileName );
}

/**
* IRT_ListButtons
* 
* @returns array
* @param int $InstanceID
* @param string $Remote
*/

function IRT_ListButtons( int $InstanceID,string $Remote ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IRT_ListButtons( $InstanceID,$Remote );
}

/**
* IRT_ListRemotes
* 
* @returns array
* @param int $InstanceID
*/

function IRT_ListRemotes( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IRT_ListRemotes( $InstanceID );
}

/**
* IRT_SendOnce
* 
* @returns bool
* @param int $InstanceID
* @param string $Remote
* @param string $Button
*/

function IRT_SendOnce( int $InstanceID,string $Remote,string $Button ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IRT_SendOnce( $InstanceID,$Remote,$Button );
}

/**
* IRT_UpdateFormButtons
* 
* @returns bool
* @param int $InstanceID
* @param string $Remote
*/

function IRT_UpdateFormButtons( int $InstanceID,string $Remote ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IRT_UpdateFormButtons( $InstanceID,$Remote );
}

/**
* IRT_UpdateFormRemotes
* 
* @returns bool
* @param int $InstanceID
*/

function IRT_UpdateFormRemotes( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->IRT_UpdateFormRemotes( $InstanceID );
}

/**
* KNX_DoWrite
* 
* @returns bool
* @param int $InstanceID
* @param mixed $Value
*/

function KNX_DoWrite( int $InstanceID,mixed $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_DoWrite( $InstanceID,$Value );
}

/**
* KNX_RenameVariables
* 
* @returns bool
* @param int $InstanceID
*/

function KNX_RenameVariables( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_RenameVariables( $InstanceID );
}

/**
* KNX_RequestStatus
* 
* @returns bool
* @param int $InstanceID
*/

function KNX_RequestStatus( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_RequestStatus( $InstanceID );
}

/**
* KNX_WriteDPT1
* 
* @returns bool
* @param int $InstanceID
* @param bool $B
*/

function KNX_WriteDPT1( int $InstanceID,bool $B ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT1( $InstanceID,$B );
}

/**
* KNX_WriteDPT10
* 
* @returns bool
* @param int $InstanceID
* @param int $WeekDay
* @param int $TimeOfDay
*/

function KNX_WriteDPT10( int $InstanceID,int $WeekDay,int $TimeOfDay ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT10( $InstanceID,$WeekDay,$TimeOfDay );
}

/**
* KNX_WriteDPT11
* 
* @returns bool
* @param int $InstanceID
* @param int $Date
*/

function KNX_WriteDPT11( int $InstanceID,int $Date ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT11( $InstanceID,$Date );
}

/**
* KNX_WriteDPT12
* 
* @returns bool
* @param int $InstanceID
* @param int $Value
*/

function KNX_WriteDPT12( int $InstanceID,int $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT12( $InstanceID,$Value );
}

/**
* KNX_WriteDPT13
* 
* @returns bool
* @param int $InstanceID
* @param int $Value
*/

function KNX_WriteDPT13( int $InstanceID,int $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT13( $InstanceID,$Value );
}

/**
* KNX_WriteDPT14
* 
* @returns bool
* @param int $InstanceID
* @param float $Value
*/

function KNX_WriteDPT14( int $InstanceID,float $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT14( $InstanceID,$Value );
}

/**
* KNX_WriteDPT15
* 
* @returns bool
* @param int $InstanceID
* @param int $D1
* @param int $D2
* @param int $D3
* @param int $D4
* @param int $D5
* @param int $D6
* @param bool $E
* @param bool $P
* @param bool $D
* @param bool $C
* @param int $Index
*/

function KNX_WriteDPT15( int $InstanceID,int $D1,int $D2,int $D3,int $D4,int $D5,int $D6,bool $E,bool $P,bool $D,bool $C,int $Index ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT15( $InstanceID,$D1,$D2,$D3,$D4,$D5,$D6,$E,$P,$D,$C,$Index );
}

/**
* KNX_WriteDPT16
* 
* @returns bool
* @param int $InstanceID
* @param string $Value
*/

function KNX_WriteDPT16( int $InstanceID,string $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT16( $InstanceID,$Value );
}

/**
* KNX_WriteDPT17
* 
* @returns bool
* @param int $InstanceID
* @param int $Value
*/

function KNX_WriteDPT17( int $InstanceID,int $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT17( $InstanceID,$Value );
}

/**
* KNX_WriteDPT18
* 
* @returns bool
* @param int $InstanceID
* @param bool $C
* @param int $SceneNumber
*/

function KNX_WriteDPT18( int $InstanceID,bool $C,int $SceneNumber ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT18( $InstanceID,$C,$SceneNumber );
}

/**
* KNX_WriteDPT19
* 
* @returns bool
* @param int $InstanceID
* @param int $Time
* @param int $WeekDay
* @param bool $F
* @param bool $WD
* @param bool $NWD
* @param bool $NY
* @param bool $ND
* @param bool $NDOW
* @param bool $NT
* @param bool $SUTI
* @param bool $CLQ
*/

function KNX_WriteDPT19( int $InstanceID,int $Time,int $WeekDay,bool $F,bool $WD,bool $NWD,bool $NY,bool $ND,bool $NDOW,bool $NT,bool $SUTI,bool $CLQ ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT19( $InstanceID,$Time,$WeekDay,$F,$WD,$NWD,$NY,$ND,$NDOW,$NT,$SUTI,$CLQ );
}

/**
* KNX_WriteDPT2
* 
* @returns bool
* @param int $InstanceID
* @param bool $C
* @param bool $V
*/

function KNX_WriteDPT2( int $InstanceID,bool $C,bool $V ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT2( $InstanceID,$C,$V );
}

/**
* KNX_WriteDPT20
* 
* @returns bool
* @param int $InstanceID
* @param int $Value
*/

function KNX_WriteDPT20( int $InstanceID,int $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT20( $InstanceID,$Value );
}

/**
* KNX_WriteDPT200
* 
* @returns bool
* @param int $InstanceID
* @param int $Z
* @param bool $B
*/

function KNX_WriteDPT200( int $InstanceID,int $Z,bool $B ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT200( $InstanceID,$Z,$B );
}

/**
* KNX_WriteDPT201
* 
* @returns bool
* @param int $InstanceID
* @param int $Z
* @param int $N
*/

function KNX_WriteDPT201( int $InstanceID,int $Z,int $N ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT201( $InstanceID,$Z,$N );
}

/**
* KNX_WriteDPT202
* 
* @returns bool
* @param int $InstanceID
* @param int $U
* @param int $Z
*/

function KNX_WriteDPT202( int $InstanceID,int $U,int $Z ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT202( $InstanceID,$U,$Z );
}

/**
* KNX_WriteDPT203
* 
* @returns bool
* @param int $InstanceID
* @param float $U
* @param int $Z
*/

function KNX_WriteDPT203( int $InstanceID,float $U,int $Z ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT203( $InstanceID,$U,$Z );
}

/**
* KNX_WriteDPT204
* 
* @returns bool
* @param int $InstanceID
* @param float $Value
* @param int $Z
*/

function KNX_WriteDPT204( int $InstanceID,float $Value,int $Z ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT204( $InstanceID,$Value,$Z );
}

/**
* KNX_WriteDPT205
* 
* @returns bool
* @param int $InstanceID
* @param float $Value
* @param int $Z
*/

function KNX_WriteDPT205( int $InstanceID,float $Value,int $Z ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT205( $InstanceID,$Value,$Z );
}

/**
* KNX_WriteDPT206
* 
* @returns bool
* @param int $InstanceID
* @param int $Time
* @param int $Mode
*/

function KNX_WriteDPT206( int $InstanceID,int $Time,int $Mode ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT206( $InstanceID,$Time,$Mode );
}

/**
* KNX_WriteDPT207
* 
* @returns bool
* @param int $InstanceID
* @param int $Value
* @param bool $Attr0
* @param bool $Attr1
* @param bool $Attr2
* @param bool $Attr3
* @param bool $Attr4
* @param bool $Attr5
* @param bool $Attr6
* @param bool $Attr7
*/

function KNX_WriteDPT207( int $InstanceID,int $Value,bool $Attr0,bool $Attr1,bool $Attr2,bool $Attr3,bool $Attr4,bool $Attr5,bool $Attr6,bool $Attr7 ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT207( $InstanceID,$Value,$Attr0,$Attr1,$Attr2,$Attr3,$Attr4,$Attr5,$Attr6,$Attr7 );
}

/**
* KNX_WriteDPT209
* 
* @returns bool
* @param int $InstanceID
* @param float $Temperature
* @param bool $Attr0
* @param bool $Attr1
* @param bool $Attr2
* @param bool $Attr3
* @param bool $Attr4
*/

function KNX_WriteDPT209( int $InstanceID,float $Temperature,bool $Attr0,bool $Attr1,bool $Attr2,bool $Attr3,bool $Attr4 ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT209( $InstanceID,$Temperature,$Attr0,$Attr1,$Attr2,$Attr3,$Attr4 );
}

/**
* KNX_WriteDPT21
* 
* @returns bool
* @param int $InstanceID
* @param bool $Bit0
* @param bool $Bit1
* @param bool $Bit2
* @param bool $Bit3
* @param bool $Bit4
* @param bool $Bit5
* @param bool $Bit6
* @param bool $Bit7
*/

function KNX_WriteDPT21( int $InstanceID,bool $Bit0,bool $Bit1,bool $Bit2,bool $Bit3,bool $Bit4,bool $Bit5,bool $Bit6,bool $Bit7 ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT21( $InstanceID,$Bit0,$Bit1,$Bit2,$Bit3,$Bit4,$Bit5,$Bit6,$Bit7 );
}

/**
* KNX_WriteDPT210
* 
* @returns bool
* @param int $InstanceID
* @param float $Temperature
* @param bool $Attr0
* @param bool $Attr1
* @param bool $Attr2
* @param bool $Attr3
* @param bool $Attr4
* @param bool $Attr5
* @param bool $Attr6
* @param bool $Attr7
* @param bool $Attr8
* @param bool $Attr9
* @param bool $Attr10
* @param bool $Attr11
*/

function KNX_WriteDPT210( int $InstanceID,float $Temperature,bool $Attr0,bool $Attr1,bool $Attr2,bool $Attr3,bool $Attr4,bool $Attr5,bool $Attr6,bool $Attr7,bool $Attr8,bool $Attr9,bool $Attr10,bool $Attr11 ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT210( $InstanceID,$Temperature,$Attr0,$Attr1,$Attr2,$Attr3,$Attr4,$Attr5,$Attr6,$Attr7,$Attr8,$Attr9,$Attr10,$Attr11 );
}

/**
* KNX_WriteDPT211
* 
* @returns bool
* @param int $InstanceID
* @param int $Demand
* @param int $ControllerMode
*/

function KNX_WriteDPT211( int $InstanceID,int $Demand,int $ControllerMode ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT211( $InstanceID,$Demand,$ControllerMode );
}

/**
* KNX_WriteDPT212
* 
* @returns bool
* @param int $InstanceID
* @param float $TempSetpoint1
* @param float $TempSetpoint2
* @param float $TempSetpoint3
*/

function KNX_WriteDPT212( int $InstanceID,float $TempSetpoint1,float $TempSetpoint2,float $TempSetpoint3 ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT212( $InstanceID,$TempSetpoint1,$TempSetpoint2,$TempSetpoint3 );
}

/**
* KNX_WriteDPT213
* 
* @returns bool
* @param int $InstanceID
* @param float $TempSetpoint1
* @param float $TempSetpoint2
* @param float $TempSetpoint3
* @param float $TempSetpoint4
*/

function KNX_WriteDPT213( int $InstanceID,float $TempSetpoint1,float $TempSetpoint2,float $TempSetpoint3,float $TempSetpoint4 ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT213( $InstanceID,$TempSetpoint1,$TempSetpoint2,$TempSetpoint3,$TempSetpoint4 );
}

/**
* KNX_WriteDPT214
* 
* @returns bool
* @param int $InstanceID
* @param float $Temperature
* @param int $Demand
* @param bool $Attr0
* @param bool $Attr1
* @param bool $Attr2
* @param bool $Attr3
* @param bool $Attr4
* @param bool $Attr5
*/

function KNX_WriteDPT214( int $InstanceID,float $Temperature,int $Demand,bool $Attr0,bool $Attr1,bool $Attr2,bool $Attr3,bool $Attr4,bool $Attr5 ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT214( $InstanceID,$Temperature,$Demand,$Attr0,$Attr1,$Attr2,$Attr3,$Attr4,$Attr5 );
}

/**
* KNX_WriteDPT215
* 
* @returns bool
* @param int $InstanceID
* @param float $Temperature
* @param int $Power
* @param bool $Attr0
* @param bool $Attr1
* @param bool $Attr2
* @param bool $Attr3
* @param bool $Attr4
* @param bool $Attr5
* @param bool $Attr6
* @param bool $Attr7
* @param bool $Attr8
* @param bool $Attr9
* @param bool $Attr10
* @param bool $Attr11
*/

function KNX_WriteDPT215( int $InstanceID,float $Temperature,int $Power,bool $Attr0,bool $Attr1,bool $Attr2,bool $Attr3,bool $Attr4,bool $Attr5,bool $Attr6,bool $Attr7,bool $Attr8,bool $Attr9,bool $Attr10,bool $Attr11 ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT215( $InstanceID,$Temperature,$Power,$Attr0,$Attr1,$Attr2,$Attr3,$Attr4,$Attr5,$Attr6,$Attr7,$Attr8,$Attr9,$Attr10,$Attr11 );
}

/**
* KNX_WriteDPT216
* 
* @returns bool
* @param int $InstanceID
* @param int $Pnom
* @param int $BstageLimit
* @param int $BurnerType
* @param bool $OilSupport
* @param bool $GasSupport
* @param bool $SolidSupport
*/

function KNX_WriteDPT216( int $InstanceID,int $Pnom,int $BstageLimit,int $BurnerType,bool $OilSupport,bool $GasSupport,bool $SolidSupport ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT216( $InstanceID,$Pnom,$BstageLimit,$BurnerType,$OilSupport,$GasSupport,$SolidSupport );
}

/**
* KNX_WriteDPT217
* 
* @returns bool
* @param int $InstanceID
* @param int $Magic
* @param int $Version
* @param int $Revision
*/

function KNX_WriteDPT217( int $InstanceID,int $Magic,int $Version,int $Revision ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT217( $InstanceID,$Magic,$Version,$Revision );
}

/**
* KNX_WriteDPT218
* 
* @returns bool
* @param int $InstanceID
* @param float $Volume
* @param int $Z
*/

function KNX_WriteDPT218( int $InstanceID,float $Volume,int $Z ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT218( $InstanceID,$Volume,$Z );
}

/**
* KNX_WriteDPT219
* 
* @returns bool
* @param int $InstanceID
* @param int $LogNumber
* @param int $AlarmPriority
* @param int $ApplicationArea
* @param int $ErrorClass
* @param bool $Attribut0
* @param bool $Attribut1
* @param bool $Attribut2
* @param bool $Attribut3
* @param bool $AlarmStatus0
* @param bool $AlarmStatus1
* @param bool $AlarmStatus2
*/

function KNX_WriteDPT219( int $InstanceID,int $LogNumber,int $AlarmPriority,int $ApplicationArea,int $ErrorClass,bool $Attribut0,bool $Attribut1,bool $Attribut2,bool $Attribut3,bool $AlarmStatus0,bool $AlarmStatus1,bool $AlarmStatus2 ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT219( $InstanceID,$LogNumber,$AlarmPriority,$ApplicationArea,$ErrorClass,$Attribut0,$Attribut1,$Attribut2,$Attribut3,$AlarmStatus0,$AlarmStatus1,$AlarmStatus2 );
}

/**
* KNX_WriteDPT22
* 
* @returns bool
* @param int $InstanceID
* @param bool $Bit0
* @param bool $Bit1
* @param bool $Bit2
* @param bool $Bit3
* @param bool $Bit4
* @param bool $Bit5
* @param bool $Bit6
* @param bool $Bit7
* @param bool $Bit8
* @param bool $Bit9
* @param bool $Bit10
* @param bool $Bit11
* @param bool $Bit12
* @param bool $Bit13
* @param bool $Bit14
* @param bool $Bit15
*/

function KNX_WriteDPT22( int $InstanceID,bool $Bit0,bool $Bit1,bool $Bit2,bool $Bit3,bool $Bit4,bool $Bit5,bool $Bit6,bool $Bit7,bool $Bit8,bool $Bit9,bool $Bit10,bool $Bit11,bool $Bit12,bool $Bit13,bool $Bit14,bool $Bit15 ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT22( $InstanceID,$Bit0,$Bit1,$Bit2,$Bit3,$Bit4,$Bit5,$Bit6,$Bit7,$Bit8,$Bit9,$Bit10,$Bit11,$Bit12,$Bit13,$Bit14,$Bit15 );
}

/**
* KNX_WriteDPT220
* 
* @returns bool
* @param int $InstanceID
* @param int $DelayTime
* @param float $Temp
*/

function KNX_WriteDPT220( int $InstanceID,int $DelayTime,float $Temp ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT220( $InstanceID,$DelayTime,$Temp );
}

/**
* KNX_WriteDPT221
* 
* @returns bool
* @param int $InstanceID
* @param int $ManufacturerCode
* @param int $IncrementedNumber
*/

function KNX_WriteDPT221( int $InstanceID,int $ManufacturerCode,int $IncrementedNumber ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT221( $InstanceID,$ManufacturerCode,$IncrementedNumber );
}

/**
* KNX_WriteDPT222
* 
* @returns bool
* @param int $InstanceID
* @param float $Comfort
* @param float $Standby
* @param float $Economy
*/

function KNX_WriteDPT222( int $InstanceID,float $Comfort,float $Standby,float $Economy ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT222( $InstanceID,$Comfort,$Standby,$Economy );
}

/**
* KNX_WriteDPT223
* 
* @returns bool
* @param int $InstanceID
* @param int $EnergyDem
* @param int $ControllerMode
* @param int $EmergencyMode
*/

function KNX_WriteDPT223( int $InstanceID,int $EnergyDem,int $ControllerMode,int $EmergencyMode ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT223( $InstanceID,$EnergyDem,$ControllerMode,$EmergencyMode );
}

/**
* KNX_WriteDPT224
* 
* @returns bool
* @param int $InstanceID
* @param float $Cooling
* @param float $Heating
* @param int $ControllerMode
* @param int $EmergencyMode
*/

function KNX_WriteDPT224( int $InstanceID,float $Cooling,float $Heating,int $ControllerMode,int $EmergencyMode ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT224( $InstanceID,$Cooling,$Heating,$ControllerMode,$EmergencyMode );
}

/**
* KNX_WriteDPT225
* 
* @returns bool
* @param int $InstanceID
* @param int $Value0
* @param int $Value1
*/

function KNX_WriteDPT225( int $InstanceID,int $Value0,int $Value1 ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT225( $InstanceID,$Value0,$Value1 );
}

/**
* KNX_WriteDPT229
* 
* @returns bool
* @param int $InstanceID
* @param int $V
* @param int $Z
*/

function KNX_WriteDPT229( int $InstanceID,int $V,int $Z ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT229( $InstanceID,$V,$Z );
}

/**
* KNX_WriteDPT23
* 
* @returns bool
* @param int $InstanceID
* @param int $Value
*/

function KNX_WriteDPT23( int $InstanceID,int $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT23( $InstanceID,$Value );
}

/**
* KNX_WriteDPT230
* 
* @returns bool
* @param int $InstanceID
* @param int $ManufactID
* @param int $IdentNumber
* @param int $Version
* @param int $Medium
*/

function KNX_WriteDPT230( int $InstanceID,int $ManufactID,int $IdentNumber,int $Version,int $Medium ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT230( $InstanceID,$ManufactID,$IdentNumber,$Version,$Medium );
}

/**
* KNX_WriteDPT231
* 
* @returns bool
* @param int $InstanceID
* @param string $Language
* @param string $Region
*/

function KNX_WriteDPT231( int $InstanceID,string $Language,string $Region ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT231( $InstanceID,$Language,$Region );
}

/**
* KNX_WriteDPT232
* 
* @returns bool
* @param int $InstanceID
* @param int $R
* @param int $G
* @param int $B
*/

function KNX_WriteDPT232( int $InstanceID,int $R,int $G,int $B ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT232( $InstanceID,$R,$G,$B );
}

/**
* KNX_WriteDPT234
* 
* @returns bool
* @param int $InstanceID
* @param string $LanguageCode
*/

function KNX_WriteDPT234( int $InstanceID,string $LanguageCode ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT234( $InstanceID,$LanguageCode );
}

/**
* KNX_WriteDPT235
* 
* @returns bool
* @param int $InstanceID
* @param int $ActiveElectricalEnergy
* @param int $Tariff
* @param bool $E
* @param bool $T
*/

function KNX_WriteDPT235( int $InstanceID,int $ActiveElectricalEnergy,int $Tariff,bool $E,bool $T ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT235( $InstanceID,$ActiveElectricalEnergy,$Tariff,$E,$T );
}

/**
* KNX_WriteDPT236
* 
* @returns bool
* @param int $InstanceID
* @param bool $D
* @param int $P
* @param int $M
*/

function KNX_WriteDPT236( int $InstanceID,bool $D,int $P,int $M ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT236( $InstanceID,$D,$P,$M );
}

/**
* KNX_WriteDPT237
* 
* @returns bool
* @param int $InstanceID
* @param bool $CE
* @param bool $BF
* @param bool $LF
* @param bool $RR
* @param bool $AI
* @param int $Addr
*/

function KNX_WriteDPT237( int $InstanceID,bool $CE,bool $BF,bool $LF,bool $RR,bool $AI,int $Addr ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT237( $InstanceID,$CE,$BF,$LF,$RR,$AI,$Addr );
}

/**
* KNX_WriteDPT238
* 
* @returns bool
* @param int $InstanceID
* @param bool $B7
* @param bool $B6
* @param int $Value
*/

function KNX_WriteDPT238( int $InstanceID,bool $B7,bool $B6,int $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT238( $InstanceID,$B7,$B6,$Value );
}

/**
* KNX_WriteDPT239
* 
* @returns bool
* @param int $InstanceID
* @param int $SetValue
* @param bool $ChannelActivation
*/

function KNX_WriteDPT239( int $InstanceID,int $SetValue,bool $ChannelActivation ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT239( $InstanceID,$SetValue,$ChannelActivation );
}

/**
* KNX_WriteDPT240
* 
* @returns bool
* @param int $InstanceID
* @param int $HeightPos
* @param int $SlatsPos
* @param bool $ValidHeightPos
* @param bool $ValidSlatsPos
*/

function KNX_WriteDPT240( int $InstanceID,int $HeightPos,int $SlatsPos,bool $ValidHeightPos,bool $ValidSlatsPos ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT240( $InstanceID,$HeightPos,$SlatsPos,$ValidHeightPos,$ValidSlatsPos );
}

/**
* KNX_WriteDPT241
* 
* @returns bool
* @param int $InstanceID
* @param int $HeightPos
* @param int $SlatsPos
* @param bool $A
* @param bool $B
* @param bool $C
* @param bool $D
* @param bool $E
* @param bool $F
* @param bool $G
* @param bool $H
* @param bool $I
* @param bool $J
* @param bool $K
* @param bool $L
* @param bool $M
* @param bool $N
* @param bool $O
* @param bool $P
*/

function KNX_WriteDPT241( int $InstanceID,int $HeightPos,int $SlatsPos,bool $A,bool $B,bool $C,bool $D,bool $E,bool $F,bool $G,bool $H,bool $I,bool $J,bool $K,bool $L,bool $M,bool $N,bool $O,bool $P ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT241( $InstanceID,$HeightPos,$SlatsPos,$A,$B,$C,$D,$E,$F,$G,$H,$I,$J,$K,$L,$M,$N,$O,$P );
}

/**
* KNX_WriteDPT242
* 
* @returns bool
* @param int $InstanceID
* @param int $XAxis
* @param int $YAxis
* @param int $Brightness
* @param bool $C
* @param bool $B
*/

function KNX_WriteDPT242( int $InstanceID,int $XAxis,int $YAxis,int $Brightness,bool $C,bool $B ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT242( $InstanceID,$XAxis,$YAxis,$Brightness,$C,$B );
}

/**
* KNX_WriteDPT249
* 
* @returns bool
* @param int $InstanceID
* @param int $TimePeriod
* @param int $AbsoluteColourTemperature
* @param int $AbsoluteBrightness
* @param bool $B0
* @param bool $B1
* @param bool $B2
*/

function KNX_WriteDPT249( int $InstanceID,int $TimePeriod,int $AbsoluteColourTemperature,int $AbsoluteBrightness,bool $B0,bool $B1,bool $B2 ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT249( $InstanceID,$TimePeriod,$AbsoluteColourTemperature,$AbsoluteBrightness,$B0,$B1,$B2 );
}

/**
* KNX_WriteDPT25
* 
* @returns bool
* @param int $InstanceID
* @param int $Busy
* @param int $Nak
*/

function KNX_WriteDPT25( int $InstanceID,int $Busy,int $Nak ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT25( $InstanceID,$Busy,$Nak );
}

/**
* KNX_WriteDPT251
* 
* @returns bool
* @param int $InstanceID
* @param int $R
* @param int $G
* @param int $B
* @param int $W
* @param bool $ValidR
* @param bool $ValidG
* @param bool $ValidB
* @param bool $ValidW
*/

function KNX_WriteDPT251( int $InstanceID,int $R,int $G,int $B,int $W,bool $ValidR,bool $ValidG,bool $ValidB,bool $ValidW ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT251( $InstanceID,$R,$G,$B,$W,$ValidR,$ValidG,$ValidB,$ValidW );
}

/**
* KNX_WriteDPT26
* 
* @returns bool
* @param int $InstanceID
* @param int $SceneNumber
* @param bool $B
*/

function KNX_WriteDPT26( int $InstanceID,int $SceneNumber,bool $B ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT26( $InstanceID,$SceneNumber,$B );
}

/**
* KNX_WriteDPT27
* 
* @returns bool
* @param int $InstanceID
* @param bool $S0
* @param bool $S1
* @param bool $S2
* @param bool $S3
* @param bool $S4
* @param bool $S5
* @param bool $S6
* @param bool $S7
* @param bool $S8
* @param bool $S9
* @param bool $S10
* @param bool $S11
* @param bool $S12
* @param bool $S13
* @param bool $S14
* @param bool $S15
* @param bool $M0
* @param bool $M1
* @param bool $M2
* @param bool $M3
* @param bool $M4
* @param bool $M5
* @param bool $M6
* @param bool $M7
* @param bool $M8
* @param bool $M9
* @param bool $M10
* @param bool $M11
* @param bool $M12
* @param bool $M13
* @param bool $M14
* @param bool $M15
*/

function KNX_WriteDPT27( int $InstanceID,bool $S0,bool $S1,bool $S2,bool $S3,bool $S4,bool $S5,bool $S6,bool $S7,bool $S8,bool $S9,bool $S10,bool $S11,bool $S12,bool $S13,bool $S14,bool $S15,bool $M0,bool $M1,bool $M2,bool $M3,bool $M4,bool $M5,bool $M6,bool $M7,bool $M8,bool $M9,bool $M10,bool $M11,bool $M12,bool $M13,bool $M14,bool $M15 ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT27( $InstanceID,$S0,$S1,$S2,$S3,$S4,$S5,$S6,$S7,$S8,$S9,$S10,$S11,$S12,$S13,$S14,$S15,$M0,$M1,$M2,$M3,$M4,$M5,$M6,$M7,$M8,$M9,$M10,$M11,$M12,$M13,$M14,$M15 );
}

/**
* KNX_WriteDPT275
* 
* @returns bool
* @param int $InstanceID
* @param float $TempSetpoint1
* @param float $TempSetpoint2
* @param float $TempSetpoint3
* @param float $TempSetpoint4
*/

function KNX_WriteDPT275( int $InstanceID,float $TempSetpoint1,float $TempSetpoint2,float $TempSetpoint3,float $TempSetpoint4 ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT275( $InstanceID,$TempSetpoint1,$TempSetpoint2,$TempSetpoint3,$TempSetpoint4 );
}

/**
* KNX_WriteDPT29
* 
* @returns bool
* @param int $InstanceID
* @param int $Value
*/

function KNX_WriteDPT29( int $InstanceID,int $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT29( $InstanceID,$Value );
}

/**
* KNX_WriteDPT3
* 
* @returns bool
* @param int $InstanceID
* @param bool $C
* @param int $StepCode
*/

function KNX_WriteDPT3( int $InstanceID,bool $C,int $StepCode ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT3( $InstanceID,$C,$StepCode );
}

/**
* KNX_WriteDPT30
* 
* @returns bool
* @param int $InstanceID
* @param bool $Bit0
* @param bool $Bit1
* @param bool $Bit2
* @param bool $Bit3
* @param bool $Bit4
* @param bool $Bit5
* @param bool $Bit6
* @param bool $Bit7
* @param bool $Bit8
* @param bool $Bit9
* @param bool $Bit10
* @param bool $Bit11
* @param bool $Bit12
* @param bool $Bit13
* @param bool $Bit14
* @param bool $Bit15
* @param bool $Bit16
* @param bool $Bit17
* @param bool $Bit18
* @param bool $Bit19
* @param bool $Bit20
* @param bool $Bit21
* @param bool $Bit22
* @param bool $Bit23
*/

function KNX_WriteDPT30( int $InstanceID,bool $Bit0,bool $Bit1,bool $Bit2,bool $Bit3,bool $Bit4,bool $Bit5,bool $Bit6,bool $Bit7,bool $Bit8,bool $Bit9,bool $Bit10,bool $Bit11,bool $Bit12,bool $Bit13,bool $Bit14,bool $Bit15,bool $Bit16,bool $Bit17,bool $Bit18,bool $Bit19,bool $Bit20,bool $Bit21,bool $Bit22,bool $Bit23 ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT30( $InstanceID,$Bit0,$Bit1,$Bit2,$Bit3,$Bit4,$Bit5,$Bit6,$Bit7,$Bit8,$Bit9,$Bit10,$Bit11,$Bit12,$Bit13,$Bit14,$Bit15,$Bit16,$Bit17,$Bit18,$Bit19,$Bit20,$Bit21,$Bit22,$Bit23 );
}

/**
* KNX_WriteDPT31
* 
* @returns bool
* @param int $InstanceID
* @param int $Value
*/

function KNX_WriteDPT31( int $InstanceID,int $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT31( $InstanceID,$Value );
}

/**
* KNX_WriteDPT4
* 
* @returns bool
* @param int $InstanceID
* @param string $Value
*/

function KNX_WriteDPT4( int $InstanceID,string $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT4( $InstanceID,$Value );
}

/**
* KNX_WriteDPT5
* 
* @returns bool
* @param int $InstanceID
* @param int $U
*/

function KNX_WriteDPT5( int $InstanceID,int $U ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT5( $InstanceID,$U );
}

/**
* KNX_WriteDPT6
* 
* @returns bool
* @param int $InstanceID
* @param bool $A
* @param bool $B
* @param bool $C
* @param bool $D
* @param bool $E
* @param int $F
*/

function KNX_WriteDPT6( int $InstanceID,bool $A,bool $B,bool $C,bool $D,bool $E,int $F ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT6( $InstanceID,$A,$B,$C,$D,$E,$F );
}

/**
* KNX_WriteDPT7
* 
* @returns bool
* @param int $InstanceID
* @param int $Value
*/

function KNX_WriteDPT7( int $InstanceID,int $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT7( $InstanceID,$Value );
}

/**
* KNX_WriteDPT8
* 
* @returns bool
* @param int $InstanceID
* @param float $Value
*/

function KNX_WriteDPT8( int $InstanceID,float $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT8( $InstanceID,$Value );
}

/**
* KNX_WriteDPT9
* 
* @returns bool
* @param int $InstanceID
* @param float $Value
*/

function KNX_WriteDPT9( int $InstanceID,float $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->KNX_WriteDPT9( $InstanceID,$Value );
}

/**
* LCN_AddGroup
* 
* @returns bool
* @param int $InstanceID
* @param int $Group
*/

function LCN_AddGroup( int $InstanceID,int $Group ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->LCN_AddGroup( $InstanceID,$Group );
}

/**
* LCN_AddIntensity
* 
* @returns bool
* @param int $InstanceID
* @param int $Intensity
*/

function LCN_AddIntensity( int $InstanceID,int $Intensity ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->LCN_AddIntensity( $InstanceID,$Intensity );
}

/**
* LCN_AddThresholdCurrent
* 
* @returns bool
* @param int $InstanceID
* @param int $Register
* @param int $Threshold
* @param float $Value
*/

function LCN_AddThresholdCurrent( int $InstanceID,int $Register,int $Threshold,float $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->LCN_AddThresholdCurrent( $InstanceID,$Register,$Threshold,$Value );
}

/**
* LCN_AddThresholdDefined
* 
* @returns bool
* @param int $InstanceID
* @param int $Register
* @param int $Threshold
* @param float $Value
*/

function LCN_AddThresholdDefined( int $InstanceID,int $Register,int $Threshold,float $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->LCN_AddThresholdDefined( $InstanceID,$Register,$Threshold,$Value );
}

/**
* LCN_Beep
* 
* @returns bool
* @param int $InstanceID
* @param bool $SpecialTone
* @param int $Count
*/

function LCN_Beep( int $InstanceID,bool $SpecialTone,int $Count ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->LCN_Beep( $InstanceID,$SpecialTone,$Count );
}

/**
* LCN_DeductIntensity
* 
* @returns bool
* @param int $InstanceID
* @param int $Intensity
*/

function LCN_DeductIntensity( int $InstanceID,int $Intensity ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->LCN_DeductIntensity( $InstanceID,$Intensity );
}

/**
* LCN_DeductThresholdCurrent
* 
* @returns bool
* @param int $InstanceID
* @param int $Register
* @param int $Threshold
* @param float $Value
*/

function LCN_DeductThresholdCurrent( int $InstanceID,int $Register,int $Threshold,float $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->LCN_DeductThresholdCurrent( $InstanceID,$Register,$Threshold,$Value );
}

/**
* LCN_DeductThresholdDefined
* 
* @returns bool
* @param int $InstanceID
* @param int $Register
* @param int $Threshold
* @param float $Value
*/

function LCN_DeductThresholdDefined( int $InstanceID,int $Register,int $Threshold,float $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->LCN_DeductThresholdDefined( $InstanceID,$Register,$Threshold,$Value );
}

/**
* LCN_Fadeout
* 
* @returns bool
* @param int $InstanceID
* @param int $Intensity
* @param int $Ramp
*/

function LCN_Fadeout( int $InstanceID,int $Intensity,int $Ramp ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->LCN_Fadeout( $InstanceID,$Intensity,$Ramp );
}

/**
* LCN_FlipRelay
* 
* @returns bool
* @param int $InstanceID
*/

function LCN_FlipRelay( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->LCN_FlipRelay( $InstanceID );
}

/**
* LCN_GetKnownDevices
* 
* @returns array
* @param int $InstanceID
*/

function LCN_GetKnownDevices( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->LCN_GetKnownDevices( $InstanceID );
}

/**
* LCN_LimitOutput
* 
* @returns bool
* @param int $InstanceID
* @param int $Value
* @param int $Time
* @param string $TimeType
*/

function LCN_LimitOutput( int $InstanceID,int $Value,int $Time,string $TimeType ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->LCN_LimitOutput( $InstanceID,$Value,$Time,$TimeType );
}

/**
* LCN_LoadScene
* 
* @returns bool
* @param int $InstanceID
* @param int $Scene
*/

function LCN_LoadScene( int $InstanceID,int $Scene ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->LCN_LoadScene( $InstanceID,$Scene );
}

/**
* LCN_LockTargetValue
* 
* @returns bool
* @param int $InstanceID
* @param int $Target
*   enum[0=ltR1, 1=ltR2, 2=ltS1, 3=ltS2]
*/

function LCN_LockTargetValue( int $InstanceID,int $Target ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->LCN_LockTargetValue( $InstanceID,$Target );
}

/**
* LCN_RampStop
* 
* @returns bool
* @param int $InstanceID
*/

function LCN_RampStop( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->LCN_RampStop( $InstanceID );
}

/**
* LCN_ReleaseTargetValue
* 
* @returns bool
* @param int $InstanceID
* @param int $Target
*   enum[0=ltR1, 1=ltR2, 2=ltS1, 3=ltS2]
*/

function LCN_ReleaseTargetValue( int $InstanceID,int $Target ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->LCN_ReleaseTargetValue( $InstanceID,$Target );
}

/**
* LCN_RemoveGroup
* 
* @returns bool
* @param int $InstanceID
* @param int $Group
*/

function LCN_RemoveGroup( int $InstanceID,int $Group ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->LCN_RemoveGroup( $InstanceID,$Group );
}

/**
* LCN_RequestLights
* 
* @returns bool
* @param int $InstanceID
*/

function LCN_RequestLights( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->LCN_RequestLights( $InstanceID );
}

/**
* LCN_RequestRead
* 
* @returns bool
* @param int $InstanceID
*/

function LCN_RequestRead( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->LCN_RequestRead( $InstanceID );
}

/**
* LCN_RequestStatus
* 
* @returns bool
* @param int $InstanceID
*/

function LCN_RequestStatus( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->LCN_RequestStatus( $InstanceID );
}

/**
* LCN_RequestThresholds
* 
* @returns bool
* @param int $InstanceID
*/

function LCN_RequestThresholds( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->LCN_RequestThresholds( $InstanceID );
}

/**
* LCN_SaveScene
* 
* @returns bool
* @param int $InstanceID
* @param int $Scene
*/

function LCN_SaveScene( int $InstanceID,int $Scene ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->LCN_SaveScene( $InstanceID,$Scene );
}

/**
* LCN_SearchDevices
* 
* @returns bool
* @param int $InstanceID
* @param int $Segment
*/

function LCN_SearchDevices( int $InstanceID,int $Segment ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->LCN_SearchDevices( $InstanceID,$Segment );
}

/**
* LCN_SelectSceneRegister
* 
* @returns bool
* @param int $InstanceID
* @param int $Register
*/

function LCN_SelectSceneRegister( int $InstanceID,int $Register ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->LCN_SelectSceneRegister( $InstanceID,$Register );
}

/**
* LCN_SendCommand
* 
* @returns bool
* @param int $InstanceID
* @param string $Function
* @param string $Data
*/

function LCN_SendCommand( int $InstanceID,string $Function,string $Data ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->LCN_SendCommand( $InstanceID,$Function,$Data );
}

/**
* LCN_SetDisplayText
* 
* @returns bool
* @param int $InstanceID
* @param int $Row
* @param string $Text
*/

function LCN_SetDisplayText( int $InstanceID,int $Row,string $Text ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->LCN_SetDisplayText( $InstanceID,$Row,$Text );
}

/**
* LCN_SetDisplayTime
* 
* @returns bool
* @param int $InstanceID
* @param int $Row
* @param int $Duration
*/

function LCN_SetDisplayTime( int $InstanceID,int $Row,int $Duration ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->LCN_SetDisplayTime( $InstanceID,$Row,$Duration );
}

/**
* LCN_SetIntensity
* 
* @returns bool
* @param int $InstanceID
* @param int $Intensity
* @param int $Ramp
*/

function LCN_SetIntensity( int $InstanceID,int $Intensity,int $Ramp ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->LCN_SetIntensity( $InstanceID,$Intensity,$Ramp );
}

/**
* LCN_SetLamp
* 
* @returns bool
* @param int $InstanceID
* @param int $Lamp
* @param string $Action
*/

function LCN_SetLamp( int $InstanceID,int $Lamp,string $Action ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->LCN_SetLamp( $InstanceID,$Lamp,$Action );
}

/**
* LCN_SetRGBW
* 
* @returns bool
* @param int $InstanceID
* @param int $R
* @param int $G
* @param int $B
* @param int $W
*/

function LCN_SetRGBW( int $InstanceID,int $R,int $G,int $B,int $W ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->LCN_SetRGBW( $InstanceID,$R,$G,$B,$W );
}

/**
* LCN_SetRelay
* 
* @returns bool
* @param int $InstanceID
* @param string $Value
*/

function LCN_SetRelay( int $InstanceID,string $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->LCN_SetRelay( $InstanceID,$Value );
}

/**
* LCN_SetTargetValue
* 
* @returns bool
* @param int $InstanceID
* @param int $Target
*   enum[0=ltR1, 1=ltR2, 2=ltS1, 3=ltS2]
* @param float $Value
*/

function LCN_SetTargetValue( int $InstanceID,int $Target,float $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->LCN_SetTargetValue( $InstanceID,$Target,$Value );
}

/**
* LCN_ShiftTargetValue
* 
* @returns bool
* @param int $InstanceID
* @param int $Target
*   enum[0=ltR1, 1=ltR2, 2=ltS1, 3=ltS2]
* @param float $RelativeValue
*/

function LCN_ShiftTargetValue( int $InstanceID,int $Target,float $RelativeValue ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->LCN_ShiftTargetValue( $InstanceID,$Target,$RelativeValue );
}

/**
* LCN_ShutterMove
* 
* @returns bool
* @param int $InstanceID
* @param int $Position
*/

function LCN_ShutterMove( int $InstanceID,int $Position ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->LCN_ShutterMove( $InstanceID,$Position );
}

/**
* LCN_ShutterMoveDown
* 
* @returns bool
* @param int $InstanceID
*/

function LCN_ShutterMoveDown( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->LCN_ShutterMoveDown( $InstanceID );
}

/**
* LCN_ShutterMoveUp
* 
* @returns bool
* @param int $InstanceID
*/

function LCN_ShutterMoveUp( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->LCN_ShutterMoveUp( $InstanceID );
}

/**
* LCN_ShutterStop
* 
* @returns bool
* @param int $InstanceID
*/

function LCN_ShutterStop( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->LCN_ShutterStop( $InstanceID );
}

/**
* LCN_StartFlicker
* 
* @returns bool
* @param int $InstanceID
* @param string $Depth
* @param string $Speed
* @param int $Count
*/

function LCN_StartFlicker( int $InstanceID,string $Depth,string $Speed,int $Count ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->LCN_StartFlicker( $InstanceID,$Depth,$Speed,$Count );
}

/**
* LCN_StopFlicker
* 
* @returns bool
* @param int $InstanceID
*/

function LCN_StopFlicker( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->LCN_StopFlicker( $InstanceID );
}

/**
* LCN_SwitchDurationMin
* 
* @returns bool
* @param int $InstanceID
* @param int $Minutes
* @param string $Fadeout
* @param bool $Retentive
*/

function LCN_SwitchDurationMin( int $InstanceID,int $Minutes,string $Fadeout,bool $Retentive ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->LCN_SwitchDurationMin( $InstanceID,$Minutes,$Fadeout,$Retentive );
}

/**
* LCN_SwitchDurationSec
* 
* @returns bool
* @param int $InstanceID
* @param int $Seconds
* @param string $Fadeout
* @param bool $Retentive
*/

function LCN_SwitchDurationSec( int $InstanceID,int $Seconds,string $Fadeout,bool $Retentive ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->LCN_SwitchDurationSec( $InstanceID,$Seconds,$Fadeout,$Retentive );
}

/**
* LCN_SwitchMemory
* 
* @returns bool
* @param int $InstanceID
* @param int $Ramp
*/

function LCN_SwitchMemory( int $InstanceID,int $Ramp ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->LCN_SwitchMemory( $InstanceID,$Ramp );
}

/**
* LCN_SwitchMode
* 
* @returns bool
* @param int $InstanceID
* @param int $Ramp
*/

function LCN_SwitchMode( int $InstanceID,int $Ramp ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->LCN_SwitchMode( $InstanceID,$Ramp );
}

/**
* LCN_SwitchRelay
* 
* @returns bool
* @param int $InstanceID
* @param bool $SwitchOn
*/

function LCN_SwitchRelay( int $InstanceID,bool $SwitchOn ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->LCN_SwitchRelay( $InstanceID,$SwitchOn );
}

/**
* LCN_SwitchRelayTimer
* 
* @returns bool
* @param int $InstanceID
* @param int $Timerfactor
*/

function LCN_SwitchRelayTimer( int $InstanceID,int $Timerfactor ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->LCN_SwitchRelayTimer( $InstanceID,$Timerfactor );
}

/**
* MBUS_SearchDevices
* 
* @returns bool
* @param int $InstanceID
*/

function MBUS_SearchDevices( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MBUS_SearchDevices( $InstanceID );
}

/**
* MBUS_UpdateFormAddressing
* 
* @returns bool
* @param int $InstanceID
* @param bool $UseSecondaryAddress
*/

function MBUS_UpdateFormAddressing( int $InstanceID,bool $UseSecondaryAddress ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MBUS_UpdateFormAddressing( $InstanceID,$UseSecondaryAddress );
}

/**
* MBUS_UpdateValues
* 
* @returns bool
* @param int $InstanceID
*/

function MBUS_UpdateValues( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MBUS_UpdateValues( $InstanceID );
}

/**
* MC_CreateModule
* 
* @returns bool
* @param int $InstanceID
* @param string $ModuleURL
*/

function MC_CreateModule( int $InstanceID,string $ModuleURL ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MC_CreateModule( $InstanceID,$ModuleURL );
}

/**
* MC_DeleteModule
* 
* @returns bool
* @param int $InstanceID
* @param string $Module
*/

function MC_DeleteModule( int $InstanceID,string $Module ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MC_DeleteModule( $InstanceID,$Module );
}

/**
* MC_GetModule
* 
* @returns array
* @param int $InstanceID
* @param string $Module
*/

function MC_GetModule( int $InstanceID,string $Module ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MC_GetModule( $InstanceID,$Module );
}

/**
* MC_GetModuleList
* 
* @returns array
* @param int $InstanceID
*/

function MC_GetModuleList( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MC_GetModuleList( $InstanceID );
}

/**
* MC_GetModuleRepositoryInfo
* 
* @returns array
* @param int $InstanceID
* @param string $Module
*/

function MC_GetModuleRepositoryInfo( int $InstanceID,string $Module ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MC_GetModuleRepositoryInfo( $InstanceID,$Module );
}

/**
* MC_GetModuleRepositoryLocalBranchList
* 
* @returns array
* @param int $InstanceID
* @param string $Module
*/

function MC_GetModuleRepositoryLocalBranchList( int $InstanceID,string $Module ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MC_GetModuleRepositoryLocalBranchList( $InstanceID,$Module );
}

/**
* MC_GetModuleRepositoryRemoteBranchList
* 
* @returns array
* @param int $InstanceID
* @param string $Module
*/

function MC_GetModuleRepositoryRemoteBranchList( int $InstanceID,string $Module ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MC_GetModuleRepositoryRemoteBranchList( $InstanceID,$Module );
}

/**
* MC_IsModuleClean
* 
* @returns bool
* @param int $InstanceID
* @param string $Module
*/

function MC_IsModuleClean( int $InstanceID,string $Module ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MC_IsModuleClean( $InstanceID,$Module );
}

/**
* MC_IsModuleUpdateAvailable
* 
* @returns bool
* @param int $InstanceID
* @param string $Module
*/

function MC_IsModuleUpdateAvailable( int $InstanceID,string $Module ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MC_IsModuleUpdateAvailable( $InstanceID,$Module );
}

/**
* MC_IsModuleValid
* 
* @returns bool
* @param int $InstanceID
* @param string $Module
*/

function MC_IsModuleValid( int $InstanceID,string $Module ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MC_IsModuleValid( $InstanceID,$Module );
}

/**
* MC_ReloadModule
* 
* @returns bool
* @param int $InstanceID
* @param string $Module
*/

function MC_ReloadModule( int $InstanceID,string $Module ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MC_ReloadModule( $InstanceID,$Module );
}

/**
* MC_RevertModule
* 
* @returns bool
* @param int $InstanceID
* @param string $Module
*/

function MC_RevertModule( int $InstanceID,string $Module ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MC_RevertModule( $InstanceID,$Module );
}

/**
* MC_UpdateModule
* 
* @returns bool
* @param int $InstanceID
* @param string $Module
*/

function MC_UpdateModule( int $InstanceID,string $Module ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MC_UpdateModule( $InstanceID,$Module );
}

/**
* MC_UpdateModuleRepositoryBranch
* 
* @returns bool
* @param int $InstanceID
* @param string $Module
* @param string $Branch
*/

function MC_UpdateModuleRepositoryBranch( int $InstanceID,string $Module,string $Branch ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MC_UpdateModuleRepositoryBranch( $InstanceID,$Module,$Branch );
}

/**
* MQTTPUB_Publish
* 
* @returns mixed
* @param int $InstanceID
* @param int $id
*/

function MQTTPUB_Publish( int $InstanceID,int $id ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MQTTPUB_Publish( $InstanceID,$id );
}

/**
* MQTTPUB_Subscribe
* 
* @returns mixed
* @param int $InstanceID
* @param int $id
*/

function MQTTPUB_Subscribe( int $InstanceID,int $id ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MQTTPUB_Subscribe( $InstanceID,$id );
}

/**
* MQTTPUB_Subscribe_All
* 
* @returns mixed
* @param int $InstanceID
* @param int $id
* @param string $ident
*/

function MQTTPUB_Subscribe_All( int $InstanceID,int $id,string $ident ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MQTTPUB_Subscribe_All( $InstanceID,$id,$ident );
}

/**
* MQTTPUB_UnSubscribe
* 
* @returns mixed
* @param int $InstanceID
* @param int $id
*/

function MQTTPUB_UnSubscribe( int $InstanceID,int $id ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MQTTPUB_UnSubscribe( $InstanceID,$id );
}

/**
* MQTTPUB_UnSubscribe_All
* 
* @returns mixed
* @param int $InstanceID
* @param int $id
* @param string $ident
*/

function MQTTPUB_UnSubscribe_All( int $InstanceID,int $id,string $ident ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MQTTPUB_UnSubscribe_All( $InstanceID,$id,$ident );
}

/**
* MQTT_ClearRetainedMessages
* 
* @returns bool
* @param int $InstanceID
*/

function MQTT_ClearRetainedMessages( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MQTT_ClearRetainedMessages( $InstanceID );
}

/**
* MQTT_ClearTopics
* 
* @returns bool
* @param int $InstanceID
*/

function MQTT_ClearTopics( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MQTT_ClearTopics( $InstanceID );
}

/**
* MQTT_GetKnownDevices
* 
* @returns array
* @param int $InstanceID
*/

function MQTT_GetKnownDevices( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MQTT_GetKnownDevices( $InstanceID );
}

/**
* MQTT_GetRetainedMessage
* 
* @returns array
* @param int $InstanceID
* @param string $Topic
*/

function MQTT_GetRetainedMessage( int $InstanceID,string $Topic ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MQTT_GetRetainedMessage( $InstanceID,$Topic );
}

/**
* MQTT_GetRetainedMessageTopicList
* 
* @returns array
* @param int $InstanceID
*/

function MQTT_GetRetainedMessageTopicList( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MQTT_GetRetainedMessageTopicList( $InstanceID );
}

/**
* MQTT_RemoveRetainedMessage
* 
* @returns bool
* @param int $InstanceID
* @param string $Topic
*/

function MQTT_RemoveRetainedMessage( int $InstanceID,string $Topic ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MQTT_RemoveRetainedMessage( $InstanceID,$Topic );
}

/**
* MQTT_UIChangeSendTopic
* 
* @returns bool
* @param int $InstanceID
* @param bool $Active
*/

function MQTT_UIChangeSendTopic( int $InstanceID,bool $Active ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MQTT_UIChangeSendTopic( $InstanceID,$Active );
}

/**
* MQTT_UIChangeType
* 
* @returns bool
* @param int $InstanceID
* @param int $Type
*/

function MQTT_UIChangeType( int $InstanceID,int $Type ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MQTT_UIChangeType( $InstanceID,$Type );
}

/**
* MSCK_SendPacket
* 
* @returns bool
* @param int $InstanceID
* @param string $Text
* @param string $ClientIP
* @param int $ClientPort
*/

function MSCK_SendPacket( int $InstanceID,string $Text,string $ClientIP,int $ClientPort ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MSCK_SendPacket( $InstanceID,$Text,$ClientIP,$ClientPort );
}

/**
* MSCK_SendText
* 
* @returns bool
* @param int $InstanceID
* @param string $Text
*/

function MSCK_SendText( int $InstanceID,string $Text ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MSCK_SendText( $InstanceID,$Text );
}

/**
* MXC_DimBrighter
* 
* @returns bool
* @param int $InstanceID
*/

function MXC_DimBrighter( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MXC_DimBrighter( $InstanceID );
}

/**
* MXC_DimDarker
* 
* @returns bool
* @param int $InstanceID
*/

function MXC_DimDarker( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MXC_DimDarker( $InstanceID );
}

/**
* MXC_DimSet
* 
* @returns bool
* @param int $InstanceID
* @param int $Intensity
*/

function MXC_DimSet( int $InstanceID,int $Intensity ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MXC_DimSet( $InstanceID,$Intensity );
}

/**
* MXC_DimStop
* 
* @returns bool
* @param int $InstanceID
*/

function MXC_DimStop( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MXC_DimStop( $InstanceID );
}

/**
* MXC_GetKnownDevices
* 
* @returns array
* @param int $InstanceID
*/

function MXC_GetKnownDevices( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MXC_GetKnownDevices( $InstanceID );
}

/**
* MXC_RequestInfo
* 
* @returns bool
* @param int $InstanceID
*/

function MXC_RequestInfo( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MXC_RequestInfo( $InstanceID );
}

/**
* MXC_RequestStatus
* 
* @returns bool
* @param int $InstanceID
*/

function MXC_RequestStatus( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MXC_RequestStatus( $InstanceID );
}

/**
* MXC_SendBoolean
* 
* @returns bool
* @param int $InstanceID
* @param bool $Value
*/

function MXC_SendBoolean( int $InstanceID,bool $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MXC_SendBoolean( $InstanceID,$Value );
}

/**
* MXC_SendFloat
* 
* @returns bool
* @param int $InstanceID
* @param float $Value
*/

function MXC_SendFloat( int $InstanceID,float $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MXC_SendFloat( $InstanceID,$Value );
}

/**
* MXC_SendInteger
* 
* @returns bool
* @param int $InstanceID
* @param int $Value
*/

function MXC_SendInteger( int $InstanceID,int $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MXC_SendInteger( $InstanceID,$Value );
}

/**
* MXC_SetTemperature
* 
* @returns bool
* @param int $InstanceID
* @param float $Temperature
*/

function MXC_SetTemperature( int $InstanceID,float $Temperature ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MXC_SetTemperature( $InstanceID,$Temperature );
}

/**
* MXC_ShutterMoveDown
* 
* @returns bool
* @param int $InstanceID
*/

function MXC_ShutterMoveDown( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MXC_ShutterMoveDown( $InstanceID );
}

/**
* MXC_ShutterMoveUp
* 
* @returns bool
* @param int $InstanceID
*/

function MXC_ShutterMoveUp( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MXC_ShutterMoveUp( $InstanceID );
}

/**
* MXC_ShutterStepDown
* 
* @returns bool
* @param int $InstanceID
*/

function MXC_ShutterStepDown( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MXC_ShutterStepDown( $InstanceID );
}

/**
* MXC_ShutterStepUp
* 
* @returns bool
* @param int $InstanceID
*/

function MXC_ShutterStepUp( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MXC_ShutterStepUp( $InstanceID );
}

/**
* MXC_ShutterStop
* 
* @returns bool
* @param int $InstanceID
*/

function MXC_ShutterStop( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MXC_ShutterStop( $InstanceID );
}

/**
* MXC_SwitchMode
* 
* @returns bool
* @param int $InstanceID
* @param bool $DeviceOn
*/

function MXC_SwitchMode( int $InstanceID,bool $DeviceOn ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->MXC_SwitchMode( $InstanceID,$DeviceOn );
}

/**
* ModBus_RequestRead
* 
* @returns bool
* @param int $InstanceID
*/

function ModBus_RequestRead( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ModBus_RequestRead( $InstanceID );
}

/**
* ModBus_UIChangeMode
* 
* @returns bool
* @param int $InstanceID
* @param int $Mode
*   enum[0=mbgmTCP, 1=mbgmRTU, 2=mbgmRTUoverTCP, 3=mbgmTCPoverUDP, 4=mbgmSymBoxRTU, 5=mbgmSymBoxASCII, 6=mbgmRTUoverUDP, 7=mbgmASCII, 8=mbgmASCIIoverTCP, 9=mbgmASCIIoverUDP]
*/

function ModBus_UIChangeMode( int $InstanceID,int $Mode ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ModBus_UIChangeMode( $InstanceID,$Mode );
}

/**
* ModBus_UIExportTemplate
* 
* @returns string
* @param int $InstanceID
*/

function ModBus_UIExportTemplate( int $InstanceID ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ModBus_UIExportTemplate( $InstanceID );
}

/**
* ModBus_UIForm
* 
* @returns string
* @param int $InstanceID
* @param int $DataType
*   enum[0=mbBit, 1=mbUInt8MSB, 2=mbUInt16, 3=mbUInt32, 4=mbInt8MSB, 5=mbInt16, 6=mbInt32, 7=mbFloat32, 8=mbInt64, 9=mbFloat64, 10=mbStringPlain, 11=mbUInt64, 12=mbUInt8LSB, 13=mbInt8LSB, 14=mbStringHex]
* @param float $Factor
*/

function ModBus_UIForm( int $InstanceID,int $DataType,float $Factor ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ModBus_UIForm( $InstanceID,$DataType,$Factor );
}

/**
* ModBus_UIFormVirtual
* 
* @returns string
* @param int $InstanceID
* @param int $VariableType
*   enum[0=vtBoolean, 1=vtInteger, 2=vtFloat, 3=vtString]
*/

function ModBus_UIFormVirtual( int $InstanceID,int $VariableType ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ModBus_UIFormVirtual( $InstanceID,$VariableType );
}

/**
* ModBus_UIImportTemplate
* 
* @returns bool
* @param int $InstanceID
* @param string $ImportData
*/

function ModBus_UIImportTemplate( int $InstanceID,string $ImportData ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ModBus_UIImportTemplate( $InstanceID,$ImportData );
}

/**
* ModBus_UIUpdate
* 
* @returns bool
* @param int $InstanceID
* @param int $DataType
*   enum[0=mbBit, 1=mbUInt8MSB, 2=mbUInt16, 3=mbUInt32, 4=mbInt8MSB, 5=mbInt16, 6=mbInt32, 7=mbFloat32, 8=mbInt64, 9=mbFloat64, 10=mbStringPlain, 11=mbUInt64, 12=mbUInt8LSB, 13=mbInt8LSB, 14=mbStringHex]
* @param int $ReadFunctionCode
* @param int $WriteFunctionCode
* @param float $Factor
*/

function ModBus_UIUpdate( int $InstanceID,int $DataType,int $ReadFunctionCode,int $WriteFunctionCode,float $Factor ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ModBus_UIUpdate( $InstanceID,$DataType,$ReadFunctionCode,$WriteFunctionCode,$Factor );
}

/**
* ModBus_UIUpdateVirtual
* 
* @returns bool
* @param int $InstanceID
* @param int $VariableType
*   enum[0=vtBoolean, 1=vtInteger, 2=vtFloat, 3=vtString]
*/

function ModBus_UIUpdateVirtual( int $InstanceID,int $VariableType ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ModBus_UIUpdateVirtual( $InstanceID,$VariableType );
}

/**
* ModBus_UIValidateTemplate
* 
* @returns bool
* @param int $InstanceID
* @param string $ImportData
*/

function ModBus_UIValidateTemplate( int $InstanceID,string $ImportData ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ModBus_UIValidateTemplate( $InstanceID,$ImportData );
}

/**
* ModBus_WriteCoil
* 
* @returns bool
* @param int $InstanceID
* @param bool $Value
*/

function ModBus_WriteCoil( int $InstanceID,bool $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ModBus_WriteCoil( $InstanceID,$Value );
}

/**
* ModBus_WriteRegister
* 
* @returns bool
* @param int $InstanceID
* @param float $Value
*/

function ModBus_WriteRegister( int $InstanceID,float $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ModBus_WriteRegister( $InstanceID,$Value );
}

/**
* ModBus_WriteRegisterString
* 
* @returns bool
* @param int $InstanceID
* @param string $Value
*/

function ModBus_WriteRegisterString( int $InstanceID,string $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ModBus_WriteRegisterString( $InstanceID,$Value );
}

/**
* NC_ActivateServer
* 
* @returns bool
* @param int $InstanceID
*/

function NC_ActivateServer( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->NC_ActivateServer( $InstanceID );
}

/**
* NC_AddDevice
* 
* @returns string
* @param int $InstanceID
* @param string $Token
* @param string $Provider
* @param string $DeviceID
* @param string $Name
* @param int $VisualizationID
*/

function NC_AddDevice( int $InstanceID,string $Token,string $Provider,string $DeviceID,string $Name,int $VisualizationID ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->NC_AddDevice( $InstanceID,$Token,$Provider,$DeviceID,$Name,$VisualizationID );
}

/**
* NC_DeleteNotification
* 
* @returns bool
* @param int $InstanceID
* @param int $NotificationID
*/

function NC_DeleteNotification( int $InstanceID,int $NotificationID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->NC_DeleteNotification( $InstanceID,$NotificationID );
}

/**
* NC_GetDevices
* 
* @returns array
* @param int $InstanceID
*/

function NC_GetDevices( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->NC_GetDevices( $InstanceID );
}

/**
* NC_GetNotification
* 
* @returns array
* @param int $InstanceID
* @param int $NotificationID
*/

function NC_GetNotification( int $InstanceID,int $NotificationID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->NC_GetNotification( $InstanceID,$NotificationID );
}

/**
* NC_GetNotifications
* 
* @returns array
* @param int $InstanceID
*/

function NC_GetNotifications( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->NC_GetNotifications( $InstanceID );
}

/**
* NC_GetRequestLimitCount
* 
* @returns int
* @param int $InstanceID
*/

function NC_GetRequestLimitCount( int $InstanceID ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->NC_GetRequestLimitCount( $InstanceID );
}

/**
* NC_PushNotification
* 
* @returns int
* @param int $InstanceID
* @param int $VisualizationID
* @param string $Title
* @param string $Body
* @param string $Sound
*/

function NC_PushNotification( int $InstanceID,int $VisualizationID,string $Title,string $Body,string $Sound ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->NC_PushNotification( $InstanceID,$VisualizationID,$Title,$Body,$Sound );
}

/**
* NC_ReadNotification
* 
* @returns bool
* @param int $InstanceID
* @param int $NotificationID
*/

function NC_ReadNotification( int $InstanceID,int $NotificationID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->NC_ReadNotification( $InstanceID,$NotificationID );
}

/**
* NC_RemoveDevice
* 
* @returns bool
* @param int $InstanceID
* @param int $DeviceID
*/

function NC_RemoveDevice( int $InstanceID,int $DeviceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->NC_RemoveDevice( $InstanceID,$DeviceID );
}

/**
* NC_RemoveDeviceVisualization
* 
* @returns bool
* @param int $InstanceID
* @param int $DeviceID
* @param int $VisualizationID
*/

function NC_RemoveDeviceVisualization( int $InstanceID,int $DeviceID,int $VisualizationID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->NC_RemoveDeviceVisualization( $InstanceID,$DeviceID,$VisualizationID );
}

/**
* NC_SetDeviceName
* 
* @returns bool
* @param int $InstanceID
* @param int $DeviceID
* @param string $Name
*/

function NC_SetDeviceName( int $InstanceID,int $DeviceID,string $Name ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->NC_SetDeviceName( $InstanceID,$DeviceID,$Name );
}

/**
* NC_SetDeviceVisualization
* 
* @returns bool
* @param int $InstanceID
* @param int $DeviceID
* @param int $VisualizationID
* @param bool $Enabled
*/

function NC_SetDeviceVisualization( int $InstanceID,int $DeviceID,int $VisualizationID,bool $Enabled ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->NC_SetDeviceVisualization( $InstanceID,$DeviceID,$VisualizationID,$Enabled );
}

/**
* NC_TestDevice
* 
* @returns bool
* @param int $InstanceID
* @param int $DeviceID
*/

function NC_TestDevice( int $InstanceID,int $DeviceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->NC_TestDevice( $InstanceID,$DeviceID );
}

/**
* NC_UpdateFormList
* 
* @returns bool
* @param int $InstanceID
*/

function NC_UpdateFormList( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->NC_UpdateFormList( $InstanceID );
}

/**
* NUT_Query
* 
* @returns mixed
* @param int $InstanceID
*/

function NUT_Query( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->NUT_Query( $InstanceID );
}

/**
* NUT_UpdateEvent
* 
* @returns mixed
* @param int $InstanceID
*/

function NUT_UpdateEvent( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->NUT_UpdateEvent( $InstanceID );
}

/**
* OC_PushMessage
* 
* @returns bool
* @param int $InstanceID
* @param string $ClientID
* @param string $Data
*/

function OC_PushMessage( int $InstanceID,string $ClientID,string $Data ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OC_PushMessage( $InstanceID,$ClientID,$Data );
}

/**
* OPCUA_BrowseNode
* 
* @returns bool
* @param int $InstanceID
* @param string $NodeId
*/

function OPCUA_BrowseNode( int $InstanceID,string $NodeId ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OPCUA_BrowseNode( $InstanceID,$NodeId );
}

/**
* OPCUA_ClearNodes
* 
* @returns bool
* @param int $InstanceID
*/

function OPCUA_ClearNodes( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OPCUA_ClearNodes( $InstanceID );
}

/**
* OPCUA_GetKnownNodes
* 
* @returns array
* @param int $InstanceID
*/

function OPCUA_GetKnownNodes( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OPCUA_GetKnownNodes( $InstanceID );
}

/**
* OPCUA_RequestStatus
* 
* @returns bool
* @param int $InstanceID
*/

function OPCUA_RequestStatus( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OPCUA_RequestStatus( $InstanceID );
}

/**
* OPCUA_Subscribe
* 
* @returns bool
* @param int $InstanceID
*/

function OPCUA_Subscribe( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OPCUA_Subscribe( $InstanceID );
}

/**
* OPCUA_WriteValue
* 
* @returns bool
* @param int $InstanceID
* @param mixed $Value
*/

function OPCUA_WriteValue( int $InstanceID,mixed $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OPCUA_WriteValue( $InstanceID,$Value );
}

/**
* OWN_Query
* 
* @returns mixed
* @param int $InstanceID
*/

function OWN_Query( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OWN_Query( $InstanceID );
}

/**
* OWN_UpdateEvent
* 
* @returns mixed
* @param int $InstanceID
*/

function OWN_UpdateEvent( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OWN_UpdateEvent( $InstanceID );
}

/**
* OW_GetKnownDevices
* 
* @returns array
* @param int $InstanceID
*/

function OW_GetKnownDevices( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OW_GetKnownDevices( $InstanceID );
}

/**
* OW_RequestStatus
* 
* @returns bool
* @param int $InstanceID
*/

function OW_RequestStatus( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OW_RequestStatus( $InstanceID );
}

/**
* OW_SetPin
* 
* @returns bool
* @param int $InstanceID
* @param int $Pin
* @param bool $SwitchOn
*/

function OW_SetPin( int $InstanceID,int $Pin,bool $SwitchOn ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OW_SetPin( $InstanceID,$Pin,$SwitchOn );
}

/**
* OW_SetPort
* 
* @returns bool
* @param int $InstanceID
* @param int $Value
*/

function OW_SetPort( int $InstanceID,int $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OW_SetPort( $InstanceID,$Value );
}

/**
* OW_SetPosition
* 
* @returns bool
* @param int $InstanceID
* @param int $Value
*/

function OW_SetPosition( int $InstanceID,int $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OW_SetPosition( $InstanceID,$Value );
}

/**
* OW_SetStrobe
* 
* @returns bool
* @param int $InstanceID
* @param bool $Status
*/

function OW_SetStrobe( int $InstanceID,bool $Status ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OW_SetStrobe( $InstanceID,$Status );
}

/**
* OW_SwitchMode
* 
* @returns bool
* @param int $InstanceID
* @param bool $SwitchOn
*/

function OW_SwitchMode( int $InstanceID,bool $SwitchOn ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OW_SwitchMode( $InstanceID,$SwitchOn );
}

/**
* OW_ToggleMode
* 
* @returns bool
* @param int $InstanceID
*/

function OW_ToggleMode( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OW_ToggleMode( $InstanceID );
}

/**
* OW_WriteBytes
* 
* @returns bool
* @param int $InstanceID
* @param string $Data
*/

function OW_WriteBytes( int $InstanceID,string $Data ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OW_WriteBytes( $InstanceID,$Data );
}

/**
* OW_WriteBytesMasked
* 
* @returns bool
* @param int $InstanceID
* @param string $Data
* @param int $Mask
*/

function OW_WriteBytesMasked( int $InstanceID,string $Data,int $Mask ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OW_WriteBytesMasked( $InstanceID,$Data,$Mask );
}

/**
* OZW_GetKnownDevices
* 
* @returns array
* @param int $InstanceID
*/

function OZW_GetKnownDevices( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OZW_GetKnownDevices( $InstanceID );
}

/**
* OZW_GetKnownItems
* 
* @returns array
* @param int $InstanceID
*/

function OZW_GetKnownItems( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OZW_GetKnownItems( $InstanceID );
}

/**
* OZW_RequestStatus
* 
* @returns bool
* @param int $InstanceID
*/

function OZW_RequestStatus( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OZW_RequestStatus( $InstanceID );
}

/**
* OZW_UpdateItems
* 
* @returns bool
* @param int $InstanceID
*/

function OZW_UpdateItems( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OZW_UpdateItems( $InstanceID );
}

/**
* OZW_WriteDataPoint
* 
* @returns bool
* @param int $InstanceID
* @param mixed $Value
*/

function OZW_WriteDataPoint( int $InstanceID,mixed $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OZW_WriteDataPoint( $InstanceID,$Value );
}

/**
* OZW_WriteDataPointEx
* 
* @returns bool
* @param int $InstanceID
* @param string $DataPoint
* @param mixed $Value
*/

function OZW_WriteDataPointEx( int $InstanceID,string $DataPoint,mixed $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OZW_WriteDataPointEx( $InstanceID,$DataPoint,$Value );
}

/**
* OpenWeatherData_CalcAbsoluteHumidity
* 
* @returns mixed
* @param int $InstanceID
* @param float $temp
* @param float $humidity
*/

function OpenWeatherData_CalcAbsoluteHumidity( int $InstanceID,float $temp,float $humidity ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OpenWeatherData_CalcAbsoluteHumidity( $InstanceID,$temp,$humidity );
}

/**
* OpenWeatherData_CalcAbsolutePressure
* 
* @returns mixed
* @param int $InstanceID
* @param float $pressure
* @param float $temp
* @param float $altitude
*/

function OpenWeatherData_CalcAbsolutePressure( int $InstanceID,float $pressure,float $temp,float $altitude ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OpenWeatherData_CalcAbsolutePressure( $InstanceID,$pressure,$temp,$altitude );
}

/**
* OpenWeatherData_CalcDewpoint
* 
* @returns mixed
* @param int $InstanceID
* @param float $temp
* @param float $humidity
*/

function OpenWeatherData_CalcDewpoint( int $InstanceID,float $temp,float $humidity ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OpenWeatherData_CalcDewpoint( $InstanceID,$temp,$humidity );
}

/**
* OpenWeatherData_CalcHeatindex
* 
* @returns mixed
* @param int $InstanceID
* @param float $temp
* @param float $hum
*/

function OpenWeatherData_CalcHeatindex( int $InstanceID,float $temp,float $hum ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OpenWeatherData_CalcHeatindex( $InstanceID,$temp,$hum );
}

/**
* OpenWeatherData_CalcWindchill
* 
* @returns mixed
* @param int $InstanceID
* @param float $temp
* @param int $speed
*/

function OpenWeatherData_CalcWindchill( int $InstanceID,float $temp,int $speed ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OpenWeatherData_CalcWindchill( $InstanceID,$temp,$speed );
}

/**
* OpenWeatherData_ConvertWindDirection2Text
* 
* @returns mixed
* @param int $InstanceID
* @param int $dir
*/

function OpenWeatherData_ConvertWindDirection2Text( int $InstanceID,int $dir ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OpenWeatherData_ConvertWindDirection2Text( $InstanceID,$dir );
}

/**
* OpenWeatherData_ConvertWindSpeed2Strength
* 
* @returns mixed
* @param int $InstanceID
* @param int $speed
*/

function OpenWeatherData_ConvertWindSpeed2Strength( int $InstanceID,int $speed ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OpenWeatherData_ConvertWindSpeed2Strength( $InstanceID,$speed );
}

/**
* OpenWeatherData_ConvertWindStrength2Text
* 
* @returns mixed
* @param int $InstanceID
* @param int $bft
*/

function OpenWeatherData_ConvertWindStrength2Text( int $InstanceID,int $bft ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OpenWeatherData_ConvertWindStrength2Text( $InstanceID,$bft );
}

/**
* OpenWeatherData_GetRawData
* 
* @returns mixed
* @param int $InstanceID
* @param string $name
*/

function OpenWeatherData_GetRawData( int $InstanceID,string $name ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OpenWeatherData_GetRawData( $InstanceID,$name );
}

/**
* OpenWeatherData_UpdateCurrent
* 
* @returns mixed
* @param int $InstanceID
*/

function OpenWeatherData_UpdateCurrent( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OpenWeatherData_UpdateCurrent( $InstanceID );
}

/**
* OpenWeatherData_UpdateData
* 
* @returns mixed
* @param int $InstanceID
*/

function OpenWeatherData_UpdateData( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OpenWeatherData_UpdateData( $InstanceID );
}

/**
* OpenWeatherData_UpdateHourlyForecast
* 
* @returns mixed
* @param int $InstanceID
*/

function OpenWeatherData_UpdateHourlyForecast( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OpenWeatherData_UpdateHourlyForecast( $InstanceID );
}

/**
* OpenWeatherOneCall_CalcAbsoluteHumidity
* 
* @returns mixed
* @param int $InstanceID
* @param float $temp
* @param float $humidity
*/

function OpenWeatherOneCall_CalcAbsoluteHumidity( int $InstanceID,float $temp,float $humidity ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OpenWeatherOneCall_CalcAbsoluteHumidity( $InstanceID,$temp,$humidity );
}

/**
* OpenWeatherOneCall_CalcAbsolutePressure
* 
* @returns mixed
* @param int $InstanceID
* @param float $pressure
* @param float $temp
* @param float $altitude
*/

function OpenWeatherOneCall_CalcAbsolutePressure( int $InstanceID,float $pressure,float $temp,float $altitude ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OpenWeatherOneCall_CalcAbsolutePressure( $InstanceID,$pressure,$temp,$altitude );
}

/**
* OpenWeatherOneCall_CalcHeatindex
* 
* @returns mixed
* @param int $InstanceID
* @param float $temp
* @param float $hum
*/

function OpenWeatherOneCall_CalcHeatindex( int $InstanceID,float $temp,float $hum ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OpenWeatherOneCall_CalcHeatindex( $InstanceID,$temp,$hum );
}

/**
* OpenWeatherOneCall_ConvertWindDirection2Text
* 
* @returns mixed
* @param int $InstanceID
* @param int $dir
*/

function OpenWeatherOneCall_ConvertWindDirection2Text( int $InstanceID,int $dir ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OpenWeatherOneCall_ConvertWindDirection2Text( $InstanceID,$dir );
}

/**
* OpenWeatherOneCall_ConvertWindSpeed2Strength
* 
* @returns mixed
* @param int $InstanceID
* @param int $speed
*/

function OpenWeatherOneCall_ConvertWindSpeed2Strength( int $InstanceID,int $speed ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OpenWeatherOneCall_ConvertWindSpeed2Strength( $InstanceID,$speed );
}

/**
* OpenWeatherOneCall_ConvertWindStrength2Text
* 
* @returns mixed
* @param int $InstanceID
* @param int $bft
*/

function OpenWeatherOneCall_ConvertWindStrength2Text( int $InstanceID,int $bft ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OpenWeatherOneCall_ConvertWindStrength2Text( $InstanceID,$bft );
}

/**
* OpenWeatherOneCall_GetRawData
* 
* @returns mixed
* @param int $InstanceID
*/

function OpenWeatherOneCall_GetRawData( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OpenWeatherOneCall_GetRawData( $InstanceID );
}

/**
* OpenWeatherOneCall_UpdateData
* 
* @returns mixed
* @param int $InstanceID
*/

function OpenWeatherOneCall_UpdateData( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OpenWeatherOneCall_UpdateData( $InstanceID );
}

/**
* OpenWeatherStation_DeleteStation
* 
* @returns mixed
* @param int $InstanceID
* @param string $station_id
*/

function OpenWeatherStation_DeleteStation( int $InstanceID,string $station_id ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OpenWeatherStation_DeleteStation( $InstanceID,$station_id );
}

/**
* OpenWeatherStation_FetchMeasurements
* 
* @returns mixed
* @param int $InstanceID
* @param int $from
* @param int $to
* @param string $type
* @param int $limit
*/

function OpenWeatherStation_FetchMeasurements( int $InstanceID,int $from,int $to,string $type,int $limit ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OpenWeatherStation_FetchMeasurements( $InstanceID,$from,$to,$type,$limit );
}

/**
* OpenWeatherStation_ListStations
* 
* @returns mixed
* @param int $InstanceID
*/

function OpenWeatherStation_ListStations( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OpenWeatherStation_ListStations( $InstanceID );
}

/**
* OpenWeatherStation_RegisterStation
* 
* @returns mixed
* @param int $InstanceID
*/

function OpenWeatherStation_RegisterStation( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OpenWeatherStation_RegisterStation( $InstanceID );
}

/**
* OpenWeatherStation_TransmitMeasurements
* 
* @returns mixed
* @param int $InstanceID
*/

function OpenWeatherStation_TransmitMeasurements( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OpenWeatherStation_TransmitMeasurements( $InstanceID );
}

/**
* OpenWeatherStation_UpdateStation
* 
* @returns mixed
* @param int $InstanceID
*/

function OpenWeatherStation_UpdateStation( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->OpenWeatherStation_UpdateStation( $InstanceID );
}

/**
* PC_Enter
* 
* @returns bool
* @param int $InstanceID
*/

function PC_Enter( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->PC_Enter( $InstanceID );
}

/**
* PC_Leave
* 
* @returns bool
* @param int $InstanceID
*/

function PC_Leave( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->PC_Leave( $InstanceID );
}

/**
* PF_GetALLDevices
* 
* @returns mixed
* @param int $InstanceID
*/

function PF_GetALLDevices( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->PF_GetALLDevices( $InstanceID );
}

/**
* PF_GetConfiguration
* 
* @returns mixed
* @param int $InstanceID
*/

function PF_GetConfiguration( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->PF_GetConfiguration( $InstanceID );
}

/**
* PF_GetCurrentData
* 
* @returns mixed
* @param int $InstanceID
*/

function PF_GetCurrentData( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->PF_GetCurrentData( $InstanceID );
}

/**
* PF_GetHistory
* 
* @returns mixed
* @param int $InstanceID
*/

function PF_GetHistory( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->PF_GetHistory( $InstanceID );
}

/**
* PF_GetHistoryDevice
* 
* @returns mixed
* @param int $InstanceID
*/

function PF_GetHistoryDevice( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->PF_GetHistoryDevice( $InstanceID );
}

/**
* PF_GetHistoryDeviceCSV
* 
* @returns mixed
* @param int $InstanceID
*/

function PF_GetHistoryDeviceCSV( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->PF_GetHistoryDeviceCSV( $InstanceID );
}

/**
* PF_GetHistoryDeviceInterval
* 
* @returns mixed
* @param int $InstanceID
* @param int $year
* @param int $month
* @param int $day
* @param int $fromhour
*/

function PF_GetHistoryDeviceInterval( int $InstanceID,int $year,int $month,int $day,int $fromhour ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->PF_GetHistoryDeviceInterval( $InstanceID,$year,$month,$day,$fromhour );
}

/**
* PF_GetHistoryDevices
* 
* @returns mixed
* @param int $InstanceID
*/

function PF_GetHistoryDevices( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->PF_GetHistoryDevices( $InstanceID );
}

/**
* PF_GetHistoryInterval
* 
* @returns mixed
* @param int $InstanceID
* @param int $year
* @param int $month
* @param int $day
* @param int $fromhour
*/

function PF_GetHistoryInterval( int $InstanceID,int $year,int $month,int $day,int $fromhour ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->PF_GetHistoryInterval( $InstanceID,$year,$month,$day,$fromhour );
}

/**
* PF_GetPowerHistory
* 
* @returns mixed
* @param int $InstanceID
*/

function PF_GetPowerHistory( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->PF_GetPowerHistory( $InstanceID );
}

/**
* PF_GetPowerHistoryCSV
* 
* @returns mixed
* @param int $InstanceID
*/

function PF_GetPowerHistoryCSV( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->PF_GetPowerHistoryCSV( $InstanceID );
}

/**
* PF_Send
* 
* @returns mixed
* @param int $InstanceID
* @param string $Text
*/

function PF_Send( int $InstanceID,string $Text ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->PF_Send( $InstanceID,$Text );
}

/**
* PF_SetBidirectional_counter
* 
* @returns mixed
* @param int $InstanceID
* @param bool $value
*/

function PF_SetBidirectional_counter( int $InstanceID,bool $value ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->PF_SetBidirectional_counter( $InstanceID,$value );
}

/**
* PF_SetWebFrontVariable
* 
* @returns mixed
* @param int $InstanceID
* @param string $ident
* @param bool $value
*/

function PF_SetWebFrontVariable( int $InstanceID,string $ident,bool $value ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->PF_SetWebFrontVariable( $InstanceID,$ident,$value );
}

/**
* PF_UpdateStatus
* 
* @returns mixed
* @param int $InstanceID
*/

function PF_UpdateStatus( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->PF_UpdateStatus( $InstanceID );
}

/**
* PJ_Backlight
* 
* @returns bool
* @param int $InstanceID
* @param bool $Status
*/

function PJ_Backlight( int $InstanceID,bool $Status ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->PJ_Backlight( $InstanceID,$Status );
}

/**
* PJ_Beep
* 
* @returns bool
* @param int $InstanceID
* @param int $TenthOfASecond
*/

function PJ_Beep( int $InstanceID,int $TenthOfASecond ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->PJ_Beep( $InstanceID,$TenthOfASecond );
}

/**
* PJ_DimRGBW
* 
* @returns bool
* @param int $InstanceID
* @param int $R
* @param int $RTime
* @param int $G
* @param int $GTime
* @param int $B
* @param int $BTime
* @param int $W
* @param int $WTime
*/

function PJ_DimRGBW( int $InstanceID,int $R,int $RTime,int $G,int $GTime,int $B,int $BTime,int $W,int $WTime ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->PJ_DimRGBW( $InstanceID,$R,$RTime,$G,$GTime,$B,$BTime,$W,$WTime );
}

/**
* PJ_DimServo
* 
* @returns bool
* @param int $InstanceID
* @param int $Channel
* @param int $Value
* @param int $Steps
*/

function PJ_DimServo( int $InstanceID,int $Channel,int $Value,int $Steps ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->PJ_DimServo( $InstanceID,$Channel,$Value,$Steps );
}

/**
* PJ_LCDText
* 
* @returns bool
* @param int $InstanceID
* @param int $Line
* @param string $Text
*/

function PJ_LCDText( int $InstanceID,int $Line,string $Text ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->PJ_LCDText( $InstanceID,$Line,$Text );
}

/**
* PJ_RequestStatus
* 
* @returns bool
* @param int $InstanceID
*/

function PJ_RequestStatus( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->PJ_RequestStatus( $InstanceID );
}

/**
* PJ_RunProgram
* 
* @returns bool
* @param int $InstanceID
* @param int $Type
*/

function PJ_RunProgram( int $InstanceID,int $Type ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->PJ_RunProgram( $InstanceID,$Type );
}

/**
* PJ_SetLEDs
* 
* @returns bool
* @param int $InstanceID
* @param bool $Green
* @param bool $Yellow
* @param bool $Red
*/

function PJ_SetLEDs( int $InstanceID,bool $Green,bool $Yellow,bool $Red ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->PJ_SetLEDs( $InstanceID,$Green,$Yellow,$Red );
}

/**
* PJ_SetRGBW
* 
* @returns bool
* @param int $InstanceID
* @param int $R
* @param int $G
* @param int $B
* @param int $W
*/

function PJ_SetRGBW( int $InstanceID,int $R,int $G,int $B,int $W ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->PJ_SetRGBW( $InstanceID,$R,$G,$B,$W );
}

/**
* PJ_SetServo
* 
* @returns bool
* @param int $InstanceID
* @param int $Channel
* @param int $Value
*/

function PJ_SetServo( int $InstanceID,int $Channel,int $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->PJ_SetServo( $InstanceID,$Channel,$Value );
}

/**
* PJ_SetVoltage
* 
* @returns bool
* @param int $InstanceID
* @param float $Voltage
*/

function PJ_SetVoltage( int $InstanceID,float $Voltage ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->PJ_SetVoltage( $InstanceID,$Voltage );
}

/**
* PJ_SwitchDuration
* 
* @returns bool
* @param int $InstanceID
* @param bool $DeviceOn
* @param int $Duration
*/

function PJ_SwitchDuration( int $InstanceID,bool $DeviceOn,int $Duration ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->PJ_SwitchDuration( $InstanceID,$DeviceOn,$Duration );
}

/**
* PJ_SwitchLED
* 
* @returns bool
* @param int $InstanceID
* @param int $LED
* @param bool $Status
*/

function PJ_SwitchLED( int $InstanceID,int $LED,bool $Status ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->PJ_SwitchLED( $InstanceID,$LED,$Status );
}

/**
* PJ_SwitchMode
* 
* @returns bool
* @param int $InstanceID
* @param bool $DeviceOn
*/

function PJ_SwitchMode( int $InstanceID,bool $DeviceOn ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->PJ_SwitchMode( $InstanceID,$DeviceOn );
}

/**
* POP3_DeleteMail
* 
* @returns bool
* @param int $InstanceID
* @param string $UID
*/

function POP3_DeleteMail( int $InstanceID,string $UID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->POP3_DeleteMail( $InstanceID,$UID );
}

/**
* POP3_GetCachedMails
* 
* @returns array
* @param int $InstanceID
*/

function POP3_GetCachedMails( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->POP3_GetCachedMails( $InstanceID );
}

/**
* POP3_GetMailEx
* 
* @returns array
* @param int $InstanceID
* @param string $UID
*/

function POP3_GetMailEx( int $InstanceID,string $UID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->POP3_GetMailEx( $InstanceID,$UID );
}

/**
* POP3_UpdateCache
* 
* @returns bool
* @param int $InstanceID
*/

function POP3_UpdateCache( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->POP3_UpdateCache( $InstanceID );
}

/**
* POP3_UpdateFormUseSSL
* 
* @returns bool
* @param int $InstanceID
* @param bool $UseSSL
*/

function POP3_UpdateFormUseSSL( int $InstanceID,bool $UseSSL ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->POP3_UpdateFormUseSSL( $InstanceID,$UseSSL );
}

/**
* RegVar_GetBuffer
* 
* @returns string
* @param int $InstanceID
*/

function RegVar_GetBuffer( int $InstanceID ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->RegVar_GetBuffer( $InstanceID );
}

/**
* RegVar_SendEvent
* 
* @returns bool
* @param int $InstanceID
* @param int $ReportID
* @param string $Text
*/

function RegVar_SendEvent( int $InstanceID,int $ReportID,string $Text ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->RegVar_SendEvent( $InstanceID,$ReportID,$Text );
}

/**
* RegVar_SendPacket
* 
* @returns bool
* @param int $InstanceID
* @param string $Text
* @param string $ClientIP
* @param int $ClientPort
*/

function RegVar_SendPacket( int $InstanceID,string $Text,string $ClientIP,int $ClientPort ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->RegVar_SendPacket( $InstanceID,$Text,$ClientIP,$ClientPort );
}

/**
* RegVar_SendText
* 
* @returns bool
* @param int $InstanceID
* @param string $Text
*/

function RegVar_SendText( int $InstanceID,string $Text ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->RegVar_SendText( $InstanceID,$Text );
}

/**
* RegVar_SetBuffer
* 
* @returns bool
* @param int $InstanceID
* @param string $Text
*/

function RegVar_SetBuffer( int $InstanceID,string $Text ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->RegVar_SetBuffer( $InstanceID,$Text );
}

/**
* RequestAction
* 
* @returns bool
* @param int $VariableID
* @param mixed $Value
*/

function RequestAction( int $VariableID,mixed $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->RequestAction( $VariableID,$Value );
}

/**
* RequestActionEx
* 
* @returns bool
* @param int $VariableID
* @param mixed $Value
* @param string $Sender
*/

function RequestActionEx( int $VariableID,mixed $Value,string $Sender ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->RequestActionEx( $VariableID,$Value,$Sender );
}

/**
* S7_RequestRead
* 
* @returns bool
* @param int $InstanceID
*/

function S7_RequestRead( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->S7_RequestRead( $InstanceID );
}

/**
* S7_Write
* 
* @returns bool
* @param int $InstanceID
* @param float $Value
*/

function S7_Write( int $InstanceID,float $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->S7_Write( $InstanceID,$Value );
}

/**
* S7_WriteBit
* 
* @returns bool
* @param int $InstanceID
* @param bool $Value
*/

function S7_WriteBit( int $InstanceID,bool $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->S7_WriteBit( $InstanceID,$Value );
}

/**
* S7_WriteByte
* 
* @returns bool
* @param int $InstanceID
* @param int $Value
*/

function S7_WriteByte( int $InstanceID,int $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->S7_WriteByte( $InstanceID,$Value );
}

/**
* S7_WriteChar
* 
* @returns bool
* @param int $InstanceID
* @param int $Value
*/

function S7_WriteChar( int $InstanceID,int $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->S7_WriteChar( $InstanceID,$Value );
}

/**
* S7_WriteDWord
* 
* @returns bool
* @param int $InstanceID
* @param int $Value
*/

function S7_WriteDWord( int $InstanceID,int $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->S7_WriteDWord( $InstanceID,$Value );
}

/**
* S7_WriteInteger
* 
* @returns bool
* @param int $InstanceID
* @param int $Value
*/

function S7_WriteInteger( int $InstanceID,int $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->S7_WriteInteger( $InstanceID,$Value );
}

/**
* S7_WriteReal
* 
* @returns bool
* @param int $InstanceID
* @param float $Value
*/

function S7_WriteReal( int $InstanceID,float $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->S7_WriteReal( $InstanceID,$Value );
}

/**
* S7_WriteShort
* 
* @returns bool
* @param int $InstanceID
* @param int $Value
*/

function S7_WriteShort( int $InstanceID,int $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->S7_WriteShort( $InstanceID,$Value );
}

/**
* S7_WriteString
* 
* @returns bool
* @param int $InstanceID
* @param string $Value
*/

function S7_WriteString( int $InstanceID,string $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->S7_WriteString( $InstanceID,$Value );
}

/**
* S7_WriteWord
* 
* @returns bool
* @param int $InstanceID
* @param int $Value
*/

function S7_WriteWord( int $InstanceID,int $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->S7_WriteWord( $InstanceID,$Value );
}

/**
* SC_CreateSkin
* 
* @returns bool
* @param int $InstanceID
* @param string $SkinURL
*/

function SC_CreateSkin( int $InstanceID,string $SkinURL ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SC_CreateSkin( $InstanceID,$SkinURL );
}

/**
* SC_DeleteModule
* 
* @returns bool
* @param int $InstanceID
* @param string $BundleID
*/

function SC_DeleteModule( int $InstanceID,string $BundleID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SC_DeleteModule( $InstanceID,$BundleID );
}

/**
* SC_DeleteSkin
* 
* @returns bool
* @param int $InstanceID
* @param string $Skin
*/

function SC_DeleteSkin( int $InstanceID,string $Skin ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SC_DeleteSkin( $InstanceID,$Skin );
}

/**
* SC_GetLastConfirmedStoreConditions
* 
* @returns int
* @param int $InstanceID
*/

function SC_GetLastConfirmedStoreConditions( int $InstanceID ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SC_GetLastConfirmedStoreConditions( $InstanceID );
}

/**
* SC_GetModuleInfoList
* 
* @returns array
* @param int $InstanceID
*/

function SC_GetModuleInfoList( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SC_GetModuleInfoList( $InstanceID );
}

/**
* SC_GetSkin
* 
* @returns array
* @param int $InstanceID
* @param string $Skin
*/

function SC_GetSkin( int $InstanceID,string $Skin ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SC_GetSkin( $InstanceID,$Skin );
}

/**
* SC_GetSkinIconContent
* 
* @returns string
* @param int $InstanceID
* @param string $Skin
* @param string $Icon
*/

function SC_GetSkinIconContent( int $InstanceID,string $Skin,string $Icon ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SC_GetSkinIconContent( $InstanceID,$Skin,$Icon );
}

/**
* SC_GetSkinList
* 
* @returns array
* @param int $InstanceID
*/

function SC_GetSkinList( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SC_GetSkinList( $InstanceID );
}

/**
* SC_GetSkinRepositoryInfo
* 
* @returns array
* @param int $InstanceID
* @param string $Skin
*/

function SC_GetSkinRepositoryInfo( int $InstanceID,string $Skin ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SC_GetSkinRepositoryInfo( $InstanceID,$Skin );
}

/**
* SC_GetSkinRepositoryLocalBranchList
* 
* @returns array
* @param int $InstanceID
* @param string $Skin
*/

function SC_GetSkinRepositoryLocalBranchList( int $InstanceID,string $Skin ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SC_GetSkinRepositoryLocalBranchList( $InstanceID,$Skin );
}

/**
* SC_GetSkinRepositoryRemoteBranchList
* 
* @returns array
* @param int $InstanceID
* @param string $Skin
*/

function SC_GetSkinRepositoryRemoteBranchList( int $InstanceID,string $Skin ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SC_GetSkinRepositoryRemoteBranchList( $InstanceID,$Skin );
}

/**
* SC_InstallModule
* 
* @returns bool
* @param int $InstanceID
* @param string $BundleID
* @param int $Channel
*   enum[0=scStable, 1=scBeta, 2=scTesting]
* @param int $ReleaseID
*/

function SC_InstallModule( int $InstanceID,string $BundleID,int $Channel,int $ReleaseID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SC_InstallModule( $InstanceID,$BundleID,$Channel,$ReleaseID );
}

/**
* SC_IsSkinClean
* 
* @returns bool
* @param int $InstanceID
* @param string $Skin
*/

function SC_IsSkinClean( int $InstanceID,string $Skin ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SC_IsSkinClean( $InstanceID,$Skin );
}

/**
* SC_IsSkinUpdateAvailable
* 
* @returns bool
* @param int $InstanceID
* @param string $Skin
*/

function SC_IsSkinUpdateAvailable( int $InstanceID,string $Skin ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SC_IsSkinUpdateAvailable( $InstanceID,$Skin );
}

/**
* SC_IsSkinValid
* 
* @returns bool
* @param int $InstanceID
* @param string $Skin
*/

function SC_IsSkinValid( int $InstanceID,string $Skin ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SC_IsSkinValid( $InstanceID,$Skin );
}

/**
* SC_MakeRequest
* 
* @returns string
* @param int $InstanceID
* @param string $Endpoint
* @param string $Method
* @param string $Body
*/

function SC_MakeRequest( int $InstanceID,string $Endpoint,string $Method,string $Body ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SC_MakeRequest( $InstanceID,$Endpoint,$Method,$Body );
}

/**
* SC_Move
* 
* @returns bool
* @param int $InstanceID
* @param int $Position
*/

function SC_Move( int $InstanceID,int $Position ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SC_Move( $InstanceID,$Position );
}

/**
* SC_MoveDown
* 
* @returns bool
* @param int $InstanceID
* @param int $Duration
*/

function SC_MoveDown( int $InstanceID,int $Duration ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SC_MoveDown( $InstanceID,$Duration );
}

/**
* SC_MoveUp
* 
* @returns bool
* @param int $InstanceID
* @param int $Duration
*/

function SC_MoveUp( int $InstanceID,int $Duration ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SC_MoveUp( $InstanceID,$Duration );
}

/**
* SC_RevertSkin
* 
* @returns bool
* @param int $InstanceID
* @param string $Skin
*/

function SC_RevertSkin( int $InstanceID,string $Skin ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SC_RevertSkin( $InstanceID,$Skin );
}

/**
* SC_SetLastConfirmedStoreConditions
* 
* @returns bool
* @param int $InstanceID
* @param int $LastConfirmedStoreConditions
*/

function SC_SetLastConfirmedStoreConditions( int $InstanceID,int $LastConfirmedStoreConditions ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SC_SetLastConfirmedStoreConditions( $InstanceID,$LastConfirmedStoreConditions );
}

/**
* SC_Stop
* 
* @returns bool
* @param int $InstanceID
*/

function SC_Stop( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SC_Stop( $InstanceID );
}

/**
* SC_UpdateSkin
* 
* @returns bool
* @param int $InstanceID
* @param string $Skin
*/

function SC_UpdateSkin( int $InstanceID,string $Skin ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SC_UpdateSkin( $InstanceID,$Skin );
}

/**
* SC_UpdateSkinRepositoryBranch
* 
* @returns bool
* @param int $InstanceID
* @param string $Skin
* @param string $Branch
*/

function SC_UpdateSkinRepositoryBranch( int $InstanceID,string $Skin,string $Branch ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SC_UpdateSkinRepositoryBranch( $InstanceID,$Skin,$Branch );
}

/**
* SMAModbus_ReconnectParentSocket
* 
* @returns mixed
* @param int $InstanceID
* @param mixed $force
*/

function SMAModbus_ReconnectParentSocket( int $InstanceID,mixed $force ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SMAModbus_ReconnectParentSocket( $InstanceID,$force );
}

/**
* SMAModbus_Update
* 
* @returns mixed
* @param int $InstanceID
*/

function SMAModbus_Update( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SMAModbus_Update( $InstanceID );
}

/**
* SMAModbus_UpdateCurrent
* 
* @returns mixed
* @param int $InstanceID
*/

function SMAModbus_UpdateCurrent( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SMAModbus_UpdateCurrent( $InstanceID );
}

/**
* SMAModbus_UpdateDevice
* 
* @returns mixed
* @param int $InstanceID
* @param mixed $applied
*/

function SMAModbus_UpdateDevice( int $InstanceID,mixed $applied ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SMAModbus_UpdateDevice( $InstanceID,$applied );
}

/**
* SMAModbus_UpdateValues
* 
* @returns mixed
* @param int $InstanceID
* @param mixed $applied
*/

function SMAModbus_UpdateValues( int $InstanceID,mixed $applied ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SMAModbus_UpdateValues( $InstanceID,$applied );
}

/**
* SMS_RequestBalance
* 
* @returns float
* @param int $InstanceID
*/

function SMS_RequestBalance( int $InstanceID ):float {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SMS_RequestBalance( $InstanceID );
}

/**
* SMS_RequestStatus
* 
* @returns string
* @param int $InstanceID
* @param string $MsgID
*/

function SMS_RequestStatus( int $InstanceID,string $MsgID ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SMS_RequestStatus( $InstanceID,$MsgID );
}

/**
* SMS_Send
* 
* @returns string
* @param int $InstanceID
* @param string $Number
* @param string $Text
*/

function SMS_Send( int $InstanceID,string $Number,string $Text ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SMS_Send( $InstanceID,$Number,$Text );
}

/**
* SMTP_SendMail
* 
* @returns bool
* @param int $InstanceID
* @param string $Subject
* @param string $Body
*/

function SMTP_SendMail( int $InstanceID,string $Subject,string $Body ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SMTP_SendMail( $InstanceID,$Subject,$Body );
}

/**
* SMTP_SendMailAttachment
* 
* @returns bool
* @param int $InstanceID
* @param string $Subject
* @param string $Body
* @param string $Filename
*/

function SMTP_SendMailAttachment( int $InstanceID,string $Subject,string $Body,string $Filename ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SMTP_SendMailAttachment( $InstanceID,$Subject,$Body,$Filename );
}

/**
* SMTP_SendMailAttachmentEx
* 
* @returns bool
* @param int $InstanceID
* @param string $Address
* @param string $Subject
* @param string $Body
* @param string $Filename
*/

function SMTP_SendMailAttachmentEx( int $InstanceID,string $Address,string $Subject,string $Body,string $Filename ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SMTP_SendMailAttachmentEx( $InstanceID,$Address,$Subject,$Body,$Filename );
}

/**
* SMTP_SendMailEx
* 
* @returns bool
* @param int $InstanceID
* @param string $Address
* @param string $Subject
* @param string $Body
*/

function SMTP_SendMailEx( int $InstanceID,string $Address,string $Subject,string $Body ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SMTP_SendMailEx( $InstanceID,$Address,$Subject,$Body );
}

/**
* SMTP_SendMailMedia
* 
* @returns bool
* @param int $InstanceID
* @param string $Subject
* @param string $Body
* @param int $MediaID
*/

function SMTP_SendMailMedia( int $InstanceID,string $Subject,string $Body,int $MediaID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SMTP_SendMailMedia( $InstanceID,$Subject,$Body,$MediaID );
}

/**
* SMTP_SendMailMediaEx
* 
* @returns bool
* @param int $InstanceID
* @param string $Address
* @param string $Subject
* @param string $Body
* @param int $MediaID
*/

function SMTP_SendMailMediaEx( int $InstanceID,string $Address,string $Subject,string $Body,int $MediaID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SMTP_SendMailMediaEx( $InstanceID,$Address,$Subject,$Body,$MediaID );
}

/**
* SMTP_UpdateFormUseSSL
* 
* @returns bool
* @param int $InstanceID
* @param bool $UseSSL
*/

function SMTP_UpdateFormUseSSL( int $InstanceID,bool $UseSSL ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SMTP_UpdateFormUseSSL( $InstanceID,$UseSSL );
}

/**
* SPRT_SendText
* 
* @returns bool
* @param int $InstanceID
* @param string $Text
*/

function SPRT_SendText( int $InstanceID,string $Text ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SPRT_SendText( $InstanceID,$Text );
}

/**
* SPRT_SetBreak
* 
* @returns bool
* @param int $InstanceID
* @param bool $OnOff
*/

function SPRT_SetBreak( int $InstanceID,bool $OnOff ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SPRT_SetBreak( $InstanceID,$OnOff );
}

/**
* SPRT_SetDTR
* 
* @returns bool
* @param int $InstanceID
* @param bool $OnOff
*/

function SPRT_SetDTR( int $InstanceID,bool $OnOff ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SPRT_SetDTR( $InstanceID,$OnOff );
}

/**
* SPRT_SetRTS
* 
* @returns bool
* @param int $InstanceID
* @param bool $OnOff
*/

function SPRT_SetRTS( int $InstanceID,bool $OnOff ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SPRT_SetRTS( $InstanceID,$OnOff );
}

/**
* SSCK_SendPacket
* 
* @returns bool
* @param int $InstanceID
* @param string $Text
* @param string $ClientIP
* @param int $ClientPort
*/

function SSCK_SendPacket( int $InstanceID,string $Text,string $ClientIP,int $ClientPort ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SSCK_SendPacket( $InstanceID,$Text,$ClientIP,$ClientPort );
}

/**
* SSCK_SendText
* 
* @returns bool
* @param int $InstanceID
* @param string $Text
*/

function SSCK_SendText( int $InstanceID,string $Text ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SSCK_SendText( $InstanceID,$Text );
}

/**
* SSCK_UpdateFormUseSSL
* 
* @returns bool
* @param int $InstanceID
* @param bool $UseSSL
*/

function SSCK_UpdateFormUseSSL( int $InstanceID,bool $UseSSL ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SSCK_UpdateFormUseSSL( $InstanceID,$UseSSL );
}

/**
* SWD_DimDown
* 
* @returns mixed
* @param int $InstanceID
*/

function SWD_DimDown( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SWD_DimDown( $InstanceID );
}

/**
* SWD_DimUp
* 
* @returns mixed
* @param int $InstanceID
*/

function SWD_DimUp( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SWD_DimUp( $InstanceID );
}

/**
* SWD_SetDuration
* 
* @returns mixed
* @param int $InstanceID
* @param int $duration
* @param string $action
*/

function SWD_SetDuration( int $InstanceID,int $duration,string $action ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SWD_SetDuration( $InstanceID,$duration,$action );
}

/**
* SWD_SetIntensity
* 
* @returns mixed
* @param int $InstanceID
* @param int $percent
*/

function SWD_SetIntensity( int $InstanceID,int $percent ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SWD_SetIntensity( $InstanceID,$percent );
}

/**
* SWD_SetSwitchMode
* 
* @returns mixed
* @param int $InstanceID
* @param bool $val
*/

function SWD_SetSwitchMode( int $InstanceID,bool $val ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SWD_SetSwitchMode( $InstanceID,$val );
}

/**
* SWD_TimerEvent
* 
* @returns mixed
* @param int $InstanceID
*/

function SWD_TimerEvent( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SWD_TimerEvent( $InstanceID );
}

/**
* SetValue
* 
* @returns bool
* @param int $VariableID
* @param mixed $Value
*/

function SetValue( int $VariableID,mixed $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SetValue( $VariableID,$Value );
}

/**
* SetValueBoolean
* 
* @returns bool
* @param int $VariableID
* @param bool $Value
*/

function SetValueBoolean( int $VariableID,bool $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SetValueBoolean( $VariableID,$Value );
}

/**
* SetValueFloat
* 
* @returns bool
* @param int $VariableID
* @param float $Value
*/

function SetValueFloat( int $VariableID,float $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SetValueFloat( $VariableID,$Value );
}

/**
* SetValueInteger
* 
* @returns bool
* @param int $VariableID
* @param int $Value
*/

function SetValueInteger( int $VariableID,int $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SetValueInteger( $VariableID,$Value );
}

/**
* SetValueString
* 
* @returns bool
* @param int $VariableID
* @param string $Value
*/

function SetValueString( int $VariableID,string $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->SetValueString( $VariableID,$Value );
}

/**
* Sys_GetBattery
* 
* @returns array
*/

function Sys_GetBattery(  ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->Sys_GetBattery(  );
}

/**
* Sys_GetCPUInfo
* 
* @returns array
*/

function Sys_GetCPUInfo(  ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->Sys_GetCPUInfo(  );
}

/**
* Sys_GetHardDiskInfo
* 
* @returns array
*/

function Sys_GetHardDiskInfo(  ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->Sys_GetHardDiskInfo(  );
}

/**
* Sys_GetMemoryInfo
* 
* @returns array
*/

function Sys_GetMemoryInfo(  ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->Sys_GetMemoryInfo(  );
}

/**
* Sys_GetNetworkInfo
* 
* @returns array
*/

function Sys_GetNetworkInfo(  ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->Sys_GetNetworkInfo(  );
}

/**
* Sys_GetProcessInfo
* 
* @returns array
*/

function Sys_GetProcessInfo(  ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->Sys_GetProcessInfo(  );
}

/**
* Sys_GetSpooler
* 
* @returns array
*/

function Sys_GetSpooler(  ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->Sys_GetSpooler(  );
}

/**
* Sys_GetURLContent
* 
* @returns string
* @param string $URL
*/

function Sys_GetURLContent( string $URL ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->Sys_GetURLContent( $URL );
}

/**
* Sys_GetURLContentEx
* 
* @returns string
* @param string $URL
* @param array $Options
*/

function Sys_GetURLContentEx( string $URL,array $Options ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->Sys_GetURLContentEx( $URL,$Options );
}

/**
* Sys_Ping
* 
* @returns bool
* @param string $Host
* @param int $Timeout
*/

function Sys_Ping( string $Host,int $Timeout ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->Sys_Ping( $Host,$Timeout );
}

/**
* TC_AddLanguage
* 
* @returns bool
* @param int $InstanceID
* @param string $Language
*/

function TC_AddLanguage( int $InstanceID,string $Language ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->TC_AddLanguage( $InstanceID,$Language );
}

/**
* TC_AddTranslation
* 
* @returns bool
* @param int $InstanceID
* @param string $Language
* @param string $SourceText
* @param string $TranslatedText
* @param string $Reference
* @param string $Status
*/

function TC_AddTranslation( int $InstanceID,string $Language,string $SourceText,string $TranslatedText,string $Reference,string $Status ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->TC_AddTranslation( $InstanceID,$Language,$SourceText,$TranslatedText,$Reference,$Status );
}

/**
* TC_CleanupLanguage
* 
* @returns bool
* @param int $InstanceID
* @param string $Language
*/

function TC_CleanupLanguage( int $InstanceID,string $Language ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->TC_CleanupLanguage( $InstanceID,$Language );
}

/**
* TC_GetLanguages
* 
* @returns array
* @param int $InstanceID
*/

function TC_GetLanguages( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->TC_GetLanguages( $InstanceID );
}

/**
* TC_RemoveLanguage
* 
* @returns bool
* @param int $InstanceID
* @param string $Language
*/

function TC_RemoveLanguage( int $InstanceID,string $Language ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->TC_RemoveLanguage( $InstanceID,$Language );
}

/**
* TC_RemoveTranslation
* 
* @returns bool
* @param int $InstanceID
* @param string $Language
* @param string $SourceText
*/

function TC_RemoveTranslation( int $InstanceID,string $Language,string $SourceText ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->TC_RemoveTranslation( $InstanceID,$Language,$SourceText );
}

/**
* TC_TranslateLanguage
* 
* @returns bool
* @param int $InstanceID
* @param string $Language
*/

function TC_TranslateLanguage( int $InstanceID,string $Language ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->TC_TranslateLanguage( $InstanceID,$Language );
}

/**
* TC_UpdateLanguage
* 
* @returns bool
* @param int $InstanceID
* @param string $Language
*/

function TC_UpdateLanguage( int $InstanceID,string $Language ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->TC_UpdateLanguage( $InstanceID,$Language );
}

/**
* TC_UpdateTranslation
* 
* @returns bool
* @param int $InstanceID
* @param string $Language
* @param string $SourceText
* @param string $TranslatedText
* @param string $Reference
* @param string $Status
*/

function TC_UpdateTranslation( int $InstanceID,string $Language,string $SourceText,string $TranslatedText,string $Reference,string $Status ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->TC_UpdateTranslation( $InstanceID,$Language,$SourceText,$TranslatedText,$Reference,$Status );
}

/**
* TasmotaConfig_restart
* 
* @returns mixed
* @param int $InstanceID
*/

function TasmotaConfig_restart( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->TasmotaConfig_restart( $InstanceID );
}

/**
* TasmotaConfig_sendMQTTCommand
* 
* @returns mixed
* @param int $InstanceID
* @param string $command
* @param string $msg
*/

function TasmotaConfig_sendMQTTCommand( int $InstanceID,string $command,string $msg ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->TasmotaConfig_sendMQTTCommand( $InstanceID,$command,$msg );
}

/**
* TasmotaConfig_setPower
* 
* @returns mixed
* @param int $InstanceID
* @param int $power
* @param bool $Value
*/

function TasmotaConfig_setPower( int $InstanceID,int $power,bool $Value ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->TasmotaConfig_setPower( $InstanceID,$power,$Value );
}

/**
* TasmotaConfig_setPowerOnState
* 
* @returns mixed
* @param int $InstanceID
* @param int $value
*/

function TasmotaConfig_setPowerOnState( int $InstanceID,int $value ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->TasmotaConfig_setPowerOnState( $InstanceID,$value );
}

/**
* TasmotaFingerprint_countFP
* 
* @returns mixed
* @param int $InstanceID
*/

function TasmotaFingerprint_countFP( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->TasmotaFingerprint_countFP( $InstanceID );
}

/**
* TasmotaFingerprint_deleteFP
* 
* @returns mixed
* @param int $InstanceID
* @param int $value
*/

function TasmotaFingerprint_deleteFP( int $InstanceID,int $value ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->TasmotaFingerprint_deleteFP( $InstanceID,$value );
}

/**
* TasmotaFingerprint_enrollFP
* 
* @returns mixed
* @param int $InstanceID
* @param int $value
*/

function TasmotaFingerprint_enrollFP( int $InstanceID,int $value ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->TasmotaFingerprint_enrollFP( $InstanceID,$value );
}

/**
* TasmotaFingerprint_restart
* 
* @returns mixed
* @param int $InstanceID
*/

function TasmotaFingerprint_restart( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->TasmotaFingerprint_restart( $InstanceID );
}

/**
* TasmotaFingerprint_sendMQTTCommand
* 
* @returns mixed
* @param int $InstanceID
* @param string $command
* @param string $msg
*/

function TasmotaFingerprint_sendMQTTCommand( int $InstanceID,string $command,string $msg ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->TasmotaFingerprint_sendMQTTCommand( $InstanceID,$command,$msg );
}

/**
* TasmotaFingerprint_setPower
* 
* @returns mixed
* @param int $InstanceID
* @param int $power
* @param bool $Value
*/

function TasmotaFingerprint_setPower( int $InstanceID,int $power,bool $Value ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->TasmotaFingerprint_setPower( $InstanceID,$power,$Value );
}

/**
* TasmotaFingerprint_setPowerOnState
* 
* @returns mixed
* @param int $InstanceID
* @param int $value
*/

function TasmotaFingerprint_setPowerOnState( int $InstanceID,int $value ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->TasmotaFingerprint_setPowerOnState( $InstanceID,$value );
}

/**
* TasmotaLED_restart
* 
* @returns mixed
* @param int $InstanceID
*/

function TasmotaLED_restart( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->TasmotaLED_restart( $InstanceID );
}

/**
* TasmotaLED_sendMQTTCommand
* 
* @returns mixed
* @param int $InstanceID
* @param string $command
* @param string $msg
*/

function TasmotaLED_sendMQTTCommand( int $InstanceID,string $command,string $msg ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->TasmotaLED_sendMQTTCommand( $InstanceID,$command,$msg );
}

/**
* TasmotaLED_setCT
* 
* @returns mixed
* @param int $InstanceID
* @param int $value
*/

function TasmotaLED_setCT( int $InstanceID,int $value ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->TasmotaLED_setCT( $InstanceID,$value );
}

/**
* TasmotaLED_setColorHex
* 
* @returns mixed
* @param int $InstanceID
* @param string $color
*/

function TasmotaLED_setColorHex( int $InstanceID,string $color ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->TasmotaLED_setColorHex( $InstanceID,$color );
}

/**
* TasmotaLED_setDimmer
* 
* @returns mixed
* @param int $InstanceID
* @param int $value
*/

function TasmotaLED_setDimmer( int $InstanceID,int $value ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->TasmotaLED_setDimmer( $InstanceID,$value );
}

/**
* TasmotaLED_setFade
* 
* @returns mixed
* @param int $InstanceID
* @param bool $value
*/

function TasmotaLED_setFade( int $InstanceID,bool $value ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->TasmotaLED_setFade( $InstanceID,$value );
}

/**
* TasmotaLED_setLED
* 
* @returns mixed
* @param int $InstanceID
* @param int $LED
* @param string $color
*/

function TasmotaLED_setLED( int $InstanceID,int $LED,string $color ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->TasmotaLED_setLED( $InstanceID,$LED,$color );
}

/**
* TasmotaLED_setPixel
* 
* @returns mixed
* @param int $InstanceID
* @param int $count
*/

function TasmotaLED_setPixel( int $InstanceID,int $count ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->TasmotaLED_setPixel( $InstanceID,$count );
}

/**
* TasmotaLED_setPower
* 
* @returns mixed
* @param int $InstanceID
* @param int $power
* @param bool $Value
*/

function TasmotaLED_setPower( int $InstanceID,int $power,bool $Value ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->TasmotaLED_setPower( $InstanceID,$power,$Value );
}

/**
* TasmotaLED_setPowerOnState
* 
* @returns mixed
* @param int $InstanceID
* @param int $value
*/

function TasmotaLED_setPowerOnState( int $InstanceID,int $value ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->TasmotaLED_setPowerOnState( $InstanceID,$value );
}

/**
* TasmotaLED_setScheme
* 
* @returns mixed
* @param int $InstanceID
* @param int $schemeID
*/

function TasmotaLED_setScheme( int $InstanceID,int $schemeID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->TasmotaLED_setScheme( $InstanceID,$schemeID );
}

/**
* TasmotaLED_setSpeed
* 
* @returns mixed
* @param int $InstanceID
* @param int $value
*/

function TasmotaLED_setSpeed( int $InstanceID,int $value ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->TasmotaLED_setSpeed( $InstanceID,$value );
}

/**
* TasmotaLED_setWhite
* 
* @returns mixed
* @param int $InstanceID
* @param int $value
*/

function TasmotaLED_setWhite( int $InstanceID,int $value ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->TasmotaLED_setWhite( $InstanceID,$value );
}

/**
* TasmotaSwitchTopic_restart
* 
* @returns mixed
* @param int $InstanceID
*/

function TasmotaSwitchTopic_restart( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->TasmotaSwitchTopic_restart( $InstanceID );
}

/**
* TasmotaSwitchTopic_sendMQTTCommand
* 
* @returns mixed
* @param int $InstanceID
* @param string $command
* @param string $msg
*/

function TasmotaSwitchTopic_sendMQTTCommand( int $InstanceID,string $command,string $msg ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->TasmotaSwitchTopic_sendMQTTCommand( $InstanceID,$command,$msg );
}

/**
* TasmotaSwitchTopic_setPower
* 
* @returns mixed
* @param int $InstanceID
* @param int $power
* @param bool $Value
*/

function TasmotaSwitchTopic_setPower( int $InstanceID,int $power,bool $Value ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->TasmotaSwitchTopic_setPower( $InstanceID,$power,$Value );
}

/**
* TasmotaSwitchTopic_setPowerOnState
* 
* @returns mixed
* @param int $InstanceID
* @param int $value
*/

function TasmotaSwitchTopic_setPowerOnState( int $InstanceID,int $value ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->TasmotaSwitchTopic_setPowerOnState( $InstanceID,$value );
}

/**
* Tasmota_restart
* 
* @returns mixed
* @param int $InstanceID
*/

function Tasmota_restart( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->Tasmota_restart( $InstanceID );
}

/**
* Tasmota_sendMQTTCommand
* 
* @returns mixed
* @param int $InstanceID
* @param string $command
* @param string $msg
*/

function Tasmota_sendMQTTCommand( int $InstanceID,string $command,string $msg ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->Tasmota_sendMQTTCommand( $InstanceID,$command,$msg );
}

/**
* Tasmota_setFanSpeed
* 
* @returns mixed
* @param int $InstanceID
* @param int $value
*/

function Tasmota_setFanSpeed( int $InstanceID,int $value ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->Tasmota_setFanSpeed( $InstanceID,$value );
}

/**
* Tasmota_setMaxPower
* 
* @returns mixed
* @param int $InstanceID
* @param int $value
*/

function Tasmota_setMaxPower( int $InstanceID,int $value ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->Tasmota_setMaxPower( $InstanceID,$value );
}

/**
* Tasmota_setMaxPowerHold
* 
* @returns mixed
* @param int $InstanceID
* @param int $value
*/

function Tasmota_setMaxPowerHold( int $InstanceID,int $value ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->Tasmota_setMaxPowerHold( $InstanceID,$value );
}

/**
* Tasmota_setMaxPowerWindow
* 
* @returns mixed
* @param int $InstanceID
* @param int $value
*/

function Tasmota_setMaxPowerWindow( int $InstanceID,int $value ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->Tasmota_setMaxPowerWindow( $InstanceID,$value );
}

/**
* Tasmota_setPower
* 
* @returns mixed
* @param int $InstanceID
* @param int $power
* @param bool $Value
*/

function Tasmota_setPower( int $InstanceID,int $power,bool $Value ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->Tasmota_setPower( $InstanceID,$power,$Value );
}

/**
* Tasmota_setPowerOnState
* 
* @returns mixed
* @param int $InstanceID
* @param int $value
*/

function Tasmota_setPowerOnState( int $InstanceID,int $value ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->Tasmota_setPowerOnState( $InstanceID,$value );
}

/**
* UC_DeleteObjects
* 
* @returns bool
* @param int $InstanceID
* @param array $IDs
*/

function UC_DeleteObjects( int $InstanceID,array $IDs ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->UC_DeleteObjects( $InstanceID,$IDs );
}

/**
* UC_DuplicateObject
* 
* @returns int
* @param int $InstanceID
* @param int $ID
* @param int $ParentID
* @param bool $Recursive
*/

function UC_DuplicateObject( int $InstanceID,int $ID,int $ParentID,bool $Recursive ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->UC_DuplicateObject( $InstanceID,$ID,$ParentID,$Recursive );
}

/**
* UC_FindInFiles
* 
* @returns array
* @param int $InstanceID
* @param array $Files
* @param string $SearchStr
*/

function UC_FindInFiles( int $InstanceID,array $Files,string $SearchStr ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->UC_FindInFiles( $InstanceID,$Files,$SearchStr );
}

/**
* UC_FindInvalidStrings
* 
* @returns array
* @param int $InstanceID
*/

function UC_FindInvalidStrings( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->UC_FindInvalidStrings( $InstanceID );
}

/**
* UC_FindReferences
* 
* @returns array
* @param int $InstanceID
* @param int $ID
*/

function UC_FindReferences( int $InstanceID,int $ID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->UC_FindReferences( $InstanceID,$ID );
}

/**
* UC_FindShortTags
* 
* @returns array
* @param int $InstanceID
*/

function UC_FindShortTags( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->UC_FindShortTags( $InstanceID );
}

/**
* UC_FixInvalidStrings
* 
* @returns bool
* @param int $InstanceID
* @param array $References
*/

function UC_FixInvalidStrings( int $InstanceID,array $References ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->UC_FixInvalidStrings( $InstanceID,$References );
}

/**
* UC_FixShortTags
* 
* @returns bool
* @param int $InstanceID
* @param array $References
*/

function UC_FixShortTags( int $InstanceID,array $References ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->UC_FixShortTags( $InstanceID,$References );
}

/**
* UC_GetEventStatistics
* 
* @returns array
* @param int $InstanceID
*/

function UC_GetEventStatistics( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->UC_GetEventStatistics( $InstanceID );
}

/**
* UC_GetIconContent
* 
* @returns string
* @param int $InstanceID
* @param string $Icon
*/

function UC_GetIconContent( int $InstanceID,string $Icon ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->UC_GetIconContent( $InstanceID,$Icon );
}

/**
* UC_GetIconList
* 
* @returns array
* @param int $InstanceID
*/

function UC_GetIconList( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->UC_GetIconList( $InstanceID );
}

/**
* UC_GetKernelStatistics
* 
* @returns array
* @param int $InstanceID
*/

function UC_GetKernelStatistics( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->UC_GetKernelStatistics( $InstanceID );
}

/**
* UC_GetLastLogMessages
* 
* @returns array
* @param int $InstanceID
* @param int $Type
*   enum[0=lmtDefault, 1=lmtSuccess, 2=lmtNotify, 3=lmtWarning, 4=lmtError, 5=lmtDebug, 6=lmtCustom]
*/

function UC_GetLastLogMessages( int $InstanceID,int $Type ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->UC_GetLastLogMessages( $InstanceID,$Type );
}

/**
* UC_GetLogMessageStatistics
* 
* @returns array
* @param int $InstanceID
*/

function UC_GetLogMessageStatistics( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->UC_GetLogMessageStatistics( $InstanceID );
}

/**
* UC_GetMessageSenderIDList
* 
* @returns array
* @param int $InstanceID
*/

function UC_GetMessageSenderIDList( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->UC_GetMessageSenderIDList( $InstanceID );
}

/**
* UC_GetMessageSenderIDSizeList
* 
* @returns array
* @param int $InstanceID
*/

function UC_GetMessageSenderIDSizeList( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->UC_GetMessageSenderIDSizeList( $InstanceID );
}

/**
* UC_GetMessageTypeList
* 
* @returns array
* @param int $InstanceID
*/

function UC_GetMessageTypeList( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->UC_GetMessageTypeList( $InstanceID );
}

/**
* UC_GetScriptSenderList
* 
* @returns array
* @param int $InstanceID
*/

function UC_GetScriptSenderList( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->UC_GetScriptSenderList( $InstanceID );
}

/**
* UC_MigrateWorkflow
* 
* @returns bool
* @param int $InstanceID
* @param int $ScriptID
*/

function UC_MigrateWorkflow( int $InstanceID,int $ScriptID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->UC_MigrateWorkflow( $InstanceID,$ScriptID );
}

/**
* UC_RenameScript
* 
* @returns bool
* @param int $InstanceID
* @param int $ScriptID
* @param string $Filename
*/

function UC_RenameScript( int $InstanceID,int $ScriptID,string $Filename ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->UC_RenameScript( $InstanceID,$ScriptID,$Filename );
}

/**
* UC_ReplaceInFiles
* 
* @returns array
* @param int $InstanceID
* @param array $Files
* @param string $SearchStr
* @param string $ReplaceStr
*/

function UC_ReplaceInFiles( int $InstanceID,array $Files,string $SearchStr,string $ReplaceStr ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->UC_ReplaceInFiles( $InstanceID,$Files,$SearchStr,$ReplaceStr );
}

/**
* UC_ResetLastLogMessages
* 
* @returns bool
* @param int $InstanceID
*/

function UC_ResetLastLogMessages( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->UC_ResetLastLogMessages( $InstanceID );
}

/**
* UC_ResetLogMessageStatistics
* 
* @returns bool
* @param int $InstanceID
*/

function UC_ResetLogMessageStatistics( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->UC_ResetLogMessageStatistics( $InstanceID );
}

/**
* UC_SendUsageData
* 
* @returns bool
* @param int $InstanceID
*/

function UC_SendUsageData( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->UC_SendUsageData( $InstanceID );
}

/**
* UC_UpdateLicenseData
* 
* @returns bool
* @param int $InstanceID
*/

function UC_UpdateLicenseData( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->UC_UpdateLicenseData( $InstanceID );
}

/**
* USCK_SendPacket
* 
* @returns bool
* @param int $InstanceID
* @param string $Text
* @param string $ClientIP
* @param int $ClientPort
*/

function USCK_SendPacket( int $InstanceID,string $Text,string $ClientIP,int $ClientPort ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->USCK_SendPacket( $InstanceID,$Text,$ClientIP,$ClientPort );
}

/**
* USCK_SendText
* 
* @returns bool
* @param int $InstanceID
* @param string $Text
*/

function USCK_SendText( int $InstanceID,string $Text ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->USCK_SendText( $InstanceID,$Text );
}

/**
* UVR_UpdateValues
* 
* @returns bool
* @param int $InstanceID
*/

function UVR_UpdateValues( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->UVR_UpdateValues( $InstanceID );
}

/**
* VELLEUSB_ReadAnalogChannel
* 
* @returns int
* @param int $InstanceID
* @param int $Channel
*/

function VELLEUSB_ReadAnalogChannel( int $InstanceID,int $Channel ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VELLEUSB_ReadAnalogChannel( $InstanceID,$Channel );
}

/**
* VELLEUSB_ReadCounter
* 
* @returns int
* @param int $InstanceID
* @param int $Counter
*/

function VELLEUSB_ReadCounter( int $InstanceID,int $Counter ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VELLEUSB_ReadCounter( $InstanceID,$Counter );
}

/**
* VELLEUSB_ReadDigital
* 
* @returns int
* @param int $InstanceID
*/

function VELLEUSB_ReadDigital( int $InstanceID ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VELLEUSB_ReadDigital( $InstanceID );
}

/**
* VELLEUSB_ReadDigitalChannel
* 
* @returns bool
* @param int $InstanceID
* @param int $Channel
*/

function VELLEUSB_ReadDigitalChannel( int $InstanceID,int $Channel ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VELLEUSB_ReadDigitalChannel( $InstanceID,$Channel );
}

/**
* VELLEUSB_ResetCounter
* 
* @returns bool
* @param int $InstanceID
* @param int $Counter
*/

function VELLEUSB_ResetCounter( int $InstanceID,int $Counter ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VELLEUSB_ResetCounter( $InstanceID,$Counter );
}

/**
* VELLEUSB_SetCounterDebounceTime
* 
* @returns bool
* @param int $InstanceID
* @param int $Counter
* @param int $Time
*/

function VELLEUSB_SetCounterDebounceTime( int $InstanceID,int $Counter,int $Time ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VELLEUSB_SetCounterDebounceTime( $InstanceID,$Counter,$Time );
}

/**
* VELLEUSB_WriteAnalogChannel
* 
* @returns bool
* @param int $InstanceID
* @param int $Channel
* @param int $Value
*/

function VELLEUSB_WriteAnalogChannel( int $InstanceID,int $Channel,int $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VELLEUSB_WriteAnalogChannel( $InstanceID,$Channel,$Value );
}

/**
* VELLEUSB_WriteDigital
* 
* @returns bool
* @param int $InstanceID
* @param int $Value
*/

function VELLEUSB_WriteDigital( int $InstanceID,int $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VELLEUSB_WriteDigital( $InstanceID,$Value );
}

/**
* VELLEUSB_WriteDigitalChannel
* 
* @returns bool
* @param int $InstanceID
* @param int $Channel
* @param bool $Value
*/

function VELLEUSB_WriteDigitalChannel( int $InstanceID,int $Channel,bool $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VELLEUSB_WriteDigitalChannel( $InstanceID,$Channel,$Value );
}

/**
* VIO_Connect
* 
* @returns bool
* @param int $InstanceID
* @param string $ClientIP
* @param int $ClientPort
*/

function VIO_Connect( int $InstanceID,string $ClientIP,int $ClientPort ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VIO_Connect( $InstanceID,$ClientIP,$ClientPort );
}

/**
* VIO_Disconnect
* 
* @returns bool
* @param int $InstanceID
* @param string $ClientIP
* @param int $ClientPort
*/

function VIO_Disconnect( int $InstanceID,string $ClientIP,int $ClientPort ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VIO_Disconnect( $InstanceID,$ClientIP,$ClientPort );
}

/**
* VIO_GetPacketList
* 
* @returns array
* @param int $InstanceID
*/

function VIO_GetPacketList( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VIO_GetPacketList( $InstanceID );
}

/**
* VIO_GetTextList
* 
* @returns array
* @param int $InstanceID
*/

function VIO_GetTextList( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VIO_GetTextList( $InstanceID );
}

/**
* VIO_HTTPResponse
* 
* @returns bool
* @param int $InstanceID
* @param string $Route
* @param string $Method
* @param string $Data
*/

function VIO_HTTPResponse( int $InstanceID,string $Route,string $Method,string $Data ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VIO_HTTPResponse( $InstanceID,$Route,$Method,$Data );
}

/**
* VIO_PushData
* 
* @returns bool
* @param int $InstanceID
* @param string $Event
* @param string $Data
* @param string $Retry
* @param string $ID
*/

function VIO_PushData( int $InstanceID,string $Event,string $Data,string $Retry,string $ID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VIO_PushData( $InstanceID,$Event,$Data,$Retry,$ID );
}

/**
* VIO_PushPacket
* 
* @returns bool
* @param int $InstanceID
* @param string $Text
* @param string $ClientIP
* @param int $ClientPort
*/

function VIO_PushPacket( int $InstanceID,string $Text,string $ClientIP,int $ClientPort ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VIO_PushPacket( $InstanceID,$Text,$ClientIP,$ClientPort );
}

/**
* VIO_PushPacketHEX
* 
* @returns bool
* @param int $InstanceID
* @param string $Text
* @param string $ClientIP
* @param int $ClientPort
*/

function VIO_PushPacketHEX( int $InstanceID,string $Text,string $ClientIP,int $ClientPort ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VIO_PushPacketHEX( $InstanceID,$Text,$ClientIP,$ClientPort );
}

/**
* VIO_PushText
* 
* @returns bool
* @param int $InstanceID
* @param string $Text
*/

function VIO_PushText( int $InstanceID,string $Text ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VIO_PushText( $InstanceID,$Text );
}

/**
* VIO_PushTextHEX
* 
* @returns bool
* @param int $InstanceID
* @param string $Text
*/

function VIO_PushTextHEX( int $InstanceID,string $Text ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VIO_PushTextHEX( $InstanceID,$Text );
}

/**
* VIO_SendPacket
* 
* @returns bool
* @param int $InstanceID
* @param string $Text
* @param string $ClientIP
* @param int $ClientPort
*/

function VIO_SendPacket( int $InstanceID,string $Text,string $ClientIP,int $ClientPort ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VIO_SendPacket( $InstanceID,$Text,$ClientIP,$ClientPort );
}

/**
* VIO_SendText
* 
* @returns bool
* @param int $InstanceID
* @param string $Text
*/

function VIO_SendText( int $InstanceID,string $Text ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VIO_SendText( $InstanceID,$Text );
}

/**
* VISU_CandidateMediaStream
* 
* @returns bool
* @param int $InstanceID
* @param string $SessionID
* @param string $ICE
*/

function VISU_CandidateMediaStream( int $InstanceID,string $SessionID,string $ICE ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VISU_CandidateMediaStream( $InstanceID,$SessionID,$ICE );
}

/**
* VISU_ChangeVisibleGreetingFields
* 
* @returns bool
* @param int $InstanceID
* @param int $Value
*/

function VISU_ChangeVisibleGreetingFields( int $InstanceID,int $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VISU_ChangeVisibleGreetingFields( $InstanceID,$Value );
}

/**
* VISU_ConfigureMediaStream
* 
* @returns bool
* @param int $InstanceID
* @param string $SessionID
* @param string $SessionDescription
*/

function VISU_ConfigureMediaStream( int $InstanceID,string $SessionID,string $SessionDescription ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VISU_ConfigureMediaStream( $InstanceID,$SessionID,$SessionDescription );
}

/**
* VISU_ConnectMediaStream
* 
* @returns string
* @param int $InstanceID
* @param int $MediaID
*/

function VISU_ConnectMediaStream( int $InstanceID,int $MediaID ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VISU_ConnectMediaStream( $InstanceID,$MediaID );
}

/**
* VISU_DeleteNotification
* 
* @returns bool
* @param int $InstanceID
* @param int $NotificationID
*/

function VISU_DeleteNotification( int $InstanceID,int $NotificationID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VISU_DeleteNotification( $InstanceID,$NotificationID );
}

/**
* VISU_DeleteNotifications
* 
* @returns bool
* @param int $InstanceID
*/

function VISU_DeleteNotifications( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VISU_DeleteNotifications( $InstanceID );
}

/**
* VISU_DisconnectMediaStream
* 
* @returns bool
* @param int $InstanceID
* @param string $SessionID
*/

function VISU_DisconnectMediaStream( int $InstanceID,string $SessionID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VISU_DisconnectMediaStream( $InstanceID,$SessionID );
}

/**
* VISU_Execute
* 
* @returns string
* @param int $InstanceID
* @param int $ActionID
* @param int $TargetID
* @param mixed $Value
*/

function VISU_Execute( int $InstanceID,int $ActionID,int $TargetID,mixed $Value ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VISU_Execute( $InstanceID,$ActionID,$TargetID,$Value );
}

/**
* VISU_FetchChartData
* 
* @returns array
* @param int $InstanceID
* @param int $ObjectID
* @param int $StartTime
* @param int $TimeSpan
*   enum[0=tsHour, 1=tsDay, 2=tsWeek, 3=tsMonth, 4=tsYear, 5=tsDecade]
* @param int $Density
*   enum[0=gdNormal, 1=gdHD, 2=gdRaw]
*/

function VISU_FetchChartData( int $InstanceID,int $ObjectID,int $StartTime,int $TimeSpan,int $Density ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VISU_FetchChartData( $InstanceID,$ObjectID,$StartTime,$TimeSpan,$Density );
}

/**
* VISU_FetchChartDataEx
* 
* @returns array
* @param int $InstanceID
* @param int $ObjectID
* @param int $StartTime
* @param int $TimeSpan
*   enum[0=tsHour, 1=tsDay, 2=tsWeek, 3=tsMonth, 4=tsYear, 5=tsDecade]
* @param int $Density
*   enum[0=gdNormal, 1=gdHD, 2=gdRaw]
* @param array $Visibility
*/

function VISU_FetchChartDataEx( int $InstanceID,int $ObjectID,int $StartTime,int $TimeSpan,int $Density,array $Visibility ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VISU_FetchChartDataEx( $InstanceID,$ObjectID,$StartTime,$TimeSpan,$Density,$Visibility );
}

/**
* VISU_GetAggregatedValues
* 
* @returns array
* @param int $InstanceID
* @param int $VariableID
* @param int $AggregationSpan
*   enum[0=agHour, 1=agDay, 2=agWeek, 3=agMonth, 4=agYear, 5=ag5Minutes, 6=ag1Minute, 7=agChanges]
* @param int $StartTime
* @param int $EndTime
* @param int $Limit
*/

function VISU_GetAggregatedValues( int $InstanceID,int $VariableID,int $AggregationSpan,int $StartTime,int $EndTime,int $Limit ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VISU_GetAggregatedValues( $InstanceID,$VariableID,$AggregationSpan,$StartTime,$EndTime,$Limit );
}

/**
* VISU_GetLoggedValues
* 
* @returns array
* @param int $InstanceID
* @param int $VariableID
* @param int $StartTime
* @param int $EndTime
* @param int $Limit
*/

function VISU_GetLoggedValues( int $InstanceID,int $VariableID,int $StartTime,int $EndTime,int $Limit ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VISU_GetLoggedValues( $InstanceID,$VariableID,$StartTime,$EndTime,$Limit );
}

/**
* VISU_GetMail
* 
* @returns array
* @param int $InstanceID
* @param int $InstanceID2
* @param string $UID
*/

function VISU_GetMail( int $InstanceID,int $InstanceID2,string $UID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VISU_GetMail( $InstanceID,$InstanceID2,$UID );
}

/**
* VISU_GetMailList
* 
* @returns array
* @param int $InstanceID
* @param int $InstanceID2
*/

function VISU_GetMailList( int $InstanceID,int $InstanceID2 ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VISU_GetMailList( $InstanceID,$InstanceID2 );
}

/**
* VISU_GetMediaContent
* 
* @returns string
* @param int $InstanceID
* @param int $MediaID
*/

function VISU_GetMediaContent( int $InstanceID,int $MediaID ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VISU_GetMediaContent( $InstanceID,$MediaID );
}

/**
* VISU_GetNotifications
* 
* @returns array
* @param int $InstanceID
*/

function VISU_GetNotifications( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VISU_GetNotifications( $InstanceID );
}

/**
* VISU_GetSnapshot
* 
* @returns array
* @param int $InstanceID
*/

function VISU_GetSnapshot( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VISU_GetSnapshot( $InstanceID );
}

/**
* VISU_PostNotification
* 
* @returns int
* @param int $InstanceID
* @param string $Title
* @param string $Text
* @param string $Type
* @param int $TargetID
*/

function VISU_PostNotification( int $InstanceID,string $Title,string $Text,string $Type,int $TargetID ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VISU_PostNotification( $InstanceID,$Title,$Text,$Type,$TargetID );
}

/**
* VISU_PostNotificationEx
* 
* @returns int
* @param int $InstanceID
* @param string $Title
* @param string $Text
* @param string $Icon
* @param string $Sound
* @param int $TargetID
*/

function VISU_PostNotificationEx( int $InstanceID,string $Title,string $Text,string $Icon,string $Sound,int $TargetID ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VISU_PostNotificationEx( $InstanceID,$Title,$Text,$Icon,$Sound,$TargetID );
}

/**
* VISU_ReadNotification
* 
* @returns bool
* @param int $InstanceID
* @param int $NotificationID
*/

function VISU_ReadNotification( int $InstanceID,int $NotificationID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VISU_ReadNotification( $InstanceID,$NotificationID );
}

/**
* VISU_ReadNotifications
* 
* @returns bool
* @param int $InstanceID
*/

function VISU_ReadNotifications( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VISU_ReadNotifications( $InstanceID );
}

/**
* VISU_RegisterPNS
* 
* @returns string
* @param int $InstanceID
* @param string $Token
* @param string $Provider
* @param string $DeviceID
* @param string $DeviceName
*/

function VISU_RegisterPNS( int $InstanceID,string $Token,string $Provider,string $DeviceID,string $DeviceName ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VISU_RegisterPNS( $InstanceID,$Token,$Provider,$DeviceID,$DeviceName );
}

/**
* VISU_Reload
* 
* @returns bool
* @param int $InstanceID
*/

function VISU_Reload( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VISU_Reload( $InstanceID );
}

/**
* VISU_RenderChart
* 
* @returns string
* @param int $InstanceID
* @param int $ObjectID
* @param int $StartTime
* @param int $TimeSpan
*   enum[0=tsHour, 1=tsDay, 2=tsWeek, 3=tsMonth, 4=tsYear, 5=tsDecade]
* @param int $Density
*   enum[0=gdNormal, 1=gdHD, 2=gdRaw]
* @param bool $IsExtrema
* @param bool $IsDyn
* @param int $Width
* @param int $Height
*/

function VISU_RenderChart( int $InstanceID,int $ObjectID,int $StartTime,int $TimeSpan,int $Density,bool $IsExtrema,bool $IsDyn,int $Width,int $Height ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VISU_RenderChart( $InstanceID,$ObjectID,$StartTime,$TimeSpan,$Density,$IsExtrema,$IsDyn,$Width,$Height );
}

/**
* VISU_RenderChartEx
* 
* @returns string
* @param int $InstanceID
* @param int $ObjectID
* @param int $StartTime
* @param int $TimeSpan
*   enum[0=tsHour, 1=tsDay, 2=tsWeek, 3=tsMonth, 4=tsYear, 5=tsDecade]
* @param int $Density
*   enum[0=gdNormal, 1=gdHD, 2=gdRaw]
* @param bool $IsExtrema
* @param bool $IsDyn
* @param int $Width
* @param int $Height
* @param array $Visibility
*/

function VISU_RenderChartEx( int $InstanceID,int $ObjectID,int $StartTime,int $TimeSpan,int $Density,bool $IsExtrema,bool $IsDyn,int $Width,int $Height,array $Visibility ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VISU_RenderChartEx( $InstanceID,$ObjectID,$StartTime,$TimeSpan,$Density,$IsExtrema,$IsDyn,$Width,$Height,$Visibility );
}

/**
* VISU_RunScriptWait
* 
* @returns string
* @param int $InstanceID
* @param int $ScriptID
*/

function VISU_RunScriptWait( int $InstanceID,int $ScriptID ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VISU_RunScriptWait( $InstanceID,$ScriptID );
}

/**
* VISU_SaveGridConfiguration
* 
* @returns bool
* @param int $InstanceID
* @param string $Configuration
*/

function VISU_SaveGridConfiguration( int $InstanceID,string $Configuration ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VISU_SaveGridConfiguration( $InstanceID,$Configuration );
}

/**
* VISU_SetEvent
* 
* @returns bool
* @param int $InstanceID
* @param int $EventID
* @param string $EventChanges
*/

function VISU_SetEvent( int $InstanceID,int $EventID,string $EventChanges ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VISU_SetEvent( $InstanceID,$EventID,$EventChanges );
}

/**
* VISU_UpdateFormGraphDefaults
* 
* @returns bool
* @param int $InstanceID
* @param bool $GraphRawDensity
*/

function VISU_UpdateFormGraphDefaults( int $InstanceID,bool $GraphRawDensity ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VISU_UpdateFormGraphDefaults( $InstanceID,$GraphRawDensity );
}

/**
* VISU_UpdateFormNotificationValues
* 
* @returns bool
* @param int $InstanceID
*/

function VISU_UpdateFormNotificationValues( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VISU_UpdateFormNotificationValues( $InstanceID );
}

/**
* VISU_UpdateFormSecurityWarning
* 
* @returns bool
* @param int $InstanceID
* @param bool $AllowPasswordlessOnWAN
*/

function VISU_UpdateFormSecurityWarning( int $InstanceID,bool $AllowPasswordlessOnWAN ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VISU_UpdateFormSecurityWarning( $InstanceID,$AllowPasswordlessOnWAN );
}

/**
* VS_UpdateSource
* 
* @returns bool
* @param int $InstanceID
* @param string $ContentSource
*/

function VS_UpdateSource( int $InstanceID,string $ContentSource ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VS_UpdateSource( $InstanceID,$ContentSource );
}

/**
* VoIP_AcceptCall
* 
* @returns bool
* @param int $InstanceID
* @param int $ConnectionID
*/

function VoIP_AcceptCall( int $InstanceID,int $ConnectionID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VoIP_AcceptCall( $InstanceID,$ConnectionID );
}

/**
* VoIP_Connect
* 
* @returns int
* @param int $InstanceID
* @param string $Number
*/

function VoIP_Connect( int $InstanceID,string $Number ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VoIP_Connect( $InstanceID,$Number );
}

/**
* VoIP_Disconnect
* 
* @returns bool
* @param int $InstanceID
* @param int $ConnectionID
*/

function VoIP_Disconnect( int $InstanceID,int $ConnectionID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VoIP_Disconnect( $InstanceID,$ConnectionID );
}

/**
* VoIP_GetConnection
* 
* @returns array
* @param int $InstanceID
* @param int $ConnectionID
*/

function VoIP_GetConnection( int $InstanceID,int $ConnectionID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VoIP_GetConnection( $InstanceID,$ConnectionID );
}

/**
* VoIP_GetData
* 
* @returns string
* @param int $InstanceID
* @param int $ConnectionID
*/

function VoIP_GetData( int $InstanceID,int $ConnectionID ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VoIP_GetData( $InstanceID,$ConnectionID );
}

/**
* VoIP_PlayWave
* 
* @returns bool
* @param int $InstanceID
* @param int $ConnectionID
* @param string $Filename
*/

function VoIP_PlayWave( int $InstanceID,int $ConnectionID,string $Filename ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VoIP_PlayWave( $InstanceID,$ConnectionID,$Filename );
}

/**
* VoIP_RejectCall
* 
* @returns bool
* @param int $InstanceID
* @param int $ConnectionID
*/

function VoIP_RejectCall( int $InstanceID,int $ConnectionID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VoIP_RejectCall( $InstanceID,$ConnectionID );
}

/**
* VoIP_SendDTMF
* 
* @returns bool
* @param int $InstanceID
* @param int $ConnectionID
* @param string $Digit
*/

function VoIP_SendDTMF( int $InstanceID,int $ConnectionID,string $Digit ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VoIP_SendDTMF( $InstanceID,$ConnectionID,$Digit );
}

/**
* VoIP_SetData
* 
* @returns bool
* @param int $InstanceID
* @param int $ConnectionID
* @param string $Data
*/

function VoIP_SetData( int $InstanceID,int $ConnectionID,string $Data ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->VoIP_SetData( $InstanceID,$ConnectionID,$Data );
}

/**
* WC_PushMessage
* 
* @returns bool
* @param int $InstanceID
* @param string $Hook
* @param string $Data
*/

function WC_PushMessage( int $InstanceID,string $Hook,string $Data ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WC_PushMessage( $InstanceID,$Hook,$Data );
}

/**
* WC_PushMessageBinary
* 
* @returns bool
* @param int $InstanceID
* @param string $Hook
* @param string $Data
*/

function WC_PushMessageBinary( int $InstanceID,string $Hook,string $Data ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WC_PushMessageBinary( $InstanceID,$Hook,$Data );
}

/**
* WC_PushMessageBinaryEx
* 
* @returns bool
* @param int $InstanceID
* @param string $Hook
* @param string $Data
* @param string $RemoteIP
* @param int $RemotePort
*/

function WC_PushMessageBinaryEx( int $InstanceID,string $Hook,string $Data,string $RemoteIP,int $RemotePort ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WC_PushMessageBinaryEx( $InstanceID,$Hook,$Data,$RemoteIP,$RemotePort );
}

/**
* WC_PushMessageEx
* 
* @returns bool
* @param int $InstanceID
* @param string $Hook
* @param string $Data
* @param string $RemoteIP
* @param int $RemotePort
*/

function WC_PushMessageEx( int $InstanceID,string $Hook,string $Data,string $RemoteIP,int $RemotePort ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WC_PushMessageEx( $InstanceID,$Hook,$Data,$RemoteIP,$RemotePort );
}

/**
* WC_PushMessageText
* 
* @returns bool
* @param int $InstanceID
* @param string $Hook
* @param string $Data
*/

function WC_PushMessageText( int $InstanceID,string $Hook,string $Data ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WC_PushMessageText( $InstanceID,$Hook,$Data );
}

/**
* WC_PushMessageTextEx
* 
* @returns bool
* @param int $InstanceID
* @param string $Hook
* @param string $Data
* @param string $RemoteIP
* @param int $RemotePort
*/

function WC_PushMessageTextEx( int $InstanceID,string $Hook,string $Data,string $RemoteIP,int $RemotePort ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WC_PushMessageTextEx( $InstanceID,$Hook,$Data,$RemoteIP,$RemotePort );
}

/**
* WDE1_ReInitEvent
* 
* @returns mixed
* @param int $InstanceID
*/

function WDE1_ReInitEvent( int $InstanceID ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WDE1_ReInitEvent( $InstanceID );
}

/**
* WDE1_ReadRecord
* 
* @returns mixed
* @param int $InstanceID
* @param string $inbuf
*/

function WDE1_ReadRecord( int $InstanceID,string $inbuf ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WDE1_ReadRecord( $InstanceID,$inbuf );
}

/**
* WDE1_SetRainPerCount
* 
* @returns mixed
* @param int $InstanceID
* @param int $rainpercount
*/

function WDE1_SetRainPerCount( int $InstanceID,int $rainpercount ):mixed {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WDE1_SetRainPerCount( $InstanceID,$rainpercount );
}

/**
* WEB_UpdateFormEnableSSL
* 
* @returns bool
* @param int $InstanceID
* @param bool $EnableSSL
*/

function WEB_UpdateFormEnableSSL( int $InstanceID,bool $EnableSSL ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WEB_UpdateFormEnableSSL( $InstanceID,$EnableSSL );
}

/**
* WFC_AddItem
* 
* @returns bool
* @param int $InstanceID
* @param string $ID
* @param string $ClassName
* @param string $Configuration
* @param string $ParentID
*/

function WFC_AddItem( int $InstanceID,string $ID,string $ClassName,string $Configuration,string $ParentID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WFC_AddItem( $InstanceID,$ID,$ClassName,$Configuration,$ParentID );
}

/**
* WFC_AudioNotification
* 
* @returns bool
* @param int $InstanceID
* @param string $Title
* @param int $MediaID
*/

function WFC_AudioNotification( int $InstanceID,string $Title,int $MediaID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WFC_AudioNotification( $InstanceID,$Title,$MediaID );
}

/**
* WFC_CandidateMediaStream
* 
* @returns bool
* @param int $InstanceID
* @param string $SessionID
* @param string $ICE
*/

function WFC_CandidateMediaStream( int $InstanceID,string $SessionID,string $ICE ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WFC_CandidateMediaStream( $InstanceID,$SessionID,$ICE );
}

/**
* WFC_ConfigureMediaStream
* 
* @returns bool
* @param int $InstanceID
* @param string $SessionID
* @param string $SessionDescription
*/

function WFC_ConfigureMediaStream( int $InstanceID,string $SessionID,string $SessionDescription ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WFC_ConfigureMediaStream( $InstanceID,$SessionID,$SessionDescription );
}

/**
* WFC_ConnectMediaStream
* 
* @returns string
* @param int $InstanceID
* @param int $MediaID
*/

function WFC_ConnectMediaStream( int $InstanceID,int $MediaID ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WFC_ConnectMediaStream( $InstanceID,$MediaID );
}

/**
* WFC_DeleteItem
* 
* @returns bool
* @param int $InstanceID
* @param string $ID
*/

function WFC_DeleteItem( int $InstanceID,string $ID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WFC_DeleteItem( $InstanceID,$ID );
}

/**
* WFC_DisconnectMediaStream
* 
* @returns bool
* @param int $InstanceID
* @param string $SessionID
*/

function WFC_DisconnectMediaStream( int $InstanceID,string $SessionID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WFC_DisconnectMediaStream( $InstanceID,$SessionID );
}

/**
* WFC_Execute
* 
* @returns string
* @param int $InstanceID
* @param int $ActionID
* @param int $TargetID
* @param mixed $Value
*/

function WFC_Execute( int $InstanceID,int $ActionID,int $TargetID,mixed $Value ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WFC_Execute( $InstanceID,$ActionID,$TargetID,$Value );
}

/**
* WFC_FetchChartData
* 
* @returns array
* @param int $InstanceID
* @param int $ObjectID
* @param int $StartTime
* @param int $TimeSpan
*   enum[0=tsHour, 1=tsDay, 2=tsWeek, 3=tsMonth, 4=tsYear, 5=tsDecade]
* @param int $Density
*   enum[0=gdNormal, 1=gdHD, 2=gdRaw]
*/

function WFC_FetchChartData( int $InstanceID,int $ObjectID,int $StartTime,int $TimeSpan,int $Density ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WFC_FetchChartData( $InstanceID,$ObjectID,$StartTime,$TimeSpan,$Density );
}

/**
* WFC_FetchChartDataEx
* 
* @returns array
* @param int $InstanceID
* @param int $ObjectID
* @param int $StartTime
* @param int $TimeSpan
*   enum[0=tsHour, 1=tsDay, 2=tsWeek, 3=tsMonth, 4=tsYear, 5=tsDecade]
* @param int $Density
*   enum[0=gdNormal, 1=gdHD, 2=gdRaw]
* @param array $Visibility
*/

function WFC_FetchChartDataEx( int $InstanceID,int $ObjectID,int $StartTime,int $TimeSpan,int $Density,array $Visibility ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WFC_FetchChartDataEx( $InstanceID,$ObjectID,$StartTime,$TimeSpan,$Density,$Visibility );
}

/**
* WFC_GetAggregatedValues
* 
* @returns array
* @param int $InstanceID
* @param int $VariableID
* @param int $AggregationSpan
*   enum[0=agHour, 1=agDay, 2=agWeek, 3=agMonth, 4=agYear, 5=ag5Minutes, 6=ag1Minute, 7=agChanges]
* @param int $StartTime
* @param int $EndTime
* @param int $Limit
*/

function WFC_GetAggregatedValues( int $InstanceID,int $VariableID,int $AggregationSpan,int $StartTime,int $EndTime,int $Limit ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WFC_GetAggregatedValues( $InstanceID,$VariableID,$AggregationSpan,$StartTime,$EndTime,$Limit );
}

/**
* WFC_GetItems
* 
* @returns array
* @param int $InstanceID
*/

function WFC_GetItems( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WFC_GetItems( $InstanceID );
}

/**
* WFC_GetLoggedValues
* 
* @returns array
* @param int $InstanceID
* @param int $VariableID
* @param int $StartTime
* @param int $EndTime
* @param int $Limit
*/

function WFC_GetLoggedValues( int $InstanceID,int $VariableID,int $StartTime,int $EndTime,int $Limit ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WFC_GetLoggedValues( $InstanceID,$VariableID,$StartTime,$EndTime,$Limit );
}

/**
* WFC_GetSnapshot
* 
* @returns array
* @param int $InstanceID
*/

function WFC_GetSnapshot( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WFC_GetSnapshot( $InstanceID );
}

/**
* WFC_GetSnapshotChanges
* 
* @returns array
* @param int $InstanceID
* @param int $LastTimeStamp
*/

function WFC_GetSnapshotChanges( int $InstanceID,int $LastTimeStamp ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WFC_GetSnapshotChanges( $InstanceID,$LastTimeStamp );
}

/**
* WFC_GetSnapshotChangesEx
* 
* @returns array
* @param int $InstanceID
* @param int $CategoryID
* @param int $LastTimeStamp
*/

function WFC_GetSnapshotChangesEx( int $InstanceID,int $CategoryID,int $LastTimeStamp ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WFC_GetSnapshotChangesEx( $InstanceID,$CategoryID,$LastTimeStamp );
}

/**
* WFC_GetSnapshotEx
* 
* @returns array
* @param int $InstanceID
* @param int $CategoryID
*/

function WFC_GetSnapshotEx( int $InstanceID,int $CategoryID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WFC_GetSnapshotEx( $InstanceID,$CategoryID );
}

/**
* WFC_OpenCategory
* 
* @returns bool
* @param int $InstanceID
* @param int $CategoryID
*/

function WFC_OpenCategory( int $InstanceID,int $CategoryID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WFC_OpenCategory( $InstanceID,$CategoryID );
}

/**
* WFC_PushNotification
* 
* @returns bool
* @param int $InstanceID
* @param string $Title
* @param string $Text
* @param string $Sound
* @param int $TargetID
*/

function WFC_PushNotification( int $InstanceID,string $Title,string $Text,string $Sound,int $TargetID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WFC_PushNotification( $InstanceID,$Title,$Text,$Sound,$TargetID );
}

/**
* WFC_RegisterPNS
* 
* @returns string
* @param int $InstanceID
* @param string $Token
* @param string $Provider
* @param string $DeviceID
* @param string $DeviceName
*/

function WFC_RegisterPNS( int $InstanceID,string $Token,string $Provider,string $DeviceID,string $DeviceName ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WFC_RegisterPNS( $InstanceID,$Token,$Provider,$DeviceID,$DeviceName );
}

/**
* WFC_Reload
* 
* @returns bool
* @param int $InstanceID
*/

function WFC_Reload( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WFC_Reload( $InstanceID );
}

/**
* WFC_RenderChart
* 
* @returns string
* @param int $InstanceID
* @param int $ObjectID
* @param int $StartTime
* @param int $TimeSpan
*   enum[0=tsHour, 1=tsDay, 2=tsWeek, 3=tsMonth, 4=tsYear, 5=tsDecade]
* @param int $Density
*   enum[0=gdNormal, 1=gdHD, 2=gdRaw]
* @param bool $IsExtrema
* @param bool $IsDyn
* @param int $Width
* @param int $Height
*/

function WFC_RenderChart( int $InstanceID,int $ObjectID,int $StartTime,int $TimeSpan,int $Density,bool $IsExtrema,bool $IsDyn,int $Width,int $Height ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WFC_RenderChart( $InstanceID,$ObjectID,$StartTime,$TimeSpan,$Density,$IsExtrema,$IsDyn,$Width,$Height );
}

/**
* WFC_RenderChartEx
* 
* @returns string
* @param int $InstanceID
* @param int $ObjectID
* @param int $StartTime
* @param int $TimeSpan
*   enum[0=tsHour, 1=tsDay, 2=tsWeek, 3=tsMonth, 4=tsYear, 5=tsDecade]
* @param int $Density
*   enum[0=gdNormal, 1=gdHD, 2=gdRaw]
* @param bool $IsExtrema
* @param bool $IsDyn
* @param int $Width
* @param int $Height
* @param array $Visibility
*/

function WFC_RenderChartEx( int $InstanceID,int $ObjectID,int $StartTime,int $TimeSpan,int $Density,bool $IsExtrema,bool $IsDyn,int $Width,int $Height,array $Visibility ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WFC_RenderChartEx( $InstanceID,$ObjectID,$StartTime,$TimeSpan,$Density,$IsExtrema,$IsDyn,$Width,$Height,$Visibility );
}

/**
* WFC_SendNotification
* 
* @returns bool
* @param int $InstanceID
* @param string $Title
* @param string $Text
* @param string $Icon
* @param int $Timeout
*/

function WFC_SendNotification( int $InstanceID,string $Title,string $Text,string $Icon,int $Timeout ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WFC_SendNotification( $InstanceID,$Title,$Text,$Icon,$Timeout );
}

/**
* WFC_SendPopup
* 
* @returns bool
* @param int $InstanceID
* @param string $Title
* @param string $Text
*/

function WFC_SendPopup( int $InstanceID,string $Title,string $Text ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WFC_SendPopup( $InstanceID,$Title,$Text );
}

/**
* WFC_SetItems
* 
* @returns bool
* @param int $InstanceID
* @param string $Items
*/

function WFC_SetItems( int $InstanceID,string $Items ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WFC_SetItems( $InstanceID,$Items );
}

/**
* WFC_SwitchPage
* 
* @returns bool
* @param int $InstanceID
* @param string $PageName
*/

function WFC_SwitchPage( int $InstanceID,string $PageName ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WFC_SwitchPage( $InstanceID,$PageName );
}

/**
* WFC_UpdateConfiguration
* 
* @returns bool
* @param int $InstanceID
* @param string $ID
* @param string $Configuration
*/

function WFC_UpdateConfiguration( int $InstanceID,string $ID,string $Configuration ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WFC_UpdateConfiguration( $InstanceID,$ID,$Configuration );
}

/**
* WFC_UpdateFormGraphDefaults
* 
* @returns bool
* @param int $InstanceID
* @param bool $GraphRawDensity
*/

function WFC_UpdateFormGraphDefaults( int $InstanceID,bool $GraphRawDensity ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WFC_UpdateFormGraphDefaults( $InstanceID,$GraphRawDensity );
}

/**
* WFC_UpdateFormNotificationValues
* 
* @returns bool
* @param int $InstanceID
*/

function WFC_UpdateFormNotificationValues( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WFC_UpdateFormNotificationValues( $InstanceID );
}

/**
* WFC_UpdateFormSecurityWarning
* 
* @returns bool
* @param int $InstanceID
* @param bool $AllowPasswordlessOnWAN
*/

function WFC_UpdateFormSecurityWarning( int $InstanceID,bool $AllowPasswordlessOnWAN ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WFC_UpdateFormSecurityWarning( $InstanceID,$AllowPasswordlessOnWAN );
}

/**
* WFC_UpdateParentID
* 
* @returns bool
* @param int $InstanceID
* @param string $ID
* @param string $ParentID
*/

function WFC_UpdateParentID( int $InstanceID,string $ID,string $ParentID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WFC_UpdateParentID( $InstanceID,$ID,$ParentID );
}

/**
* WFC_UpdatePosition
* 
* @returns bool
* @param int $InstanceID
* @param string $ID
* @param int $Position
*/

function WFC_UpdatePosition( int $InstanceID,string $ID,int $Position ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WFC_UpdatePosition( $InstanceID,$ID,$Position );
}

/**
* WFC_UpdateVisibility
* 
* @returns bool
* @param int $InstanceID
* @param string $ID
* @param bool $Visible
*/

function WFC_UpdateVisibility( int $InstanceID,string $ID,bool $Visible ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WFC_UpdateVisibility( $InstanceID,$ID,$Visible );
}

/**
* WSC_SendMessage
* 
* @returns bool
* @param int $InstanceID
* @param string $Message
*/

function WSC_SendMessage( int $InstanceID,string $Message ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WSC_SendMessage( $InstanceID,$Message );
}

/**
* WWW_UpdatePage
* 
* @returns bool
* @param int $InstanceID
*/

function WWW_UpdatePage( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WWW_UpdatePage( $InstanceID );
}

/**
* WinLIRC_SendOnce
* 
* @returns bool
* @param int $InstanceID
* @param string $Remote
* @param string $Button
*/

function WinLIRC_SendOnce( int $InstanceID,string $Remote,string $Button ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WinLIRC_SendOnce( $InstanceID,$Remote,$Button );
}

/**
* WuT_SwitchMode
* 
* @returns bool
* @param int $InstanceID
* @param bool $DeviceOn
*/

function WuT_SwitchMode( int $InstanceID,bool $DeviceOn ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WuT_SwitchMode( $InstanceID,$DeviceOn );
}

/**
* WuT_UpdateValue
* 
* @returns bool
* @param int $InstanceID
*/

function WuT_UpdateValue( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WuT_UpdateValue( $InstanceID );
}

/**
* WuT_UpdateValues
* 
* @returns bool
* @param int $InstanceID
*/

function WuT_UpdateValues( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->WuT_UpdateValues( $InstanceID );
}

/**
* XBee_SendBuffer
* 
* @returns bool
* @param int $InstanceID
* @param int $DestinationDevice
* @param string $Buffer
*/

function XBee_SendBuffer( int $InstanceID,int $DestinationDevice,string $Buffer ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->XBee_SendBuffer( $InstanceID,$DestinationDevice,$Buffer );
}

/**
* XBee_SendCommand
* 
* @returns string
* @param int $InstanceID
* @param string $Command
*/

function XBee_SendCommand( int $InstanceID,string $Command ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->XBee_SendCommand( $InstanceID,$Command );
}

/**
* XC_Configure
* 
* @returns bool
* @param int $InstanceID
* @param string $Configuration
*/

function XC_Configure( int $InstanceID,string $Configuration ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->XC_Configure( $InstanceID,$Configuration );
}

/**
* XC_Update
* 
* @returns bool
* @param int $InstanceID
*/

function XC_Update( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->XC_Update( $InstanceID );
}

/**
* YC_SearchDevices
* 
* @returns array
* @param int $InstanceID
* @param string $SearchTarget
*/

function YC_SearchDevices( int $InstanceID,string $SearchTarget ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->YC_SearchDevices( $InstanceID,$SearchTarget );
}

/**
* ZC_QueryService
* 
* @returns array
* @param int $InstanceID
* @param string $Name
* @param string $Type
* @param string $Domain
*/

function ZC_QueryService( int $InstanceID,string $Name,string $Type,string $Domain ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZC_QueryService( $InstanceID,$Name,$Type,$Domain );
}

/**
* ZC_QueryServiceEx
* 
* @returns array
* @param int $InstanceID
* @param string $Name
* @param string $Type
* @param string $Domain
* @param int $Timeout
*/

function ZC_QueryServiceEx( int $InstanceID,string $Name,string $Type,string $Domain,int $Timeout ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZC_QueryServiceEx( $InstanceID,$Name,$Type,$Domain,$Timeout );
}

/**
* ZC_QueryServiceType
* 
* @returns array
* @param int $InstanceID
* @param string $Type
* @param string $Domain
*/

function ZC_QueryServiceType( int $InstanceID,string $Type,string $Domain ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZC_QueryServiceType( $InstanceID,$Type,$Domain );
}

/**
* ZC_QueryServiceTypeEx
* 
* @returns array
* @param int $InstanceID
* @param string $Type
* @param string $Domain
* @param int $Timeout
*/

function ZC_QueryServiceTypeEx( int $InstanceID,string $Type,string $Domain,int $Timeout ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZC_QueryServiceTypeEx( $InstanceID,$Type,$Domain,$Timeout );
}

/**
* ZC_QueryServiceTypes
* 
* @returns array
* @param int $InstanceID
*/

function ZC_QueryServiceTypes( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZC_QueryServiceTypes( $InstanceID );
}

/**
* ZC_QueryServiceTypesEx
* 
* @returns array
* @param int $InstanceID
* @param int $Timeout
*/

function ZC_QueryServiceTypesEx( int $InstanceID,int $Timeout ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZC_QueryServiceTypesEx( $InstanceID,$Timeout );
}

/**
* ZW_AssociationAddToGroup
* 
* @returns bool
* @param int $InstanceID
* @param int $Group
* @param int $Node
*/

function ZW_AssociationAddToGroup( int $InstanceID,int $Group,int $Node ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_AssociationAddToGroup( $InstanceID,$Group,$Node );
}

/**
* ZW_AssociationAddToGroupEx
* 
* @returns bool
* @param int $InstanceID
* @param int $Group
* @param int $Node
* @param int $Channel
*/

function ZW_AssociationAddToGroupEx( int $InstanceID,int $Group,int $Node,int $Channel ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_AssociationAddToGroupEx( $InstanceID,$Group,$Node,$Channel );
}

/**
* ZW_AssociationRemoveFromGroup
* 
* @returns bool
* @param int $InstanceID
* @param int $Group
* @param int $Node
*/

function ZW_AssociationRemoveFromGroup( int $InstanceID,int $Group,int $Node ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_AssociationRemoveFromGroup( $InstanceID,$Group,$Node );
}

/**
* ZW_AssociationRemoveFromGroupEx
* 
* @returns bool
* @param int $InstanceID
* @param int $Group
* @param int $Node
* @param int $Channel
*/

function ZW_AssociationRemoveFromGroupEx( int $InstanceID,int $Group,int $Node,int $Channel ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_AssociationRemoveFromGroupEx( $InstanceID,$Group,$Node,$Channel );
}

/**
* ZW_Basic
* 
* @returns bool
* @param int $InstanceID
* @param int $Value
*/

function ZW_Basic( int $InstanceID,int $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_Basic( $InstanceID,$Value );
}

/**
* ZW_ClearWakeUpQueue
* 
* @returns bool
* @param int $InstanceID
*/

function ZW_ClearWakeUpQueue( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_ClearWakeUpQueue( $InstanceID );
}

/**
* ZW_ColorCW
* 
* @returns bool
* @param int $InstanceID
* @param int $ColdWhite
*/

function ZW_ColorCW( int $InstanceID,int $ColdWhite ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_ColorCW( $InstanceID,$ColdWhite );
}

/**
* ZW_ColorRGB
* 
* @returns bool
* @param int $InstanceID
* @param int $Red
* @param int $Green
* @param int $Blue
*/

function ZW_ColorRGB( int $InstanceID,int $Red,int $Green,int $Blue ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_ColorRGB( $InstanceID,$Red,$Green,$Blue );
}

/**
* ZW_ColorRGBWW
* 
* @returns bool
* @param int $InstanceID
* @param int $Red
* @param int $Green
* @param int $Blue
* @param int $WarmWhite
* @param int $ColdWhite
*/

function ZW_ColorRGBWW( int $InstanceID,int $Red,int $Green,int $Blue,int $WarmWhite,int $ColdWhite ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_ColorRGBWW( $InstanceID,$Red,$Green,$Blue,$WarmWhite,$ColdWhite );
}

/**
* ZW_ColorWW
* 
* @returns bool
* @param int $InstanceID
* @param int $WarmWhite
*/

function ZW_ColorWW( int $InstanceID,int $WarmWhite ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_ColorWW( $InstanceID,$WarmWhite );
}

/**
* ZW_ConfigurationAddCustom
* 
* @returns bool
* @param int $InstanceID
* @param int $Parameter
* @param string $Description
*/

function ZW_ConfigurationAddCustom( int $InstanceID,int $Parameter,string $Description ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_ConfigurationAddCustom( $InstanceID,$Parameter,$Description );
}

/**
* ZW_ConfigurationGetValue
* 
* @returns bool
* @param int $InstanceID
* @param int $Parameter
*/

function ZW_ConfigurationGetValue( int $InstanceID,int $Parameter ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_ConfigurationGetValue( $InstanceID,$Parameter );
}

/**
* ZW_ConfigurationRemoveCustom
* 
* @returns bool
* @param int $InstanceID
* @param int $Parameter
*/

function ZW_ConfigurationRemoveCustom( int $InstanceID,int $Parameter ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_ConfigurationRemoveCustom( $InstanceID,$Parameter );
}

/**
* ZW_ConfigurationResetValue
* 
* @returns bool
* @param int $InstanceID
* @param int $Parameter
*/

function ZW_ConfigurationResetValue( int $InstanceID,int $Parameter ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_ConfigurationResetValue( $InstanceID,$Parameter );
}

/**
* ZW_ConfigurationSetValue
* 
* @returns bool
* @param int $InstanceID
* @param int $Parameter
* @param int $Value
*/

function ZW_ConfigurationSetValue( int $InstanceID,int $Parameter,int $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_ConfigurationSetValue( $InstanceID,$Parameter,$Value );
}

/**
* ZW_DeleteFailedDevice
* 
* @returns bool
* @param int $InstanceID
* @param int $NodeID
*/

function ZW_DeleteFailedDevice( int $InstanceID,int $NodeID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_DeleteFailedDevice( $InstanceID,$NodeID );
}

/**
* ZW_DimDown
* 
* @returns bool
* @param int $InstanceID
*/

function ZW_DimDown( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_DimDown( $InstanceID );
}

/**
* ZW_DimDownEx
* 
* @returns bool
* @param int $InstanceID
* @param int $Duration
*/

function ZW_DimDownEx( int $InstanceID,int $Duration ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_DimDownEx( $InstanceID,$Duration );
}

/**
* ZW_DimSet
* 
* @returns bool
* @param int $InstanceID
* @param int $Intensity
*/

function ZW_DimSet( int $InstanceID,int $Intensity ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_DimSet( $InstanceID,$Intensity );
}

/**
* ZW_DimSetEx
* 
* @returns bool
* @param int $InstanceID
* @param int $Intensity
* @param int $Duration
*/

function ZW_DimSetEx( int $InstanceID,int $Intensity,int $Duration ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_DimSetEx( $InstanceID,$Intensity,$Duration );
}

/**
* ZW_DimStop
* 
* @returns bool
* @param int $InstanceID
*/

function ZW_DimStop( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_DimStop( $InstanceID );
}

/**
* ZW_DimUp
* 
* @returns bool
* @param int $InstanceID
*/

function ZW_DimUp( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_DimUp( $InstanceID );
}

/**
* ZW_DimUpEx
* 
* @returns bool
* @param int $InstanceID
* @param int $Duration
*/

function ZW_DimUpEx( int $InstanceID,int $Duration ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_DimUpEx( $InstanceID,$Duration );
}

/**
* ZW_DoorLockOperation
* 
* @returns bool
* @param int $InstanceID
* @param int $Mode
*/

function ZW_DoorLockOperation( int $InstanceID,int $Mode ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_DoorLockOperation( $InstanceID,$Mode );
}

/**
* ZW_GetInformation
* 
* @returns string
* @param int $InstanceID
*/

function ZW_GetInformation( int $InstanceID ):string {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_GetInformation( $InstanceID );
}

/**
* ZW_GetKnownDevices
* 
* @returns array
* @param int $InstanceID
*/

function ZW_GetKnownDevices( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_GetKnownDevices( $InstanceID );
}

/**
* ZW_GetSupportedVersions
* 
* @returns array
* @param int $InstanceID
*/

function ZW_GetSupportedVersions( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_GetSupportedVersions( $InstanceID );
}

/**
* ZW_GetWakeUpQueue
* 
* @returns array
* @param int $InstanceID
*/

function ZW_GetWakeUpQueue( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_GetWakeUpQueue( $InstanceID );
}

/**
* ZW_LockMode
* 
* @returns bool
* @param int $InstanceID
* @param bool $Locked
*/

function ZW_LockMode( int $InstanceID,bool $Locked ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_LockMode( $InstanceID,$Locked );
}

/**
* ZW_MeterReset
* 
* @returns bool
* @param int $InstanceID
*/

function ZW_MeterReset( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_MeterReset( $InstanceID );
}

/**
* ZW_Optimize
* 
* @returns bool
* @param int $InstanceID
*/

function ZW_Optimize( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_Optimize( $InstanceID );
}

/**
* ZW_ProtectionSet
* 
* @returns bool
* @param int $InstanceID
* @param int $Mode
*   enum[0=pUnprotected, 1=pProtectedBySequence, 2=pNoOperationPossible]
*/

function ZW_ProtectionSet( int $InstanceID,int $Mode ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_ProtectionSet( $InstanceID,$Mode );
}

/**
* ZW_ProtectionSetEx
* 
* @returns bool
* @param int $InstanceID
* @param int $Mode
*   enum[0=pUnprotected, 1=pProtectedBySequence, 2=pNoOperationPossible]
* @param int $ModeRF
*   enum[0=prfUnprotected, 1=prfNoRFControl, 2=prfNoRFResponse]
*/

function ZW_ProtectionSetEx( int $InstanceID,int $Mode,int $ModeRF ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_ProtectionSetEx( $InstanceID,$Mode,$ModeRF );
}

/**
* ZW_ReactivateFailedNode
* 
* @returns bool
* @param int $InstanceID
*/

function ZW_ReactivateFailedNode( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_ReactivateFailedNode( $InstanceID );
}

/**
* ZW_RequestInfo
* 
* @returns bool
* @param int $InstanceID
*/

function ZW_RequestInfo( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_RequestInfo( $InstanceID );
}

/**
* ZW_RequestPriorityRoute
* 
* @returns array
* @param int $InstanceID
*/

function ZW_RequestPriorityRoute( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_RequestPriorityRoute( $InstanceID );
}

/**
* ZW_RequestRoutingList
* 
* @returns array
* @param int $InstanceID
* @param bool $RemoveBad
* @param bool $RemoveNonRepeaters
*/

function ZW_RequestRoutingList( int $InstanceID,bool $RemoveBad,bool $RemoveNonRepeaters ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_RequestRoutingList( $InstanceID,$RemoveBad,$RemoveNonRepeaters );
}

/**
* ZW_RequestStatus
* 
* @returns bool
* @param int $InstanceID
*/

function ZW_RequestStatus( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_RequestStatus( $InstanceID );
}

/**
* ZW_ResetStatistics
* 
* @returns bool
* @param int $InstanceID
*/

function ZW_ResetStatistics( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_ResetStatistics( $InstanceID );
}

/**
* ZW_ResetToDefault
* 
* @returns bool
* @param int $InstanceID
*/

function ZW_ResetToDefault( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_ResetToDefault( $InstanceID );
}

/**
* ZW_SearchMainDevice
* 
* @returns int
* @param int $InstanceID
*/

function ZW_SearchMainDevice( int $InstanceID ):int {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_SearchMainDevice( $InstanceID );
}

/**
* ZW_SearchSubDevices
* 
* @returns array
* @param int $InstanceID
*/

function ZW_SearchSubDevices( int $InstanceID ):array {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_SearchSubDevices( $InstanceID );
}

/**
* ZW_ShutterMoveDown
* 
* @returns bool
* @param int $InstanceID
*/

function ZW_ShutterMoveDown( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_ShutterMoveDown( $InstanceID );
}

/**
* ZW_ShutterMoveUp
* 
* @returns bool
* @param int $InstanceID
*/

function ZW_ShutterMoveUp( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_ShutterMoveUp( $InstanceID );
}

/**
* ZW_ShutterStop
* 
* @returns bool
* @param int $InstanceID
*/

function ZW_ShutterStop( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_ShutterStop( $InstanceID );
}

/**
* ZW_StartAddDevice
* 
* @returns bool
* @param int $InstanceID
*/

function ZW_StartAddDevice( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_StartAddDevice( $InstanceID );
}

/**
* ZW_StartAddNewPrimaryController
* 
* @returns bool
* @param int $InstanceID
*/

function ZW_StartAddNewPrimaryController( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_StartAddNewPrimaryController( $InstanceID );
}

/**
* ZW_StartRemoveDevice
* 
* @returns bool
* @param int $InstanceID
*/

function ZW_StartRemoveDevice( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_StartRemoveDevice( $InstanceID );
}

/**
* ZW_StopAddDevice
* 
* @returns bool
* @param int $InstanceID
*/

function ZW_StopAddDevice( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_StopAddDevice( $InstanceID );
}

/**
* ZW_StopAddNewPrimaryController
* 
* @returns bool
* @param int $InstanceID
*/

function ZW_StopAddNewPrimaryController( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_StopAddNewPrimaryController( $InstanceID );
}

/**
* ZW_StopRemoveDevice
* 
* @returns bool
* @param int $InstanceID
*/

function ZW_StopRemoveDevice( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_StopRemoveDevice( $InstanceID );
}

/**
* ZW_SwitchAllMode
* 
* @returns bool
* @param int $InstanceID
* @param int $Mode
*/

function ZW_SwitchAllMode( int $InstanceID,int $Mode ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_SwitchAllMode( $InstanceID,$Mode );
}

/**
* ZW_SwitchMode
* 
* @returns bool
* @param int $InstanceID
* @param bool $DeviceOn
*/

function ZW_SwitchMode( int $InstanceID,bool $DeviceOn ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_SwitchMode( $InstanceID,$DeviceOn );
}

/**
* ZW_SwitchModeEx
* 
* @returns bool
* @param int $InstanceID
* @param bool $DeviceOn
* @param int $Duration
*/

function ZW_SwitchModeEx( int $InstanceID,bool $DeviceOn,int $Duration ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_SwitchModeEx( $InstanceID,$DeviceOn,$Duration );
}

/**
* ZW_Test
* 
* @returns bool
* @param int $InstanceID
*/

function ZW_Test( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_Test( $InstanceID );
}

/**
* ZW_TestDevice
* 
* @returns bool
* @param int $InstanceID
* @param int $NodeID
*/

function ZW_TestDevice( int $InstanceID,int $NodeID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_TestDevice( $InstanceID,$NodeID );
}

/**
* ZW_ThermostatFanModeSet
* 
* @returns bool
* @param int $InstanceID
* @param int $FanMode
*   enum[0=tfmAutoLow, 1=tfmOnLow, 2=tfmAutoHigh, 3=tfmOnHigh]
*/

function ZW_ThermostatFanModeSet( int $InstanceID,int $FanMode ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_ThermostatFanModeSet( $InstanceID,$FanMode );
}

/**
* ZW_ThermostatModeSet
* 
* @returns bool
* @param int $InstanceID
* @param int $Mode
*   enum[0=tmOff, 1=tmHeat, 2=tmCool, 3=tmAuto, 4=tmAuxiliary, 5=tmResume, 6=tmFanOnly, 7=tmFurnace, 8=tmDryAir, 9=tmMoistAir, 10=tmAutoChangeover]
*/

function ZW_ThermostatModeSet( int $InstanceID,int $Mode ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_ThermostatModeSet( $InstanceID,$Mode );
}

/**
* ZW_ThermostatSetPointSet
* 
* @returns bool
* @param int $InstanceID
* @param int $SetPoint
*   enum[0=tspInvalid, 1=tspHeating, 2=tspCooling, 3=tspFurnace, 4=tspDryAir, 5=tspMoistAir, 6=tspAutoChangeover, 7=tspEnergySaveHeating, 8=tspEnergySaveCooling, 9=tspAwayHeating, 10=tspAwayCooling, 11=tspFullPower]
* @param float $Value
*/

function ZW_ThermostatSetPointSet( int $InstanceID,int $SetPoint,float $Value ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_ThermostatSetPointSet( $InstanceID,$SetPoint,$Value );
}

/**
* ZW_UIAddAssociation
* 
* @returns bool
* @param int $InstanceID
* @param int $GroupID
*/

function ZW_UIAddAssociation( int $InstanceID,int $GroupID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_UIAddAssociation( $InstanceID,$GroupID );
}

/**
* ZW_UIAddParameter
* 
* @returns bool
* @param int $InstanceID
*/

function ZW_UIAddParameter( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_UIAddParameter( $InstanceID );
}

/**
* ZW_UICancelUserCode
* 
* @returns bool
* @param int $InstanceID
*/

function ZW_UICancelUserCode( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_UICancelUserCode( $InstanceID );
}

/**
* ZW_UICloseAddAssociationDialog
* 
* @returns bool
* @param int $InstanceID
*/

function ZW_UICloseAddAssociationDialog( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_UICloseAddAssociationDialog( $InstanceID );
}

/**
* ZW_UIIsParameterQueued
* 
* @returns bool
* @param int $InstanceID
* @param int $ID
*/

function ZW_UIIsParameterQueued( int $InstanceID,int $ID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_UIIsParameterQueued( $InstanceID,$ID );
}

/**
* ZW_UIOpenEditParameterDialog
* 
* @returns bool
* @param int $InstanceID
* @param int $ID
* @param string $Name
* @param string $Enum
*/

function ZW_UIOpenEditParameterDialog( int $InstanceID,int $ID,string $Name,string $Enum ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_UIOpenEditParameterDialog( $InstanceID,$ID,$Name,$Enum );
}

/**
* ZW_UIReadCustomValues
* 
* @returns bool
* @param int $InstanceID
*/

function ZW_UIReadCustomValues( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_UIReadCustomValues( $InstanceID );
}

/**
* ZW_UIReadValues
* 
* @returns bool
* @param int $InstanceID
*/

function ZW_UIReadValues( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_UIReadValues( $InstanceID );
}

/**
* ZW_UISendCurrentConfigurationParameters
* 
* @returns bool
* @param int $InstanceID
*/

function ZW_UISendCurrentConfigurationParameters( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_UISendCurrentConfigurationParameters( $InstanceID );
}

/**
* ZW_UISetRoutingOptions
* 
* @returns bool
* @param int $InstanceID
* @param bool $ShowRepeating
* @param bool $ShowResponding
*/

function ZW_UISetRoutingOptions( int $InstanceID,bool $ShowRepeating,bool $ShowResponding ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_UISetRoutingOptions( $InstanceID,$ShowRepeating,$ShowResponding );
}

/**
* ZW_UIUpdateAssociations
* 
* @returns bool
* @param int $InstanceID
*/

function ZW_UIUpdateAssociations( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_UIUpdateAssociations( $InstanceID );
}

/**
* ZW_UIUpdateConfigurationParameters
* 
* @returns bool
* @param int $InstanceID
*/

function ZW_UIUpdateConfigurationParameters( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_UIUpdateConfigurationParameters( $InstanceID );
}

/**
* ZW_UIUpdateParameterSelection
* 
* @returns bool
* @param int $InstanceID
* @param int $ParameterValue
*/

function ZW_UIUpdateParameterSelection( int $InstanceID,int $ParameterValue ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_UIUpdateParameterSelection( $InstanceID,$ParameterValue );
}

/**
* ZW_UIUpdateUserCodeList
* 
* @returns bool
* @param int $InstanceID
*/

function ZW_UIUpdateUserCodeList( int $InstanceID ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_UIUpdateUserCodeList( $InstanceID );
}

/**
* ZW_UpdatePriorityReturnRoute
* 
* @returns bool
* @param int $InstanceID
* @param int $DestinationID
* @param array $Route
* @param int $Speed
*/

function ZW_UpdatePriorityReturnRoute( int $InstanceID,int $DestinationID,array $Route,int $Speed ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_UpdatePriorityReturnRoute( $InstanceID,$DestinationID,$Route,$Speed );
}

/**
* ZW_UpdatePriorityRoute
* 
* @returns bool
* @param int $InstanceID
* @param array $Route
* @param int $Speed
*/

function ZW_UpdatePriorityRoute( int $InstanceID,array $Route,int $Speed ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_UpdatePriorityRoute( $InstanceID,$Route,$Speed );
}

/**
* ZW_UserCodeLearn
* 
* @returns bool
* @param int $InstanceID
* @param bool $Enabled
*/

function ZW_UserCodeLearn( int $InstanceID,bool $Enabled ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_UserCodeLearn( $InstanceID,$Enabled );
}

/**
* ZW_UserCodeRemove
* 
* @returns bool
* @param int $InstanceID
* @param int $Identifier
*/

function ZW_UserCodeRemove( int $InstanceID,int $Identifier ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_UserCodeRemove( $InstanceID,$Identifier );
}

/**
* ZW_WakeUpSetInterval
* 
* @returns bool
* @param int $InstanceID
* @param int $Seconds
*/

function ZW_WakeUpSetInterval( int $InstanceID,int $Seconds ):bool {
	$rpc=$GLOBALS["rpc"];
	return $rpc->ZW_WakeUpSetInterval( $InstanceID,$Seconds );
}
