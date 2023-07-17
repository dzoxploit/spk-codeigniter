-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2023 at 03:36 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kosin`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE `alternatif` (
  `id` int(11) NOT NULL,
  `idKost` int(11) NOT NULL,
  `idSubkriteriaHarga` int(11) NOT NULL,
  `idSubkriteriaJarak` int(11) NOT NULL,
  `idSubkriteriaLuas` int(11) NOT NULL,
  `idSubkriteriaKeamanan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id`, `idKost`, `idSubkriteriaHarga`, `idSubkriteriaJarak`, `idSubkriteriaLuas`, `idSubkriteriaKeamanan`) VALUES
(1, 3, 7, 8, 13, 17),
(2, 1, 3, 8, 11, 14),
(3, 2, 1, 9, 11, 14),
(4, 5, 4, 8, 12, 15),
(5, 6, 4, 8, 12, 15);

-- --------------------------------------------------------

--
-- Table structure for table `alternatif_nilai`
--

CREATE TABLE `alternatif_nilai` (
  `id` int(11) NOT NULL,
  `idAlternatif` int(11) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alternatif_nilai`
--

INSERT INTO `alternatif_nilai` (`id`, `idAlternatif`, `nilai`) VALUES
(12, 1, 0.284),
(13, 2, 0.4206),
(14, 3, 0.3486),
(15, 4, 0.4173),
(16, 5, 0.4173);

-- --------------------------------------------------------

--
-- Table structure for table `kost`
--

CREATE TABLE `kost` (
  `id` int(11) NOT NULL,
  `kost` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kost`
--

INSERT INTO `kost` (`id`, `kost`, `slug`) VALUES
(1, 'Kost Harjo Suwito Depok Sleman', 'kost-harjo-suwito-depok-sleman'),
(2, 'Kost Pugeran Utama Tipe A Kecamatan Depok Sleman', 'kost-pugeran-utama-tipe-a-kecamatan-depok-sleman'),
(3, 'Kost Singgahsini Alpukat Rania Tipe B Condong Catur Yogyakarta', 'kost-singgahsini-alpukat-rania-tipe-b-condong-catur-yogyakarta'),
(5, 'Kost Ibu Anti Tipe A Depok Sleman', 'kost-ibu-anti-tipe-a-depok-sleman'),
(6, 'Kost Permata Indah 1 Depok Sleman', 'kost-permata-indah-1-depok-sleman');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id` int(11) NOT NULL,
  `kriteria` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id`, `kriteria`, `slug`) VALUES
(1, 'Harga Sewa Kost Perbulan', 'harga-sewa-kost-perbulan'),
(2, 'Jarak dari Amikom', 'jarak-dari-amikom'),
(3, 'Luas Kamar', 'luas-kamar'),
(4, 'Keamanan', 'keamanan');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria_nilai`
--

CREATE TABLE `kriteria_nilai` (
  `id` int(11) NOT NULL,
  `idKriteriaAsal` int(11) NOT NULL,
  `idKriteriaTujuan` int(11) NOT NULL,
  `nilai` float NOT NULL,
  `nilaiPrioritas` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kriteria_nilai`
--

INSERT INTO `kriteria_nilai` (`id`, `idKriteriaAsal`, `idKriteriaTujuan`, `nilai`, `nilaiPrioritas`) VALUES
(109, 1, 2, 2, 0.47),
(110, 1, 3, 4, 0.47),
(111, 1, 4, 5, 0.47),
(112, 2, 1, 0.5, 0.27),
(113, 2, 3, 2, 0.27),
(114, 2, 4, 5, 0.27),
(115, 3, 1, 0.25, 0.21),
(116, 3, 2, 0.5, 0.21),
(117, 3, 4, 8, 0.21),
(118, 4, 1, 0.2, 0.06),
(119, 4, 2, 0.2, 0.06),
(120, 4, 3, 0.13, 0.06);

-- --------------------------------------------------------

--
-- Table structure for table `subkriteria`
--

CREATE TABLE `subkriteria` (
  `id` int(11) NOT NULL,
  `idKriteria` int(11) NOT NULL,
  `subkriteria` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subkriteria`
--

INSERT INTO `subkriteria` (`id`, `idKriteria`, `subkriteria`, `slug`) VALUES
(1, 1, '< 399.000', '399000'),
(3, 1, '400.000 - 599.000', '400000-599000'),
(4, 1, '600.000 - 799.000', '600000-799000'),
(6, 1, '800.000 - 999.000', '800000-999000'),
(7, 1, '> 1.000.000', '1000000'),
(8, 2, '< 1km', '1km'),
(9, 2, '1-5 km', '1-5-km'),
(10, 2, '> 5km', '5km'),
(11, 3, '2 x 3 ㎡', '2-x-3'),
(12, 3, '3 x 4 ㎡', '3-x-4'),
(13, 3, '> 4 x 5 ㎡', '4-x-5'),
(14, 4, 'Tidak ada satpam', 'tidak-ada-satpam'),
(15, 4, 'Satpam 1', 'satpam-1'),
(17, 4, 'Satpam lebih dari 1', 'satpam-lebih-dari-1');

-- --------------------------------------------------------

--
-- Table structure for table `subkriteria_nilai`
--

CREATE TABLE `subkriteria_nilai` (
  `id` int(11) NOT NULL,
  `idKriteria` int(11) NOT NULL,
  `idSubkriteriaAsal` int(11) NOT NULL,
  `idSubkriteriaTujuan` int(11) NOT NULL,
  `nilai` float NOT NULL,
  `nilaiPrioritas` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subkriteria_nilai`
--

INSERT INTO `subkriteria_nilai` (`id`, `idKriteria`, `idSubkriteriaAsal`, `idSubkriteriaTujuan`, `nilai`, `nilaiPrioritas`) VALUES
(551, 1, 1, 1, 0.42, 0.42),
(552, 1, 1, 1, 0.24, 0.42),
(553, 1, 1, 1, 0.21, 0.42),
(554, 1, 1, 1, 0.06, 0.42),
(555, 1, 1, 1, 0.07, 0.42),
(556, 1, 1, 2, 6, 0.42),
(557, 1, 1, 3, 2, 0.42),
(558, 1, 1, 4, 5, 0.42),
(559, 1, 1, 5, 3, 0.42),
(560, 1, 2, 1, 0.17, 0.24),
(561, 1, 2, 3, 3, 0.24),
(562, 1, 2, 4, 3, 0.24),
(563, 1, 2, 5, 5, 0.24),
(564, 1, 3, 1, 0.5, 0.21),
(565, 1, 3, 2, 0.33, 0.21),
(566, 1, 3, 4, 3, 0.21),
(567, 1, 3, 5, 6, 0.21),
(568, 1, 4, 1, 0.2, 0.06),
(569, 1, 4, 2, 0.33, 0.06),
(570, 1, 4, 3, 0.33, 0.06),
(571, 1, 4, 5, 1, 0.06),
(572, 1, 5, 1, 0.33, 0.07),
(573, 1, 5, 2, 0.2, 0.07),
(574, 1, 5, 3, 0.17, 0.07),
(575, 1, 5, 4, 1, 0.07),
(576, 2, 1, 1, 0.75, 0.75),
(577, 2, 1, 1, 0.17, 0.75),
(578, 2, 1, 1, 0.08, 0.75),
(579, 2, 1, 2, 6, 0.75),
(580, 2, 1, 3, 8, 0.75),
(581, 2, 2, 1, 0.17, 0.17),
(582, 2, 2, 3, 3, 0.17),
(583, 2, 3, 1, 0.13, 0.08),
(584, 2, 3, 2, 0.33, 0.08),
(585, 3, 1, 1, 0.31, 0.31),
(586, 3, 1, 1, 0.51, 0.31),
(587, 3, 1, 1, 0.18, 0.31),
(588, 3, 1, 2, 1, 0.31),
(589, 3, 1, 3, 1, 0.31),
(590, 3, 2, 1, 1, 0.51),
(591, 3, 2, 3, 6, 0.51),
(592, 3, 3, 1, 1, 0.18),
(593, 3, 3, 2, 0.17, 0.18),
(594, 4, 1, 1, 0.67, 0.67),
(595, 4, 1, 1, 0.15, 0.67),
(596, 4, 1, 1, 0.18, 0.67),
(597, 4, 1, 2, 6, 0.67),
(598, 4, 1, 3, 3, 0.67),
(599, 4, 2, 1, 0.17, 0.15),
(600, 4, 2, 3, 1, 0.15),
(601, 4, 3, 1, 0.33, 0.18),
(602, 4, 3, 2, 1, 0.18);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idKost` (`idKost`),
  ADD KEY `alternatif_ibfk_2` (`idSubkriteriaHarga`),
  ADD KEY `idSubkriteriaJarak` (`idSubkriteriaJarak`),
  ADD KEY `idSubkriteriaLuas` (`idSubkriteriaLuas`),
  ADD KEY `idSubkriteriaKeamanan` (`idSubkriteriaKeamanan`);

--
-- Indexes for table `alternatif_nilai`
--
ALTER TABLE `alternatif_nilai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idAlternatif` (`idAlternatif`);

--
-- Indexes for table `kost`
--
ALTER TABLE `kost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `kriteria_nilai`
--
ALTER TABLE `kriteria_nilai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `idKriteria` (`idKriteria`);

--
-- Indexes for table `subkriteria_nilai`
--
ALTER TABLE `subkriteria_nilai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idKriteria` (`idKriteria`),
  ADD KEY `idSubkriteriaAsal` (`idSubkriteriaAsal`),
  ADD KEY `idSubkriteriaTujuan` (`idSubkriteriaTujuan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `alternatif_nilai`
--
ALTER TABLE `alternatif_nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `kost`
--
ALTER TABLE `kost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kriteria_nilai`
--
ALTER TABLE `kriteria_nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `subkriteria`
--
ALTER TABLE `subkriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `subkriteria_nilai`
--
ALTER TABLE `subkriteria_nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=603;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD CONSTRAINT `alternatif_ibfk_1` FOREIGN KEY (`idKost`) REFERENCES `kost` (`id`),
  ADD CONSTRAINT `alternatif_ibfk_2` FOREIGN KEY (`idSubkriteriaHarga`) REFERENCES `subkriteria` (`id`),
  ADD CONSTRAINT `alternatif_ibfk_3` FOREIGN KEY (`idSubkriteriaJarak`) REFERENCES `subkriteria` (`id`),
  ADD CONSTRAINT `alternatif_ibfk_4` FOREIGN KEY (`idSubkriteriaLuas`) REFERENCES `subkriteria` (`id`),
  ADD CONSTRAINT `alternatif_ibfk_5` FOREIGN KEY (`idSubkriteriaKeamanan`) REFERENCES `subkriteria` (`id`);

--
-- Constraints for table `alternatif_nilai`
--
ALTER TABLE `alternatif_nilai`
  ADD CONSTRAINT `alternatif_nilai_ibfk_1` FOREIGN KEY (`idAlternatif`) REFERENCES `alternatif` (`id`);

--
-- Constraints for table `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD CONSTRAINT `subkriteria_ibfk_1` FOREIGN KEY (`idKriteria`) REFERENCES `kriteria` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
