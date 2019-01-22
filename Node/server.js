//the API require the Express Module
var express = require('express');
var hostname = 'localhost'; 
var port = 3000; 
//the express application
var app = express();

//MySql connection
var mysql = require('mysql');

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
//Routing
var router = express.Router();

router.route('/api/v1/users')
.get(function(req, res){
  res.json({
    message : "Page d'acceuil de l'API",
    result: value,
    methode: req.method});
});

router.route('/articles')
.get(function(req, res) {
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
});

router.route('/category')
.get(function(req,res){
    var valueSQL = req.query.category_name;
    console.log(valueSQL);
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
          result: value,
          methode: req.method});

      });
});

app.use(router);
// Starts the server
app.listen(port, hostname, function(){
	console.log("server on http://"+ hostname +":"+port+"\n"); 
});
 