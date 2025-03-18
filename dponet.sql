-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17/03/2025 às 01:10
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
-- Banco de dados: `dponet`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `formularios`
--

CREATE TABLE `formularios` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `perguntas`
--

CREATE TABLE `perguntas` (
  `id` int(11) NOT NULL,
  `pergunta` varchar(255) NOT NULL,
  `opcao1` varchar(255) NOT NULL,
  `opcao2` varchar(255) NOT NULL,
  `opcao3` varchar(255) NOT NULL,
  `opcao4` varchar(255) NOT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `formulario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `perguntas`
--

INSERT INTO `perguntas` (`id`, `pergunta`, `opcao1`, `opcao2`, `opcao3`, `opcao4`, `data_criacao`, `formulario_id`) VALUES
(1, 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Esse tempore quidem eius cumque ratione iure quasi natus cum nemo, officiis nam consectetur, vel accusamus excepturi laudantium. Deleniti perferendis explicabo illum?     ', 'lorem', 'lorem', 'lorem', 'lorem', '2025-03-16 20:59:07', 0),
(2, 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Esse tempore quidem eius cumque ratione iure quasi natus cum nemo, officiis nam consectetur, vel accusamus excepturi laudantium. Deleniti perferendis explicabo illum?     ', 'lorem', 'lorem', 'lorem', 'lorem', '2025-03-16 23:46:21', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `respostas`
--

CREATE TABLE `respostas` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `pergunta_id` int(11) NOT NULL,
  `resposta` int(1) NOT NULL,
  `data_resposta` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `respostas`
--

INSERT INTO `respostas` (`id`, `usuario_id`, `pergunta_id`, `resposta`, `data_resposta`) VALUES
(1, 13, 1, 3, '2025-03-16 23:48:27'),
(2, 13, 2, 3, '2025-03-16 23:48:27'),
(3, 13, 1, 0, '2025-03-16 23:55:24'),
(4, 13, 2, 0, '2025-03-16 23:55:24'),
(5, 13, 1, 2, '2025-03-17 00:01:40'),
(6, 13, 2, 1, '2025-03-17 00:01:40');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo_usuario` enum('admin','usuario') NOT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `tipo_usuario`, `data_criacao`) VALUES
(1, 'João', 'freiresjv@gmail.com', '$2y$10$6XZS/vjciOl.5NqgnpR5QeTiOPzNflK/CpwaQEyNIWjxIVZGZIRtu', 'admin', '2025-03-16 20:11:18'),
(4, 'Beatriz', 'a@gmail.com', '$2y$10$NW1t13PN7AR5bBYVwyVOP.pPVZF1JOLLsNos1XD9dNJX/tiRXpvIm', 'admin', '2025-03-16 20:14:31'),
(5, 'rafel', 'unimar@g.com', '$2y$10$ftBqKva.Zhj4Q1RpuYzQReLDC2kkGOme9D1MhTRDbHXSayCJtUnkW', 'admin', '2025-03-16 20:22:57'),
(9, 'Luiz', 'etec@gmail.com', '$2y$10$EeYZeGb9CmMHtOuEZE1H8.nFx9frSuM4JV97jyflzSy8/v2GjZhZe', 'usuario', '2025-03-16 20:32:41'),
(10, 'Rafael', '123@gmail.com', '$2y$10$4sicsicxuEyHE.Gz9fK4h.bt6QHZD9WNLh5m6AO2eaNn1710etVLq', 'admin', '2025-03-16 20:34:09'),
(11, 'Luiz', '1@i.com', '$2y$10$FpU2LwF/3ngflFLo/nJ/TOmmt6niR.CQbP4K.3TpSNDWbzbl/QtY6', 'admin', '2025-03-16 20:58:17'),
(12, 'Rafael', 'unim@i.com', '$2y$10$jtX3qdKCvcXOPCmGc9G8zeTIf4UJddp8zsADyYuSIrrJESpsVIloe', 'usuario', '2025-03-16 21:00:06'),
(13, 'Julia', '1234@gmail.com', '$2y$10$9tIPzksenuvi4axngtz1J.rTcDCP2RBM2DrYU15iKWWvRe/pbXvAW', 'admin', '2025-03-16 22:13:27');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `formularios`
--
ALTER TABLE `formularios`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `perguntas`
--
ALTER TABLE `perguntas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `respostas`
--
ALTER TABLE `respostas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `pergunta_id` (`pergunta_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `formularios`
--
ALTER TABLE `formularios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `perguntas`
--
ALTER TABLE `perguntas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `respostas`
--
ALTER TABLE `respostas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `respostas`
--
ALTER TABLE `respostas`
  ADD CONSTRAINT `respostas_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `respostas_ibfk_2` FOREIGN KEY (`pergunta_id`) REFERENCES `perguntas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
