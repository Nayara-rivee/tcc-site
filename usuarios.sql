-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15/05/2025 às 11:37
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
-- Banco de dados: `login`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(140) NOT NULL,
  `email` varchar(140) NOT NULL,
  `senha` varchar(140) NOT NULL,
  `nivel` int(11) NOT NULL,
  `tell` varchar(11) NOT NULL,
  `sobrenome` varchar(140) NOT NULL,
  `gênero` enum('Feminino','Masculino','Prefiro não dizer') NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `nome_comunidade` varchar(100) DEFAULT NULL,
  `telefone_comunidade` varchar(20) DEFAULT NULL,
  `entrou_no_grupo` tinyint(1) DEFAULT 0,
  `entrou_no_grupo_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `nivel`, `tell`, `sobrenome`, `gênero`, `password_reset_token`, `nome_comunidade`, `telefone_comunidade`, `entrou_no_grupo`, `entrou_no_grupo_em`) VALUES
(22, 'Marcelle', 'marcelle@gmail.com', '$2y$10$KXi1cwtXjHt1KpKyohe/cOFAd/MiTIRaWGJ2q7OOKEFJxts/mNCMy', 0, '1234565', 'Batista', 'Feminino', '2cf96b349f3b867ceee083f5af72597298ab793ed07d50d95e8957929339eb5135b4fe5e2863b95548e03a92cbcd2d30f4f7', NULL, NULL, 0, NULL),
(23, 'nayara', 'nayarasp07@gmail.com', '$2y$10$jlB0vsYxdLum7MxJf6fCx.EM5bfTj8N4YLjLI9u9svwXG4UTtUBWq', 0, '1232343554', 'silva', 'Feminino', NULL, NULL, NULL, 0, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
