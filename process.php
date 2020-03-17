<?php

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   file                 :  process.php
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   author               :  Muhamed Skoko - info@mskoko.me
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

include_once($_SERVER['DOCUMENT_ROOT'].'/includes.php');

///////////////////////////////////

function pre_r($Array) {
	echo '<pre>';
	print_r($Array);
	echo '</pre>';
}

if (isset($_GET['cookie_alert'])) {
	//Zastiti input;
	$POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
	$isAorD = $Secure->SecureTxt($POST['isAorD']);
	if (!empty($isAorD)||!is_numeric($isAorD)) {
		$isAorD = '1';
	}

	// Get Current date, time
	$current_time = time();

	// Set Cookie expiration for 1 month
	$cookie_expiration_time = $current_time + (30 * 24 * 60 * 60);  // for 1 month
	setcookie('accept_cookie', $isAorD, $cookie_expiration_time);

	die(true);
}

/////////////////////////////////////

if (isset($_GET['s'])) {
	//Zastiti input
	$POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

	$sText = $Secure->SecureTxt($POST['s']);
	//$sText = $Secure->SecureTxt($_GET['s']);

	if (empty($sText)) {
		die('<small>Search by ..</small>');
	} else {
		if ($Search->UserSearch($sText)['Count'] <= 0) {
			die('<small>No results ..</small>');
		}
		foreach ($Search->UserSearch($sText)['Response'] as $k => $v) { ?>
			<div class="media">
				<div class="media-left">
					<a href="/@<?php echo $Secure->SecureTxt($v['Username']); ?>">
						<img class="media-object photo-profile" src="<?php echo $User->GetImage($v['id']); ?>" width="40" height="40" alt="<?php echo $Secure->SecureTxt($User->getFullName($v['id'])); ?>">
					</a>
				</div>
				<div class="media-body">
					<a href="/@<?php echo $Secure->SecureTxt($v['Username']); ?>" class="anchor-username">
						<i><?php echo $Secure->SecureTxt($User->getFullName($v['id'])); ?></i> <br>
						<small>@<?php echo $Secure->SecureTxt($v['Username']); ?></small>
					</a>
				</div>
			</div>
		<?php }
	}
}


if (isset($_GET['post'])) {
	//Zastiti input
	$POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

	$ownerID 	= $Secure->SecureTxt($POST['oID']);
	$VolimTe 	= $Secure->SecureTxt($POST['VolimTE']);
	if (isset($POST['is_anon'])) {
		$Anon = '1';
	} else {
		$Anon = '0';
	}

	if (empty($VolimTe)||strlen($VolimTe) <= 2) {
		$Alert->SaveAlert('You have to write a message', 'error');
		header("Location: /@".$User->UserDataByID($ownerID)['Username']);
		die();
	}

	if (!($Post->AddProfileMsg($ownerID, $User->UserData()['id'], $VolimTe, '', $Anon, NULL)) == false) {
		$Alert->SaveAlert('Success!', 'success');
		header("Location: /@".$User->UserDataByID($ownerID)['Username']);
		die();
	} else {
		$Alert->SaveAlert('An unknown error has occurred! Please try again later.', 'error');
		header("Location: /@".$User->UserDataByID($ownerID)['Username']);
		die();
	}
}


if (isset($_GET['like_post'])) {
	//Zastiti input
	$POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

	$PostID = $Secure->SecureTxt($POST['pID']);

	if (!is_numeric($PostID)) {
		return false;
		die();
	}

	if ($Post->isLikePost($PostID, $User->UserData()['id']) == 0) {
		$Post->addLikePost($PostID, $User->UserData()['id']);
		echo $Post->PostLikes($PostID);
		die();
	} else {
		echo $Post->PostLikes($PostID);
		die();
	}
}

if (isset($_GET['unlike_post'])) {
	//Zastiti input
	$POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

	$PostID = $Secure->SecureTxt($POST['pID']);

	if (!is_numeric($PostID)) {
		die(false);
	}

	if ($Post->isLikePost($PostID, $User->UserData()['id']) >= 0) {
		$Post->RemoveLikePost($PostID, $User->UserData()['id']);
		echo $Post->PostLikes($PostID);
		die();
	} else {
		echo $Post->PostLikes($PostID);
		die();
	}
}


if (isset($_GET['save_profile'])) {
	//Zastiti input
	$POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

	$Username 	= $Secure->SecureTxt($POST['Username']);
	//Proveri dali Email vec postoji u nasu bazu;
	if (!($Username == $User->UserData()['Username'])) {
		if (!empty($User->UserIDByUsername($Username)['id'])) {
			$Alert->SaveAlert('This username is already registered in our database.', 'error');
			header("Location: /settings");
			die();
		}
	}

	$fName 		= $Secure->SecureTxt($POST['fName']);
	$lName 		= $Secure->SecureTxt($POST['lName']);
	$Email 		= $Secure->SecureTxt($POST['Email']);
	$Website 	= $Secure->SecureTxt($POST['Website']);

	//Proveri dali Email vec postoji u nasu bazu;
	if (!($Email == $User->UserData()['Email'])) {
		if (!empty($User->UserIDByEmail($Email)['id'])) {
			$Alert->SaveAlert('This email is already registered in our database.', 'error');
			header("Location: /settings");
			die();
		}
	}

	//Napravi proveru za Website
	if (!empty($Website)) {
		//$Website = 'http://'.$Website;
	}

	//User Avatar
	$UserPhoto 		= $_FILES['UserPhoto'];
	if (!empty($UserPhoto['name'])) {
		//File upload dir;
		$Putanja 		= 'user/img/';
		//File Name
		$fFileName 		= $Secure->SecureTxt(basename($UserPhoto['name']));
		//File Extensions
		$Ext 			= strtolower(pathinfo($fFileName, PATHINFO_EXTENSION));

		//Alow ext is mp4
		$AllowedExt = ['jpg', 'jpeg', 'png', 'gif'];
		if (!in_array($Ext, $AllowedExt)) {
			$Alert->SaveAlert('This image format is not supported! Allowed only image format is: (<b>JPG, JPEG, PNG & GIF</b>)', 'error');
			header("Location: /settings");
			die('error');
		}

		$ImgLink 		= $Secure->RandomString(50);

		//Save to DB;
		$Image 		= $Putanja.$ImgLink.'.'.$Ext;

		//File :: Folder :: File Name :: Extension
		$Upload->UploadFile($UserPhoto, $Putanja, $ImgLink, $Ext);
	} else {
		$Image = $User->UserData()['Image'];
	}

	if (!($User->UpdateInformation($Username, $fName, $lName, $Email, $Website, $Image, $User->UserData()['id'])) == false) {
		$Alert->SaveAlert('Success!', 'success');
		header("Location: /@".$User->UserData()['Username']);
		die();
	} else {
		$Alert->SaveAlert('An unknown error has occurred! Please try again later.', 'error');
		header("Location: /@".$User->UserData()['Username']);
		die();
	}
}

if (isset($_GET['sVideo'])) {
	echo "??";
	//Zastiti input;
	$POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
	//Upload this.
	$ownerID = $Secure->SecureTxt($POST['oID']);
	if (empty($ownerID)||!is_numeric($ownerID)) {
		die('..?');
	}

	//echo "ok?";
	if (isset($_FILES['File'])) {
		$File = $_FILES['File'];

		if (!empty($File['name'])) {
			//File upload dir;
			$Putanja 		= 'user/v/';
			//File Name
			$fFileName 		= $Secure->SecureTxt(basename($File['name']));
			//File Extensions
			$Ext 			= strtolower(pathinfo($fFileName, PATHINFO_EXTENSION));
			$RandomLink 	= $Secure->RandomString(50);

			//Save to DB;
			$FileLink 		= $Putanja.$RandomLink.'.'.$Ext;

			//Alow ext is mp4
			$AllowedExt = ['mp4', 'avi', 'gif'];
			if (!in_array($Ext, $AllowedExt)) {
				$Alert->SaveAlert('This video format is not supported! Allowed only video format is: (<b>MP4, AVI, GIF</b>)', 'error');
				die('error');
			}

			include_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/libs/getID3-master/getid3/getid3.php');
			$getID3 = new getID3;
			$ThisFileInfo = $getID3->analyze($File['tmp_name']);
			getid3_lib::CopyTagsToComments($ThisFileInfo);
			//print_r($ThisFileInfo, true);
			$SaveVideoInfo = Array(
				'duration_string' 	=> $ThisFileInfo['playtime_string'],
				'duration_seconds' 	=> $ThisFileInfo['playtime_seconds'],
				'dimensions_y' 		=> $ThisFileInfo['video']['resolution_x'],
				'dimensions_x' 		=> $ThisFileInfo['video']['resolution_y'],
				'filesize_bytes' 	=> $ThisFileInfo['filesize'],
			);

			//Max playtime_string is 5min
			if ($ThisFileInfo['playtime_string'] >= '5:01') {
				$Alert->SaveAlert('Your video is too large, the video should be no longer than (<b>5:00</b>minutes)', 'error');
				die('error');
			}

			//pre_r($SaveVideoInfo);

			//File :: Folder :: File Name :: Extension
			if (!($Upload->UploadFile($File, $Putanja, $RandomLink, $Ext, '', '', 0)) == true) {
				die('error1');	
			}

			if (!($Post->AddProfileMsg($ownerID, $User->UserData()['id'], '', $FileLink, '', serialize($SaveVideoInfo))) == false) {
				$Alert->SaveAlert('Success!', 'success');
				die('success');
			} else {
				die('error2');
			}
			die('success');
		}
	} else {
		die('Video is not select :(');
	}
	die('error3');

}

if (isset($_GET['change_password'])) {
	$Pass 	= $Secure->SecureTxt($POST['Pass']);
	$nPass 	= $Secure->SecureTxt($POST['nPass']);
	$nrPass = $Secure->SecureTxt($POST['nrPass']);

	if ($User->UserData()['Password'] == md5($Pass)) {
		if ($nPass == $nrPass) {
			$nPass = md5($nPass);
			$User->UpdatePassword($nPass, $User->UserData()['id']);

			$Alert->SaveAlert('Success!', 'success');
			header("Location: /settings");
			die();
		} else {
			$Alert->SaveAlert('Please make sure you have entered your password correctly', 'error');
			header("Location: /settings");
			die();
		}
	} else {
		$Alert->SaveAlert('Password nije tacan!', 'error');
		header("Location: /settings");
		die();
	}
}

if (isset($_GET['new_account'])) {
	$Username 	= $Secure->SecureTxt($POST['Username']);
	//Proveri dali Email vec postoji u nasu bazu;
	if (!($Username == $User->UserData()['Username'])) {
		if (!empty($User->UserIDByUsername($Username)['id'])) {
			$Alert->SaveAlert('This username is already registered in our database.', 'error');
			header("Location: /register");
			die();
		}
	}

	$Name 		= explode(' ', $Secure->SecureTxt($POST['Name']));
	if (isset($Name[0])) {
		$fName 		= $Secure->SecureTxt($Name[0]);
	} else {
		$fName 		= '';
		die('Please Enter the your name');
	}
	if (isset($Name[1])) {
		$lName 		= $Secure->SecureTxt($Name[1]);
	} else {
		$lName 		= '';
	}

	/////////////////////
	$vratiNaProfil = $Secure->SecureTxt($POST['naProf']);
	if (!empty($User->GetIDuName($vratiNaProfil)['id'])) {
		$rdrNaProf = $vratiNaProfil;
	} else {
		$rdrNaProf = '';
	}

	$Email 		= $Secure->SecureTxt($POST['Email']);
	//Proveri dali Email vec postoji u nasu bazu;
	if (!($Email == $User->UserData()['Email'])) {
		if (!empty($User->UserIDByEmail($Email)['id'])) {
			$Alert->SaveAlert('This email is already registered in our database.', 'error');
			header('Location: /register?rdr='.$rdrNaProf);
			die();
		}
	}

	$Pass 	= md5($Secure->SecureTxt($POST['Pass']));
	if (!($User->AddNewAccount($fName, $lName, $Username, $Email, $Pass, $Secure->RandomString(50))) == false) {
		$Alert->SaveAlert('Success!', 'success');
		header('Location: /login?autologin&id='.$User->UserIDByEmail($Email)['id'].'&key='.$User->UserIDByEmail($Email)['reg_token'].'&rdr='.$rdrNaProf);
		die();
	} else {
		$Alert->SaveAlert('An unknown error occurred. Please try again later. ps. We apologize for the inconvenience!', 'error');
		header('Location: /register?rdr='.$rdrNaProf);
		die();
	}
}


/* CREATE QUIZZ */
if (isset($_GET['create_quizz'])) {
	//Zastiti input
	$POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

	$qID 	= $POST['qID'];
	
	//Provera za Count - Pitanja 
	if (!(count($qID) === 10) === true) {
		die('Ovaj Quizz se sastoji od 10 pitanja. Vas rezultat: '.count($qID).'/10');
	}

	//Get Questions
	foreach ($qID as $k => $v) {
		//Get Question ID;
		$QuestionID = $Secure->SecureTxt($v);

		//Get Answers
		$quizAnswer = $POST['quizAnswer_'.$QuestionID];
		if (isset($quizAnswer)) {
			foreach ($quizAnswer as $kk => $vv) {
				//Get Answer ID;
				$AnswerID = $Secure->SecureTxt($vv);

				//Type 
				$qType 		= $Secure->SecureTxt($Quizz->GetTemplateByID($Quizz->GetQuestionByID($v)['qID'])['Type']);

				//Question
				$qQuestion 	= $Secure->SecureTxt($Quizz->GetQuestionByID($v)['Question']);

				//Answer
				$qAnswer 	= $Secure->SecureTxt($Quizz->GetAnswersByID($AnswerID)['Answer']);
				
				//Save Question
				//Ako vec postoji vrati false;
				if (empty($Quizz->UserQuestionLast($QuestionID, $User->UserData()['id'])['id'])) {
					if (!($Quizz->SaveUserQuestion($qType, $QuestionID, $User->UserData()['id'])) == false) {
						//Get last user Question ID;
						$LastUserQid = $Quizz->UserQuestionLast($QuestionID, $User->UserData()['id'])['id'];
						//Save Answers
						if (empty($Quizz->UserAnswerLast($LastUserQid, $User->UserData()['id'])['id'])) {
							if (!($Quizz->SaveUserAnswer($LastUserQid, $User->UserData()['id'], $qAnswer)) == false) {
								$return = true;
							} else {
								$return = false;
							}
						}
					} else {
						$return = false;
					}
				} else {
					$return = false;
				}

				//echo 'Type: '.$qType.' | qID '.$QuestionID.' | Question: '.$qQuestion.' | Answer: '.$qAnswer.'<hr>';
			}

		}
	}//Get question

	if (!($return) == false) {
		$Alert->SaveAlert('Success!', 'success');
		header("Location: /@".$User->UserData()['Username']);
		die();
	} else {
		$Alert->SaveAlert('An unknown error occurred. Please try again later. ps. We apologize for the inconvenience!', 'error');
		header("Location: /@".$User->UserData()['Username']);
		die();
	}


}

/* USER ANSWER */
if (isset($_GET['quizz_u_answer'])) {
	//Zastiti input;
	$POST 	= filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

	$userID = $Secure->SecureTxt($POST['uID']);

	$qID 	= $POST['qID'];
	
	//Provera za Count - Pitanja 
	if (!(count($qID) === 10) === true) {
		die('Ovaj Quizz se sastoji od 10 pitanja. Vas rezultat: '.count($qID).'/10');
	}

	//Get Questions
	$cAns=0;
	foreach ($qID as $k => $v) {
		//Get Question ID;
		$QuestionID = $Secure->SecureTxt($v);

		//Get Answers
		$quizAnswer = $POST['u_quizAnswer_'.$QuestionID];
		if (isset($quizAnswer)) {
			foreach ($quizAnswer as $kk => $vv) {
				//Get Answer ID;
				$AnswerID 	= $Secure->SecureTxt($vv).'<br>';

				//Answer
				$tID 		= '1';
				$Answer 	= $Secure->SecureTxt($Quizz->GetAnswersByID($AnswerID)['Answer']);

				//Ako vec postoji vrati false;
				if (empty($Quizz->UserAnswerLastByUser($QuestionID, $User->UserData()['id'])['id'])) {
					//Save Answer
					if (!($Quizz->SaveUserAnswerByUser($tID, $QuestionID, $Answer, $User->UserData()['id'], $userID)) == false) {
						$return = true;
					} else {
						$return = false;
					}
				} else {
					$return = false;
				}

				//proveri dali je tacan odgovor;
				//$cAnswer = $Quizz->PrintAnswersByQid($QuestionID, $userID)['cAnswer'];
				$cAnswer = $Quizz->PrintAnswersByQid($QuestionID)['cAnswer'];
				//print_r($Quizz->PrintAnswersByQid($QuestionID));
				$cAns++;
				if (!($Answer == $cAnswer)) {
					$cAns = intval($cAns-1);
				}

				//echo 'Answer: '.$Answer.' ~ cAnswer: '.$cAnswer.' ~ '.$cAns;
				//die();
			}
		}
	}

	if (!($return) == false) {
		//Save for result in table;
		$Quizz->SaveResult($QuestionID, $cAns, $User->UserData()['id'], $userID);

		$Alert->SaveAlert('Success!', 'success');
		header("Location: /@".$User->UserDataByID($userID)['Username']);
		die();
	} else {
		$Alert->SaveAlert('An unknown error occurred. Please try again later. ps. We apologize for the inconvenience!', 'error');
		header("Location: /@".$User->UserDataByID($userID)['Username']);
		die();
	}
}


if (isset($_GET['likeThisResult'])) {
	//Zastiti input
	$POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

	$userID = $Secure->SecureTxt($POST['uID']);

	if (empty($Quizz->isLikeThisResult($userID, $User->UserData()['id']))) {
		if (!($Quizz->LikeThisResult($userID, $User->UserData()['id'])) == false) {
			die('success');
		} else {
			die('error');
		}
	} else {
		die();
	}

}




if (isset($_GET['save_audio_msg'])) {
	//Zastiti input
	$POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

	//Upload this.
	$ownerID = $Secure->SecureTxt($POST['o_id']);

	//Audio message
	if (isset($_FILES['audio_data'])) {
		$AudioMsg = $_FILES['audio_data'];

		if (!empty($AudioMsg['name'])) {
			//File upload dir;
			$Putanja 		= 'user/audio_msg/';
			//File Name
			$fFileName 		= $Secure->SecureTxt(basename($AudioMsg['name']));
			//File Extensions
			//$Ext 			= strtolower(pathinfo($fFileName, PATHINFO_EXTENSION));
			$Ext			= 'mp3';
			$RandomLink 	= $Secure->RandomString(50);

			//Save to DB;
			$AudioMsgLink 		= $Putanja.$RandomLink.'.'.$Ext;

			//File :: Folder :: File Name :: Extension
			if (!($Upload->UploadFile($AudioMsg, $Putanja, $RandomLink, $Ext, '', '', 1)) == true) {
				die('error');	
			}

			if (!($Post->AddProfileMsg($ownerID, $User->UserData()['id'], '', $AudioMsgLink, '', NULL)) == false) {
				die('success!');
			} else {
				die('error!');
			}
		}
	}

	/*
		//Save this.
   		move_uploaded_file($_FILES['audio_data']['tmp_name'], $url.'/user/audio_msg/file3.mp3');
    	die();
    */
}
if (isset($GET['sPost'])) {
	$postID = $Secure->SecureTxt($POST['pID']);
	if(empty($Secure->SecureTxt($Post->PostByID($postID)['id']))) {
		die('This post is not valid!');
	}

	if(!($Post->PostByID($postID)['user_id'] == $User->UserData()['id']) == true) {
		$Alert->SaveAlert('This post is not you own!', 'error');
		header('Location: /post?w='.$postID);
		die('This post is not you own!');
	}

	$pMsg = $Secure->SecureTxt($POST['pMsg']);
	if (empty($pMsg) || $pMsg == '') {
		$Alert->SaveAlert('Message is empty! -Please type a message', 'error');
		header('Location: /post?w='.$postID);
		die('Message is empty! -Please type a message');
	}

	///////////////////////
	if (!($Post->editPost($pMsg, $User->UserData()['id'], $postID)) == false) {
		$Alert->SaveAlert('Success!', 'success');
		header('Location: /post?w='.$postID);
		die();
	} else {
		$Alert->SaveAlert('Error!', 'error');
		header('Location: /post?w='.$postID);
		die();
	}
}






