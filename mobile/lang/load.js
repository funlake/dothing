define(function(){
	return {
		modLang 	: null
	          ,globalLang	: null
	          ,render : function(){
	          		var self 	= this;
	          		var page 	= $.fpage;
			require(['lang/'+this.getDefaultLang()+'/'+page,'lang/'+this.getDefaultLang()+'/global'],function(modLang,globalLang){
				$('*[multilang]').each(function(_,_this){
					if(modLang[$(_this).attr('multilang')]){
						_this.innerHTML = modLang[$(_this).attr('multilang')];
					}
					else if(globalLang[$(_this).attr('multilang')]){
						_this.innerHTML = globalLang[$(_this).attr('multilang')];
					}
				});
				self.modLang		= modLang;
				self.globalLang	= globalLang;
	          		})
		}
	          ,widgetRender: function(){
			require(['lang/'+this.getDefaultLang()+'/global'],function(globalLang){
				$('*[multilang]').each(function(_,_this){
					if(globalLang[$(_this).attr('multilang')]){
						_this.innerHTML = globalLang[$(_this).attr('multilang')];
					}
				})
	          		})	          		
	          }
	          //must call after render function invoked.
	         ,get : function(_var){
	         		return this.modLang[_var] || this.globalLang[_var]
	         }
	         ,getDefaultLang : function(){
	          		return 'en';
	          }
	}
})