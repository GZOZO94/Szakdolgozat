<?php
$data=array();
include('connection_database.php');
$query=sprintf("select * from pictures where references_ref_id=%d",$_POST['ref_id']);
$res=pg_query($con,$query);
while($result2=pg_fetch_array($res))
{
	$Id=$result2['pic_id'];
	$data[$Id]['pic_id']=$Id;
	$data[$Id]['pic_name']=$result2['pic_name'];
	$data[$Id]['references_ref_id']=$result2['references_ref_id'];
}
echo json_encode($data);
?>