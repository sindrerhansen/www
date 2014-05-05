<!DOCTYPE HTML>
        <?php
            //the usual stuff 
            $con = mysql_connect("localhost","root","Kaffe123");
            if (!$con) {   die('Could not connect: ' . mysql_error()); }
            mysql_select_db("temperaturlogg", $con);

            $sql = mysql_query('SELECT * FROM tempdata');

            $data = array();
            $data2 = array();
            
            while ($row = mysql_fetch_array($sql)) {
               
        extract($row);
        $datetime1 = date('Y, n, j', strtotime($date_entered)); //converts date from 2012-01-10 (mysql date format) to the format Highcharts understands 2012, 1, 10
        $datetime2 = 'Date.UTC('.$datetime1.')'; //getting the date into the required format for pushing the Data into the Series
        $datetime3 = $date_entered * 1000;
        // we are getting 2 fields
        $data[] = "[$datetime3, $temp1]";
        $data2[] = "[$datetime3, $temp2]";
  
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
                            type: 'spline',
                        },
                        title: {
                            text: 'Øl bryggings temperature',
                            x: -20 //center
                        },
                        subtitle: {
                            text: 'Source: Arduino',
                            x: -20
                        },
                        xAxis: {
                            type: 'datetime',
                            dateTimeLabelFormats: { 
                                minute: '%H:%M',
                                hour: '%H:%M', 
                            }
                        },
                        
                        yAxis: {
                            title: {
                                text: 'Temperature (C)'
                            },
                            min: 0
                        },
                        tooltip: {
                            formatter: function() {
                                    return '<b>'+ this.series.name +'</b><br/>'+
                                    Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) +': '+ this.y;
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
                            name: 'Temp1',
                            data: [<?php echo join($data, ',') ?>]

                        },
                        {
                            name: 'Temp2',
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