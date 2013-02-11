<?php
require_once('../../vendor/autoload.php');
require '../../config.php';

$channel_name = 'my-channel';
$event_name = 'my_event';
$event_data = array('message' => 'Hello world!');
$socket_id = $_POST[ 'socket_id' ];

$pusher = new Pusher(APP_KEY, APP_SECRET, APP_ID);
$response = $pusher->trigger($channel_name, $event_name, $event_data, $socket_id, true);
print_r($response);
?>