# Experimental example of connecting to Pusher from Adobe Air

Initial investigation suggests that:

* External files can't be loaded from within an Air application so all files have to be stored locally
* In order to use WebSockets [web-socket-js](https://github.com/gimite/web-socket-js) has to be included on it's own first - also from a local directory