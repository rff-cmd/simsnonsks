<script src="../chart/js/serial.js" type="text/javascript"></script>


<?php
$data = '';
$i=0;
$sql1=mysql_query("select id, edunme from edu order by edunme");
while ($row_edu=fetch_object($sql1)) {
	$sql2=mysql_query("select count(ref) jmledu from cln where eduid='$row_edu->id'");
	$row_jml=fetch_object($sql2);
	if ($row_jml->jmledu > 0) {
		$edu_count = $row_jml->jmledu;
	} else {
		$edu_count = 0;
	}
	
	switch ($i) {
		case 0:
			$color = "#FF0F00";
			break;
		
		case 1:
			$color = "#FF6600";
			break;
		
		case 2:
			$color = "#FF9E01";
			break;
		
		case 3:
			$color = "#FCD202";
			break;
		
		case 4:
			$color = "#F8FF01";
			break;
		
		case 5:
			$color = "#B0DE09";
			break;
		
		case 6:
			$color = "#04D215";
			break;
		
		case 7:
			$color = "#0D8ECF";
			break;
		
		case 8:
			$color = "#0D52D1";
			break;
		
		case 9:
			$color = "#2A0CD0";
			break;
		
		case 10:
			$color = "#8A0CCF";
			break;
		
		case 11:
			$color = "#CD0D74";
			break;
		
		case 12:
			$color = "#754DEB";
			break;
		
		case 13:
			$color = "#DDDDDD";
			break;
		
		case 14:
			$color = "#999999";
			break;
		
		case 15:
			$color = "#333333";
			break;
		
		case 16:
			$color = "#333333";
			break;
		
		default:
			$color = "#000000";
	}
	
	if ($i==0) {
		$data = '{
                    "country2": "'.$row_edu->edunme.'",
                    "visits2": '.$edu_count.',
                    "color": "'.$color.'"
                }';
	} else {
		$data = $data . ', {
                    "country2": "'.$row_edu->edunme.'",
                    "visits2": '.$edu_count.',
                    "color": "'.$color.'"
                }';
	}
	
	$i++;
}
?>

<?php
echo '
<script type="text/javascript">
	var chart;

	var chartData2 = [
		'.$data.'
	];
</script> ';
?>

<script type="text/javascript">
	AmCharts.ready(function () {
		// SERIAL CHART
		chart = new AmCharts.AmSerialChart();
		chart.dataProvider = chartData2;
		chart.categoryField = "country2";
		// the following two lines makes chart 3D
		chart.depth3D = 20;
		chart.angle = 30;

		// AXES
		// category
		var categoryAxis = chart.categoryAxis;
		categoryAxis.labelRotation = 90;
		categoryAxis.dashLength = 5;
		categoryAxis.gridPosition = "start";

		// value
		var valueAxis = new AmCharts.ValueAxis();
		valueAxis.title = "Jumlah";
		valueAxis.dashLength = 5;
		chart.addValueAxis(valueAxis);

		// GRAPH            
		var graph = new AmCharts.AmGraph();
		graph.valueField = "visits2";
		graph.colorField = "color";
		graph.balloonText = "<span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>";
		graph.type = "column";
		graph.lineAlpha = 0;
		graph.fillAlphas = 1;
		chart.addGraph(graph);
		
		// CURSOR
		var chartCursor = new AmCharts.ChartCursor();
		chartCursor.cursorAlpha = 0;
		chartCursor.zoomable = false;
		chartCursor.categoryBalloonEnabled = false;
		chart.addChartCursor(chartCursor);                

		// WRITE
		chart.write("chartdiv2");
	});
</script>

<div id="chartdiv2" style="width: 100%; height: 400px;"></div>
