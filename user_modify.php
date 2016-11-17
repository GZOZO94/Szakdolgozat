<?php
	$data=array();
	$error=array();
include('connection_database.php');
	$res=pg_query($con,"select * from users");
	while($result=pg_fetch_array($res))
	{
		if(isset($_POST['Id']) && $_POST['Id']==$result['Id'])
		{
			if(isset($_FILES["file"]["type"]))
			{
				$temporary = explode(".", $_FILES["file"]["name"]);
				$file_extension = end($temporary);
				$sourcePath = $_FILES['file']['tmp_name']; 
				$file=md5(uniqid()).".".$file_extension;
				$targetPath = "Profile/".$file; 
				move_uploaded_file($sourcePath,$targetPath);
				$query=sprintf("update users set profile_pic='%s' where \"Id\"=%d",pg_real_escape_string($file),$_POST['Id']);
				pg_query($con,$query);	
				$filename=$result["profile_pic"];
				if($filename!='Profile.jpg')
				{
					unlink('Profile/'.$filename);
					
				}
				$data['pic']=$file;
			}
			if(isset($_POST['firstname']) && $_POST['firstname']!=NULL)
			{
				$query=sprintf("update users set firstname='%s' where \"Id\"=%d",pg_real_escape_string($_POST['firstname']),$_POST['Id']);
				pg_query($con,$query);
				$data['firstname']=$_POST['firstname'];
			}
			if(isset($_POST['lastname']) && $_POST['lastname']!=NULL)
			{
				$query=sprintf("update users set lastname='%s' where \"Id\"=%d",pg_real_escape_string($_POST['lastname']),$_POST['Id']);
				pg_query($con,$query);
				$data['lastname']=$_POST['lastname'];
			}
			if(isset($_POST['username']) && $_POST['username']!=NULL)
			{
				$eye=0;
				$result2=pg_query($con,"select * from user");
				while($result3=pg_fetch_array($result2))
				{
					if($result3['user_name']==$_POST['username'] && $_POST['Id']!=$result3['Id'])
						$eye=1;
				}
				if($eye==0)
				{
					$query=sprintf("update users set user_name='%s' where \"Id\"=%d",pg_real_escape_string($_POST['username']),$_POST['Id']);
					pg_query($con,$query);
					$data['username']=$_POST['username'];
				}
				else 
					$error['username']='Username error';
			}
			if(isset($_POST['password']) && $_POST['password']!=NULL)
			{
				$query=sprintf("update users set user_password='%s' where \"Id\"=%d",pg_real_escape_string($_POST['password']),$_POST['Id']);
				pg_query($con,$query);
				$data['password']=$_POST['password'];
			}
			if(isset($_POST['email']) && $_POST['email']!=NULL)
			{
				$query=sprintf("update users set email='%s' where \"Id\"=%d",pg_real_escape_string($_POST['email']),$_POST['Id']);
				pg_query($con,$query);
				$data['email']=$_POST['email'];
			}
			if(isset($_POST['phonenumber']) && $_POST['phonenumber']!=NULL)
			{
				if (preg_match("/^(06[0-9]{9})$/", $_POST['phonenumber']))
				{
					$query=sprintf("update users set phone='%s' where \"Id\"=%d",pg_real_escape_string($_POST['phonenumber']),$_POST['Id']);
					pg_query($con,$query);
					$data['phonenumber']=$_POST['phonenumber'];
				}
				else{
					$error['phone']='Phone error';
				}
			}
			if(isset($_POST['priority']) && $_POST['priority']!=NULL)
			{
				if(0<$_POST['priority'] && $_POST['priority']<4)
				{
					$query=sprintf("update users set priority=%d where \"Id\"=%d",pg_real_escape_string($_POST['priority']),$_POST['Id']);
					pg_query($con,$query);
					$data['priority']=$_POST['priority'];
				}
				else
						$error['priority']="Priority error";
			}
			if(isset($_POST['birthdate']) && $_POST['birthdate']!=NULL)
			{
				if (preg_match("/^[0-9]{4}.(0[1-9]|1[0-2]).(0[1-9]|[1-2][0-9]|3[0-1])$/", $_POST['birthdate']))
				{
					$query=sprintf("update users set birthdate='%s' where \"Id\"=%d",pg_real_escape_string($_POST['birthdate']),$_POST['Id']);
					pg_query($con,$query);
					$data['birthdate']=$_POST['birthdate'];
				}
				else{
					$error['date']='Date error';
				}
			}
			if(isset($_POST['message']))
			{
				$query=sprintf("update users set message='%s' where \"Id\"=%d",pg_real_escape_string($_POST['message']),$_POST['Id']);
				pg_query($con,$query);
				$data['message']=$_POST['message'];
			}
		}
	}
	$data['error']=$error;
	echo json_encode($data);
?>