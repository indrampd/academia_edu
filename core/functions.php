<?php
include 'autoload.php';

function get_where($table, $where, $id)
{
   global $conn;

   $data = mysqli_fetch_assoc($conn->query("SELECT * FROM $table WHERE $where = $id"));

   return $data;
}

function query($select, $table, $where, $params)
{
   global $conn;

   $data = $conn->query("SELECT $select FROM $table WHERE $where = $params");

   return ($data);
}

function query_assoc($sql)
{
   global $conn;

   $result = $conn->query($sql);
   $data = [];
   while ($row = mysqli_fetch_assoc($result)) {
      $data[] = $row;
   }

   return $data;
}

function delete($id)
{
   global $conn;

   $conn->query("DELETE FROM `tbl_user` WHERE `user_id` = $id");

   return mysqli_affected_rows($conn);
}

function register($username, $email, $password)
{
   global $conn;

   $image = "default.png";
   $role_id = 2;
   $status = 2;
   $created = time();

   $data = $conn->query("INSERT INTO `tbl_user`(`username`, `email`, `image`, `password`, `role_id`,`status`, `date_created`) VALUES ('$username' , '$email' , '$image', '$password', $role_id, $status, $created)");

   return $data;
}

function addUser($username, $email, $role_id, $status)
{
   global $conn;

   $image = "default.png";
   $password = md5("sttgarut");
   $created = time();

   $data = $conn->query("INSERT INTO `tbl_user`(`username`, `email`, `image`, `password`, `role_id`,`status`, `date_created`) VALUES ('$username' , '$email' , '$image', '$password', $role_id, $status, $created)");

   return $data;
}

function updateUser($username, $email, $role_id, $status, $user_id)
{
   global $conn;

   $data = $conn->query("UPDATE `db_academia`.`tbl_user` SET `username` = '$username', `email` =  '$email', `role_id` = $role_id, `status` = $status WHERE `user_id` = $user_id");

   return $data;
}



























function do_follow($id_user, $id_user_followed)
{
   global $conn;

   $result = mysqli_query($conn, "INSERT INTO tbl_data_follow VALUES('','$id_user','$id_user_followed')");

   if (mysqli_affected_rows($conn) > 0) {
      return true;
   } else {
      return false;
   }
}

function do_unfollow($id_user, $id_user_followed)
{
   global $conn;

   $result = mysqli_query($conn, "DELETE FROM tbl_data_follow WHERE user_follower = '$id_user' AND user_followed = '$id_user_followed'");

   if (mysqli_affected_rows($conn) > 0) {
      return true;
   } else {
      return false;
   }
}

function isFollowed($id_user, $id_user_followed)
{
   global $conn;

   $result = mysqli_query($conn, "SELECT * FROM tbl_data_follow WHERE user_follower = '$id_user' AND user_followed = '$id_user_followed'");
   if (mysqli_fetch_assoc($result)) {
      return true;
   } else {
      return false;
   }
}

function followers($user_id)
{
   global $conn;

   $result = mysqli_query($conn, "SELECT * FROM tbl_data_follow WHERE user_followed = '$user_id'");

   return mysqli_num_rows($result);
}

function following($user_id)
{
   global $conn;

   $result = mysqli_query($conn, "SELECT * FROM tbl_data_follow WHERE user_follower = '$user_id'");

   return mysqli_num_rows($result);
}

function btn_follow($id_session, $user_id)
{
   if ($id_session != $user_id) {
      if (isFollowed($id_session, $user_id)) {
         echo "
         <a href='?unfollow=1&id=$id_session&followed=$user_id' class='mr-2 text-success'>
            <i class='mdi mdi-check-circle'></i>
            <span>Followed</span>
         </a>";
      } else {
         echo "
         <a href='?follow=1&id=$id_session&followed=$user_id' class='mr-2 text-primary'>
            <i class='mdi mdi-plus-circle'></i>
            <span>Follow</span>
         </a>";
      }
   }
}

function status($string)
{
   if ($string == 1) {
      $data = "<label class='badge badge-info'>Aktif</label>";
   } else {
      $data = "<label class='badge badge-danger'>Non-Aktif</label>";
   }

   return $data;
}

function privasi($string)
{
   if ($string == 1) {
      $data = "<label class='badge badge-secondary'>Pribadi</label>";
   } else {
      $data = "<label class='badge badge-info'>Publik</label>";
   }

   return $data;
}

function statusname($string)
{
   if ($string == 1) {
      $data = "Aktif";
   } else {
      $data = "Non-aktif";
   }

   return $data;
}

function rolename($string)
{
   global $conn;

   $data = mysqli_fetch_assoc($conn->query("SELECT `tbl_user`.`role_id`, `tbl_role`.`role` FROM `tbl_user` JOIN `tbl_role` ON `tbl_user`.`role_id` = `tbl_role`.`role_id` WHERE tbl_role.`role_id`= '$string' "));

   return $data['role'];
}

function convert_size_file($bytes, $to, $decimal_places = 1)
{
   $formulas = array(
      'K' => number_format($bytes / 1024, $decimal_places),
      'M' => number_format($bytes / 1048576, $decimal_places),
      'G' => number_format($bytes / 1073741824, $decimal_places)
   );
   return isset($formulas[$to]) ? $formulas[$to] : 0;
}


function upload($judul, $deskripsi)
{
   global $conn;

   $email = $_SESSION['login'];
   $user_id = $_SESSION['user_id'];
   $waktu_upload = time();

   $folderUpload = "../assets/uploads/$email";

   # periksa apakah folder tersedia
   if (!is_dir($folderUpload)) {
      # jika tidak maka folder harus dibuat terlebih dahulu
      mkdir($folderUpload, 0777, $rekursif = true);
   }

   $jumlahFile = count($_FILES['file']['name']);

   for ($i = 0; $i < $jumlahFile; $i++) {
      $uploadFile = $_FILES['file'];
      $namaFile = $_FILES['file']['name'][$i];
      $lokasiTmp = $_FILES['file']['tmp_name'][$i];
      $size = $_FILES['file']['size'][$i];

      $extractFile = pathinfo($uploadFile['name'][$i]);

      $sameName = 0;
      $handle = opendir($folderUpload);
      while (false !== ($file = readdir($handle))) {
         if (strpos($file, $extractFile['filename']) !== false)
            $sameName++;
      }

      $type = $extractFile['extension'];
      $newName = empty($sameName) ? $extractFile['basename'] : $extractFile['filename'] . '(' . $sameName . ').' . $extractFile['extension'];

      $lokasiBaru = "{$folderUpload}/{$newName}";

      $insertfile = mysqli_query($conn, "INSERT INTO `tbl_file` SET `user_id` = '$user_id', `judul` = '$judul', `deskripsi` = '$deskripsi', `nama_file` = '$newName', `ukuran_file` = '$size', `tipe_file` = '$type', `date_created` = '$waktu_upload' ");

      if ($insertfile) {
         $prosesUpload = move_uploaded_file($lokasiTmp, $lokasiBaru);
      }
   }
}
