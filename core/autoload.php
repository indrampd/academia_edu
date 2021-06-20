<?php

$host = "localhost";
$username = "root";
$password = "";
$dbname = "db_academia_c";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (mysqli_connect_errno()) {
   echo "Koneksi ke database gagal" . mysqli_connect_error();
}
