<?php

session_start();

include '../core/autoload.php';
require '../core/functions.php';

if (!isset($_SESSION['user_id'])) {
   header("location: ../auth");
}

if ($_SESSION['role'] == 2) {
   header("Location: home.php");
}

$jumlah_admin = mysqli_num_rows($conn->query("SELECT * FROM tbl_user WHERE role_id = 1"));
$jumlah_user = mysqli_num_rows($conn->query("SELECT * FROM tbl_user WHERE role_id = 2"));
$jumlah_file = mysqli_num_rows($conn->query("SELECT * FROM tbl_file"));

include '../templates/header.php';  // 1
include '../templates/navbar.php';  // 2
include '../templates/sidebar.php'; // 3

?>
<!-- main content -->
<div class="main-panel">
   <div class="content-wrapper">
      <!--  -->
      <div class="row d-none" id="proBanner">
         <div class="col-12">
            <span class="d-flex align-items-center purchase-popup">
               <p>Get tons of UI components, Plugins, multiple layouts, 20+ sample pages, and more!</p>
               <a href="https://www.bootstrapdash.com/product/purple-bootstrap-admin-template?utm_source=organic&utm_medium=banner&utm_campaign=free-preview" target="_blank" class="btn download-button purchase-button ml-auto">Upgrade To Pro</a>
               <i class="mdi mdi-close" id="bannerClose"></i>
            </span>
         </div>
      </div>
      <!--  -->
      <div class="page-header">
         <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
               <i class="mdi mdi-home"></i>
            </span> Dashboard
         </h3>
         <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
               <li class="breadcrumb-item active" aria-current="page">
                  <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
               </li>
            </ul>
         </nav>
      </div>
      <!--  -->
      <div class="row">
         <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-danger card-img-holder text-white">
               <div class="card-body">
                  <img src="../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                  <h4 class="font-weight-normal mb-3">Jumlah Admin <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                  </h4>
                  <h2 class="mb-5"><?= $jumlah_admin ?> Users</h2>
                  <!-- <h6 class="card-text">Increased by 60%</h6> -->
               </div>
            </div>
         </div>
         <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
               <div class="card-body">
                  <img src="../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                  <h4 class="font-weight-normal mb-3">Jumlah User <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                  </h4>
                  <h2 class="mb-5"><?= $jumlah_user ?> Users</h2>
                  <!-- <h6 class="card-text">Decreased by 10%</h6> -->
               </div>
            </div>
         </div>
         <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-success card-img-holder text-white">
               <div class="card-body">
                  <img src="../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                  <h4 class="font-weight-normal mb-3">Jumlah File Terupload <i class="mdi mdi-diamond mdi-24px float-right"></i>
                  </h4>
                  <h2 class="mb-5"><?= $jumlah_file ?> Files</h2>
                  <!-- <h6 class="card-text">Increased by 5%</h6> -->
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
               <div class="card-body">
                  <h4 class="card-title">Daftar File</h4>
                  <div class="table-responsive">
                     <table class="table">
                        <thead>
                           <tr>
                              <th> # </th>
                              <th> Name </th>
                              <th> Due Date </th>
                              <th> Progress </th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td> 1 </td>
                              <td> Herman Beck </td>
                              <td> May 15, 2015 </td>
                              <td>
                                 <div class="progress">
                                    <div class="progress-bar bg-gradient-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                 </div>
                              </td>
                           </tr>
                           <!-- <tr>
                              <td> 2 </td>
                              <td> Messsy Adam </td>
                              <td> Jul 01, 2015 </td>
                              <td>
                                 <div class="progress">
                                    <div class="progress-bar bg-gradient-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <td> 3 </td>
                              <td> John Richards </td>
                              <td> Apr 12, 2015 </td>
                              <td>
                                 <div class="progress">
                                    <div class="progress-bar bg-gradient-warning" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <td> 4 </td>
                              <td> Peter Meggik </td>
                              <td> May 15, 2015 </td>
                              <td>
                                 <div class="progress">
                                    <div class="progress-bar bg-gradient-primary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <td> 5 </td>
                              <td> Edward </td>
                              <td> May 03, 2015 </td>
                              <td>
                                 <div class="progress">
                                    <div class="progress-bar bg-gradient-danger" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <td> 5 </td>
                              <td> Ronald </td>
                              <td> Jun 05, 2015 </td>
                              <td>
                                 <div class="progress">
                                    <div class="progress-bar bg-gradient-info" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                 </div>
                              </td>
                           </tr> -->
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>

      </div>
   </div>
   <!-- akhir konten -->

   <?php include '../templates/footer.php' ?>