import sys
import json
import logging
import webapp2
import urllib
from google.appengine.api import urlfetch
from google.appengine.ext.webapp.mail_handlers import InboundMailHandler
from google.appengine.api import mail 

reload(sys)
sys.setdefaultencoding("utf-8")
class LogSenderHandler(InboundMailHandler):
    def receive(self, mail_message):
        decoded_html = ""
        tobesent = mail_message.subject
        logging.info("From: " + mail_message.sender)
        logging.info("To:" + mail_message.to)
        logging.info("Subject: " + mail_message.subject)
        logging.info("Date: " + mail_message.date)
	logging.info( mail_message.bodies('text/plain'))
        html_bodies= mail_message.bodies('text/plain')
        for content_type,body in html_bodies:
            decoded_html=body.decode()
            logging.info(decoded_html)
        datafields = {
            "to":mail_message.to,
            "from":mail_message.sender,
            "subject":mail_message.subject,
            "date":mail_message.date,
            "body":decoded_html}
        datafields=urllib.urlencode(datafields)
        logging.info(datafields)        
        result=urlfetch.fetch(url="https://mailing-bindasrishant-1.c9.io/rest/receiveMail",payload=datafields,method=urlfetch.POST)
        attrs=vars(result)
        print ','.join("%s: %s" % item for item in attrs.items())
app = webapp2.WSGIApplication([LogSenderHandler.mapping()], debug=True)
