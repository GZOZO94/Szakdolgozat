<?php
	$data=array();
	$con = pg_connect("host=ec2-54-228-213-36.eu-west-1.compute.amazonaws.com port=5432 dbname=d6n8r0rohggpo4 user=jfotvvwtbqcthq password=Yvyw2FjADjwzePR6u5wzpE4Prr");
	$query=sprintf('select * from users where \"Id\"=%d',$_POST['Id']);
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
	echo json_encode($data);
?>