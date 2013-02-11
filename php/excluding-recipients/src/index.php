<?php
require('../../config.php');
?>

<html>
  <head>
    <title>
    </title>
    <script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script src="http://js.pusher.com/1.12/pusher.min.js"></script>
    <script>
      Pusher.log = function(msg) {
        log( msg );
      };
    
      var appKey = "<?php echo(APP_KEY); ?>";
      var pusher = new Pusher(appKey); 

      pusher.subscribe( 'my-channel' );
      pusher.bind( 'my_event', function( data ) {
        log( 'data received: ' + JSON.stringify( data ) );
      } );
      
      function log(msg) {
        $('#logs').prepend('<div>' + msg + '</div>');
      };

      function triggerEvent() {
        $.ajax({
          url: 'trigger.php',
          type: 'post',
          data: {
            socket_id: pusher.connection.socket_id
          },
          complete: function(xhr, status) {
            log(status + ': ' + xhr.responseText);
          }
        });
        return false;
      };

      $( function() {
        $( '#triggerBtn' ).click( triggerEvent );
      } );
    </script>
  </head>
  <body>
    <p>If you click the button now you should see the response from the AJAX call logged but you will not recieve the event.</p>
    <p>If you open the example up in a new browser tab then if you trigger in one tab it will appear in the other. But, it will not be received by the tab which initially triggered the event.</p> 
    <button id="triggerBtn">Trigger</button>
    <h3>Logs</h3>
    <div id="logs"></div>
  </body>
</html>