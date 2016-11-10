<?php
if (session_status() == PHP_SESSION_NONE) 
	{
		session_start();
	}
$watch=0;
$null_item=0;
$con=mysqli_connect("localhost", "root","")
	or die("Kapcsolódási Hiba: ".mysqli_error($con));
mysqli_query($con,'SET NAMES utf8');
mysqli_select_db($con,"tfs");
$res=mysqli_query($con,"select * from pictures");
echo "<div class='row well well-sm'>
			<div class='col-sm-5'>
				<div id='Carousel' class='carousel slide' data-ride='carousel'>
					<div class='carousel-inner' role='listbox'>";
while($result=mysqli_fetch_array($res))
{
	if($_SESSION["ref_Id"]==$result['References_ref_id'])
	{
		if($watch==0)
		{
			echo 
						"<div class='item active picture'>
							<img class='img-thumbnail img-responsive center-block' src='Uploads/".$result["pic_name"]."' alt='".$result["pic_name"]."' style='width:500px;height:400px'>
						</div>";
			$watch=1;
			$null_item=1;
		}
		else
		{
			echo 
						"<div class='item picture'>
							<img class='img-thumbnail img-responsive center-block' src='Uploads/".$result["pic_name"]."' alt='".$result["pic_name"]."' style='width:500px;height:400px'>
						</div>";
		}
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
			<div class='col-sm-7 well well-lg'>";
$query=sprintf("select * from ref where ref_Id=%d",$_SESSION["ref_Id"]);
$res=mysqli_query($con,$query);
while($result2=mysqli_fetch_array($res))
	{		
		echo "<blockquote>
				<h4><small>".$result2["title"]."</small></h4>
			</blockquote>
			<p align='justify'>";
			if(isset($result2["long_text"]) && $result2["long_text"]!=NULL)
			{
				$myfile=fopen('Texts/'.$result2["long_text"],'r')  or die("Nem lehet megnyitni a fájlt!");
				while(!feof($myfile)) {	
					echo fgets($myfile)."<br />";
				} 
				fclose($myfile);
			}
			echo "</p>";
			}
			echo "<button type='button' class='btn btn-default pic_button'>Képek</button>
				<div id='pictures' class='modal fade' role='dialog'>
					<div class='modal-dialog modal-lg'>
						<div class='modal-content'>
							<div class='modal-header'>
								<button type='button' class='close modal_close' data-dismiss='modal'>&cross;</button>
								<h4 class='modal-title'>Feltöltött képek</h4>
							</div>
							<div class='modal-body'>
								<div class='row'>
									<div class='col-sm-6 pics'>";
								include('Ref_pictures.php');
			echo					"</div>
									<div class='col-sm-6'>
										<img id='main_pic' class='img img-responsive img-thumbnail center-block' src='Uploads/Pic.jpg' alt='Pic.jpg' />
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>";
?>
<script>
$(document).ready(function(){
	$('.pic_button').on('mouseover',function(){
		var imageUrl=$('.main').attr('src');
		$('#main_pic').attr('src',imageUrl);
		return false;
	});
	$('.pic_button').on('click',function(){
		$('#pictures').modal({backdrop: true});
		return false;
	});
	$('#pictures').on('hidden.bs.modal',function(){
		$("#data").load("References_subscription.php");
			return false;
	});
});
</script>