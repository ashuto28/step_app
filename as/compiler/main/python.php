<?php
	$userDir=$userId=$_SESSION['uni_rol_num'];
	$CC="python3.5";
	$code=$_POST["value"];
	$filename_code="../submittedfile/".$userDir."/".$userId."_".$_SESSION['questionNo'].".py";
	$out="timeout 2s python3.5  ".$filename_code;
	$filename_error="../submittedfile/".$userDir."/".$userId."error.txt";
	$executable="../submittedfile/".$userDir."/".$userId."pyc";
	$command=$CC." ".$filename_code;
	$command_error=$command." 2>".$filename_error;
	$testcase="../testcase/testcase_".$_SESSION['questionNo'].".txt";
	$filename_out="../submittedfile/".$userDir."/".$userId."output".".txt";
	$solution="../solution/solution_".$_SESSION['questionNo'].".txt";
	$check=0;
	$pass=0;	
	$run_time_error=0;
	if(trim($code)=="")
	die("The code area is empty");
	exec("chmod 600 $filename_code");
	$file_code=fopen($filename_code,"w+");
	fwrite($file_code,$code);
	fclose($file_code);
	shell_exec($command_error);
	$error=file_get_contents($filename_error);
	$executionStartTime = microtime(true);
	if(trim($error)=="")
	{
		
			$process = proc_open($out,
				array(
					0 => array("file",$testcase,"r"), //stdin
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
	else if(strpos($error,"Error")===false)
	{
			$process = proc_open($out,
				array(
					0 => array("file",$testcase,"r"), //stdin
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
		$output=$error;
		$check=1;
	}
	$executionEndTime = microtime(true);
	$seconds = $executionEndTime - $executionStartTime;
	$seconds = sprintf('%0.3f', $seconds);
	if($check==1)
	{	
		echo "Verdict : CE";
		exec("rm $filename_code");
		$_SESSION['solved_'.$_SESSION['questionNo']]=false;
	}
	else if(trim($runtime_error)!=""){
		echo "Verdict : RE";
		exec("rm $filename_code");
		$_SESSION['solved_'.$_SESSION['questionNo']]=false;
	}
	else if($check==0 && $seconds>=2)
	{
		echo "Verdict : TLE";
		exec("rm $filename_code");
		$_SESSION['solved_'.$_SESSION['questionNo']]=false;
	}
	else if(trim($output)=="")
	{
		echo "Verdict : WA";
		exec("rm $filename_code");
		$_SESSION['solved_'.$_SESSION['questionNo']]=false;
	}
	else if($check==0)
	{
		if($pass==1){
		$_SESSION['solved_'.$_SESSION['questionNo']]=true;
			exec("chmod 400 $filename_code");
		}
		else{
			$_SESSION['solved_'.$_SESSION['questionNo']]=false;
			exec("rm $filename_code");
			echo false;
		}
	}
	
	exec("rm ../submittedfile/".$userDir."/*.txt");
	exec("rm $executable");
?>