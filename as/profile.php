<?php
/* Displays user information and some useful messages */
session_start();

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: error.php");    
}
else {
    // Makes it easier to read
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $cls_rol_num = $_SESSION['cls_rol_num'];
    $uni_rol_num = $_SESSION['uni_rol_num'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];
}

	if($active==='0'){
	header("location: profile-notverified.php");	//if account is not verified
	}
?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>SteppApp</title>
		<link href="img/favicon.ico" rel="shortcut icon">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="compiler/css/bootstrap.min.css">
        <link rel="stylesheet" href="compiler/css/font-awesome.min.css">
        <link rel="stylesheet" href="compiler/css/normalize.css">
        <link rel="stylesheet" href="compiler/css/main.css">
        <link rel="stylesheet" href="compiler/css/style.css">
        <script src="compiler/js/vendor/modernizr-2.8.3.min.js"></script>
        <script src="cpmpiler/js/vendor/jquery-1.12.0.min.js"></script>
        <script src="compiler/bootstrap-3.3.7/js/bootstrap.min.js" ></script>
        <script src="comppiler/bootstrap-3.3.7/js/bootstrap.js" ></script>
		
		<script src ="js/question.js"></script>
		<!--script src ="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script-->
		
    </head>

<body>
<div class="main">

<div class="row">
  <div class="col-md-12">
  <nav class="shadow navbar navbar-inverse navbar-fixed-top nbar">
    <div class="navbar-header">
      <a class="lspace h2">StepApp</a>
       <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button>
    </div>
    <div class="collapse navbar-collapse navbar-menubuilder">
    <ul class="nav navbar-nav">
      <li class="space"><a href="#"><i class="fa fa-bar-chart ispace"></i>Attendance</a></li>
      <li class="space"><a href="#"><i class="fa fa-graduation-cap ispace"></i>Academics</a></li>
      <li class="space"><a href="#"><i class="fa fa-cart-plus ispace"></i>Purchase</a></li>
		<li class="space"><a href="compiler/index.php"><i class="fa fa-code ispace"></i>StepApp Coding Arena</a></li>
		<li class="space"><a href="logout.php"><i class="fa fa-check ispace"></i>Log Out</a></li>
      	
    </ul>
    </div>
</nav>
</div>
</div>
<div class="row cspace ">
<div class="col-sm-12 ">
	
</div>
</div>
<div class="row cspace ">
<div class="col-sm-12 ">
	
</div>
</div>


<div class="row cspace ">
<div class="col-sm-12 hidden-xs">
</div>
</div>
	<div class="" style="text-align:center"><h4>This module is still under devlopment please contact ASHUTOSH(7081271808) for more detail</h4></div>
	<div class="" style="text-align:center"><h4>Note: You can use StepApp Coding Arena from the above navigational bar OR </h4></div>
	<div class="" style="text-align:center"><h3>Click Here</h3><a href='compiler/index.php' class='btn btn-success'>StepApp Coding Arena <i class='fa fa-code ispace'></i></a></div>

<div class="row cspace ">
<div class="col-sm-12 hidden-xs">
</div>
</div>

</div><!--div-main-->

<br><br><br>
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
