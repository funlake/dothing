<?php
namespace Dothing\Lib;
use \Dothing\Lib\Router;
use \Dothing\Lib\Factory;
use \Dothing\Lib\Hook;
use \Dothing\Lib\Lang;
class Controller
{
	private static $controller 		= null;
	private static $controllerEvent = null;
	private static $models			= array();
	function DOController(){}
	/**
	** Get current controller according to recent URI
	** This method would invoked after Router::Prepare()
	**/
	public static function GetController()
	{
		if( !self::$controller )
		{
			$app = "\Application\Modules\\".ucwords(Router::GetModule())."\\".ucwords(Router::GetController());
			if( self::LoadController() )
			{
				//$ctrClass = 'DOController'.ucwords(Router::$controller);
				self::$controller = new $app();
			}
			else if(Router::$module === 'autocrud')
			{//curd automate
				self::AutoCrud(Router::$controller
							  ,Router::$action
							  ,array_merge($_GET,$_POST,$_FILES)
				);
				exit();
			}
			else
			{
				throw new \Dothing\Lib\Exception("Unknown module", 404);
			}
		}
		return self::$controller;
	}
	public static function GetControllerEvent()
	{
		$evt = "\Application\Modules\\".ucwords(Router::GetModule())."\Event\\".ucwords(Router::GetController());
		if( !self::$controllerEvent )
		{
			if( self::LoadControllerEvent() )
			{
				//$ctrClass = 'DOEvent'.ucwords(Router::$controller);
				self::$controllerEvent = new $evt();
			}
		}
		return self::$controllerEvent;
					
	}
	public static function LoadController( )
	{
		$path  = APPBASE.DS.Router::GetModule()
						.DS.Router::GetController().".php";

		if(file_exists( $path ))
		{
			include $path;
			return true;
		}
		return false;
	}
	public static function LoadControllerEvent()
	{
		$path  = self::GetPath('event').DS.Router::GetController().".php";
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

		if(/*!!$posts && */false !== ($modelObj = Factory::GetModel('#__'.$model)))
		{
			if(!method_exists($modelObj, $action))
			{
				throw new RouterException("Unknown controller::action", 404);
			}

			if( !in_array($action,array('Select','Delete') )) 
			{
				if($posts['__token'] != \Dothing\Lib\Base::GetToken() && !isset($posts['_no_token']))
				{
					throw new RouterException("Invalid token",102);
				}
			}
			$action = ucwords(strtolower($action));
			/** 
			*** We didn't prepare events for crud call generally
			*** Unless user create dir crud/event/ and create events files
			 **/
			Hook::TriggerEvent(
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
						$msg 	= Lang::Get($modelObj->addMsgFail);
						$detail	= $modelObj->error_msg;
					}
					else
					{
						$flag	= 1;
						$msg	= Lang::Get($modelObj->addMsgSuccess);
						$detail	= $modelObj->info_msg;
						Hook::TriggerEvent(
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
							$msg 	= Lang::Get($modelObj->updateMsgFail);
							$detail	= $modelObj->error_msg;
						}
						else
						{
							$flag   = 1;
							$msg	= Lang::Get($modelObj->updateMsgSuccess);
							$detail	= $modelObj->info_msg;
							Hook::TriggerEvent(
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
						$msg 	= Lang::Get($modelObj->deleteMsgFail);
						$detail	= $modelObj->error_msg;
					}	
					else 
					{
						$flag	= 1;
						$msg 	= Lang::Get($modelObj->deleteMsgSuccess);
						Hook::TriggerEvent(
							array(
							    'afterRequest' => array($ins,$posts)
							)
						);
					}
				break;

				case 'Select':
				case 'Find'  :
						Hook::TriggerEvent(
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
				$json = Factory::GetJson();
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
				Uri::Redirect($posts['__redirect'],$msg,$flag);
			}
			/** REST call ? **/
			else
			{
				$json = Factory::GetJson();
				echo $posts['callback']."(".$json->encode($ins).")";
			}
			return;
		}	
		throw new RouterException("Unknown controller::action", 404);
	}

	public function AutoAccess($format,$args = array())
	{
		list($action,$model) = explode('.',$format);
		ob_start();
		self::AutoCrud($action,$model,$args);
		$json = Factory::GetJson();
		return $json->decode(trim(ob_get_clean(),'()'));
	}
	/**
	 * load view
	 *
	 */
	function Display( $view = 'default',array $variables = null)
	{
		$action   	= preg_replace('#Action$#i','',Router::$action);
		if(empty($view))
		{//When $view set as null,we would include tpl file which's name as action.
			$view = $action;
		}
		// //Mobile view?
		// if($mobileView)
		// {
		// 	$view .= "_mobile";
		// }
		$layout     = APPBASE.DS.Router::$module
					 .DS.'view'
					 .DS.Router::$controller
					 .DS.$view.DO_TEMPLATE_EXT;

		if(!file_exists($layout))
		{
			throw new \Dothing\Lib\Exception("{$layout} is not exists!");
		}

		$view = new \Dothing\Lib\View();

		$view->Display($layout,$variables);
	}
	/**
	 * load model object
	 *
	 * @return unknown
	 */
	function GetModel( $model = '')
	{
		if(!$model) $model = Router::$controller;
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
		return APPBASE.DS.Router::$module;
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