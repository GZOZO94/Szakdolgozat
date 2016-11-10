<?php
	session_start();
	$user_name=$_POST["user_name"];
	$user_psw=$_POST["user_psw"];
	$eye=0;
	$con=mysqli_connect("localhost", "root","")
	or die("Kapcsolódási Hiba: ".mysqli_error($con));
	mysqli_query($con,'SET NAMES utf8');
	mysqli_select_db($con,"tfs");
	$result=mysqli_query($con,"select * from user");
	while($result2=mysqli_fetch_array($result))
		{
			if($result2["user_name"]==$user_name && $user_psw==$result2["user_password"])
				{	
					$_SESSION['Id']=$result2["Id"];
					$eye=1;
					$_SESSION["priority"]=$result2["priority"];
					$_SESSION["Error"]=false;
					$_SESSION["prof_pic"]=$result2["profile_pic"];
				}
		}
	if($eye==0)
	{
		$_SESSION["Error"]=true;
		$_SESSION["Id"]=NULL;
	}
	header("Location:index.php");
?>