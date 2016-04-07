<?php
/**
 * @file
 *
 * generic Weather Station Sensor PHP Device Module Class
 *
 * @author Thomas Dressler
 * @copyright Thomas Dressler 2009-2016
 * @version 1.5
 * @date 2016-04-05
 */

/**
 * common module helper function
 */
include_once(__DIR__ . "/../module_helper.php");
/** 
 * @class WSDEV
 *
 * generic Weather Station Sensor PHP Device Module Class for IPSymcon
 * 
 * @par Prefix: WSD_
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
 * @snippet WSDev/module.php capvars
 *
 * - \b Debug: Flag to enable debug output via IPS_LogMessages
 *
 * @par Actions (if supported by the attached splitter and the physical device)
 * - \b None
 *
 */
class WSDEV extends T2DModule
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
        'Name'=>array("ident"=>'Name',"type"=>self::VT_String,"name"=>'Name','profile'=>'~String',"pos"=>0),
        "Temp" => array("ident" => 'Temperatur', "type" => self::VT_Float, "name" => 'Temperatur', "profile" => 'Temperature', "pos" => 0),
        "Hum" => array("ident" => 'Humidity', "type" => self::VT_Integer, "name" => 'Feuchte', "profile" => 'Humidity', "pos" => 1),
        "Press" => array("ident" => 'Pressure', "type" => self::VT_Integer, "name" => 'Pressure', "profile" => 'AirPressure', "pos" => 2),
        "Wind" => array("ident" => 'Windspeed', "type" => self::VT_Float, "name" => 'Wind Speed', "profile" => 'WindSpeed.kmh', "pos" => 3),
        "WindDir" => array("ident" => 'WindDir', "type" => self::VT_Integer, "name" => 'Wind Direction', "profile" => 'WindDirection.Text', "pos" => 4),
        "Rain" => array("ident" => "Rain", "type" => self::VT_Float, "name" => 'Rain', "profile" => 'Rainfall', "pos" => 6),
        "RainCounter" => array("ident" => "RainCounter", "type" => self::VT_Integer, "name" => 'Rain Counter', "profile" => '', "pos" => 7),
        "IsRaining" => array("ident" => "IsRaining", "type" => self::VT_Boolean, "name" => 'Raining', "profile" => 'Raining', "pos" => 8),
        "Forecast" => array("ident" => "Forecast", "type" => self::VT_Integer, "name" => 'Forecast', "profile" => '', "pos" => 9),
        "Battery" => array("ident" => "Battery", "type" => self::VT_Boolean, "name" => 'Battery', "profile" => 'Battery.Reversed', "pos" => 10),
        "Lost" => array("ident" => "Lost", "type" => self::VT_Integer, "name" => 'Lost Records', "profile" => '', "pos" => 11),
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
        $json=__DIR__."/module.json";
        parent::__construct($InstanceID,$json);
    }

    //------------------------------------------------------------------------------
    /**
     * overload internal IPS_Create($id) function
     */
    public function Create()
    {
        // Diese Zeile nicht löschen.
        parent::Create();
        //Hint: $this->debug will not work in this stage! must use IPS_LogMessage
        
        // register property
        $this->RegisterPropertyString('DeviceID', '');
        $this->RegisterPropertyString('Typ', '');
        $this->RegisterPropertyString('Class', '');
        $this->RegisterPropertyString('CapList', '');
        $this->RegisterPropertyBoolean('Debug', false);

        $this->CreateStatusVars();
        

    }

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
            }else{
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
        }else{
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
                if ($target == $this->module_interfaces['WS-RX']) {
                    if (isset($data['WSData']) && isset($data['DeviceID'])) {
                        $Device = $data['DeviceID'];
                        $typ = $data['Typ'];
                        $class = $data['Class'];
                        //call data point
                        $myID = $this->GetDeviceID();
                        $myType = $this->GetType();
                        $myClass = $this->GetClass();
                        if (($myID == $Device) && ($myType == $typ) && ($myClass = $class)) {
                            $this->debug(__FUNCTION__, "$Device(Typ:$typ,Class:$class)");
                            $ws_data = $data['WSData'];
                            if (is_object($ws_data)) $ws_data = get_object_vars($ws_data);
                            $this->ParseData($ws_data);
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
    //---------public functions
    //------------------------------------------------------------------------------
    

    //------------------------------------------------------------------------------
    //---------internal functions
    //------------------------------------------------------------------------------
    
    /**
     * parsing incoming data along capabilities
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
                continue;
            }
            if (!isset($data[$cap])) continue;
            $s = $data[$cap];
            switch ($cap) {
                //Integer
                case 'Hum'://hum
                case 'WindDir'://wind
                case 'RainCounter'://raincounter
                case 'Press'://pressure
                case 'Forecast'://willi
                case 'Lost'://lost
                    $iv = (int)$s;
                    SetValueInteger($vid, $iv);
                    break;
                //float
                case 'Temp'://temp
                case 'Wind'://wind
                case 'Rain'://rain
                    $fv = (float)$s;
                    SetValueFloat($vid, $fv);
                    break;
                //String
                case 'Name'://
                    $st = utf8_decode($s);
                    SetValueString($vid, $st);
                    break;
                case 'IsRaining'://israining
                    if ($s == 'YES') {
                        SetValueBoolean($vid, true);
                        $s = "Its Raining";
                    } else {
                        SetValueBoolean($vid, false);
                        $s = "$cap($vid): No Rain";
                    }
                    break;
                //special
                case 'Battery'://battery
                    if ($s == 'LOW') {
                        SetValueBoolean($vid, false);
                    } else {
                        SetValueBoolean($vid, true);
                    }
                    break;


                default:
                    $this->debug(__FUNCTION__, "$cap not handled");
            }
            $this->debug(__FUNCTION__, "$cap:($vid)" . $s);
        }
    }
    
}
