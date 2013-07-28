define(['jquery','plugin/validation_jquery'],function($){
	var rules ={
		'([^_]+)_(edit|add)[^_]*$' : function(_,$1){
			if(typeof mod[$1] !== "undefined"){
				mod[$1].apply(mod,[]);
			}
			//require(['plugin/validation_jquery'],function(){
			$(function(){
				$('#submitForm').click(function(){
					if($('#Afm').validate()){
						$('#Afm').submit();
					}
				});
				require(['form'],function(){
					$('.chzn-select').chosen()
				})
			})	
				
			//})
		}

	}
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
			});
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
			else{
				for(var i in rules){
					route.replace(new RegExp(i),rules[i]);
				}
			}
		}
	}
	return mod;
})