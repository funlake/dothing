require.config({
	paths : {
		'api'			: ['base/api']
	        ,  'language'		: ['lang/load']
	        ,	'phonegap'		: ['lib/phonegap/cordova-2.1.0']
	        ,  'appconfig'		: ['config/app']
	        ,	'text'			: ['lib/jquery/plugin/text']
	}
	//depends config
         ,shim : {
         }
});
// A template loader plugin
require(['text'],function(){

});
/** some map between browser and mobile platform **/
$.fevent = {
	'click'  : requirejs.isBrowser ? 'click' : 'tap',
	'alert' : requirejs.isBrowser ? alert : navigator.notification.alert
}