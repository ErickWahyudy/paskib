-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Jun 2023 pada 06.27
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
('pbb001jdeJS', 'A005Wxb6fq', 'P001mQGYDT', '67', '88', '77', '65'),
('pbb002duSSM', 'A004oJreti', 'P001mQGYDT', '98', '77', '87', '66'),
('pbb003UJSE', 'A0032wpbq0', 'P001mQGYDT', '86', '76', '99', '55'),
('pbb004fef', 'A005Wxb6fq', 'P002c86ZkE', '45', '33', '22', '13'),
('pbb005djSSE', 'A004oJreti', 'P002c86ZkE', '89', '76', '56', '77'),
('pbb006dbSDB', 'A0032wpbq0', 'P002c86ZkE', '89', '99', '77', '56');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_pbb`
--
ALTER TABLE `tb_pbb`
  ADD PRIMARY KEY (`id_pbb`),
  ADD KEY `id_pengguna` (`id_pengguna`),
  ADD KEY `id_peserta` (`id_peserta`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_pbb`
--
ALTER TABLE `tb_pbb`
  ADD CONSTRAINT `tb_pbb_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `tb_pengguna` (`id_pengguna`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_pbb_ibfk_2` FOREIGN KEY (`id_peserta`) REFERENCES `tb_peserta` (`id_peserta`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
