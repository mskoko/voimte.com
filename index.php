<?php

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   file                 :  index.php
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   author               :  Muhamed Skoko - info@mskoko.me
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

include_once($_SERVER['DOCUMENT_ROOT'].'/includes.php');

///////////////////////////

if (!($User->IsLoged()) == true) {
	header('Location: /login?rdr='.$Secure->SecureTxt($GET['id']));
	die();
}

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

if (isset($GET['rdr'])) {
	$naProf = $Secure->SecureTxt($GET['rdr']); 
} else {
	$naProf = '';
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
	<link rel="stylesheet" type="text/css" href="//unpkg.com/gijgo@1.9.13/css/gijgo.min.css">

	<!-- Table -->
	<link rel="stylesheet" type="text/css" href="/assets/table_/datatables.min.css">

	<link rel="stylesheet" type="text/css" href="/assets/record/style.css">
	
	<!-- Preload -->
    <link rel="stylesheet" type="text/css" href="/assets/video/dist/plyr.css">
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
	
	<div class="space" style="margin-top:50px;"></div>

	<!-- Page content -->
    <div class="container">
    	<div class="row justify-content-center">
    		
    		<div class="col-md-7">
    			<?php if (!empty($userID)||!$userID == '') { ?>
					<div class="img_profile" style="text-align:center;">
						<img src="/<?php echo $User->GetImage($userID); ?>" alt="<?php echo $User->UserDataByID($userID)['Name']; ?>" style="width:100px;">
						
						<h3><i><?php echo $User->getFullName($userID); ?></i></h3>
						<h4><a href="/@<?php echo $User->UserDataByID($userID)['Username']; ?>">@<?php echo $User->UserDataByID($userID)['Username']; ?></a></h4>
						
						<hr>
						<!--<?php if(!$Secure->SecureTxt($User->UserDataByID($userID)['Website']) == '') { ?>
							<div class="p_link">
								<li>
									<a href="" target="_blank"><?php echo $Secure->formatLinksInText($Secure->SecureTxt($User->UserDataByID($userID)['Website'])); ?></a>
								</li>
							</div>
						<?php } ?>-->

						<div class="p_stats">
							<li><?php echo $Secure->viewConverter($Post->PostsCountByUserID($userID)); ?> <small>message/s</small></li>
							<li><?php echo $Secure->viewConverter($User->ProfileViews($userID)); ?> <small>view</small></li>
						</div>
					</div>

					<br>
					
					<!--<div class="row">
						<div class="col-6">
							<span class="btn btn-sm btn-danger" style="width:100%;cursor:pointer;" onclick="my_love()">
								<i class="fa fa-heart" style="font-size:20px;"></i>
							</span>
						</div>

						<div class="col-6">
							<span class="btn btn-sm btn-info" style="width:100%;cursor:pointer;" onclick="my_quizz()">
								<i class="fa fa-comments-o" style="font-size:20px;"></i>
							</span>
						</div>
					</div> <br>-->

	    			<div class="card" id="my_love_p">
						<div class="card-body">
							
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="col-6">
											<!-- Text msg -->
											<button id="text_por_btn" class="btn btn-primary" onclick="audio_or_text('text')" style="width:100%;">
												<i class="fa fa-comments-o"></i> <br> <small>Message</small>
											</button>
										</div>

										<div class="col-6">
											<!-- Audio msg -->
											<button id="audio_por_btn" class="btn btn-primary" onclick="audio_or_text('audio')" style="width:100%;">
												<i class="fa fa-play-circle"></i> <br> <small>Audio <small>/</small> Video</small>
											</button>
										</div>
									</div>

									<br>

									<!--Audio or Video-->
									<div id="audio_por" class="rec_btn">
										<div class="remove_for_desktop">
											<div class="row">
												<div class="col-6">
													<button id="addVideo" class="btn btn_no_rec" onclick="upVideo()">
														<i class="fa fa-upload"></i>
														<label>Share your video</label>
														<form id="shareVideo" action="/process?upVideo" method="POST" autocomplete="off" enctype="multipart/form-data">
															<input id="oID_" type="text" name="oID" value="<?php echo $userID; ?>" style="display:none;">
															<input id="upVideo" type="file" name="Video" accept="video/*" onchange="shareVideo()" style="display:none;">
														</form>
													</button>
												</div>

												<div class="col-6">
													<button id="starting_record" class="btn btn_no_rec">
														<i class="fa fa-microphone"></i>
														<label id="minutes">Voice message</label>:<label id="seconds"></label>
													</button>
												</div>
											</div>
										</div>

										<div class="remove_for_phone">
											<div class="row">
												<div class="col-6">
													<button id="addVideo" class="btn btn_no_rec" onclick="upVideo()">
														<i class="fa fa-upload"></i>
														<label>Video</label>
														<form id="shareVideo" action="/process?upVideo" method="POST" autocomplete="off" enctype="multipart/form-data">
															<input id="oID_" type="text" name="oID" value="<?php echo $userID; ?>" style="display:none;">
															<input id="upVideo" type="file" name="Video" accept="video/*" onchange="shareVideo()" style="display:none;">
														</form>
													</button>
												</div>

												<div class="col-6">
													<button id="starting_record" class="btn btn_no_rec">
														<i class="fa fa-microphone"></i>
														<label id="minutes">Voice</label>:<label id="seconds"></label>
													</button>
												</div>
											</div>
										</div>

										<audio id="record_start" controls>
											<source src="/assets/sounds/hover.mp3" type="audio/mpeg">
										</audio>
									
										<div class="pLoveAudio">
											<!--<div id="formats"></div>

											<pre id="log"></pre>-->

											<ol id="recordingsList"></ol>
										</div>

										<div id="prnt_result"></div>
									</div>

									<div id="text_por">
										<form action="/process?post" method="POST" autocomplete="off">
											<input id="pID" type="text" name="oID" value="<?php echo $userID; ?>" style="display:none;">
											<div class="pLoveText">
												<textarea name="VolimTE" rows="5" style="width:100%;" class="form-control" placeholder="Type .." minlength="2" maxlength="500"></textarea>
											</div>
											
											<br>
											<label id="p_a_an" style="cursor:pointer;">
												<input id="p_a_an" type="checkbox" name="is_anon" value="1"> Post as anonymous
											</label>

											<button class="btn btn-sm btn-info" style="float:right;">
												<i class="fa fa-send"></i> Post
											</button>
										</form>
									</div>
								</div>
							</div>

						</div>
					</div>
				<?php } ?>

				<hr>
					
				<!-- My love -->
				<div id="my_love" style="display:block;">
					<?php foreach ($Post->Posts($userID) as $k => $v) { ?>
						<?php 
							if ($v['Annon'] == true) {
								$uLink 	= '';
								$uImg 	= '/user/img/default.png';
								$uName 	= '<a class="anchor-username"><i>Anonymous</i><br>
								<small>@Anonymous</small></a>';
							} else {
								$uLink 	= '/@'.$User->UserDataByID($v['user_id'])['Username'].'';
								$uImg 	= $User->GetImage($v['user_id']);
								$uName 	= '<a href="/@'.$User->UserDataByID($v['user_id'])['Username'].'" class="anchor-username"><i>'.$User->getFullName($v['user_id']).'</i> <br>
								<small>@'.$User->UserDataByID($v['user_id'])['Username'].'</small></a>';
							}

							if ($Post->isLikePost($v['id'], $User->UserData()['id']) <= 0) {
								$thisLikedPost = '<p>
			                		<strong id="likeThis_'.$v['id'].'_Post" onclick="like_this_post('.$v['id'].')">
			                			<i id="liked_'.$v['id'].'" class="fa fa-heart-o"></i>
			                		</strong>

			                		<p style="margin-top: -20px;" id="i_l_p_num_'.$v['id'].'"><span>'.$Secure->viewConverter($Post->PostLikes($v['id'])).'</span></p>
			                	</p>';
							} else {
								$thisLikedPost = '<p>
			                		<strong id="likeThis_'.$v['id'].'_Post" onclick="unlike_this_post('.$v['id'].')">
			                			<i id="liked_'.$v['id'].'" class="fa fa-heart"></i>
			                		</strong>

			                		<p style="margin-top: -20px;" id="i_l_p_num_'.$v['id'].'"><span>'.$Secure->viewConverter($Post->PostLikes($v['id'])).'</span></p>
			                	</p>';
							}
						?>
						<div class="card" id="post_">
								<div class="panel panel-default">
						            <div class="panel-body">
						               	<section class="post-heading">
						                    <div class="row">
						                        <div class="col-md-12">
													<div class="media">
														<div class="media-left">
															<a href="<?php echo $uLink; ?>">
																<img class="media-object photo-profile" src="<?php echo $uImg; ?>" width="40" height="40" alt="...">
															</a>
														</div>
														<div class="media-body">
															<?php echo $uName; ?> 
															<p class="anchor-time">
																<?php if(!($v['user_id'] == $User->UserData()['id']) == false) { ?>
																	<span class="pEditPost" style="margin-top:-10px;" onclick="pEdit(<?php echo $v['id']; ?>)">
																		<i class="fa fa-edit"></i> edit
																	</span><br>
																<?php } ?>
																<?php $expDate = explode(', ', $v['Date']); ?>
																<span style="float:right;" title="<?php echo $v['Date']; ?>"><?php echo $expDate[1]; ?></span>
															</p>
														</div>
													</div>
						                    	</div>
						                	</div>        
						            	</section>

						            	<section class="post-body">
						                	<?php if (!empty($Secure->SecureTxt($v['p_audio'])) && !empty($Secure->SecureTxt($v['fInfo']))) { ?>
												<p style="margin:0;">
													<video class="afterglow" controls width="1920" height="1080">
														<source src="/<?php echo $Secure->SecureTxt($v['p_audio']); ?>" type="video/mp4" />
													</video>
												</p>
						                	<?php } else if (!empty($Secure->SecureTxt($v['p_audio']))) { ?>
												<p style="margin: 20px 0;">
													<audio class="audio_" id="<?php echo $v['id'].time(); ?>" controls>
														<source src="<?php echo $Secure->SecureTxt($v['p_audio']); ?>" type="audio/mpeg">
													</audio>
												</p>
						                	<?php } else { ?>
							                	<p><?php if (strlen( $Secure->SecureTxt($v['p_text']) ) <= 100) {
						                			echo '<span style="font-size:22px;">'.nl2br($Secure->SecureTxt($v['p_text'])).'</span>';
						                		} else {
						                			echo '<span style="font-size:normal;">'.nl2br($Secure->SecureTxt($v['p_text'])).'</span>';
						                		} ?></p>
												
												<?php $AnimCount = $Post->LoveHeartCount($v['p_text']); ?>
												<?php if($AnimCount !== 0) { ?>
													<span id="is_anim" onclick="love_anim(<?php echo $v['id'].', '.$Post->LoveHeartCount($v['p_text']); ?>)"></span>
													
													<div id="post_heart_<?php echo $v['id']; ?>" class="heartAnim">
														<br>
														<?php for ($i=0; $i < $AnimCount; $i++) { ?>
															<img src="assets/img/i/heart-curvy-outline-filled.png?<?php echo time(); ?>" id="p_heart_p_<?php echo $v['id']; ?>_b_<?php echo $i; ?>" class="animated infinite delay-2s" style="display:none;position:absolute;margin-left: -25px;">
														<?php } ?>
													</div>
												<?php } ?>
											<?php } ?>
						            	</section>
		
						            	<section class="post-footer">
						            		<?php echo $thisLikedPost; ?>
						            	</section>
						            </div>
						        </div>
						</div> <br>
					<?php } ?>
				</div>

    		</div>

		</div>
	</div>

	<div id="showUploadAnim" style="display:none;">
		<div id="dropBG"></div>
		<div id="uploadFile">
			<div class="uplodFile">
				<input id="fUploadE" type="file" name="File" id="File" style="opacity:0;">
				
				<div id="uploadText">
					<h1><i class="fa fa-cog"></i></h1>
				
					<h2>Please wait..</h2>
				</div>

				<div class="row justify-content-center">
					<div class="col-md-8">
						<div class="progress">
							<div id="fUploadStatus" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"><span id="fUploadNum">0</span></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Footer -->
	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/assets/php/footer.php'); ?>
	<!-- Table -->
	<script type="text/javascript" charset="utf8" src="/assets/js/jquery.dataTables.min.js"></script>

	<!-- inserting these scripts at the end to be able to use all the elements in the DOM -->
	<script src="/assets/record/js/WebAudioRecorder.min.js"></script>
	<script src="/assets/record/js/app.js?<?php echo time(); ?>"></script>
	<!-- Video js -->
	<script type="text/javascript" src="/assets/js/afterglow.min.js"></script>
	<script type="text/javascript" src="/assets/video/dist/plyr.js?v1"></script>
	
	<script type="text/javascript">
		var aplayers_multiple = new Plyr.setup('.audio_');
		var vplayers_multiple = new Plyr.setup('.vide_');

		$('.play-video').on('click', function() {
		    vplayers_multiple[1].volume = 0.5; // 0.5;
		    vplayers_multiple[1].currentTime = 1; // 10
		    vplayers_multiple[1].fullscreen.active = false; // false;
		});

		<?php if(get_active_link('love') == 'active') { ?>
			$('#my_quizz').fadeOut(300);
			//////////////////////////
			$('#my_love_p').fadeIn(300);
			$('#my_love').fadeIn(300);
		<?php } else if(get_active_link('know') == 'active') { ?>
			$('#my_love_p').fadeOut(300);
			$('#my_love').fadeOut(300);
			//////////////////////////
			$('#my_quizz').fadeIn(300);
		<?php } ?>

		function createDownloadLink(blob) {
			$('#preloader').fadeIn(300);

		    var url = URL.createObjectURL(blob);
		    var au = document.createElement('audio');
		    var li = document.createElement('li');
		    var link = document.createElement('a');

		    $(li).attr('id', 'recordedaudio-id');
		    var filename = new Date().toISOString();
		    au.controls = true;
		    au.src = url;
		    li.appendChild(au);
		    li.appendChild(link);

		    var xhr = new XMLHttpRequest();
		    var fd = new FormData();
		    fd.append('audio_data', blob, filename);
		    fd.append('o_id', <?php echo $userID; ?>);
		    xhr.open('POST', '/process?save_audio_msg', true);
		    xhr.send(fd);
		    xhr.onload = function(e) {
		        if(this.readyState === 4) {
		            console.log("Server returned: ", e.target.responseText);
		            document.location.href = '/@<?php echo $User->UserDataByID($userID)['Username'].'?t='.time(); ?>#post_';
		        }
		    };
		}
	</script>
	
</body>
</html>