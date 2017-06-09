var express = require('express');
var router = express.Router();

//get homepage / represents homepage

router.get('/',function(req,res){
res.render('homepage');

});

module.exports = router;

