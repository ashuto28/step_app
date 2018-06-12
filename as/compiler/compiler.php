<?php
session_start();	
	if ( $_SESSION['logged_in'] != 1 ) {
	  $_SESSION['message'] = "You must log in before viewing your profile page!";
	  header("location: ../error.php");
	}

	$languageID=$_SESSION["language"];

	if($_SESSION['seen']===true){
		if($languageID=="java")
		$default_file="userfile/".$_SESSION['uni_rol_num']."/".$_SESSION['className'].".".$languageID;
		else
		$default_file="userfile/".$_SESSION['uni_rol_num']."/".$_SESSION['uni_rol_num'].".".$languageID;
	}
	else{
		header("location: index.php");
	}
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
		<script src ="js/custom.js"></script>
		<script src="addon/fold/brace-fold.js"></script>
		<script src="addon/fold/comment-fold.js"></script>
		<link rel="stylesheet" href="addon/display/fullscreen.css">
		<link rel="stylesheet" href="addon/hint/show-hint.css">
		<script src="addon/hint/show-hint.js"></script>
		<script src="mode/clike/clike.js"></script>
		<script src ="mode/python/python.js"></script>
		<script src="js/sweetalert.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
		<script src ="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		
		<style>
		  .CodeMirror { height: 480px; border: 3px solid #ddd; }
		  .CodeMirror-scroll { max-height: 480px ;}
		  .CodeMirror pre { padding-left: 0px; line-height: 1.25; }
		  .question { height: 480px;max-height : 480px;	border: 1px solid #ddd; }
		  /*.CodeMirror-fullscreen{margin-top:150px;margin-bottom:0px;}*/
	</style>
		<script>
			var max=3;
			var question=1;
		</script>
	
    </head>

<body >
<div class="main" >

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
<br>
<div class = "row cspace" style = "margin-left: 0px;">
	<div class="col-xs-12 visible-xs" style = "text-align:center"><h4>Mobile and TAB view is not available for this site<br>Please come online with Desktop for better experience</h4></div>
<div class = "col-md-8 col-sm-12 hidden-xs" style = "margin-left: 0px;">
<div class="form-group">
<form action="compile" name="f2" method="POST">
	<div class="col-sm-12">
	<label for="ta" class="col-sm-4 h4">Write Your Code</label>
		<div class="col-sm-8">
				<p for="language " class=" col-sm-3  h4 img-responsive" >Language</p>
				<select class=" col-sm-2 btn btn-success  " name="language" id = "modeSelect" onchange="changeEditor(this.value);getDatatextarea(this.value);">
				<option <?php if($languageID=='c') echo 'selected="selected"'; ?>value="text/x-csrc">C </option>
				<option <?php if($languageID=='cpp') echo 'selected="selected"'; ?>value="text/x-c++src">C++</option>
				<option <?php if($languageID=='java') echo 'selected="selected"'; ?> value="text/x-java">Java</option>
				<option <?php if($languageID=='py') echo 'selected="selected"'; ?> value="text/x-python">Python</option>
				</select>
				<label class="col-sm-3 "><button type="submit" class="btn btn-success" style="float:right;width:100%;">Run Code <i class="fa fa-code ispace md-hidden "></i></button></label>
				<label class=" col-sm-4"><a href="#" class="btn btn-success" value='Submit Code' onclick="submitFile()" style="float:right;width:100%;">Submit code <i class="fa fa-code ispace "></i></a></label>
		</div>
		</div>
				<textarea id="textarea" name="textarea" ><?php include $default_file; ?></textarea>
				<p>*For fullscreen mode tap on editor window and then press F11</p>
				<br>
				<br>
				<label for="in">Enter Your Input</label>
				<textarea class="form-control" name="input" rows="10" cols="50"></textarea><br><br>
				<br><br><br>
				<script id="script">
                  this.editor = CodeMirror.fromTextArea(document.getElementById("textarea"), {
                    mode: document.getElementById("modeSelect").value,
                    lineNumbers: true,
                    matchBrackets: true,
                    lineWrapping: true,
					styleActiveLine: true,
                    extraKeys: {
                      "F11": function(cm) {
                        cm.setOption("fullScreen", !cm.getOption("fullScreen"));
						if(cm.getOption("fullScreen")){
							
							cm.getWrapperElement().style.marginTop= 70 + 'px';
						}
						else
							   cm.getWrapperElement().style.margin= 0 + 'px';
						cm.refresh();
                      },
                      "Esc": function(cm) {
                        if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false);
                      },
                      "Ctrl-Q": function(cm) {
                        cm.foldCode(cm.getCursor()); 
                      }
                    },
                   foldGutter: true,
                   gutters: ["CodeMirror-linenumbers", "CodeMirror-foldgutter"]
                  });
					
				 function changeEditor(chanEditor){
						this.editor.setOption("mode", chanEditor);
					}
				function callfun( data ){
					this.editor.getDoc().setValue(data);
				}
				
				
                </script>
					
				
		</form>


</div>
</div>
<script src="addon/hint/show-hint.js"></script>

	<div class="col-sm-4 visible-md visible-lg" ><h4 class="col-sm-6">Problem</h4>
		<button class="btn btn-success col-sm-3" onclick="prevData('targetId')"><i class="fa fa-code ispace"></i>Prev</button>
		<button class="btn btn-success col-sm-3" onclick="getData('targetId')"><i class="fa fa-code ispace"></i>Next</button>
		<pre class="question pre col-sm-12" id="targetId"><?php include"question/questionNo".$_SESSION['questionNo'].".txt";?></pre>
	</div>
	</div>
</div>


<div class="well foot">
<div class="row area">

<div class="col-sm-5 col-sm-offset-1">

<b> &copy; Content owned by STEPAPP CO. LTD.  </b><br>
<b>Developed By <a target="_blank" href="https://fb.com/ashutosh.dwivedi.92102">Ashutosh Dwivedi</a></b>

</div>

<div class="col-sm-5 col-sm-offset-1 col-xs-12">
<?php

 // set default timezone
date_default_timezone_set('Asia/Calcutta'); // CDT

$current_date = date('d/m/Y == H:i:s');
echo"<b>Server Time:  $current_date</b>";

?>
</div>
</div>
</div>

</body>
</html>


