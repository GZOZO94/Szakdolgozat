<?php
if (session_status() == PHP_SESSION_NONE) 
	{
		session_start();
	}
$data=array();
include('connection_database.php');
$res=pg_query($con,"select * from users"); 
while($result=pg_fetch_array($res))
{
	if(((isset($_COOKIE["Id"]) && $_COOKIE["Id"]!=$result["Id"]) || (isset($_SESSION["Id"]) && $_SESSION["Id"]!=$result["Id"])) && isset($_SESSION["priority"]) && $_SESSION["priority"]==1)
	{
		$Id=$result['Id'];
		$data[$Id]['Id']=$Id;
		$data[$Id]['firstname']=$result['firstname'];
		$data[$Id]['lastname']=$result['lastname'];
		$data[$Id]['phone']=$result['phone'];
		$data[$Id]['email']=$result['email'];
		$data[$Id]['user_name']=$result['user_name'];
		$data[$Id]['user_password']=$result['user_password'];
		$data[$Id]['profile_pic']=$result['profile_pic'];
		$data[$Id]['birthdate']=$result['birthdate'];
		$data[$Id]['priority']=$result['priority'];
		$data[$Id]['message']=$result['message'];
	}
}
echo json_encode($data);
?>