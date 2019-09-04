-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2018 at 05:21 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `osisku`
--

-- --------------------------------------------------------

--
-- Table structure for table `calon`
--

CREATE TABLE `calon` (
  `id_calon` int(3) NOT NULL,
  `nis` varchar(15) NOT NULL,
  `nomor` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `calon`
--

INSERT INTO `calon` (`id_calon`, `nis`, `nomor`) VALUES
(1, '456456', 1),
(2, '5675878', 3),
(3, '5675876', 0),
(4, '5675877', 2),
(5, '93', 0),
(9, '99', 0);

-- --------------------------------------------------------

--
-- Table structure for table `kandidat`
--

CREATE TABLE `kandidat` (
  `id_kandidat` int(2) NOT NULL,
  `id_vismis` int(3) NOT NULL,
  `no_calon` int(1) NOT NULL,
  `tipe` int(1) NOT NULL,
  `jumlah` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kandidat`
--

INSERT INTO `kandidat` (`id_kandidat`, `id_vismis`, `no_calon`, `tipe`, `jumlah`) VALUES
(1, 1, 1, 0, 0),
(2, 2, 2, 0, 0),
(3, 3, 3, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(3) NOT NULL,
  `kelas` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `kelas`) VALUES
(1, 'VII A'),
(3, 'VII C');

-- --------------------------------------------------------

--
-- Table structure for table `misi`
--

CREATE TABLE `misi` (
  `id` int(3) NOT NULL,
  `id_misi` int(3) NOT NULL,
  `misi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `misi`
--

INSERT INTO `misi` (`id`, `id_misi`, `misi`) VALUES
(132, 5, 'ghjghjh'),
(133, 5, 'ghjgh'),
(134, 5, 'ghj'),
(135, 5, 'ghj'),
(136, 5, 'ghj'),
(142, 2, 'ghjghjh'),
(143, 2, 'ghjgh'),
(144, 2, 'ghj'),
(145, 2, 'ghj'),
(146, 2, 'ghj'),
(150, 3, 'memajukan sekolah'),
(151, 3, 'memajukan sekolah'),
(152, 3, 'memajukan sekolah'),
(153, 3, 'oke ya'),
(154, 1, 'OK'),
(155, 1, 'ini'),
(156, 1, 'nimi'),
(157, 1, 'nim'),
(158, 1, 'nimi');

-- --------------------------------------------------------

--
-- Table structure for table `pemilihan`
--

CREATE TABLE `pemilihan` (
  `id_pemilihan` int(3) NOT NULL,
  `tgl_mulai` datetime NOT NULL,
  `tgl_akhir` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemilihan`
--

INSERT INTO `pemilihan` (`id_pemilihan`, `tgl_mulai`, `tgl_akhir`) VALUES
(20, '2018-09-21 00:00:00', '2018-09-21 23:59:59');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nis` varchar(15) NOT NULL,
  `id_kelas` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nis`, `id_kelas`) VALUES
('5675876', 1),
('5675877', 1),
('5675878', 1),
('5675879', 1),
('5675880', 1),
('5675883', 1),
('5675884', 1),
('5675885', 1),
('456456', 3),
('91', 3),
('92', 3),
('93', 3),
('94', 3),
('95', 3),
('96', 3),
('97', 3),
('98', 3),
('99', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `foto` varchar(50) NOT NULL,
  `level` varchar(1) NOT NULL,
  `posisi` varchar(1) NOT NULL,
  `status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `nama`, `tempat_lahir`, `tgl_lahir`, `foto`, `level`, `posisi`, `status`) VALUES
('456456', '098f6bcd4621d373cade4e832627b4f6', 'Bangkenu', 'Sukabumi', '1995-07-17', 'public/img/profile/456456.jpg', 'a', 's', 'b'),
('5675876', '098f6bcd4621d373cade4e832627b4f6', 'Fahmi Sebastian', 'Sukabumi', '1996-05-16', '', 'u', 's', 'b'),
('5675877', '098f6bcd4621d373cade4e832627b4f6', 'Indihome ', 'Sukabumi', '1996-05-17', 'public/img/profile/5675877.jpg', 'u', 's', 'b'),
('5675878', '098f6bcd4621d373cade4e832627b4f6', 'Fahmi Pamungkas', 'Sukabumi', '1996-05-18', 'public/img/profile/5675878.jpg', 'u', 's', 'b'),
('5675879', '098f6bcd4621d373cade4e832627b4f6', 'Fahmi Pamungkas', 'Sukabumi', '1996-05-19', '', 'u', 's', 'b'),
('5675880', '098f6bcd4621d373cade4e832627b4f6', 'Fahmi Pamungkas', 'Sukabumi', '1996-05-20', '', 'u', 's', 'b'),
('5675883', '098f6bcd4621d373cade4e832627b4f6', 'Fahmi Pamungkas', 'Sukabumi', '1996-05-23', '', 'u', 's', 'b'),
('5675884', '098f6bcd4621d373cade4e832627b4f6', 'Fahmi Pamungkas', 'Sukabumi', '1996-05-24', '', 'u', 's', 'b'),
('5675885', '098f6bcd4621d373cade4e832627b4f6', 'Fahmi Pamungkas', 'Sukabumi', '1996-05-25', '', 'u', 's', 'b'),
('886764', '098f6bcd4621d373cade4e832627b4f6', 'dfg', 'Sukabumi', '1996-05-16', '', 'u', 'g', 'b'),
('886772', '098f6bcd4621d373cade4e832627b4f6', 'erwe', 'Sukabumi', '1996-05-24', '', 'u', 'g', 'b'),
('91', '098f6bcd4621d373cade4e832627b4f6', 'Dede', 'Sukabumi', '1996-05-17', '', 'u', 's', 'b'),
('92', '098f6bcd4621d373cade4e832627b4f6', 'Dede', 'Sukabumi', '1996-05-18', '', 'u', 's', 'b'),
('93', '098f6bcd4621d373cade4e832627b4f6', 'Dede', 'Sukabumi', '1996-05-19', '', 'u', 's', 'b'),
('94', '098f6bcd4621d373cade4e832627b4f6', 'Dede', 'Sukabumi', '1996-05-20', '', 'u', 's', 'b'),
('95', '098f6bcd4621d373cade4e832627b4f6', 'Dede', 'Sukabumi', '1996-05-21', '', 'u', 's', 'b'),
('96', '098f6bcd4621d373cade4e832627b4f6', 'Dede', 'Sukabumi', '1996-05-22', '', 'u', 's', 'b'),
('97', '098f6bcd4621d373cade4e832627b4f6', 'Dede', 'Sukabumi', '1996-05-23', '', 'u', 's', 'b'),
('98', '098f6bcd4621d373cade4e832627b4f6', 'Dede', 'Sukabumi', '1996-05-24', '', 'u', 's', 'b'),
('99', '098f6bcd4621d373cade4e832627b4f6', 'Kandarium', 'Sukabumi', '1996-05-25', '', 'u', 's', 'b');

-- --------------------------------------------------------

--
-- Table structure for table `visi_misi`
--

CREATE TABLE `visi_misi` (
  `id_vismis` int(3) NOT NULL,
  `visi` varchar(100) NOT NULL,
  `id_misi` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visi_misi`
--

INSERT INTO `visi_misi` (`id_vismis`, `visi`, `id_misi`) VALUES
(1, 'Mewujudkan siswa - siswa yang berprestasi OK', 1),
(2, 'Memajukan Sekolah kedepan jalan', 2),
(3, 'Meningkatkan Kualitas Sekolah', 3),
(5, 'ghjgh', 5);

-- --------------------------------------------------------

--
-- Table structure for table `voting`
--

CREATE TABLE `voting` (
  `id_voting` int(5) NOT NULL,
  `no_kandidat` int(2) NOT NULL,
  `username` varchar(15) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calon`
--
ALTER TABLE `calon`
  ADD PRIMARY KEY (`id_calon`),
  ADD UNIQUE KEY `nis` (`nis`),
  ADD KEY `id_user` (`nis`),
  ADD KEY `id_calon` (`id_calon`),
  ADD KEY `nomor` (`nomor`);

--
-- Indexes for table `kandidat`
--
ALTER TABLE `kandidat`
  ADD PRIMARY KEY (`id_kandidat`),
  ADD KEY `id_vismis` (`id_vismis`,`no_calon`),
  ADD KEY `no_calon` (`no_calon`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `misi`
--
ALTER TABLE `misi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_misi` (`id_misi`);

--
-- Indexes for table `pemilihan`
--
ALTER TABLE `pemilihan`
  ADD PRIMARY KEY (`id_pemilihan`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `visi_misi`
--
ALTER TABLE `visi_misi`
  ADD PRIMARY KEY (`id_vismis`),
  ADD KEY `id_misi` (`id_misi`);

--
-- Indexes for table `voting`
--
ALTER TABLE `voting`
  ADD PRIMARY KEY (`id_voting`),
  ADD KEY `no_kandidat` (`no_kandidat`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calon`
--
ALTER TABLE `calon`
  MODIFY `id_calon` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kandidat`
--
ALTER TABLE `kandidat`
  MODIFY `id_kandidat` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `misi`
--
ALTER TABLE `misi`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `pemilihan`
--
ALTER TABLE `pemilihan`
  MODIFY `id_pemilihan` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `voting`
--
ALTER TABLE `voting`
  MODIFY `id_voting` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `calon`
--
ALTER TABLE `calon`
  ADD CONSTRAINT `calon_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`);

--
-- Constraints for table `kandidat`
--
ALTER TABLE `kandidat`
  ADD CONSTRAINT `kandidat_ibfk_2` FOREIGN KEY (`id_vismis`) REFERENCES `visi_misi` (`id_vismis`),
  ADD CONSTRAINT `kandidat_ibfk_3` FOREIGN KEY (`no_calon`) REFERENCES `calon` (`nomor`);

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_3` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`),
  ADD CONSTRAINT `siswa_ibfk_4` FOREIGN KEY (`nis`) REFERENCES `user` (`username`);

--
-- Constraints for table `visi_misi`
--
ALTER TABLE `visi_misi`
  ADD CONSTRAINT `visi_misi_ibfk_1` FOREIGN KEY (`id_misi`) REFERENCES `misi` (`id_misi`);

--
-- Constraints for table `voting`
--
ALTER TABLE `voting`
  ADD CONSTRAINT `voting_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE,
  ADD CONSTRAINT `voting_ibfk_2` FOREIGN KEY (`no_kandidat`) REFERENCES `kandidat` (`id_kandidat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
