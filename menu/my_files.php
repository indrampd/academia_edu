<?php

session_start();

include '../core/autoload.php';
require '../core/functions.php';

if (!isset($_SESSION['user_id'])) {
   header("location: ../auth");
}


if ($_SESSION['role'] == 1) {
   $files = query_assoc("SELECT * FROM tbl_file");
} else {
   $user_id = $_SESSION['user_id'];
   $files = query_assoc("SELECT * FROM tbl_file WHERE `user_id` = $user_id");
}
// $user = get_where("tbl_user", 'user_id', $files[0]['user_id']);

include '../templates/header.php';  // 1
include '../templates/navbar.php';  // 2
include '../templates/sidebar.php'; // 3

?>
<!-- konten -->

<div class="main-panel">
   <div class="content-wrapper">
      <div class="page-header">
         <h3 class="page-title"> My Files </h3>
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="../menu/data_user.php">Files Management</a></li>
               <li class="breadcrumb-item active" aria-current="page">My Files</li>
            </ol>
         </nav>
      </div>
      <div class="row">

         <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
               <div class="card-body">
                  <h4 class="card-title mb-5">Data Files</h4>
                  <?php if (isset($_SESSION['message'])) : ?>
                     <?php echo $_SESSION['message']; ?>
                  <?php endif; ?>
                  <?php unset($_SESSION['message']); ?>
                  <hr class="mb-5">
                  <!-- <p class="card-description"> Add class <code>.table-hover</code> -->
                  </p>
                  <div class="table-responsive">
                     <table id="example" class="table">
                        <thead>
                           <tr>
                              <th width="5%">No</th>
                              <th width="20%">Pemilik</th>
                              <th width="20%">Judul</th>
                              <th width="30%">Deskripsi</th>
                              <th width="10%">Privasi</th>
                              <th>Waktu Upload</th>
                              <th width="4%"></th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           $i = 1;
                           foreach ($files as $file) :
                              $user = get_where("tbl_user", "user_id", $file['user_id']);
                           ?>
                              <tr>
                                 <td><?= $i++ ?></td>
                                 <td><?= $user['email'] ?></td>
                                 <td><?= $file['judul'] ?> </td>
                                 <td><?= $file['deskripsi'] ?></td>
                                 <td><?= privasi($file['privasi']) ?></td>
                                 <!-- <td><?= convert_size_file($file['ukuran_file'], 'M', 1) ?> MB</td> -->
                                 <td><?= date('d F Y', $file['date_created']) ?> </td>
                                 <td class="text-right">
                                    <div class="dropdown">
                                       <a class="badge badge-sm badge-icon-only badge-secondary text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <i class="fas fa-ellipsis-v"></i>
                                       </a>
                                       <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                          <a class="dropdown-item" href="edit_file.php?id=<?= $file['file_id'] ?>">Edit</a>
                                          <a class="dropdown-item" href="share_file.php?id=<?= $file['file_id'] ?>">Bagikan</a>

                                          <!-- modal button -->
                                          <a class="dropdown-item" data-toggle="modal" data-target="#HapusModal-<?= $file['file_id'] ?>" style="cursor:pointer">Hapus</a>

                                       </div>
                                    </div>
                                 </td>

                                 <div class="modal fade" id="HapusModal-<?= $file['file_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modalHapus" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-title" id="HapusModalLongTitle">Hapus data</h5>
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                             </button>
                                          </div>
                                          <div class="modal-body">
                                             Apakah Anda yakin ingin menghapus data ini?
                                          </div>
                                          <div class="modal-footer">
                                             <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                             <a class="btn btn-danger" href="delete_file.php?id=<?= $file['file_id'] ?>">Hapus</a>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </tr>
                           <?php endforeach; ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>

      </div>
   </div>
   <!-- content-wrapper ends -->

   <!-- akhir konten -->
   <?php include '../templates/footer.php' ?>