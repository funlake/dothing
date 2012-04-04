(function(){
	/**--js loader--*/	

	//create element
	function createEl( tag , html) {
		    var obj = document.createElement(tag);
		    if(html) obj.innerHTML = html;
		    //this helps to fix the memory leak issue
		    try {
		        return obj;
		    } finally {
		        obj = null;
		    }
	}
	var temp = createEl('div');
		
	var DOJsLoader = {
		/** load ext */
		loadExt  : function(Container,root){		
			DOJsLoader.loads(Container,[
			 // {'tag':'link','rel':'stylesheet','type':'text/css','href':root+'/data/js/ext/resources/css/ext-all.css'}
			 {'type':'text/javascript','src':root+'/data/js/ext/adapter/ext/ext-base.js'}
			 ,{'type':'text/javascript','src':root+'/data/js/ext/ext-all.js'}
			 ,{'type':'text/javascript','src':root+'/data/js/ext/ext-init.js'}
			])
		}
	   //ext 扩展插件
	  ,loadExtPlg : function(Container,root,plg){
	  		DOJsLoader.loads(Container,[
				{'type':'text/javascript','src':root+'/data/js/ext/ux/'+plg+'.js'}
			])
	  }
	  //表单验证
	  ,loadValid : function(Container,root){
	   		DOJsLoader.loads(Container,[
				{'type':'text/javascript','src':root+'/data/js/common/validate.js'}
			])
	   }
	  //编辑页面各项初始化
	  ,loadEditlayout  : function(Container,root){
	  		DOJsLoader.loads(Container,[
				{'type':'text/javascript','src':root+'/data/js/common/edit_layout.js'}
			])
	  }
	  //Tab layout
	  ,loadTablayout  : function(Container,root){
	  		DOJsLoader.loadExtPlg(Container,root,'TabCloseMenu');
	  		DOJsLoader.loads(Container,[
				{'type':'text/javascript','src':root+'/data/js/common/tab_layout.js'}
			])
	  }
	  //Tree layout
	  ,loadTreelayout  : function(Container,root){
	  		DOJsLoader.loads(Container,[
				{'type':'text/javascript','src':root+'/data/js/common/tree_layout.js'}
			])
	  }
	   //样式导入
	  ,loadCss : function(Container,root,css){
	   		DOJsLoader.loads(Container,[
				{'tag':'link','rel':'stylesheet','type':'text/css','href':root+'/data/css/'+css+'.css'}
			])
	   }
	   //导入theme
	  ,loadTheme : function(Container,root,theme){
	  		DOJsLoader.loads(Container,[
				{'tag':'link','rel':'stylesheet','type':'text/css','href':root+'/data/themes/'+theme+'/css/ext-all.css'}
			   ,{'tag':'link','rel':'stylesheet','type':'text/css','href':root+'/data/themes/'+theme+'/css/main.css'}
			])
	  }
	   //日历控件
	   ,loadCalendar : function(Container,root){
	   	
	   }
	   ,loads  : function(Container,setting){
	   		for(var i=0,j=setting.length;i<j;i++){
	   			var d = createEl(setting[i]['tag'] || 'script');
	   			
	   			for(var k in setting[i]){
	   				if( setting[i][k] !=='tag' ) d[k] = setting[i][k];
	   			}

	   			//temp.innerHTML = d.outerHTML;
	   			//ie 6
	   			if(!window.XMLHttpRequest){
	   				//避免内存泄漏
	   				var td = d.outerHTML;
	   				document.write(td);//解决异步问题
	   			}	   			
	   			else{
	   				//ie 6 下此方法会造成内存泄漏 
	   				temp.appendChild( d );
	   				var di = temp.innerHTML;
					try{
	   				document.write(di);	///解决异步问题。
	   				//document.write('</'+'script>');
					}catch(e){}
	   			}
	   			//temp.removeChild(d);
	   			temp.innerHTML 	= '';
	   			delete d;
	   			d 				= null;
	   		}
	   }
	}
	/**--js init--*/
	var $Ss= document.getElementsByTagName('script')
	   ,$S = $Ss[($Ss.length)-1]
	   ,$H = document.getElementsByTagName('head')[0]
	   ,$T = $S.innerHTML
	   ,$P = $H.root || $H.getAttribute('base')
	   ,$L = DOJsLoader ;
	//import
	$T.toString().replace(/@load\s+([\w\[\]\,\/\\\\-]+)\;?/ig,function($_0,$_1){

		if($L['load'+$_1])
		{
			$L['load'+$_1]( $S , $P);
		}
		else{
			var p = $_1.split('[');
			
			if($L['load'+p[0]])
			{
				var plgf = $L['load'+p[0]];
				var plgs = p[1].replace(/\]$/,'').split(',');
				for(var i =0,j=plgs.length;i<j;i++){
					plgf($S,$P,plgs[i]);
				}
				
			}
			else
				alert('警告:控件'+$_1+'不存在')
		}
	})
	
	window['DO'] 			= window['DO'] || {};
	window['DO']['append']  = DOJsLoader.loads;
})()

