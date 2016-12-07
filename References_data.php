<?php 
	$ref_id=$_GET['ref_Id'];
	include('user_identification.php');
?>

<!DOCTYPE HTML>
<html lang="hu">
<head>
	<meta http-equiv="Content_Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>The future software</title>
	<link href="Pictures/logo.ico" rel="shortcut icon">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="Java/my_jquery.js"></script>
	<link rel="stylesheet" href="Style/style.css" type="text/css">
	<style type="text/css">
	.drag_over{
		border: 2px dashed #ccc; 
		text-align: center;
	}
	</style>
</head>
<body>
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" data-target="#hide" data-toggle="collapse" class="navbar-toggle">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="index.php" class="navbar-brand">The Future Software</a>
			</div>
			<div class="collapse navbar-collapse" id="hide">
				<ul class="nav navbar-nav">
					<li><a href="Services.php">Szolgáltatások</a></li>
					<li><a href="References.php">Referenciák</a></li>
					<li><a href="Contact.php">Kapcsolat</a></li>
					<?php if(isset($_SESSION["priority"]) && $_SESSION["priority"]==1) echo "<li><a href='users.php'><span class='glyphicon glyphicon-user'></span> Felhasználók</a></li>"; ?>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a <?php if($eye==0) echo "data-toggle='modal' data-target='#login' href='#'"; else echo "href='Logout.php'";?>><span class="glyphicon glyphicon-log-in"></span><?php if($eye==0) echo" Bejelentkezés"; else echo " Kijelentkezés";?></a></li>
					<?php if($eye==0) echo "<li><a href='Registration.php'><span class='glyphicon glyphicon-user'></span> Regisztráció</a></li>"; 
					else { echo "<li><a href='profile.php'>"; if($message==1) echo "<span class='badge badge-info'>1</span>"; echo"<span class='glyphicon glyphicon-user'></span> Profilom <img src='Profile/".$profile_picture."' style='width: 20px; height: 20px;' /></a></li>"; }?>
				</ul>
			</div>
		</div>
	</nav>
	<div id="login" class="modal fade" role="dialog">
		 <div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&cross;</button>
					<h4 class="modal-title">Bejelentkezés</h4>
				</div>
				<div class="modal-body">
					 <form action="login_database.php" method="post">
						<div class="form-group">
							<label for="user_name">Felhasználónév</label>
							<input type="text" class="form-control" placeholder="Felhasználónév" name="user_name" required>
						</div>
						<div class="form-group">
							<label for="pwd">Password:</label>
							<input type="password" class="form-control" id="pwd" placeholder="Password" name="user_psw" required>
						</div>
						<button type="submit" class="btn btn-default" name="reg">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div id="data">
		</div>
		<?php
		if($eye==1 && $_SESSION["priority"]<3)
		{
		echo
		"<div class='row well'>
			<form id='ref_data' action='upload.php?ref_Id=".$ref_id."' method='post' enctype='multipart/form-data'> 
				<div class='col-sm-4 text-center drop'>
					<div class='upload_image_multi'>
						<div id='preview' >
							<img id='image' src='Pictures/pic.jpg' class='img-thumbnail img-responsive' style=' width: 350px; height: 350px' />
						</div>
						<p style='color: #ccc; text-align: center;'>Drag & drop picture</p>
					</div>
					<div class='form-group'>
						<label class='btn btn-default btn-file'>
							Feltöltés<input type='file' id='file' style=' display:none;' name='image[]' multiple/>
						</label>
					</div>
				</div>
				<div class='col-sm-8 well'>
					<button data-target='#ref_about' data-toggle='collapse' type='button' class='btn btn-default'>Hozzászólás</button>
					<blockquote class='collapse' id='ref_about'>						
							<div class='form-group'>
								<label for='txt'>Hozzászólás</label>
								<textarea class='form-control' rows='5' id='txt' name='txt' ></textarea>
							</div>
							<button type='submit' class='form-control' name='submit' id='up'>Elküld</button>
					</blockquote>
					<div class='progress'>
						<div class='progress-bar progress-bar-striped active percent' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width:0%'></div>
					</div>
				</div>
			</form>
		</div>";
		}
		?>
	</div>
	<div class="container-fluid text-center">
		<p>Copyright &copy; The future software 2016</p>
	</div>
	<script>
	function percent_show(val,percent){
		percent.width(val)
		percent.html(val);
	};
	function checktype(file,isload){
			var match= ["image/jpeg","image/png","image/jpg"];
			for( var i=0; i<file.length; i++)
			{
				var imagefile = file[i].type;
				if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
				{
					alert("Nem megfelelő formátum!");
					$('#image').attr('src', 'Pictures/pic.jpg');
					return false;
				}
				else
				{
					var reader = new FileReader();
					reader.readAsDataURL(file[i]);
					reader.onload = isload;
				}
			}
			return true;
		};
		function show(data,sendurl,showid){
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
	function get(ref_id,geturl,sendurl,showid)
	{
		var formData=new FormData();
		formData.append('ref_id', ref_id);
		$.ajax({
			url: geturl,
			type: 'POST',
			data: formData,
			contentType: false,       
			cache: false,            
			processData:false,
			dataType: 'json',
			success: function(data){
				show(data,sendurl,showid);
			}
		});
		return false;
	};
		$(document).ready(function(){
			var file=new Array(); 
			var files; 
			var view=0;
			var pic_num=0;
			var percent = $('.percent');
			var geturl='ref_pictures_database.php';
			var showid='#data';
			var ref_id=<?php echo $ref_id?>;
			var sendurl='References_subscription.php?ref_id='+ref_id;
			get(ref_id,geturl,sendurl,showid);
			$('.upload_image_multi').on('dragover',function(){
				$(this).addClass('drag_over');
				return false;
			});
		
			$('.upload_image_multi').on('dragleave',function(){
				$(this).removeClass('drag_over');
				return false;
			});
			$('.upload_image_multi').on('drop', function(event){
				file=[];
				percent_show('0%',percent);
				event.preventDefault();
				view=0;
				pic_num=0;
				$('.upload_image_multi').removeClass('drag_over');
				files=event.originalEvent.dataTransfer.files;
				for(var i=0; i<files.length; ++i)
				{
					file[i]=files[i];
				}
				var result;
				result=checktype(file,load);
				if(result==false)
				{
					file=0;
					$('#preview').html("<img id='image' src='Pictures/pic.jpg' class='img-thumbnail img-responsive' style=' width: 350px; height: 350px' />");
					return false;
				}
				return false;
			});
			$("#ref_data").on('submit',function(e){
				e.preventDefault();
				var formData= new FormData(this);
				formData.delete('image[]');
				if(file.length!=0)
					{
						for(var i=0; i<file.length; i++)
						{
							formData.append('image[]',file[i]);
						}
					}
				console.log(file);
				$.ajax({
					url: 'upload.php?ref_Id='+ref_id,
					type: 'POST',
					data: formData,
					contentType: false,       
					cache: false,            
					processData:false,
					success: function(data){
						percent_show('100%',percent);
						get(ref_id,geturl,sendurl,showid);
					},
					beforeSend: function() {
					percent_show('0%',percent);
					},
					uploadProgress: function(event, position, total, percentComplete) {
						percent_show(percentComplete + '%',percent);
					}
				});
				$('#txt').val("");
				$('#preview').html("<img id='image' src='Pictures/pic.jpg' class='img-thumbnail img-responsive' style=' width: 350px; height: 350px' />");
				file=[];
				return false;
			});
			$('#file').change(function(){
				file=[];
				view=0;
				pic_num=0;
				percent_show('0%',percent);
				files=this.files;
				for(var i=0; i<files.length; ++i)
				{
					file[i]=files[i];
				}
				var result;
				result=checktype(file,load);
				if(result==false)
				{
					file=0;
					$('#preview').html("<img id='image' src='Pictures/pic.jpg' class='img-thumbnail img-responsive' style=' width: 350px; height: 350px' />");
					return false;
				}
				return false;
			});
			$('#preview ').on('click', '.remove', function() {
						$(this).parentsUntil('#preview').remove();
						var image_num=$(this).attr('id');
						file.splice(file.indexOf(files[image_num]),1);
						if(file.length==0)
								$('#preview').html("<img id='image' src='Pictures/pic.jpg' class='img-thumbnail img-responsive' style=' width: 350px; height: 350px' />");
						return false;
					});
			function load(e){
				if(view==0)
				{
					$('#preview').html("<div class='row well well-sm elem'><div class='col-sm-3'><img src='"+e.target.result+"'  title='"+pic_num+"' class='img img-responsive' style=' width: 100px; height: 100px' /></div><div class='col-sm-9'><button type='button' class='close remove' id='"+pic_num+"' >&cross;</button></div></div>");
					view=1;
				}
				else
					$('#preview').append("<div class='row well well-sm elem'><div class='col-sm-3'><img src='"+e.target.result+"' title='"+pic_num+"' class='img img-responsive' style=' width: 100px; height: 100px' /></div><div class='col-sm-9'><button type='button' class='close remove' id='"+pic_num+"' >&cross;</button></div></div>");
					pic_num=pic_num+1;
			};

		});
	</script>
</body>
</html>