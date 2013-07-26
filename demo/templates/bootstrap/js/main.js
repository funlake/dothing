require.config({
	catchError : true
          ,paths : {
	         // 'jq'		: ['jquery']
	}
	//depends config
    ,shim : {
         	         'app' : [
         	         		'jquery',
         	         		'text',
         	         		'bootstrap-transition',
    			'bootstrap-alert',
    			'bootstrap-modal',
    			'bootstrap-dropdown',
    			'bootstrap-scrollspy',
    			'bootstrap-tab',
    			'bootstrap-tooltip',
    			'bootstrap-popover',
    			'bootstrap-button',
    			'bootstrap-collapse',
    			'bootstrap-carousel',
    			'bootstrap-typeahead'
    		]
         }
    ,waitSeconds: 15
});

require(['app'],function(app){
	app.run();
});