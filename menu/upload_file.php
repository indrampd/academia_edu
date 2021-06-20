<?php

session_start();

include '../core/autoload.php';
require '../core/functions.php';

if (!isset($_SESSION['user_id'])) {
	header("location: ../auth");
}


$pesan = '';

if (isset($_POST["btn-upload"])) {
	// cek apakah data berhasil di tambahkan atau tidak
	$judul = $_POST['judul'];
	$deskripsi = $_POST['deskripsi'];

	if (upload($judul, $deskripsi) > 0) {
		echo " <script>alert('data gagal ditambahkan!');</script>";
	} else {
		echo "<script>alert('data berhasil ditambahkan!'); location.href='my_files.php'</script>";
	}
}


// function isset_file($name)
// {
// 	return (isset($_FILES[$name]) && $_FILES[$name]['error'] != UPLOAD_ERR_NO_FILE);
// }


// if (isset($_POST['upload-data'])) {
// 	$name = $_FILES['file']['name'];
// 	$temp_name = $_FILES['file']['tmp_name'];


// 	if (isset_file('file')) {
// 		$pesan = '<div class="alert alert-success" > Data Sudah ada bos! </div>';
// 	} else {
// 		$pesan = '<div class="alert alert-danger" > Form Data tidak boleh kosong! </div>';
// 	}
// }


include '../templates/header.php';  // 1
include '../templates/navbar.php';  // 2
include '../templates/sidebar.php'; // 3
?>




<script src="../assets/js/file-upload.js"></script>
<!-- main konten -->
<div class="main-panel">
	<div class="content-wrapper">
		<div class="page-header">
			<h3 class="page-title"> Upload File </h3>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="../menu/data_user.php">Users Management</a></li>
					<li class="breadcrumb-item active" aria-current="page">Upload File</li>
				</ol>
			</nav>
		</div>

		<div class="row">
			<div class="col-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title mb-5">Upload File</h4>
						<hr class="mb-5">
						<!-- <p class="card-description"> Basic form elements </p> -->
						<form class="forms-sample" method="post" enctype="multipart/form-data">
							<div class=" form-group row">
								<label for="judul" class="col-sm-3 col-form-label">Judul</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="judul" name="judul" required>
								</div>
							</div>
							<div class="form-group row">
								<label for="deskripsi" class="col-sm-3 col-form-label">Deskripsi</label>
								<div class="col-sm-9">
									<textarea class="form-control" id="deskripsi" rows="4" name="deskripsi" required></textarea>
								</div>
							</div>
							<div class="form-group row">
								<label for="fileUpload" class="col-sm-3 col-form-label">File upload</label>
								<div class="col-sm-9">
									<input type="file" id="fileUpload" name="file[]" class="file-upload-default">
									<div class=" input-group col-xs-12">
										<input type="text" id="fileUpload" class="form-control file-upload-info" disabled placeholder="Upload File (.doc,.docx,.pdf,.csv, .xlsx, .ppt , dsb) " multiple required>
										<span class="input-group-append">
											<button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
										</span>
									</div>
								</div>
							</div>
							<button type="submit" class="btn btn-gradient-primary mr-2" name="btn-upload">Upload</button>
							<button class="btn btn-gradient-light" type="reset">Cancel</button>
						</form>
					</div>
				</div>
			</div>
		</div>



	</div>
	<!-- akhir konten -->

	<?php include '../templates/footer.php' ?>