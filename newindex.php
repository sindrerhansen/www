<!DOCTYPE html>
<head>
  <script src="js/jquery-1.10.2.min.js"></script>
  <script src="js/highcharts.js" type="text/javascript"></script>
  <script>
  var chart;
  $(document).ready(function() {
     var options = {
        chart: {
           renderTo: 'container',
           type: 'line',
        },
        title: {
        },
        xAxis: {
           type: 'datetime'
        },
        yAxis: {
        },
        series: [{
           name: 'val1',
           data: []
       }, {
           name: 'val2',
           data: []
        }]
     };
     $.getJSON('data_jason.php', function(json) {
        val1 = [];
        val2 = [];
        $.each(json, function(key,value) {
        val1.push([value.date_enterd, value.Temp1]);
        val2.push([value.date_enterd, value.Temp2]);
        });

        options.series[0].data = Temp1;
        options.series[1].data = Temp1;
        chart = new Highcharts.Chart(options);
     });
  });
  </script>
</head>
<html>