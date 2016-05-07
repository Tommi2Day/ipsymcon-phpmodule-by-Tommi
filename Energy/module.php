<?php
/**
 * @file
 *
 * generic Energy Device Module
 *
 * @author Thomas Dressler
 * @copyright Thomas Dressler 2016
 * @version 1.3
 * @date 2016-04-10
 */


include_once(__DIR__ . "/../module_helper.php");

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
        'Name' => array("ident" => 'Name', "type" => self::VT_String, "name" => 'Name', 'profile' => '~String', "pos" => 0),
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
        "VoltIn" => array("ident" => 'VoltIn', "type" => self::VT_Integer, "name" => 'Voltage Input', "profile" => 'Volt.230', "pos" => 4),
        "VoltOut" => array("ident" => 'VoltOut', "type" => self::VT_Integer, "name" => 'Voltage Output', "profile" => 'Volt.230', "pos" => 5),
        "Freq" => array("ident" => 'Freq', "type" => self::VT_Float, "name" => 'Frequency', "profile" => 'Hertz.50', "pos" => 6),
        'LoadPct' => array("ident" => 'LoadPct', "type" => self::VT_Integer, "name" => 'Load', 'profile' => 'Battery.100', "pos" => 8),
        'Charged' => array("ident" => 'Charged', "type" => self::VT_Integer, "name" => 'Charged', 'profile' => 'Battery.100', "pos" => 7),
        'Nominal' => array("ident" => 'Nominal', "type" => self::VT_Integer, "name" => 'Nominal Load', 'profile' => 'Watt.3680', "pos" => 9,"hidden" => true),
        'Watt' => array("ident" => 'Watt', "type" => self::VT_Integer, "name" => 'Load absolute', 'profile' => 'Watt.3680', "pos" => 9),
        'TimeLeft' => array("ident" => 'TimeLeft', "type" => self::VT_Float, "name" => 'Time Left', 'profile' => 'Time.min', "pos" => 10),
        'Status' => array("ident" => 'Status', "type" => self::VT_String, "name" => 'Status', 'profile' => 'String', "pos" => 11),
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
        $this->RegisterPropertyFloat('CounterFactor',1);

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
    /**
     * GetProperty Modul class of creator
     * @return string
     */
    private function GetCounterFactor()
    {
        return (String)IPS_GetProperty($this->InstanceID, 'CounterFactor');
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
                        case 'EMEM':
                            $last=GetValueInteger($vid);
                            $opid=$this->GetIDForIdent('OCounter');
                            if ($opid) {
                                $offset=GetValueInteger($opid);
                                if ($last>$iv) {
                                    $offset+=65535;
                                    SetValueInteger($opid,$offset);
                                }
                                $iv=$iv+$offset;
                            }

                            $pvid=$this->GetIDForIdent('TPower');
                            if ($pvid) {
                                $factor=$this->GetCounterFactor();
                                $val=$iv*$factor;
                                SetValueFloat($pvid,$val);
                            }

                            break;
                        case 'EMGZ':
                            $pvid=$this->GetIDForIdent('TGas');
                            if ($pvid) {
                                $factor=$this->GetCounterFactor();
                                $val=$iv*$factor;
                                SetValueFloat($pvid,$val);
                            }
                            break;
                        default:
                            SetValueInteger($vid, $iv);
                    }

                    break;
                case 'ACounter':
                    $iv = (int)$s;
                    switch ($this->GetType()) {
                        case 'EMEM':
                            $pvid=$this->GetIDForIdent('APower');
                            if ($pvid) {
                                SetValueFloat($pvid,$iv);
                            }
                        break;
                        case 'EMWZ':
                            $pvid=$this->GetIDForIdent('APower');
                            if ($pvid) {
                                $factor=$this->GetCounterFactor();
                                $val=$iv*$factor;
                                SetValueFloat($pvid,$val);
                            }
                            break;
                        case 'EMGZ':
                            $pvid=$this->GetIDForIdent('AGas');
                            if ($pvid) {
                                $factor=$this->GetCounterFactor();
                                $val=$iv*$factor;
                                SetValueFloat($pvid,$val);
                            }
                            break;

                    }
                    SetValueInteger($vid, $iv);
                    break;
                //int types
                case 'Signal': //RSSI
                case 'VoltIn'://InputVolt
                case 'VoltOut'://Output Volt
                case 'LoadPct'://Load in Pct
                case 'Charged'://Charged in Pct
                case 'Nominal'://Nominal Power
                case 'Watt'://Absolute Load
                case 'OCounter': //old counter
                case 'PCounter': //peack counter
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
            $this->debug(__FUNCTION__, "$cap:($vid)" . $s);
        }//for
    }//function
}//class
