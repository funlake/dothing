<?php
class DOController
{
	private static $controller 		= null;
	private static $controllerEvent = null;
	private static $models			= array();
	function DOController(){}
	/**
	** Get current controller according to recent URI
	** This method would invoked after DORouter::Prepare()
	**/
	public static function GetController()
	{
		if( !self::$controller )
		{
			if( self::LoadController() )
			{
				$ctrClass = 'DOController'.ucwords(DORouter::$controller);
				self::$controller = new $ctrClass();
			}
			else if(DORouter::$module === 'autocrud')
			{//curd automate
				self::AutoCrud(DORouter::$controller
							  ,DORouter::$action
							  ,array_merge($_REQUEST,$_FILES)
				);
				exit();
			}
			else
			{
				throw new DORouterException("Unknown module", 404);
			}
		}
		return self::$controller;
	}
	public static function GetControllerEvent()
	{
		if( !self::$controllerEvent )
		{
			if( self::LoadControllerEvent() )
			{
				$ctrClass = 'DOEvent'.ucwords(DORouter::$controller);
				self::$controllerEvent = new $ctrClass();
			}
		}
		return self::$controllerEvent;
					
	}
	public static function LoadController( )
	{
		$path  = APPBASE.DS.DORouter::GetModule()
						.DS.DORouter::GetController().".php";

		if(file_exists( $path ))
		{
			include $path;
			return true;
		}
		return false;
	}
	public static function LoadControllerEvent()
	{
		$path  = self::GetPath('event').DS.DORouter::GetController().".php";
		if(file_exists( $path ))
		{
			include $path;
			return true;
		}
		return false;
		
	}
	/** Auto curd handler **/
	public static function AutoCrud($action,$model,array $posts = null)
	{
		$action = ucwords(strtolower($action));
		if(/*!!$posts && */false !== ($modelObj = DOFactory::GetModel('#__'.$model)))
		{
			if(!method_exists($modelObj, $action))
			{
				throw new DORouterException("Unknown controller::action", 404);
			}
			if( !in_array($action,array('Select','Delete')) && ($posts['__token'] != DOBase::GetToken() || empty($posts['__token']) ) )
			{
				throw new DORouterException("Invalid token",102);
			}
			$action = ucwords(strtolower($action));
			/** 
			*** We didn't prepare events for crud call generally
			*** Unless user create dir crud/event/ and create events files
			 **/
			DOHook::TriggerEvent(
				array(
				    'beforeRequest' => array($posts)
				)
			);
			$ins    = $modelObj->$action($posts);
			switch($action)
			{
				case 'Add':
					if(!$ins->success)
					{
						$flag	= 0;
						$msg 	= DOLang::Get($modelObj->addMsgFail);
						$detail	= $modelObj->error_msg;
					}
					else
					{
						$flag	= 1;
						$msg	= DOLang::Get($modelObj->addMsgSuccess);
						$detail	= $modelObj->info_msg;
						DOHook::TriggerEvent(
							array(
							    'afterRequest' => array($ins,$posts)
							)
						);
					}
				break;

				case 'Update':
						if(!$ins->success)
						{
							$flag	= 0;
							$msg 	= DOLang::Get($modelObj->updateMsgFail);
							$detail	= $modelObj->error_msg;
						}
						else
						{
							$flag   = 1;
							$msg	= DOLang::Get($modelObj->updateMsgSuccess);
							$detail	= $modelObj->info_msg;
							DOHook::TriggerEvent(
								array(
								    'afterRequest' => array($ins,$posts)
								)
							);
						}
				break;
				
				case 'Delete':
					if(!$ins->success)
					{
						$flag	= 0;
						$msg 	= DOLang::Get($modelObj->deleteMsgFail);
						$detail	= $modelObj->error_msg;
					}	
					else 
					{
						$flag	= 1;
						$msg 	= DOLang::Get($modelObj->deleteMsgSuccess);
						DOHook::TriggerEvent(
							array(
							    'afterRequest' => array($ins,$posts)
							)
						);
					}
				break;

				case 'Select':
				case 'Find'  :
						DOHook::TriggerEvent(
							array(
							    'afterRequest' => array($ins,$posts)
							)
						);
				break;
				default:
					return;
				break;
			}
			/** Is it an ajax request? **/
			if($posts['__ajax'])
			{
				$json = DOFactory::GetJson();
				/** Response json data **/
				echo $json->encode(
					array('flag'=>$flag,'msg'=>$msg,'detail'=>$detail)		
				);
			}
			/** Or redirect **/
			else if(!empty($posts['__redirect'])) 
			{
				if(!empty($detail))
				{
					$detail = "(<i>{$detail}</i>)";
				}
				$msg = empty($msg) ? $detail : $msg.$detail;
				DOUri::Redirect($posts['__redirect'],$msg,$flag);
			}
			/** REST call ? **/
			else
			{
				$json = DOFactory::GetJson();
				echo $posts['callback']."(".$json->encode($ins).")";
			}
			return;
		}	
		throw new DORouterException("Unknown controller::action", 404);
	}

	public function AutoAccess($format,$args = array())
	{
		list($action,$model) = explode('.',$format);
		ob_start();
		self::AutoCrud($action,$model,$args);
		$json = DOFactory::GetJson();
		return $json->decode(trim(ob_get_clean(),'()'));
	}
	/**
	 * load view
	 *
	 */
	function Display( $view = 'default',array $variables = null)
	{
		$action   	= preg_replace('#Action$#i','',DORouter::$action);
		if(empty($view))
		{//When $view set as null,we would include tpl file which's name as action.
			$view = $action;
		}
		//Mobile view?
		if($mobileView)
		{
			$view .= "_mobile";
		}
		$layout     = APPBASE.DS.DORouter::$module
					 .DS.'view'
					 .DS.DORouter::$controller
					 .DS.'layout.'.$view.'.php';
		if(!file_exists($layout))
		{
			throw new Exception("{$layout} is not exists!");
		}
		//include_once $layout;
		echo DOTemplate::ParseHtml($layout,$variables);
	}
	/**
	 * load model object
	 *
	 * @return unknown
	 */
	function GetModel( $model = '')
	{
		if(!$model) $model = DORouter::$controller;
		$model	= strtolower($model);
		if(!self::$models[$model])
		{
			//Model path
			$path = self::GetPath('model')
					. DS
					. $model.'.php' ;
			if( file_exists( $path ))
			{
				include_once $path;
				$model = "DOModel".ucwords($model);
				if( class_exists( $model ))
				{
					self::$models[$model] = new $model();
				}
			}
			else self::$models[$model] = null;
		}
		return self::$models[$model];
	}

	public static function GetModuleRoot()
	{
		return APPBASE.DS.DORouter::$module;
	}

	public static function GetPath($dir)
	{
		return self::GetModuleRoot().DS.$dir;
	}
	
	function __destruct()
	{
		#DOSession::end();
	}
}