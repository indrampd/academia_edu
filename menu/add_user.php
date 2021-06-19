<?php

session_start();

include '../core/autoload.php';
require '../core/functions.php';

if (!isset($_SESSION['user_id'])) {
   header("location: ../auth");
}


if (isset($_POST['btn-add'])) {
   $username = htmlspecialchars($_POST['username']);
   $email = htmlspecialchars($_POST['email']);
   $role_id = $_POST['role_id'];
   $status = $_POST['status'];

   $data = $conn->query("SELECT * FROM `tbl_user` WHERE `email` = '$email'");
   $count = mysqli_num_rows($data);

   if ($count == 0) {
      $addUser = addUser($username, $email, $role_id, $status);

      if ($addUser) {
         // $_SESSION['message'] = "<div class='alert alert-success' role='alert'>Data berhasil ditambahkan!</div>";
         echo "<script>alert('Data berhasil ditambahkan!')</script>";
         header("location: data_user.php");
      }
   } else {
      // $_SESSION['message'] = "<div class='alert alert-danger' role='alert'>Email sudah terpakai!</div>";
      // header("location: add_user.php");
      echo "<script>alert('Email sudah terpakai!')</script>";
      // header("location: add_user.php");
   }
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
         <h3 class="page-title">Add User</h3>
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="../menu/add_user.php">User Management</a></li>
               <li class="breadcrumb-item active" aria-current="page">Add User</li>
            </ol>
         </nav>
      </div>
      <div class="row">
         <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
               <div class="card-body">
                  <h4 class="card-title mb-5">Tambah Data User</h4>
                  <hr class="mb-5">
                  <form class="forms-sample" method="POST">
                     <div class="form-group row">
                        <label for="exampleInputEmail" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                           <input type="email" class="form-control" id="exampleInputEmail" name="email" placeholder="Masukan Email" required>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="exampleInpuName" class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                           <input type="text" class="form-control" id="exampleInpuName" name="username" placeholder="Name" required>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="roleAkses" class="col-sm-3 col-form-label">Role Akses</label>
                        <div class="col-sm-9">
                           <select class="form-control" id="roleAkses" name="role_id" required>
                              <option value="1">Admin</option>
                              <option value="2">User</option>
                           </select>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="status" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9">
                           <select class="form-control" id="status" name="status" required>
                              <option value="1">Aktif</option>
                              <option value="2">Non-Aktif</option>
                           </select>
                        </div>
                     </div>
                     <button type="submit" class="btn btn-gradient-primary mr-2" name="btn-add">Tambah</button>
                     <button class="btn btn-gradient-light" type="reset">Reset</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- akhir header -->
   <!-- akhir konten -->
   <?php include '../templates/footer.php' ?>