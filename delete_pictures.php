<?php
if(isset($_POST['pic_id']))
{
	include('connection_database.php');//Kapcsolódás az adatbázishoz
	$query=sprintf('select * from pictures where pic_id=%d',$_POST['pic_id']);
	$res=pg_query($con,$query);
	while($result=pg_fetch_array($res))
	{
			$filename=$result["pic_name"];
			if($filename!='pic.jpg')
				unlink('Uploads/'.$filename);//Az adott referenciához tartoó kép törlése
	}
	$query_data=sprintf('delete from pictures where pic_id=%d',$_POST['pic_id']);//A kép törlése az adatbázisból is
	pg_query($con,$query_data);
	echo "Sikeres törlés";
}
?>