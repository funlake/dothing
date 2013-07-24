/** We did not load requirejs at this moment **/
$(document).bind('mobileinit',function(e,data){
	$.get('config/app.json',function(data){
		$.fconfig = eval('('+data+')');
	});
});
$(document).bind('pagebeforechange',function(e,data){
/*	$.fpage = data.toPage.attr('id').split('_')[1];
	console.log($.fpage);*/
	if(typeof data.toPage == "string"){
		$.fpage = data.toPage.replace(/^.*\/([^\/]+)\.html+$/,'$1');
	}
	else{
		$.fpage = (data.toPage.attr('id').split('_'))[1];
	}
	
})