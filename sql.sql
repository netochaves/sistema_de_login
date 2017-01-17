CREATE TABLE `cadastro` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `senha` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `descricao` varchar(1000) DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  PRIMARY KEY(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
