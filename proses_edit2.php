
<?php
	include "koneksi.php";
	$id_kerusakan=$_POST['id_kerusakan'];
	$kode_kerusakan = $_POST['kode_kerusakan'];
	$nama_kerusakan = $_POST['nama_kerusakan'];
	$solusi_kerusakan = $_POST['solusi_kerusakan'];
	$densitas = $_POST['densitas'];


	$tb_kerusakan=mysql_query
	("UPDATE tb_kerusakan SET kode_kerusakan = '$kode_kerusakan', nama_kerusakan = '$nama_kerusakan', solusi_kerusakan ='$solusi_kerusakan', densitas = '$densitas' WHERE id_kerusakan = '$id_kerusakan'");
	header('location:data_kerusakan.php');
?>