<?php

session_start();

include '../core/autoload.php';
require '../core/functions.php';

$pesan = "";

if (!isset($_SESSION['user_id'])) {
   header("location: ../auth");
}

if (isset($_GET['id']) && isset($_GET['followed'])) {

   if (isset($_GET['follow'])) {
      if (do_follow($_GET['id'], $_GET['followed'])) {
         header("location: home.php");
      }
   }

   if (isset($_GET['unfollow'])) {
      if (do_unfollow($_GET['id'], $_GET['followed'])) {
         header("location: home.php");
      }
   }
}
$files = query_assoc("SELECT * FROM `tbl_file` WHERE `privasi` = 2 ");
// $data = $conn->query(
//    "SELECT `tbl_user`.`*` , `tbl_file`.`*`
//    FROM `tbl_file`
//    JOIN `tbl_user` ON `tbl_file`.`user_id` =` tbl_user`.`user_id`;
//    WHERE `privasi` = 2;"
// );
$datas = $conn->query("SELECT * FROM `tbl_user` WHERE NOT `user_id` = $user_id AND NOT `role_id` = 1");


include '../templates/header.php';  // 1
include '../templates/navbar.php';  // 2
include '../templates/sidebar.php'; // 3

?>
<!-- main content -->
<div class="main-panel">
   <div class="content-wrapper">
      <!-- header -->
      <div class="page-header">
         <h3 class="page-title">Halaman Utama</h3>
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="../menu/home.php">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Halaman Utama</li>
            </ol>
         </nav>
      </div>
      <!-- akhir header -->
      <!--  -->
      <div class="row justify-content-center">
         <?= $pesan ?>
         <?php
         foreach ($files as $file) :
            $user = get_where("tbl_user", "user_id", $file['user_id']);
         ?>
            <div class="col-sm-12 mb-4">
               <div class="card">
                  <div class="card-body">
                     <a href="">
                        <h5 class="card-title"><?= $file['judul'] ?> | <?= $file['tipe_file'] ?>
                        </h5>
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
                     <button type="submit" class="btn btn-outline-secondary btn-rounded btn-icon" data-toggle="modal" data-target="#share-<?= $file['file_id'] ?>">
                        <i class="mdi mdi-share"></i>
                     </button>

                     <!-- Modal -->
                     <div class="modal fade" id="share-<?= $file['file_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="share-Title" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLongTitle">Bagikan Ke ?</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                              <div class="modal-body mb-5">
                                 <hr class="mb-3">
                                 <div class="row">
                                    <div class="col text-center">
                                       <p class="card-text">
                                          <img src="../assets/profile/<?= $user['image'] ?>" alt="profile" style="width: 40px; height: 40px; object-fit: cover;" alt="foto" class="rounded-circle mr-2" class="rounded-circle">
                                          <?= $user['username'] ?>
                                       </p>
                                    </div>
                                    <div class="col text-center">
                                       <p class="card-text">
                                          <button type="submit" class="btn btn-primary btn-rounded btn-icon">
                                             <i class="mdi mdi-share"></i>
                                          </button>
                                       </p>
                                    </div>
                                 </div>
                              </div>
                              <hr>
                           </div>
                        </div>
                     </div>

                  </div>
               </div>
            </div>
         <?php endforeach ?>


      </div>
   </div>
   <!-- akhir konten -->

   <?php include '../templates/footer.php' ?>