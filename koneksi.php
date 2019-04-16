
<?php
	$host="localhost";
	$user="root";
	$pass="";
	$database_koneksi = "db_pakar";
	mysql_connect($host,$user,$pass) or die("Error Connect DB ".mysql_error());
	mysql_select_db("db_pakar") or die("Database Tidak Ada. ".mysql_error());
?>