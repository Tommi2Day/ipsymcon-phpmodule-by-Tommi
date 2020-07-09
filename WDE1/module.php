<?
/**
 * @file
 *
 * WDE1 Gateway IPSymcon PHP Splitter Module Class
 *
 * @author Thomas Dressler
 * @copyright Thomas Dressler 2009-2020
 * @version 5.1.1
 * @date 2020-06-14
 */


include_once(__DIR__ . "/../libs/module_helper.php");

/** @class WDE1
 *
 * WDE1 Gateway IPSymcon PHP Splitter Module Class
 *
 *
 */
class WDE1 extends T2DModule
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
     * How many sensors are attached
     * 8 external Temp/Hum Sensors(0-7), Kombisensor(8) and indoor Sensors(9)
     */
    const MAXSENSORS = 9; //no indoor record

    /**
     * Fieldlist for Logging
     */
    const fieldlist = "Time;Typ;Id;Name;Temp;Hum;Bat;Lost;Wind;Rain;IsRaining;RainCounter;Pressure;willi;";

    //--------------------------------------------------------
    // main module functions
    //--------------------------------------------------------
    /**
     * Constructor.
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
        $this->RegisterPropertyString('Category', 'WDE1 Devices');
        $this->RegisterPropertyInteger('ParentCategory', 0); //parent cat is root

        $this->RegisterPropertyString('LogFile', '');
        $this->RegisterPropertyInteger('RainPerCount', 295);
        $this->RegisterPropertyBoolean('AutoCreate', true);
        $this->RegisterPropertyBoolean('Debug', false);
        $this->RegisterPropertyBoolean('Active', false);

        //Vars
        $this->RegisterVariableString('LastUpdate', 'Last Update', "", -4);
        IPS_SetHidden($this->GetIDForIdent('LastUpdate'), true);


        //Timers
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
     * overwrite internal IPS_ApplyChanges($id) function
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

    ///--------------------------------------------------------
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
    public function SetRainPerCount(int $rainpercount)
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
                if (IPS_GetProperty($ParentID, 'BaudRate') <> 9600)
                    IPS_SetProperty($ParentID, 'BaudRate', 9600);
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
        $this->SetLocalBuffer('');
        $this->SetTimerInterval('ReInit', 60000);
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

            $buffer = $this->GetLocalBuffer();
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
                    $inbuf = $this->ReadRecord($buffer); //returns remaining chars
                    $this->SetLocalBuffer($inbuf);
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
     * Data Interface to Childs
     * @param string $Data
     */
    protected function SendDataToChildren($Data)
    {
        parent::SendDataToChildren($Data);
    }

    //------------------------------------------------------------------------------
    /**
     * Data Interface tp Parent (IO-TX)
     * @param string $Data
     * @return bool
     */
    protected function SendDataToParent($Data)
    {
        $res = false;
        $json = json_encode(
            array("DataID" => $this->module_interfaces['IO-TX'],
                "Buffer" => utf8_encode($Data)));
        if ($this->HasActiveParent()) {
            $this->debug(__FUNCTION__, strToHex($Data));
            $res = parent::SendDataToParent($json);
            $this->debuglog($Data);
        } else {
            $this->debug(__FUNCTION__, 'No Parent');
        }
        return $res;

    }//function

    //------------------------------------------------------------------------------
    //public functions
    //------------------------------------------------------------------------------


    //------------------------------------------------------------------------------
    //internal functions
    //------------------------------------------------------------------------------

    //------------------------------------------------------------------------------
    /**
     * Takes an input string and prepare it for parsing
     * @param string $inbuf Record from wde1, terminated by CRLF
     * @return string
     */
    public function ReadRecord(string $inbuf)
    {
        $this->debug(__FUNCTION__, 'ReadRecord:' . $inbuf);
        $r=0;
        while (strlen($inbuf) > 0) {
            $pos = strpos($inbuf, chr(13));
            if ($pos===false) {
                break;
            }
            $data = substr($inbuf, 0, $pos);
            $inbuf = substr($inbuf, $pos+1);
            if (preg_match('/\$([0-9,-;]+)$/', $data, $records)) {
                $r++;
                $data = $records[1]; //[1]=matched value, only this one expected
                $data = str_replace(',', '.', $data);
                $wde1_data = $this->parse_weather($data);
                //if result
                if ($wde1_data) {
                    $this->SendWSData($wde1_data);
                    $this->log_weather($wde1_data);
                } else {
                    $this->debug(__FUNCTION__, "No wsdata returned for $data");
                }//if wsdata
            } else {
                $this->debug(__FUNCTION__, "No match in inbuf,try next");
            }//if pregmatch
        }//while
        $this->debug(__FUNCTION__, "Found $r records");
        return $inbuf;
    }//function

    //------------------------------------------------------------------------------
    /**
     * parses an record string
     * @param String $data
     * @return array
     */
    private function parse_weather($data)
    {
        //clear record
        //$1;1;;21,2;22,4;25,1;14,6;15,8;12,1;;24,5;37;;78;72;;75;;:50;16,0;42;8,0;455;1;0<cr><lf>
        $this->debug(__FUNCTION__, 'Entered:' . $data);
        $wde1_data = array();
        $records = array();
        for ($p = 0; $p < self::MAXSENSORS; $p++) {
            $records[$p] = array('typ' => '', 'id' => '', 'sensor' => '', 'temp' => '', 'hum' => '', 'lost' => '');
        }
        $wde1_data['date'] = time();
        $wde1_data['records'] = $records;
        $wde1_data['wind'] = '';
        $wde1_data['rain'] = '';
        $wde1_data['israining'] = '';
        $fields = explode(';', $data);
        $f = 0;
        $this->debug(__FUNCTION__, "Data: " . print_r($fields, true));
        while ($f < count($fields) - 1) {
            $f++;
            $s = $fields[$f];
            if ($s == '') continue;
            $this->debug(__FUNCTION__, 'Field:' . $f . '=' . $s);
            if ($f >= 3 && $f <= 10) {
                $wde1_data['records'][$f - 3]['temp'] = $s;
                $wde1_data['records'][$f - 3]['id'] = $f - 3;
                $wde1_data['records'][$f - 3]['typ'] = 'T';

            } elseif ($f >= 11 && $f <= 18) {
                $wde1_data['records'][$f - 11]['hum'] = $s;
                $wde1_data['records'][$f - 11]['typ'] = 'T/F';
            } elseif ($f == 19) {
                $wde1_data['records'][8]['temp'] = $s;
                $wde1_data['records'][8]['id'] = 8;
                $wde1_data['records'][8]['typ'] = 'Kombisensor';
            } elseif ($f == 20) {
                $wde1_data['records'][8]['hum'] = $s;
            } elseif ($f == 21) {
                $wde1_data['wind'] = $s;
            } elseif ($f == 22) {
                $wde1_data['rainc'] = $s;
                if (strlen($s) > 0) {
                    $rainc = (int)$s;
                    $rc = $this->GetRainPerCount();
                    $val = $rc / 1000 * $rainc;
                    $m = round($val, 1);
                    $wde1_data['rain'] = $m;
                }
            } elseif ($f == 23) {
                $wde1_data['israining'] = ($s == '1') ? 'YES' : 'NO';
            }//if
        }//while

        if ($f >= 23) {
            $this->debug(__FUNCTION__, 'OK');
        } else {
            $this->debug(__FUNCTION__, "Field Error (24 expected, $f received)");
        }
        $this->debug(__FUNCTION__, " Parsed Data:" . print_r($wde1_data, true));
        return $wde1_data;
    }//function


    //------------------------------------------------------------------------------
    /**
     * Forward weather data to WSDev instances
     * Create one if needed
     * @param $weather_data
     */
    private function SendWSData($weather_data)
    {
        //parsing was OK, start distributing
        $this->debug(__FUNCTION__, 'Prepare');
        $data = array();
        //$wue_data['date']=time();
        $dt = $weather_data['date'];
        $datum = date('Y-m-d H:i:s', $dt);

        for ($Device = 0; $Device < self::MAXSENSORS; $Device++) {
            $id = $weather_data['records'][$Device]['id'];
            $typ = $weather_data['records'][$Device]['typ'];
            //$sensor=$weather_data['records'][$Device]['sensor'];
            $temp = $weather_data['records'][$Device]['temp'];
            $hum = $weather_data['records'][$Device]['hum'];
            $data['Id'] = $id;
            $data['Typ'] = $typ;
            $data['Date'] = $datum;

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
                continue; //nothing to send
            }//if temp

            $this->debug(__FUNCTION__, "Sensor: . $id Caps: $caps Prepared Data:" . print_r($data, true));
            $found = false;
            $instID = 0;
            $instances = IPS_GetInstanceListByModuleID($this->module_interfaces['WSDEV']);
            foreach ($instances as $instID) {
                $I = @IPS_GetInstance($instID);
                if ($I && ($I['ConnectionID'] == $this->InstanceID)) { //my child
                    $iid = (String)IPS_GetProperty($instID, 'DeviceID');
                    $ityp = (String)IPS_GetProperty($instID, 'Typ');
                    $class = (String)IPS_GetProperty($instID, 'Class');
                    if (($iid == $Device) && ($ityp == $typ) && ($class == __CLASS__)) {
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
                    IPS_LogMessage(__CLASS__, 'Creating Device ID ' . $Device . ' disabled by Property AutoCreate');
                }//if autocreate
            }//if found
            if ($found && ($instID > 0)) {
                //send record to children
                $json = json_encode(
                    array("DataID" => $this->module_interfaces['WS-RX'],
                        "DeviceID" => $Device,
                        "Typ" => $typ,
                        "Class" => __CLASS__,
                        "WSData" => $data));
                $this->debug(__FUNCTION__, $json);
                @$this->SendDataToChildren($json);
            }//found
        }//for
        $this->debug(__FUNCTION__, 'Finished');
        $vid = @$this->GetIDForIdent('LastUpdate');
        SetValueString($vid, $datum);
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
        $ModuleID = $this->module_interfaces['WSDEV'];
        if (IPS_ModuleExists($ModuleID)) {
            //return $result;
            $this->debug(__FUNCTION__, "Create Device $Device,Type $typ");
            $instID = IPS_CreateInstance($ModuleID);
            if ($instID > 0) {
                IPS_ConnectInstance($instID, $this->InstanceID);  //Parents are ourself!
                IPS_SetProperty($instID, 'DeviceID', $Device);
                IPS_SetProperty($instID, 'Class', __CLASS__);
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
                $ident = __CLASS__ . "_WS_$Device";
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
                        IPS_LogMessage(__CLASS__, "Category $cat Ident $ident ($catid) created");
                    } else {
                        IPS_LogMessage(__CLASS__, "Category $cat Ident $ident ($catid) FAILED");
                    }

                }
                $this->debug(__FUNCTION__, "Category:$catid");
                if (!IPS_SetParent($instID, $catid)) {
                    $this->debug(__FUNCTION__, "SetParent to Cat $catid failed");
                };
                $this->debug(__FUNCTION__, 'New ID:' . $instID);
                //if instID
            } else {
                $this->debug(__FUNCTION__, 'Instance  is not created!');
            }
        }//module exists
        return $instID;
    }//function
    //------------------------------------------------------------------------------

    //------------------------------------------------------------------------------
    /**
     * Log data to file
     * @param array $weather_data
     */
    private function log_weather($weather_data)
    {
        //standard log)
        $fname = $this->GetLogFile();
        if ($fname > '') $this->log2file($fname, $weather_data);

    }//function

    //--------------------------------------------------------
    /**
     * Log data to file
     * @param String $fname
     * @param array $weather_data
     */
    private function log2file($fname, $weather_data)
    {
        if ($fname == '') return;
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

        //dates
        if (isset($weather_data['date'])) {
            $dt = $weather_data['date'];
        }else{
            $dt = time();
        }//has date
        if ( $dt == 0 ) {
            $dt = time();
        }//if date == 0
        $datum = date('Y-m-d H:i:s', $dt);

        $rain = $weather_data['rain'];
        $rainc = $weather_data['rainc'];
        $israining = $weather_data['israining'];
        $wind = $weather_data['wind'];

        for ($i = 0; $i < self::MAXSENSORS; $i++) {
            $id = $weather_data['records'][$i]['id'];
            $typ = $weather_data['records'][$i]['typ'];
            $sensor = $weather_data['records'][$i]['sensor'];
            $temp = $weather_data['records'][$i]['temp'];
            $hum = $weather_data['records'][$i]['hum'];
            $data = sprintf('%s;%s;%s;%s;%s;%s;;;', $datum, $typ, $id, $sensor, $temp, $hum);
            if ($i == 8) $data = sprintf('%s;%s;%s;%s;%s;%s;;;%s;%s;%s;', $datum, $typ, $id, $sensor, $temp, $wind, $rain, $israining, $rainc);
            if ($temp > 0) {
                @fwrite($o, $data);
                fwrite($o, "\r\n");
            }//if temp
        }//for
        fclose($o);
    }//function
}//class
