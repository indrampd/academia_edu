<?php

session_start();

include '../core/autoload.php';
require '../core/functions.php';

if (!isset($_SESSION['user_id'])) {
   header("location: ../auth");
}

$files = query_assoc("SELECT * FROM `tbl_file`  WHERE `privasi` = 2 ");

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
         <?php
         foreach ($files as $file) :
            $user = get_where("tbl_user", "user_id", $file['user_id']);
         ?>
            <div class="col-sm-12 mb-4">
               <div class="card">
                  <div class="card-body">
                     <a href="">
                        <h5 class="card-title"><?= $file['judul'] ?></h5>
                     </a>
                     <hr>
                     <p class="card-text">
                        <img src="../assets/profile/<?= $user['image'] ?>" alt="profile" style="width: 20px; height: 20px; object-fit: cover;" alt="foto" class="rounded-circle" class="rounded-circle">
                        <a href=""><small class="text-muted"> <?= $user['username'] ?></small></a>
                     </p>
                     <p class="card-text text-dark"><?= $file['deskripsi'] ?></p>
                     <p class="card-text"><small class="text-muted">Terakhir diubah <?= date('d F Y', $file['date_created']) ?></small></p>
                     <hr>
                     <div class="row">
                        <div class="col-2">
                           <a href="../assets/uploads/<?= $user['email'] ?>/<?= $file['nama_file'] ?>" class="btn btn-rounded btn-primary mb-3">Download</a>
                        </div>
                        <div class="col">
                           <form action="share_file.php">
                              <button type="submit" class="btn btn-outline-primary btn-rounded btn-icon">
                                 <i class="mdi mdi-share"></i>
                              </button>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         <?php endforeach ?>


      </div>
   </div>
   <!-- akhir konten -->

   <?php include '../templates/footer.php' ?>