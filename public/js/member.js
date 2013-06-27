/**
 * 
 */
var action = '';

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
	/*
	$('input').blur(function(){
		var formElememtId = $(this).attr('name');
		var data = {};
		$('input').each(function(){
			data[$(this).attr('name')] = $(this).val();
			
		});
	});
	console.log(data);
	*/
	$('input').blur(function(){
		var formElememtId = $(this).attr('name');
		
		signUpFormValidation(formElememtId);
		
	});
}

function signUpFormValidation(formElememtId){
	var url = 'member/SignUp';
	var data = {};
	$('input').each(function(){
		data[$(this).attr('name')] = $(this).val();
		
	});
	$.post(url, data, function(resp){
		console.log(resp);
	}, 'json');
	
}

function checkSignUpForm() {
	var userName = $.trim($('[name=userName]').val());
	/*
	$('[name=userMail]').val();
	$('[name=userPhone]').val();
	$('[name=userPasswd]').val();
	$('[name=userPasswdComfirm]').val();
	$('[name=captcha[input]]').val();
	$('[name=agreement]').val();
	*/
	/*
	if(userName == ''){
		alert('trim ok');
	}
	*/
	/*
	console.log(userName);
	*/
}
 
$(document).ready(function(){
	checkSignUpForm();
	showProtocol();
	signUpFormValidateAction();
});

