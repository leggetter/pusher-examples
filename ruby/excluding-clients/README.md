# Simple example of excluding events from being distributed to certain clients using Pusher with Ruby

To get working:

1. Download these source files/clone the repo
2. Navigate to `ruby/excluding-clients/src` and run `bundle install` to get the gems and dependencies required by this example
3. [Sign up for Pusher](http://pusher.com/signup)
4. `mv config.example.rb config.rb`
5. Replace the `YOUR_` variable values with your Pusher App credentials
6. Start the Sinatra app by running `bundle exec ruby -rubygems myapp.rb`

Navigate to <http://localhost:4567/>

* Click the `Trigger` button to trigger an event.
* Check the `Exclude me from event message` checkbox and click the `Trigger` button. The event will be triggered but you will not receive the event. For more information see [Excluding Recipients](http://pusher.com/docs/publisher_api_guide/publisher_excluding_recipients).