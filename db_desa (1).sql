-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Feb 2022 pada 15.26
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
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(5) NOT NULL,
  `username_admin` varchar(15) DEFAULT NULL,
  `password` varchar(10) DEFAULT NULL,
  `nama_admin` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `username_admin`, `password`, `nama_admin`) VALUES
(1, 'admin1', 'admin1', 'nama admin1');

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
  `jumlah_keluar` int(11) DEFAULT NULL,
  `rincian_keluar` text DEFAULT NULL,
  `tahun_keluar` int(5) DEFAULT NULL,
  `id_bidang_keluar` int(3) DEFAULT NULL,
  `id_subbidang_keluar` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_keluar`
--

INSERT INTO `tb_keluar` (`id_keluar`, `rekening_keluar`, `jumlah_keluar`, `rincian_keluar`, `tahun_keluar`, `id_bidang_keluar`, `id_subbidang_keluar`) VALUES
(1, '098098.09', 1000, 'rincian keluar 1', 2003, 3, 28),
(4, '98908.23', 20000, 'rincian surplus', 2131, 6, 39);

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
  `jumlah_masuk` int(11) DEFAULT NULL,
  `tahun_masuk` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_masuk`
--

INSERT INTO `tb_masuk` (`id_masuk`, `id_sumber_masuk`, `id_jenis_sumber_masuk`, `rincian_masuk`, `rekening_masuk`, `jumlah_masuk`, `tahun_masuk`) VALUES
(1, 1, 1, 'rincian masuk 1', '9800.987', 5000, 2001),
(2, 1, 3, 'rincian masuk 2', '12.34.5', 4000, 2002),
(3, 2, 4, 'rincian masuk 3', '98.45.3', 3000, 2003);

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

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

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
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id_keluar` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_masuk`
--
ALTER TABLE `tb_masuk`
  MODIFY `id_masuk` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
