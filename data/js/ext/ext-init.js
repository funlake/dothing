(function(){
	if(Ext){
		Ext.onReady(function(){
			//关闭top页面已展开的menu
			if(typeof parent.DO.systemMenu != 'undefined' || typeof parent.parent.DO.systemMenu != 'undefined'){
				//假设当前页面非top页面，则body.onclick即关闭top页面展开的menu
				Ext.get(document.body).on('click',function(){
						var ab =  top.DO.systemMenu.activeMenuBtn || {menu:{hide:function(){}}}
						ab.menu.hide();
				});
			}

			/**
			*初始化DO入口对象
			*
			*/
			//top.window.DO BEGIN
			Ext.Msg.buttonText.ok 		= '确认';
			Ext.Msg.buttonText.yes 		= '是';
			Ext.Msg.buttonText.no 		= '否';
			Ext.Msg.buttonText.cancel 	= '取消';
			

			window.DO = Ext.apply(window.DO || {},{
					/** load mask **/
					loadingMask : function(){
						var loadmask = new Ext.LoadMask(Ext.getBody(), {msg:'处理中...'});
						top.window.DO.showLoading = function(){
							loadmask.show();
						}
						
						top.window.DO.hideLoading = function(){
							loadmask.hide();
						}
						return loadmask;
					}
					/**
					//弹出窗口类
					######弹出信息######
					#1.普通
					#2.警告
					#3.询问
					#4.错误
					##begin
					*/
					//info
				   ,msgI : function(msg,fn){
						this.extMsg(msg,fn,'I');
					}
					//qusetion
				   ,msgQ : function(msg,fnY,fnN){
				   		var fn = function(o){
				   			
				   			var self = this;
				   			//触发确定事件
				   			if(o == 'yes') 		fnY || fnY.call(self);
				   			//出发否定事件
				   			else if(o == 'no') 	fnN || fnN.call(self);
				   		}
				   		this.extMsg(msg,fn,'Q');
				   }
				   //error
				   ,msgE : function(msg,fn){
				   		this.extMsg(msg,fn,'E');
				   }
				   //warning
				   ,msgW : function(msg,fn){
				   		this.extMsg(msg,fn,'W');
				   }
				   //notice.message slide out from footbar of page.
				   ,msgT : function(msg,txt){
				   	
				   		new Ext.ux.window.MessageWindow({
							 title:'信息' 
							,html:msg || 'No information available' 
							,origin:{offY:-5,offX:-5}
							,autoHeight:true
							//,iconCls:Ext.MessageBox.INFO
							,help:false
							,hideFx:{delay:1000, mode:'standard'}
							,listeners:{
								render:function(){
									//func = function(o){eval(fn)}
									//fn.call();
									
									//Ext.ux.Sound.play('generic.wav');
								}
							}
						}).show(Ext.getDoc());
				   }
				   //ext messagebox extention.
				   ,extMsg : function(msg,f,t,buttons,w){
				   		var iconClass,btn,title,func,msgBoxWidth;
	
						if(w == undefined) w = msgBoxWidth || 300;
						switch(t)
						{
							//info
							case 'I':
							  iconClass = Ext.MessageBox.INFO;
							  btn 		= Ext.MessageBox.OK;
							  title 	= '信息';
							break;
							//question
							case 'Q':
							  iconClass = Ext.MessageBox.QUESTION;
							  btn 		= Ext.MessageBox.YESNO;
							  title 	= '确认';
							break;
							//error
							case 'E':
							  iconClass = Ext.MessageBox.ERROR;
							  btn 		= Ext.MessageBox.OK;
							  title 	= '错误';
							break;
							//warnning
							case 'W':
							  iconClass = Ext.MessageBox.WARNING;
							  btn 		= Ext.MessageBox.OK;
							  title		= '警告';
							break;
						}
						if(buttons !== undefined) btn = buttons;
						if(typeof f == 'function')
						{
							func = f;
						}
						else func = function(o){eval(f)}
					 	Ext.MessageBox.show({
					           title: title,
					           msg: msg,
					           width:w,
					           buttons: btn,
					           modal: true,
							   resizable: false,
					           fn: func,
					           icon: iconClass
					  });
				   }
				   /**
				   * 弹出dialoag
				   */
				   ,showDialog : function (v,r,w,h,config){
						if (!w) 
						{
							w = Math.ceil(document.body.clientWidth * (2/3));
							if (w > 700 ) w = 700;
						}
						if (!h) h = Math.ceil(document.body.clientHeight * (3/4));
/*						if(top.centerPanel.getActiveTab()) 
						{
							try{
							if(page_name) v = page_name+v;
							else
								v = top.centerPanel.getActiveTab().title+v;
							}catch(e){}
						}
					*/
						if(!DO.dialog){
							var defaultCfg = {
								title: v ,
								layout:'fit',
								width: w,
								height: h,
								border:false,
								modal:true,
								closable:true,
								maximizable:true,
								closeAction:'hide',
								plain: true,
								items: new Ext.Panel({
									layout:'fit'
								   ,html  : '<iframe id="dialog-iframe" frameborder="0" style="width:100%;height:100%" src="'+r+'"></iframe>'
									//items: [new  Ext.ux.IFrameComponent({ id:'tab-iframe', url:r })]
								})
							}
							DO.dialog = new Ext.Window(Ext.apply(defaultCfg,config));
							//DO.dialog.on('hide', function(){refreshSelf();});
						}
						else
						{
							DO.dialog.setTitle(v);
							DO.dialog.restore();
							Ext.get('dialog-iframe').dom.src = r;
						}
						
						//position will fit the browser
						var wh = DO.getObjectPosition(w,h);
						var swh= DO.getScrollPosition();
						var dw = wh[0]/2;
						var dh = wh[1]/2;
						DO.dialog.on('maximize',function(){dialog.setPosition(swh[0],swh[1])})
						DO.dialog.setPosition(swh[0]+dw,swh[1]+dh)
						
						//showTopLoading();
						//show
						DO.dialog.show();
					}
				   //relative position
				   ,getObjectPosition : function(objectW,objectH)
					{
						if(Ext.isIE)
						{
							return [(document.body.clientWidth-objectW),(document.body.clientHeight-objectH)];
						}
						else if(Ext.isGecko)
						{
							return [window.innerWidth-objectW,window.innerHeight-objectH];
						}
						else
						{
							return [window.innerWidth-objectW,window.innerHeight-objectH];
						}
					}
				
				  //scroll position
				   ,getScrollPosition : function()
					{
						if(Ext.isIE)
						{
							return [document.body.scrollLeft,document.body.scrollTop || document.documentElement.scrollTop];
						}
						else if(Ext.isGecko)
						{
							return [window.pageXOffset,window.pageYOffset];
						}
						else
						{
							return [window.pageXOffset,window.pageYOffset];
						}
					}
				   /**
				   * ajax call ,base on Ext.Ajax
				   */
				   ,ajaxCall:function( option ){
				   	   //load mask
				   		top.window.DO.showLoading();
				   		var opt = Ext.applyIf(option,{
				   		   disableCaching : false
						  ,success : function(o){
						   	 //hide load mask
						   	  top.window.DO.hideLoading();
						   	  var r = {};
						   	  try{r = eval('('+(o.responseText)+')');}catch(e){}
						   	  switch(r.flag){
						   	  	case '0':
						   	  		top.DO.msgE(r.msg);
						   	  	break;
						   	  	
						   	  	case '1':
							   	  	if(r.fn){
							   	  	 	//success call back
							   	  	 	var scb = new Function('',r.fn);
							   	  	 	scb();
							   	  	 	//scb 	= null;
							   	  	 }
							   	  	 top.DO.msgT(r.msg,'');
						   	  	break;
						   	  	
						   	  	case '2':
						   	  		var scb = function(){};
						   	  		if(r.fn){
							   	  	 	//success call back when click 'OK' button
							   	  	 	scb = new Function('',r.fn);
							   	  	 	top.DO.msgI(r.msg,scb);
							   	  	 }
							   	  	 top.DO.msgI(r.msg,scb);
							   	  	 scb = null;
						   	  	break;
						   	  	
						   	  	default :
						   	  		top.DO.msgW(o.responseText);
						   	  	break;
						   	  }
						   }
						   ,failure : function(o){
							   	//hide load mask
						   		top.window.DO.hideLoading();
						   		Ext.Msg.alert('警告','请求失败!');
						   }
						})
				   		
						Ext.Ajax.request(opt);
						return false;
				   }
				   /**
				   * 表单提交封装函数
				   */
				 ,formPost : function( fid){
				  	var fid    = fid || 'adminForm';
				  	var frmObj = Ext.getDom(fid);
				  	//form.action is empty
				  	if(!frmObj.action) {DO.msgE('请确保form.action不为空'); return;}
				  	//validate
				  	if(!FIC_checkForm( fid )) 
					{
						top.DO.msgE('请确保表单填写正确!');
						return false;
					}
					
					return DO.ajaxCall({
						form 		: 'adminForm'
					   ,isUpload     : self.enctype == 'multipart/form-data' ? true : false
					   //,callBack    : function(){location.href = location.href;}
					})
					
				  }
				 
				})
				//top.window.DO END
				top.window.DO.loadingMask();
		})
	}
})()