<?php
require('../../config.php');
?>

<html>
  <head>
    <title>
    </title>
    <script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script src="http://js.pusher.com/1.11/pusher.min.js"></script>
    <script>
      function log(msg) {
        $('#logs').prepend('<div>' + msg + '</div>');
        if(console && console.log) {
          console.log(msg);
        }
      };
      Pusher.log = log;
    
      $(function() {
        // Get the Pusher app_key from the config
        var appKey = "<?php echo(APP_KEY); ?>";
        var pusher = new Pusher(appKey);
        
        // subscribe to the channel and bind to the event triggered within trigger.php
        var channel = pusher.subscribe('my-channel');
        channel.bind('my_event', function(data) {
          alert(data.message);
        });
        
        $('#triggerBtn').click(triggerEvent)
      });
      
      function triggerEvent() {
        // calling trigger.php with trigger the 'my_event' on the 'my-channel' channel.
        $.ajax({
          url: 'trigger.php',
          complete: function(xhr, status) {
            log(status + ': ' + xhr.responseText);
          }
        });
      };
      

    </script>
  </head>
  <body>
    <h1>PHP &amp; Pusher - Hello world!</h1>
    <button id="triggerBtn">Click Me!</button>
    
    <h3>Debug Log</h3>
    <div id="logs"></div>
  </body>
</html>