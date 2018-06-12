<?php
require "../db.php";
session_start();
$result = $mysqli->query("SELECT * FROM public");

$chart_data = '';
while($row = $result->fetch_array())
{
 $chart_data .= "{ question:'Problem ".$row["question"]."', attempted:".$row["attempted"].", solved:".$row["solved"]."}, ";
}
$chart_data = substr($chart_data, 0, -2);

?>

<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>SteppApp coding Arena</title>
		<link href="../img/favicon.ico" rel="shortcut icon">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/style.css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
        <script src="js/vendor/jquery-1.12.0.min.js"></script>
        <script src="bootstrap-3.3.7/js/bootstrap.min.js" ></script>
        <script src="bootstrap-3.3.7/js/bootstrap.js" ></script>
		<link rel=stylesheet href="lib/codemirror.css">
		<script src="lib/codemirror.js"></script>
		<script src="mode/xml/xml.js"></script>
		<link rel="stylesheet" href="addon/fold/foldgutter.css" />
		<script src="addon/edit/matchbrackets.js"></script>
		<script src="addon/display/fullscreen.js"></script>
		<script src="addon/fold/foldcode.js"></script>
		<script src="addon/fold/foldgutter.js"></script>
		<script src ="js/question.js"></script>
		<script src="addon/fold/brace-fold.js"></script>
		<script src="addon/fold/comment-fold.js"></script>
		<link rel="stylesheet" href="addon/display/fullscreen.css">
		<link rel="stylesheet" href="addon/hint/show-hint.css">
		<script src="addon/hint/show-hint.js"></script>
		<script src="mode/clike/clike.js"></script>
		<script src ="mode/python/python.js"></script>
		<!--script src ="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script-->
		<link rel="stylesheet" href="graph/morris.css">
		<script src="graph/jquery.min.js"></script>
		<script src="graph/raphael-min.js"></script>
		<script src="graph/morris.min.js"></script>
    </head>

<body>
<div class="main">

<div class="row">
  <div class="col-md-12">
  <nav class="shadow navbar navbar-inverse navbar-fixed-top nbar">
    <div class="navbar-header">
      <a class="navbar-brand lspace" href="../profile.php">StepApp Coding arena</a>
       <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button>
    </div>
    <div class="collapse navbar-collapse navbar-menubuilder">
    <ul class="nav navbar-nav">
      <li class="space"><a href="compiler"><i class="fa fa-code ispace"></i>Compiler</a></li>
      <li class="space"><a href="arc"><i class="fa fa-archive ispace"></i>Problem Archive</a></li>
      <li class="space"><a href="cont"><i class="fa fa-cogs ispace"></i>Contests</a></li>
		<li class="space"><a href="../profile.php"><i class="fa fa-home ispace"></i>Home</a></li>
		<li class="space"><a href="../logout.php"><i class="fa fa-check ispace"></i>Log Out</a></li>
      	<table>
		   <tr>
			  <td>Current time :</td>
			  <td id="Hour" style="color:green;font-size:large;"></td>
			  <td id="Minut" style="color:green;font-size:x-large;"></td>
			  <td id="Second" style="color:red;font-size:xx-large;"></td>
		  <tr>
		</table>
    </ul>
    </div>

 
	  <script type="text/javascript">
		 function timedMsg()
		  {
			var t=setInterval("change_time();",1000);
		  }
		 function change_time()
		 {
		   var d = new Date();
			
			 var curr_hour = d.getHours();
		   var curr_min = d.getMinutes();
		   var curr_sec = d.getSeconds();
		   if(curr_hour > 12)
			 curr_hour = curr_hour - 12;
		   document.getElementById('Hour').innerHTML =curr_hour+':';
			document.getElementById('Minut').innerHTML=curr_min+':';
			document.getElementById('Second').innerHTML=curr_sec;
		 }
		timedMsg();   
		</script>
</nav>
</div>
</div>
<div class="row cspace ">
<div class="col-sm-12 ">
	
</div>
</div>

	<br><br>
		<div class="container-fluid">
				<div class="row">
				<div class="col-sm-6">
				<h3 style="text-align:center"><strong><u>Score Card</u></strong></h3><br>
					<table class="table table-bordered  ">
						
						<tr>
							<th>Question Number</th>
							<th>Max Marks</th>
							<th>Your Score</th>
							<th>Language</th>
						</tr>
						<?php
						require "../db.php";						
						$result = $mysqli->query('SELECT * FROM score WHERE userId='.$_SESSION['uni_rol_num'].' ORDER BY question');

							$score_data = '';
							$ScoreSum=0;
							$MaxSum=0;
							while($row = $result->fetch_array())
							{
							   echo 
								   '<tr>
								   		<td>
											'.$row['question'].'
										</td>
										<td>
											'.$row['max_score'].'
										</td>
										<td>
											'.$row['scored'].'
										</td>
										<td>
											'.$row['language'].'
								   </tr>';
									$MaxSum+=$row['max_score'];
									$ScoreSum+=$row['scored'];
							}
							?>
						<tr>
							<td>Total</td>
							<td><?php echo $MaxSum; ?></td>
							<td><?php echo $ScoreSum;?></td>
							<td>###</td>
						</tr>
					</table>
				</div>
				
				<div class="col-sm-6">
					<h3 style="text-align:center"><strong><u>Public Response</u></strong></h3>
					<div class="col-sm-6 col-sm-offset-0"><br><h3 class="cspace">Language used</h3></div>
					<div id="div" style="height: 200px;" class="col-sm-6"></div>
				
				   <div id="question" style="height: 300px;" class="col-sm-10 col-sm-offset-2"></div>
					
				</div>			
			</div>
			</div>
		<script>
			new Morris.Bar({
				  
					element: 'question',
					data: [<?php echo $chart_data;?>],
				  	xkey: 'question',
				  	ykeys: ['attempted','solved'],
					ymax: 700,
					xLabelAngle: 45,
				  	labels: ['Attempted','Solved'],
					barColors: ['#5b50b0','#ffaa00','#000']
				
				});
		
				new Morris.Donut({
				 	element: 'div',
				  	data: [
						{label: "java", value: 150},
						{label: "c++", value: 200},
						{label: "python", value: 100},
						{label: "c", value: 400}
				  	]
				});

		</script>



</div><!--div-main-->
<div class="row cspace ">
<div class="col-sm-12 ">
	
</div>
</div>

<br>
<div class="area">
<div class="well foot">
<div class="row area">


<div class="col-md-5 col-md-offset-1">

<b> &copy; Content owned by STEPAPP CO. LTD.  </b><br>
<b>Developed By <a target='_BLANK' href="https://fb.com/ashutosh.dwivedi.92102">Ashutosh Dwivedi</a></b>

</div>

<div class="col-md-5 col-md-offset-1 col-xs-12">
<?php

 // set default timezone
date_default_timezone_set('Asia/Calcutta'); // CDT

$current_date = date('d/m/Y == H:i:s');
echo"<b>Server Time:  $current_date</b>";

?>
</div>
</div>
</div>
</div>
</body>
</html>


