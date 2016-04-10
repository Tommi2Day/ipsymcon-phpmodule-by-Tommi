<?php
/**
 * @file
 *
 * generic Weather Station Sensor PHP Device Module Class
 *
 * @author Thomas Dressler
 * @copyright Thomas Dressler 2009-2016
 * @version 1.7
 * @date 2016-04-10
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
        "WindChill" => array("ident" => 'WindChill', "type" => self::VT_Float, "name" => 'Wind Chill', "profile" => 'Temperature', "pos" => 0),
        "Hum" => array("ident" => 'Humidity', "type" => self::VT_Integer, "name" => 'Feuchte', "profile" => 'Humidity', "pos" => 1),
        "Press" => array("ident" => 'Pressure', "type" => self::VT_Integer, "name" => 'Pressure', "profile" => 'AirPressure', "pos" => 2),
        "Wind" => array("ident" => 'Windspeed', "type" => self::VT_Float, "name" => 'Wind Speed', "profile" => 'WindSpeed.kmh', "pos" => 3),
        "WindGust" => array("ident" => 'WindGust', "type" => self::VT_Float, "name" => 'Wind Gust', "profile" => 'WindSpeed.kmh', "pos" => 3),
        "WindDir" => array("ident" => 'WindDir', "type" => self::VT_Integer, "name" => 'Wind Direction', "profile" => 'WindDirection.Text', "pos" => 4),
        "Storm" => array("ident" => "Storm", "type" => self::VT_Boolean, "name" => 'Storm Indicator', "profile" => '', "pos" => 5), //reversed state
        "Rain" => array("ident" => "Rain", "type" => self::VT_Float, "name" => 'Rain', "profile" => 'Rainfall', "pos" => 6),
        "RainDaily" => array("ident" => "RainDaily", "type" => self::VT_Float, "name" => 'Rain Daily', "profile" => 'Rainfall', "pos" => 6),
        "RainCounter" => array("ident" => "RainCounter", "type" => self::VT_Integer, "name" => 'Rain Counter', "profile" => '', "pos" => 7,"hidden" => true),
        "IsRaining" => array("ident" => "IsRaining", "type" => self::VT_Boolean, "name" => 'Raining', "profile" => 'Raining', "pos" => 8),
        "Forecast" => array("ident" => "Forecast", "type" => self::VT_Integer, "name" => 'Forecast', "profile" => '', "pos" => 9),
        "Battery" => array("ident" => "Battery", "type" => self::VT_Boolean, "name" => 'Battery', "profile" => 'Battery.Reversed', "pos" => 10,"hidden" => true),
        "Lost" => array("ident" => "Lost", "type" => self::VT_Integer, "name" => 'Lost Records', "profile" => 'Signal', "pos" => 11,"hidden" => true),
        "UV" => array("ident" => "UV", "type" => self::VT_Integer, "name" => 'UV Index', "profile" => 'UVIndex', "pos" => 12),
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

        //nonstandard profile
        $this->check_profile('Signal', 1, "", " dB", "Gauge", -120, +10, 1, 0, false);
        
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
                case 'UV'; //UVIndex
                case 'TS'; //TimeStamp
                case 'Lost'://lost
                case 'Signal':
                    $iv = (int)$s;
                    SetValueInteger($vid, $iv);
                    break;
                //float
                case 'Temp'://temp
                case 'Wind'://wind
                case 'WindChill'://wind
                case 'WindGust'://wind
                case 'Rain'://rain
                case 'RainDaily'://rain
                    $fv = (float)$s;
                    SetValueFloat($vid, $fv);
                    break;
                //String
                case 'Name'://
                    $st = utf8_decode($s);
                    SetValueString($vid, $st);
                    break;

                //special
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
                case 'Storm'://israining
                    if ($s == 'YES') {
                        //is reversed
                        SetValueBoolean($vid, false);
                        $s = "Its Storm";
                    } else {
                        SetValueBoolean($vid, true);
                        $s = "OK";
                    }
                    break;
                case 'Battery'://battery
                    $state=(!preg_match("/LOW|WARN/i",$s)); //reversed
                    SetValueBoolean($vid, $state);
                    break;


                default:
                    $this->debug(__FUNCTION__, "$cap not handled");
            }
            $this->debug(__FUNCTION__, "$cap:($vid)" . $s);
        }
    }
    
}
