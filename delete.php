<?php
if(isset($_POST['ref_id']))
{
	include('connection_database.php');//Kapcsol�d�s az adatb�zishoz
	$query=sprintf("select * from pictures where references_ref_id=%d",$_POST['ref_id']);//Az adott referenci�hoz tartoz� inform�ci�k lek�rdez�se
	$res=pg_query($con,$query);
	while($result=pg_fetch_array($res))//Az adatok v�gigolvas�sa
	{
			$filename=$result["pic_name"];
			if($filename!='pic.jpg')
				unlink('Uploads/'.$filename);//Az adott k�p t�rl�se, ha nem az alap�rtelmezett pic.jpg
	}
	$query_data=sprintf('delete from pictures where references_ref_id=%d',$_POST['ref_id']); //Az adatb�ziselem t�rl�se
	pg_query($con,$query_data);
	$query=sprintf("select * from ref where ref_id=%d",$_POST['ref_id']);
	$res=pg_query($con,$query);
	while($result=pg_fetch_array($res))
	{
		if($result['long_text']!=NULL)//Az adott referenci�hoz tartoz� sz�veges f�jl t�rl�se
		{
			$filename=$result["long_text"];
			unlink('Texts/'.$filename);
		}
		$filename=$result["prof_picture"];
		if($filename!='pic.jpg')
			unlink('Uploads/'.$filename);//Az adott referenci�hoz tartoz� bor�t�k�p t�rl�se
	}
	$query=sprintf('delete from ref where ref_id=%d',$_POST['ref_id']);//Az adott referencia t�rl�se
	pg_query($con,$query);
}
?>