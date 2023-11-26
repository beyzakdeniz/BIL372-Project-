<?php
	include"database.php";
	session_start();
	if(!isset($_SESSION["AID"]))
	{
		echo"<script>window.open('index.php?mes=Access Denied..','_self');</script>";
		
	}		
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Mahmut Tuncer</title>
	    <link rel="icon" type="image/x-icon" href="\favicon.jpg">

		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
	
		<?php include"hesap_secim_barı.php";?><br>
		
		
		<!––img src="favicon.jpg" style="margin-left:90px;" class="sha"-->
			
			<div id="section">
			
				<?php include"admin_barı.php";?><br>
				
				<div class="content">
					<h3 class="text">Hoşgeldin <?php echo $_SESSION["ANAME"]; ?></h3><br><hr><br>
						<h3 > Okul Bilgisi</h3><br>
					<img src="favicon.jpg" class="imgs">
					<p class="para">
						School Management System is a is a complete school management software designed to automate a school's diverse operations from classes, exams to school events calendar. 
					</p>
					
					<p class="para">
						This school software has a powerful online community to bring parents, teachers and students on a common interactive platform. It is a paperless office automation solution for today's modern schools. The School Management System provides the facility to carry out all day to day activities of the school.
					</p>
				</div>
				
			</div>
	</body>
</html>