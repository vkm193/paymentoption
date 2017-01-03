<?php
session_start();
require_once( 'Facebook/autoload.php' );

$fb = new Facebook\Facebook([
  'app_id' => '386825701433017',
  'app_secret' => 'a483736f3cefaa859a9373125a974c09',
  'default_graph_version' => 'v2.5',
]); 

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions for more permission you need to send your application for review
$loginUrl = $helper->getLoginUrl('http://paymentoption.in/fbloginsdk/callback.php', $permissions);

header("location: ".$loginUrl);

?>