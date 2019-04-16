
<?php
include "koneksi.php";
$kode_kerusakan = $_POST['kode_kerusakan'];
$nama_kerusakan = $_POST['nama_kerusakan'];
$solusi_kerusakan = $_POST['solusi_kerusakan'];
$densitas = $_POST['densitas'];
mysql_query("INSERT INTO tb_kerusakan (kode_kerusakan,nama_kerusakan,solusi_kerusakan, densitas) VALUES ('$kode_kerusakan','$nama_kerusakan','$solusi_kerusakan','$densitas')");
header('location:data_kerusakan.php');
?>