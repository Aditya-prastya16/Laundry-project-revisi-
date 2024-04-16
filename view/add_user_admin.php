<?php
require '../auth/function.php';

require "../layout/navbar_admin.php";
    session_start();

    if(!@$_SESSION['username']){
        header('Location:../auth/login.php');
    }else if(@$_SESSION['role']=='kasir'){
        echo "<script>alert('anda kasir');window.location.href='../auth/login.php';</script>";
    }else if(@$_SESSION['role']=='owner'){
        echo "<script>alert('anda owner');window.location.href='../auth/login.php';</script>";
    }

if(isset($_POST["register"])){

    if(registrasi($_POST)> 0  ){
        echo "<script> 
                alert('User Baru Berhasil Ditambahkan !');window.location='../admin/user.php';
            </script>";
    }else{
        echo mysqli_error($koneksi);
    }

}

?>

<?= template_header('Home') ?>


    
<div class="container mx-auto p-8">
    <h2 class="text-[28px] font-semibold pb-2 border-b-2 border-[#A5A5A5] mb-[5%]">Tambah Data User</h2>
    <form action="" method="post">
    <div class="flex mb-4">
                <label for="nama" class="w-1/5 text-left pr-4 pt-1" >Nama :</label>
                <input type="text" id="nama" name="nama" required class="w-3/4 px-3 py-2 border rounded-xl border-gray-300">
            </div>
            <div class="flex mb-4">
                <label for="username" class="w-1/5 text-left pr-4 pt-1" >Username :</label>
                <input type="text" id="username" name="username" required class="w-3/4 px-3 py-2 border rounded-xl border-gray-300">
            </div>
            <div class="flex mb-4">
                <label for="password" class="w-1/5 text-left pr-4 pt-1" >Password :</label>
                <input type="password" id="password" name="password" required class="w-3/4 px-3 py-2 border rounded-xl border-gray-300">
            </div>
            <div class="flex mb-4">
                <label for="password2" class="w-1/5 text-left pr-4 pt-1" >Konfirmasi Password :</label>
                <input type="password" id="password2" name="password2" required class="w-3/4 px-3 py-2 border rounded-xl border-gray-300">
            </div>
    <div class="flex mb-4">
                <label for="id_outlet" class="w-1/5 text-left pr-4 pt-1">Nama Outlet :</label>
                <select name="id_outlet" id="id_outlet" class="w-3/4 px-3 py-2 border rounded-xl border-gray-300">
                <div class="flex mb-4">
                <option value="<?= $user_row['id_outlet'] ?>"><?= $user_row['id_outlet'] ?></option>

<?php
                        include "../koneksi.php";
                        $query="SELECT * FROM tb_outlet ";
                        $data = mysqli_query($koneksi, $query);
                        $cek = mysqli_num_rows($data);
                        while($row = mysqli_fetch_assoc($data)){
                    ?>
                        <option value="<?=$row['id_outlet'];?>"><?=$row['nama'];?></option>                
                        <?php
                     }
                     ?>
                </select>
            </div>
            <div class="flex mb-4">
                <label for="role" class="w-1/5 text-left pr-4 pt-1">Role :</label>
                <select name="role" id="role" class="w-3/4 px-3 py-2 border rounded-xl border-gray-300">
                    <option disabled selected>-- Pilih Role --</option>
                    <option value="admin" >Admin</option>
                     <option value="owner">Owner</option>
                     <option value="Kasir">Kasir</option>         
                </select>
            </div>
            <div class="flex justify-end my-[2%]">
            <a href="../admin/user.php">
                <button type="button" class="inline-flex justify-center py-2 px-10 border border-transparent shadow-sm text-sm  rounded-xl text-white bg-[#E61700] font-semibold hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 ">
                    Kembali
                </button>
            </a>
                <button type="submit" name="register"  class="inline-flex justify-center py-2 px-10 mx-5 border border-transparent shadow-sm text-sm  rounded-xl text-white bg-[#53D258] font-semibold hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 ">
                    Simpan
                </button>
            </div>
        </form>
    </div>
<?= template_footer() ?>