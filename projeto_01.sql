-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 25-Ago-2019 às 06:26
-- Versão do servidor: 10.1.39-MariaDB
-- versão do PHP: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projeto_01`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_admin.online`
--

CREATE TABLE `tb_admin.online` (
  `id` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `ultima_acao` datetime NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_admin.online`
--

INSERT INTO `tb_admin.online` (`id`, `ip`, `ultima_acao`, `token`) VALUES
(9, '::1', '2019-08-25 01:14:32', '5d620903f0dfd');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_admin.usuarios`
--

CREATE TABLE `tb_admin.usuarios` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cargo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_admin.usuarios`
--

INSERT INTO `tb_admin.usuarios` (`id`, `user`, `password`, `img`, `nome`, `cargo`) VALUES
(1, 'admin', 'admin', '5d4616968d753.jpg', 'Matheus F. Siqueira', 2),
(2, 'user', 'user', '5d4617fa5cf5a.jpg', 'User', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_admin.visitas`
--

CREATE TABLE `tb_admin.visitas` (
  `id` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `dia` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_admin.visitas`
--

INSERT INTO `tb_admin.visitas` (`id`, `ip`, `dia`) VALUES
(1, '::1', '2019-08-02'),
(2, '::1', '2019-08-24');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.categorias`
--

CREATE TABLE `tb_site.categorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_site.categorias`
--

INSERT INTO `tb_site.categorias` (`id`, `nome`, `slug`, `order_id`) VALUES
(4, 'Geral', 'geral', 4),
(5, 'Cotidiano', 'cotidiano', 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.config`
--

CREATE TABLE `tb_site.config` (
  `titulo` varchar(255) NOT NULL,
  `nome_autor` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `icone1` varchar(255) NOT NULL,
  `descricao1` text NOT NULL,
  `icone2` varchar(255) NOT NULL,
  `descricao2` text NOT NULL,
  `icone3` varchar(255) NOT NULL,
  `descricao3` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_site.config`
--

INSERT INTO `tb_site.config` (`titulo`, `nome_autor`, `descricao`, `icone1`, `descricao1`, `icone2`, `descricao2`, `icone3`, `descricao3`) VALUES
('Projeto Site Dinâmico', 'Matheus Ferreira', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur porttitor tortor turpis, ac eleifend mi interdum vestibulum. Sed eget arcu maximus nulla ullamcorper semper. Nunc vel magna feugiat, aliquam turpis eu, vestibulum ligula. Proin quis purus a quam hendrerit interdum. Curabitur sagittis commodo arcu, quis tempus ligula pretium mattis. Vestibulum ante turpis, porta dictum rutrum in, pulvinar ac purus. Nulla imperdiet pharetra ex at commodo. Sed tristique vestibulum consectetur.\r\n\r\nVivamus ut diam odio. Quisque quis eros tellus. Morbi mattis mauris sed vehicula scelerisque. Morbi quis fermentum augue. Suspendisse vel mi molestie, placerat diam at, placerat mi. Aliquam augue magna, mattis sit amet arcu blandit, malesuada pretium ligula. Aliquam malesuada cursus rhoncus. Ut odio orci, vehicula sit amet turpis finibus, facilisis ornare leo. Vestibulum vestibulum arcu ac lectus tempus pretium. Maecenas porta rhoncus arcu, ac porttitor dolor interdum a. Duis ullamcorper vitae sem ut rutrum.', 'fab fa-css3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur porttitor tortor turpis, ac eleifend mi interdum vestibulum. Sed eget arcu maximus nulla ullamcorper semper.', 'fab fa-html5', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur porttitor tortor turpis, ac eleifend mi interdum vestibulum. Sed eget arcu maximus nulla ullamcorper semper.', 'fab fa-js-square', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur porttitor tortor turpis, ac eleifend mi interdum vestibulum. Sed eget arcu maximus nulla ullamcorper semper.');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.depoimentos`
--

CREATE TABLE `tb_site.depoimentos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `depoimento` text NOT NULL,
  `data` date NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_site.depoimentos`
--

INSERT INTO `tb_site.depoimentos` (`id`, `nome`, `depoimento`, `data`, `order_id`) VALUES
(1, 'Fulano 1', 'Depoimento 1', '2019-08-03', 1),
(2, 'Fulano 2', 'Depoimento 2', '2019-08-03', 2),
(3, 'Fulano 3', 'Depoimento 3', '2019-08-03', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.noticias`
--

CREATE TABLE `tb_site.noticias` (
  `id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `data` date NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `conteudo` text NOT NULL,
  `capa` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_site.noticias`
--

INSERT INTO `tb_site.noticias` (`id`, `categoria_id`, `data`, `titulo`, `conteudo`, `capa`, `slug`, `order_id`) VALUES
(15, 4, '2019-08-07', 'Lorem Ipsum', '<h1 style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;\">T&Iacute;TULO DE TESTE</h1>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum blandit gravida condimentum. Praesent leo nibh, sodales ut feugiat at, ultrices vel nibh. Quisque vel pharetra odio, a euismod nibh. Cras sollicitudin condimentum dolor in scelerisque. Aenean pulvinar viverra ipsum, eu vehicula orci convallis ac. Ut id nisi sit amet magna scelerisque scelerisque vitae ac odio. Nulla porta ac nulla vel sagittis. Nam porttitor vestibulum urna, eget volutpat mauris euismod quis. Phasellus auctor vel nulla vel porta. Nulla nisl purus, bibendum interdum leo sed, eleifend pharetra tellus. Donec nisl odio, volutpat eu rutrum et, porta eu orci. Morbi malesuada urna eget dui lobortis, vel gravida felis luctus. Mauris tristique libero in nibh laoreet ultricies.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;\">Quisque id mi at erat vestibulum laoreet. Nunc ac arcu ut quam finibus lobortis non in sem. Fusce placerat in augue ac aliquam. Pellentesque et porttitor sem. Donec vehicula ex eu magna fringilla ullamcorper. Phasellus luctus laoreet porttitor. Donec dolor lacus, vehicula sit amet urna sit amet, imperdiet interdum sapien. Pellentesque egestas a purus quis pretium. Mauris imperdiet ex augue, vitae varius diam iaculis a. Nulla at magna ullamcorper nunc lacinia ultricies. Donec nec hendrerit orci. In hac habitasse platea dictumst. Nulla varius magna felis.</p>\r\n<p><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"http://consciencia.net/img/2014/03/cotidiano2.jpg\" alt=\"Resultado de imagem para imagem cotidiano\" /></p>\r\n<p><span style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #ffffff;\">In hac habitasse platea dictumst. Integer accumsan vestibulum malesuada. Nullam id orci vel leo ornare malesuada. Nam hendrerit felis sed sapien faucibus laoreet vel eget sem. Aenean vehicula euismod lacus, a iaculis orci ornare eget. Proin non nisi sed tortor iaculis consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus mi sem, ac consequat ante ornare eget. Morbi a convallis magna. Ut vel leo et dui gravida ultrices. Sed lobortis leo pellentesque justo vestibulum vulputate. Vivamus vulputate dui eu tellus malesuada, in efficitur ex iaculis. Maecenas maximus tristique diam, ac eleifend nulla mollis in. Integer in vehicula erat.</span></p>\r\n<p>&nbsp;</p>', '5d4b7f4eedd78.jpg', 'lorem-ipsum', 15),
(16, 5, '2019-08-25', 'Governo autoriza uso das Forças Armadas no PA; Quatro Estados já pediram auxílio', '<p><span style=\"color: #4d4d4d; font-family: UOLText, Arial, sans-serif; font-size: 18px;\"><img style=\"font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Oxygen, Ubuntu, Cantarell, \'Open Sans\', \'Helvetica Neue\', sans-serif;\" src=\"https://img.r7.com/images/amazonia-queimada-23082019164644749?dimensions=460x305\" alt=\"Resultado de imagem para amazonia\" /></span></p>\r\n<p><span style=\"color: #4d4d4d; font-family: UOLText, Arial, sans-serif; font-size: 18px;\">O governo federal editou mais uma edi&ccedil;&atilde;o extra do Di&aacute;rio Oficial da Uni&atilde;o para autorizar agora o emprego das For&ccedil;as Armadas no Estado do Par&aacute; para Garantia da Lei e da Ordem (GLO). Mais cedo, j&aacute; tinha sido autorizado o uso das For&ccedil;as no Tocantins. </span></p>\r\n<p><span style=\"color: #4d4d4d; font-family: UOLText, Arial, sans-serif; font-size: 18px;\">Agora, j&aacute; s&atilde;o quatro Estados que ter&atilde;o apoio das For&ccedil;as Armadas em a&ccedil;&otilde;es de combate &agrave;s queimadas na regi&atilde;o amaz&ocirc;nica. Na sexta, 23, Roraima e Rond&ocirc;nia j&aacute; tinham recebido autoriza&ccedil;&atilde;o. </span></p>\r\n<p><span style=\"color: #4d4d4d; font-family: UOLText, Arial, sans-serif; font-size: 18px;\">O presidente da Rep&uacute;blica, Jair Bolsonaro, assinou na sexta decreto que autoriza o uso das For&ccedil;as Armadas para GLO e para a&ccedil;&otilde;es subsidi&aacute;rias nas &aacute;reas de fronteira, mas terras ind&iacute;genas, em unidades federais de conserva&ccedil;&atilde;o ambiental e </span><span style=\"color: #4d4d4d; font-family: UOLText, Arial, sans-serif; font-size: 18px;\">em outras &aacute;reas da Amaz&ocirc;nia Legal. </span></p>\r\n<p><span style=\"color: #4d4d4d; font-family: UOLText, Arial, sans-serif; font-size: 18px;\">A autoriza&ccedil;&atilde;o, no entanto, est&aacute; condicionada ao requerimento do governador de cada Estado.</span></p>\r\n<p><span style=\"color: #f40b5c;\"><em><span style=\"font-family: UOLText, Arial, sans-serif; font-size: 18px;\">Fonte: UOL</span></em></span></p>', '5d61fd01e2ae8.jpeg', 'governo-autoriza-uso-das-forcas-armadas-no-pa;-quatro-estados-ja-pediram-auxilio', 16),
(17, 5, '2019-08-25', 'No Twitter, ministro do Meio Ambiente volta a provocar presidente francês', '<p><span style=\"color: #4d4d4d; font-family: UOLText, Arial, sans-serif; font-size: 18px;\">O ministro do Meio Ambiente, Ricardo Salles, voltou a provocar o presidente da Fran&ccedil;a, Emmanuel Macron, neste s&aacute;bado, em meio &agrave; repercuss&atilde;o das queimadas na Amaz&ocirc;nia. \"Mais fogo em Angola e Congo do que na Amaz&ocirc;nia.... e o M&iacute;cron n&atilde;o fala nada .... pq ser&aacute; ? ser&aacute; que &eacute; pq eles n&atilde;o concorrem com os ineficientes agricultores franceses?\", escreveu o ministro em sua conta oficial do Twitter.</span></p>\r\n<p><span style=\"color: #4d4d4d; font-family: UOLText, Arial, sans-serif; font-size: 18px;\"> A publica&ccedil;&atilde;o de Salles foi acompanhada do compartilhamento de uma reportagem da ag&ecirc;ncia de not&iacute;cias Bloomberg, que diz que o Brasil est&aacute; em terceiro lugar no mundo em rela&ccedil;&atilde;o &agrave;s queimadas de florestas, atr&aacute;s de Angola e Congo.</span></p>\r\n<p><span style=\"color: #f40b5c;\"><em><span style=\"font-family: UOLText, Arial, sans-serif; font-size: 18px;\">Fonte: UOL</span></em></span></p>', '5d61fe91957fc.jpg', 'no-twitter--ministro-do-meio-ambiente-volta-a-provocar-presidente-frances', 17);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.servicos`
--

CREATE TABLE `tb_site.servicos` (
  `id` int(11) NOT NULL,
  `servico` text NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_site.servicos`
--

INSERT INTO `tb_site.servicos` (`id`, `servico`, `order_id`) VALUES
(1, 'Serviço 1', 1),
(2, 'Serviço 2', 2),
(3, 'Serviço 3', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_sites.slides`
--

CREATE TABLE `tb_sites.slides` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `slide` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_sites.slides`
--

INSERT INTO `tb_sites.slides` (`id`, `nome`, `slide`, `order_id`) VALUES
(1, 'slide1', '5d37bebc2461c.jpg', 1),
(2, 'slide2', '5d37bec10c08b.jpg', 2),
(3, 'slide3', '5d37bec575909.jpg', 3),
(4, 'slide4', '5d37beca45894.jpg', 4),
(5, 'slide5', '5d37beceea657.jpg', 5),
(6, 'Slide teste', '5d4615ff327a1.jpg', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin.online`
--
ALTER TABLE `tb_admin.online`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_admin.usuarios`
--
ALTER TABLE `tb_admin.usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_admin.visitas`
--
ALTER TABLE `tb_admin.visitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_site.categorias`
--
ALTER TABLE `tb_site.categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_site.depoimentos`
--
ALTER TABLE `tb_site.depoimentos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_site.noticias`
--
ALTER TABLE `tb_site.noticias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_site.servicos`
--
ALTER TABLE `tb_site.servicos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_sites.slides`
--
ALTER TABLE `tb_sites.slides`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin.online`
--
ALTER TABLE `tb_admin.online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_admin.usuarios`
--
ALTER TABLE `tb_admin.usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_admin.visitas`
--
ALTER TABLE `tb_admin.visitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_site.categorias`
--
ALTER TABLE `tb_site.categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_site.depoimentos`
--
ALTER TABLE `tb_site.depoimentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_site.noticias`
--
ALTER TABLE `tb_site.noticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tb_site.servicos`
--
ALTER TABLE `tb_site.servicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_sites.slides`
--
ALTER TABLE `tb_sites.slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
