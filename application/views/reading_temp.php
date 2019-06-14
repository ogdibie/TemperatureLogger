<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<script src="<?php echo base_url(); ?>application/third_party/canvasjs.min.js">	
	</script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
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
	<h2><?php echo $title;	?></h2>
	<?php echo form_open('temperature/get_temp'); ?>
            <div class="row">
                <div class='col-md-6'>
                    <div class="form-group">
                        <label class="control-label">From</label>
                        <div class='input-group date' id='datetimepicker1'>
                            <input type='text' name="ftime" class="form-control" />
                            <span class="input-group-addon">
                     <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>

		
                <div class='col-md-6'>
                    <div class="form-group">
                        <label class="control-label">To</label>
                        <div class='input-group date' id='datetimepicker2'>
                            <input type='text' name="ttime" class="form-control" />
                            <span class="input-group-addon">
                     <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <input type="submit" name="submit_temp_range" class="btn btn-primary" value="Update Graph">	
	</form>

<?php
$dataPoints = array(
	array("y" => 25, "label" => "Sunday"),
	array("y" => 15, "label" => "Monday"),
	array("y" => 25, "label" => "Tuesday"),
	array("y" => 5, "label" => "Wednesday"),
	array("y" => 10, "label" => "Thursday"),
	array("y" => 0, "label" => "Friday"),
	array("y" => 20, "label" => "Saturday")
);

$dp = $temp;
?>
	<h1>Temperature Readings</h1>
	<div id="body">
<script>
  $(function () {
    	$('#datetimepicker1').datetimepicker({
		format: 'YYYY-MM-DD HH:mm:ss'
	});	
    	$('#datetimepicker2').datetimepicker({	
		format: 'YYYY-MM-DD HH:mm:ss'
	});
 });
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	title: {
		text: "Temperature Reading"
	},
	axisY: {
		title: "Temperature (celcius)"
	},
	axisX:{
		title: "Time (date/time of reading)"
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($dp, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
	
	<div id="chartContainer" style="height: 370px; width: 100%;"></div>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

</body>
</html>
