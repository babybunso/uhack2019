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
		
	//	console.log(report.length , report.affectedRows, report )
		/* if ( report.length == 0 || typeof report.length == 'undefined' ) {
			msg = messages.NO_RECORD_FOUND;
			statusCode = 400;
		} else {
			msg = messages.INSERT_SUCCESS;
		}  */

	    message = {
		    message : messages.INSERT_SUCCESS,
		    error_code : statusCode
	    }

	    res.status(statusCode).send(message);
	});
});



app.listen(process.env.PORT, () => {
	console.log('I am runnng now, ' + process.env.PORT );
});

	    
//	res.status(res.statusCode).send("AD");
	