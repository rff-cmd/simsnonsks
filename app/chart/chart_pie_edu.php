<script src="../chart/js/pie.js" type="text/javascript"></script>

<?php
$data = '';
$i=0;
$sql1=mysql_query("select id, edunme from edu");
while ($row_edu=fetch_object($sql1)) {
	$sql2=mysql_query("select count(ref) jmledu from cln where eduid='$row_edu->id'");
	$row_jml=fetch_object($sql2);
	if ($row_jml->jmledu > 0) {
		$edu_count = $row_jml->jmledu;
	} else {
		$edu_count = 0;
	}
	
	if ($i==0) {
		$data = '{
					"country": "'.$row_edu->edunme.'",
					"value": '.$edu_count.'
				}';
	} else {
		$data = $data . ', {
					"country": "'.$row_edu->edunme.'",
					"value": '.$edu_count.'
				}';
	}
	
	$i++;
}
?>

<?php
echo '
<script type="text/javascript">
	var chart;
	var legend;

	var chartData = [
		'.$data.'
	];
</script> ';
?>

<script type="text/javascript">
	AmCharts.ready(function () {
		// PIE CHART
		chart = new AmCharts.AmPieChart();
		chart.dataProvider = chartData;
		chart.titleField = "country";
		chart.valueField = "value";
		chart.outlineColor = "#FFFFFF";
		chart.outlineAlpha = 0.8;
		chart.outlineThickness = 2;
		chart.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
		// this makes the chart 3D
		chart.depth3D = 15;
		chart.angle = 30;

		// WRITE
		chart.write("chartdiv");
	});
</script>

<div id="chartdiv" style="width: 100%; height: 400px;"></div>
