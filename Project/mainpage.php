<?php
include("auth.php");
require('db.php');
$refine = $_GET["refine"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// number of books
	$num = mysqli_real_escape_string($con,stripslashes($_POST["number"]));
	// id of book
	$id = mysqli_real_escape_string($con,stripslashes($_POST["id"]));

	if(is_numeric($num)) {
		// set cookie
		if(isset($_COOKIE["cart"])) {
			$cart = json_decode($_COOKIE["cart"],true);
			if (array_key_exists($id,$cart))
				$cart[$id] += $num;
			else
				$cart[$id] = $num;
			setcookie("cart",json_encode($cart), time() + (86400 * 30),
					dirname($_SERVER["REQUEST_URI"]),$_SERVER['host'], true, true);
		} else {
			$cart = array($id => $num);
			setcookie("cart",json_encode($cart),time() + (86400 * 30),
					dirname($_SERVER["REQUEST_URI"]),$_SERVER['host'], true, true);
			}
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Welcome Home</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="js/mainpage.js"></script>
	<link rel="stylesheet" href="css/style.css" />
</head>
<body>
	<div class="form">
		<p>Welcome <?php echo $_SESSION['username']; ?>!</p>
		<p>This is secure area. (click on title to view book and reviews)</p>
		<p><a href="">Dashboard</a></p>
		<p><a href="logout.php">Logout</a></p>
		<p><a href="checkout.php">Checkout</a></p>
	</div>
	<div class="sidebar">
		<div>
			<input type="checkbox" id="fiction" onclick="refine()" <?php echo (in_array("fiction",$refine)? "checked='checked'" : ""); ?>> Fiction
		</div>
		<div>
			<input type="checkbox" id="nonfiction" onclick="refine()" <?php echo (in_array("nonfiction",$refine)? "checked='checked'" : ""); ?>> Non-fiction
		</div>
		<div>
			<input type="checkbox" id="adventure" onclick="refine()" <?php echo (in_array("adventure",$refine)? "checked='checked'" : ""); ?>> Adventure
		</div>
		<div>
			<input type="checkbox" id="mystery" onclick="refine()" <?php echo (in_array("mystery",$refine)? "checked='checked'" : ""); ?>> Mystery
		</div>
		<div>
			<input type="checkbox" id="history" onclick="refine()" <?php echo (in_array("history",$refine)? "checked='checked'" : ""); ?>> History
		</div>
		<div>
			<input type="checkbox" id="biography" onclick="refine()" <?php echo (in_array("biography",$refine)? "checked='checked'" : ""); ?>> Biography
		</div>
		<div>
			<input type="checkbox" id="fantasy" onclick="refine()" <?php echo (in_array("fantasy",$refine)? "checked='checked'" : ""); ?>> Fantasy
		</div>
	</div>
	<div>
		<?php echo "SELECT * FROM Books WHERE " . $refine[0] . "=1"; ?>
	</div>
	<div>
		<?php
			$query = "SELECT * FROM Books";
			// check $_GET for selectors, unsafe at the moment
			if (!empty($refine)) $query .= " WHERE " . array_shift($refine) . "=1";
			foreach ($refine as $category) {
				$query .= " AND " . $category . "=1";
			}
			$result = mysqli_query($con,$query);
			while($row = mysqli_fetch_assoc($result)) {
				?>
				<div class='book-item'>
					<div class='book-title' onclick="window.location.href = 'item.php?id=<?php echo $row["id"];?>'"><?php echo $row["title"]; ?></div>
					<div class='book-author'><?php echo $row["author"]; ?></div>
					<div class='book-price'>$<?php echo $row["price"]; ?></div>
					<form class='add-to-cart' method="post" action="<?php $_SERVER["REQUEST_URI"]; ?>">
						<input type='number' class='input-num' name='number' min="0">
						<input type='hidden' name='id' value='<?php echo $row["id"]; ?>'>
						<input type='submit' value='Add'>
					</form>
				</div>
				<?php
			}
		?>
	</div>
</body>
</html>
