<?php
session_start();
$ref_Id=$_GET["ref_Id"];
include('connection_database.php');
if(isset($_FILES['image']['tmp_name']) && $_POST["txt"]!=NULL)
	{
		$num_files=count($_FILES['image']['tmp_name']);
		$text=$_POST["txt"];
		for($i=0; $i<$num_files; $i++)
		{
			$temporary = explode(".", $_FILES["image"]["name"][$i]);
			$file_extension = end($temporary);
			$sourcePath = $_FILES['image']['tmp_name'][$i];
			$file=md5(uniqid(rand(), true)).".".$file_extension;
			$targetPath = "Uploads/".$file;
			move_uploaded_file($sourcePath,$targetPath);
			$query=sprintf("insert into pictures(pic_name,References_ref_id) values('%s',%d)",pg_escape_string($file),$ref_Id);
			pg_query($con,$query);
		}
		$textfile=md5(uniqid()).".txt";
		$myfile=fopen('Texts/'.$textfile,'w')  or die("Nem lehet megnyitni a fájlt!");
		fwrite($myfile, $text);
		fclose($myfile);
		$res=pg_query($con,"select * from ref");
		while($result=pg_fetch_array($res))
		{
			if($ref_Id==$result["ref_id"])
			{
				if($result['long_text']!=NULL)
				{
					$filename=$result["long_text"];
					unlink('Texts/'.$filename);
				}
			}
		}
		$querys=sprintf("update ref set long_text='%s' where ref_id='%d'",pg_escape_string($textfile),$ref_Id);
		pg_query($con,$querys);
		echo "Sikeres kép, és szöveg feltöltés!";
	}
else if(!isset($_FILES['image']['tmp_name']) && $_POST["txt"]!=NULL)
	{
		$text=$_POST["txt"];
		$textfile=md5(uniqid()).".txt";
		$myfile=fopen('Texts/'.$textfile,'w')  or die("Nem lehet megnyitni a fájlt!");
		fwrite($myfile, $text);
		fclose($myfile);
		$res=pg_query($con,"select * from ref");
		while($result=pg_fetch_array($res))
		{
			if($ref_Id==$result["ref_id"])
			{
				if($result['long_text']!=NULL)
				{
					$filename=$result["long_text"];
					unlink('Texts/'.$filename);
				}
			}
		}
		$querys=sprintf("update ref set long_text='%s' where ref_id='%d'",pg_escape_string($textfile),$ref_Id);
		pg_query($con,$querys);
		echo "Sikeres szöveg feltöltés!";
	}
else if(isset($_FILES['image']['tmp_name']))
	{
		$num_files=count($_FILES['image']['tmp_name']);
		for($i=0; $i<$num_files; $i++)
		{
			$temporary = explode(".", $_FILES["image"]["name"][$i]);
			$file_extension = end($temporary);
			$sourcePath = $_FILES['image']['tmp_name'][$i];
			$file=md5(uniqid(rand(), true)).".".$file_extension;
			$targetPath = "Uploads/".$file;
			move_uploaded_file($sourcePath,$targetPath);
			$query=sprintf("insert into pictures(pic_name,References_ref_id) values('%s',%d)",pg_escape_string($file),$ref_Id);
			pg_query($con,$query);
		}
		echo "Sikeres képfeltöltés!";
	}
else
	{
		echo "Se képet, se szöveget nem töltöttél fel!";
	}
?>