<?php
if(isset($_POST['ref_id']))
{
	include('connection_database.php');
	$query=sprintf("select * from pictures where references_ref_id=%d",$_POST['ref_id']);
	$res=pg_query($con,$query);
	while($result=pg_fetch_array($res))
	{
			$filename=$result["pic_name"];
			if($filename!='pic.jpg')
				unlink('Uploads/'.$filename);
	}
	$query_data=sprintf('delete from pictures where references_ref_id=%d',$_POST['ref_id']); 
	pg_query($con,$query_data);
	$query=sprintf("select * from ref where ref_id=%d",$_POST['ref_id']);
	$res=pg_query($con,$query);
	while($result=pg_fetch_array($res))
	{
		if($result['long_text']!=NULL)
		{
			$filename=$result["long_text"];
			unlink('Texts/'.$filename);
		}
		$filename=$result["prof_picture"];
		if($filename!='pic.jpg')
			unlink('Uploads/'.$filename);
	}
	$query=sprintf('delete from ref where ref_id=%d',$_POST['ref_id']);
	pg_query($con,$query);
}
?>