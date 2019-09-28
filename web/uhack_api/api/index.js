require('dotenv').config();
const express = require('express');
const app = express();
const querystring = require('querystring');
//const request = require('request-promise'),
 const	sleep = require('await-sleep'),
	request = require("request"),
	bodyParser = require('body-parser');
var queries = require('./lib/queries');

const messages = {
	NO_RECORD_FOUND : "No record found.",
	INSERT_SUCCESS : "Successfully submitted your filed report",
	UPDATE_SUCCESS : "Successfully updated the record"
}
 
app.use(bodyParser.json()); 
app.use(bodyParser.urlencoded({ extended: false })); 	
app.get('/', (req, res) => {
	res.sendStatus(200);
}); 

app.post('/report', async (req, res) => {
	await   queries.reporting(body);
	res.status(res.statusCode).send("AD");
	//res.status(error.statusCode).send(error.error.error_description);
});


app.post('/commonreport', async  (req, res) => {
	let body = '';
	let report = new Object;
	let message = new Object;
	let msg ='';
	let statusCode = 200;

	 req.on('data', chunk => {
	    body += chunk.toString();
	});

	 req.on('end', () => {
		console.log(body);
		body = JSON.parse(body);
		report =  queries.reporting(body);

	    message = {
		    message : messages.INSERT_SUCCESS,
		    status : statusCode
	    }

	    res.status(statusCode).send(message);
	});
});

app.post('/personalreport', async  (req, res) => {
	let body = '';
	
	let message = new Object;
	let msg ='';
	let statusCode = 200;

	 req.on('data', chunk => {
	    body += chunk.toString();
	});

	 req.on('end', () => {
		report = new Object;

		body = JSON.parse(body);
		report =  queries.reporting(body);

	    message = {
		    message : messages.INSERT_SUCCESS,
		    status : statusCode
	    }

	    res.status(statusCode).send(message);
	});
});


app.listen(process.env.PORT, () => {
	console.log('I am runnng now, ' + process.env.PORT );
});

	    
//	res.status(res.statusCode).send("AD");
	