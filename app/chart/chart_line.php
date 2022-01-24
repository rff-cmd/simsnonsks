<script src="chart/js/serial.js" type="text/javascript"></script>

<script type="text/javascript">
	var chart;
	var graph;

	var chartData3 = [
		{
			"year": "1986",
			"value": 2016
		},
		{
			"year": "1987",
			"value": 7011
		},
		{
			"year": "1988",
			"value": 16068
		},
		{
			"year": "1989",
			"value": 1919
		},
		{
			"year": "1990",
			"value": 19056
		},
		{
			"year": "1991",
			"value": 14077
		},
		{
			"year": "1992",
			"value": 20213
		},
		{
			"year": "1993",
			"value": 1717
		},
		{
			"year": "1994",
			"value": 8254
		},
		{
			"year": "1995",
			"value": 20019
		},
		{
			"year": "1996",
			"value": 11063
		},
		{
			"year": "1997",
			"value": 2905
		},
		{
			"year": "1998",
			"value": 3307
		},
		{
			"year": "1999",
			"value": 2168
		},
		{
			"year": "2000",
			"value": 4073
		},
		{
			"year": "2001",
			"value": 2027
		},
		{
			"year": "2002",
			"value": 4251
		},
		{
			"year": "2003",
			"value": 7281
		},
		{
			"year": "2004",
			"value": 6348
		},
		{
			"year": "2005",
			"value": 3074
		},
		{
			"year": "2006",
			"value": 6011
		},
		{
			"year": "2007",
			"value": 10074
		},
		{
			"year": "2008",
			"value": 9124
		},
		{
			"year": "2009",
			"value": 2024
		},
		{
			"year": "2010",
			"value": 8022
		},
		{
			"year": "2011",
			"value": 0
		},
		{
			"year": "2012",
			"value": 7296
		},
		{
			"year": "2013",
			"value": 12217
		},
		{
			"year": "2014",
			"value": 15147
		}
	];


	AmCharts.ready(function () {
		// SERIAL CHART
		chart = new AmCharts.AmSerialChart();
		chart.pathToImages = "chart/images/";
		chart.dataProvider = chartData3;
		chart.marginLeft = 10;
		chart.categoryField = "year";
		chart.dataDateFormat = "YYYY";

		// listen for "dataUpdated" event (fired when chart is inited) and call zoomChart method when it happens
		chart.addListener("dataUpdated", zoomChart);

		// AXES
		// category
		var categoryAxis = chart.categoryAxis;
		categoryAxis.parseDates = true; // as our data is date-based, we set parseDates to true
		categoryAxis.minPeriod = "YYYY"; // our data is yearly, so we set minPeriod to YYYY
		categoryAxis.dashLength = 3;
		categoryAxis.minorGridEnabled = true;
		categoryAxis.minorGridAlpha = 0.1;

		// value
		var valueAxis = new AmCharts.ValueAxis();
		valueAxis.axisAlpha = 0;
		valueAxis.inside = true;
		valueAxis.dashLength = 3;
		chart.addValueAxis(valueAxis);

		// GRAPH                
		graph = new AmCharts.AmGraph();
		graph.type = "smoothedLine"; // this line makes the graph smoothed line.
		graph.lineColor = "#d1655d";
		graph.negativeLineColor = "#637bb6"; // this line makes the graph to change color when it drops below 0
		graph.bullet = "round";
		graph.bulletSize = 8;
		graph.bulletBorderColor = "#FFFFFF";
		graph.bulletBorderAlpha = 1;
		graph.bulletBorderThickness = 2;
		graph.lineThickness = 2;
		graph.valueField = "value";
		graph.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value]]</span></b>";
		chart.addGraph(graph);

		// CURSOR
		var chartCursor = new AmCharts.ChartCursor();
		chartCursor.cursorAlpha = 0;
		chartCursor.cursorPosition = "mouse";
		chartCursor.categoryBalloonDateFormat = "YYYY";
		chart.addChartCursor(chartCursor);

		// SCROLLBAR
		var chartScrollbar = new AmCharts.ChartScrollbar();
		chart.addChartScrollbar(chartScrollbar);

		// WRITE
		chart.write("chartdiv3");
	});

	// this method is called when chart is first inited as we listen for "dataUpdated" event
	function zoomChart() {
		// different zoom methods can be used - zoomToIndexes, zoomToDates, zoomToCategoryValues
		chart.zoomToDates(new Date(1995, 0), new Date(2016, 0));
	}
</script>
<div id="chartdiv3" style="width:100%; height:400px;"></div>
