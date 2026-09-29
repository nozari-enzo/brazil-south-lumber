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
  destaque  VARCHAR(120)  NULL,               -- texto da etiqueta, ex.: "Pedido mínimo: 3 containers"
  imagem    VARCHAR(255)  NULL,               -- caminho da foto, ex.: img/fotos/cercas-pacote.jpg
  ordem     INT           NOT NULL DEFAULT 0, -- menor aparece primeiro
  ativo     TINYINT(1)    NOT NULL DEFAULT 1, -- 0 = escondido do site
  PRIMARY KEY (id),
  UNIQUE KEY uq_produtos_nome (nome)
) ENGINE=InnoDB;

-- produtos iniciais (mesmos de migracoes/001-produtos-reais.sql)
INSERT IGNORE INTO produtos (nome, descricao, destaque, imagem, ordem) VALUES
  ('Madeira serrada bruta de pinus',
   'Tábuas e pranchas de pinus serradas brutas, secas em estufa e embaladas em pacotes cintados e identificados por lote.',
   'Pedido mínimo: 3 containers', 'img/fotos/pacotes-madeira-serrada.jpg', 1),
  ('Cercas de pinus',
   'Tábuas para cerca com ponta chanfrada, cortadas em medida padronizada e empacotadas para exportação.',
   'Pedido mínimo: 3 containers', 'img/fotos/cercas-pacote.jpg', 2),
  ('Madeira para pallets',
   'Tábuas e peças de pinus para a montagem de pallets, cortadas na medida do pedido e secas em estufa.',
   'Pedido mínimo: 3 containers', NULL, 3),
  ('Madeira para móveis',
   'Tábuas de pinus secas em estufa para a fabricação de móveis, cortadas na medida do pedido.',
   'Pedido mínimo: 3 containers', NULL, 4);
