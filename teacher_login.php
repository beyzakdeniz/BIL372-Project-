<?php
	include "database.php";
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Mahmut Tuncer Kurs Merkezi</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body class="back">
		
		<div class="login">
			<h1 class="heading">Öğretmen Girişi</h1>
			<div class="log">
			<?php
				if(isset($_POST["login"]))
				{
					$sql="select * from ogretmen where ogretmen_id='{$_POST["ogretmen_id"]}'";
					$res=$db->query($sql);
					if($res->num_rows>0)
					{
						$ro=$res->fetch_assoc();
						$_SESSION["ogretmen_id"]=$ro["ogretmen_id"];
						echo "<script>window.open('teacher_home.php','_self');</script>";
					}
					else	
						echo '<script>alert("invalid id, try again")</script>';
					
				}
				if(isset($_GET["mes"]))
				{
					echo "<div class='error'>{$_GET["mes"]}</div>";
				}
				
			?>
		
				<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
					<label>User ID</label><br>
					<input type="text" name="ogretmen_id" required class="input"><br><br>
					<button type="submit" class="btn" name="login">Login Here</button>
				</form>
			</div>
		</div>
		<script src="js/jquery.js"></script>
		 <script>
		$(document).ready(function(){
			$(".error").fadeTo(1000, 100).slideUp(1000, function(){
					$(".error").slideUp(1000);
			});
			
			$(".success").fadeTo(1000, 100).slideUp(1000, function(){
					$(".success").slideUp(1000);
			});
		});
	</script>
		
	
		
	</body>
</html>