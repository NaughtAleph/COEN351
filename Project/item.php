<?php
include("auth.php");
require('db.php');
$id = $_GET["id"];

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
					dirname($_SERVER["REQUEST_URI"]),$_SERVER['host'], true);
		} else {
			$cart = array($id => $num);
			setcookie("cart",json_encode($cart),time() + (86400 * 30),
					dirname($_SERVER["REQUEST_URI"]),$_SERVER['host'], true);
			}
	}
}
$id = mysqli_real_escape_string($con,stripslashes($id));
$result = mysqli_query($con,"SELECT * FROM Books WHERE id='$id'");
$result = mysqli_fetch_assoc($result);
// if result is invalid, delete cookie, destroy session, and send back to login
$reviews = mysqli_query($con,"SELECT * FROM Reviews WHERE bookid=$id");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $result["title"]; ?></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="js/mainpage.js"></script>
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/item.css" />
</head>
<body>
	<div class="form">
		<p><a href="index.php">Back</a></p>
		<p><a href="logout.php">Logout</a></p>
		<p><a href="checkout.php">Checkout</a></p>
	</div>
	<div class="book-item">
		<div class="book-title">
			<?php echo $result["title"]; ?>
		</div>
		<div class="book-author">
			<?php echo $result["author"]; ?>
		</div>
		<div class="book-price">
			<?php echo $result["price"]; ?>
		</div>
		<form class='add-to-cart' method="post" action="<?php $_SERVER["REQUEST_URI"]; ?>">
			<input type='number' class='input-num' name='number' min="0">
			<input type='hidden' name='id' value='<?php echo $result["id"]; ?>'>
			<input type='submit' value='Add'>
		</form>
	</div>
	<div>
		<?php
			while($row = mysqli_fetch_assoc($reviews)) {
				$query = "SELECT firstname,lastname FROM Accounts WHERE id=$row[accountid]";
				$name_result = mysqli_fetch_assoc(mysqli_query($con, $query));
				$name = "&ndash; " . $name_result["firstname"] . " " . $name_result["lastname"];
				?>
				<div class="review">
					<div class="rev-text"><?php echo $row["review"]; ?></div>
					<div class="rev-author"><?php echo $name; ?> </div>
				</div>
			<?php }
		?>
	</div>
	<form method="post" action="review.php">
		<textarea id="textbox" name="review" class="review" placeholder="Add a review"></textarea>
		<input type="hidden" name="id" value="<?php echo $id; ?>" >
		<input type='submit' class='right' value='Submit'>
	</form>
</body>
</html>
