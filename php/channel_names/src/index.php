<?php
require('../../config.php');

session_start();
$csrfToken = md5(uniqid(mt_rand(),true));

$_SESSION['csrfToken'] = $csrfToken;
?>

<html>
  <head>
    <title>
    </title>
    <script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script src="http://js.pusher.com/1.11/pusher.min.js"></script>
    <script>
      Pusher.log = function(msg) {
        if(console && console.log) {
          console.log(msg);
        }
      };
    
      var channels = {};
      var appKey = "<?php echo(APP_KEY); ?>";
      var csrfToken = "<?php echo($csrfToken); ?>";
      var pusher = new Pusher(appKey);      
    
      $(function() {
        init();
      });
      
      function init() {
        $('#triggerBtn').click(triggerClicked)
      };
      
      function triggerClicked() {
        var channelName = $.trim( $('#channelName').val() );
        var data = $.trim( $('#data').val() );
        
        if(!channelName.length) {
          alert('Please provide a channel name');
          return;
        }
        
        if(data.length > 100) {
          alert('Sorry, restricting the JSON data size to 100 characters');
          return;
        }
        
        var jsonData = null;
        try {
          jsonData = JSON.parse(data);
        }
        catch(e) {
          alert('There\'s a problem with your JSON:\n\n' + e.message + '\n\n' + data);
          return;
        }
        
        if(channels[channelName] === undefined) {
          channels[channelName] = pusher.subscribe(channelName);
          channels[channelName].bind('pusher:subscription_succeeded', function() {

            channels[channelName].bind('event', function(eventData) {
              log('Event received:\n' + JSON.stringify(eventData));
            });

            triggerEvent(channelName, jsonData);
          });
        }
        else {
          triggerEvent(channelName, jsonData);
        }
        return false;
      };
      
      function triggerEvent(channelName, jsonData) {
        $.ajax({
          url: 'trigger.php',
          type: 'post',
          data: {
            channelName: channelName,
            json: jsonData,
            csrfToken: csrfToken
          },
          complete: function(xhr, status) {
            log(status + ': ' + xhr.responseText);
          }
        });
      };
      
      function log(msg) {
        $('#logs').prepend('<div>' + msg + '</div>');
      };
    </script>
  </head>
  <body>
    <label for="channelName">Channel name:</label>
    <input type="text" id="channelName" value="test-channel" /><br />
    <textarea id="data">{"hello":"world"}</textarea>
    <button id="triggerBtn">Trigger</button>
    <h3>Logs</h3>
    <div id="logs"></div>
  </body>
</html>