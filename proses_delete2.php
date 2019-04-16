
<?php
	include "koneksi.php";
	$id_kerusakan=$_GET['id_kerusakan'];
	mysql_query("Delete FROM tb_kerusakan WHERE id_kerusakan='$id_kerusakan'");
	header('location:data_kerusakan.php');
	
?>