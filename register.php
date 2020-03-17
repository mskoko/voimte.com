<?php

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   file                 :  register.php
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   author               :  Muhamed Skoko - info@mskoko.me
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

include_once($_SERVER['DOCUMENT_ROOT'].'/includes.php');

//////////////////////////

if (!($User->IsLoged()) == false) {
    header('Location: /home');
    die();
}

if (isset($GET['rdr'])) {
	$naProf = $Secure->SecureTxt($GET['rdr']); 
} else {
	$naProf = '';
}

/************************************/

//BLOCK

/*if (!isset($_GET['reg_now'])) {
	header('Location: /home');
}*/

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sign up for Free | <?php echo $Site->SiteConfig()['site_name']; ?></title>

	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/assets/php/head.php'); ?>

	<!-- ld -->
	<script type="application/ld+json" src="/assets/json/ld.json"></script>
</head>
<body>
	<div id="organization"></div><div id="webpage"></div>

	<div class="preloader"></div>

	<!-- Alerts -->
	<div id="msg_alert"><?php echo $Alert->PrintAlert(); ?></div>
	<script type="text/javascript">
		setTimeout(function() {
			document.getElementById('msg_alert').innerHTML = "<?php echo $Alert->RemoveAlert(); ?>";
		}, 5000);
	</script>

	<!-- Header -->
	<header class="header_area">
		<!-- Navigation -->
		<?php include_once($url.'/assets/php/nav.php'); ?>
	</header> <!-- end Header -->
	
	<?php if (!($User->IsLoged()) == false) { ?>
		<div class="left_ads">
			<div class="ads_left1">
				<img src="assets/img/i/chat-flat.png" alt="">
			</div>

			<div class="ads_left2">
				<img src="assets/img/i/binocular-var-outline-filled.png" alt="">
			</div>

			<div class="ads_left3">
				<img src="assets/img/i/heart-curvy-outline-filled.png" alt="">
			</div>

		</div>

		<div class="right_ads">
			<div class="ads_right1">
				<img src="assets/img/i/eye-outline-filled.png" alt="">
			</div>

			<div class="ads_right2">
				<img src="assets/img/i/checkmark-flat.png" alt="">
			</div>

			<div class="ads_right3">
				<img src="assets/img/i/heart-curvy-outline-filled.png" alt="">
			</div>
		</div>
	<?php } ?>

	<div class="space" style="margin-top:50px;"></div>
	<!-- Page content -->

    <div class="container">
    	<div class="row justify-content-center">
    		<div class="col-md-7">
    			<form action="/process?new_account" method="POST">
    				<input type="text" name="naProf" value="<?php echo $naProf; ?>" style="display:none;">
    				
	               	<div class="row">
	               		<div class="col-md-12">
		                    <label>Full name: </label>
		                    <input type="text" name="Name" class="form-control" required="">
		                </div>
	               	</div> <br>

	               	<div class="row">
	               		<div class="col-md-6">
		                    <label>Email: </label>
		                    <input type="email" name="Email" class="form-control" required="">
		                </div>
		                
	               		<div class="col-md-6">
		                    <label>Username: </label>
		                    <input type="text" name="Username" class="form-control" required="">
		                </div>
	               	</div> <br>

	               	<div class="row">
	               		<div class="col-md-12">
		                    <label>Password: </label>
		                    <input type="password" name="Pass" class="form-control" required="">
		                </div>
	               	</div> <br>

		            <div class="row justify-content-center">
		            	<div class="col-md-6">
		            		<button class="btn btn-success" style="width:100%;">
			                	<i class="fa fa-user-plus"></i> Ok, lets go!
			                </button>
		            	</div>
		            </div>
	            </form>

	            <?php
					/* INCLUSION OF LIBRARY FILEs*/
					include_once( $_SERVER['DOCUMENT_ROOT'].'/core/inc/libs/Facebook/autoload.php');

					$fb = new Facebook\Facebook([
						'app_id' => APP_ID,
						'app_secret' => APP_SECRET,
						'default_graph_version' => 'v3.2',
					]);

					$helper = $fb->getRedirectLoginHelper();

					$permissions = ['email']; // Optional permissions
					$loginUrl = $helper->getLoginUrl('http://localhost/fb_login/fb-new.php', $permissions);
				?>

				<center><hr> [or] <hr></center>

	            <div class="row justify-content-center">
	            	<div class="col-md-6">
	                	<a href="<?php echo $Secure->SecureTxt($loginUrl); ?>" class="btn btn-primary" style="width:100%">
							<i class="fa fa-facebook"></i> w/ Facebook
						</a> 
	                </div>
	            </div>
    		</div>
		</div>
    </div>

	<!-- Footer -->
	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/assets/php/footer.php'); ?>
</body>
</html>