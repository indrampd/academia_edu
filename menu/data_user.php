<?php

session_start();

include '../core/autoload.php';
require '../core/functions.php';

if (!isset($_SESSION['user_id'])) {
   header("location: ../auth");
}

$users = query_assoc("SELECT * FROM tbl_user");

include '../templates/header.php';  // 1
include '../templates/navbar.php';  // 2
include '../templates/sidebar.php'; // 3

?>
<!-- konten -->

<div class="main-panel">
   <div class="content-wrapper">
      <div class="page-header">
         <h3 class="page-title"> Data Users </h3>
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="../menu/data_user.php">Users Management</a></li>
               <li class="breadcrumb-item active" aria-current="page">Data Users</li>
            </ol>
         </nav>
      </div>
      <div class="row">

         <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
               <div class="card-body">
                  <h4 class="card-title mb-5">Data Users</h4>
                  <?php if (isset($_SESSION['message'])) : ?>
                     <?php echo $_SESSION['message']; ?>
                  <?php endif; ?>
                  <?php unset($_SESSION['message']); ?>
                  <hr class="mb-5">
                  <!-- <p class="card-description"> Add class <code>.table-hover</code> -->
                  </p>
                  <table id="example" class="table">
                     <thead>
                        <tr>
                           <th>No</th>
                           <th>Image</th>
                           <th>Nama Lengkap</th>
                           <th>Email</th>
                           <th>Tanggal Pembuatan</th>
                           <th>Status</th>
                           <th>Role</th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        $i = 1;
                        foreach ($users as $user) :
                        ?>
                           <tr>
                              <td><?= $i++ ?></td>
                              <td><img src="../assets/profile/<?= $user['image']; ?>" style="width: 50px; height: 50px; object-fit: cover;" alt="foto" class="rounded-circle"></td>
                              <td><?= $user['username'] ?></td>
                              <td><?= $user['email'] ?></td>
                              <td><?= date('d F Y', $user['date_created']) ?></td>
                              <td><?= status($user['status']) ?></td>
                              <td class="text-success"><?= rolename($user['role_id']); ?></i></td>
                              <td class="text-right">
                                 <div class="dropdown">
                                    <a class="badge badge-sm badge-icon-only badge-secondary text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                       <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                       <a class="dropdown-item" href="edit_user.php?id=<?= $user['user_id'] ?>">Edit</a>

                                       <!-- modal button -->
                                       <a class="dropdown-item" data-toggle="modal" data-target="#HapusModal-<?= $user['user_id'] ?>" style="cursor:pointer">Hapus</a>

                                    </div>
                                 </div>
                              </td>

                              <div class="modal fade" id="HapusModal-<?= $user['user_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modalHapus" aria-hidden="true">
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
                                          <a class="btn btn-danger" href="delete_user.php?hapus=<?= $user['user_id'] ?>">Hapus</a>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </tr>
                        <?php endforeach; ?>
                        <!-- <tr>
                           <td>Jacob</td>
                           <td>Photoshop</td>
                           <td>Photoshop</td>
                           <td>Photoshop</td>
                           <td>Photoshop</td>
                           <td>Photoshop</td>
                           <td><label class="badge badge-danger">Non-Aktif</label></td>
                           <td class="text-danger"> User</i></td>
                        </tr> -->
                     </tbody>
                  </table>
               </div>
            </div>
         </div>

      </div>
   </div>
   <!-- content-wrapper ends -->

   <!-- akhir konten -->
   <?php include '../templates/footer.php' ?>