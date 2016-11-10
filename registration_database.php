<?php
			$eye=0;
			$con=mysqli_connect("localhost", "root","")
			or die("Kapcsolódási Hiba: ".mysqli_error($con));
			mysqli_query($con,'SET NAMES utf8');
			mysqli_select_db($con,"tfs");
			$firstn=$_POST["firstn"];
			$secondn=$_POST["secondn"];
			$user=$_POST["user"];
			$psw1=$_POST["psw"];
			$psw2=$_POST["pswa"];
			$email=$_POST["email"];
			$year=$_POST["year"];
			$month=$_POST["month"];
			$day=$_POST["day"];
			$phone=$_POST["phone"];
			$prof_pic="Profile.jpg";
			if($psw2==$psw1)
			{
				$result=mysqli_query($con,"select * from user");
				while($result0=mysqli_fetch_array($result))
				{
					if($user==$result0["user_name"])
					{
						$eye=$eye+1;
					}
				}
				if($eye<1)
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
						$query=sprintf("insert into user(user_name,user_password,firstname,lastname,email,phone,birthdate,profile_pic,priority) values('%s','%s','%s','%s','%s','%s','%d.%d.%d','%s',%d)", mysql_real_escape_string($user), mysql_real_escape_string($psw1), mysql_real_escape_string($firstn), mysql_real_escape_string($secondn), mysql_real_escape_string($email), mysql_real_escape_string($phone),$year,$month,$day, mysql_real_escape_string($prof_pic),3);
						mysqli_query($con,$query);
						$result=mysqli_query($con,"select * from user");
						while($result2=mysqli_fetch_array($result))
						{
							if($result2["user_name"]==$user && $psw1==$result2["user_password"])
							{
								$Id2=$result2["Id"];
							}
						}	
						echo "Sikeres regisztráció. Kérlek jelentkezz be!";
					}
				else 
					echo "Ez a felhasználónév már foglalt. Kérem válasszon egy másikat!";
			}
			else
				echo "Hibás jelszó ismétlés!";
?>