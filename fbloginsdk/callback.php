<?php
session_start();
require_once( 'Facebook/autoload.php' );
require_once('../db/functions.php');

$fb = new Facebook\Facebook([
  'app_id' => '386825701433017',
  'app_secret' => 'a483736f3cefaa859a9373125a974c09',
  'default_graph_version' => 'v2.5',
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


try {
  // Get the Facebook\GraphNodes\GraphUser object for the current user.
  // If you provided a 'default_access_token', the '{access-token}' is optional.
  $response = $fb->get('/me?fields=id,name,email,first_name,last_name', $accessToken->getValue());
//  print_r($response);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'ERROR: Graph ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'ERROR: validation fails ' . $e->getMessage();
  exit;
}
$me = $response->getGraphUser();
//print_r($me);

	/* ---- Session Variables -----*/
	    $_SESSION['FBID'] = $me->getProperty('id');           
        $_SESSION['FULLNAME'] = $me->getProperty('name');
	    $_SESSION['EMAIL'] =  $me->getProperty('email');
    /* ---- header location after session ----*/
checkuser($me->getProperty('id'), $me->getProperty('name'), $me->getProperty('email'));
header("location:..")
?>