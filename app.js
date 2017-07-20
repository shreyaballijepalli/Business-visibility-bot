#!/usr/bin/env
'use strict';

require('dotenv').config({silent: true});

var express = require('express');
var path = require('path');
var cookieParser = require('cookie-parser');
var bodyParser = require('body-parser');
var expressValidator = require('express-validator');
var flash = require('connect-flash');
var session = require('express-session');
var Conversation = require('watson-developer-cloud/conversation/v1'); // watson sdk
var mysql = require('mysql');

var handlebars = require('express-handlebars').create({defaultLayout:'home'});

var routes = require('./routes/homepage');
var users = require('./routes/users');

//Init app
var app = express();


//view engine

app.set('views', path.join(__dirname,'views'));    //want a folder views to handle our views
app.engine('handlebars',handlebars.engine);
app.set('view engine','handlebars');               //set view engine to handlebars  

//body parser middleware
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({extended: false }));
app.use(cookieParser());

//set public folder images,css,jquery files


app.use(express.static(path.join(__dirname, 'public')));

app.use(session({
    secret: 'secret',
    saveUninitialized:true,
    resave: true
}));


//express validator
app.use(expressValidator({
  errorFormatter: function(param, msg, value) {
      var namespace = param.split('.')
      , root    = namespace.shift()
      , formParam = root;

    while(namespace.length) {
      formParam += '[' + namespace.shift() + ']';
    }
    return {
      param : formParam,
      msg   : msg,
      value : value
    };
  }
}));


//connect flash

app.use(flash());
app.use(require('connect-flash')());


app.use(function(req,res,next) {
res.locals.success_msg = req.flash('success_msg');
res.locals.error_msg = req.flash('error_msg');
res.locals.error = req.flash('error');
res.locals.user = req.flash('logged_msg');
next();

});


app.use('/',routes);
app.use('/users',users);


var conversation = new Conversation({
  version_date: Conversation.VERSION_DATE_2017_04_21
});


 var con = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "Shreya@98",
  database: "USERS"
});

  con.connect(function(err) {
  if (err) throw err;
  console.log("Connected!");

});




app.post('/my-url', function(req, res) {
  console.log('Success');
  var input = String(req.body.id);
  var flag=0;
  con.query("SELECT * FROM sql_customers", function (err, result, fields) {
    if (err) throw err;

    for(var i=0;i<result.length;i++)
{
    if(result[i].Question==input)
 {
     flag=1;
     break;
 }

}  

  var number = 0;
  
  if(result.length!=0)
  number= result[result.length-1].id;

  var post  = {id:number+1 , Question : input};

  if(flag==0 && (typeof input != 'undefined') )
{
  var query = con.query('INSERT INTO sql_customers SET ?', post, function(err, result1) {
  console.log("Inserted");

});

}
  

if(result.length>100)
{
   var sql = "DELETE FROM sql_customers ORDER BY id LIMIT 1";
    con.query(sql, function (err, result2) {
    if (err) throw err;
    console.log("Number of records deleted: " + result2.affectedRows);
  });

}

    
}); 
 

});


app.post('/api/message', function(req, res) {
  var workspace = process.env.WORKSPACE_ID || '<workspace-id>';
  if (!workspace || workspace === '<workspace-id>') {
    return res.json({
      'output': {
        'text': 'The app has not been configured with a <b>WORKSPACE_ID</b> environment variable. Please refer to the ' + '<a href="https://github.com/watson-developer-cloud/conversation-simple">README</a> documentation on how to set this variable. <br>' + 'Once a workspace has been defined the intents may be imported from ' + '<a href="https://github.com/watson-developer-cloud/conversation-simple/blob/master/training/car_workspace.json">here</a> in order to get a working application.'
      }
    });
  }

var flag=0;

var req_input = req.body.input;

for(var key in req_input) {
var input = req_input[key];

}


 con.query("SELECT * FROM sql_customers", function (err, result, fields) {
    if (err) throw err;
  //  result = JSON.parse(result);
   // console.log(result.length);
    for(var i=0;i<result.length;i++)
{
    if(result[i].Question==input)
 {
     flag=1;
     break;
 }

}  


  var number = 0;

  if(result.length!=0)
  number= result[result.length-1].id;

  var post  = {id:number+1 , Question:input};

  if(flag==0 && (typeof input != 'undefined'))
{
  var query = con.query('INSERT INTO sql_customers SET ?', post, function(err, result1) {
  console.log("Inserted");

});

}
 
if(result.length>100)
{
   var sql = "DELETE FROM sql_customers ORDER BY id LIMIT 1";
    con.query(sql, function (err, result2) {
    if (err) throw err;
    console.log("Number of records deleted: " + result2.affectedRows);
  });

}
 

    
});


  var payload = {
    workspace_id: workspace,
    context: req.body.context || {},
    input: req.body.input || {}
  };



  // Send the input to the conversation service
  conversation.message(payload, function(err, data) {
    if (err) {
      return res.status(err.code || 500).json(err);
    }
    return res.json(updateMessage(payload, data));
  });
});


function updateMessage(input, response) {
  var responseText = null;
  if (!response.output) {
    response.output = {};
  } else {
    return response;
  }
  if (response.intents && response.intents[0]) {
    var intent = response.intents[0];
    if (intent.confidence >= 0.75) {
      responseText = 'I understood your intent was ' + intent.intent;
    } else if (intent.confidence >= 0.5) {
      responseText = 'I think your intent was ' + intent.intent;
    } else {
      responseText = 'I did not understand your intent';
    }
  }
  response.output.text = responseText;
  return response;
}




app.set('port',(process.env.PORT || 3000));

app.listen(app.get('port'),function(){

console.log("listening to port 3000");

});

module.exports = app;
