<?php
session_start();

if ( $_SESSION['logged_in'] != 1 ) {
	  $_SESSION['message'] = "You must log in before viewing your profile page!";
	  header("location: ../error.php");
	}
	if(!isset($_SESSION['language']) AND empty($_SESSION['language'])){
		$_SESSION['language']='c';
	}
	if(!isset($_SESSION['seen']) AND empty($_SESSION['seen'])){
		$_SESSION['seen']=false;
	}
	if(!isset($_SESSION['questionNo']) AND empty($_SESSION['questionNo'])){
		$_SESSION['questionNo']=1;
	}
	if(!isset($_SESSION['className']) AND empty($_SESSION['className']));{
		$_SESSION['className']="Myclass";
	}
	if(!isset($_SESSION['MAXQUES']) AND empty($_SESSION['MAXQUES']));{
		$_SESSION['MAXQUES']=3;
	}
	
	if($_SESSION['seen']===true){
		header('location: arc');
	}
	else{
		exec('mkdir userfile/'.$_SESSION['uni_rol_num']);
		exec('mkdir submittedfile/'.$_SESSION['uni_rol_num']);
		exec('cp sample/* userfile/'.$_SESSION['uni_rol_num'].'/');
		exec('cd userfile/'.$_SESSION['uni_rol_num'].'/ && rename "s/sample/'.$_SESSION['uni_rol_num'].'/g"  *');
		exec('rm userfile/'.$_SESSION['uni_rol_num'].'/sample*');
		$_SESSION['seen']=true;
		header('location: arc');
	}
?>
