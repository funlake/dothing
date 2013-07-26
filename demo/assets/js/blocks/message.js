define(['jquery'],function($){
	return {
		closeInit  : function(){
			//var $ = jQuery;
			$(function(){
				$('#msg-close').click(function(){
					$('#msg-row').fadeOut();
				})
			})
		}
	}
})