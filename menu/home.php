<?php

session_start();

include '../core/autoload.php';
require '../core/functions.php';

$pesan = "";

if (!isset($_SESSION['user_id'])) {
   header("location: ../auth");
}

if (isset($_GET['id']) && isset($_GET['followed'])) {

   if (isset($_GET['follow'])) {
      if (do_follow($_GET['id'], $_GET['followed'])) {
         header("location: home.php");
      }
   }

   if (isset($_GET['unfollow'])) {
      if (do_unfollow($_GET['id'], $_GET['followed'])) {
         header("location: home.php");
      }
   }
}
$files = query_assoc("SELECT * FROM `tbl_file`  WHERE `privasi` = 2 ");

if (isset($_POST['search'])) {
   $keyword = $_POST['s_keyword'];
   $kategori = $_POST['s_kategori'];
   if (isset($_POST['s_keyword']) && isset($_POST['s_kategori']) != "") {
      $files = query_assoc("SELECT * FROM `tbl_file` WHERE `judul` LIKE '%$keyword%' AND `tipe_file` LIKE '%$kategori%'");
   } else {
      $files = query_assoc("SELECT * FROM `tbl_file` WHERE `judul` LIKE '%$keyword%'");
   }

   if ($files) {
      $pesan = "<p class='card-text' role='alert'>Menampilkan beberapa hasil dengan kategori <b>$kategori</b> </p>";
   } else {
      echo "<script>alert('Data Tidak Ditemukan!')</script>";
      echo "<script>window.location='home.php'</script>";
   }
}



include '../templates/header.php';  // 1
include '../templates/navbar.php';  // 2
include '../templates/sidebar.php'; // 3

?>
<!-- main content -->
<div class="main-panel">
   <div class="content-wrapper">
      <!-- header -->
      <div class="page-header">
         <h3 class="page-title">Halaman Utama</h3>
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="../menu/home.php">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Halaman Utama</li>
            </ol>
         </nav>
      </div>
      <!-- akhir header -->
      <!--  -->
      <div class="row justify-content-center">
         <?= $pesan ?>
         <?php
         foreach ($files as $file) :
            $user = get_where("tbl_user", "user_id", $file['user_id']);
         ?>
            <div class="col-sm-12 mb-4">
               <div class="card">
                  <div class="card-body">
                     <a href="">
                        <h5 class="card-title"><?= $file['judul'] ?> | <?= $file['tipe_file'] ?>
                        </h5>
                     </a>
                     <hr>
                     <p class="card-text">
                        <img src="../assets/profile/<?= $user['image'] ?>" alt="profile" style="width: 20px; height: 20px; object-fit: cover;" alt="foto" class="rounded-circle mr-2" class="rounded-circle">
                        <a href="profile.php?id=<?= $file['user_id']; ?>">
                           <span class="text-muted mr-2"> <?= $user['username'] ?></span>
                        </a>
                        <?php
                        btn_follow($_SESSION['user_id'], $file['user_id']);
                        ?>
                        <a href="?id=<?= $user['user_id'] ?>" class="mr-2 text-primary">
                           <i class="mdi mdi-message"></i>
                           <span>Pesan</span>
                        </a>
                     </p>
                     <p class="card-text text-dark"><?= $file['deskripsi'] ?></p>
                     <p class="card-text">
                        <small class="text-muted">Terakhir diubah <?= date('d F Y', $file['date_created']) ?></small>
                     </p>
                     <hr>
                     <button onclick="window.location.href='../assets/uploads/<?= $user['email'] ?>/<?= $file['nama_file'] ?>';" class="btn btn-rounded btn-primary mr-2">Download</button>
                     <button type="submit" onclick="window.location.href='share_file.php';" class="btn btn-outline-secondary btn-rounded btn-icon">
                        <i class="mdi mdi-share"></i>
                     </button>
                  </div>
               </div>
            </div>
         <?php endforeach ?>


      </div>
   </div>
   <!-- akhir konten -->

   <?php include '../templates/footer.php' ?>