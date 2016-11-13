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
			$query=sprintf("select * from ref where User_Id=%d",$_POST['Id']);
			$res2=pg_query($con,$query);
			while($result2=pg_fetch_array($res2))
			{
				$query=sprintf("select * from pictures where References_ref_id=%d",$result2['ref_id']);
				$res3=pg_query($con,$query);
				while($result3=pg_fetch_array($res3))
				{
					$filename=$result3["prof_picture"];
					unlink('Uploads/'.$filename);
				}
				$query_data=sprintf('delete from pictures where References_ref_id=%d',$result2['ref_id']);
				pg_query($con,$query_data);
				$query=sprintf("delete from ref where ref_id=%d",$result2['ref_id']);
				pg_query($con,$query);		
				if($result2['long_text']!=NULL)
				{
					$filename=$result2["long_text"];
					unlink('Texts/'.$filename);
				}
			}
			$query=sprintf("delete from user where Id=%d",$_POST['Id']);
			pg_query($con,$query);
			if($result['profile_pic']!='Profile.jpg')
			{
				$filename=$result["profile_pic"];
				unlink('Profile/'.$filename);
			}
		}
	}
?>