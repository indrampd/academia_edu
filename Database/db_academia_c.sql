-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Jun 2021 pada 14.20
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_academia`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_data_follow`
--

CREATE TABLE `tbl_data_follow` (
  `follow_id` int(11) NOT NULL,
  `user_follower` int(11) DEFAULT NULL,
  `user_followed` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_data_follow`
--

INSERT INTO `tbl_data_follow` (`follow_id`, `user_follower`, `user_followed`) VALUES
(23, 1, 2),
(24, 3, 2),
(32, 2, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_file`
--

CREATE TABLE `tbl_file` (
  `file_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `judul` mediumtext DEFAULT NULL,
  `deskripsi` mediumtext DEFAULT NULL,
  `nama_file` varchar(255) DEFAULT NULL,
  `ukuran_file` varchar(255) DEFAULT NULL,
  `tipe_file` char(10) DEFAULT NULL,
  `privasi` int(1) DEFAULT NULL,
  `date_created` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_file`
--

INSERT INTO `tbl_file` (`file_id`, `user_id`, `judul`, `deskripsi`, `nama_file`, `ukuran_file`, `tipe_file`, `privasi`, `date_created`) VALUES
(1, 2, 'APLIKASI SIMPLE ADDITIVE WEIGHTING (SAW) DALAM PENENTUAN THE MOST LOYAL CUSTOMER', 'Perdagangan adalah hubungan yang menguntungkan antara kedua belah pihak, yaitu pembeli dan penjual. Fakta yang ada di lapangan menyebutkan bahwa perusahaan lebih berorientasi untuk memperoleh pelanggan baru, namun tidak berfokus pada kehilangan pelanggan (loss of customer). Padahal variabel kepuasan pelanggan sangat berpengaruh positif dan signifikan terhadap loyalitas pelanggan. Dan tentunya berpengaruh juga terhadap eksistensi perusahaan itu sendiri. Oleh karena itu perusahaan sebaiknyan menjaga pelanggan yang ada dengan memberikan penghargaan, seperti pemilihan “the most loyal customer”. Dalam makalah ini dibuat sistem aplikasi untuk menentukan loyalitas pelanggan menggunakan metode Simple Additive Weighting (SAW). Dalam metode ini ada 4 kriteria yang digunakan, yaitu total belanja, keaktifan pelanggan (kuantitas datang), laba perusahaan per 1 nota belanja pelanggan, value increase perusahaan dalam 2 tahun. Studi kasus dari sistem ini dilakukan pada salah satu perusahaan dagang atau swalayan. Hasil penerapan dari sistem ini adalah sistem yang bisa menentukan siapa pelanggan paling loyal dari sekian sampel pelanggan yang terpilih.', 'Studi Metode Kerja.pptx', '4004208', 'pptx', 2, 1624180028),
(2, 2, 'KONSEP DAN DESAIN ARSITEKTUR JARINGAN TEKNOLOGI INFORMASI UNTUK PENERAPAN SMART CITY (STUDI KASUS KOTA KENDARI SULAWESI TENGGARA)', 'Saat ini banyak kota besar dan berkembang menerapkan konsep smart city untuk meningkatkan pembangunan dan pelayanan kepada masyarakat termasuk kota kendari sulawesi tenggara untuk mewujudkan hal tersebut dibutuhkan infrastruktur jaringan teknologi informasi yang menghubungkan instansi pemerintahan dan fasilitas perkotaan yang menunjang smart city, salah satu hal penting dalam penyediaan infrastruktur jaringan adalah pematangan konsep dan desain arsitektur jaringan teknologi informasi, penelitian dilakukan dengan mengumpulan data tentang kondisi infrastruktur jaringan yang ada saat ini kemudian membuat konsep dan desain berdasarkan pemetaan wilayah instansi di setiap kecamatan yang ada di kota kendari Kata Kunci: Arsitektur, Tecknologi informasi, Model, Smart City', 'Program3.pdf', '284265', 'pdf', 2, 1624180345);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_role`
--

CREATE TABLE `tbl_role` (
  `role_id` int(11) NOT NULL,
  `role` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_role`
--

INSERT INTO `tbl_role` (`role_id`, `role`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_shared_file`
--

CREATE TABLE `tbl_shared_file` (
  `shared_id` int(11) NOT NULL,
  `file_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `image` varchar(150) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `date_created` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `username`, `email`, `image`, `password`, `role_id`, `status`, `date_created`) VALUES
(1, 'Admin', 'admin@sttgarut.ac.id', 'logo-small.png', 'dd333e8fd2983f714843c636620f2a57', 1, 1, 1623541329),
(2, 'Indra Mahpudin', 'indramahpudin21@gmail.com', 'logo-small.png', 'dd333e8fd2983f714843c636620f2a57', 2, 1, 1623921470),
(3, 'User Biasa', 'user@sttgarut.ac.id', 'default.png', 'dd333e8fd2983f714843c636620f2a57', 2, 1, 1624164990);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_data_follow`
--
ALTER TABLE `tbl_data_follow`
  ADD PRIMARY KEY (`follow_id`);

--
-- Indeks untuk tabel `tbl_file`
--
ALTER TABLE `tbl_file`
  ADD PRIMARY KEY (`file_id`) USING BTREE;

--
-- Indeks untuk tabel `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`role_id`) USING BTREE;

--
-- Indeks untuk tabel `tbl_shared_file`
--
ALTER TABLE `tbl_shared_file`
  ADD PRIMARY KEY (`shared_id`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`) USING BTREE;

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_data_follow`
--
ALTER TABLE `tbl_data_follow`
  MODIFY `follow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `tbl_file`
--
ALTER TABLE `tbl_file`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_shared_file`
--
ALTER TABLE `tbl_shared_file`
  MODIFY `shared_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
