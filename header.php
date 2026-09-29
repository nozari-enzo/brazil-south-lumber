<?php
require_once __DIR__ . '/empresa.php';
$empresa = empresa();
?>
<header class="site-header" id="site-header">
  <div class="header-inner">
    <a href="index.php#inicio" class="wordmark">
      <?php if ($empresa['logo']): ?>
      <img src="<?= htmlspecialchars($empresa['logo']) ?>" alt="" class="wordmark-logo">
      <?php endif; ?>
      <span class="wordmark-text">Brazil South<span>Lumber</span></span>
    </a>

    <nav class="main-nav" id="main-nav">
      <a href="index.php#sobre">A serraria</a>
      <a href="produtos.php">Produtos</a>
      <a href="index.php#servicos">Serviços</a>
      <a href="index.php#processo">Processo</a>
      <a href="index.php#contato">Contato</a>
    </nav>

    <a href="orcamento.php" class="btn btn-header">Pedir orçamento</a>

    <button class="menu-toggle" id="menu-toggle" aria-label="Abrir menu" aria-expanded="false" aria-controls="main-nav">
      <span></span><span></span><span></span>
    </button>
  </div>
</header>
