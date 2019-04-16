
<head>

<?php
include ('master2.php');
?>


</head>









<body>
 


<div class="container">
 
  <h2>Data Kerusakan</h2>

  
<table id="mytable" class="table table-bordered">
    <thead>
      <th>No</th>
       <th>Kode Kerusakan</th>
      <th>Nama Kerusakan</th>
       <th>Solusi</th>
        <th>Densitas</th>
     
     
    </thead>
<?php 
  //menampilkan data mysqli
  include "koneksi.php";
  $no = 0;
  $tb_kerusakan=mysql_query("SELECT * FROM tb_kerusakan");
  while($r=mysql_fetch_array($tb_kerusakan))
  {
  $no++;
       
?>
  <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo  $r['kode_kerusakan']; ?></td>
      <td><?php echo  $r['nama_kerusakan']; ?></td>
      <td><?php echo  $r['solusi_kerusakan']; ?></td>
      <td><?php echo  $r['densitas']; ?></td>
  </tr>
 

<?php } ?>
</table>
</div>

</body>

<h1>.</h1>
  
  </html>
