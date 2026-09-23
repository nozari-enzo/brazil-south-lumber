<?php
// enviar.php
// Recebe o formulário de orçamento, valida os campos, salva o pedido no
// banco e avisa por e-mail usando PHPMailer + SMTP. Responde sempre em JSON,
// para o script.js mostrar a mensagem certa na própria página, sem recarregar.

header('Content-Type: application/json; charset=utf-8');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/libs/PHPMailer/src/Exception.php';
require __DIR__ . '/libs/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/libs/PHPMailer/src/SMTP.php';
require __DIR__ . '/db.php';

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

// --- coleta e limpeza básica dos campos ---
$nome     = trim($_POST['nome'] ?? '');
$email    = trim($_POST['email'] ?? '');
$telefone = trim($_POST['telefone'] ?? '');
$mensagem = trim($_POST['mensagem'] ?? '');

// --- validação no servidor (nunca confiar só no JS) ---
// os limites máximos batem com o tamanho das colunas em database/schema.sql
$erros = [];

if (mb_strlen($nome) < 2 || mb_strlen($nome) > 120) {
    $erros[] = 'Informe um nome válido.';
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 160) {
    $erros[] = 'Informe um e-mail válido.';
}
if (mb_strlen($telefone) > 30) {
    $erros[] = 'Informe um telefone válido.';
}
if (mb_strlen($mensagem) < 10) {
    $erros[] = 'Conte com mais detalhes o que você precisa.';
}
if (mb_strlen($mensagem) > 5000) {
    $erros[] = 'A mensagem ficou muito longa — resuma em até 5000 caracteres.';
}

// campo-armadilha invisível (honeypot) contra robôs de spam
if (!empty($_POST['campo_extra_kx91'])) {
    // finge sucesso pro robô, mas não envia nada de verdade
    error_log('enviar.php: pedido descartado pelo honeypot (e-mail informado: ' . $email
        . ', campo preenchido com: ' . mb_substr((string) $_POST['campo_extra_kx91'], 0, 60) . ')');
    responder(true, 'Pedido enviado com sucesso.');
}

if (!empty($erros)) {
    responder(false, implode(' ', $erros), 422);
}

// --- salva o pedido no banco (assim nada se perde se o e-mail falhar) ---
$orcamentoId = null;

try {
    $stmt = conectarBanco()->prepare(
        'INSERT INTO orcamentos (nome, email, telefone, mensagem) VALUES (?, ?, ?, ?)'
    );
    $stmt->execute([$nome, $email, $telefone !== '' ? $telefone : null, $mensagem]);
    $orcamentoId = (int) conectarBanco()->lastInsertId();
} catch (Throwable $e) {
    error_log('enviar.php: falha ao salvar orçamento no banco: ' . $e->getMessage());
}

// --- monta e envia o e-mail ---
$emailEnviado = false;

// arquivo de configuração precisa existir (copiado a partir do .example)
$configPath = __DIR__ . '/mail-config.php';
if (!file_exists($configPath)) {
    error_log('enviar.php: mail-config.php ausente. Copie mail-config.example.php para mail-config.php e preencha os dados.');
} else {
    $config = require $configPath;
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
        $mail->Subject = $orcamentoId
            ? "Novo pedido de orçamento pelo site (#{$orcamentoId})"
            : 'Novo pedido de orçamento pelo site';
        $mail->Body =
            "Nome: {$nome}\n" .
            "E-mail: {$email}\n" .
            "Telefone: {$telefone}\n\n" .
            "Mensagem:\n{$mensagem}";

        $mail->send();
        $emailEnviado = true;
    } catch (Exception $e) {
        error_log('enviar.php: falha ao enviar e-mail: ' . $mail->ErrorInfo);
    }
}

// marca no banco que o aviso por e-mail saiu
if ($orcamentoId && $emailEnviado) {
    try {
        conectarBanco()
            ->prepare('UPDATE orcamentos SET email_enviado = 1 WHERE id = ?')
            ->execute([$orcamentoId]);
    } catch (Throwable $e) {
        error_log('enviar.php: falha ao marcar e-mail enviado: ' . $e->getMessage());
    }
}

// basta um dos dois (banco ou e-mail) funcionar para o pedido não se perder
if ($orcamentoId || $emailEnviado) {
    responder(true, 'Pedido enviado com sucesso! Em breve entramos em contato.');
}

responder(false, 'Não foi possível enviar agora. Tente novamente em instantes ou fale por telefone/WhatsApp.', 500);
