<?
/**
 * @file
 *
 * Dummy Module for FHZ compatibility functions
 *
 *  @author Thomas Dressler
 *  @copyright Thomas Dressler 2011-2016
 *  @version 1.2
 *  @date 2016-01-02
 */
/** @class FHZDummy
 *
 * IPSymcon PHP Splitter Module Class
 * @throws none
 *
 *  @version 4.0
 *  @date 2016-01-02
 *
 *  Descriptions :
 *  @see http://www.tdressler.net/ipsymcon/fhzdummy.html
 *  @see https://www.symcon.de/service/dokumentation/entwicklerbereich/sdk-tools/sdk-php/
 *  @see http://www.ip-symcon.de/service/dokumentation/komponenten/verwaltungskonsole/
 *
 */
    class FHZDummy extends IPSModule {
        /**
         * GUID definitions
         * @var array
         */
        private $module_data=array("id"=>"{D3D9FBB6-4739-418B-A910-9B98BAB13E04}", //Modul GUID
                                "name"=> "FHZDummy", //Modul Name
                                "type"=> 2, // Type =splitter
                                "vendor"=> "ELV",
                                "aliases"=> ["FHZDummy"], //display names
                                "parentRequirements"=> ["{79827379-F36E-4ADA-8A95-5F8D1DC92FA9}"], //IO-TX
                                "childRequirements"=> ["{DF4F0170-1C5F-4250-840C-FB5B67262530}"], //FS20-RX
                                "implemented"=> ["{018EF6B5-AB94-40C6-AA53-46943E824ACF}", //VirtIO RX
                                                 "{122F60FB-BE1B-4CAB-A427-2613E4C82CBA}"], //FS20-TX
                                "FS20"=>"{48FCFDC1-11A5-4309-BB0B-A0DB8042A969}", // FS20 Device
                                "FS20-TX"=>"{122F60FB-BE1B-4CAB-A427-2613E4C82CBA}", //from FS20 Device
                                "FS20-RX"=>"{DF4F0170-1C5F-4250-840C-FB5B67262530}", //to FS20 Device
                                "IO-RX"=>"{018EF6B5-AB94-40C6-AA53-46943E824ACF}", //from VirtIO
                                "IO-TX"=>"{79827379-F36E-4ADA-8A95-5F8D1DC92FA9}"); //to VirtIO

        /**
         * FHZDummy constructor.
         * @param $InstanceID
         */
        public function __construct($InstanceID) {
            // Diese Zeile nicht löschen
            parent::__construct($InstanceID);
        }
        /**
         * overwrite internal IPS_Create($id) function
         */
        public function Create() {
            // Diese Zeile nicht löschen.
            parent::Create();
            $this->RegisterPropertyString("LogFile", "");
            $this->RegisterPropertyBoolean("Debug", false);
        }

        /**
         * FHZDummy Destructor
         */
        public function Destroy() {
 			//Save Settings
 			$this->SemLeave('Log');
 			parent::Destroy();
		}

        /**
         * overwrite internal IPS_ApplyChanges($id) function
         */
        public function ApplyChanges() {
            // Diese Zeile nicht loeschen
            parent::ApplyChanges();
        }

        /**
         * Receive Data from Child (Devices)
         * @param string $JSONString
         */
        //Data interface receive from childs
        public function ForwardData($JSONString){
            // decode Data from Device Instanz
            if (strlen($JSONString)> 0) {
                $data = json_decode($JSONString);
                $buffer=$this->decode_child_data($data);
                // forward to I/O Instanz
                if (isset($data->DataID)) {
                    //looks like valid answer, proceed
                    if ($this->HasActiveParent()) {
                        $this->debug("ForwardData","SendToParent:". $this->strToHex($buffer));
                        $this->SendDataToParent(json_encode(
                                array("DataID" => $this->module_data['IO-TX'] ,
                                    "Buffer" => $buffer)
                            )
                        );
                    }
                } else {
                    $this->debug("ForwardData","No DataID supplied");
                }
            }else {
                $this->debug('ForwardData','strlen(JSONString) == 0');
            }
        }
        /**
         * Receive Data from Parent(IO)
         * @param string $JSONString
         */

        //Data interface receive from parent
        public function ReceiveData($JSONString){
            // decode Data from Device Instanz
            if (strlen($JSONString)> 0) {
                // decode Data from IO Instanz
                $data = json_decode($JSONString);
                $buffer=$this->decode_parent_data($data);
                $this->debug("Receive","Forward to Clients:".$buffer);
                // ToDo: forward to Child Instances
            }else {
                $this->debug('ReceiveData','strlen(JSONString) == 0');
            }
        }

        /**
         * decodes the object from Child generated by json_decode
         * and returns the string for the IO Buffer
         * ToDo: do real translation or drop it at all
         * @param object $data
         * @return string
         */
        private function decode_child_data ($data) {
            $text='';
            $buffer='';
            if (is_object($data)) $data=get_object_vars($data);
            foreach ($data as $key=>$value) {
                $text.=$key."=".$data[$key].";";
                $buffer.=chr($data[$key]); //dummy, this will not work
            }
            $this->outlog("DecodeChild",$text);
            return $buffer;
        }

        /**
         * decodes the object from Parent generated by json_decode
         * and returns the Data for the Device
         * ToDo: do real translation or drop it at all
         * @param object $data
         * @return string
         */
        private function decode_parent_data ($data) {
            $buffer='';
            $target='';
            if (is_object($data)) $data=get_object_vars($data);
            if (isset($data->Buffer)) {
                $buffer=$data->Buffer;
                $target=$data->DataID;
            }
            $text="Target:".$target.", Data:".$buffer;
            $this->outlog("DecodeParent",$text);
            return $buffer;
        }

        /**
         * Check if a parent exists and is active
         * @return bool
         */
        private function HasActiveParent()
        {
            $instance = IPS_GetInstance($this->InstanceID);
            if ($instance['ConnectionID'] > 0)
            {
                $parent = IPS_GetInstance($instance['ConnectionID']);
                if ($parent['InstanceStatus'] == 102)
                    return true;
            }
            return false;
        }
        //--------helper functions ---------------

        /**
         * Enter/Lock semaphore
         * @param $resource
         * @return bool
         */
        //emulate delphi crtical section functions
        private function SemEnter($resource)
    	{
            for ($i = 0; $i < 100; $i++)
        	{
                if (IPS_SemaphoreEnter($this->module_data['name'] ."-".$resource, 1))
            	{
                    return true;
            	}
                else
            	{
                IPS_Sleep(mt_rand(1, 3));
            	}
            }
        return false;
        }

        /**
         * Leave/unlock Semaphore
         * @param $resource
         */
        private function SemLeave($resource)
        {
            IPS_SemaphoreLeave($this->module_data['name'] ."-". $resource);
        }

        /**
         * Log to file
         * @param  $topic
         * @param $data
         */
        private function outlog($topic,$data)
        {

            $this->debug($topic,$data);
            $logfile=$this->ReadPropertyString('LogFile');
            if ($logfile=='') return;

            $datum=date('Y-m-d H:i:s');
            $data=$datum." ".$topic." ::".$data;
            try{
                $this->SemEnter($logfile);
                $log=fopen($logfile,'a+');
                if ($log) {
                    fwrite($log,$data."\n");
                    fclose($log);

                }
            }catch (Exception $e){
                $this->debug($topic,'Log exception: '.  $e->getMessage());
            }
            $this->SemLeave($logfile);
        }

        /**
         * Log Debug Messages
         * PHP modules cannot enter data to debug window,use messages instead
         * @param string $topic
         * @param string $data
         */
        private function debug ($topic,$data) {
            $data=$topic."::".$data;
            if ($this->ReadPropertyBoolean('Debug')) {
                IPS_LogMessage($this->module_data['name'],$data);

            }
        }

        /**
         * Make Hex string
         * http://stackoverflow.com/questions/14674834/php-convert-string-to-hex-and-hex-to-string
         * @param $string
         * @return string
         */
        private function strToHex($string){
            $hex = '';
            for ($i=0; $i<strlen($string); $i++){
                $ord = ord($string[$i]);
                $hexCode = dechex($ord);
                $hex .= ' '.substr('0'.$hexCode, -2);
            }
            return strToUpper($hex);
        }
}
?>