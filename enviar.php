<?php
// enviar.php
// Recebe o formulário de orçamento, valida os campos e envia por e-mail
// usando PHPMailer + SMTP. Responde sempre em JSON, para o script.js
// mostrar a mensagem certa na própria página, sem recarregar.

header('Content-Type: application/json; charset=utf-8');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/libs/PHPMailer/src/Exception.php';
require __DIR__ . '/libs/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/libs/PHPMailer/src/SMTP.php';

function responder(bool $sucesso, string $mensagem, int $statusHttp = 200): void
{
    http_response_code($statusHttp);
    echo json_encode(['success' => $sucesso, 'message' => $mensagem]);
    exit;
}

// só aceita POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    responder(false, 'Método não permitido.', 405);
}

// arquivo de configuração precisa existir (copiado a partir do .example)
$configPath = __DIR__ . '/mail-config.php';
if (!file_exists($configPath)) {
    responder(false, 'Configuração de e-mail ausente no servidor. Copie mail-config.example.php para mail-config.php e preencha os dados.', 500);
}
$config = require $configPath;

// --- coleta e limpeza básica dos campos ---
$nome     = trim($_POST['nome'] ?? '');
$email    = trim($_POST['email'] ?? '');
$telefone = trim($_POST['telefone'] ?? '');
$mensagem = trim($_POST['mensagem'] ?? '');

// --- validação no servidor (nunca confiar só no JS) ---
$erros = [];

if (mb_strlen($nome) < 2) {
    $erros[] = 'Informe um nome válido.';
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $erros[] = 'Informe um e-mail válido.';
}
if (mb_strlen($mensagem) < 10) {
    $erros[] = 'Conte com mais detalhes o que você precisa.';
}

// campo-armadilha invisível (honeypot) contra robôs de spam
if (!empty($_POST['campo_extra_kx91'])) {
    // finge sucesso pro robô, mas não envia nada de verdade
    responder(true, 'Pedido enviado com sucesso.');
}

if (!empty($erros)) {
    responder(false, implode(' ', $erros), 422);
}

// --- monta e envia o e-mail ---
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = $config['smtp_host'];
    $mail->SMTPAuth   = true;
    $mail->Username   = $config['smtp_user'];
    $mail->Password   = $config['smtp_password'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = $config['smtp_port'];
    $mail->CharSet    = 'UTF-8';

    $mail->setFrom($config['from_email'], $config['from_name']);
    $mail->addAddress($config['to_email'], $config['to_name']);
    $mail->addReplyTo($email, $nome);

    $mail->isHTML(false);
    $mail->Subject = 'Novo pedido de orçamento pelo site';
    $mail->Body =
        "Nome: {$nome}\n" .
        "E-mail: {$email}\n" .
        "Telefone: {$telefone}\n\n" .
        "Mensagem:\n{$mensagem}";

    $mail->send();

    responder(true, 'Pedido enviado com sucesso! Em breve entramos em contato.');
} catch (Exception $e) {
    responder(false, 'Não foi possível enviar agora. Tente novamente em instantes ou fale por telefone/WhatsApp.', 500);
}
