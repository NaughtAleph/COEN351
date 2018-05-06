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

if(isset($_POST['username']))
{

    $username = stripslashes($_REQUEST['username']);
    $username = mysqli_real_escape_string($con,$username);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con,$password);
    echo "$username";
    $hashpass = md5($password);

    //Checking is user existing in the database or not
    $query = "SELECT * FROM project WHERE username='$username'and password='$hashpass'";
    $result = mysqli_query($con,$query);
    $rows = mysqli_num_rows($result);
        if($rows==1){
        $_SESSION['username'] = $username;
            // Redirect user to index.php
        echo "<script> location.href='mainpage.php'; </script>";
        exit; 
    }
    else
    {
    echo "<div class='form'>
    <div class=container my-container'> 
        <form method='POST'>
        <hr><h5><strong><em><u>ERROR</u></h5><hr>
    <h3>Username OR password is incorrect.</h3>
    <br/>Click here to again  <a href='login.php'>Login</a></div>";
    }
    }else{
?>
<div class="form">
    <div class="container my-container"> 
<form method="POST" action="">
       	<hr><h5><strong><em><u>LOGIN</u></h5><hr>

    	<label for="username">Username name</label>
        <input type="text" class="form-control mx-sm-3" id="username" name="username" aria-describedby="userHelp" 
        placeholder="Enter UserName" required="true">
        <small id="userHelp" class="form-text text-muted">Enter your username.</small>
        <br>

    	<label for="password">Password</label>
        <input type="text" class="form-control" id="password" aria-describedby="passHelp" name="password" 
        placeholder="Enter Password" required="true">
        <small id="middleHelp" class="form-text text-muted">Enter your password name.</small>
        <br><br>

  <input type="submit" name="submit" value="Login"><br><br>
  <p>Not registered yet? <a href='register.php'>Register Here</a></p>
  <p>Forgot password? <a href='forgot.php'>Click here!</a></p>

</form>
</div>
</div>
<?php } ?>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
