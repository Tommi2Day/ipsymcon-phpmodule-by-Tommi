<?
/**
 * @file
 *
 * NUT Gateway IPSymcon PHP Splitter Module Class
 *
 * @author Thomas Dressler
 * @copyright Thomas Dressler 2011-2019
 * @version 5.1.0
 * @date 2019-05-04
 */

include_once(__DIR__ . "/../libs/module_helper.php");

/** @class NUT
 *
 * %NUT  IPSymcon PHP Splitter Module Class
 */
class NUT extends T2DModule
{
    //------------------------------------------------------------------------------
    //module const and vars
    //------------------------------------------------------------------------------

    /**
     * default Nominal Value
     */
    const default_nomval=100;
    /**
     * Nominal power map
     */
    private $nomvals = array(
        700 => 480,
        750 => 500, //smart ups xxx
        1000 => 670,
        1500 => 980,
        2200 => 1580,
        3000 => 2700,
        420 => 260, //Smart ups SC xxx
        450 => 280,
        620 => 390,
        350 => 210, //Back UPS CS/ES
        400 => 240,
        500 => 300,
        550 => 330,
        800 => 540); //Back UPS RS

    /**
     * Fieldlist for Logging
     */
    private $fieldlist = array("Date","Typ", "Id", "Name", "VoltIn", "VoltOut", "Freq", "LoadPct", "Charged", "Watt", "Nominal", "TimeLeft", "Status", "Alert","VoltBatt");


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
        $this->RegisterPropertyString('Category', 'NUT Devices');
        $this->RegisterPropertyInteger('ParentCategory', 0); //parent cat is root
        $this->RegisterPropertyInteger('Port', 3493);
        $this->RegisterPropertyInteger('UpdateInterval', 300);
        $this->RegisterPropertyInteger('NomPower', self::default_nomval);
        $this->RegisterPropertyString('IDfield', 'ups.serial');
        $this->RegisterPropertyString('UPSname', '');
        $this->RegisterPropertyString('Host', '');
        $this->RegisterPropertyString('LogFile', '');
        $this->RegisterPropertyBoolean('AutoCreate', true);
        $this->RegisterPropertyBoolean('Debug', false);
        $this->RegisterPropertyBoolean('Active', false);

        //timer
        $this->RegisterTimer('Update', 0, $this->module_data["prefix"] . '_UpdateEvent($_IPS[\'TARGET\']);');
        //Vars

        //Connect Parent
        $this->RequireParent($this->module_interfaces['ClientSocket']);
        $pid = $this->GetParent();
        if ($pid) {
            $name = IPS_GetName($pid);
            if ($name == "Client Socket") IPS_SetName($pid, __CLASS__ . " Socket");
        }

        if (IPS_GetKernelRunlevel() == self::KR_READY) {
            if ($this->isActive() && ($this->GetParent() > 0)) {
                $this->SetStatus(self::ST_AKTIV);
                $i = $this->GetUpdateInterval();
                $this->SetTimerInterval('Update', ($i * 1000));//ms
                $this->debug(__FUNCTION__, "Starte Timer $i sec");
                $this->init();
            } else {
                $this->SetStatus(self::ST_INACTIV);
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
        if ($this->isActive() && ($this->GetParent() > 0)) {
            $this->SetStatus(self::ST_AKTIV);
            $i = $this->GetUpdateInterval();
            $this->SetTimerInterval('Update', ($i * 1000));//ms
            $this->debug(__FUNCTION__, "Starte Timer $i sec");
            $this->init();
        } else {
            $this->SetStatus(self::ST_INACTIV);
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
     * Get Nominal Power in W
     * @return int
     */
    private function GetNomPower()
    {
        return (Integer)IPS_GetProperty($this->InstanceID, 'NomPower');
    }

    //--------------------------------------------------------
    /**
     * Set Nominal Power in W
     * @param  int
     */
    private function SetNomPower($val)
    {
        $this->debug(__FUNCTION__, "Set NomPower:$val");
        IPS_SetProperty($this->InstanceID, 'NomPower',(Integer)$val);
        parent::ApplyChanges();
    }
    //------------------------------------------------------------------------------
    /**
     * Get ID field
     * @return string
     */
    private function GetIDfield()
    {
        return (String)IPS_GetProperty($this->InstanceID, 'IDfield');
    }

    //------------------------------------------------------------------------------
    /**
     * Get NUT UPS name
     * @return string
     */
    private function GetUPSname()
    {
        return (String)IPS_GetProperty($this->InstanceID, 'UPSname');
    }

    //--------------------------------------------------------
    /**
     * Set NUT name as send by NUT
     * @param  int
     */
    private function SetUPSname($val)
    {
        $this->debug(__FUNCTION__, "UPS Name:$val");
        IPS_SetProperty($this->InstanceID, 'UPSname',$val);
        parent::ApplyChanges();
    }

    //------------------------------------------------------------------------------
    //---Events
    //------------------------------------------------------------------------------
    /**
     * Timer Event to query the %NUT daemon
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
        $this->SetLocalBuffer('');
        $pid = $this->GetParent();
        if ($pid > 0) {
            //apply host+port to parent
            $host = $this->GetHost();
            $port = $this->GetPort();
            IPS_SetProperty($pid, 'Host', $host);
            IPS_SetProperty($pid, 'Port', $port);
            IPS_ApplyChanges($pid);
        } else {
            $this->debug(__FUNCTION__, 'Error:No parent attached');
        }

    }
    //------------------------------------------------------------------------------
    //Data Interfaces
    //------------------------------------------------------------------------------

    /**
     * Data Interface from Parent(IO-RX)
     * @param String $JSONString
     */
    public function ReceiveData($JSONString)
    {
        //status check triggered by data
        if ($this->isActive()) {
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
                    //$this->debug(__FUNCTION__, $buffer);
                    //$bl = strlen($buffer);
                    $this->SetLocalBuffer($buffer);
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
                    case $this->module_interfaces['EN-TX']:
                        $buffer = utf8_decode($data['Buffer']);
                        $this->debug(__FUNCTION__, 'EN-TX:' . $buffer);
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
     * Query Nut daemon
     */
    public function Query()
    {
        $nut_data = array();
        $pid = $this->GetParent();

        //open socket
        IPS_SetProperty($pid, 'Open', true);
        IPS_ApplyChanges($pid);
        //LIST UPS command
        $this->SetLocalBuffer("");
        $ups = $this->GetUPSname();
        if (empty($ups)) {
            $this->SetLocalBuffer("");
            $this->SendText("LIST UPS\n");
            IPS_Sleep(1000);
            $in = $this->GetLocalBuffer();
            $lines = explode("\n", $in);
            $this->SetLocalBuffer("");
            //extract UPS Name to query (assume only one!)
            if (isset($lines[1]) && preg_match('/^UPS\s+(\w+)\s+"(.*)"/', $lines[1], $res)) {
                $ups = $res[1];
                $this->SetUPSname($ups);
            }elseif(preg_match('/^ERR/',$in)){
                $this->debug(__FUNCTION__,"Error: ".$in);
                IPS_LogMessage(__CLASS__,__FUNCTION__." found ERROR:".$in);
            }else{
                $this->debug(__FUNCTION__,"unexpected data: ".$in);
            }

        }

        //query named UPS
        if (! empty($ups)) {
            $this->SendText("LIST VAR $ups \n");
            //wait
            IPS_Sleep(1000);
            //get response
            $in = $this->GetLocalBuffer();
            //cleaning
            $this->SetLocalBuffer("");
            //translate response into array
            $nut = $this->format_data($in);
            if (count($nut) > 1) {
                //more than one valid row found, looks good
                //parse
                $nut_data = $this->Parse($nut);
            } else {
                IPS_LogMessage(__CLASS__, "no valid VAR data found for UPS $ups");
            }
        }else{
            $this->debug(__FUNCTION__,"UPSname property not set and no UPS found");
        }
        //Socket close=terminate
        IPS_SetProperty($pid, 'Open', false);
        IPS_ApplyChanges($pid);


        if (count($nut_data) > 0) {
            $this->SendENData($nut_data);
        }

    }
    //------------------------------------------------------------------------------
    //internal functions
    //------------------------------------------------------------------------------

    /**
     * Data Interface tp Parent (IO-TX)
     * Forward commands to IO Instance
     * @param String $Data
     * @return bool
     */
    private function SendText(string $Data)
    {
        $res = false;
        $json = json_encode(
            array("DataID" => $this->module_interfaces['IO-TX'],
                "Buffer" => utf8_encode($Data)));
        if ($this->HasActiveParent()) {
            $this->debug(__FUNCTION__, $Data);
            $res = parent::SendDataToParent($json);
        } else {
            $this->debug(__FUNCTION__, 'No Parent');
        }
        return $res;

    }//function
    //------------------------------------------------------------------------------
    /**
     * parses an record string
     *
     * @param array $nut
     * @return array
     */
    private function Parse(array $nut)
    {

        $data = array();
        $ups=$this->GetUPSname();
        $data["Name"]=$ups;
        $idfield=$this->GetIDfield();
        if (isset($nut[$idfield])) {
            $dev = $nut[$idfield];
        } else {
            $dev=$ups."@".$this->GetHost();
        }
        $data['Id'] = $dev;
        if (isset($nut['input.voltage'])) {
            $data['VoltIn'] = $nut['input.voltage'];
        }
        if (isset($nut['output.voltage'])) {
            $data['VoltOut'] = $nut['output.voltage'];
        }
        if (isset($nut['ups.load'])) {
            $data['LoadPct'] = $nut['ups.load'];
        }
        if (isset($nut['battery.temperature'])) {
            $data['Temp'] = $nut['battery.temperature'];
        }
        if (isset($nut['ups.model'])) {
            $data['Typ'] = $nut['ups.model'];
        }
        if (isset($nut['ups.status'])) {
            $data['Status'] = $nut['ups.status'];
        }
        if (isset($nut['battery.runtime'])) {
            $data['TimeLeft'] = $nut['battery.runtime'] / 60;
        }
        if (isset($nut['battery.charge'])) {
            $data['Charged'] = $nut['battery.charge'];
        }
        if (isset($nut['battery.voltage'])) {
            $data['VoltBatt'] = $nut['battery.voltage'];
        }
        if (isset($nut['output.frequency'])) {
            $data['Freq'] = $nut['output.frequency'];
        }
        //nominal value
        $nominal=$this->GetNomPower();
        if ($nominal==self::default_nomval) {
            //looks like nompower isnt adjusted
            if (isset($nut['ups.realpower.nominal'])) {
                //retrieve nominal power from device data
                $nominal=$nut['ups.realpower.nominal'];
                $this->debug(__FUNCTION__, "Set Nominal Power Data =" . $nominal);
                $this->SetNomPower($nominal);
            }else{
                //guess from typ
                if (!empty($data['Typ'])) {
                    preg_match("/(\d{3,4})/", $data['Typ'], $result);
                    if (isset($result[0]) && (isset($nomvals[$result[0]]))) {
                        $nominal = $this->nomvals[$result[0]];
                        $this->debug(__FUNCTION__, "Set Nominal Power from Model(" . $data['Typ'] . "=" . $nominal);
                        $this->SetNomPower($nominal);
                    }
                }
            }
        }
        $data['Nominal']=$nominal;

        //load
        if (isset($data['LoadPct'])) {
            $watt = $data['Nominal'] * $data['LoadPct'];
            if ($watt > 0) $watt=round($watt / 100);
            $data['Watt'] = $watt;
            $this->debug(__FUNCTION__, "Power=" . $watt);
        }

        //Alert
        if (isset($data['Status'])) {
            $data['Alert'] = (substr($data['Status'], 0, 2) == 'OL') ? 'NO' : 'YES';
        }

        //set typ field
        if (!isset($data['Typ'])) $data['Typ'] = "NUT attached USV";

        $data['Date'] = date('Y-m-d H:i:s', time());
        return $data;
    }//function


    //------------------------------------------------------------------------------
    /**
     * Forward data to EnergyDev instances
     * Create one if needed
     * @param $data
     */
    private function SendENData($data)
    {
        //parsing was OK, start distributing
        $this->debug(__FUNCTION__, 'Prepare ' . print_r($data, true));
        $class = __CLASS__;
        if (!isset($data['Id']) || !isset($data['Typ'])) {
            IPS_LogMessage($class, 'Missing Data Id or Typ');
            return;
        }
        $id = $data['Id'];
        $typ = $data['Typ'];
        $caps = '';
        foreach ($this->fieldlist as $cap) {
            if (isset($data[$cap])) {
                $caps .= ";" . $cap;
            }
        }
        $caps=substr($caps,1);
        $this->debug(__FUNCTION__, "USV $id Caps: $caps ");
        $found = false;
        $instID = 0;
        $instances = IPS_GetInstanceListByModuleID($this->module_interfaces['EnergyDev']);
        foreach ($instances as $instID) {
            $I = @IPS_GetInstance($instID);
            if ($I && ($I['ConnectionID'] == $this->InstanceID)) { //my child
                $iid = (String)IPS_GetProperty($instID, 'DeviceID');
                $ityp = (String)IPS_GetProperty($instID, 'Typ');
                $iclass = (String)IPS_GetProperty($instID, 'Class');
                if (($iid == $id) && ($ityp == $typ) && ($iclass == $class)) {
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
                $instID = $this->CreateENDevice($data, $caps);
                if ($instID > 0) {
                    //new instance needed
                    $this->debug(__FUNCTION__, 'CREATE Device with Caps: ' . $caps);
                    $found = true;
                }
            } else {
                $this->debug(__FUNCTION__, 'Creating Device ID ' . $id . ' disabled by Property AutoCreate');
                IPS_LogMessage($class, 'Creating Device ID ' . $id . ' disabled by Property AutoCreate');
            }//if autocreate
        }//if found
        if ($found && ($instID > 0)) {
            //send record to children
            $json = json_encode(
                array("DataID" => $this->module_interfaces['EN-RX'],
                    "DeviceID" => $id,
                    "Typ" => $typ,
                    "Class" => $class,
                    "ENData" => $data));
            $this->debug(__FUNCTION__, $json);
            @$this->SendDataToChildren($json);
            $this->log_data($data);
        }//found

        $this->debug(__FUNCTION__, 'Finished');
    }//function


    //--------------------------------------------------------
    /**
     * Create a new EnergyDev instance and set its properties
     * @param array $data parsed record
     * @param String $caps String semicolon seperated capabilities of this device
     * @return int new Instance ID
     */
    private function CreateENDevice($data, $caps)
    {
        $instID = 0;
        $Device = $data['Id'];
        $typ = $data['Typ'];
        $ModuleID = $this->module_interfaces['EnergyDev'];
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
                IPS_SetName($instID, "$typ ID $Device");

                $ident = __CLASS__ . "_EN_$Device";
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
                //$this->debug(__FUNCTION__,"Field: $field, Val: $val");
            }
            $line .= ";";
        }//for
        $line .= "\r\n";
        fwrite($o, $line);
        fclose($o);
    }//function

    //--------------------------------------------------------
    /**
     *
     * @param string $text output from nut daemon
     * @return array $nut Array Key/Values
     */
    private function format_data($text)
    {
        $entry = explode("\n", $text); //Satztrenner
        $nut = array();
        foreach ($entry as $line) {
            if (!$line || strlen($line) < 5) continue;
            //Valid Line 'VAR <ups> <key> "<value>"'
            if (preg_match('/^VAR\s+(\w+)\s+([\w\.]+)\s+"(.*)"/', $line, $words)) {
                $this->debug(__FUNCTION__,"matched data: $line");
                $key = trim($words[2]);
                $value = trim($words[3]);
                $nut[$key] = $value;
            }elseif(preg_match('/^ERR/',$line)){
                $this->debug(__FUNCTION__,"Error: $line");
                IPS_LogMessage(__CLASS__,__FUNCTION__." found ERROR:".$line);
            }else{
                $this->debug(__FUNCTION__,"Unused data: $line");
            }
        }
        return $nut;
    }

}//class
