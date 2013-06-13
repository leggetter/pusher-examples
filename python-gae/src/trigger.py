#!/usr/bin/env python
#
from google.appengine.ext import webapp
import pusher

try:
  import config
except ImportError:
  raise Exception("refer to the README on creating a config.py file")

class TriggerHandler(webapp.RequestHandler):
    def get(self):
	    p = pusher.Pusher(app_id=config.app_id, key=config.app_key, secret=config.app_secret)

	    p['my-channel'].trigger('my_event',{'msg': 'Hello world!'})

app = webapp.WSGIApplication([('/trigger', TriggerHandler)],
                                         debug=True)
