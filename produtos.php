<?php
// produtos.php
// Lista os produtos ativos cadastrados na tabela "produtos" do banco.
require __DIR__ . '/db.php';

try {
    $produtos = conectarBanco()
        ->query('SELECT nome, descricao, destaque FROM produtos WHERE ativo = 1 ORDER BY ordem, id')
        ->fetchAll();
} catch (Throwable $e) {
    error_log('produtos.php: falha ao carregar produtos: ' . $e->getMessage());
    $produtos = [];
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Produtos — Brazil South Lumber</title>
<meta name="description" content="Madeira serrada, vigas, caibros, tábuas para construção civil e madeira para paletes. Pinus e eucalipto, cortados sob medida pela Brazil South Lumber.">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Zilla+Slab:wght@400;500;600;700&family=Work+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<a href="#conteudo" class="skip-link">Pular para o conteúdo</a>

<?php include 'header.php'; ?>

<main id="conteudo">

  <section class="page-intro">
    <div class="page-intro-inner">
      <a href="index.php" class="breadcrumb-back">← Início</a>
      <h1>Produtos</h1>
      <p>Da estrutura ao acabamento, em pinus e eucalipto — cortados na medida do seu projeto.</p>
    </div>
  </section>

  <!-- PRODUTOS -->
  <section class="products">
    <?php if (empty($produtos)): ?>
    <p class="product-empty">
      Nosso catálogo está sendo atualizado. <a href="orcamento.php">Fale com a gente</a> e conte o que você precisa.
    </p>
    <?php else: ?>
    <div class="product-list">
      <?php foreach ($produtos as $i => $produto): ?>
      <article class="product-row<?= $i % 2 === 1 ? ' product-row--alt' : '' ?>">
        <div class="product-info">
          <h3><?= htmlspecialchars($produto['nome']) ?></h3>
          <p><?= htmlspecialchars($produto['descricao']) ?></p>
          <?php if (!empty($produto['destaque'])): ?>
          <span class="product-tag"><?= htmlspecialchars($produto['destaque']) ?></span>
          <?php endif; ?>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  </section>

  <!-- CTA -->
  <section class="cta-band">
    <div class="cta-band-inner">
      <div>
        <h2>Não achou a bitola que precisa?</h2>
        <p>Fala com a gente — cortamos sob medida a partir de 1 m³.</p>
      </div>
      <a href="orcamento.php" class="btn btn-primary">Solicitar orçamento</a>
    </div>
  </section>

</main>

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>
</body>
</html>
