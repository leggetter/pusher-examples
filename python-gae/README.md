# Using Pusher with Google App Engine

This project provides a really simple example of:

* Triggering messages in `src/trigger.py`
* Authenticating a [Private Channel](http://pusher.com/docs/private_channel) in `src/pusher_auth.py`
* Authenticating a [Presence Channel](http://pusher.com/docs/presence_channel) in `src/pusher_presence_auth.py`

The project uses the [Generic Pusher Python library](https://github.com/pusher/pusher_client_python) and includes it for completeness in the `pusher` directory.

## Getting started

### Create your config file

    cd src
    cp config_example.py config.py
    
And edit the new `config.py` file and add your own Pusher application credentials.

### Add the app to the GoogleAppEngineLauncher

* Open GoogleAppEngineLauncher
* File -> Add Existing Application...
* In the settings dialog browse to the `src` direction and click 'Choose'
* Enter a port number you are happy with
* Click 'Add'
* Click the 'Run' button
* Navigate to the web server that is spun up

### Using the application

* Click the 'Trigger' button to trigger and event with the data `{'msg': 'Hello world!'}`. The contents of the `msg` property will be alerted when it's pushed to the web application. The source which triggers the message is in `src/trigger.py`.
* Click the 'Subscribe to Private Channel' button. The `src/pusher_auth.py` code will be executed to authenticate the subscription. When the subscription has been accepted by pusher the `pusher:subscription_succeeded` event will be triggered and an alert will appear confirming the subscription.
* Click the 'Subscribe to Presence Channel' button. The `src/pusher_presence_auth.py` code will be executed to authenticate the subscription. When the subscription has been accepted by pusher the `pusher:subscription_succeeded` event will be triggered and an alert will appear confirming the subscription.

## Demo:

<http://gae-pusher-test.appspot.com/>
