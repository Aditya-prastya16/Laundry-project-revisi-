<?php
include "../function/functionuser.php";


session_start();

if(!@$_SESSION['username']){
    header('Location:../auth/login.php');
}else if(@$_SESSION['role']=='kasir'){
    echo "<script>alert('anda kasir');window.location.href='../auth/login.php';</script>";
}else if(@$_SESSION['role']=='owner'){
    echo "<script>alert('anda owner');window.location.href='../auth/login.php';</script>";
}
$user = mysqli_query($koneksi, "SELECT * FROM tb_user ORDER BY id_user ASC ");
$nomor = 1;
$keyword = $_GET["keyword"];


$query = "SELECT * FROM tb_user
          where
          id_user like '%$keyword%' or
          nama like '%$keyword%' or
          username like '%$keyword%' or
          id_outlet like '%$keyword%' or
          role like '%$keyword%'  
   ";
$user = query($query);
?>
   <div id="container">
        <table class="container table-auto border-collapse border-b border-gray-300">
            <thead>
                <tr>
                    <th class="px-4 py-2">No</th>
                    <th class="px-4 py-2">Nama</th>
                    <th class="px-4 py-2">Username</th>
                    <th class="px-4 py-2">Outlet</th>
                    <th class="px-4 py-2">Role</th>
                    <th class="px-4 py-2" >Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach( $user as $row ) :
            
        ?>
                <tr>
                    <th class="border-t border-gray-300 px-4 py-2"><?= $nomor++ ?></th>
                    <th class="border-t border-gray-300 px-4 py-2"><?= $row['nama'] ?></th>
                    <th class="border-t border-gray-300 px-4 py-2"><?= $row['username'] ?></th>
                    <th class="border-t border-gray-300 px-4 py-2"><?= $row['id_outlet'] ?></th>
                    <th class="border-t border-gray-300 px-4 py-2"><?= $row['role'] ?></th>
                    <th class="border-t border-gray-300 px-4 py-2">
                        <a href="../view/update_user_admin.php?id_user=<?= $row['id_user'] ?>">
                            <button class="bg-[#2685CA] hover:bg-blue-700 text-white font-bold py-3 px-3 rounded-lg">
                                <img src="../img/edit.png" alt="Edit" class="w-4 h-4">
                            </button>
                        </a> 
                        <?php
                        $id = $row['id_user'];
                        $hide_delete1 = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_user INNER JOIN tb_transaksi USING(id_user) WHERE id_user = $id");
                        $cek1 = mysqli_fetch_row($hide_delete1)[0];

                        $id = $row['id_user']; // Assuming $data['id_user'] contains the user's ID

                        // Check if there are related records in tb_detail_transaksi
                        $hide_delete_query = "SELECT COUNT(*) as total FROM tb_detail_transaksi WHERE id_transaksi IN (SELECT id_transaksi FROM tb_transaksi WHERE id_user = '$id')";
                        $hide_delete_result = mysqli_query($koneksi, $hide_delete_query);
                        $hide_delete_row = mysqli_fetch_assoc($hide_delete_result);
                        $total_related_records = $hide_delete_row['total'];

                        // Hide delete button if there are related records
                        $hide_delete = ($total_related_records > 0) ? true : false;
                        ?>
                        <?php
                        // Check if delete button should be hidden
                        if (!$hide_delete && $_SESSION['username'] != $data['username']) {
                        ?>
<a href="../delete/delete_user_admin.php?id_user=<?= $row['id_user'] ?>" onclick="return confirm('Anda yakin ingin menghapus Data ini?')">
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
                <?php endforeach; ?>
            </table>
        </div>

        
