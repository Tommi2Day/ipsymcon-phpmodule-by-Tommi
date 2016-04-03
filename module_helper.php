<?php
/**
 * @file
 *
 * IPS Module Helper Class
 *
 * @author Thomas Dressler
 * @copyright Thomas Dressler 2016
 * @version 1.0
 * @date 2016-04-03
 */
//disable html errors in modules
ini_set("html_errors","0");

/** @class module helper
 *
 * IPS Module Helper Class
 *
 * @version 4.0
 * @date 2016-04-01
 *
 */

class module_helper
{
    //------------------------------------------------------------------------------
    //ips const
    //------------------------------------------------------------------------------
    /**
     *
     */
    const KR_READY = 10103;
    /**
     *
     */
    const ST_AKTIV = 102;
    /**
     *
     */
    const ST_INACTIV = 104;
    /**
     *
     */
    const ST_ERROR = 201;
    /**
     *
     */
    const ST_NOPARENT = 202;
    /**
     *
     */
    const VT_Boolean = 0;
    /**
     *
     */
    const VT_Integer = 1;
    /**
     *
     */
    const VT_Float = 2;
    /**
     *
     */
    const VT_String = 3;

    //------------------------------------------------------------------------------
    // Device guids
    //------------------------------------------------------------------------------
    /**
     * @var array
     */
    public static $module_interfaces = array(
        //Devices
        "WS300PC" => "{C790A7F2-2572-421F-901B-7F45C05BB062}", // WS300PC Splitter
        "WSDEV" => "{4228137D-EDE3-41BF-9B0A-CA0DB1AC6353}", // WS Device
        "FS20" => "{48FCFDC1-11A5-4309-BB0B-A0DB8042A969}", // FS20 Device
        "FS20WUE" => "{AA2544FC-0BF8-43C1-B84C-096B844AEACC}", //FS20WUE Splitter
        "WDE1" => "{EE7F90DD-7668-459C-A233-8241C46864A5}", //WDE1 Splitter
        "VirtIO" => "{6179ED6A-FC31-413C-BB8E-1204150CF376}",
        "SerialPort" => "{6DC3D946-0D31-450F-A8C6-C42DB8D7D4F1}",
        "ClientSocket" => "{3CFF0FD9-E306-41DB-9B5A-9D06D38576C3}",
        "FTDI" => "{C1D478E9-2A3E-4344-BCC4-37C892F58751}",
        "SwitchDev" => "{F2FC0924-2CE9-4067-9DB5-D228F0CCF4AD}", //Switch Device
        //Data Points
        "SWD-TX" => "{6FB0F652-2A47-46B1-AFC5-E327E45E59F9}", //SWDSend (from Device)
        "SWD-RX" => "{E8E6E831-3C60-41CD-B05F-B9FE86A6922E}", //SWDReceive (to Device)
        "WS-TX" => "{F7B329D4-6E4E-4D0C-B059-E1894B23D8CE}", //WSSend (from Device)
        "WS-RX" => "{CD3D1E2D-83ED-4595-90CD-3444A22AAA66}", //WSReceive (to Device)
        "IO-RX" => "{018EF6B5-AB94-40C6-AA53-46943E824ACF}", //from VirtIO
        "IO-TX" => "{79827379-F36E-4ADA-8A95-5F8D1DC92FA9}", //to VirtIO
        "FS20-TX" => "{122F60FB-BE1B-4CAB-A427-2613E4C82CBA}", //from FS20 Device
        "FS20-RX" => "{DF4F0170-1C5F-4250-840C-FB5B67262530}", //to FS20 Device
    );


    //------------------------------------------------------------------------------
    //Instance specific data
    //------------------------------------------------------------------------------
    /**
     * Instance ID of calling IPS Module instance
     * @var int
     */
    private $InstanceID = 0;
   
    /**
     * copy of instance modul name
     * @var string
     */
    private $modname = '';

    //------------------------------------------------------------------------------
    //Object functions
    //------------------------------------------------------------------------------
    /**
     * module_helper constructor.
     * @param $InstanceID
     * @param $name
     */
    public function __construct($InstanceID, $name)
    {

        $this->InstanceID = $InstanceID;
        $this->modname = $name;
    }

    //------------------------------------------------------------------------------
    //Public class functions
    //------------------------------------------------------------------------------
    /**
     * Check if a parent is active
     * @param $id integer InstanceID
     * @return bool
     */
    public function HasActiveParent($id = 0)
    {
        if ($id == 0) $id = $this->InstanceID;
        $parent = $this->GetParent($id);
        if ($parent > 0) {
            $status = $this->GetInstanceStatus($parent);
            if ($status == self::ST_AKTIV) {
                return true;
            } else {
                //IPS_SetInstanceStatus($id, self::ST_NOPARENT);
                //$this->debug(__FUNCTION__, "Parent not active for Instance #" . $id);
                return false;
            }
        }
        //$this->debug(__FUNCTION__, "No Parent for Instance #" . $id);
        return false;
    }
    //--------------------------------------------------------
    /**
     * Check if the given Instance is active
     * @param int $id
     * @return bool
     */
    public function isActive($id=0)
    {
        if ($id == 0) $id = $this->InstanceID;
        $res=$this->HasActiveParent($id);
        if ($res) $res=(bool)IPS_GetProperty($id, 'Active');
        return $res;
    }
    
    //------------------------------------------------------------------------------
    /**
     * Retrieve instance status 
     * @param int $id
     * @return mixed
     */
    public function GetInstanceStatus($id=0) {
        if ($id == 0) $id = $this->InstanceID;
        $inst=IPS_GetInstance($id);
        return $inst['InstanceStatus'];
    }

    //------------------------------------------------------------------------------
    /**
     * Check if a parent for Instance $id exists
     * @param $id integer InstanceID
     * @return integer
     */
    public function GetParent($id = 0)
    {
        $parent = 0;
        if ($id == 0) $id = $this->InstanceID;
        if (IPS_InstanceExists($id)) {
            $instance = IPS_GetInstance($id);
            $parent = $instance['ConnectionID'];
        } else {
            //$this->debug(__FUNCTION__, "Instance #$id dosnt exists");
        }
        return $parent;
    }

    //------------------------------------------------------------------------------
    /**
     * Enter/Lock semaphore
     * @param $resource
     * @return bool
     */
    public function SemEnter($resource)
        {
            for ($i = 0; $i < 100; $i++) {
                if (IPS_SemaphoreEnter($this->modname . "-" . $resource, 1)) {
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
    public function SemLeave($resource)
    {
        IPS_SemaphoreLeave($this->modname . "-" . $resource);
    }

}//class

//###########################################
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
