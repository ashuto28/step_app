<?php
/* ashutosh dwivedi :- User login process, checks if user exists and password is correct */
/* Displays user information and some useful messages */
session_start();
// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != true ) {
  $_SESSION['message'] = "You must log in first!!!";
  header("location: error.php");
}
// Escape email to protect against SQL injections
$uni_rol_num = $mysqli->escape_string($_POST['uni_rol_num']);
$result = $mysqli->query("SELECT * FROM users WHERE uni_rol_num=$uni_rol_num");

if ( $result->num_rows == 0 ){ // User doesn't exist
    $_SESSION['message'] = "User with that University roll number doesn't exist!";
    header("location: error.php");
}
else { // User exists
    $user = $result->fetch_assoc();

    if ( password_verify($_POST['password'], $user['password']) ) {
        /* assign all the detail of account to the session variables for easy access*/
        $_SESSION['email'] = $user['email'];
		$_SESSION['cls_rol_num'] = $user['cls_rol_num'];
		$_SESSION['uni_rol_num'] = $user['uni_rol_num'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['active'] = $user['active'];
        $_SESSION['logged_in'] = true;	// This is how we'll know the user is logged in
		if($_SESSION['active'] === '0')
			$_SESSION['hash'] = $user['hash'];
		unset ($_SESSION['message']);	// unset the default message
        header("location: compiler/");
    }
    else {
        $_SESSION['message'] = "You have entered wrong password, try again!";
        header("location: error.php");
    }
}

