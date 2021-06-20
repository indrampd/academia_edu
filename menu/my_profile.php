<?php

session_start();

include '../core/autoload.php';
require '../core/functions.php';

if (!isset($_SESSION['user_id'])) {
   header("location: ../auth");
}

$user_id = $_SESSION['user_id'];
$user = get_where("tbl_user", "user_id", $user_id);
$files = query_assoc("SELECT * FROM `tbl_file` WHERE `user_id`= $user_id");

if (isset($_GET['id']) && isset($_GET['followed'])) {

   if (isset($_GET['follow'])) {
      if (do_follow($_GET['id'], $_GET['followed'])) {
         header("location: my_profile.php");
      }
   }

   if (isset($_GET['unfollow'])) {
      if (do_unfollow($_GET['id'], $_GET['followed'])) {
         header("location: my_profile.php");
      }
   }
}

if (isset($_POST['edit'])) {
   $user_id  = $_SESSION['user_id'];
   $username = $_POST['username'];
   $password = $_POST['password'];
   $hash = md5($password);

   $edit = $conn->query("UPDATE `tbl_user` SET `username` = '$username' , `password` = '$hash' WHERE `user_id` = '$user_id' ");

   if ($edit) {
      echo "<script>alert('Data Berhasil Diubah!'); location.href='my_profile.php'</script>";
   } else {
      echo "<script>alert('Data Gagal Diubah!')</script>";
   }
}

if (isset($_POST['submit'])) {

   if ($_FILES['upload']['name'] != "") {
      $user_id = $_POST['user_id'];

      $file_lama = $_POST['image'];
      $file = $_FILES['upload'];

      $file_baru = $file['name'];
      $file_temp = $file['tmp_name'];
      $file_size = $file['size'];
      $name = explode('.', $file_baru);
      $path = "../assets/profile/" . $file_baru;

      // cek jika ukurannya terlalu besar
      if ($file_size > 1000000) {
         echo "<script>
				alert('ukuran file terlalu besar!');
				location.href='my_profile.php';
			  </script>";
         return false;
      } else {
         $update = $conn->query("UPDATE `tbl_user` SET `image` = '$file_baru' WHERE `user_id` = $user_id");
         if ($update) {
            if ($file_lama != "default.png") {
               unlink("../assets/profile/" . $file_lama);
               move_uploaded_file($file_temp, $path);
               echo "<script>alert('Foto Profil Berhasil Diubah!');</script>";
               echo "<script>window.location='my_profile.php'</script>";
            } else {
               move_uploaded_file($file_temp, $path);
               echo "<script>alert('Foto Profil Berhasil Diubah!');</script>";
               echo "<script>window.location='my_profile.php'</script>";
            }
         } else {
            echo "<script>alert('Gagal Diubah!')</script>";
            echo "<script>window.location='my_profile.php'</script>";
         }
      }
   } else {
      echo "<script>alert('Required Field!')</script>";
      echo "<script>window.location='my_profile.php'</script>";
   }
}

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
               <li class="breadcrumb-item"><a href="../menu/my_profile.php">Profile</a></li>
               <li class="breadcrumb-item active" aria-current="page">Profil Saya</li>
            </ol>
         </nav>
      </div>
      <div class="row justify-content-end">

         <!-- profile -->
         <div class="col-md-4">
            <div class="card">
               <div class="card-body">
                  <h4 class="card-title mb-4">Detail Profile</h4>
                  <hr class="mb-3">
                  <form class="forms-sample" method="POST" enctype="multipart/form-data">
                     <div class="row d-flex flex-column text-center align-items-sm-center mb-4">
                        <img src="../assets/profile/<?= $user['image'] ?>" style="object-fit: cover;" class="rounded-circle" width="150px" height="150px" alt="">
                     </div>
                     <p class="card-text text-center mb-3">
                        <?= $user['username'] ?>
                     </p>
                     <p class="card-text text-center mb-3">
                        <small><b><?= followers($user['user_id']) ?></b> Followers </small>
                        <small class="text-muted"> | </small>
                        <small><b><?= following($user['user_id']) ?></b> Following </small>
                     </p>
                     <div class="row d-flext flex-column text-center align-items-sm-center ">
                        <label for="fileImage" class="btn btn-outline-secondary btn-rounded btn-sm">Ubah Foto Profile</label>
                        <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                        <input type="hidden" name="image" value="<?= $user['image'] ?>">
                        <input type="file" id="fileImage" name="upload" class="custom-file-input" multiple onchange="submitForm()" hidden>
                     </div>
                     <button id="submit" type="submit" name="submit" hidden></button>
                  </form>
               </div>
            </div>
         </div>
         <!-- end profile -->

         <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
               <div class="card-body">
                  <form class="forms-sample" method="POST">
                     <h4 class="card-title mb-4">Ubah Profile</h4>
                     <hr class="mb-4">
                     <!-- <p class="card-description"> Horizontal form layout </p> -->
                     <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                           <input type="email" class="form-control" id="email" placeholder="Username" value="<?= $user['email'] ?>" name="email" disabled>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="username" class="col-sm-3 col-form-label">Nama Akun</label>
                        <div class="col-sm-9">
                           <input type="text" class="form-control" id="username" placeholder="Email" value="<?= $user['username'] ?>" name="username">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                           <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password" name="password">
                        </div>
                     </div>
                     <button type="submit" class="btn btn-success btn-rounded mr-2" name="edit">Edit</button>
                     <button class="btn btn-light btn-rounded">Cancel</button>
                  </form>
               </div>
            </div>
         </div>


         <?php
         foreach ($files as $file) :
            $user = get_where("tbl_user", "user_id", $file['user_id']);
         ?>
            <div class="col-sm-8 mb-4">
               <div class="card">
                  <div class="card-body">
                     <a href="">
                        <h5 class="card-title"><?= $file['judul'] ?></h5>
                     </a>
                     <hr>
                     <p class="card-text">
                        <img src="../assets/profile/<?= $user['image'] ?>" alt="profile" style="width: 20px; height: 20px; object-fit: cover;" alt="foto" class="rounded-circle mr-2" class="rounded-circle">
                        <a href="profile.php?id=<?= $file['user_id']; ?>">
                           <span class="text-muted mr-2"> <?= $user['username'] ?></span>
                        </a>
                        <?php
                        btn_follow($_SESSION['user_id'], $file['user_id']);
                        btn_message($_SESSION['user_id'], $file['user_id']);
                        ?>
                        <!-- <a href="?id=<?= $user['user_id'] ?>" class="mr-2 text-primary">
                           <i class="mdi mdi-message"></i>
                           <span>Pesan</span>
                        </a> -->
                     </p>
                     <p class="card-text text-dark"><?= $file['deskripsi'] ?></p>
                     <p class="card-text">
                        <small class="text-muted">Terakhir diubah <?= date('d F Y', $file['date_created']) ?></small>
                     </p>
                     <hr>
                     <button onclick="window.location.href='../assets/uploads/<?= $user['email'] ?>/<?= $file['nama_file'] ?>';" class="btn btn-rounded btn-primary mr-2">Download</button>
                     <button type="submit" onclick="window.location.href='share_file.php';" class="btn btn-outline-primary btn-rounded btn-icon">
                        <i class="mdi mdi-share"></i>
                     </button>
                  </div>
               </div>
            </div>
         <?php endforeach ?>

      </div>
   </div>

   <!-- akhir konten -->

   <?php include '../templates/footer.php' ?>