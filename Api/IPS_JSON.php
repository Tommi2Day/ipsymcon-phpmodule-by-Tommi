<?php
/**
 * @file
 * 
* Mapper class for IP-Symcon JSON API
* 
*  @author Thomas Dressler
*  @copyright Thomas Dressler 2013-2016
*  @version 4.1
*  @date 2016-05-14
*/
/** @class IPS_JSON
 * 
 * IPSymcon JSON API wrapper class
 * @throws Exception (disabled by default)
 *
 *  @version 4.1
 *  @date 2016-05-11
 *
 *  Descriptions :
 *  @see http://www.tdressler.net/ipsymcon/jsonapi.html
 *  @see http://www.ip-symcon.de/service/dokumentation/entwicklerbereich/datenaustausch/
 *  @see http://www.ip-symcon.de/service/dokumentation/komponenten/verwaltungskonsole/
 *
 */
class IPS_JSON {

	/** 
	 * URL to reach IPSymcon
	 *
	 * @var String $url
	 */
    private $url;
	/**
	 * API Username (Lizenz-Benutzername e.g. Email)
	 * @see http://www.ip-symcon.de/service/dokumentation/komponenten/verwaltungskonsole/
	 *
	 * @var String $user
	 * 
	
	 */
	private $user;
	/**
	 *API Password (Fernzugriff Kennword)
	 *
	 *@var String $password
	 */
	private $password;
	/**
	 * last Error
	 * 
	 *	@var array
	 *
	 *	$error=array('message'=>$message,'code'=>$code)
	 *	@param String $message
	 *	@param Integer $code
	 */
    private $error;
	/**
	 * last called method
	 * @var String $method
	 */
    private $method;
	/**
	 * should throw an Exception in case of error
	 * @var Boolean $exception_flag
	 */
	private $exception_flag;
	
	/**
	 * IPS Variable Types
	 *
	 * @var array
	 *
	 * matches IPS Variable API type return codes to API type field names ("ValueXYZ")
	 */
	private $ips_vartypes=array(0=>'ValueBoolean',
		   1=>'ValueInteger',
		   2=>'ValueFloat',
		   3=>'ValueString',
		   4=>'ValueArray',
		   5=>'ValueVariant');
    
	/**
	 * return $ips_vartypes
	 * @return array
	 *
	*/	   
	public function get_ips_vartypes() {
		return $this->ips_vartypes;
	}
    /**
    * Constructor
    *
    * @param string $url full url to reach ipsymcon json api service
    * @param string $user IPSymcon License Username (e.g. Email)
    * @param string $password IPSymcon "Fernzugriff/Remote Access"-Password
	* @param boolean $exception_flag indicates if aan exception should occur
	* @throws Exception
	*/
    function __construct($url,$user,$password,$exception_flag=false) {
		$this->exception_flag=$exception_flag;
	//json needed, should be standard in IPS2.6 with PHP 5.4
	if ( !function_exists('json_encode') || !function_exists('json_decode'))
	{
		$this->error=array('message' => "PHP Json functions not found", 'code' => '-1');
		if ($this->exception_flag ) throw new Exception($this->error['message'],$this->error['code']);
		return null;
	}
	$this->url = $url;
	$this->user=$user;
	$this->password=$password;
   }
   /**
    * retrieves last error message
    * @return string
    */
    public function getErrorMessage() {
	if (is_array($this->error)) {
            return $this->error["message"];
        }
		return '';
   }
   /**
    * retrieves last error code
    * @return integer
    */
   public function getErrorCode()
   {
	   if (is_array($this->error)) {
		   return (integer)$this->error["code"];
	   }
	   return null;
   }
   /**
    * retrieves last called method
    * @return String
    */
   public function getMethod() {
    return $this->method;
   }
   
   /**
    * check if an error occured
    * @return bool
    */
   public function isError() {
	return is_array($this->error);
   }
   
   /**
    * set error variable
    *
    * @param String $message Error Message
    * @param int $code Error Code
    */
   private function setError($message,$code) {
	$this->error['message'] = $message;
	if (!is_null($code)) {
		$this->error['code'] = (String)$code;	
	}
   }
    
	/**
	 * retrieves IPS Variable details
	 *
	 * @param int $id IPS Variable-ID
	 * @return array
	 * 	Assoc Array mit Value(value), Type(type), Name(name),Last Update(last), Suffix(suffix),Digits(digits) vom Profile
	 */ 
	public function get_var($id) {
	$res=$this->IPS_VariableExists($id);
	if (is_null($res)) {
	    $error=$this->getErrorMessage();
	    $this->setError("IPS_VariableExists Request failed:".$error);
		return null;
	}
	if (!$res) {
	    $this->setError( "Variable $id doesnt exist",'-1');
		return null;
	}
	//print $version;
	$obj=$this->IPS_GetObject($id);
	//print_r($obj);
	if (!$obj) {
		$this->setError("IPS_GetObject Request failed:".$this->getErrorMessage());
		return null;
	}
	#query object detail
	$name=$obj["ObjectName"];
	//name should not have spaces
	if ($name) {
		$name=preg_replace('/\s+/','/_/',$name);
	}else{
		$name='Value';
	}
	$var=$this->IPS_GetVariable($id);
	//print_r($var);
	if (!$var) {
		$this->setError("IPS_GetVariable Request failed:".$this->getErrorMessage());
		return null;
	}
	
	//type aware value retrieving
	$res=null;
	$type=$var["VariableType"];
	$typname=$this->ips_vartypes[$type];
	$res=$this->GetValue($id);
	
	
	//last update time
	$last=(integer)$var["VariableUpdated"];
	
	//retrieve suffix and digits from profile
	$suffix='';
	$profilename=$var['VariableCustomProfile'];
	if (!$profilename) $profilename=$var['VariableProfile'];
	if ($profilename) {
		#query variable profile
		$profile=$this->IPS_GetVariableProfile($profilename);
		if ($profile) {
			$suffix=$profile['Suffix'];
			$digits=$profile['Digits'];
		}
	}
	//prepare return value
	return array('value'=>$res,'type'=>$type,'last'=>$last,'name'=>$name,'suffix'=>$suffix,'digits'=>$digits);
	}
	
	/**
	 * get script details
	 *
	 * @param int $id IPS Script-ID
	 * @return array
	 * 	Assoc Array mit Last Execution Time(last), ScriptName(name), FileName(file), Broken(is_broken)
	 */
	public function get_script($id) {
	$res=$this->IPS_ScriptExists($id);
	if (is_null($res)) {
	    $error=$this->getErrorMessage();
	    $this->setError("IPS_ScriptExists Request failed:".$error);
		return null;
	}
	if (!$res) {
	    $this->setError( "Script $id doesnt exist",'-1');
		return null;
	}
	
	#query object detail
	$obj=$this->IPS_GetObject($id);
	if (!$obj) {
		$this->setError("IPS_GetObject Request failed:".$this->getErrorMessage());
		return null;
	}
	$name=$obj["ObjectName"];
	//name should not have spaces
	if ($name) {
		$name=preg_replace('/\s+/','/_/',$name);
	}else{
		$name='Value';
	}
	
	#query script details
	$var=$this->IPS_GetScript($id);
	if (!$var) {
		$this->setError("IPS_GetScript Request failed:".$this->getErrorMessage());
		return null;
	}
	#update time
	$last=$var['LastExecute'];
	$file=$var['ScriptFile'];
	$is_broken=$var['IsBroken'];
	$data=array('last'=>$last,'name'=>$name,'file'=>$file,'is_broken'=>$is_broken);
	return $data;
	}
   /**
    * main function (class autoloader)
    * 
    * called if a method with a given name doesnt exist
    * will catch method name and translate into api call
    *
    * @param string $name method
    * @param variant $arguments
    * @return  variant result of called function
    * @throws Exception
    */
   public function __call($name, $arguments) {
   
	$this->error=null;
	$this->method=$name;
	$rpc = Array(
         "jsonrpc" => "2.0",
         "method" => $name,
         "params" => $arguments,
         "id" => "null"
	);
   
	array_walk_recursive($rpc, function(&$item, $key){
	    if ( is_string($item) ) $item = utf8_encode($item);
	});
	$content=json_encode($rpc);
	$header=array('Authorization: Basic '. base64_encode($this->user.":".$this->password),
				  'Content-type: application/json; charset=utf-8');
	$result = file_get_contents($this->url, false, stream_context_create(
	    array('http' => array(
		'method'  => 'POST',
	        'header'  => $header,
	        'content' => $content
		)
	    )
	));
	if (!$result) {
	    $this->error=array('message' => "No data returned from ".$this->url, 'code' => '-1');
		if ($this->exception_flag) throw new Exception($this->error['message'],$this->error['code']);
	    return null;
	}
	//decoding needs assoc flag to be compatible with returned IPS arrays
	$result = (array) json_decode($result,true);	
	array_walk_recursive($result, function(&$item, $key){
	    if ( is_string($item) )
		$item = utf8_decode($item);
	});
	
	if(isset($result['error'])) {
	    $this->error=$result['error'];
	    if ($this->exception_flag) throw new Exception($this->error['message'],$this->error['code']);
		return null;
	}
	return $result['result'];		
   
   }//call
  
}//class

