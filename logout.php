
<?php
	include "database.php";
	session_start();

	unset($_SESSION["AID"]);
	unset($_SESSION["ANAME"]);
	unset($_SESSION["ogretmen_id"]);
	unset($_SESSION["ogrenci_id"]);

	session_destroy();
	echo "<script>window.open('/index.php', '_self');</script>";
?>
