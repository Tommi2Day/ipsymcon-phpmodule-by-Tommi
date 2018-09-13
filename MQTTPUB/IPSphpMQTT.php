<?php
/**
 * @file
 *
 * modified phpMQTT class
 *
 * @author Blue Rhinos Consulting, modified by Thomas Dressler
 * @copyright 2010 Blue Rhinos Consulting | Andrew Milsted
 * @copyright Thomas Dressler 2016-2018
 * @version 5.0.2
 * @date 2018-09-13
 */

/*
 	phpMQTT
	A simple php class to connect/publish/subscribe to an MQTT broker
*/
/*
	Licence

	Copyright (c) 2010 Blue Rhinos Consulting | Andrew Milsted
	andrew@bluerhinos.co.uk | http://www.bluerhinos.co.uk

	Permission is hereby granted, free of charge, to any person obtaining a copy
	of this software and associated documentation files (the "Software"), to deal
	in the Software without restriction, including without limitation the rights
	to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
	copies of the Software, and to permit persons to whom the Software is
	furnished to do so, subject to the following conditions:

	The above copyright notice and this permission notice shall be included in
	all copies or substantial portions of the Software.

	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
	THE SOFTWARE.

*/

/**
 * @class IPSphpMQTT
 *  based on phpMQTT class
 *  modified for running with Symcon (http://www.symcon.de)
 *
 */
class IPSphpMQTT {

    /**
     * Socket handler
     * @var object $socket
     */
    private $socket =null;
    /**
     * counter for message id
     * @var int $msgid
     */
    public $msgid = 1;
    /**
     * default keepalive timer
     * @var int $keepalive
     */
    public $keepalive = 10;
    /**
     * host unix time, used to detect disconects
     * @var int $timesinceping
     */
    public $timesinceping;
    /**
     * used to store currently subscribed topics
     * @var array $topics
     */
    public $topics = array();
    /**
     * debug flag
     * @var bool $debug
     */
    public $debug = false;
    /**
     * broker address
     * @var string $address
     */
    public $address;
    /**
     * broker port
     * @var int $port
     */
    public $port;
    /**
     * client id sent to brocker
     * @var string $clientid
     */
    public $clientid;
    /**
     * stores the will of the client
     * @var string $will
     */
    public $will;
    /**
     * stores username
     * @var string $username
     */
    private $username;
    /**
     * stores password
     * @var string $password
     */
    private $password;
    /**
     * store debug messages for IPS
     * @var array $debugmsg
     */
    public $debugmsg=array();

    /**
     * IPSphpMQTT constructor.
     * @param string $address Broker IP/Hostname
     * @param int $port Broker Port
     * @param string $clientid  Client ID for broker
     */
    public function __construct($address, $port, $clientid){
        $this->broker($address, $port, $clientid);
        $this->debugmsg=array();
    }

    /**
     * keep debug messages to retrieve from IPS module
     * @param $func string
     * @param $msg string
     */
    public function debugtxt($func,$msg) {
        array_push($this->debugmsg,$func."::".$msg);
    }

    /**
     * set broker details
     * @param string $address Broker IP/Hostname
     * @param int $port Broker Port
     * @param string $clientid  Client ID for broker
     */
    private function broker($address, $port, $clientid){
        $this->address = $address;
        $this->port = $port;
        $this->clientid = $clientid;
    }

    /**
     * Auto connect function
     * @param bool $clean should the client send a clean session flag
     * @param string $will Last will
     * @param string $username Broker Username (if needed)
     * @param string $password Broker Password (if needed)
     * @return bool success
     */
    public function connect_auto($clean = true, $will = NULL, $username = NULL, $password = NULL){
        while($this->connect($clean, $will, $username, $password)==false){
            sleep(10);
        }
        return true;
    }

    /**
     * connects to the broker
     * @param bool $clean should the client send a clean session flag
     * @param string $will Last will
     * @param string $username Broker Username (if needed)
     * @param string $password Broker Password (if needed)
     * @return bool
     */
    public function connect($clean = true, $will = NULL, $username = NULL, $password = NULL){

        $msg=" Clean:".($clean?'True':'false');
        $msg.=" Will:".($will?$will:'NONE');
        $msg.=" User:".($username?$username:'not set');
        $msg.=" Password:".($password?$password:'not set');
        $this->debugtxt(__FUNCTION__,"Connect entered,". $msg);
        if($will) $this->will = $will;
        if($username) $this->username = $username;
        if($password) $this->password = $password;

        $address = gethostbyname($this->address);
        $this->debugtxt(__FUNCTION__,"Connect to: ". $address. ":".$this->port);
        $this->socket = fsockopen($address, $this->port, $errno, $errstr, 60);

        if (!$this->socket ) {
            IPS_LogMessage(__CLASS__,__FUNCTION__.":: fsockopen($address,$this->port) failed: $errno, $errstr");
            $this->debugtxt(__FUNCTION__,"fsockopen($address,$this->port) failed: $errno, $errstr");
            return false;
        }

        stream_set_timeout($this->socket, 5);
        stream_set_blocking($this->socket, 0);

        $i = 0;
        $buffer = "";

        $buffer .= chr(0x00); $i++;
        $buffer .= chr(0x06); $i++;
        $buffer .= chr(0x4d); $i++;
        $buffer .= chr(0x51); $i++;
        $buffer .= chr(0x49); $i++;
        $buffer .= chr(0x73); $i++;
        $buffer .= chr(0x64); $i++;
        $buffer .= chr(0x70); $i++;
        $buffer .= chr(0x03); $i++;

        //No Will
        $var = 0;
        if($clean) $var+=2;

        //Add will info to header
        if($this->will != NULL){
            $var += 4; // Set will flag
            $var += ($this->will['qos'] << 3); //Set will qos
            if($this->will['retain'])	$var += 32; //Set will retain
        }

        if($this->username != NULL) $var += 128;	//Add username to header
        if($this->password != NULL) $var += 64;	//Add password to header

        $buffer .= chr($var); $i++;

        //Keep alive
        $buffer .= chr($this->keepalive >> 8); $i++;
        $buffer .= chr($this->keepalive & 0xff); $i++;

        $buffer .= $this->strwritestring($this->clientid,$i);

        //Adding will to payload
        if($this->will != NULL){
            $buffer .= $this->strwritestring($this->will['topic'],$i);
            $buffer .= $this->strwritestring($this->will['content'],$i);
        }

        if($this->username) $buffer .= $this->strwritestring($this->username,$i);
        if($this->password) $buffer .= $this->strwritestring($this->password,$i);

        $head = "  ";
        $head{0} = chr(0x10);
        $head{1} = chr($i);

        fwrite($this->socket, $head, 2);
        fwrite($this->socket,  $buffer);

        $string = $this->read(4);
        if (!$string) {
            IPS_LogMessage(__CLASS__,__FUNCTION__.": Connection failed! No Data");
            $this->debugtxt(__FUNCTION__,"Connection failed! No Data");
            return false;
        }
        if(ord($string{0})>>4 == 2 && $string{3} == chr(0)){
            $this->debugtxt(__FUNCTION__,"Connected to Brocker");
        }else{
            IPS_LogMessage(__CLASS__,__FUNCTION__.":: ".sprintf("Connection failed! (Error: 0x%02x 0x%02x)\n",
                    ord($string{0}),ord($string{3})));
            $this->debugtxt(__FUNCTION__,
                sprintf("Connection failed! (Error: 0x%02x 0x%02x)\n",ord($string{0}),ord($string{3})));
            return false;
        }

        $this->timesinceping = time();

        return true;
    }

    /* r */
    /**
     * ead: reads in so many bytes
     * @param int $int Bytes to read
     * @param bool $nb NonBlocking flag
     * @return string
     */
    private function read($int = 8192, $nb = false){

        //	print_r(socket_get_status($this->socket));

        $string="";
        $togo = $int;

        if($nb){
            return fread($this->socket, $togo);
        }

        while (!feof($this->socket) && $togo>0) {
            $fread = fread($this->socket, $togo);
            $string .= $fread;
            $togo = $int - strlen($string);
        }
        return $string;
    }

    /**
     * subscribes to topics
     * @param array $topics Array with topics to subscribe
     * @param int $qos QOS setting (0,1 or 2)
     * @return string
     */

    public function subscribe($topics, $qos = 0){
        $this->debugtxt(__FUNCTION__, "entered with qos=$qos");
        $i = 0;
        $buffer = "";
        $id = $this->msgid;
        $buffer .= chr($id >> 8);  $i++;
        $buffer .= chr($id % 256);  $i++;

        foreach($topics as $key => $topic){
            $this->debugtxt(__FUNCTION__, "subscribe topic:$topic");
            $buffer .= $this->strwritestring($key,$i);
            $buffer .= chr($topic["qos"]);  $i++;
            $this->topics[$key] = $topic;
        }

        $cmd = 0x80;
        //$qos
        $cmd +=	($qos << 1);
        $head = chr($cmd);
        $head .= chr($i);

        fwrite($this->socket, $head, 2);
        fwrite($this->socket, $buffer, $i);
        $string = $this->read(2);

        $bytes = ord(substr($string,1,1));
        $string = $this->read($bytes);
        $this->debugtxt(__FUNCTION__, "leaved");
        return $string;
    }

    /**
     * sends a keep alive ping
     */
    private function ping(){
        $head = chr(0xc0);
        $head .= chr(0x00);
        fwrite($this->socket, $head, 2);
        $this->debugtxt(__FUNCTION__, "Ping executed");
    }

    /**
     * sends a proper disconect cmd
     */
    public function disconnect(){
        $head = " ";
        $head{0} = chr(0xe0);
        $head{1} = chr(0x00);
        fwrite($this->socket, $head, 2);
        $this->debugtxt(__FUNCTION__, "disconnected");
    }

    /**
     * sends a proper disconect, then closes the socket
     */
    public function close(){
        $this->disconnect();
        fclose($this->socket);
        $this->debugtxt(__FUNCTION__, "Connection closed");
    }

    /**
     * publishes $content on a $topic
     * @param string $topic Topic to publish
     * @param string $content Content to publish
     * @param int $qos QOS to publish(0,1,2)
     * @param int $retain
     */
    function publish($topic, $content, $qos = 0, $retain = 0){

        $this->debugtxt(__FUNCTION__,"entered, topic: $topic,qos:$qos,retain:$retain");
        $i = 0;
        $buffer = "";

        $buffer .= $this->strwritestring($topic,$i);

        //$buffer .= $this->strwritestring($content,$i);

        if($qos){
            $id = $this->msgid++;
            $buffer .= chr($id >> 8);  $i++;
            $buffer .= chr($id % 256);  $i++;
        }

        $buffer .= $content;
        $i+=strlen($content);


        $head = " ";
        $cmd = 0x30;
        if($qos) $cmd += $qos << 1;
        if($retain) $cmd += 1;

        $head{0} = chr($cmd);
        $head .= $this->setmsglength($i);

        fwrite($this->socket, $head, strlen($head));
        fwrite($this->socket, $buffer, $i);
        $this->debugtxt(__FUNCTION__, "msg ID ".$this->msgid." with topic '$topic' published($i bytes)");

    }


    /**
     * processes a recieved topic
     * @param string $msg Received Message
     */
    private function message($msg){
        $tlen = (ord($msg{0})<<8) + ord($msg{1});
        $topic = substr($msg,2,$tlen);
        $msg = substr($msg,($tlen+2));
        $found = 0;
        $this->debugtxt(__FUNCTION__, "msg with topic '$topic' recieved");
        foreach($this->topics as $key=>$top){
            if( preg_match("/^".str_replace("#",".*",
                    str_replace("+","[^\/]*",
                        str_replace("/","\/",
                            str_replace("$",'\$',
                                $key))))."$/",$topic) ){
                if(is_callable($top['function'])){
                    call_user_func($top['function'],$topic,$msg);
                    $found = 1;
                }
            }
        }

        if(!$found)
            $this->debugtxt(__FUNCTION__, "msg recieved but no match in subscriptions");
    }

    /**
     * the processing loop for an "allways on" client
     * @param boolean $loop boolean set true when you are doing other stuff in the loop good for watching something else at the same time
     * @return boolean
     */
    public function proc( $loop = true){

        if(1){
            //$sockets = array($this->socket);
            $w = null;
            $e = null;
            //$cmd = 0;

            //$byte = fgetc($this->socket);
            if(feof($this->socket)){

                $this->debugtxt(__FUNCTION__, "eof receive going to reconnect for good measure");
                fclose($this->socket);
                $this->connect_auto(false);
                if(count($this->topics))
                    $this->subscribe($this->topics);
            }

            $byte = $this->read(1, true);
            if(!strlen($byte)){
                if($loop){
                    usleep(100000);
                }
            }else{
                $cmd = (int)(ord($byte)/16);
                $this->debugtxt(__FUNCTION__, "Recevid: $cmd");

                $multiplier = 1;
                $value = 0;
                do{
                    $digit = ord($this->read(1));
                    $value += ($digit & 127) * $multiplier;
                    $multiplier *= 128;
                }while (($digit & 128) != 0);

                $this->debugtxt(__FUNCTION__, "::Fetching: $value");
                $string='';
                if($value)
                    $string = $this->read($value,"fetch");

                if($cmd){
                    switch($cmd){
                        case 3:
                            $this->message($string);
                            break;
                    }

                    $this->timesinceping = time();
                }
            }

            if($this->timesinceping < (time() - $this->keepalive )){
                $this->debugtxt(__FUNCTION__, "not found something so ping");
                $this->ping();
            }


            if($this->timesinceping<(time()-($this->keepalive*2))){
                $this->debugtxt(__FUNCTION__, "not seen a package in a while, disconnecting");
                fclose($this->socket);
                $this->connect_auto(false);
                if(count($this->topics))
                    $this->subscribe($this->topics);
            }

        }
        return 1;
    }

    /**
     * getmsglength
     * @param string $msg String to check
     * @param int $i in/out current position
     * @return int
     */
    private function getmsglength(&$msg, &$i){

        $multiplier = 1;
        $value = 0 ;
        do{
            $digit = ord($msg{$i});
            $value += ($digit & 127) * $multiplier;
            $multiplier *= 128;
            $i++;
        }while (($digit & 128) != 0);
        $this->debugtxt(__FUNCTION__, "Len=$value");
        return $value;
    }


    /**
     * setmsglength
     * @param $len int
     * @return string
     */
    private function setmsglength($len){
        $this->debugtxt(__FUNCTION__, "Len=$len");
        $string = "";
        do{
            $digit = $len % 128;
            $len = $len >> 7;
            // if there are more digits to encode, set the top bit of this digit
            if ( $len > 0 )
                $digit = ($digit | 0x80);
            $string .= chr($digit);
        }while ( $len > 0 );
        return $string;
    }

    /* strwritestring: writes a string to a buffer */
    /**
     * @param $str string
     * @param  $i int in/out position
     * @return string
     */
    private function strwritestring($str, &$i){
        $len = strlen($str);
        $msb = $len >> 8;
        $lsb = $len % 256;
        $ret = chr($msb);
        $ret .= chr($lsb);
        $ret .= $str;
        $i += ($len+2);
        return $ret;
    }

    /**
     * printstr to debug
     * @param $string
     */
    private function printstr($string){
        $strlen = strlen($string);
        for($j=0;$j<$strlen;$j++){
            $num = ord($string{$j});
            if($num > 31)
                $chr = $string{$j}; else $chr = " ";
            $this->debugtxt(__FUNCTION__, sprintf("%4d: %08b : 0x%02x : %s ",$j,$num,$num,$chr));
        }
    }
}