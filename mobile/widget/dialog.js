define(function(){
	return {
	           'dlgs' : {}
/*	          ,'atoz' : function(){
	          		var chars = [];
	          		for(var i=0;i<26;i++){
	          			chars[chars.length] = String.fromCharCode(97+i);
	          		}
	          		return chars;	
	          }()
	          ,'randomId' : function(){
	          		var shuffer = this.atoz.sort(function(){
	          			return Math.pow(-1,Math.floor(Math.random() * 2 + 1));
	          		});
	          		return (shuffer.splice(0,7).join(''))+ (Date.parse(new Date()));
	          }*/
	         ,'confrim' : function(identify,title,body,okCb,cancelCb){
	         		var page = $.fpage,dialogId = page+identify;
	         		if(!this.dlgs["confirm_"+dialogId]){
	         			this.dlgs["confirm_"+dialogId] = true;
	         			var self	= this;
				require(['text!widget/dialog_confirm.html','language'],function(tmpl,lang){
					var parseHtml	= tmpl.replace(/@id/g,dialogId).replace(/@title/,title).replace(/@content/,body);
					$('#page_'+page).append(parseHtml).trigger('create');
					//replace language
					lang.widgetRender();
					//configure events
					if(typeof okCb == "function"){
						
						$('#'+dialogId+'_yes').live($.fevent.click,function(){
							okCb.apply(self,[self,dialogId]);
						});			
					}
					if(typeof cancelCb == "function"){
						$('#'+dialogId+'_no').live($.fevent.click,function(){
							cancelCb.apply(self,[self,dialogId]);
						})			
					}
					//asyn call
					$('#'+dialogId+'_trigger').trigger($.fevent.click);
				})
			}
			else{
				//sync call
				$('#'+dialogId+'_trigger').trigger($.fevent.click);
			}
		}
	         ,'info' : function(title,body,okCb){
	         		var dialogId = "msgbox",page = $.fpage;
	         		if(!this.dlgs["info_"+dialogId+title+body]){
	         			this.dlgs["info_"+dialogId+title+body] = true;
	         			var self	= this;
				require(['text!widget/dialog_info.html','language'],function(tmpl,lang){
					var parseHtml	= tmpl.replace(/@id/g,dialogId).replace(/@title/,title).replace(/@content/,body);
					$('#page_'+page).append(parseHtml).trigger('create');
					lang.widgetRender();
					if(typeof okCb == "function"){
						$('#'+dialogId+'_yes').live($.fevent.click,function(){
							okCb.apply(self,[self,dialogId]);
						});			
					}
					//asyn call
					$('#'+dialogId+'_trigger').trigger($.fevent.click);
				})
			}
			else{
				//sync call
				$('#'+dialogId+'_title').html(title);
				$('#'+dialogId+'_content').html(body);
				$('#'+dialogId+'_trigger').trigger($.fevent.click);
			}	         	
	         }
	}
});