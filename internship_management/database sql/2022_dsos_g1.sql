-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2023 at 01:09 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `2022_dsos_g1`
--

-- --------------------------------------------------------

--
-- Table structure for table `aluno`
--

CREATE TABLE `aluno` (
  `id` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `autenticacao_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `aluno`
--

INSERT INTO `aluno` (`id`, `numero`, `nome`, `email`, `autenticacao_id`) VALUES
(21, 1, 'aluno', 'aluno@gmail.com', 31),
(22, 2, 'aluno1', 'aluno1@gmail.com', 32),
(23, 3, 'aluno2', 'aluno2@gmail.com', 33);

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `descricao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`id`, `name`, `descricao`) VALUES
(1, 'Desenvolvimento / Operação de Software', 'Desenvolvimento / Operação de Software. É muito fixe! meus bacans'),
(2, 'Desenvolvimento de Software Orientado a Serviços', 'Desenvolvimento de Software Orientado a Serviços. É muito fixe!'),
(3, 'Laboratório de Projeto III', 'Laboratório de Projeto III. É muito fixe!'),
(4, 'Processos das Organizações', 'Processos das Organizações. É muito fixe!');

-- --------------------------------------------------------

--
-- Table structure for table `autenticacao`
--

CREATE TABLE `autenticacao` (
  `id` int(11) NOT NULL,
  `login_type` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `autenticacao`
--

INSERT INTO `autenticacao` (`id`, `login_type`, `username`, `password`) VALUES
(26, 'ADMIN', 'admin', '$argon2i$v=19$m=131072,t=4,p=3$TGpiNFhheVZJS01KTnh5VQ$La/cK/3zfOVGroCp2tG7OrtDfr5eti5mQk3yADhmdOU'),
(28, 'RESPONSAVEL', 'responsavel', '$argon2i$v=19$m=131072,t=4,p=3$dlpXbGh1RXBDTzFIWXBpMA$Mhk6HUEjY3UddgE6UykEa8avf0viMXoeueAK3PLWC08'),
(30, 'DOCENTE', 'docente', '$argon2i$v=19$m=131072,t=4,p=3$SDV3MHovMFZDV20zeVlIaw$LAnCvyhqg/DCQbfoFME95ejy/2jLZlen95c34kWBjD8'),
(31, 'ALUNO', 'aluno', '$argon2i$v=19$m=131072,t=4,p=3$YWh1cVVlT1RiTU9WZlpMSw$D7yQgL+pbTZzUnbEZ7I/3wt8lyTMnc9kabAEEmURz2Y'),
(32, 'ALUNO', 'aluno1', '$argon2i$v=19$m=131072,t=4,p=3$bzhxTGU4UVllR3RoUU1ycw$j1pP9kmGq/QP/xFopTudv+lntphorTFmgMIsDfpRj0A'),
(33, 'ALUNO', 'aluno2', '$argon2i$v=19$m=131072,t=4,p=3$dUlsWUJCZEhMUGZEU2lvUw$rQjP2goMtqSNbUTTYnhou5gvij52bhtjZSbD4//xn+Y'),
(34, 'DOCENTE', 'docente1', '$argon2i$v=19$m=131072,t=4,p=3$U1UyeExVeFlPclVjV0hnVQ$vq7GRklV/PFgbZ09QGkX5EUEj06S9yHTvYspgpUVf0E'),
(35, 'EMPRESA', 'empresa', '$argon2i$v=19$m=131072,t=4,p=3$NzlyakJOTVQydVN6RUVjZQ$CXq4Hy0+0+z+VR8SC9Ub7zFvYOFfJb9/DSdV6Rxuov0');

-- --------------------------------------------------------

--
-- Table structure for table `candidaturas_docente`
--

CREATE TABLE `candidaturas_docente` (
  `aluno_id` int(11) NOT NULL,
  `proposta_docente_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `candidaturas_empresa`
--

CREATE TABLE `candidaturas_empresa` (
  `aluno_id` int(11) NOT NULL,
  `proposta_empresa_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `docente`
--

CREATE TABLE `docente` (
  `id` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL,
  `email` varchar(255) NOT NULL,
  `autenticacao_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `docente`
--

INSERT INTO `docente` (`id`, `numero`, `nome`, `isAdmin`, `email`, `autenticacao_id`) VALUES
(4, 1, 'docente', 1, 'docente@gmail.com', 30),
(5, 2, 'docente1', 0, 'docente1@gmail.com', 34);

-- --------------------------------------------------------

--
-- Table structure for table `empresa`
--

CREATE TABLE `empresa` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `morada` varchar(255) NOT NULL,
  `telefone` int(9) NOT NULL,
  `email` varchar(255) NOT NULL,
  `site` varchar(255) NOT NULL,
  `responsavel_id` int(11) NOT NULL,
  `autenticacao_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `empresa`
--

INSERT INTO `empresa` (`id`, `nome`, `morada`, `telefone`, `email`, `site`, `responsavel_id`, `autenticacao_id`) VALUES
(7, 'empresa', 'rua da empresa', 912345678, 'empresa@gmail.com', 'empresa.site.com', 4, 35);

-- --------------------------------------------------------

--
-- Table structure for table `proposta_aluno`
--

CREATE TABLE `proposta_aluno` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `aluno_id` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `area_id` int(11) NOT NULL,
  `pdf` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `proposta_aluno`
--

INSERT INTO `proposta_aluno` (`id`, `titulo`, `aluno_id`, `descricao`, `status`, `area_id`, `pdf`) VALUES
(3, 'Virar frangos', 21, 'Anda virar do frango', 0, 4, 'aval-sad.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `proposta_docente`
--

CREATE TABLE `proposta_docente` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `docente_id` int(11) NOT NULL,
  `aluno_id` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `area_id` int(11) NOT NULL,
  `pdf` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `proposta_docente`
--

INSERT INTO `proposta_docente` (`id`, `titulo`, `docente_id`, `aluno_id`, `descricao`, `status`, `area_id`, `pdf`) VALUES
(12, 'Apanhar castanhas', 4, 0, 'Apanhar da castanha', 0, 3, 'p8.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `proposta_empresa`
--

CREATE TABLE `proposta_empresa` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `aluno_id` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `area_id` int(11) NOT NULL,
  `pdf` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `proposta_empresa`
--

INSERT INTO `proposta_empresa` (`id`, `titulo`, `empresa_id`, `aluno_id`, `descricao`, `status`, `area_id`, `pdf`) VALUES
(3, 'Ir de férias', 7, 0, 'Vamos a la playa, oh, oh, oh, oh, oh\r\nVamos a la playa, oh, oh, oh, oh, oh\r\nVamos a la playa, oh, oh, oh, oh, oh\r\nVamos a la playa, oh, oh\r\nVamos a la playa\r\nLa bomba estalló\r\nLas radiaciones tostan\r\nY matizan de azul\r\nVamos a la playa, oh, oh, oh, oh, oh\r\nVamos a la playa, oh, oh, oh, oh, oh\r\nVamos a la playa, oh, oh, oh, oh, oh\r\nVamos a la playa, oh, oh', 0, 1, 'p9.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `responsavel`
--

CREATE TABLE `responsavel` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefone` int(9) NOT NULL,
  `autenticacao_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `responsavel`
--

INSERT INTO `responsavel` (`id`, `nome`, `email`, `telefone`, `autenticacao_id`) VALUES
(4, 'responsavel', 'responsavel@gmail.com', 912345678, 28);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`id`),
  ADD KEY `autenticacao_id` (`autenticacao_id`);

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `autenticacao`
--
ALTER TABLE `autenticacao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidaturas_docente`
--
ALTER TABLE `candidaturas_docente`
  ADD KEY `aluno_id` (`aluno_id`),
  ADD KEY `proposta_docente_id` (`proposta_docente_id`);

--
-- Indexes for table `candidaturas_empresa`
--
ALTER TABLE `candidaturas_empresa`
  ADD KEY `aluno_id` (`aluno_id`),
  ADD KEY `proposta_empresa_id` (`proposta_empresa_id`);

--
-- Indexes for table `docente`
--
ALTER TABLE `docente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `autenticacao_id` (`autenticacao_id`);

--
-- Indexes for table `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `responsavel-id` (`responsavel_id`),
  ADD KEY `autenticacao_id` (`autenticacao_id`);

--
-- Indexes for table `proposta_aluno`
--
ALTER TABLE `proposta_aluno`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aluno_id` (`aluno_id`),
  ADD KEY `area_id` (`area_id`);

--
-- Indexes for table `proposta_docente`
--
ALTER TABLE `proposta_docente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `docente_id` (`docente_id`),
  ADD KEY `aluno_id` (`aluno_id`),
  ADD KEY `area_id` (`area_id`);

--
-- Indexes for table `proposta_empresa`
--
ALTER TABLE `proposta_empresa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empresa_id` (`empresa_id`),
  ADD KEY `aluno_id` (`aluno_id`),
  ADD KEY `area_id` (`area_id`);

--
-- Indexes for table `responsavel`
--
ALTER TABLE `responsavel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `autenticacao_id` (`autenticacao_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aluno`
--
ALTER TABLE `aluno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `autenticacao`
--
ALTER TABLE `autenticacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `docente`
--
ALTER TABLE `docente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `proposta_aluno`
--
ALTER TABLE `proposta_aluno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `proposta_docente`
--
ALTER TABLE `proposta_docente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `proposta_empresa`
--
ALTER TABLE `proposta_empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `responsavel`
--
ALTER TABLE `responsavel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `aluno_ibfk_1` FOREIGN KEY (`autenticacao_id`) REFERENCES `autenticacao` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `candidaturas_docente`
--
ALTER TABLE `candidaturas_docente`
  ADD CONSTRAINT `candidaturas_docente_ibfk_1` FOREIGN KEY (`aluno_id`) REFERENCES `aluno` (`id`),
  ADD CONSTRAINT `candidaturas_docente_ibfk_2` FOREIGN KEY (`proposta_docente_id`) REFERENCES `proposta_docente` (`id`);

--
-- Constraints for table `candidaturas_empresa`
--
ALTER TABLE `candidaturas_empresa`
  ADD CONSTRAINT `candidaturas_empresa_ibfk_1` FOREIGN KEY (`aluno_id`) REFERENCES `aluno` (`id`),
  ADD CONSTRAINT `candidaturas_empresa_ibfk_2` FOREIGN KEY (`proposta_empresa_id`) REFERENCES `proposta_empresa` (`id`);

--
-- Constraints for table `docente`
--
ALTER TABLE `docente`
  ADD CONSTRAINT `docente_ibfk_1` FOREIGN KEY (`autenticacao_id`) REFERENCES `autenticacao` (`id`);

--
-- Constraints for table `empresa`
--
ALTER TABLE `empresa`
  ADD CONSTRAINT `empresa_ibfk_1` FOREIGN KEY (`autenticacao_id`) REFERENCES `autenticacao` (`id`),
  ADD CONSTRAINT `empresa_ibfk_2` FOREIGN KEY (`responsavel_id`) REFERENCES `responsavel` (`id`);

--
-- Constraints for table `proposta_aluno`
--
ALTER TABLE `proposta_aluno`
  ADD CONSTRAINT `proposta_aluno_ibfk_1` FOREIGN KEY (`area_id`) REFERENCES `area` (`id`),
  ADD CONSTRAINT `proposta_aluno_ibfk_2` FOREIGN KEY (`aluno_id`) REFERENCES `aluno` (`id`);

--
-- Constraints for table `proposta_docente`
--
ALTER TABLE `proposta_docente`
  ADD CONSTRAINT `proposta_docente_ibfk_1` FOREIGN KEY (`area_id`) REFERENCES `area` (`id`),
  ADD CONSTRAINT `proposta_docente_ibfk_2` FOREIGN KEY (`docente_id`) REFERENCES `docente` (`id`);

--
-- Constraints for table `proposta_empresa`
--
ALTER TABLE `proposta_empresa`
  ADD CONSTRAINT `proposta_empresa_ibfk_1` FOREIGN KEY (`area_id`) REFERENCES `area` (`id`),
  ADD CONSTRAINT `proposta_empresa_ibfk_2` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`id`);

--
-- Constraints for table `responsavel`
--
ALTER TABLE `responsavel`
  ADD CONSTRAINT `responsavel_ibfk_1` FOREIGN KEY (`autenticacao_id`) REFERENCES `autenticacao` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
