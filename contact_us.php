<?php

include_once("email_submission/email.php");

if (isset($_POST["submit"])) {
	$obj = new Email();
	$obj->Form_Preparation();
	$obj->sendEmail();
	$EmailSubmissionFeedback = $obj->responseMessage();
	$FormMessage = "";
	
	switch ($EmailSubmissionFeedback) {
		case "success":
			$FormMessage = '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> Your Message Has Been Sent Successfully.</div>';
			break;
		case "error":
			$FormMessage = '<div class="alert alert-warning"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> Your Message Was Not Sent. Try Again Later.</div>';
			break;
		default:
			$FormMessage = $EmailSubmissionFeedback;
	}
}

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Contact Us Today</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Call Us, Email Us or Visit Us at Our Office Address. We will love to make you succeed in your business.">
<meta name="keywords" content="">
<meta name="author" content="X-CONCEPT (Trading) Limited">

<!-- Bootstrap Css -->
<link href="assets/css/bootstrap.min.css" rel="stylesheet">

<!-- Style -->
<link href="assets/css/owl.carousel.css" rel="stylesheet">
<link href="assets/css/owl.theme.css" rel="stylesheet">
<link href="assets/css/owl.transitions.css" rel="stylesheet">

<link href="assets/css/animate.css" rel="stylesheet">
<link href="assets/css/offshore.css" rel="stylesheet">
<!-- Icons Font -->
<link rel="stylesheet" href="assets/css/font-awesome.min.css">

<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<![endif]-->
</head>

<body>
<section class="main-header">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.html"><h1>X-CONCEPT (Trading) Ltd</h1></a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse navigation" id="bs-example-navbar-collapse-1">
                <div class="col-md-12 col-xs-12 nav-wrap">
                    <ul class="nav navbar-nav">
                        <li><a href="index.html" class="page-scroll">Home</a></li>
                        <li><a href="aboutus.html" class="page-scroll">About Us</a></li>
                        <li><a href="services.html" class="page-scroll">Our Services</a></li>
                        <li><a href="projectfunding.html" class="page-scroll">Project Funding</a></li>
                        <li><a href="disclaimer.html" class="page-scroll">Disclaimer</a></li>
                        <li><a href="contact_us.php" class="page-scroll">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    
    <div class="banner_wrapper">
    	<div class="bg-overlay"></div>
    	<div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Contact Us</h2>
                    <hr class="light-sep bg-white">
                    <p>We can help you finance/loan your business dreams. </p>
                </div>
            </div>
        </div>
    </div>
    
</section>




<!-- Testimonials
	============================================= -->
<section id="contact-section">
    <div class="container">
        <div class="row">
        	<div class="col-md-6">
				<h2 class="subtitle  wow fadeInDown" data-wow-duration="500ms" data-wow-delay=".3s">Contact Us</h2>
            	<div class="address-details">
                    <div class="address wow fadeInLeft" data-wow-duration="500ms" data-wow-delay=".3s">
                        <p><i class="fa fa-map-marker"></i>&nbsp;
                        1 Center Point, 103 New Oxford Street, London WC1A 1</p>
                    </div>
                    <div class="email wow fadeInLeft" data-wow-duration="500ms" data-wow-delay=".7s">
                        <p><i class="fa fa-envelope"></i>&nbsp;
                        hello@xconcept-trading.com </p>
                    </div>
                    <div class="phone wow fadeInLeft" data-wow-duration="500ms" data-wow-delay=".9s">
                        <p><i class="fa fa-phone"></i>&nbsp;
                        +44 207 164 6937, &nbsp; +44 207 900 3191</p>
                    </div>
                </div>
                
                <div class="map-area">
                    <div class="map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2482.821485474568!2d-0.13145668422968906!3d51.51649097963658!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48761b2d67e28873%3A0xcc6590e4dc845980!2sCentre+Point!5e0!3m2!1sen!2sng!4v1523633129602" width="600" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="block">
                    <h2 class="subtitle wow fadeInDown" data-wow-duration="500ms" data-wow-delay=".3s">Fill A Form</h2>
                    
                    <div class="contact-form">
                    	<?php
							if(isset($FormMessage)) {
								echo $FormMessage;
							}
						?>
                        <form id="contact-form" method="post" action="contact_us.php" role="form">
                
                            <div class="form-group wow fadeInDown" data-wow-duration="500ms" data-wow-delay=".6s">
                                <input type="text" placeholder="Your Name" class="form-control" name="name" id="name">
                            </div>
                            
                            <div class="form-group wow fadeInDown" data-wow-duration="500ms" data-wow-delay=".8s">
                                <input type="email" placeholder="Your Email" class="form-control" name="email" id="email" >
                            </div>
                            
                            <div class="form-group wow fadeInDown" data-wow-duration="500ms" data-wow-delay="1s">
                                <input type="text" placeholder="Subject" class="form-control" name="subject" id="subject">
                            </div>
                            
                            <div class="form-group wow fadeInDown" data-wow-duration="500ms" data-wow-delay="1.2s">
                                <textarea rows="6" placeholder="Message" class="form-control" name="message" id="message"></textarea>    
                            </div>
                            
                            
                            <div id="submit" class="wow fadeInDown" data-wow-duration="500ms" data-wow-delay="1.4s">
                                <input type="submit" id="contact-submit" name="submit" class="btn btn-default btn-send" value="Send Message">
                            </div>                      
                            <input type="hidden" name="recipient" value="tradingxconcept@gmail.com ">
                        </form>
                    </div>
                    <div class="clear"></div>
                    <div id="contactFormErrorMessage" style="margin-top: 1em; display: none;">
                        <div class="alert alert-info">
                        	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <span><img src="assets/images/loading.gif" width="32" height="32"></span> Please Hold On While We Forward Your Message.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="footer">
	<div class="container">
    	<div class="col-sm-3">
        	<div class="img-footer">
            	<h1>
                    <a href="index.html">
                        X-CONCEPT (Trading) <br>Limited 
                    </a>
                </h1>
            </div>
        </div>
        
        <div class="col-sm-3">
        	<h2>ABOUT US</h2>
            <p>X-CONCEPT (Trading) Limited can help you finance/loan (project funding) your business dreams through Commercial Lending for Asset Based Lending, Factoring, Equipment Leasing, Commercial Real Estate, Merchant Card Processing, Merger and Acquisition, Merchant Cash Advance, Working Capital, Expansion Commercial Bridge Loans, Debt Restructure.</p>
        </div>
        
        <div class="col-sm-3">
        	<h2>QUICK LINKS</h2>
            <ul class="menu-services">
                <li><a href="index.html">Home</a></li>
                <li><a href="aboutus.html">About Us</a></li>
                <li><a href="services.html">Our Services</a></li>
                <li><a href="projectfunding.html">Project Funding</a></li>
                <li><a href="disclaimer.html">Disclaimer</a></li>
                <li><a href="contact_us.php">Contact Us</a></li>
           </ul>
        </div>
        
        <div class="col-sm-3 touch">
        	<h2>GET IN TOUCH</h2>
            <p><i class="fa fa-map-marker"></i>&nbsp; 1 Center Point, 103 New Oxford Street, London WC1A 1</p>
            <p><i class="fa fa-envelope"></i>&nbsp; hello@xconcept-trading.com </p>
            <p><i class="fa fa-phone"></i>&nbsp; +44 207 164 6937, &nbsp; +44 207 900 3191</p>
            
            <!--<ul>
            	<li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
            </ul>-->
            
            <p>© <span id="theyear"></span> X-CONCEPT (Trading) Limited . All Rights Reserved.</p>
        </div>
    </div>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="assets/js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/custom.js"></script>
<!-- JS PLUGINS -->
<script src="assets/js/owl.carousel.min.js"></script>
<script>

var dateObj = new Date();

document.getElementById('theyear').innerHTML = dateObj.getFullYear();

</script>
</body>
</html>
