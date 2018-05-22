<?php
include("auth.php");
require('db.php');
session_start();
$id = mysqli_real_escape_string($con, htmlspecialchars($_POST["id"]));
$account = $_SESSION["id"];

/* PERSISTENT XSS VULNERABILITY */
//$review = mysqli_real_escape_string($con,htmlspecialchars($_POST["review"]));
$review = $_POST["review"];

$query = "INSERT into Reviews (bookid,review,accountid,time) VALUES ('$id','$review','$account',".time().")";

mysqli_query($con, $query);
echo $query;

header("Location: item.php?id=$id");
?>
