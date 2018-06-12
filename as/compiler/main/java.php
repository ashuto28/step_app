<?php
	$code=$_POST["value"];
	if(trim($code)=="")
		die("Code area is empty");
	$source = preg_replace('/\/\*[\s\S]*\*\/|\/\/.*|"(?:\\\\?.)*?"/', '', $code);
		if (preg_match('/\bpublic class\s+(\w+)/', $code, $matches)) {
			$className = $matches[1];
			//echo $className;
		}
	if(trim($className)=="")
	die("No public class found !!! unable to detect main method");
	else{
	exec('mkdir ../submittedfile/'.$_SESSION['uni_rol_num'].'/'.$_SESSION['questionNo']);
	$_SESSION['className']=$className;
	$userId=$_SESSION['uni_rol_num'];
	$classPath=$userDir="../submittedfile/".$userId."/".$_SESSION['questionNo'];
	$CC="javac";
	
	$out="timeout 5s java -cp ".$classPath." ".$className;
	$filename_code=$userDir."/".$className.".java";
	$filename_error=$userDir."/".$className."error.txt";
	$executable=$userDir."/*.class";
	$command=$CC." ".$filename_code;	
	$command_error=$command." 2>".$filename_error;
	$testcase="../testcase/testcase_".$_SESSION['questionNo'].".txt";
	$filename_out=$userDir."/".$userId."output".".txt";
	$check=0;
	$pass=0;
	$solution="../solution/solution_".$_SESSION['questionNo'].".txt";
	
	exec('chmod 600 '.$userDir."/*");
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
	else if(strpos($error,"error")===false)
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
		exec('rm '.$userDir.'/* ');
		exec("rmdir $userDir");
		$_SESSION['solved_'.$_SESSION['questionNo']]=false;
	}
	else if(trim($runtime_error)!=""){
		echo "Verdict : RE";
		exec("rm $filename_code");
		exec('rm '.$userDir.'/* ');
		exec("rmdir $userDir");
		$_SESSION['solved_'.$_SESSION['questionNo']]=false;
	}
	else if($check==0 && $seconds>=5)
	{
		echo "Verdict : TLE";
		exec("rm $filename_code");
		exec('rm '.$userDir.'/* ');
		exec("rmdir $userDir");
		$_SESSION['solved_'.$_SESSION['questionNo']]=false;
	}
	else if(trim($output)==="")
	{
		echo "Verdict : WA";
		exec("rm $filename_code");
		exec('rm '.$userDir.'/* ');
		exec("rmdir $userDir");
		$_SESSION['solved_'.$_SESSION['questionNo']]=false;
	}
	else if($check==0)
	{
		if($pass==1){
			$_SESSION['solved_'.$_SESSION['questionNo']]=true;
			exec('chmod 400 '.$userDir."/*");
			exec("rm ".$userDir."/*.txt");
			exec("rm $executable");
		}
		else{
			$_SESSION['solved_'.$_SESSION['questionNo']]=false;
			exec('rm '.$userDir.'/* ');
			exec("rmdir $userDir");
		}
	}
	}
?>