<?php
//resend activation link to the user
session_start();

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must register first!!";
  header("location: error.php");    
}
		$uni_rol_num = $_SESSION['uni_rol_num'];
 		$first_name = $_SESSION['first_name'];
		$last_name = $_SESSION['last_name'];
		$email = $_SESSION['email'];
		$hash = $_SESSION['hash'];
        $_SESSION['message'] =
                "Confirmation link has been sent to $email, please verify
                 your account by clicking on the link in the message!";

       //  Send registration confirmation link (verify.php)
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
    

?>

