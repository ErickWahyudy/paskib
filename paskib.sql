-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Jul 2023 pada 16.36
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `paskib`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jasmani`
--

CREATE TABLE `tb_jasmani` (
  `id_jasmani` varchar(15) NOT NULL,
  `id_pengguna` varchar(15) NOT NULL,
  `id_peserta` varchar(15) NOT NULL,
  `nilai_lari` varchar(3) NOT NULL,
  `nilai_pushUp` varchar(3) NOT NULL,
  `nilai_sitUp` varchar(3) NOT NULL,
  `tahun` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_jasmani`
--

INSERT INTO `tb_jasmani` (`id_jasmani`, `id_pengguna`, `id_peserta`, `nilai_lari`, `nilai_pushUp`, `nilai_sitUp`, `tahun`) VALUES
('j001vwnu5', 'A0032wpbq0', 'P0053jRgzz', '74', '79', '80', 2023),
('j002sGIkd', 'A0032wpbq0', 'P002c86ZkE', '74', '80', '79', 2023),
('j003T5mD3', 'A0032wpbq0', 'P0044kTXLz', '72', '65', '68', 2023),
('j004wW540', 'A0032wpbq0', 'P003FBBKNz', '72', '74', '75', 2023),
('j005oB7O1', 'A0032wpbq0', 'P001mQGYDT', '78', '73', '77', 2023);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kriteria`
--

CREATE TABLE `tb_kriteria` (
  `id_kriteria` varchar(15) NOT NULL,
  `kriteria` varchar(15) NOT NULL,
  `bobot` varchar(5) NOT NULL,
  `nama_nilai1` varchar(15) NOT NULL,
  `nama_nilai2` varchar(15) NOT NULL,
  `nama_nilai3` varchar(15) NOT NULL,
  `nama_nilai4` varchar(15) NOT NULL,
  `nama_nilai5` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kriteria`
--

INSERT INTO `tb_kriteria` (`id_kriteria`, `kriteria`, `bobot`, `nama_nilai1`, `nama_nilai2`, `nama_nilai3`, `nama_nilai4`, `nama_nilai5`) VALUES
('K001ZfwKoY', 'Tinggi Badan', '30', '', '', '', '', ''),
('K002nfYbXS', 'Berat Badan', '20', '', '', '', '', ''),
('K003BNDjht', 'Jasmani', '10', 'Lari', 'Push Up', 'Sit Up', '', ''),
('K004RHwS3n', 'PBB', '20', 'Sikap', 'Gerak Badan', 'Gerak Dasar', 'Aba- Aba', ''),
('K005ndLkXQ', 'Parade', '20', 'Wajah', 'Badan', 'Bahu Pundak', 'Tangan', 'Kaki');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_level`
--

CREATE TABLE `tb_level` (
  `id_level` varchar(2) NOT NULL,
  `level` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_level`
--

INSERT INTO `tb_level` (`id_level`, `level`) VALUES
('1', 'superadmin'),
('2', 'admin'),
('3', 'juri');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_matriks`
--

CREATE TABLE `tb_matriks` (
  `id_matriks` varchar(15) NOT NULL,
  `id_peserta` varchar(15) NOT NULL,
  `id_kriteria` varchar(15) NOT NULL,
  `hasil` varchar(7) NOT NULL,
  `nilai_kriteria` varchar(2) NOT NULL,
  `tahun` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_matriks`
--

INSERT INTO `tb_matriks` (`id_matriks`, `id_peserta`, `id_kriteria`, `hasil`, `nilai_kriteria`, `tahun`) VALUES
('T001WmjGb', 'P0053jRgzz', 'K003BNDjht', '78', '3', 2023),
('T002Buis0', 'P002c86ZkE', 'K003BNDjht', '78', '3', 2023),
('T003ApRqc', 'P0044kTXLz', 'K003BNDjht', '68', '1', 2023),
('T004AiLxw', 'P003FBBKNz', 'K003BNDjht', '74', '2', 2023),
('T005rDnDe', 'P001mQGYDT', 'K003BNDjht', '76', '2', 2023),
('T006cDAp1', 'P0053jRgzz', 'K004RHwS3n', '76', '2', 2023),
('T007aigxe', 'P002c86ZkE', 'K004RHwS3n', '77', '3', 2023),
('T008wuP89', 'P0044kTXLz', 'K004RHwS3n', '77', '3', 2023),
('T009zurmp', 'P003FBBKNz', 'K004RHwS3n', '75', '2', 2023),
('T010BEJod', 'P001mQGYDT', 'K004RHwS3n', '77', '3', 2023),
('T011ARswp', 'P0053jRgzz', 'K005ndLkXQ', '74', '2', 2023),
('T012iBuX3', 'P002c86ZkE', 'K005ndLkXQ', '75', '2', 2023),
('T0133wfgc', 'P0044kTXLz', 'K005ndLkXQ', '77', '3', 2023),
('T014mLh2E', 'P003FBBKNz', 'K005ndLkXQ', '77', '3', 2023),
('T0153tpwL', 'P001mQGYDT', 'K005ndLkXQ', '77', '3', 2023);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_nilai_hasil`
--

CREATE TABLE `tb_nilai_hasil` (
  `id_nilai` varchar(15) NOT NULL,
  `id_peserta` varchar(15) NOT NULL,
  `hasil` text NOT NULL,
  `tahun` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_nilai_hasil`
--

INSERT INTO `tb_nilai_hasil` (`id_nilai`, `id_peserta`, `hasil`, `tahun`) VALUES
('H001Hvvf5', 'P0053jRgzz', '0.15025', 2023),
('H002urHPR', 'P002c86ZkE', '0.29531', 2023),
('H003XpM36', 'P0044kTXLz', '0.32911', 2023),
('H0042bWUu', 'P003FBBKNz', '0.27606', 2023),
('H00537b8p', 'P001mQGYDT', '0.27138', 2023);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_parade`
--

CREATE TABLE `tb_parade` (
  `id_parade` varchar(15) NOT NULL,
  `id_pengguna` varchar(15) NOT NULL,
  `id_peserta` varchar(15) NOT NULL,
  `nilai_wjh` varchar(3) NOT NULL,
  `nilai_bdn` varchar(3) NOT NULL,
  `nilai_bp` varchar(3) NOT NULL,
  `nilai_tgn` varchar(3) NOT NULL,
  `nilai_kk` varchar(3) NOT NULL,
  `tahun` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_parade`
--

INSERT INTO `tb_parade` (`id_parade`, `id_pengguna`, `id_peserta`, `nilai_wjh`, `nilai_bdn`, `nilai_bp`, `nilai_tgn`, `nilai_kk`, `tahun`) VALUES
('p001MFLsZ', 'A0032wpbq0', 'P0053jRgzz', '75', '74', '72', '73', '76', 2023),
('p002qhwr4', 'A0032wpbq0', 'P002c86ZkE', '77', '77', '76', '77', '77', 2023),
('p003Pwfxg', 'A0032wpbq0', 'P0044kTXLz', '77', '78', '77', '77', '77', 2023),
('p004ly9Gi', 'A0032wpbq0', 'P003FBBKNz', '76', '76', '76', '76', '77', 2023),
('p005FhMfS', 'A0032wpbq0', 'P001mQGYDT', '77', '77', '76', '76', '78', 2023),
('p0067zOyI', 'A004oJreti', 'P0053jRgzz', '73', '74', '74', '73', '73', 2023),
('p007j3m9V', 'A004oJreti', 'P002c86ZkE', '75', '73', '72', '72', '72', 2023),
('p0082qs9K', 'A004oJreti', 'P0044kTXLz', '78', '77', '78', '79', '79', 2023),
('p009kExPb', 'A004oJreti', 'P003FBBKNz', '75', '75', '72', '75', '74', 2023),
('p010OrEz8', 'A004oJreti', 'P001mQGYDT', '75', '77', '76', '75', '76', 2023),
('p011kuVCp', 'A005Wxb6fq', 'P0053jRgzz', '76', '75', '75', '75', '77', 2023),
('p01205usT', 'A005Wxb6fq', 'P002c86ZkE', '77', '77', '76', '75', '75', 2023),
('p013nR9je', 'A005Wxb6fq', 'P0044kTXLz', '76', '76', '77', '77', '77', 2023),
('p014OJG6q', 'A005Wxb6fq', 'P003FBBKNz', '80', '80', '80', '78', '78', 2023),
('p015du6Oo', 'A005Wxb6fq', 'P001mQGYDT', '80', '80', '80', '78', '78', 2023);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pbb`
--

CREATE TABLE `tb_pbb` (
  `id_pbb` varchar(15) NOT NULL,
  `id_pengguna` varchar(15) NOT NULL,
  `id_peserta` varchar(15) NOT NULL,
  `nilai_sk` varchar(3) NOT NULL,
  `nilai_gb` varchar(3) NOT NULL,
  `nilai_gd` varchar(3) NOT NULL,
  `nilai_ab` varchar(3) NOT NULL,
  `tahun` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pbb`
--

INSERT INTO `tb_pbb` (`id_pbb`, `id_pengguna`, `id_peserta`, `nilai_sk`, `nilai_gb`, `nilai_gd`, `nilai_ab`, `tahun`) VALUES
('b001Fgw5r', 'A0032wpbq0', 'P0053jRgzz', '78', '77', '78', '77', 2023),
('b002SP58O', 'A0032wpbq0', 'P002c86ZkE', '77', '75', '80', '77', 2023),
('b003Ot0jj', 'A0032wpbq0', 'P0044kTXLz', '77', '75', '80', '79', 2023),
('b004XXAnS', 'A0032wpbq0', 'P003FBBKNz', '77', '72', '73', '76', 2023),
('b005LwOcD', 'A0032wpbq0', 'P001mQGYDT', '79', '79', '76', '75', 2023),
('b0061894Q', 'A004oJreti', 'P0053jRgzz', '74', '75', '72', '73', 2023),
('b0070e7Td', 'A004oJreti', 'P002c86ZkE', '76', '77', '77', '77', 2023),
('b0085A1Zx', 'A004oJreti', 'P0044kTXLz', '80', '80', '79', '80', 2023),
('b009xOPPh', 'A004oJreti', 'P003FBBKNz', '76', '77', '77', '76', 2023),
('b010R728W', 'A004oJreti', 'P001mQGYDT', '75', '77', '75', '79', 2023),
('b0119G1bf', 'A005Wxb6fq', 'P0053jRgzz', '74', '78', '76', '77', 2023),
('b012UGYmN', 'A005Wxb6fq', 'P002c86ZkE', '75', '77', '77', '77', 2023),
('b013pEJsI', 'A005Wxb6fq', 'P0044kTXLz', '75', '76', '73', '75', 2023),
('b014JdTm3', 'A005Wxb6fq', 'P003FBBKNz', '75', '73', '74', '75', 2023),
('b015Y9r8R', 'A005Wxb6fq', 'P001mQGYDT', '78', '75', '76', '74', 2023);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengaturan`
--

CREATE TABLE `tb_pengaturan` (
  `id_pengaturan` varchar(7) NOT NULL,
  `nama_judul` varchar(50) NOT NULL,
  `meta_keywords` text NOT NULL,
  `meta_description` text NOT NULL,
  `jdwl_praktek` varchar(15) NOT NULL,
  `jam_praktek` time NOT NULL,
  `jdwl_pendaftaran` varchar(50) NOT NULL,
  `akses_pendaftaran` enum('Buka','Tutup') NOT NULL,
  `logo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pengaturan`
--

INSERT INTO `tb_pengaturan` (`id_pengaturan`, `nama_judul`, `meta_keywords`, `meta_description`, `jdwl_praktek`, `jam_praktek`, `jdwl_pendaftaran`, `akses_pendaftaran`, `logo`) VALUES
('P1xhDwL', 'PASKIBRAKA  PONOROGO', 'PASKIBRAKA  PONOROGO', 'PASKIBRAKA  PONOROGO', 'Senin ~ Jum\'at', '05:00:00', 'Setiap hari Minggu', 'Buka', 'header_6491dfa58a3f0.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengguna`
--

CREATE TABLE `tb_pengguna` (
  `id_pengguna` varchar(15) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `id_level` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`id_pengguna`, `nama`, `keterangan`, `email`, `password`, `id_level`) VALUES
('A001bnHDs', 'Erik Wahyudi', 'Superadmin', 'erik@gmail.com', '202cb962ac59075b964b07152d234b70', '1'),
('A002rlZgr3', 'Dewi', 'Admin 1', 'dewi@gmail.com', '202cb962ac59075b964b07152d234b70', '2'),
('A0032wpbq0', 'Fannisa', 'Dewan Juri', 'fannisa@gmail.com', '202cb962ac59075b964b07152d234b70', '3'),
('A004oJreti', 'Rani', 'juri 2', 'rani@gmail.com', '202cb962ac59075b964b07152d234b70', '3'),
('A005Wxb6fq', 'Rika', 'juri 3', 'rika@gmail.com', '202cb962ac59075b964b07152d234b70', '3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_peserta`
--

CREATE TABLE `tb_peserta` (
  `id_peserta` varchar(15) NOT NULL,
  `nama_peserta` varchar(100) NOT NULL,
  `asal_sekolah` varchar(18) NOT NULL,
  `tinggi_bb` varchar(3) NOT NULL,
  `berat_bb` varchar(3) NOT NULL,
  `level` varchar(15) NOT NULL DEFAULT 'peserta'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_peserta`
--

INSERT INTO `tb_peserta` (`id_peserta`, `nama_peserta`, `asal_sekolah`, `tinggi_bb`, `berat_bb`, `level`) VALUES
('P001mQGYDT', 'Zulfa Pradiva', 'SMA N 1 Ponorogo', '172', '65', 'peserta'),
('P002c86ZkE', 'Brilian Jagad', 'SMAN N 3 Ponorogo', '172', '66', 'peserta'),
('P003FBBKNz', 'Naufal Labiibi', 'SMA N 2 Ponorogo', '175', '73', 'peserta'),
('P0044kTXLz', 'Erdi Anggara', 'SMA BAKTI', '175', '77', 'peserta'),
('P0053jRgzz', 'Asarika Nian Mahardi', 'SMA N 1 Babadan', '170', '64', 'peserta');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_jasmani`
--
ALTER TABLE `tb_jasmani`
  ADD PRIMARY KEY (`id_jasmani`),
  ADD KEY `id_pengguna` (`id_pengguna`),
  ADD KEY `id_peserta` (`id_peserta`);

--
-- Indeks untuk tabel `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `tb_level`
--
ALTER TABLE `tb_level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indeks untuk tabel `tb_matriks`
--
ALTER TABLE `tb_matriks`
  ADD PRIMARY KEY (`id_matriks`),
  ADD KEY `id_peserta` (`id_peserta`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indeks untuk tabel `tb_nilai_hasil`
--
ALTER TABLE `tb_nilai_hasil`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `id_peserta` (`id_peserta`);

--
-- Indeks untuk tabel `tb_parade`
--
ALTER TABLE `tb_parade`
  ADD PRIMARY KEY (`id_parade`),
  ADD KEY `id_pengguna` (`id_pengguna`),
  ADD KEY `id_peserta` (`id_peserta`);

--
-- Indeks untuk tabel `tb_pbb`
--
ALTER TABLE `tb_pbb`
  ADD PRIMARY KEY (`id_pbb`),
  ADD KEY `id_pengguna` (`id_pengguna`),
  ADD KEY `id_peserta` (`id_peserta`);

--
-- Indeks untuk tabel `tb_pengaturan`
--
ALTER TABLE `tb_pengaturan`
  ADD PRIMARY KEY (`id_pengaturan`);

--
-- Indeks untuk tabel `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD KEY `id_level` (`id_level`);

--
-- Indeks untuk tabel `tb_peserta`
--
ALTER TABLE `tb_peserta`
  ADD PRIMARY KEY (`id_peserta`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_jasmani`
--
ALTER TABLE `tb_jasmani`
  ADD CONSTRAINT `tb_jasmani_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `tb_pengguna` (`id_pengguna`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_jasmani_ibfk_2` FOREIGN KEY (`id_peserta`) REFERENCES `tb_peserta` (`id_peserta`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_matriks`
--
ALTER TABLE `tb_matriks`
  ADD CONSTRAINT `tb_matriks_ibfk_1` FOREIGN KEY (`id_peserta`) REFERENCES `tb_peserta` (`id_peserta`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_matriks_ibfk_2` FOREIGN KEY (`id_kriteria`) REFERENCES `tb_kriteria` (`id_kriteria`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_nilai_hasil`
--
ALTER TABLE `tb_nilai_hasil`
  ADD CONSTRAINT `tb_nilai_hasil_ibfk_1` FOREIGN KEY (`id_peserta`) REFERENCES `tb_peserta` (`id_peserta`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_parade`
--
ALTER TABLE `tb_parade`
  ADD CONSTRAINT `tb_parade_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `tb_pengguna` (`id_pengguna`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_parade_ibfk_2` FOREIGN KEY (`id_peserta`) REFERENCES `tb_peserta` (`id_peserta`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_pbb`
--
ALTER TABLE `tb_pbb`
  ADD CONSTRAINT `tb_pbb_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `tb_pengguna` (`id_pengguna`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_pbb_ibfk_2` FOREIGN KEY (`id_peserta`) REFERENCES `tb_peserta` (`id_peserta`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  ADD CONSTRAINT `tb_pengguna_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `tb_level` (`id_level`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
