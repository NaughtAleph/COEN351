<?php
session_start();
if(!isset($_SESSION["username"])){
	header("Location: login.php");
	exit();
} else {
	header("Location: mainpage.php?".explode("?",$_SERVER["REQUEST_URI"])[1]);
	exit();
}
?>
