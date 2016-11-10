<?php
if(isset($_POST['ref_id']))
{
	$con=mysqli_connect("localhost", "root","")
	or die("Kapcsolódási Hiba: ".mysqli_error($con));
	mysqli_query($con,'SET NAMES utf8');
	mysqli_select_db($con,"tfs");
	$res=mysqli_query($con,"select * from pictures");
	while($result=mysqli_fetch_array($res))
	{
		if($_POST['ref_id']==$result['References_ref_id'])
		{
			$filename=$result["pic_name"];
			unlink('Uploads/'.$filename);
		}
	}
	$query_data=sprintf('delete from pictures where References_ref_id=%d',$_POST['ref_id']);
	mysqli_query($con,$query_data);
	$res=mysqli_query($con,"select * from ref");
	while($result=mysqli_fetch_array($res))
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
	mysqli_query($con,$query);
}
?>