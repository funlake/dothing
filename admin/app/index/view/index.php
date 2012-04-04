<script type='text/javascript' src='<?php echo DOUri::getRoot();?>/data/js/common/loader.js'>
@load Ext;
@load ExtPlg[TabCloseMenu,WindowMsg];
@load Theme[backend/default]
</script>
<script type="text/javascript">
        Ext.onReady(function() {
        	var addTab = function(option){
				if(centerTabLayout){
					var t = centerTabLayout.add(option)
					centerTabLayout.activate(t.id);
				}
			}
			DO.systemMenu = new Ext.Toolbar({
				style : {
					border : 0
				}
			});
			DO.systemMenu.add({
					 text: '系统',
					 menu: {
			                xtype: 'menu',
			                plain: true,
			                items: [{
			                	text:'系统设置'
			                   ,icon  : '<?php echo DOUri::getRoot();?>/data/images/module/system.png'
			                },{
			                	 text:'模块管理'
			                	,icon  : '<?php echo DOUri::getRoot();?>/data/images/module/settings.png'
			                	,handler:function(){addTab({
			                				id    : 'module_panel'
									   	   ,title : '模块'
									   	   ,html  : '<iframe id="center-iframe" frameborder="0" style="width:100%;height:100%" src="<?php echo DOUri::buildQuery('module','module','index')?>"></iframe>'
									   	   
									  	   ,closable:true
			                	})
			                	
				               }
				            }]
					 }
			   
			},'-',{
					text: '模块',
					            menu: {
					                xtype: 'menu',
					                plain: true,
					                items: [<?php echo DOBase::get('backModules');?>]
					       }
				
			},'-',{
				text: '设定',
					            menu: {
					                xtype: 'menu',
					                plain: true,
					                items: [{
					                	text:'关于...'
					                   ,handler : function(o){
					                   		Ext.MessageBox.show({
					                   			title : 'help'
					                   		   ,msg  : 'this is dothing backend system'
					                   		})
					                   }
					                }]
					       }
			}
			,'->'
			,{
				text : '退出'
			   ,handler : function(o){DO.ajaxCall({
			   		url : '<?php echo DOUri::buildQuery('index','index','');?>'//invoke hook
			   	   ,method : 'post'
			   	   ,params : {task:'logout'}
			   })}
			}
			)

			var centerTabLayout = new Ext.TabPanel({
							border:false
						   ,tabPosition:'bottom'
						   ,enableTabScroll:true
						   ,plugins: new Ext.ux.TabCloseMenu() // contextmenu
						   ,items:[{
						   	    id    : 'index_panel'
						   	   ,title : '公告栏'
						   	   ,html  : '<iframe id="center-iframe" frameborder="0" style="width:100%;height:100%" src="<?php echo DOUri::buildQuery('index','index','welcome')?>"></iframe>'
						    }]
			});
			
			centerTabLayout.setActiveTab(0);
/*			centerTabLayout.on('tabchange',function(o,t){
				var ifr = Ext.getDom('center-iframe');
				if(ifr && t.url)
				{
					//alert(Ext.get(t.id).id)
					//var c = Ext.DomQuery.select('div[class^=x-panel-body]',Ext.get(t.id).dom)[0];//x-panel-body-noheader
					//ifr.src = t.url;
					//c.appendChild(ifr);
					//alert(ifr.getAttribute('src'));
					//ifr.src = t.url;
					//centerTabLayout.doLayout(true);
				}
				
			})*/
		
            var viewport = new Ext.Viewport({
                layout:'border',

                items: [{
                    //id:'btns',
                    region:'north',
                    baseCls:'x-plain',
                    split:false,
                    height:28,
                    minHeight: 40,
                    maxHeight: 85,
                    layout:'fit',
                    margins: '0 0 0 5',
                    items: [
						DO.systemMenu
                    ]
                    
               }, {
                    region:'center',
					layout : 'fit',
					items:[		
						centerTabLayout
					]
                   
               }]
            });
            viewport.doLayout();
        });
</script>
