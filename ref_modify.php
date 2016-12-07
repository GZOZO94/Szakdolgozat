<?php
$data=json_decode(file_get_contents('php://input'),TRUE);
echo "<div class='row'>
			<div class='col-sm-4'>
				<div class='panel panel-primary'>
						<div class='panel-heading'></div>
				<div class='panel-body'>
					<ul class='list-group'>
						<li class='list-group-item'><p>Cím: <span>".$data["title"]."</span><button type='button' class='close title'>&#9776;</button></p></li>
						<li class='list-group-item'><form class='".$data["ref_id"]."'><div class='form-group'><label class='sr-only'>Cím</label><input class='form-control' name='title' required/><button type='button' class='close reset'>&times;</button><button type='submit' class='close done'>&#10004</button></div></form></li>
						<li class='list-group-item'><p>Bejegyzés: <span>".$data["text"]."</span><button type='button' class='close text'>&#9776;</button></p></li>
						<li class='list-group-item'><form class='".$data["ref_id"]."'><div class='form-group'><label class='sr-only'>Hozzászólás</label><input class='form-control' name='text' required/><button type='button' class='close reset'>&times;</button><button type='submit' class='close done'>&#10004</button></div></form></li>
					</ul>
				</div>
			</div>
		</div>
		<div class='col-sm-8'>
			<div class='modify_picture'>
				<img src='Uploads/".$data['prof_picture']."' alt='".$data['prof_picture']."' class='img img-responsive img-thumbnail center-block'/><br />
				<button type='button' class='btn btn-primary center-block' id='".$data['ref_id']."'>Csere</button>
			</div>
		</div>
	</div>";
?>
<script>
var picture=0;
function imageload(e){
	$('.modify_picture').children('img').attr('src',e.target.result);
	return false;
};
function show(option){
	$(option).parents('li').hide(1000);
	$(option).parents('li').next().show(1000);
	return false;
};
function showpicture(openfunction)
	{
		var imagefile = picture.type;
		var match= ["image/jpeg","image/png","image/jpg"];
		if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
		{
			alert("Nem megfelelő formátum!");
			$('#image').attr('src', 'Pictures/pic.jpg');
			picture=0;
			return false;
		}
		else
		{
			var reader = new FileReader();
			reader.onload = openfunction;
			reader.readAsDataURL(picture);
		}
		return true;
	}
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
			picture=e.originalEvent.dataTransfer.files;
			picture=picture[0];
			showpicture(imageload);
			return false;
		});
		$('.list-group').find('form').parents('li').hide();
		$('.title').on('click',function(){
			show('.title');
			return false;
		});
		$('.text').on('click',function(){
			show('.text');
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
					var result=0;
					var res=jQuery.parseJSON(data);
					if(res.title)
					{
						result=res.title;
					}
					else if(res.text)
					{
						result=res.text;
					}
					if(result!=0)
					{
						i.parents('li').hide(1000);
						i.parents('li').prev().children('p').children('span').html(result);
						i.parents('li').prev().show(1000);
					}
				}
			});
			return false;
		});
		$('.modify_picture').children('button').on('click',function(){
			ref_id=$(this).attr('id');
			var formData= new FormData();
			if(picture!=0)
			{
				formData.delete('file');
				formData.append('file',picture);
				formData.append('ref_id',ref_id);
			$.ajax({
				url: 'reference_modify.php',
				type: 'POST',
				data: formData,
				contentType: false,       
				cache: false,            
				processData:false,
				success: function(data){
						picture=0;
					}
				});
			}
			else 
				alert("Nem jelöltél ki új profilképet!");
			return false;
		});
});
</script>