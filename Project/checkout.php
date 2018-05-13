<?php
//TODO bootstrap form look
// TODO add minus button next to things to delete them from your cart
require("auth.php");
require("db.php");
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
	if ($cc && is_numeric($cc) &&
		$name != "" &&
		$month && is_numeric($month) &&
		$year && is_numeric($year) &&
		$cvc && is_numeric($cvc)) {
		?>
			<html>
			<head>
				<meta http-equiv="refresh" content="3;./mainpage.php" />
			</head>
			<body>
				<h3>Purchase(s) Successful</h3>
				<h3>Returning you to main page in 3 seconds</h3>
			</body>
			</html>
		<?php
		//TODO clear cart cookie
		exit;
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="css/checkout.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
	<script src="js/checkout.js"></script>
</head>
<body>
	<table>
		<tr>
			<th>Title</th>
			<th>Number</th>
			<th>Price Per Unit</th>
			<th>Total Price</th>
		</tr>
		<?php
			$cart = json_decode($_COOKIE["cart"], true);
			foreach ($cart as $id=>$num) {
				$result = mysqli_query($con, "SELECT * FROM Books WHERE id=$id");
				while($row = mysqli_fetch_array($result)) {
					?>
						<tr>
							<td><?php echo $row["title"] ?></td>
							<td><?php echo $num ?></td>
							<td>$<?php echo $row["price"] ?></td>
							<td><?php echo sprintf("$%.2f",$num * $row["price"]) ?> </td>
						</tr>
					<?php
				}
			}
		?>
	</table>
	<form method="post" action="checkout.php">
<!-- possibly remove feature of remembering cc number and name, could be insecure -->
		<input id="cc" name="cc" type="text"
			placeholder="Credit Card Number" maxlength=16
			<?php if ($cc != "") echo "value='$cc'"; ?> 
		>
		<?php
			if ($cc && !is_numeric($cc)) { ?>
				<span class='error'>
					Make sure your credit card only contains numbers
				</span>
		<?php } else if (isset($_POST["cc"]) && !$cc) { ?>
				<span class='error'>
					Required Field
				</span>
		<?php } ?>
		<br>
		<input id="name" name="name" type="text"
			placeholder="Cardholder Name"
			<?php if ($name != "") echo "value='$name'";//TODO gotta escape html?>
		>
		<?php if (isset($_POST["name"]) && !$name) { ?>
			<span class='error'>
				Required Field
			</span>
		<?php } ?>
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
		<?php
			if ((isset($_POST["expireMonth"]) && !$month) || (isset($_POST["expireYear"]) && !$year)) { ?>
				<span class='error'>
					Required Field
				</span>
		<?php }	?>
		<br>
		<input id="cvc" name="cvc" type="text" placeholder="CVC" maxlength=3>
		<?php
			if ($cvc && !is_numeric($cvc)) { ?>
				<span class='error'>
					Make sure your cvc only contains numbers
				</span>
		<?php } else if (isset($_POST["cvc"]) && !$cvc) { ?>
				<span class='error'>
					Required Field
				</span>
		<?php } ?>
		<br>
		<input type="submit" value="Submit">
	</form>
</body>
</html>
