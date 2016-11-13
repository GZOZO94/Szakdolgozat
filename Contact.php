<?php 
	session_start();
	$eye=0;
	if(isset($_SESSION["Id"]))
	{
		$Id=$_SESSION["Id"];
		$eye=1;
		$con = pg_connect("host=ec2-54-228-213-36.eu-west-1.compute.amazonaws.com port=5432 dbname=d6n8r0rohggpo4 user=jfotvvwtbqcthq password=Yvyw2FjADjwzePR6u5wzpE4Prr");
		$query=sprintf("select profile_pic from users where \"Id\"=%d",$Id);
		$result=pg_query($con,$query);
		$result2=pg_fetch_array($result);
		$profile_picture=$result2["profile_pic"];
	}
	else
	{
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
	<script src="Java/my_jquery.js"></script>
	<link rel="stylesheet" href="Style/style.css" type="text/css">
	<style>
	.connection {
		background: #A1A1F9;
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
					else echo "<li><a href='profile.php'><span class='glyphicon glyphicon-user'></span> Profilom <img src='Profile/".$profile_picture."' style='width: 20px; height: 20px;' /></a></li>";?>
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
		<div class='col-sm-4'>
		<h2 class="well well-sm">Kapcsolat <small>The Future Software</small></h2>
			<blockquote class="connection">
			<h3 class="well well-sm">Központi irodánk</h3>
			<p class='well well-sm'>
				Papnövelde u. 7, Budapest, 1056
			</p>
			</blockquote>
			<blockquote class="connection">
			<h3 class="well well-sm">Uszódi irodánk</h3>
			<p class="well well-sm">
				Petőfi u. 30, Uszód, 6332
			</p>
			</blockquote>
			<blockquote class="connection">
			<h3 class="well well-sm">Telefonszám</h3>
			<p class="well well-sm">
				Mobil: 06209259186
			</p>
			</blockquote>
			<blockquote class="connection">
			<h3 class="well well-sm">Email</h3>
			<p class="well well-sm">
				gasparzoltan94@gmail.com
			</p>
			</blockquote>
		</div>
		<div class='col-sm-8'>
			<h2 class="well well-sm">Központi irodánk <small>Budapest</small></h2>
			<img src="Pictures/home.jpg" alt="Home.jpg" class="img img-responsive img-thumbnail center-block" />
			<h2 class="well well-sm">Uszódi irodánk <small>Uszód</small></h2>
			<img src="Pictures/home2.jpg" alt="Home2.jpg" class="img img-responsive img-thumbnail center-block" />
		</div>
	</div>
	<div class="container text-center well">
		<p>Copyright &copy; The future software 2016</p>
	</div>
</body>
</html>