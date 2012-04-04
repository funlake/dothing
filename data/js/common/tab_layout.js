/**
* tab layout
*/
Ext.onReady(function(){
	DO.Tab = new Ext.TabPanel({
				border:false
			   ,tabPosition:'top'
			   ,enableTabScroll:true
			   ,plugins: new Ext.ux.TabCloseMenu() // contextmenu
	});
	//viewport
	var viewport = new Ext.Viewport({
        layout:'border',

        items: [{
            id:'tbar',
            border:true,
            region:'center',
            baseCls:'x-plain',
            split:false,
            layout:'fit',
            items: [
				DO.Tab
            ]
       }]
    });
	//id = "center-iframe"的iframe是否存在?
    var gotIfr = false;
    /**
    *添加单个tab
    */
    DO.addTab  = function(tab,TabObj){
    	var opt = Ext.apply({
    		title 		: tab[0]
		   ,url   		: tab[1]
    	},tab[2] || {});
    	
    	if(!gotIfr){
    		opt 	= Ext.apply(opt,{html :'<iframe id="center-iframe" frameborder="0" style="width:100%;height:100%" src="'+tab[1]+'"></iframe>'});
    		gotIfr 	= true;
    	}
    	var t = TabObj.add(opt);
    }
    /**
    *群加tabs
    */
    DO.addTabs = function(tabs,TabObj,defaultTab){
    	var TO = TabObj || DO.Tab;
    	
    	Ext.each(tabs,function(v,i){
    		DO.addTab.apply(null,[v,TO]);
    	})
    	if(typeof defaultTab != 'undefined')
    		DO.Tab.setActiveTab(defaultTab);
    }
    /**
    *保证各个tab共享一个iframe.
    */
    DO.Tab.on('tabchange',function(o,t){
    	var ifr = Ext.getDom('center-iframe');
    	if(ifr && t.url){
			var c = Ext.DomQuery.select('div[class^=x-panel-body]',Ext.get(t.id).dom)[0];//iframe's parentnode
			ifr.src = t.url;
			c.appendChild(ifr);
			DO.Tab.doLayout(true);
		}
    })
    
    viewport.doLayout(true);
})