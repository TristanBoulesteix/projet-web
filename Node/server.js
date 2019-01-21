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
  con.connect(function(err) {
    if (err) throw err;
    console.log("Connected!");
  });

myRouter.route('/')
.all(function(req,res){
      res.json({message : "Vous êtes sur le server Web Services Express du site internet du BDE ", methode : req.method});
});

myRouter.route('/articles')
// GET
.all(function(req,res){
    var sql = "CALL productPerCategory()";
    //Promise to give enought to the SQL requets befor sending datas
    const promise1 = new Promise((resolve, reject) => {
            con.query(sql, function (err, result, fields) {
              if (err) return reject(err);
              resolve(result);
            });
      });

      //Send the JSON when the promise is resolved
      promise1.then((value) =>{
          res.json({
          message : "Voici les produits de la boutique :",
          result: value,
          methode: req.method});

      });
});

myRouter.route('/category')
// GET
.all(function(req,res){
    var sql = "";
    //Promise to give enought to the SQL requets befor sending datas
    const promise1 = new Promise((resolve, reject) => {
            con.query(sql, function (err, result, fields) {
              if (err) return reject(err);
              resolve(result);
            });
      });

      //Send the JSON when the promise is resolved
      promise1.then((value) =>{
          res.json({
          message : "Voici les produits de la boutique :",
          result: value,
          methode: req.method});

      });
});

// Nous demandons à l'application d'utiliser notre routeur
app.use(myRouter);


// Starts the server
app.listen(port, hostname, function(){
	console.log("Server on http://"+ hostname +":"+port+"\n");
});