<?php
//this module will set the time limit to the compiler.php and compile.php script

//first part consists of fixed time to be set by admin and secend part consists of server time
$start_time=10*60*60+5*60+0;
$duration=(23*60*60+60*60)*1000;			//seting duration of the test
$current_time = (date('H')*60*60+date('i')*60+date('s'));
$time =($current_time - $start_time)*1000; //times are converted to miliseconds so that it can be use to add with date.parse in javascript
$remaining_time = $duration-$time;
if($remaining_time>$duration )	//condition if user access the code arena before 
	$remaining_time=0;
elseif($remaining_time<0)		//condition if time is up for the test
	$remaining_time=0;
echo $remaining_time;
?>