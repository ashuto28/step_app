<html>
	<head>
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
		</head>
	<body>
		<div id="question" style="height: 250px; width:500px;"></div>
		<div id="score" style="height: 250px; width:500px;"></div>
		<script>
			new Morris.Line({
				  // ID of the element in which to draw the chart.
				  element: 'question',
				  // Chart data records -- each entry in this array corresponds to a point on
				  // the chart.
				  data: [
					{ question: '1', attempted: 50 ,solved: 34},
					{ question: '2', attempted: 56 ,solved: 20},
					{ question: '3', attempted: 20 ,solved: 17},
					{ question: '4', attempted: 5 ,solved: 2},
					{ question: '5', attempted: 58 ,solved: 19},
					{ question: '6', attempted: 11 ,solved: 7}
				  ],
				  // The name of the data record attribute that contains x-values.
				  xkey: 'question',
				  // A list of names of data record attributes that contain y-values.
				  ykeys: ['attempted','solved'],
				  // Labels for the ykeys -- will be displayed when you hover over the
				  // chart.
				  labels: ["question",'attempted','solved'],
				
					barColors: ['#7b70b1','#0077dd','#aaa'],
				});
			new Morris.Bar({
				  // ID of the element in which to draw the chart.
				  element: 'score',
				  // Chart data records -- each entry in this array corresponds to a point on
				  // the chart.
				  data: [
					{ question: '1', attempted: 50 ,solved: 34},
					{ question: '2', attempted: 56 ,solved: 20},
					{ question: '3', attempted: 20 ,solved: 17},
					{ question: '4', attempted: 5 ,solved: 2},
					{ question: '5', attempted: 58 ,solved: 19},
					{ question: '6', attempted: 11 ,solved: 7}
				  ],
				  // The name of the data record attribute that contains x-values.
				  xkey: 'question',
				  // A list of names of data record attributes that contain y-values.
				  ykeys: ['attempted','solved'],
				  // Labels for the ykeys -- will be displayed when you hover over the
				  // chart.
				  labels: ['attempted','solved'],
				
					barColors: ['#7b70b1','#0077dd','#aaa'],
				});
		
		
		</script>
		</body>
	<html>
