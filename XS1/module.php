<?
/**
 * @file
 *
 * Ezcontrol XS1 IPSymcon PHP Splitter Module Class
 *
 * @author Thomas Dressler
 * @copyright Thomas Dressler 2012-2016
 * @version 4.1.2
 * @date 2016-10-23
 */

include_once(__DIR__ . "/../module_helper.php");
ini_set('max_execution_time',60);
/**
 * @class XS1
 *
 *  Ezcontrol XS1 IPSymcon PHP Splitter Module Class
 * 
 */
class XS1 extends T2DModule
{
    //------------------------------------------------------------------------------
    //module const and vars
    //------------------------------------------------------------------------------

    /**
     * url for listing (without host)
     */
    const list_prefix = "/control?callback=list"; //api url

    /**
     * cmd to list sensors
     */
    const cmd_list_sensors="&cmd=get_list_sensors";

    /**
     * cmd to list actors
     */
    const cmd_list_actors="&cmd=get_list_actuators";

    /**
     * cmd to set actuator
     */
    const cmd_set_actor="&cmd=set_state_actuator";
    /**
     * cmd for retrieving xs1 config
     */
    const cmd_config = "&cmd=get_config_info"; //info

    /**
     * field used as identifier
     */
    const idcol='pos'; //other candidates are 'id' or 'name'

    
    private $sensor_typelist=array(
        #"Alarmmatte"=>array("typ"=>"SwitchDev","cap"=>"Alert"),
        #"Anwesenheit"=>array("typ"=>"SwitchDev","cap"=>"Lock"),
        #"Bewegung"=>array("typ"=>"SwitchDev","cap"=>"Alert"),
        #"Blattfeuchte"=>array("typ"=>"WSDEV","cap"=>"Hum"),
        #"Bodenfeuchte"=>array("typ"=>"WSDEV","cap"=>"Hum"),
        #"Bodentemperatur"=>array("typ"=>"WSDEV","cap"=>"Temp"),
        #"Briefmelder"=>array("typ"=>"SwitchDev","cap"=>"Lock"),
        "pwr_peak"=>array("typ"=>"EnergyDev","cap"=>"PPower"),
        "pwr_consump"=>array("typ"=>"EnergyDev","cap"=>"APower"),
        #"Fenstermelder"=>array("typ"=>"SwitchDev","caps"=>"Lock"),
        #"Gas Spitzenwert"=>array("typ"=>"EnergyDev","caps"=>"AGas"),
        #"Gasmelder Butan"=>array("typ"=>"SwitchDev","caps"=>"Alert"),
        #"Gasmelder CO"=>array("typ"=>"SwitchDev","caps"=>"Alert"),
        #"Gasmelder Methan"=>array("typ"=>"SwitchDev","caps"=>"Alert"),
        #"Gasmelder Propan"=>array("typ"=>"SwitchDev","caps"=>"Alert"),
        #"Gaszähler"=>array("typ"=>"EnergyDev","caps"=>"TGas"),
        #"Glasbruchmelder"=>array("typ"=>"SwitchDev","caps"=>"Alert"),
        "light"=>array("typ"=>"WSDEV","cap"=>"Light"),
        #"Hitzemelder"=>array("typ"=>"SwitchDev","cap"=>"Alert"),
        #"Lichtschranke"=>array("typ"=>"SwitchDev","cap"=>"Alert"),
        "barometer"=>array("typ"=>"WSDEV","cap"=>"Press"),
        "hygrometer"=>array("typ"=>"WSDEV","cap"=>"Hum"),
        #"Luftgüte"=>array("typ"=>"WSDEV","cap"=>"Quality"),
        #"Rauchmelder"=>array("typ"=>"SwitchDev","cap"=>"Alert"),
        "rain"=>array("typ"=>"WSDEV","cap"=>"IsRaining"),
        #"Regen 1h"=>array("typ"=>"WSDEV","cap"=>"RainHourly"),
        #"Regen 24h"=>array("typ"=>"WSDEV","cap"=>"RainDaily"),
        "rainintensity"=>array("typ"=>"WSDEV","cap"=>"RainHourly"),
        #"Sonneneinstrahlung"=>array("typ"=>"WSDEV","cap"=>"Licht"),
        "temperature"=>array("typ"=>"WSDEV","cap"=>"Temp"),
        #"Türklingel"=>array("typ"=>"SwitchDev","cap"=>"Alert"),
        "dooropen"=>array("typ"=>"SwitchDev","cap"=>"Lock"),
        #"UV Index"=>array("typ"=>"WSDEV","cap"=>"UV"),
        #"Wasser Spitzenwert"=>array("typ"=>"EnergyDev","cap"=>"AWasser"),
        "waterdetector"=>array("typ"=>"SwitchDev","cap"=>"Alert"),
        #"Wasserstand"=>array("typ"=>"WSDEV","cap"=>"Level"),
        #"Wasserzähler"=>array("typ"=>"EnergyDev","cap"=>"AWasser"),
        "windgust"=>array("typ"=>"WSDEV","cap"=>"WindGust"),
        "winddirection"=>array("typ"=>"WSDEV","cap"=>"WindDir"),
        "windspeed"=>array("typ"=>"WSDEV","cap"=>"Wind"),
        #"Windvarianz"=>array("typ"=>"WSDEV","cap"=>"Wind"),
        #"Zaunmelder"=>array("typ"=>"SwitchDev","cap"=>"Alert"),
        #"Zähler"=>array("typ"=>"EnergyDev","cap"=>"Counter"),
        #"Zählerdifferenz"=>array("typ"=>"EnergyDev","cap"=>"Counter"),
        );

    private $actors_typelist=array(
        "dimmer"=>array("typ"=>"SwitchDev","cap"=>"Dimmer"),
        #"Fenster"=>array("typ"=>"SwitchDev","cap"=>"Switch"),
        #"Jalousie"=>array("typ"=>"SwitchDev","cap"=>"Shutter"),
        #"Markise"=>array("typ"=>"SwitchDev","cap"=>"Shutter"),
        "shutter"=>array("typ"=>"SwitchDev","cap"=>"Shutter"),
        "switch"=>array("typ"=>"SwitchDev","cap"=>"Switch"),
        #"Temperatur"=>array("typ"=>"SwitchDev","cap"=>"Switch"),
        #"Ton"=>array("typ"=>"SwitchDev","cap"=>"Switch"),
        #"Tür"=>array("typ"=>"SwitchDev","cap"=>"Switch"),
        #"Zeitschalter"=>array("typ"=>"SwitchDev","cap"=>"Switch"),
    );

    //--------------------------------------------------------
    // main module functions
    //--------------------------------------------------------
    /**
     * Constructor
     * @param $InstanceID
     */
    public function __construct($InstanceID)
    {

        if (!function_exists('simplexml_load_string')) {
            IPS_LogMessage(__CLASS__, "Error: Need SimpleXML functions(simplexml_load_string)!\n");
            return false;
        }

        // Diese Zeile nicht löschen
        $json = __DIR__ . "/module.json";
        parent::__construct($InstanceID, $json);

        return true;
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
        $this->RegisterPropertyString('Category', 'XS1');
        $this->RegisterPropertyInteger('ParentCategory', 0); //parent cat is root
        $this->RegisterPropertyInteger('UpdateInterval', 600);
        $this->RegisterPropertyString('Host', 'xs1');
        $this->RegisterPropertyBoolean('AutoCreate', true);
        $this->RegisterPropertyBoolean('Debug', false);
        $this->RegisterPropertyBoolean('Active', false);

        //Vars
        $this->RegisterVariableInteger('LastUpdate', 'Last Update', "UnixTimestamp", -1);
        IPS_SetHidden($this->GetIDForIdent('LastUpdate'), true);
        //reinit timer
        $this->RegisterTimer('Update', 0, $this->module_data["prefix"] . '_UpdateEvent($_IPS[\'TARGET\']);');

        if (IPS_GetKernelRunlevel() == self::KR_READY) {
            if ($this->isActive()) {
                $this->SetStatus(self::ST_AKTIV);
                $i = $this->GetUpdateInterval();
                $this->SetTimerInterval('Update', ($i * 1000));//ms
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
     * overload internal IPS_ApplyChanges($id) function
     */
    public function ApplyChanges()
    {
        // Diese Zeile nicht loeschen
        parent::ApplyChanges();
        if ($this->isActive()) {
            $this->SetStatus(self::ST_AKTIV);
            $i = $this->GetUpdateInterval();
            $this->SetTimerInterval('Update', ($i * 1000));//ms
            $this->init();

        } else {
            $this->SetStatus(self::ST_INACTIV);
            $this->SetTimerInterval('Update', 0);
        }

    }

    //--------------------------------------------------------
    //Get/Set
    //--------------------------------------------------------
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
     * Get Property UpdateInterval
     * @return int
     */
    private function GetUpdateInterval()
    {
        return (Integer)IPS_GetProperty($this->InstanceID, 'UpdateInterval');
    }

    //--------------------------------------------------------
    /**
     * Get Property Host
     * @return String
     */
    private function GetHost()
    {
        return (String)IPS_GetProperty($this->InstanceID, 'Host');
    }


    //--------------------------------------------------------
    /**
     * Get URL to list actors
     * @return String
     */
    private function GetListActorsURL()
    {
        $host = $this->GetHost();
        $url = "http://" . $host . self::list_prefix.self::cmd_list_actors;
        return $url;
    }
    //--------------------------------------------------------
    /**
     * Get URL to list sensors
     * @return String
     */
    private function GetListSensorsURL()
    {
        $host = $this->GetHost();
        $url = "http://" . $host . self::list_prefix.self::cmd_list_sensors;
        return $url;
    }
    //--------------------------------------------------------
    /**
     * Get URL to set actors
     * @return String
     */
    private function GetSetActorURL()
    {
        $host = $this->GetHost();
        $url = "http://" . $host . self::list_prefix.self::cmd_set_actor;
        return $url;
    }
    //------------------------------------------------------------------------------
    //---Events
    //------------------------------------------------------------------------------
    /**
     * Timer Event to read current data record from AHA Device(e.g.Fritzbox)
     * discard output
     */
    public function UpdateEvent()
    {
        $this->debug(__FUNCTION__, 'UpdateEvent');
        $this->Query('Sensor',$this->GetListSensorsURL(),$this->sensor_typelist);
        $this->Query('Actor',$this->GetListActorsURL(),$this->actors_typelist);
    }
    //------------------------------------------------------------------------------
    //device functions
    //------------------------------------------------------------------------------

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
                        $this->debug(__FUNCTION__, 'Type:WS-TX:');
                        break;
                    case $this->module_interfaces['SWD-TX']:
                        $this->debug(__FUNCTION__, 'Type: SWD-TX');
                        if (isset($data['Cap']) && isset($data['Value']) && isset($data['Device'])) {
                            $cap = $data['Cap'];
                            $val = $data['Value'];
                            $dev = $data['Device'];
                            switch ($cap) {
                                case 'Switch':
                                    $this->SwitchMode($dev, $val);
                                    break;
                                case 'Dimmer':
                                case 'Timer':
                                case 'Shutter':
                                    $this->debug(__FUNCTION__, "SWD-TX: unimplemented cap '$cap'");
                                    break;
                                default:
                                    $this->debug(__FUNCTION__, "SWD-TX: invalid cap '$cap'");
                            }

                        } else {
                            $this->debug(__FUNCTION__, 'SWD-TX: invalid Data');
                        }


                        break;
                    case $this->module_interfaces['EN-TX']:
                        //$data=array();
                        $this->debug(__FUNCTION__, 'Type: EN-TX');
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
    //public functions
    //------------------------------------------------------------------------------
    /**
     * Send Switch command to Device
     * @param string $dev  Actor ID
     * @param int $val new actor value
     * @return bool
     */
    //query actual state
    public function SwitchMode(string $dev, int $val)
    {
        $this->debug(__FUNCTION__, "Actor $dev switch to $val");
        $state = $this->SwitchStatus($val);
        $url = $this->GetSetActorURL();

        $url .= '&number=' . $dev. '&value='.($state?100:0);
        $answer = chop(@file_get_contents($url));
        $this->debug(__FUNCTION__,"Answer:".$answer);
        $response = $http_response_header[0];
        if (!preg_match("/200\s+OK$/", $response)) {
            IPS_LogMessage(__CLASS__, __FUNCTION__ . "::Error: Request ($url) failed, Response: $response ");
            return false;
        }
        $json=preg_replace('/list\((\{.*\})\)/s','\1',$answer);
        $data = json_decode($json);
        if ($data->{'actuator'}->{'value'}==$val) {
            IPS_Logmessage(__CLASS__, "set XS1 Actor No.$dev to ".($val?'On':'Off').": Success");
        }else{
            IPS_Logmessage(__CLASS__, "set XS1 Actor No.$dev to ".($val?'On':'Off').": Failed");
            return false;
        }
        return true;
    }

    //------------------------------------------------------------------------------
    //internal functions
    //------------------------------------------------------------------------------

    //------------------------------------------------------------------------------
    /**
     * Query Sensors
     * @param $branch string
     * @param $url string
     * @param $map array
     */
    private function Query($branch,$url,$map)
    {
        $last_id = @$this->GetIDForIdent('LastUpdate');
        $max=0;
        if ($last_id) $max=GetValueInteger($last_id);


        $answer = chop(@file_get_contents($url));
        $response = $http_response_header[0];
        if ((preg_match("/200\s+OK$/", $response)) && (strlen($answer) > 0)) {
            $json=preg_replace('/list\((\{.*\})\)/s','\1',$answer);
            $data = json_decode($json);
            switch($branch) {
                case 'Sensor': $data=$data->{'sensor'};
                    break;
                case 'Actor': $data=$data->{'actuator'};
                    break;
            }

            if (!$data){
                IPS_LogMessage("XS1","no sensor data returned");
                return;
            }
            $n=0;
            foreach ($data as $dev) {
                $n++; //xs1 number parameter is serialno of sensor list
                $data=array();
                $caps='';
                $type=$dev->{'type'};
                if ($type == 'disabled') {
                    continue;
                }
                if (isset($map[$type])) {
                    $mod=$map[$type]['typ'];
                    $cap=$map[$type]['cap'];
                }else{
                    IPS_LogMessage(__CLASS__, __FUNCTION__ . "::$branch: Unsupported type $type");
                    continue;
                }
                $devname=$dev->{'name'};
                $val=$dev->{'value'};
                $unit=utf8_decode($dev->{'unit'});
                $utime=$dev->{'utime'};
                //id needs protocol V15+
                $id=isset($dev->{'id'})?$dev->{'id'}:$n;


                //get ips varids
                $data['Branch']=$branch;
                $data['Id']=$n;
                $data['Name']=utf8_encode($devname);
                $data['Typ']=$type;
                $data['TS']=$utime;
                $data[$cap]=$val;
                
                //actur functions
                if ($branch == "Actor") {
                    $fun='';
                    $fl=array();
                    $fl[$cap]=0;
                    if (isset($dev->{'function'})) {
                        $fun='Functions:';
                        foreach ($dev->{'function'} as $f) {
                            $ft=$f->{'type'};
                            switch ($ft) {

                                case 'off_wait_on':
                                case 'on_wait_off':
                                    //$fl["Timer"]=1; //timer not implemented yet
                                    break;
                                case 'on':
                                case 'off':
                                $fl["Switch"]=1;
                                    break;
                                case 'dimmer':
                                    //$fl["Dimmer"]=1; //dimmer not implemented yet
                                    break;
                                case 'long_on':
                                case 'long_off':
                                    //$fl["Shutter"]=1; //shutter not implemeted yet
                                    break;
                                case 'disabled':
                                    break;
                                default:
                                    $this->debug(__FUNCTION__ , "Unimplemented function '$ft''");
                            }
                            $fun.="$ft,";
                        }
                       
                        //collect caps
                        foreach($fl as $ft=>$val) {
                            $caps.="$ft";
                            if ($val==1) $caps.=':1';
                            $caps.=";";
                        }
                    }
                    $this->debug(__FUNCTION__ , "$branch: $n($id) Name: $devname, Type: $type, Val: $val, $fun");
                }elseif ($branch=="Sensor") {
                    $caps="$cap;TS";
                    $this->debug(__FUNCTION__ , "$branch: $n($id) Name: $devname, Type: $type, Val: $val, Unit: '$unit'");
                }

                $this->debug(__FUNCTION__,"$branch: $n Mod:$mod, Caps: $caps");
                switch($mod) {
                        case 'WSDEV':
                            $this->SendWSData($caps,$data);
                            break;
                        case 'EnergyDev':
                            $this->SendENData($caps,$data);
                            break;
                        case 'SwitchDev':
                            $this->SendSwitchData($caps,$data);
                            break;
                        default:
                            IPS_LogMessage(__CLASS__, __FUNCTION__ . "::$branch: Unsupported Mod '$mod''");
                }

                //store max timestamp value
                if ($utime>$max) {$max=$utime;}
            }//for
            //set max timestamp info
            SetValueInteger($last_id,$max);

        } else {
            IPS_LogMessage(__CLASS__, __FUNCTION__ . "::Error Answer calling $url");
        }


    }//function

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
        $branch=$data['Branch'];
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
                //$this->debug(__FUNCTION__, "Check my $branch Device '$Device'' with Instance $instID($iid)");
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
                $this->debug(__FUNCTION__, "Creating XS1 $branch WSDEV Device  " . $Device . ' disabled by Property AutoCreate');
                IPS_LogMessage($class, "Creating XS1 $branch WSDEV Device " . $Device . ' disabled by Property AutoCreate');
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
            $this->debug(__FUNCTION__, "Json:".$json);
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
        $name = $data['Name'];
        $branch=$data['Branch'];
        unset($data['Branch']);
        if (!$name) $name = "XS1 $branch $Device";
        $host = $this->GetHost();
        $class = __CLASS__ . "-WS";
        $ModuleID = $this->module_interfaces['WSDEV'];
        if (IPS_ModuleExists($ModuleID)) {
            //return $result;
            $this->debug(__FUNCTION__, "$branch $Device: $name");
            $instID = IPS_CreateInstance($ModuleID);
            if ($instID > 0) {
                IPS_ConnectInstance($instID, $this->InstanceID);  //Parents are ourself!
                IPS_SetProperty($instID, 'DeviceID', $Device);
                IPS_SetProperty($instID, 'Class', $class);
                IPS_SetProperty($instID, 'Typ', $typ);
                IPS_SetProperty($instID, 'CapList', $caps);
                IPS_SetProperty($instID, 'Debug', $this->isDebug()); //follow debug settings from splitter
                IPS_SetName($instID, "XS1 $branch '$name'");
                $ident = $class . "_".$branch."_$Device on $host";
                $ident = preg_replace("/\W/", "_", $ident);//nicht-Buchstaben/zahlen entfernen
                IPS_SetIdent($instID, $ident);
                IPS_ApplyChanges($instID);
                $cat = $this->GetCategory() . " $branch"."s";
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
     * Forward Switch data to SwitchDev instances
     * Create one if needed
     * @param $caps string
     * @param $data array
     */
    private function SendSwitchData($caps, $data)
    {
        $this->debug(__FUNCTION__, 'Prepare');
        $datum = date('Y-m-d H:i:s', time());
        $data['Date'] = $datum;
        $Device = $data['Id'];
        $typ = $data['Typ'];
        $class = __CLASS__ . "-SW";
        $branch=$data['Branch'];
        $found = false;
        $instID = 0;
        $instances = IPS_GetInstanceListByModuleID($this->module_interfaces['SwitchDev']);
        foreach ($instances as $instID) {
            $I = IPS_GetInstance($instID);
            $iid = (String)IPS_GetProperty($instID, 'DeviceID');
            $ityp = (String)IPS_GetProperty($instID, 'Typ');
            $iclass = (String)IPS_GetProperty($instID, 'Class');
            //$this->debug(__FUNCTION__, "Check my $branch Device '$Device'' with Instance $instID($iid)");
            if ($I['ConnectionID'] == $this->InstanceID) { //my child
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
                $this->debug(__FUNCTION__, "CREATE NEW Switch Device " . $Device);
                $instID = $this->CreateSwitchDevice($data, $caps);
                $found = true;
            } else {
                $this->debug(__FUNCTION__, "Creating XS1 $branch Switch Device " . $Device . ' disabled by Property AutoCreate');
                IPS_LogMessage($class, "Creating XS1 $branch Switch Device " . $Device . ' disabled by Property AutoCreate');
            }//if autocreate
        }//if found

        if ($found && ($instID > 0)) {
            //send record to children
            $json = json_encode(
                array("DataID" => $this->module_interfaces['SWD-RX'],
                    "DeviceID" => $Device,
                    "Typ" => $typ,
                    "Class" => $class,
                    "SWData" => $data,
                )
            );

            $this->debug(__FUNCTION__, "Json:".$json);
            @$this->SendDataToChildren($json);

        }//found
    }//function

    //--------------------------------------------------------
    /**
     * Create a new SwitchDev instance and set its properties
     * @param array $data parsed record
     * @param String $caps String semicolon seperated capabilities of this device
     * @return int new Instance ID
     */
    private function CreateSwitchDevice($data, $caps)
    {
        $instID = 0;
        $Device = $data['Id'];
        $typ = $data['Typ'];
        $name = $data['Name'];
        $branch=$data['Branch'];
        unset($data['Branch']);
        if (!$name) $name = "XS1 $branch $Device";
        //$host = $this->GetHost();
        $class = __CLASS__ . "-SW";
        $ModuleID = $this->module_interfaces['SwitchDev'];
        if (IPS_ModuleExists($ModuleID)) {
            //return $result;
            $this->debug(__FUNCTION__, 'Device:' . $Device);
            $instID = IPS_CreateInstance($ModuleID);
            if ($instID > 0) {
                IPS_SetProperty($instID, 'DeviceID', $Device);
                IPS_SetProperty($instID, 'Class', $class);
                IPS_SetProperty($instID, 'Typ', $typ);
                IPS_SetProperty($instID, 'CapList', $caps);
                IPS_SetProperty($instID, 'Debug', $this->isDebug()); //follow debug settings from splitter
                IPS_SetName($instID, "XS1 $branch '$name'");
                $ident = $class . "_".$branch."_$Device";
                $ident = preg_replace("/\W/", "_", $ident);//nicht-Buchstaben/zahlen entfernen
                IPS_SetIdent($instID, $ident);
                IPS_ConnectInstance($instID, $this->InstanceID);
                IPS_ApplyChanges($instID);

                //set category
                $cat = $this->GetCategory() . " $branch"."s";
                $pcat = $this->GetParentCategory();
                $ident = preg_replace("/\W/", "_", $cat);//fix naming
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
     * Forward Energy data to EnergyDev instances
     * Create one if needed
     * @param $caps string
     * @param $data array
     */
    private function SendENData($caps, $data)
    {
        $this->debug(__FUNCTION__, 'Prepare');
        $datum = date('Y-m-d H:i:s', time());
        $data['Date'] = $datum;
        $Device = $data['Id'];
        $typ = $data['Typ'];
        $branch=$data['Branch'];
        $found = false;
        $instID = 0;
        $class = __CLASS__ . "-EN";
        $instances = IPS_GetInstanceListByModuleID($this->module_interfaces['EnergyDev']);
        foreach ($instances as $instID) {
            $I = IPS_GetInstance($instID);
            $iid = (String)IPS_GetProperty($instID, 'DeviceID');
            $ityp = (String)IPS_GetProperty($instID, 'Typ');
            $iclass = (String)IPS_GetProperty($instID, 'Class');
            //$this->debug(__FUNCTION__, "Check my Device '$Device'' with Instance $instID($iid)");
            if ($I['ConnectionID'] == $this->InstanceID) { //my child
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
                $this->debug(__FUNCTION__, 'CREATE NEW Energy Device ' . $Device);
                $instID = $this->CreateEnergyDevice($data, $caps);
                $found = true;
            } else {
                $this->debug(__FUNCTION__, "Creating XS1 $branch Energy Device " . $Device . ' disabled by Property AutoCreate');
                IPS_LogMessage(__CLASS__, "Creating XS1 $branch Energy Device " . $Device . ' disabled by Property AutoCreate');
            }//if autocreate
        }//if found

        if ($found && ($instID > 0)) {
            //send record to children
            $json = json_encode(
                array("DataID" => $this->module_interfaces['EN-RX'],
                    "DeviceID" => $Device,
                    "Typ" => $typ,
                    "Class" => $class,
                    "ENData" => $data,
                )
            );
            
            $this->debug(__FUNCTION__, "Json:".$json);
            @$this->SendDataToChildren($json);

        }//found
    }//function

    //--------------------------------------------------------
    /**
     * Create a new EnergyDev instance and set its properties
     * @param array $data parsed record
     * @param String $caps String semicolon seperated capabilities of this device
     * @return int new Instance ID
     */
    private function CreateEnergyDevice($data, $caps)
    {
        $instID = 0;
        $Device = $data['Id'];
        $typ = $data['Typ'];
        $name = $data['Name'];
        $branch=$data['Branch'];
        unset($data['Branch']);
        if (!$name) $name = "XS1 $branch $Device";
        $class = __CLASS__ . "-EN";
        //$host = $this->GetHost();
        $ModuleID = $this->module_interfaces['EnergyDev'];
        if (IPS_ModuleExists($ModuleID)) {
            //return $result;
            $this->debug(__FUNCTION__, 'Device:' . $Device);
            $instID = IPS_CreateInstance($ModuleID);
            if ($instID > 0) {
                IPS_SetProperty($instID, 'DeviceID', $Device);
                IPS_SetProperty($instID, 'Class', $class);
                IPS_SetProperty($instID, 'Typ', $typ);
                IPS_SetProperty($instID, 'CapList', $caps);
                IPS_SetProperty($instID, 'Debug', $this->isDebug()); //follow debug settings from splitter
                IPS_SetName($instID, "XS1 $branch '$name'");
                $ident = $class . "_".$branch."_$Device";
                $ident = preg_replace("/\W/", "_", $ident);//nicht-Buchstaben/zahlen entfernen
                IPS_SetIdent($instID, $ident);
                IPS_ConnectInstance($instID, $this->InstanceID);
                IPS_ApplyChanges($instID);

                //set category
                $cat = $this->GetCategory() . " $branch"."s";
                $pcat = $this->GetParentCategory();
                $ident = preg_replace("/\W/", "_", $cat);//fix naming
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
    }

}//class
