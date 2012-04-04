<?php
class DOController extends DOBase
{
	
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
		
		DOFactory::get('com',array('http_request'));
		$_POST = DORequest::filter( $_POST );
		$_GET  = DORequest::filter( $_GET );
		//print_r($_POST);
	}
	
	function _init($backend='')
	{
		//pass variables
		$this->uri		  = & DOFactory::get('class',array('uri'));

		$this->module	  = $this->uri->getModule();
		$this->controller = $this->uri->getController();
		$this->action     = $this->uri->getAction();
		$this->params	  = $this->uri->getParams();
		//echo $this->controller."|".$this->action."|";
		//$this->appPath    = implode('.',array(DO_PROJECTPATH,$this->project,'app',$this->controller));
		$this->appPath    = implode('.',array('app',$this->module));

		if($backend) $this->appPath = $backend.".".$this->appPath;
		
	}
	function loadController( $controller)
	{
		$f  		= str_replace('.',DS,$controller);
		#get controller name
		list(,,$ctr) 	= explode('.',$controller);			
		$fs = SYSTEM_ROOT.DS.$f.'.php';
		if( file_exists($fs) )
		{
			include $fs;
			return 'DO'.ucwords($ctr);
		}
		return false;
	}
	/**
	 * load view
	 *
	 */
	function loadView( $view = '')
	{
		//header("content-type:text/html;charset=utf-8");
		if( !$view )
		{
			$view   	= preg_replace('#Action$#i','',$this->action);
		}
		$viewPath = $this->appPath.'.view.'.$view;
		#echo 222;
		//loader::import('app.view.'.$controller.'.'.$view);
		$hook = & DOFactory::get('class',array('hook'));
		#$hook->on('beforeview',$this->module,$this->controller,$this->action);
		ob_start();
		DOLoader::import($viewPath);
		$mainContent = ob_get_contents();
		ob_end_clean();
		#echo $mainContent;
		$hook->on('afterview',$this->module,$this->controller,$this->action,array('main'=>$mainContent));
	}
	/**
	 * load model object
	 *
	 * @return unknown
	 */
	function loadModel( $model = '')
	{
		if(!$model) $model = $this->controller;
		
		if( $this->checkIfGotModel( $model ))
		{
			DOLoader::import($this->appPath.'.model.'.$model);
			$model = "DOModel_{$model}";
			if( class_exists( $model ))
			{
				return new $model();
			}
		}
	}
	/**
	 * check if got modle
	 *
	 */
	function checkIfGotModel( $model )
	{
		$fileHandler = & DOFactory::get('com',array('file'));
		
		$f = str_replace('.',DS,$this->appPath) 
			. DS 
			. 'model' 
			. DS 
			. $this->controller.'.php' ;

		return $fileHandler->exist( SYSTEM_ROOT,$f );
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
		DOSession::end();
	}
}
?>
