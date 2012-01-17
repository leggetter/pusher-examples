#!/usr/bin/env python
#
from google.appengine.ext import webapp
from google.appengine.ext.webapp import util
import pusher

try:
  import config
except ImportError:
  raise Exception("refer to the README on creating a config.py file")

class TriggerHandler(webapp.RequestHandler):
    def get(self):
	    p = pusher.Pusher(app_id=config.app_id, key=config.app_key, secret=config.app_secret)

	    p['my-channel'].trigger('my_event',{'msg': 'Hello world!'})

def main():
    application = webapp.WSGIApplication([('/trigger', TriggerHandler)],
                                         debug=True)
    util.run_wsgi_app(application)


if __name__ == '__main__':
    main()
