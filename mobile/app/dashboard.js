require(['language','widget/dialog','widget/iconlist'],function(lang,dialog,iconlist) {
	lang.render();
	$('#mybtn').live($.fevent.click,function(){
		dialog.confrim('id_1',lang.get('confirm_title'),lang.get('confirm_body'),
			function(obj,id){
				console.log("ok:"+id);
			},
			function(obj,id){
				console.log("cancel:"+id);
			}
		);
	});
	$('#mybtn2').live($.fevent.click,function(){
		dialog.confrim('id_2',lang.get('confirm_title'),lang.get('confirm_body'),
			function(obj,id){
				console.log("ok:"+id);
			},
			function(obj,id){
				console.log("cancel:"+id);
			}
		);
	});
	$('#mybtn3').live($.fevent.click,function(e){
		dialog.info(lang.get('confirm_title'),lang.get('confirm_body'),
			function(obj,id){
				console.log("ok1:"+id);
			}
		);
	});
	$('#mybtn4').live($.fevent.click,function(e){
		dialog.info(lang.get('confirm_title'),lang.get('confirm_body')+'@@@',
			function(obj,id){
				console.log("ok2:"+id);
			}
		);
	});
	iconlist.render('p_list',[
		{link:"index.html",text:"go to index"},
		{link:"login.html",text:"go to login"},
		{link:"dashboard.html",text:"go to dashboard"}
	]);
	
});