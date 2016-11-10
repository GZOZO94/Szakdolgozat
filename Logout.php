<?php
	session_start();
	unset($_SESSION["Id"]);
	unset($_SESSION["Error"]);
	unset($_SESSION["ref_Id"]);
	unset($_SESSION["priority"]);
	header("Location:index.php");
?>