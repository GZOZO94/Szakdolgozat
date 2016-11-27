<?php
$data=array();
include('connection_database.php');
$query=sprintf("select * from ref where ref_id=%d",$_POST["ref_id"]);
$res=pg_query($con,$query);
while($result2=pg_fetch_array($res))
{
	$Id=$result2['ref_id'];
	$data[$Id]['ref_id']=$Id;
	$data[$Id]['title']=$result2['title'];
	$data[$Id]['text']=$result2['text'];
	$data[$Id]['long_text']=$result2['long_text'];
}
echo json_encode($data);
?>