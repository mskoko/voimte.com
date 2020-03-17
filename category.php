<?php

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   file                 :  feed.php
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   author               :  Muhamed Skoko - info@mskoko.me
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

include_once($_SERVER['DOCUMENT_ROOT'].'/includes.php');

//////////////////////////

if (!($User->IsLoged()) == true) {
	header('Location: /login');
	die();
}

/************************************/

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $Site->SiteConfig()['site_name']; ?></title>

	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/assets/php/head.php'); ?>

	<!-- ld -->
	<script type="application/ld+json" src="/assets/json/ld.json"></script>
	<link rel="stylesheet" type="text/css" href="//unpkg.com/gijgo@1.9.13/css/gijgo.min.css">

	<!-- Table -->
	<link rel="stylesheet" type="text/css" href="/assets/table_/datatables.min.css">
	
	<!-- Preload -->
    <link rel="stylesheet" type="text/css" href="/assets/video/dist/plyr.css">
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
	
	<div class="space" style="margin-top:50px;"></div>


	<!-----------------------------------------------------
		Kategorije bi sluzile da korisnicima omogucim da djele 'ljubavni sadrzaj'

		-> Video ce imati opciju da ostave 'link ili da uploaduju vlastiti video'.
		-> 
	------------------------------------------------------>

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-2 col-4 cat" onclick="goToCategory(1)">
				<div><img src="/assets/img/i/video.png" alt="Go to Video list"></div>
				<div class="catInfo">
					<b>5k</b> <br>
					<small>(Video)</small>
				</div>
			</div>

			<div class="col-md-2 col-4 cat" onclick="goToCategory(2)">
				<div><img src="/assets/img/i/image.png" alt="Go to Image list"></div>
				<div class="catInfo">
					<b>3k</b> <br>
					<small>(Image)</small>
				</div>
			</div>


			<div class="col-md-2 col-4 cat" onclick="goToCategory(3)">
				<div><img src="/assets/img/i/book.png" alt="Go to Book list"></div>
				<div class="catInfo">
					<b>500</b> <br>
					<small>(Writers)</small>
				</div>
			</div>

			<div class="col-md-2 col-4 cat" onclick="goToCategory(4)">
				<div><span class="hstMskoko">#</span></div>
				<div class="catInfo">
					<b>500</b> <br>
					<small>(Popularly)</small>
				</div>
			</div>
		</div>
	</div>

	<div class="space" style="margin-top:20px;"></div>

	<!-- Page content -->
    <div class="container">
    	<div class="row justify-content-center">
  			
  			

		</div>
    </div>


	<!-- Footer -->
	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/assets/php/footer.php'); ?>
	
	<script type="text/javascript">
		function goToCategory(catID) {
			if (catID == 1) {
				// Video
				document.location.href = '/category?p=video';
			} else if (catID == 2) {
				// 
				document.location.href = '/category?p=image';
			} else if (catID == 3) {
				// 
				document.location.href = '/category?p=writers';
			} else if (catID == 4) {
				// 
				document.location.href = '/category?p=Popularly';
			} else {
				return false;
			}
		}
	</script>

	<hr>

	<div style="text-align:center;margin:0px 0px 20px 0px;">
		<small>Icons made by <a href="https://www.flaticon.com/authors/prosymbols" title="Prosymbols">Prosymbols</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></small>
	</div>
	
</body>
</html>