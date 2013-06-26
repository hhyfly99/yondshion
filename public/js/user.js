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
	$('#membershipProtocol').colorbox();
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
});

