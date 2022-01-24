<script src="app/chart/js/pie.js" type="text/javascript"></script>

<?php

$dbpdo = DB::create();

$data = '';
$i=0;
$sqlstr = "select distinct replid id, tingkat name from tingkat where aktif=1 order by urutan"; 
$sql1=$dbpdo->prepare($sqlstr);
$sql1->execute();
while ($row_tingkat=$sql1->fetch(PDO::FETCH_OBJ)) {
	$sqlstr2 = "select count(a.nis) count_siswa, b.idtingkat from siswa a inner join kelas b on a.idkelas=b.replid group by b.idtingkat having b.idtingkat='$row_tingkat->id'";
	$sql2=$dbpdo->prepare($sqlstr2);
	$sql2->execute();
	$row_jml=$sql2->fetch(PDO::FETCH_OBJ);	
	if ($row_jml->count_siswa > 0) {
		$korte_count = $row_jml->count_siswa;
	} else {
		$korte_count = 0;
	}
	
	if ($i==0) {
		if(empty($row_tingkat->id)) {
			$data = '{
					"country": "'.$row_tingkat->name.'",
					"value": '.$korte_count.'
				}';
		} else {
			$data = '{
					"country": "'.$row_tingkat->name.'",
					"value": '.$korte_count.'
				}';
		}
		
	} else {
		if(empty($row_tingkat->id)) {
			$data = $data . ', {
					"country": "'.$row_tingkat->name.'",
					"value": '.$korte_count.'
				}';
		} else {
			$data = $data . ', {
					"country": "'.$row_tingkat->name.'",
					"value": '.$korte_count.'
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
		chart.balloonText = "[[title]]<br><span style='font-size:10px'><b>[[value]]</b> ([[percents]]%)</span>";
		// this makes the chart 3D
		chart.depth3D = 15;
		chart.angle = 30;

		// WRITE
		chart.write("chartdiv");
	});
</script>

<div id="chartdiv" style="width: 100%; height: 550px;"></div>
