<?php

session_start();

$message = "";

include '../core/autoload.php';
require '../core/functions.php';

if (!isset($_SESSION['user_id'])) {
   header("location: ../auth");
}


if (isset($_GET['id'])) {
   $user_id = $_GET['id'];

   if ($_SESSION['role'] != 1) {
      if ($id != $_SESSION['user_id']) {
         header("Location: ../index.php");
      }
   } else {
      $user = get_where('tbl_user', 'user_id', $user_id);
   }
   $role = query_assoc("SELECT * FROM tbl_role");
} else {
   header("Location: data_user.php");
}

if (isset($_POST['btn-update'])) {
   $user_id = $_POST['user_id'];
   $username = htmlspecialchars($_POST['username']);
   $email = $_POST['email'];
   $role_id = $_POST['role_id'];
   $status = $_POST['status'];

   $update = updateUser($username, $email, $role_id, $status, $user_id);

   if ($update) {
      echo "<script>alert('Data berhasil diubah!')</script>";
      header("location: data_user.php");
   } else {
      echo "<script>alert('Gagal!')</script>";
   }
}



include '../templates/header.php';  // 1
include '../templates/navbar.php';  // 2
include '../templates/sidebar.php'; // 3

?>

<div class="main-panel">
   <div class="content-wrapper">
      <div class="page-header">
         <h3 class="page-title"> Edit Data User </h3>
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="../menu/data_user.php">Users Management</a></li>
               <li class="breadcrumb-item active" aria-current="page">Edit Data User</li>
            </ol>
         </nav>
      </div>
      <div class="row">
         <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
               <div class="card-body">
                  <h4 class="card-title mb-5">Edit Data User</h4>
                  <hr class="mb-5">
                  <?php echo $message;
                  ?>
                  <form class="forms-sample" method="POST">

                     <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                     <input type="hidden" name="email" value="<?= $user['email'] ?>">

                     <div class="form-group row">
                        <label for="exampleInputEmail" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                           <input type="email" class="form-control" id="exampleInputEmail" name="email" value="<?= $user['email'] ?>" disabled>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="exampleInpuName" class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                           <input type="text" class="form-control" id="exampleInpuName" name="username" placeholder="Name" value="<?= $user['username'] ?>" required>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="roleAkses" class="col-sm-3 col-form-label">Role Akses</label>
                        <div class="col-sm-9">
                           <select class="form-control" id="roleAkses" name="role_id" required>
                              <option value="<?= $user['role_id'] ?>"><?= rolename($user['role_id']) ?></option>
                              <?php foreach ($role as $item) { ?>
                                 <option value="<?= $item['role_id'] ?>"><?= $item['role'] ?></option>
                              <?php  } ?>
                           </select>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="status" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9">
                           <select class="form-control" id="status" name="status" required>
                              <option value="<?= $user['status'] ?>"><?= statusname($user['status']) ?></option>
                              <option value="1">Aktif</option>
                              <option value="2">Non-Aktif</option>
                           </select>
                        </div>
                     </div>
                     <button type="submit" class="btn btn-gradient-primary mr-2" name="btn-update">Submit</button>
                     <button class="btn btn-gradient-danger" type="reset">Reset</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- content-wrapper ends -->

   <?php include '../templates/footer.php' ?>