<?php
	session_start();
	$user_name=$_POST["user_name"];
	$user_psw=$_POST["user_psw"];
	$eye=0;
	$con = pg_connect("host=ec2-54-228-213-36.eu-west-1.compute.amazonaws.com port=5432 dbname=d6n8r0rohggpo4 user=jfotvvwtbqcthq password=Yvyw2FjADjwzePR6u5wzpE4Prr");
			if (!$con) {
				echo "Error with connecting.\n";
				exit;
			}
	$result=pg_query($con,"select * from users");
	while($result2=pg_fetch_array($result))
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