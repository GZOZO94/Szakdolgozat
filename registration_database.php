<?php
			$eye=0;
			$error= array();
			$data= array();
			include('connection_database.php');
			if(empty($_POST["firstn"]))
				$error['firstn']='Hiányzó keresztnév';
			else
				$firstn=$_POST["firstn"];
			if(empty($_POST["secondn"]))
				$error['secondn']='Hiányzó vezetéknév';
			else
				$secondn=$_POST["secondn"];
			if(empty($_POST["username"]))
				$error['username']='Hiányzó felhasználónév';
			else
				$user=$_POST["username"];
			if(empty($_POST["psw"]))
				$error['psw']='Hiányzó jelszó';
			else
				$psw1=$_POST["psw"];
			if(empty($_POST["pswa"]))
				$error['pswa']='Hiányzó jelszóismétlés';
			else
				$psw2=$_POST["pswa"];
			if(empty($_POST["email"]))
				$error['email']='Hiányzó email';
			else
				$email=$_POST["email"];
			if(empty($_POST["date"]))
				$error['date']='Hiányzó születési dátum';
			else
				$date=$_POST["date"];
			if(empty($_POST["phone"]))
				$error['phone']='Hiányzó telefonszám';
			else
				$phone=$_POST["phone"];
			$prof_pic="Profile.jpg";
			if(empty($error))
			{
				if($psw2==$psw1 )
				{
					$result=pg_query($con,"select * from users");
					while($result0=pg_fetch_array($result))
					{
						if($user==$result0["user_name"])
						{
							$eye=$eye+1;
						}
					}
					if($eye<1)
						{
							if(!preg_match("/^(06[0-9]{9})$/", $phone))
							{
								$error['phone_format']="Helytelen telefonszám formátum!";
							}
							else if (!preg_match("/^[0-9]{4}.(0[1-9]|1[0-2]).(0[1-9]|[1-2][0-9]|3[0-1])$/", $date))
							{
								$error['date_format']="Helytelen dátum formátum!";
							}
							else
							{
								if(isset($_FILES["file"]["type"]))
								{
									$validextensions = array("jpeg", "jpg", "png");
									$temporary = explode(".", $_FILES["file"]["name"]);
									$file_extension = end($temporary);
									if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")) && in_array($file_extension, $validextensions)) 
									{
										if ($_FILES["file"]["error"] > 0)
										{
											echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
										}
										else
										{
											$sourcePath = $_FILES['file']['tmp_name']; 
											$prof_pic=md5(uniqid()).".".$file_extension;
											$targetPath = "Profile/".$prof_pic; 
											move_uploaded_file($sourcePath,$targetPath);
										}
									}
								}
								$query=sprintf("insert into users(user_name,user_password,firstname,lastname,email,phone,birthdate,profile_pic,priority) values('%s','%s','%s','%s','%s','%s','%s','%s',%d)", pg_real_escape_string($user), pg_real_escape_string($psw1), pg_real_escape_string($firstn), pg_real_escape_string($secondn), pg_real_escape_string($email), pg_real_escape_string($phone),pg_real_escape_string($date), pg_real_escape_string($prof_pic),3);
								pgi_query($con,$query);
								$result=pgi_query($con,"select * from user");
								while($result2=pg_fetch_array($result))
								{
									if($result2["user_name"]==$user && $psw1==$result2["user_password"])
									{
										$Id2=$result2["Id"];
									}
								}	
							}
						}
					else 
					{
						$error['username_busy']="Ez a felhasználónév már foglalt";
					}
				}
				else
				{
					$error['password']="Hibás jelszó ismétlés!";
				}
			}
			if(!empty($error))
			{
				$data['success']=false;
				$data['error']=$error;
			}
			else
			{
				$data['success']=true;
				$data['message'] = "Sikeres regisztráció. Kérlek jelentkezz be!";
				$data['error']=$error;
			}
			echo 
				json_encode($data);
?>