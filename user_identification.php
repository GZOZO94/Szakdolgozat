<?php
	session_start();
	$eye=0;
	$message=0;
	if(isset($_COOKIE["Id"]) || isset($_SESSION["Id"]))
	{
		if(isset($_SESSION['Id']))
			$Id=$_SESSION['Id'];
		else
			$Id=$_COOKIE["Id"]; 
		$eye=1;
		include('connection_database.php');
		$query=sprintf("select profile_pic from users where \"Id\"=%d",$Id);
		$result=pg_query($con,$query);
		$result2=pg_fetch_array($result);
		$profile_picture=$result2["profile_pic"];
		$query=sprintf("select message from users where \"Id\"=%d",$Id);
		$result=pg_query($con,$query);
		$result2=pg_fetch_array($result);
		if($result2['message']!=NULL && $result2['message']!='0')
		{
				$message=1;
		}
		else
			$message=0;
			
		$query=sprintf("select priority from users where \"Id\"=%d",$Id);
		$result=pg_query($con,$query);
		$result2=pg_fetch_array($result);
		$_SESSION['priority']=$result2['priority'];
	}
	else
		$eye=0;
?>
