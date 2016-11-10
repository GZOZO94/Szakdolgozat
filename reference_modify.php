<?php
	$con=mysqli_connect("localhost", "root","")
	or die("Kapcsolódási Hiba: ".mysqli_error($con));
	mysqli_query($con,'SET NAMES utf8');
	mysqli_select_db($con,"tfs");
	$res=mysqli_query($con,"select * from ref");
	while($result=mysqli_fetch_array($res))
	{
		if(isset($_POST['ref_id']) && $_POST['ref_id']==$result['ref_id'])
		{
			if(isset($_POST['title']) && $_POST['title']!=NULL)
			{
				$query=sprintf("update ref set title='%s' where ref_id=%d",mysql_real_escape_string($_POST['title']),$_POST['ref_id']);
				mysqli_query($con,$query);
				echo $_POST['title'];
			}
			if(isset($_POST['text']) && $_POST['text']!=NULL)
			{
				$query=sprintf("update ref set text='%s' where ref_id=%d",mysql_real_escape_string($_POST['text']),$_POST['ref_id']);
				mysqli_query($con,$query);
				echo $_POST['text'];
			}
			if(isset($_FILES["file"]["type"]))
			{
				$temporary = explode(".", $_FILES["file"]["name"]);
				$file_extension = end($temporary);
				$sourcePath = $_FILES['file']['tmp_name']; 
				$file=md5(uniqid()).".".$file_extension;
				$targetPath = "Uploads/".$file; 
				move_uploaded_file($sourcePath,$targetPath);
				$query=sprintf("update ref set prof_picture='%s' where ref_id=%d",mysql_real_escape_string($file),$_POST['ref_id']);
				mysqli_query($con,$query);	
				$filename=$result["prof_picture"];
				if($filename!='pic.jpg')
				{
					unlink('Uploads/'.$filename);
					
				}
			}
		}
	}
?>