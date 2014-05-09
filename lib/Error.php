<?php 
namespace Dothing\Lib;
/**
 * Error handler
 * @author lake
 *
 */
class Error
{
	/** Error messages container **/
	public static $_errorMsg;
	
	public function __construct()
	{
	}
	public static function Capture($errorNo,$errorString,$file,$line)
	{
		switch( $errorNo )
		{
			case E_RECOVERABLE_ERROR:
			case E_USER_ERROR:
				self::ErrorHandler($errorString, $file, $line);
			break;
			
			case E_WARNING:
			case E_USER_WARNING:
				self::WarningHandler($errorString, $file, $line);
			break;
			
			case E_DEPRECATED:
			case E_USER_DEPRECATED:
				self::DepreatedHandler($errorString, $file, $line);
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
		if(!strncasecmp($msg,'[###',1))
		{
			preg_match('~\[###([^#]+)###\]((?:(?!//detail:).)*)(//detail:(.*)$)?~is', $msg,$m);
			return self::CustomHandler($m[1],$m[2], $file, $line);
		}
		self::$_errorMsg['doerror_error'][] = array(
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
		if(!strncasecmp($msg,'[###',1))
		{
			preg_match('~\[###([^#]+)###\]((?:(?!//detail:).)*)(//detail:(.*)$)?~is', $msg,$m);
			return self::CustomHandler($m[1],$m[2],@$m[4],$file, $line);
		}
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
	public static function CustomHandler( $key,$msg,$detail ,$file,$line)
	{
		self::$_errorMsg['doerror_'.$key][] = array(
				'msg' 		=> $msg
			   ,'file'		=> $file
			   ,'line'		=> $line
			   ,'detail'    => $detail
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
	/**
	 * Trigger user level error.
	 * @param string $type  //Type of errors,e.g. mysql,file,dom... anything we can customize.
	 * @param string $msg   //Main error messages
	 * @param string $detail//Error details
	 * @param string $level //Error level,those E_NOTICE,E_USER_WARNING stuff
	 */
	public static function Trigger($type,$msg,$detail,$level)
	{
		trigger_error('[###'.$type.'###]'
					  .$msg.(!empty($detail) ? '//detail:'.$detail : '')
					  ,$level);
	}
	/**
	 * Push into session array
	 */
	public function __destruct()
	{
		/** Dont save if refresh debug page **/
		if(\Dothing\Lib\Router::$module !== 'debug')
		{
			/** Save in session,we'd better close custom error handler in live enviroment **/
			//$sess = DOFactory::GetSession();
			//print_r(self::$_errorMsg);
			//$sess->Set('DO_Errorinfo',self::$_errorMsg);
		}
	}
}
?>