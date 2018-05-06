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
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
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
if (isset($_REQUEST['username'])){
    
    $firstname = stripslashes($_REQUEST['firstname']);
    $firstname = mysqli_real_escape_string($con,$firstname); 
    
    $lastname = stripslashes($_REQUEST['lastname']);
    $lastname = mysqli_real_escape_string($con,$lastname); 
    
    $contact = stripslashes($_REQUEST['contactnumber']);
    $contact = mysqli_real_escape_string($con,$contact); 
    
    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($con,$email);
    
    $username = stripslashes($_REQUEST['username']);
    $username = mysqli_real_escape_string($con,$username);

    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con,$password);

    $cpassword = stripslashes($_REQUEST['cnfpassword']);
    $cpassword = mysqli_real_escape_string($con,$cpassword);
    
    $passpattern = '/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%&*()]).{4,}/';
    $emailpattern = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';



    $query = "SELECT username FROM Accounts where username='$username'";
    $result = mysqli_query($con,$query);
    $rows = mysqli_num_rows($result);
        
    if($rows>0)
    {
        echo "<div class='container my-container'> 
        <form method='POST'>
        <hr><h5><strong><em><u>ERROR</u></h5><hr>
        <h3>Username already taken.</h3>
        <h4>should choose diffrent username,.....</h4>
        <br/>Click here to again try<a href='register.php'>Login</a></div>"; 
    }

    else if(!preg_match($passpattern, $password))
    {
        echo "<div class='container my-container'> 
        <form method='POST'>
        <hr><h5><strong><em><u>ERROR</u></h5><hr>
        <h3>Password pattern doesn't match.</h3>
        <h4> Minimun 1 capital, small, special and numeric,.....</h4>
        <br/>Click here to again try<a href='register.php'>Login</a></div>";
    }
    else if(!preg_match($emailpattern, $email))
    {
        echo "<div class='container my-container'> 
        <form method='POST'>
        <hr><h5><strong><em><u>ERROR</u></h5><hr>
        <h3>Email pattern doesn't match.</h3>
        <h4>Email enter is wrong format,.....</h4>
        <br/>Click here to again try<a href='register.php'>Login</a></div>";
    }
    else if ($cpassword != $password)
    {
        echo "<div class='container my-container'> 
        <form method='POST'>
        <hr><h5><strong><em><u>ERROR</u></h5><hr>
        <h3>Confirm Password Error.</h3>
        <h4>should match password,.....</h4>
        <br/>Click here to again try<a href='register.php'>Login</a></div>";
    }
    else if(strlen($username)<8)
    {
        echo "<div class='container my-container'> 
        <form method='POST'>
        <hr><h5><strong><em><u>ERROR</u></h5><hr>
        <h3>Username Error.</h3>
        <h4>should be more than 8 character,.....</h4>
        <br/>Click here to again try<a href='register.php'>Login</a></div>";   
    }
    else if(strlen($contact)!==10)
    {
        echo "<div class='container my-container'> 
        <form method='POST'>
        <hr><h5><strong><em><u>ERROR</u></h5><hr>
        <h3>Contact Error.</h3>
        <h4>should be 10 digit,.....</h4>
        <br/>Click here to again try<a href='register.php'>Login</a></div>";   
    }
    
    else {
            $hashpass = password_hash($password, PASSWORD_BCRYPT);
            $query = "INSERT into Accounts (username,firstname,lastname,contact,email,password) VALUES ('$username','$firstname','$lastname','$contact','$email','$hashpass')";
			//echo "$query";
            $result = mysqli_query($con,$query);
            //echo "$result";

            if($result){
        echo "<div class='container my-container'> 
        <form method='POST'>
        <hr><h5><strong><em><u>SUCCESS</u></h5><hr>
                    <h3>You are registered successfully.</h3>
                    <br/>Click here to <a href='login.php'>Login</a></div>";
                        }
            }

}
    else{
?>
<form name="myform" method="post" action="">
	<div class="container my-container">
		<div class="form-group">
			<fieldset class ="form-group">  
				<hr><h5><strong><em><u>GENERAL</u></h5><hr>

				<label for="firstname">First name</label>
				<input type="text" class="form-control mx-sm-3" id="firstname" name="firstname" aria-describedby="firstHelp" 
    				placeholder="Enter First Name" required="true">
				<small id="firstHelp" class="form-text text-muted">Enter your first name.</small>
				<br>

				<label for="lastname">Last Name</label>
				<input type="text" class="form-control" id="lastname" aria-describedby="lastHelp" name="lastname"
					placeholder="Enter Last Name" required="true">
				<small id="lastHelp" class="form-text text-muted">Enter your last name.</small>
				<br>

				<label for="contactnumber">Contact</label>
				<input type="number" class="form-control" id="contactnumber" aria-describedby="contactHelp" name="contactnumber" placeholder="Enter Contact" required="true">
				<small id="contactHelp" class="form-text text-muted">Enter your contact number mobile only.</small>
				<br>

				<label for="exampleInputEmail">Email address</label>
				<input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" required="true">
				<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
			</fieldset>
			<fieldset>
				<hr><h5><strong><em><u>USERNAME AND PASSWORD</u></h5><hr>

				<label for="username">Username</label>
				<input type="text" class="form-control" id="username" placeholder="username" name="username" aria-describedby="usernameHint" required="true">
				<small id="usernameHint" class="form-text text-muted">Please enter 8 character username.</small>
				<br>

				<label for="password">Password</label>
				<input type="text" class="form-control" id="password" placeholder="Password" name="password" aria-describedby="passwordHint" required="true">
				<small id="passwordHint" class="form-text text-muted">Please enter strong password.</small>
				<br>

				<label for="cnfpassword">Confirm Password</label>
				<input type="password" class="form-control" name="cnfpassword" id="cnfpassword" placeholder="Password" aria-describedby="cnfpasswordHint" required="true">
				<small id="cnfpasswordHint" class="form-text text-muted">Please enter same password as above</small>
				<br>

			</fieldset>
		</div>  
		<input type="submit" name="submit" value="SAVE">
	</div>
</form>
<?php } ?>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>



