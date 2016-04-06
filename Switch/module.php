<?php
/**
 * @file
 *
 * generic Switch Device Module
 *
 * @author Thomas Dressler
 * @copyright Thomas Dressler 2016
 * @version 1.5
 * @date 2016-04-05
 */

 /**
 * common module helper function
 */
include_once(__DIR__ . "/../module_helper.php");
/**
 * fhz/fs20 specific data and functions
 */
include_once(__DIR__ . "/../fhz_helper.php");

/**
 * @class SwitchDev
 *
 * generic Switch Device Module Class for IPSymcon
 *
 * @par Prefix: SWD_
 *
 * @par Properties
 *
 * - \b DeviceID: ID/Serial of the connected Device. Will be matched when receiving Data
 *
 * - \b Typ: Typ/Model of the Device, if available. Will be matched when receiving Data
 *
 * - \b Class: Class of the creator. Will be matched when receiving Data
 *
 * - \b Caplist; Keywords of actual capabilies for matching status variables,
 * seperated by semicolon, set by splitter. Idents must match definitions in $capvars
 * @snippet Switch/module.php capvars
 *
 * - \b Debug: Flag to enable debug output via IPS_LogMessages
 *
 * @par Actions (if supported by the attached splitter and the physical device)
 *
 * - \b SWD_SetSwitchMode($id,$state): raise a switch command, Default action for status variable
 *
 * - \b SWD_DimUp($id): Raise the level of  dimmer one step (up to 100%)
 *
 * - \b SWD_DimDown($id) : Lower the level of  dimmer one step (down to 0%)
 *
 * - \b SWD_SetIntensity($id,$percent) : Set the dimming Level in percent
 *
 */

class SwitchDev extends T2DModule
{
    //------------------------------------------------------------------------------
    //module const and vars
    //------------------------------------------------------------------------------

    ///[capvars]
    /**
     * mapping array for capabilities to variables
     * @var array $capvars
     */
    protected $capvars = array(
        'Name' => array("ident" => 'Name', "type" => self::VT_String, "name" => 'Name', 'profile' => '~String', "pos" => 0),
        "Switch" => array("ident" => 'Switch', "type" => self::VT_Boolean, "name" => 'Status', "profile" => 'Switch', "pos" => 1, "action" => true),
        "Dimmer" => array("ident" => 'Dimmer', "type" => self::VT_Integer, "name" => 'Dimmer', "profile" => 'Intensity.100', "pos" => 2, "action" => true),
        "Timer" => array("ident" => 'Timer', "type" => self::VT_Integer, "name" => 'Timer', "profile" => '', "pos" => 3),
        'TimerActionCode' => array("ident" => 'TimerActionCode', "type" => self::VT_String, "name" => 'next Timer Action', "profile" => '', "pos" => 3, "hidden" => true),
        "FS20" => array("ident" => 'FS20', "type" => self::VT_String, "name" => 'last FS20 code', "profile" => '', "pos" => 4),
    );
    ///[capvars]

    //------------------------------------------------------------------------------
    //main module functions 
    //------------------------------------------------------------------------------
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

    //------------------------------------------------------------------------------
    /**
     * overload internal IPS_Create($id) function
     */
    public function Create()
    {
        // Diese Zeile nicht löschen.
        parent::Create();

        // register property
        $this->RegisterPropertyString('DeviceID', '');
        $this->RegisterPropertyString('Typ', '');
        $this->RegisterPropertyString('Class', '');
        $this->RegisterPropertyString('CapList', '');
        $this->RegisterPropertyBoolean('Debug', false);

        $this->RegisterTimer('DeviceTimer', 0, $this->module_data["prefix"] . '_TimerEvent($_IPS[\'TARGET\']);');

        $this->CreateStatusVars();

    }//func

    //------------------------------------------------------------------------------
    /**
     * Destructor
     */
    public function Destroy()
    {
        parent::Destroy();
    }

    //------------------------------------------------------------------------------
    /**
     * overload internal IPS_ApplyChanges($id) function
     */
    public function ApplyChanges()
    {
        // do not remove this line
        parent::ApplyChanges();
        if (IPS_GetKernelRunlevel() == self::KR_READY) {
            if ($this->HasActiveParent()) {
                $this->SetStatus(self::ST_AKTIV);
            } else {
                $this->SetStatus(self::ST_NOPARENT);
            } //check status
        }
        //must be here!!
        $this->SetStatusVariables(); //Update Variables
    }


    //------------------------------------------------------------------------------
    /**
     * define default module actions
     * @param String $Ident
     * @param mixed $val
     */
    public function RequestAction($Ident, $val)
    {
        $this->debug(__FUNCTION__, "entered: $Ident=$val");
        switch ($Ident) {
            case "Switch":
                $this->SetSwitchMode($val);
                break;
            case "Dimmer":
                $this->SetIntensity($val);
                break;
            /*
            case "Timer":
                $this->SetDuration($val);
                break;
            */
            default:
                $this->debug(__FUNCTION__, "unhandled Ident $Ident");
        }

    }
    
    //------------------------------------------------------------------------------
    //Data Interfaces
    //------------------------------------------------------------------------------
    /**
     * Receive Data from Parent(IO)
     * @param string $JSONString
     */
    public function ReceiveData($JSONString)
    {

        //trigger status check
        if ($this->HasActiveParent()) {
            $this->SetStatus(self::ST_AKTIV);
        } else {
            $this->SetStatus(self::ST_NOPARENT);
        }

        // decode Data from Device Instanz
        if (strlen($JSONString) > 0) {
            // decode Data from IO Instanz
            $this->debug(__FUNCTION__, 'Data arrived:' . $JSONString);
            //$this->debuglog($JSONString);
            // decode Data from IO Instanz
            $data = json_decode($JSONString);
            //entry for data from parent
            if (is_object($data)) $data = get_object_vars($data);
            if (isset($data['DataID'])) {
                $target = $data['DataID'];
                if ($target == $this->module_interfaces['SWD-RX']) {
                    if (isset($data['SWData']) && isset($data['DeviceID'])) {
                        $Device = $data['DeviceID'];
                        $typ = $data['Typ'];
                        $class = $data['Class'];
                        //call data point
                        $myID = $this->GetDeviceID();
                        $myType = $this->GetType();
                        $myClass = $this->GetClass();
                        if (($myID == $Device) && ($myType == $typ) && ($myClass = $class)) {
                            $this->debug(__FUNCTION__, "$Device(Typ:$typ,Class:$class)");
                            $sw_data = $data['SWData'];
                            if (is_object($sw_data)) $sw_data = get_object_vars($sw_data);
                            $this->ParseData($sw_data);
                        } else {
                            $this->debug(__FUNCTION__, 'Wrong Target: ' . $Device . " (Typ:$typ,Class=$class)" . '-->' . $myID . " (Typ:$myType,Class=$myClass)");
                        }
                    } else {
                        $this->debug(__FUNCTION__, 'Interface Data Error');
                    }
                }
            }
        } else {
            $this->debug(__FUNCTION__, 'strlen(JSONString) == 0');
        }
    }
    //------------------------------------------------------------------------------
    /**
     * Forward command to Splitter parent
     * @param $Data
     * @return bool
     */
    public function SendDataToParent($Data)
    {
        $json = json_encode($Data);
        $this->debug(__FUNCTION__, $json);
        $res = parent::SendDataToParent($json);
        return $res;
    }

    //------------------------------------------------------------------------------
    //Get/Set
    //------------------------------------------------------------------------------
    /**
     * Get Property DeviceID
     * @return string
     */
    private function GetDeviceID()
    {
        return (String)IPS_GetProperty($this->InstanceID, 'DeviceID');
    }

    //------------------------------------------------------------------------------
    /**
     * Get Property Type
     * @return string
     */
    private function GetType()
    {
        return (String)IPS_GetProperty($this->InstanceID, 'Typ');
    }


    //------------------------------------------------------------------------------
    /**
     * GetProperty Modul class of creator
     * @return string
     */
    private function GetClass()
    {
        return (String)IPS_GetProperty($this->InstanceID, 'Class');
    }



    //------------------------------------------------------------------------------
    //---------Events
    //------------------------------------------------------------------------------
    /**
     * Timer event to simulate internal FS20(or similar) timed functions
     */
    public function TimerEvent()
    {
        $this->debug(__FUNCTION__, "Timer Event");
        $this->SetTimerInterval('DeviceTimer', 0);
        $caps = $this->GetCaps();
        $acvid = @$this->GetIDForIdent($caps['TimerActionCode']);
        $tvid = @$this->GetIDForIdent($caps['Timer']);
        $dvid = @$this->GetIDForIdent($caps['Dimmer']);
        $swid = @$this->GetIDForIdent($caps['Switch']);
        if ($acvid) {
            $code = GetValue($acvid);
            $actions = explode(";", $code);
            foreach ($actions as $part) {
                list($ident, $val) = explode(":", $part);
                switch ($ident) {
                    case 'Switch':
                        $val = ($val == 'On');
                        SetValueBoolean($swid, $val);
                        break;
                    case 'Dimmer':
                        SetValueInteger($dvid, $val);
                        break;
                    default:
                        $this->debug(__FUNCTION__, "Unsupported Ident $ident");
                }
            }
        }
        //reset values
        SetValueString($acvid, '');
        SetValueInteger($tvid, 0);
    }
    //------------------------------------------------------------------------------
    //---------public functions
    //------------------------------------------------------------------------------
    /**
     * Set dimmer an level (step if fs20) up
     * @return bool
     */
    public function DimUp()
    {
        $res = false;
        $caps = $this->GetCaps();
        $type = $this->GetType();
        $cap = 'Dimmer';
        if (isset($caps[$cap])) {
            $ident = $caps[$cap];
            $vid = @$this->GetIDForIdent($ident);
            if (!$vid) {
                IPS_LogMessage(__CLASS__, __FUNCTION__ . "::No vid for cap $cap('$ident')");
                return $res;
            }
            $val = GetValueInteger($vid);
            switch ($type) {
                case 'FS20':
                    $steps = FHZ_helper::fs20_intensity_steps($val);
                    $val = FHZ_helper::fs20_intensity_percent($steps + 1);
                    break;
                default:
                    $val++;
            }
            if ($val > 100) $val = 100;
            $this->debug(__FUNCTION__, "$cap Step to $val%");
            $res = $this->SetIntensity($val);
        } else {
            IPS_LogMessage(__CLASS__, __FUNCTION__ . "::failed, not capable for $type");
        }
        return $res;

    }
    //------------------------------------------------------------------------------
    /**
     * Set dimmer an level (step if fs20) down
     * @return bool
     */
    public function DimDown()
    {
        $res = false;
        $caps = $this->GetCaps();
        $type = $this->GetType();
        $cap = 'Dimmer';
        if (isset($caps[$cap])) {
            $ident = $caps[$cap];
            $vid = @$this->GetIDForIdent($ident);
            if (!$vid) {
                IPS_LogMessage(__CLASS__, __FUNCTION__ . "::No vid for cap $cap('$ident')");
                return $res;
            }
            $val = GetValueInteger($vid);
            switch ($type) {
                case 'FS20':
                    $steps = FHZ_helper::fs20_intensity_steps($val);
                    $val = FHZ_helper::fs20_intensity_percent($steps + 1);
                    break;
                default:
                    $val--;
            }
            if ($val < 0) $val = 0;
            $res = $this->SetIntensity($val);
            $this->debug(__FUNCTION__, "$cap Step to $val %");
        } else {
            IPS_LogMessage(__CLASS__, __FUNCTION__ . "::failed, not capable for $type");
        }
        return $res;

    }

    //------------------------------------------------------------------------------
    /**
     * Dim to the given level
     * Range 0..100
     * @param integer $percent Dimmer value percent
     * @return bool
     */
    public function SetIntensity($percent)
    {
        $res = false;
        $val = $percent;
        $caps = $this->GetCaps();
        $type = $this->GetType();
        $cap = 'Dimmer';
        if (!isset($caps[$cap])) {
            IPS_LogMessage(__CLASS__, __FUNCTION__ . "::failed, not capable for $type");
            return $res;
        }
        if (($val < 0) || ($val > 100)) {
            IPS_LogMessage(__CLASS__, __FUNCTION__ . "::$cap Value($val) % out of range 0-100");
            return $res;
        }
        $ident = $caps[$cap];
        $vid = @$this->GetIDForIdent($ident);
        if (!$vid) {
            IPS_LogMessage(__CLASS__, __FUNCTION__ . "::No vid for cap $cap('$ident')");
            return $res;
        }

        $this->debug(__FUNCTION__, "Set to $val ($vid)");
        SetValueInteger($vid, $val);

        //change switch state too
        $ident = $caps['Switch'];
        $svid = @$this->GetIDForIdent($ident);
        if ($svid) {
            $state = GetValueBoolean($svid);
            $switch = ($val > 0);
            if ($state != $switch) {
                $this->SetSwitchMode($switch);
            }
        }
        if (!$this->HasActiveParent()) {
            IPS_LogMessage(__CLASS__, __FUNCTION__ . "Parent not active, No real Action");
            return $res;
        }

        $data = array(
            "DataID" => $this->module_interfaces["SWD-TX"],
            "Type" => $this->GetType(),
            "Device" => $this->GetDeviceID(),
            "Cap" => $cap,
            "Value" => $val,
        );
        $res = $this->SendDataToParent($data);
        return $res;
    }

    //------------------------------------------------------------------------------
    /**
     * Set Timer to execute Tasks defined in Var TimerActionCode
     *
     * @param integer $duration Duration in sec
     * @return bool
     */
    public function SetDuration($duration)
    {
        $res = false;
        $val = $duration;
        $caps = $this->GetCaps();
        $type = $this->GetType();
        $cap = 'Timer';
        $max = 3600 * 24;
        if (!isset($caps[$cap])) {
            IPS_LogMessage(__CLASS__, __FUNCTION__ . "::failed, not capable for $type");
            return $res;
        }
        switch ($type) {
            case "FS20":
                $max = 15360;
                break;
        }
        if (($val < 0) || ($val > $max)) {
            IPS_LogMessage(__CLASS__, __FUNCTION__ . "::$cap Value($val) % out of range (0-$max)");
            return $res;
        }

        $ident = $caps[$cap];
        $vid = @$this->GetIDForIdent($ident);
        if (!$vid) {
            IPS_LogMessage(__CLASS__, __FUNCTION__ . "::No vid for cap $cap('$ident')");
            return $res;
        }
        $this->debug(__FUNCTION__, "Set $cap to $val ($vid)");
        SetValueInteger($vid, $val);
        //rearm timer
        $this->SetTimerInterval('DeviceTimer', $val * 1000);


        if (!$this->HasActiveParent()) {
            IPS_LogMessage(__CLASS__, __FUNCTION__ . "Parent not active, No real Action");
            return $res;
        }
        //forward to splitter
        $data = array(
            "DataID" => $this->module_interfaces["SWD-TX"],
            "Type" => $this->GetType(),
            "Device" => $this->GetDeviceID(),
            "Cap" => $cap,
            "Value" => $val,
        );
        $this->SendDataToParent($data);
        $res = true;
        return $res;

    }

    //------------------------------------------------------------------------------
    /**
     * change switch status
     * @param bool $val On or Off
     * @return bool
     */
    public function SetSwitchMode($val)
    {
        $res = false;
        $caps = $this->GetCaps();
        $type = $this->GetType();
        $cap = 'Switch';
        $state = $this->SwitchStatus($val);
        $status = $state ? "On" : "Off";
        if (!isset($caps[$cap])) {
            IPS_LogMessage(__CLASS__, __FUNCTION__ . "::failed, not capable for $type");
            return $res;
        }
        $ident = $caps[$cap];
        $vid = @$this->GetIDForIdent($ident);
        if (!$vid) {
            IPS_LogMessage(__CLASS__, __FUNCTION__ . "::No vid for cap $cap('$ident')");
            return $res;
        }
        $this->debug(__FUNCTION__, "Set $ident($vid) to $status");
        SetValueBoolean($vid, $state);
        if (isset($caps['Timer'])) {
            $ident = $caps['Timer'];
            $vid = @$this->GetIDForIdent($ident);
            if ($vid) {
                SetValueInteger($vid, 0);
            } else {
                IPS_LogMessage(__CLASS__, __FUNCTION__ . "::No vid for cap Timer('$ident')");
            }
            //$status.=", Timer 0"
        }

        //dimmer value is not changed with switch!

        if (!$this->HasActiveParent()) {
            IPS_LogMessage(__CLASS__, __FUNCTION__ . "Parent not active, No real Action");
            return $res;
        }

        $data = array(
            "DataID" => $this->module_interfaces["SWD-TX"],
            "Type" => $this->GetType(),
            "Device" => $this->GetDeviceID(),
            "Cap" => $cap,
            "Value" => $state,
        );
        $this->SendDataToParent($data);
        $res = true;
        return $res;
    }

    //------------------------------------------------------------------------------
    //---------internal functions
    //------------------------------------------------------------------------------
    /**
     * overloaded function to maintain variables and timer
     */
    protected function SetStatusVariables()
    {
        parent::SetStatusVariables();
        $caps = $this->GetCaps();
        if (count($caps) < 1) {
            return;
        }
        if (!isset($caps['Timer'])) {
            $tid = @IPS_GetEventIDByName("DeviceTimer", $this->InstanceID);
            if ($tid > 0) {
                IPS_LogMessage(__CLASS__, __FUNCTION__ . "Drop DeviceTimer ($tid)");
                IPS_DeleteEvent($tid);
            }
        }

    }
    //------------------------------------------------------------------------------
    /**
     * parses switch status values to true/false
     * @param mixed $val
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
     * handle incoming data along capabilities
     * @param array $data
     */
    private function ParseData($data)
    {
        //
        $caps = $this->GetCaps();
        //$this->debug(__FUNCTION__,print_r($this->all_caps,true));
        foreach (array_keys($caps) as $cap) {
            $ident = $caps[$cap];
            $vid = @$this->GetIDForIdent($ident);
            if ($vid == 0) {
                $this->debug(__FUNCTION__, "Cap $cap Ident $ident: Variable missed");
            }
            if (!isset($data[$cap])) continue;
            $s = $data[$cap];
            switch ($cap) {
                //integer
                case 'Timer'://Duration code
                case 'Dimmer'://intensity 100%
                    $iv = (int)$s;
                    SetValueInteger($vid, $iv);
                    break;
                //String
                case 'Name'://Duration code
                    $st = utf8_decode($s);
                    SetValueString($vid, $st);
                    break;
                //special
                case 'Switch'://Status
                    $state = $this->SwitchStatus($s);
                    SetValueBoolean($vid, $state);
                    break;
                case 'FS20':
                    //fs20 mode decoding
                    $state = false;
                    $intensity = 0;
                    $timer = 0;
                    $acode = '';
                    $actioncode = '';
                    $code = utf8_decode($s);
                    $this->debug(__FUNCTION__, "FS20 Code " . strToHex($code));
                    $action = $code[0];
                    $ext = ord($code[1]);
                    $tvid = @$this->GetIDForIdent($caps['Timer']);
                    $dvid = @$this->GetIDForIdent($caps['Dimmer']);
                    $swid = @$this->GetIDForIdent($caps['Switch']);
                    $avid = @$this->GetIDForIdent($caps['TimerActionCode']);
                    $this->debug(__FUNCTION__, "FS20 Vars S:$swid,D:$dvid,T:$tvid,A:$avid");
                    if ($dvid) $intensity = GetValueInteger($dvid);
                    if ($swid) $state = GetValueBoolean($swid);
                    if ($tvid) $timer = GetValueInteger($tvid);
                    if ($avid) $acode = GetValueString($avid);
                    $ac = ord($action) & 0x1f;
                    $timed = (($action & 0x20) > 0);
                    $this->debug(__FUNCTION__, "FS20 AC:" . $ac . "PrevD:$intensity, PrevS:" . ($state ? "On" : "Off"));
                    switch ($ac) {
                        case 0: //off
                            if ($timed) {
                                $actioncode = 'Switch:Off';
                            } else {
                                $state = false;
                            }
                            break;
                        case ($ac < 0x0f): //Dim to value
                            $intensity = FHZ_helper::fs20_intensity_percent($action & 0x0f);
                            $state = true;
                            if ($timed) {
                                $actioncode = 'Switch:Off';
                            }
                            break;
                        case 0x10: //on full
                            $state = true;
                            $intensity = 100;
                            if ($timed) {
                                $actioncode = 'Switch:Off';
                            }
                            break;
                        case 0x11: //on with old value
                            $state = true;
                            if ($intensity == 0) $intensity = 100;
                            if ($timed) {
                                $actioncode = 'Switch:Off';
                            }
                            break;
                        case 0x12:
                            $state = !GetValueBoolean($swid); //toggle
                            break;
                        case 0x13: //dimup
                            $steps = FHZ_helper::fs20_intensity_steps($intensity);
                            $intensity = FHZ_helper::fs20_intensity_percent($steps + 1);
                            $state = true;
                            break;
                        case 0x14: //dimdown
                            if ($intensity == 0) $intensity = 100;
                            $steps = FHZ_helper::fs20_intensity_steps($intensity);
                            $intensity = FHZ_helper::fs20_intensity_percent($steps - 1);
                            if ($intensity == 0) $state = false;
                            break;

                        case 0x18: //off-for-timer
                            $state = 'Off';
                            $action = 'Switch:On';
                            break;
                        case 0x19: //on-for-timer than out
                            $state = true;
                            $actioncode = 'Switch:Off';
                            break;
                        case 0x1A: //on-old-for-timer than out
                            $state = true;
                            $actioncode = 'Switch:Off';
                            break;
                        case 0x1C: //ramp-on-time (time to reach the desired dim value on dimmers)
                            $state = true;
                            $actioncode = "Dimmer:$intensity";
                            break;
                        case 0x1D: //ramp-off-time (time to reach the off state on dimmers)
                            $actioncode = 'Switch:Off;Dimmer:0';
                            break;
                        case 0x1E: //on-old-for-timer-prev", // old val for timer, then go to prev. state
                            $actioncode = "Switch:" . ($state ? 'On' : 'Off');
                            $state = true;
                            break;
                        case 0x1F: //on-100-for-timer-prev", // 100% for timer, then go to previous state
                            //new intensity will be the old one
                            $action = "Switch:" . ($state ? 'On' : 'Off') . ";Dimmer:$intensity";
                            $intensity = 100;
                            $state = true;
                            break;

                        case 0x15: //dimupdown, no value changes
                        case 0x16: //Set Timer
                        case 0x17: //nop
                        case 0x1B: //rese
                            break;
                    }

                    $new_timer = FHZ_helper::fs20_times($ext);
                    $this->debug(__FUNCTION__, "State:" . ($state ? "ON" : "OFF") . ", Dimmer:$intensity%,Timer: $new_timer,ActionCode: '$actioncode'");
                    //state
                    if ($swid) SetValueBoolean($swid, $state);
                    //dimmer
                    if ($dvid) SetValueInteger($dvid, $intensity);
                    //timer
                    if ($tvid) {
                        $this->SetTimerInterval('DeviceTimer', $new_timer * 1000);
                        SetValueInteger($tvid, $new_timer);
                    }
                    //action
                    if (($avid) && ($acode <> $actioncode)) SetValueString($avid, $actioncode);
                    //log
                    $actiontext = FHZ_helper::$fs20_codes[strToHex($action)];
                    if ($ext > 0) $actiontext .= ', Timer:' . $timer;
                    $text = sprintf('%s (%s)', $actiontext, strToHex($code));
                    if ($vid) SetValueString($vid, $text);
                    $this->debug(__FUNCTION__, "Action:" . $text);
                    break;
                default:
                    $this->debug(__FUNCTION__, "$cap not handled");
            }
            $this->debug(__FUNCTION__, "$cap:($vid)" . $s);
        }
    }

}
