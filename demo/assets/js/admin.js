define(['jquery'],function($){
	var mod = {
		'__construct' : function(){
			/** List page status change **/
			$('.status_trigger').click(function(){
				var self = $(this);
				$.getJSON(self.attr("src"),function(data){
					if(data.flag){
					  //success change status
					  if(self.hasClass('publish')){
					  	self.removeClass("publish").addClass("unpublish")
					  }else{
					  	self.removeClass("unpublish").addClass("publish")
					  }
					}
				})
			})
		},
		'user' : function(){
			mod.__construct();

		},
		'user_index' : function(){
			//mod.user();

		},
		'user_group' : function(){
			//mod.user();
		},
		'user_login' : function(){
			//alert($)
		},
		'run' : function(route){
			var t = route.split('_'),c = t[0];
			if(typeof mod[c] != "undefined"){
				mod[c].apply(mod,[]);
			}
			if(typeof mod[route] != "undefined"){
				mod[route].apply(mod,[]);
			}
		}
	}
	return mod;
})