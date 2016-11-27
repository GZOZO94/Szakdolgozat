<?php
$data=array();
include('connection_database.php');
$ref_id=$_POST['Id'];
$query=sprintf('select * from ref where ref_id=%d',$ref_id);
$res=pg_query($con,$query);
while($result=pg_fetch_array($res))
{
	$data['ref_id']=$result['ref_id'];
	$data['title']=$result['title'];
	$data['text']=$result['text'];
	$data['prof_picture']=$result['prof_picture'];
}
echo json_encode($data);
?>