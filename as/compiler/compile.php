<?php
session_start();
if ( $_SESSION['logged_in'] != 1 ) {
	  $_SESSION['message'] = "You must log in before viewing your profile page!";
	  header("location: ../error.php");    
	}
	elseif(!isset($_POST["language"])){
		$_SESSION['message'] = "Language is Not set";
	  	header("location: ../error.php"); 
	}
?>

<!DOCTYPE html>
<html>
	<head>


		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<title>Output</title>
		<link href="../img/favicon.ico" rel="shortcut icon">
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/normalize.css">
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/style.css">
		<script src="js/vendor/modernizr-2.8.3.min.js"></script>
		
	</head>
<body>
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
      <li class="space"><a href="compiler.php"><i class="fa fa-code ispace"></i>Compiler</a></li>
      <li class="space"><a href="archive.php"><i class="fa fa-archive ispace"></i>Problem Archive</a></li>
      <li class="space"><a href="contest.php"><i class="fa fa-cogs ispace"></i>Contests</a></li>
		<li class="space"><a href="../profile.php"><i class="fa fa-home ispace"></i>Home</a></li>
		<li class="space"><a href="../logout.php"><i class="fa fa-check ispace"></i>Log Out</a></li>
    </ul>
   <div id="clockdiv">	 
		  		<p style="color:#00aa00;margin:0px;" class="h4"><strong>Timer</strong> :
			  <span class="hours" style="color:#ffff00;font-size:large;" ></span> :
			  <span class="minutes"  style="color:#ccff00;font-size:x-large;"></span> :
			  <span class="seconds" style="color:#ff0000;font-size:xx-large;"></span>
			</p>
	</div>
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


<div class="row log">
<div class="col-sm-6">
<div class=""><h3 style="text-align:center;">Your Output</h3></div>
</div>
<div class="col-sm-6">
<div class=""><h3 style="text-align:center;">Expected Output</h3></div>
</div>
</div>
<div class="row ">
<div class="col-sm-6">

<?php
	
	//if($_FILES["file"]["name"]!="")
	{
		//include "compilers/make.php";
	}
	//else
	{
		switch($_SESSION['language'])
			{
				case "c":
				{
					include("compilers/c.php");
					break;
				}
				case "cpp":
				{
					include("compilers/cpp.php");
					break;
				}

				case "java":
				{	
					include("compilers/java.php");
					break;
				}
				case "py":
				{
					include("compilers/python32.php");
					break;
				}
			}
	}
?>

</div>
<div class="col-sm-6">

<?php
	echo '<pre  class="form-control pre" name="output" style="height: 250px;">'.file_get_contents("sampleSolution/sampleSolution_".$_SESSION['questionNo'].".txt").'</pre>';
?>
<a href="compiler"><p class="btn btn-success col-sm-4 col-sm-offset-4">Back</p></a>
</div>
</div>

</div><br><br><br>

<div class="area">
<div class="well foot">
<div class="row area">
<div class="col-sm-3">
</div>

<div class="col-sm-5">


<div class="fm">

<b> &copy Content owned by STEPAPP CO. LTD.  </b><br>
<b>Developed By <a href="https://fb.com/ashutosh.dwivedi.92102">Ashutosh Dwivedi</a></b>

</div>
</div>


<div class="col-sm-4">

</div>
</div>
</div>
</div>

</body>
</html>
