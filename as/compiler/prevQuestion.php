<?php
session_start();
$questionNo=$_GET['ques'];
$_SESSION['questionNo'] = $questionNo;
echo file_get_contents("question/questionNo".$questionNo.".txt");
?>
