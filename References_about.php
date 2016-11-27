<?php 
if (session_status() == PHP_SESSION_NONE) 
{
    session_start();
}
$rows=0;
$data=json_decode(file_get_contents('php://input'),TRUE);
foreach ($data as &$value) {
	$picture=$value['prof_picture'];
	if($rows%3==0)
	{
		echo "<div class='row'>";
	}
	$rows=$rows+1;
	echo "<div class='col-sm-4 well'>
			<div class='row'>
				<div class='col-sm-4 text-center well well-sm'>
					<a href='References_data.php?ref_Id=".$value["ref_id"]."'>
						<img src='Uploads/".$picture."' class='img-thumbnail img-responsive center-block' style='width: 100px; height: 100px;' title='".$picture."' alt='".$picture."'>
					</a>
				</div>
			<div class='col-sm-8 well well-sm'>";
		if(isset($_SESSION["priority"]) && $_SESSION["priority"]<3) echo "<button type='button' class='".$value["ref_id"]." close delete'>&cross;</button><button type='button' class='".$value["ref_id"]." close modify'>&#9776;</button>";
			echo "<a href='References_data.php?ref_Id=".$value["ref_id"]."'>
					<blockquote class='text-center'>
						<h4><small>".$value["title"]."</small></h4>
					</blockquote>
						<p class='text-center'>".$value["text"]."</p>
				</a>
			</div>
			</div>
		</div>";
	if($rows%3==0)
	{
		echo "</div>";
	}
}
if($rows%3!=0)
	echo "</div>";
unset($value);
?>
<script>
function show_modify(data,sendurl,showid){
		$.ajax({
			url: sendurl,
			type: 'POST',
			data: JSON.stringify(data),
			contentType: 'application/json',       
			cache: false,            
			processData:false,
			success: function(data){
				$(showid).html(data);
				console.log(data)
			}
		});
		return false;
	};
	function getdata_modify(id,geturl,sendurl,showid){
			var formData=new FormData();
			formData.append('Id',id);
			$.ajax({
				url: geturl,
				type: 'POST',
				data: formData,
				contentType: false,       
				cache: false,            
				processData:false,
				dataType: 'json',
				success: function(data){
					show_modify(data,sendurl,showid);
				}
			});
			return false;
		};
$(document).ready(function(){
	var geturl;
	var sendurl;
	var showid;
	$('.delete').on('click', function(){
		var id=$(this).attr('class');
		id=id.substr(0,id.indexOf(' '));
		var Data=new FormData();
		geturl='references_database.php';
		sendurl='References_about.php';
		showid='#references_about';
		Data.append("ref_id",id);
		$.ajax({
			url: "delete.php",
			type: 'POST',
			data: Data,
			contentType: false,       
			cache: false,            
			processData:false,
			success: function(data){
				getdata_modify(id,geturl,sendurl,showid);
			}
		});
	});
	$('.modify').on('click',function(){
			var formData=new FormData();
			var id=$(this).attr('class');
			geturl='modify_database.php';
			sendurl='ref_modify.php';
			showid='#select';
			id=id.substr(0,id.indexOf(' '));
				getdata_modify(id,geturl,sendurl,showid);
			$('#modify').modal();
			formData.append('Id',id);
			$.ajax({
				url: 'reference_modify.php',
				type: 'POST',
				data: formData,
				contentType: false,       
				cache: false,            
				processData:false
			});
			return false;
		});
});
</script>