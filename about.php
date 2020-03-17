<?php

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   file                 :  about.php
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   author               :  Muhamed Skoko - info@mskoko.me
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

include_once($_SERVER['DOCUMENT_ROOT'].'/includes.php');

//////////////////////////

/************************************/

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $Site->SiteConfig()['site_name']; ?></title>

	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/assets/php/head.php'); ?>

	<!-- ld -->
	<script type="application/ld+json" src="/assets/json/ld.json"></script>

	<link rel="stylesheet" type="text/css" href="/assets/record/style.css?<?php echo time(); ?>">
</head>
<body>
	<div id="organization"></div><div id="webpage"></div>

	<div id="preloader">
		<div id="circle">
			<img src="/assets/img/i/loading.gif" alt="">
		</div> 
	</div>

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
	
	<div class="space" style="margin-top:80px;"></div>

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h3>About us</h3>

				<p><a href="http://voimte.com/">VOIMTE.com</a> is a mini platform for <b>"leaving messages"</b> to a loved one.</p>
				<p>The platform is designed to deliver a text or audio message to a loved one. <small>(many more new, innovative features coming soon)</small></p>
				<p>A <b>"as you know me"</b> system is being developed on the platform where the account holder will have the opportunity to publish a short quiz consisting of 10-20 random questions.</p>
			</div>
		</div>
	</div>

	<!-- Footer -->
	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/assets/php/footer.php'); ?>
	<script src="/assets/record/js/app.js?<?php echo time(); ?>"></script>
		
	<script type="text/javascript">
		$('#preloader').fadeOut(300);
	</script>
</body>
</html>