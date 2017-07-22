'use strict';
var express = require('express');
var router = express.Router();
var app = express();
var path = require('path');
var mysql = require('mysql');
var bluepages = require('bluepages');


var Conversation = require('watson-developer-cloud/conversation/v1');

 var con = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "USERS"
});



var conversation = new Conversation({
  version_date: Conversation.VERSION_DATE_2017_04_21
});




//login


router.get('/login',function(req,res){

res.render('login');

});




router.get('/logout',function(req,res){

  req.flash('success_msg','You are logged out');
  res.setHeader("Cache-Control","no-cache");
  res.setHeader("Cache-Control","no-store"); //Directs caches not to store the page under any circumstance
  res.setHeader("Pragma","no-cache"); //HTTP 1.0 backward compatibility
  res.redirect('/');

});


router.post('/login',function(req,res){

var intranetId = req.body.uid; // email
var password = req.body.password;

bluepages.authenticate(intranetId,password,function(err,verified){
	if(err) console.log(err);
	else {
		if(verified) 
{
			console.log('Success');
                        req.flash('logged_msg','You are logged in');
                        res.redirect('/users/conversation');

}
		else 
{
			console.log('Invalid Credentials');

}


}

});



});





router.get('/conversation',function(req,res){

 con.query('SELECT * FROM sql_customers', function(err, conversation, fields) {
        
       if (err) throw err; 
       var arr = conversation.slice(conversation.length-10,conversation.length);
       res.render('index',{conversation:arr});
     

    });


});

module.exports=router;


