#!/usr/bin/env python
#
from google.appengine.ext import webapp
from google.appengine.ext.webapp import util
import pusher
try:
    import json
except ImportError:
    import simplejson as json
    
try:
  import config
except ImportError:
  raise Exception("refer to the README on creating a config.py file")

class AuthHandler(webapp.RequestHandler):
    def post(self):
    
      channel_name = self.request.get('channel_name')
      socket_id = self.request.get('socket_id')
    
      p = pusher.Pusher(app_id=config.app_id, key=config.app_key, secret=config.app_secret)
    
      auth = p[channel_name].authenticate(socket_id)
      json_data = json.dumps(auth)
    
      self.response.out.write(json_data)


def main():
    application = webapp.WSGIApplication([('/pusher/auth', AuthHandler)],
                                         debug=True)
    util.run_wsgi_app(application)


if __name__ == '__main__':
    main()
