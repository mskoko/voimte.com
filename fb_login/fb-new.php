<?php

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   file                 :  fb-new.php
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   author               :  Muhamed Skoko - info@mskoko.me
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

include_once($_SERVER['DOCUMENT_ROOT'].'/includes.php');


/* INCLUSION OF LIBRARY FILEs*/
include_once( $_SERVER['DOCUMENT_ROOT'].'/core/inc/libs/Facebook/autoload.php');

$fb = new Facebook\Facebook([
    'app_id' => APP_ID,
    'app_secret' => APP_SECRET,
    'default_graph_version' => 'v3.2',
]);

$helper = $fb->getRedirectLoginHelper();

try {
    $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

if (! isset($accessToken)) {
    if ($helper->getError()) {
        header('HTTP/1.0 401 Unauthorized');
        echo "Error: " . $helper->getError() . "\n";
        echo "Error Code: " . $helper->getErrorCode() . "\n";
        echo "Error Reason: " . $helper->getErrorReason() . "\n";
        echo "Error Description: " . $helper->getErrorDescription() . "\n";
    } else {
        header('HTTP/1.0 400 Bad Request');
        echo 'Bad request';
    }
    exit;
}

try {
    // Returns a `Facebook\FacebookResponse` object
    $response = $fb->get('/me?fields=id,first_name,last_name,gender,email,picture', $accessToken);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}


//Facebook response;
$user = $response->getGraphUser();

$SaveUserID = $Secure->SecureTxt($user['id']);
$fName      = $Secure->SecureTxt($user['first_name']);
$lName      = $Secure->SecureTxt($user['last_name']);
$Email      = $Secure->SecureTxt($user['email']);

//Proveri dali Email vec postoji u nasu bazu;
if (!($Email == $User->UserData()['Email'])) {
    if (!empty($User->UserIDByEmail($Email)['id'])) {
        $Alert->SaveAlert('This email is already registered in our database.', 'error');
        header("Location: /home");
        die();
    }
}

$pImage     = $Secure->SecureTxt($user['picture']['url']);

$Username   = strtolower($fName);
//Proveri dali Email vec postoji u nasu bazu;
if (!($Username == $User->UserData()['Username'])) {
    if (!empty($User->UserIDByUsername($Username)['id'])) {
        $Username = $Username.'.'.$Secure->RandomString(5);
    }
}

//Rand pass
$Pass = md5($Secure->RandomString(30));

//Add new acc
if (!($User->AddNewAccount($fName, $lName, $Username, $Email, $Pass, $Secure->RandomString(50))) == false) {
    //Login with FB :)
    $_SESSION['UserLogin']['ID']        = $User->UserIDByEmail($Email)['id'];
    
    $Alert->SaveAlert('You\'ve successfully created your account via Facebook!', 'success');
    header("Location: /@".$User->UserData()['Username']);
    die();
} else {
    $Alert->SaveAlert('An unknown error occurred. Please try again later. ps. We apologize for the inconvenience!', 'error');
    header("Location: /register");
    die();
}

/*
// Logged in
echo '<h3>Access Token</h3>';
var_dump($accessToken->getValue());

// The OAuth 2.0 client handler helps us manage access tokens
$oAuth2Client = $fb->getOAuth2Client();

// Get the access token metadata from /debug_token
$tokenMetadata = $oAuth2Client->debugToken($accessToken);
echo '<h3>Metadata</h3>';
var_dump($tokenMetadata);

// Validation (these will throw FacebookSDKException's when they fail)
$tokenMetadata->validateAppId('971768379839611'); // Replace {app-id} with your app id
// If you know the user ID this access token belongs to, you can validate it here
//$tokenMetadata->validateUserId('123');
$tokenMetadata->validateExpiration();

if (! $accessToken->isLongLived()) {
  // Exchanges a short-lived access token for a long-lived one
  try {
    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
  } catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
    exit;
  }

  echo '<h3>Long-lived</h3>';
  var_dump($accessToken->getValue());
}

$_SESSION['fb_access_token'] = (string) $accessToken;

// User is logged in with a long-lived access token.
// You can redirect them to a members-only page.
//header('Location: https://example.com/members.php');*/


?>