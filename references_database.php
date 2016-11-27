<?php
$data=array();
include('connection_database.php');
$res=pg_query($con,"select * from ref");
while($result2=pg_fetch_array($res))
{
	$Id=$result2['ref_id'];
	$data[$Id]['ref_id']=$Id;
	$data[$Id]['title']=$result2['title'];
	$data[$Id]['text']=$result2['text'];
	$data[$Id]['prof_picture']=$result2['prof_picture'];
}
echo json_encode($data);
?>