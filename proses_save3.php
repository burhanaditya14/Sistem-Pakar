
<?php
include "koneksi.php";
$id_kerusakan = $_POST['id_kerusakan'];
$id_gejala = $_POST['id_gejala'];

mysql_query("INSERT INTO tb_relasi (id_kerusakan,id_gejala) VALUES ('$id_kerusakan','$id_gejala')");
header('location:data_relasi.php');
?>