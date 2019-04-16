<?php
	include "koneksi.php";
	$id_relasi =$_POST['id_relasi'];
	$id_kerusakan = $_POST['id_kerusakan'];
	$id_gejala = $_POST['id_gejala'];
	

	$tb_relasi=mysql_query
	("UPDATE tb_relasi SET id_kerusakan = '$id_kerusakan', id_gejala = '$id_gejala' WHERE id_relasi = '$id_relasi'");
	header('location:data_relasi.php');
?>

