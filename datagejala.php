
<head>
<?php
include ('master2.php');
?>
</head>

<body>
<div class="container">
 
  <h2>Data Gejala Kerusakan</h2>

  

<table id="mytable" class="table table-bordered">
    <thead>
    <th>No</th>
      <th>Nama Gejala</th>
      <th>Kode Kerusakan</th>
  
    </thead>
<?php 
  //menampilkan data mysqli
  include "koneksi.php";
  $no = 0;
  $tb_gejala=mysql_query("SELECT * FROM tb_gejala");
  while($r=mysql_fetch_array($tb_gejala))
  {
  $no++;
       
?>
  <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo  $r['nama_gejala']; ?></td>
      <td><?php echo  $r['kode_gejala']; ?></td>
</tr>
<?php } ?>
</table>
</div>
</body>
</html>
