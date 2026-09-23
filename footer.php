<?php
require_once __DIR__ . '/empresa.php';
$empresa = empresa();
?>
<footer class="site-footer">
  <div class="footer-inner">
    <?php if ($empresa['logo']): ?>
    <a href="index.php#inicio" class="site-logo site-logo--footer">
      <img src="<?= htmlspecialchars($empresa['logo']) ?>" alt="<?= htmlspecialchars($empresa['nome']) ?>">
    </a>
    <?php else: ?>
    <a href="index.php#inicio" class="wordmark wordmark--footer">Brazil South<span>Lumber</span></a>
    <?php endif; ?>
    <nav class="footer-nav">
      <a href="index.php#sobre">A serraria</a>
      <a href="produtos.php">Produtos</a>
      <a href="index.php#servicos">Serviços</a>
      <a href="index.php#contato">Contato</a>
      <a href="orcamento.php">Orçamento</a>
    </nav>
    <p class="footer-copy">© <span id="ano-atual">2026</span> <?= htmlspecialchars($empresa['nome']) ?>. Todos os direitos reservados.</p>
  </div>
</footer>
