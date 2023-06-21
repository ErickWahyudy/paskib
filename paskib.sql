-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Jun 2023 pada 16.21
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
  `nilai_sitUp` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_jasmani`
--

INSERT INTO `tb_jasmani` (`id_jasmani`, `id_pengguna`, `id_peserta`, `nilai_lari`, `nilai_pushUp`, `nilai_sitUp`) VALUES
('j001b7kQy', 'A0032wpbq0', 'P001mQGYDT', '65', '77', '78'),
('j002rCGqG', 'A0032wpbq0', 'P0053jRgzz', '67', '76', '77'),
('j003ikour', 'A004oJreti', 'P003FBBKNz', '77', '78', '79'),
('j004PDAuh', 'A004oJreti', 'P0044kTXLz', '80', '78', '77'),
('j005y8U9u', 'A005Wxb6fq', 'P002c86ZkE', '76', '80', '77');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kriteria`
--

CREATE TABLE `tb_kriteria` (
  `id_kriteria` varchar(15) NOT NULL,
  `kriteria` varchar(15) NOT NULL,
  `bobot` varchar(3) NOT NULL,
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
('K001ZfwKoY', 'Tinggi Badan', '1', '', '', '', '', ''),
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
  `nilai_kriteria` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_matriks`
--

INSERT INTO `tb_matriks` (`id_matriks`, `id_peserta`, `id_kriteria`, `hasil`, `nilai_kriteria`) VALUES
('T001fNjoZ', 'P001mQGYDT', 'K003BNDjht', '73.33', '2'),
('T002QTcBl', 'P0053jRgzz', 'K003BNDjht', '73.33', '2'),
('T0039buf9', 'P003FBBKNz', 'K003BNDjht', '78.00', '3'),
('T004HA2rb', 'P0044kTXLz', 'K003BNDjht', '78.33', '3'),
('T0050NaKI', 'P002c86ZkE', 'K003BNDjht', '77.67', '3'),
('T006R4SWp', 'P001mQGYDT', 'K005ndLkXQ', '72.56', '1'),
('T007ahIrh', 'P0053jRgzz', 'K005ndLkXQ', '76.67', '2'),
('T008csU3E', 'P003FBBKNz', 'K005ndLkXQ', '72.78', '1'),
('T009t4jRG', 'P0044kTXLz', 'K005ndLkXQ', '75.11', '2'),
('T010yi3sg', 'P002c86ZkE', 'K005ndLkXQ', '73.11', '1'),
('T0119lFL7', 'P001mQGYDT', 'K004RHwS3n', '73.00', '1'),
('T0123v6x4', 'P0053jRgzz', 'K004RHwS3n', '74.56', '2'),
('T013AourN', 'P003FBBKNz', 'K004RHwS3n', '75.11', '2'),
('T014XhKEm', 'P0044kTXLz', 'K004RHwS3n', '73.67', '1'),
('T015pKyso', 'P002c86ZkE', 'K004RHwS3n', '75.44', '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_nilai_hasil`
--

CREATE TABLE `tb_nilai_hasil` (
  `id_nilai` varchar(15) NOT NULL,
  `id_peserta` varchar(15) NOT NULL,
  `hasil` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_nilai_hasil`
--

INSERT INTO `tb_nilai_hasil` (`id_nilai`, `id_peserta`, `hasil`) VALUES
('H001fPvJQ', 'P001mQGYDT', '0.57094'),
('H002Ka5NL', 'P0053jRgzz', '0.72658'),
('H0036qrbi', 'P003FBBKNz', '0.65803'),
('H004hjy7T', 'P0044kTXLz', '0.57310'),
('H005XaSNr', 'P002c86ZkE', '0.65803');

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
  `nilai_kk` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_parade`
--

INSERT INTO `tb_parade` (`id_parade`, `id_pengguna`, `id_peserta`, `nilai_wjh`, `nilai_bdn`, `nilai_bp`, `nilai_tgn`, `nilai_kk`) VALUES
('p001QogT9', 'A0032wpbq0', 'P001mQGYDT', '77', '76', '78', '76', '66'),
('p002EDTMQ', 'A0032wpbq0', 'P0053jRgzz', '77', '78', '80', '72', '74'),
('p003GjRnX', 'A0032wpbq0', 'P003FBBKNz', '71', '72', '73', '74', '75'),
('p004gJeKa', 'A0032wpbq0', 'P0044kTXLz', '77', '76', '75', '77', '71'),
('p005RcTNO', 'A0032wpbq0', 'P002c86ZkE', '77', '76', '78', '76', '67'),
('p006DC6FO', 'A004oJreti', 'P001mQGYDT', '67', '67', '65', '79', '71'),
('p0072KUwX', 'A004oJreti', 'P0053jRgzz', '76', '73', '72', '78', '78'),
('p008pHg2n', 'A004oJreti', 'P003FBBKNz', '76', '71', '72', '78', '76'),
('p009XweB0', 'A004oJreti', 'P0044kTXLz', '76', '71', '80', '71', '73'),
('p0109cTLV', 'A004oJreti', 'P002c86ZkE', '72', '72', '71', '79', '77'),
('p0113rWkA', 'A005Wxb6fq', 'P001mQGYDT', '77', '75', '71', '72', '74'),
('p012CSUo7', 'A005Wxb6fq', 'P0053jRgzz', '81', '76', '77', '65', '71'),
('p013EvIRB', 'A005Wxb6fq', 'P003FBBKNz', '76', '71', '73', '72', '74'),
('p014h1g5Z', 'A005Wxb6fq', 'P0044kTXLz', '77', '73', '71', '74', '78'),
('p015kKwTL', 'A005Wxb6fq', 'P002c86ZkE', '67', '77', '68', '69', '77');

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
  `nilai_ab` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pbb`
--

INSERT INTO `tb_pbb` (`id_pbb`, `id_pengguna`, `id_peserta`, `nilai_sk`, `nilai_gb`, `nilai_gd`, `nilai_ab`) VALUES
('b001WBg4m', 'A0032wpbq0', 'P001mQGYDT', '76', '74', '73', '77'),
('b002T5dvP', 'A0032wpbq0', 'P0053jRgzz', '77', '76', '78', '71'),
('b003zZrM8', 'A0032wpbq0', 'P003FBBKNz', '77', '76', '77', '78'),
('b004rzl0T', 'A0032wpbq0', 'P0044kTXLz', '76', '74', '75', '77'),
('b005YPxco', 'A0032wpbq0', 'P002c86ZkE', '77', '75', '78', '73'),
('b006VPnDw', 'A004oJreti', 'P001mQGYDT', '76', '77', '78', '78'),
('b007FkSEr', 'A004oJreti', 'P0053jRgzz', '67', '77', '66', '78'),
('b008IGlKh', 'A004oJreti', 'P003FBBKNz', '77', '76', '72', '80'),
('b0099T6Lh', 'A004oJreti', 'P0044kTXLz', '77', '76', '72', '74'),
('b010j5EB3', 'A004oJreti', 'P002c86ZkE', '71', '80', '77', '76'),
('b011e5omc', 'A005Wxb6fq', 'P001mQGYDT', '67', '68', '68', '71'),
('b0125n1ON', 'A005Wxb6fq', 'P0053jRgzz', '77', '76', '77', '78'),
('b013HRVU2', 'A005Wxb6fq', 'P003FBBKNz', '67', '77', '77', '71'),
('b014XTFxY', 'A005Wxb6fq', 'P0044kTXLz', '71', '71', '71', '71'),
('b015ebCgx', 'A005Wxb6fq', 'P002c86ZkE', '78', '76', '67', '77');

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
  `nama_peserta` varchar(20) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `asal_sekolah` varchar(18) NOT NULL,
  `tinggi_bb` varchar(3) NOT NULL,
  `berat_bb` varchar(3) NOT NULL,
  `level` varchar(15) NOT NULL DEFAULT 'peserta'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_peserta`
--

INSERT INTO `tb_peserta` (`id_peserta`, `nama_peserta`, `tgl_lahir`, `asal_sekolah`, `tinggi_bb`, `berat_bb`, `level`) VALUES
('P001mQGYDT', 'Anam', '2007-04-01', 'SMP N 5 Ponorogo', '172', '65', 'peserta'),
('P002c86ZkE', 'Udin', '2007-02-01', 'SMPN 2 Balong', '172', '66', 'peserta'),
('P003FBBKNz', 'Fikran', '2008-06-05', 'SMP N 2 Balong', '175', '73', 'peserta'),
('P0044kTXLz', 'Sultan', '2009-08-08', 'MTS Ma\'arif Balong', '175', '77', 'peserta'),
('P0053jRgzz', 'Asarika Nian Mahardi', '2008-07-08', 'SMA N 1 Babadan', '170', '64', 'peserta');

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
