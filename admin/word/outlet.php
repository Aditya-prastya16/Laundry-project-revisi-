<!DOCTYPE html>
<html>
<head>
 <title>word</title>
</head>
<body>
 <style type="text/css">
 body{
 font-family: sans-serif;
 }
 table{
 margin: 20px auto;
 border-collapse: collapse;
 }
 table th,
 table td{
 border: 1px solid #3c3c3c;
 padding: 3px 8px;

 }
 a{
 background: blue;
 color: #fff;
 padding: 8px 10px;
 text-decoration: none;
 border-radius: 2px;
 }
 </style>

 <?php
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=data_outlet.doc");
 ?>
 <table border="1">
 <tr>
 <th >No</th>
                        <th >Nama Outlet</th>
                        <th >Alamat</th>
                        <th >No Telp</th>


        </tr>
 <?php 
 // koneksi database
 $koneksi = mysqli_connect("localhost","root","","Myloundry");
 $nomor =1;
 // menampilkan data
 $data = mysqli_query($koneksi,"select * from tb_outlet");
 while($row = mysqli_fetch_array($data)){
 ?>
         <tr class="borderbot">
         <th ><?=$nomor++?></th>
                        <th ><?=$row['nama']?></th>
                        <th ><?=$row['alamat']?></th>
                        <th ><?=$row['tlp']?></th>
        </tr>
 <?php 
 }
 ?>
 </table>
</body>
</html>