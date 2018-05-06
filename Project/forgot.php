<?php
/**
 * User: SP
 */
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<style type="text/css">
.my-container{
	max-width: 50%;
	margin-left: 10%;
}
</style>
</head>
<body>
<?php
require('db.php');
session_start();

if (isset($_REQUEST['username']))
{
    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($con,$email); 
    
    $username = stripslashes($_REQUEST['username']);
    $username = mysqli_real_escape_string($con,$username); 
    
    $newpassword = stripslashes($_REQUEST['newpassword']);
    $newpassword = mysqli_real_escape_string($con,$newpassword); 

    $passpattern = '/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%&*()]).{4,}/';
    $emailpattern = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';

    if(!preg_match($passpattern, $newpassword))
    {
        echo "<div class='container my-container'> 
        <form method='POST'>
        <hr><h5><strong><em><u>ERROR</u></h5><hr>
        <h3>Password pattern doesn't match.</h3>
        <h4> Minimun 1 capital, small, special and numeric,.....</h4>
        <br/>Click here to again try<a href='forgot.php'>Back</a></div>";
    }
    else if(!preg_match($emailpattern, $email))
    {
        echo "<div class='container my-container'> 
        <form method='POST'>
        <hr><h5><strong><em><u>ERROR</u></h5><hr>
        <h3>Email pattern doesn't match.</h3>
        <h4>Email enter is wrong format,.....</h4>
        <br/>Click here to again try<a href='forgot.php'>Back</a></div>";
    }
    
    else 
    {
        $hashpass = md5($newpassword);
        $query = "UPDATE Accounts SET password = '$hashpass' where email='$email' and username='$username'";
        $result = mysqli_query($con,$query);
        $rows = mysqli_num_rows($result);

          if($rows>0)
          {
          echo "<div class='container my-container'> 
          <form method='POST'>
          <hr><h5><strong><em><u>ERROR</u></h5><hr>
          <h3>Your Password was not updated successfully.</h3>
          <h4> username or email not found </h4>
          <br/>Click here to try again <a href='forgot.php'>Login</a></div>";            
          }
          else
          {
          $_SESSION['username'] = $username;
          echo "<script> location.href='login.php'; </script>";
          exit; 
          }
    }
}else{
?>
<div class="form">
   <div class="container my-container">
<form method="POST" action="">
	
      
       	<hr><h5><strong><em><u>Forgot Password</u></h5><hr>

    	<label for="email">Email</label>
        <input type="text" class="form-control mx-sm-3" id="email" name="email" aria-describedby="emailhelp" 
        placeholder="Enter Email">
        <small id="emailhelp" class="form-text text-muted">Enter your email.</small>
        <br>

        <label for="username">Username</label>
        <input type="text" class="form-control mx-sm-3" id="username" name="username" aria-describedby="usernamehelp"
        placeholder="Enter Username">
        <small id="usernamehelp" class="form-text text-muted">Enter your username.</small>
        <br>

    	  <label for="newpassword">New Password</label>
        <input type="text" class="form-control" id="newpassword" aria-describedby="newpassHelp" name="newpassword" 
        placeholder="Enter New Password">
        <small id="newpassHelp" class="form-text text-muted">Enter your new password.</small>
        <br>

  <input type="submit" name="submit" value="Update">

</form></div></div>
<?php } ?>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
