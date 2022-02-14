var nvd3Charts = function() {

    var myColors = ["#33414E","#8DCA35","#00BFDD","#FF702A","#DA3610",
        "#80CDC2","#A6D969","#D9EF8B","#FFFF99","#F7EC37","#F46D43",
        "#E08215","#D73026","#A12235","#8C510A","#14514B","#4D9220",
        "#542688", "#4575B4", "#74ACD1", "#B8E1DE", "#FEE0B6","#FDB863",
        "#C51B7D","#DE77AE","#EDD3F2"];
    d3.scale.myColors = function() {
        return d3.scale.ordinal().range(myColors);
    };
        
	var startChart1 = function() {
		/*These lines are all chart setup.  Pick and choose which chart features you want to utilize. */
		nv.addGraph(function() {
			var chart = nv.models.lineChart().margin({
				left : 100
			})//Adjust chart margins to give the x-axis some breathing room.
			.useInteractiveGuideline(true)//We want nice looking tooltips and a guideline!
			.transitionDuration(350)//how fast do you want the lines to transition?
			.showLegend(true)//Show the legend, allowing users to turn on/off line series.
			.showYAxis(true)//Show the y-axis
			.showXAxis(true)//Show the x-axis
			.color(d3.scale.myColors().range());;

			chart.xAxis//Chart x-axis settings
			.axisLabel('Time (ms)').tickFormat(d3.format(',r'));

			chart.yAxis//Chart y-axis settings
			.axisLabel('Voltage (v)').tickFormat(d3.format('.02f'));

			/* Done setting the chart up? Time to render it!*/
			var myData = sinAndCos();
			//You need data...

			d3.select('#chart-1 svg')//Select the <svg> element you want to render the chart in.
			.datum(myData)//Populate the <svg> element with chart data...
			.call(chart);
			//Finally, render the chart!

			//Update the chart when window resizes.
			nv.utils.windowResize(function() {
                alert('1');
                chart.update();
			});
			return chart;
		});
		/**************************************
		 * Simple test data generator
		 */
		function sinAndCos() {
			var sin = [], sin2 = [], cos = [];

			//Data is represented as an array of {x,y} pairs.
			for (var i = 0; i < 100; i++) {
				sin.push({
					x : i,
					y : Math.sin(i / 10)
				});
				sin2.push({
					x : i,
					y : Math.sin(i / 10) * 0.25 + 0.5
				});
				cos.push({
					x : i,
					y : .5 * Math.cos(i / 10)
				});
			}

			//Line chart data should be sent as an array of series objects.
			return [{
				values : sin, //values - represents the array of {x,y} data points
				key : 'Sine Wave' //key  - the name of the series.
			}, {
				values : cos,
				key : 'Cosine Wave'
			}, {
				values : sin2,
				key : 'Another sine wave'
			}];
		}

	};

	return {		
		init : function() {
			startChart1();
		}
	};
}();

nvd3Charts.init();