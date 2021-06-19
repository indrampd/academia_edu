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
<div class="main-panel">
   <div class="content-wrapper">
   </div>

   <!-- akhir konten -->

   <?php include '../templates/footer.php' ?>