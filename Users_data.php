<?php
	$rows=0; 
	$data=json_decode(file_get_contents('php://input'),TRUE);
	foreach ($data as &$value) 
	{
			$picture=$value["profile_pic"];
			if($rows%2==0)
			{
				echo "<div class='row'>";
			}
			$rows=$rows+1;
			echo "<div class='col-sm-6'>
					<div class='row well'>
						<div class='col-sm-4 text-center well profile_picture'>
							<img src='Profile/".$picture."' class='".$value["Id"]." img-thumbnail img-responsive center-block' style='width: 300px; height: 200px;' title='".$picture."' alt='".$picture."'><br />
							<form class='".$value["Id"]." image_upload'><div class='form-group'><button type='submit' class='btn btn-primary'>Csere</button></div></form>
							<button type='button' class='close delete' id='".$value["Id"]."'>&cross;</button>
						</div>
						<div class='col-sm-6 well'>
								<div class='panel panel-primary'>
									<div class='panel-heading'>
										<button type='button' class='close firstn_secondn'>&#9776;</button>
										<h4 class='panel-title'>".$value["firstname"]." ".$value["lastname"]."</h4>
										<form class='".$value["Id"]."'><div class='form-group'><label class='sr-only'>Keresztnév</label><input class='form-control' name='firstname' placeholder='Keresztnév' value='".$value["firstname"]."' required /></div><div class='form-group'><label class='sr-only'>Vezetéknév</label><input class='form-control' name='lastname' placeholder='Vezetéknév' value='".$value["lastname"]."' required /><button type='button' class='close back'>&times;</button><button type='submit' class='close ok'>&#10004</button></div></form>
									</div>
									<div class='panel-body'><button type='button' class='btn btn-primary data'>Adatok</button>
										<div class='collapse'>
											 <ul class='list-group'>
												<li class='list-group-item'><p>Felhasználónév: <span>".$value["user_name"]." </span><button type='button' class='close user_name'>&#9776;</button></p></li>
												<li class='list-group-item user'><form class='".$value["Id"]."'><div class='form-group'><label class='sr-only'>Felhasználóbév</label><input class='form-control' name='username' required /><button type='button' class='close reset'>&times;</button><button type='submit' class='close done'>&#10004</button></div></form></li>
												<li class='list-group-item'><p>Jelszó: <span>".$value["user_password"]."</span><button type='button' class='close password'>&#9776;</button></p></li>
												<li class='list-group-item psw'><form class='".$value["Id"]."'><div class='form-group'><label class='sr-only'>Jelszó</label><input class='form-control' name='password' required /><button type='button' class='close reset'>&times;</button><button type='submit' class='close done'>&#10004</button></div></form></li>
												<li class='list-group-item'><p>Email: <span>".$value["email"]."</span><button type='button' class='close email'>&#9776;</button></p></li>
												<li class='list-group-item mail'><form class='".$value["Id"]."'><div class='form-group'><label class='sr-only'>Email</label><input class='form-control' name='email' type='email' required/><button type='button' class='close reset'>&times;</button><button type='submit' class='close done'>&#10004</button></div></form></li>
												<li class='list-group-item'><p>Születésnap: <span>".$value["birthdate"]."</span><button type='button' class='close birth'>&#9776;</button></p></li>
												<li class='list-group-item bdate'><form class='".$value["Id"]."'><div class='form-group'><label class='sr-only'>Születésnap</label><input class='form-control' name='birthdate' required/><button type='button' class='close reset'>&times;</button><button type='submit' class='close done'>&#10004</button></div></form></li>
												<li class='list-group-item'><p>Telefoszám: <span>".$value["phone"]."</span><button type='button' class='close phone'>&#9776;</button></p></li>
												<li class='list-group-item telephone'><form class='".$value["Id"]."'><div class='form-group'><label class='sr-only'>Telefonszám</label><input class='form-control' name='phonenumber' required/><button type='button' class='close reset'>&times;</button><button type='submit' class='close done'>&#10004</button></div></form></li>
												<li class='list-group-item'><p>Prioritási szint: <span>".$value["priority"]."</span><button type='button' class='close priority'>&#9776;</button></p></li>
												<li class='list-group-item prio'><form class='".$value["Id"]."'><div class='form-group'><label class='sr-only'>Prioritás</label><input class='form-control' name='priority' required/><button type='button' class='close reset'>&times;</button><button type='submit' class='close done'>&#10004</button></div></form></li>
												<button type='button' class='".$value["Id"]." btn btn-primary list-group-item' ><p align='center'>Értesítés</p></button>
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
if($rows%2!=0)
		echo "</div>";
unset($value);
?>
<script src="Java/users.js"></script>
