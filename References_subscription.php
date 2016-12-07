<?php
if (session_status() == PHP_SESSION_NONE) 
{
    session_start();
}
$watch=0;
$null_item=0;

echo "<div class='row well well-sm'>
			<div class='col-sm-5'>
				<div id='Carousel' class='carousel slide' data-ride='carousel'>
					<div class='carousel-inner' role='listbox'>";
$data=json_decode(file_get_contents('php://input'),TRUE);
foreach ($data as &$value) 
{
	if($watch==0)
		{
			echo 
						"<div class='item active picture'>
							<img class='img-thumbnail img-responsive center-block' src='Uploads/".$value["pic_name"]."' alt='".$value["pic_name"]."' style='width:500px;height:400px'>
						</div>";
			$watch=1;
			$null_item=1;
		}
		else
		{
			echo 
						"<div class='item picture'>
							<img class='img-thumbnail img-responsive center-block' src='Uploads/".$value["pic_name"]."' alt='".$value["pic_name"]."' style='width:500px;height:400px'>
						</div>";
		}
 }
 if($null_item==0)
{
	echo "<div class='item active'>
							<img class='img-thumbnail img-responsive center-block' src='Uploads/pic.jpg' alt='pic.jpg' style='width:500px;height:400px'>
						</div>";
						
}
	echo		"</div>
				</div>
				<a class='left carousel-control' href='#Carousel' role='button' data-slide='prev'>
					<span class='glyphicon glyphicon-chevron-left' aria-hidden='true'></span>
					<span class='sr-only'>Previous</span>
				</a>
				<a class='right carousel-control' href='#Carousel' role='button' data-slide='next'>
					<span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span>
					<span class='sr-only'>Next</span>
				</a>
			</div>
			<div class='col-sm-7 well well-lg'>
			<div id='texts'>
			</div>";
?>
<script>
$(document).ready(function(){
	var geturl='references_data_database.php';
	var sendurl='references_data_texts.php';
	var showid='#texts';
	var ref_id=<?php echo $_GET["ref_id"];?>;
	console.log(ref_id);
	get(ref_id,geturl,sendurl,showid);
});
</script>
<?php unset($value);?>