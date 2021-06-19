<?php
session_start();

$message = "";

include '../core/autoload.php';
require '../core/functions.php';

$file_id = $_GET['id'];

$data = get_where("tbl_file", "file_id", "$file_id");

$file = $data['nama_file'];

$email = $_SESSION['login'];


$delete = mysqli_query($conn, "DELETE FROM `tbl_file` WHERE `file_id`='$file_id'");


if ($delete) {
   unlink("../assets/uploads/$email/" . $file);
   echo "<script> alert('Data Berhasil Dihapus!'); location.href='my_files.php'</script>";
} else {
   echo '<script>Data Gagal Dihapus!</script>';
}
