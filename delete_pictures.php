<?php
if(isset($_POST['pic_id']))
{
	include('connection_database.php');
	$query=sprintf('select * from pictures where pic_id=%d',$_POST['pic_id']);
	$res=pg_query($con,$query);
	while($result=pg_fetch_array($res))
	{
			$filename=$result["pic_name"];
			if($filename!='pic.jpg')
				unlink('Uploads/'.$filename);
	}
	$query_data=sprintf('delete from pictures where pic_id=%d',$_POST['pic_id']);
	pg_query($con,$query_data);
	echo "Sikeres törlés";
}
?>