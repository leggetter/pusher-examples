<?php
require_once('../../lib/squeeks-Pusher-PHP/lib/Pusher.php');
require_once('../../config.php');

$pusher = new Pusher(APP_KEY, APP_SECRET, APP_ID);
echo $pusher->socket_auth($_POST['channel_name'], $_POST['socket_id']);
?>