<?php
session_start();

// wajib disetiap halaman
include '../core/autoload.php';
require '../core/functions.php';

// masukan fungsi disini

$message = '';

// Fungsi untuk keep me signed in
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
   $id = $_COOKIE['id'];
   $key = $_COOKIE['key'];

   // Ambil email berdasarkan ID
   $data = query_assoc("SELECT `email` FROM `tbl_user` WHERE `user_id` = $id'");

   // Cek cookie dan email
   if ($key === hash('sha256', $data['email'])) {
      $_SESSION['login'] = true;
   }
}

// Jika sesi login ada maka pindah ke halaman index.php
if (!empty($_SESSION['login'])) {
   header("location: ../index.php");
}

// Mengecek user yang login sesuai dengan username dan password di database
if (isset($_POST['btn-login'])) {
   $email = $_POST['email'];
   $password =  md5($_POST['password']);

   $result = mysqli_query($conn, "SELECT * FROM `tbl_user` WHERE  `email` = '$email' and `password` = '$password'");
   $data = mysqli_fetch_array($result);


   if (mysqli_num_rows($result) > 0) {
      $_SESSION['user_id'] = ($data['user_id']);
      $_SESSION['login'] = ($data['email']);
      $_SESSION['username'] = ($data['username']);
      $_SESSION['role'] = ($data['role_id']);
      $_SESSION['status'] = ($data['status']);
      $_SESSION['image'] = ($data['image']);

      // Untuk cookie
      if (isset($_POST['remember'])) {

         setcookie('id', $data['user_id'], time() + 3600);
         setcookie('key', hash('sha256', $data['email']), time() + 3600);
      }

      header("location: ./index.php");
   } else {
      $message = "<label>Username atau Password Salah!</label>";
   }
}

// akhir fungsi

include '../templates/auth_header.php';

?>

<!-- awal konten -->

<div class="container-scroller">
   <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
         <div class="row flex-grow">
            <div class="col-lg-5 mx-auto">
               <div class="auth-form-light text-center p-5">
                  <div class="brand-logo">
                     <img src="../assets/images/Academia.edu_logo.svg">
                  </div>
                  <h4>Hello! let's get started</h4>
                  <h6 class="font-weight-light">Sign in to continue.</h6>
                  <form class="pt-3" role="form" method="POST">
                     <p class="text-danger"><?php echo $message; ?></p>
                     <div class="form-group">
                        <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email" name="email">
                     </div>
                     <div class="form-group">
                        <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" name="password">
                     </div>
                     <div class="mt-3">
                        <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" name="btn-login">SIGN IN</button>
                     </div>
                     <div class="my-2 d-flex justify-content-between align-items-center">
                        <div class="form-check">
                           <label class="form-check-label text-muted">
                              <input type="checkbox" class="form-check-input" name="remember"> Keep me signed in </label>
                        </div>
                        <!-- <a href="#" class="auth-link text-black">Forgot password?</a> -->
                     </div>
                     <div class="text-center mt-4 font-weight-light"> Don't have an account? <a href="register.php" class="text-primary">Create</a>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <!-- content-wrapper ends -->
   </div>
   <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->

<!-- akhir konten -->

<?php include '../templates/auth_footer.php' ?>