//the API require the Express Module
const express = require('express');
const hostname = '10.169.128.55';
const port = 3000;
//the express application
const app = express();

const jwt = require('jsonwebtoken');

//MySql connection
const mysql = require('mysql');

//connexion to the database
const con = mysql.createConnection({
          host     : 'localhost',
          user     : 'root',
          password: "",
          database : 'projet-web'
      });
      con.connect(function(err) {
        if (err) throw err;
        console.log("Connected!");
      });

//Avoid "No 'Access-Control-Allow-Origin' header is present on the requested resource." issues
  app.use(function(req, res, next) {
    res.header("Access-Control-Allow-Origin", "*");
     res.header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
     next();
  });

  const payload ={
    "sub": "CesiBdeLyon",
    "name": "BDECesi",
    "iat": 5516239022// expire on 20 oct 2144.
  };
  const secret = "S3cr3t@1sK33p_doesitneedtobelong?";
  var token = "";

  function makeTheToken(bde, cesi, res, resolve) {
    // signature algorithm
    if(bde == "bde" && cesi == "lyon"){
      jwt.sign(payload, secret, { algorithm: 'HS256'}, function(err, token) {
        if(err){
          console.log('Error occurred while generating token');
          console.log(err);
          resolve(token);
          return false;
          }
        else{
          if(token != false){
            resolve(token);
          }
            else{
              res.send("Could not create token");
              res.end();
            }
        }
      });
    }
    else{
      res.send("not a user");
    }
  };
   //token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJDZXNpQmRlTHlvbiIsIm5hbWUiOiJCREVDZXNpIiwiaWF0Ijo1NTE2MjM5MDIyfQ.4IcckP3DD8atyhP3ClieEVbzRDk0YqGVqsj3dFNuYq4

//Routing
const router = express.Router();

router.route('/api/v1/users')
.get(function(req, res){
    const promise = new Promise((resolve, reject) => {
      makeTheToken(req.query.bde, req.query.cesi, res, resolve)
    });
  //Send the JSON when the promise is resolved
    promise.then((value) =>{
      res.json({
        message : "Token",
        result: value,
        methode: req.method
      });
    });
});

router.route('/articles')
.get(function(req, res) {
  var validateToken = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJDZXNpQmRlTHlvbiIsIm5hbWUiOiJCREVDZXNpIiwiaWF0Ijo1NTE2MjM5MDIyfQ.4IcckP3DD8atyhP3ClieEVbzRDk0YqGVqsj3dFNuYq4";
  if (req.query.token == validateToken) {
      const sql = "CALL productPerCategory()";
      con.query(sql, function (error, results, fields) {
        if(error){//If there is error, we send the error in the error section with 500 status
            res.json({"status": 500,
            "error": error,
            "response": null
          });
        } else {
          res.json({//If there is no error, all is good and response is 200OK.
              "status": 200,
              "error": null,
              "response": results
            });
        }
      });
    }
    else{
      res.json({
        "response": "you are not allowed to have datas.",
      });
    }
});

router.route('/category')
.get(function(req,res){

  var validateToken = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJDZXNpQmRlTHlvbiIsIm5hbWUiOiJCREVDZXNpIiwiaWF0Ijo1NTE2MjM5MDIyfQ.4IcckP3DD8atyhP3ClieEVbzRDk0YqGVqsj3dFNuYq4";
  if (req.query.token == validateToken) {
    if(req.query.category_name == "all"){
      var valueSQL = req.query.category_name;
      var sql = 'CALL productPerCategory()';
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
            response: value,
            methode: req.method});

        });
    }
    else{
      var valueSQL = req.query.category_name;
      var sql = 'CALL categoryPerProducts("'+valueSQL+'")';
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
            response: value,
            methode: req.method});

        });
      }
    }
    else{
      res.json({
        "response": "you are not allowed to have datas.",
      });
    }
});


router.route('/ideas')
.get(function(req, res) {
  var validateToken = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJDZXNpQmRlTHlvbiIsIm5hbWUiOiJCREVDZXNpIiwiaWF0Ijo1NTE2MjM5MDIyfQ.4IcckP3DD8atyhP3ClieEVbzRDk0YqGVqsj3dFNuYq4";
  if (req.query.token == validateToken) {
      const sql = "CALL ideas";
      con.query(sql, function (error, results, fields) {
        if(error){//If there is error, we send the error in the error section with 500 status
            res.json({"status": 500,
            "error": error,
            "response": null
          });
        } else {
          res.json({//If there is no error, all is good and response is 200OK.
              "status": 200,
              "error": null,
              "response": results
            });
        }
      });
    }
    else{
      res.json({
        "response": "you are not allowed to have datas.",
      });
    }
});

router.route('/events')
.get(function(req, res) {
  var validateToken = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJDZXNpQmRlTHlvbiIsIm5hbWUiOiJCREVDZXNpIiwiaWF0Ijo1NTE2MjM5MDIyfQ.4IcckP3DD8atyhP3ClieEVbzRDk0YqGVqsj3dFNuYq4";
  if (req.query.token == validateToken) {
      const sql = "CALL recentEvent";
      con.query(sql, function (error, results, fields) {
        if(error){//If there is error, we send the error in the error section with 500 status
            res.json({"status": 500,
            "error": error,
            "response": null
          });
        } else {
          res.json({//If there is no error, all is good and response is 200OK.
              "status": 200,
              "error": null,
              "response": results
            });
        }
      });
    }
    else{
      res.json({
        "response": "you are not allowed to have datas.",
      });
    }
});

router.route('/events/past')
.get(function(req, res) {
  var validateToken = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJDZXNpQmRlTHlvbiIsIm5hbWUiOiJCREVDZXNpIiwiaWF0Ijo1NTE2MjM5MDIyfQ.4IcckP3DD8atyhP3ClieEVbzRDk0YqGVqsj3dFNuYq4";
  if (req.query.token == validateToken) {
      const sql = "CALL oldEvent";
      con.query(sql, function (error, results, fields) {
        if(error){//If there is error, we send the error in the error section with 500 status
            res.json({"status": 500,
            "error": error,
            "response": null
          });
        } else {
          res.json({//If there is no error, all is good and response is 200OK.
              "status": 200,
              "error": null,
              "response": results
            });
        }
      });
    }
    else{
      res.json({
        "response": "you are not allowed to have datas.",
      });
    }
});

router.route('/gallery')
.get(function(req, res) {
  var validateToken = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJDZXNpQmRlTHlvbiIsIm5hbWUiOiJCREVDZXNpIiwiaWF0Ijo1NTE2MjM5MDIyfQ.4IcckP3DD8atyhP3ClieEVbzRDk0YqGVqsj3dFNuYq4";
  if (req.query.token == validateToken) {
      const sql = "CALL imagePerEvent("+req.query.event+")";
      con.query(sql, function (error, results, fields) {
        if(error){//If there is error, we send the error in the error section with 500 status
            res.json({"status": 500,
            "error": error,
            "response": null
          });
        } else {
          res.json({//If there is no error, all is good and response is 200OK.
              "status": 200,
              "error": null,
              "response": results
            });
        }
      });
    }
    else{
      res.json({
        "response": "you are not allowed to have datas.",
      });
    }
});

router.route('/comment')
.get(function(req, res) {
  var validateToken = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJDZXNpQmRlTHlvbiIsIm5hbWUiOiJCREVDZXNpIiwiaWF0Ijo1NTE2MjM5MDIyfQ.4IcckP3DD8atyhP3ClieEVbzRDk0YqGVqsj3dFNuYq4";
  if (req.query.token == validateToken) {
      const sql = "CALL commentPerImage("+req.query.image+")";
      con.query(sql, function (error, results, fields) {
        if(error){//If there is error, we send the error in the error section with 500 status
            res.json({"status": 500,
            "error": error,
            "response": null
          });
        } else {
          res.json({//If there is no error, all is good and response is 200OK.
              "status": 200,
              "error": null,
              "response": results
            });
        }
      });
    }
    else{
      res.json({
        "response": "you are not allowed to have datas.",
      });
    }
});


app.use(router);
// Starts the server
app.listen(port, hostname, function(){
	console.log("server on http://"+ hostname +":"+port+"\n"); 
});