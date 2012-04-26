<?php
require('../../config.php');
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Presence Authentication Example</title>
  
  <style>
    #debug {
      margin-top: 20px;
    }
  
    #subscription_status.subscribed {
      color: green;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <h1>Presence Authentication Example</h1>
  
  <div>Subscription status: <span id="subscription_status">Not subscribed</span></div>
  
  <div id="debug"></div>

  <script src="http://js.pusher.com/1.12/pusher.min.js"></script>
  <script>
    // default value is '/pusher/auth'
    Pusher.channel_auth_endpoint = "presence_auth.php";
    
    var APP_KEY = '<?php echo(APP_KEY); ?>';
    var pusher = new Pusher(APP_KEY);
    var channel = pusher.subscribe('presence-channel');
    channel.bind('pusher:subscription_succeeded', function() {
      var el = document.getElementById('subscription_status');
      el.innerText = 'Subscribed!';
      el.className = 'subscribed';
    });
    
    // for debugging purposes. Not required.
    Pusher.log = function(msg) {
      if(window.console && window.console.log) {
        window.console.log(msg);
      }
      
      var el = document.createElement('div');
      el.innerText = msg;
      document.getElementById('debug').appendChild(el);
    }
  </script>
</body>
</html>