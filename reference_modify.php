<?php
	$con = pg_connect("host=ec2-54-228-213-36.eu-west-1.compute.amazonaws.com port=5432 dbname=d6n8r0rohggpo4 user=jfotvvwtbqcthq password=Yvyw2FjADjwzePR6u5wzpE4Prr");
			if (!$con) {
				echo "Error with connecting.\n";
				exit;
			}
	$res=pg_query($con,"select * from ref");
	while($result=pg_fetch_array($res))
	{
		if(isset($_POST['ref_id']) && $_POST['ref_id']==$result['ref_id'])
		{
			if(isset($_POST['title']) && $_POST['title']!=NULL)
			{
				$query=sprintf("update ref set title='%s' where ref_id=%d",pg_escape_string($_POST['title']),$_POST['ref_id']);
				pg_query($con,$query);
				echo $_POST['title'];
			}
			if(isset($_POST['text']) && $_POST['text']!=NULL)
			{
				$query=sprintf("update ref set text='%s' where ref_id=%d",pg_escape_string($_POST['text']),$_POST['ref_id']);
				pg_query($con,$query);
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
				$query=sprintf("update ref set prof_picture='%s' where ref_id=%d",pg_escape_string($file),$_POST['ref_id']);
				pg_query($con,$query);	
				$filename=$result["prof_picture"];
				if($filename!='pic.jpg')
				{
					unlink('Uploads/'.$filename);
					
				}
			}
		}
	}
?>