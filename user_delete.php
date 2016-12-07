<?php
if(isset($_POST['Id']))
{
	include('connection_database.php');
	$query=sprintf("select * from users where \"Id\"=%d",$_POST['Id']);
	$res=pg_query($con,$query);
	while($result=pg_fetch_array($res))
	{
			$query=sprintf("select * from ref where user_id=%d",$_POST['Id']);
			$res2=pg_query($con,$query);
			while($result2=pg_fetch_array($res2))
			{
				$query=sprintf("select * from pictures where references_ref_id=%d",$result2['ref_id']);
				$res3=pg_query($con,$query);
				while($result3=pg_fetch_array($res3))
				{
					$filename=$result3["pic_name"];
					if($filename!='pic.jpg')
						unlink('Uploads/'.$filename);
				}
				$query_data=sprintf('delete from pictures where references_ref_id=%d',$result2['ref_id']);
				pg_query($con,$query_data);
				if($result2['long_text']!=NULL)
				{
					$filename=$result2["long_text"];
					unlink('Texts/'.$filename);
				}
				$filename=$result3["prof_picture"];
				if($filename!='pic.jpg')
					unlink('Uploads/'.$filename);
				$query=sprintf("delete from ref where ref_id=%d",$result2['ref_id']);
				pg_query($con,$query);		
			}
			if($result['profile_pic']!='Profile.jpg')
			{
				$filename=$result["profile_pic"];
				unlink('Profile/'.$filename);
			}
			$query=sprintf("delete from user where \"Id\"=%d",$_POST['Id']);
			pg_query($con,$query);
	}
}
?>