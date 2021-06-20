<?php
// wajib disetiap halaman
include '../core/autoload.php';
require '../core/functions.php';

// masukan fungsi disini

$message = "";

// if (!isset($_SESSION['user_id'])) {
//    header("Location: index.php");
// }

if (isset($_POST['btn-signup'])) {
   $username = htmlspecialchars($_POST['username']);
   $email = htmlspecialchars($_POST['email']);
   $password1 = $_POST['password'];
   $password2 = $_POST['password2'];

   $data = $conn->query("SELECT * FROM `tbl_user` WHERE `email` = '$email'");
   $count = mysqli_num_rows($data);

   if ($count == 0) {
      if ($password1 == $password2) {
         $password = md5($password1);
         $register = register($username, $email, $password);

         if ($register) {
            $message = "<p class='text-success'>Akun berhasil didaftarkan!</p>";
         }
      } else {
         $message = "<p class='text-danger'>Password yang dimasukan tidak sesuai!</p>";
      }
   } else {
      $message = "<p class='text-danger'>Gunakan email yang lain!</p>";
   }
}

// akhir fungsi

include '../templates/auth_header.php';

?>

<!-- Awal konten -->

<div class="container-scroller">
   <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
         <div class="row flex-grow">
            <div class="col-lg-5 mx-auto">
               <div class="auth-form-light text-center p-5">
                  <div class="brand-logo">
                     <img src="../assets/images/Academia.edu_logo.svg">
                  </div>
                  <h4>New here?</h4>
                  <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
                  <form class="pt-3" method="POST">
                     <?= $message ?>
                     <div class="form-group">
                        <input type="text" class="form-control form-control-lg" id="exampleInputFullname" placeholder="Full Name" name="username" required>
                     </div>
                     <div class="form-group">
                        <input type="email" class="form-control form-control-lg" id="exampleInputEmail" placeholder="Email" name="email" required>
                     </div>
                     <div class="form-group">
                        <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" name="password" required>
                     </div>
                     <div class="form-group">
                        <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Konfirmasi Password" name="password2" required>
                     </div>
                     <div class="mt-3">
                        <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" name="btn-signup">SIGN UP</button>
                     </div>
                     <div class=" text-center mt-4 font-weight-light"> Already have an account? <a href="index.php" class="text-primary">Login</a>
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