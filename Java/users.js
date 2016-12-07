$(document).ready(function(){
		var user;
		var changes=new Array(); 
		var file=new Array();
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
		function del(onclick,Url,whereload,geturl,sendurl){
			$(onclick).on('click',function(){
				var formData=new FormData();
				user=$(this).attr('id');
				formData.append('Id',user);
				$.ajax({
				url: Url,
				type: 'POST',
				data: formData,
				contentType: false,       
				cache: false,            
				processData:false,
				success: function(data){
					getdata(geturl,sendurl,whereload);
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
		toggle('.user_name');
		toggle('.password');
		toggle('.email');
		toggle('.birth');
		toggle('.phone');
		toggle('.priority');

		back('.reset');
	
		del('.delete','user_delete.php','#user_data','user_database.php','Users_data.php');

		toggle_data('.data');

		name('.firstn_secondn');

		backname('.back');

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
	
		$('.panel-heading').find('input').on('click',function(e){
				$(this).val("");
		});
	
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