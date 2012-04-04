/**
* 编辑页面 tool bar
*/
Ext.onReady(function(){
	DO.Etbar = new Ext.Toolbar();
	var viewport = new Ext.Viewport({
        layout:'border',

        items: [{
            id:'tbar',
            border:true,
            region:'north',
            baseCls:'x-plain',
            split:false,
            height:25,
            layout:'fit',
            items: [
				DO.Etbar
            ]
            
       }, {
            region:'center',
			layout : 'fit',
			border : false,
			contentEl:'edit_content'
       }]
    });
    
	DO.addBtn = function(text,fn,iconCls,tip,attr){
		var opt = {
			text 	: text
		   ,handler : new Function('o',fn)
		   ,iconCls : iconCls
		}
		if(!!tip) opt.tooltip = tip;
		var attr = attr || {};
		opt = Ext.applyIf(opt,attr);
		DO.Etbar.add(opt);
	}
	
	DO.addBtns = function(conf){
		//添加按钮群
		Ext.QuickTips.init();
		Ext.each(conf,function(v,i){
			//array
			if(typeof v == 'object'){
				DO.addBtn.apply(null,v);
				if(i < conf.length - 1 && (typeof conf[i+1] == 'object')) DO.Etbar.addItem('-');
			}
			else if(typeof v == 'string'){
				DO.Etbar.addItem(v);
			}
		})
		
		try{DO.Etbar.doLayout();}catch(e){}
	}
	var panelBody = Ext.get('edit_content').parent();
	Ext.DomHelper.applyStyles(panelBody,'overflow:auto');
	//Ext.applyStyles(panelBody,'overflow:auto');
})

