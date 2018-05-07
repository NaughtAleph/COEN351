<?php
include("auth.php");
require('db.php');
$refine = $_GET["refine"];
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Welcome Home</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="mainpage.js"></script>
	<link rel="stylesheet" href="css/style.css" />
</head>
<body>
	<div class="form">
		<p>Welcome <?php echo $_SESSION['username']; ?>!</p>
		<p>This is secure area.</p>
		<p><a href="">Dashboard</a></p>
		<a href="logout.php">Logout</a>
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
		<?php
			$query = "SELECT * FROM Books";
			// check $_GET for selectors, unsafe at the moment
			if (!empty($refine)) $query .= " WHERE " . array_shift($refine) . "=1";
			foreach ($refine as $category) {
				$query .= " AND " . $category . "=1";
			}
			$result = mysqli_query($con,$query);
			while($row = mysqli_fetch_array($result)) {
				echo "<div class='book-item' onclick='test(this)'>".
						"<div class='book-title'>$row[title]</div>".
						"<div class='book-author'>$row[author]</div>".
						"<div class='book-price'>$$row[price]</div>".
					"</div>";
			}
		?>
	</div>
</body>
</html>
