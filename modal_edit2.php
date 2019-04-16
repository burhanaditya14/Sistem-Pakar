
<?php
    include "koneksi.php";
	$id_kerusakan=$_GET['id_kerusakan'];
	$tb_kerusakan=mysql_query("SELECT * FROM tb_kerusakan WHERE id_kerusakan='$id_kerusakan'");
	while($r=mysql_fetch_array($tb_kerusakan)){
?>

<div class="modal-dialog">
    <div class="modal-content">

    	<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Edit Data Menggunakan Modal Boostrap (popup)</h4>
        </div>

        <div class="modal-body">
        	<form action="proses_edit2.php" name="modal_popup" enctype="multipart/form-data" method="POST">
        		
                <div class="form-group" style="padding-bottom: 20px;">
                	<label for="Kode Kerusakan">Kode Kerusakan</label>
                    <input type="hidden" name="id_kerusakan"  class="form-control" value="<?php echo $r['id_kerusakan']; ?>" />
                    <p></p>
     				<input type="text" name="kode_kerusakan"  class="form-control" value="<?php echo $r['kode_kerusakan']; ?>"/>
                    <p></p>

                    <label for="Nama Kerusakan">Nama Kerusakan</label>
                    <input type="text" name="nama_kerusakan"  class="form-control" value="<?php echo $r['nama_kerusakan']; ?>"/>
                <p></p>
                	<label for="Solusi">Solusi</label>
     				<textarea name="solusi_kerusakan"  class="form-control"><?php echo $r['solusi_kerusakan']; ?></textarea>
                    <p></p>
                    <label for="Densitas">Densitas</label>
                    <input type="text" name="densitas"  class="form-control" value="<?php echo $r['densitas']; ?>"/>
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