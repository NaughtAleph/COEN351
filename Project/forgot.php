<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<style type="text/css">
.my-container{
	max-width: 50%;
	margin-left: 10%;
}
</style>
</head>
<body>
<div class="form">
<form method="get" action="">
	<div class="container my-container">
  <div class="form-group">
    <fieldset class ="form-group">  
       	<hr><h5><strong><em><u>LOGIN</u></h5><hr>

    	<label for="username">First name</label>
        <input type="text" class="form-control mx-sm-3" id="username" name="username" aria-describedby="userHelp" 
        placeholder="Enter UserName">
        <small id="userHelp" class="form-text text-muted">Enter your username.</small>
        <br>

    	<label for="password">Password</label>
        <input type="text" class="form-control" id="password" aria-describedby="passHelp" name="password" 
        placeholder="Enter Password">
        <small id="middleHelp" class="form-text text-muted">Enter your password name.</small>
        <br>

    </fieldset>
   </div>  
  <input type="submit" name="submit" value="Login">
  <p>Not registered yet? <a href='register.php'>Register Here</a></p>
  <p>Forgot password? <a href='password.php'>Click here!</a></p>


</div>
</form>
</div>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>