<!DOCTYPE html>
<html>
	<head>
		<title>Pay for shit</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="checkout.js"></script>
	</head>
	<body>
		<!--Get items from cart-->
		<form type="POST" action="checkout.php">
			<input id="cc" name="cc" type="text" placeholder="Credit Card Number" maxlength=16>
			<br>
			<input id="name" name="name" type="text" placeholder="Cardholder Name">
			<br>
			<!-- change to select tag (dropdown) -->
			<select id="expireMonth" name="expireMonth"></select>
			<select id="expireYear" name="expireYear"></select>
			<!--<input id="expire" name="expire" type="text" placeholder="Expiration Date">-->
			<br>
			<input id="cvc" name="cvc" type="text" placeholder="CVC" maxlength=3>
			<br>
			<input type="submit" value="Submit">
		</form>
	</body>
</html>
