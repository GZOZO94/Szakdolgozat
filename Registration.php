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
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
	<script src="Java/my_jquery.js"></script>
	<link rel="stylesheet" href="Style/style.css" type="text/css">	
	<style type="text/css">
	input.ng-valid {
		background: grey;
		color: white;
	}
	.profile_pic_over{
		border: 2px dashed #ccc; 
		text-align: center;
	}
	#prof_pic{
		width: 200px;
		height: 200px;
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
					<li><a data-toggle="modal" data-target="#login" href="#"><span class="glyphicon glyphicon-log-in"></span> Bejelentkezés</a></li>
					<li><a href="Registration.php"><span class="glyphicon glyphicon-user"></span> Regisztráció</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<div id="login" class="modal fade" role="dialog">
		 <div class="modal-dialog">

			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Bejelentkezés</h4>
				</div>
				<div class="modal-body">
					 <form action="login_database.php" method="post">
						<div class="form-group">
							<label for="user_name">Felhasználónév</label>
							<input type="text" class="form-control" id="email" placeholder="Felhasználónév" name="user_name" required>
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
		<div class="row">
			<div class="col-sm-2">
				<div class="profile_pic">
					<img id="prof_pic" src="Pictures/Profile.jpg" class="img-thumbnail img-responsive center-block" width="200px" height="200px">
					<p style="color: black; text-align: center;">Drag & drop profile picture</p>
				</div>
			</div>
			<div class="col-sm-10 well well-lg">
				<h2 class="col-sm-offset-1"><span class="glyphicon glyphicon-user"> Regisztráció</h2>
				<br />
				<form action="registration_database.php" method="post" class="form-horizontal" id="reg" ng-app="">
					<div class="form-group">
						<label class="control-label col-sm-2" for="firstn">Keresztnév:</label>
						<div class="col-sm-10">
							<input type="text" placeholder="Keresztnév" class="form-control" id="firstn" name="firstn" ng-model='firstn' required />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="secondn">Vezetéknév:</label>
						<div class="col-sm-10">
							<input type="text" placeholder="Vezetéknév" class="form-control" id="secondn" name="secondn" ng-model='secondn' required />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="user">Felhasználónév:</label>
						<div class="col-sm-10">
							<input type="text" placeholder="Felhasználónév" class="form-control" id="user" name="user" ng-model='user' required />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="psw">Jelszó</label>
						<div class="col-sm-10">
							<input type="password" placeholder="Jelszó" class="form-control" id="psw" name="psw" ng-model='psw' required />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="pswa">Jelszó ismét:</label>
						<div class="col-sm-10">
							<input type="password" placeholder="Jelszó ismét" class="form-control" id="pswa" name="pswa" ng-model='pswa' required />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="phone">Telefonszám:</label>
						<div class="col-sm-10">
							<input type="text" placeholder="Telefonszám" class="form-control" id="phone" name="phone"  ng-model='phone' required />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="email">Email:</label>
						<div class="col-sm-10">
							<input type="email" placeholder="Email" class="form-control" id="email" name="email" ng-model='email' required />
						</div>
					</div>
					<div class="form-group text-center">
						<label>Születési dátum</label><br>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="year">Év:</label>
						<div class="col-sm-2">
							<select class="form-control" id="year" name="year">
								<?php
									for($i = 1950; $i<date("Y")+1; $i++)
										echo '<option value="'.$i.'">'.$i.'</option>'
								?>
							</select>
						</div>
						<label class="control-label col-sm-1" for="month">Hónap:</label>
						<div class="col-sm-2">
							<select class="form-control" id="month" name="month">
								<?php
									for($i = 1; $i<13; $i++)
										echo '<option value="'.$i.'">'.$i.'</option>'
								?>
							</select>
						</div>
						<label class="control-label col-sm-2" for="day">Nap:</label>
						<div class="col-sm-2">
							<select class="form-control" id="day" name="day">
								<?php
									for($i = 1; $i<32; $i++)
										echo '<option value="'.$i.'">'.$i.'</option>'
								?>
							</select>
						</div>
					</div>
					<br />
					<div class="text-center">
						<button type="submit" class="btn btn-default">Regisztráció</button>
					</div>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 text-center">
				<br />
				<p>Copyright &copy; The future software 2016</p>
			</div>
		</div>
	</div>
	<script>
	$(function(){
		var file=0;
		$('.profile_pic').on('dragover', function(){
			$('.profile_pic').addClass('profile_pic_over');
			return false;
		});
		$('.profile_pic').on('dragleave', function(){
			$('.profile_pic').removeClass('profile_pic_over');
			return false;
		});
		$('.profile_pic').on('drop',function(e){
			e.preventDefault();
			$('.profile_pic').removeClass('profile_pic_over');
			file=e.originalEvent.dataTransfer.files;
			var imagefile = file[0].type;
			var match= ["image/jpeg","image/png","image/jpg"];
			if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
				{
					alert("Nem megfelelő formátum!");
					$('#image').attr('src', 'Pictures/Profile.jpg');
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
		$('#reg').on('submit',function(e){
			e.preventDefault();
			
			var formData=new FormData(this);
			if(file!=0)
			{
				formData.append('file',file[0]);
			}
			$.ajax({
				url:'registration_database.php',
				type: 'POST',
				data: formData,
				contentType: false,       
				cache: false,            
				processData:false,
				success:function(response){
					alert(response);
				}
			});
			return false;
		});
		function imageIsLoaded(e){
				$('#prof_pic').attr('src', e.target.result);
		};
	});
	</script>
</body>
</html>