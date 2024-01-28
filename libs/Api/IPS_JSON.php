<?php

/**
 * @file
 * 
* Mapper class for IP-Symcon JSON API
* 
*  @author Thomas Dressler
*  @copyright Thomas Dressler 2013-2019
*  @version 5.1
*  @date 2019-05-04
*/

/** @class IPS_JSON
 *
 * IPSymcon JSON API wrapper class
 * @throws Exception (disabled by default)
 *
 * @version 7.0
 * @date 2024-01-24
 *
 *  Descriptions :
 * @see https://www.tdressler.net/ipsymcon/jsonapi.html
 * @see https://www.symcon.de/service/dokumentation/entwicklerbereich/datenaustausch/
 * @see https://www.symcon.de/service/dokumentation/komponenten/verwaltungskonsole/
 *
 * // ips methods used in this class via _call (to make ide happy)
 * @method IPS_GetObject(int $id)
 * @method IPS_VariableExists(int $id)
 * @method IPS_GetVariable(int $id)
 * @method IPS_GetVariableProfile($profilename)
 * @method GetValue(int $id)
 * @method IPS_ScriptExists(int $id)
 * @method IPS_GetScript(int $id)
 * @method IPS_RunScriptWait(int $script_id)
 * @method IPS_GetKernelVersion()
 * @method IPS_InstanceExists(int $id)
 * @method IPS_GetInstance(int $id)
 * @method FS20_SwitchMode(int $id, bool $switch)
 */
class IPS_JSON {
	/** 
	 * URL to reach IPSymcon
	 *
	 * @var string $url
	 */
    private string $url;
	/**
	 * API Username (Lizenz-Benutzername e.g. Email)
	 * @see http://www.ip-symcon.de/service/dokumentation/komponenten/verwaltungskonsole/
	 *
	 * @var string $user
	 * 
	
	 */
	private string $user;
	/**
	 *API Password (Fernzugriff Kennword)
	 *
	 *@var string $password
	 */
	private string $password;
	/**
	 * last Error
	 * 
	 *	@var array of string $password
	 *
	 *	$error=array('message'=>$message,'code'=>$code)
	 *	@param string $message
	 *	@param int $code
	 */
    private array $error=array();
	/**
	 * last called method
	 * @var String $method
	 */
    private string $method;
	/**
	 * should throw an Exception in case of error
	 * @var Boolean $exception_flag
	 */
	private bool $exception_flag;
	
	/**
	 * IPS Variable Types
	 *
	 * @var array of String $exception_flag
	 *
	 * matches IPS Variable API type return codes to API type field names ("ValueXYZ")
	 */
	private array $ips_vartypes=array(0=>'ValueBoolean',
		   1=>'Valueint',
		   2=>'ValueFloat',
		   3=>'ValueString',
		   4=>'ValueArray',
		   5=>'Valuemixed');


	/**
	 * return $ips_vartypes
	 * @return array
	 *
	*/	   
	public function get_ips_vartypes(): array
    {
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
    function __construct(string $url, string $user, string $password, bool $exception_flag=false) {
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
    public function getErrorMessage(): string
    {
	if (isset($this->error["message"])) {
            return $this->error["message"];
        }
		return '';
   }

   /**
    * retrieves last called method
    * @return string
    */
   public function getMethod(): string
   {
    return $this->method;
   }
   
   /**
    * check if an error occured
    * @return bool
    */
   public function isError(): bool
   {
	return isset($this->error["message"]) && !empty($this->error["message"]);
   }
   
   /**
    * set error variable
    *
    * @param string $message Error Message
    */
   private function setError(string $message): void
   {
	$this->error['message'] = $message;
   }

   /**
    * retrieves name of object
    *
    * @param int $id IPS Object-ID
    * @return string
    */
   private function get_object_name(int $id): string
   {
       $obj=$this->IPS_GetObject($id);
       //print_r($obj);
       if (!$obj) {
           $this->setError("IPS_GetObject Request failed:".$this->getErrorMessage());
           return '';
       }
       #query object detail
       $name=$obj["ObjectName"];
       //name should not have spaces
       if ($name) {
           $name=preg_replace('/\s+/','/_/',$name);
       }else{
           $name='Value';
       }
         return $name;
   }
	/**
	 * retrieves IPS Variable details
	 *
	 * @param int $id IPS Variable-ID
	 * @return ?array
	 * 	Assoc Array mit Value(value), Type(type), Name(name),Last Update(last), Suffix(suffix),Digits(digits) vom Profile
	 */ 
	public function get_var(int $id): ?array
    {
	$res=$this->IPS_VariableExists($id);
	if (is_null($res)) {
	    $error=$this->getErrorMessage();
	    $this->setError("IPS_VariableExists Request failed:".$error);
		return null;
	}
	if (!$res) {
	    $this->setError( "Variable $id doesnt exist");
		return null;
	}
	//print $version;
	$name=$this->get_object_name($id);
    if ($name== '') {
        return null;
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
	// $typname=$this->ips_vartypes[$type];
	$res=$this->GetValue($id);
	
	
	//last update time
	$last=(int)$var["VariableUpdated"];
	
	//retrieve suffix and digits from profile
	$suffix='';
    $digits=0;
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
	 * @return ?array
	 * 	Assoc Array mit Last Execution Time(last), ScriptName(name), FileName(file), Broken(is_broken)
	 */
	public function get_script(int $id): ?array
    {
	$res=$this->IPS_ScriptExists($id);
	if (is_null($res)) {
	    $error=$this->getErrorMessage();
	    $this->setError("IPS_ScriptExists Request failed:".$error);
		return null;
	}
	if (!$res) {
	    $this->setError( "Script $id doesnt exist");
		return null;
	}
	
	#query object detail
	$name=$this->get_object_name($id);
    if ($name== '') {
        return null;
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
        return array('last'=>$last,'name'=>$name,'file'=>$file,'is_broken'=>$is_broken);

	}

   /**
    * main function (class autoloader)
    * 
    * called if a method with a given name doesn't exist
    * will catch method name and translate into api call
    *
    * @param string $name method
    * @param mixed $arguments
    * @return mixed|null result of called function
    * @throws Exception
    */
   public function __call(string $name, mixed $arguments): mixed{
	$this->error=array();
	$this->method=$name;
	$rpc = Array(
         "jsonrpc" => "2.0",
         "method" => $name,
         "params" => $arguments,
         "id" => "null"
	);
   
	array_walk_recursive($rpc, function(&$item){
	    if ( is_string($item) ) $item = mb_convert_encoding($item, 'UTF-8', 'ISO-8859-1');
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
	array_walk_recursive($result, function(&$item){
	    if ( is_string($item) )
		$item = mb_convert_encoding($item, 'ISO-8859-1', 'UTF-8');
	});
	
	if(isset($result['error'])) {
	    $this->error=$result['error'];
	    if ($this->exception_flag) throw new Exception($this->error['message'],$this->error['code']);
		return null;
	}
	return $result['result'];		
   
   }//call
  
}//class

