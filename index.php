<?php 
	session_start();
	$eye=0;
	$error=false;
	if(isset($_SESSION["Id"]))
	{
		$Id=$_SESSION["Id"];
		$eye=1;
		$error=$_SESSION["Error"];
		$profile_picture=$_SESSION["prof_pic"];
	}
	else if(isset($_SESSION["Error"]))
	{
		$error=$_SESSION["Error"];
		$eye=0;
	}
	else
	$eye=0;
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
	<script>
	$(document).ready(function(){
		$(".navbar-brand").click(function(e){
			e.preventDefault();
			var destId=e.currentTarget.id+"Section";

			$("html, body").animate({
				scrollTop: $("#"+destId).offset().top
			},1000);
		});
	});
	</script>
</head>
<body>
<?php if($error==true)
{
echo "<script type='text/javascript'>$(function(){alert('Hibás jelszó vagy felhasználónév!');});</script>";
unset($_SESSION["Id"]);
unset($_SESSION["Error"]);
}
?>
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" data-target="#hide" data-toggle="collapse" class="navbar-toggle">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a id="about" href="#aboutSection" class="navbar-brand">The Future Software</a>
			</div>
			<div class="collapse navbar-collapse" id="hide">
				<ul class="nav navbar-nav">
				<li><a href="Services.php">Szolgáltatások</a></li>
					<li><a href="References.php">Referenciák</a></li>
					<li><a href="Contact.php">Kapcsolat</a></li>
					<?php if(isset($_SESSION["priority"]) && $_SESSION["priority"]==1) echo "<li><a href='users.php'><span class='glyphicon glyphicon-user'></span> Felhasználók</a></li>"; ?>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a <?php if($eye==0) echo "data-toggle='modal' data-target='#login' href='#'"; else echo "href='Logout.php'";?>><span class="glyphicon glyphicon-log-in"></span><?php if($eye==0) echo" Bejelentkezés"; else echo " Kijelentkezés <img src='Profile/".$profile_picture."' style='width: 20px; height: 20px;' />";?></a></li>
					<?php if($eye==0) echo "<li><a href='Registration.php'><span class='glyphicon glyphicon-user'></span> Regisztráció</a></li>"; ?>
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
					 <form id="log_in" action="login_database.php" method="post">
						<div class="form-group">
							<label for="user_name">Felhasználónév</label>
							<input type="text" class="form-control" id="user_name" placeholder="Felhasználónév" name="user_name" required>
						</div>
						<div class="form-group">
							<label for="pwd">Password:</label>
							<input type="password" class="form-control" id="pwd" placeholder="Jelszó" name="user_psw" required>
						</div>
						<button type="submit" class="btn btn-default" name="reg" id="sub" >Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div id="myCarousel" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				<li data-target="#myCarousel" data-slide-to="1"></li>
			</ol>
			<div class="carousel-inner" role="listbox">
				<div class="item active">
					<img src="Pictures/logo.jpg" alt="TFS">
					<div class="carousel-caption">
						<h3>The Future Software</h3>
						<p>A világ egyik legnagyobb szoftverportálja</p>
					</div>
				</div>
				<div class="item">
					<img src="Pictures/logo2.jpg" alt="TFS">
					<div class="carousel-caption">
						<h3>The Future Software</h3>
						<p>A világ egyik legnagyobb szoftverportálja</p>
					</div>
				</div>
			</div>
			<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
		<div id="aboutSection" class="container-fluid">
		<h2>Rólunk <small>The Future Software</small></h2>
		<blockquote class="well text-center">
			<p>"A Future Software" a világ egyik legnagyobb szoftvercég portálja.<br />
			Folyamatban lévő munkáink között weblapfejlesztés,Iphone applikáció fejlesztés,Andriod applikáció fejlesztés, illetve grafikai tervezés állnak.<br />
			A legfrisebb, és legmodernebb technológiákkal dolgozunk, fejlesztünk.<br />
			Mindig naprakészek vagyunk a szoftvervilág változásaival kapcsolatban.</p>
		</blockquote>
		</div>
	</div>
	<div class="container-fluid text-center">
		<p>Copyright &copy; The future software 2016</p>
	</div>
</body>
</html>