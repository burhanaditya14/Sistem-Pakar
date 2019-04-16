<?php require_once('Connections/koneksi.php'); ?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO user (email, username, password) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['password'], "text"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());

  $insertGoTo = "login.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<?php
	include ("master.php")
	?>
	
<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Bootstrap Snippet: Login Form</title>
  
  
  <link rel='stylesheet' href='http://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css'>

      <link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/style.scss">
<style>
body {
  background: #fff;
  font-family: sans-serif;
}
 
h2 {
  color: #000000;
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
</head>

<body>
<div class="container">
<h2>Form Registrasi</h2>
<div class="well">

    <div class="wrapper">
       <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
      <table align="center">
        <tr valign="baseline">
          <td nowrap align="left">Email:</td>
          <td><input type="email" class="form-control" placeholder="Email" name="email" required /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="left">Username:</td>
          <td><input type="text" class="form-control" placeholder="User Name" name="username" required /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="left">Password:</td>
          <td><input type="password" class="form-control" placeholder="Password" name="password" autocomplete="new-password" required /></td>
		  </tr>
		  
	
        <tr valign="baseline">
          <td nowrap align="right">&nbsp;</td>
          <td><input type="submit"  value="Daftar"></td>
        </tr>
      </table>
      <input type="hidden" name="MM_insert" value="form1">
    </form>
      

  </div>
  </div>  

</body>

</html>
