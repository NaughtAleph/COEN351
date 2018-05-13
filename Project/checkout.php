<?php
//TODO bootstrap form look
require("auth.php");
require("db.php");
$cc = "";
$name = "";
$month = 0;
$year = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["id"])) {
	$id = $_POST["id"];
	$num = $_POST["number"];
	$cart = json_decode($_COOKIE["cart"], true);
	if (is_numeric($num) && is_numeric($id) && isset($cart[$id])) {
		$cart[$id] -= $num;
		if ($cart[$id] <= 0)
			unset($cart[$id]);
			setcookie("cart",json_encode($cart), time() + (86400 * 30),
				dirname($_SERVER["REQUEST_URI"]), $_SERVER['host'], true);
		if (empty($cart)) {
			$_COOKIE["cart"] = "";
			setcookie("cart", "",-1, dirname($_SERVER["REQUEST_URI"]),
				$_SERVER['host'], true);
		}
		else
			$_COOKIE["cart"] = json_encode($cart);
	}
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// htmlspecialchars avoids XSS attacks
	$cc = htmlspecialchars($_POST["cc"]);
	$name = htmlspecialchars($_POST["name"]);
	$month = htmlspecialchars($_POST["expireMonth"]);
	$year = htmlspecialchars($_POST["expireYear"]);
	$cvc = htmlspecialchars($_POST["cvc"]);
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
			setcookie('cart',"", -1, dirname($_SERVER['REQUEST_URI']), $_SERVER['host'], true);
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
	<h3>Current Cart</h3>
	<?php
		if (!isset($_COOKIE["cart"]) || !$_COOKIE["cart"]) { ?>
			<h5>Cart is empty</h5>
	<?php } else { ?>
	<table>
		<tr>
			<th>Title</th>
			<th>Number</th>
			<th>Price Per Unit</th>
			<th>Total Price</th>
			<th>Action</th>
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
							<td>
								<form method="post" action="">
									<input type="number" class="input-num" name="number" min="0">
									<input type="hidden" name="id" value="<?php echo $row["id"];?>">
									<input type="submit" value="Remove">
								</form>
							</td>
						</tr>
					<?php
				}
			}
		} ?>
	</table>
	<a href="mainpage.php">Back</a>
	<h3>Enter details to checkout</h3>
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
			<?php if ($name != "") echo "value='$name'"; ?>
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
