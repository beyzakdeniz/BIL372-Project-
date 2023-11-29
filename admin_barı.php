<div class="admin_barı"><br>
<h3 class="text">Menü</h3><br><hr><br>
<ul class="s">
<?php
	if(isset($_SESSION["AID"]))
	{
		echo'
			<li class="li"><a href="ogrenci_ekle.html">Öğrenci Ekle</a></li>
			<li class="li"><a href="calisan_ekle.html">Çalışan Ekle</a></li>
			<li class="li"><a href="gider_ekle.html">Gider Ekle</a></li>
			<li class="li"><a href="ogrenci_goruntule.html">Öğrencileri Görüntüle</a></li>
			<li class="li"><a href="veli_goruntule.html">Velileri Görüntüle</a></li>
			<li class="li"><a href="calisan_goruntule.html">Çalışanları Görüntüle</a></li>
			<li class="li"><a href="ders_programi_goruntule.html">Ders programı Görüntüle</a></li>
			<li class="li"><a href="rapor_goruntule.html">Rapor Görüntüle</a></li>
			<li class="li"><a href="logout.php">Logout</a></li>
		
		';
	
	}

?>
	

</ul>

</div>