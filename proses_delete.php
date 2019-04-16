
<?php
	include "koneksi.php";
	$id_gejala=$_GET['id_gejala'];
	mysql_query("Delete FROM tb_gejala WHERE id_gejala='$id_gejala'");
	header('location:data_gejala.php');
	
?>