<?php
include "../function/functionoutlet.php";


session_start();

if(!@$_SESSION['username']){
    header('Location:../auth/login.php');
}else if(@$_SESSION['role']=='kasir'){
    echo "<script>alert('anda kasir');window.location.href='../auth/login.php';</script>";
}else if(@$_SESSION['role']=='owner'){
    echo "<script>alert('anda owner');window.location.href='../auth/login.php';</script>";
}
$outlet = mysqli_query($koneksi, "SELECT * FROM tb_outlet ORDER BY id_outlet ASC");
$nomor = 1 ;
$keyword = $_GET["keyword"];


$query = "SELECT * FROM tb_outlet
          where
          id_outlet like '%$keyword%' or
          nama like '%$keyword%' or
          alamat like '%$keyword%' or
          tlp like '%$keyword%' 
   ";
$outlet = query($query);
?>
        <div id="container">
            <table class="container table-auto border-collapse border-b border-gray-300">
                <thead>
                    <tr>
                        <th class="px-4 py-2">No</th>
                        <th class="px-4 py-2">Nama Outlet</th>
                        <th class="px-4 py-2">Alamat</th>
                        <th class="px-4 py-2">No Telp</th>
                        <th class="px-4 py-2" >Aksi</th>
                    </tr>
                </thead>
                <?php
                foreach( $outlet as $row ) :
            
        ?>
                <tbody>
                    <tr>
                        <th class="border-t border-gray-300 px-4 py-2"><?=$nomor++ ?></th>
                        <th class="border-t border-gray-300 px-4 py-2"><?=$row['nama']?></th>
                        <th class="border-t border-gray-300 px-4 py-2"><?=$row['alamat']?></th>
                        <th class="border-t border-gray-300 px-4 py-2"><?=$row['tlp']?></th>
                        <th class="border-t border-gray-300 px-4 py-2">
                           <a href="../view/update_outlet_admin.php?id_outlet=<?= $row['id_outlet'] ?>">
                                <button href="" class="bg-[#2685CA] hover:bg-blue-700 text-white font-bold py-3 px-3 rounded-lg">
                                    <img src="../img/edit.png" alt="Edit" class="w-4 h-4">
                                </button>
                           </a> 
                           <?php
$id = $row['id_outlet'];
$hide_delete1 = mysqli_fetch_row(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_outlet INNER JOIN tb_user ON tb_outlet.id_outlet=tb_user.id_outlet WHERE tb_outlet.id_outlet='$id'"));
$hide_delete2 = mysqli_fetch_row(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_outlet INNER JOIN tb_paket ON tb_outlet.id_outlet=tb_paket.id_outlet WHERE tb_outlet.id_outlet='$id'"));
$hide_delete3 = mysqli_fetch_row(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_outlet INNER JOIN tb_transaksi ON tb_outlet.id_outlet=tb_transaksi.id_outlet WHERE tb_outlet.id_outlet='$id'"));

if ($hide_delete1[0] == '0' && $hide_delete2[0] == '0' && $hide_delete3[0] == '0') {
                        ?>
<a href="../delete/delete_outlet_admin.php?id_outlet=<?= $row['id_outlet'] ?>" onclick="return confirm('Anda yakin ingin menghapus Data ini?')">
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

        
