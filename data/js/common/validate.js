/** form validate **/

//==================================================================================================================
//  Trim Whitespace
//------------------------------------------------------------------------------------------------------------------
String.prototype.trim=function(){ 
	return this.replace(/^\s*|\s*$/g,'');
}
String.prototype.ltrim=function(){
	return this.replace(/^\s*/g,'');
}
String.prototype.rtrim=function(){
	return this.replace(/\s*$/g,'');
}

//==================================================================================================================
//  FIC_checkForm
//  Form Input Checking by JC
/*
		Apply these class names to form elements:
		
		* validate-username (a valid username, rolename)
		* required (not blank)
		* validate-number (a valid number)
		* validate-positive  (a positive number)
		* validate-digits (digits only, spaces allowed.)
		* validate-alpha (letters only)
		* validate-alphanum (only letters and numbers)
		* validate-date (a valid date value)
		* validate-email (a valid email address)
		* validate-url (a valid URL)
		* validate-date-au (a date formatted as; dd/mm/yyyy)
		* validate-currency-dollar (a valid dollar value)
		* validate-one-required (At least one checkbox/radio element must be selected in a group)
		* validate-not-first (Selects only, must choose an option other than the first)
		* validate-not-empty (Selects only, must choose an option with a value that is not empty)
		* validate-verifypassword ( password and verify password must same)
		* validate-int (a valid integer)
		
		Also, you can specify this attribute for text, passwird and textarea elements:
		* minlength="x" (where x is the minimum number of characters)
*/
//------------------------------------------------------------------------------------------------------------------
var xGetElementById = function($){return document.getElementById($);}
function FIC_checkForm(e) {
	var errs = new Array();
	
	//this function is called when a form is submitted.
	if (typeof(e) == "string") {
		//the id was supplied, get the object reference
		e = xGetElementById(e);
		if (!e) {
			return true;
		}
	}
	
	var elm=e;
	if (!e.nodeName) {			
		//was fired by yahoo
		elm = (e.srcElement) ? e.srcElement : e.target;
	}
	if (elm.nodeName.toLowerCase() != 'form') {
		elm = searchUp(elm,'form');
	}
	//alert(elm);
	
	var all_valid = true;
	
	//access form elements
	//inputs
	var f_in = elm.getElementsByTagName('input');
	//selects
	var f_sl = elm.getElementsByTagName('select');
	//textareas
	var f_ta = elm.getElementsByTagName('textarea');
	
	//check inputs
	for (i=0;i<f_in.length;i++) {
		if (f_in[i].type.toLowerCase() != 'submit' && f_in[i].type.toLowerCase() != 'button' && f_in[i].type.toLowerCase() != 'hidden') {
			if (isVisible(f_in[i])) {
				
				var cname = ' '+f_in[i].className.replace(/^\s*|\s*$/g,'')+' ';
				cname = cname.toLowerCase();
				var inv = f_in[i].value.trim();
				var t = f_in[i].type.toLowerCase();
				var cext = '';
				if (t == 'text' || t == 'password') {
					//text box
					var valid = FIC_checkField(elm,cname,f_in[i]);
				} else if(t == 'radio' || t == 'checkbox'){
					// radio or checkbox
					var valid = FIC_checkRadCbx(cname,f_in[i],f_in);
					cext = '-cr';
				} else {
					var valid = true;
				}
				
				if (valid) {
					removeClassName(f_in[i],'validation-failed'+cext);
					addClassName(f_in[i],'validation-passed'+cext);
				} else {
					removeClassName(f_in[i],'validation-passed'+cext);
					addClassName(f_in[i],'validation-failed'+cext);
					//try to get title
					if (f_in[i].getAttribute('title')){
						errs[errs.length] = f_in[i].getAttribute('title');
					}
					all_valid = false;
				}
			}
		}
	} //end for i
	
	//return false;
	//check textareas
	for (i=0;i<f_ta.length;i++) {
		if (isVisible(f_ta[i])) {
			var cname = ' '+f_ta[i].className.replace(/^\s*|\s*$/g,'')+' ';
			cname = cname.toLowerCase();
			var valid = FIC_checkField(elm,cname,f_ta[i]);
			
			if (valid) {
				removeClassName(f_ta[i],'validation-failed');
				addClassName(f_ta[i],'validation-passed');
			} else {
				removeClassName(f_ta[i],'validation-passed');
				addClassName(f_ta[i],'validation-failed');
				//try to get title
				if (f_ta[i].getAttribute('title')){
					errs[errs.length] = f_ta[i].getAttribute('title');
				}
				all_valid = false;
			}
		}
	} //end for i
	
	//check selects
	for (i=0;i<f_sl.length;i++) {
		if (isVisible(f_sl[i])) {
			var cname = ' '+f_sl[i].className.replace(/^\s*|\s*$/g,'')+' ';
			cname = cname.toLowerCase();
			var valid = FIC_checkSel(cname,f_sl[i]);
			if (valid) {
				removeClassName(f_sl[i],'validation-failed-sel');
				addClassName(f_sl[i],'validation-passed-sel');
			} else {
				removeClassName(f_sl[i],'validation-passed-sel');
				addClassName(f_sl[i],'validation-failed-sel');
				//try to get title
				if (f_sl[i].getAttribute('title')){
					errs[errs.length] = f_sl[i].getAttribute('title');
				}
				all_valid = false;
			}
		}
	} //end for i
	
	if (!all_valid) {
		if (errs.length > 0){
			//Ext.Msg.alert('Error',"We have found the following error(s):<br/><br/>  * "+errs.join("<br/>  * ")+"<br/><br/>Please check the fields and try again");
		} else {
			//Ext.Msg.alert('Error',"We have found the following error(s):<br/><br/>  * "+errs.join("<br/>  * ")+"<br/><br/>Please check the fields and try again");

		}
		return false;
		//YAHOO.util.Event.stopEvent(e);
	}
	else
	{
		return true;	
		//YAHOO.util.Event.stopEvent(e);
		//handleForm(elm.id, elm.action);
	}		
	//return all_valid;
} // end FIC_checkForm

//==================================================================================================================
//  FIC_checkField
//	c = className
//	e = the element
//------------------------------------------------------------------------------------------------------------------
function FIC_checkField(elm,c,e) {
	var valid = true;
	var t = e.value.trim();
	
	//search for username
	if (c.indexOf(' username ') != -1 && t.length == 0) {
		//required found, and not filled in
		valid = false;
	}
	
	//check length and chars
	if (c.indexOf(' username ') != -1){
		//check for minlength.
		var m = e.getAttribute('minlength');
		if (m && Math.abs(m) > 0){
			if (e.value.length < Math.abs(m)){
				valid = false;
			}
		}
		// check chars
		var r = new RegExp("[\<|\>|\"|\'|\%|\;|\(|\)|\&|\+]", "i");
		if (r.exec(t))
		{
			valid = false;
		}
	}
	
	//search for required
	if (c.indexOf(' required ') != -1 && t.length == 0) {
		//required found, and not filled in
		valid = false;
	}
	
	//check length and chars
	if (c.indexOf(' required ') != -1){
		//check for minlength.
		var m = e.getAttribute('minlength');
		if (m && Math.abs(m) > 0){
			if (e.value.length < Math.abs(m)){
				valid = false;
			}
		}
		// check chars
		var r = new RegExp("[\<|\>]", "i");
		if (r.exec(t))
		{
			valid = false;
		}
	}

	//search for validate-  
	if (c.indexOf(' validate-number ') != -1 && isNaN(t) && t.match(/[^\d]/)) {
		//number bad
		valid = false;
	} else if (c.indexOf(' validate-digits ') != -1 && t.replace(/ /,'').match(/[^\d]/)) {
		//digit bad
		valid = false;
	} else if (c.indexOf(' validate-alpha ') != -1 && !t.match(/^[a-zA-Z]+$/)) {
		//alpha bad
		valid = false;
	} else if (c.indexOf(' validate-alphanum ') != -1 && t.match(/\W/)) {
		//alpha bad
		valid = false;
	} else if (c.indexOf(' validate-date ') != -1) {
		var d = new date(t);
		if (isNaN(d)) {
			//date bad
			valid = false;
		}
	} else if (c.indexOf(' validate-email ') != -1 && !t.match(/\w{1,}[@][\w\-]{1,}([.]([\w\-]{1,})){1,3}$/)) {
		//email bad
		valid = false;
		if (c.indexOf(' required ') == -1 && t.length == 0) {
			valid = true;
		}
	} else if (c.indexOf(' validate-url ') != -1 && !t.match(/^(http|https|ftp):\/\/(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+)(:(\d+))?\/?/i)) {
		//url bad
		valid = false;
	} else if (c.indexOf(' validate-date-au ') != -1 && !t.match(/^(\d{2})\/(\d{2})\/(\d{4})$/)) {
		valid = false;
	} else if (c.indexOf(' validate-currency-dollar ') != -1 && !t.match(/^\$?\-?([1-9]{1}[0-9]{0,2}(\,[0-9]{3})*(\.[0-9]{0,2})?|[1-9]{1}\d*(\.[0-9]{0,2})?|0(\.[0-9]{0,2})?|(\.[0-9]{1,2})?)$/)) {
		valid = false;
	} else if(c.indexOf(' validate-verifypassword ') != -1 && elm.pass.value != elm.v_pass.value ){
		valid = false;
	}else if (c.indexOf(' validate-int ') != -1 ) {
		if( parseInt(t).toString()!=t) //(isNaN(t) && t.match(/[^\d]/)) || t<0  ,such as 1.0
		//integer bad
		valid = false;
	}
	//alert(t);
	//return false;
	return valid;
}

//==================================================================================================================
//  FIC_checkRadCbx
//	c = className
//	e = this element, radio or checkbox
//	f = input fields dom element
//------------------------------------------------------------------------------------------------------------------
function FIC_checkRadCbx(c,e,f){
	var valid = true;
	
	//search for required
	if (c.indexOf(' validate-one-required ') != -1) {
		//required found
		//check if other checkboxes or radios have been selected.
		valid = false;
		for (var i=0;i<f.length;i++){
			if(f[i].name.toLowerCase() == e.name.toLowerCase() && f[i].checked){
				valid = true;
				break;
			}
		}
	}
	
	return valid;
}

//==================================================================================================================
//  FIC_checkSel
//	c = className
//	e = this select element
//------------------------------------------------------------------------------------------------------------------
function FIC_checkSel(c,e){
	var valid = true;
	//search for validate-  
	if (c.indexOf(' validate-not-first ') != -1 && e.selectedIndex == 0) {
		//bad
		valid = false;
	} else if (c.indexOf(' validate-not-empty ') != -1 && e.options[e.selectedIndex].value.length == 0) {
		//bad
		valid = false;
	}
	return valid;
}

//==================================================================================================================
//  addClassName
//------------------------------------------------------------------------------------------------------------------
function addClassName(e,t) {
	if (typeof e == "string") {
		e = xGetElementById(e);
	}
	//code to change and replace strings
	var ec = ' ' + e.className.replace(/^\s*|\s*$/g,'') + ' ';
	var nc = ec;
	t = t.replace(/^\s*|\s*$/g,'');
	//check if not already there
	if (ec.indexOf(' '+t+' ') == -1) {
		//not found, add it
		nc = ec + t;
	}
	//return the changed text!
	e.className = nc.replace(/^\s*|\s*$/g,''); //trimmed whitespace
	return true;
}

//==================================================================================================================
//  removeClassName
//------------------------------------------------------------------------------------------------------------------
function removeClassName(e,t) {
	if (typeof e == "string") {
		e = xGetElementById(e);
	}
	//code to change and replace strings
	var ec = ' ' + e.className.replace(/^\s*|\s*$/g,'') + ' ';
	var nc = ec;
	t = t.replace(/^\s*|\s*$/g,'');
	//check if not already there
	if (ec.indexOf(' '+t+' ') != -1) {
		//found, so lets remove it
		nc = ec.replace(' ' + t.replace(/^\s*|\s*$/g,'') + ' ',' ');
	}
	//return the changed text!
	e.className = nc.replace(/^\s*|\s*$/g,''); //trimmed whitespace
	return true;
}

//==================================================================================================================
//  attachToForms
//------------------------------------------------------------------------------------------------------------------
function attachToForms(e) {
	//search dom for all forms
	var frms = document.getElementsByTagName('form'); 
	for(var i=0;i<frms.length;i++) {
		YAHOO.util.Event.addListener(frms[i], "submit", FIC_checkForm);
	}
}

//==================================================================================================================
//  isVisible
//------------------------------------------------------------------------------------------------------------------
function isVisible(e) {
	//returns true is should be visible to user.
	if (typeof e == "string") {
		e = xGetElementById(e);
	}
	while (e.nodeName.toLowerCase() != 'body' && e.style.display.toLowerCase() != 'none' && e.style.visibility.toLowerCase() != 'hidden') {
		e = e.parentNode;
	}
	if (e.nodeName.toLowerCase() == 'body') {
		return true;
	} else{
		return false;
	}
}