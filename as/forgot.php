<?php 
/* Reset your password form, sends reset.php password link */
require 'db.php';
session_start();

// Check if form submitted with method="post"
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) 
{   
    $uni_rol_num = $mysqli->escape_string($_POST['uni_rol_num']);
    $result = $mysqli->query("SELECT * FROM users WHERE uni_rol_num='$uni_rol_num'");

    if ( $result->num_rows == 0 ) // User doesn't exist
    { 
        $_SESSION['message'] = "User with Roll Number='$uni_rol_num' doesn't exist!";
        header("location: error.php");
    }
    else { // User exists (num_rows != 0)

        $user = $result->fetch_assoc(); // $user becomes array with user data
		
		$uni_rol_num = $user['uni_rol_num'];
        $email = $user['email'];
        $hash = $user['hash'];
        $first_name = $user['first_name'];
		$last_name = $user['last_name'];

        // Session message to display on success.php
        $_SESSION['message'] = "<p>Please check your email <span>$email</span>"
        . " for a confirmation link to complete your password reset!</p>";

        // Send registration confirmation link (reset.php)
        $ip= exec('curl http://ipecho.net/plain; echo');
        $to      = $email;
        $subject = 'Password Reset Link (StepApp Coorporation limited)';
		$from='StepApp';
        $message_body = '
        <h2>Hello '.$first_name.' '.$last_name.'</h2>
		
        <h3>You have requested for password reset!<br>	
		Your University Roll Number and login ID is : '.$uni_rol_num.'</h3>
		<p>Please click this link to reset your password:<br>
        http://'.$ip.'/ashutosh/as/reset.php?uni_rol_num='.$uni_rol_num.'&hash='.$hash.'<br><br>
		if above mentioned university roll number is doesnt belong to you then kindly dont activate it<br>
		All the query related StepApp to will be solved by system administrator</p>';
		$headers = "From: $from"."\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		mail( $to, $subject, $message_body,$headers);
        header("location: success.php");
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Reset Your Password</title>
  <?php include 'css/css.html'; ?>
</head>

<body>
    
  <div class="form">

    <h1>Reset Your Password</h1>

    <form action="forgot.php" method="post">
     <div class="field-wrap">
      <label>
        University Roll Number<span class="req">*</span>
      </label>
      <input type="text"required autocomplete="off" name="uni_rol_num"/>
    </div>
    <button class="button button-block">Reset</button>
    </form>
  </div>
          
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>
</body>

</html>
