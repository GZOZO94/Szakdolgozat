<?php
if(isset($_POST['pic_id']))
{
	include('connection_database.php');
	$res=pg_query($con,"select * from pictures");
	while($result=pg_fetch_array($res))
	{
		if($_POST['pic_id']==$result['pic_id'])
		{
			$filename=$result["pic_name"];
			unlink('Uploads/'.$filename);
		}
	}
	$query_data=sprintf('delete from pictures where pic_id=%d',$_POST['pic_id']);
	pg_query($con,$query_data);
}
?>