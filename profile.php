<?php 
	session_start();
	$eye=0;
	if(isset($_SESSION["Id"]))
	{
		$Id=$_SESSION["Id"];
		$eye=1;
	}
	else
	{
		exit();
		$eye=0;
	}
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
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/animsition/4.0.2/css/animsition.min.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/animsition/4.0.2/js/animsition.min.js" charset="utf-8"></script>
	<script src="Java/my_jquery.js"></script>
	<link rel="stylesheet" href="Style/style.css" type="text/css">
</head>
<body ng-app='myApp' ng-controller='myCont'>
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
					else echo "<li><a href='profile.php'><span ng-show='notice' class='badge badge-info'>{{notice}}</span><span class='glyphicon glyphicon-user'></span> Profilom <img src='{{path}}{{user.picture}}' style='width: 20px; height: 20px;' /></a></li>"?>
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
			<div class="alert alert-success" ng-show='res'>
				<a href="#" class="close" ng-click='done()'>&times;</a>
				<p align="center">{{res}}</p>
			</div>
		</div>
		<div class='row'>
			<div class='col-sm-3'>
				<div>
					<img src="{{path}}{{user.picture}}" alt={{user.picture}} class="img img-responsive img-thumbnail center-block" style='width: 200px; height: 200px' />
					<br />
					<label class='btn btn-primary btn-file center-block'>
						Feltöltés<input type='file' name='file' onchange="angular.element(this).scope().filechange(this)"  style=' display:none;' />
					</label>
				</div>
			</div>
			<div class='col-sm-9'>
				<div class='panel panel-primary'>
					<div class='panel-heading'>
						<h1>{{user.firstn}} {{user.secondn}}<small> Adataim</small><button type="button" ng-click='delete_user()' class="close">&times;</button></h1>
					</div>
					<div class='panel-body'>
						<ul class='list-group'>
							<li class='list-group-item'>Felhasználónév: {{user.username}}</li>
							<li class='list-group-item'>Jelszó: {{user.password}}<button type="button" ng-click='toggle_psw()' class="close">&#9776;</button></li>
							<li class='list-group-item'  ng-show='show_psw'><input type='password' ng-change="change()" lass="form-control" ng-model="user.password" style='color: black;'/></li>
							<li class='list-group-item'>Email: {{user.email}}<button type="button" ng-click='toggle_email()' class="close">&#9776;</button></li>
							<li class='list-group-item'  ng-show='show_email'><input type='text'  ng-change="change()" class="form-control" ng-model="user.email" style='color: black;'/></li>
							<li class='list-group-item'>Telefonszám: {{user.phonenumber}}<button type="button" ng-click='toggle_phone()' class="close">&#9776;</button></li>
							<li class='list-group-item' ng-show='show_phone'><input type='text'  ng-change="change()" class="form-control" ng-model="user.phonenumber" style='color: black;'/></li>
							<li class='list-group-item'>Dátum: {{user.birthdate}}<button type="button" ng-click='toggle_date()' class="close">&#9776;</button></li>
							<li class='list-group-item' ng-show='show_date'><input type='text' ng-change="change()" class="form-control" ng-model="user.birthdate" style='color: black;'/></li>
							<li class='list-group-item' ng-click='send()'><p align='center'>Küldés</p></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="alert alert-info" ng-show='user.message'>
				<a href="#" class="close" data-dismiss="alert" ng-click='getmessage()' aria-label="close" >&times;</a>
				<p align="center">Adatmódosítás: {{user.message}}</p>
			</div>
		</div>
	</div>
	<div class="container text-center well">
		<p>Copyright &copy; The future software 2016</p>
	</div>
	<script>
		var file;
		var counter=0;
		var myApp=angular.module('myApp',[]);
		myApp.service('getdata', ['$http',function ($http) {
            this.data = function(data,Url,scope){
               var fd = new FormData();
               fd.append('Id', data);
               $http.post(Url, fd, {
                  transformRequest: angular.identity,
                  headers: {'Content-Type': undefined}
               })
               .success(function(data){
					scope.user=data;
					if(data.message=="" || data.message==0)
					{
						scope.notice=false;
						data.message="";
					}
					else 
					{
						scope.notice=1;
					}
               });
            }
         }]);
		 myApp.service('senddata', ['$http',function ($http) {
            this.data = function(Id,data,Url,getdata,scope,file,counter){
               var fd = new FormData();
			   for(x in data)
					fd.append(x,data[x]);
               fd.append('Id', Id);
			   fd.append('file',file);
               $http.post(Url, fd, {
                  transformRequest: angular.identity,
                  headers: {'Content-Type': undefined}
               }).success(function(data){
					if(data.error.length==0 && counter==1)
						scope.res="Sikeres modosítás";
					else if(data.error.date)
					{
						scope.res="Hiba történt: "+data.error.date+". A dátum nem került modosításra!";
						getdata.data(Id,'profile_data.php',scope);
					}
					else if(data.error.phone){
						scope.res="Hiba történt: "+data.error.phone+". A telefonszám nem került modosításra!";
						getdata.data(Id,'profile_data.php',scope);
					}
					else
						scope.res=false;
			   });
            };
			this.del=function(Id,Url){
				var fd=new FormData();
				fd.append('Id',Id);
				 $http.post(Url, fd, {
                  transformRequest: angular.identity,
                  headers: {'Content-Type': undefined}
               }).success(function(data){
					  location.href ='Logout.php';
			   });
			};
         }]);
		myApp.controller('myCont',function($scope,getdata,senddata){
			$scope.user={};
			$scope.path='Profile/';
			$scope.show_psw=false;
			$scope.toggle_psw=function(){
				$scope.show_psw=!$scope.show_psw;
			};
			$scope.show_date=false;
			$scope.toggle_date=function(){
				$scope.show_date=!$scope.show_date;
			};
			$scope.show_email=false;
			$scope.toggle_email=function(){
				$scope.show_email=!$scope.show_email;
			};
			$scope.show_phone=false;
			$scope.toggle_phone=function(){
				$scope.show_phone=!$scope.show_phone;
			};
			$scope.change=function(){
				counter=1;
			};
			$scope.done=function(){
				$scope.res=false; 
			};
			var Id=<?php echo $Id;?>;
			var Url="profile_data.php";
			var sendUrl='user_modify.php';
			getdata.data(Id,Url,$scope);
			$scope.delete_user=function(){
				var url='user_delete.php'
				senddata.del(Id,url);
			}
			$scope.getmessage=function(){
				$scope.user.message="";
				$scope.notice=false;
				senddata.data(Id,$scope.user,sendUrl,getdata,$scope,file,counter);
			}
			$scope.send=function(){
				senddata.data(Id,$scope.user,sendUrl,getdata,$scope,file,counter);
				counter=0;
			};
			$scope.filechange=function(e){
				file=e.files[0];
				counter=1;
				var reader = new FileReader();
				reader.onload = function(event)
				{
					 $scope.$apply(function() {
						  $scope.user.picture = event.target.result;
						  $scope.path="";
					  });
				};
				reader.readAsDataURL(e.files[0]);
			};
		});
	</script>
</body>
</html>