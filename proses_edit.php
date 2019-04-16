
<?php
	include "koneksi.php";
	$id_gejala=$_POST['id_gejala'];
	$kode_gejala = $_POST['kode_gejala'];
	$nama_gejala = $_POST['nama_gejala'];
	$tb_gejala=mysql_query("UPDATE tb_gejala SET nama_gejala = '$nama_gejala', kode_gejala = '$kode_gejala' WHERE id_gejala = '$id_gejala'");
	header('location:data_gejala.php');
?>