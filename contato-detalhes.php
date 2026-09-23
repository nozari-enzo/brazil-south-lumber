<?php
// contato-detalhes.php
// Lista de contatos da serraria, usada na página inicial e na de orçamento.
// Os dados vêm de empresa.php.
require_once __DIR__ . '/empresa.php';
$empresa = empresa();
?>
<dl class="contact-details">
  <div>
    <dt><?= $empresa['whatsapp'] ? 'Telefone / WhatsApp' : 'Telefone' ?></dt>
    <dd>
      <a href="tel:<?= htmlspecialchars($empresa['telefone_link']) ?>"><?= htmlspecialchars($empresa['telefone']) ?></a>
      <?php if ($empresa['whatsapp']): ?>
      · <a href="https://wa.me/<?= htmlspecialchars($empresa['whatsapp']) ?>" target="_blank" rel="noopener">WhatsApp</a>
      <?php endif; ?>
    </dd>
  </div>
  <div>
    <dt>E-mail</dt>
    <dd><a href="mailto:<?= htmlspecialchars($empresa['email']) ?>"><?= htmlspecialchars($empresa['email']) ?></a></dd>
  </div>
  <div>
    <dt>Endereço</dt>
    <dd><?= htmlspecialchars($empresa['endereco']) ?><br><?= htmlspecialchars($empresa['cidade']) ?></dd>
  </div>
  <div>
    <dt>Horário</dt>
    <dd><?= htmlspecialchars($empresa['horario']) ?></dd>
  </div>
  <?php if ($empresa['instagram'] || $empresa['facebook']): ?>
  <div>
    <dt>Redes sociais</dt>
    <dd>
      <?php if ($empresa['instagram']): ?>
      <a href="<?= htmlspecialchars($empresa['instagram']) ?>" target="_blank" rel="noopener">Instagram</a>
      <?php endif; ?>
      <?php if ($empresa['instagram'] && $empresa['facebook']): ?> · <?php endif; ?>
      <?php if ($empresa['facebook']): ?>
      <a href="<?= htmlspecialchars($empresa['facebook']) ?>" target="_blank" rel="noopener">Facebook</a>
      <?php endif; ?>
    </dd>
  </div>
  <?php endif; ?>
</dl>
