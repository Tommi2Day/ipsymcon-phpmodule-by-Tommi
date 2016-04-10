<?
/**
 * @file
 *
 * CUL IPSymcon PHP Splitter Module  for busware.de CUL/CUN/COC receiver
 *
 * @author Thomas Dressler
 * @copyright Thomas Dressler 2011-2016
 * @version 4.1
 * @date 2016-04-10
 */

include_once(__DIR__ . "/../module_helper.php");
include_once(__DIR__ . "/../fhz_helper.php");

/** @class CUL
 *
 * CUL IPSymcon PHP Splitter Module Class
 * for busware.de CUL/CUN/COC receiver
 * tested with IPS 4.0 COC FW 1.61 (ESA,Dimmer not tested,FHT not implementd, only FHT-TFK)
 *
 * protocol decodes translated from CULFW project
 * @see http://culfw.de/commandref.html
 */
class CUL extends T2DModule
{
    //------------------------------------------------------------------------------
    //module const and vars
    //------------------------------------------------------------------------------
    /**
     * Timer constant
     * maxage of LastUpdate in sec before ReInit
     */
    const MAXAGE = 300;

    /**
     * Fieldlist for Logging weather
     */
    const fieldlist_weather = "Date;Typ;Id;Name;Temp;Hum;Bat;Lost;Wind;Rain;IsRaining;RainCounter;Pressure;";


    //--------------------------------------------------------
    // main module functions
    //--------------------------------------------------------
    /**
     * Constructor
     * @param $InstanceID
     */
    public function __construct($InstanceID)
    {
        // 
        $json = __DIR__ . "/module.json";
        parent::__construct($InstanceID, $json);
    }

    //--------------------------------------------------------
    /**
     * overload internal IPS_Create($id) function
     */
    public function Create()
    {
        parent::Create();
        //Hint: $this->debug will not work in this stage! must use IPS_LogMessage
        //props
        $this->RegisterPropertyString('Category', 'CUL/CUx Devices');
        $this->RegisterPropertyInteger('ParentCategory', 0); //parent cat is root
        $this->RegisterPropertyBoolean('AutoCreate', true);
        $this->RegisterPropertyBoolean('Debug', false);
        $this->RegisterPropertyBoolean('Active', false);
        $this->RegisterPropertyBoolean('UseOW', false);
        
        //status Vars
        $this->RegisterVariableString('Buffer', 'Buffer', "", -1);
        IPS_SetHidden($this->GetIDForIdent('Buffer'), true);
        $this->RegisterVariableString('LastUpdate', 'Last Update', "", -2);
        IPS_SetHidden($this->GetIDForIdent('LastUpdate'), true);
        $this->RegisterVariableString('AuxMessage', 'Last System Message', "", 1);
        $this->RegisterVariableString('Version', 'Version', "", 2);
        $this->RegisterVariableString('Modus', 'Modus', "", 2);
        $this->RegisterVariableInteger('Errors', 'Errors', 0, 3);

        //reinit timer
        $this->RegisterTimer('ReInit', 58000, $this->module_data["prefix"] . '_ReInitEvent($_IPS[\'TARGET\']);');


        //call init if ready and activated
        if (IPS_GetKernelRunlevel() == self::KR_READY) {
            if ($this->isActive()) {
                $this->SetStatus(self::ST_AKTIV);
                //$this->init();
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
     * overload internal IPS_ApplyChanges($id) function
     */
    public function ApplyChanges()
    {
        // Diese Zeile nicht loeschen
        parent::ApplyChanges();
        if ($this->isActive() && $this->HasActiveParent()) {
            $this->SetStatus(self::ST_AKTIV);
            //$this->init();
        } else {
            $this->SetStatus(self::ST_INACTIV);
        }

    }

    //--------------------------------------------------------
    //Get/Set
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
    /**
     * Get status variable Buffer
     * contains incoming data from IO, act as regVar
     * @return String
     */
    private function GetBuffer()
    {
        $id = $this->GetIDForIdent('Buffer');
        $val = GetValueString($id);
        return $val;
    }

    //------------------------------------------------------------------------------
    /**
     * Set status variable Buffer
     * @param String $val
     */
    private function SetBuffer($val)
    {
        $id = $this->GetIDForIdent('Buffer');
        SetValueString($id, $val);
    }

    //------------------------------------------------------------------------------
    /**
     * Get Property UseOW
     * proerty to enable HMS emulation
     * @return bool
     */
    private function GetUseOw()
    {
        return (bool)IPS_GetProperty($this->InstanceID, 'UseOW');

    }

    //------------------------------------------------------------------------------
    //---Events
    //------------------------------------------------------------------------------
    /**
     * Timer Event to reinitialize system
     * Executed if there are no valid data within Timer as indicated by LastUpdate
     */
    public function ReInitEvent()
    {
        $id = @$this->GetIDForIdent('LastUpdate');
        if (!$id) return;
        $var = IPS_GetVariable($id);
        if (!$var) return;
        $last = $var['VariableUpdated'];
        //if (!$last) $last=0;
        $now = time();
        $diff = $now - $last;
        $this->debug(__FUNCTION__, "last update $diff s ago");
        if (($diff > self::MAXAGE) && $this->isActive() && $this->HasActiveParent()) {
            $this->init();
        }
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
        
        if (!$this->isActive()) return;
        if (!$this->HasActiveParent()) {
            $this->debug(__FUNCTION__, 'No active parent');
            return;
        }
        $this->debug(__FUNCTION__, 'Init entered');
        //get message variable
        $lmid = $this->GetIDForIdent('AuxMessage');
        //Status variables
        $mid = $this->GetIDForIdent('Modus');
        $versid = $this->GetIDForIdent('Version');
        SetValueString($mid, ""); //reset status variable
        SetValueString($versid, "");
        $this->SetBuffer('');

        //retrieve 1wire property
        $ow_use_hms = $this->GetUseOw();
        
        //query actual Modus 
        $this->SendText("X\r\n");
        IPS_Sleep(1000);
        $modus = GetValueString($mid);
        if ($modus <> "21") {
            //send command for CUL/CUN Modus X21 
            SetValueString($lmid, "");
            $this->SendText("X21\r\n");
            IPS_Sleep(1000);
            //Modus abfragen
            $this->SendText("X\r\n");
            IPS_Sleep(1000);
            $modus = GetValueString($mid);
            //log action
            if ($modus == "21") {
                $this->debug(__FUNCTION__, "CUL Modus set successfully");
            } else {
                IPS_LogMessage(__CLASS__, "Set CUL Modus failed");
            }//modus

        } else {
            $this->debug(__FUNCTION__, "CUL Modus already set");
        }//modus
        
        //query Version
        SetValueString($lmid, "");
        $this->SendText("V\r\n");
        IPS_Sleep(1500);
        $version = GetValueString($versid);
        SetValueString($lmid, "");
        
        //eble 1wire on capable devices if enabled
        if (($ow_use_hms) && (preg_match('/CSM|CUNO|COC/', $version))) {
            $this->init_onewire();
        }
        $this->debug(__FUNCTION__, "Version:$version, Modus: $modus");
        $this->SetBuffer('');

    }

    //------------------------------------------------------------------------------
    /**
     * Send commands to enable !Wire HMS Emulation
     */
    private function init_onewire()
    {
        $this->debug(__FUNCTION__, "Entered");
        //get message variable
        $lmid = $this->GetIDForIdent('AuxMessage');
        //$devid=getVid('OneWireDevices',$reg);
        #read OW-IDs
        IPS_Sleep(1000);
        $this->SendText("Of\r\n");
        IPS_Sleep(2000);
        $this->SendText("OHo\r\n");
        IPS_Sleep(2000);
        $res = substr(GetValueString($lmid), 0, 2);
        if ($res <> "ON") {
            $this->SendText("OHo\r\n");
            IPS_Sleep(1500);
            $res = substr(GetValueString($lmid), 0, 2);
        }
        if ($res == "ON") {
            #set 180s intervall
            $this->SendText("OHt180\r\n");
            IPS_Sleep(1500);
            $res = GetValueString($lmid);
            $this->debug(__FUNCTION__, "Set OW HMS Timer 180s:$res");
        } else {
            IPS_LogMessage(__CLASS__, "Onewire: Failed to set HMS modus($res)");
        }
        SetValueString($lmid, "");
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
                        $buffer = utf8_decode($data['Buffer']);
                        $this->debug(__FUNCTION__, 'WS-TX:' . $buffer);
                        break;
                    case $this->module_interfaces['EN-TX']:
                        $this->debug(__FUNCTION__, 'EN-TX');
                        break;
                    case $this->module_interfaces['FS20-TX']:
                        $this->debug(__FUNCTION__, 'FS20-TX');
                        break;
                    case $this->module_interfaces['SWD-TX']:
                        $this->debug(__FUNCTION__, 'SWD-TX');
                        if (isset($data['Cap']) && isset($data['Value']) && isset($data['Device']) && isset($data['Type'])) {
                            $this->SWD_ActionHandler($data);

                        } else {
                            $this->debug(__FUNCTION__, 'SWD-TX: invalid Data');
                        }


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
     * Data Interface from Parent(IO-RX)
     * @param string $JSONString
     */
    public function ReceiveData($JSONString)
    {
        //status check triggered by data
        if ($this->isActive() && $this->HasActiveParent()) {
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

            $buffer = $this->GetBuffer();
            if (is_object($data)) $data = get_object_vars($data);
            if (isset($data['DataID'])) {
                $target = $data['DataID'];
                if ($target == $this->module_interfaces['IO-RX']) {
                    $buffer .= utf8_decode($data['Buffer']);
                    $this->debug(__FUNCTION__, "Actual Buffer:" . $buffer);
                    $bl = strlen($buffer);
                    if ($bl > 5000) {
                        $buffer = substr($buffer, 5000);
                        IPS_LogMessage(__CLASS__, "Buffer length exceeded, dropping...");
                    }
                    $pos = strpos($buffer, chr(0x0a));
                    while ($pos !== false) {
                        $line = substr($buffer, 0, $pos - 1);
                        $this->Parse($line);
                        $buffer = substr($buffer, $pos + 1);
                        if ($buffer === false) $buffer = '';
                        $pos = strpos($buffer, chr(0x0a));
                        if ($buffer) $this->debug(__FUNCTION__, "Remains:$buffer,RPos: $pos");
                    }
                    $this->SetBuffer($buffer);
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
     * Data Interface tp Parent (IO-TX)
     * @param String $Data
     * @return bool
     */
    private function SendText($Data)
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
    //internal functions
    //------------------------------------------------------------------------------
    /**
     * Main parsing function, will split into device specific parsing
     * @param $line
     */
    private function Parse($line)
    {
        $lmid = $this->GetIDForIdent('AuxMessage');
        //load error variable
        $errid = $this->GetIDForIdent('Errors');
        $errors = GetValueInteger($errid);
        SetValueInteger($errid, 0);


        $this->debug(__FUNCTION__, "Line:$line");
        //---------------EM1000-----------------------------------
        if (preg_match("/(E[0-9A-F]{18,20})\s*\$/", $line, $res)) {
            $this->parse_EM1000($res[1]);
        } //-----------------------FS20
        elseif (preg_match("/(F[0-9A-F]{8,12})\s*\$/", $line, $res)) {
            $this->parse_FS20($res[1]);
        } //------------------FHT---------------------------------
        elseif (preg_match("/(T[0-9A-F]{8,12})\s*\$/", $line, $res)) {
            $this->parse_FHT($res[1]);
        } //---------------------Wetter(WS300)-----------------------------------------
        elseif (preg_match("/(K[0-9A-F]{6,16})\s*\$/", $line, $res)) {
            $this->parse_WS300($res[1]);
        } //--------------------HMS-------------------------------------------------------
        elseif (preg_match("/(H[0-9A-F]{12,14})\s*\$/", $line, $res)) {
            $this->parse_HMS($res[1]);
        } //--------------------ESA-------------------------------------------------------
        elseif (preg_match("/(S[0-9A-F]{32,34})\s*\$/", $line, $res)) {
            $this->parse_ESA($res[1]);
        } #-----------aux/unknown/unimplemented cul/cun/coc message------
        elseif (!preg_match("/^\s*$/", $line)) {
            $this->debug(__FUNCTION__, 'MSG:' . $line);
            SetValueString($lmid, $line);

            //--------------------OneWire---------------------------------------------
            if (preg_match("/R:[0-9A-F]{16}\s*\$/", $line)) {
                $this->debug(__FUNCTION__, 'OneWire Device:' . substr($line, 2));
            } elseif (preg_match("/D:\s*([0-9]+)\s*\$/", $line, $res)) {
                $this->debug(__FUNCTION__, 'OneWire detected Devices:' . $res[1]);
            } elseif (preg_match("/^\s*(ON|OFF)\s*\$/", $line, $res)) {
                $this->debug(__FUNCTION__, 'OneWire HMS Emulation:' . $res[1]);
            } //------ Init messages --------------
            elseif (preg_match("/(V\s*[0-9\.]+)\s*CSM.*/", $line, $res)) {
                $vers = $res[1];
                $versid = $this->GetIDForIdent('Version');
                if ($versid) SetValueString($versid,$vers);
                $this->debug(__FUNCTION__, 'Version:' . $vers);
            } elseif (preg_match("/^[0-9]{2}\s+[0-9]{3}/", $line)) {
                $modus = substr($line, 2);
                $mid = $this->GetIDForIdent('Modus');
                if ($mid) SetValueString($mid,$modus);
                $this->debug(__FUNCTION__, 'Modus:' . $modus);
                //--------- Error -------------
            } else {
                $errors = $errors + 1;
                $this->debug(__FUNCTION__, 'Err:' . $errors . ' MSG:' . $line . "Len:" . strlen($line) . " Hex:" . strToHex($line));
                SetValueInteger($errid, $errors);
                if ($errors > 10) {
                    //to many errors, reset COC
                    $this->init();

                }//errors
            }//preg others
        }//preg
    }//functio

    //------------------------------------------------------------------------------
    /**
     * Parse EM1000 CUL Hex Record
     *
     * @code
     * # Ettaacc111122223333
     * # E0101E2997805002F02
     * # 0123456789012345678
     * @endcode
     * -tt:type 01=EM-1000s, 02=EM-100-EM, 03=1000GZ
     * -aa:address, depending on the type above 01:01-04, 02:05-08, 03:09-12
     * -cc:seqno, will be incremented by one for each message
     * -1111: total_cnt
     * -2222: current_cnt (Not set for type 2)
     * -3333: peak_cnt  (Not set for type 2)
     *
     * -seqno    =  number of received datagram in sequence, runs from 2 to 255
     * -total_cnt=  total (cumulated) value in ticks as read from the device. will wrap at 65535
     * -current_cnt  =  current counter value (average over latest 5 minutes) in device units
     * -peak_cnt     =  maximum value in device units
     *
     * @param string $line
     *
     */
    private function parse_EM1000($line)
    {
        $data = array();
        $caps = "Counter;OCounter;";
        $type = substr($line, 2, 1);
        $addr = substr($line, 3, 2);
        $seqno = hexdec(substr($line, 5, 2));

        //original total value
        $total_cnt = hexdec(substr($line, 9, 2) . substr($line, 7, 2));
        $current_cnt = hexdec(substr($line, 13, 2) . substr($line, 11, 2));
        $peak_cnt = hexdec(substr($line, 17, 2) . substr($line, 15, 2));

        //device specific
        $addr_num = hexdec($addr);
        $data['Id'] = $addr_num;
        $data['Class']= __CLASS__."-EM";
        if ($addr_num >= 1 && $addr_num <= 4) {
            $data['Typ'] = 'EMWZ';
            $data['CounterFactor'] = 150;
            $caps .= 'TPower;APower;PPower;ACounter;PCounter;';
        } elseif ($addr_num >= 5 && $addr_num <= 8) {
            $data['Typ'] = 'EMEM';
            $data['CounterFactor'] = 0.001;
            $caps .= 'TPower;APower;ACounter;';
        } elseif ($addr_num >= 9 && $addr_num <= 12) {
            $data['Typ'] = 'EMGZ';
            $data['CounterFactor'] = 0.01;
            $caps .= 'TGas;AGas;ACounter;';
        } else {
            $this->incError();
            return;
        }//if addr

        $data['Counter'] = $total_cnt;
        $data['PCounter'] = $peak_cnt;
        $data['ACounter'] = $current_cnt;
        //debug
        $val = sprintf("SEQ: %d CNT: %d CURRCNT: %d PEAKCNT: %d",
            $seqno, $total_cnt, $current_cnt, $peak_cnt);
        $text = "Type $type Addr:$addr, $val";

        //signal
        if (strlen($line) > 19) {
            $rssi = $this->GetSignal(substr($line, 19, 2));
            $text .= ", RSSI:$rssi";
            $data['Signal'] = $rssi;
            $caps.="Signal;";
        }

        //logging
        $this->debug(__FUNCTION__, $text);
        //logge($emlog,"$line=>Dev $addr:".$text."\n");
        $this->SendEnData($data, $caps);
    }//function

    //------------------------------------------------------------------------------
    /**
     * Parse FS20 CUL Hex record
     *
     * @code
     * # F1F1E013A4F
     * # FHHHHAACCTTSS
     * # 0123456789012
     * @endcode
     * -HHHH Homecode
     * -AA Address
     * -CC FS20code
     * -TT Timer code
     * -SS Signal
     *
     * @param $line
     */
    private function parse_FS20($line)
    {
        $data = array();
        $caps = "Switch:1;Dimmer:1;Timer;FS20;TimerActionCode;";//enable action for switch and dimmer
        $hcode = substr($line, 1, 4);
        $addr = substr($line, 5, 2);
        $code = substr($line, 7, 2);
        $acode=hexdec($code);

        $hc = FHZ_helper::hex2four($hcode . $addr);
        $action = FHZ_helper::$fs20_codes[$code];
        if (!$action) {
            $this->incError();
            IPS_LogMessage(__CLASS__, __FUNCTION__ . "unknown Action Code $code");
            return;
        }

        //timer
        if ($acode >31){
            $timer = substr($line, 9, 2);
            $tcode=hexdec($timer);
            $action .= ' Timer:' . FHZ_helper::fs20_times($tcode);
        }else{
            $tcode=0;
        }
        $fs20data = chr($acode) . chr($tcode);

        //signal
        $rssi = 0;
        if (strlen($line) > 11) {
            $rssi = $this->GetSignal(substr($line, 11, 2));
            $data['Signal'] = $rssi;
            $caps.='Signal;';

        } else {
            //signal
            if ((strlen($line) > 9) && ($acode<32)) {
                $rssi = $this->GetSignal(substr($line, 9, 2));
                $data['Signal'] = $rssi;
                $caps.='Signal;';
            }
        }

        //make record
        $data['Typ'] = 'FS20'; //Device FS20
        $data['Id'] = $hc;
        $data['Class'] = __CLASS__."-FS20";
        $data['FS20'] = utf8_encode($fs20data);

        //send
        $text = sprintf('Device:%s(%s), Action:%s (%s), Signal %d', $hc, $hcode . $addr, $action, strToHex($fs20data), $rssi);
        $this->debug(__FUNCTION__, $text);
        $this->SendSwitchData($data, $caps);

    }

    //------------------------------------------------------------------------------
    /**
     * Parse FHT CUL Hex record
     *
     * @code
     * # T4414B90106 TFK
     * # TAAAAAACCSS
     * # 01234567890
     * @endcode
     * - AAAAAA Adress
     * - CC code
     * - SS Signal
     *
     * @param $line
     */
    private function parse_FHT($line)
    {
        $data=array();
        $data['Class'] = __CLASS__."-FHT";
        $caps='Id;Typ;';

        if(strlen($line) <12 ) {
            //TFK with signal
            $dev = substr($line, 1, 6);
            $code = substr($line, 7, 2);
            
            $data['Typ']="FHT TFK";
            $data['Id']=$dev;
            switch ($code) {

                case "01":
                case "81": $win="OPEN";
                            $bat='OK';
                            $data['Lock']=$win;
                            $data['Battery']=$bat;
                            $caps.="Lock;Battery;";
                    break;
                case "02":
                case "82": $win="CLOSE";
                           $bat='OK';
                            $data['Lock']=$win;
                           $data['Battery']=$bat;
                            $caps.="Lock;Battery;";
                    break;
                case "11":
                case "91":$win="OPEN";
                            $bat='LOW';
                            $data['Lock']=$win;
                            $data['Battery']=$bat;
                            $caps.="Lock;Battery;";
                    break;
                case "12":
                case "92":
                        $win="CLOSED";
                        $bat='LOW';
                        $data['Lock']=$win;
                        $data['Battery']=$bat;
                        $caps.="Lock;Battery;";

                    break;
                default: break;
            }//switch
            //signal
            if ( strlen($line)>9) {
                $rssi=$this->GetSignal(substr($line,9,2));
                $caps.="Signal;";
                $data['Signal']=$rssi;
            }

            $cmd=isset(FHZ_helper::$FHT_tfk_codes [$code])? FHZ_helper::$FHT_tfk_codes[$code]:"Unknown TFK:$code";
            $text="FHT TFK Dev $dev  Code $cmd" ;

            //logging
            $this->debug(__FUNCTION__,$text);

            //send
            $this->SendSwitchData($data,$caps);
        } else {

            $dev = substr($line, 1, 4);
            $code = substr($line, 5, 2);
            //FHT controler
            $this->debug(__FUNCTION__, "FHT not implemented yet, Data $dev Code:$code ($line)");

        }//if strlen
    }//function

    //------------------------------------------------------------------------------
    /**
     * Parse HMS CUL Hex Record
     @code
     # H37AE01240000
     # HAAAABICCSS    Typid >1
     #    CCITTHTHHSS Typid 0,1
     # 012345678901234
     @endcode
     * - AAAA Address
     * - B Battery
     * - I Type
     * - CC State code
     * - T Temperature 0.1 Byteorder MSB 3,0,1
     * - H Humidity 0.1 Byteorder MSB 2,4,5
     * - S Signal
     * @param string $line
     */
    private function parse_HMS($line)
    {

        $codes = array(
            0 => "HMS100TF",
            1 => "HMS100T",
            2 => "HMS100WD",
            3 => "RM100-2",
            4 => "HMS100TFK", # Depending on the onboard jumper it is 4 or 5
            5 => "HMS100TFK",
            6 => "HMS100MG",
            8 => "HMS100CO",
            14 => "HMS100FIT"
        );

        $typid = hexdec(substr($line, 6, 1));
        $typ = $codes[$typid];
        $stat = $typid > 1 ? hexdec(substr($line, 7, 2)) : hexdec(substr($line, 5, 2));
        //$prf  = $typid > 1 ? "02" : "05";
        $bat = $typid > 1 ? hexdec(substr($line, 5, 1)) + 1 : 1;
        $dev = substr($line, 1, 4);
        $val = $typid > 1 ? "000000" : substr($line, 7);


        $data = array();
        $data['Class'] = __CLASS__."-HMS";
        $caps = 'Id;Typ;Battery;';
        $data['Id'] = $dev;
        $data['Typ'] = $typ;
        $data['Battery'] = ($bat == 1) ? 'OK' : 'LOW';

        //signal
        $rssi=0;
        if (strlen($line) > 13) {
            $rssi = $this->GetSignal(substr($line, 13, 2));
            $data['Signal'] = $rssi;
            $caps .= 'Signal;';
        }

        //data
        switch ($typid) {
            case 0://TF
                $caps .= 'Temp;Hum;';
                $temp = (substr($val, 3, 1) . substr($val, 0, 2)) / 10;
                $hum = (Integer)(substr($val, 4, 2) . substr($val, 2, 1)) / 10;
                if (($stat & 128) > 0) $temp = -$temp;
                $data['Temp'] = $temp;
                $data['Hum'] = $hum;
                $this->debug(__FUNCTION__, "HMS $dev ($typ) Temp:$temp, Hum: $hum RSSI:$rssi");
                $this->SendWSData($data, $caps);
                break;
            case 1://T
                $caps .= 'Temp';
                $temp = (substr($val, 3, 1) . substr($val, 0, 2)) / 10;
                if (($stat & 128) > 0) $temp = -$temp;
                $data['Temp'] = $temp;
                $this->SendWSData($data, $caps);
                $this->debug(__FUNCTION__, "HMS $dev ($typ) Temp: $temp RSSI:$rssi");
                break;
            case 4://TFK Switch1
            case 5://TFK Switch2
                $caps .= 'Lock;';
                $data['Lock'] = ($stat > 0) ? 'CLOSE' : 'OPEN';
                $this->SendSwitchData($data, $caps);
                $this->debug(__FUNCTION__, "HMS $dev ($typ) Lock:" . $data['Lock']." RSSI:$rssi");
                break;

            case 2://WD
            case 3://RM100
            case 6://Gas MG
            case 8://Gas CO
            case 14://FIT
                $data['Alert'] = ($stat > 0) ? 'YES' : 'NO';
                $this->SendSwitchData($data, $caps);
                $this->debug(__FUNCTION__, "HMS $dev ($typ) Alert:" . $data['Alert']." RSSI:$rssi");
                break;

            default://typid not known
                IPS_LogMessage(__CLASS__ . "HMS: $dev Unknown type $typid");
                $this->incError();
        }

    }//function

    //------------------------------------------------------------------------------
    /**
     * Parse WS300 CUL Hex Record
     *
     * @code
     * # For KS300:
       # KFFTTTHWHWWRRFRSS
     * # For S300TH:
     * # KAATTHTHHSS
     * # K11245265
     * # K41815177F4
     * # 0123456789012345
     * @endcode
     * -AA Address
     * -T Temp Byteorder MSB 6,3,4
     * -H Hum Byteorder MSB 7,8(,5)
     * -W Wind Byteorder 9,10,7
     * -R Raincounter Byteorder 14,11,12
     * -S Signal
     *
     * Data must be read backwards
     * @param $line
     */
    private function parse_WS300($line)
    {

        $tlist = array("0" => "temp",
            "1" => "T/F",
            "2" => "Rain",
            "3" => "Wind",
            "4" => "Indoor",
            "5" => "brightness",
            "6" => "pyro",
            "7" => "T/F");

        $a = str_split($line);
        $len = strlen($line) - 1; //last is cr
        $firstbyte = hexdec($a[1]);
        $typebyte = $a[2];
        $dev = (string)($firstbyte & 7);
        $typid = $tlist[$typebyte];
        $typebyte = $typebyte & 7;
        $varids = null;
        $val = "no data";

        $data = array();
        $caps = 'Id;Typ;';
        $data['Id'] = $dev;
        $data['Class'] = __CLASS__."-WS300";


        //signal
        if (strlen($line) > 13) {
            $rssi = $this->GetSignal(substr($line, 13, 2));
            $data['Signal'] = $rssi;
            $caps .= 'Signal;';
        }


        if (($firstbyte & 7) == 7) {
            if ($typebyte == 0 && $len > 6) {           # temp
                $sgn = ($firstbyte & 8) ? -1 : 1;
                $tmp = $sgn * ($a[6] . $a[3] . "." . $a[4]);
                $val = "T: $tmp";
                $caps .= 'Temp';
                $data['Temp'] = $tmp;
                $data['Typ'] = 'PS50';
            }

            if ($typebyte == 1 && $len > 8) {           # temp/hum
                $sgn = ($firstbyte & 8) ? -1 : 1;
                $tmp = $sgn * ($a[6] . $a[3] . "." . $a[4]);
                //$hum = ($a[7].$a[8].".".$a[5]) ;
                $hum = ($a[7] . $a[8]);
                $val = "T: $tmp  H: $hum";
                $caps .= 'Temp;Hum;';
                $data['Temp'] = $tmp;
                $data['Hum'] = $hum;
                $data['Typ'] = 'WS300 T/F';

            }
            //signal
            if ($len > 9) {
                $rssi = $this->GetSignal(substr($line, 19, 2));
                $data['Signal'] = $rssi;
                $caps .= 'Signal;';

            }

        } else {
            if ($len < 12) {                 #  S300TH
                $sgn = ($firstbyte & 8) ? -1 : 1;
                $tmp = $sgn * ($a[6] . $a[3] . "." . $a[4]);
                //$hum = ($a[7].$a[8].".".$a[5]);
                $hum = ($a[7] . $a[8]);
                $val = "T: $tmp  H: $hum";
                $caps .= 'Temp;Hum;';
                $data['Temp'] = $tmp;
                $data['Hum'] = $hum;
                $data['Typ'] = "S300TH";

                //signal
                if ($len == 10) {
                    $rssi = $this->GetSignal(substr($line, 9, 2));
                    $data['Signal'] = $rssi;
                    $caps .= 'Signal;';

                }
            } elseif ($len > 13) {          # KS300/2


                $rainc = hexdec($a[14] . $a[11] . $a[12]);
                $wnd = hexdec($a[9] . $a[10] . $a[7]) / 10;
                $hum = hexdec($a[8] . $a[5]);
                $tmp = hexdec($a[6] . $a[3] . $a[4]) / 10;
                if ($a[1] & 0xC) $tmp = $tmp * -1;
                $ir = ((hexdec($a[1]) & 2)) ? "YES" : "NO";
                $caps .= 'Temp;Hum;Wind;RainCounter;IsRaining;';
                $data['Temp'] = $tmp;
                $data['Hum'] = $hum;
                $data['Wind'] = $wnd;
                $data['RainCounter'] = $rainc;
                $data['IsRaining'] = $ir;
                $data['Typ'] = "KS300";
                $val = "T: $tmp  H: $hum  W: $wnd  R: $rainc  IR: $ir";
            }
            //signal
            if ($len == 15) {
                $rssi = $this->GetSignal(substr($line, 13, 2));
                $data['Signal'] = $rssi;
                $caps .= 'Signal;';
            }
        }
        if (!$data['Typ']) $data['Typ'] = ($typid ? $typid : 'unknown');
        $text = "Dev $dev ($typid): $val";
        $this->debug(__FUNCTION__, "HMS:" . $text);
        $this->SendWSData($data, $caps);
    }//function

    //------------------------------------------------------------------------------
    /**
     * Parse ESA Power monitor record
     * definitions taken from FHEM 64_ESA2000.pm
     * @code
    # S6E003D011E00037650001102C1DA07D01D
    # S 6E 003D 011E 00037650 0011 02C1DA 07D0 1D
    #              1           2           3
    # 0 12 3456 7890 12345678 9012 345678 9012 34
    #   NN DDDD IIII TTTTTTTT CCCC ZZZZZZ XXXX SS
    # N seqno        =  number of received datagram in sequence mod 128(repeated if seqno/128 >0)
    # D code         =  device code
    # I typid           = typid of sensor: 011E: ESA1000-WZ, ...
    # T total_cnt    =  total (cumulated) value in ticks as read from the device
    # C current_cnt  =  current value (average over latest 5 minutes) in device units
    # Z timestamp    =  current time from start of device in 10 sec units
    # X ticks        =  ticks per kWh setup in ESA1000WS (depends on the meter)
    @endcode
     * @param string $line
     */
    private function parse_ESA($line)
    {
        $codelist = array(
            "003D" => "ESA1000-S0",
            "0055" => "ESA1000-S0",
            "44C7" => "ESA2000_LED",
            "0178" => "ESA2000_LED",
            "0595" => "ESA1000GAS",
            "01FA" => "ESA2000_LED",
            "011E" => "ESA1000-WZ"
        );

        //$seqno= hexdec(substr($line,1,2))%128;
        $code = substr($line, 3, 4);
        $typid = substr($line, 7, 4);
        $dev = $code . "-" . $typid;
        $total_cnt = hexdec(substr($line, 11, 8));
        $current_cnt = hexdec(substr($line, 19, 4));
        $timestamp = hexdec(substr($line, 23, 6));
        $ticks = hexdec(substr($line, 29, 4));
        $sensorname = isset($codelist[$code]) ? $codelist[$code] : "ESA ";
        $caps = 'Date;Id;Typ;Counter;ACounter;TPower;APower;';
        $data['Class'] = __CLASS__."-ESA";
        $data['Date'] = date('Y-m-d H:i:s', $timestamp);
        $data['Id'] = $dev;
        $data['Typ'] = $sensorname;
        $data['Counter'] = $total_cnt;
        $data['ACounter'] = $current_cnt;
        if ($ticks > 0) {
            $data['TPower'] = $total_cnt / $ticks;
            $data['APower'] = $current_cnt / $ticks;
        }
        //signal
        $rssi = 0;
        if (strlen($line) > 32) {
            $rssi = $this->GetSignal(substr($line, 33, 2));
            $caps .= 'Signal;';
            $data['Signal'] = $rssi;
        }
        $text = "ESA Dev $dev : Tot:$total_cnt, Cur: $current_cnt Ticks: $ticks; Signal: $rssi";
        $this->debug(__FUNCTION__, $text);
        $this->SendEnData($data, $caps);

    }//function

    //------------------------------------------------------------------------------
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
        $class = $data['Class'];
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
                $this->debug(__FUNCTION__, "Check my Device '$id'' with Instance $instID($iid)");
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
        $class = $data['Class'];
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
     * Forward Switch data to SwitchDev instances
     * Create one if needed
     * @param array $data
     * @param string $caps
     */
    private function SendSwitchData($data, $caps)
    {
        //parsing was OK, start distributing
        $this->debug(__FUNCTION__, 'Prepare');
        $class = $data['Class'];
        $id = $data['Id'];
        $typ = $data['Typ'];
        $found = false;
        $instID = 0;
        $instances = IPS_GetInstanceListByModuleID($this->module_interfaces['SwitchDev']);
        foreach ($instances as $instID) {
            $I = IPS_GetInstance($instID);
            $iid = (String)IPS_GetProperty($instID, 'DeviceID');
            $ityp = (String)IPS_GetProperty($instID, 'Typ');
            $iclass = (String)IPS_GetProperty($instID, 'Class');
            $this->debug(__FUNCTION__, "Check my Device '$id' with Instance $instID($iid)");
            if ($I['ConnectionID'] == $this->InstanceID) { //my child
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
                $this->debug(__FUNCTION__, 'CREATE NEW Device');
                $instID = $this->CreateSwitchDevice($data, $caps);
                $found = true;
            } else {
                $this->debug(__FUNCTION__, 'Creating Device ID ' . $id . ' disabled by Property AutoCreate');
                IPS_LogMessage($class, 'Creating Device ID ' . $id . ' disabled by Property AutoCreate');
            }//if autocreate
        }//if found

        if ($found && ($instID > 0)) {
            //send record to children
            $json = json_encode(
                array("DataID" => $this->module_interfaces['SWD-RX'],
                    "DeviceID" => $data['Id'],
                    "Typ" => $data['Typ'],
                    "Class" => $class,
                    "SWData" => $data,
                )
            );

            $this->debug(__FUNCTION__, $json);
            @$this->SendDataToChildren($json);
            $datum = date('Y-m-d H:i:s', time());
            $vid = @$this->GetIDForIdent('LastUpdate');
            if ($vid) SetValueString($vid, $datum);
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
        $class = $data['Class'];
        $Device = $data['Id'];
        $typ = $data['Typ'];
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
                IPS_SetName($instID, "$typ Device $Device");
                $ident = $class . "_".$typ."_".$Device;
                $ident = preg_replace("/\W/", "_", $ident);//nicht-Buchstaben/zahlen entfernen
                IPS_SetIdent($instID, $ident);
                IPS_ConnectInstance($instID, $this->InstanceID);
                IPS_ApplyChanges($instID);

                //set category
                $cat = $this->GetCategory();
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
                }//parent
            } else {
                $this->debug(__FUNCTION__, 'Instance  is not created!');
            }//if instID
        }//module exists
        return $instID;
    }//function

    //------------------------------------------------------------------------------
    /**
     * Forward data to EnergyDev instances
     * Create one if needed
     * @param array $data
     * @param string $caps
     */
    private function SendEnData($data, $caps)
    {
        //parsing was OK, start distributing
        $this->debug(__FUNCTION__, 'Prepare');
        $class = $data['Class'];
        $id = $data['Id'];
        $typ = $data['Typ'];
        $found = false;
        $instID = 0;
        $instances = IPS_GetInstanceListByModuleID($this->module_interfaces['EnergyDev']);
        foreach ($instances as $instID) {
            $I = IPS_GetInstance($instID);
            $iid = (String)IPS_GetProperty($instID, 'DeviceID');
            $ityp = (String)IPS_GetProperty($instID, 'Typ');
            $iclass = (String)IPS_GetProperty($instID, 'Class');
            $this->debug(__FUNCTION__, "Check my Device '$id' with Instance $instID($iid)");
            if ($I['ConnectionID'] == $this->InstanceID) { //my child
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
                $this->debug(__FUNCTION__, 'CREATE NEW Device');
                $instID = $this->CreateENDevice($data, $caps);
                $found = true;
            } else {
                $this->debug(__FUNCTION__, 'Creating Device ID ' . $id . ' disabled by Property AutoCreate');
                IPS_LogMessage($class, 'Creating Device ID ' . $id . ' disabled by Property AutoCreate');
            }//if autocreate
        }//if found

        //drop counterfactor from data
        if (isset($data['CounterFactor'])) {
            unset($data['CounterFactor']);
        }
        if ($found && ($instID > 0)) {
            //send record to children
            $json = json_encode(
                array("DataID" => $this->module_interfaces['EN-RX'],
                    "DeviceID" => $data['Id'],
                    "Typ" => $data['Typ'],
                    "Class" => $class,
                    "ENData" => $data,
                )
            );

            $this->debug(__FUNCTION__, $json);
            @$this->SendDataToChildren($json);
            $datum = date('Y-m-d H:i:s', time());
            $vid = @$this->GetIDForIdent('LastUpdate');
            if ($vid) SetValueString($vid, $datum);
        }//found
    }//function

    //--------------------------------------------------------
    /**
     * Create a new EneryDev instance and set its properties
     * @param array $data parsed record
     * @param String $caps String semicolon seperated capabilities of this device
     * @return int new Instance ID
     */
    private function CreateENDevice($data, $caps)
    {
        $instID = 0;
        $class = $data['Class'];
        $Device = $data['Id'];
        $typ = $data['Typ'];
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
                IPS_SetName($instID, "$typ Device " . $Device);
                $ident = $class . "_".$typ."_".$Device;
                $ident = preg_replace("/\W/", "_", $ident);//nicht-Buchstaben/zahlen entfernen
                IPS_SetIdent($instID, $ident);
                IPS_ConnectInstance($instID, $this->InstanceID);
                IPS_ApplyChanges($instID);

                //set factor
                if (isset($data['CounterFactor'])) {
                    IPS_SetProperty($instID, 'CounterFactor', $data['CounterFactor']);
                }
                //set category
                $cat = $this->GetCategory();
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
                }//parent
                if (IPS_HasChanges($instID)) IPS_ApplyChanges($instID);
            } else {
                $this->debug(__FUNCTION__, 'Instance  is not created!');
            }//if instID
        }//module exists
        return $instID;
    }//function

    //------------------------------------------------------------------------------
    /**
     * prepare action request for sending to parent
     * @param array $data Interface Data
     */
    private function SWD_ActionHandler($data)
    {

        $cap = $data['Cap'];
        $val = $this->SwitchStatus($data['Value']);
        $type = $data['Type'];
        $Device = $data['Device'];
        switch ($type) {
            case 'FS20':
                switch ($cap) {
                    case 'Switch':
                        $fs20code = $val ? "11" : "00";
                        break;
                    case 'Dimmer':
                        $steps = FHZ_helper::fs20_intensity_steps($val);
                        $fs20code = sprintf("%02X", $steps);
                        break;
                        break;

                    default:
                        IPS_LogMessage(__CLASS__, __FUNCTION__.'invalid FS20 Action Command ' . $cap);
                        return;
                }
                $culaddr='';
                if (strlen($Device)==12) {
                    $culaddr.=FHZ_helper::four2hex(substr($Device,0,8)); //hc
                    $culaddr.=FHZ_helper::four2hex(substr($Device,8,4)); //sub
                    $cul = 'F' . $culaddr . $fs20code;
                    $this->debug(__FUNCTION__, "Send to FS20 Device $Device ($culaddr): $cul");
                    $this->SendText($cul . "\r\n");
                }else{
                    IPS_LogMessage(__CLASS__, __FUNCTION__ ."Invalid Device $Device Len<>12: ".strlen($Device));
                }

                break;
            default:
                IPS_LogMessage(__CLASS__, __FUNCTION__ . "unsupported Type $type");
        }
    }
    
    //------------------------------------------------------------------------------
    /**
     * decodes signal strengh from CUL hex
     * @param $hex
     * @return int
     */
    private function GetSignal($hex)
    {
        $rssi = hexdec($hex);
        if ($rssi >= 128) {
            $rssi = (($rssi - 256) / 2) - 74;
        } else {
            $rssi = ($rssi / 2) - 74;
        }
        $rssi = intval($rssi);
        return $rssi;
    }

    //------------------------------------------------------------------------------
    /**
     * inc Error counter
     */
    private function incError()
    {
        $vid = $this->GetIDForIdent('Error');
        $val = GetValueInteger($vid);
        SetValueInteger($vid, $val + 1);
    }
}//class
