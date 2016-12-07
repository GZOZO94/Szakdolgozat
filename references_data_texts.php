<?php
$data=json_decode(file_get_contents('php://input'),TRUE);
foreach ($data as &$value) 
{	
		echo "<blockquote>
				<h4><small>".$value["title"]."</small></h4>
			</blockquote>
			<p align='justify'>";
			if(isset($value["long_text"]) && $value["long_text"]!=NULL)
			{
				$myfile=fopen('Texts/'.$value["long_text"],'r')  or die("Nem lehet megnyitni a fájlt!");
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
									<div class='col-sm-6 pics'>
									</div>
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
		var geturl='ref_pictures_database.php';
		var sendurl='Ref_pictures.php';
		var showid='.pics';
		var ref_id=<?php echo $value['ref_id'];?>;
		get(ref_id,geturl,sendurl,showid);
	$('.pic_button').on('mouseover',function(){
		var imageUrl=$('.main').attr('src');
		$('#main_pic').attr('src',imageUrl);
		return false;
	});
	$('.pic_button').on('click',function(){
		geturl='ref_pictures_database.php';
		sendurl='Ref_pictures.php';
		showid='.pics';
		get(ref_id,geturl,sendurl,showid);
		$('#pictures').modal({backdrop: true});
		return false;
	});
	$('#pictures').on('hidden.bs.modal',function(){
		geturl='ref_pictures_database.php';
		sendurl='References_subscription.php?ref_id='+ref_id;
		showid='#data';
		get(ref_id,geturl,sendurl,showid);
		return false;
	});
});
</script>
<?php unset($value); ?>