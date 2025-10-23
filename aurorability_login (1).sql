-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23/10/2025 às 20:17
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `aurorability_login`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `servico_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `titulo_comentario` varchar(255) NOT NULL,
  `comentario` text NOT NULL,
  `data_criacao` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `comentarios`
--

INSERT INTO `comentarios` (`id`, `servico_id`, `usuario_id`, `titulo_comentario`, `comentario`, `data_criacao`) VALUES
(4, 15, 9, 'Iniciando', 'Para iniciar o projeto\n1. Navbar\n2. Hero Section\n3. Noticias', '2025-09-15 20:20:51'),
(5, 15, 9, 'testando de novo', 'aaaaaaaaaaaaa', '2025-09-16 19:12:08');

-- --------------------------------------------------------

--
-- Estrutura para tabela `servico`
--

CREATE TABLE `servico` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `tipo_servico_id` int(11) NOT NULL,
  `data_inicio` date NOT NULL DEFAULT current_timestamp(),
  `data_termino` date NOT NULL,
  `status` enum('Em Andamento','Concluído','Cancelado','') NOT NULL DEFAULT 'Em Andamento'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `servico`
--

INSERT INTO `servico` (`id`, `usuario_id`, `tipo_servico_id`, `data_inicio`, `data_termino`, `status`) VALUES
(11, 6, 2, '2025-09-07', '2025-09-24', 'Concluído'),
(12, 6, 3, '2025-09-07', '2025-09-17', 'Concluído'),
(15, 9, 3, '2025-09-15', '2025-09-25', 'Em Andamento');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipos_servico`
--

CREATE TABLE `tipos_servico` (
  `id` int(11) NOT NULL,
  `nome_tipo` varchar(100) NOT NULL,
  `valor` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tipos_servico`
--

INSERT INTO `tipos_servico` (`id`, `nome_tipo`, `valor`) VALUES
(1, 'Plano Básico', 2490),
(2, 'Plano Intermediário', 4950),
(3, 'Plano Avançado', 6420);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `codigo_redefinicao` varchar(6) DEFAULT NULL,
  `validade_codigo` datetime DEFAULT NULL,
  `token_redefinicao` varchar(64) DEFAULT NULL,
  `validade_token` datetime DEFAULT NULL,
  `nivel` int(2) NOT NULL,
  `data_criacao` date NOT NULL DEFAULT current_timestamp(),
  `cpf` varchar(14) NOT NULL,
  `rg` varchar(20) NOT NULL,
  `genero` varchar(50) NOT NULL,
  `numero` varchar(15) NOT NULL,
  `caminho_foto` varchar(255) DEFAULT NULL,
  `token` varchar(64) DEFAULT NULL,
  `token_expira` datetime DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `codigo_redefinicao`, `validade_codigo`, `token_redefinicao`, `validade_token`, `nivel`, `data_criacao`, `cpf`, `rg`, `genero`, `numero`, `caminho_foto`, `token`, `token_expira`, `telefone`, `data_nascimento`) VALUES
(2, 'Nickolas', 'nickolascremasco@gmail.com', '$2y$10$.obdvEXvlajWCeuk4Nu0OOdCDFdFAqwJrBQfDtXEu5Xl.dLWTqIbO', NULL, NULL, NULL, NULL, 1, '2025-06-29', '', '', '', '', NULL, NULL, NULL, NULL, NULL),
(6, 'Alexandra Sarandy', 'alexandra@gmail.com', '$2y$10$Qv.s5PD7TDAsDLnCrpjnmeGjjHWEnYOa/x50FbdohqkBC/JtYO5Z6', NULL, NULL, NULL, NULL, 0, '2025-09-01', '445.238.438-21', '55.235.435', 'masculino', '', '../img/uploads/68b63c556cf2a-usuarioGenerico.jpg', NULL, NULL, NULL, NULL),
(9, 'teste', 'teste@gmail.com', '$2y$10$5TPGdJli8ITIUydfwR2oo.oOzTfikOKVR5r0HZC7wl21gAqYvpuKq', NULL, NULL, NULL, NULL, 0, '2025-09-05', '453.453.453-45', '43-534.534', 'masculino', '', NULL, NULL, NULL, NULL, NULL),
(14, 'testeF', 'testandoF@gmail.com', '$2y$10$M8Z2LHfPz0./88dRXx7rFOSuwaVzLsmYa/VlZih9oVRRWwcZoNI6.', NULL, NULL, NULL, NULL, 0, '2025-10-01', '445.238.438-21', '55-235.435', 'masculino', '(21) 97455-', '../img/uploads/68ddbb56940a2-4161d2c1db40f36f4c258e6b5561c0ee.jpg', NULL, NULL, NULL, NULL),
(16, 'nayara', 'nayarasp07@gmail.com', '$2y$10$OPFHwkICLH2cxFWI3AggUO4tyAr8PF6SSLLbqqnmU1jdndAFSTxOa', NULL, NULL, NULL, NULL, 0, '2025-10-08', '', '', 'feminino', '', 'img/uploads/perfil/16_nayara_1761097952.jpg', '9551739c67970e2da888c99d2f4ea1d4b168182252f64617db537db173815bbd', '2025-10-23 20:05:14', '2134212324', '2007-10-17'),
(17, 'maria', 'maria@gmail.com', '$2y$10$HIhGakrA0Ix9xqqNcrvyTe.PmiyrenGQxM8xY6QefEZEX3YewRzdC', NULL, NULL, NULL, NULL, 1, '2025-10-08', '', '', 'feminino', '', NULL, NULL, NULL, '324243533456', '1997-06-12'),
(18, 'livia', 'livia@gmail.com', '$2y$10$x.aZ/FGInRP.SgiReC6vN.MYNeOKC1ssvFWvSWS2BqJlRFhbJsn9.', NULL, NULL, NULL, NULL, 0, '2025-10-08', '', '', 'feminino', '', NULL, NULL, NULL, '12342435', '1990-03-21'),
(19, 'livia', 'livia@gmail.com', '$2y$10$lwNHUzQdlbrI/U0qFOTZauQRT3yO3fk/bI7e3Vp9k2x7xieD.04w.', NULL, NULL, NULL, NULL, 0, '2025-10-08', '', '', 'feminino', '', NULL, NULL, NULL, '12342435', '1990-03-21'),
(20, 'livia', 'livia@gmail.com', '$2y$10$cXXXk1xgZ76w8yDQB6Up7OSXDvDAD4CwKeRR0A0xv21p2c1ApzCeO', NULL, NULL, NULL, NULL, 0, '2025-10-08', '', '', 'feminino', '', NULL, NULL, NULL, '12342435', '1990-03-21'),
(21, 'aline', 'aline@gmail.com', '$2y$10$rHJpZPSc0Ph/y67s2mtNVeR1fWxGp.OR5wkbAT657cKayv/TdizBS', NULL, NULL, NULL, NULL, 0, '2025-10-08', '15193545769', '23-423.534', 'feminino', '', NULL, NULL, NULL, '12432435435', '1997-12-01');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuario_id` (`usuario_id`),
  ADD KEY `fk_servico_id` (`servico_id`);

--
-- Índices de tabela `servico`
--
ALTER TABLE `servico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuarios` (`usuario_id`),
  ADD KEY `fk_tipo_servicos` (`tipo_servico_id`);

--
-- Índices de tabela `tipos_servico`
--
ALTER TABLE `tipos_servico`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `servico`
--
ALTER TABLE `servico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `tipos_servico`
--
ALTER TABLE `tipos_servico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `fk_servico_id` FOREIGN KEY (`servico_id`) REFERENCES `servico` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_usuario_id` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Restrições para tabelas `servico`
--
ALTER TABLE `servico`
  ADD CONSTRAINT `fk_tipo_servicos` FOREIGN KEY (`tipo_servico_id`) REFERENCES `tipos_servico` (`id`),
  ADD CONSTRAINT `fk_usuarios` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
