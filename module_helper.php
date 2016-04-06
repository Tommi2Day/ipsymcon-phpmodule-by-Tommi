<?php
/**
 * @mainpage Content
 *
 * This is a Library of PHP Modules for the home automation software "Symcon
 *
 *
 *
 * @section Devices
 *
 *
 * @subpage WSDEV Generic Weather Sensor Device Modul
 *
 * @subpage EnergyDev Generic Energy Sensor Device Modul
 *
 * @subpage SwitchDev Generic Switch Device Modul
 *
 * @section Splitter
 *
 * @subpage WS300PC Splitter for ELV WS300PC Data Logger
 *
 * @subpage FS20WUE Splitter for ELV FS20WUE WS300 Series Weather and FS20 Data Receiver
 *
 * @subpage WDE1 Splitter for ELV WDE1 WS300 Series Weather Data Receiver
 *
 * @subpage AVMAHA Splitter for AVM Smarthome Devices
 *
 * @see https://www.symcon.de
 * @see https://www.symcon.de/service/dokumentation/entwicklerbereich/sdk-tools/sdk-php/
 * @see http://www.ip-symcon.de/service/dokumentation/komponenten/verwaltungskonsole/
 * @see https://github.com/Tommi2Day/ipsymcon-phpmodule-by-Tommi
 *
 */

/**
 * @file
 *
 * IPS Module Helper Class
 *
 * @author Thomas Dressler
 * @copyright Thomas Dressler 2016
 * @version 2.1
 * @date 2016-04-05
 */
//disable html errors in modules
ini_set("html_errors", "0");

/**
 * @class T2DModule
 *
 * IPS Module Helper Class
 * combines often used functions and constants
 *
 * @see https://github.com/Tommi2Day/ipsymcon-phpmodule-by-Tommi
 *
 */
class T2DModule extends IPSModule
{
    //------------------------------------------------------------------------------
    //module const and vars
    //------------------------------------------------------------------------------
    /**
     * Kernel Status "Ready"
     */
    const KR_READY = 10103;
    /**
     * Module Status aktive
     */
    const ST_AKTIV = 102;
    /**
     * Module Status "inactive"
     */
    const ST_INACTIV = 104;
    /**
     * Module Status "Error"
     */
    const ST_ERROR = 201;
    /**
     * Custom Module Status "NoParent"
     */
    const ST_NOPARENT = 202;
    /**
     * IPS Variable Type Boolean
     */
    const VT_Boolean = 0;
    /**
     * IPS Variable Type Integer
     */
    const VT_Integer = 1;
    /**
     * IPS Variable Type Float
     */
    const VT_Float = 2;
    /**
     * IPS Variable Type String
     */
    const VT_String = 3;

    /**
     * Vital module data build out of module.json
     * @var array $module_data
     */
    protected $module_data = array();

    /**
     * optional filename of a debug log (fully qualified)
     * @var string $DEBUGLOG
     */
    protected $DEBUGLOG = '';

    /**
     * Modul name for fast access
     * @var string $name
     */
    protected $name = '';

    /**
     * Device capabilities
     * to be overwrite in implementation
     * @var array $capvars
     */
    protected $capvars = array();

    /**
     * often needed module GUIDs
     * @var array $module_interfaces
     */
    protected $module_interfaces = array(
        //Splitter
        "WS300PC" => "{C790A7F2-2572-421F-901B-7F45C05BB062}", // WS300PC Splitter
        "FS20WUE" => "{AA2544FC-0BF8-43C1-B84C-096B844AEACC}", //FS20WUE Splitter
        "WDE1" => "{EE7F90DD-7668-459C-A233-8241C46864A5}", //WDE1 Splitter
        "AVMAHA" => "{0837AE77-B72A-4AA6-8680-D6DDCDAEFA39}", //AVM AHA Splitter
        "CUL" => "{5B0BB3C6-C35A-4438-94E4-8A6CF9EF3A4A}", //Busware CUL/CUN/COC Splitter
        "NUT" => "{431281F9-77DC-46A6-8AA9-A6E2C60A5FB2}", //NUT USV Splitter
        "TE923" => "{137511E0-F98B-49F3-9A6C-95234DF2E1FB}", //TE923,Ventus etc Weather Splitter
        "XS1" => "{8B015BFA-3CDD-4D45-99C8-3F250AEF1E83}", //XS1 Splitter
        //IO
        "VirtIO" => "{6179ED6A-FC31-413C-BB8E-1204150CF376}",
        "SerialPort" => "{6DC3D946-0D31-450F-A8C6-C42DB8D7D4F1}",
        "ClientSocket" => "{3CFF0FD9-E306-41DB-9B5A-9D06D38576C3}",
        "FTDI" => "{C1D478E9-2A3E-4344-BCC4-37C892F58751}",

        //devices
        "FS20" => "{48FCFDC1-11A5-4309-BB0B-A0DB8042A969}", // FS20 Device
        "WSDEV" => "{4228137D-EDE3-41BF-9B0A-CA0DB1AC6353}", // WS Device
        "SwitchDev" => "{F2FC0924-2CE9-4067-9DB5-D228F0CCF4AD}", //Switch Device
        "EnergyDev" => "{F0302960-A22D-40CC-8994-B7C40F045023}", //Energy Device

        //Data Points
        "FS20-TX" => "{122F60FB-BE1B-4CAB-A427-2613E4C82CBA}", //from FS20 Device
        "FS20-RX" => "{DF4F0170-1C5F-4250-840C-FB5B67262530}", //to FS20 Device
        "SWD-TX" => "{6FB0F652-2A47-46B1-AFC5-E327E45E59F9}", //SWDSend (from Device)
        "SWD-RX" => "{E8E6E831-3C60-41CD-B05F-B9FE86A6922E}", //SWDReceive (to Device)
        "WS-TX" => "{F7B329D4-6E4E-4D0C-B059-E1894B23D8CE}", //WSSend (from Device)
        "WS-RX" => "{CD3D1E2D-83ED-4595-90CD-3444A22AAA66}", //WSReceive (to Device)
        "IO-RX" => "{018EF6B5-AB94-40C6-AA53-46943E824ACF}", //from VirtIO
        "IO-TX" => "{79827379-F36E-4ADA-8A95-5F8D1DC92FA9}", //to VirtIO
        "EN-TX" => "{63056B9B-EF14-4F65-8235-D292391AE591}", //from Energy Device
        "EN-RX" => "{3C60BF34-7DD3-4234-B865-AF1606BB267C}", //to Energy Device
    );


    //------------------------------------------------------------------------------
    //Object functions
    //------------------------------------------------------------------------------
    /**
     * Constructor
     * @param integer $InstanceID
     * @param string $json_file Path to module.json
     */
    public function __construct($InstanceID, $json_file)
    {
        parent::__construct($InstanceID);
        $json = @file_get_contents($json_file);
        $data = @json_decode($json, true);
        $this->module_data = $data;
        $this->name = $data["name"];
        if (!isset($this->name)) {
            IPS_LogMessage(__CLASS__, "Reading Moduldata from module.json failed!");
            return false;
        }
        $this->DEBUGLOG = IPS_GetLogDir() . "/" . $data["name"] . "debug.log";
        return true;
    }

    //------------------------------------------------------------------------------
    /**
     * Create function
     *
     */
    public function Create()
    {
        //do not delete this
        parent::Create();
    }

    //------------------------------------------------------------------------------
    /**
     * Apply function
     */
    public function ApplyChanges()
    {
        parent::ApplyChanges();
    }
    //------------------------------------------------------------------------------
    //Protected class functions
    //------------------------------------------------------------------------------
    /**
     * Check if a parent is active
     * @param $id integer InstanceID
     * @return bool
     */
    protected function HasActiveParent($id = 0)
    {
        if ($id == 0) $id = $this->InstanceID;
        $parent = $this->GetParent($id);
        if ($parent > 0) {
            $status = $this->GetInstanceStatus($parent);
            if ($status == self::ST_AKTIV) {
                return true;
            } else {
                //IPS_SetInstanceStatus($id, self::ST_NOPARENT);
                $this->debug(__FUNCTION__, "Parent not active for Instance #" . $id);
                return false;
            }
        }
        $this->debug(__FUNCTION__, "No Parent for Instance #" . $id);
        return false;
    }
    //--------------------------------------------------------
    /**
     * Check if the given Instance is active
     * @param int $id
     * @return bool
     */
    protected function isActive($id = 0)
    {
        if ($id == 0) $id = $this->InstanceID;
        $res = (bool)IPS_GetProperty($id, 'Active');
        return $res;
    }

    //------------------------------------------------------------------------------
    /**
     * Retrieve instance status
     * @param int $id
     * @return mixed
     */
    protected function GetInstanceStatus($id = 0)
    {
        if ($id == 0) $id = $this->InstanceID;
        $inst = IPS_GetInstance($id);
        return $inst['InstanceStatus'];
    }

    //------------------------------------------------------------------------------
    /**
     * Check if a parent for Instance $id exists
     * @param $id integer InstanceID
     * @return integer
     */
    protected function GetParent($id = 0)
    {
        $parent = 0;
        if ($id == 0) $id = $this->InstanceID;
        if (IPS_InstanceExists($id)) {
            $instance = IPS_GetInstance($id);
            $parent = $instance['ConnectionID'];
        } else {
            $this->debug(__FUNCTION__, "Instance #$id dosnt exists");
        }
        return $parent;
    }

    //------------------------------------------------------------------------------
    /**
     * Get Property Caplist
     * @return string
     */
    protected function GetCapList()
    {
        return (String)IPS_GetProperty($this->InstanceID, 'CapList');
    }

    //------------------------------------------------------------------------------
    /**
     * returns array of defined capabilities for this device
     * @return array
     */
    protected function GetCaps()
    {
        $result = array();
        //define vars
        $caplist = $this->GetCapList();
        $caps = explode(";", $caplist);
        //$this->debug(__FUNCTION__,"CapVars:".print_r($this->capvars,true));
        foreach ($caps as $cap) {
            if (isset($this->capvars[$cap])) {
                $ident = $this->capvars[$cap]['ident'];
                if ($ident) {
                    $result[$cap] = $ident;
                    //$this->debug(__FUNCTION__, "Cap '$cap': use Var '$ident''");
                }
            } else {
                $this->debug(__FUNCTION__, "Cap $cap: No Variable configured");
            }
        }
        return $result;
    }

    //------------------------------------------------------------------------------
    /**
     * create status variables out of capvar definitions from device
     */
    protected function CreateStatusVars()
    {
        $vid = 0;
        $caps = $this->capvars;
        //IPS_LogMessage(__CLASS__,__FUNCTION__. "::ID #".$this->InstanceID. " Caps ".print_r($caps,true));
        foreach (array_keys($caps) as $cap) {
            $var = $caps[$cap];
            $type = $var["type"];
            switch ($type) {
                case self::VT_Boolean:
                    $vid = $this->RegisterVariableBoolean($var["ident"], $var["name"], $var["profile"], $var["pos"]);
                    break;
                case self::VT_Integer:
                    $vid = $this->RegisterVariableInteger($var["ident"], $var["name"], $var["profile"], $var["pos"]);
                    break;
                case self::VT_Float:
                    $vid = $this->RegisterVariableFloat($var["ident"], $var["name"], $var["profile"], $var["pos"]);
                    break;
                case self::VT_String:
                    $vid = $this->RegisterVariableString($var["ident"], $var["name"], $var["profile"], $var["pos"]);
                    break;
                default:
                    //IPS_LogMessage(__CLASS__,__FUNCTION__."::Unknown Typ ($type)");

            }
            if ($vid) {
                IPS_LogMessage($this->name, __FUNCTION__ . "Create Variable for Cap $cap ( $vid)");
            } else {

                IPS_LogMessage($this->name, __FUNCTION__ . ":: Create Variable failed");
            }


        }

    }

    //------------------------------------------------------------------------------
    /**
     * remove variables not matching actual capabilities
     */

    protected function SetStatusVariables()
    {
        $caps = $this->GetCaps();
        //IPS_LogMessage($this->name, __FUNCTION__ ." entered for Caps:".print_r($caps,true));
        if (count($caps) < 1) {
            IPS_LogMessage($this->name, __FUNCTION__ . " Caps empty");
            return;
        }
        foreach (array_keys($this->capvars) as $cap) {
            $var = $this->capvars[$cap];
            $ident = $var["ident"];
            $id = @$this->GetIDForIdent($ident);
            if ($id > 0) {
                //IPS_LogMessage($this->name, __FUNCTION__ ." Maintain Var for Cap $cap ID $id Keep :$keep");
                if (!isset($caps[$cap])) {
                    $this->drop_var($ident);
                } else {
                    if (isset($var["hidden"])) {
                        IPS_SetHidden($id, $var["hidden"]);
                    }//hidden
                    if (isset($var["action"])) {
                        $action = $var["action"];
                        //if (is_bool($action)) {
                        if ($action) {
                            //IPS_LogMessage($this->name,__FUNCTION__."Enable Standard Action for $cap");
                            $this->EnableAction($cap);
                        } else {
                            //IPS_LogMessage($this->name,__FUNCTION__."Disable Standard Action for $cap");
                            $this->DisableAction($cap);
                        }
                        //}
                    }//actiom
                }//caps
            } else {
                IPS_LogMessage($this->name, __FUNCTION__ . " Var with Ident $ident not found");
            }//id
        }//for
    }//function

    //------------------------------------------------------------------------------
    /**
     * Enter/Lock semaphore
     * @param $resource
     * @return bool
     */
    protected function SemEnter($resource)
    {
        for ($i = 0; $i < 100; $i++) {
            if (IPS_SemaphoreEnter($this->name . "-" . $resource, 1)) {
                return true;
            } else {
                IPS_Sleep(mt_rand(1, 3));
            }
        }
        return false;
    }

    //------------------------------------------------------------------------------
    /**
     * Leave/unlock Semaphore
     * @param $resource
     */
    protected function SemLeave($resource)
    {
        IPS_SemaphoreLeave($this->name . "-" . $resource);
    }

    //-------------------------------------------------------------------------------
    /**
     * Check profile by name if exists, else create
     * @param String $pname Name
     * @param integer $typ Variable Typ (0..3)
     * @param String $prefix Prefix before value
     * @param String $suffix Suffix after value
     * @param String $icon Icon Name
     * @param integer $min min value
     * @param integer $max max value
     * @param integer $step step value
     * @param integer $digit digits for formatting
     * @param boolean $drop drop existing profile first
     */
    protected function check_profile($pname, $typ, $prefix, $suffix, $icon, $min, $max, $step, $digit = 0, $drop = false)
    {
        if (IPS_VariableProfileExists($pname) && $drop) IPS_DeleteVariableProfile($pname);
        if (!IPS_VariableProfileExists($pname)) {
            IPS_LogMessage($this->name, __FUNCTION__ . "::Create VariableProfile $pname");
            if (IPS_CreateVariableProfile($pname, $typ)) {
                IPS_SetVariableProfileText($pname, $prefix, $suffix);
                if (isset($min) && isset($max) && isset($step)) {
                    IPS_SetVariableProfileValues($pname, $min, $max, $step);
                }
                if (isset($digit)) {
                    IPS_SetVariableProfileDigits($pname, $digit);
                }
                if ($icon) {
                    IPS_SetVariableProfileIcon($pname, $icon);
                }
            } else {
                IPS_LogMessage($this->name, __FUNCTION__ . "::Cannot Create VariableProfile $pname");
            }
        }
    }

    //-------------------------------------------------------------------------------
    /**
     * Delete a Variable by name if exists and assigned events
     * @param String $ident
     */
    protected function drop_var($ident)
    {
        //IPS_LogMessage($this->name, __FUNCTION__ . "::Drop Var $ident");
        $vid = @$this->GetIDForIdent($ident);
        if (($vid > 0) && IPS_VariableExists($vid)) {
            $events = IPS_GetVariableEventList($vid);
            foreach ($events as $ev) {
                @IPS_DeleteEvent($ev);
            }
            @IPS_DeleteVariable($vid);
            return;
        }
        IPS_LogMessage($this->name, __FUNCTION__ . "::Error Variable $ident not found");
    }

    //------------------------------------------------------------------------------
    //--------helper functions ---------------
    //------------------------------------------------------------------------------
    /**
     * Log an debug message
     * PHP modules cannot enter data to debug window,use messages instead
     * @param $topic
     * @param $data
     */
    protected function debug($topic, $data)
    {
        $data = "(ID #$this->InstanceID) $topic ::" . $data;
        if ($this->isDebug()) {
            IPS_LogMessage($this->name, $data);

        }
    }
    //------------------------------------------------------------------------------
    /**
     * check if debug is enabled
     * @return bool
     */
    protected function isDebug()
    {
        $debug = @IPS_GetProperty($this->InstanceID, 'Debug');
        return ($debug === true);
    }
    //--------------------------------------------------------
    /**
     * Log Debug to its own file
     * @param $data
     */
    protected function debuglog($data)
    {
        if (!$this->isDebug()) return;
        $fname = $this->DEBUGLOG;
        $o = @fopen($fname, "a");
        if (!$o) {
            $this->debug(__FUNCTION__, 'Cannot open ' . $fname);
            return;
        }
        fwrite($o, $data . "\n");
        fclose($o);
    }

}//class

//------------------------------------------------------------------------------
/**
 * Hex String functions
 */
//------------------------------------------------------------------------------
/**
 * Make Hex string
 * http://stackoverflow.com/questions/14674834/php-convert-string-to-hex-and-hex-to-string
 * @param $string
 * @return string
 */
function strToHex($string)
{
    $hex = '';
    for ($i = 0; $i < strlen($string); $i++) {
        $ord = ord($string[$i]);
        $hexCode = dechex($ord);
        $hex .= substr('0' . $hexCode, -2);
    }
    return strtoupper($hex);
}

//------------------------------------------------------------------------------
/**
 * @param $hex
 * @return string
 */
function hexToStr($hex)
{
    $string = '';
    for ($i = 0; $i < strlen($hex) - 1; $i += 2) {
        $string .= chr(hexdec($hex[$i] . $hex[$i + 1]));
    }
    return $string;
}
