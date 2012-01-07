#Simple Pusher Pipe Example

For more information on the Pusher Pipe see:
<http://pusher.com/docs/pipe>

## Technologies

The Pusher Pipe only has a client library for Node.js at the moment.

## Example

### Node.js

To run this example you must install the `pusher-pipe` node.js module. You can find the module here:
http://search.npmjs.org/#/pusher-pipe

And install using:

    npm pusher-pipe
    
See the [Pusher Pipe QuickStart](http://pusher.com/docs/pipe_quickstart) for more information.

The node example found in `node/src/` is based on the [Pusher Pipe QuickStart](http://pusher.com/docs/pipe_quickstart). It demonstrates how to:

* Be notified of a socket connection on the server
* trigger an event from the client on the `back_channel`
* trigger an event from the server on the `back_channel`
* subscribe to a channel and bind to an event on the client
* trigger an event on a channel from the server