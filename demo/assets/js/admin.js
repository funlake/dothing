define(['app'],function(_){
	return {
		'__construct' : function(){

		},
		'user' : function(){

		},
		'user_index' : function(){
		       // this.user();
		        //this.__construct();
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
		}
	}

})