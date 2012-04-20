<?php
class DOController extends DOBase
{
	private static $controller 		= null;
	private static $controllerEvent = null;
	private static $models			= array();
	function DOController()
	{
		parent::__construct();

		$this->_init(parent::get('backend'));
		//set app root
		$this->set('cpath' ,SYSTEM_ROOT		.	DS
						   .(parent::get('backend') ? parent::get('backend').DS : '')
						   .'app'	.	DS
						   .$this->module);
		
		//filter
		
		//DOFactory::get('com',array('http_request'));
		//$_POST = DORequest::filter( $_POST );
		//$_GET  = DORequest::filter( $_GET );
		//print_r($_POST);
	}
	
	function _init($backend=''){}
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
		$layout     = APPBASE.DS.DORouter::$module.DS.'layout'.DS.$action.DS.$view.'.php';
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
	function listAction()
	{
		
	}
	function addAction()
	{
		
	}
	function editAction()
	{
		
	}
	function deleteAction()
	{
		
	}
	function saveAction()
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
	function get($method,$params = array())
	{
		if(!$this->model)
		{
			//set model
			$this->model 	 = $this->loadModel();
		}
		$m = "get".ucwords($method);
		if(method_exists($this->model,$m))
		{
			return call_user_func_array(array($this->model,$m),$params);
		}
		return false;
	}
	
	function getPath( $path )
	{
		return parent::get('cpath') . DS . $path;
	}

	function initExtJs()
	{
		$this->dataHandler = & DOFactory::get('extjs',array('data'));
		$this->extWidget   = & DOFactory::get('extjs',array('widget'));
	}	
	function __destruct()
	{
		#DOSession::end();
	}
}
?>
