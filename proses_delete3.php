
<?php
	include "koneksi.php";
	$id_relasi=$_GET['id_relasi'];
	mysql_query("Delete FROM tb_relasi WHERE id_relasi='$id_relasi'");
	header('location:data_relasi.php');
	
?>