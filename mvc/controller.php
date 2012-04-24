<?php
class DOController
{
	private static $controller 		= null;
	private static $controllerEvent = null;
	private static $models			= array();
	function DOController(){}
	function GetController()
	{
		if( !self::$controller )
		{
			if( self::LoadController() )
			{
				$ctrClass = 'DO'.ucwords(DORouter::$controller);
				self::$controller = new $ctrClass();
			}
			else
			{//curd automate
				self::AutoCurd(DORouter::$controller,DORouter::$action,$_POST);
				exit();
			}
		}
		return self::$controller;
	}
	function GetControllerEvent()
	{
		if( !self::$controllerEvent )
		{
			if( self::LoadControllerEvent() )
			{
				$ctrClass = 'DO'.ucwords(DORouter::$controller).'Event';
				self::$controllerEvent = new $ctrClass();
			}
		}
		return self::$controllerEvent;
					
	}
	function LoadController( )
	{
		$path  = APPBASE.DS.DORouter::$module.DS.DORouter::$controller.".php";
		if(file_exists( $path ))
		{
			include $path;
			return true;
		}
		return false;
	}
	function LoadControllerEvent()
	{
		$path  = EVTBASE.DS.DORouter::$module.DS.DORouter::$controller.".php";
		if(file_exists( $path ))
		{
			include $path;
			return true;
		}
		return false;
		
	}
	/** Auto curd handler **/
	public function AutoCurd($action,$model,array $posts = null)
	{
		if(!!$posts && false !== ($modelObj = DOFactory::GetModel('#__'.$model)))
		{
			if($posts['__token'] != DOBase::GetToken())
			{
				DOUri::Redirect($posts['__redirect'],DOLang::Get(
						'Unvalid token'
					),0
				);
			}
			$action = ucwords(strtolower($action));
			$ins    = $modelObj->$action($posts);
			switch($action)
			{
				case 'Create':
					if(!$ins->insert_id)
					{
						$flag	= 0;
						$msg 	= DOLang::Get($modelObj->CreateMsgFail);
						$detail	= $modelObj->error_msg;
					}
					else
					{
						$flag	= 1;
						$msg	= DOLang::Get($modelObj->CreateMsgSuccess);
					}
				break;

				case 'Update':
						$msg	= DOLang::Get($modelObj->UpdateMsgSuccess);
				break;
				
				case 'Delete':
					if(!$ins->affect_rows)
					{
						$flag	= 0;
						$msg 	= DOLang::Get($modelObj->DeleteMsgFail);
						$detail	= $modelObj->error_msg;
					}	
					else 
					{
						$flag	= 1;
						$msg 	= DOLang::Get($modelObj->DeleteMsgSuccess);
					}
				break;
			}
			/** Is it an ajax request? **/
			if($posts['__ajax'])
			{
				$json = DOFactory::GetTool('json');
				/** Response json data **/
				exit($json->encode(
					array('flag'=>$flag,'msg'=>$msg,'errors'=>$detail)		
				));
			}
			/** Or redirect **/
			DOUri::Redirect($posts['__redirect'],$msg,$flag);
		}	
		else
		{
			$request = DOFactory::GetTool('http.request');
			$msg	 = $request->Get('__DOMSG','cookie');
			if(!empty($msg))
			{
				echo $msg;
				setcookie('__DOMSG'		,'',time()-180);
				setcookie('__DOMSG_TYPE','',time()-180);
			}	
		}
		return false;
	}
	/**
	 * load view
	 *
	 */
	function Display( $view = 'default',array $variables = null)
	{
		$action   	= preg_replace('#Action$#i','',DORouter::$action);
		if(empty($view))
		{//when $view set as null,we would include tpl file which name as action.
			$view = $action;
		}
		if(!!$variables)
		{//what variables we want to pass to tpl 
			extract($variables);
		}
		$layout     = APPBASE.DS.DORouter::$module.DS.'view'.DS.DORouter::$controller.DS.$view.'.php';
		include_once $layout;
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
			$path = APPBASE.DS.DORouter::$module
					. DS
					. 'model'
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
	/**
	 * call model's method which function name's prefixs were 'get'
	 *
	 * @param String $method
	 * @param Array $params
	 * @return 
	 */
	function Get( $method )
	{
		$model 	= DORouter::$controller;
		$model	= strtolower($model);
		if(!self::$models[$model])
		{
			//set model
			self::$models[$model] 	 = self::GetModel();
		}
		$m = "Get".ucwords(strtolower($method));
		if(method_exists(self::$models[$model],$m))
		{
			$args = func_get_args();
			array_unshift($args);
			return call_user_func_array(array(self::$models[$model],$m),$args);
		}
		return false;
	}
	
	function __destruct()
	{
		#DOSession::end();
	}
}
?>
