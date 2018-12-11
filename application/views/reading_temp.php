<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<script type= "text/javascript" src="./application/third_party/package/dist/Chart.bundle.js">	
	</script>

	
	<script type= "text/javascript" src="./application/third_party/package/dist/Chart.min.js">	
	</script>

	<title>Temperature Reading</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}
	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>

	
</head>
<body>

<div id="container">
	<h1>Temperature Readings</h1>
	<div id="body">
<canvas id="myChart" width="400" height="400"></canvas>
<script>
//perform some sort of ajax call
var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
     type: 'line',
     // The data for our dataset
     data: {
     labels: ["January", "February", "March", "April", "May", "June", "July"],

     datasets: [{
     label: "My First dataset",
     backgroundColor: 'rgb(255, 99, 132)',
     borderColor: 'rgb(255, 99, 132)',
	data: [0, 10, 5, 2, 20, 30, 45], 
"fill":false }]
      },

                                                                                             // Configuration options go here
       options: {}
     });
</script>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

</body>
</html>
