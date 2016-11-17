<?php
	if (session_status() == PHP_SESSION_NONE) 
	{
		session_start();
	}
	$rows=0;
	include('connection_database.php');
	$res=pg_query($con,"select * from pictures");
	while($result=pg_fetch_array($res))
	{
	
		if($_SESSION["ref_Id"]==$result['references_ref_id'])
		{
			if($rows%4==0)
			{
				echo "<div class='row'>";
			}
			$rows=$rows+1;
			echo "<div class='col-sm-3'>";
			if(isset($_SESSION["priority"]) && $_SESSION["priority"]<3) echo "<button type='button' class='close delete' id='".$result["pic_id"]."'>&cross;</button>";
			echo
					"<img class='img-thumbnail img-responsive center-block main' src='Uploads/".$result["pic_name"]."' alt='".$result["pic_name"]."' title='".$result["pic_name"]."' style='width:100px; height:100px'>
				</div>";
			if($rows%4==0)
			{
				echo "</div>";
			}
		}
	}
	if($rows%4!=0)
		echo "</div>";
?>
<script>
$(document).ready(function(){
	$('.delete').on('click', function(){
		var id=$(this).attr('id');
		var Data=new FormData();
		Data.append("pic_id",id);
		$.ajax({
			url: "delete_pictures.php",
			type: 'POST',
			data: Data,
			contentType: false,       
			cache: false,            
			processData:false,
			success: function(data){
				$('.pics').load('Ref_pictures.php');
			}
		});
		return false;
	});
	$('.pics img').on('click',function(){
		var imageUrl=$(this).attr('src');
		var imageAlt=$(this).attr('alt');
		$('#main_pic').attr('src',imageUrl);
		$('#main_pic').attr('alt',imageAlt);
		return false;
	});
	$('.pics img').on('mouseover',function(){
		$(this).css('border','2px red solid');
		return false;
	});
	$('.pics img').on('mouseleave',function(){
		$(this).css('border','none');
		return false;
	});
});
</script>
