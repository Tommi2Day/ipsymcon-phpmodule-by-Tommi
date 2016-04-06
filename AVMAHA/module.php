<?
/**
 * @file
 *
 * AVM AHA-API IPSymcon PHP Splitter Module Class
 *
 * @author Thomas Dressler
 * @copyright Thomas Dressler 2016
 * @version 1.1
 * @date 2016-04-05
 */

/**
 * common module helper function
 */
include_once(__DIR__ . "/../module_helper.php");

/**
 * @class AVMAHA
 *
 * AVM AHA-API IPSymcon PHP Splitter Module Class
 *
 * read AVM AHA Smarthome Services from Fritz!OS (Ftritz!Box etc.) 
 * 
 * supported Devices:
 * -Fritz Powerline 546E,
 * -Fritz Dect200(need FritzOS6.20+ for Temeperature),
 * -Repeater 100 (need FritzOS6.50+),
 * -Comet Dect HKR (need FritzOS6.50+
 * 
 *
 * @par Prefix: AHA
 *
 * @par Properties
 *
 * - \b  Active (Default: Off/Inactive):
 *
 * - \b Category (Default 'WDE1 Devices'):  name of category for subsequent devices
 *
 * - \b ParentCategory (Default 0): ID of parent category for newly created category
 *
 * - \b UpdateInterval (Default 60): Query Interval in sec
 *
 * - \b Host (default fritz.box): Hostname or IP of AHA Server
 *
 * - \b User (default none): Username for Frotz!OS login (if required)
 *
 * - \b Password (default none): Password for Fritz!OS Login 
 *
 * - \b AutoCreate (Default: On/True): Flag to allow autocreation of new Device Instances below Category
 *
 * - \b Debug: Flag to enable debug output via IPS_LogMessages
 *
 * @par Actions (if supported by the attached splitter and the physical device)
 *
 * - \b None
 * @see http://avm.de/fileadmin/user_upload/Global/Service/Schnittstellen/AVM_Technical_Note_-_Session_ID.pdf
 * @see http://avm.de/fileadmin/user_upload/Global/Service/Schnittstellen/AHA-HTTP-Interface.pdf
 *
 */
class AVMAHA extends T2DModule
{
    //------------------------------------------------------------------------------
    //module const and vars
    //------------------------------------------------------------------------------
    /**
     * path to Fritz!OS login application (without host)
     */
    const login_path = "/login_sid.lua"; //login_sid.lua for fritzos 5.50+

    /**
     * path to Fritz!OS AHA application (without host)
     */
    const aha_path = "/webservices/homeautoswitch.lua"; //api url


    //--------------------------------------------------------
    // main module functions
    //--------------------------------------------------------
    /**
     * Constructor
     * @param $InstanceID
     */
    public function __construct($InstanceID)
    {

        if (!function_exists('mb_internal_encoding')) {
            IPS_LogMessage(__CLASS__, "Error: Need Multibyte functions (mb_string_convert)!\n");
            return false;
        }
        if (!function_exists('simplexml_load_string')) {
            IPS_LogMessage(__CLASS__, "Error: Need SimpleXML functions(simplexml_load_string)!\n");
            return false;
        }

        // Diese Zeile nicht löschen
        $json = __DIR__ . "/module.json";
        parent::__construct($InstanceID, $json);

        return true;
    }

    //--------------------------------------------------------
    /**
     * overload internal IPS_Create($id) function
     */
    public function Create()
    {
        // Diese Zeile nicht löschen.
        parent::Create();
        //Hint: $this->debug will not work in this stage! must use IPS_LogMessage
        //props
        $this->RegisterPropertyString('Category', 'AVM AHA Devices');
        $this->RegisterPropertyInteger('ParentCategory', 0); //parent cat is root
        $this->RegisterPropertyInteger('UpdateInterval', 600);
        $this->RegisterPropertyString('Host', 'fritz.box');
        $this->RegisterPropertyString('User', '');
        $this->RegisterPropertyString('Password', '');
        $this->RegisterPropertyBoolean('AutoCreate', true);
        $this->RegisterPropertyBoolean('Debug', false);
        $this->RegisterPropertyBoolean('Active', false);

        //Vars

        //reinit timer
        $this->RegisterTimer('Update', 0, $this->module_data["prefix"] . '_UpdateEvent($_IPS[\'TARGET\']);');

        if (IPS_GetKernelRunlevel() == self::KR_READY) {
            if ($this->isActive()) {
                $this->SetStatus(self::ST_AKTIV);
                $i = $this->GetUpdateInterval();
                $this->SetTimerInterval('Update', ($i * 1000));//ms
                $this->init();
            } else {
                $this->SetStatus(self::ST_INACTIV);
                $this->SetTimerInterval('Update', 0);
            }
        }

    }

    //--------------------------------------------------------
    /**
     * Destructor
     */
    public function Destroy()
    {
        parent::Destroy();
    }

    //--------------------------------------------------------
    /**
     * overload internal IPS_ApplyChanges($id) function
     */
    public function ApplyChanges()
    {
        // Diese Zeile nicht loeschen
        parent::ApplyChanges();
        if ($this->isActive()) {
            $this->SetStatus(self::ST_AKTIV);
            $i = $this->GetUpdateInterval();
            $this->SetTimerInterval('Update', ($i * 1000));//ms
            $this->init();

        } else {
            $this->SetStatus(self::ST_INACTIV);
            $this->SetTimerInterval('Update', 0);
        }

    }

    //--------------------------------------------------------
    //Get/Set
    //--------------------------------------------------------
    /**
     * Get Property category name to be created and used for Device Instnaces
     * @return string
     */
    private function GetCategory()
    {
        return (String)IPS_GetProperty($this->InstanceID, 'Category');
    }

    //--------------------------------------------------------
    /**
     * Get Property Parent Category ID
     * @return int
     */
    private function GetParentCategory()
    {
        return (Integer)IPS_GetProperty($this->InstanceID, 'ParentCategory');
    }

    //--------------------------------------------------------
    /**
     * Get Property UpdateInterval
     * @return int
     */
    private function GetUpdateInterval()
    {
        return (Integer)IPS_GetProperty($this->InstanceID, 'UpdateInterval');
    }

    //--------------------------------------------------------
    /**
     * Get Property Host
     * @return String
     */
    private function GetHost()
    {
        return (String)IPS_GetProperty($this->InstanceID, 'Host');
    }

    //--------------------------------------------------------
    /**
     * Get Property User
     * @return String
     */
    private function GetUser()
    {
        return (String)IPS_GetProperty($this->InstanceID, 'User');
    }

    //--------------------------------------------------------
    /**
     * Get Property Password
     * @return String
     */
    private function GetPassword()
    {
        return (String)IPS_GetProperty($this->InstanceID, 'Password');
    }

    //--------------------------------------------------------
    /**
     * Get Property LoginURL
     * @return String
     */
    private function GetLoginURL()
    {
        $host = $this->GetHost();
        $loginurl = "http://" . $host . self::login_path;
        return $loginurl;
    }
    //--------------------------------------------------------
    /**
     * Get Property AHAURL
     * @return String
     */
    private function GetAHAURL()
    {
        $host = $this->GetHost();
        $ahaurl = "http://" . $host . self::aha_path;
        return $ahaurl;
    }
    //------------------------------------------------------------------------------
    //---Events
    //------------------------------------------------------------------------------
    //------------------------------------------------------------------------------
    /**
     * Timer Event to read current data record from AHA Device(e.g.Fritzbox)
     * discard output
     */
    public function UpdateEvent()
    {
        $this->debug(__FUNCTION__, 'UpdateEvent');
        $this->Query();
    }
    //------------------------------------------------------------------------------
    //device functions
    //------------------------------------------------------------------------------

    //------------------------------------------------------------------------------
    /**
     * Initialization sequence
     */
    private function init()
    {
        $this->debug(__FUNCTION__, 'Init entered');

    }

    //------------------------------------------------------------------------------
    //Data Interfaces
    //------------------------------------------------------------------------------
    /**
     * Data Interface from Childs
     * @param string $JSONString
     */
    public function ForwardData($JSONString)
    {
        // decode Data from Device Instanz
        if (strlen($JSONString) > 0) {
            $this->debug(__FUNCTION__, 'Data arrived:' . $JSONString);
            $this->debuglog($JSONString);
            // decode Data from IO Instanz
            $data = json_decode($JSONString);
            //entry for data from parent
            if (is_object($data)) $data = get_object_vars($data);
            if (isset($data['DataID'])) {
                $target = $data['DataID'];
                switch ($target) {
                    case $this->module_interfaces['WS-TX']:
                        $buffer = utf8_decode($data['Buffer']);
                        $this->debug(__FUNCTION__, 'WS-TX:' . $buffer);
                        break;
                    case $this->module_interfaces['SWD-TX']:
                        $this->debug(__FUNCTION__, 'SWD-TX');
                        if (isset($data['Cap']) && isset($data['Value']) && isset($data['Device'])) {
                            $cap = $data['Cap'];
                            $val = $data['Value'];
                            $ain = $data['Device'];
                            switch ($cap) {
                                case 'Switch':
                                    $this->SwitchMode($ain, $val);
                                    break;
                                default:
                                    $this->debug(__FUNCTION__, 'SWD-TX: invalid Command ' . $cap);
                            }

                        } else {
                            $this->debug(__FUNCTION__, 'SWD-TX: invalid Data');
                        }


                        break;
                    case $this->module_interfaces['EN-TX']:
                        //$data=array();
                        $this->debug(__FUNCTION__, 'EN-TX');
                        break;
                }
            }//dataid
            else {
                $this->debug(__FUNCTION__, 'No DataID supplied');
            }//dataid
        }//len json
        else {
            $this->debug(__FUNCTION__, 'strlen(JSONString) == 0');
        }//else len json

    }

    //------------------------------------------------------------------------------
    //public functions
    //------------------------------------------------------------------------------
    /**
     * Send Switch command to Device
     * @param $ain String Actor ID
     * @param $val mixed new actor value
     * @return bool
     */
    //query actual state
    public function SwitchMode($ain, $val)
    {
        $state = $this->SwitchStatus($val);
        $ahaurl = $this->GetAHAURL();
        $sid = $this->GetSID();
        if (!isset($sid)) {
            IPS_LogMessage(__CLASS__, __FUNCTION__ . "::Error: Login failed");
            return false;
        }
        if (!isset($ain)) {
            IPS_LogMessage(__CLASS__, __FUNCTION__ . "::Error: AIN not defined");
            return false;
        }
        $url = $ahaurl . '?ain=' . rawurlencode($ain) . '&sid=' . $sid . '&switchcmd=getswitchstate';
        $answer = chop(@file_get_contents($url));
        $response = $http_response_header[0];
        if (!preg_match("/200\s+OK$/", $response)) {
            IPS_LogMessage(__CLASS__, __FUNCTION__ . "::Error: Query ($url) failed, Response: $response ");
            return false;
        }
        $this->debug(__FUNCTION__, "Actor $ain actual state:" . ($answer ? "ON" : "OFF"));
        if ((($answer == "1") != $state)) {
            //execute query
            $cmd = ($state == true) ? 'setswitchon' : 'setswitchoff';
            $this->debug(__FUNCTION__, "Actor $ain execute cmd:" . $cmd);
            $url = $ahaurl . '?ain=' . rawurlencode($ain) . '&sid=' . $sid . '&switchcmd=' . $cmd;
            $answer = @file_get_contents($url);
            $this->debug(__FUNCTION__, "Switch Actor $ain Answer : $answer");
            $response = $http_response_header[0];
            if (!preg_match("/200\s+OK$/", $response)) {
                IPS_LogMessage(__CLASS__, __FUNCTION__ . "::Error: Update Actor $ain failed, Response: $response");
                return false;
            }
        } else {
            $this->debug(__FUNCTION__, "No need to switch Actor $ain");
        }
        return true;
    }

    //------------------------------------------------------------------------------
    /**
     * Query Fritzbox
     */
    public function Query()
    {

        $ahaurl = $this->GetAHAURL();
        //login to switch
        $sid = $this->GetSID();
        if (!isset($sid)) {
            IPS_LogMessage(__CLASS__, __FUNCTION__ . "::Error: Login failed");
            return;
        }
        //$int_coding=mb_internal_encoding();
        $url = $ahaurl . '?sid=' . $sid;
        //query all device data using new getdevicelistinfos command at once
        $xmlstring = chop(@file_get_contents($url . "&switchcmd=getdevicelistinfos"));
        $response = $http_response_header[0];
        if ((preg_match("/200\s+OK$/", $response)) && (strlen($xmlstring) > 0)) {
            $this->Parse($xmlstring);
        } else {
            IPS_LogMessage(__CLASS__, __FUNCTION__ . "::Error: No Answer calling $url&switchcmd=getdevicelistinfos");
        }


    }
    //------------------------------------------------------------------------------
    //internal functions
    //------------------------------------------------------------------------------

    /**
     * parses switch status values to true/false
     * @param bool|mixed $val
     * @return bool
     */
    private function SwitchStatus($val)
    {
        if (is_bool($val)) {
            $status = $val;
        } elseif (is_string($val)) {
            $status = preg_match("/ON|1|True/i", $val);
        } elseif (is_integer($val)) {
            $status = ($val > 0);
        } else {
            $status = (bool)$val;
        }
        return $status;
    }


    //------------------------------------------------------------------------------
    /**
     * @param $xmlstring string XML Data
     */
    private function Parse($xmlstring)
    {

        $xml = simplexml_load_string($xmlstring);
        $this->debug(__FUNCTION__, $xmlstring);
        if (!$xml || !$xml->device) {
            IPS_LogMessage(__CLASS__, __FUNCTION__ . "::Error: Unexpected Answer for cmd=getdevicelistinfos");
            return;
        }
        /*
              // debug Comet Dect
                 $dev=$xml->addChild('device');
                 $dev->addAttribute('identifier','10045 67895');
                 $dev->addAttribute('functionbitmask',(1<<6));
                 $dev->addChild('name','Comet Dect Test #1');
                 $dev->addChild('present',1);
                 $hkr=$dev->addChild('hkr');
                 $hkr->addChild('tist',43);
                 $hkr->addChild('komfort',46);
                 $hkr->addChild('absenk',38);
                 $hkr->addChild('tsoll',44);
        //
        */
        foreach ($xml->device as $device) {
            $data = array();
            //attributes
            $ain = (string)$device->attributes()['identifier'];
            $pname = (string)$device->attributes()['productname'];
            $name = (string)$device->name;
            $conn = (((integer)$device->present) == 1);
            $data['Id'] = $ain;
            $data['Typ'] = $pname;
            $data['Name'] = $name;
            $data['Connect'] = $conn;
            $enc = mb_internal_encoding();
            if ($enc == 'ISO-8859-1') {
                $name = mb_convert_encoding($name, 'ISO-8859-1', 'UTF-8');
            }
            //capabilities
            $mask = (integer)$device->attributes()['functionbitmask'];
            $has_hkr = ($mask & (1 << 6)) > 0;
            $has_powermeter = ($mask & (1 << 7)) > 0;
            $has_temperatur = ($mask & (1 << 8)) > 0;
            $has_switch = ($mask & (1 << 9)) > 0;
            $has_repeater = ($mask & (1 << 10)) > 0;


            //analyze data
            $txt = '';
            if ($has_hkr) {
                //bit6=HKR heating Device Comet , as of Fritz!OS 6.50
                if (isset($device->hkr)) {
                    //data available
                    //values are 0.5C steps 16-56 or 253(On) or 254(off)

                    $tist = $device->hkr->tist / 2;
                    $komfort = $device->hkr->komfort / 2;
                    $absenk = $device->hkr->absenk / 2;
                    $tsoll = $device->hkr->tsoll;
                    if (($tsoll >= 16) && ($tsoll <= 56)) {
                        $tsoll = $tsoll / 2;
                    } elseif ($tsoll == 254) {
                        $tsoll = 0;
                    } elseif ($tsoll == 253) {
                        $tsoll = -1;
                    }
                    $caps = 'Tist;Tsoll;Treduced;TComfort';
                    $data['tist'] = $tist;
                    $data['tsoll'] = $tist;
                    $data['reduced'] = $absenk;
                    $data['comfort'] = $komfort;
                    $txt = sprintf(" HKR(Act:%02.1fC ,Target:%02.1fC ,Sink:%02.1fC, Comfort:%02.1fC); ", $tist, $tsoll, $absenk, $komfort);
                    $this->debug(__FUNCTION__ . "_HKR", $txt);
                    $this->SendHKRData($caps, $data);
                }
            }
            if ($has_powermeter) {
                //bit7=enery meter
                if (isset($device->powermeter)) {
                    //data available
                    $power = (integer)$device->powermeter->power;
                    $actual = $power / 1000; //mW->W
                    $counter = (integer)$device->powermeter->energy;
                    $new_total = $counter / 1000;//Wh ->KWh
                    $caps = 'APower;TPower;Counter';
                    $data['Counter'] = $counter;
                    $data['APower'] = $actual;
                    $data['TPower'] = $new_total;
                    $txt = " Power(Act:" . $actual . " W, Power: $power mW, Counter:$new_total); ";
                    $this->debug(__FUNCTION__ . "_Power", $txt);
                    $this->SendENData($caps, $data);
                }
            }
            if ($has_temperatur) {
                //bit8=temperature sensor
                if (isset($device->temperature)) {
                    $temperatur = ((integer)$device->temperature->celsius) / 10;
                    $offset = ((integer)$device->temperature->offset) / 10;
                    $temperatur = $temperatur + $offset;
                    $caps = 'Temp';
                    $data['Temp'] = $temperatur;
                    $txt = sprintf(" Temperature:(Temp:%02.1fC, Offset:%02.1f) ;", $temperatur, $offset);
                    $this->debug(__FUNCTION__ . "_Temp", $txt);
                    $this->SendWSData($caps, $data);
                }
            }
            if ($has_switch) {
                //bit9=power switch
                if (isset($device->switch)) {
                    $status = (string)$device->switch->state;
                    $status = ($status == "1");
                    $caps = 'Switch';
                    $data['Switch'] = $status;
                    $txt = " Switch(Status:" . ($status ? "On" : "Off") . "); ";
                    $this->debug(__FUNCTION__ . "_Switch", $txt);
                    $this->SendSwitchData($caps, $data);
                }
            }
            if ($has_repeater) {
                //bit10=Repeater, no special variables as of now FritzOS 6.50
                $txt = " Repeater(detected); ";
                $this->debug(__FUNCTION__ . "_Rep", $txt);
            }
            //logging
            $this->debug(__FUNCTION__, $name . ":" . ($conn ? 'connected' : 'disconnected') . $txt);
        }
    }
    //-------------------------------------------------------------------------------
    /**
     * login into fritz and get sid
     * @return string sid
     */
    private function GetSID()
    {
        $loginurl = $this->GetLoginURL();
        $username = $this->GetUser();
        $password = $this->GetPassword();
        if (!$password) {
            IPS_LogMessage(__CLASS__, __FUNCTION__ . "::Error: Password not defined");
            return null;
        }
        if (is_null($username)) $username = '';
        // get challenge string
        $http_response = file_get_contents($loginurl);
        $response = $http_response_header[0];
        if (preg_match("/200\s+OK$/", $response)) {
            $xml = simplexml_load_string($http_response);
            $challenge = (string)$xml->Challenge;
            $sid = (string)$xml->SID;
        } else {
            IPS_LogMessage(__CLASS__, __FUNCTION__ . "::Error: GetSid with $loginurl failed, Response: $response");
            return null;
        }

        if ((strlen($sid) > 0) && (preg_match("/^[0]+$/", $sid)) && $challenge) {
            //sid is null, got challenge
            //build password response
            $pass = $challenge . "-" . $password;
            //UTF-16LE encoding as required
            $pass = mb_convert_encoding($pass, "UTF-16LE");
            //md5hash on top
            $md5 = md5($pass);
            //final answer string
            $challenge_response = $challenge . "-" . $md5;
            //send to box
            $url = $loginurl . "?username=" . $username . "&response=" . $challenge_response;
            $http_response = file_get_contents($url);
            //check answer
            $xml = simplexml_load_string($http_response);
            $sid = (string)$xml->SID;
            if ((strlen($sid) > 0) && !preg_match("/^[0]+$/", $sid)) {
                //is not null, bingo!
                return $sid;
            }

        } else {
            //use existing sid if $sid matches an hex string
            if ((strlen($sid) > 0) && (preg_match("/^[0-9a-f]+$/", $sid))) return $sid;
        }
        return null;
    }//function

    //------------------------------------------------------------------------------
    /**
     * Forward weather data to WSDev instances
     * Create one if needed
     * @param $caps string
     * @param $data array
     */
    private function SendWSData($caps, $data)
    {
        //parsing was OK, start distributing
        $this->debug(__FUNCTION__, 'Prepare');
        $datum = date('Y-m-d H:i:s', time());
        $data['Date'] = $datum;
        $Device = $data['Id'];
        $typ = $data['Typ'];
        $class = __CLASS__ . "-WS";
        $found = false;
        $instID = 0;
        $instances = IPS_GetInstanceListByModuleID($this->module_interfaces['WSDEV']);
        foreach ($instances as $instID) {
            $I = @IPS_GetInstance($instID);

            if ($I && ($I['ConnectionID'] == $this->InstanceID)) { //my child
                $iid = (String)IPS_GetProperty($instID, 'DeviceID');
                $ityp = (String)IPS_GetProperty($instID, 'Typ');
                $iclass = (String)IPS_GetProperty($instID, 'Class');
                $this->debug(__FUNCTION__, "Check my Device '$Device'' with Instance $instID($iid)");
                if (($iid == $Device) && ($iclass == $class) && ($ityp == $typ)) {
                    $this->debug(__FUNCTION__, 'Use existing ID:' . $instID);
                    $found = true;
                    break;
                }//if destdevice
            }//if
        }//for
        if (!$found) {
            //no free instance available, have to create a new one
            if ($this->ReadPropertyBoolean('AutoCreate') == true) {
                //new instance needed
                $instID = $this->CreateWSDevice($data, $caps);
                if ($instID > 0) {
                    $this->debug(__FUNCTION__, 'Created WSDEV with Caps: ' . $caps);
                    $found = true;
                }
            } else {
                $this->debug(__FUNCTION__, 'Creating AHA WS Device AIN ' . $Device . ' disabled by Property AutoCreate');
                IPS_LogMessage($class, 'Creating AHA WSDEV Device AIN' . $Device . ' disabled by Property AutoCreate');
            }//if autocreate
        }//if found
        if ($found && ($instID > 0)) {
            //send record to children
            $json = json_encode(
                array("DataID" => $this->module_interfaces['WS-RX'],
                    "DeviceID" => $Device,
                    "Class" => $class,
                    "Typ" => $typ,
                    "WSData" => $data));
            $this->debug(__FUNCTION__, $json);
            @$this->SendDataToChildren($json);
        }//found
    }//function

    //--------------------------------------------------------
    /**
     * Create a new WSDev instance and set its properties
     * @param array $data parsed record
     * @param String $caps String semicolon seperated capabilities of this device
     * @return int new Instance ID
     */
    private function CreateWSDevice($data, $caps)
    {
        $instID = 0;
        $Device = $data['Id'];
        $typ = $data['Typ'];
        $name = $data['Name'];
        if (!$name) $name = "$typ ($Device)";
        $host = $this->GetHost();
        $class = __CLASS__ . "-WS";
        $ModuleID = $this->module_interfaces['WSDEV'];
        if (IPS_ModuleExists($ModuleID)) {
            //return $result;
            $this->debug(__FUNCTION__, 'Device:' . $Device);
            $instID = IPS_CreateInstance($ModuleID);
            if ($instID > 0) {
                IPS_ConnectInstance($instID, $this->InstanceID);  //Parents are ourself!
                IPS_SetProperty($instID, 'DeviceID', $Device);
                IPS_SetProperty($instID, 'Class', $class);
                IPS_SetProperty($instID, 'Typ', $typ);
                IPS_SetProperty($instID, 'CapList', $caps);
                IPS_SetProperty($instID, 'Debug', $this->isDebug()); //follow debug settings from splitter
                IPS_SetName($instID, "Temperatur Sensor on '$name'");
                $ident = $class . "_$Device on $host";
                $ident = preg_replace("/\W/", "_", $ident);//nicht-Buchstaben/zahlen entfernen
                IPS_SetIdent($instID, $ident);
                IPS_ApplyChanges($instID);
                $cat = $this->GetCategory() . " on " . $host;
                $pcat = $this->GetParentCategory();
                $ident = preg_replace("/\W/", "_", $cat);//nicht-Buchstaben/zahlen entfernen
                $catid = @IPS_GetObjectIDByIdent($ident, $pcat);
                if ($catid == 0) {
                    $catid = IPS_CreateCategory();
                    IPS_SetName($catid, $cat);
                    if (IPS_SetIdent($catid, $ident) && IPS_SetParent($catid, $pcat)) {
                        IPS_LogMessage($class, "Category $cat Ident $ident ($catid) created");
                    } else {
                        IPS_LogMessage($class, "Category $cat Ident $ident ($catid) FAILED");
                    }

                }
                $this->debug(__FUNCTION__, "Category:$catid");
                if (!IPS_SetParent($instID, $catid)) {
                    $this->debug(__FUNCTION__, "SetParent Instance $instID to Cat $catid failed, Dropping instance");
                    IPS_DeleteInstance($instID);
                    $instID = 0;
                } else {
                    $this->debug(__FUNCTION__, 'New ID:' . $instID);
                };
                //if instID
            } else {
                $this->debug(__FUNCTION__, 'Instance  is not created!');
            }
        }//module exists
        return $instID;
    }//function

    //------------------------------------------------------------------------------
    /**
     * Forward Switch data to SwitchDev instances
     * Create one if needed
     * @param $caps string
     * @param $data array
     */
    private function SendSwitchData($caps, $data)
    {
        $this->debug(__FUNCTION__, 'Prepare');
        $datum = date('Y-m-d H:i:s', time());
        $data['Date'] = $datum;
        $Device = $data['Id'];
        $typ = $data['Typ'];
        $class = __CLASS__ . "-SW";
        $found = false;
        $instID = 0;
        $instances = IPS_GetInstanceListByModuleID($this->module_interfaces['SwitchDev']);
        foreach ($instances as $instID) {
            $I = IPS_GetInstance($instID);
            $iid = (String)IPS_GetProperty($instID, 'DeviceID');
            $ityp = (String)IPS_GetProperty($instID, 'Typ');
            $iclass = (String)IPS_GetProperty($instID, 'Class');
            $this->debug(__FUNCTION__, "Check my Device '$Device'' with Instance $instID($iid)");
            if ($I['ConnectionID'] == $this->InstanceID) { //my child
                if (($iid == $Device) && ($iclass == $class) && ($ityp == $typ)) {
                    $this->debug(__FUNCTION__, 'Use existing ID:' . $instID);
                    $found = true;
                    break;
                }//if destdevice

            }//if
        }//for
        if (!$found) {
            //no free instance available, have to create a new one
            if ($this->ReadPropertyBoolean('AutoCreate') == true) {
                //new instance needed
                $this->debug(__FUNCTION__, 'CREATE NEW Device AIN ' . $Device);
                $instID = $this->CreateSwitchDevice($data, $caps);
                $found = true;
            } else {
                $this->debug(__FUNCTION__, 'Creating AHA Switch Device AIN ' . $Device . ' disabled by Property AutoCreate');
                IPS_LogMessage($class, 'Creating AHA Switch Device AIN' . $Device . ' disabled by Property AutoCreate');
            }//if autocreate
        }//if found

        if ($found && ($instID > 0)) {
            //send record to children
            $json = json_encode(
                array("DataID" => $this->module_interfaces['SWD-RX'],
                    "DeviceID" => $Device,
                    "Typ" => $typ,
                    "Class" => $class,
                    "SWData" => $data,
                )
            );

            $this->debug(__FUNCTION__, $json);
            @$this->SendDataToChildren($json);

        }//found
    }//function

    //--------------------------------------------------------
    /**
     * Create a new SwitchDev instance and set its properties
     * @param array $data parsed record
     * @param String $caps String semicolon seperated capabilities of this device
     * @return int new Instance ID
     */
    private function CreateSwitchDevice($data, $caps)
    {
        $instID = 0;
        $Device = $data['Id'];
        $typ = $data['Typ'];
        $name = $data['Name'];
        if (!$name) $name = "$typ ($Device)";
        $host = $this->GetHost();
        $class = __CLASS__ . "-SW";
        $ModuleID = $this->module_interfaces['SwitchDev'];
        if (IPS_ModuleExists($ModuleID)) {
            //return $result;
            $this->debug(__FUNCTION__, 'Device:' . $Device);
            $instID = IPS_CreateInstance($ModuleID);
            if ($instID > 0) {
                IPS_SetProperty($instID, 'DeviceID', $Device);
                IPS_SetProperty($instID, 'Class', $class);
                IPS_SetProperty($instID, 'Typ', $typ);
                IPS_SetProperty($instID, 'CapList', $caps);
                IPS_SetProperty($instID, 'Debug', $this->isDebug()); //follow debug settings from splitter
                IPS_SetName($instID, "Switch on '$name'");
                $ident = $class . "_$Device on $host";
                $ident = preg_replace("/\W/", "_", $ident);//nicht-Buchstaben/zahlen entfernen
                IPS_SetIdent($instID, $ident);
                IPS_ConnectInstance($instID, $this->InstanceID);
                IPS_ApplyChanges($instID);

                //set category
                $cat = $this->GetCategory() . " on " . $host;
                $pcat = $this->GetParentCategory();
                $ident = preg_replace("/\W/", "_", $cat);//fix naming
                $catid = @IPS_GetObjectIDByIdent($ident, $pcat);
                if ($catid == 0) {
                    $catid = IPS_CreateCategory();
                    IPS_SetName($catid, $cat);
                    if (IPS_SetIdent($catid, $ident) && IPS_SetParent($catid, $pcat)) {
                        IPS_LogMessage($class, "Category $cat Ident $ident ($catid) created");
                    } else {
                        IPS_LogMessage($class, "Category $cat Ident $ident ($catid) FAILED");
                    }

                }
                $this->debug(__FUNCTION__, "Category:$catid");
                if (!IPS_SetParent($instID, $catid)) {
                    $this->debug(__FUNCTION__, "SetParent Instance $instID to Cat $catid failed, Dropping instance");
                    IPS_DeleteInstance($instID);
                    $instID = 0;
                } else {
                    $this->debug(__FUNCTION__, 'New ID:' . $instID);
                };

                //if instID
            } else {
                $this->debug(__FUNCTION__, 'Instance  is not created!');
            }
        }//module exists
        return $instID;
    }//function


    //------------------------------------------------------------------------------
    /**
     * Forward Energy data to EnergyDev instances
     * Create one if needed
     * @param $caps string
     * @param $data array
     */
    private function SendENData($caps, $data)
    {
        $this->debug(__FUNCTION__, 'Prepare');
        $datum = date('Y-m-d H:i:s', time());
        $data['Date'] = $datum;
        $Device = $data['Id'];
        $typ = $data['Typ'];
        $found = false;
        $instID = 0;
        $class = __CLASS__ . "-EN";
        $instances = IPS_GetInstanceListByModuleID($this->module_interfaces['EnergyDev']);
        foreach ($instances as $instID) {
            $I = IPS_GetInstance($instID);
            $iid = (String)IPS_GetProperty($instID, 'DeviceID');
            $ityp = (String)IPS_GetProperty($instID, 'Typ');
            $iclass = (String)IPS_GetProperty($instID, 'Class');
            $this->debug(__FUNCTION__, "Check my Device '$Device'' with Instance $instID($iid)");
            if ($I['ConnectionID'] == $this->InstanceID) { //my child
                if (($iid == $Device) && ($iclass == $class) && ($ityp == $typ)) {
                    $this->debug(__FUNCTION__, 'Use existing ID:' . $instID);
                    $found = true;
                    break;
                }//if destdevice

            }//if
        }//for
        if (!$found) {
            //no free instance available, have to create a new one
            if ($this->ReadPropertyBoolean('AutoCreate') == true) {
                //new instance needed
                $this->debug(__FUNCTION__, 'CREATE NEW Device AIN ' . $Device);
                $instID = $this->CreateEnergyDevice($data, $caps);
                $found = true;
            } else {
                $this->debug(__FUNCTION__, 'Creating AHA Energy Device AIN ' . $Device . ' disabled by Property AutoCreate');
                IPS_LogMessage(__CLASS__, 'Creating AHA Energy Device AIN ' . $Device . ' disabled by Property AutoCreate');
            }//if autocreate
        }//if found

        if ($found && ($instID > 0)) {
            //send record to children
            $json = json_encode(
                array("DataID" => $this->module_interfaces['EN-RX'],
                    "DeviceID" => $Device,
                    "Typ" => $typ,
                    "Class" => $class,
                    "ENData" => $data,
                )
            );

            $this->debug(__FUNCTION__, $json);
            @$this->SendDataToChildren($json);

        }//found
    }//function

    //--------------------------------------------------------
    /**
     * Create a new EnergyDev instance and set its properties
     * @param array $data parsed record
     * @param String $caps String semicolon seperated capabilities of this device
     * @return int new Instance ID
     */
    private function CreateEnergyDevice($data, $caps)
    {
        $instID = 0;
        $Device = $data['Id'];
        $typ = $data['Typ'];
        $name = $data['Name'];
        if (!$name) $name = "$typ ($Device)";
        $class = __CLASS__ . "-EN";
        $host = $this->GetHost();
        $ModuleID = $this->module_interfaces['EnergyDev'];
        if (IPS_ModuleExists($ModuleID)) {
            //return $result;
            $this->debug(__FUNCTION__, 'Device:' . $Device);
            $instID = IPS_CreateInstance($ModuleID);
            if ($instID > 0) {
                IPS_SetProperty($instID, 'DeviceID', $Device);
                IPS_SetProperty($instID, 'Class', $class);
                IPS_SetProperty($instID, 'Typ', $typ);
                IPS_SetProperty($instID, 'CapList', $caps);
                IPS_SetProperty($instID, 'Debug', $this->isDebug()); //follow debug settings from splitter
                IPS_SetName($instID, "Power Sensor on '$name'");
                $ident = $class . "_$Device on $host";
                $ident = preg_replace("/\W/", "_", $ident);//nicht-Buchstaben/zahlen entfernen
                IPS_SetIdent($instID, $ident);
                IPS_ConnectInstance($instID, $this->InstanceID);
                IPS_ApplyChanges($instID);

                //set category
                $cat = $this->GetCategory() . " on " . $host;
                $pcat = $this->GetParentCategory();
                $ident = preg_replace("/\W/", "_", $cat);//fix naming
                $catid = @IPS_GetObjectIDByIdent($ident, $pcat);
                if ($catid == 0) {
                    $catid = IPS_CreateCategory();
                    IPS_SetName($catid, $cat);
                    if (IPS_SetIdent($catid, $ident) && IPS_SetParent($catid, $pcat)) {
                        IPS_LogMessage($class, "Category $cat Ident $ident ($catid) created");
                    } else {
                        IPS_LogMessage($class, "Category $cat Ident $ident ($catid) FAILED");
                    }

                }
                $this->debug(__FUNCTION__, "Category:$catid");
                if (!IPS_SetParent($instID, $catid)) {
                    $this->debug(__FUNCTION__, "SetParent Instance $instID to Cat $catid failed, Dropping instance");
                    IPS_DeleteInstance($instID);
                    $instID = 0;
                } else {
                    $this->debug(__FUNCTION__, 'New ID:' . $instID);
                };

                //if instID
            } else {
                $this->debug(__FUNCTION__, 'Instance  is not created!');
            }
        }//module exists
        return $instID;
    }
    //------------------------------------------------------------------------------
    /**
     * Forward HKR data to HeatingDev instances
     * Create one if needed
     * ToDo: must be implemented
     * @param $caps string
     * @param $data array
     */
    private function SendHKRData($caps, $data)
    {
        IPS_LogMessage(__CLASS__, __FUNCTION__ . '::Not implemented yet');

    }
}//class
