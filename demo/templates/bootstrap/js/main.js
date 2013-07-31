require.config({
	catchError : true
          ,paths : {
	         // 'jq'		: ['jquery']
	}
	//depends config
    ,shim : {
                          'bootstrap' : ['jquery'],
         	         'app' : [
         	         		'jquery',
         	         		'text',
                                            'bootstrap'
       //   	         		'bootstrap-transition',
    			// 'bootstrap-alert',
    			// 'bootstrap-modal',
    			// 'bootstrap-dropdown',
    			// 'bootstrap-scrollspy',
    			// 'bootstrap-tab',
    			// 'bootstrap-tooltip',
    			// 'bootstrap-popover',
    			// 'bootstrap-button',
    			// 'bootstrap-collapse',
    			// 'bootstrap-carousel',
    			// 'bootstrap-typeahead'
    		],
                  'form' : ['jquery','chosen_jquery','plugin/validation_jquery']

         }
    ,waitSeconds: 15
});

require(['app'],function(app){
	app.run();
});