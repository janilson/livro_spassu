DROP TABLE IF EXISTS `livro_autor`;
DROP TABLE IF EXISTS `livro_assunto`;
DROP TABLE IF EXISTS `livro`;
DROP TABLE IF EXISTS `assunto`;
DROP TABLE IF EXISTS `autor`;


CREATE TABLE `autor`
(
    `id`   int         NOT NULL AUTO_INCREMENT,
    `nome` varchar(40) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

CREATE TABLE `assunto`
(
    `id`        int         NOT NULL AUTO_INCREMENT,
    `descricao` varchar(20) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

CREATE TABLE `livro`
(
    `id`             int         NOT NULL AUTO_INCREMENT,
    `titulo`         varchar(40) NOT NULL,
    `editora`        varchar(40) NOT NULL,
    `edicao`         varchar(2)  NOT NULL,
    `ano_publicacao` varchar(4)  NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

CREATE TABLE `livro_assunto`
(
    `id`         int NOT NULL AUTO_INCREMENT,
    `livro_id`   int NOT NULL,
    `assunto_id` int NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `UK_livro_autor` (`livro_id`, `assunto_id`),
    KEY `FK_livro_assunto_livro` (`livro_id`),
    KEY `FK_livro_assunto_assunto` (`assunto_id`),
    CONSTRAINT `FK_livro_assunto_livro` FOREIGN KEY (`livro_id`) REFERENCES `livro` (`id`),
    CONSTRAINT `FK_livro_assunto_autor` FOREIGN KEY (`assunto_id`) REFERENCES `assunto` (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

CREATE TABLE `livro_autor`
(
    `id`       int NOT NULL AUTO_INCREMENT,
    `livro_id` int NOT NULL,
    `autor_id` int NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `UK_livro_autor` (`livro_id`, `autor_id`),
    KEY `FK_livro_autor_livro` (`livro_id`),
    KEY `FK_livro_autor_autor` (`autor_id`),
    CONSTRAINT `FK_livro_autor_livro` FOREIGN KEY (`livro_id`) REFERENCES `livro` (`id`),
    CONSTRAINT `FK_livro_autor_autor` FOREIGN KEY (`autor_id`) REFERENCES `autor` (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;


CREATE OR REPLACE VIEW vw_autor_livros AS
SELECT au.nome,
       l.titulo,
       l.editora,
       l.edicao,
       l.ano_publicacao,
       GROUP_CONCAT(CONCAT(assu.descricao) ORDER BY assu.descricao SEPARATOR ', ') assuntos
  FROM autor au
  JOIN livro_autor lau
    ON lau.autor_id = au.id
  JOIN livro l
    ON l.id = lau.livro_id
  JOIN livro_assunto lassu
    ON lassu.livro_id = l.id
  JOIN assunto assu
    ON assu.id = lassu.assunto_id
 GROUP BY au.nome,
          l.titulo,
          l.editora,
          l.edicao,
          l.ano_publicacao;
