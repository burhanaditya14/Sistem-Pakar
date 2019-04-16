<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	




  $logoutGoTo = "/TA/logout.php";
  
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Sistem Pakar</title>

    <!-- Bootstrap -->
	<link rel="shortcut icon" href="/TA/gambar/download.jpg" type="image/x-icon"/>
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="/TA/css/bootstrap.min.css">
	

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
<!--
.style2 {color: #FFFFFF}
-->
    </style>
	
	<style type="text/css">
      .navbar-sau{
  background-color:  #0033CC;
  border-radius: 0;
  border:#fff;
  
       }
    </style>
	
	
</head>

<body>
<nav class="navbar navbar-sau">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header info">
    <button type="btn btn-info" class="navbar-toggle collapsed" data-toggle="collapse"  data-target="#bs-example-navbar-collapse-1" aria-expanded"false" style="background-color: #ffffff;">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"style="background-color: #333333;"></span>
        <span class="icon-bar"style="background-color: #333333;"></span>
        <span class="icon-bar"style="background-color: #333333;"></span>      
		</button>
      	<a class="navbar-brand" href="#"><span style="color: #FFFFFF"><B>SAU</B><span></a>    
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" 
          style="background-color: #0033cc">
      <ul class="nav navbar-nav">
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
		<li style="background-color:#FFFFFF"><a href="Konsultasi.php"style="color: #000">Konsultasi</a></li>
		<li class=" btn-primary  dropdown" style="background-color: #fff">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" 
           aria-haspopup="true" aria-expanded="false" style="color: #000">DATA <span class="caret"></span></a>
          
		  <ul class="dropdown-menu">
            <li><a href="/TA/datagejala.php">Data Gejala </a></li>
            <li><a href="/TA/datakerusakan.php">Data Kerusakan</a></li>
            <li><a href="/TA/datarelasi.php">Data Relasi</a></li>
          </ul>
        </li>
		
		<li class=" btn-primary  dropdown" style="background-color: #fff">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" 
           aria-haspopup="true" aria-expanded="false" style="color: #000">PAKAR <span class="caret"></span></a>
          
		  <ul class="dropdown-menu">
            <li><a href="/TA/data_gejala.php">Input Gejala </a></li>
            <li><a href="/TA/data_kerusakan.php">Input Kerusakan</a></li>
            <li><a href="/TA/data_relasi.php">Input Relasi</a></li>
          </ul>
        </li>
		<li class=" btn-primary  dropdown" style="background-color:#fff">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" 
                aria-haspopup="true" aria-expanded="false" style="color: #000">Akun <span class="caret"></span></a>
          <ul class="dropdown-menu">
              <li><a href="/TA/login.php">Login</a></li>
          <li><a href="#" data-toggle="modal" data-target="#logoutModal">Log Out</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


<div class="modal" id="logoutModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4>Log Out <i class="fa fa-lock"></i></h4>
      </div>
      <div class="modal-body">
        <p><i class="fa fa-question-circle"></i> Apa anda yakin ingin keluar dari sistem ? <br /></p>
        <div class="actionsBtns">
            <form action="/logout" method="post">
                <button type="button" class="btn btn-default"> <a href="<?php echo $logoutAction ?>">Ya</a> </button>
                  <button class="btn btn-default" data-dismiss="modal">Tidak <a href="#"> </button>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>





</body>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    
	<nav class="navbar navbar-inverse navbar-fixed-bottom">
  <div class="container">
    <footer>
                        <div class="container">
                        <h2></h2>
                        <p class ="pull-right "><a href ="#">Back To Top</a></p>
                        <p><a style="color:#FFFFFF">&copy; 2017 Burhan Aditya  &middot; <a href ="home.php">Home</a></p>
                        </div></footer>
  </div>
</nav>            
</html>
