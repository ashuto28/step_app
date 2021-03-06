<?php 
/* Main page with two forms: sign up and log in */
require 'db.php';
session_start();
	if(!isset($_SESSION['logged_in']) AND empty($_SESSION['logged_in']))
		$_SESSION['logged_in']=false;
	else if($_SESSION['logged_in']===true)
		header("location: profile.php");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Sign-Up/Login Form</title>
  <link href="img/favicon.ico" rel="shortcut icon">
  <?php include 'css/css.html'; ?>
	<link rel="stylesheet" href="css/css/bootstrap.css">
	
      
</head>

<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    if (isset($_POST['login'])) { //user logging in
        require 'login.php';   
    }
    elseif (isset($_POST['register'])) { //user registering
        require 'register.php';        
    }
}
?>
<body>
  <div class="form">
      <h1>StepApp</h1>
	
      <ul class="tab-group">
        <li class="tab"><a href="#signup">Sign Up</a></li>
        <li class="tab active"><a href="#login">Log In</a></li>
      </ul>
      
      <div class="tab-content">

         <div id="login">   
          <h1>Welcome Back!</h1>
          
          <form action="index.php" method="post" autocomplete="off">
          
            <div class="field-wrap">
            <label>
              University Roll Number<span class="req">*</span>
            </label>
            <input type="text" required autocomplete="off" name="uni_rol_num"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Password<span class="req">*</span>
            </label>
            <input type="password" required autocomplete="off" name="password"/>
          </div>
        
		
          <p class="forgot" ><a href="forgot.php">Forgot Password?</a></p>
        
          
          <button class="button button-block" name="login" >Log In</button>
          
          </form>
	

        </div>
          
        <div id="signup">   
          <h1>Sign Up</h1>
          
          <form action="index.php" method="post" autocomplete="off">
          
          <div class="top-row">
            <div class="field-wrap">
              <label>
                First Name<span class="req">*</span>
              </label>
              <input type="text" required autocomplete="off" name='firstname' />
            </div>
        
            <div class="field-wrap">
              <label>
                Last Name<span class="req">*</span>
              </label>
              <input type="text"required autocomplete="off" name='lastname' />
            </div>
          </div>
	   <div class="field-wrap">
            <label>
              Class Roll Number<span class="req">*</span>
            </label>
            <input type="text" required autocomplete="off" name="cls_rol_num" />
          </div>
		
	  <div class="field-wrap">
            <label>
              University Roll Number<span class="req">*</span>
            </label>
            <input type="text" required autocomplete="off" name="uni_rol_num" />
          </div>

          <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input type="email"required autocomplete="off" name='email' />
          </div>
          
          <div class="field-wrap">
            <label>
              Set Password<span class="req">*</span>
            </label>
            <input type="password"required autocomplete="off" name='password'/>
          </div>
          
          <button type="submit" class="button button-block" name="register" >Register</button>
          
          </form>
		
        </div>  
        
      </div><!-- tab-content -->
      
</div> <!-- /form -->
  <script src='/compiler/graph/jquery.min.js'></script>
  <script src="js/index.js"></script>

</body>
</html>
