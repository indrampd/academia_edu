<?php

session_start();

include '../core/autoload.php';
require '../core/functions.php';

if (!isset($_SESSION['user_id'])) {
   header("location: ../auth");
}

$user = get_where("tbl_user", "user_id", $_SESSION['user_id']);

include '../templates/header.php';  // 1
include '../templates/navbar.php';  // 2
include '../templates/sidebar.php'; // 3

?>

<!-- main konten -->
<div class="main-panel">
   <div class="content-wrapper">
      <div class="page-header">
         <h3 class="page-title">Profil Saya</h3>
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="../menu/profile.php">Profile</a></li>
               <li class="breadcrumb-item active" aria-current="page">Profil Saya</li>
            </ol>
         </nav>
      </div>
      <div class="row">

         <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
               <div class="card-body">
                  <h4 class="card-title mb-5">Detail Profile</h4>
                  <hr class="mb-5">
                  <!-- <p class="card-description"> Basic form layout </p> -->
                  <form class="forms-sample">
                     <div class="form-group">
                        <label for="exampleInputUsername1">Nama</label>
                        <input type="text" class="form-control-plaintext" id="exampleInputUsername1" placeholder="Username" value="<?= $user['username'] ?>" disabled>
                     </div>
                     <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control-plaintext" id="exampleInputEmail1" placeholder="Email" value="<?= $user['email'] ?>" disabled>
                     </div>
                     <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control-plaintext" id="exampleInputPassword1" placeholder="Password">
                     </div>
                     <div class="form-group">
                        <label for="exampleInputConfirmPassword1">Confirm Password</label>
                        <input type="password" class="form-control-plaintext" id="exampleInputConfirmPassword1" placeholder="Password">
                     </div>
                     <div class="form-check form-check-flat form-check-primary">
                        <label class="form-check-label">
                           <input type="checkbox" class="form-check-input"> Remember me </label>
                     </div>
                     <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                     <button class="btn btn-light">Cancel</button>
                  </form>
               </div>
            </div>
         </div>

         <div class="col-md-4 order-md-2">
            <div class="card">
               <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                     <img src="../assets/profile/<?= $user['image'] ?>" alt="Admin" class="rounded-circle" width="150">
                     <div class="mt-3">
                        <h5><?= $_SESSION['username']; ?></h5>
                        <p class="text-secondary mb-3"><?= $_SESSION['login'] ?></p>
                        <button class="btn btn-gradient-success">Upload</button>
                        <!-- <button class="btn btn-outline-primary">Message</button> -->
                     </div>
                  </div>
               </div>
            </div>

            <div class="card mt-3">
               <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                     <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram mr-2 icon-inline text-danger">
                           <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                           <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                           <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                        </svg>Instagram</h6>
                     <span class="text-secondary">@admin</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                     <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook mr-2 icon-inline text-primary">
                           <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                        </svg>Facebook</h6>
                     <span class="text-secondary">Admin</span>
                  </li>
               </ul>
            </div>
         </div>
      </div>

   </div>

   <!-- akhir konten -->

   <?php include '../templates/footer.php' ?>