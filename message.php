﻿<?php
if(isset($_POST['Id']) && $_POST['Id']!=NULL)
{
	$text="";
	$con = pg_connect("host=ec2-54-228-213-36.eu-west-1.compute.amazonaws.com port=5432 dbname=d6n8r0rohggpo4 user=jfotvvwtbqcthq password=Yvyw2FjADjwzePR6u5wzpE4Prr");
			if (!$con) {
				echo "Error with connecting.\n";
				exit;
			}
	$query=sprintf('select * from users where "Id"=%d',$_POST['Id']);
	$res=pg_query($con,$query);
	$result=pg_fetch_array($res);
	if(isset($_POST['firstname']) && $_POST['firstname']!=NULL)
			{
				$text=$text."\nKeresztnév: ".$_POST['firstname'];
			}
	if(isset($_POST['lastname']) && $_POST['lastname']!=NULL)
			{
				$text=$text."\nVezetéknév: ".$_POST['lastname'];
			}
	if(isset($_POST['username']) && $_POST['username']!=NULL)
			{
				$text=$text."\nFelhasználónév: ".$_POST['username'];
			}
	if(isset($_POST['password']) && $_POST['password']!=NULL)
			{
				$text=$text."\nJelszó: ".$_POST['password'];
			}
	if(isset($_POST['email']) && $_POST['email']!=NULL)
			{
				$text=$text."\nEmail: ".$_POST['email'];
			}
	if(isset($_POST['phonenumber']) && $_POST['phonenumber']!=NULL)
			{
				$text=$text."\nTelefonszám: ".$_POST['phonenumber'];
			}
	if(isset($_POST['priority']) && $_POST['priority']!=NULL)
			{
				$text=$text."\nPrioritás: ".$_POST['priority'];
			}
	if(isset($_POST['birthdate']) && $_POST['birthdate']!=NULL)
			{
				$text=$text."\nSzületésnap: ".$_POST['birthdate'];
			}
	if($text!="")
	{
		$query=sprintf("update users set message='%s' where \"Id\"=%d",pg_real_escape_string($text),$_POST['Id']);
		pg_query($con,$query);
	}
	echo $text;
}	
?>