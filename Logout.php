<?php
	session_start();
	setcookie("Id", "", time()-3600);
	unset($_SESSION['Id']);
	unset($_SESSION["priority"]);
	header("Location:index.php");
?>