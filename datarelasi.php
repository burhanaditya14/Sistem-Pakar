
<head>

<?php
include ('master2.php');
?>



</head>
<body>
 


<div class="container">
 
  <h2>Data Relasi</h2>

        

<table id="mytable" class="table table-bordered">
    <thead>
      <th>No</th>
       <th>Id Kerusakan</th>
      <th>Id Gejala</th>

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
      
      
  </tr>
 

<?php } ?>
</table>
</div>
</body>



<h1>.</h1>

  
  </html>

  



