function showdata(data,sendurl,showid){
		$.ajax({
			url: sendurl,
			type: 'POST',
			data: JSON.stringify(data),
			contentType: 'application/json',       
			cache: false,            
			processData:false,
			success: function(result){
				$(showid).html(result);
			}
		});
		return false;
	};
	function getdata(geturl,sendurl,showid)
	{
		$.ajax({
			url: geturl,
			type: 'POST',
			data: "",
			contentType: false,       
			cache: false,            
			processData:false,
			dataType: 'json',
			success: function(data){
				showdata(data,sendurl,showid);
				console.log(data);
			}
		});
		return false;
	};
	function showfile(file,openfunction)
	{
		var imagefile = file.type;
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
			reader.onload = openfunction;
			reader.readAsDataURL(file);
		}
		return true;
	}
	function imageIsLoaded(e){
				$('#image').attr('src', e.target.result);
			};
$(document).ready(function(){
	var file=0;
	var ref_id;
	var geturl='references_database.php';
	var sendurl='References_about.php';
	var showid='#references_about';
	getdata(geturl,sendurl,showid);
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
			file=file[0];
			showfile(file,imageIsLoaded);
		return false;
		});
	$("#image_upload").on('submit',function(e){
		e.preventDefault();
		var formData= new FormData(this);
		if(file!=0)
		{
			formData.delete('file');
			formData.append('file',file);
		}
		$.ajax({
			url: 'drop.php',
			type: 'POST',
			data: formData,
			contentType: false,       
			cache: false,            
			processData:false,
			success: function(data){
				getdata(geturl,sendurl,showid);
			}
			});
		return false;
		});
	$('#file').change(function(){
		var files = this.files[0];
		showfile(files,imageIsLoaded);
		});
	$('#modify').on('hidden.bs.modal',function(){
		getdata(geturl,sendurl,showid);
		return false;
	});
});
