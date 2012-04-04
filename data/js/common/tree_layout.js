Ext.onReady(function(){			
		// Left Tree
	    var Tree = Ext.tree;	
	    //tree panel	
	    DO.ltTree = new Tree.TreePanel({
	    	el: 'tree',
	        autoScroll:true,
	        animate:true,
	        useArrows:true,
	        enableDD:false,
	        containerScroll: false,
	        rootVisible: false
	    });		
	   
	    // set the root node
	    DO.ltRoot = new Tree.AsyncTreeNode({
			id:'0'
	    });
	    // set root for tree
	    DO.ltTree.setRootNode(DO.ltRoot);		
	    DO.activeTreeNode = DO.ltTree.getSelectionModel();
		DO.ltTree.addListener('click',function(o,e){
			//link to edit form
			if(o.attributes.link)
				Ext.get('center-iframe').dom.src = o.attributes.link
			
		});
    
		/* West Panel */
		var westPanel= new Ext.Panel({
				region:'west',
				id:'west-panel',
				border:false,
				collapsible: false,
				split:true,
				title:'  ',
				width: '20%',
				layout:'fit',
				margins:'0 0 0 0',
				layoutConfig:{
					animate:false
				},
				items:DO.ltTree
		});			

		/* Center Panel */
		var centerPanel= new Ext.Panel({
			id:"center-panel",			
			region:'center',
			autoScroll: false,
			collapsible: false
			
		});
	
		/* define viewport */
	   var viewport = new Ext.Viewport({
	        layout:'border',
	        items:[westPanel,centerPanel]
	    });			

	    //thin border style
	var panels = Ext.DomQuery.select('div[class*=x-panel-body-noheader]');
	Ext.each(panels,function(v,k){
		Ext.get(v.id).applyStyles('border-top:0px;border-bottom:0px')
	})		
	//设置panel title
	DO.setTreeTitle = function( v ){
		westPanel.setTitle( v )
		westPanel.doLayout(true);
	}	
	//设置右边区块链接
	DO.setTreeLink = function( link ){
		centerPanel.update('<iframe id="center-iframe" scrolling="auto" frameborder="0" style="border: 0px none ; overflow: auto; "  height="100%" width="100%" src="'+link+'"></iframe>')
	}
	//设置树形数据源
	DO.setTreeLoader   = function( dataurl ){
		DO.ltTree.loader = new Ext.tree.TreeLoader({
    				dataUrl:dataurl
			});

	}
	//节点reload 方法
	DO.treeReload = function( node ){
		return node.reload();
	}
	DO.activeReload = function()
	{
		DO.treeReload(DO.activeTreeNode.selNode);
	}
	DO.activeParentReload = function()
	{
		DO.treeReload(DO.activeTreeNode.selNode.parentNode);
	}
	DO.activeChangeText = function(text)
	{
		DO.activeTreeNode.selNode.setText(text);
	}
	/**
	*main method
	*/
	DO.setTreelayout = function(setting){
		DO.setTreeLoader(setting[0]);//set loader
		DO.setTreeLink(setting[1]);//set node link
		DO.setTreeTitle(setting[2]);//set tree panel title
		DO.ltRoot.render();
		DO.ltRoot.expand();
	}
});