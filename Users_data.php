<?php
	if (session_status() == PHP_SESSION_NONE) /*ha nincs futó munkafolyamat, akkor indítok egyet, hogy elérhessem a session változókat*/
	{
		session_start();
	}
	$rows=0; /*Ezzel tartom számon a kiírni kivánt elemek számát*/
	include('connection_database.php'); /*kapcsolódok az adatbázishoz*/
	$res=pg_query($con,"select * from users"); /*kilistázom a felhasználókat, a listázót kivéve*/
	while($result=pg_fetch_array($res))
	{
		if(isset($_SESSION["Id"]) && $_SESSION["Id"]!=$result["Id"] && isset($_SESSION["priority"]) && $_SESSION["priority"]==1)
		{
			$picture=$result["profile_pic"];
			if($rows%2==0)/*Egy sorban 2 elemet jelenítek meg, ezért, ha az elemek száma 2-vel osztva 0-át ad maradékul akkor új sort kell kezdenem*/
			{
				echo "<div class='row'>";
			}
			$rows=$rows+1;/*növelem az elemek számát, és kiírom az adott elemet*/
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
												<button type='button' class='".$result["Id"]." btn btn-primary list-group-item' ><p align='center'>Értesítés</p></button>
											</ul>
										</div>
									</div>
								</div>
						</div>
					</div>
				</div>";
			if($rows%2==0)/*ha az elemszám növelése után 2-vel osztva 0-át add maradékul akkor le kell zárnom a sort*/
			{
				echo "</div>";
			}
		}
	}
if($rows%2!=0)/* ha nem páros számú felhasználóm van, akkor is az utolsó után le kell zárnom a sort*/
		echo "</div>";
?>
<script>
	$(document).ready(function(){
		var user; /* a felhasználó azonosítója*/
		var changes=new Array(); /*ezzel tartom számon a változásokat*/
		var file=new Array(); /*fontos, hogy tudjam, hogy melyik felhasználóhoz tartozik a cserélni kívánt fájl*/
		/*Elrejtem a meg nem nyitott formokat*/
		function hide(option){
			$(option).hide();
			return false;
		};
		function toggle(option){
			$(option).on('click',function(){
				$(this).parents('li').hide(1000);
				$(this).parents('li').next().show(1000);
				return false;
			});
			return false;
		};
		function back(option){
			$(option).on('click',function(){
				$(this).parents('li').hide(1000);
				$(this).parents('li').prev().show(1000);
				return false;
			});
			return false;
		};
		function toggle_data(option){
				$(option).on('click',function(){
				$(this).next().toggle(1000);
				return false;
			});
			return false;
		};
		function name(option){
			$(option).on('click',function(){
				$(this).siblings('h4').hide(1000);
				$(this).hide(1000);
				$(this).siblings('form').show(1000);
				return false;
			});
			return false;
		};
		function backname(option){
			$(option).on('click',function(){
				$(this).parents('form').siblings('h4').show(1000);
				$(this).parents('form').siblings('button').show(1000);
				$(this).parents('form').hide(1000);
				return false;
			});
			return false;
		};
		function del(onclick,Url,whereload,whatload){
			$(onclick).on('click',function(){
				var formData=new FormData();
				user=$(this).attr('id');/*Megmondom, hogy melyik felhasználót törölje*/
				formData.append('Id',user);/*És elküldöm az azonosítóját*/
				$.ajax({
				url: Url,
				type: 'POST',
				data: formData,
				contentType: false,       
				cache: false,            
				processData:false,
				success: function(data){
					$(whereload).load(whatload);/*Frissítem az oldal megfelelő részét, ezzel aszinkron törölve a felhasználót*/
					}
				});
				return false;
			});
			return false;
		};
		
		hide('.user');
		hide('.psw');
		hide('.mail');
		hide('.telephone');
		hide('.bdate');
		hide('.prio');
		$('.panel-heading').children('form').hide();
		/*Ha rákattintok a modoítás ikonra, akkor jelenjen meg az alatta lévő form, és ömaga pedig tünjün el*/
		toggle('.user_name');
		toggle('.password');
		toggle('.email');
		toggle('.birth');
		toggle('.phone');
		toggle('.priority');
		/*Ha az x-re nyomok rá akkor visszavonom a modosítást, vagyis tünjön el a form, és jelenjen meg a felette lévő elem*/
		back('.reset');
		/*A felhasználó törlése*/
		del('.delete','user_delete.php','#user_data','Users_data.php');
		/*Az adatok gombra kattintva jelenjenek meg a felhasználó adatai*/
		toggle_data('.data');
		/*A felhasználó nevének a módosításához jelenjen meg a form, és tünjön el a felette lévő szöveg*/
		name('.firstn_secondn');
		/*Ha nem modosítom a felhasználó nevét tünjön el a form, és jelenjen meg a felette lévő szöveg*/
		backname('.back');
		/*Ha modosítom a felhasználó nevét el is kell küldenem*/
		$('.panel-heading').children('form').on('submit',function(e){
			var formData=new FormData(this);
			var i=$(this);
			user=i.attr('class'); /*A form class-ja a felhasználó azonosítója*/
			formData.append('Id',user);
			$.ajax({
			url: 'user_modify.php',
			type: 'POST',
			data: formData,
			contentType: false,       
			cache: false,            
			processData:false,
			success: function(data){
					var result= jQuery.parseJSON(data);
					i.siblings('h4').html(result.firstname+" "+ result.lastname);
					i.siblings('h4').show(1000);
					i.siblings('button').show(1000);
					i.hide(1000);
					changes[user]=jQuery.extend(changes[user], result);
					console.log(changes[user]);
				}
			});
			return false;
		});
		/*Drag & drop képfeltöltés*/
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
			user=$(this).children('img').attr('class'); /*A kép class-jának első eleme a felhasználó azonosítója*/
			user=user.substr(0,user.indexOf(' '));
			file[user]=e.originalEvent.dataTransfer.files;
			preview=$(this).children('img');
			var imagefile = file[user][0].type;
			var match= ["image/jpeg","image/png","image/jpg"];/*Megvizsgálom, hogy megfelelő formátumú-e a feltölteni kívánt fájl*/
			if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
				{
					alert("Nem megfelelő formátum!");
					return false;
				}
			else
				{
					/*megjelenítem a drag & drop-olt fájlt*/
					var reader = new FileReader();
					reader.addEventListener("load", function () {
							$(preview.attr('src',reader.result));
					}, false);

					if (file[user][0]) {
						reader.readAsDataURL(file[user][0]);
					}
				}
		});
		/*Ha megynomom a csere gombot kicserli a felhasználó profilképét*/
		$(".image_upload").on('submit',function(e){
			e.preventDefault();
			var formData= new FormData();
			user=$(this).attr('class');
			user=user.substr(0,user.indexOf(' '));/*A form class-jának első tagja a felhasználó azonosítója*/
			if(typeof(file[user])!='undefined' && file[user]!=0)
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
				success: function(result){
					var data= jQuery.parseJSON(result);
					changes[user]=jQuery.extend(changes[user], data);
					file[user]=0;
				}
				});
			}
			else 
				alert("Nem jelöltél ki új profilképet!");
		});
		/*A felhasználó modosított adatainak a továbbítása*/
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
			success: function(result){
					var data= jQuery.parseJSON(result);
					i.parents('li').hide(1000);
					if(data.error.username)
						alert('Már létező felhasználónevet adtál meg. Kérlek válassz másikat!');
					else if(data.error.date)
						alert('Téves dátum formátum. Kérlek add meg a következőnek megfelelően: yyyy.mm.dd');
					else if(data.error.phone)
						alert('Téves telefonszám formátum. Kérlek add meg a következőnek megfelelően: 06705426422');
					else if(data.error.priority)
						alert('Helytelen prioritás érték. Csak 1-től 3-ig létezik prioritás!');
					else
					{
						for(x in data)
						{
								if(data[x].length>0)
									i.parents('li').prev().children('p').children('span').html(data[x]);
						}
						changes[user]=jQuery.extend(changes[user], data);
						console.log(changes[user]);
					}
					i.parents('li').prev().show(1000);
				}
			});
			return false;
		});
		/*Ha rákattintok az imput mezőre tünjön el az értéke*/
		$('.panel-heading').find('input').on('click',function(e){
				$(this).val("");
		});
		/*Értesítés küldése a változtatott elemekről*/
		$('ul').children('button').on('click',function(){
			var i=$(this);
			var formData=new FormData();
			user=i.attr('class');
			user=user.substr(0,user.indexOf(' '));
			var data=changes[user];
			for(x in data)
			{
					if(data[x].length>0)
						formData.append(x,data[x]);
			}
			formData.append('Id',user);
			$.ajax({
			url: 'message.php',
			type: 'POST',
			data: formData,
			contentType: false,       
			cache: false,            
			processData:false,
			success: function(result){
				console.log(result);
				}
			});
		});
	});
</script>