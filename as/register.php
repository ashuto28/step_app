<?php
/* 
	Registration process, inserts user info into the database 
   and sends account confirmation email message
 */
/* Displays user information and some useful messages */
session_start();

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must register first!!";
  header("location: error.php");    
}
// Set session variables to be used on profile.php page
if($_SERVER['REQUEST_METHOD']==='POST'){
$_SESSION['email'] = $_POST['email'];
$_SESSION['first_name'] = $_POST['firstname'];
$_SESSION['last_name'] = $_POST['lastname'];
$_SESSION['uni_rol_num'] = $_POST['uni_rol_num'];
$_SESSION['cls_rol_num'] = $_POST['cls_rol_num'];
}
else{
	  $_SESSION['message'] = "Some unknown error occured. \n Please try again";
	$_SESSION['logged_in'] = 0;		//this will logout the user as it directly accessing this page
	  header("location: error.php");    

}

// Escape all $_POST variables to protect against SQL injections
$first_name = $mysqli->escape_string($_POST['firstname']);
$last_name = $mysqli->escape_string($_POST['lastname']);
$email = $mysqli->escape_string($_POST['email']);
$cls_rol_num = $mysqli->escape_string($_POST['cls_rol_num']);
$uni_rol_num = $mysqli->escape_string($_POST['uni_rol_num']);
$password = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
$hash = $mysqli->escape_string( md5( rand(0,1000) ) );
      
// Check if user with that email already exists
$result = $mysqli->query("SELECT * FROM users WHERE uni_rol_num='$uni_rol_num'") or die($mysqli->error());

// We know user email exists if the rows returned are more than 0
if ( $result->num_rows > 0 ) {
    
    $_SESSION['message'] = 'User with this Univerity roll number already exists!! Please contact Administrator!';
    header("location: error.php");
    
}
else { // Email doesn't already exist in a database, proceed...

    // active is 0 by DEFAULT (no need to include it here)
    $sql = "INSERT INTO users (first_name, last_name, cls_rol_num, uni_rol_num, email, password, hash) " 
            . "VALUES ('$first_name','$last_name','$cls_rol_num','$uni_rol_num','$email','$password', '$hash')";

    // Add user to the database
    if ( $mysqli->query($sql) ){

        $_SESSION['active'] = 0; //0 until user activates their account with verify.php
        $_SESSION['logged_in'] = true; // So we know the user has logged in
        $_SESSION['message'] =
                "Confirmation link has been sent to $email, please verify
                 your account by clicking on the link in the message!";

        // Send registration confirmation link (verify.php)
		$ip= exec('curl http://ipecho.net/plain; echo');
        $to      = $email;
        $subject = 'Account Verification (StepApp Coorporation limited)';
		$from='StepApp';
        $message_body = '
        <h2>Hello '.$first_name.' '.$last_name.'</h2>
		
        <h3>Thank you for signing up!<br><br>	
		Your University Roll Number and login ID is : '.$uni_rol_num.'</h3><br>		
       	<p>Please click this link to activate your account:<br>
        http://'.$ip.'/ashutosh/as/verify.php?uni_rol_num='.$uni_rol_num.'&hash='.$hash.'<br><br>
		if above mentioned university roll number is doesnt belong to you then kindly dont activate it<br>
		All the query related StepApp to will be solved by system administrator</p>';
		$headers = "From: $from"."\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		mail( $to, $subject, $message_body,$headers);
        header("location: profile-notverified.php");
    }

    else {
        $_SESSION['message'] = 'Registration failed!';
        header("location: error.php");
    }

}
