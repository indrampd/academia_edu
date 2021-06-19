<?php

session_start();

include '../core/autoload.php';
require '../core/functions.php';

if (!isset($_SESSION['user_id'])) {
   header("location: ../auth");
}

include '../templates/header.php';  // 1
include '../templates/navbar.php';  // 2
include '../templates/sidebar.php'; // 3

?>

<!-- main konten -->

<!-- header -->
<div class="main-panel">
   <div class="content-wrapper">
      <div class="page-header">
         <h3 class="page-title">Follower</h3>
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="../menu/friend_list.php">Friend List</a></li>
               <li class="breadcrumb-item active" aria-current="page">Follower</li>
            </ol>
         </nav>
      </div>
   </div>
   <!-- akhir header -->

   <!-- akhir konten -->

   <?php include '../templates/footer.php' ?>