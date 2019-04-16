<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "maaf.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php
	include ("master2.php");
   error_reporting(E_ALL ^E_NOTICE ^E_DEPRECATED);
    mysql_connect("127.0.0.1", "root", "");
    mysql_select_db("db_pakar");
?>



<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>

<body>
    <div class="container">

      <table class="table table-bordered" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#000099">
  
  
  <tr>
    <td align="center" valign="top" bgcolor="#FFFFFF"><br />
      <strong>Analisa Menggunakan Sistem Pakar Metode Dempster Shafer</strong><br />
      <br />
<?php
	function irisan($arr1,$arr2)
	{
		$c=-1;
		unset($arrhsl);
		$arrhsl = array();
		for ($i=0;$i<count($arr1);$i++)
		{
			for ($j=0;$j<count($arr2);$j++)
			{
				//echo "$arr1[$i] == $arr2[$j]<br/>";
				if ($arr1[$i] == $arr2[$j])
				{
					$c++;
					$arrhsl[$c] = $arr1[$i];
				}
			}			
		}
		return $arrhsl;
	}
	
	if (!isset($_POST['button']))
	{
?>
<form name="form1" method="post" action=""><br>
  <table class="table table-condensed">
  <tr> 
  <td id="ignore" bgcolor="#DBEAF5" width="300"><div align="center"><strong><font size="2" face="Arial, Helvetica, sans-serif"><font size="2">GEJALA</font> </font></strong></div></td>
    <?php
    $q = mysql_query("select * from tb_gejala ORDER BY id_gejala");
    while ($r = mysql_fetch_row($q)) 
	{ 
	?>        
    <tr><td> 
        <label><input name="<?php echo $r[0]; ?>" type="checkbox" value="<?php echo $r[0]; ?>">
    <?php echo $r[1]; ?></label><br/>                
    </td>    
    </tr>
    <?php } ?>	
    <tr>
      <td colspan="2"><input type="submit" name="button" value="OK"></td>
    </tr>

  </table>
  <h2>.</h2>
  <br>

</form>

</tr>



  <?php
  	exit;
  }
  


  unset($gejala);
  echo "<br/>";
  echo "Gejala Terpilih : <br/>";
  echo "================= <br/>";





  $q = mysql_query("select * from tb_gejala ORDER BY nama_gejala");
  $i = 0;
        while ($r = mysql_fetch_row($q)) {
            if ($_POST[$r[0]] == true) {
                $gejala[$i] = $r[0];
				echo "- ".$r[1].'<br/>';
                $i++;
            }
        }

?>
<table class="table table-bordered" border="1">
    <tr>
      <td class="info" align="center"><strong><font size="2" face="Arial, Helvetica, sans-serif">Densitas Awal</font></strong></td> 
    </tr>
    <tr>
      <td align="center">
<?php
if (count($gejala) > 0) {
        if (count($gejala) == 1) {
        
        unset($kerusakan);
        $i = 0;
        while ($hh = mysql_fetch_row($qq)) {
            $penyakit[$i] = $hh[0];
            $densitas[$i] = $hh[1];
            $i++;
        } 				
    } else {
            $q = mysql_query("select * from tb_gejala ORDER BY nama_gejala");
            $i = 0;
                while ($r = mysql_fetch_row($q)) {
                    if ($_POST[$r[0]] == true) {
                        $idgjl[$i] = $r[0];
                        $i++;
                    }
                }
            unset($m);
            $m = array();
            unset($barishasil);
            unset($nilaihasil);
            $barishasil = array();
            $nilaihasil = array();
            
            for ($k = 1; $k < count($idgjl); $k++) 
            {
                echo "<br/>";
				echo "proses ke".$k.'<br/>';
				echo "============= <br/>";
                if ($k == 1)
                {
                    $gejala = mysql_query ("SELECT * FROM tb_kerusakan WHERE id_kerusakan = '".$idgjl[0]."'");
                    
                    $datagejala = mysql_fetch_array ($gejala);
                    $m[0]=$datagejala['densitas'];
                    $t[0]= 1- $datagejala['densitas'];
                    echo " ".$_POST['Cek'][0]." m[0]=$m[0]<br/>";
                    echo "t[0]=$t[0]<br/>";
                    

                    
                    $gejala = mysql_query ("SELECT * FROM tb_kerusakan WHERE id_kerusakan = '".$idgjl[$k]."'");
                    $datagejala = mysql_fetch_array ($gejala);
                    $m[$k]=$datagejala['densitas'];
                    $t[$k]= 1- $datagejala['densitas'];
                    echo " ".$_POST['Cek'][$k]." m[$k]=$m[$k]<br/>";
                    echo "t[$k]=$t[$k]<br/>";
                    
                    
                    unset ($p0);
                    $strp0= "";
                    $qbasisgejala = mysql_query ("SELECT * FROM tb_relasi WHERE id_gejala = '".$idgjl[0]."'");
                    $c=-1;
                    while ($databasisgejala = mysql_fetch_array ($qbasisgejala))
                    {
                    $c++;
                    $p0[$c] = $databasisgejala ['id_kerusakan'];
                    $strp0 = implode(',',$p0);
                    }
                    unset($p1);
                    $strp1="";
                    $qbasisgejala = mysql_query ("SELECT * FROM tb_relasi WHERE id_gejala = '".$idgjl[1]."'");
                    $c=-1;
                    While ($databasisgejala = mysql_fetch_array ($qbasisgejala))
                    {
                    $c++;
                    $p1[$c] = $databasisgejala ['id_kerusakan'];
                    }
                    $strp1 = implode(',',$p1);
                    ?>
               
      </td>
    </tr>
        </table>





                    <div class="container">
              
  <table class="table table-bordered" table border="1">
                    <tr>
                        <td class="info">&nbsp;</td>
                        <td class="info"><?php echo "m1 $strp1"; ?><?php echo " = $m[1]"; ?></td>
                        <td class="info"><?php echo "t1 = $t[1]"; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo "m0 = $strp0"; ?><?php echo " = $m[0]"; ?></td>
                        <td><?php unset($pp); $pp =array(); $pp = irisan($p0, $p1); $strpp = implode(',', $pp); echo "$strpp =".$m[0]*$m[$k]; ?></td>
                        <td><?php echo "$strp0 =".$m[0]*$t[$k]; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo "t0 = $t[0]"; ?></td>
                        <td><?php echo "$strp1 =".$m[$k]*$t[0]; ?></td>
                        <td><?php echo "&oslash;=".$t[0]*$t[$k]; ?></td>
                    </tr>
        </table>


                    <table class="table table-bordered" border="1">
    <tr>
      <td class="info" align="center"><strong><font size="2" face="Arial, Helvetica, sans-serif">Densitas Baru</font></strong></td> 
    </tr>
    <tr>
      <td align="center">
                    <?php
                    $barishasil[$k][0] = $strpp;
                    $barisnilai[$k][0] = $m[0]*$m[$k];
                    
                    $barishasil[$k][1] = $strp0;
                    $barisnilai[$k][1] = $m[0]*$t[$k];
                    
                    $barishasil[$k][2] = $strp1;
                    $barisnilai[$k][2] = $m[$k]*$t[0];
                    
                    $baristeta[$k] = $t[0]*$t[$k];
                    
                    $tetapembagi = 0;
                    for ($ii = 0; $ii < count($barishasil[$k]); $ii++)
                    {
                        if ($barishasil[$k][$ii] == '')
                        {
                            $tetapembagi += $barisnilai[$k][$ii];
                        }
                    }
					
                    for ($ii = 0; $ii < count($barishasil[$k]); $ii++)
                    {
                        for ($jj = $ii+1; $jj < count($barishasil[$k]); $jj++)
                        {
                            if ($barishasil[$k][$ii] == $barishasil[$k][$jj])
                            {
                                $barisnilai[$k][$ii] += $barisnilai[$k][$jj];
                                $barishasil[$k][$jj] = '';
                            }
                        }
                    }
                }
                else
                {
                    $gejala = mysql_query ("SELECT * FROM tb_kerusakan WHERE id_kerusakan = '".$idgjl[$k]."'");
                    $datagejala = mysql_fetch_array ($gejala);
                    $m[$k]=$datagejala['densitas'];
                    $t[$k]= 1- $datagejala['densitas'];
                    echo "m[$k]=$m[$k]<br/>";
                    echo "t[$k]=$t[$k]<br/>";
                    
                    unset($p1);
                    $strp1="";
                    $qbasisgejala = mysql_query ("SELECT * FROM tb_relasi WHERE id_gejala = '".$idgjl[$k]."'");
                    $c=-1;
                    while ($databasisgejala = mysql_fetch_array ($qbasisgejala))
                    {
                    $c++;
                    $p1[$c] = $databasisgejala ['id_kerusakan'];
                    }
                    $strp1 = implode(',',$p1);
                    
                    for ($i=0; $i<count($barishasil[$k-1]); $i++)
                    {
                        echo $barishasil[$k-1][$i]." ".$barisnilai[$k-1][$i]." / (1 - ".$tetapembagi.") = ";
                        $barisnilai[$k-1][$i] = $barisnilai[$k-1][$i] / (1 - $tetapembagi);
                        echo " ".$barisnilai[$k-1][$i]." <br/>";
                    }
                    
                    echo "&oslash; ".$baristeta[$k-1]." / (1 - ".$tetapembagi.") = "; 
                    $baristeta[$k-1] = $baristeta[$k-1] / (1 - $tetapembagi); 
                    echo " ".$baristeta[$k-1]." <br/>";
                    ?>
                    

</td>
</tr>
</table>


                    <div class="container">
                    <table class="table table-bordered table border="1">
                    <tr>
                        <td class="info">&nbsp;</td>
                        <td class="info"><?php echo "m$k $strp1"; ?><?php echo " = $m[$k]"; ?></td>
                        <td class="info"><?php echo "t$k = $t[$k]"; ?></td>
                    </tr>
                    <?php 
                    $zz=-1;
                    for ($i=0; $i<count($barishasil[$k-1]); $i++)
                    {
                        if ($barishasil[$k-1][$i] != '')
                        {
                    ?>
                    <tr>
                        <td><?php echo $barishasil[$k - 1][$i]." = ".$barisnilai[$k-1][$i].""; ?></td>
                        <td><?php unset($pp); $pp =array(); $arrh = explode(',',$barishasil[$k-1][$i]); $pp = irisan($arrh, $p1); $strpp = implode(',', $pp); echo "$strpp =".$barisnilai[$k-1][$i]*$m[$k]; ?></td>
                        <td><?php echo $barishasil[$k-1][$i]." =".$barisnilai[$k-1][$i]*$t[$k]; ?></td>
                    </tr>
                    <?php
                            $zz++;
                            $barishasil[$k][$zz] = $strpp;
                            $barisnilai[$k][$zz] = $barisnilai[$k-1][$i]*$m[$k];
                            
                            $zz++;
                            $barishasil[$k][$zz] = $barishasil[$k-1][$i];
                            $barisnilai[$k][$zz] = $barisnilai[$k-1][$i]*$t[$k];
                        }
                    }
                    
                    $zz++;
                    $barishasil[$k][$zz] = $strp1;
                    $barisnilai[$k][$zz] = $m[$k]*$baristeta[$k-1];
                    
                    $baristeta[$k] = $baristeta[$k-1]*$t[$k];
                    
                    $tetapembagi = 0;
                    for ($ii = 0; $ii < count($barishasil[$k]); $ii++)
                    {
                        if ($barishasil[$k][$ii] == '')
                        {
                            $tetapembagi += $barisnilai[$k][$ii];
                        }
                    }

                    for ($ii = 0; $ii < count($barishasil[$k]); $ii++)
                    {
                        for ($jj = $ii+1; $jj < count($barishasil[$k]); $jj++)
                        {
                            if ($barishasil[$k][$ii] == $barishasil[$k][$jj])
                            {
                                $barisnilai[$k][$ii] += $barisnilai[$k][$jj];
                                $barishasil[$k][$jj] = '';
                            }
                        }
                    }
                    ?>
                    <tr>
                        <td><?php echo "teta = ".$baristeta[$k-1]; ?></td>
                        <td><?php echo "$strp1 =".$m[$k]*$baristeta[$k-1]; ?></td>
                        <td><?php echo "&oslash;=".$baristeta[$k-1]*$t[$k]; ?></td>
                    </tr>
                    </table>




<table class="table table-bordered" border="1">
    <tr>
      <td class="info" align="center"><strong><font size="2" face="Arial, Helvetica, sans-serif">Perankingan</font></strong></td> 
    </tr>
    <tr>
      <td align="center">
                    <?php
                }
            }
            
            $strp1 = implode(',',$p1);
                    
            $arrpenyterbesar = array();
            $strpenyterbesar = "";
            $nilaipenyterbesar = -10;
            
            for ($i=0; $i<count($barishasil[$k-1]); $i++)
            {
                echo $barishasil[$k-1][$i]." ".$barisnilai[$k-1][$i]." / (1 - ".$tetapembagi.") = ";
                $barisnilai[$k-1][$i] = $barisnilai[$k-1][$i] / (1 - $tetapembagi);
                echo " ".$barisnilai[$k-1][$i]." <br/>";
                
                if (($nilaipenyterbesar < $barisnilai[$k-1][$i]) && ($barishasil[$k-1][$i] != "")) { $strpenyterbesar = $barishasil[$k-1][$i]; $nilaipenyterbesar = $barisnilai[$k-1][$i]; }
            }
            
            echo "&oslash; ".$baristeta[$k-1]." / (1 - ".$tetapembagi.") = "; 
            $baristeta[$k-1] = $baristeta[$k-1] / (1 - $tetapembagi); 
            echo " ".$baristeta[$k-1]." <br/>"; 
            if ($nilaipenyterbesar < $baristeta[$k-1]) { $strpenyterbesar = "&oslash;"; $nilaipenyterbesar = $baristeta[$k-1]; }
            echo "<br/>";

}
}
?>
</td>
</tr>
</table>

<table class="table table-bordered" border="1">
    <tr>
      <td class="info" align="center"><strong><font size="2" face="Arial, Helvetica, sans-serif">Array Terbesar</font></strong></td> 
    </tr>
    <tr>
      <td align="center">
<?php
   
            echo "".$strpenyterbesar." = ".$nilaipenyterbesar."<br/>";
            
			
            ?></td>
      </tr>
    </table>
    <?php
            $arrpenyterbesar = explode(",", $strpenyterbesar);
            $strhslpenyakit = "";
            for ($i=0;$i<count($arrpenyterbesar);$i++)
            {
                $querypeny = mysql_query("SELECT * FROM tb_kerusakan WHERE id_kerusakan = '$arrpenyterbesar[$i]'");
                $datapeny = mysql_fetch_array($querypeny);
                ($i+1).$datapeny['nama_kerusakan']."<br/>";
                $arrnmpenyterbesar[$i] = $datapeny['nama_kerusakan'];
                $arrnmnoteterbesar[$i] = $datapeny['solusi_kerusakan'];
                if ($i==0) { $strhasilpenyakit .= $datapeny['nama_kerusakan']; } else { $strhasilpenyakit .= ','.$datapeny['nama_kerusakan']; 
            }

}

  ?>

  



   
  <table class="table table-bordered" border="1">
	<tr>
	  <td class="info" align="center"><strong><font size="2" face="Arial, Helvetica, sans-serif">Nama Kerusakan</font></strong></td>
	  <td class="info"  align="center"><strong><font size="2" face="Arial, Helvetica, sans-serif">Nilai Probabilitas</font></strong></td>

	</tr>
	<tr>
	  <td><?php
		for ($i = 0; $i < count($arrnmpenyterbesar); $i++)
		{
			echo $arrnmpenyterbesar[$i]."<br/>";
		}
	  ?></td>
	  <td valign="top"><?php echo round($nilaipenyterbesar*100,1)."%"  ; ?></td>
	</tr>
  </table>



<table class="table table-bordered" border="1">
    <tr>
      <td class="info" align="center"><strong><font size="2" face="Arial, Helvetica, sans-serif">Solusi Kerusakan</font></strong></td> 
    </tr>
    <tr>
      <td><?php
        for ($i = 0; $i < count($arrnmpenyterbesar); $i++)
        {
            echo $arrnmnoteterbesar[$i]."<br/>";
        }
      ?></td>
      
    </tr>
  </table>
  
 <a href="Konsultasi.php"> 
    <button onClick="window.print();">Print</button> 
    </a>

</body>
<h3>.</h3>
</html>