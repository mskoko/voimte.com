<?php

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   file                 :  post.php
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   author               :  Muhamed Skoko - mskoko.me@gmail.com
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

include_once($_SERVER['DOCUMENT_ROOT'].'/includes.php');

///////////////////////////

if (!($User->IsLoged()) == true) {
	header('Location: /login');
	die();
}

if (isset($GET['w'])) {
	$postID = $Secure->SecureTxt($GET['w']);
} else {
	$postID = '';
}

if (empty($postID) || !is_numeric($postID) || $postID == '') {
	die('Url is not a valid!');
}

if (empty($Post->PostByID($postID)['id'])) {
	die('Url is not a valid!');
}

if (isset($GET['del'])) {
	$postID = $Secure->SecureTxt($GET['w']);

	if(!($Post->PostByID($postID)['user_id'] == $User->UserData()['id']) == true) {
		$Alert->SaveAlert('This post is not you own!', 'error');
		header('Location: /post?w='.$postID);
		die('This post is not you own!');
	}

	///////////////////////
	if (!($Post->delPost($User->UserData()['id'], $postID)) == false) {
		$Alert->SaveAlert('Success!', 'success');
		header('Location: /home');
		die();
	} else {
		$Alert->SaveAlert('Error!', 'error');
		header('Location: /home');
		die();
	}
}


// default;
$pSave = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $Site->SiteConfig()['site_name']; ?></title>
	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/assets/php/head.php'); ?>


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
		<?php include_once($url.'/assets/php/nav.php'); ?>
	</header> <!-- end Header -->
	
	<div class="space" style="margin-top:50px;"></div>

	<!-- Page content -->
    <div class="container">
    	<div class="row justify-content-center">
			<div class="col-md-7">
				<?php if ($Post->PostByID($postID)['Annon'] == true) {
					$uLink 	= '';
					$uImg 	= '/user/img/default.png';
					$uName 	= '<a class="anchor-username"><i>Anonymous</i><br>
					<small>@Anonymous</small></a>';
				} else {
					$uLink 	= '/@'.$User->UserDataByID($Post->PostByID($postID)['user_id'])['Username'].'';
					$uImg 	= $User->GetImage($Post->PostByID($postID)['user_id']);
					$uName 	= '<a href="/@'.$User->UserDataByID($Post->PostByID($postID)['user_id'])['Username'].'" class="anchor-username"><i>'.$User->getFullName($Post->PostByID($postID)['user_id']).'</i> <br>
					<small>@'.$User->UserDataByID($Post->PostByID($postID)['user_id'])['Username'].'</small></a>';
				}

				if ($Post->isLikePost($Post->PostByID($postID)['id'], $User->UserData()['id']) <= 0) {
					$thisLikedPost = '<p>
                		<strong id="likeThis_'.$Post->PostByID($postID)['id'].'_Post" onclick="like_this_post('.$Post->PostByID($postID)['id'].')">
                			<i id="liked_'.$Post->PostByID($postID)['id'].'" class="fa fa-heart-o"></i>
                		</strong>

                		<p style="margin-top: -20px;" id="i_l_p_num_'.$Post->PostByID($postID)['id'].'"><span>'.$Secure->viewConverter($Post->PostLikes($Post->PostByID($postID)['id'])).'</span></p>
                	</p>';
				} else {
					$thisLikedPost = '<p>
                		<strong id="likeThis_'.$Post->PostByID($postID)['id'].'_Post" onclick="unlike_this_post('.$Post->PostByID($postID)['id'].')">
                			<i id="liked_'.$Post->PostByID($postID)['id'].'" class="fa fa-heart"></i>
                		</strong>

                		<p style="margin-top: -20px;" id="i_l_p_num_'.$Post->PostByID($postID)['id'].'"><span>'.$Secure->viewConverter($Post->PostLikes($Post->PostByID($postID)['id'])).'</span></p>
                	</p>';
				} ?>

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
													<?php $expDate = explode(', ', $Post->PostByID($postID)['Date']); ?>
													<span style="float:right;" title="<?php echo $Post->PostByID($postID)['Date']; ?>"><?php echo $expDate[1]; ?></span>
												</p>
											</div>
										</div>
			                    	</div>
			                	</div>        
			            	</section>

			            	<section class="post-body">
			                	<?php if (!empty($Secure->SecureTxt($Post->PostByID($postID)['p_audio'])) && !empty($Secure->SecureTxt($Post->PostByID($postID)['fInfo']))) { ?>
									<p style="margin:0;">
										<video class="vide_" id="player" onerror="failed(event)" style="width: 100%;height:80vh;">
											<source src="/<?php echo $Secure->SecureTxt($Post->PostByID($postID)['p_audio']); ?>" type="video/mp4" />
										</video>
									</p>
			                	<?php } else if (!empty($Secure->SecureTxt($Post->PostByID($postID)['p_audio']))) { ?>
									<p style="margin: 20px 0;">
										<audio class="audio_" id="<?php echo $Post->PostByID($postID)['id'].time(); ?>" controls>
											<source src="<?php echo $Secure->SecureTxt($Post->PostByID($postID)['p_audio']); ?>" type="audio/mpeg">
										</audio>
									</p>
			                	<?php } else { ?>
			                		<?php if(empty($Secure->SecureTxt($Post->PostByID($postID)['p_text']))) {
			                			$pSave = 0;
			                		} else {
			                			$pSave = 1;
			                		} ?>
				                	<form id="sPost" action="/process?sPost" method="POST" autocomplete="off" accept-charset="utf-8">
				                		<input type="text" name="pID" value="<?php echo $postID ?>" style="display:none;">
				                		
				                		<textarea name="pMsg" class="form-control" style="width:100%;height:150px;" required=""><?php echo $Secure->SecureTxt($Post->PostByID($postID)['p_text']); ?></textarea>
				                	</form>
									
									<?php $AnimCount = $Post->LoveHeartCount($Post->PostByID($postID)['p_text']); ?>
									<?php if($AnimCount !== 0) { ?>
										<span id="is_anim" onclick="love_anim(<?php echo $Post->PostByID($postID)['id'].', '.$Post->LoveHeartCount($Post->PostByID($postID)['p_text']); ?>)"></span>
										
										<div id="post_heart_<?php echo $Post->PostByID($postID)['id']; ?>" class="heartAnim">
											<br>
											<?php for ($i=0; $i < $AnimCount; $i++) { ?>
												<img src="/assets/img/i/heart-curvy-outline-filled.png?<?php echo time(); ?>" id="p_heart_p_<?php echo $Post->PostByID($postID)['id']; ?>_b_<?php echo $i; ?>" class="animated infinite delay-2s" style="display:none;position:absolute;margin-left: -25px;">
											<?php } ?>
										</div>
									<?php } ?>
								<?php } ?>
			            	</section>

			            	<section class="post-footer">
			            		<?php echo $thisLikedPost; ?>
			            	</section> 

			            	<?php if(!($Post->PostByID($postID)['user_id'] == $User->UserData()['id']) == false) { ?> <hr>
					            <div class="pBtnss" style="margin:0 10px;position:relative;z-index:9999;">
					            	<a href="/post?w=<?php echo $postID; ?>&del" class="btn btn-sm btn-danger" style="float:left;">
					            		<i class="fa fa-trash"></i> Delete
					            	</a>
									<?php if ($pSave == 1) { ?>
						            	<a href="javascript:;" class="btn btn-sm btn-success" style="float:right;" onclick="return $('#sPost').submit();">
						            		<i class="fa fa-save"></i> Save
						            	</a>
						            <?php } ?>
					            </div> <div class="clearfix"><br><br></div>
					        <?php } ?>
			            </div>
			        </div>
				</div>

			</div>
    	</div>
    </div>

	<!-- Footer -->
	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/assets/php/footer.php'); ?>
	<!-- Video js -->
	<script type="text/javascript" src="/assets/video/dist/plyr.js?v1"></script>
	<script type="text/javascript">
		var aplayers_multiple = new Plyr.setup('.audio_');
		var vplayers_multiple = new Plyr.setup('.vide_');

		$('.play-video').on('click', function() {
			vplayers_multiple[1].volume = 0.5; // 0.5;
			vplayers_multiple[1].currentTime = 1; // 10
			vplayers_multiple[1].fullscreen.active = false; // false;
		});
		function like_this_post(pID) {
			if(pID == '') {
				alert('Sorry.');
			} else {
				$.ajax({
	                url: '/process?like_post',
	                dataType: 'text',
	                type: 'POST',
	                contentType: 'application/x-www-form-urlencoded',
	                data: 'pID='+pID,
	                success: function( data, textStatus, jQxhr ) {
	                    $('#liked_'+pID).removeClass('fa-heart-o');
	                    $('#liked_'+pID).addClass('fa-heart');

	                    //change btn > unlike
	                    document.getElementById('likeThis_'+pID+'_Post').setAttribute('onclick', 'unlike_this_post('+pID+')');

	                    $('#i_l_p_num_'+pID+' span').html( data );
	                },
	                error: function( jqXhr, textStatus, errorThrown ){
	                    console.log( errorThrown );
	                }
	            });
			}
		}
		function unlike_this_post(pID) {
			if(pID == '') {
				alert('Sorry.');
			} else {
				$.ajax({
	                url: '/process?unlike_post',
	                dataType: 'text',
	                type: 'POST',
	                contentType: 'application/x-www-form-urlencoded',
	                data: 'pID='+pID,
	                success: function( data, textStatus, jQxhr ){
	                    $('#liked_'+pID).removeClass('fa-heart');
	                    $('#liked_'+pID).addClass('fa-heart-o');

	                    //change btn > like
	                    document.getElementById('likeThis_'+pID+'_Post').setAttribute('onclick', 'like_this_post('+pID+')');

	                    $('#i_l_p_num_'+pID+' span').html( data );
	                    console.log(data);
	                },
	                error: function( jqXhr, textStatus, errorThrown ){
	                    console.log( errorThrown );
	                }
	            });
			}
		}
		function sleep(ms) {
			return new Promise(resolve => setTimeout(resolve, ms));
		}
		async function love_anim(post_id, num_heart) {
			if(post_id == ''||num_heart == '') {
				alert('Sorry, this Post has ben problem!');
			} else {
				//Max num is 10 heart!
				if (num_heart > 10) {
					num_heart = 10;
				}

				var i;
				for (i = 0; i < num_heart; i++) {
					$('#p_heart_p_'+post_id+'_b_'+i).addClass('zoomInRight');
					$('#p_heart_p_'+post_id+'_b_'+i).show();
					$('#p_heart_p_'+post_id+'_b_'+i).hide(300);
					
					await sleep(200);
				}
				//alert(post_id + ' :: ' + num_heart);
			}
		}
		$('#preloader').fadeOut(300);
	</script>
</body>
</html>