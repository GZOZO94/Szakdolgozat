<?php
if(isset($_POST['pic_id']))
{
	$con=mysqli_connect("localhost", "root","")
	or die("Kapcsolódási Hiba: ".mysqli_error($con));
	mysqli_query($con,'SET NAMES utf8');
	mysqli_select_db($con,"tfs");
	$res=mysqli_query($con,"select * from pictures");
	while($result=mysqli_fetch_array($res))
	{
		if($_POST['pic_id']==$result['pic_id'])
		{
			$filename=$result["pic_name"];
			unlink('Uploads/'.$filename);
		}
	}
	$query_data=sprintf('delete from pictures where pic_id=%d',$_POST['pic_id']);
	mysqli_query($con,$query_data);
}
?>