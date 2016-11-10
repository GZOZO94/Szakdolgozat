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
$res=pg_query($con,"select * from ref");
while($result2=pg_fetch_array($res))
	{		
			$picture=$result2["prof_picture"];
			if($rows%3==0)
			{
				echo "<div class='row'>";
			}
			$rows=$rows+1;
			echo "<div class='col-sm-4 well'>
					<div class='row'>
						<div class='col-sm-4 text-center well well-sm'>
							<a href='References_data.php?ref_Id=".$result2["ref_id"]."'>
								<img src='Uploads/".$picture."' class='img-thumbnail img-responsive center-block' style='width: 100px; height: 100px;' title='".$picture."' alt='".$picture."'>
							</a>
						</div>
						<div class='col-sm-8 well well-sm'>";
			if(isset($_SESSION["priority"]) && $_SESSION["priority"]<3) echo "<button type='button' class='".$result2["ref_id"]." close delete'>&cross;</button><button type='button' class='".$result2["ref_id"]." close modify'>&#9776;</button>";
							echo "<a href='References_data.php?ref_Id=".$result2["ref_id"]."'>
								<blockquote class='text-center'>
									<h4><small>".$result2["title"]."</small></h4>
								</blockquote>
									<p class='text-center'>".$result2["text"]."</p>
							</a>
						</div>
					</div>
				</div>";
			if($rows%3==0)
			{
				echo "</div>";
			}
	}
if($rows%3!=0)
		echo "</div>";
	pg_close($con);
?>
<script>
$(document).ready(function(){
	$('.delete').on('click', function(){
		var id=$(this).attr('class');
		id=id.substr(0,id.indexOf(' '));
		var Data=new FormData();
		Data.append("ref_id",id);
		$.ajax({
			url: "delete.php",
			type: 'POST',
			data: Data,
			contentType: false,       
			cache: false,            
			processData:false,
			success: function(data){
				$("#references_about").load("References_about.php");
			}
		});
	});
	$('.modify').on('click',function(){
			$('#modify').modal();
			var formData=new FormData();
			var id=$(this).attr('class');
			id=id.substr(0,id.indexOf(' '));
			formData.append('Id',id);
			$.ajax({
				url: 'ref_modify.php',
				type: 'POST',
				data: formData,
				contentType: false,       
				cache: false,            
				processData:false,
				success: function(data){
					$('#select').html(data);
				}
			});
			return false;
		});
});
</script>