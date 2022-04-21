<?php
session_start();
if(!isset($_SESSION['sess_user_id']))
//check is session (sess_user_id) is set and remove whitespace or other characters from the beginning and end of a string
{
	header("location: index.php"); //redirect back to index.php
	exit();
}

if(!isset($_SESSION['otp']))
{
	header("location: index.php");
	exit();
}


if($_SESSION['otp'] != 1)
{
	header("location: index.php");
	exit();
}

include ("include/function.php");
include ("include/connect.php");
include ("include/sessiontimeout")

?>

<?php
					if (isset($_POST['proceed']))
					{
						$otp = mysqli_real_escape_string($con,$_POST["otp"]); //escapes special characters in a string
						$otp = strip_tag($otp); //function that take out unneccessary characters in a string

						if (isset($_SESSION['sess_user_id']))
						{
							if (isset($_SESSION['otptimeout']))
							{
								if (time() - $_SESSION['otptimeout'] < 180)
								{
									if ($otp == $_SESSION['getotp'])
									{
										$_SESSION['payment'] = 1;
										unset ($_SESSION['otp']);
										unset ($_SESSION['getotp']);
										unset ($_SESSION['otptimeout']);
										header("location: payment.php");
										exit();
									}
									else
									{
										?>
										<script type="text/javascript">
										alert("Your OTP code is incorrect.");
										window.location.href = "otp.php"; //direct to Logout.php
										</script>
										<?php
									}
								}
								else
								{
									?>
									<script type="text/javascript">
									alert("Your OTP code have expired. Please click the button to generate a new one");
									window.location.href = "otp.php"; //direct to Logout.php
									</script>
									<?php
								}
							}
							else
							{
								?>
										<script type="text/javascript">
										alert("Please click the OTP Button to request for a OTP code");
										window.location.href = "otp.php"; //direct to Logout.php
										</script>
										<?php
							}
						}
						else
						{
							header("location: index.php"); //redirect back to index.php
							exit();
						}
					}

					?>
					<?php require ("getotp.php"); ?>
<!DOCTYPE HTML>
<html>
<head>
<title>One-Stop BBQ</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-1.11.0.min.js"></script>
<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }>
</script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<!--Google Fonts-->
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>

	<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
				});
			});
	</script>
<!-- //end-smoth-scrolling -->
</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=289011751125169";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!--header start here-->
<div class="header">
   <div class="container">
        <div class="header-main">
			 <div class="logo">
			   <a href="index.php"><img src="images/logo3.png" alt="One-stopbbq logo"></a>
			 </div>
			 
            <div class="top-nav">
            	<span class="menu"> <img src="images/icon.png" alt=""/></span>
				<ul class="nav nav-pills nav-justified res">
					<li><a  href="index.php"><i class="glyphicon glyphicon-home"> </i>Home</a></li>
					<li><a href="about.php"><i class="glyphicon glyphicon-star"> </i>About</a></li>
					<li><a href="alacarte.php"><i  class="glyphicon glyphicon-thumbs-up"> </i>Alacarte</a></li>
					<li><a href="packages.php"><i class="glyphicon glyphicon-list-alt"> </i>Packages</a></li>
					<li><a href="contact.php"><i class="glyphicon glyphicon-envelope"> </i>Contact</a></li>
				</ul>
				</ul>
				<!-- script-for-menu -->
							 <script>
							   $( "span.menu" ).click(function() {
								 $( "ul.res" ).slideToggle( 300, function() {
								 // Animation complete.
								  });
								 });
							</script>
			<!-- /script-for-menu -->
			 </div>	
     <div class="clearfix"> </div>
   </div>	
 </div>
</div>
<!--header end here-->
<!--banner start here-->
<div class="banner">
  <div class="container">
 	<div class="banner-main">
		<div class="signin-form">
			<div class="signin">
				<div class="signin-main">
					<form action="otp.php" method="post" id="forgetpassword-form"
						autocomplete="off">

						<div id="form-content">
							<h2 align="center">One Time Password</h2>
							<fieldset>
								<div class="fieldgroup" align="center">
									<p align="center">You have to enter One-Time Password before you can proceed with your payment.</p>
										<label for="otp">One-Time Password: </label>
										<input name="otp" type="text" id="otp" maxlength="15" >
								</div>
								<div class="fieldgroup">
										<input type="submit" value="Click here to get your OTP" class="submit"
											name="submitotp" id="registerbutton">

										<input type="submit" value="Proceed" class="submit"
											name="proceed" id="registerbutton">
								
								</div>

							</fieldset>

						</div>

					</form>

					
				</div>
			</div>
		</div>
	</div>
</div>

<!--footer start here-->
<?php
include("footer.php");

?>
</html>