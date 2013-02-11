<?php
require_once('../../vendor/autoload.php');
require_once('../../config.php');

$pusher = new Pusher(APP_KEY, APP_SECRET, APP_ID);
$user_id = uniqid();
$presence_data = array('name' => 'Phil Leggetter', 'twitter_id' => '@leggetter');
echo $pusher->presence_auth($_POST['channel_name'], $_POST['socket_id'], $user_id, $presence_data);
?>