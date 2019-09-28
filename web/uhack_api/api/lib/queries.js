const mysql = require('mysql');
const dotenv = require('dotenv'),
        env = dotenv.config(),
        moment = require('moment'),
	environment = env.parsed;

var con = mysql.createConnection({
        host: environment.DB_HOSTNAME, 
        user:environment.DB_USER,
        password: environment.DB_PASS,
        database :environment.DB_NAME,
        reconnect: true,
        connectionLimit:100
});

module.exports = {

}