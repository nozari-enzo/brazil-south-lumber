-- database/schema.sql
-- Cria o banco, as tabelas e os produtos iniciais do site.
-- Pode rodar mais de uma vez sem duplicar nada.

CREATE DATABASE IF NOT EXISTS brazil_south_lumber
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE brazil_south_lumber;

-- pedidos enviados pelo formulário de orçamento
CREATE TABLE IF NOT EXISTS orcamentos (
  id            INT UNSIGNED  NOT NULL AUTO_INCREMENT,
  nome          VARCHAR(120)  NOT NULL,
  email         VARCHAR(160)  NOT NULL,
  telefone      VARCHAR(30)   NULL,
  mensagem      TEXT          NOT NULL,
  email_enviado TINYINT(1)    NOT NULL DEFAULT 0,  -- 1 = o e-mail de aviso saiu
  criado_em     DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  KEY idx_orcamentos_criado_em (criado_em)
) ENGINE=InnoDB;

-- catálogo exibido em produtos.php
CREATE TABLE IF NOT EXISTS produtos (
  id        INT UNSIGNED  NOT NULL AUTO_INCREMENT,
  nome      VARCHAR(120)  NOT NULL,
  descricao TEXT          NOT NULL,
  destaque  VARCHAR(120)  NULL,               -- texto da etiqueta, ex.: "Bitolas de 5x5 a 15x15 cm"
  ordem     INT           NOT NULL DEFAULT 0, -- menor aparece primeiro
  ativo     TINYINT(1)    NOT NULL DEFAULT 1, -- 0 = escondido do site
  PRIMARY KEY (id),
  UNIQUE KEY uq_produtos_nome (nome)
) ENGINE=InnoDB;

-- produtos que já estavam no site
INSERT IGNORE INTO produtos (nome, descricao, destaque, ordem) VALUES
  ('Madeira serrada',
   'Pranchas e pranchões de pinus e eucalipto, verdes ou secos em estufa, cortados na medida do projeto.',
   'Sob encomenda a partir de 1 m³', 1),
  ('Vigas e caibros',
   'Estrutura para telhados e mezaninos, com seções padronizadas ou cortadas sob medida para o seu projeto.',
   'Bitolas de 5x5 a 15x15 cm', 2),
  ('Tábuas para construção civil',
   'Tábuas para forma, guarda-corpo e fechamento, com secagem controlada para reduzir empeno em obra.',
   'Espessuras de 15 a 30 mm', 3),
  ('Madeira para paletes',
   'Blocos, tacos e tábuas para paletização, com volume e prazo pensados para quem embala em escala.',
   'Entrega programada mensal', 4);
