<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
<meta http-equiv="refresh" content="30">
 

<title>Using Highcharts with PHP and MySQL</title>

<script type="text/javascript" src="js/jquery-1.11.1.min.js" ></script>
<script type="text/javascript" src="js/highcharts.js" ></script>
<script type="text/javascript" src="js/themes/gray.js"></script>

<script type="text/javascript">
	var chart;
			$(document).ready(function() {
				var options = {
					chart: {
						zoomType: 'x',
						renderTo: 'container',
						defaultSeriesType: 'line',
						animation: false,
						marginRight: 130,
						marginBottom: 25
					},
					title: {
						text: 'Fermatation test',
						x: -20 //center
					},
					subtitle: {
						text: '',
						x: -20
					},
					xAxis: {
						type: 'datetime',
						tickInterval: 60 * 1000, // one hour
						minRange: 2 * 60 * 1000, // fourteen days
						tickWidth: 0,
						gridLineWidth: 1,
//						labels: 
//						{
//							align: 'center',
//							x: -3,
//							y: 20,
//							formatter: function() 
//							{
//								return Highcharts.dateFormat('%H%M', this.value);
//							}
//						}
					},

					yAxis: [{
					labels: {
                	format: '{value}°C'
            		},
						title: {
							text: 'Temperature'
						},
						plotLines: [{
							value: 0,
							width: 1,
							color: '#808080'
						}],


					},{// Secondary yAxis
            		labels: {
                	format: '{value} L'
            		},
            			title: {
                		text: 'Volume'
            		},
					opposite: true
					}],
//					tooltip: {
//						formatter: function() {
//				                return Highcharts.dateFormat('%H%M', this.x-(1000*3600)) +': <b>'+ this.y + '</b>';
//						}
//					},
					legend: {
						layout: 'vertical',
						align: 'right',
						verticalAlign: 'top',
						x: -10,
						y: 100,
						borderWidth: 0
					},
					plotOptions: {                	
                	series: {
                	shadow: false
            		},
                	line: {
                    marker: {
                        enabled: false
                    	}
                	}
            		},

        				series: [{
           				name: 'Temp1',
           				color:'#0000FF',
           				data: [],
           				tooltip: {
                		valueSuffix: ' °C'
                		}

        }]
				}
				// Load data asynchronously using jQuery. On success, add the data
				// to the options and initiate the chart.
				// This data is obtained by exporting a GA custom report to TSV.
				// http://api.jquery.com/jQuery.get/
				jQuery.get('fermdata.php', null, function(tsv) {
					var lines = [];
					temp1 = [];

					try {
						// split the data return into lines and parse them
						tsv = tsv.split(/\n/g);
						jQuery.each(tsv, function(i, line) {
							line = line.split(/\t/);
							date = Date.parse(line[0] +' UTC');
							temp1.push([date, parseFloat(line[1].replace(',', ''), 10)]);

						});
					} catch (e) {  }
					options.series[0].data = temp1;

					chart = new Highcharts.Chart(options);
				});
			});
</script>
</head>
<body>
<div id="container" style="width: 100%; height: 600px; margin: 0 auto"></div>	
</body>
</html>