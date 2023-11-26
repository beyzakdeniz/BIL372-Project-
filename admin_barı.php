<div class="admin_barı"><br>
<h3 class="text">Menü</h3><br><hr><br>
<ul class="s">
<?php
	if(isset($_SESSION["AID"]))
	{
		echo'
			<li class="li"><a href="admin_home.php">Okul Bilgisi</a></li>
			<li class="li"><a href="ogrenci_ekle.html">Öğrenci Ekle</a></li>
			<li class="li"><a href="calisan_ekle.html">Çalışan Ekle</a></li>
			<li class="li"><a href="gider_ekle.html">Gider Ekle</a></li>
			<li class="li"><a href="ogrencileri_goruntule.html">Öğrencileri Görüntüle</a></li>
			<li class="li"><a href="velileri_goruntule.html">Velileri Görüntüle</a></li>
			<li class="li"><a href="calisanlari_goruntule.html">Çalışanları Görüntüle</a></li>
			<li class="li"><a href="ders_programi_goruntule.html">Ders programı Görüntüle</a></li>
			<li class="li"><a href="giderleri_goruntule.html">Giderleri Görüntüle</a></li>
			<li class="li"><a href="rapor_goruntule.html">Rapor Görüntüle</a></li>
			<li class="li"><a href="logout.php">Logout</a></li>
		
		';
	
	
	}
	else{
		echo'
			<li class="li"><a href="teacher_home.php">Profile</a></li>
			<li class="li"><a href="handle_class.php"> Handled Class</a></li>
			<li class="li"><a href="add_stud.php"> Students</a></li>
			<li class="li"><a href="view_stud_teach.php" target="_blank"> View Student</a></li>

			<li class="li"><a href="tech_view_exam.php">View Exam</a></li>
			<li class="li"><a href="add_mark.php">Add Marks</a></li>
			<li class="li"><a href="view_mark.php">View Marks</a></li>
			<li class="li"><a href="logout.php">Logout</a></li>

		
		';
	}


?>
	

</ul>

</div>