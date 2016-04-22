var MailParser = require("mailparser").MailParser;
var mailparser = new MailParser();

var mysql = require("mysql");

var express = require('express');
var router = express.Router();

mailparser.on("end", function(mail_object){
    
    console.log("From:", mail_object.from); //[{address:'sender@example.com',name:'Sender Name'}]
    console.log("Subject:", mail_object.subject); // Hello world!
    console.log("Text body:", mail_object.text); // How are you today?
});

// send the email source to the parser


/* GET home page. */
router.all('/', function(req, res, next) {
var bodyText =  req.body["data"];
//console.log(bodyText);
mailparser.write(bodyText);

mailparser.end();    
res.send("OK");
//res.render('index', { title: 'Express' });
});

module.exports = router;
