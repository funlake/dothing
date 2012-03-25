<?php
/**
 * @version $Id: class.extgrid.php,v 1.1 2009/02/19 02:33:46 john Exp $
 * @author lake
 * @package ext2.0
 */

class DOExtGrid
{
	public $json;
	public $id;
	public $url;
	public $formUrl;
	public $key;
	public $girdTitle ;
	public $_offsize=0;
	public $_limit	=20;
	public $remoteSort 		= true;
	public $seperator  		= ':'; 
	public $as					= '@';
	public $hideFlag			= '#';
	public $asp        = ',';
	public $headerArray = array();
	public $hideTbar			= false;
	public $hideBbar			= false;
	public $gridWidth  		= 755;
	public $gridHeight		 	= 460;
	public $headerDefaultWidth = 30;
	public $additionParam		= array();
	public $headerDataArray 	= array();
	public $defaultSort     	= array();
	public $replaceJson		= array('{"'=>'{','":'=>':',',"'=>',');
	public $noComaKey 			= array('width','height','sortable','locked','hidden','editor');
	public $toolBarButtonContainer	= array();
	public $pageBarButtonContainer = array();
	public $checkBox			= true;
	
	/**
	 * @param op flag
	 */
	public $add 	= '增加';
	public $edit 	= '删除';
	public $remove  = '编辑';
	
	public $subTableHtml = '';
	public $subCallUrl   = '';
	public $fieldType    = array(1=>"Field",2=>"ComboBox",3=>"Checkbox",4=>"Radio");
	public $searchArray;
	// Search Form Define
	public $searchFormWidth;
	public $searchFormHeight;
	public $searchFormTitle;

	
	// Search Panel Define
	public $searchPanelId;
	public $searchPanelTitle;	
	public $searchPanelDiv;	
	public $searchPanelItemArray;
	public $searchPanelwidth;
	public $searchPanelheight;
	function __construct( Array $array)
	{
		call_user_func_array(array($this,'init'),$array);
	}
	/**
	 * initialize
	 *
	 * @param unknown_type $id
	 * @param unknown_type $title
	 * @param unknown_type $url
	 * @param unknown_type $key
	 * @param unknown_type $_offsize
	 * @param unknown_type $_limit
	 * @param unknown_type $headerConfig
	 * @return extGrid
	 */
	function init($dataUrl,$formUrl='',$actionUrl='',$key,$headerConfig,$id='ext',$title='')
	{
		$this->multiLang		= $multiLang;
		$this->json             = & DOFactory::get('com',array('json'));
		$this->id				= $id ? $id : 'ext';
		$this->var_prefix 		= $this->id.'_';
		$this->gridTitle		= $title;
		$this->url				= $dataUrl;
		$this->formUrl			= $formUrl;
		$this->actionUrl        = $actionUrl;
		$this->key 				= $key;
		$this->headerArray = $headerConfig;

		if($headerConfig['groupViewConfig'])
		{
			$gs 	= explode('|',$headerConfig['groupViewConfig']);
			$gss    = explode(':',$gs[1]);
			$dora 	= $gss[1] ? $gss[1] : 'ASC';	
			$this->groupDataConfig = <<<config
			sortInfo:{field: '{$gss[0]}', direction: "{$dora}"},
	    	groupField:'{$gs[0]}',
config;
		}
		if($title)
		{
			$this->panelDisplay = true;	
		}
		else $this->panelDisplay = false;
		//register button
		$this->registerButton(DOLang::get('g_add','添加'),"top.DO.showDialog(' - {$multiLang->g_add}','{$this->formUrl}');",'','','add-icon');
		$this->registerButton(DOLang::get('g_edit','编辑'),$this->getPassParam("{$this->id}_grid","{$this->formUrl}"),'','','edit-icon');
		if($this->actionUrl)
		{
			$this->registerButton(DOLang::get('g_delete','删除'),$this->getPassParam("{$this->id}_grid","{$this->actionUrl}",1),'','','remove-icon');
		}
/*		// page limit
		if(isset($_REQUEST['extgrid_new_limit'])) {
			$_SESSION["s_admin_{$sessionPrefix}_perpage"]=$_REQUEST['extgrid_new_limit'];
		}
		if(!empty($_SESSION["s_admin_{$sessionPrefix}_perpage"])) {
			$this->_limit = $_SESSION["s_admin_{$sessionPrefix}_perpage"];
			//var_dump($this->_limit);exit;
		}
		$page_nums = array();
		foreach($GLOBALS['config']['admin_page_numbers'] as $v) {
			$page_nums[$v] = $v;
		}
		$pagingSelect = makeSelectList('perpage',
					       $page_nums,
					       '',
					       'onchange="extgridChangeLimit(this)"',
					       $this->_limit);
		$this->pagingSelect = $pagingSelect;
		$this->registerHTML($pagingSelect,'pbar');*/
		
		$this->rowNumberer = true;
		$this->checkBox    = true;
		
		$this->searchFormTitle = $this->gridTitle.' Search';

		$this->initDefine();
	}
	/**
	 * edit button registry
	 *
	 * @param $grid // grid has been existed
	 * @param $url  // editor file path
	 * @return unknown
	 */
	function getPassParam($grid,$url,$linkFlag = 0, $title='')
	{
		
		$title = $title ? $title : $this->edit;
		$keys = implode(',',$this->key);
		if(strpos($url,'?') !== false)
		{
			$url .= '&';	
		}
		else $url .= '?'; 
		return 
<<<passUrl
try{
		var selectedRows = {$grid}.getSelectionModel().getSelections().length;
		if(selectedRows == 0) 
		{
			showIconMsg('{$this->multiLang->g_select_items}','',3);
			return;
		}
		var a = '{$keys}';
		var paramStr = '';
	    var linkFlag = {$linkFlag};
		for(var i=0;i<selectedRows;i++)
		{
		    var arr = a.split(',');
			for(var j=0,k=arr.length;j<k;j++)
			{
				if(('{$url}&' + paramStr).length <= 2000)
				{
					paramStr += arr[j]+'[]='+{$grid}.getSelectionModel().getSelections()[i].get(arr[j])+'&';
				}
				else paramStr += '';
					
			}									
		}

		if(linkFlag == 0)
		{
			top.DO.showDialog(' - {$title}','{$url}'+paramStr);
		}
		else if(linkFlag == 1)
			
			deleteItem('{$url}&'+paramStr);//,{$this->id}_grid);	
		else if(linkFlag == 2)
			window.location.href='{$url}&'+paramStr;
		else return;		
}catch(e){}\n
passUrl;
	}
	/**
	 * ajax load data
	 *
	 * @return unknown
	 */
	function connect()
	{
		$this->headerDataArray 	= $this->mapHeaderArray($this->headerArray);
		if($this->defaultSort)
		{
			$defaultSortStr = "{$this->var_prefix}store.setDefaultSort('".key($this->defaultSort)."','".current($this->defaultSort)."')";
		}
		return 
<<<DATA
	    {$this->var_prefix}store = new Ext.data.GroupingStore({
	        proxy: new Ext.data.ScriptTagProxy({
	            url: '{$this->url}'
	        }),
	        reader: new Ext.data.JsonReader({
	            root: 'results',
	            totalProperty: 'total',
	            id: '{$this->id}',
	            fields: [{$this->renderField()}]
	        }),	
	        {$this->groupDataConfig}
			listeners:{load:function(){lm.hide()}},
	    	remoteSort:{$this->remoteSort}
	    });
	    {$defaultSortStr}
DATA;
	}
	/**
	 * map the header array
	 *
	 * @param $config // config data array
	 * @return unknown
	 */
	function mapHeaderArray($config)
	{
		$i = 0;
		foreach($config as $k=>$v)
		{
			if($k == '') $k = '  ';
			if($k == 'groupViewConfig') continue;
			if(strpos($v,$this->hideFlag) === 0) 
			{
				$tep = explode($this->seperator,$v);
				$tep = ltrim($tep[0],$this->hideFlag);
				$this->unShowField[] = $tep;
				continue;
			}
			$as = explode($this->as,$v,2);
			$vs = explode($this->seperator,$as[0]);
			$header[$i] = array('header'=>"<span class='grid_header'>".($k)."</span>",'dataIndex'=>$vs[0],'width'=>$vs[1] ? $vs[1] : $this->headerDefaultWidth);	
			if($as[1])
			{
				$at = explode($this->asp,$as[1]);
				
				foreach ($at as $v)
				{
					$kv = explode($this->seperator,$v,2);
					$header[$i][$kv[0]] = $kv[1]; 	
				}
			}
			$i++;
		}
		return $header;
	}
	/**
	 *mapping the field
	 *
	 * @return unknown
	 */
	function renderField()
	{
		if($this->headerDataArray)
		{
			foreach($this->headerDataArray as $k=>$i)
			{
				foreach($i as $k2=>$v)
				{
					if($k2 == "dataIndex") $this->_renderField[] = $this->json->encode($v);
				}
			}
			if(count($this->unShowField))
			{
				foreach($this->unShowField as $v2)
				{
					$this->_renderField[] = $this->json->encode($v2);	
				}
			}
			return implode(",",$this->_renderField);
		}
	}
	/**
	 * make column in grid
	 *
	 * @return unknown
	 */
	function makeColumnModel()
	{
		$mapData = $this->mapCM();
		if($this->rowNumberer)
		{
			$initRowNum = "var {$this->var_prefix}rn = new Ext.grid.RowNumberer();";
			$mapData = str_replace("[{","[{$this->var_prefix}rn,{",$mapData);	
		}		
		if($this->subTableHtml || $this->subCallUrl)
		{
			$subKey = "['".implode("','",$this->key)."']";
			if($this->subTableHtml)
			{
				$initExpander = 
				<<<exp
				{$this->var_prefix}subTable = new Ext.grid.RowExpander({
					tpl:new Ext.Template("{$this->subTableHtml}")
				});
exp;
			}
			if(!$this->subTableHtml && $this->subCallUrl)
			{
				$initExpander = 
				<<<exp
				{$this->var_prefix}subTable = new Ext.grid.RowExpander({
					tpl:new Ext.Template(" "),
					url:'{$this->subCallUrl}',
					key:{$subKey}
				});
exp;
			}
			
		if($initRowNum)
			$mapData = str_replace("[{$this->var_prefix}rn,{","[{$this->var_prefix}rn,{$this->var_prefix}subTable,{",$mapData);
		else 
			$mapData = str_replace("[{","[{$this->var_prefix}subTable,{",$mapData);
		}
		if($this->checkBox)
		{
			$initChk = "var {$this->var_prefix}chkbox = new Ext.grid.CheckboxSelectionModel();";
			//if(strpos($mapData,"[{$this->var_prefix}rn,{$this->var_prefix}subTable,{") === 0)
			if($initRowNum && $initExpander)
			{
				$mapData = str_replace("[{$this->var_prefix}rn,{$this->var_prefix}subTable,{","[{$this->var_prefix}rn,{$this->var_prefix}subTable,{$this->var_prefix}chkbox,{",$mapData);
			}
			elseif($initRowNum && !$initExpander)
			{
				$mapData = str_replace("[{$this->var_prefix}rn,{","[{$this->var_prefix}rn,{$this->var_prefix}chkbox,{",$mapData);
			}
			elseif(!$initRowNum && $initExpander)
			{	
				$mapData = str_replace("[{$this->var_prefix}subTable,{","[{$this->var_prefix}subTable,{$this->var_prefix}chkbox,{",$mapData);
			}
			else
			{ 
				$mapData = str_replace("[{","[{$this->var_prefix}chkbox,{",$mapData);
			}
		}
		return 
<<<CM
		{$initRowNum}\n
		{$initChk}\n
		{$initExpander}\n
		//var rowSl = new Ext.grid.RowSelectionModel();\n
	    var cm = new Ext.grid.ColumnModel({$mapData});\n
	    cm.defaultSortable = true;
CM;
	}
	
	/**
	 * json encoding the original array in php
	 *
	 * @return unknown
	 */
	function mapCM()
	{
		$map = $this->json->encode($this->headerDataArray);
		return $this->replaceJson($map);
	}
	/**
	 * replace the json data(fit javascript code)
	 *
	 * @param unknown_type $jsonData
	 * @return unknown
	 */
	function replaceJson($jsonData)
	{
		$jsonData =  strtr($jsonData,$this->replaceJson);
		return $this->trimComa($jsonData);
	}
	/**
	 * trim coma 
	 *
	 * @param unknown_type $jsonData
	 * @return unknown
	 */
	function trimComa($jsonData)
	{
		foreach($this->noComaKey as $key)
		{
			$jsonData = preg_replace("/{$key}\s*:\s*\"(.[^\,]+)\"/i","{$key}:\\1",$jsonData);	
		}
		return $jsonData;
	}
	
	/**
	 * add a new button
	 *
	 * @param  $pos // tbar->toolbar  pbar->pagingbar
	 * @param  $text // button's text
	 * @param  $toolTip //button's tooltip
	 * @param  $otherAttribute //other useful attribute you want to add
	 * @param  $iconCls  //icon's class,define in css file or just use the one that has existed
	 * @param  $handler  //what this button will do when it was be clicked!(string with javascript code)
	 */
	function pushButton($pos,$text,$toolTip='',$otherAttribute='',$iconCls='',$handler='')
	{
		$iconClass = $iconCls != '' ? $iconCls : strtolower($text).'-icon';
		$buttonStr = "'-',{\n";
		$buttonStr.= "text:'{$text}',\n";
		$buttonStr.= "iconCls:'{$iconClass}',\n";
		$buttonStr.= "tooltip:'{$toolTip}',\n";
		if(!$handler)
		{
			$tx = strtolower(preg_replace("/\s+/","_",$text));
			$tx = preg_replace('/^[0-9]+([A-Z0-9a-z]+)$/','$1',md5($tx));
			$buttonStr.= "handler:{$this->var_prefix}{$tx}ButtonHandler,\n";
		}
		else $buttonStr.= "handler:{$handler},\n";
		if($otherAttribute)
		{
			$buttonStr.= "{$otherAttribute}\n";
		}
		else $buttonStr = rtrim($buttonStr,",\n");
		$buttonStr.="}\n";
		if($pos == 'pbar')
		{
			$this->pageBarButtonContainer[strtolower($text).'-'.$pos.'-button'] = $buttonStr;
		}
		elseif($pos == 'tbar')
		{
			$this->toolBarButtonContainer[strtolower($text).'-'.$pos.'-button'] = $buttonStr;
		}
		else return;
	}
	/**
	 * button register interface
	 *
	 * @param  $text // button's text
	 * @param  $jsCode // javascript code for handler this button
	 * @param  $toolTip // tooltip
	 * @param  $otherAttribute // other attribute
	 * @param  $iconCls // icon's class
	 * @param  $pos //tbar->toolbar pbar->pagingbar
	 */
	function registerButton($text,$jsCode,$toolTip='',$otherAttribute='',$iconCls='',$pos='tbar')
	{
		
		$btn = strtolower(preg_replace("/\s+/","_",$text));
		$label = $this->genLabel($btn.'-'.$pos.'-button');
		$pos = $pos ? $pos : 'tbar';
		if(!isset($this->toolBarButtonContainer[$label]))
		{
			$this->pushButton($pos,$text,$toolTip,$otherAttribute,$iconCls);	
		}
		elseif(!isset($this->pageBarButtonContainer[$label]))
		{
			$this->pushButton($pos,$text,$toolTip,$otherAttribute,$iconCls);	
		}
		$btn = preg_replace('/^[0-9]+([A-Z0-9a-z]+)$/','$1',md5($btn));
		$this->buttonToggleContainer[$label] =  
<<<buttonHandler
		var {$this->var_prefix}{$btn}ButtonHandler = function(o)
		{
    		{$jsCode}\n
		}
buttonHandler;
	}
	//register menu
	function registerMenu($text,$menuName,$toolTip,$iconCls,$menuCfg,$otherAttribute='')
	{
		$this->menuStr[]= "\n var menu_{$menuName} = new Ext.menu.Menu({id:'menu_{$menuName}',items:[{$menuCfg}]})";
		$this->registerButton($text,'',$toolTip,"menu:menu_{$menuName}{$otherAttribute}",$iconCls);
	}
	
	function registerTextBox($label,$html)
	{
		$label = $this->genLabel($label);
		$this->toolBarButtonContainer[$label] = "'-','".addslashes($label)." : ".addslashes($html)."'";
	}
	
	
	function registerHTML($html,$pos='tbar')
	{
		$label = strtolower('html-'.$pos.'-btn-'.md5($html));
		$label = $this->genLabel($label);
		if($pos=='tbar') {
			$this->toolBarButtonContainer[$label] = "'".addslashes($html)."'";
		} else {
			$this->pageBarButtonContainer[$label] = "'".addslashes($html)."'";
		}
	}
	function unregisterHTML($html,$pos='tbar')
	{
		$label = strtolower('html-'.$pos.'-btn-'.md5($html));
		if(isset($this->toolBarButtonContainer[$label]))
		{
			unset($this->toolBarButtonContainer[$label]);	
		}
		if(isset($this->pageBarButtonContainer[$label]))
		{
			unset($this->pageBarButtonContainer[$label]);
		}
	}
	
	function genLabel($label)
	{
		if($label == '') $label = "(1)";
		if($this->toolBarButtonContainer[$label]) $label = '('.count($this->toolBarButtonContainer).')';
		elseif($this->pageBarButtonContainer[$label]) $label = "(".count($this->pageBarButtonContainer).")";
		return $label;
	}
	/**
	 * remove the button
	 *
	 * @param  $pos // button's position tbar->toolbar pbar->pagingbar
	 * @param  $text // button's text
	 */
	function unregisterButton($text)
	{
		if(isset($this->toolBarButtonContainer[strtolower($text).'-tbar-button']))
		{
			unset($this->toolBarButtonContainer[strtolower($text).'-tbar-button']);	
		}
		if(isset($this->pageBarButtonContainer[strtolower($text).'-pbar-button']))
		{
			unset($this->pageBarButtonContainer[strtolower($text).'-pbar-button']);
		}
	}
	
	/**
	 * disable the button
	 *
	 * @param  $pos ^
	 * @param  $text ^
	 */
	function disableButton($text)
	{
		if(isset($this->toolBarButtonContainer[strtolower($text).'-tbar-button']))
		{
			$this->pushButton('tbar',$text,'','disabled:true');
		}
		if(isset($this->pageBarButtonContainer[strtolower($text).'-pbar-button']))
		{
			$this->pushButton('pbar',$text,'','disabled:true');
		}
	}
	
	/**
	 * build the grid
	 *
	 * @return unknown
	 */
	function makeBorderGridPanel()
	{
		$tbs = implode(",\n",$this->toolBarButtonContainer);
		$tbs = trim($tbs,",\n");
		if(strpos($tbs,"'-',{") === 0) $tbs = ltrim($tbs,"'-',");
		else $tbs = "'".ltrim($tbs,"'-',");
		$pbs = implode(",\n",$this->pageBarButtonContainer);
		if($pbs)
		{
			$pbs = "'-',".trim($pbs,",\n");
		}
		if($this->subTableHtml || $this->subCallUrl)
		{
			$plugin = "\n plugins:{$this->var_prefix}subTable,";	
		}
		if(count($this->additionParam))
		{
			foreach($this->additionParam as $k=>$v)
			{
				$params .= ','.$k.':\''.$v.'\'';	
			}
		}


		if($this->groupDataConfig)
		{
			$groupView = <<<groupviewconfig
			view: new Ext.grid.GroupingView({
           	 	forceFit:true,
            	groupTextTpl: '{gvalue} ({[values.rs.length]})'
        	}),
groupviewconfig;
			$pbar = <<<pb
			pageSize: {$this->_limit},
			store: {$this->var_prefix}store
pb;
		}
		else
		{
			$pbar = <<<pb
				pageSize: {$this->_limit},
	            store: {$this->var_prefix}store,
	            displayInfo: true,
	            items:[
	                {$pbs}
					]
pb;
		}
		if(!$this->hideTbar)
		{
			$tbStr=",tbar:[{$tbs}]";
		}
		else $tbStr = '';
		if(!$this->hideBbar)
		{
			$bbStr = ",bbar: new Ext.PagingToolbar({
			 ".$pbar.",
			 cls:'pagingbar'
	        })";
		}
		else $bbStr =  '';
		return 
<<<GRID
	    {$this->id}_grid = new Ext.grid.GridPanel({
	        id:'{$this->id}',
	        border:false,
	        region:'center',
			height:{$this->gridHeight},
	       // enableDragDrop:true,
	       // ddGroup:'tt',
			//height: Ext.get('{$this->id}').getHeight(),
			//width: Ext.get('{$this->id}').getWidth(),
			//bodyStyle:'width:99.78%;height:100%',
	        store: {$this->var_prefix}store,
	        cm: cm,
	        trackMouseOver:true,
	        sm: (typeof {$this->var_prefix}chkbox!=='undefined') ? {$this->var_prefix}chkbox : new Ext.grid.RowSelectionModel({selectRow:Ext.emptyFn}),
	        {$plugin}
	        loadMask: true,
	        stripeRows : true,
	        viewConfig: {
	           forceFit:true,
	           autoFill:true,
	           enableRowBody:true	           
	        },
	        {$groupView}
	        title:'{$this->gridTitle}',
	        collapsible:false,
	        floating :false
			{$bbStr}
			{$tbStr}
	    });
		
	    // render it
	   // {$this->id}_grid.render();
	
	    // trigger the data store load
	    {$this->var_prefix}store.load({params:{start:{$this->_offsize}, limit:{$this->_limit}{$params}}});
GRID;
	}
	
	function makeTableGridPanel()
	{
		$tbs = implode(",\n",$this->toolBarButtonContainer);
		$tbs = trim($tbs,",\n");
		if(strpos($tbs,"'-',{") === 0) $tbs = ltrim($tbs,"'-',");
		else $tbs = "'".ltrim($tbs,"'-',");
		$pbs = implode(",\n",$this->pageBarButtonContainer);
		if($pbs)
		{
			$pbs = "'-',".trim($pbs,",\n");
		}
		if($this->subTableHtml || $this->subCallUrl)
		{
			$plugin = "\n plugins:{$this->var_prefix}subTable,";	
		}
		if(count($this->additionParam))
		{
			foreach($this->additionParam as $k=>$v)
			{
				$params .= ','.$k.':\''.$v.'\'';	
			}
		}
		if($this->hideTbar)
		{
			$tbStr=",tbar:[{$tbs}]";
		}
		else $tbStr = '';
		return 
<<<GRID
	    {$this->id}_grid = new Ext.grid.GridPanel({
	        el:'{$this->id}',
	        
			//height: Ext.get('{$this->id}').getHeight(),
			//width: Ext.get('{$this->id}').getWidth(),
			//bodyStyle:'width:99.78%',
			height:{$this->gridHeight},
			width:{$this->gridWidth},
	        store: {$this->var_prefix}store,
	        cm: cm,
	        trackMouseOver:true,
	        sm: (typeof {$this->var_prefix}chkbox!=='undefined') ? {$this->var_prefix}chkbox : new Ext.grid.RowSelectionModel({selectRow:Ext.emptyFn}),
	        {$plugin}
	        loadMask: true,
	        viewConfig: {
	           forceFit:false,
	           autoFill:true,
	           enableRowBody:true	           
	        },
	        title:'{$this->gridTitle}',
	        collapsible:true,
	        floating :false,
	        bbar: new Ext.PagingToolbar({
	            pageSize: {$this->_limit},
	            store: {$this->var_prefix}store,
	            displayInfo: true,
	            displayMsg: 'Displaying topics {0} - {1} of {2}',
	            emptyMsg: "No topics to display",
	            items:[
	                {$pbs}
					]
	        }){$tbStr}
	    });

	    // render it
	    {$this->id}_grid.render();
	
	    // trigger the data store load
	    {$this->var_prefix}store.load({
	    		params:{
	    				start:{$this->_offsize}
	    			   ,limit:{$this->_limit}{$params}
	    		}
	    	   ,callback : function(){
	    	   		if(lm) lm.hide();
	    	   }
	    });
GRID;
	}
	
	/**
	 * showing the grid you have defined
	 *
	 */
	function showGrid($sessionPrefix='')
	{
		if($sessionPrefix)
		{
			getCurrentPage($sessionPrefix,$this);
		}
/*		if($this->subTableHtml)
		{
			$this->registerButton($this->multiLang->g_view_all,"{$this->var_prefix}subTable.expandAllRow()");
		}*/
		$buttonsHandler = implode("\n",$this->buttonToggleContainer);
		$menuCfgStr		= implode("\n",(array)$this->menuStr);
		$curPage = $_SESSION["s_admin_{$sessionPrefix}_sl"];
		
		
		if(isset($_GET["extgrid_new_limit"])) {
			$this->_offsize = 0;
			$_SESSION["s_admin_{$sessionPrefix}_page"]=1;
			//echo $sessionPrefix;exit;
			//var_dump($this->_limit);exit;
		}

/*		if($this->_limit > max($GLOBALS['config']['admin_page_numbers'])) {
			$this->unregisterHTML($this->pagingSelect,'pbar');
			$this->registerHTML('<input type="hidden" id="perpage" value="'.$this->_limit.'" name="perpage" />','pbar');
		}*/
		
		echo 
<<<SHOW
		
		<script>
		{$this->defineVar}
		Ext.onReady(function()
		{\n
			lm = new Ext.LoadMask(document.body, {msg:'{$this->multiLang->g_loading}',removeMask:true,store:{$this->var_prefix}store});
			lm.show();
			Ext.QuickTips.init();
			{$buttonsHandler}\n
			{$menuCfgStr}\n
			{$this->connect()}\n
			
			{$this->makeColumnModel()}\n			
			{$this->makeBorderGridPanel()}\n 
			var viewpoint = new Ext.Viewport({
				layout:'border',
				
				items:[{$this->id}_grid]
			});
		});
	
		function {$this->id}_getCbLen()
		{
			var g = {$this->id}_grid;
			return g.getSelectionModel().getSelections().length;
		}
		function {$this->id}_getSelectedRecord(r,c)
		{
			var g = {$this->id}_grid;
			if({$this->id}_getCbLen())
			{
				if(r == 'all' && c !== undefined)
				{
					var ra = [];
					for(var i=0,j={$this->id}_getCbLen();i<j;i++)
					{
						ra[i] = g.getSelectionModel().getSelections()[i].get(c);
						//g.getSelectionModel().lock();
					}
					return ra;
				}
				else if(r !='all' && c === undefined)
				{
					return g.getSelectionModel().getSelections()[r-1];
				}
				else return g.getSelectionModel().getSelections()[r-1].get(c);
			}
			else return null;
		}
		</script>
	
		<!--<div id="{$this->id}" style="height:{$this->gridHeight}px"></div>-->
SHOW;
	}
	
	function genGrid()
	{

		$buttonsHandler = implode("\n",$this->buttonToggleContainer);
		echo <<<JS
		<script type='text/javascript'>
		//Ext.onReady(function(){\n
			lm = new Ext.LoadMask(document.body, {msg:'{$this->multiLang->g_loading}',removeMask:true,store:{$this->var_prefix}store});
			lm.show();
			Ext.QuickTips.init();
			{$buttonsHandler}\n
			{$this->connect()}\n
			{$this->makeColumnModel()}\n			
			{$this->makeBorderGridPanel()}\n 
		//});
		</script>
JS;
	}
	
	
	
	function showTableGrid($sessionPrefix='')
	{
		if($sessionPrefix)
		{
			getCurrentPage($sessionPrefix,$this);
		}
/*		if($this->subTableHtml)
		{
			$this->registerButton('View all',"{$this->var_prefix}subTable.expandAllRow()");
		}*/
		$buttonsHandler = implode("\n",$this->buttonToggleContainer);
		echo 
<<<SHOW
		
		<script>
	
		Ext.onReady(function()
		{\n
			Ext.QuickTips.init();
			{$buttonsHandler}\n
			{$this->connect()}\n
			{$this->makeColumnModel()}\n			
			{$this->makeTableGridPanel()}\n 
		});
		</script>
	
		<div id="{$this->id}"></div>
SHOW;
	}
	
	/**
	 * showing  define
	 *
	 */
	function initDefine()
	{	
		$this->defineVar = 
<<<DEFINE
			var lm;
			var {$this->id}_grid;
			var {$this->var_prefix}store;
			var {$this->var_prefix}subTable;
DEFINE;
	}
}
?>