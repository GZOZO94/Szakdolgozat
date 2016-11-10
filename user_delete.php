<?php
	$con = pg_connect("host=ec2-54-228-213-36.eu-west-1.compute.amazonaws.com port=5432 dbname=d6n8r0rohggpo4 user=jfotvvwtbqcthq password=Yvyw2FjADjwzePR6u5wzpE4Prr");
			if (!$con) {
				echo "Error with connecting.\n";
				exit;
			}
	$res=pg_query($con,"select * from users");
	while($result=pg_fetch_array($res))
	{
		if(isset($_POST['Id']) && $_POST['Id']==$result['Id'])
		{
			$query=sprintf("delete from users where \"Id\"=%d",$_POST['Id']);
			mysqli_query($con,$query);
			if($result['profile_pic']!='Profile.jpg')
			{
				$filename=$result["profile_pic"];
				unlink('Profile/'.$filename);
			}
		}
	}
?>