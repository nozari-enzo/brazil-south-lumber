-- database/migracoes/001-produtos-reais.sql
-- Troca os produtos provisórios pelos produtos reais da serraria e adiciona
-- a foto de cada produto. Rode uma vez em bancos criados antes desta mudança
-- (quem vai criar o banco do zero só precisa do schema.sql). Rodar de novo
-- dá erro no ALTER TABLE, porque a coluna "imagem" já vai existir.

USE brazil_south_lumber;

ALTER TABLE produtos
  ADD COLUMN imagem VARCHAR(255) NULL AFTER destaque;

-- produtos provisórios: ficam escondidos do site, não são apagados.
-- o LIKE pega também o nome gravado com acento corrompido (importação pelo terminal do Windows)
UPDATE produtos SET ativo = 0
WHERE nome IN ('Madeira serrada', 'Vigas e caibros', 'Tábuas para construção civil', 'Madeira para paletes')
   OR nome LIKE 'T%buas para constru%o civil';

INSERT INTO produtos (nome, descricao, destaque, imagem, ordem) VALUES
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
   'Pedido mínimo: 3 containers', NULL, 4)
ON DUPLICATE KEY UPDATE
  descricao = VALUES(descricao),
  destaque  = VALUES(destaque),
  imagem    = VALUES(imagem),
  ordem     = VALUES(ordem),
  ativo     = 1;
