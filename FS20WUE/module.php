<?
/**
 * @file
 *
 * FS20WUE IPSymcon PHP Splitter Module Class
 *
 * @author Thomas Dressler
 * @copyright Thomas Dressler 2011-2016
 * @version 1.5
 * @date 2016-04-06
 */
/**
 * common module helper function
 */
include_once(__DIR__ . "/../module_helper.php");
/**
 * fhz/fs20 specific data and functions
 */
include_once(__DIR__ . "/../fhz_helper.php");

/** @class FS20WUE
 *
 * FS20WUE IPSymcon PHP Splitter Module Class
 * 
 * @par Prefix: WUE
 *
 * @par Properties
 *
 * - \b  Active (Default: Off/Inactive):
 *
 * - \b Category (Default 'WDE1 Devices'):  name of category for subsequent devices
 *
 * - \b ParentCategory (Default 0): ID of parent category for newly created category
 *
 * - \b RainPerCount (Default 295): How much rain will be counted for one count (mm/1000), Range: 200-500
 *
 * - \b Logfile (Default none): optional fully qualified filename of a logfile.
 * File will be in csv format with one line per sensor. Header will be in the first line
 * 
 * - \b AutoCreate (Default: On/True): Flag to allow autocreation of new Device Instances below Category
 *
 * - \b Debug: Flag to enable debug output via IPS_LogMessages
 *
 * @par Actions (if supported by the attached splitter and the physical device)
 *
 * - \b None
 *
 * @see http://www.elv.de/fs20-und-wetterdaten-uart-empfaenger-fs20-wue-komplettbausatz.html
 *
 */
class FS20WUE extends T2DModule
{
    //------------------------------------------------------------------------------
    //module const and vars
    //------------------------------------------------------------------------------
    /**
     * Timer constant
     * maxage of LastUpdate in sec before ReInit
     */
    const MAXAGE = 300;

    /**
     * Fieldlist for Logging
     */
    const fieldlist = "Time;Typ;id;Name;Temp;Hum;Bat;Lost;Wind;Rain;IsRaining;RainCounter;Pressure;willi;";


    //--------------------------------------------------------
    // main module functions
    //--------------------------------------------------------
    /**
     * Constructor
     * @param $InstanceID
     */
    public function __construct($InstanceID)
    {
        // Diese Zeile nicht löschen
        $json = __DIR__ . "/module.json";
        parent::__construct($InstanceID, $json);
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
        $this->RegisterPropertyString('Category', 'FS20WUE Devices');
        $this->RegisterPropertyInteger('ParentCategory', 0); //parent cat is root
        $this->RegisterPropertyInteger('RainPerCount', 295);
        $this->RegisterPropertyString('LogFile', '');
        $this->RegisterPropertyBoolean('AutoCreate', true);
        $this->RegisterPropertyBoolean('Debug', false);
        $this->RegisterPropertyBoolean('Active', false);

        //Vars
        $this->RegisterVariableString('Buffer', 'Buffer', "", -1);
        IPS_SetHidden($this->GetIDForIdent('Buffer'), true);
        $this->RegisterVariableString('LastUpdate', 'Last Update', "", -2);
        IPS_SetHidden($this->GetIDForIdent('LastUpdate'), true);

        //reinit timer
        $this->RegisterTimer('ReInit', 60000, $this->module_data["prefix"] . '_ReInitEvent($_IPS[\'TARGET\']);');


        //Connect Parent
        $this->RequireParent($this->module_interfaces['SerialPort']);
        $pid = $this->GetParent();
        if ($pid) {
            $name = IPS_GetName($pid);
            if ($name == "Serial Port") IPS_SetName($pid, __CLASS__ . " Port");
        }

        //call init if ready and activated
        if (IPS_GetKernelRunlevel() == self::KR_READY) {
            if ($this->isActive()) {
                $this->SetStatus(self::ST_AKTIV);
                $this->init();
            } else {
                $this->SetStatus(self::ST_INACTIV);
                $this->SetTimerInterval('ReInit', 0);
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
        if ($this->isActive() && $this->HasActiveParent()) {
            $this->SetStatus(self::ST_AKTIV);
            $this->init();
        } else {
            $this->SetStatus(self::ST_INACTIV);
            $this->SetTimerInterval('ReInit', 0);
        }

    }

    //--------------------------------------------------------
    //Get/Set
    //--------------------------------------------------------
    /**
     * Get Property logfile name
     * @return string
     */
    private function GetLogFile()
    {
        return (String)IPS_GetProperty($this->InstanceID, 'LogFile');
    }

    //------------------------------------------------------------------------------
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

    //------------------------------------------------------------------------------
    /**
     * Set Property RainPerCount
     * This is the amount of rain per count of wipe in mm*1000
     * Limit 200..500, default 295
     * @param Integer $rainpercount
     */
    public function SetRainPerCount($rainpercount)
    {
        if (IPS_GetProperty($this->InstanceID, 'RainPerCount') != $rainpercount) {
            if (($rainpercount > 500) || ($rainpercount < 200)) {
                IPS_LogMessage(__CLASS__, __FUNCTION__ . ":: Rain per Count invalid ($rainpercount mm ), cancel");
                return;
            }
            IPS_SetProperty($this->InstanceID, 'RainPerCount', $rainpercount);
        }
    }

    //------------------------------------------------------------------------------
    /**
     * Get Property RainPerCount
     * @return int
     */
    private function GetRainPerCount()
    {

        return (Integer)IPS_GetProperty($this->InstanceID, 'RainPerCount');
    }

    //------------------------------------------------------------------------------
    /**
     * Get status variable Buffer
     * contains incoming data from IO, act as regVar
     * @return String
     */
    private function GetBuffer()
    {
        $id = $this->GetIDForIdent('Buffer');
        $val = GetValueString($id);
        return $val;
    }

    //------------------------------------------------------------------------------
    /**
     * Set status variable Buffer
     * @param String $val
     */
    private function SetBuffer($val)
    {
        $id = $this->GetIDForIdent('Buffer');
        SetValueString($id, $val);
    }

    //------------------------------------------------------------------------------
    //---Events
    //------------------------------------------------------------------------------
    /**
     * Timer Event to reinitialize system
     * Executed if there are no valid data within Timer as indicated by LastUpdate
     */
    public function ReInitEvent()
    {
        $id = @$this->GetIDForIdent('LastUpdate');
        if (!$id) return;
        $var = IPS_GetVariable($id);
        if (!$var) return;
        $last = $var['VariableUpdated'];
        //if (!$last) $last=0;
        $now = time();
        $diff = $now - $last;
        $this->debug(__FUNCTION__, "last update $diff s ago");
        if (($diff > self::MAXAGE) && $this->isActive() && $this->HasActiveParent()) {
            $this->init();
        }
    }

    //------------------------------------------------------------------------------
    //device functions
    //------------------------------------------------------------------------------
    /**
     * Set IO properties
     */
    private function SyncParent()
    {
        $ParentID = $this->GetParent();
        if ($ParentID > 0) {
            $this->debug(__FUNCTION__, 'entered');
            $ParentInstance = IPS_GetInstance($ParentID);
            if ($ParentInstance['ModuleInfo']['ModuleID'] == $this->module_interfaces['SerialPort']) {
                if (IPS_GetProperty($ParentID, 'DataBits') <> 8)
                    IPS_SetProperty($ParentID, 'DataBits', 8);
                if (IPS_GetProperty($ParentID, 'StopBits') <> 1)
                    IPS_SetProperty($ParentID, 'StopBits', 1);
                if (IPS_GetProperty($ParentID, 'BaudRate') <> 4800)
                    IPS_SetProperty($ParentID, 'BaudRate', 4800);
                if (IPS_GetProperty($ParentID, 'Parity') <> 'None')
                    IPS_SetProperty($ParentID, 'Parity', "None");

                if (IPS_HasChanges($ParentID)) {
                    IPS_SetProperty($ParentID, 'Open', false);
                    @IPS_ApplyChanges($ParentID);
                    IPS_Sleep(200);
                    $port = IPS_GetProperty($ParentID, 'Port');
                    if ($port) {
                        IPS_SetProperty($ParentID, 'Open', true);
                        @IPS_ApplyChanges($ParentID);
                    }

                }
            }//serialPort
        }//parentID
    }//function


    //------------------------------------------------------------------------------
    /**
     * Initialization sequence
     */
    private function init()
    {
        $this->debug(__FUNCTION__, 'Init entered');
        $this->SyncParent();
        $this->SetBuffer('');
        $this->SetTimerInterval('ReInit', 60000);
        if (!$this->HasActiveParent()) {
            $this->debug(__FUNCTION__, 'No active parent');
            return;
        }
        $this->SendDataToParent(chr(2) . chr(2) . chr(0xF1) . chr(1)); //enable FS20 immediate send
        IPS_Sleep(15);
        $this->SendDataToParent(chr(2) . chr(2) . chr(0xF2) . chr(1)); //enable weather immediate send
        IPS_Sleep(15);
        $this->SendDataToParent(chr(2) . chr(2) . chr(0xFB) . chr(0)); //use binary protocol
        IPS_Sleep(100);
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
                    case $this->module_interfaces['FS20-TX']:
                        $this->debug(__FUNCTION__, 'FS20-TX');
                        break;
                    case $this->module_interfaces['SWD-TX']:
                        $this->debug(__FUNCTION__, 'SWD-TX');
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
    /**
     * Data Interface from Parent(IO-RX)
     * @param string $JSONString
     */
    public function ReceiveData($JSONString)
    {
        //status check triggered by data
        if ($this->isActive() && $this->HasActiveParent()) {
            $this->SetStatus(self::ST_AKTIV);
        } else {
            $this->SetStatus(self::ST_INACTIV);
            $this->debug(__FUNCTION__, 'Data arrived, but dropped because inactiv:' . $JSONString);
            return;
        }
        // decode Data from Device Instanz
        if (strlen($JSONString) > 0) {
            $this->debug(__FUNCTION__, 'Data arrived:' . $JSONString);
            $this->debuglog($JSONString);
            // decode Data from IO Instanz
            $data = json_decode($JSONString);
            //entry for data from parent

            $buffer = $this->GetBuffer();
            if (is_object($data)) $data = get_object_vars($data);
            if (isset($data['DataID'])) {
                $target = $data['DataID'];
                if ($target == $this->module_interfaces['IO-RX']) {
                    $buffer .= utf8_decode($data['Buffer']);
                    $this->debug(__FUNCTION__, strToHex($buffer));
                    $bl = strlen($buffer);
                    if ($bl > 500) {
                        $buffer = substr($buffer, 500);
                        IPS_LogMessage(__CLASS__, "Buffer length exceeded, dropping...");
                    }
                    //entry point for data from parent
                    //reduce input from prepending bytes until start byte
                    while ($bl > 7) {
                        $fstart = false;
                        $indata = str_split($buffer);
                        $il = count($indata);
                        while ($il > 0) {
                            $bt = $indata[0];
                            $b = ord($bt);
                            if ($b == 2) {
                                $fstart = true;
                                break;
                            } else {
                                array_splice($indata, 0, 1);
                                $il = count($indata);
                                continue;  //waitfor start
                            }//if 02
                        }//while
                        if (!$fstart) {
                            $this->SetBuffer($buffer);
                            return;
                        }
                        $il = count($indata);
                        if ($il > 7) {
                            $dl = ord($indata[1]);
                            if ($il >= ($dl + 2)) {
                                //enough data available, frame may complete
                                $data = array_splice($indata, 0, $dl + 2);
                                $b = ord($data[2]);
                                switch ($b) {
                                    case 0xA1:
                                        $this->parse_switch($data);
                                        break;
                                    case 0xA2:
                                        $this->parse_weather($data);
                                        break;
                                    default:
                                        $this->debug(__FUNCTION__, 'Unknown Typ:' . strToHex($data[2]));
                                }//switch b
                            }//l>=dl+2
                        }//if il>7
                        $buffer = implode("", $indata);
                        $bl = strlen($buffer);
                    }//while bl>0
                    $this->SetBuffer($buffer);
                }//target
            }//dataid
            else {
                $this->debug(__FUNCTION__, 'No DataID supplied');
            }//dataid
        } else {
            $this->debug(__FUNCTION__, 'strlen(JSONString) == 0');
        }//else len json
    }//func

    //------------------------------------------------------------------------------
    /**
     * Data Interface tp Parent (IO-TX)
     * @param String $Data
     * @return bool
     */
    public function SendDataToParent($Data)
    {
        $res = false;
        $json = json_encode(
            array("DataID" => $this->module_interfaces['IO-TX'],
                "Buffer" => utf8_encode($Data)));
        if ($this->HasActiveParent()) {
            $this->debug(__FUNCTION__, strToHex($Data));
            $res = parent::SendDataToParent($json);
            //$this->mh->debuglog($Data);
        } else {
            $this->debug(__FUNCTION__, 'No Parent');
        }
        return $res;
    }//function

    //------------------------------------------------------------------------------
    //internal functions
    //------------------------------------------------------------------------------
    /**
     *  parses an record string
     * @param array $packet
     * @return bool
     */
    private function parse_weather($packet)
    {
        /*
             02 0C A2 01 00 00 DD 01 65 00 00 00 00 00
        Data:02 0C A2 P  A  TT FF WW NN R
        P=Typ->01=T/F Sensor, 07:KS200/300
        A=Adresse 0..7
        TT=Temperatur /2er-Complemnt)
        FF=Feuchte (0.1%)
        WW=Windgeschwindigkei(0.1kmH)
        NN=Niederschlag(Wippenschlaege)
        R=Regenflag 0->Nein, 1 Ja
        */

        $this->debug(__FUNCTION__, 'Parse');
        $l = count($packet);
        if ($l <> 14) {
            $this->debug(__FUNCTION__, 'Length wrong:' . $l . '<->14');
            return false;
        }//if len
        $device = ord($packet[4]);
        if (($device < 0) || ($device > 7)) {
            $this->debug(__FUNCTION__, 'Address ' . $device . ' unknown');
            return false;
        }//if device
        $b = ord($packet[3]);
        switch ($b) {
            case 1:
                break;
            case 7:
                $device = 8;
                break;
            default:
                $this->debug(__FUNCTION__, 'Type ' . $b . ' unknown');
                return false;
        }
        $t = round(((ord($packet[5]) * 256) + ord($packet[6])) / 10, 1);
        $h = round(((ord($packet[7]) * 256) + ord($packet[8])) / 10, 0);
        $typ = 'T/F';
        $weather_data = array();
        $weather_data['records'][$device]['id'] = $device;
        $weather_data['records'][$device]['sensor'] = '';
        $weather_data['records'][$device]['temp'] = sprintf('%.1f', $t);
        $weather_data['records'][$device]['hum'] = sprintf('%d', $h);
        $weather_data['records'][$device]['typ'] = $typ;
        $text = sprintf('ID: %d TYP:%s T: %.1f  H: %d', $device, $typ, $t, $h);
        if ($device == 8) {
            $typ = 'Kombi Sensor';
            $weather_data['wind'] = '';
            $weather_data['rain'] = '';
            $weather_data['rainc'] = '';
            $weather_data['israining'] = '';
            $c = (ord($packet[11]) * 256) + ord($packet[12]);
            $m = $c * $this->GetRainPerCount();
            if ($m <> 0) $m = $m / 1000;
            $w = round(((ord($packet[9]) * 256) + ord($packet[10])) / 10, 1);
            $weather_data['rain'] = sprintf('%.1f', $m);
            $weather_data['wind'] = sprintf('%.1f', $w);
            $weather_data['rainc'] = $c;
            if (ord($packet[13]) == 0) {
                $weather_data['israining'] = 'NO';
            } else {
                $weather_data['israining'] = 'YES';
            }
            $text = sprintf('ID: %d TYP:%s T: %.1f  H: %d W: %s C: %d R: %.1f IsRain: %s', $device, $typ, $t, $h, $w, $c, $m, $weather_data['israining']);
        }//if device
        $data['typ'] = $typ;
        $this->debug(__FUNCTION__, 'Parsed:' . $text);
        $this->SendWSData($device, $weather_data);
        return true;

    }//func

    //------------------------------------------------------------------------------
    /**
     * Forward weather data to WSDev instances
     * Create one if needed
     * @param Integer $Device Device ID
     * @param array $weather_data
     */
    private function SendWSData($Device, $weather_data)
    {
        //parsing was OK, start distributing
        $this->debug(__FUNCTION__, 'Prepare');
        $class = __CLASS__ . "-WS";
        $data = array();
        $weather_data['date'] = time();
        $dt = $weather_data['date'];
        $datum = date('Y-m-d H:i:s', $dt);
        $id = $weather_data['records'][$Device]['id'];
        $typ = $weather_data['records'][$Device]['typ'];
        //$sensor=$weather_data['records'][$Device]['sensor'];
        $temp = $weather_data['records'][$Device]['temp'];
        $hum = $weather_data['records'][$Device]['hum'];
        $data['Date'] = $datum;
        $data['Id'] = $id;
        $data['Typ'] = $typ;

        $caps = "Temp";
        $data['Temp'] = $temp;
        if (($typ == 'T/F')) {
            $data['Hum'] = $hum;
            $caps .= ";Hum";
        }
        if ($Device == 8) {
            $rain = $weather_data['rain'];
            $rainc = $weather_data['rainc'];
            $israining = $weather_data['israining'];
            $wind = $weather_data['wind'];
            $data['Hum'] = $hum;
            $data['Rain'] = $rain;
            $data['RainCounter'] = $rainc;
            $data['IsRaining'] = $israining;
            $data['Wind'] = $wind;
            $caps .= ";Hum;Wind;Rain;IsRaining;RainCounter";

        }

        if (strlen($temp) == 0) {
            return; //nothing to send
        }//if temp
        $this->log_weather($Device, $weather_data);

        $this->debug(__FUNCTION__, 'GetInstance for Sensor:' . $id);
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
                    //new instance needed
                    $this->debug(__FUNCTION__, 'CREATE Device with Caps: ' . $caps);
                    $found = true;
                }
            } else {
                $this->debug(__FUNCTION__, 'Creating Device ID ' . $Device . ' disabled by Property AutoCreate');
                IPS_LogMessage($class, 'Creating Device ID ' . $Device . ' disabled by Property AutoCreate');
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
            $vid = @$this->GetIDForIdent('LastUpdate');
            SetValueString($vid, $datum);

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
        $class = __CLASS__ . "-WS";
        $Device = $data['Id'];
        $typ = $data['Typ'];
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
                switch ($Device) {
                    case 0:
                    case $Device < 8 :
                        IPS_SetName($instID, 'Sensor ' . $Device);
                        break;
                    case 8:
                        IPS_SetName($instID, 'KombiSensor');
                        break;
                    default:
                        IPS_SetName($instID, "unknown Sensor('" . strToHex($Device) . "')");
                        break;
                }//switch
                $ident = $class . "_$Device";
                $ident = preg_replace("/\W/", "_", $ident);//nicht-Buchstaben/zahlen entfernen
                IPS_SetIdent($instID, $ident);
                IPS_ApplyChanges($instID);
                $cat = $this->GetCategory();
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
     * parse data from device
     * @param array $packet
     * @return array
     */
    private function parse_switch($packet)
    {

        $this->debug(__FUNCTION__, 'Parse');
        $l = count($packet);
        if ($l <> 8) {
            $this->debug(__FUNCTION__, 'Length wrong:' . $l . '<->8');
            return false;
        }//if len

        //FS20 02 06 A2 HH HH HH AA EE
        $src = $packet[3] . $packet[4] . $packet[5];
        $fs20data = $packet[6] . $packet[7];
        $hc = FHZ_helper::bin2four($src);
        //prepare structure
        $data = array();
        $data['Typ'] = 'FS20'; //Device FS20
        $data['DeviceID'] = $hc; //
        $data['FS20'] = utf8_encode($fs20data);
        $data['Class'] = __CLASS__;

        $action = FHZ_helper::$fs20_codes[strToHex($fs20data[0])];
        if (ord($fs20data[0]) > 31) $action .= ' Timer:' . FHZ_helper::fs20_times(ord($fs20data[1]));
        $text = sprintf('Device:%s(%s), Action:%s (%s)', $hc, strToHex($src), $action, strToHex($fs20data));
        $this->debug(__FUNCTION__, $text);
        $this->SendSwitchData($data);

        return true;
    }//function


    //------------------------------------------------------------------------------
    /**
     * Forward Switch data to SwitchDev instances
     * Create one if needed
     * @param array $data
     */
    private function SendSwitchData($data)
    {
        //parsing was OK, start distributing
        $this->debug(__FUNCTION__, 'Prepare');
        $class = __CLASS__ . "-SW";
        $Device = $data['DeviceID'];
        $typ = $data['Typ'];
        $found = false;
        $instID = 0;
        $caps = "Switch;Dimmer;Timer;FS20;TimerActionCode";
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
                $this->debug(__FUNCTION__, 'CREATE NEW Device');
                $instID = $this->CreateSwitchDevice($data, $caps);
                $found = true;
            } else {
                $this->debug(__FUNCTION__, 'Creating FS20 Device ID ' . $Device . ' disabled by Property AutoCreate');
                IPS_LogMessage($class, 'Creating FS20 Device ID ' . $Device . ' disabled by Property AutoCreate');
            }//if autocreate
        }//if found

        if ($found && ($instID > 0)) {
            //send record to children
            $json = json_encode(
                array("DataID" => $this->module_interfaces['SWD-RX'],
                    "DeviceID" => $data['DeviceID'],
                    "Typ" => $data['Typ'],
                    "Class" => $class,
                    "SWData" => $data,
                )
            );

            $this->debug(__FUNCTION__, $json);
            @$this->SendDataToChildren($json);
            $datum = date('Y-m-d H:i:s', time());
            $vid = @$this->GetIDForIdent('LastUpdate');
            if ($vid) SetValueString($vid, $datum);
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
        $class = __CLASS__ . "-SW";
        $Device = $data['DeviceID'];
        $typ = $data['Typ'];
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
                IPS_SetName($instID, "FS20 Device " . $Device);
                $ident = $class . "_$Device";
                $ident = preg_replace("/\W/", "_", $ident);//nicht-Buchstaben/zahlen entfernen
                IPS_SetIdent($instID, $ident);
                IPS_ConnectInstance($instID, $this->InstanceID);
                IPS_ApplyChanges($instID);

                //set category
                $cat = $this->GetCategory();
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
                }//parent
            } else {
                $this->debug(__FUNCTION__, 'Instance  is not created!');
            }//if instID
        }//module exists
        return $instID;
    }//function

    //------------------------------------------------------------------------------
    /**
     * Log data to file
     * @param Integer $Device Device ID to log
     * @param array $weather_data
     */
    private function log_weather($Device, $weather_data)
    {
        //standard log)
        $fname = $this->GetLogFile();
        if ($fname == '') return;
        $i = $Device;
        $this->debug(__FUNCTION__, 'File:' . $fname);
        $exists = file_exists($fname);
        $o = @fopen($fname, "a");
        if (!$o) {
            IPS_LogMessage(__CLASS__, __FUNCTION__ . '::Cannot open ' . $fname);
            return;
        }
        if (!$exists) {
            fwrite($o, self::fieldlist . "\r\n");
        } //if exists
        $dt = $weather_data['date'];
        if ($dt == 0) {
            $dt = time();
        }//if date
        $datum = date('Y-m-d H:i:s', $dt);
        $id = $weather_data['records'][$i]['id'];
        $typ = $weather_data['records'][$i]['typ'];
        $sensor = $weather_data['records'][$i]['sensor'];
        $temp = $weather_data['records'][$i]['temp'];
        $hum = $weather_data['records'][$i]['hum'];
        $data = "$datum;$typ;$id;$sensor;$temp;$hum;";
        if ($i == 8) {
            $rain = $weather_data['rain'];
            $rainc = $weather_data['rainc'];
            $israining = $weather_data['israining'];
            $wind = $weather_data['wind'];
            $data = "$datum;$typ;$id;$sensor;$temp;$hum;;;$wind;$rain;$israining;$rainc";
        }
        if ($temp > 0) {
            @fwrite($o, $data);
            fwrite($o, "\r\n");
        }//if temp
        fclose($o);
    }//function
    
}//class
