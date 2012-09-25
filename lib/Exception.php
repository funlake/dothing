<?php 
/**
 * Exception handler,basically copied from ZendFrameWork.
 * @ajusted by lake
 *
 */
class DOException extends Exception
{
	/** All message we want to display finally**/
	public static $msg  = array();
	public static $item = 0;
	
	public function __construct($message,$code,Exception $previous = null)
	{
		$this->PushMsg($message,(int)$code);
		if(version_compare(PHP_VERSION,'5.3.0','<'))
		{
			$this->_previous = $previous;
			return parent::__construct($message,(int)$code);	
		}	
		return parent::__construct($message,(int)$code,$previous);
	}
	/**Push the messages into message array each throw **/
	public function PushMsg($message,$code='')
	{
		self::$msg[self::$item]['msg'] 	= $message;
		self::$msg[self::$item]['file'] = $this->getFile();
		self::$msg[self::$item]['line'] = $this->getLine();
		self::$msg[self::$item]['trace']= $this->getTrace();
		self::$item++;	
	}
	public function __call($mtd,$params=null)
	{
		if('getprevious' == strtolower($mtd))
		{
			return $this->_getPrevious();
		}
		return null;
	}
	public function __toString()
	{
		if(version_compare(PHP_VERSION,'5.3.0','<'))
		{
			if(null !== ($e = $this->getPrevious()))
			{
				return $e->__toString()."Next\r\n".parent::__toString();
			}
		}
		return parent::__toString();
	}

	public function _getPrevious()
	{
		return $this->_previous;
	}

	public function _getMessage()
	{
		return self::$msg;
	}
}
?>