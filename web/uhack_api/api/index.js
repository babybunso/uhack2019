require('dotenv').config();
const express = require('express');
const app = express();
const crypto = require('crypto');
const querystring = require('querystring');
const request = require('request-promise');
const bodyParser = require('body-parser');
const queries = require('./lib/queries');
//var path = require('path');
 
app.use(bodyParser.json()); 
app.use(bodyParser.urlencoded({ extended: false })); 	
/* app.use(function(req, res, next) {
	var data = '';
	req.setEncoding('utf8');
	req.on('data', function(chunk) { 
	    data += chunk;
	});
	req.on('end', function() {
	    req.rawBody = data;
	    console.log(req.url)
	    console.log('...' + data);
	    
//	    console.log(req.rawBody)
	});
	next();
    }); */
 
app.get('/', (req, res) => {
	res.sendStatus(200);
});

app.listen(process.env.PORT, () => {
	console.log('I am runnng now, ' + process.env.PORT );
});

app.post('/report', (req, res) => {
	res.status(res.statusCode).send("AD");
	//res.status(error.statusCode).send(error.error.error_description);
});


app.post('/commonreport', (req, res) => {
	let body = '';

	req.on('data', chunk => {
	    body += chunk.toString();
	});

	req.on('end', () => {
 	    console.log(body)
	    res.status(res.statusCode).send(body);
	});
    
});

	


app.post('/report2', (req, res) => {

	collectRequestData(req, result => {
		console.log(result);
		res.end(`Parsed data belonging to ${result.fname}`);
	    });
});
	    
//	res.status(res.statusCode).send("AD");
	