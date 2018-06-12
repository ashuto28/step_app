<?php 
	session_start();	
	if ( $_SESSION['logged_in'] != 1 ) {
	  $_SESSION['message'] = "You must log in before viewing your profile page!";
	  header("location: ../error.php");
	}
	$languageID=$_SESSION["language"];
	
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
		<script src="js/archive.js"></script>
        <script src="js/vendor/jquery-1.12.0.min.js"></script>
        <script src="bootstrap-3.3.7/js/bootstrap.min.js" ></script>
        <script src="bootstrap-3.3.7/js/bootstrap.js" ></script>
		<link rel=stylesheet href="lib/codemirror.css">
		<script src="lib/codemirror.js"></script>
		<script src="mode/xml/xml.js"></script>
		<script src ="js/question.js"></script>
		<script src="addon/hint/show-hint.js"></script>
		<script src="mode/clike/clike.js"></script>
		<script src ="mode/python/python.js"></script>
		<script src="js/sweetalert.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
		<script src ="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script>
			var max=3;
			var question=1;
		</script>
    </head>

<body>
	<?php
	echo '<script>swal("';
	echo include"question/questionNo1.txt";
	echo'");</script>';
			
	?>
<div class="main">

<div class="row">
  <div class="col-sm-12">
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
	<li id="clockdiv" >	 
		  		<p style="color:#00aa00;margin:0px;" class="h4"><strong>Timer</strong> :
			  <span class="hours" style="color:#ffff00;font-size:large;" ></span> :
			  <span class="minutes"  style="color:#ccff00;font-size:x-large;"></span> :
			  <span class="seconds" style="color:#ff0000;font-size:xx-large;"></span>
			</p>
	</li>
		</ul>
    </div>
	  <script type="text/javascript">
		function getTimeRemaining(endtime) {
			  var t = Date.parse(endtime) - Date.parse(new Date());
			  var seconds = Math.floor((t / 1000) % 60);
			  var minutes = Math.floor((t / 1000 / 60) % 60);
			  var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
			  return {
				'total': t,
				'hours': hours,
				'minutes': minutes,
				'seconds': seconds
			  };
			}

			function initializeClock(id, endtime) {
			  var clock = document.getElementById(id);
			  
			  var hoursSpan = clock.querySelector('.hours');
			  var minutesSpan = clock.querySelector('.minutes');
			  var secondsSpan = clock.querySelector('.seconds');

			  function updateClock() {
				var t = getTimeRemaining(endtime);
				hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
				minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
				secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

				if (t.total <= 0) {
				  clearInterval(timeinterval);
					swal({
						  title: "StepApp Coding Arena",
						  text: "Thankyou for participating"
						},
						function(){
						 window.location.assign("contest.php");
						});
				}
			  }
			  updateClock();
			  var timeinterval = setInterval(updateClock, 1000);
			}
			var deadline = new Date(Date.parse(new Date()) +<?php require "timer.php"?>);
			initializeClock('clockdiv', deadline);
		  
		</script>
</nav>
</div>
</div>
<div class="row cspace ">
<div class="col-sm-12 ">
	
</div>
</div>

	<br>
	
<div class="col-xs-12 visible-xs" style = "text-align:center"><h4>Mobile and TAB view is not available for this site<br>Please come online with Desktop for better experience</h4></div>
	
	<div class="row hidden-xs">
		
  <div class="col-sm-2 " >
	  <div class="cspace">
		  </div>
  <nav class="shadow sidebar-nav navbar-inverse navbar-fixed-left nbar">
    <div class="navbar-header">
      <h1 class="navbar-brand " ><strong>QUESTIONS</strong></h1>
       <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button>
    </div>
    <div class="collapse navbar-collapse  sidebar-navbar-collapse">
    <ul class="nav navbar-nav prob">
		<li class="space"><a href="#" onclick='getQuestion("targetId" ,1)' value="1">Problem 1 <i class="fa 
			<?php 	
				if(isset($_SESSION['solved_'.'1']) && $_SESSION['solved_'.'1']===true)
				echo "fa-check";
				else
				echo "fa-angle-double-right";
			
			?>"></i></a></li>
		<li class="space" ><a href="#" onclick='getQuestion("targetId",2)' value="2">Problem 2 <i class="fa
			<?php 	
				if(isset($_SESSION['solved_'.'2']) && $_SESSION['solved_'.'2']===true)
				echo "fa-check";
				else
				echo "fa-angle-double-right";
			
			?>"></i></a></li>
		<li class="space"><a href="#" onclick='getQuestion("targetId",3)' value="3">Problem 3 <i class="fa 
			<?php 	
				if(isset($_SESSION['solved_'.'3']) && $_SESSION['solved_'.'3']===true)
				echo "fa-check";
				else
				echo "fa-angle-double-right";
			
			?>"></i></a></li>
		<li class="space"><a href="#" onclick="problem(4)" value="4">Problem 4 <i class="fa 
			<?php 	
				if(isset($_SESSION['solved_'.'4']) && $_SESSION['solved_'.'4']===true)
				echo "fa-check";
				else
				echo "fa-angle-double-right";
			
			?>"></i></a></li>
		<li class="space"><a href="#" onclick="problem(5)" value="5">Problem 5 <i class="fa 
			<?php 	
				if(isset($_SESSION['solved_'.'5']) && $_SESSION['solved_'.'5']===true)
				echo "fa-check";
				else
				echo "fa-angle-double-right";
			
			?>"></i></a></li>
		<li class="space"><a href="#" onclick="problem(6)" value="6">Problem 6 <i class="fa 
			<?php 	
				if(isset($_SESSION['solved_'.'6']) && $_SESSION['solved_'.'6']===true)
				echo "fa-check";
				else
				echo "fa-angle-double-right";
			
			?>"></i></a></li>
		
		</ul>
    </div>
	  <script>
	  		function problem(probNo){
				alert(probNo);		
			}
		  
	  
	  </script>
</nav>
</div>
		<div class="col-sm-8  " >
			<div id="problemTarget">
			<div class="col-sm-4">	<p class="h4 col-sm-4"><strong>Problem</strong><div id="questionNo" class="h4 col-sm-4" ><?php echo $_SESSION['questionNo'];?> </div></p> </div>
			<a class="btn btn-success col-sm-2" href="compiler"><i class="fa fa-code ispace"></i>Solve</a>
			<button class="btn btn-success col-sm-2 col-sm-offset-1" onclick="prevData('targetId')"><i class="fa fa-code ispace"></i>Prev</button>
			<button class="btn btn-success col-sm-2 col-sm-offset-1" onclick="getData('targetId')"><i class="fa fa-code ispace"></i>Next</button>
			<pre class="question pre col-sm-12" id="targetId" style="height:500px;background-color: #ff;"><?php include"question/questionNo".$_SESSION['questionNo'].".txt";?></pre>
		</div>
	</div>
</div>
	


</div><!--div-main-->

<div class="area">
<div class="well foot">
<div class="row area">


<div class="col-md-5 col-md-offset-1">

<b> &copy Content owned by STEPAPP CO. LTD.  </b><br>
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


