<?php
if (session_status() == PHP_SESSION_NONE) 
{
    session_start();
}
$rows=0;
$data=json_decode(file_get_contents('php://input'),TRUE);
foreach ($data as &$value) 
{
			if($rows%4==0)
			{
				echo "<div class='row'>";
			}
			$rows=$rows+1;
			echo "<div class='col-sm-3'>";
			if(isset($_SESSION["priority"]) && $_SESSION["priority"]<3) echo "<button type='button' class='close delete' id='".$value["pic_id"]."'>&cross;</button>";
			echo
					"<img class='img-thumbnail img-responsive center-block main' src='Uploads/".$value["pic_name"]."' alt='".$value["pic_name"]."' title='".$value["pic_name"]."' style='width:100px; height:100px'>
				</div>";
			if($rows%4==0)
			{
				echo "</div>";
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
				var geturl='ref_pictures_database.php';
				var sendurl='Ref_pictures.php';
				var showid='.pics';
				var ref_id=<?php echo $value['References_ref_id'];?>;
				get(ref_id,geturl,sendurl,showid);
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
<?php unset($value) ?>
