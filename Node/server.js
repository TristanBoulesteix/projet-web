//the API require the Express Module
const express = require('express');
const hostname = 'localhost';
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
          database : 'projet-web',
          timeout: 100000
      });
      con.connect(function(err) {
        if (err) throw err;
        console.log("Connected to the first db!");
      });

//2nd connexion to the database
const con2 = mysql.createConnection({
          host     : 'localhost',
          user     : 'root',
          password: "",
          database : 'projet-web-user',
          timeout: 100000
        });
        con2.connect(function(err) {
        if (err) throw err;
        console.log("Connected to the secund db!");
        });

//Avoid "No 'Access-Control-Allow-Origin' header is present on the requested resource." issues
  app.use(function(req, res, next) {
    res.header("Access-Control-Allow-Origin", "*");
     res.header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
     next();
  });

  // the payload for the token
  const payload ={
    "sub": "CesiBdeLyon",
    "name": "BDECesi",
    "iat": 5516239022// expire on 20 oct 2144.
  };
  // token's secret
  const secret = "S3cr3t@1sK33p_doesitneedtobelong?";
  // full token
  var token = "";

  /**
   * 
   * @param {*} bde the data recieved in the get query
   * @param {*} cesi the data recieved in the get query
   * @param {*} res the response to the get query
   * @param {*} resolve the resolv of the promise
   * create a crypted token
   */
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

//Routing
const router = express.Router();

// route /api/v1/users
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

//route /users
router.route('/users')
.get(function(req, res) {
  var validateToken = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJDZXNpQmRlTHlvbiIsIm5hbWUiOiJCREVDZXNpIiwiaWF0Ijo1NTE2MjM5MDIyfQ.4IcckP3DD8atyhP3ClieEVbzRDk0YqGVqsj3dFNuYq4";
  if (req.query.token == validateToken) {
      const sql = "CALL allUsers()";
      con2.query(sql, function (error, results, fields) {
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
      //Send the JSON when user not allowed to have datas
      res.json({
        "response": "you are not allowed to have datas.",
      });
    }
});

//route userschange
router.route('/userschange')
.post(function(req, res) {
  var validateToken = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJDZXNpQmRlTHlvbiIsIm5hbWUiOiJCREVDZXNpIiwiaWF0Ijo1NTE2MjM5MDIyfQ.4IcckP3DD8atyhP3ClieEVbzRDk0YqGVqsj3dFNuYq4";
  if (req.query.token == validateToken) {
      const sql = "CALL changeUser( "+req.query.id_user+", "+req.query.selection+" )";
      con2.query(sql, function (error, results, fields) {
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
      //Send the JSON when user not allowed to have datas
      res.json({
        "response": "you are not allowed to have datas.",
      });
    }
});

// route articles
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
      //Send the JSON when user not allowed to have datas
      res.json({
        "response": "you are not allowed to have datas.",
      });
    }
});

// route category
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
      //Send the JSON when user not allowed to have datas
      res.json({
        "response": "you are not allowed to have datas.",
      });
    }
});

// route ideas
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
      //Send the JSON when user not allowed to have datas
      res.json({
        "response": "you are not allowed to have datas.",
      });
    }
});

// route events
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
      //Send the JSON when user not allowed to have datas
      res.json({
        "response": "you are not allowed to have datas.",
      });
    }
});

// route events/past
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
      //Send the JSON when user not allowed to have datas
      res.json({
        "response": "you are not allowed to have datas.",
      });
    }
});

// route gallery
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
      //Send the JSON when user not allowed to have datas
      res.json({
        "response": "you are not allowed to have datas.",
      });
    }
});

// routes comment
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
      //Send the JSON when user not allowed to have datas
      res.json({
        "response": "you are not allowed to have datas.",
      });
    }
});

// route like/event
router.route('/like/event')
.post(function(req, res) {
  var validateToken = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJDZXNpQmRlTHlvbiIsIm5hbWUiOiJCREVDZXNpIiwiaWF0Ijo1NTE2MjM5MDIyfQ.4IcckP3DD8atyhP3ClieEVbzRDk0YqGVqsj3dFNuYq4";
  if (req.query.token == validateToken) {
      const sql = "CALL addLike("+req.query.id_image+")";
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
              "response": "done"
            });
        }
      });
    }
    else{
      //Send the JSON when user not allowed to have datas
      res.json({
        "response": "you are not allowed to have datas.",
      });
    }
});

// route like/idea
router.route('/like/idea')
.post(function(req, res) {
  var validateToken = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJDZXNpQmRlTHlvbiIsIm5hbWUiOiJCREVDZXNpIiwiaWF0Ijo1NTE2MjM5MDIyfQ.4IcckP3DD8atyhP3ClieEVbzRDk0YqGVqsj3dFNuYq4";
  if (req.query.token == validateToken) {
      const sql = "CALL addLikeIdea("+req.query.id_idea+")";
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
              "response": "done!"
            });
        }
      });
    }
    else{
      //Send the JSON when user not allowed to have datas
      res.json({
        "response": "you are not allowed to have datas.",
      });
    }
});

// make the server use teh router
app.use(router);
// Starts the server
app.listen(port, hostname, function(){
	console.log("server on http://"+ hostname +":"+port+"\n"); 
});