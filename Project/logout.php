<html>
<head>
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<meta http-equiv="refresh" content="3;./login.php" />
</head>
<body>
<?php
session_start();
session_destroy();
if (isset($_COOKIE['cart']))
	setcookie('cart',"", -1, dirname($_SERVER['REQUEST_URI']), true);
?>
	<p>You have successfully logged out. Returning to login page in 3 seconds.</p>
</body>
</html>

