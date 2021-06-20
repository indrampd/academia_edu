<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
   <ul class="nav">
      <li class="nav-item nav-profile">
         <a href="../menu/my_profile.php" class="nav-link">
            <div class="nav-profile-image">
               <img src="../assets/profile/<?= $user_session['image'] ?>" alt="profile">
               <span class="login-status online"></span>
               <!--change to offline or busy as needed-->
            </div>
            <div class="nav-profile-text d-flex flex-column">
               <span class="font-weight-bold mb-2"><?= $username ?></span>
               <span class="text-secondary text-small"><?= rolename($role_id) ?></span>
            </div>
            <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
         </a>
      </li>
      <li class="nav-item <?= ($_SESSION['role'] == 2) ? 'd-none' : ""; ?> ">
         <a class="nav-link" href="../menu/dashboard.php">
            <span class="menu-title">Dashboard</span>
            <i class="mdi mdi-view-dashboard menu-icon"></i>
         </a>
      </li>
      <li class="nav-item">
         <a class="nav-link" href="../menu/home.php">
            <span class="menu-title">Home</span>
            <i class="mdi mdi-home menu-icon"></i>
         </a>
      </li>
      <li class="nav-item <?= ($_SESSION['role'] == 2) ? 'd-none' : ""; ?> ">
         <a class="nav-link" data-toggle="collapse" href="#user-management" aria-expanded="false" aria-controls="user-management">
            <span class="menu-title">Users Management</span>
            <i class="menu-arrow"></i>
            <i class="mdi mdi-account-settings menu-icon"></i>
         </a>
         <div class="collapse" id="user-management">
            <ul class="nav flex-column sub-menu">
               <li class="nav-item"> <a class="nav-link" href="../menu/data_user.php">Data User</a></li>
               <li class="nav-item"> <a class="nav-link" href="../menu/add_user.php">Add User</a></li>
            </ul>
         </div>
      </li>
      <li class="nav-item">
         <a class="nav-link" data-toggle="collapse" href="#file-management" aria-expanded="false" aria-controls="file-management">
            <span class="menu-title">Files Management</span>
            <i class="menu-arrow"></i>
            <i class="mdi mdi-file menu-icon"></i>
         </a>
         <div class="collapse" id="file-management">
            <ul class="nav flex-column sub-menu">
               <li class="nav-item"> <a class="nav-link" href="../menu/my_files.php">My Files</a></li>
               <li class="nav-item"> <a class="nav-link" href="../menu/share_file.php">Shared File</a></li>
               <li class="nav-item"> <a class="nav-link" href="../menu/upload_file.php">Upload File</a></li>
            </ul>
         </div>
      </li>
      <li class="nav-item">
         <a class="nav-link" href="../menu/users.php">
            <span class="menu-title">Friends List</span>
            <i class="mdi mdi-account-search menu-icon"></i>
         </a>
      </li>
   </ul>
</nav>