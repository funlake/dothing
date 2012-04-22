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
	/**
	 * load view
	 *
	 */
	function Display( $view = 'default')
	{
		$action   	= preg_replace('#Action$#i','',DORouter::$action);
		$layout     = APPBASE.DS.DORouter::$module.DS.'view'.DS.$action.DS.$view.'.php';
		@include_once $layout;
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
	function ListAction()
	{
		
	}
	function AddAction()
	{
		
	}
	function EditAction()
	{
		
	}
	function DeleteAction()
	{
		
	}
	function SaveAction()
	{
		$_POST = filter::process( $_POST );
		
		switch( $_POST['task'] )
		{
			case 'add':
			break;
		}
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
