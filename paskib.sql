-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Jun 2023 pada 05.39
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
('j001vwnu5', 'A0032wpbq0', 'P0053jRgzz', '74', '79', '80'),
('j002sGIkd', 'A0032wpbq0', 'P002c86ZkE', '70', '80', '79'),
('j003T5mD3', 'A0032wpbq0', 'P0044kTXLz', '72', '65', '68'),
('j004wW540', 'A0032wpbq0', 'P003FBBKNz', '72', '74', '75'),
('j005oB7O1', 'A0032wpbq0', 'P001mQGYDT', '78', '73', '77');

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
  `nilai_kriteria` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_matriks`
--

INSERT INTO `tb_matriks` (`id_matriks`, `id_peserta`, `id_kriteria`, `hasil`, `nilai_kriteria`) VALUES
('T001Rs1Tb', 'P0053jRgzz', 'K003BNDjht', '78', '3'),
('T002kKvut', 'P002c86ZkE', 'K003BNDjht', '76', '2'),
('T003O4v1X', 'P0044kTXLz', 'K003BNDjht', '68', '1'),
('T004LmKbk', 'P003FBBKNz', 'K003BNDjht', '74', '2'),
('T0053Zwkn', 'P001mQGYDT', 'K003BNDjht', '76', '2'),
('T006xOJeB', 'P0053jRgzz', 'K004RHwS3n', '76', '2'),
('T007JuiVX', 'P002c86ZkE', 'K004RHwS3n', '77', '3'),
('T008UYbOY', 'P0044kTXLz', 'K004RHwS3n', '77', '3'),
('T009Hjk3T', 'P003FBBKNz', 'K004RHwS3n', '75', '2'),
('T010awREO', 'P001mQGYDT', 'K004RHwS3n', '77', '3'),
('T0114kuo0', 'P0053jRgzz', 'K005ndLkXQ', '74', '2'),
('T0126WBhJ', 'P002c86ZkE', 'K005ndLkXQ', '76', '2'),
('T01393h1U', 'P0044kTXLz', 'K005ndLkXQ', '77', '3'),
('T014iaGn6', 'P003FBBKNz', 'K005ndLkXQ', '77', '3'),
('T015MhmTT', 'P001mQGYDT', 'K005ndLkXQ', '78', '3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_nilai_hasil`
--

CREATE TABLE `tb_nilai_hasil` (
  `id_nilai` varchar(15) NOT NULL,
  `id_peserta` varchar(15) NOT NULL,
  `hasil` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
('p001MFLsZ', 'A0032wpbq0', 'P0053jRgzz', '75', '74', '72', '73', '76'),
('p002qhwr4', 'A0032wpbq0', 'P002c86ZkE', '77', '77', '76', '77', '77'),
('p003Pwfxg', 'A0032wpbq0', 'P0044kTXLz', '77', '78', '77', '77', '77'),
('p004ly9Gi', 'A0032wpbq0', 'P003FBBKNz', '76', '76', '76', '76', '77'),
('p005FhMfS', 'A0032wpbq0', 'P001mQGYDT', '77', '77', '76', '76', '78'),
('p0067zOyI', 'A004oJreti', 'P0053jRgzz', '73', '74', '74', '73', '73'),
('p007j3m9V', 'A004oJreti', 'P002c86ZkE', '75', '73', '72', '72', '72'),
('p0082qs9K', 'A004oJreti', 'P0044kTXLz', '78', '77', '78', '79', '79'),
('p009kExPb', 'A004oJreti', 'P003FBBKNz', '75', '75', '72', '75', '74'),
('p010OrEz8', 'A004oJreti', 'P001mQGYDT', '75', '77', '76', '75', '76'),
('p011kuVCp', 'A005Wxb6fq', 'P0053jRgzz', '76', '75', '75', '75', '77'),
('p01205usT', 'A005Wxb6fq', 'P002c86ZkE', '77', '77', '76', '75', '75'),
('p013nR9je', 'A005Wxb6fq', 'P0044kTXLz', '76', '76', '77', '77', '77'),
('p014OJG6q', 'A005Wxb6fq', 'P003FBBKNz', '80', '80', '80', '78', '78'),
('p015du6Oo', 'A005Wxb6fq', 'P001mQGYDT', '80', '80', '80', '78', '78');

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
('b001Fgw5r', 'A0032wpbq0', 'P0053jRgzz', '78', '77', '78', '77'),
('b002SP58O', 'A0032wpbq0', 'P002c86ZkE', '77', '75', '80', '77'),
('b003Ot0jj', 'A0032wpbq0', 'P0044kTXLz', '77', '75', '80', '79'),
('b004XXAnS', 'A0032wpbq0', 'P003FBBKNz', '77', '72', '73', '76'),
('b005LwOcD', 'A0032wpbq0', 'P001mQGYDT', '79', '79', '76', '75'),
('b0061894Q', 'A004oJreti', 'P0053jRgzz', '74', '75', '72', '73'),
('b0070e7Td', 'A004oJreti', 'P002c86ZkE', '76', '77', '77', '77'),
('b0085A1Zx', 'A004oJreti', 'P0044kTXLz', '80', '80', '79', '80'),
('b009xOPPh', 'A004oJreti', 'P003FBBKNz', '76', '77', '77', '76'),
('b010R728W', 'A004oJreti', 'P001mQGYDT', '75', '77', '75', '79'),
('b0119G1bf', 'A005Wxb6fq', 'P0053jRgzz', '74', '78', '76', '77'),
('b012UGYmN', 'A005Wxb6fq', 'P002c86ZkE', '75', '77', '77', '77'),
('b013pEJsI', 'A005Wxb6fq', 'P0044kTXLz', '75', '76', '73', '75'),
('b014JdTm3', 'A005Wxb6fq', 'P003FBBKNz', '75', '73', '74', '75'),
('b015Y9r8R', 'A005Wxb6fq', 'P001mQGYDT', '78', '75', '76', '74');

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
('A001bnHDs', 'Dewi Taliya', 'Superadmin', 'dewi@gmail.com', '202cb962ac59075b964b07152d234b70', '1'),
('A002rlZgr3', 'Santi', 'Admin 1', 'santi@gmail.com', '202cb962ac59075b964b07152d234b70', '2'),
('A0032wpbq0', 'Toni', 'Dewan Juri', 'toni@gmail.com', '202cb962ac59075b964b07152d234b70', '3'),
('A004oJreti', 'Cipto', 'juri 2', 'cipto@gmail.com', '202cb962ac59075b964b07152d234b70', '3'),
('A005Wxb6fq', 'Wahyu', 'juri 3', 'wahyu@gmail.com', '202cb962ac59075b964b07152d234b70', '3');

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
