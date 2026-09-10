<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Solicitar orçamento — Brazil South Lumber</title>
<meta name="description" content="Peça um orçamento de madeira serrada, vigas, tábuas ou paletes com a Brazil South Lumber. Respondemos em até 1 dia útil.">
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
      <h1>Solicitar orçamento</h1>
      <p>Conta pra gente o volume e a bitola que você precisa — respondemos em até 1 dia útil.</p>
    </div>
  </section>

  <!-- FORMULÁRIO DE ORÇAMENTO -->
  <section class="contact">
    <div class="contact-inner">
      <div class="contact-info">
        <h2>Prefere falar direto?</h2>
        <p>Também atendemos por telefone e e-mail, no horário comercial.</p>

        <dl class="contact-details">
          <div>
            <dt>Telefone / WhatsApp</dt>
            <dd><a href="tel:+554700000000">(47) 0000-0000</a></dd>
          </div>
          <div>
            <dt>E-mail</dt>
            <dd><a href="mailto:contato@serrariabomcorte.com.br">contato@serrariabomcorte.com.br</a></dd>
          </div>
          <div>
            <dt>Endereço</dt>
            <dd>RS-020, Km 98 - 3025 - Industrial<br>São Francisco de Paula - RS, 95400-000</dd>
          </div>
          <div>
            <dt>Horário</dt>
            <dd>Segunda a sexta, 7h30 às 17h30</dd>
          </div>
        </dl>
      </div>

      <form class="contact-form" id="contact-form" action="enviar.php" method="POST" novalidate>
        <input type="text" name="website" class="hp-field" tabindex="-1" autocomplete="off" aria-hidden="true">

        <div class="form-row">
          <label for="nome">Nome</label>
          <input type="text" id="nome" name="nome" autocomplete="name" required>
          <span class="form-error" data-error-for="nome"></span>
        </div>

        <div class="form-row">
          <label for="email">E-mail</label>
          <input type="email" id="email" name="email" autocomplete="email" required>
          <span class="form-error" data-error-for="email"></span>
        </div>

        <div class="form-row">
          <label for="telefone">Telefone</label>
          <input type="tel" id="telefone" name="telefone" autocomplete="tel">
        </div>

        <div class="form-row">
          <label for="mensagem">O que você precisa? (produto, bitola, volume)</label>
          <textarea id="mensagem" name="mensagem" rows="4" required></textarea>
          <span class="form-error" data-error-for="mensagem"></span>
        </div>

        <button type="submit" class="btn btn-primary btn-form">Enviar pedido</button>
        <p class="form-status" id="form-status" role="status" aria-live="polite"></p>
      </form>
    </div>
  </section>

</main>

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>
</body>
</html>
