<?php
/**
 * @file
 *
 * generic Energy Device Module
 *
 * @author Thomas Dressler
 * @copyright Thomas Dressler 2016-2018
 * @version 5.0.1
 * @date 2018-08-18
 */


include_once(__DIR__ . "/../libs/module_helper.php");

/**
 * @class EnergyDev
 *
 * generic Energy Device Module Class for IPSymcon
 *
 *
 */
class EnergyDev extends T2DModule
{
    //------------------------------------------------------------------------------
    //module const and vars
    //------------------------------------------------------------------------------
    
    /**
     * mapping array for capabilities to variables
     * @var array $capvars
     */
    ///[capvars]
    protected $capvars = array(
        'Name' => array("ident" => 'Name', "type" => self::VT_String, "name" => 'Name', 'profile' => '', "pos" => 0),
        "APower" => array("ident" => 'APower', "type" => self::VT_Float, "name" => 'Power Actual', "profile" => 'Power_W.3', "pos" => 1),
        "TPower" => array("ident" => 'TPower', "type" => self::VT_Float, "name" => 'Power Total', "profile" => 'Electricity', "pos" => 1),
        "PPower" => array("ident" => 'PPower', "type" => self::VT_Float, "name" => 'Power Peak', "profile" => 'Power_W.3', "pos" => 1),
        "AGas" => array("ident" => 'AGas', "type" => self::VT_Float, "name" => 'Gas Actual', "profile" => 'Gas', "pos" => 1),
        "TGas" => array("ident" => 'TGas', "type" => self::VT_Float, "name" => 'Gas Total', "profile" => 'Gas', "pos" => 1),
        "PGas" => array("ident" => 'PGas', "type" => self::VT_Float, "name" => 'Gas Peak', "profile" => 'Gas', "pos" => 1),
        "AWasser" => array("ident" => 'AWasser', "type" => self::VT_Float, "name" => 'Wasser Actual', "profile" => 'Water', "pos" => 1),
        "TWasser" => array("ident" => 'TWasser', "type" => self::VT_Float, "name" => 'Wasser Total', "profile" => 'Water', "pos" => 1),
        "PWasser" => array("ident" => 'PWasser', "type" => self::VT_Float, "name" => 'Wasser Peak', "profile" => 'Water', "pos" => 1),
        "Amp" => array("ident" => 'Amp', "type" => self::VT_Float, "name" => 'Ampere', "profile" => '~Ampere.16', "pos" => 2),
        //counter based
        "Counter" => array("ident" => 'Counter', "type" => self::VT_Integer, "name" => 'Counter', "profile" => '', "pos" => 2,"hidden" => true),
        "OCounter" => array("ident" => 'OCounter', "type" => self::VT_Integer, "name" => 'Counter Offset', "profile" => '', "pos" => 2, "hidden" => true),
        "ACounter" => array("ident" => 'ACounter', "type" => self::VT_Integer, "name" => 'Current Counter', "profile" => '', "pos" => 2, "hidden" => true),
        "PCounter" => array("ident" => 'PCounter', "type" => self::VT_Integer, "name" => 'Peak Counter', "profile" => '', "pos" => 2, "hidden" => true),
        //usv
        'VoltBatt' => array("ident" => 'VoltBatt', "type" => self::VT_Float, "name" => 'Batterie Volt', 'profile' => 'Volt', "pos" => 4),
        "VoltIn" => array("ident" => 'VoltIn', "type" => self::VT_Float, "name" => 'Voltage Input', "profile" => 'Volt.230', "pos" => 4),
        "VoltOut" => array("ident" => 'VoltOut', "type" => self::VT_Float, "name" => 'Voltage Output', "profile" => 'Volt.230', "pos" => 5),
        "Freq" => array("ident" => 'Freq', "type" => self::VT_Float, "name" => 'Frequency', "profile" => 'Hertz.50', "pos" => 6),
        'LoadPct' => array("ident" => 'LoadPct', "type" => self::VT_Integer, "name" => 'Load', 'profile' => 'Battery.100', "pos" => 8),
        'Charged' => array("ident" => 'Charged', "type" => self::VT_Integer, "name" => 'Charged', 'profile' => 'Battery.100', "pos" => 7),
        'Nominal' => array("ident" => 'Nominal', "type" => self::VT_Float, "name" => 'Nominal Load', 'profile' => 'Watt.3680', "pos" => 9,"hidden" => true),
        'Watt' => array("ident" => 'Watt', "type" => self::VT_Float, "name" => 'Watt', 'profile' => 'Watt.3680', "pos" => 9),
        'TimeLeft' => array("ident" => 'TimeLeft', "type" => self::VT_Float, "name" => 'Time Left', 'profile' => 'Time.min', "pos" => 10),

        'Status' => array("ident" => 'Status', "type" => self::VT_String, "name" => 'Status', 'profile' => '', "pos" => 11),
        'Alert' => array("ident" => 'Alert', "type" => self::VT_Boolean, "name" => 'Alert', 'profile' => 'Alert.Reversed', "pos" => 12),
        "Battery" => array("ident" => "Battery", "type" => self::VT_Boolean, "name" => 'Battery', "profile" => 'Battery.Reversed', "pos" => 13,"hidden" => true),
        'Signal' => array("ident" => 'Signal', "type" => self::VT_Integer, "name" => 'Signal', 'profile' => 'Signal', "pos" => 40,"hidden" => true),
        "TS" => array("ident" => "TS", "type" => self::VT_Integer, "name" => 'Timestamp', "profile" => 'UnixTimestamp', "pos" => 41,"hidden" => true)

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
        $this->RegisterPropertyFloat('CounterFactor',1.0);

        //NonStandard Profiles (needed for Webfront)
        $this->check_profile('Time.min', 2, "", ' min', "Hourglass", null, null, null, 1, false);
        $this->check_profile('Power_W.3', 2, "", " W", "Electricity", 0, 9999, 1, 3, false);
        $this->check_profile('Power_Wh', 2, "", " Wh", "Electricity", 0, 9999, 1, 0, false);
        $this->check_profile('Signal', 1, "", " dB", "Gauge", -120, +10, 1, 0, false);

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
        // Diese Zeile nicht loeschen
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
                if ($target == $this->module_interfaces['EN-RX']) {
                    if (isset($data['ENData']) && isset($data['DeviceID'])) {
                        $Device = $data['DeviceID'];
                        $typ = $data['Typ'];
                        $class = $data['Class'];
                        //call data point
                        $myID = $this->GetDeviceID();
                        $myType = $this->GetType();
                        $myClass = $this->GetClass();
                        if (($myID == $Device) && ($myType == $typ) && ($myClass == $class)) {
                            $this->debug(__FUNCTION__, "$Device(Typ:$typ,Class:$class)");
                            $sw_data = $data['ENData'];
                            if (is_object($sw_data)) $sw_data = get_object_vars($sw_data);
                            $this->ParseData($sw_data);
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
     * @param string $Data
     * @return bool
     */
    protected function SendDataToParent($Data)
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
    /**
     * GetProperty Modul class of creator
     * @return string
     */
    private function GetCounterFactor()
    {
        return floatval(IPS_GetProperty($this->InstanceID, 'CounterFactor'));
    }

    //------------------------------------------------------------------------------
    /**
     * handle incoming data along capabilities
     * @param array $data
     */
    private function ParseData($data)
    {
        //
        $this->debug(__FUNCTION__,'Parse');
        $caps = $this->GetCaps();
        foreach (array_keys($caps) as $cap) {
            $ident = $caps[$cap];
            $vid = @$this->GetIDForIdent($ident);
            if ($vid == 0) {
                $this->debug(__FUNCTION__, "Cap $cap Ident $ident: Variable missed");
                continue;
            }
            if (!isset($data[$cap])) continue;
            $s = $data[$cap];
            $this->debug(__FUNCTION__, "Handle $cap ($vid) = $s");
            switch ($cap) {
                //boolean types
                case 'Alert'://Status
                    $state = ($s != 'YES'); //reversed display
                    SetValueBoolean($vid, $state);
                    break;
                //Counter types with factor
                case 'Counter':
                    $iv = (int)$s;
                    switch ($this->GetType()) {
                        case 'EMWZ':
                            $last=GetValueInteger($vid);
                            $opid=$this->GetIDForIdent('OCounter');
                            if ($opid) {
                                $offset=GetValueInteger($opid);
                                if ($last>$iv) {
                                    $offset+=65535;
                                    $this->debug(__FUNCTION__, "EMWZ:Increase Offset by 65535: $offset");
                                    SetValueInteger($opid,$offset);
                                }
                                $iv=$iv+$offset;
                            }else{
                                $this->debug(__FUNCTION__, "EMWZ:No vid for OCounter");
                            }

                            $pvid=$this->GetIDForIdent('TPower');
                            if ($pvid) {
                                $factor=$this->GetCounterFactor();
                                if ($factor == 0) $factor=150;
                                $val=$iv*(1/$factor); //counter%ticks pro kw
                                SetValueFloat($pvid,$val);
                                $this->debug(__FUNCTION__, "EMWZ:TPower:($pvid)=" . $val ."F:$factor(".$this->GetCounterFactor().")");
                                
                            }else{
                                $this->debug(__FUNCTION__, "EMWZ:No vid for TPower");
                            }

                            break;
                        case 'EMEM':
                            $last=GetValueInteger($vid);
                            $opid=$this->GetIDForIdent('OCounter');
                            if ($opid) {
                                $offset=GetValueInteger($opid);
                                if ($last>$iv) {
                                    $offset+=65535;
                                    $this->debug(__FUNCTION__, "EMEM:Increase Offset by 65535: $offset");
                                    SetValueInteger($opid,$offset);
                                }
                                $iv=$iv+$offset;
                            }else{
                                $this->debug(__FUNCTION__, "EMEM:No vid for OCounter");
                            }

                            $pvid=$this->GetIDForIdent('TPower');
                            if ($pvid) {
                                $factor=$this->GetCounterFactor();
                                if ($factor == 0) $factor=100;
                                $val=$iv*(1/$factor); //counter%ticks pro kw
                                SetValueFloat($pvid,$val);
                                $this->debug(__FUNCTION__, "EMEM:TPower:($pvid)=" . $val ."F:$factor(".$this->GetCounterFactor().")");
                            }else{
                                $this->debug(__FUNCTION__, "EMEM:No vid for TPower");
                            }

                            break;
                        case 'EMGZ':
                            $pvid=$this->GetIDForIdent('TGas');
                            if ($pvid) {
                                $factor=$this->GetCounterFactor();
                                if ($factor == 0) $factor=100;
                                $val=$iv*(1/$factor); //Counter%ticks pro m3
                                SetValueFloat($pvid,$val);
                                $this->debug(__FUNCTION__, "EMGZ:TGas:($pvid)=" . $val ."F:$factor(".$this->GetCounterFactor().")");
                            }else{
                                $this->debug(__FUNCTION__, "EMGZ:No vid for TGas");
                            }
                            break;

                    }
                    SetValueInteger($vid, $iv);
                    break;
                case 'ACounter':
                    $iv = (int)$s;
                    switch ($this->GetType()) {
                        case 'EMWZ':
                            $pvid=$this->GetIDForIdent('APower');
                            if ($pvid) {
                                $factor=$this->GetCounterFactor();
                                if ($factor == 0) $factor=150;
                                $val=$iv*(1/$factor)*1000; //W statt KW
                                SetValueFloat($pvid,$val);
                                $this->debug(__FUNCTION__, "EMWZ:APower:($pvid)=" . $val ."F:$factor(".$this->GetCounterFactor().")");
                            }else{
                                $this->debug(__FUNCTION__, "EMWZ:No vid for APower");
                            }
                        break;
                        case 'EMEM':
                            $pvid=$this->GetIDForIdent('APower');
                            if ($pvid) {
                                $factor=$this->GetCounterFactor();
                                if ($factor == 0) $factor=100;
                                $val=$iv*(1/$factor)*1000; //W statt KW
                                SetValueFloat($pvid,$val);
                                $this->debug(__FUNCTION__, "EMEM:APower:($pvid)=" . $val ."F:$factor(".$this->GetCounterFactor().")");
                            }else{
                                $this->debug(__FUNCTION__, "EMEM:No vid for APower");
                            }
                            break;
                        case 'EMGZ':
                            $pvid=$this->GetIDForIdent('AGas');
                            if ($pvid) {
                                $factor=$this->GetCounterFactor();
                                if ($factor == 0) $factor=100;
                                $val=$iv*(1/$factor); //m3
                                SetValueFloat($pvid,$val);
                                $this->debug(__FUNCTION__, "EMGZ:AGas:($pvid)=" . $val ." F:$factor(".$this->GetCounterFactor().")");
                            }else{
                                $this->debug(__FUNCTION__, "EMGZ:No vid for AGas");
                            }
                            break;

                    }
                    SetValueInteger($vid, $iv);
                    break;
                case 'PCounter':
                    $iv = (int)$s;
                    switch ($this->GetType()) {
                        case 'EMWZ':
                            $pvid=$this->GetIDForIdent('PPower');
                            if ($pvid) {
                                $factor=$this->GetCounterFactor();
                                if ($factor == 0) $factor=150;
                                $val=$iv*(1/$factor)*1000; //W statt KW
                                SetValueFloat($pvid,$val);
                                $this->debug(__FUNCTION__, "EMWZ:PPower:($pvid)=" . $val ."F:$factor(".$this->GetCounterFactor().")");
                            }else{
                                $this->debug(__FUNCTION__, "EMWZ:No vid for PPower");
                            }
                            break;
                        case 'EMEM':
                            $pvid=$this->GetIDForIdent('PPower');
                            if ($pvid) {
                                $factor=$this->GetCounterFactor();
                                if ($factor == 0) $factor=100;
                                $val=$iv*(1/$factor)*1000; //W statt KW
                                SetValueFloat($pvid,$val);
                                $this->debug(__FUNCTION__, "EMEM:PPower:($pvid)=" . $val ." F:$factor(".$this->GetCounterFactor().")");
                            }else{
                                $this->debug(__FUNCTION__, "EMEM:No vid for PPower");
                            }
                            break;
                        case 'EMGZ':
                            $pvid=$this->GetIDForIdent('PGas');
                            if ($pvid) {
                                $factor=$this->GetCounterFactor();
                                if ($factor == 0) $factor=100;
                                $val=$iv*(1/$factor); //m3
                                SetValueFloat($pvid,$val);
                                $this->debug(__FUNCTION__, "EMGZ:PGas:($pvid)=" . $val ." F:$factor(".$this->GetCounterFactor().")");
                            }else{
                                $this->debug(__FUNCTION__, "EMGZ:No vid for PGas");
                            }
                            break;
                    }
                    SetValueInteger($vid, $iv);
                    break;
                //int types
                case 'Signal': //RSSI
                
                case 'LoadPct'://Load in Pct
                case 'Charged'://Charged in Pct
                
                case 'OCounter': //old counter
                case 'TS': //Timestamp 
                    $iv = (int)$s;
                    SetValueInteger($vid, $iv);
                    break;
                //float types with factor
                case 'AGas'://Actual 
                case 'TGas'://Total
                case 'PGas'://Peak
                case 'APower'://Actual
                case 'PPower'://Peak
                case 'TPower'://Total 
                case 'AWater'://Actual 
                case 'TWater'://Total
                case 'PWater'://Peak
                    $fv = (float)$s;
                    $factor=$this->GetCounterFactor();
                    $val=$fv*$factor;
                    SetValueFloat($vid, $val);
                    break;
                //float types
                case 'VoltIn'://InputVolt
                case 'VoltOut'://Output Volt
                case 'VoltBatt'://Battery Volt
                case 'Nominal'://Nominal Power
                case 'Watt'://Absolute Load
                case 'Freq'://Frequency
                case 'TimeLeft'://TimeLeft
                    $fv = (float)$s;
                    SetValueFloat($vid, $fv);
                    break;
                //string types
                case 'Name':
                case 'Status':
                    $st = utf8_decode($s);
                    SetValueString($vid, $st);
                    break;

                default:
                    $this->debug(__FUNCTION__, "$cap not handled");
            }//switch
            $this->debug(__FUNCTION__, "$cap:($vid)=" . $s);
        }//for
    }//function
}//class
