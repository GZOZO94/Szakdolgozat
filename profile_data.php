<?php
	$data=array();
	include('connection_database.php');
	$query=sprintf('select * from user where Id=%d',$_POST['Id']);
	$res=pg_query($con,$query);
	$result=pg_fetch_array($res);
	$data['firstn']=$result['firstname'];
	$data['secondn']=$result['lastname'];
	$data['username']=$result['user_name'];
	$data['phonenumber']=$result['phone'];
	$data['birthdate']=$result['birthdate'];
	$data['password']=$result['user_password'];
	$data['email']=$result['email'];
	$data['picture']=$result['profile_pic'];
	$data['message']=$result['message'];
	echo json_encode($data);
?>