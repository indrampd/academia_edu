<?php

session_start();

include '../core/autoload.php';
require '../core/functions.php';

if (!isset($_SESSION['user_id'])) {
   header("location: ../auth");
}

$files = query_assoc("SELECT * FROM `tbl_file`  WHERE `privasi` = 1 ");

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
      <div class="row">
         <?php
         foreach ($files as $file) :
            $user = get_where("tbl_user", "user_id", $file['user_id']);
         ?>
            <div class="col-4">
               <div class="card">
                  <div class="card-body">
                     <h5 class="card-title"><?= $file['judul'] ?></h5>
                     <p class="card-text"><?= $file['deskripsi'] ?></p>
                     <a href="detail_file.php?id=<?= $file['file_id'] ?>" class="badge badge-gradient-primary mb-3">Lihat File</a>
                     <p class="card-text"><small class="text-muted">Terakhir diubah <?= date('d F Y', $file['date_created']) ?> <br> Oleh <?= $user['username'] ?></small></p>
                  </div>
               </div>
            </div>
         <?php endforeach ?>


      </div>
   </div>
   <!-- akhir konten -->

   <?php include '../templates/footer.php' ?>