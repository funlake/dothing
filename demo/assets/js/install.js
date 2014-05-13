define(['jquery','raptor'],function($,_){
	return {
		run : function(route){
			switch(route){
				case 'index_check' : 
					$("li.list-group-item").each(function(){
						if($(this).hasClass("fail")){
							$("#next-btn").addClass("disabled");
							return false;
						}
					});
					$(function(){
						require(["text!plugin/css/raptor/raptor.css"],function(_c){
							var $ = jQuery;
							$("body").raptor({
							    autoEnable: true,
								enableUi: true,
								unloadWarning: false,
								classes: 'raptor-editing-inline',
								plugins: {
								    textBold: true,
								    textItalic: true,
								    textUnderline: true,
								    textStrike: true,
								    textBlockQuote: true,
								    textSizeDecrease: true,
								    textSizeIncrease: true,
								    dock: {
								        docked: true,
								        dockToElement: true
								    },
								    unsavedEditWarning: false
								}
							});
						})	
					})

					
				break;
			}
		}
	}
})