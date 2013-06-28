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
	$('input').blur(function(){
		var formElememtId = $(this).attr('name');
		
		signUpFormValidation(formElememtId);
		
	});
}

function signUpFormValidation(formElememtId){
	var url = 'SignUpFromValidation';
	var data = {};
	var firstItem = '';
	$('input').each(function(){
		data[$(this).attr('name')] = $(this).val();
		/*
		$.post(url, data, function(resp){
			//console.log(resp);
			for(i in resp){
				for(j in resp[i]){
					//console.log(resp[i][j]);
					//alert(getSignUpError(resp[i][j]));
					$(this).parent().append(getSignUpError(resp[i][j]));
				}
			}
			//$("#"+id).parent().append(getSignUpError(resp[id], id));
		}, 'json');
		*/
		$.post(url, data, function(resp){
			//console.log(resp);
			for(var i in resp){
				//console.log([i]+':'+resp[i]);
				if(resp.hasOwnProperty(i)){
					firstItem = resp[i];
					break;
				}
			}
			//console.log(firstItem);
			
		}, 'json');
		
		//alert($(this).val());
		$(this).parent().append(getSignUpError(firstItem));
	});
	
	/*
	$.post(url, data, function(resp){
		//console.log(resp);
		for(var i in resp){
			//console.log([i]+':'+resp[i]);
			if(resp.hasOwnProperty(i)){
				var firstItem = resp[i];
				break;
			}
		}
		//console.log(firstItem);
		
		for(i in resp){
			for(j in resp[i]){
				console.log(resp[i][j]);
				//$("#"+id).parent().append(getSignUpError(resp[i][j])));
			}
		}
		
		//$("#"+id).parent().append(getSignUpError(resp[id], id));
	}, 'json');
	*/
}

function getSignUpError(errorString){
	var o = '<ul id="errors" class=errors>';
	o += '<li>' + errorString + '</li>';
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
	signUpFormAjax();
});

