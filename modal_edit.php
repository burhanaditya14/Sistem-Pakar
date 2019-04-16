<!--
Author : Aguzrybudy
Created : Selasa, 19-April-2016
Title : Crud Menggunakan Modal Bootsrap
-->
<?php
    include "koneksi.php";
	$id_gejala=$_GET['id_gejala'];
	$tb_gejala=mysql_query("SELECT * FROM tb_gejala WHERE id_gejala='$id_gejala'");
	while($r=mysql_fetch_array($tb_gejala)){
?>

<div class="modal-dialog">
    <div class="modal-content">

    	<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Edit Data Gejala Kerusakan</h4>
        </div>

        <div class="modal-body">
        	<form action="proses_edit.php" name="modal_popup" enctype="multipart/form-data" method="POST">
        		
                <div class="form-group" style="padding-bottom: 20px;">
                	<label for="Modal Name">Nama Gejala</label>
                    <input type="hidden" name="id_gejala"  class="form-control" value="<?php echo $r['id_gejala']; ?>" />
     				<input type="text" name="nama_gejala"  class="form-control" value="<?php echo $r['nama_gejala']; ?>"/>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                	<label for="Description">Kode Gejala</label>
     				<textarea name="kode_gejala"  class="form-control"><?php echo $r['kode_gejala']; ?></textarea>
                </div>

              

	            <div class="modal-footer">
	                <button class="btn btn-success" type="submit">
	                    Simpan
	                </button>

	                <button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true">
	               		Batal
	                </button>
	            </div>

            	</form>

             <?php } ?>

            </div>

           
        </div>
    </div>