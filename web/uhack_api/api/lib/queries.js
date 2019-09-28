const mysql = require('mysql');
const dotenv = require('dotenv').config();
   ///     env = dotenv.config(),
    //    moment = require('moment'),
//	environment = env.parsed;

var con = mysql.createConnection({ 
        host: process.env.DB_HOSTNAME, 
        user:process.env.DB_USER,
        password: process.env.DB_PASS,
        database : process.env.DB_NAME,
        reconnect: true,
        connectionLimit:100
});

function reporting(report) {
        report.base_location = (report.base_location == undefined) ?'' : report.base_location;
        report.unit_location = (report.unit_location == undefined) ?'' : report.unit_location;
     // let queryString = `SELECT * FROM reportings`;
        let str = `
                INSERT INTO reportings (
                        reporting_name,
                        reporting_type,
                        reporting_reporter_id,
                        reporting_report_type,
                        reporting_report,
                        reporting_base_location,
                        reporting_unit_location,
                        reporting_status,
                        reporting_bldg_engr,
                        reporting_bldg_mngr,
                        reporting_opt_mngr
                )
                VALUES (
                        '${report.name}',
                        '${report.type}',
                        '${report.reporter_id}',
                        '${report.report_type}',
                        '${report.report}',
                        '${report.base_location}',
                        '${report.unit_location}',
                        'Active', 
                        'Pending',
                        'Pending',
                        'Pending'
                )
        `;

        

    // let query = `INSERT INTO reportings   `;
        return singleQuery(str);
}


function singleQuery(queryString) {
        return new Promise((resolve, reject) => {
                con.query(queryString, async  function (err, rows, fields)  {
                        if (err) {
                                reject( err) 
                        }
                else {
                                resolve(rows)
                        }
                        
                });

         });
      

}

module.exports = {
        reporting
}