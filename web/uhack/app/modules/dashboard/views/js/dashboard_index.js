
$(document).ready(function() {
        var d = new Date();
        var month = ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sept", "Oct", "Nov", "Dec"];
        var day =  values.filter( function(values) {
		return values.day == 28
        });

        var year =  values.filter( function(values) {
		return values.year == d.getFullYear()
        });

        var mon =   values.filter( function(values) {
                console.log(d.getMonth(), month[d.getMonth()])
		return values.m == d.getMonth()  +1
        });

        function gr (values, status) {
                return values.filter( function(values) {
                        return (values.reporting_bldg_engr == status)
                });
        }

        function gr2 (values, status) {
                return values.filter( function(values) {
                        return (values.reporting_bldg_mngr == status)
                });
        }

        function gr3 (values, status) {
                return values.filter( function(values) {
                        return (values.reporting_opt_mngr == status)
                });
        }

        var chart = new CanvasJS.Chart("chartContainer", {
                theme: "light1", // "light1", "light2", "dark1", "dark2"
                exportEnabled: true,
                animationEnabled: true,
                title: {
                        text: "Building Engineer Assets Status for" + month[d.getMonth()]
                },
                data: [{
                        type: "pie",
                        startAngle: 25,
                        toolTipContent: "<b>{label}</b>: {y}%",
                        showInLegend: "true",
                        legendText: "{label}",
                        indexLabelFontSize: 16,
                        indexLabel: "{label} - {y}%",
                        dataPoints: [
                                { y: gr( values, 'Approved' ).length, label: "Approved" },
                                { y: gr( values, 'Pending' ).length, label: "Pending" },
                                { y: gr( values, 'Denied' ).length, label: "Denied" }
                        ]
                }]
        });

        var chart2 = new CanvasJS.Chart("chartContainer2", {
                theme: "light1", // "light1", "light2", "dark1", "dark2"
                exportEnabled: true,
                animationEnabled: true,
                title: {
                        text: "Building Manager Assets Status for" + month[d.getMonth()]
                },
                data: [{
                        type: "pie",
                        startAngle: 25,
                        toolTipContent: "<b>{label}</b>: {y}%",
                        showInLegend: "true",
                        legendText: "{label}",
                        indexLabelFontSize: 16,
                        indexLabel: "{label} - {y}%",
                        dataPoints: [
                                { y: gr2( values, 'Approved' ).length, label: "Approved" },
                                { y: gr2( values, 'Pending' ).length, label: "Pending" },
                                { y: gr2( values, 'Denied' ).length, label: "Denied" }
                        ]
                }]
        });

        var chart3 = new CanvasJS.Chart("chartContainer3", {
                theme: "light1", // "light1", "light2", "dark1", "dark2"
                exportEnabled: true,
                animationEnabled: true,
                title: {
                        text: "Building Manager Assets Status for" + month[d.getMonth()]
                },
                data: [{
                        type: "pie",
                        startAngle: 25,
                        toolTipContent: "<b>{label}</b>: {y}%",
                        showInLegend: "true",
                        legendText: "{label}",
                        indexLabelFontSize: 16,
                        indexLabel: "{label} - {y}%",
                        dataPoints: [
                                { y: gr3( values, 'Approved' ).length, label: "Approved" },
                                { y: gr3( values, 'Pending' ).length, label: "Pending" },
                                { y: gr3(values, 'Denied' ).length, label: "Denied" }
                        ]
                }]
        });
        chart.render();
        chart2.render();
        chart3.render();
});