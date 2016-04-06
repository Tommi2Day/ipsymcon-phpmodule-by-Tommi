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

/**
 * common module helper function
 */
include_once(__DIR__ . "/../module_helper.php");
/**
 * fhz/fs20 specific data and functions
 */
include_once(__DIR__ . "/../fhz_helper.php");

/**
 * @class FHZDummy
 *
 *  IPSymcon PHP Splitter Module Class to give FS20Instances an parent if no FHZ is available. 
 *  It decodes incoming Data into IPS_LogMessages
 * 
 * @deprecated
 * 
 * @par Prefix: FHZDummy
 *
 * @par Properties
 *
 *
 * - \b Debug: Flag to enable debug output via IPS_LogMessages
 *
 * @par Actions (if supported by the attached splitter and the physical device)
 *
 * - \b None
 *
 */
class FHZDummy extends T2DModule
{
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
        $json=__DIR__."/module.json";
        parent::__construct($InstanceID,$json);
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
        $this->RegisterPropertyBoolean("Debug", false);
      }
    //--------------------------------------------------------
    /**
     * FHZDummy Destructor
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
                    case $this->module_interfaces['IO-TX']:
                        $buffer = utf8_decode($data['Buffer']);
                        $this->debug(__FUNCTION__, strToHex($buffer));
                        $this->debuglog("IOTX-HEX:".strToHex($buffer));
                        break;
                    case $this->module_interfaces['FS20-TX']: //to FHZ
                        $this->debug(__FUNCTION__, 'FS20-TX');
                        $this->decode_fs20tx($data);
                        if ($this->HasActiveParent())
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
                    case $this->module_interfaces['IO-RX']:
                        $buffer = utf8_decode($data['Buffer']);
                        $this->debug(__FUNCTION__, strToHex($buffer));
                        $this->debuglog("IORX-HEX:".strToHex($buffer));
                        break;
                    case $this->module_interfaces['FS20-RX']:
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
}//class
