<?
/**
 * @file
 *
 * MQTT Publisher IPSymcon PHP IO Module Class
 * uses IPSphpMQTT.php
 *
 * @author Thomas Dressler
 * @copyright Thomas Dressler 2016
 * @version 4.1.2
 * @date 2016-10-23
 */

include_once(__DIR__ . "/../module_helper.php");
include_once(__DIR__ . "/IPSphpMQTT.php");

/** @class MQTTPUB
 *
 * %MQTTPUB  IPSymcon PHP IO Module Class
 */
class MQTTPUB extends T2DModule
{
    //------------------------------------------------------------------------------
    //module const and vars
    //------------------------------------------------------------------------------
    /**
     * MQTT QOS constant "At Most once" (Fire and forget)
     * Used here for publishing, no need to take care
     * @see http://www.hivemq.com/blog/mqtt-essentials-part-6-mqtt-quality-of-service-levels
     */
    const MQTT_QOS_0_AT_MOST_ONCE=0;


    /**
     * Fieldlist for Logging
     */
    private $fieldlist = array("TS","VariableID","VariableType","VariableUpdated","VariableChanged","Value","Path");

    /**
     * MQTT QOS setting
     * set to QOS=0 because we are publisher only
     * @var int $qos
     */
    private $qos=self::MQTT_QOS_0_AT_MOST_ONCE;
    /**
     * MQTT Retain setting
     * @var boolean $retained
     */
    private $retained=false;



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
        $this->RegisterPropertyInteger('Port', 1883);
        $this->RegisterPropertyString('Host', 'mqttbroker');
        $this->RegisterPropertyString('Topic', 'IPS/status/%varid%/%varident%/%path%');
        $this->RegisterPropertyString('ClientID', 'symcon');
        $this->RegisterPropertyString('LogFile', '');
        $this->RegisterPropertyString('User', '');
        $this->RegisterPropertyString('Password', '');
        $this->RegisterPropertyBoolean('Debug', false);
        $this->RegisterPropertyBoolean('Active', false);
        $this->RegisterPropertyString('Subscriptions', json_encode(array()));
        $this->RegisterPropertyInteger('MsgID', 0);

        /* workaround for persistent MsgIDs */

        $vid=$this->RegisterVariableInteger('MsgID', 'MessageID', '' );
        IPS_SetHidden($vid,true);

        //register status msg
        $this->RegisterMessage(0, self::IPS_KERNELMESSAGE );
    }//function

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
        $this->RegisterMessage(0, self::IPS_KERNELMESSAGE );
        // Diese Zeile nicht loeschen
        parent::ApplyChanges();
        if ($this->isActive()) {
            $this->SetStatus(self::ST_AKTIV);
            $this->Register_All();
        } else {
            $this->SetStatus(self::ST_INACTIV);
            $this->Unregister_All();
        }
    }

    ///--------------------------------------------------------
    //Get/Set
    //--------------------------------------------------------

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
     * Get Property logfile name
     * @return string
     */
    private function GetHost()
    {
        return (String)IPS_GetProperty($this->InstanceID, 'Host');
    }

    //------------------------------------------------------------------------------
    /**
     * Get Property Port
     * @return int
     */
    private function GetPort()
    {
        return (Integer)IPS_GetProperty($this->InstanceID, 'Port');
    }

    //------------------------------------------------------------------------------
    /**
     * Get Property Port
     * @return string
     */
    private function GetClientID()
    {
        $clientid=(String)IPS_GetProperty($this->InstanceID, 'ClientID');
        $clientid.="@".gethostname();
        return $clientid;
    }

    //------------------------------------------------------------------------------
    /**
     * Get Property Topic
     * @return string
     */
    private function GetTopic()
    {
        return (String)IPS_GetProperty($this->InstanceID, 'Topic');
    }

    //------------------------------------------------------------------------------
    /**
     * Get Property Username
     * @return string
     */
    private function GetUser()
    {
        $user=(String)IPS_GetProperty($this->InstanceID, 'User');
        return $user;
    }
    //------------------------------------------------------------------------------
    /**
     * Get Property Password
     * @return string
     */
    private function GetPassword()
    {
        $user=(String)IPS_GetProperty($this->InstanceID, 'Password');
        return $user;
    }
    //------------------------------------------------------------------------------
    /**
     * Get Property Subscription
     * @return array known registered variable IDs
     */
    private function GetSubscriptions()
    {
        $prop=(String)IPS_GetProperty($this->InstanceID, 'Subscriptions');
        $data=(array)json_decode($prop);
        $subs=array();
        foreach ($data as $id) {
            $subs[$id]=1;
        }
        $this->debug(__FUNCTION__, 'know '.count($data).' subscribed IDs');
        return $subs;
    }

    //------------------------------------------------------------------------------
    /**
     * Set Property Subscription
     * @param  array $subs registered variable IDs to save
     */
    private function SetSubscriptions($subs)
    {
        $data=array_unique(array_keys($subs));
        $prop=json_encode($data);
        IPS_SetProperty($this->InstanceID, 'Subscriptions',$prop);
        $this->debug(__FUNCTION__, count($data).' subscribed IDs stored');
        IPS_ApplyChanges($this->InstanceID);
    }

    //------------------------------------------------------------------------------
    /**
     * retrieves next message id
     * @return int
     */
    private function GetNextMsgID (){

        /*
        $msgid=($this->GetBuffer('MsgID')?(integer)$this->GetBuffer('MsgID'):0);
        $msgid+=1;
        $this->SetBuffer('MsgID',(string)$msgid);
        */

        $vid = @$this->GetIDForIdent('MsgID');
        $msgid=GetValueInteger($vid);
        $msgid+=1;
        SetValueInteger($vid,$msgid);
        return $msgid;
    }
    //------------------------------------------------------------------------------
    //---Events
    //------------------------------------------------------------------------------

    /**
     * Handle Message Events
     * will be called from IPS message loop for registered objects and events
     *
     * @param int $TimeStamp Timestamp of Event (looks not filled)
     * @param int $SenderID related object ID
     * @param int $Message related Message ID
     * @param array $Data Payload (content depends on Message ID)
     *
     *  @see https://www.symcon.de/service/dokumentation/entwicklerbereich/sdk-tools/sdk-php/nachrichten/
     */
    public function MessageSink($TimeStamp, $SenderID, $Message, $Data) {
        $this->debug(__FUNCTION__,"entered");
        $id=$SenderID;
        $this->debug(__FUNCTION__, "TS: $TimeStamp SenderID ".$SenderID." with MessageID ".$Message." Data: ".print_r($Data, true));
        switch ($Message) {
            case self::VM_UPDATE:
                $this->Publish($id,$Data);
                break;
            case self::VM_DELETE:
                $this->UnSubscribe($id);
                break;
            case self::IPS_KERNELMESSAGE:
                $kmsg=$Data[0];
                switch ($kmsg) {
                    case self::KR_READY:
                        IPS_LogMessage(__CLASS__,__FUNCTION__." KR_Ready ->register()");
                        $this->Register_All();
                        break;
                    case self::KR_UNINIT:
                        /* not working :( */
                        $msgid=$this->GetBuffer("MsgID");
                        IPS_SetProperty($this->InstanceID,'MsgID',(Integer)$msgid);
                        IPS_ApplyChanges($this->InstanceID);
                        IPS_LogMessage(__CLASS__,__FUNCTION__." KR_UNINIT ->disconnect()");
                        break;
                    default:
                        IPS_LogMessage(__CLASS__,__FUNCTION__." Kernelmessage unhahndled, ID".$kmsg);
                        break;
                }

            default:
                IPS_LogMessage(__CLASS__,__FUNCTION__." Unknown Message $Message");
                break;
        }
        $this->debug(__FUNCTION__,"leaved");

    }

    //------------------------------------------------------------------------------
    //device functions
    //------------------------------------------------------------------------------


    //------------------------------------------------------------------------------
    //Data Interfaces
    //------------------------------------------------------------------------------


    //------------------------------------------------------------------------------
    //public functions
    //------------------------------------------------------------------------------

    //------------------------------------------------------------------------------
    /**
     * Subscribe variables by ID
     * @param int $id variable ID to subscribe
     */
    public function Subscribe($id)
    {
        $this->debug(__FUNCTION__,"entered for ID ".$id);
        $subs=$this->GetSubscriptions();
        if (IPS_VariableExists($id)) {
            $this->RegisterMessage($id, self::VM_UPDATE );
            $this->RegisterMessage($id, self::VM_DELETE );
            if (! isset($subs[$id])) {
                $subs[$id] = 1;
                $this->SetSubscriptions($subs);
                $this->debug(__FUNCTION__,"Variable ($id) subscribed");
            }else{
                $this->debug(__FUNCTION__,"Variable ($id) already subscribed");
            }
        }else{
            $this->debug(__FUNCTION__,"ID ($id) is not a variable");
        }
        $this->debug(__FUNCTION__,"leaved");
    }

    //------------------------------------------------------------------------------
    /**
     * Subscribe all variables below Parent ID
     * @param int $id subscribe all variables below this object id
     */
    public function Subscribe_All(int $id)
    {
        $this->debug(__FUNCTION__,"starting with ID ".$id);
        if (IPS_VariableExists($id)) {
            $this->Subscribe($id);
        }

        if (IPS_HasChildren($id)) {
            $childs=@IPS_GetChildrenIDs($id);
            foreach ($childs as $child ) {
                $this->debug(__FUNCTION__,"found Child ID ".$child);
                $this->Subscribe_All($child); //rekursiv call
            }

        }
        $this->debug(__FUNCTION__,"leaved");
    }
    //------------------------------------------------------------------------------
    /**
     * UnSubscribe variables by ID
     * @param int $id variable ID to unsubscribe
     */
    public function UnSubscribe(int $id)
    {

        $this->debug(__FUNCTION__,"entered for ID ".$id);
        $this->UnRegister($id );
        //rewrite properties
        $subs=$this->GetSubscriptions();
        if (isset($subs[$id])) {
            unset ($subs[$id]);
            $this->SetSubscriptions($subs);
        }else{
            $this->debug(__FUNCTION__,"ID $id was not subscribed");
        }
        $this->debug(__FUNCTION__,"leaved");
    }

    //------------------------------------------------------------------------------
    /**
     * UnSubscribe variables below parent ID
     * @param int $id Unsubscribe all below object id
     */
    public function UnSubscribe_All(int $id)
    {
        $this->debug(__FUNCTION__,"starting with ID ".$id);
        if (IPS_VariableExists($id)) {
            $this->UnSubscribe($id);
        }
        if (IPS_HasChildren($id)) {
            $childs=@IPS_GetChildrenIDs($id);
            foreach ($childs as $child ) {
                $this->debug(__FUNCTION__," found Child ID".$child);
                $this->UnSubscribe_All($child); //rekursiv call
            }
        }
        $this->debug(__FUNCTION__,"leaved");
    }
    //------------------------------------------------------------------------------
    /**
     * Publish data of a variable to MQTT
     * @param int $id Variable ID
     */
    public function Publish(int $id)
    {
        $this->debug(__FUNCTION__,"entered for ID ".$id);

        $data=array();
        if (IPS_VariableExists($id)) {
            $val=GetValue($id);
            $var=IPS_GetVariable($id);
            $obj=IPS_GetObject($id);
            $ident=$obj['ObjectIdent'];
            $name=$obj['ObjectName'];
            if (!$ident) $ident=$name;
            $path=$this->create_path(IPS_GetParent($id));
            $path=$path.$name;
            $data['Path']=$path;
            $data['VariableID']=$id;
            $data['VariableType']=$var['VariableType'];
            $data['VariableUpdated']=$var['VariableUpdated'];
            $data['VariableChanged']=$var['VariableChanged'];
            $data['VariableIdent']=$ident;
            $data['UTF8Value']=utf8_encode($val);
            $data['TS']=time();
            $payload=json_encode($data);
            $path=str_replace(array(" "),"_",$path);
            $topic=$this->GetTopic();
            $topic=str_replace("%varid%",$id,$topic);
            $topic=str_replace("%varident%",$ident,$topic);
            $topic=str_replace("%path%",$path,$topic);
            $this->debug(__FUNCTION__,$topic." = ".$payload);
            $this->mqtt_publish($topic,$payload,$id);
            $this->log_data($data);
        }else{
            $this->debug(__FUNCTION__,"Variable ($id) not found");
        }
        $this->debug(__FUNCTION__,"leaved");
    }
    //------------------------------------------------------------------------------
    //internal functions
    //------------------------------------------------------------------------------
    /* maybe obsolete
    private function AdjustID(){
        $msgid=IPS_GetProperty($this->InstanceID,'MsgID');
        $buffer=($this->GetBuffer('MsgID')?(integer)$this->GetBuffer('MsgID'):0);
        if ($buffer>$msgid) {
            IPS_SetProperty($this->InstanceID,'MsgID',$buffer);
        }else{
            $this->SetBuffer('MsgID',(string)$msgid);
        }

    }
    */
    /**
     * register all known variable message subscriptions
     */
    private function Register_All()
    {
        $this->debug(__FUNCTION__, 'entered');
            $subs = $this->GetSubscriptions();
            foreach ($subs as $id => $value) {
                $this->Register($id);
            }
        $this->debug(__FUNCTION__,"leaved");
    }
    /**
     * register all known variable message subscriptions
     * @param int $id VariableID to register
     */
    private function Register($id)
    {
        $this->debug(__FUNCTION__, 'entered for ID '.$id);
        if (IPS_VariableExists($id)){
            $this->debug(__FUNCTION__, 'register '.$id);
            $this->RegisterMessage($id, self::VM_UPDATE);
            $this->RegisterMessage($id, self::VM_DELETE);;
        }else{
            $this->debug(__FUNCTION__,"Variable ($id) not found");
        }
        $this->debug(__FUNCTION__,"leaved");
    }
    //------------------------------------------------------------------------------
    /**
     * unregister a variable message subscriptions
     * @param int $id VariableID to unregister
     */
    private function UnRegister($id)
    {
        $this->debug(__FUNCTION__, 'entered');
        if (IPS_VariableExists($id)){
                $this->debug(__FUNCTION__, 'unregister '.$id);
                $this->UnRegisterMessage($id, self::VM_UPDATE);
                $this->UnRegisterMessage($id, self::VM_DELETE);;
        }else{
            $this->debug(__FUNCTION__,"Variable ($id) not found");
        }
        $this->debug(__FUNCTION__,"leaved");
    }

    //------------------------------------------------------------------------------
    /**
     * unregister all known variable message subscriptions
     */
    private function Unregister_All()
    {
        $this->debug(__FUNCTION__, 'entered');
        $subs = $this->GetSubscriptions();
        foreach ($subs as $id => $value) {
            $this->UnRegister($id );
        }
        $this->debug(__FUNCTION__,"leaved");
    }
    //------------------------------------------------------------------------------
    /**
     * Create the Category Path
     *
     * @param int $id ObjectID to start
     * @return string
     */
    private function create_path ($id) {
        $this->debug(__FUNCTION__,"entered for ID $id");
        $path='';
        do {

            $obj=IPS_GetObject($id);
            $name=$obj['ObjectName'];
            $path=$name."/".$path;
            $id=IPS_GetParent($id);

        } while ($id>0);
        $this->debug(__FUNCTION__,"Path=".$path);
        return $path;
    }


    //------------------------------------------------------------------------------
    /**
     * Log data to file
     * @param array $data Variable Data
     */
    private function log_data($data)
    {
        //standard log)
        $this->debug(__FUNCTION__,"entered");
        $fname = $this->GetLogFile();
        if ($fname > '') $this->log2file($fname, $data);
        $this->debug(__FUNCTION__,"leaved");
    }//function

    //--------------------------------------------------------
    /**
     * Log data to file
     * @param String $fname Filename to log
     * @param array $data Variable Data
     */
    private function log2file($fname, $data)
    {
        $this->debug(__FUNCTION__,"entered");
        if ($fname == '') return;
        $this->debug(__FUNCTION__, 'write to file:' . $fname);
        $exists = file_exists($fname);
        $o = @fopen($fname, "a");
        if (!$o) {
            IPS_LogMessage(__CLASS__, __FUNCTION__ . '::Cannot open ' . $fname);
            $this->debug(__FUNCTION__, 'Cannot open ' . $fname);
            return;
        }
        $header = implode(";", $this->fieldlist);
        if (!$exists) {
            $this->debug(__FUNCTION__, 'write header to New file');
            fwrite($o, $header . "\r\n");
        } //if exists

        $line = '';
        for ($f = 0; $f < count($this->fieldlist); $f++) {
            $field = $this->fieldlist[$f];
            if (isset($data[$field])) {
                $val = $data[$field];
                $line .= $val;
                //$this->debug(__FUNCTION__,"Field: $field, Val: $val");
            }
            $line .= ";";
        }//for
        $line .= "\r\n";
        fwrite($o, $line);
        fclose($o);
        $this->debug(__FUNCTION__,"leaved");
    }//function
    #--------------------------------------------------------


    #--------------------------------------------------------
    /**
     * Publish a message to the broker
     * @param   string $topic   the topic you wish to publish on e.g. temperature/spain
     * @param   string $content the message string to be published
     * @param  int $objectID related object
     */

    private function mqtt_publish($topic, $content, $objectID)
    {
        $this->debug(__FUNCTION__,"entered with topic '$topic'");
        $host=$this->GetHost();
        $port=$this->GetPort();
        $clientid=$this->GetClientID();
        $qos=$this->qos;
        $retained=$this->retained;
        $username=$this->GetUser();
        $password=$this->GetPassword();
        $mqtt = new IPSphpMQTT($host, $port, $clientid);
        $this->print_mqtt_debug($mqtt,$objectID);
        if ($mqtt -> connect(true,null,$username,$password)) {
            $this->print_mqtt_debug($mqtt,$objectID);
            $msgid=$this->GetNextMsgID();
            $this->debug(__FUNCTION__,"Connected to $host:$port ClientID $clientid");
            $mqtt->msgid=$msgid;
            $mqtt -> publish($topic, $content, $qos, $retained);
            $mqtt -> close();
            $this->print_mqtt_debug($mqtt,$objectID);
        }else{
            IPS_LogMessage(__CLASS__,__FUNCTION__."::Connect to $host:$port with ClientID $clientid failed");
            $this->debug(__FUNCTION__,"Connect to $host:$port with ClientID $clientid failed");
        }
        $this->debug(__FUNCTION__,"leaved");

    }

    #--------------------------------------------------------
    /**
     * print collected phpmqtt class debug messages
     * @param  IPSphpMqtt $mqtt IPSphpMQTT object
     * @param int $objectID related Object
     */
    private function print_mqtt_debug($mqtt,$objectID) {
        if (! is_array($mqtt->debugmsg)) return;
        while (count ($mqtt->debugmsg)>0) {
            $msg=array_shift($mqtt->debugmsg);
            $this->debug('IPSphpMQTT',"($objectID)->$msg");
        }
    }

}//class
