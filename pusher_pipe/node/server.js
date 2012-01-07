var config = require('./config.js');
console.log(config);

var sys = require('sys');
var Pipe = require('pusher-pipe');

var client = Pipe.createClient({
    key: config.PUSHER_APP_KEY,
    secret: config.PUSHER_APP_SECRET,
    app_id: config.PUSHER_APP_ID,
    debug: true
});

client.subscribe(['socket_message', 'socket_existence']);

client.on('connected', function() {
  console.log('>>>>>>> connected event');
});

client.sockets.on('open', function(socketId) {
  console.log('>>>>>>> Connection by ' + socketId);
});

client.connect();

client.sockets.on('event:eventFromBrowser', function(socket_id, data){
    client.socket(socket_id).trigger('acknowledge', {message: 'back channel event'});
    
    client.channel('my-channel').trigger('my_event', {message: 'standard channel event'});
})