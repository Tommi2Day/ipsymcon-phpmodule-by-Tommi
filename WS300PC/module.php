<?
/**
 * @file
 *
 * WS300PC Gateway IPSymcon PHP Splitter Module Class
 *
 * @author Thomas Dressler
 * @copyright Thomas Dressler 2009-2016
 * @version 1.7
 * @date 2016-04-08
 */

/**
 * common module helper function
 */
include_once(__DIR__ . "/../module_helper.php");

/**
 * @class WS300PC
 *
 * WS300PC Gateway IPSymcon PHP Splitter Module Class
 * 
 * This Device is EOL and out of Stock anyway :)
 *
 */
class WS300PC extends T2DModule
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
     * 8 external Temp/Hum Sensors(0-7), Kombisensor(8) and internal Sensors(9)
     */
    const MAXSENSORS = 10; //const integer

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
        $this->RegisterPropertyString('Category', 'WS300PC Devices');
        $this->RegisterPropertyInteger('ParentCategory', 0); //parent cat is root
        $this->RegisterPropertyInteger('RecordInterval', 5);
        $this->RegisterPropertyInteger('WS300PCInterval', 300);
        $this->RegisterPropertyString('LogFile', '');
        //$this->RegisterPropertyString('WSWinFile', '');
        $this->RegisterPropertyInteger('Altitude', 0);
        $this->RegisterPropertyInteger('RainPerCount', 295);
        $this->RegisterPropertyBoolean('AutoCreate', true);
        $this->RegisterPropertyBoolean('Debug', false);
        $this->RegisterPropertyBoolean('Active', false);

        //willi profile
        if (!IPS_VariableProfileExists('WS300_Willi')) {
            IPS_CreateVariableProfile('WS300_Willi', 1); //integer
            IPS_SetVariableProfileAssociation('WS300_Willi', 0, 'Sunny', 'Sun', -1);
            IPS_SetVariableProfileAssociation('WS300_Willi', 1, 'some Clouds', 'Cloud', -1);
            IPS_SetVariableProfileAssociation('WS300_Willi', 2, 'Cloudy', 'Cloud', -1);
            IPS_SetVariableProfileAssociation('WS300_Willi', 3, 'Rainy', 'Drops', -1);
        }
        //Vars
        $this->RegisterVariableInteger('RecCount', 'History Record Count');
        $this->RegisterVariableString('Last', 'Last History Record');
        $this->RegisterVariableString('Buffer', 'Buffer', "", -1);
        IPS_SetHidden($this->GetIDForIdent('Buffer'), true);
        $this->RegisterVariableBoolean('isPolling', 'isPolling', "", -2);
        IPS_SetHidden($this->GetIDForIdent('isPolling'), true);
        $this->RegisterVariableString('Config', 'Config Record', "", -3);
        IPS_SetHidden($this->GetIDForIdent('Config'), true);
        $this->RegisterVariableString('LastUpdate', 'Last Update', "", -4);
        IPS_SetHidden($this->GetIDForIdent('LastUpdate'), true);


        //Timers
        $this->RegisterTimer('ReInit', 60000, $this->module_data["prefix"] . '_ReInitEvent($_IPS[\'TARGET\']);');
        $this->RegisterTimer('Update', 0, $this->module_data["prefix"] . '_UpdateEvent($_IPS[\'TARGET\']);');


        //Connect Parent
        $this->RequireParent($this->module_interfaces['SerialPort']);
        $pid = $this->GetParent();
        if ($pid) {
            $name = IPS_GetName($pid);
            if ($name == "Serial Port") IPS_SetName($pid, __CLASS__ . " Port");
        }

        //call init if ready and activated
        if (IPS_GetKernelRunlevel() == self::KR_READY) {
            if (($this->isActive()) && ($this->HasActiveParent())) {
                $this->SetStatus(self::ST_AKTIV);
                $i = $this->GetWS300pcInterval();
                $this->SetTimerInterval('Update', ($i * 1000));//ms
                $this->SetTimerInterval('ReInit', 60000);
                $this->init();
                SetValueInteger($this->GetIDForIdent('RecCount'), 0);
                $this->GetWS300pcInterval();

            } else {
                $this->SetStatus(self::ST_INACTIV);
                $this->SetTimerInterval('ReInit', 0);
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

        //reinit
        if ($this->isActive() && $this->HasActiveParent()) {
            $this->SetStatus(self::ST_AKTIV);
            $this->init();
        } else {
            $this->SetStatus(self::ST_NOPARENT);
            $this->SetTimerInterval('ReInit', 0);
            $this->SetTimerInterval('Update', 0);
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
     * Set Property RecordInterval
     * this is the ws300pc internal logging interval for historic records in min
     * Limit 5..100min
     * @param Integer $interval
     */
    private function SetRecordInterval($interval)
    {
        if (IPS_GetProperty($this->InstanceID, 'RecordInterval') != $interval) {
            if (($interval > 100) || ($interval < 5)) {
                IPS_LogMessage(__CLASS__, __FUNCTION__ . ":: Record Interval invalid ($interval min), cancel");
                return;
            }
            IPS_SetProperty($this->InstanceID, 'RecordInterval', $interval);
        }
    }

    //------------------------------------------------------------------------------
    /**
     * Get Property Read Interval
     * @return int
     */
    private function GetRecordInterval()
    {
        return (Integer)IPS_GetProperty($this->InstanceID, 'RecordInterval');
    }

    //------------------------------------------------------------------------------
    /**
     * Set Property Altitude
     * this is the ws300pc internal altititude setting used for pressure correction
     * Limit -100..8000m
     * @param Integer $alt
     */
    private function SetAltitude($alt)
    {
        if (IPS_GetProperty($this->InstanceID, 'Altitude') != $alt) {
            if (($alt > 8000) || ($alt < -100)) {
                IPS_LogMessage(__CLASS__, __FUNCTION__ . ":: Altitude invalid ($alt m), cancel");
                return;
            }
            IPS_SetProperty($this->InstanceID, 'Altitude', $alt);
        }
    }

    //------------------------------------------------------------------------------
    /**
     * Get Property Altitude
     * @return int
     */
    private function GetAltitude()
    {
        return (Integer)IPS_GetProperty($this->InstanceID, 'Altitude');
    }

    //------------------------------------------------------------------------------
    /**
     * Set Property RainPerCount
     * This is the amount of rain per count of wipe in mm*1000
     * Limit 200..500, default 295
     * @param Integer $rainpercount
     */
    private function SetRainPerCount($rainpercount)
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
        /*
        if (IPS_GetKernelRunlevel() == KR_READY) {
        if ($this->config == '') $this->getConfig();
        }
        */
        return (Integer)IPS_GetProperty($this->InstanceID, 'RainPerCount');
    }

    //------------------------------------------------------------------------------
    /**
     * Get property WS300PCInterval
     * @return int
     */
    private function GetWS300pcInterval()
    {
        /*
        if (IPS_GetKernelRunlevel() == KR_READY) {
            if ($this->config == '') $this->getConfig();
        }
        */
        return (Integer)IPS_GetProperty($this->InstanceID, 'WS300PCInterval');
    }

    //------------------------------------------------------------------------------
    /**
     * Get status variable RecCount
     * Indicates history records readed up to now
     * @return Integer
     */
    public function GetHistoryCount()
    {
        $id = @$this->GetIDForIdent('RecCount');
        $val = GetValueInteger($id);
        return $val;
    }

    //------------------------------------------------------------------------------
    /**
     * Set status variable RecCount
     * @param Integer $val
     */
    public function SetHistoryCount($val)
    {
        $id = @$this->GetIDForIdent('RecCount');
        SetValueInteger($id, $val);
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
    /**
     * Get status variable Config
     * contains WS300PC config record in hex
     * @return String
     */
    private function GetConfig()
    {
        $id = $this->GetIDForIdent('Config');
        $val = GetValueString($id);
        return $val;
    }

    //------------------------------------------------------------------------------
    /**
     * Set status variable Config
     * @param String $val
     */
    private function SetConfig($val)
    {
        $id = $this->GetIDForIdent('Config');
        SetValueString($id, $val);
    }

    //------------------------------------------------------------------------------
    /**
     * Get status variable isPolling
     * indicates a running query
     * ToDo: Replace with semaphore
     * @return bool
     */
    private function isPolling()
    {
        $id = $this->GetIDForIdent('isPolling');
        $val = GetValueBoolean($id);
        return $val;
    }

    //------------------------------------------------------------------------------
    /**
     * Set status variable isPolling
     * @param bool $val
     */
    private function SetPolling($val)
    {
        $id = $this->GetIDForIdent('isPolling');
        SetValueBoolean($id, $val);
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
        if (($diff > self::MAXAGE) && $this->isActive() && $this->HasActiveParent() && !$this->isPolling()) {
            $this->init();
        }
    }
    //------------------------------------------------------------------------------
    /**
     * Timer Event to read current data record from WS300PC
     * discard output
     */
    public function UpdateEvent()
    {
        $this->debug(__FUNCTION__, 'Update');
        $this->ReadCurrentRecord();
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
                if (IPS_GetProperty($ParentID, 'BaudRate') <> 19200)
                    IPS_SetProperty($ParentID, 'BaudRate', 19200);
                if (IPS_GetProperty($ParentID, 'Parity') <> 'Even')
                    IPS_SetProperty($ParentID, 'Parity', "Even");


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
            if ($this->isActive() && $this->HasActiveParent()) {
                SPRT_SetDTR($ParentID, true);
                SPRT_SetRTS($ParentID, false);
                //send dummy commands to wakeup
                $tosend = chr(0xfe) . chr(0x39) . chr(0xfc);
                $this->SendDataToParent($tosend);
                IPS_Sleep(500);
                $this->SetBuffer('');
                $this->GetVersion();
            }

        }//parentID
    }//function


    //------------------------------------------------------------------------------
    /**
     * Initialization sequence
     */
    private function init()
    {
        $this->debug(__FUNCTION__, 'executing Init');
        $this->SyncParent();
        $this->SetBuffer('');
        SetValueInteger($this->GetIDForIdent('RecCount'), 0);
        $i = $this->GetWS300pcInterval();
        $this->SetTimerInterval('Update', ($i * 1000));//ms
        $this->SetTimerInterval('ReInit', 61200); //odd time to prevent clash with update
        //$this->ReadConfig();
        $this->debug(__FUNCTION__, 'Init leaved');
    }

    //------------------------------------------------------------------------------
    //Data Interfaces
    //------------------------------------------------------------------------------
    /**
     * Data Interface from Childs
     * @param $JSONString
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
            //$this->mh->debuglog($JSONString);
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
     * Data Interface to Childs
     * Forward commands to childs
     * @param String $Data Json encoded
     */
    public function SendDataToChildren($Data)
    {
        parent::SendDataToChildren($Data);
    }

    //------------------------------------------------------------------------------
    /**
     * Data Interface tp Parent (IO-TX)
     * Forward commands to IO Instance
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
    /**
     * Read WS300PC config record and set properties accordently
     * ToDo: Check if Setting properties with apply is usefull(double invokation of ReadConfig)
     * @return bool
     */
    private function ReadConfig()
    {
        $result = false;
        $this->debug(__FUNCTION__, 'Poll CMD 32(Config)');
        $cmd = 0x32;

        $needapply = false;
        $inbuf = $this->Poll($cmd);
        $l = strlen($inbuf);
        if ($l > 0) {
            $ic = ord($inbuf[1]);
            if ($ic == 0x32) {
                if ($l == 17) {
                    /*  parse config
                    #           1         2         3
                    # 0123456789012345678901234567890123
                    # FE320000000010000000000500E60127FC
                    # FE3210321010000010000000000500E60127FC
                    #     001122334455667788iihhhhmmmm
                    #    Sensor flags   ,interval,höhe,regen mm    */
                    $cmsg = strToHex($inbuf);
                    $this->SetConfig($cmsg);
                    $this->debug(__FUNCTION__, 'OK');
                    $val = substr($cmsg, 22, 2);
                    $interval = hexdec($val);
                    //PCInterval
                    if ($this->GetRecordInterval() <> $interval) {
                        $this->SetRecordInterval($interval);
                        $needapply = true;
                    }
                    //Altitude
                    $val = substr($cmsg, 24, 4);
                    $alt = hexdec($val);
                    if ($this->GetAltitude() <> $alt) {
                        $this->SetAltitude($alt);
                        $needapply = true;
                    }

                    //rain per Count
                    $val = substr($cmsg, 28, 4);
                    $rainpc = hexdec($val);
                    if ($this->GetRainPerCount() <> $rainpc) {
                        $this->SetRainPerCount($rainpc);
                        $needapply = true;
                    }
                    $result = true;
                    $this->debug(__FUNCTION__, "Interval: $interval, Alt: $alt, Rainpc: $rainpc");
                    if ($needapply) $this->ApplyChanges();
                } else {
                    $this->debug(__FUNCTION__, 'Bytecount mismatch, should 17, is' . $l);
                } //if $l
            }//if ic32
        }//if poll
        return $result;
    }

    //------------------------------------------------------------------------------
    /**
     * Write Properties back to the device. This will trigger a resync phase of WS300PC(10min)
     */
    public function WriteConfig()
    {
        $this->debug(__FUNCTION__, 'CMD 30(SetConfig)');
        $this->SetTimerInterval('Update', 900 * 1000); //wait 15min
        $alt = $this->GetAltitude();
        $rperc = $this->GetRainPerCount();
        $interval = $this->GetRecordInterval();
        if (($alt > 8000) || ($alt < -100)) {
            IPS_LogMessage(__CLASS__, __FUNCTION__ . ":: Altitude invalid ($alt m), cancel");
            return;
        }
        if (($interval > 100) || ($interval < 5)) {
            IPS_LogMessage(__CLASS__, __FUNCTION__ . ":: Record Interval invalid ($interval min), cancel");
            return;
        }
        if (($rperc > 500) || ($rperc < 200)) {
            IPS_LogMessage(__CLASS__, __FUNCTION__ . ":: Rain per Count invalid ($rperc mm ), cancel");
            return;
        }
        $this->debug(__FUNCTION__, "Write Alt: $alt, RainPerCount $rperc, Record Intervall:$interval min");

        //prepare command
        $Text = chr(0xFE) . chr(0x30);
        $Text .= chr($interval);
        $Text .= chr(($alt >> 8) & 0xff) . chr($alt & 0xff);
        $Text .= chr(($rperc >> 8) & 0xff) . chr($rperc & 0xff);
        $Text .= chr(0xFC);
        //send
        $this->SendDataToParent($Text);
        IPS_Sleep(1000);
        //check answer
        $answer = $this->GetBuffer();
        $this->debug(__FUNCTION__, "Answer:" . strToHex($answer));
        if (strlen($answer) == 4) {
            if (ord($answer[3]) == 6) {
                IPS_LogMessage(__CLASS__, __FUNCTION__ . "::Write config command submitted, pls wait 10min for resync");
            } else {
                IPS_LogMessage(__CLASS__, __FUNCTION__ . "::unexpected answer");
            }
        }
        $this->SetBuffer('');
    }//function

    //------------------------------------------------------------------------------
    /**
     * retrieve current weather record from device
     * returns csv fragment
     * @return String
     */
    public function ReadCurrentRecord()
    {
        //stop update timer
        $this->SetTimerInterval('Update', 0);
        $ws300_data = array();
        $result = '';

        //read config
        $config = $this->GetConfig();
        if (strlen($config) == 34) {
            $this->debug(__FUNCTION__, 'Poll 33 (current)');
            $cmd = 0x33;
            $inbuf = $this->Poll($cmd);
            $l = strlen($inbuf);
            if ($l > 0) {
                $ic = ord($inbuf[1]);
                if ($ic == 0x33) {
                    //my record
                    if ($l == 40) {
                        //len is expected
                        $this->debug(__FUNCTION__, 'Data cmd 33 valid,Parse');
                        $ws300_data = $this->parse_weather($inbuf);
                    } else {
                        $this->debug(__FUNCTION__, 'Cmd 33 Bytecount mismatch, should 40, is ' . $l);
                    }
                } else {
                    $this->debug(__FUNCTION__, 'Cmd 33 First Byte error');
                }//if 33
            }//if poll
        } else {
            $this->ReadConfig();
            $this->debug(__FUNCTION__, 'Config Error, Rereading');
        }//if result
        if (count($ws300_data) > 0) {
            $this->SendWSData($ws300_data);
            $this->log_weather($ws300_data);
            $result = $this->format_data($ws300_data);
        }
        //restart timer
        $this->SetTimerInterval('Update', $this->GetWS300pcInterval() * 1000); //ms
        return $result;
    }//function

    //------------------------------------------------------------------------------
    /**
     * retrieve next historic record from device and returns a csv fragment
     * @return string
     */
    public function ReadNextRecord()
    {
        //stop update timer
        $this->SetTimerInterval('Update', 0);
        $data = '';
        $reccount = $this->GetHistoryCount();
        $config = $this->GetConfig();
        if (strlen($config) == 34) {
            $this->debug(__FUNCTION__, 'Poll 31 (Stored)');
            $cmd = 0x31;
            $inbuf = $this->Poll($cmd);
            $l = strlen($inbuf);
            if ($l > 0) {
                $ic = ord($inbuf[1]);
                if ($ic == 0x31) {
                    switch ($l) {
                        case 43:
                            $this->debug(__FUNCTION__, 'Data valid,Parse');
                            //got valid history record
                            $result = $this->parse_weather($inbuf);
                            if ($result) {
                                $this->debug(__FUNCTION__, 'Parse OK, Log');
                                $data = $this->format_data($result);
                                //start logging to the file
                                //$this->log2file($logfile, $result);
                                //increment record counter
                                $reccount++;
                                $this->SetHistoryCount($reccount);
                                $this->debug(__FUNCTION__, 'Got Record ' . $reccount);
                            }//if result
                            break;
                        case 3:
                            $this->debug(__FUNCTION__, 'No more records');
                            break;
                        default:
                            $this->debug(__FUNCTION__, 'Bytecount mismatch  should be 43, is' . $l);
                            break;
                    }//case

                }//if ic 31
                else {
                    $this->debug(__FUNCTION__, 'First Byte error');
                }//if ic
            }//poll
        }//strlen config
        else {
            $this->debug(__FUNCTION__, 'Config record Error');
        }
        //restart update timer
        $this->SetTimerInterval('Update', $this->GetWS300pcInterval() * 1000);
        return $data;
    } //function

    //------------------------------------------------------------------------------
    /**
     * Query device firmware revision
     * @return string
     */
    public function GetVersion()
    {
        //returns firmware version of device
        $this->debug(__FUNCTION__, 'Poll 34 (Version)');
        $cmd = 0x34;
        $inbuf = $this->Poll($cmd);
        $this->debug(__FUNCTION__, "Answer:" . strToHex($inbuf));
        $l = strlen($inbuf);
        if ($l == 4) {
            $ic = ord($inbuf[1]);
            if ($ic == 0x34) {
                $result = strToHex($inbuf[2]);
                $result = $result[0] . '.' . $result[1];
                $this->debug(__FUNCTION__, 'Version:' . $result);
                return $result;
            }//ic
        }
        $this->debug(__FUNCTION__, 'Unexpected answer');
        return '';
    }//function

    //------------------------------------------------------------------------------
    //internal functions
    //------------------------------------------------------------------------------
    /**
     * parse data from device
     * @param String $data
     * @return array
     */
    private function parse_weather($data)
    {
        //clear record
        $ws300pc_data = array();
        $records = array();
        for ($p = 0; $p < self::MAXSENSORS; $p++) {
            $records[$p] = array('typ' => '', 'id' => '', 'sensor' => '', 'temp' => '', 'hum' => '', 'lost' => '');
        }

        $ws300pc_data['records'] = $records;
        $ws300pc_data['willi'] = '';
        $ws300pc_data['wind'] = '';
        $ws300pc_data['rain'] = '';
        $ws300pc_data['israining'] = '';
        $msg = $data;
        $hmsg = strToHex($msg);
        $zeit = time();

        /*
          #           1         2         3         4         5         6         7         8
          # 012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
            FE3100003F75FFF14400E41C00CF2100C91F00CC2A00EF1CFFFD530005470000000000000000CC2A03CAFC  stored
            FE310000367700D50000C73600CF2100DF2700284F00EF1C009E3300D2000000000000000000CC2303F9FB
          #         zzzztttthhtttthhtttthhtttthhtttthhtttthhtttthhtttthhtttthhrrrrwwwwtttthhpppp
          # FE3300E42600E52801012F00FB4500974200FC2B00BE2C002F460000000000000001032303E231FC
          # FE3300D50000C73600CF2100DF2700DA2D00EF1C009E3300983B0000000000000000E62F03E700FC  current
          #     tttthhtttthhtttthhtttthhtttthhtttthhtttthhtttthhtttthhrrrrwwwwtttthhppppss
          #     00000011111122222233333344444455555566666677777788888888888888999999999999
          # FE320000000010000000000500E60127FC  config
          # FE321010000010000000000500E60127FC
          #     001122334455667788iihhhhmmmm
          */

        //handle differences between current and history record
        $fun = ord($msg[1]);
        $israining = '';
        $willi = '';
        switch ($fun) {
            case 0x33:
                $this->debug(__FUNCTION__, 'Current Record');
                $offs = 4;
                $val = substr($hmsg, 76, 2);
                $this->debug(__FUNCTION__, 'Willi:' . $val);
                $willi = hexdec($val);
                $israining = 'NO';
                if (($willi & 0x80) == 0x80) $israining = 'YES';
                $willi = $willi & 0x0F;
                break; //if 33

            case 0x31:
                $offs = 12;
                $val = substr($hmsg, 8, 4);
                $this->debug(__FUNCTION__, 'TimeDiff:' . $val);
                $timediff = hexdec($val);
                $zeit = $zeit - ($timediff * 60);
                $val = date('Y-m-d h:i:s', $zeit);
                $this->debug(__FUNCTION__, 'history Record:-' . $timediff . ' min ' . $val);
                SetValueString($this->GetIDForIdent('Last'), $val);
                break; //if 33
            default:

                $this->debug(__FUNCTION__, 'WS300 illegal data ');
                return array();
        }//switch
        $ws300pc_data['records'] = $records;
        $ws300pc_data['willi'] = $willi;
        $ws300pc_data['wind'] = '';
        $ws300pc_data['rain'] = '';
        $ws300pc_data['rainc'] = '';
        $ws300pc_data['press'] = '';
        $ws300pc_data['israining'] = $israining;
        $ws300pc_data['date'] = $zeit;

        //wind,press,rain
        $val = substr($hmsg, 54 + $offs, 4);
        $rainc = hexdec($val);
        $rainv = $this->GetRainPerCount() * $rainc;
        $this->debug(__FUNCTION__, "Rainc: $rainc ($val), Rainv: $rainv");

        $val = substr($hmsg, 58 + $offs, 4);
        $wind = hexdec($val);
        $this->debug(__FUNCTION__, "Wind: $wind($val)");

        $alt = $this->GetAltitude();
        $val = substr($hmsg, 68 + $offs, 4);
        $vpress = hexdec($val);
        $this->debug(__FUNCTION__, "Press: $vpress ($val), Alt: $alt");
        if ($alt <> 0) {
            $vpress = $vpress + round($alt / 8.5);
        } //korrektur nach höhe

        $config = $this->GetConfig();
        //handle temp+hum for each sensor
        for ($s = 0; $s < self::MAXSENSORS; $s++) {
            $id = $s;
            $fp = ($s * 2) + 4;
            $fh = substr($config, $fp, 2);
            $flags = hexdec($fh); //flags are from config
            $ws300pc_data['records'][$s]['id'] = $id;
            $ws300pc_data['records'][$s]['flags'] = $flags;
            //innensensor hat keine flags
            if ($s < self::MAXSENSORS) {
                $this->debug(__FUNCTION__, "Sensor: $s Flags: $fh($flags)");
            }
            //check presence flag
            if ((($flags and 0x10) > 0) or ($s == 9)) {
                $p = ($s * 6) + $offs;
                if ($s == 9) $p = $p + 8;
                $this->debug(__FUNCTION__, 'Sensor:' . $s . ' Pos:' . $p . ' Val:' . substr($hmsg, $p, 6));

                //Temperature and Huminity
                $val = substr($hmsg, $p, 4);
                $t = hexdec($val);
                if ($t > 32767) $t = $t - 65535;
                $val = substr($hmsg, $p + 4, 2);
                $h = hexdec($val);
                $temp = $t / 10;
                $hum = $h;
                $typ = 'T';
                $ws300pc_data['records'][$s]['sensor'] = '';
                $ws300pc_data['records'][$s]['temp'] = sprintf('%.1f', $temp);
                $ws300pc_data['records'][$s]['hum'] = sprintf('%d', $hum);
                if (($hum > 0) || ($s > 7)) {
                    $typ = 'T/F';
                }
                $ws300pc_data['records'][$s]['typ'] = $typ;
                $battery = 'OK';
                $lostcount = 0;
                //battery and lost records
                if ($s < 9) {
                    //außer Innensensor, der hat keine flags
                    if (($flags & 0xe0) <> 0) {
                        $battery = 'LOW';
                    }
                    $lostcount = ($flags & 0x0f);
                    $ws300pc_data['records'][$s]['lost'] = $lostcount;
                    $ws300pc_data['records'][$s]['battery'] = $battery;
                }
                //assign values
                switch ($s) {
                    case 0 :

                    case $s < 8:
                        $val = sprintf('T: %.1f  H: %d  Bat: %s  LR: %d', $temp, $hum, $battery, $lostcount);
                        break;
                    case 8:
                        $ws300pc_data['wind'] = sprintf('%.1f', $wind / 10);
                        $ws300pc_data['rain'] = sprintf('%.1f', $rainv / 1000);
                        $ws300pc_data['rainc'] = sprintf('%d', $rainc);
                        $val = sprintf('T: %.1f  H: %d  W: %.1f R: %.1f IsRain: %s Bat: %s  LR: %d', $temp, $hum, $wind / 10, $rainv / 1000, $israining, $battery, $lostcount);
                        break;
                    case 9:
                        $ws300pc_data['press'] = sprintf('%d', $vpress);
                        $val = sprintf('T: %.1f  H: %d  P: %d  Willi: %d', $temp, $hum, $vpress, $willi);
                        break;
                }//case
                $this->debug(__FUNCTION__, 'Sensor:' . $s . ' Result: ' . $val);
            }  //if
        }//for
        return $ws300pc_data;
    }//function


    //------------------------------------------------------------------------------
    /**
     * Query Device with given command
     * ToDo:Replace polling var with semaphore
     * @param $cmd
     * @return bool|string Record from Device
     */
    private function Poll($cmd)
    {
        $result = "";
        if ($this->isPolling()) {
            $this->debug(__FUNCTION__, 'already running, canceled');
            return $result;
        }
        //send to device
        $this->SetBuffer('');
        $tosend = chr(0xfe) . chr($cmd) . chr(0xfc);
        $this->SendDataToParent($tosend);
        //waiting for response
        $rcount = 0;
        $inbuf = '';
        $ende = false;
        $this->SetPolling(true);
        IPS_Sleep(1000);
        $buffer = $this->GetBuffer();
        $fstart = false;
        $indata = str_split($buffer);
        $il = count($indata);
        $z = 0;
        while ($il > 0) {
            $z++;
            $bt = $indata[0];
            $b = ord($bt);
            if ($b == 0xfe) {
                $fstart = true;
                break;
            } else {
                array_splice($indata, 0, 1);
                $il = count($indata);
                continue;  //waitfor start
            }//if 02
        }//while il
        if ($fstart) {
            $il = count($indata);
            //start recording bytes until end byte and do escapes
            $escape = false;
            while ($il > 0) {
                $bt = $indata[0];
                $b = ord($bt);
                array_splice($indata, 0, 1);
                $il = count($indata);
                if ($b == 0xf8) {
                    $escape = true;
                    continue;
                }//f8
                else {
                    if ($escape) {
                        $b--;
                        $escape = false;
                        $z++;
                        $inbuf = $inbuf . chr($b);
                    }//esc
                    else {
                        $z++;
                        $inbuf = $inbuf . chr($b);
                        if ($b == 0xfc) {
                            $ende = true;
                            break; //for
                        }//fc
                    }//esc
                }//f8
                $rcount++;
            }//while il

        }//if start

        $this->SetPolling(false);

        if (!$ende) {
            if ($rcount = 0) $this->debug(__FUNCTION__, 'no data');
            if ($rcount > 0) $this->debug(__FUNCTION__, ' wrong data: ' . strToHex($inbuf));
            return false;
        }//if !ende
        $this->debug(__FUNCTION__, 'RAW: ' . strlen($inbuf) . ' bytes: ' . strToHex($inbuf));
        $this->SetBuffer('');
        $datum = date('Y-m-d H:i:s', time());
        $vid = $this->GetIDForIdent('LastUpdate');
        SetValueString($vid, $datum);
        return $inbuf;
    }  //function

    //------------------------------------------------------------------------------
    /**
     * Forward weather data to WSDev instances
     * Create one if needed
     * @param $weather_data
     */
    private function SendWSData($weather_data)
    {
        //parsing was OK, start distributing
        $this->debug(__FUNCTION__, 'Prepare ');
        //$this->debug(__FUNCTION__, 'Data:'. print_r($weather_data, true));

        $dt = $weather_data['date'];
        $datum = date('Y-m-d H:i:s', $dt);
        for ($Device = 0; $Device < self::MAXSENSORS; $Device++) {
            if (!($weather_data['records'][$Device]['typ'])) continue;
            $data = array();
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
            if ($Device < 9) {
                //innensensor hat keinenbatteryanzeige
                $lost = $weather_data['records'][$Device]['lost'];
                $bat = $weather_data['records'][$Device]['battery'];
                $data["Battery"] = $bat;
                $data["Lost"] = $lost;
                $caps .= ";Battery;Lost";
            }
            if ($Device == 8) {
                $rain = $weather_data['rain'];
                $rainc = $weather_data['rainc'];
                $israining = $weather_data['israining'];
                $wind = $weather_data['wind'];
                $typ = 'Kombisensor';
                $data['Typ'] = $typ;
                $data['Rain'] = $rain;
                $data['RainCounter'] = $rainc;
                $data['IsRaining'] = $israining;
                $data['Wind'] = $wind;
                $caps .= ";Wind;Rain;IsRaining;RainCounter";
            }
            if ($Device == 9) {
                $typ = 'Indoor';
                $press = $weather_data['press'];
                $willi = $weather_data['willi'];
                $data['Typ'] = $typ;
                $data["Press"] = $press;
                $data['Forecast'] = $willi;
                $caps .= ";Hum;Press;Forecast";
            }

            if (strlen($temp) == 0) {
                continue; //nothing to send
            }//if temp

            //$this->debug(__FUNCTION__, "Sensor:  $id Caps: $caps Data:" . print_r($data, true));
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
        $vid = $this->GetIDForIdent('LastUpdate');
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
                    case 9:
                        IPS_SetName($instID, 'InnenSensor');
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

                //set willi profile for forecast
                $vid=@IPS_GetObjectIDByIdent('Forecast',$instID);
                if ($vid>0) IPS_SetVariableCustomProfile($vid, "WS300_Willi");
            } else {
                $this->debug(__FUNCTION__, 'Instance  is not created!');
            }
        }//module exists
        return $instID;
    }//function

    //------------------------------------------------------------------------------
    /**
     * Format an historic record for output
     * @param $weather_data
     * @return string
     */
    private function format_data($weather_data)
    {
        $dt = $weather_data['date'];
        if ($dt == 0) {
            $dt = time();
        }//if date
        $out = '';
        $datum = date('Y-m-d H:i:s', $dt);
        $rain = $weather_data['rain'];
        $rainc = $weather_data['rainc'];
        $press = $weather_data['press'];
        $israining = $weather_data['israining'];
        $wind = $weather_data['wind'];
        $willi = $weather_data['willi'];
        for ($i = 0; $i < self::MAXSENSORS; $i++) {
            $id = $weather_data['records'][$i]['id'];
            $typ = $weather_data['records'][$i]['typ'];
            if (!$typ) continue;
            $battery = '';
            $lost = '';
            $sensor = $weather_data['records'][$i]['sensor'];
            $temp = $weather_data['records'][$i]['temp'];
            $hum = $weather_data['records'][$i]['hum'];
            if ($i < 9) {
                $battery = $weather_data['records'][$i]['battery'];
                $lost = $weather_data['records'][$i]['lost'];
            }
            $data = sprintf('%s;%s;%s;%s;%s;%s;%s;%s;', $datum, $typ, $id, $sensor, $temp, $hum, $battery, $lost);
            if ($i == 8) $data = sprintf('%s;%s;%s;%s;%s;%s;%s;%s;%s;%s;%s;%s;', $datum, 'Kombisensor', $id, $sensor, $temp, $hum, $battery, $lost, $wind, $rain, $israining, $rainc);
            if ($i == 9) $data = sprintf('%s;%s;%s;%s;%s;%s;%s;%s;;;;;%s;%s;', $datum, 'Indoor', $id, $sensor, $temp, $hum, $battery, $lost, $press, $willi);
            if ($temp > 0) {
                $out .= $data . "\r\n";
            }//if temp
        }//for
        return $out;
    }

    //------------------------------------------------------------------------------
    /**
     * Log data to file
     * @param array $weather_data
     */
    private function log_weather($weather_data)
    {
        //standard log)
        $fname = $this->GetLogFile();
        $data = $this->format_data($weather_data);
        if ($fname == '') return;
        if ($data == '') return;
        $this->log2file($fname, $data);

    }//function

    //--------------------------------------------------------
    /**
     * @param String $fname
     * @param String $data
     */
    private function log2file($fname, $data)
    {
        if ($fname == '') return;
        if ($data == '') return;
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
        @fwrite($o, $data);
        fclose($o);
    }//function

}//class
