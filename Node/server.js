//the API require the Express Module
var express = require('express');

//Variables to set the Express Server
var express = require('express');
var hostname = 'localhost';
var port = 3000;

//the express application
var app = express();
// Express router
var myRouter = express.Router();

//Init of the body-Parser
var bodyParser = require("body-parser"); 
app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());

//MySql connection
var mysql = require('mysql');
//connexion to the database
var con = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "projet-web"
  });
  

myRouter.route('/')
.all(function(req,res){
      res.json({message : "Vous êtes sur le server Web Services Express du site internet du BDE ", methode : req.method});
});

myRouter.route('/events')
// GET
.get(function(req,res){
    var participate = 22;
    var reslt;
    var sql = "SELECT name FROM `campus` WHERE id = 1";

  /*  var promise = new Promise(function(res, rej){
        con.connect(function(err) {
            if (err) throw err;
            con.query(sql, function (err, result, fields) {
              if (err) throw err;
              reslt = result[0].name;
              console.log(reslt);
            });
          });
        res(reslt);
    });*/
    var promise1 = new Promise(function(resolve, reject) {
        setTimeout(function() { 
        con.connect(function(err) {
            if (err) throw err;
            con.query(sql, function (err, result, fields) {
              if (err) throw err;
              reslt = result[0].name;
              console.log(reslt);
            });
          });
          resolve(reslt);
        }, 1000);

      });
      
      promise1.then(function(value) {
        res.json({
        message : "route get :",
        name: req.query.name,
        date: req.query.date,
        campus : value,
        participants: participate,
        methode: req.method});
      });
    
    /*promise.then(function(){
      res.json({
      message : "route get :",
      name: req.query.name,
      date: req.query.date,
      campus : reslt,
      participants: participate,
      methode: req.method});
    });*/
})
//POST
.post(function(req,res){
      res.json({message : "route post",
      name: req.query.name,
      date: req.query.date,
      participants: '12',
      methode : req.method});
})
//PUT
.put(function(req,res){
      res.json({message : "route put",
      name: req.query.name,
      date: req.query.date,
      methode : req.method});
})
//DELETE
.delete(function(req,res){
res.json({message : "route delete",
      name: req.query.name,
      date: req.query.date,
      methode : req.method});
});

// Nous demandons à l'application d'utiliser notre routeur
app.use(myRouter);


// Starts the server
app.listen(port, hostname, function(){
	console.log("Server on http://"+ hostname +":"+port+"\n");
});