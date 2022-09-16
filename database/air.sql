-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 31, 2022 at 08:04 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `air`
--

-- --------------------------------------------------------

--
-- Table structure for table `aliran_air`
--

CREATE TABLE `aliran_air` (
  `id_aliran` int(11) NOT NULL,
  `nama_material` varchar(100) NOT NULL,
  `ukuran` varchar(20) DEFAULT NULL,
  `jumlah` decimal(10,2) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `satuan_id` int(11) NOT NULL,
  `pengisian_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabel jumlah aliran air ditiap kantor';

--
-- Dumping data for table `aliran_air`
--

INSERT INTO `aliran_air` (`id_aliran`, `nama_material`, `ukuran`, `jumlah`, `kategori_id`, `satuan_id`, `pengisian_id`) VALUES
(6, 'Lob. Pot Trotoar', '110 x 90 mm', '2.00', 3, 2, 4),
(7, 'Test', '10 mm', '1.00', 2, 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `anggaran`
--

CREATE TABLE `anggaran` (
  `id` int(11) NOT NULL,
  `nama_bahan` varchar(100) NOT NULL,
  `ukuran` varchar(20) DEFAULT NULL,
  `jumlah` decimal(10,2) NOT NULL,
  `satuan_id` int(11) NOT NULL COMMENT 'Akan Mengisi Bidang Satuan',
  `harga_satuan` decimal(10,2) NOT NULL,
  `analisa` varchar(30) NOT NULL COMMENT 'Contohnya: TABEL',
  `jumlah_harga` decimal(12,2) NOT NULL,
  `kategori_id` int(11) NOT NULL COMMENT 'Akan dimasukkan ke dalam kategori anggaran',
  `kantor_id` int(11) NOT NULL,
  `date_created` date NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `status_konfirmasi` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabel Master';

--
-- Dumping data for table `anggaran`
--

INSERT INTO `anggaran` (`id`, `nama_bahan`, `ukuran`, `jumlah`, `satuan_id`, `harga_satuan`, `analisa`, `jumlah_harga`, `kategori_id`, `kantor_id`, `date_created`, `user_id`, `status_konfirmasi`) VALUES
(1, 'Pipa PVC', '110 x 90 mm', '2.00', 2, '1078249.56', 'TABEL', '5576617.80', 2, 2, '2022-07-27', NULL, 0),
(2, 'Lob. Pot Trotoar', '110 mm', '1.00', 2, '668292.50', 'TABEL', '668292.50', 3, 2, '2022-07-27', NULL, 0),
(3, 'Collase', '-', '1.00', 2, '1000000.00', 'TABEL', '120000000.00', 2, 2, '2022-07-31', 12, 0);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(4, 'petugas', 'Petugas PLA'),
(5, 'pengguna', 'Pengguna Aplikasi/ Masyarakat');

-- --------------------------------------------------------

--
-- Table structure for table `kantor_aliran`
--

CREATE TABLE `kantor_aliran` (
  `id_kantor_aliran` int(11) NOT NULL,
  `nama_pemilik` varchar(100) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `no_register` varchar(70) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Kantor yang menerima aliran air';

--
-- Dumping data for table `kantor_aliran`
--

INSERT INTO `kantor_aliran` (`id_kantor_aliran`, `nama_pemilik`, `alamat`, `no_register`, `users_id`) VALUES
(3, 'Sulismin Thalib', 'Jl. Asrama No.6 (Komp. Krakatau Estate)', NULL, 9);

-- --------------------------------------------------------

--
-- Table structure for table `kantor_anggaran`
--

CREATE TABLE `kantor_anggaran` (
  `id_kantor` int(11) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `cabang` varchar(50) NOT NULL,
  `users_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Kantor Cabang PLN untuk anggaran';

--
-- Dumping data for table `kantor_anggaran`
--

INSERT INTO `kantor_anggaran` (`id_kantor`, `lokasi`, `cabang`, `users_id`) VALUES
(1, 'Jl.Asrama', 'Cemara', NULL),
(2, 'Jl. Asrama Komp. Krakatau Estate', 'Cemara', 12);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kat` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL COMMENT 'Contohnya : Bahan, Biaya Pelaksanaan, Biaya Perbaikan',
  `keterangan` varchar(300) DEFAULT NULL COMMENT 'Keterangan Kategori'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Pengelompokan Anggaran Biaya atau Aliran Air';

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kat`, `nama_kategori`, `keterangan`) VALUES
(2, 'Bahan', NULL),
(3, 'Biaya Pelaksanaan', NULL),
(4, 'Material', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `pengisian`
--

CREATE TABLE `pengisian` (
  `id_isian` int(11) NOT NULL,
  `kantor_id_aliran` int(11) DEFAULT NULL,
  `tgl_pengisian` date DEFAULT NULL,
  `keterangan` text,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `status_konfirmasi` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Pengisian Formulir pada tabel aliran air';

--
-- Dumping data for table `pengisian`
--

INSERT INTO `pengisian` (`id_isian`, `kantor_id_aliran`, `tgl_pengisian`, `keterangan`, `user_id`, `status_konfirmasi`) VALUES
(4, 3, '2022-07-30', '<p>asd<br></p>', 9, 1),
(5, 3, '2022-07-31', '<p>asd</p>', 9, 0);

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `id_satuan` int(11) NOT NULL,
  `nama_satuan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Membuat Pilihan Satuan pada anggaran';

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`id_satuan`, `nama_satuan`) VALUES
(2, 'BH'),
(3, 'M'),
(4, 'TPT');

-- --------------------------------------------------------

--
-- Table structure for table `sett_anggaran`
--

CREATE TABLE `sett_anggaran` (
  `id_sett` int(11) NOT NULL,
  `nama_penyetuju` varchar(100) NOT NULL COMMENT 'Nama bawah dokumen, tepat di bawah tanda tangan',
  `ttd_penyetuju` varchar(255) DEFAULT NULL COMMENT 'Tanda Tangan bawah dokumen',
  `jabatan_penyetuju` varchar(100) NOT NULL COMMENT 'Jabatan bawah nama penyetuju',
  `nama_pemeriksa` varchar(100) NOT NULL,
  `ttd_pemeriksa` varchar(255) DEFAULT NULL,
  `jabatan_pemeriksa` varchar(50) NOT NULL,
  `nama_pembuat` varchar(100) NOT NULL,
  `ttd_pembuat` varchar(255) DEFAULT NULL,
  `jabatan_pembuat` varchar(50) NOT NULL,
  `nama_pengesah` varchar(100) NOT NULL,
  `ttd_pengesah` varchar(255) DEFAULT NULL,
  `jabatan_pengesah` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Pengaturan Surat Anggaran maupun aliran air';

--
-- Dumping data for table `sett_anggaran`
--

INSERT INTO `sett_anggaran` (`id_sett`, `nama_penyetuju`, `ttd_penyetuju`, `jabatan_penyetuju`, `nama_pemeriksa`, `ttd_pemeriksa`, `jabatan_pemeriksa`, `nama_pembuat`, `ttd_pembuat`, `jabatan_pembuat`, `nama_pengesah`, `ttd_pengesah`, `jabatan_pengesah`) VALUES
(1, 'Robert Sahat Manik', 'ttd.jpg', 'Kacab. Cemara', 'Zainal Abidin Dalimunthe', NULL, 'Plt. Kabag. Jaringan', 'Syarifudin Sinaga', NULL, 'Kabag. Pemasaran', 'Nurleli,ST', NULL, 'Kadiv Perencana');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `full_name` varchar(50) NOT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `picture` varchar(255) NOT NULL,
  `is_cabang` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `full_name`, `active`, `picture`, `is_cabang`) VALUES
(1, '127.0.0.1', 'administrator', '$argon2id$v=19$m=65536,t=4,p=1$RHlPV1pqR2FKd1Z4WFNabA$Qnv5A6w8rT0khqspbH8YlCOXETKDnMkR4NgnqxcxP4s', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1659231818, 'Administrator', 1, 'default.png', NULL),
(2, '127.0.0.1', NULL, '$argon2id$v=19$m=65536,t=4,p=1$d3dKTGF2eVc5YUZ6Qjdkcw$I6S1fPTdaM4uemw31QVLqZa6yb1aZu5FPqr7uU+oUno', 'adi@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1640075359, 1640092657, 'Adi Saputra', 1, 'ProfilGoogle.jpg', NULL),
(3, '127.0.0.1', NULL, '$argon2id$v=19$m=65536,t=4,p=1$M2NlU1NyamNHWWwzWHdoWQ$El4W08OcKZ00OvnJ6VdzzsHAq7aarsJIHk2U5qLXKSo', 'fulan@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1657520358, 1659231910, 'Fulan', 1, 'default.png', NULL),
(9, '127.0.0.1', NULL, '$argon2id$v=19$m=65536,t=4,p=1$Lzg2ZEVBUk0yMnZSZnBJaQ$Bl1DTbR94puM4lcQ+UD3IbUoPySWOty18h1T6o5hxlo', 'fikimantap@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658548276, 1659231876, 'Syafikihidayah', 1, 'default.png', 0),
(12, '127.0.0.1', NULL, '$argon2id$v=19$m=65536,t=4,p=1$ejFXdUdNUFREeUtkMEhrRQ$cdJZFNZ/HTNjix1nKlhZ5jrKHrTUMgjJXYGatSeJ5UE', 'fachry@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658548941, 1659249483, 'Muhammad Fachry', 1, 'default.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(9, 2, 4),
(5, 3, 4),
(15, 9, 5),
(18, 12, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aliran_air`
--
ALTER TABLE `aliran_air`
  ADD PRIMARY KEY (`id_aliran`),
  ADD KEY `kategori_id` (`kategori_id`),
  ADD KEY `satuan_id` (`satuan_id`),
  ADD KEY `pengisian_id` (`pengisian_id`);

--
-- Indexes for table `anggaran`
--
ALTER TABLE `anggaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `satuan_id` (`satuan_id`),
  ADD KEY `kategori_id` (`kategori_id`),
  ADD KEY `kantor_id` (`kantor_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `kantor_aliran`
--
ALTER TABLE `kantor_aliran`
  ADD PRIMARY KEY (`id_kantor_aliran`);

--
-- Indexes for table `kantor_anggaran`
--
ALTER TABLE `kantor_anggaran`
  ADD PRIMARY KEY (`id_kantor`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kat`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `pengisian`
--
ALTER TABLE `pengisian`
  ADD PRIMARY KEY (`id_isian`),
  ADD KEY `kantor_id_aliran` (`kantor_id_aliran`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `sett_anggaran`
--
ALTER TABLE `sett_anggaran`
  ADD PRIMARY KEY (`id_sett`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `uc_email` (`email`) USING BTREE,
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`) USING BTREE,
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`) USING BTREE,
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`) USING BTREE;

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`) USING BTREE,
  ADD KEY `fk_users_groups_users1_idx` (`user_id`) USING BTREE,
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aliran_air`
--
ALTER TABLE `aliran_air`
  MODIFY `id_aliran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `anggaran`
--
ALTER TABLE `anggaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kantor_aliran`
--
ALTER TABLE `kantor_aliran`
  MODIFY `id_kantor_aliran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kantor_anggaran`
--
ALTER TABLE `kantor_anggaran`
  MODIFY `id_kantor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengisian`
--
ALTER TABLE `pengisian`
  MODIFY `id_isian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sett_anggaran`
--
ALTER TABLE `sett_anggaran`
  MODIFY `id_sett` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aliran_air`
--
ALTER TABLE `aliran_air`
  ADD CONSTRAINT `aliran_air_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id_kat`) ON DELETE CASCADE,
  ADD CONSTRAINT `aliran_air_ibfk_2` FOREIGN KEY (`satuan_id`) REFERENCES `satuan` (`id_satuan`) ON DELETE CASCADE,
  ADD CONSTRAINT `aliran_air_ibfk_3` FOREIGN KEY (`pengisian_id`) REFERENCES `pengisian` (`id_isian`) ON DELETE CASCADE;

--
-- Constraints for table `anggaran`
--
ALTER TABLE `anggaran`
  ADD CONSTRAINT `anggaran_ibfk_1` FOREIGN KEY (`satuan_id`) REFERENCES `satuan` (`id_satuan`) ON DELETE CASCADE,
  ADD CONSTRAINT `anggaran_ibfk_2` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id_kat`) ON DELETE CASCADE,
  ADD CONSTRAINT `anggaran_ibfk_3` FOREIGN KEY (`kantor_id`) REFERENCES `kantor_anggaran` (`id_kantor`) ON DELETE CASCADE,
  ADD CONSTRAINT `anggaran_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengisian`
--
ALTER TABLE `pengisian`
  ADD CONSTRAINT `pengisian_ibfk_1` FOREIGN KEY (`kantor_id_aliran`) REFERENCES `kantor_aliran` (`id_kantor_aliran`) ON DELETE CASCADE,
  ADD CONSTRAINT `pengisian_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
