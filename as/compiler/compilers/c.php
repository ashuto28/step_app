<?php
	$userDir=$userId=$_SESSION['uni_rol_num'];
	$CC="gcc";
	$out="timeout 2s userfile/".$userDir."/./".$userId;
	$code=$_POST["textarea"];
	$input=$_POST["input"];
	$filename_code="userfile/".$userDir."/".$userId.".c";
	$filename_in="userfile/".$userDir."/".$userId.".txt";
	$filename_error="userfile/".$userDir."/".$userId."error.txt";
	$executable="userfile/".$userDir."/".$userId;
	$command=$CC." ".$filename_code." -o userfile/".$userDir."/".$userId;
	$command_error=$command." 2>".$filename_error;
	$sample_in="sampleInput/sampleInput_".$_SESSION['questionNo'].".txt";
	$filename_out="userfile/".$userDir."/".$userId."output".".txt";
	$check=0;
	$pass=0;
	$solution="sampleSolution/sampleSolution_".$_SESSION['questionNo'].".txt";
	$run_time_error=0;
	if(trim($code)=="")
	die("The code area is empty");
	exec('chmod 600 '."userfile/".$userDir."/*");
	$file_code=fopen($filename_code,"w+");
	fwrite($file_code,$code);
	fclose($file_code);
	$file_in=fopen($filename_in,"w+");
	fwrite($file_in,$input);
	fclose($file_in);
	exec('chmod 400 '."userfile/".$userDir."/*");
	shell_exec($command_error);
	$error=file_get_contents($filename_error);
	$executionStartTime = microtime(true);
	if(trim($error)=="")
	{
		if(trim($input)=="")
		{
			$process = proc_open($out,
				array(
					0 => array("file",$sample_in,"r"), //stdin
					1 => array("file",$filename_out,"w"),  //stdout
					2 => array("pipe", "w")   // stderr
				),  $pipes);
					$runtime_error=stream_get_contents($pipes[2]);
					fclose($pipes[2]);
					$output=file_get_contents($filename_out);
					proc_close($process);
					if($runtime_error!=null){
						$output=$runtime_error;
					}
					$hash1=md5_file($solution);
					$hash2=md5_file($filename_out);
					if($hash1===$hash2)
						$pass=1;
		}
		else
		{
			$process = proc_open($out,
				array(
					0 => array("file",$filename_in,"r"), //stdin
					1 => array("pipe", "w"),  //stdout
					2 => array("pipe", "w")   // stderr
				),  $pipes);
					$runtime_error=stream_get_contents($pipes[2]);
					fclose($pipes[2]);
					$output=stream_get_contents($pipes[1]);
					fclose($pipes[1]);
					proc_close($process);
					if($runtime_error!=null){
						$output=$runtime_error;
					}
		}
	}
	else if(strpos($error,"error")===false)
	{
		echo "<pre>$error</pre>";
		if(trim($input)=="")
		{
			$process = proc_open($out,
				array(
					0 => array("file",$sample_in,"r"), //stdin
					1 => array("file",$filename_out,"w"),  //stdout
					2 => array("pipe", "w")   // stderr
				),  $pipes);
					$runtime_error=stream_get_contents($pipes[2]);
					fclose($pipes[2]);
					$output=stream_get_contents($pipes[1]);
					fclose($pipes[1]);
					proc_close($process);
					if($runtime_error!=null){
						$output=$runtime_error;
					}
					$hash1=md5_file($solution);
					$hash2=md5_file($filename_out);
					if($hash1===$hash2)
						$pass=1;
		}
		
		else
		{
			$process = proc_open($out,
				array(
					0 => array("file",$filename_in,"r"), //stdin
					1 => array("pipe", "w"),  //stdout
					2 => array("pipe", "w")   // stderr
				),  $pipes);
					$runtime_error=stream_get_contents($pipes[2]);
					fclose($pipes[2]);
					$output=stream_get_contents($pipes[1]);
					fclose($pipes[1]);
					proc_close($process);
					if($runtime_error!=null){
						$output=$runtime_error;
					}
		}
	}
	else
	{
		$output=$error;
		$check=1;
	}
	$executionEndTime = microtime(true);
	$seconds = $executionEndTime - $executionStartTime;
	$seconds = sprintf('%0.3f', $seconds);
	echo '<pre  class="form-control pre" name="output" style="height: 250px;">'.$output.'</pre>';
	echo "<pre>Compiled And Executed In: $seconds s</pre>";
	if($check==1)
	{
		echo "<pre>Verdict : CE</pre>";
	}
	else if(trim($runtime_error)!=""){
		echo "<pre>Verdict : RE</pre>";
	}
	else if($check==0 && $seconds>=2)
	{
		echo "<pre>Verdict : TLE</pre>";
	}
	else if(trim($output)=="")
	{
		echo "<pre>Verdict : WA</pre>";
	}
	else if($check==0)
	{
		echo "<pre>Verdict : AC</pre>";
		if($pass==1)
		echo "<pre style='background:#ffff00;text:#ffffff;'>Congrutulations Successfully passed all test cases</pre>";
		else
		echo "<pre>OPPSS failed in passing test cases</pre>";
	}		
	//exec("rm $filename_code");
	exec("rm userfile/".$userDir."/".$userId.".o");
	exec("rm userfile/".$userDir."/*.txt");
	exec("rm $executable");
?>