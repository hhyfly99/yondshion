/**
 * 
 */
var action = '';
var o = '';

function getAction() {
	$('#submitbutton').click(function(){
		var actionStr = window.location.pathname;
		action = actionStr.substr(actionStr.lastIndexOf('/')+1, actionStr.length);
	});
}

function showProtocol() {
	$('#memberProtocol').colorbox();
}

function signUpFormAjax() {
	$('input').blur(function(){
		var formElememtId = $(this).attr('id');
		//alert(formElememtId);
		signUpFormValidation(formElememtId);
		
	});
}

function signUpFormValidation(id){
	var url = 'SignUpFromValidation';
	var data = {};
	$('input').each(function(){
		data[$(this).attr('name')] = $(this).val();
	});
	//console.log(data);
	
	$.post(url, data, function(resp){
		//console.log(resp);
		$("#"+id).parent().find('.errors').remove();
		$("#"+id).parent().append(getSignUpError(resp[id], id));
	}, 'json');
}

function agreementValidation(){
	$('#agreement').click( function(){
		var data = $('#agreement').val();
		alert(data);
		//if( $(this).is(':checked') )
			//alert("checked");
	});
	//data = $('#agreement').val();
	
	/*
	$.post(url, data, function(resp){
		//console.log(resp);
		$("#"+id).parent().find('.errors').remove();
		$("#"+id).parent().append(getSignUpError(resp[id], id));
	}, 'json');
	*/
}

function getSignUpError(formErrors, id){
	o = '<ul id="errors-'+id+'" class=errors>';
	//console.log(formErrors);
	for(errorKey in formErrors){
		o += '<li>' + formErrors[errorKey] + '</li>';
	}
	o += '</ul>';
	return o;
}

/*
function getSignUpError(formErrors , id){
	var o = '<ul id="errors-"'+id+'class=errors>';
	for(errorKey in formErrors){
		o += '<li>' + formErrors[errorKey] + '</li>';
	}
	
	o += '</ul>';
	return o;
}
*/

function checkSignUpForm() {
	var userName = $.trim($('[name=userName]').val());
	
}
 
$(document).ready(function(){
	checkSignUpForm();
	showProtocol();
	signUpFormAjax();
	agreementValidation();
});

