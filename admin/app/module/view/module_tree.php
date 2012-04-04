<div id="tree" style="overflow:auto;border:0px"> </div>
<script type="text/javascript" src="<?php echo DOUri::getRoot();?>/data/js/common/loader.js">
	@load Ext;
	@load Treelayout
	@load ExtPlg[WindowMsg]
	@load Theme[backend/default];
</script>
<script type='text/javascript'>
Ext.onReady(function(){
   DO.setTreelayout([
    	'<?php echo DOUri::buildQuery('module','module','data');?>' //数据源
       	,'<?php echo DOuri::buildQuery('module','module','edit')?>'  //编辑页面
       	,'<?php echo DOLang::get('module_manage','模块管理');?>'      //树title
    ])
    //添加默认root结点
	DO.ltRoot.appendChild([
	 	{
	 		 text:'<?php echo DOLang::get('backend','模块');?>'
	 		,id:'backend'          	
	 		,icon : '<?php echo DOUri::getRoot();?>/data/images/module/module.png'
	 		,link:'<?php echo DOuri::buildQuery('module','module','add','backend=yes')?>'
	 	  	,menu_link_add:'<?php echo DOuri::buildQuery('module','module','add','backend=yes&id=null&task=add')?>'
	 	}
	 	/*
		,{
			text:'<?php echo DOLang::get('frontend','前台模块');?>'
			,id:'frontend'
			,link:'<?php echo DOuri::buildQuery('module','module','edit','frontend=yes')?>'
			,menu_link_add:'<?php echo DOuri::buildQuery('module','module','add','frontend=yes&id=null&task=add')?>'
		}*/
	]);
	DO.ltRoot.firstChild.select();
	DO.ltRoot.firstChild.expand();
    //设置节点右键菜单
	DO.ltTree.on('contextmenu',function(o,e){
		o.select();
		new Ext.menu.Menu({
			//add random string,or it will cause some problem
			   id : 'node_menus' +  (Date.parse(new Date()))
			   ,items:[
					{
						text:'<?php echo DOLang::get('g_add','添加');?>'
						,iconCls:'add-icon'
						,disabled : !o.attributes.menu_link_add
						,handler:function(h){
							DO.showDialog('<?php echo DOLang::get('addmodule','添加模块');?>'
									,o.attributes.menu_link_add
							)
						}
					}
				   ,{
						text:'<?php echo DOLang::get('g_edit','编辑');?>'
						,iconCls:'edit-icon'
						,disabled : !o.attributes.menu_link_edit
						,handler:function(h){
							DO.showDialog('<?php echo DOLang::get('addmodule','编辑模块');?>'
									,o.attributes.menu_link_edit
							)
						}
					}
				   ,{
						text:'<?php echo DOLang::get('g_delete','删除');?>'
						,iconCls:'remove-icon'
						,disabled : !o.attributes.menu_link_edit
						,handler:function(h){
							DO.ajaxCall({
								url : o.attributes.menu_link_del
							})
						}
					}
				]
		}).showAt(e.getXY());
	})

})
</script>
