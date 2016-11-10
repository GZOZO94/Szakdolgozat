<?php
$con=mysqli_connect("localhost", "root","")
	or die("Kapcsolódási Hiba: ".mysqli_error($con));
	mysqli_query($con,'SET NAMES utf8');
	mysqli_select_db($con,"tfs");
	$res=mysqli_query($con,"select * from user");
	while($result=mysqli_fetch_array($res))
	{
		if(isset($_POST['Id']) && $_POST['Id']==$result['Id'])
		{
			$query=sprintf("delete from user where Id=%d",$_POST['Id']);
			mysqli_query($con,$query);
			if($result['profile_pic']!='Profile.jpg')
			{
				$filename=$result["profile_pic"];
				unlink('Profile/'.$filename);
			}
		}
	}
?>