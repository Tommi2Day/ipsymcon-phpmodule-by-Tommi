<?
/**
 * @file
 *
 * Dummy Module for FHZ compatibility functions
 *
 * @author Thomas Dressler
 * @copyright Thomas Dressler 2011-2016
 * @version 1.3
 * @date 2016-04-03
 */
include_once(__DIR__ . "/../fhz_helper.php");
include_once(__DIR__ . "/../module_helper.php");

/**
 *IPSymcon PHP Splitter Module Class
 * @class FHZDummy
 * @deprecated
 *
 *
 * @version 4.0
 * @date 2016-01-06
 *
 *  Descriptions :
 * @see http://www.tdressler.net/ipsymcon/fhzdummy.html
 * @see https://www.symcon.de/service/dokumentation/entwicklerbereich/sdk-tools/sdk-php/
 * @see http://www.ip-symcon.de/service/dokumentation/komponenten/verwaltungskonsole/
 *
 */
class FHZDummy extends IPSModule
{
    /**
     * Vital module data build out of module.json
     * @var array|mixed
     */
    private $module_data = array();

    /**
     * optional filename of a debug log (fully qualified)
     * @var string
     */
    private $DEBUGLOG = '';

    /**
     * module helper object
     * @var module_helper
     */
    private $mh;

    //--------------------------------------------------------
    // main module functions
    //--------------------------------------------------------
    /**
     * FHZDummy constructor.
     * @param $InstanceID
     */
    public function __construct($InstanceID)
    {
        // Diese Zeile nicht löschen
        parent::__construct($InstanceID);
        $json = @file_get_contents(__DIR__ . "/module.json");
        $data = @json_decode($json, true);
        $this->module_data = $data;
        if (!isset($data["name"])) {
            IPS_LogMessage(__CLASS__, "Reading Moduldata from module.json failed!");
            return false;
        }
        $this->DEBUGLOG = IPS_GetLogDir() . "/" . __CLASS__ . "debug.log";
        $this->mh = new module_helper($InstanceID, $this->module_data['name']);
        return true;
    }
    //--------------------------------------------------------
    /**
     * overwrite internal IPS_Create($id) function
     */
    public function Create()
    {
        // Diese Zeile nicht löschen.
        parent::Create();
        //Hint: $this->debug will not work in this stage! must use IPS_LogMessage
        $this->RegisterPropertyBoolean("Debug", false);
      }
    //--------------------------------------------------------
    /**
     * FHZDummy Destructor
     */
    public function Destroy()
    {
        //Save Settings
        //$this->mh->SemLeave('Log');
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
    }


    //------------------------------------------------------------------------------
    //Data Interfaces
    //------------------------------------------------------------------------------
    /**
     * Receive Data from Child (Devices)
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
                    case module_helper::$module_interfaces['IO-TX']:
                        $buffer = utf8_decode($data['Buffer']);
                        $this->debug(__FUNCTION__, strToHex($buffer));
                        $this->debuglog("IOTX-HEX:".strToHex($buffer));
                        break;
                    case module_helper::$module_interfaces['FS20-TX']: //to FHZ
                        $this->debug(__FUNCTION__, 'FS20-TX');
                        $this->decode_fs20tx($data);
                        if ($this->mh->HasActiveParent())
                            $this->SendDataToParent($JSONString);
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
     * Receive Data from Parent
     * @param string $JSONString
     */
    public function ReceiveData($JSONString)
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
                    case module_helper::$module_interfaces['IO-RX']:
                        $buffer = utf8_decode($data['Buffer']);
                        $this->debug(__FUNCTION__, strToHex($buffer));
                        $this->debuglog("IORX-HEX:".strToHex($buffer));
                        break;
                    case module_helper::$module_interfaces['FS20-RX']:
                        $this->decode_fs20rx($data);
                        $this->SendDataToChildren($JSONString);
                        break;
                    default:
                        IPS_LogMessage(__CLASS__, "Data Target GUID $target unhandled");

                }//target
            }//dataid
            else {
                $this->debug(__FUNCTION__, 'No DataID supplied');
            }//dataid
        } else {
            $this->debug(__FUNCTION__, 'strlen(JSONString) == 0');
        }//else len json
    }

    //------------------------------------------------------------------------------
    //internal functions
    //------------------------------------------------------------------------------
    /**
     * Decodes Data from FS20-TX interface
     * @param $data
     */
    private function decode_fs20tx($data)
    {

        //entry for data t0 parent
        //$this->debug(__FUNCTION__,print_r($data,true));
        $db = chr($data['DataByte1']) . chr($data['DataByte2']) . chr($data['DataByte3']);//.chr($data['DataByte4']);
        $dest = chr($data['DestByte1']) . chr($data['DestByte2']) . chr($data['DestByte3']);//.chr($data['DataByte4']);
        $hc = FHZ_helper::bin2four(substr($dest, 0, 3));
        $fs20action = $data['DataByte1'];
        $fs20ext = $data['DataByte2'];
        //$this->debug(__FUNCTION__,"HC $hc,A:$fs20action,E:$fs20ext");
        $action = '(Action=' . FHZ_helper::$fs20_codes[strToHex(chr($fs20action))];
        if ($fs20action > 31) $action .= ' Timer:' . FHZ_helper::fs20_times($fs20ext);
        $action .= ') ';

        $text = sprintf('TX: BC=%d, Prot=%s,HC:%s(Src=%s),Data=%s %s', $data['ByteCount'], $data['Protocol'], $hc, strToHex($dest), strToHex($db), $action);
        $this->debug(__FUNCTION__, $text);
        $this->debuglog('FS20TX:'.$text);

    }
    //------------------------------------------------------------------------------
    /**
     * Decodes Data from FS20-RX interface
     * @param $data
     */
    private function decode_fs20rx($data)
    {

        //entry for data t0 parent
        $db = chr($data['DataByte1']) . chr($data['DataByte2']) . chr($data['DataByte3']) . chr($data['DataByte4']);
        $dest = chr($data['SrcsByte1']) . chr($data['SrcsByte2']) . chr($data['SrcsByte3']) . chr($data['DataByte4']);
        $action = '(Action=' . FHZ_helper::$fs20_codes[strToHex($db[0])];
        if (ord($db[0]) > 31) $action .= ' Timer:' . FHZ_helper::fs20_times($db[1]);
        $action .= ') ';
        $hc = FHZ_helper::bin2four(substr($dest, 0, 3));
        $text = sprintf('RX: BC=%d, Prot=%s,Dev=%s,DevB=%d,HC:%s(Src=%s),Data=%s %s', $data['ByteCount'], $data['Protocol'], $data['Device'], $data['DeviceByte'], $hc, strToHex($dest), strToHex($db), $action);
        $this->debug(__FUNCTION__, $text);
        $this->debuglog('FS20RX:'.$text);

    }
    
    //------------------------------------------------------------------------------
    //--------helper functions ---------------
    //------------------------------------------------------------------------------
    /**
     * Log an debug message
     * PHP modules cannot enter data to debug window,use messages instead
     * @param $topic
     * @param $data
     */
    private function debug($topic, $data)
    {
        $data = "(ID #$this->InstanceID) $topic ::" . $data;
        if ($this->isDebug()) {
            IPS_LogMessage(__CLASS__, $data);

        }
    }

    //------------------------------------------------------------------------------
    /**
     * check if debug is enabled
     * @return bool
     */
    private function isDebug()
    {
        $debug = @IPS_GetProperty($this->InstanceID, 'Debug');
        return ($debug === true);
    }
    //--------------------------------------------------------
    /**
     * Log Debug to its own file
     * @param $data
     */
    public function debuglog($data)
    {
        if (!$this->isDebug()) return;
        $fname = $this->DEBUGLOG;
        $o = @fopen($fname, "a");
        if (!$o) {
            $this->debug(__FUNCTION__, 'Cannot open ' . $fname);
            return;
        }
        fwrite($o, $data . "\n");
        fclose($o);
    }
}//class
