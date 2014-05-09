define(['jquery'],function($){
	return {
		run : function(route){
			switch(route){
				case 'index_check' : 
					$("li.list-group-item").each(function(){
						if($(this).hasClass("fail")){
							$("#next-btn").addClass("disabled");
							return false;
						}
					})
				break;
			}
		}
	}
})