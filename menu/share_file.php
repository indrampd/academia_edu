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

$user_id = $_SESSION['user_id'];
$file_id = get_where("tbl_shared_file", "user_id", $user_id);
if (!$file_id) {
   $files = query_assoc("SELECT * FROM `tbl_file`  WHERE `user_id` = $user_id");
} else {
   $files = query_assoc("SELECT * FROM `tbl_file`  WHERE `file_id` = $file_id");
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
         <h3 class="page-title">Shared File</h3>
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="../menu/my_files.php">Files Management</a></li>
               <li class="breadcrumb-item active" aria-current="page">Shared File</li>
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
                        btn_message($_SESSION['user_id'], $file['user_id']);
                        ?>
                        <!-- <a href="?id=<?= $user['user_id'] ?>" class="mr-2 text-primary">
                           <i class="mdi mdi-message"></i>
                           <span>Pesan</span>
                        </a> -->
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