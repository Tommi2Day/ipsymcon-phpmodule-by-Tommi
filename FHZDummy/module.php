<?
/**
 * @file
 *
 * Dummy Module for FHZ compatibility functions
 *
 *  @author Thomas Dressler
 *  @copyright Thomas Dressler 2011-2015
 *  @version 4.0
 *  @date 2015-11-21
 */
/** @class FHZDummy
 *
 * IPSymcon PHP Module Class
 * @throws none
 *
 *  @version 1.1
 *  @date 2015-12-29
 *
 *  Descriptions :
 *  @see http://www.tdressler.net/ipsymcon/fhzdummy.html
 *  @see https://www.symcon.de/service/dokumentation/entwicklerbereich/sdk-tools/sdk-php/
 *  @see http://www.ip-symcon.de/service/dokumentation/komponenten/verwaltungskonsole/
 *
 */
    class FHZDummy extends IPSModule {
        /**
         * @var string
         */
    	public $name='FHZDummy';
        /**
         * Parent Guid (IIPSSendFHZ)
         * (not used yet)
         * @var string
         */
 			protected $parent_guid='{122F60FB-BE1B-4CAB-A427-2613E4C82CBA}';
        /**
         * Child guid (IIPSReceiveFHZ)
         * (not used yet)
         * @var String
         */
 			protected $child_guid='{DF4F0170-1C5F-4250-840C-FB5B67262530}';
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
         *
         * @param $JSONString
         */
        //Data interface to childs
        public function ForwardData($JSONString)
        {
            // Empfangene Daten von der Device Instanz
            //IPS_LogMessage($this->name, "Forward:".$JSONString);
            $this->outlog("Forward:".$JSONString);
            $this->SendDataToParent($JSONString);
        }

        /**
         * Receive Data from Parent(IO)
         *
         * @param $JSONString
         * @return bool
         */
        //Data interface from parent
        public function ReceiveData($JSONString)
        {

            //IPS_LogMessage($this->name, "ReceiveData:".$JSONString);
            $this->outlog("ReceiveData:".$JSONString);
        	$this->SendDataToChildren($JSONString);
            return true;
        }

        /**
         * Send Data to Parent(IO)
         * (will only log, not forward)
         * @param $data
         * @return bool
         */
        protected function SendDataToParent($JSONString)
        {
            //IPS_LogMessage($this->name, "SendDataToParent:".$JSONString);
            $this->outlog("SendDataToParent:".$JSONString);
            //IPS_SendDataToParent($this->InstanceID, $JSONString);
            return true;
        }
        /**
         * legacy IIPSReceiveFHZ (FHZ->Device)
         * (procedure ReceiveFHZData(Data: TFHZDataRX); stdcall;)
         *
         * @param $data
         *
         */
        public function ReceiveFHZData($data) {
            // dummy
        }

        /**
         * legacy IIPSSendFHZ (Device->FHZ)
         * (procedure SendFHZData(Data: TFHZDataTX; NumBytes: Byte); stdcall;)
         *
         * @param $data
         * @param $NumBytes
         */
        public function SendFHZData($data,$NumBytes) {
            //dummy
        }

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
                if (IPS_SemaphoreEnter($this->name ."-".$resource, 1))
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
            IPS_SemaphoreLeave($this->name ."-". $resource);
        }

        /**
         * Log to file
         * @param $data
         */
        private function outlog($data)
        {
            $logfile=$this->ReadPropertyString('LogFile');
            if ($logfile=='') return;
            $datum=date('Y-m-d H:i:s');
            try{
                $this->SemEnter($logfile);
                $log=fopen($logfile,'a+');
                if ($log) {
                    fwrite($log,$datum." ".$data."\n");
                    fclose($log);

                }
            }catch (Exception $e){
                IPS_Logmessage($this->name, 'Log exception: ',  $e->getMessage());
            }
            $this->SemLeave($logfile);
        }
}
?>