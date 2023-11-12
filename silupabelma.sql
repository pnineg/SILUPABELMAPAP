-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11-Nov-2023 às 14:31
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `silupabelma`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `codigos_postais`
--

CREATE TABLE `codigos_postais` (
  `cod_postal` varchar(8) NOT NULL,
  `localidade` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `codigos_postais`
--

INSERT INTO `codigos_postais` (`cod_postal`, `localidade`) VALUES
('0', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `encomendas`
--

CREATE TABLE `encomendas` (
  `id_encomenda` int(11) NOT NULL,
  `data_encomenda` date NOT NULL,
  `id_user` int(11) NOT NULL,
  `valor_total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `encomendas`
--

INSERT INTO `encomendas` (`id_encomenda`, `data_encomenda`, `id_user`, `valor_total`) VALUES
(2, '2023-11-02', 37, '19.00'),
(3, '2023-11-03', 26, '20.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `linhas_encm`
--

CREATE TABLE `linhas_encm` (
  `id_encomenda` int(11) NOT NULL,
  `id_produto` int(255) NOT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `valor_produto` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `products`
--

CREATE TABLE `products` (
  `id_produto` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `preço_uni` int(11) DEFAULT NULL,
  `foto` varchar(250) DEFAULT NULL,
  `capacidade` varchar(255) DEFAULT NULL,
  `cor` varchar(255) DEFAULT NULL,
  `marca` varchar(255) DEFAULT NULL,
  `dimensões` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `products`
--

INSERT INTO `products` (`id_produto`, `name`, `stock`, `preço_uni`, `foto`, `capacidade`, `cor`, `marca`, `dimensões`) VALUES
(6, 'CilindroBelma', 1, 50, 'transferir.jpeg', '250L', 'Branco', 'Junker', '1.50 metro'),
(12, 'GALINHA azul', 2, 12, 'nike-air-zoom-superfly-9-elite-fg-rosa-71-69aabbafb06cace8ed16699111617259-1024-1024.jpeg', '1', 'Rosa', 'nike', '42');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `morada` varchar(255) NOT NULL,
  `cod_postal` varchar(8) NOT NULL,
  `NIF` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id_user`, `email`, `nome`, `morada`, `cod_postal`, `NIF`, `password`, `admin`) VALUES
(5, 'ronaldmec@gmail.com', 'ronaldinho', '', '0', 0, '$2y$10$fEhnZk57gJ5OqHcTcmIX5eQf3.SFsAZq5fqTC0P8vYJoAMsbC02mW', 0),
(6, 'w@gmail.com', 'www', '', '0', 0, '$2y$10$nSY8xFhXvEuh6bLe3vR35OeePVQvx/cPufypHhsMqQj8ZPzBs8R5u', 0),
(7, 'wag@gmail.com', 'wag', '', '0', 0, '$2y$10$k78VgPP7jXnUL8PbZ1dDw.7ZbiRrGhysMYAEHQrhNb54Qml9.i//y', 0),
(8, 'fakenary@gmail.com', 'luc', '', '0', 0, '$2y$10$OnMf8yqdAY3e9bJCYFMiG.aFkkw0IrGILOXJLWKhmHQUwtqB.TMWu', 0),
(9, 'prof@gmail.com', 'prof', '', '0', 0, '$2y$10$H3cWsjMNA9TC7/X7KKK1HOPKJnpBpX2lV4Ipl/Wy8vJLs.y3TCj5W', 0),
(10, 'pp@gmail.com', 'pp', '', '0', 0, '$2y$10$NNIvm0eHTqDYDUjY1Kt1N.3jEXsTQsp5WYqLq.461bsu8k51t0bbW', 0),
(11, 'p@gmail.com', 'p', '', '0', 0, '$2y$10$O/crS.XFepJ2GhpyMHMQDOIJCA7rlbjEi1BqnkUOpU8XCVt0ErucW', 0),
(12, 'q@gmail.com', 'q', '', '0', 0, '$2y$10$mdYMGGf36B5wpP80lpRmbOXGZXQ4HnrqJmnPHOzbcOpKaShF32XeS', 0),
(13, 'ro@gmail.com', 'ro', '', '0', 0, '$2y$10$dySeJT5t1K3rp2pkkuQJm.Q5SbIi7khjT9O5tROU6an4xqp51gUSy', 0),
(14, 'borracha', 'robertinhodopneu', '', '0', 0, '$2y$10$T4AwLVRRG49l.epO9oyt/.2kqNi5fZ1JBqayIvJHBM8a4bo8MGU42', 0),
(15, 'prodo@gmail.com', 'prodo', '', '0', 0, '$2y$10$.G3jkUEIpz5Iq4cDwgq5peEwWTAh1woW6ikX5UW8PXZoEPA2rDM/e', 0),
(23, 'gabigol@gmail.com', 'reidaamerica', '', '0', 0, '$2y$10$eBN7Ajrx9M2njKLpTXAgeuldvB2MhmVkRRrSybZx5Blq4N4q02WR6', 0),
(24, 'gay@gmail.com', 'gay', '', '0', 0, '$2y$10$.QhkMeUMqKcUCE5zVa9.juS754IuGmbaLHCH5IAZcJPeTsnq6Kfmm', 0),
(25, 'pepekadomal@gmail.com', 'ppk', '', '0', 0, '$2y$10$QmTI.xd8WM.NpQyzbBxzmuMyWfjzP.AdIu4QkkphWDr9o2VtXwCK.', 0),
(26, 'pedro14@gmail.com', 'Pedro Gomes', 'Travessa da ferreira 76 1º', '0', 12067, '$2y$10$TCQwe3aJxlKfSys4XATaXORYo8gR3okixEp.6gVVoVp97fChuwuU2', 1),
(27, 'pedo@gmail.com', 'pedo', '', '0', 0, '$2y$10$zevaCNxmJxekknHPnudEducAHGgzoJih6iS1q.y2nujU7KGpNtu7G', 0),
(28, 'pedrog14@gamil.com', 'pedrocadas14', 'Travessa de Ferreira', '0', 0, '$2y$10$5j2jd0B3xWWjTvNUhdef5OzoQaPzuRaw140/3mAOLyoNNCqI4aciC', 0),
(29, 'luquinhapressão@gmail.com', 'luquinhachupapitoca', 'frente da escola', '0', 0, '$2y$10$.wO84GSwhGcNeUi/iDGIk.mEx/NekI1QqF3hzcIMfW7iYUVe9QP6a', 0),
(30, 'gabrielpiroquinha@gmail.com', 'gabrieldoborel', 'Fim do Mundo 123', '0', 0, '$2y$10$W0qjRv6bMB3rBj4VZC9pBu..2wbjHUFWNGzQ3fvu5fwpshqIH60Eu', 0),
(31, 'ivorolinha@gmail.com', 'Iva Rolinha', 'CEF', '0', 0, '$2y$10$OwDyT11C7VF/Hroy/nZ6j.ZJ5UF5qdL/FjkXdMQde4H63la3G66wa', 0),
(32, 'daniela@gmail.com', 'daniela', 'dt', '0', 0, '$2y$10$la2P085LRXA/3nCn2froA.mfGsfzzHA.AV3aOr.nMlGO/P5qIy20m', 0),
(33, 'pepe@gmail.com', 'pepê', 'Porto', '0', 0, '$2y$10$6vz2fpehrh58U14qQSkDyeoutz3xEcLYuGchf.YQNMsQXf91V1YMW', 0),
(34, 'pepe@gmail.com', 'pepê', 'Porto', '0', 0, '$2y$10$ES9PuKhYP3Zq2jHwBkjO5ONMash7idVgu7nbldaUBn24Hcz1/6JvW', 0),
(36, 'calvo@gmail.com', 'calvo', 'calvice', '0', 0, '$2y$10$6iyEEeYiv00POJ.9Dgg8OeTj2lzpaA8ZCA1b6PPSZ7HahXwLbdoO.', 0),
(37, 'lucas@gmail.com', 'lucas', 'cu', '0', 0, '$2y$10$j7w5FX.tclzguu4ZldXVyOCVbyFuesCE3ghkvDpVdqp/Rt9MvQAlG', 0),
(38, 'erro@gmail.com', 'erro', 'erro', '0', 0, '$2y$10$yA1Zt4TlZ9nNFE7sy/SPbuOb85hJayjWFcsLKZcWD/f0.w6hH2zmi', 0),
(39, 'gaga@gmail.com', 'gaga', 'gaga', '0', 0, '$2y$10$cSaoapHN7FI1uUYRL8JK.uYzphCwTWIApZy2hwY5cCLivpFQBdpHO', 0),
(40, 'fafa@gmail.com', 'fafa', 'fafa', '0', 0, '$2y$10$KO5dx7Zb.yoH1vBO3zsZbes7VCQ89pYrlybpEQ3Y7DneyA8YxnVSK', 0),
(41, 'pepê@gmail.com', 'pepe', 'Estadio do Dragão', '0', 0, '$2y$10$K3D/zzcXVln2VFFoyesE9.qFlFs4Cz0ef4oW2C6DUoSTmajCEEQmS', 0),
(42, 'Phs07070706@gmail.com', 'Phs', 'Porto', '0', 0, '$2y$10$hu74JDDbycChk8AL8qqqb.sQWQl3KzfArwFeLogImLDrlN41gOPxi', 0),
(43, 'gaitas@gmail.com', 'Gaitinhas', 'Roça', '0', 0, '$2y$10$B7iEJD6Pn9pWEJBas73gle24h.FpRtpgqREKSLWUlTuXuAaRsEdnS', 0),
(44, 'phs070706@gmail.com', 'pedro', 'Travessa de ferreira 76', '0', 0, '$2y$10$LLTjmkdSfGmHPaEKeH98nOR0A0oScpoyuLH8yPOA4wzir2QYS9xqm', 0),
(45, 'ka@gmail.com', 'Ka', 'ka 75', '0', 0, '$2y$10$030ZEpwLP1BkNam5wXeCbeehWTUHQB4bGzgV.w6AeZ8Zb2gZW3GBi', 0),
(46, 'felipe34@gmail.com', 'Felipe21', 'Felipe 12', '0', 0, '$2y$10$TzLmST5InOLxm6bNI1JzA.nS/UD8w/SSE4V.29YfxAWrERL2GdleS', 0),
(47, 'c2@gmail.com', 'Cu', 'Cu', '0', 0, '$2y$10$N6Lls0j8tcRExmuK2U7ifO.Mb96t.bBffQY3LgcMVcSfZ4U6/5l/S', 0),
(48, 'rosangela@gmail.com', 'Rosângela Arcanjo Soares', 'Porto.pt', '0', 120607, '$2y$10$b1N2chTmJqQvYCaeM.e15.8TmEDoUvzHtBgenV3iAl7.EEUQN5jGG', 0),
(49, 'phsoares070706@gmail.com', 'pedro h', 'Travessa de ferreira 76 1º', '0', 70706, '$2y$10$EVzD/51Z55uNrTHZVW0uf.43xNsQGYbyqLCg7iMr178cpHm77LD0G', 0),
(52, 'rato@gmail.com', 'rato', 'rato', '0', 123, '$2y$10$PiCcAUTXkJKbLWc9nluv1OyJEtmATAjRMa3SLfxDvg/4ZG7Tlyu/W', 0),
(53, 'lucas12@gmail.com', 'Lucas', 'Lucas', '0', 986, '$2y$10$G4uqXWPrEMiQLC0GDKHJ9uUUaZdV1eyTZu3hzrcDztiNUnw4F2E0u', 0),
(54, 'paulo7353@gmail.com', 'paulinho', 'belma', '0', 7353, '$2y$10$eOl6al7gheyWBmNKmshHgugu..PxNF7Z8v5jpgTYpkWsK7VcodxD2', 0),
(55, 'langinha1206@gmail.com', 'lanja', 'travessa', '120674', 1206, '$2y$10$Fh7ovH.21rifYBzQF1sK/O90PDmx/e8zk93uxJTNTtIvT/Dfiql7.', 1),
(56, 'phs07@gmail.com', 'pedocaa', 'Santos Pousada', '0', 7077, '$2y$10$V9NwVM/8AH9AUV1lL8GyT.KTt4tnLulxEfLP.DS8snvliddjqoVeG', 0),
(58, 'psilva@gmail.com', 'Paulo Gomes', 'Santos Pousada', '4200', 2030, '$2y$10$Tmoo/e2LqI2KwnKvUqkGKe9P85Kf9aqon2aWVj6h0bVtqVYfJHrFi', 1),
(59, 'calvao@gmail.com', 'Lucas Costa', 'Rua do Covelo, 207', '4200-180', 194582047, '$2y$10$SQc4VS98KNTwUSomTrN24Ol.mY2ITNLK.TUKgX6a0sLcSaicnzKKe', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `codigos_postais`
--
ALTER TABLE `codigos_postais`
  ADD PRIMARY KEY (`cod_postal`);

--
-- Índices para tabela `encomendas`
--
ALTER TABLE `encomendas`
  ADD PRIMARY KEY (`id_encomenda`),
  ADD KEY `id_user` (`id_user`);

--
-- Índices para tabela `linhas_encm`
--
ALTER TABLE `linhas_encm`
  ADD PRIMARY KEY (`id_encomenda`,`id_produto`),
  ADD KEY `fk_carrinho_produto` (`id_produto`);

--
-- Índices para tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_produto`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `fk_users_codigos_postais` (`cod_postal`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `encomendas`
--
ALTER TABLE `encomendas`
  MODIFY `id_encomenda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `codigos_postais`
--
ALTER TABLE `codigos_postais`
  ADD CONSTRAINT `fk_codigos_postais` FOREIGN KEY (`cod_postal`) REFERENCES `users` (`cod_postal`);

--
-- Limitadores para a tabela `encomendas`
--
ALTER TABLE `encomendas`
  ADD CONSTRAINT `encomendas_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Limitadores para a tabela `linhas_encm`
--
ALTER TABLE `linhas_encm`
  ADD CONSTRAINT `fk_carrinho_encomendas` FOREIGN KEY (`id_encomenda`) REFERENCES `encomendas` (`id_encomenda`),
  ADD CONSTRAINT `fk_carrinho_produto` FOREIGN KEY (`id_produto`) REFERENCES `products` (`id_produto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
