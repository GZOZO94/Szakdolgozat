<?php
if(isset($_POST['ref_id']))
{
	$data=array();
	include('connection_database.php');
	$query=sprintf("select * from ref where ref_id=%d",$_POST['ref_id']);
	$res=pg_query($con,$query);
	while($result=pg_fetch_array($res))
	{
		if(isset($_POST['title']) && $_POST['title']!=NULL)
		{
			$query=sprintf("update ref set title='%s' where ref_id=%d",pg_real_escape_string($_POST['title']),$_POST['ref_id']);
			pg_query($con,$query);
			$data['title']=$_POST['title'];
		}
		if(isset($_POST['text']) && $_POST['text']!=NULL)
		{
			$query=sprintf("update ref set text='%s' where ref_id=%d",pg_real_escape_string($_POST['text']),$_POST['ref_id']);
			pg_query($con,$query);
			$data['text']=$_POST['text'];
		}
		if(isset($_FILES["file"]["type"]))
		{
			$temporary = explode(".", $_FILES["file"]["name"]);
			$file_extension = end($temporary);
			$sourcePath = $_FILES['file']['tmp_name']; 
			$file=md5(uniqid()).".".$file_extension;
			$targetPath = "Uploads/".$file; 
			move_uploaded_file($sourcePath,$targetPath);
			$query=sprintf("update ref set prof_picture='%s' where ref_id=%d",pg_real_escape_string($file),$_POST['ref_id']);
			pg_query($con,$query);	
			$filename=$result["prof_picture"];
			if($filename!='pic.jpg')
			{
				unlink('Uploads/'.$filename);
			}
			$data['picture']=$file;
		}
	}
	echo json_encode($data);
}
?>