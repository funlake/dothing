define(['jquery'],function($){
	var mod = {
		'__construct' : function(){
			require(['bootstrap'],function($bootstrap){
				// $('#clear_seesion').click(function(){
				// 	// $.ajax($('#Afm'),function(data){
				// 	// 	alert(data);
				// 	// })
				// })
			})
		},
		'index' : function(){
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
		}
	}
	return mod;
});