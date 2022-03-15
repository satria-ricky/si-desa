-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Mar 2022 pada 08.19
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_desa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_bidang`
--

CREATE TABLE `tb_bidang` (
  `id_bidang` int(11) NOT NULL,
  `nama_bidang` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_bidang`
--

INSERT INTO `tb_bidang` (`id_bidang`, `nama_bidang`) VALUES
(1, 'Penyelenggaran pemerintah desa'),
(2, 'Pelaksanaan pembangunan desa\r\n'),
(3, 'Pembinaan desa'),
(4, 'Pemberdayaan masyarakat'),
(5, 'Penanggulangan bencana darurat dan mendesak desa'),
(6, 'Surplus defisit');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jenis_masuk`
--

CREATE TABLE `tb_jenis_masuk` (
  `jenis_masuk_id` int(11) NOT NULL,
  `jenis_sumber_id` int(11) DEFAULT NULL,
  `jenis_nama` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_jenis_masuk`
--

INSERT INTO `tb_jenis_masuk` (`jenis_masuk_id`, `jenis_sumber_id`, `jenis_nama`) VALUES
(1, 1, 'Hasil usaha desa'),
(2, 1, 'Hasil aset desa'),
(3, 1, 'Swadaya, partisipasi dan gotong royong'),
(4, 2, 'Dana desa'),
(5, 2, 'Bagi hasil pajak dan retribusi'),
(6, 2, 'Alokasi dana desa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_keluar`
--

CREATE TABLE `tb_keluar` (
  `id_keluar` int(5) NOT NULL,
  `rekening_keluar` varchar(20) DEFAULT NULL,
  `jumlah_keluar` double DEFAULT NULL,
  `rincian_keluar` text DEFAULT NULL,
  `tahun_keluar` int(5) DEFAULT NULL,
  `id_bidang_keluar` int(3) DEFAULT NULL,
  `id_subbidang_keluar` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_keluar`
--

INSERT INTO `tb_keluar` (`id_keluar`, `rekening_keluar`, `jumlah_keluar`, `rincian_keluar`, `tahun_keluar`, `id_bidang_keluar`, `id_subbidang_keluar`) VALUES
(1, '098098.09', 300, 'rincian keluar 1', 2003, 3, 28),
(8, '1213.23', 10000, 'asdasd', 2001, 4, 29),
(9, '1213.23', 200, 's', 2003, 3, 27),
(10, '90.90.90', 500, 'RINCIAN', 5555, 2, 10),
(11, '90.90.90', 99, 'RINCIAN BARU', 2001, 2, 9),
(12, '3242.234', 50000, 'RINCIAN BARU', 2001, 5, 36),
(15, '90.90.91', 1, 'RINCIAN BARU', 2022, 2, 10),
(16, '90.90.90', 2, 'RINCIAN BARU', 2022, 2, 11),
(18, '90.90.91', 1, 'RINCIAN BARU', 2001, 3, 26);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_laporan`
--

CREATE TABLE `tb_laporan` (
  `laporan_id` int(11) NOT NULL,
  `laporan_jenis` int(11) DEFAULT NULL,
  `laporan_tahun` int(11) DEFAULT NULL,
  `laporan_user_id_kepala` int(11) DEFAULT NULL,
  `laporan_user_id_sekretaris` int(11) DEFAULT NULL,
  `laporan_status_kepala` int(11) DEFAULT NULL,
  `laporan_status_sekretaris` int(11) DEFAULT NULL,
  `laporan_created` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_laporan`
--

INSERT INTO `tb_laporan` (`laporan_id`, `laporan_jenis`, `laporan_tahun`, `laporan_user_id_kepala`, `laporan_user_id_sekretaris`, `laporan_status_kepala`, `laporan_status_sekretaris`, `laporan_created`) VALUES
(3, 1, 2001, 17, 15, 1, 1, '14-03-2022'),
(5, 2, 2001, 17, 15, 1, 1, '15-03-2022'),
(6, 2, 2003, 17, 15, 2, 1, '15-03-2022'),
(7, 1, 2022, 17, 15, 2, 2, '15-03-2022');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_level_user`
--

CREATE TABLE `tb_level_user` (
  `level_id` int(11) NOT NULL,
  `level_nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_level_user`
--

INSERT INTO `tb_level_user` (`level_id`, `level_nama`) VALUES
(2, 'Admin'),
(3, 'Kepala Desa'),
(4, 'Sekretaris');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_masuk`
--

CREATE TABLE `tb_masuk` (
  `id_masuk` int(5) NOT NULL,
  `id_sumber_masuk` int(11) DEFAULT NULL,
  `id_jenis_sumber_masuk` int(11) DEFAULT NULL,
  `rincian_masuk` text DEFAULT NULL,
  `rekening_masuk` varchar(20) DEFAULT NULL,
  `jumlah_masuk` double DEFAULT NULL,
  `tahun_masuk` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_masuk`
--

INSERT INTO `tb_masuk` (`id_masuk`, `id_sumber_masuk`, `id_jenis_sumber_masuk`, `rincian_masuk`, `rekening_masuk`, `jumlah_masuk`, `tahun_masuk`) VALUES
(1, 1, 2, 'rincian masuk 1', '9800.987', 110000, 2001),
(3, 2, 4, 'rincian masuk 3', '98.45.3', 3000, 2022),
(6, 1, 3, 'RINCIAN BARU', '321', 1000, 5555),
(7, 1, 2, 'RINCIAN BARU', '90.90.90', 10, 2090),
(8, 2, 4, 'RINCIAN', '90.90.91', 9999, 2003),
(9, 1, 2, 'RINCIAN', '90.90.90', 12, 2091);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_subbidang`
--

CREATE TABLE `tb_subbidang` (
  `sub_id` int(11) NOT NULL,
  `sub_id_bidang` int(11) DEFAULT NULL,
  `sub_nama` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_subbidang`
--

INSERT INTO `tb_subbidang` (`sub_id`, `sub_id_bidang`, `sub_nama`) VALUES
(1, 1, 'Penyelenggaran belanja siltap, tunjangan dan operasional pemerintah desa'),
(2, 1, 'Administrasi kependudukan, pencatatan sipil stastistik dan kearsipan'),
(3, 1, 'Tata praja pemerintahan perencanaan keuangan dan pelaporan'),
(4, 1, 'Pertanahan'),
(9, 2, 'Pendidikan'),
(10, 2, 'Kesehatan'),
(11, 2, 'Pekerjaan umum'),
(12, 2, 'Kawasan pemukiman'),
(13, 2, 'Kehutanan dan lingkungan hidup'),
(14, 2, 'Perhubungan, komunikasi dan informatika'),
(25, 3, 'Ketentraman, ketertiban umum dan perlindungan masyarakat'),
(26, 3, 'Kebudayaan dan keagamaan'),
(27, 3, 'Kepemudaan dan olahraga'),
(28, 3, 'Kelembagaan masyarakat'),
(29, 4, 'Peningkatan kapasitas aparatur desa\r\n'),
(30, 4, 'Pemberdayaan perempuan, perlindungan anak dan keluarga'),
(31, 4, 'Perdagangan dan perindustrian'),
(35, 5, 'Penanggulangan bencana\r\n'),
(36, 5, 'Keadaan mendesak'),
(39, 6, 'Pembiayaan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_sumber_masuk`
--

CREATE TABLE `tb_sumber_masuk` (
  `sumber_masuk_id` int(11) NOT NULL,
  `sumber_masuk_nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_sumber_masuk`
--

INSERT INTO `tb_sumber_masuk` (`sumber_masuk_id`, `sumber_masuk_nama`) VALUES
(1, 'Pendapatan asli desa'),
(2, 'Pendapatan transfer');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `user_id` int(11) NOT NULL,
  `user_id_level` int(11) DEFAULT NULL,
  `user_id_status` int(11) DEFAULT NULL,
  `user_nama` varchar(255) DEFAULT NULL,
  `user_username` varchar(255) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `user_kontak` varchar(255) DEFAULT NULL,
  `user_alamat` varchar(255) DEFAULT NULL,
  `user_ttd` varchar(255) DEFAULT NULL,
  `user_created` date DEFAULT NULL,
  `last_updated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`user_id`, `user_id_level`, `user_id_status`, `user_nama`, `user_username`, `user_password`, `user_kontak`, `user_alamat`, `user_ttd`, `user_created`, `last_updated`) VALUES
(3, 1, 1, 'nama BARU', 'super admin', 'super admin', '089999999999', 'alamat baru abah', 'tes1.png', '2021-07-28', '2021-07-28'),
(15, 4, NULL, 'nama sekretaris', 'sekretaris', 'sekretaris', NULL, NULL, '15750.jpg', NULL, NULL),
(17, 3, NULL, 'kepala desa durdongga', 'kepala', 'kepala', NULL, NULL, '10155177_540626589389254_4387240563293915915_n.jpg', NULL, NULL),
(19, 2, NULL, 'nama baru', 'admin', 'admin', NULL, NULL, '15179223_943850232425852_8786516406049919493_n.jpg', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_bidang`
--
ALTER TABLE `tb_bidang`
  ADD PRIMARY KEY (`id_bidang`);

--
-- Indeks untuk tabel `tb_jenis_masuk`
--
ALTER TABLE `tb_jenis_masuk`
  ADD PRIMARY KEY (`jenis_masuk_id`);

--
-- Indeks untuk tabel `tb_keluar`
--
ALTER TABLE `tb_keluar`
  ADD PRIMARY KEY (`id_keluar`);

--
-- Indeks untuk tabel `tb_laporan`
--
ALTER TABLE `tb_laporan`
  ADD PRIMARY KEY (`laporan_id`);

--
-- Indeks untuk tabel `tb_level_user`
--
ALTER TABLE `tb_level_user`
  ADD PRIMARY KEY (`level_id`);

--
-- Indeks untuk tabel `tb_masuk`
--
ALTER TABLE `tb_masuk`
  ADD PRIMARY KEY (`id_masuk`);

--
-- Indeks untuk tabel `tb_subbidang`
--
ALTER TABLE `tb_subbidang`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indeks untuk tabel `tb_sumber_masuk`
--
ALTER TABLE `tb_sumber_masuk`
  ADD PRIMARY KEY (`sumber_masuk_id`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_bidang`
--
ALTER TABLE `tb_bidang`
  MODIFY `id_bidang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tb_jenis_masuk`
--
ALTER TABLE `tb_jenis_masuk`
  MODIFY `jenis_masuk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_keluar`
--
ALTER TABLE `tb_keluar`
  MODIFY `id_keluar` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `tb_laporan`
--
ALTER TABLE `tb_laporan`
  MODIFY `laporan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_level_user`
--
ALTER TABLE `tb_level_user`
  MODIFY `level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_masuk`
--
ALTER TABLE `tb_masuk`
  MODIFY `id_masuk` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_subbidang`
--
ALTER TABLE `tb_subbidang`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `tb_sumber_masuk`
--
ALTER TABLE `tb_sumber_masuk`
  MODIFY `sumber_masuk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
