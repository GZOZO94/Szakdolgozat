$(document).ready(function(){
	var file=0;
	var ref_id;
	$('.drag_over').on('dragover', function(){
			$('.drag_over').addClass('drag');
			return false;
		});
	$('.drag_over').on('dragleave', function(){
			$('.drag_over').removeClass('drag');
			return false;
		});
	$('.drag_over').on('drop', function(e){
			e.preventDefault();
			$('.drag_over').removeClass('drag');
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
				reader.onload = imageIsLoaded;
				reader.readAsDataURL(file[0]);
			}
		return false;
		});
	$("#image_upload").on('submit',function(e){
		e.preventDefault();
		var formData= new FormData(this);
		if(file!=0)
		{
			formData.delete('file');
			formData.append('file',file[0]);
		}
		$.ajax({
			url: 'drop.php',
			type: 'POST',
			data: formData,
			contentType: false,       
			cache: false,            
			processData:false,
			success: function(data){
				file=0;
				console.log(data);
				$("#references_about").load("References_about.php");
			}
			});
		return false;
		});
	$('#file').change(function(){
		var files = this.files[0];
		var imagefile = files.type;
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
				reader.onload = imageIsLoaded;
				reader.readAsDataURL(this.files[0]);
			}
			return false;
		});
		$('#modify').on('hidden.bs.modal',function(){
			$('#references_about').load("References_about.php");
			return false;
	});
	function imageIsLoaded(e){
				$('#image').attr('src', e.target.result);
			};
});
