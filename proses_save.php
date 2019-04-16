<!--
Author : Aguzrybudy
Created : Selasa, 19-April-2016
Title : Crud Menggunakan Modal Bootsrap
-->
<?php
include "koneksi.php";
$nama_gejala = $_POST['nama_gejala'];
$kode_gejala = $_POST['kode_gejala'];
mysql_query("INSERT INTO tb_gejala (nama_gejala,kode_gejala) VALUES ('$nama_gejala','$kode_gejala')");
header('location:data_gejala.php');
?>