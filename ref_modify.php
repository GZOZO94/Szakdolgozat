<?php
$con = pg_connect("host=ec2-54-228-213-36.eu-west-1.compute.amazonaws.com port=5432 dbname=d6n8r0rohggpo4 user=jfotvvwtbqcthq password=Yvyw2FjADjwzePR6u5wzpE4Prr");
			if (!$con) {
				echo "Error with connecting.\n";
				exit;
			}
$res=pg_query($con,"select * from ref");
while($result=pg_fetch_array($res))
{
	if(isset($_POST['Id']) && $_POST['Id']==$result['ref_id'])
	{
		echo "<div class='row'>
				<div class='col-sm-4'>
					<div class='panel panel-primary'>
							<div class='panel-heading'></div>
					<div class='panel-body'>
						<ul class='list-group'>
							<li class='list-group-item'><p>Cím: <span>".$result["title"]."</span><button type='button' class='close title'>&#9776;</button></p></li>
							<li class='list-group-item'><form class='".$result["ref_id"]."'><div class='form-group'><label class='sr-only'>Cím</label><input class='form-control' name='title' required/><button type='button' class='close reset'>&times;</button><button type='submit' class='close done'>&#10004</button></div></form></li>
							<li class='list-group-item'><p>Bejegyzés: <span>".$result["text"]."</span><button type='button' class='close text'>&#9776;</button></p></li>
							<li class='list-group-item'><form class='".$result["ref_id"]."'><div class='form-group'><label class='sr-only'>Hozzászólás</label><input class='form-control' name='text' required/><button type='button' class='close reset'>&times;</button><button type='submit' class='close done'>&#10004</button></div></form></li>
						</ul>
					</div>
					</div>
				</div>
				<div class='col-sm-8'>
					<div class='modify_picture'>
						<img src='Uploads/".$result['prof_picture']."' alt='".$result['prof_picture']."' class='img img-responsive img-thumbnail center-block'/><br />
						<button type='button' class='btn btn-primary center-block' id='".$result['ref_id']."'>Csere</button>
					</div>
				</div>
			</div>";
	}
}
?>
<script>
$(document).ready(function(){
		$('.modify_picture').on('dragover', function(){
			$('.modify_picture').addClass('drag');
			return false;
		});
		$('.modify_picture').on('dragleave', function(){
			$('.modify_picture').removeClass('drag');
			return false;
		});
		$('.modify_picture').on('drop', function(e){
			e.preventDefault();
			$('.modify_picture').removeClass('drag');
			file=e.originalEvent.dataTransfer.files;
			var imagefile = file[0].type;
			var match= ["image/jpeg","image/png","image/jpg"];
			if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
				{
					alert("Nem megfelelő formátum!");
					$('#image').attr('src', 'Pictures/pic.jpg');
					return false;
				}
			else
			{
				var reader = new FileReader();
				reader.addEventListener("load", function () {
					$('.modify_picture').children('img').attr('src',reader.result);
				}, false);

				if (file[0]) {
					reader.readAsDataURL(file[0]);
				}
			}
			return false;
		});
		$('.list-group').find('form').parents('li').hide();
		$('.title').on('click',function(){
			$(this).parents('li').hide(1000);
			$(this).parents('li').next().show(1000);
			return false;
		});
		$('.text').on('click',function(){
			$(this).parents('li').hide(1000);
			$(this).parents('li').next().show(1000);
			return false;
		});
		$('.reset').on('click',function(){
			$(this).parents('li').hide(1000);
			$(this).parents('li').prev().show(1000);
			return false;
		});
		$('.list-group').find('form').on('submit',function(e){
			e.preventDefault();
			var formData= new FormData(this);
			var i=$(this);
			ref_id=i.attr('class');
			formData.append('ref_id',ref_id);
			$.ajax({
			url: 'reference_modify.php',
			type: 'POST',
			data: formData,
			contentType: false,       
			cache: false,            
			processData:false,
			success: function(data){
					i.parents('li').hide(1000);
					i.parents('li').prev().children('p').children('span').html(data)
					i.parents('li').prev().show(1000);
				}
			});
			return false;
		});
		$('.modify_picture').children('button').on('click',function(){
			ref_id=$(this).attr('id');
			var formData= new FormData();
			if(file!=0)
			{
				formData.delete('file');
				formData.append('file',file[0]);
				formData.append('ref_id',ref_id);
			$.ajax({
				url: 'reference_modify.php',
				type: 'POST',
				data: formData,
				contentType: false,       
				cache: false,            
				processData:false,
				success: function(data){
						file=0;
						console.log(data);
					}
				});
			}
			else 
				alert("Nem jelöltél ki új profilképet!");
			return false;
		});
});
</script>
