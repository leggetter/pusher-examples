<?php
require_once('../../vendor/autoload.php');
require '../../config.php';

session_start();
if($_POST['csrfKey'] != $_SESSION['csrfKey']) {
  die("Unauthorized source!");
}

$channel_name = $_POST['channelName'];
$json_data = $_POST['json'];
$json = json_encode($json_data);

if( strlen($channel_name) > 50 ) {
  header("HTTP/1.0 403 Forbidden");
  echo('Channel name is too long');
}

if( strlen($json) > 100 ) {
  header("HTTP/1.0 403 Forbidden");
  echo('JSON data is too long');
}

$pusher = new Pusher(APP_KEY, APP_SECRET, APP_ID);
$response = $pusher->trigger($channel_name, 'event', $json_data, null, true);
print_r($response);
?>