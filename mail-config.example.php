<?php
// mail-config.example.php
//
// Este é só um MODELO. Copie este arquivo, renomeie a cópia para
// "mail-config.php" e preencha com seus dados reais. O "mail-config.php"
// (com dados de verdade) está no .gitignore e NUNCA deve ser enviado pro Git.
//
// Como gerar a senha de app do Gmail:
// 1. Ative a verificação em duas etapas na sua conta Google
//    (myaccount.google.com/security)
// 2. Acesse myaccount.google.com/apppasswords
// 3. Crie uma senha de app (16 caracteres, sem espaços) para "Mail"
// 4. Use essa senha de app abaixo — NUNCA a senha normal da sua conta Google

return [
    'smtp_host'     => 'smtp.gmail.com',
    'smtp_port'     => 587,
    'smtp_user'     => 'seuemail@gmail.com',   // seu Gmail completo
    'smtp_password' => 'xxxx xxxx xxxx xxxx',   // a senha de app de 16 caracteres
    'from_email'    => 'seuemail@gmail.com',   // geralmente igual ao smtp_user
    'from_name'     => 'Site Brazil South Lumber',
    'to_email'      => 'contato@brazilsouthlumber.com.br', // quem recebe os orçamentos
    'to_name'       => 'Brazil South Lumber',
];
