
<?php
    include "koneksi.php";
	$id_relasi=$_GET['id_relasi'];
	$tb_relasi=mysql_query("SELECT * FROM tb_relasi WHERE id_relasi='$id_relasi'");
	while($r=mysql_fetch_array($tb_relasi)){
?>

<div class="modal-dialog">
    <div class="modal-content">

    	<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Edit Data Menggunakan Modal Boostrap (popup)</h4>
        </div>

        <div class="modal-body">
        	<form action="proses_edit3.php" name="modal_popup" enctype="multipart/form-data" method="POST">
        		
              
            <div class="form-group" style="padding-bottom: 20px;">

                    <label for="Kode Kerusakan">Kode Kerusakan</label>
                    <input type="hidden" name="id_relasi"  class="form-control" value="<?php echo $r['id_relasi']; ?>" />
                    <p></p>
                 
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

             <?php } ?>

            </div>

           
        </div>
    </div>