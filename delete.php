<?php
if(isset($_POST['ref_id']))
{
	include('connection_database.php');//Kapcsolódás az adatbázishoz
	$query=sprintf("select * from pictures where references_ref_id=%d",$_POST['ref_id']);//Az adott referenciához tartozó információk lekérdezése
	$res=pg_query($con,$query);
	while($result=pg_fetch_array($res))//Az adatok végigolvasása
	{
			$filename=$result["pic_name"];
			if($filename!='pic.jpg')
				unlink('Uploads/'.$filename);//Az adott kép törlése, ha nem az alapértelmezett pic.jpg
	}
	$query_data=sprintf('delete from pictures where references_ref_id=%d',$_POST['ref_id']); //Az adatbáziselem törlése
	pg_query($con,$query_data);
	$query=sprintf("select * from ref where ref_id=%d",$_POST['ref_id']);
	$res=pg_query($con,$query);
	while($result=pg_fetch_array($res))
	{
		if($result['long_text']!=NULL)//Az adott referenciához tartozó szöveges fájl törlése
		{
			$filename=$result["long_text"];
			unlink('Texts/'.$filename);
		}
		$filename=$result["prof_picture"];
		if($filename!='pic.jpg')
			unlink('Uploads/'.$filename);//Az adott referenciához tartozó borítókép törlése
	}
	$query=sprintf('delete from ref where ref_id=%d',$_POST['ref_id']);//Az adott referencia törlése
	pg_query($con,$query);
}
?>