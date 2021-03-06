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

		//Checking is user existing in the database or not
		$query = "SELECT id,password FROM Accounts WHERE username='$username'";
		$result = mysqli_query($con,$query);
		$res = mysqli_fetch_assoc($result);
		//$rows = mysqli_num_rows($result);
		if(password_verify($password,$res['password'])){
			$_SESSION['username'] = $username;
			$_SESSION['id'] = $res["id"];
			// Redirect user to index.php
			header("Location: mainpage.php");
			exit;
		} else { ?>
			<div class="form">
				<div class="container my-container"> 
					<form method="POST" action="">
					   	<hr>
						<h5><strong><em><u>LOGIN</u></em></strong></h5>
						<hr>
						<hr>
						<h5><strong><em><u>
							ERROR: Username or password is incorrect
						</u></em></strong></h5>
		<?php }
	} else {?>
		<div class="form">
			<div class="container my-container"> 
				<form method="POST" action="">
				   	<hr>
					<h5><strong><em><u>LOGIN</u></em></strong></h5>
					<hr>
	<?php } ?>
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
					<input type="submit" name="submit" value="Login">
					<br><br>
					<p>Not registered yet? <a href='register.php'>Register Here</a></p>
					<p>Forgot password? <a href='forgot.php'>Click here!</a></p>
				</form>
			</div>
		</div>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
