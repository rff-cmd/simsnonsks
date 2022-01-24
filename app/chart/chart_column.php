<script src="app/chart/js/serial.js" type="text/javascript"></script>


<?php

$dbpdo = DB::create();

$data = '';
$i=0;
//$sqlstr = "select * from tingkat where aktif=1"; 
$sqlstr = "select distinct replid id, tingkat name from tingkat where aktif=1 order by replid";
$sql1 = $dbpdo->query($sqlstr);
while ($row_tingkat=$sql1->fetch(PDO::FETCH_OBJ)) {
	$sqlstr2 = "select count(a.nis) count_siswa, b.idtingkat from siswa a inner join kelas b on a.idkelas=b.replid where ifnull(a.alumni,0)=0 group by b.idtingkat having b.idtingkat='$row_tingkat->id'";
	$sql2=$dbpdo->prepare($sqlstr2);
	$sql2->execute();
	$row_jml=$sql2->fetch(PDO::FETCH_OBJ);
	if ($row_jml->count_siswa > 0) {
		$korte_count = $row_jml->count_siswa;
	} else {
		$korte_count = 0;
	}
	
	switch ($i) {
		case 0:
			$color = "#FF0F00";
			break;
		
		case 1:
			$color = "#04D215";
			break;
		
		case 2:
			$color = "#0D8ECF";
			break;
		
		case 3:
			$color = "#FCD202";
			break;
		
		case 4:
			$color = "#F8FF01";
			break;
		
		case 5:
			$color = "#FF6600";
			break;
		
		case 6:
			$color = "#B0DE09";
			break;
		
		case 7:
			$color = "#FF9E01";
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
			$color = "#FF0F00";
			break;
		
		case 16:
			$color = "#04D215";
			break;
		
		case 17:
			$color = "#0D8ECF";
			break;
		
		case 18:
			$color = "#FCD202";
			break;
		
		case 19:
			$color = "#F8FF01";
			break;
		
		case 20:
			$color = "#FF6600";
			break;
		
		case 21:
			$color = "#B0DE09";
			break;
		
		case 22:
			$color = "#FF9E01";
			break;
		
		case 23:
			$color = "#0D52D1";
			break;
		
		case 24:
			$color = "#2A0CD0";
			break;
		
		case 25:
			$color = "#8A0CCF";
			break;
			
		case 26:
			$color = "#0D8ECF";
			break;
		
		default:
			$color = "#000000";
	}
	
	if ($i==0) {
		if(empty($row_tingkat->id)) {
			$data = '{
                    "country2": "'.$row_tingkat->name.'",
                    "visits2": '.$korte_count.',
                    "color": "'.$color.'"
                }';
		} else {
			$data = '{
                    "country2": "'.$row_tingkat->name.'",
                    "visits2": '.$korte_count.',
                    "color": "'.$color.'"
                }';
		}
	} else {
		if(empty($row_tingkat->id)) {
			$data = $data . ', {
                    "country2": "'.$row_tingkat->name.'",
                    "visits2": '.$korte_count.',
                    "color": "'.$color.'"
                }';
		} else {
			$data = $data . ', {
                    "country2": "'.$row_tingkat->name.'",
                    "visits2": '.$korte_count.',
                    "color": "'.$color.'"
                }';
		}
		
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
		valueAxis.title = "Jumlah Siswa per Tingkat";
		valueAxis.dashLength = 5;
		chart.addValueAxis(valueAxis);

		// GRAPH            
		var graph = new AmCharts.AmGraph();
		graph.valueField = "visits2";
		graph.colorField = "color";
		graph.balloonText = "<span style='font-size:10px'>[[category]]: <b>[[value]]</b></span>";
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

<div id="chartdiv2" style="width: 100%; height: 300px;"></div>
