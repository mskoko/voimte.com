<?php

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   file                 :  index.php
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   author               :  Muhamed Skoko - info@mskoko.me
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

include_once($_SERVER['DOCUMENT_ROOT'].'/includes.php');

//////////////////////////

if (isset($GET['rdr'])) {
	$naProf = $Secure->SecureTxt($GET['rdr']); 
} else {
	$naProf = '';
}

//Login
if(isset($_GET['log'])) {
    $POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    if(empty($POST['Email'])) {
        $error[] = 'Greska!';
        $Alert->SaveAlert('The #Email field must be filled in', 'info');
    }

    if(empty($POST['Password'])) {
        $error[] = 'Greska!';
        $Alert->SaveAlert('The #Password field must be filled', 'info'); 
    }

    if (isset($POST['zapamtiME'])) {
    	$ZapamtiME 	= $Secure->SecureTxt($POST['zapamtiME']);
    } else {
    	$ZapamtiME = '0';
    }
    if (isset($ZapamtiME) && $ZapamtiME == '1') {
    	$ZapamtiME = '1';
    } else {
    	$ZapamtiME = '0';
    }

    if(empty($error)) {
		$User->LogIn($Secure->SecureTxt($POST['Email']), $Secure->SecureTxt($POST['Password']), false, $ZapamtiME, $Secure->SecureTxt($POST['naProf']));
    } else {
    	$Alert->SaveAlert('An unknown error has occurred! Please try again later.', 'error'); 
    }
}

if (isset($GET['autologin'])) {
	$UserID 	= $Secure->SecureTxt($GET['id']);
	$TokenKey 	= $Secure->SecureTxt($GET['key']);
	$naProf 	= $Secure->SecureTxt($GET['rdr']);

	//Proveri poklapaanje Tokenaaa i UserID-a
	if (!($User->RegTokenKey($TokenKey, $UserID)) == false) {
		//Proveri jeli aktivan nalog
		if (!($User->RegTokenKeyStatus($TokenKey, $UserID)['reg_status']) == false) {
			//Tacan key i user id = AutoLogin
			$User->LogIn($User->UserDataByID($UserID)['Email'], $User->UserDataByID($UserID)['Password'], true, '1', $naProf);
		}
	} else {
		//Netacan key i user id
		die('Brate/Sestro, prastaj problem cemo otkloniti u sto kracem roku.. Hvala na razumevanju. Volim vas sve! <3');
	}
}

///////////////////////////

if (isset($_GET['id'])) {
	$Username = $Secure->SecureTxt($_GET['id']);
	//$uID = explode('@', $uID);

	$userID = $User->GetIDuName($Username)['id'];

	if ($User->isProfileView($User->UserData()['id'], $userID) == 0) {	
		$User->addProfileView($User->UserData()['id'], $userID);
	}
} else {
	$userID = '';

	if (!($User->IsLoged()) == false) {
		header("Location: /@".$User->UserData()['Username']);
	}
}

//provera za nalog;
if (!($User->IsLoged()) == false) {
	if (empty($User->UserDataByID($userID)['id'])) {
		header("Location: /@".$User->UserData()['Username']);
	}
}

/************************************/

//$Alert->SaveAlert('okkkk', 'success');

//https://voimte.com/user/img/nQ8niKsN87kVtnrVmTS8.png
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
	
	<!-- Not login content -->
	<div class="space" style="margin-top:50px;"></div>

	<div class="container">
    	<div class="row justify-content-center">
    		<div class="col-md-6">
    			<form action="/login?log" method="POST" autocomplete="On">
    				<input type="text" name="naProf" value="<?php echo $naProf; ?>" style="display:none;">

	                <div class="form-group">
	                    <label>Email: </label>
	                    <input type="text" name="Email" value="<?php isset($_SESSION['Email']) ? $Email = $Secure->SecureTxt($_SESSION['Email']) : $Email = ''; echo $Email; ?>" class="form-control" required="">
	                </div> <br>

	                <div class="form-group">
	                    <label>Password: </label>
	                    <input type="password" name="Password" class="form-control" required="">
	                </div> <br>

	                <div class="form-gorup">
	                	<label for="zapamtiME">
	                		<input id="zapamtiME" type="checkbox" name="zapamtiME" value="1" <?php if(isset($_COOKIE['member_login'])) { ?> checked <?php } ?>>
	                		Remember me
	                	</label>

	                	<label for="zapamtiME" style="float:right;">
	                		<a href="/login?forgot">I forgot my password</a>
	                	</label>
	                </div> <br>

		            <div class="row">
		            	<div class="col-md-12">
		                	<button class="btn btn-success" style="width:100%;">
		                		<i class="fa fa-sign-in"></i> Lets go
		                	</button>  
		                </div>
		            </div> <hr>

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
						$loginUrl = $helper->getLoginUrl('https://voimte.com/fb_login/fb-login.php', $permissions);
					?>

		            <div class="row">
		            	<div class="col-6">
		                	<a href="/register?rdr=<?php echo $naProf; ?>" class="btn btn-primary" style="width:100%;">
		                		<i class="fa fa-user-plus"></i> Create
		                	</a>
		                </div>

		                <div class="col-6">
		                	<a href="<?php echo $Secure->SecureTxt($loginUrl); ?>" class="btn btn-primary" style="width:100%">
								<i class="fa fa-facebook"></i> w/ Facebook
							</a>
		                </div>
		            </div>
	            </form>
    		</div>
		</div>
    </div>

	<!-- Footer -->
	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/assets/php/footer.php'); ?>
	
	<script type="text/javascript">
		$('#preloader').fadeOut(300);
	</script>
</body>
</html>