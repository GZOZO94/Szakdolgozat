<?php
	if (session_status() == PHP_SESSION_NONE) 
	{
		session_start();
	}
	$rows=0;
	$con = pg_connect("host=ec2-54-228-213-36.eu-west-1.compute.amazonaws.com port=5432 dbname=d6n8r0rohggpo4 user=jfotvvwtbqcthq password=Yvyw2FjADjwzePR6u5wzpE4Prr");
			if (!$con) {
				echo "Error with connecting.\n";
				exit;
			}
	$res=pg_query($con,"select * from users");
	while($result=pg_fetch_array($res))
	{
		if(isset($_SESSION["Id"]) && $_SESSION["Id"]!=$result["Id"] && isset($_SESSION["priority"]) && $_SESSION["priority"]==1)
		{
			$picture=$result["profile_pic"];
			if($rows%2==0)
			{
				echo "<div class='row'>";
			}
			$rows=$rows+1;
			echo "<div class='col-sm-6'>
					<div class='row well'>
						<div class='col-sm-4 text-center well profile_picture'>
							<img src='Profile/".$picture."' class='".$result["Id"]." img-thumbnail img-responsive center-block' style='width: 300px; height: 200px;' title='".$picture."' alt='".$picture."'><br />
							<form class='".$result["Id"]." image_upload'><div class='form-group'><button type='submit' class='btn btn-primary'>Csere</button></div></form>
							<button type='button' class='close delete' id='".$result["Id"]."'>&cross;</button>
						</div>
						<div class='col-sm-6 well'>
								<div class='panel panel-primary'>
									<div class='panel-heading'>
										<button type='button' class='close firstn_secondn'>&#9776;</button>
										<h4 class='panel-title'>".$result["firstname"]." ".$result["lastname"]."</h4>
										<form class='".$result["Id"]."'><div class='form-group'><label class='sr-only'>Keresztnév</label><input class='form-control' name='firstname' placeholder='Keresztnév' value='".$result["firstname"]."' required /></div><div class='form-group'><label class='sr-only'>Vezetéknév</label><input class='form-control' name='lastname' placeholder='Vezetéknév' value='".$result["lastname"]."' required /><button type='button' class='close back'>&times;</button><button type='submit' class='close ok'>&#10004</button></div></form>
									</div>
									<div class='panel-body'><button type='button' class='btn btn-primary data'>Adatok</button>
										<div class='collapse'>
											 <ul class='list-group'>
												<li class='list-group-item'><p>Felhasználónév: <span>".$result["user_name"]." </span><button type='button' class='close user_name'>&#9776;</button></p></li>
												<li class='list-group-item user'><form class='".$result["Id"]."'><div class='form-group'><label class='sr-only'>Felhasználóbév</label><input class='form-control' name='username' required /><button type='button' class='close reset'>&times;</button><button type='submit' class='close done'>&#10004</button></div></form></li>
												<li class='list-group-item'><p>Jelszó: <span>".$result["user_password"]."</span><button type='button' class='close password'>&#9776;</button></p></li>
												<li class='list-group-item psw'><form class='".$result["Id"]."'><div class='form-group'><label class='sr-only'>Jelszó</label><input class='form-control' name='password' required /><button type='button' class='close reset'>&times;</button><button type='submit' class='close done'>&#10004</button></div></form></li>
												<li class='list-group-item'><p>Email: <span>".$result["email"]."</span><button type='button' class='close email'>&#9776;</button></p></li>
												<li class='list-group-item mail'><form class='".$result["Id"]."'><div class='form-group'><label class='sr-only'>Email</label><input class='form-control' name='email' type='email' required/><button type='button' class='close reset'>&times;</button><button type='submit' class='close done'>&#10004</button></div></form></li>
												<li class='list-group-item'><p>Születésnap: <span>".$result["birthdate"]."</span><button type='button' class='close birth'>&#9776;</button></p></li>
												<li class='list-group-item bdate'><form class='".$result["Id"]."'><div class='form-group'><label class='sr-only'>Születésnap</label><input class='form-control' name='birthdate' required/><button type='button' class='close reset'>&times;</button><button type='submit' class='close done'>&#10004</button></div></form></li>
												<li class='list-group-item'><p>Telefoszám: <span>".$result["phone"]."</span><button type='button' class='close phone'>&#9776;</button></p></li>
												<li class='list-group-item telephone'><form class='".$result["Id"]."'><div class='form-group'><label class='sr-only'>Telefonszám</label><input class='form-control' name='phonenumber' required/><button type='button' class='close reset'>&times;</button><button type='submit' class='close done'>&#10004</button></div></form></li>
												<li class='list-group-item'><p>Prioritási szint: <span>".$result["priority"]."</span><button type='button' class='close priority'>&#9776;</button></p></li>
												<li class='list-group-item prio'><form class='".$result["Id"]."'><div class='form-group'><label class='sr-only'>Prioritás</label><input class='form-control' name='priority' required/><button type='button' class='close reset'>&times;</button><button type='submit' class='close done'>&#10004</button></div></form></li>
											</ul>
										</div>
									</div>
								</div>
						</div>
					</div>
				</div>";
			if($rows%2==0)
			{
				echo "</div>";
			}
		}
	}
if($rows%2!=0)
		echo "</div>";
?>
<script>
	$(document).ready(function(){
		var user;
		var file=new Array();
		var out=0;
		$('.user').hide();
		$('.psw').hide();
		$('.mail').hide();
		$('.telephone').hide();
		$('.bdate').hide();
		$('.prio').hide();
		$('.panel-heading').children('form').hide();
		$('.user_name').on('click',function(){
			$(this).parents('li').hide(1000);
			$(this).parents('li').next().show(1000);
			return false;
		});
		$('.password').on('click',function(){
			$(this).parents('li').hide(1000);
			$(this).parents('li').next().show(1000);
			return false;
		});
		$('.email').on('click',function(){
			$(this).parents('li').hide(1000);
			$(this).parents('li').next().show(1000);
			return false;
		});
		$('.birth').on('click',function(){
			$(this).parents('li').hide(1000);
			$(this).parents('li').next().show(1000);
			return false;
		});
		$('.phone').on('click',function(){
			$(this).parents('li').hide(1000);
			$(this).parents('li').next().show(1000);
			return false;
		});
		$('.priority').on('click',function(){
			$(this).parents('li').hide(1000);
			$(this).parents('li').next().show(1000);
			return false;
		});
		$('.reset').on('click',function(){
			$(this).parents('li').hide(1000);
			$(this).parents('li').prev().show(1000);
			return false;
		});
		$('.delete').on('click',function(){
			var formData=new FormData();
			user=$(this).attr('id');
			formData.append('Id',user);
			$.ajax({
			url: 'user_delete.php',
			type: 'POST',
			data: formData,
			contentType: false,       
			cache: false,            
			processData:false,
			success: function(data){
				$('#user_data').load('Users_data.php');
				}
			});
			return false;
		});
		$('.data').on('click',function(){
			$(this).next().toggle(1000);
			return false;
		});
		$('.firstn_secondn').on('click',function(){
			$(this).siblings('h4').hide(1000);
			$(this).hide(1000);
			$(this).siblings('form').show(1000);
			return false;
		});
		$('.back').on('click',function(){
			$(this).parents('form').siblings('h4').show(1000);
			$(this).parents('form').siblings('button').show(1000);
			$(this).parents('form').hide(1000);
			return false;
		});
		$('.panel-heading').children('form').on('submit',function(e){
			var formData=new FormData(this);
			var i=$(this);
			user=i.attr('class');
			formData.append('Id',user);
			$.ajax({
			url: 'user_modify.php',
			type: 'POST',
			data: formData,
			contentType: false,       
			cache: false,            
			processData:false,
			success: function(data){
					i.siblings('h4').html(data);
					i.siblings('h4').show(1000);
					i.siblings('button').show(1000);
					i.hide(1000);
				}
			});
			return false;
		});
		$('.profile_picture').on('dragover', function(){
			$('.profile_picture').addClass('drag');
			return false;
		});
		$('.profile_picture').on('dragleave', function(){
			$('.profile_picture').removeClass('drag');
			return false;
		});
		$('.profile_picture').on('drop', function(e){
			e.preventDefault();
			$('.profile_picture').removeClass('drag');
			user=$(this).children('img').attr('class');
			user=user.substr(0,user.indexOf(' '));
			file[user]=e.originalEvent.dataTransfer.files;
			preview=$(this).children('img');
			var imagefile = file[user][0].type;
			var match= ["image/jpeg","image/png","image/jpg"];
			if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
				{
					alert("Nem megfelelő formátum!");
					return false;
				}
			else
				{
					var reader = new FileReader();
					reader.addEventListener("load", function () {
							$(preview.attr('src',reader.result));
					}, false);

					if (file[user][0]) {
						reader.readAsDataURL(file[user][0]);
					}
				}
		});
		$(".image_upload").on('submit',function(e){
			e.preventDefault();
			var formData= new FormData();
			user=$(this).attr('class');
			user=user.substr(0,user.indexOf(' '));
			if(file[user][0].type!=0)
			{
				formData.delete('file');
				formData.append('file',file[user][0]);
				formData.append('Id',user);
			$.ajax({
				url: 'user_modify.php',
				type: 'POST',
				data: formData,
				contentType: false,       
				cache: false,            
				processData:false,
				success: function(data){
					console.log(data);
				}
				});
			}
			else 
				alert("Nem jelöltél ki új profilképet!");
		});
		$('ul form').on('submit',function(e){
			e.preventDefault();
			var i=$(this);
			user=i.attr('class');
			var formData= new FormData(this);
			formData.append('Id',user);
			$.ajax({
			url: 'user_modify.php',
			type: 'POST',
			data: formData,
			contentType: false,       
			cache: false,            
			processData:false,
			success: function(data){
					i.parents('li').hide(1000);
					if(data=='Username error')
						alert('Már létező felhasználónevet adtál meg. Kérlek válassz másikat!');
					else if(data=='Date error')
						alert('Téves dátum formátum. Kérlek add meg a következőnek megfelelően: yyyy.mm.dd');
					else if(data=='Phone error')
						alert('Téves telefonszám formátum. Kérlek add meg a következőnek megfelelően: 06705426422');
					else if(data=='Priority error')
						alert('Helytelen prioritás érték. Csak 1-től 3-ig létezik prioritás!');
					else
						i.parents('li').prev().children('p').children('span').html(data)
					i.parents('li').prev().show(1000);
				}
			});
			return false;
		});
		$('.panel-heading').find('input').on('click',function(e){
				$(this).val("");
		});
	});
</script>