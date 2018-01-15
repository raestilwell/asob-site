<?php
if(isset($_POST['submit']) && !empty($_POST['submit'])):
    if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])):
        //your site secret key
        $secret = '6LfaxzEUAAAAACSXv9ehH1HD8cT7mhkoTLGivm5m';
        //get verify response data
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);
        if($responseData->success):
            //contact form submission code
            $name = !empty($_POST['name'])?$_POST['name']:'';
            $email = !empty($_POST['email'])?$_POST['email']:'';
            $message = !empty($_POST['message'])?$_POST['message']:'';
            
            $to = 'contact@songsofblood.com';
            $subject = 'From Songs of Blood Site';
            $htmlContent = "
                <h1>Contact request details</h1>
                <p><b>Name: </b>".$name."</p>
                <p><b>Email: </b>".$email."</p>
                <p><b>Message: </b>".$message."</p>
            ";
            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            // More headers
            $headers .= 'From:'.$name.' <'.$email.'>' . "\r\n";
            //send email
            @mail($to,$subject,$htmlContent,$headers);
            
            $succMsg = '<div class="alert alert-success">Your message has submitted successfully!</div>';
        else:
            $errMsg = '<div class="alert alert-danger">Robot verification failed, please try again.</div>';
        endif;
    else:
        $errMsg = '<div class="alert alert-danger">Please click on the reCAPTCHA box.</div>';
    endif;
else:
    $errMsg = '';
    $succMsg = '';
endif;
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Songs of Blood: A Vampire Saga | Official Site | Contact </title>
	<meta name="description" content="" />
  	<meta name="keywords" content="" />
	<meta name="robots" content="" />
	
	<link rel="shortcut icon" href="../assets/img/favicon.png" type="image/x-icon" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    
    <!-- Animate CSS -->
    <link rel="stylesheet" href="../assets/css/animate.css">
    
    <!-- Custom Style -->
    <link rel="stylesheet" href="../assets/css/style.css">
    
    <!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Muli:300|Quintessential" rel="stylesheet">
    
    <!-- ReCaptcha -->
    <script src='https://www.google.com/recaptcha/api.js'></script>
   
  </head>
  <body>
	
	<?php include('../template/nav.php'); ?>
  		
	<section id="contact-main">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-4">
					<h1>Get in <span class="blood-text">Touch</span></h1>
					<p>We love saying hello.</p>
				</div>
				
				<div class="col-sm-12 col-md-8 contact-form">
					<!-- Start Contact Form -->
					<form action="" method="POST" role="form">
					    <div class="form-group">
						    <label for="name">Name<span class="asterisk">*</span></label>
						    <input type="text" name="name" class="form-control" placeholder="Your name" required/>
					    </div>
					    
					    <div class="form-group">
						    <label for="email">Email<span class="asterisk">*</span></label>
						    <input type="text" name="email" class="form-control" placeholder="Your email" required/>
					    </div>
					    
					    <div class="form-group">
						    <label for="message">Message<span class="asterisk">*</span></label>
						    <textarea type="text" name="message" class="form-control" placeholder="Your message" required></textarea>
					    </div>
					    
					    <div class="recaptcha-wrap">
					    	<div class="g-recaptcha" data-sitekey="6LfaxzEUAAAAAG1nIUFyNFyo_LaUIsjlisgwLx43"></div>
					    </div>
					    
					    <input type="submit" class="btn btn-pink" name="submit" value="Send Your Message">
					    <?php echo $succMsg; ?>
					    <?php echo $errMsg; ?>
					</form><!-- End Contact Form -->

				</div>
			</div>
		</div>
	</section>
	
	<?php include('../template/footer.php'); ?>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    
     <!-- Font Awesome CDN -->
    <script src="https://use.fontawesome.com/3b1017770a.js"></script>
    
   
   
  </body>
</html>