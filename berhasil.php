<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING |E_DEPRECATED));
include('master2.php');
?>
<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_pakar = "localhost";
$database_pakar = "db_pakar";
$username_pakar = "root";
$password_pakar = "";
$admin = mysql_pconnect($hostname_pakar, $username_pakar, $password_pakar) or trigger_error(mysql_error(),E_USER_ERROR); 
?>



<div class="container">
<h3>Log In Success</h3>

		
		<?php
 		$loginUsername= $_COOKIE['nama_user'];
 		echo "Selamat Datang <b> $loginUsername </b>";
		?>
		


 	
		
		
</div>
</body>
