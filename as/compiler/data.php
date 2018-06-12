<?php
session_start();
switch($_GET['language']){
	case 'text/x-csrc':
		$_SESSION['language']="c";
		echo file_get_contents( "userfile/".$_SESSION['uni_rol_num']."/".$_SESSION['uni_rol_num'].".".$_SESSION['language'] );
		break;
	case 'cpp':
		$_SESSION['language']="cpp";
		echo file_get_contents( "userfile/".$_SESSION['uni_rol_num']."/".$_SESSION['uni_rol_num'].".".$_SESSION['language'] );
		break;
	case 'text/x-python':
		$_SESSION['language']="py";
		echo file_get_contents( "userfile/".$_SESSION['uni_rol_num']."/".$_SESSION['uni_rol_num'].".".$_SESSION['language'] );
		break;
	case 'text/x-java':
		
		$_SESSION['language']="java";
		echo file_get_contents("userfile/".$_SESSION['uni_rol_num']."/".$_SESSION['className'].".".$_SESSION['language'],"r");
		break;
}
?>
