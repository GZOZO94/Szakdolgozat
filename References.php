<?php 
	session_start();
	$eye=0;
	if(isset($_SESSION["Id"]))
	{
		$Id=$_SESSION["Id"];
		$eye=1;
		$con = pg_connect("host=ec2-54-228-213-36.eu-west-1.compute.amazonaws.com port=5432 dbname=d6n8r0rohggpo4 user=jfotvvwtbqcthq password=Yvyw2FjADjwzePR6u5wzpE4Prr");
		$query=sprintf("select profile_pic from user where \"Id\"=%d",$Id);
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
	<script src="Java/drop.js"></script>
	<script src="Java/my_jquery.js"></script>
	<link rel="stylesheet" href="Style/style.css" type="text/css">
	<style>
	.drag{
		border: 2px dashed #ccc; 
		text-align: center;
	}
	a{
		text-decoration: none;
		color: black;
	}
	a:hover {
		text-decoration: none;
		color: black;
	}
	
	a:link {
		text-decoration: none;
		color: black;
	}

	a:visited {
		text-decoration: none;
		color: black;
	}

	a:hover {
		text-decoration: none;
		color: black;
	}

	a:active {
		text-decoration: none;
		color: black;
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
					<button type="button" class="close" data-dismiss="modal">&cross;</button>
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
		<div>
			<h1>Referenciák</h1>
		</div>
		<div id="references_about">
				<?php
					include("References_about.php");
				?>
		</div>
				<?php
		if($eye==1 && $_SESSION["priority"]<3)
		{
			echo
			"<div class='row well'>
				<form id='image_upload' action='' method='post' enctype='multipart/form-data'> 
					<div class='col-sm-4 text-center'>
						<div class='drag_over'>
							<img id='image' src='Pictures/pic.jpg' class='img-thumbnail img-responsive' style=' width: 350px; height: 350px' />
							<p style='color: #ccc; text-align: center;' >Drag & drop picture</p>
						</div>
						<div class='form-group'>
							<label class='btn btn-default btn-file'>
								Feltöltés<input type='file' id='file' style=' display:none;' name='file'/>
							</label>
						</div>
					</div>
					<div class='col-sm-8 well'>
						<button data-target='#com' data-toggle='collapse' type='button' class='btn btn-default'>Hozzászólás</button>
						<blockquote class='collapse' id='com'>						
								<div class='form-group'>
									<label for='title'>Cím</label>
									<input type='text' class='form-control' id='title' name='title' required/>
								</div>
								<div class='form-group'>
									<label for='txt'>Hozzászólás</label>
									<textarea class='form-control' rows='5' id='txt' name='txt' required></textarea>
								</div>
								<button type='submit' class='form-control' name='submit' id='up'>Elküld</button>
						</blockquote>
					</div>
				</form>
			</div>";
		}
		?>
	<div id="modify" class="modal fade" role="dialog">
		 <div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&cross;</button>
					<h4 class="modal-title">Módosítás</h4>
				</div>
				<div class="modal-body" id="select">
				<?php
					include('ref_modify.php');
				?>
				</div>
			</div>
		</div>
	</div>
	</div>
	<div class="container-fluid text-center">
		<p>Copyright &copy; The future software 2016</p>
	</div>
</body>
</html>