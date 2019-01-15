var http = require('http');
var url = require('url');

var server = http.createServer((req, res) =>{
    var page = url.parse(req.url).pathname;
    console.log(page);
    res.writeHead(200, {"Content-Type": "text/plain"});

    if (page == '/') {
        res.write('Voici la premiere page du serveur Node.js.');
    }
    else if (page == '/page2') {
        res.write('Vous etes sur la deuxieme page du serveur Node.js .');
    }
    else if (page == '/page3') {
        res.write('Vous etes sur la 3eme page.');
    } else res.write('Voici la premiere page du serveur Node.js. Il en existe 2 autres.');
    res.end();
});
server.listen(8080);