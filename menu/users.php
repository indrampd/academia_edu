<?php

session_start();

include '../core/autoload.php';
require '../core/functions.php';

if (!isset($_SESSION['user_id'])) {
   header("location: ../auth");
}

if (isset($_GET['id']) && isset($_GET['followed'])) {

   if (isset($_GET['follow'])) {
      if (do_follow($_GET['id'], $_GET['followed'])) {
         header("location: users.php");
      }
   }

   if (isset($_GET['unfollow'])) {
      if (do_unfollow($_GET['id'], $_GET['followed'])) {
         header("location: users.php");
      }
   }
}

$user_id = $_SESSION['user_id'];

$users = query_assoc("SELECT * FROM `tbl_user` WHERE NOT `user_id` = $user_id AND NOT `role_id` = 1");

include '../templates/header.php';  // 1
include '../templates/navbar.php';  // 2
include '../templates/sidebar.php'; // 3

?>

<!-- main konten -->

<!-- header -->
<div class="main-panel">
   <div class="content-wrapper">
      <div class="page-header">
         <h3 class="page-title">Users List</h3>
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="../menu/users.php">Users</a></li>
               <li class="breadcrumb-item active" aria-current="page">Users List</li>
            </ol>
         </nav>
      </div>
      <!-- akhir header -->

      <div class="row">

         <?php
         foreach ($users as $user) :
         ?>
            <!-- profile -->
            <div class="col-md-4">
               <div class="card">
                  <div class="card-body">
                     <h4 class="card-title mb-4 text-center"><?= $user['username'] ?></h4>
                     <hr class="mb-3">
                     <div class=" row d-flex flex-column text-center align-items-sm-center mb-4">
                        <a href="profile.php?id=<?= $user['user_id'] ?>">
                           <img src="../assets/profile/<?= $user['image'] ?>" style="object-fit: cover;" class="rounded-circle" width="150px" height="150px" alt="">
                        </a>
                     </div>
                     <p class="card-text text-center mb-3">
                        <?= $user['email'] ?>
                     </p>
                     <p class="card-text text-center mb-3">
                        <small><b><?= followers($user['user_id']) ?></b> Followers </small>
                        <small class="text-muted"> | </small>
                        <small><b><?= following($user['user_id']) ?></b> Following </small>
                        <small class="text-muted"> | </small>
                        <small><b><?= uploaded($user['user_id']) ?></b> Uploaded </small>
                     </p>
                     <div class="row d-flext flex-column text-center align-items-sm-center ">
                        <?php
                        btn_follow_rounded($_SESSION['user_id'], $user['user_id']);
                        ?>
                     </div>
                  </div>
               </div>
            </div>
            <!-- end profile -->
         <?php endforeach; ?>
      </div>

   </div>

   <!-- akhir konten -->

   <?php include '../templates/footer.php' ?>