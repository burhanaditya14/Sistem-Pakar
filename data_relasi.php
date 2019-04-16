<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "admin";
$MM_donotCheckaccess = "false";

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
    if (($strUsers == "") && false) { 
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

<head>

<?php
include ('master2.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

</head>
<body>
 


<div class="container">
 
  <h2>Data Relasi</h2>

  <p><a href="#" class="btn btn-success" data-target="#ModalAdd" data-toggle="modal">Tambah Data</a></p>      

<table id="mytable" class="table table-bordered">
    <thead>
      <th>No</th>
       <th>Id Kerusakan</th>
      <th>Id Gejala</th>
      <th>Action</th>
    </thead>
<?php 
  //menampilkan data mysqli
  include "koneksi.php";
  $no = 0;
  $tb_relasi=mysql_query("SELECT * FROM tb_relasi");
  while($r=mysql_fetch_array($tb_relasi))
  {
  $no++;
       
?>
  <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo  $r['id_kerusakan']; ?></td>
      <td><?php echo  $r['id_gejala']; ?></td>
      
      <td>
         <a href="#" class='open_modal' id='<?php echo  $r['id_relasi']; ?>'><img src="/SistemPakar/gambar/edit-icon-png-3596-16x16.ico" /></a> |

         <a href="#" onClick="confirm_modal('proses_delete3.php?&id_relasi=<?php echo  $r['id_relasi']; ?>');"><img src="/SistemPakar/gambar/remove-icon-png-7131-16x16.ico" /></a>
      </td>
  </tr>
 

<?php } ?>
</table>
</div>
<h2></h2>
<!-- Modal Popup untuk Add--> 
<div id="ModalAdd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Add Data Using Modal Boostrap (popup)</h4>
        </div>

        <div class="modal-body">
          <form action="proses_save3.php" name="modal_popup" enctype="multipart/form-data" method="POST">

            <div class="form-group" style="padding-bottom: 20px;">
                <label for="id_kerusakan">ID Kerusakan </label>
                <?php virtual('/TA/Connections/pakar.php'); ?>
                <?php
                mysql_select_db($database_pakar, $pakar);
                $query_pro = "SELECT * FROM tb_kerusakan";
                $pro = mysql_query($query_pro, $pakar) or die(mysql_error());
                $row_pro = mysql_fetch_assoc($pro);
                $totalRows_pro = mysql_num_rows($pro);
                ?>
                <p></p>
                <select name="id_kerusakan" class="form-control" id="id_kerusakan">
                <?php
                do {  
                ?>
                <option value="<?php echo $row_pro['id_kerusakan']?>"><?php echo $row_pro['nama_kerusakan']?></option>
              </div>
                <?php
                } while ($row_pro = mysql_fetch_assoc($pro));
                  $rows = mysql_num_rows($pro);
                  if($rows > 0) {
                      mysql_data_seek($pro, 0);
                    $row_pro = mysql_fetch_assoc($pro);
                  }
                ?>
                  </select>
                </div>

<div class="form-group" style="padding-bottom: 20px;">
  <label for="id_gejala">ID Gejala</label>
    
  <?php virtual('/TA/Connections/pakar.php'); ?>
  <?php
  mysql_select_db($database_pakar, $pakar);
  $query_evidence = "SELECT * FROM tb_gejala";
  $evidence = mysql_query($query_evidence, $pakar) or die(mysql_error());
  $row_evidence = mysql_fetch_assoc($evidence);
  $totalRows_evidence = mysql_num_rows($evidence);
  ?>
  <select name="id_gejala" class="form-control" id="id_gejala">
    <?php
  do {  
  ?>
    <option value="<?php echo $row_evidence['id_gejala']?>"><?php echo $row_evidence['nama_gejala']?></option>
    <?php
  } while ($row_evidence = mysql_fetch_assoc($evidence));
    $rows = mysql_num_rows($evidence);
    if($rows > 0) {
      mysql_data_seek($evidence, 0);
    $row_evidence = mysql_fetch_assoc($evidence);
    }
  ?>
  </select>
                </div>
            
                
                

              <div class="modal-footer">
                  <button class="btn btn-success" type="submit">
                      Confirm
                  </button>

                  <button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true">
                    Cancel
                  </button>
              </div>

              </form>

           

            </div>

           
        </div>
    </div>
</div>

<!-- Modal Popup untuk Edit--> 
<div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>

<!-- Modal Popup untuk delete--> 
<div class="modal fade" id="modal_delete">
  <div class="modal-dialog">
    <div class="modal-content" style="margin-top:100px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" style="text-align:center;">Are you sure to delete this information ?</h4>
      </div>
                
      <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
        <a href="#" class="btn btn-danger" id="delete_link">Delete</a>
        <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
</div>


<!-- Javascript untuk popup modal Edit--> 
<script type="text/javascript">
   $(document).ready(function () {
   $(".open_modal").click(function(e) {
      var m = $(this).attr("id");
       $.ajax({
             url: "modal_edit3.php",
             type: "GET",
             data : {id_relasi: m,},
             success: function (ajaxData){
               $("#ModalEdit").html(ajaxData);
               $("#ModalEdit").modal('show',{backdrop: 'true'});
             }
           });
        });
      });
</script>

<!-- Javascript untuk popup modal Delete--> 
<script type="text/javascript">
    function confirm_modal(delete_url)
    {
      $('#modal_delete').modal('show', {backdrop: 'static'});
      document.getElementById('delete_link').setAttribute('href' , delete_url);
    }
</script>

</body>



<h1>.</h1>

  
  </html>

  



