<?php 
/**
 * Error handler
 * @author lake
 *
 */
class DOError
{
	/** Error messages container **/
	private static $__errorMsg;
	
	public static function InLog($errorNo,$errorString,$file,$line)
	{
		switch( $errorNo )
		{
			case E_CORE_ERROR:
			case E_COMPILE_ERROR:
			case E_USER_ERROR:
				self::ErrorHandler($errorString, $file, $line);
			break;
			
			case E_CORE_WARNING:
			case E_COMPILE_WARNING:
			case E_USER_WARNING:
				self::WarningHandler($errorString, $file, $line);
			break;
			
			case E_DEPRECATED:
			case E_USER_DEPRECATED:
				self::DepreatedHandler($errorString, $file, $line);
			break;
			
			case E_PARSE:
				self::ParsedHandler($errorString, $file, $line);
			break;
			
			case E_STRICT:
				self::StrictHandler($errorString, $file, $line);
			break;
			
			case E_NOTICE:
			case E_USER_NOTICE:
				self::NoticeHandler($errorString, $file, $line);
			break;
			
			default :
				self::CustomHandler($errorString,$file,$line);
			break;
		}	
	}
	/**
	 * Fatal error handler
	 */
	public static function ErrorHandler( $msg ,$file,$line)
	{
		self::$_errorMsg['doerror_fatalerror'][] = array(
				'msg' 	=> $msg
			   ,'file'	=> $file
			   ,'line'	=> $line	
		);
	}
	/**
	 * Warning handler
	 */
	public static function WarningHandler( $msg ,$file,$line)
	{
		self::$_errorMsg['doerror_warning'][] = array(
				'msg' 	=> $msg
			   ,'file'	=> $file
			   ,'line'	=> $line	
		);
	}
	/**
	 * Notice handler
	 */
	public static function NoticeHandler( $msg,$file,$line )
	{
		self::$_errorMsg['doerror_notice'][] = array(
				'msg' 	=> $msg
			   ,'file'	=> $file
			   ,'line'	=> $line	
		);
	}
	
	/**
	 * Custom error handler
	 */
	public static function CustomHandler( $msg ,$file,$line)
	{
		self::$_errorMsg['doerror_custom'][] = array(
				'msg' 	=> $msg
			   ,'file'	=> $file
			   ,'line'	=> $line	
		);
	}
	
	/**
	 * Depreated error handler
	 */
	public static function DepreatedHandler( $msg ,$file,$line)
	{
		self::$_errorMsg['doerror_depreated'][] = array(
				'msg' 	=> $msg
				,'file'	=> $file
				,'line'	=> $line
		);
	}
	
	/**
	 * Parsed error handler
	 */
	public static function ParsedHandler( $msg ,$file,$line)
	{
		self::$_errorMsg['doerror_parsed'][] = array(
				'msg' 	=> $msg
				,'file'	=> $file
				,'line'	=> $line
		);
	}
	
	/**
	 * Strict error handler
	 */
	public static function StrictHandler( $msg ,$file,$line)
	{
		self::$_errorMsg['doerror_strict'][] = array(
				'msg' 	=> $msg
				,'file'	=> $file
				,'line'	=> $line
		);
	}
}
?>