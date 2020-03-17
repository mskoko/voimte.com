<?php

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   file                 :  terms.php
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
				<h3>Terms and Conditions</h3> <br>

				<div class="terms">
					<p>These terms and conditions govern the access to and the use of Voimte.com services and platforms, through the website or through the mobile apps.</p>
					<p>All users must comply with the terms and conditions on this page to be able to use Voimte.com and its services and platforms.</p>

					<p><strong>Intellectual Property Rights</strong></p>
					<p>Other than the content you own, under these Terms, Voimte.com and/or its licensors own all the intellectual property rights and materials contained in this Website.</p>
					<p>You are granted limited license only for purposes of viewing the material contained on this Website.</p>

					<p><strong>Restrictions</strong></p>
					<p>You are specifically restricted from all of the following:</p>

					<div class="rest_">
						<li>publishing any Website material in any other media;</li>
						<li>selling, sublicensing and/or otherwise commercializing any Website material;</li>
						<li>using this Website in any way that is or may be damaging to this Website;</li>
						<li>using this Website in any way that impacts user access to this Website;</li>
						<li>using this Website contrary to applicable laws and regulations, or in any way may cause harm to the Website, or to any person or business entity;</li>
						<li>engaging in any data mining, data harvesting, data extracting or any other similar activity in relation to this Website;</li>
					</div>

					<br>
					
					<p><strong>Denial of Access</strong></p>
					<p>Voimte.com has the right to block any user from accessing the website or using it's services in general.</p>
					
					<p><strong>Impersonation</strong></p>
					<p>Impersonation by name or subdomain is not allowed and Voimte.com has the right to take adequate actions.</p>

					<p><strong>Non-Registered Users</strong></p>	
					<p>Non-registered users are able to access only the parts of the Services that are publicly available and do not enjoy all of the privileges of being a registered member. Non-registered users are, however, still subject to the TC and Privacy Policy.</p>

					<p><strong>E-mail</strong></p>
					<p>Voimte.com has the right to e-mail users with what Voimte.com sees adequate with the option to unsubscribe from notification e-mails</p>
					
					<p><strong>Information</strong></p>
					<p>Voimte.com has the right to use the information input by users with agreement to the privacy policy</p>

					<p><strong>Your Content</strong></p>
					<p>In these Website Standard Terms and Conditions, "Your Content" shall mean any audio, video, text, images or other material you choose to display on this Website. By displaying Your Content, you grant Voimte.com a non-exclusive, worldwide irrevocable, sub licensable license to use, reproduce, adapt, publish, translate and distribute it in any and all media.</p>
					<p>Your Content must be your own and must not be invading any third-party's rights. Voimte.com reserves the right to remove any of Your Content from this Website at any time without notice.</p>
		
					<p><strong>Severability</strong></p>
					<p>If any provision of these Terms is found to be invalid under any applicable law, such provisions shall be deleted without affecting the remaining provisions herein.</p>
		
					<p><strong>Variation of Terms</strong></p>
					<p>Voimte.com is permitted to revise these Terms at any time as it sees fit, and by using this Website you are expected to review these Terms on a regular basis.</p>
		
					<p><strong>Assignment</strong></p>
					<p>The Voimte.com is allowed to assign, transfer, and subcontract its rights and/or obligations under these Terms without any notification. However, you are not allowed to assign, transfer, or subcontract any of your rights and/or obligations under these Terms.</p>
					
					<p><strong>Entire Agreement</strong></p>
					<p>These Terms constitute the entire agreement between Voimte.com and you in relation to your use of this Website, and supersede all prior agreements and understandings.</p>
					
					<p><strong>Governing Law & Jurisdiction</strong></p>
					<p>These Terms will be governed by and interpreted in accordance with the laws of the State of Country, and you submit to the non-exclusive jurisdiction of the state and federal courts located in Country for the resolution of any disputes.</p>
				</div>


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