<?php
if(isset($_POST['pic_id']))
{
	include('connection_database.php');//Kapcsol�d�s az adatb�zishoz
	$query=sprintf('select * from pictures where pic_id=%d',$_POST['pic_id']);
	$res=pg_query($con,$query);
	while($result=pg_fetch_array($res))
	{
			$filename=$result["pic_name"];
			if($filename!='pic.jpg')
				unlink('Uploads/'.$filename);//Az adott referenci�hoz tarto� k�p t�rl�se
	}
	$query_data=sprintf('delete from pictures where pic_id=%d',$_POST['pic_id']);//A k�p t�rl�se az adatb�zisb�l is
	pg_query($con,$query_data);
	echo "Sikeres t�rl�s";
}
?>