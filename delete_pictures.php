<?php
if(isset($_POST['pic_id']))
{
	$con = pg_connect("host=ec2-54-228-213-36.eu-west-1.compute.amazonaws.com port=5432 dbname=d6n8r0rohggpo4 user=jfotvvwtbqcthq password=Yvyw2FjADjwzePR6u5wzpE4Prr");
			if (!$con) {
				echo "Error with connecting.\n";
				exit;
			}
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