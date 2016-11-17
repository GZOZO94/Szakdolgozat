<?php
if(isset($_POST['ref_id']))
{
	include('connection_database.php');
	$res=pg_query($con,"select * from pictures");
	while($result=pg_fetch_array($res))
	{
		if($_POST['ref_id']==$result['references_ref_id'])
		{
			$filename=$result["pic_name"];
			unlink('Uploads/'.$filename);
		}
	}
	$query_data=sprintf('delete from pictures where references_ref_id=%d',$_POST['ref_id']);
	pg_query($con,$query_data);
	$res=pg_query($con,"select * from ref");
	while($result=pg_fetch_array($res))
	{
		if($_POST['ref_id']==$result['ref_id'])
		{
			if($result['long_text']!=NULL)
			{
				$filename=$result["long_text"];
				unlink('Texts/'.$filename);
			}
			$filename=$result["prof_picture"];
			unlink('Uploads/'.$filename);
		}
	}
	$query=sprintf('delete from ref where ref_id=%d',$_POST['ref_id']);
	pg_query($con,$query);
}
?>