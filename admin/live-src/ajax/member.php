<?php
include "../function/functionmember.php";


session_start();

if(!@$_SESSION['username']){
    header('Location:../auth/login.php');
}else if(@$_SESSION['role']=='kasir'){
    echo "<script>alert('anda kasir');window.location.href='../auth/login.php';</script>";
}else if(@$_SESSION['role']=='owner'){
    echo "<script>alert('anda owner');window.location.href='../auth/login.php';</script>";
}
$member = mysqli_query($koneksi, "SELECT * FROM tb_member ORDER BY id_member ASC");
$nomor = 1;
$keyword = $_GET["keyword"];


$query = "SELECT * FROM tb_member
          where
          id_member like '%$keyword%' or
          nama like '%$keyword%' or
          alamat like '%$keyword%' or
          jenis_kelamin like '%$keyword%' or
          tlp like '%$keyword%' 
   ";
$member = query($query);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="/Project-uk/src/output.css" rel="stylesheet">
        <title></title>
    </head>
    <body>
    <div id="container">
            <table class="container table-auto border-collapse border-b border-gray-300">
                <thead>
                    <tr>
                        <th class="px-4 py-2">No</th>
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">Alamat</th>
                        <th class="px-4 py-2">Jenis Kelamin</th>
                        <th class="px-4 py-2">No Telp</th>
                        <th class="px-4 py-2" >Aksi</th>
                    </tr>
                </thead>
                <?php
                foreach( $member as $row ) :
            
        ?>
                <tbody id="searchResults">
                    <tr>


                        <th class="border-t border-gray-300 px-4 py-2"><?=$nomor++ ?></th>
                        <th class="border-t border-gray-300 px-4 py-2"><?=$row['nama']?></th>
                        <th class="border-t border-gray-300 px-4 py-2"><?=$row['alamat']?></th>
                        <th class="border-t border-gray-300 px-4 py-2"><?=$row['jenis_kelamin']?></th>
                        <th class="border-t border-gray-300 px-4 py-2"><?=$row['tlp']?></th>
                        <th class="border-t border-gray-300 px-4 py-2">
                           <a href="../view/update_member_admin.php?id_member=<?= $row['id_member'] ?>">
                                <button href="" class="bg-[#2685CA] hover:bg-blue-700 text-white font-bold py-3 px-3 rounded-lg">
                                    <img src="/Project-uk/img/edit.png" alt="Edit" class="w-4 h-4">
                                </button>
                           </a>
                            <?php
                       $id = $row['id_member'];
                       $hide_delete = mysqli_fetch_row(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_member INNER JOIN tb_transaksi ON tb_member.id_member=tb_transaksi.id_member WHERE tb_member.id_member='$id'"));

                       if ($hide_delete[0] == '0') {
                        ?>
<a href="../delete/delete_member_admin.php?id_member=<?= $row['id_member'] ?>" onclick="return confirm('Anda yakin ingin menghapus Data ini?')">
    <button class="bg-[#E61700] hover:bg-red-700 text-white font-bold py-3 px-3 rounded-lg ml-2" type="button">
        <img src="/Project-uk/img/delete.png" alt="Delete" class="w-4 h-4">
    </button>
</a>
                      
                        <?php
                            } else {
                                echo "</th>";
                            }
                        ?>

                    </tr>
                    
                </tbody>
                <?php endforeach; ?>
            </table>
        </div>

    </body>
    <script src="/Project-uk/node_modules/flowbite/dist/flowbite.min.js"></script>
</html>












