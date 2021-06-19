<?php

session_start();

$message = "";

include '../core/autoload.php';
require '../core/functions.php';

if (!isset($_SESSION['user_id'])) {
   header("location: ../auth");
}


if (isset($_GET['hapus'])) {
   $id = $_GET['hapus'];
   $user = get_where("tbl_user", "user_id", $id);

   if ($_SESSION['role'] != 1) {
      if ($id != $_SESSION['user_id']) {
         header("Location: ../index.php");
      }
   } else {
      $delete = delete($id);

      if (is_file("../assets/profile/" . $user['image'])) {
         if ($user['image'] != "default.png") {
            unlink("../assets/profile" . $user['image']);
         }
      }

      if ($delete) {
         $_SESSION['message'] = "<div class='alert alert-success' role='alert'>Data berhasil dihapus</div>";
         header("location: data_user.php");
      }
   }
} else {
   $_SESSION['message'] = "<div class='alert alert-danger' role='alert'>Data tidak bisa dihapus</div>";
   header("Location: data_user.php");
}
