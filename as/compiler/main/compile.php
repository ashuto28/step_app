<?php
session_start();
if ( $_SESSION['logged_in'] != 1 ) {
	  die("Login First");
	}	
	switch($_SESSION['language']){
			
			case "c":
			{
				include("c.php");
				$language = "C"; 
				break;
			}
			case "cpp":
			{
				include("cpp.php");
				$language= "C++";
				break;
			}

			case "java":
			{	
				include("java.php");
				$language = "JAVA";
				break;
			}

			case "py":
			{
				include("python.php");
				$language = "PYTHON";
				break;
			}
		}
	if(isset($_SESSION['solved_'.$_SESSION['questionNo']]) && $_SESSION['solved_'.$_SESSION['questionNo']]===true){
		require "../../db.php";
		$result=$mysqli->query('SELECT * FROM score WHERE userId = '.$_SESSION['uni_rol_num'].' AND question = '.$_SESSION['questionNo']);
		if($result->num_rows===0){
			$mysqli->query('INSERT INTO score(question,max_score,scored,language,userId) values('.$_SESSION['questionNo'].',100,56,'.'"'.$_SESSION['language'].'",'.$_SESSION['uni_rol_num'].')') ;
		}
		else{
	    	$mysqli->query('UPDATE score set scored = 59 ,language = "'.$language.'" WHERE userId = '.$_SESSION['uni_rol_num'].' AND question = '.$_SESSION['questionNo']) ;
		}
		$rec = $mysqli->query('SELECT solved FROM public WHERE question = '.$_SESSION['questionNo']);
		$result = $rec->fetch_assoc();
		$result['solved'] = $result['solved']+1;
		$mysqli->query('UPDATE public SET solved = '.$result['solved'].' WHERE question = '.$_SESSION['questionNo']);
		echo true;
		
	}
	
?>

