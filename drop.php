<?php	
	session_start();
	$Id=$_SESSION["Id"];
	$file='pic.jpg';
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
							$file=md5(uniqid()).".".$file_extension;
							$targetPath = "Uploads/".$file; 
							move_uploaded_file($sourcePath,$targetPath);
					}
				}
		}
		$con=mysqli_connect("localhost", "root","")
			or die("Kapcsolódási Hiba: ".mysqli_error($con));
		mysqli_query($con,'SET NAMES utf8');
		mysqli_select_db($con,"tfs");
		if(isset($_POST["title"]) && isset($_POST["txt"]))
		{
			$title=$_POST["title"];
			$txt=$_POST["txt"];
			$query=sprintf("insert into ref(text,User_Id,title,prof_picture) value('%s',%d,'%s','%s')",mysql_real_escape_string($txt),$Id,$title,mysql_real_escape_string($file));
			mysqli_query($con,$query);
		}
?>