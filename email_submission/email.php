<?php

class Email {
	private $_name;
	private $_validName;
	private $_phone;
	private $_validPhone;
	private $_email;
	private $_validEmail;
	private $_message;
	private $_validMessage;
	private $_errorMessage;
	private $_successMessage;
	private $_recipient;
	private $_subject;
	private $_validSubject;
	private $_responseSubject = "THANK YOU FOR CONTACTING US";
	private $_body;
	private $_responseBody;
	private $_headers;
	private $_EmailSendingError;
	
	
	public function __construct() {
		$this->_name = $this->TestData($_POST["name"]);
		//$this->_phone = $this->TestData($_POST["phone"]);
		$this->_email = $this->TestData($_POST["email"]);
		$this->_message = $this->TestData($_POST["message"]);
		$this->_recipient = $_POST["recipient"];
		$this->_subject = $this->TestData($_POST["subject"]);
	}
	 
	public function Form_Preparation() {
		$this->AlphaCharacters($this->_name, "name");
		//$this->PhoneNumber($this->_phone);
		$this->Email($this->_email);
		$this->Message($this->_message);
		$this->AlphaCharacters($this->_subject, "subject");
	}
	
	public function sendEmail() {
		if (empty($this->_errorMessage)) {
			//THE METHOD BELOW SETS THE BODY PROPERTY
			$this->MessageBody();
			
			// Always set content-type when sending HTML email
			$this->_headers = "MIME-Version: 1.0" . "\r\n";
			$this->_headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			
			// More headers
			$this->_headers .= "From: X-CONCEPT (Trading) Limited <hello@xconcept-trading.com >" . "\r\n";
			
			//NOW SEND THE EMAIL
			if (mail($this->_recipient,$this->_validSubject,$this->_body,$this->_headers)) {
				
				//THE METHOD BELOW SETS THE AUTO RESPONSE BODY
				$this->AutoResponse();
				mail($this->_validEmail,$this->_responseSubject,$this->_responseBody,$this->_headers);
				
				//NOW STORE THE CLIENTS DETAILS INTO THE DATABASE.
				//$this->saveClientsDetails();
				
				//IF EVERTHING GOES FINE THEN RETURN A SUCCESS MESSAGE.
				$this->_successMessage = "success";
				
			}else {
				$this->_EmailSendingError = "error";
			}
		}
	}
	
	public function responseMessage() {
		if (empty($this->_errorMessage)) {
			if (empty($this->_successMessage)) {
				if (isset($_POST["ajax"]) && $_POST["ajax"] == 1) {
					echo $this->_EmailSendingError;
				}else {
					return $this->_EmailSendingError;
				}
				
			}else {
				if (isset($_POST["ajax"]) && $_POST["ajax"] == 1) {
					echo $this->_successMessage;
				}else {
					return $this->_successMessage;
				}
			}
		}else {
			return $this->_errorMessage;
		}
	}
	
	private function AlphaCharacters($data, $dataType) {
		if (empty($data)) {
			$this->_errorMessage .= '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>The ' . $dataType . " Field Cannot Be Empty</div>";
		}else {
			if (!preg_match("/[a-zA-Z0-9.]/", $data)) {
				$this->_errorMessage .= '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>The ' . $dataType . " Field Can Only Contain Alphabets</div>";
			}else {
				if ($dataType == "name") {
					$this->_validName = $data;
				}elseif($dataType == "subject") {
					$this->_validSubject = $data;
				}
				
			}
		}
	}
	
	private function Email($data) {
		if (empty($data)) {
			$this->_errorMessage .= '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>The Email Field Cannot Be Empty</div>';
		}else {
			// check if e-mail address is well-formed
			if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
				$this->_errorMessage .= '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Your Email Is Not Correct</div>';
    		}else {
				$this->_validEmail = $data;
			}
		}
	}
	
	private function PhoneNumber($data) {
		if (empty($data)) {
			$this->_errorMessage .= '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>The Phone Field Cannot Be Empty</div>';
		}else {
			if (!preg_match("/[0-9]/", $data)) {
				$this->_errorMessage .= '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please Type Your Phone Number Correctly</div>';
			}else {
				$this->_validPhone = $data;
			}
		}
	}
	
	private function Message($data) {
		if (empty($data)) {
			$this->_errorMessage .= '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>The Message Field Cannot Be Empty</div>';
		}else {
			$this->_validMessage = $data;
		}
	}
	
	private function TestData($data) {
		$data = trim($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
private function MessageBody() {
$this->_body = <<<BODY
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>X-CONCEPT (Trading) Limited</title>
<style type="text/css">
div.wrapper {
	width: 700px;
	margin: 0 auto;
}
@media screen and (max-width: 700px) {

div.wrapper {
	width: 100%;
}

}
</style>
</head>
<body style="margin: 0; padding: 0;">
<div class="wrapper" height: auto; overflow:hidden; background-color: #EBEBEB;">
	<div style="width: 100%; height: auto; overflow: hidden; background: #191919;">
		<a href="http://xconcept-trading.com" target="_blank" style="text-decoration: none;">
			<h2 style="color: #FFF; font-family: Arial, Helvetica, sans-serif; text-align: center;">X-CONCEPT (Trading) Limited</h2>
        </a>
	</div>
	<div style="width: 96%; padding: 15px 2%; height: auto; overflow: hidden">
		<h3 style="color: #979797; font-family: Arial, Helvetica, sans-serif;">Name: </h3>
		<p style="font-family: Verdana, Geneva, sans-serif; font-size: 16px; color: #1E1E1E;">$this->_validName</p>
		<h3 style="color: #979797; font-family: Arial, Helvetica, sans-serif;">Email: </h3>
		<p style="font-family: Verdana, Geneva, sans-serif; font-size: 16px; color: #1E1E1E;">$this->_validEmail</p>
        <h3 style="color: #979797; font-family: Arial, Helvetica, sans-serif;">Subject: </h3>
		<p style="font-family: Verdana, Geneva, sans-serif; font-size: 16px; color: #1E1E1E;">$this->_validSubject</p>
		<h3 style="color: #979797; font-family: Arial, Helvetica, sans-serif;">Message: </h3>
		<p style="font-family: Verdana, Geneva, sans-serif; font-size: 16px; color: #1E1E1E;">$this->_validMessage</p>
	</div>
	<div style="width: 96%; height: auto; overflow: hidden; padding: 0 2%; background: #000;">
		<p style="color: #FFF; font-family: Arial, Helvetica, sans-serif; text-align: center;">X-CONCEPT (Trading) Limited. All Rights Reserved.</p>
	</div>
</div>
</body>
</html>		
BODY;
}

private function AutoResponse() {
$this->_responseBody = <<<BODY
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>X-CONCEPT (Trading) Limited feedback-thanks!</title>
<style type="text/css">
div.wrapper {
	width: 700px;
	margin: 0 auto;
}
div.left {
	width: 36%; 
	height: auto; 
	overflow: hidden; 
	padding: 7px 2%; 
	float: left;
}
div.right {
	width: 50%; 
	height: auto; 
	overflow: hidden; 
	padding: 0 auto; 
	float: left; 
	margin: 6% auto;
}
@media screen and (max-width: 700px) {

div.wrapper {
	width: 100%;
}

div.left {
	width: 96%; 
	padding: 7px 2%; 
	float: none;
	text-align: center;
}
div.right {
	width: 96%; 
	padding: 0 2%; 
	float: none;
	text-align: center;
}
div.right img {
	max-width: 400px;
}

}
</style>
</head>

<body style="margin: 0; padding: 0;">
<div class="wrapper" height: auto; overflow:hidden; background-color: #CCC;">
	<div style="width: 100%; height: auto; overflow: hidden; background:  #014461;">
		<a href="http://www.linkorion.com" target="_blank" style="text-decoration: none;">
			<h2 style="color: #FFF; font-family: Arial, Helvetica, sans-serif; text-align: center;">X-CONCEPT (Trading) Limited.</h2>
        </a>
	</div>
    <div style="width: 96%; padding: 7px 2%; height: auto; overflow: hidden">
        <p style="letter-spacing: 1px; font: 15px/24px 'Open Sans', Arial, sans-serif;">
			
            Thanks $this->_validName,</br></br>
            We are really happy you reached out to us. A member of our team will get back to you soon.</br> 
            If you prefer a real-time communication with us, then you can call any of the service numbers listed below. </br> </br>
            <strong> +44 207 164 6937</strong> </br>
             <strong> +44 207 900 3191 </strong></br></br>
             
             Lets get to talking, we do believe we will be of immense service to you.</br>
        <em>Have an awesome day!</em></p>
    </div>
    <div style="width: 96%; height: auto; overflow: hidden; padding: 7px 2%; background:  #014461;">
        
		<div class="left">
            <h3 style="color: #979797; font-family: Arial, Helvetica, sans-serif; font-size:15px; ">Visit Our Website</h3>
            <a href="http://xconcept-trading.com" target="_blank" style="color: #FFF; text-decoration: none;">
                <p style="font-family: Arial, Helvetica, sans-serif; font-size:12px; ">www.xconcept-trading.com</p>
            </a>
		</div>
        
        
    </div>
    <div style="width: 96%; height: auto; overflow: hidden; padding: 0 2%; background: #1A2426;">
    	<p style="color: #3075A5; font-family: Arial, Helvetica, sans-serif; text-align: center; font-size:14px; ">X-CONCEPT (Trading) Limited All Rights Reserved.</p>
    </div>
</div>
</body>
</html>
BODY;
}
	
}

if (isset($_POST["ajax"]) && $_POST["ajax"] == 1) {
	$obj = new Email();
	$obj->Form_Preparation();
	$obj->sendEmail();
	$obj->responseMessage();
}

?>