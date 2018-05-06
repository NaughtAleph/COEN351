<?php
$cc = "";
$name = "";
$month = 0;
$year = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$cc = $_POST["cc"];
	$name = $_POST["name"];
	$month = $_POST["expireMonth"];
	$year = $_POST["expireYear"];
	$cvc = $_POST["cvc"];
	//echo $cc;
	//die(mysqli_real_escape_string($cc));
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Pay for shit</title>
	<link rel="stylesheet" href="checkout.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
	<script src="checkout.js"></script>
</head>
<body>
	<!--TODO: Get items from cart-->
	<form method="post" action="checkout.php">
<!-- possibly remove feature of remembering cc number and name, could be insecure -->
		<input id="cc" name="cc" type="text"
			placeholder="Credit Card Number" maxlength=16
			<?php if ($cc != "") echo "value='$cc'"; ?> 
		>
		<?php
			if ($cc && !is_numeric($cc))
				echo "<span class='error'>".
						"Make sure your credit card only contains numbers".
					"</span>";
		?>
		<br>
		<input id="name" name="name" type="text"
			placeholder="Cardholder Name"
			<?php if ($name != "") echo "value='$name'";?>
		>
		<br>
		<select id="expireMonth" name="expireMonth">
			<?php
				for ($i = 1; $i <= 12; $i++) {
					echo "<option value=$i".
						($month == $i? " selected='selected' ":"")
						.">".($i<10?"0$i":$i)."</option>";
				}
			?>
		</select>
		<select id="expireYear" name="expireYear">
			<?php
				for ($i = 2017; $i <= 2040; $i++) {
					echo "<option value=$i".
						($year == $i? " selected='selected' ":"")
						.">$i</option>";
				}
			?>
		</select>
		<br>
		<input id="cvc" name="cvc" type="text" placeholder="CVC" maxlength=3>
		<?php
			if ($cvc && !is_numeric($cvc))
				echo "<span class='error'>".
						"Make sure your cvc only contains numbers".
					"</span>";
		?>
		<br>
		<input type="submit" value="Submit">
	</form>
</body>
</html>
