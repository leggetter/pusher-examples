<?php
  error_reporting(E_ALL);
  ini_set('display_errors', '1');

  require_once('../../vendor/autoload.php');
  require_once( '../../config.php' );

  define( 'CHANNEL', 'webhook_info' );

  // Pusher instance created for demonstration only.
  // used to log receipt of the WebHook
  $pusher = new Pusher(APP_KEY, APP_SECRET, APP_ID);

  $app_secret = APP_SECRET;

  $app_key = $_SERVER['HTTP_X_PUSHER_KEY']; 
  $webhook_signature = $_SERVER['HTTP_X_PUSHER_SIGNATURE'];

  $headers = array();
  foreach( $_SERVER as $key => $value ) {
    $headers[] = $key;
  }
  
  $body = file_get_contents('php://input');

  $pusher->trigger( CHANNEL, 'webhook_received',
    array(
      'key' => $app_key,
      'signature' => $webhook_signature,
      'body' => $body,
      'headers' => implode( ',' , $headers )
    )
  );

  $expected_signature = hash_hmac( 'sha256', $body, $app_secret, false );

  if($webhook_signature == $expected_signature) {
    $pusher->trigger( CHANNEL, 'signature_ok', array( 'msg' => 'WebHook signatures OK' ) );

    $payload = json_decode( $body, true );
    $pusher->trigger( CHANNEL, 'payload_decoded', $payload );

    foreach($payload['events'] as &$event) {
      $pusher->trigger( CHANNEL, 'event_received', $event );
    }

    header("Status: 200 OK");
  }
  else {
    $pusher->trigger( CHANNEL, 'auth_failed', array( 'msg' => 'WebHook recieved but not authorized' ) );
    header("Status: 401 Not authenticated");
  }
?>