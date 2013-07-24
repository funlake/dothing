define({
	render : function(id,data){
		require(['text!widget/iconlist.html','language'],function(tmpl,lang){
			var recordHtml = [],len = data.length;
			if(len > 0){
				$.each(data,function(k,v){
					recordHtml[recordHtml.length] = tmpl.replace(/@(\w+)/g,function(_,$1){
						return v[$1] || _;
					});
				});
				recordHtml[recordHtml.length-1] = recordHtml[recordHtml.length-1].replace('ui-li ui-btn-up-c','ui-li ui-li-last ui-btn-up-c'); 
				$('#'+id).append(recordHtml.join(""));
			}
			else{
				$.eventMap.alert("No response data...");
			}
		});
	}
});