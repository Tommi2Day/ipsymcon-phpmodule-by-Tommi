<?
/**
 * @file
 *
 * TE923 Gateway IPSymcon PHP Splitter Module Class
 *
 * @author Thomas Dressler
 * @copyright Thomas Dressler 2009-2016
 * @version 1.2
 * @date 2016-05-29
 */

include_once(__DIR__ . "/../module_helper.php");

/** @class TE923
 *
 * TE923 Gateway IPSymcon PHP Splitter Module Class
 *
 *
 *  TE923 based weather stations (TFA Nexus,Ventus 831, Mebus 923 etc) using TE923con output
 *  This requires a running webservice providing output from te923con binary.
 *
 */
class TE923 extends T2DModule
{
    //------------------------------------------------------------------------------
    //module const and vars
    //------------------------------------------------------------------------------
    /**
     * How many sensors are attached
     * 5 external Temp/Hum Sensors(1-5), Rain, Wind and Indoor Sensor
     */
    const MAXSENSORS = 6; //5external, 1 indoor


    /**
     * default rain constant *1000
     */
    const rc_to_mm = 708; //according http://www.mrbalky.com/tag/te923/ 0.708

    /**
     * factor to convert m/sec to kmh
     */
    const ms_to_kmh = 3.6;

    /**
     * List of possible Sensors
     */
    private $sensors=array("0","1","2","3","4","5",'Wind','Rain','UV','Indoor');

    /**
     * Fieldlist for Logging
     */
    private  $fieldlist = array("Date","Typ","Id","Temp","Hum","Battery","Press","Forecast","Wind","WindDir","WindGust","WindChill","Storm","Rain","RainCounter","RainDaily","RainLastDay");


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
        $this->RegisterPropertyString('Category', 'TE923 Devices');
        $this->RegisterPropertyInteger('ParentCategory', 0); //parent cat is root
        $this->RegisterPropertyInteger('RainPerCount', self::rc_to_mm);
        $this->RegisterPropertyInteger('UpdateInterval', 600);
        $this->RegisterPropertyString('URL', 'http://raspberry/cgi-bin/get_data.cgi');
        $this->RegisterPropertyString('LogFile', '');
        $this->RegisterPropertyBoolean('AutoCreate', true);
        $this->RegisterPropertyBoolean('Debug', false);
        $this->RegisterPropertyBoolean('Active', false);

        //Vars
        $this->RegisterVariableInteger('NewDayRainCounter', 'Rain Counter at new Day', "",-1);
        $this->RegisterVariableInteger('LastRainCounter', 'Last Rain Counter', "",-2);
        $this->RegisterVariableInteger( 'TimeStamp','Device Timestamp','UnixTimestamp', -3);
        IPS_SetHidden($this->GetIDForIdent('LastRainCounter'), true);
        IPS_SetHidden($this->GetIDForIdent('NewDayRainCounter'), true);


        //reinit timer
        $this->RegisterTimer('Update', 0, $this->module_data["prefix"] . '_UpdateEvent($_IPS[\'TARGET\']);');

        if (!IPS_VariableProfileExists('TE923_Storm')) {
            IPS_CreateVariableProfile('TE923_Storm', 0); //boolean
            IPS_SetVariableProfileValues('TE923_Storm', 0, 1, 0);
            //status is inverted because a 0 value is every time marked red, regardless of color
            IPS_SetVariableProfileAssociation('TE923_Storm', 1, "Not this", "Ok", -1);
            IPS_SetVariableProfileAssociation('TE923_Storm', 0, "Save your dog", "Warning", 16711680);
            IPS_SetVariableProfileIcon('TE923_Storm', "Warning");
        }
        //Forecast
        $forecast = array(
            0 => array('Heavy Snow', 'Snowflake'),
            1 => array('Little Snow', 'Snowflake'),
            2 => array('Heavy Rain', 'Rainfall'),
            3 => array('Little Rain', 'Drops'),
            4 => array('Cloudy', 'Cloud'),
            5 => array('some Clouds', 'Cloud'),
            6 => array('Sunny', 'Sun')
        );
        if (!IPS_VariableProfileExists('TE923_Forecast')) {
            IPS_CreateVariableProfile('TE923_Forecast', 1); //integer
            IPS_SetVariableProfileValues('TE923_Forecast', 0, 6, 0);
            for ($i = 0; $i < 7; $i++) {
                IPS_SetVariableProfileAssociation('TE923_Forecast', $i, $forecast[$i][0], $forecast[$i][1], -1);
            }
        }


        if (IPS_GetKernelRunlevel() == self::KR_READY) {
            if ($this->isActive()) {
                $this->SetStatus(self::ST_AKTIV);
                $i = $this->GetUpdateInterval();
                $this->SetTimerInterval('Update', ($i * 1000));//ms
                $this->debug(__FUNCTION__,"Starte Timer $i sec");

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
        if ($this->isActive())  {
            $this->SetStatus(self::ST_AKTIV);
            $i = $this->GetUpdateInterval();
            $this->SetTimerInterval('Update', ($i * 1000));//ms
            $this->debug(__FUNCTION__,"Starte Timer $i sec");

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

    //--------------------------------------------------------
    /**
     * Get Property Host
     * @return String
     */
    private function GetURL()
    {
        return (String)IPS_GetProperty($this->InstanceID, 'URL');
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
     * Get Property RainPerCount
     * @return int
     */
    private function GetRainPerCount()
    {
        return (Integer)IPS_GetProperty($this->InstanceID, 'RainPerCount');
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
        //delay random time to prevent timer clash
        $delay=rand(500,5000);
        IPS_Sleep($delay);
        $this->Query();
    }
    //------------------------------------------------------------------------------
    //device functions
    //------------------------------------------------------------------------------

    //------------------------------------------------------------------------------
    //Data Interfaces
    //------------------------------------------------------------------------------
    /**
     * Data Interface from Childs
     * @param $JSONString
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
     * @param $Data
     */
    public function SendDataToChildren($Data)
    {
        parent::SendDataToChildren($Data);
    }



    //------------------------------------------------------------------------------
    //public functions
    //------------------------------------------------------------------------------

    /**
     * Query webservice running te923con
     *
     */
    public function Query()
    {

        $url = $this->GetURL();
        $dataurl = $url . '?data';
        $data = @file_get_contents($dataurl);
        $this->debug(__FUNCTION__,"Query $dataurl");
        if (isset($http_response_header[0])) {
            $response = $http_response_header[0];
        } else {
            $response = error_get_last()['message'];
        }
        if ((preg_match("/200\s+OK$/", $response)) && (strlen($data) > 0)) {
            $this->SetStatus(self::ST_AKTIV);
            $this->debug(__FUNCTION__,"Data:".$data);
            $statusurl = $url . '?status';
            $this->debug(__FUNCTION__,"Query $statusurl");
            $status = @file_get_contents($statusurl);
            $this->debug(__FUNCTION__,"Status:".$status);
            $te_data=$this->Parse(rtrim($data), rtrim($status));
            if (count($te_data)>0) {
                $this->SendWSData($te_data);
            }

        } else {
            IPS_LogMessage(__CLASS__, __FUNCTION__ . "::Error: GetData with $url failed, Response: $response, Data:$data");
            $this->SetStatus(self::ST_ERROR);
        }


    }
    //------------------------------------------------------------------------------
    //internal functions
    //------------------------------------------------------------------------------

    //------------------------------------------------------------------------------
    /**
     * parses an record string
     * 
     * @param $data string
     * @param $status string
     * @return array
     */
    private function Parse($data, $status)
    {
        /**
         * @par Status
         * @code
         * #----Status (te923con -s -i '')
         * 0x29 :0x17 :0x14 :0x10 :0x26 :1   :1   :1   :1   :1   :1   :1   :1
         * SYSSW:BARSW:EXTSW:RCCSW:WINSW:BATR:BATU:BATW:BAT5:BAT4:BAT5:BAT2:BAT1
         * @endcode
         * - SYSSW  - software version of system controller
         * - BARSW  - software version of barometer
         * - EXTSW  - software version of UV and channel controller
         * - RCCSW  - software version of rain controller
         * - WINSW  - software version of wind controller
         * - BATR   - battery of rain sensor (1-good (not present), 0-low)
         * - BATU   - battery of UV sensor (1-good (not present), 0-low)
         * - BATW   - battery of wind sensor (1-good (not present), 0-low)
         * - BAT5   - battery of sensor 5 (1-good (not present), 0-low)
         * - BAT4   - battery of sensor 4 (1-good (not present), 0-low)
         * - BAT3   - battery of sensor 3 (1-good (not present), 0-low)
         * - BAT2   - battery of sensor 2 (1-good (not present), 0-low)
         * - BAT1   - battery of sensor 1 (1-good (not present), 0-low)
         *
         * @par Data
         * @code
         * #------Data (te923con -i 'i')
         *
         * 1356207784:22.95:41:7.70:91:8.00:83:i :i :i :i :i :i :1001.9:i :3 :0    :9 :0.1:0.0:7.2:356
         * T0   :H0:T1  :H1:T2  :H2:T3:H3:T4:H4:T5:H5:PRESS :UV:FC:STORM:WD:WS :WG :WC :RC
         * @endcode
         * -  T0    - temperature from internal sensor in °C
         * -  H0    - humidity from internal sensor in % rel
         * -  T1..5 - temperature from external sensor 1..4 in °C
         * -  H1..5 - humidity from external sensor 1...4 in % rel
         * -  PRESS - air pressure in mBar
         * -  UV    - UV index from UV sensor
         * -  FC    - station forecast, see below for more details
         * -  STORM - stormwarning; 0 - no warning, 1 - fix your dog
         * -  WD    - wind direction in n x 22.5°; 0 -> north
         * -  WS    - wind speed in m/s
         * -  WG    - wind gust speed in m/s
         * -  WC    - windchill temperature in °C
         * -  RC    - rain counter (maybe since station starts measurement) as value
         *
         *
         * weather forecast means (as precisely as possible)
         * - 0 - heavy snow
         * - 1 - little snow
         * - 2 - heavy rain
         * - 3 - little rain
         * - 4 - cloudy
         * - 5 - some clouds
         * - 6 - sunny
         */

        $te_data = array();
        $status = explode(":", $status);
        $data = explode(":", $data);
        $cdata=count($data);
        $cstatus=count($status);
        $this->debug(__FUNCTION__, "Entered: Data:$cdata,Status: $cstatus");
        //if (($cdata == 22) && ($cstatus == 13)) {
            $date = $data[0];
            $tsid= @$this->GetIDForIdent('TimeStamp');
            if ($tsid>0 ) SetValueInteger($tsid, $date);
            $te_data['date'] = $date;

            //Indoor and Sensor1-5 T/H
            for ($s = 0; $s < self::MAXSENSORS; $s++) {
                $f=($s * 2) + 1;
                if (trim($data[$f])=='i') continue;
                $te_data[$s]['Id']="$s";
                $te_data[$s]['Temp'] = (float)$data[$f];
                if ($s > 0) {
                    $batf = 13 - $s;
                    if (isset($status[$batf])) {
                        $stat = ($status[$batf] == '0')?'LOW':'OK';
                        $te_data[$s]['Battery'] = $stat;
                    }
                }
                if (trim($data[$f+1])!='i') $te_data[$s]['Hum'] = (Integer)$data[$f+1]; //todo
                $te_data[$s]['Typ']='T/F';
                if ($s==0) {
                    $te_data[$s]['Typ']='Indoor';
                } else {
                    if (!isset($te_data[$s]['Hum'])) $te_data[$s]['Typ']='T';
                }
            }

            //indoor specioa
            if (trim($data[13])!='i') $te_data[0]['Press'] = (int)$data[13];
            if (trim($data[15])!='i') $te_data[0]['Forecast'] = (int)$data[15];
            //uv
            if (trim($data[14])!='i') {
                $te_data['UV']['UV'] = $data[14];
                $te_data['UV']['Bat'] = $status[6];
            }

            //wind

            if (trim($data[18])!='i') {
                $te_data['Wind']['Wind'] = $data[18] * self::ms_to_kmh;
                $te_data['Wind']['Storm'] = ($data[16]!=0)?'YES':'No';
                $te_data['Wind']['WindDir'] = $data[17] * 22.5;
                $te_data['Wind']['WindGust'] = $data[19] * self::ms_to_kmh;
                $te_data['Wind']['WindChill'] = (float)$data[20];
                $te_data['Wind']['Bat'] = $status[7];
            }

            //rain
            if (trim($data[21])!='i') {
                $new=(int)$data[21];
                $factor=$this->GetRainPerCount()/1000;
                $rcid = @$this->GetIDForIdent('LastRainCounter');
                $dailyid = @$this->GetIDForIdent('NewDayRainCounter');

                $old = GetValueInteger($rcid);
                $daily = GetValueInteger($dailyid);
                $diff = $new - $old;
                $dailydiff=$new-$daily;

                $rain = $diff * $factor;
                $raindaily = $dailydiff * $factor;

                $te_data['Rain']['RainLastDay']='';
                $dailyvar=IPS_GetVariable($dailyid);
                $dailyupdated=$dailyvar['VariableUpdated'];
                if (is_new_day($dailyupdated)) {
                    //set last day sum
                    SetValueInteger($dailyid, $old);
                    //calculate rain last day
                    $lastday=($old-$daily)*$factor;
                    if (($lastday < 0) or ($lastday > 500)) $lastday = 0;
                    $te_data['Rain']['RainLastDay']=$lastday;
                    $this->debug(__FUNCTION__,"::NewDay, Store old Counter($old) and Daily($lastday)");
                }
                if ($new>$old) SetValueInteger($rcid,$new);
                if (($rain < 0) or ($rain > 100)) $rain = 0;
                $te_data['Rain']['Rain'] = $rain;
                if (($raindaily < 0) or ($raindaily > 500)) $raindaily = 0;
                $te_data['Rain']['RainDaily'] = $raindaily;
                $te_data['Rain']['Bat'] = $status[5];
            }
            //fill standard fields
            foreach (array('Wind','Rain','UV','Indoor') as $dev) {
                if (isset($te_data[$dev])) {
                    $te_data[$dev]['Typ']=$dev. "Sensor";
                    $te_data[$dev]['Id']=$dev;
                    if (isset($te_data[$dev]['Bat'])) {
                        $stat = (trim($te_data[$dev]['Bat']) == '0')?'LOW':'OK';
                        $te_data[$dev]['Battery'] = $stat;
                        unset ($te_data[$dev]['Bat']);
                    }
                }
            }

            $this->debug(__FUNCTION__, 'OK');
        /*
        } else {
            $this->debug(__FUNCTION__, "Field Error (22 data and 14 status fields expected");
        }
        */
        $this->debug(__FUNCTION__, " Parsed Data:" . print_r($te_data, true));
        if (count($te_data)==0) {

            IPS_LogMessage(__CLASS__, __FUNCTION__ . " Error: Parsing returned no data");
        }
        return $te_data;
    }//function


    //------------------------------------------------------------------------------
    /**
     * Forward weather data to WSDev instances
     * Create one if needed
     * @param $weather_data
     */
    private function SendWSData($weather_data)
    {
        //parsing was OK, start distributing
        $this->debug(__FUNCTION__, 'Prepare');
        $class=__CLASS__;
        $ts = $weather_data['date'];
        $datum = date('Y-m-d H:i:s', $ts);
        foreach ($this->sensors as $Device) {
            if (!isset($weather_data[$Device])) continue;
            $data=array();
            $caps='';
            $id = $weather_data[$Device]['Id']; 
            $typ = $weather_data[$Device]['Typ'];
            $data['Date']=$datum;

            foreach ($this->fieldlist as $cap) {
                if (isset($weather_data[$Device][$cap])) {
                    $data[$cap]=$weather_data[$Device][$cap];
                    $caps.=";".$cap;
                }
            }
            
            $this->debug(__FUNCTION__, "Sensor: $id Caps: $caps Prepared Data:" . print_r($data, true));
            $found = false;
            $instID = 0;
            $instances = IPS_GetInstanceListByModuleID($this->module_interfaces['WSDEV']);
            foreach ($instances as $instID) {
                $I = @IPS_GetInstance($instID);
                if ($I && ($I['ConnectionID'] == $this->InstanceID)) { //my child
                    $iid = (String)IPS_GetProperty($instID, 'DeviceID');
                    $ityp = (String)IPS_GetProperty($instID, 'Typ');
                    $iclass = (String)IPS_GetProperty($instID, 'Class');
                    if (($iid == $Device) && ($ityp == $typ) && ($iclass == $class)) {
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
                        //new instance needed
                        $this->debug(__FUNCTION__, 'CREATE Device with Caps: ' . $caps);
                        $found = true;
                    }
                } else {
                    $this->debug(__FUNCTION__, 'Creating Device ID ' . $Device . ' disabled by Property AutoCreate');
                    IPS_LogMessage($class, 'Creating Device ID ' . $Device . ' disabled by Property AutoCreate');
                }//if autocreate
            }//if found
            if ($found && ($instID > 0)) {
                //send record to children
                $json = json_encode(
                    array("DataID" => $this->module_interfaces['WS-RX'],
                        "DeviceID" => $Device,
                        "Typ" => $typ,
                        "Class" => $class,
                        "WSData" => $data));
                $this->debug(__FUNCTION__, $json);
                @$this->SendDataToChildren($json);
                $this->log_weather($data);
            }//found
        }//for
        $this->debug(__FUNCTION__, 'Finished');
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
        $ModuleID = $this->module_interfaces['WSDEV'];
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
                switch ($Device) {
                    case "0": IPS_SetName($instID, 'Indoor Sensor');
                            break;
                    case "1" :
                    case "2" :
                    case "3" :
                    case "4" :
                    case "5" :
                        IPS_SetName($instID, 'Sensor ' . $Device);
                        break;
                    case 'Wind':
                        IPS_SetName($instID, 'Wind Sensor');
                        break;
                    case 'Rain':
                        IPS_SetName($instID, 'Rain Sensor');
                        break;
                    case 'UV':
                        IPS_SetName($instID, 'UV Sensor');
                        break;
                    default:
                        IPS_SetName($instID, "unknown Sensor('$Device')");
                        break;
                }//switch
                $ident = __CLASS__ . "_WS_$Device";
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

                //set TE923_Forecast profile for forecast
                $vid=@IPS_GetObjectIDByIdent('Forecast',$instID);
                if ($vid>0) IPS_SetVariableCustomProfile($vid, "TE923_Forecast");
                //set TE923_Storm profile for Storm
                $vid=@IPS_GetObjectIDByIdent('Storm',$instID);
                if ($vid>0) IPS_SetVariableCustomProfile($vid, "TE923_Storm");
                IPS_ApplyChanges($instID);
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
    private function log_weather($data)
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
        $header=implode(";",$this->fieldlist);
        if (!$exists) {
            fwrite($o, $header."\r\n");
        } //if exists

        $line='';
        for ($f=0;$f<count($this->fieldlist);$f++) {
            $field=$this->fieldlist[$f];
            if (isset($data[$field])) {
                $val=$data[$field];
                $line.=$val;
                //$this->debug(__FUNCTION__,"Field: $field, Val: $val");
            }
            $line.=";";
        }//for
        $line.="\r\n";
        fwrite($o,$line);
        fclose($o);
    }//function
}//class
