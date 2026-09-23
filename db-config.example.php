<?php
// db-config.example.php
//
// Este é só um MODELO. Copie este arquivo, renomeie a cópia para
// "db-config.php" e preencha com os dados reais do seu MySQL. O "db-config.php"
// (com dados de verdade) está no .gitignore e NUNCA deve ser enviado pro Git.

return [
    'host'     => '127.0.0.1',
    'port'     => 3306,
    'database' => 'brazil_south_lumber',
    'user'     => 'root',          // no servidor de produção, use um usuário próprio do site
    'password' => '',              // a senha do usuário acima
];
