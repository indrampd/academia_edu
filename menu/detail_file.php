<?php

session_start();

include '../core/autoload.php';
require '../core/functions.php';

if (!isset($_SESSION['user_id'])) {
   header("location: ../auth");
}

$email = $_SESSION['login'];

if (isset($_GET['id'])) {
   $file_id = $_GET['id'];
   $file = get_where("tbl_file", "file_id", $file_id);
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
         <h3 class="page-title">Detail File</h3>
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="../menu/home.php">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Detail File</li>
            </ol>
         </nav>
      </div>
      <!-- akhir header -->
      <!--  -->
      <div class="row">
         <iframe tyle="width:100%; height: 100%" src="../assets/uploads/indramahpudin21@gmail.com/Program3.pdf">
            <!-- <iframe src="https://docs.google.com/viewerng/viewer?url=../assets/uploads/<?= $email ?>/<?= $file['nama_file'] ?>" frameborder="0" height="100%" width="100%">
         </iframe> -->
            <!-- <iframe src="../assets/uploads/<?= $email ?>/<?= $file['nama_file'] ?>" s frameborder="0"> </iframe> -->

      </div>
   </div>
   <!-- akhir konten -->

   <?php include '../templates/footer.php' ?>