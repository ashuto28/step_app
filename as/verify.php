<?php 
/* Verifies registered user email, the link to this page
   is included in the register.php email message 
*/
require 'db.php';
session_start();
// Make sure email and hash variables aren't empty
if(isset($_GET['uni_rol_num']) && !empty($_GET['uni_rol_num']) AND isset($_GET['hash']) AND !empty($_GET['hash']))
{
    $uni_rol_num = $mysqli->escape_string($_GET['uni_rol_num']); 
    $hash = $mysqli->escape_string($_GET['hash']);
    // Select user with matching email and hash, who hasn't verified their account yet (active = 0)
    $result = $mysqli->query("SELECT * FROM users WHERE uni_rol_num='$uni_rol_num' AND hash='$hash' AND active='0'");
    if ( $result->num_rows == 0 )
    { 
        $_SESSION['message'] = "Account has already been activated or the URL is invalid!";
        header("location: error.php");
    }
    else {
        $_SESSION['message'] = "Your account has been activated!";
        
        // Set the user status to active (active = 1)
        $mysqli->query("UPDATE users SET active='1' WHERE uni_rol_num='$uni_rol_num'") or die($mysqli->error);
        $_SESSION['active'] = 1;
		
        
        header("location: success.php");
    }
}
else {
    $_SESSION['message'] = "Invalid parameters provided for account verification!";
    header("location: error.php");
}     
?>