// JavaScript Document

$(document).ready(function(){
	
	//prepare a working url depending on the environment
	var siteHostName = window.location.hostname;
	var localHostOrNot, ajaxLocalhostOrNot;
	
	if (siteHostName == "localhost") {
		ajaxLocalhostOrNot = "/offshore/";
	}else {
		ajaxLocalhostOrNot = "/";
	}
	
	
	$("form#contact-forms").submit(function() {
		var errorMsg = "";
		
		//display the loading icon div
		var contactFormErrorMessage = $("div#contactFormErrorMessage");
		contactFormErrorMessage.fadeIn();
		
		var firstName = $(this).find('input[name=name]').val();
		var userEmail = $(this).find('input[name=email]').val();
		//var userPhone = $(this).find('input[name=userPhone]').val();
		var userMessage = $(this).find('textarea[name=message]').val();
		var userSubject = $(this).find('input[name=subject]').val();
		
		/**VALIDATE FIRSTNAME**/
		if (inputEmpty(firstName)) {
			if (!inputAlphabet(firstName)) {
				errorMsg += '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Name Field Can Only Contain Alphabetic Characters.</div>';
			}
		}else {
			errorMsg += '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Name Field Cannot Be Empty.</div>';
		}
		
		/**VALIDATE Useremail**/
		if (inputEmpty(userEmail)) {
			if (!ValidateEmail(userEmail)) {
				errorMsg += '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Invalid Email Format.</div>';
			}
		}else {
			errorMsg += '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Email Field Cannot Be Empty.</div>';
		}
		
		/**VALIDATE MESSAGE**/
		if (!inputEmpty(userSubject)) {
			errorMsg += '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Subject Field Cannot Be Empty.</div>';
		}
		
		/**VALIDATE SUBJECT**/
		if (!inputEmpty(userMessage)) {
			errorMsg += '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Message Field Cannot Be Empty.</div>';
		}
		
		
		if (errorMsg == "") {
			
			var link2 = "email_submission/email.php";
			var dataArray = { name : firstName, email : userEmail, subject : userSubject, message : userMessage, ajax : 1, };
					
			$.post(ajaxLocalhostOrNot + link2, dataArray, function(data) {
				if (data == "success") {
					var successMsg = '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> Your Message Has Been Sent Successfully.</div>';
					contactFormErrorMessage.html(successMsg);
				}else {
					var notSentMsg = '<div class="alert alert-warning"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> Your Message Was Not Sent. Try Again Later.</div>';
					contactFormErrorMessage.html(notSentMsg);
				}
			});
		}else {
			contactFormErrorMessage.html(errorMsg);
		}
		
		//alert("userName: " + userName + " userEmail: " + userEmail + " userPhone: " + userPhone + " message: " + userMessage);
		
		return false;
	});
});


function inputEmpty(data) {
	if (data != "") {
		return true;
	}else {
		return false;
	}
}

function inputAlphabet(inputtext) {
	var alphaExp = /^[a-zA-Z\s\.]+$/;
	if (inputtext.match(alphaExp)) {
		return true;
	} else {
		return false;
	}
}

function inputNumeric(inputtext) {
	var alphaExp = /^[0-9]{11}$/;
	if (inputtext.match(alphaExp)) {
		return true;
	} else {
		return false;
	}
}

function ValidateEmail(uemail)  {  
	var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  
	if(uemail.match(mailformat))  {  
		return true;  
	}  
	else {  
		return false;  
	}  
}

