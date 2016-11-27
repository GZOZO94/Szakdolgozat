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
	<link href="https://cdnjs.cloudflare.com/ajax/libs/animsition/4.0.2/css/animsition.min.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/animsition/4.0.2/js/animsition.min.js" charset="utf-8"></script>
	<script src="Java/my_jquery.js"></script>
	<link rel="stylesheet" href="Style/style.css" type="text/css">	
</head>
<body ng-app='myApp' ng-controller='myController'>
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
				<div class="profile_pic" droptarget>
					<img id="prof_pic" src={{picture}} class="img-thumbnail img-responsive center-block" width="200px" height="200px">
					<p style="color: black; text-align: center;">Drag & drop profile picture</p>
					<label class='btn btn-primary btn-file center-block'>
						Feltöltés<input type='file' name='file' onchange="angular.element(this).scope().filechange(this)" style=' display:none;' />
					</label>
				</div>
			</div>
			<div class="col-sm-10 well well-lg">
				<h2 class="col-sm-offset-1"><span class="glyphicon glyphicon-user"> Regisztráció</h2>
				<br />
					<form class="form-horizontal" id="reg" ng-submit='submitform()'>
					<div class="form-group">
						<label class="control-label col-sm-2" for="firstn">Keresztnév:</label>
						<div class="col-sm-10">
							<input type="text" placeholder="Keresztnév" class="form-control" id="firstn" name="firstn" ng-change="change_firstn()" ng-model='formData.firstn' required  />
							<div class="alert alert-danger" ng-show='firstn'>
								<a href="#" class="close" data-dismiss="alert" aria-label="close" >&times;</a>
								<p>{{firstn}}</p>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="secondn">Vezetéknév:</label>
						<div class="col-sm-10">
							<input type="text" placeholder="Vezetéknév" class="form-control" id="secondn" name="secondn" ng-change="change_secondn()"ng-model='formData.secondn' required   />
							<div class="alert alert-danger" ng-show='secondn'>
								<a href="#" class="close" data-dismiss="alert" aria-label="close"  >&times;</a>
								<p>{{secondn}}</p>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="username">Felhasználónév:</label>
						<div class="col-sm-10">
							<input type="text" placeholder="Felhasználónév" class="form-control" id="username" name="user" ng-change="change_username()" ng-model='formData.username' required  />
							<div class="alert alert-danger" ng-show='username'>
								<a href="#" class="close" data-dismiss="alert" aria-label="close"  >&times;</a>
								<p>{{username}}</p>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="psw">Jelszó</label>
						<div class="col-sm-10">
							<input type="password" placeholder="Jelszó" class="form-control" id="psw" name="psw" ng-change="change_psw()" ng-model='formData.psw' required  />
							<div class="alert alert-danger" ng-show='psw'>
								<a href="#" class="close" data-dismiss="alert" aria-label="close"  >&times;</a>
								<p>{{psw}}</p>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="pswa">Jelszó ismét:</label>
						<div class="col-sm-10">
							<input type="password" placeholder="Jelszó ismét" class="form-control" id="pswa" name="pswa" ng-change="change_pswa()" ng-model='formData.pswa' required  />
							<div class="alert alert-danger" ng-show='pswa'>
								<a href="#" class="close" data-dismiss="alert" aria-label="close"  >&times;</a>
								<p>{{pswa}}</p>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="phone">Telefonszám:</label>
						<div class="col-sm-10">
							<input type="text" placeholder="Telefonszám" class="form-control" id="phone" name="phone" ng-change="change_phone()" ng-model='formData.phone' required  />
							<div class="alert alert-danger" ng-show='phone'>
								<a href="#" class="close" data-dismiss="alert" aria-label="close"  >&times;</a>
								<p>{{phone}}</p>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="email">Email:</label>
						<div class="col-sm-10">
							<input type="text" placeholder="Email" class="form-control" id="mail" name="email" ng-change="change_email()" ng-model='formData.email' required  />
							<div class="alert alert-danger" ng-show='email'>
								<a href="#" class="close" data-dismiss="alert" aria-label="close"  >&times;</a>
								<p>{{email}}</p>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="date">Születési dátum:</label>
						<div class="col-sm-10">
							<input type="text" placeholder="Születési dátum" class="form-control" id="date" name="date" ng-change="change_date()" ng-model='formData.date' required  />
							<div class="alert alert-danger" ng-show='date'>
								<a href="#" class="close" data-dismiss="alert" aria-label="close"  >&times;</a>
								<p>{{date}}</p>
							</div>
						</div>
					</div>
					<br />
					<div class="text-center">
						<div class="alert alert-success" ng-show='message'>
							<p>{{message}}</p>
						</div>
						<button type="submit" ng-click="uploadFile()" class="btn btn-default">Regisztráció</button>
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
		 var myApp = angular.module('myApp', []);
         var file;
      
         myApp.service('fileUpload', ['$http',function ($http) {
            this.uploadFileToUrl = function(data,file, uploadUrl,scope){
               var fd = new FormData();
			   for(x in data)
					fd.append(x,data[x]);
               fd.append('file', file);
               $http.post(uploadUrl, fd, {
                  transformRequest: angular.identity,
                  headers: {'Content-Type': undefined}
               })
               .success(function(result){
					if(result.error.length!=0)
					{
						if (result.error.firstn)
							scope.firstn=result.error.firstn;
						else
							scope.firstn=false;
						if (result.error.secondn)
							scope.secondn=result.error.secondn; 
						else
							scope.secondn=false;
						if (result.error.username)
								scope.username=result.error.username; 
						else
						{
							if (result.error.username_busy) 
								scope.username=result.error.username_busy;
							else
								scope.username=false;
						}
						if (result.error.date) {
							scope.date=result.error.date;
						}
						else
						{
							if (result.error.date_format)
								scope.date=result.error.date_format; 
							else
								scope.date=false;
						}
						if (result.error.phone) {
								scope.phone=result.error.phone; 
						}
						else
						{
							if (result.error.phone_format)
								scope.phone=result.error.phone_format; 
							else
								scope.phone=false;
						}
						if (result.error.email)
								scope.email=result.error.email; 
						else
							scope.mail=false;
						if (result.error.psw)
								scope.psw=result.error.psw; 
						else
						{
							if (result.error.password)
								scope.psw=result.error.password;
							else
								scope.psw=false;
						}
						if (result.error.pswa)
								scope.pswa=result.error.pswa; 
						else
						{
							if (result.error.password)
								scope.pswa=result.error.password;
							else
								scope.pswa=false;
						}
						scope.message=false;
					}
					else
					{
						scope.message=result.message;
						scope.pswa=false;
						scope.psw=false;
						scope.phone=false;
						scope.date=false;
						scope.username=false;
						scope.firstn=false;
						scope.secondn=false;
						scope.email=false;
					}
               });
            }
         }]);
      
         myApp.controller('myController', ['$scope', 'fileUpload', function($scope, fileUpload){
			$scope.picture='Pictures/Profile.jpg';
			$scope.change_firstn=function(){
				$scope.firstn=false;
			};
			$scope.change_secondn=function(){
				$scope.secondn=false;
			};
			$scope.change_username=function(){
				$scope.username=false;
			};
			$scope.change_phone=function(){
				$scope.phone=false;
			};
			$scope.change_date=function(){
				$scope.date=false;
			};
			$scope.change_email=function(){
				$scope.email=false;
			};
			$scope.change_psw=function(){
				$scope.psw=false;
			};
			$scope.change_pswa=function(){
				$scope.pswa=false;
			};
			$scope.filechange=function(e){
				file=e.files[0];
				var reader = new FileReader();
				reader.onload = function(event)
				{
					 $scope.$apply(function() {
						  $scope.picture = event.target.result;
					  });
				};
				reader.readAsDataURL(e.files[0]);
			};
            $scope.uploadFile = function(){
               var data=$scope.formData;
               var uploadUrl = "registration_database.php";
               fileUpload.uploadFileToUrl(data,file, uploadUrl,$scope);
            };
         }]);
		myApp.directive('droptarget',function(){
			return function($scope,$elem){
				$elem.on('dragover', function (e) {
					e.preventDefault();
					$elem.addClass('profile_pic_over');
				});
				$elem.on('dragleave', function (e) {
					e.preventDefault();
					$elem.removeClass('profile_pic_over');
				});
				$elem.on('drop', function(e){
					e.preventDefault();
					$elem.removeClass('profile_pic_over');
					file=e.originalEvent.dataTransfer.files[0];
					var reader = new FileReader();
					reader.onload = function(event)
					{
						 $scope.$apply(function() {
							  $scope.picture = event.target.result;
						  });
					};
					reader.readAsDataURL(file);
				});
			};
		});
	</script>
</body>
</html>