<?php	
	session_start();
	if(isset($_SESSION['Id']))
			$Id=$_SESSION['Id'];
		else
			$Id=$_COOKIE["Id"]; 
	$file='pic.jpg';
	if(isset($_FILES["file"]["type"]))
		{
			$validextensions = array("jpeg", "jpg", "png",'JPG','PNG','JPEG'); 
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
		include('connection_database.php');
		if(isset($_POST["title"]) && isset($_POST["txt"])) 
		{
			$title=$_POST["title"];
			$txt=$_POST["txt"];
			$query=sprintf("insert into ref(text,User_Id,title,prof_picture) values('%s',%d,'%s','%s')",pg_escape_string($txt),$Id,$title,pg_escape_string($file));
			pg_query($con,$query);
		}
?>