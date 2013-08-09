define(['jquery'],function($){
	var rules ={
		'([^_]+)_(edit|add)[^_]*$' : function(_,$1){
			if(typeof mod[$1] !== "undefined"){
				mod[$1].apply(mod,[]);
			}
			//require(['plugin/validation_jquery'],function(){
			$(function(){
				$('#submitForm').click(function(){

				});
				require(['form'],function(){
					/** Chosen plugin setting **/
					var chosenSelect = $('.chzn-select');
					var recursiveSetDisable = function(id){
						var c = this.find("option[value="+id+"]");
						var self = this;
						if(c){
							c.attr("disabled","disabled");

							var d = this.find("option[parent="+id+"]")
							if(d){
								d.each(function(_,v){
									recursiveSetDisable.call(self,$(v).attr("value"));
									$(v).attr("disabled","disabled");
									
								});
							}
						}
					}
					chosenSelect.each(function(_,cv){
						var self = $(cv);
						var sids    = self.attr('default').split(',');
						$.each(sids,function(_,v){
							self.find("option[value="+v+"]").attr("selected","selected");
						})
						var dids     = (self.attr('disable')|| "").split(',');
						$.each(dids,function(_,v){
							if(v==="") return;
							recursiveSetDisable.call(self,v);
						})
						self.chosen({
							allow_single_deselect: true
						});
					})
				})
			})
		}

	}
	var mod = {
		'__construct' : function(){
			/** List page status change **/
			$('.status_trigger').click(function(e){
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
		'user_login' : function(){
			//alert($)
		},
		'user_permission' : function(){
			require(['plugin/masonry_jquery'],function(){
				var $container = $('.masonry');
				var gutter = 30;
				var min_width = 300;
				$container.imagesLoaded( function(){
				    $container.masonry({
				        itemSelector : '.box',
				        gutterWidth: gutter,
				        isAnimated: true,
				          columnWidth: function( containerWidth ) {
				            var box_width = (((containerWidth - 2*gutter)/3) | 0) ;

				            if (box_width < min_width) {
				                box_width = (((containerWidth - gutter)/2) | 0);
				            }

				            if (box_width < min_width) {
				                box_width = containerWidth;
				            }

				            $('.box').width(box_width);

				            return box_width;
				          }
				    });
				});
			})
		},
		'module':function(){
			mod.__construct();
		},
		'run' : function(route){
			var t = route.split('_'),c = t[0];
			if(typeof mod[c] != "undefined"){
				mod[c].apply(mod,[]);
			}
			if(typeof mod[route] != "undefined"){
				mod[route].apply(mod,[]);
			}
			for(var i in rules){
				route.replace(new RegExp(i),rules[i]);
			}
		}
	}
	return mod;
})