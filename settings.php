<?php

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   file                 :  settings.php
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   author               :  Muhamed Skoko - info@mskoko.me
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

include_once($_SERVER['DOCUMENT_ROOT'].'/includes.php');

//////////////////////////

if (!($User->IsLoged()) == true) {
    header('Location: /home');
    die();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $Site->SiteConfig()['site_name']; ?></title>

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

	<!--<div class="left_ads">
		<div class="ads_left1">
			<img src="assets/img/i/chat-flat.png" alt="">
		</div>

		<div class="ads_left2">
			<img src="assets/img/i/binocular-var-outline-filled.png" alt="">
		</div>

		<div class="ads_left3">
			<img src="assets/img/i/bulb-money-flat.png" alt="">
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
			<img src="assets/img/i/gif-flat.png" alt="">
		</div>
	</div>-->

	<div class="space" style="margin-top:50px;"></div>
	<!-- Page content -->
	
	<div class="container">
    	<div class="row justify-content-center">
    		
    		<div class="col-md-7">

				<div id="settings_form">
					<h3>Settings <hr></h3>
				</div>

				<form id="voimte_psf" action="/process?save_profile" method="POST" autocomplete="off" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-6">
							<label>Username: </label>
							<input type="text" name="Username" value="<?php echo $User->UserData()['Username']; ?>" class="form-control" required=""> <br>
						</div>

						<div class="col-md-6">
							<label>Profile image (Avatar): </label>
							<input type="file" name="UserPhoto" id="fileToUpload" class="form-control" accept="image/*" onchange="uploadImage()">
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<label>Name: </label>
							<input type="text" name="fName" value="<?php echo $User->UserData()['Name']; ?>" class="form-control" required=""> <br>
						</div>

						<div class="col-md-6">
							<label>Lastname: </label>
							<input type="text" name="lName" value="<?php echo $User->UserData()['Lastname']; ?>" class="form-control" required="">
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<label>Email: </label>
							<input type="email" name="Email" value="<?php echo $User->UserData()['Email']; ?>" class="form-control" required=""> <br>
						</div>

						<div class="col-md-6">
							<label>Webiste: </label>
							<input type="text" name="Website" value="<?php echo $User->UserData()['Website']; ?>" class="form-control">
						</div>
					</div> <br>

					<button class="btn btn-info" style="float:right;">
						<i class="fa fa-save"></i> Save
					</button>
				</form>

				<br><br><br><br><hr><br><br><br>

				<div id="settings_form">
					<h3>Change password <hr></h3>
				</div>

				<form action="/process?change_password" method="POST" autocomplete="off">
					<div class="row">
						<div class="col-md-4">
							<label>Password: </label>
							<input type="password" name="Pass" placeholder="*******" class="form-control">
						</div>

						<div class="col-md-4">
							<label>New password: </label>
							<input type="password" name="nPass" placeholder="*******" class="form-control">
						</div>

						<div class="col-md-4">
							<label>Retry password: </label>
							<input type="password" name="nrPass" placeholder="*******" class="form-control">
						</div>
					</div> <br>

					<button class="btn btn-primary" style="float:right;">
						<i class="fa fa-key"></i> Change password
					</button>
				</form>

    		</div>

    	</div>
    </div>

	<!-- Footer -->
	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/assets/php/footer.php'); ?>
		
	<script>
		function uploadImage() {
			$('#preloader').fadeIn(300);
			document.getElementById('voimte_psf').submit();
		}
	</script>


</body>
</html>