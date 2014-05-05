<!DOCTYPE HTML>
        <?php
            //the usual stuff 
            $con = mysql_connect("localhost","root","");
            if (!$con) {   die('Could not connect: ' . mysql_error()); }
            mysql_select_db("charts", $con);

            $sql = mysql_query('SELECT * FROM table1');

            $data = array();
            $data2 = array();
            
            while ($row = mysql_fetch_array($sql)) {
               
        extract($row);
        $datetime1 = date('Y, n, j', strtotime($datetime)); //converts date from 2012-01-10 (mysql date format) to the format Highcharts understands 2012, 1, 10
        $datetime2 = 'Date.UTC('.$datetime1.')'; //getting the date into the required format for pushing the Data into the Series

        // we are getting 2 fields
        $data[] = "[$datetime2, $field1]";
        $data2[] = "[$datetime2, $field2]";
  
            }
            mysql_close($con);
        ?>

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script type="text/javascript">
            $(function () {
                var chart;
                $(document).ready(function() {
                    chart = new Highcharts.Chart({
                        chart: {
                            renderTo: 'container',
                            type: 'line',
                            marginRight: 130,
                            marginBottom: 25
                        },
                        title: {
                            text: 'Monthly Average Temperature',
                            x: -20 //center
                        },
                        subtitle: {
                            text: 'Source: WorldClimate.com',
                            x: -20
                        },
                        xAxis: {
                            type: 'datetime',
                            dateTimeLabelFormats: { 
                                day: '%e of %b'    
                            }
                        },
                        
                        yAxis: {
                            title: {
                                text: 'Snow depth (m)'
                            },
                            min: 0
                        },
                        tooltip: {
                            formatter: function() {
                                    return '<b>'+ this.series.name +'</b><br/>'+
                                    Highcharts.dateFormat('%e. %b', this.x) +': '+ this.y;
                            }
                        },
                        legend: {
                            layout: 'vertical',
                            align: 'right',
                            verticalAlign: 'top',
                            x: -10,
                            y: 100,
                            borderWidth: 0
                        },
                        series: [{
                            name: 'Field1',
                            data: [<?php echo join($data, ',') ?>]
                            /*[
                                    [Date.UTC(2012,  01, 10), 1  ],
                                    [Date.UTC(2012,  01, 11), 2  ],
                                    [Date.UTC(2012,  01, 12), 3  ],
                                    [Date.UTC(2012,  01, 13), 7  ]
                                 ]
*/
                        },
                        {
                            name: 'Field2',
                            data: [<?php echo join($data2, ',') ?>]
                                                        
                        }]

                    });
                });
                
            });

            </script>
    </head>
    <body>
<script src="js/highcharts.js"></script>
<script src="js/exporting.js"></script>

<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>

    </body>
</html>