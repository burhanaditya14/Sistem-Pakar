<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_pakar = "localhost";
$database_pakar = "db_pakar";
$username_pakar = "root";
$password_pakar = "";
$pakar = mysql_pconnect($hostname_pakar, $username_pakar, $password_pakar) or trigger_error(mysql_error(),E_USER_ERROR); 
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['email'])) {
  $loginUsername=$_POST['email'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "/TA/berhasil.php";
  $MM_redirectLoginFailed = "/TA/login_gagal.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_pakar, $pakar);
  
  $LoginRS__query=sprintf("SELECT username, password FROM user WHERE username='%s' AND password='%s'",
    get_magic_quotes_gpc() ? $loginUsername : addslashes($loginUsername), get_magic_quotes_gpc() ? $password : addslashes($password)); 
   
  $LoginRS = mysql_query($LoginRS__query, $pakar) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<?php
include('master.php');
?>

<style>
body {
  background: #fff;
  font-family: sans-serif;
}
 
h2 {
  color: #fff;
}
 
.login {
  padding: 1em;
  margin: 2em auto;
  width: 17em;
  background: #fff;
  border-radius: 3px;
}
 
label {
  font-size: 10pt;
  color: #555;
}
 
input[type="text"],
input[type="password"],
textarea {
  padding: 8px;
  width: 95%;
  background: #efefef;
  border: 0;
  font-size: 10pt;
  margin: 6px 0px;
}
 
.tombol {
  background: #3498db;
  color: #fff;
  border: 0;
  padding: 5px 8px;
  margin: 20px 0px;
}
</style>

<div class="container">
<h3>Maaf Password/Username yang Anda masukkan tidak sesuai</h3>
<h5>Silahkan masukkan kembali username & password anda</h5>
</div>
<div class="container">
<div class="well">
<form action="<?php echo $loginFormAction; ?>" method="POST" id="login">
<div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Email" name="email">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
  
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>
</div>
</div>