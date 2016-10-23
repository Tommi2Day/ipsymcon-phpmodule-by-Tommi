<?
/**
 * @file
 *
 * WS2500 Gateway IPSymcon PHP Splitter Module Class
 *
 * @author Thomas Dressler
 * @copyright Thomas Dressler 2009-2016
 * @version 4.1.0
 * @date 2016-05-08
 */

include_once(__DIR__ . "/../module_helper.php");

/** @class WS2500PC
 *
 * WS2500PC Gateway IPSymcon PHP Splitter Module Class
 *
 *  This requires a running webservice providing output from ws2500 binary.
 *
 *  @see http://userpages.uni-koblenz.de/~krienke/ftp/unix/ws2500/
 */
class WS2500PC extends T2DModule
{
    //------------------------------------------------------------------------------
    //module const and vars
    //------------------------------------------------------------------------------

    /**
     * Fieldlist for Logging
     */
    private  $fieldlist = array("Date","Typ","Id","Temp","Hum","Press","Wind","WindDir","Rain","RainCounter","RainDaily","Light");


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
        $this->RegisterPropertyString('Category', 'WS2500 Devices');
        $this->RegisterPropertyInteger('ParentCategory', 0); //parent cat is root
        $this->RegisterPropertyInteger('RainPerCount', 295);
        $this->RegisterPropertyInteger('UpdateInterval', 1800);
        $this->RegisterPropertyString('URL', 'http://raspberry/cgi-bin/get_ws2500_data.cgi');
        $this->RegisterPropertyString('LogFile', '');
        $this->RegisterPropertyBoolean('AutoCreate', true);
        $this->RegisterPropertyBoolean('Debug', false);
        $this->RegisterPropertyBoolean('Active', false);

        //Vars
        $this->RegisterVariableInteger('NewDayRainCounter', 'Rain Counter at new Day', "",-1);
        $this->RegisterVariableInteger('LastRainCounter', 'Last Rain Counter', "",-2);
        $this->RegisterVariableInteger( 'TimeStamp','Device Timestamp','UnixTimestamp', -3);
        $this->RegisterVariableInteger( 'Block','Block Number','', -1);
        IPS_SetHidden($this->GetIDForIdent('LastRainCounter'), true);
        IPS_SetHidden($this->GetIDForIdent('NewDayRainCounter'), true);


        //reinit timer
        $this->RegisterTimer('Update', 0, $this->module_data["prefix"] . '_UpdateEvent($_IPS[\'TARGET\']);');


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
     * Query get_ws2500_data.cgi running ws2500 binary
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
            $this->Parse($data);

        } else {
            $this->debug( __FUNCTION__ , "Error: GetData with $url failed, Response: $response, Data:$data");
            IPS_LogMessage(__CLASS__, __FUNCTION__ . "::Error: GetData with $url failed, Response: $response, Data:$data");
            $this->SetStatus(self::ST_ERROR);
        }


    }//function

    //------------------------------------------------------------------------------
    //internal functions
    //------------------------------------------------------------------------------

    //------------------------------------------------------------------------------
    /**
     * parses an record string
     * 
     * @param $txt string Output from ws2500 program
     * @return array
     */
    private function Parse($txt)
    {
        /*
 # Sensorname[-number] (drop outs): values of sensor
 ## Blocknumber: Block(1)
 ## Date: Cal(date), time(sec)
 ## Station: Id(1)
 ## THS(Temp/humidity): Temperatur(�C), Humidity(%), New(1)
 ## PS(Pressure): Pressure-relativ(hPa), New
 ## RS(Rain): Counter(1), OneCount(mm/1000), Rain(mm/1000), Tol(1), New(1)
 ## WS(Wind): Speed(Km/h), Direction(�), Variance(�), New(1)
 ## LS(Light): Light(lux), Factor(1), Flag(1), Duration(h), DeltaDuration(min), New(1)
 ## PYS(Pyranometer): Energy(W/m), Factor(1)
 #
 Blocknumber: 348
 Date: Sun May  8 06:56:17 2016, 1462690577
 Station: 1
 THS-1 (0): 24.9, 20, h
 THS-2 (1): 20.4, 44, 1
 THS-3 (0): 23.7, 21, 1
 THS-4 (0): 23.0, 31, 1
 THS-5 (0): 22.1, 32, 1
 THS-6 (0): 24.5, 28, 1
 THS-7 (1): 17.3, 45, 1
 THS-8 (1): 17.0, 51, 1
 THS-17 (0): 23.2, 32, 1
 PS     (0): 1009, 1
 LS    (0): 479, 100, 0, 52.27, -1, 1
  */

        
        $lines=explode("\n",$txt);
        if (count($lines)<4) {
            $this->debug(__FUNCTION__,'Not enough data');
            return;
        }

        foreach ($lines as $line) {
            if (!isset($line[0])) continue;
            if ($line[0]=='#') continue;
            if ($line[0]=='+') continue;
            $result=array();
            $datum=date('Y-m-d H:i:s');
            if (preg_match_all("/^([\w-]+).*?:\s+(.*)$/",$line,$result)) {
                $dev=$result[1][0];
                $typ=$dev;
                $id=0;
                $p=strpos($dev,'-');
                if ($p>0) {
                    $typ = substr($dev, 0, $p );
                    $id = substr($dev, $p+1);
                }
                $values=$result[2][0];
                //$values=str_replace(" ",'',$values);
                $data=array();
                $data['Id']=$dev;
                $caps='';
                switch($typ) {
                    case 'Date':
                        list($d,$ts)=explode(',',$values);
                        $tsid= @$this->GetIDForIdent('TimeStamp');
                        if ($tsid>0 ) {
                            $old=GetValueInteger($tsid);
                            if ($ts>$old) {
                                SetValueInteger($tsid, $ts);
                            }
                        }
                        $datum=date('Y-m-d H:i:s',$ts);;
                        $this->debug(__FUNCTION__,"Date: $d, TS $ts, Datum $datum");
                        break;
                    case 'Blocknumber':
                        $block=$values;
                        $blid= @$this->GetIDForIdent('Block');
                        if ($blid>0 ) {
                            $old=GetValueInteger($blid);
                            if ($block  !=$old) {
                                SetValueInteger($blid, $block);
                            }else{
                                $this->debug(__FUNCTION__,"BlockNumber ($block) is the same, skipping");
                                return;
                            }
                        }
                        $this->debug(__FUNCTION__,"Blocknumber: $block");
                        break;
                    case 'Station':
                        break;
                    case 'THS':
                        $values=str_replace(" ","",$values);
                        list($temp,$hum,$new)=explode(',',$values);
                        $new=trim($new);
                        if ($new <>'0') {
                            $data['Date']=$datum;
                            $data['Typ']='T/F';
                            $caps.='Temp;Hum;';
                            if ($id == 17) {
                                $data['Typ']='Indoor';
                                $data['Id']='Indoor';
                                $caps.='Press;';
                            }
                            $data['Temp']=$temp;
                            $data['Hum']=$hum;
                            $this->debug(__FUNCTION__,"$dev: Temp:$temp, Hum:$hum");
                            $this->SendWSData($data,$caps);
                        }
                        break;
                    case 'RS':
                        $values=str_replace(" ","",$values);
                        list($rc,$cf,$rain,$tol,$new)=explode(',',$values);
                        if ($new==1) {
                            $rcid = @$this->GetIDForIdent('LastRainCounter');
                            $dailyid = @$this->GetIDForIdent('NewDayRainCounter');

                            //build diffs
                            $old = GetValueInteger($rcid);
                            $daily = GetValueInteger($dailyid);
                            $diff = $new - $old;
                            //counter overflow 4096
                            if ($diff<0) $diff+=4096;
                            $dailydiff=$new-$daily;
                            if ($dailydiff<0) $dailydiff+=4096;
                            
                            $crain = ($diff * $this->GetRainPerCount())/1000;
                            if ($crain<>$rain) {
                                $this->debug(__FUNCTION__,"Rain different c:$crain,d:$rain ");
                            }
                            $raindaily = ($dailydiff * $this->GetRainPerCount())/1000;

                            $dailyvar=IPS_GetVariable($dailyid);
                            $dailyupdated=$dailyvar['VariableUpdated'];
                            if (is_new_day($dailyupdated)) {
                                //new day routine,set
                                //$rcvar=IPS_GetVariable($rcid);
                                //$updated=$rcvar['VariableUpdated'];
                                //if($updated<$date) {
                                //set last day sum
                                $this->debug(__FUNCTION__,'NewDay, Store old Counter');
                                SetValueInteger($dailyid, $old);
                                //}
                            }
                            if ($new>$old) SetValueInteger($rcid,$new);
                            if (($rain < 0) or ($rain > 100)) $rain = 0;
                            if (($raindaily < 0) or ($raindaily > 500)) $raindaily = 0;

                            $data['Date']=$datum;
                            $data['Typ']='Rain';
                            $data['Rain']=$rain;
                            $data['RainCounter']=$rc;
                            $data['RainDaily']=$raindaily;
                            $data['CounterFactor']=$cf;
                            $caps.='RainCounter;Rain;RainDaily;';
                            $this->debug(__FUNCTION__,"Rain Counter:$rc, Rain:$rain, cf: $cf, daily: $raindaily ,TOL:$tol");
                            $this->SendWSData($data,$caps);
                        }
                        break;
                    case 'WS':
                        $values=str_replace(" ","",$values);
                        list($speed,$dir,$var,$new)=explode(',',$values);
                        if ($new==1) {
                            $data['Date']=$datum;
                            $data['Typ']='Wind';
                            $data['WindSpeed']=$speed;
                            $data['WindDir']=$dir;
                            $data['WindVar']=$var;
                            $caps.='WindSpeed;WindDir;WindVar';
                            $this->debug(__FUNCTION__,"Wind Speed:$speed, Dir:$dir, Var: $var");
                            $this->SendWSData($data,$caps);
                        }
                        break;
                    case 'LS':
                        $values=str_replace(" ","",$values);
                        list($light,$factor,$flag,$dur,$deltadur,$new)=explode(',',$values);
                        if ($new==1) {
                            $data['Date']=$datum;
                            $data['Typ']='Light';
                            $data['Light']=$light*$factor;
                            $caps.='Light;';
                            $this->debug(__FUNCTION__,"Light $light factor: $factor, Flag:$flag, Dur:$dur, Deltadur:$deltadur");
                            $this->SendWSData($data,$caps);
                        }
                        break;
                    case 'PYS':
                        $values=str_replace(" ","",$values);
                        list($light,$factor,$new)=explode(',',$values);
                        if ($new==1) {
                            $data['Date']=$datum;
                            $data['Typ']='Pyrano';
                            $data['UV']=$light*$factor;
                            $caps.='UV;';
                            $this->debug(__FUNCTION__,"PYR $light factor: $factor ");
                            $this->SendWSData($data,$caps);
                        }
                        break;
                    case 'PS':
                        $values=str_replace(" ","",$values);
                        list($press,$new)=explode(',',$values);
                        if ($new==1) {
                            $data['Date']=$datum;
                            $data['Typ'] = 'Indoor';
                            $data['Id'] = 'Indoor';
                            $data['Press'] = $press;
                            $caps .= 'Press;';
                            $this->debug(__FUNCTION__,"Press $press");
                            $this->SendWSData($data,$caps);
                        }
                        break;
                    default:
                        $this->debug(__FUNCTION__,"Unknown type '$typ'");
                        break;
                }//switch
            }//match  line
        }//for lines
    }//function

    //--------------------------------------------------------
    /**
     * Forward weather data to WSDev instances
     * Create one if needed
     * @param array $data
     * @param string $caps
     */
    private function SendWSData($data, $caps)
    {
        //parsing was OK, start distributing
        $this->debug(__FUNCTION__, 'Prepare');
        $class = __CLASS__;
        $id = $data['Id'];
        $typ = $data['Typ'];

        $this->debug(__FUNCTION__, 'GetInstance for Sensor:' . $id);
        $found = false;
        $instID = 0;
        $instances = IPS_GetInstanceListByModuleID($this->module_interfaces['WSDEV']);
        foreach ($instances as $instID) {
            $I = @IPS_GetInstance($instID);

            if ($I && ($I['ConnectionID'] == $this->InstanceID)) { //my child
                $iid = (String)IPS_GetProperty($instID, 'DeviceID');
                $ityp = (String)IPS_GetProperty($instID, 'Typ');
                $iclass = (String)IPS_GetProperty($instID, 'Class');
                //$this->debug(__FUNCTION__, "Check my Device '$id'' with Instance $instID($iid)");
                if (($iid == $id) && ($iclass == $class) && ($ityp == $typ)) {
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
                $this->debug(__FUNCTION__, 'Creating Device ID ' . $id . ' disabled by Property AutoCreate');
                IPS_LogMessage($class, 'Creating Device ID ' . $id . ' disabled by Property AutoCreate');
            }//if autocreate
        }//if found
        if ($found && ($instID > 0)) {
            //send record to children
            $json = json_encode(
                array("DataID" => $this->module_interfaces['WS-RX'],
                    "DeviceID" => $id,
                    "Class" => $class,
                    "Typ" => $typ,
                    "WSData" => $data));
            $this->debug(__FUNCTION__, $json);
            @$this->SendDataToChildren($json);

            $datum = date('Y-m-d H:i:s', time());

            
            $vid = @$this->GetIDForIdent('LastUpdate');
            if ($vid) SetValueString($vid, $datum);
            $this->log_weather($data);

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
        $class = __CLASS__;
        $Device = $data['Id'];
        $typ = $data['Typ'];
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
                IPS_SetName($instID, $typ . ' Sensor ' . $Device);
                $ident = $class . "_".$typ."_".$Device;
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
