<?php	
	session_start();
	$Id=$_SESSION["Id"];
	$file='pic.jpg';
	if(isset($_FILES["file"]["type"]))
		{
			$validextensions = array("jpeg", "jpg", "png",'JPG','PNG','JPEG'); //A t�mogatott form�tumok
			$temporary = explode(".", $_FILES["file"]["name"]);
			$file_extension = end($temporary);//A f�jlform�tum
			if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")) && in_array($file_extension, $validextensions)) //Ha megfelel az adott f�jl f�jlform�tuma
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
		include('connection_database.php');//Kapcsol�d�s az adatb�zishoz
		if(isset($_POST["title"]) && isset($_POST["txt"])) //A c�m, �s a r�vid le�r�s megad�sa k�telez�
		{
			$title=$_POST["title"];
			$txt=$_POST["txt"];
			$query=sprintf("insert into ref(text,user_id,title,prof_picture) value('%s',%d,'%s','%s')",pg_real_escape_string($txt),$Id,$title,pg_real_escape_string($file));
			pg_query($con,$query);
		}
?>