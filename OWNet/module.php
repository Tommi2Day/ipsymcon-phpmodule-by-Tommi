<?php
/**
 * @file
 *
 * 1Wire via %OWNet Gateway IPSymcon PHP Splitter Module Class
 *
 * read 1wire devices via OWServer and OWNet Library
 *
 * @author Thomas Dressler
 * @copyright Thomas Dreßler 2014-2023
 * @version 7.0.1
 * @date 2023-11-18
 *
 */

include_once(__DIR__ . "/../libs/module_helper.php");
require "ownet_php82fixed.php";

/** @class OWN
 * 
 * 1Wire via OWNet
 * IPSymcon PHP Splitter Module Class
 * 
 */
class OWN extends T2DModule
{
    //------------------------------------------------------------------------------
    //module const and vars
    //------------------------------------------------------------------------------

    /**
     * owfs root dir to parse, maybe '/uncached/' for direct access
     */
    private $ow_path='/';

    /**
     * Fieldlist for Logging
     */
    private $fieldlist = array("Date","Typ", "Id", "Name", "Temp");


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
        $this->RegisterPropertyString('Category', 'OWNet Devices');
        $this->RegisterPropertyInteger('ParentCategory', 0); //parent cat is root
        $this->RegisterPropertyInteger('Port', 4304);
        $this->RegisterPropertyInteger('UpdateInterval', 300);
        $this->RegisterPropertyInteger('Timeout', 10);
        $this->RegisterPropertyString('Host', '');
        $this->RegisterPropertyString('LogFile', '');
        $this->RegisterPropertyBoolean('AutoCreate', true);
        $this->RegisterPropertyBoolean('Debug', false);
        $this->RegisterPropertyBoolean('Active', false);

        //timer
        $this->RegisterTimer('Update', 0, $this->module_data["prefix"] . '_UpdateEvent($_IPS[\'TARGET\']);');
        

        if (IPS_GetKernelRunlevel() == self::KR_READY) {
            if ($this->isActive()) {
                $this->SetStatus(self::ST_AKTIV);
                $i = $this->GetUpdateInterval();
                $this->SetTimerInterval('Update', ($i * 1000));//ms
                $this->debug(__FUNCTION__, "Starte Timer $i sec");
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
     * overwrite internal IPS_ApplyChanges($id) function
     */
    public function ApplyChanges()
    {
        // Diese Zeile nicht loeschen
        parent::ApplyChanges();
        if ($this->isActive()) {
            $this->SetStatus(self::ST_AKTIV);
            $i = $this->GetUpdateInterval();
            $this->SetTimerInterval('Update', ($i * 1000));//ms
            $this->debug(__FUNCTION__, "Starte Timer $i sec");
            $this->init();
        } else {
            $this->SetStatus(self::ST_INACTIV);
            $this->SetTimerInterval('Update', 0);
        }

    }

    ///--------------------------------------------------------
    //Get/Set
    //--------------------------------------------------------
    /**
     * Get Property UpdateInterval
     * @return int
     */
    private function GetUpdateInterval()
    {
        return (Integer)IPS_GetProperty($this->InstanceID, 'UpdateInterval');
    }

    //------------------------------------------------------------------------------
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
     * Get Property logfile name
     * @return string
     */
    private function GetHost()
    {
        return (String)IPS_GetProperty($this->InstanceID, 'Host');
    }

    //------------------------------------------------------------------------------
    /**
     * Get Property Port
     * @return int
     */
    private function GetPort()
    {
        return (Integer)IPS_GetProperty($this->InstanceID, 'Port');
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

    //--------------------------------------------------------

    /**
     * Get Property Timeout
     * @return int
     */
    private function GetTimeout()
    {
        return (Integer)IPS_GetProperty($this->InstanceID, 'Timeout');
    }

    //------------------------------------------------------------------------------
    //---Events
    //------------------------------------------------------------------------------
    /**
     * Timer Event to query the %OWNet daemon
     * discard output
     */
    public function UpdateEvent()
    {
        $this->debug(__FUNCTION__, 'UpdateEvent');
        //delay random time to prevent timer clash
        if (!$this->isActive()) return;
        $delay = rand(500, 5000);
        IPS_Sleep($delay);
        $this->Query();
    }
    //------------------------------------------------------------------------------
    //device functions
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
                    default:
                        $this->debug(__FUNCTION__, "DataID $target ist not supported");
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
     * Data Interface to Childs
     * @param string $Data
     */
    protected function SendDataToChildren($Data)
    {
        parent::SendDataToChildren($Data);
    }



    //------------------------------------------------------------------------------
    //public functions
    //------------------------------------------------------------------------------

    /**
     * Query %OWNet daemon
     */
    public function Query()
    {
        $host=$this->GetHost();
        $port=$this->GetPort();
        $timeout=$this->GetTimeout();
        $connect="$host:$port";
        $ow=new OWNet("tcp://".$connect,$timeout);
        if ($ow) {
            //we are connected, proceed
            $this->debug(__FUNCTION__, "Connected to '$connect', timeout: $timeout");
            // retrieve owfs directory from given root
            $ow_dir=$ow->dir($this->ow_path);
            if ($ow_dir && isset($ow_dir['data_php'])) {
                $this->debug(__FUNCTION__, "ow_dir_data: ".print_r($ow_dir,true));
                //walk through the retrieved tree
                $dirs=explode(",",$ow_dir['data_php']);
                if (is_array($dirs) && (count($dirs)>0)) {
                    foreach ($dirs as $dev) {
                        $this->debug(__FUNCTION__, "dev: $dev");
                        //print_r($ow->dir($dev,true));
                        $data=array();
                        $caps='';
                        /* read standard device details */
                        //get family id
                        $fam=$ow->read("$dev/family");
                        if (!$fam) {
                            $this->debug(__FUNCTION__, "$dev is not related to a device family");
                            continue; //not a device path
                        }
                        //get device id
                        $id=$ow->read("$dev/id");
                        //get alias (if any) and owfs detected device description as type
                        $alias=$ow->get("$dev/alias");
                        $type=$ow->get("$dev/type");
                        if (!$type) {
                            $type="1Wire Family ".$fam;
                        }
                        //assign names for ips categories
                        $name=$id;
                        if ($alias) {
                            $name=$alias;
                            $caps='Name';
                        }

                        //save date
                        $data['Date'] = date('Y-m-d H:i:s', time());

                        //get varids
                        $addr="$fam.$id";
                        $this->debug(__FUNCTION__, "ID: $id ($alias): Type $type Family $fam");

                        //retrieve device specific data
                        switch ($fam) {
                            case '28': //DS18B20 temperature sensors
                            case '10': //DS18S20 temperature sensors
                            case '22': //DS1820 temperature sensors
                                $temp=$ow->get("$dev/temperature",OWNET_MSG_READ,true);
                                $this->debug(__FUNCTION__, "get $dev/temperature first, temp:".print_r($temp,true));
                                $temp=trim($ow->read("$dev/temperature",true));
                                $this->debug(__FUNCTION__, "read $dev/temperature again, temp:".print_r($temp,true));
                                $temp=str_replace(",",".",$temp);
                                if (strlen($temp)>0) {
                                    //store new temperature value
                                    $this->debug(__FUNCTION__, "$type $id ($alias): $temp");
                                    $data['Name']=$name;
                                    $data['Id']=$addr;
                                    $data['Typ']=$type;
                                    $data['Temp']=sprintf("%4.2F",$temp);
                                    //print " Alias '$alias',Temp $temp\n";
                                    $caps.=';Temp';
                                    $this->SendWSData($caps,$data);
                                    $this->log_data($data);
                                }else{
                                    $this->debug(__FUNCTION__,"ID $id: reading temp empty");
                                }
                                break;
                            default:
                                $this->debug(__FUNCTION__, "$id ($alias): Type $type Family $fam not implemented yet");
                                IPS_LogMessage(__CLASS__, "$id ($alias): Type $type Family $fam not implemented yet");
                                break;
                        }
                    } //for
                }else {
                    //no device fount
                    $this->debug(__FUNCTION__, "No 1Wire Device found");
                    IPS_LogMessage(__CLASS__, "No 1Wire Device found");
                }
            }else{
                //dir command failed, stop here
                $this->debug(__FUNCTION__, "Dir using $this->ow_path' failed");
            }
        }else{
            //no object, connect has been failed, stop here
            $this->debug(__FUNCTION__, "Connect to '$connect' failed");
            IPS_LogMessage(__CLASS__, "Connect to '$connect' failed");
        }        

    }//function
    //------------------------------------------------------------------------------
    //internal functions
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
                $this->debug(__FUNCTION__, 'Creating WSDEV Device AIN ' . $Device . ' disabled by Property AutoCreate');
                IPS_LogMessage($class, 'Creating  WSDEV Device AIN' . $Device . ' disabled by Property AutoCreate');
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
                IPS_SetName($instID, "$typ $Device");
                $ident = $class . "_$Device";
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
     * Log data to file
     * @param array $data Date per device
     */
    private function log_data($data)
    {
        //standard log)
        $fname = $this->GetLogFile();
        if ($fname > '') $this->log2file($fname, $data);

    }//function

    //--------------------------------------------------------
    /**
     * Log data to file
     * @param String $fname
     * @param array $data
     */
    private function log2file($fname, $data)
    {
        if ($fname == '') return;
        $this->debug(__FUNCTION__, 'File:' . $fname);
        $exists = file_exists($fname);
        $o = @fopen($fname, "a");
        if (!$o) {
            IPS_LogMessage(__CLASS__, __FUNCTION__ . '::Cannot open ' . $fname);
            return;
        }
        $header = implode(";", $this->fieldlist);
        if (!$exists) {
            fwrite($o, $header . "\r\n");
        } //if exists

        $line = '';
        for ($f = 0; $f < count($this->fieldlist); $f++) {
            $field = $this->fieldlist[$f];
            if (isset($data[$field])) {
                $val = $data[$field];
                $line .= $val;
                $this->debug(__FUNCTION__,"Field: $field, Val: $val");
            }
            $line .= ";";
        }//for
        $line .= "\r\n";
        fwrite($o, $line);
        fclose($o);
    }//function

}//class
