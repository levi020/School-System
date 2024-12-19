-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19/12/2024 às 03:06
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `escola`
--
CREATE DATABASE IF NOT EXISTS `escola` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `escola`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `alunos`
--

DROP TABLE IF EXISTS `alunos`;
CREATE TABLE IF NOT EXISTS `alunos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(500) NOT NULL,
  `nome` varchar(500) NOT NULL,
  `cpf` varchar(500) NOT NULL,
  `escola` varchar(500) NOT NULL,
  `turma` varchar(500) NOT NULL,
  `status` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `alunos`
--

INSERT INTO `alunos` (`id`, `image`, `nome`, `cpf`, `escola`, `turma`, `status`) VALUES
(1, 'images\\Kakashi.jpg', 'Kakashi', '000.000.000-00', 'E.E.B Júlia Miranda de Souza', '201', 'N');

-- --------------------------------------------------------

--
-- Estrutura para tabela `boletim`
--

DROP TABLE IF EXISTS `boletim`;
CREATE TABLE IF NOT EXISTS `boletim` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nota_id` int(11) NOT NULL,
  `portugues` double(12,2) DEFAULT NULL,
  `matematica` double(12,2) DEFAULT NULL,
  `ciencias_humanas` double(12,2) DEFAULT NULL,
  `ciencias_sociais` double(12,2) DEFAULT NULL,
  `educacao_fisica` double(12,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nota_id` (`nota_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `diario`
--

DROP TABLE IF EXISTS `diario`;
CREATE TABLE IF NOT EXISTS `diario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `turma` varchar(500) DEFAULT NULL,
  `data` varchar(500) NOT NULL,
  `anotacoes` varchar(500) NOT NULL,
  `cargo` varchar(500) NOT NULL,
  `numFuncionario` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `diario`
--

INSERT INTO `diario` (`id`, `turma`, `data`, `anotacoes`, `cargo`, `numFuncionario`) VALUES
(2, '201', '17/12/2024', 'terminar o sistema', 'Professor(a)', 'Levi'),
(4, '201', '18/12/2024', 'concertei o erro finalmente', 'Professor(a)', 'Levi');

-- --------------------------------------------------------

--
-- Estrutura para tabela `escola`
--

DROP TABLE IF EXISTS `escola`;
CREATE TABLE IF NOT EXISTS `escola` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `escola` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `escola`
--

INSERT INTO `escola` (`id`, `escola`) VALUES
(1, 'E.E.B Júlia Miranda de Souza'),
(2, 'E.E.B Adelaide Konder'),
(3, 'E.E.B Elsir');

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionarios`
--

DROP TABLE IF EXISTS `funcionarios`;
CREATE TABLE IF NOT EXISTS `funcionarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(500) NOT NULL,
  `senha` varchar(500) NOT NULL,
  `cargo` varchar(500) NOT NULL,
  `image` varchar(500) NOT NULL,
  `escola` varchar(500) NOT NULL,
  `ativo` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `funcionarios`
--

INSERT INTO `funcionarios` (`id`, `user`, `senha`, `cargo`, `image`, `escola`, `ativo`) VALUES
(1, 'Levi', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 'Professor(a)', 'images\\itachi.jpg', 'E.E.B Júlia Miranda de Souza', 's');

-- --------------------------------------------------------

--
-- Estrutura para tabela `notas`
--

DROP TABLE IF EXISTS `notas`;
CREATE TABLE IF NOT EXISTS `notas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aluno_id` int(11) NOT NULL,
  `turma` varchar(500) NOT NULL,
  `portugues` double(12,2) DEFAULT NULL,
  `matematica` double(12,2) DEFAULT NULL,
  `ciencias_humanas` double(12,2) DEFAULT NULL,
  `ciencias_exatas` double(12,2) DEFAULT NULL,
  `educacao_fisica` double(12,2) DEFAULT NULL,
  `trimestre` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `aluno_id` (`aluno_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `turmas`
--

DROP TABLE IF EXISTS `turmas`;
CREATE TABLE IF NOT EXISTS `turmas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numTurma` varchar(500) NOT NULL,
  `profResponsavel` varchar(500) NOT NULL,
  `mediaTurma` varchar(500) NOT NULL,
  `escola` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `turmas`
--

INSERT INTO `turmas` (`id`, `numTurma`, `profResponsavel`, `mediaTurma`, `escola`) VALUES
(1, '201', 'Levi', '6', 'E.E.B Júlia Miranda de Souza');

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `boletim`
--
ALTER TABLE `boletim`
  ADD CONSTRAINT `boletim_ibfk_1` FOREIGN KEY (`nota_id`) REFERENCES `notas` (`id`);

--
-- Restrições para tabelas `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `notas_ibfk_1` FOREIGN KEY (`aluno_id`) REFERENCES `alunos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
