<?php
	session_start();
	$user_name=$_POST["user_name"];
	$user_psw=$_POST["user_psw"];
	$eye=0;
	include('connection_database.php');
	$result=pg_query($con,"select * from users");
	while($result2=pg_fetch_array($result))
		{
			if($result2["user_name"]==$user_name && $user_psw==$result2["user_password"])
				{	
					setcookie("Id",$result2["Id"], time()+3600);
					$_SESSION['Id']=$result2["Id"];
					$eye=1;
				}
		}
	if($eye==0)
	{
		setcookie("Id",'error', time()+3600);
	}
	header("Location:index.php");
?>
