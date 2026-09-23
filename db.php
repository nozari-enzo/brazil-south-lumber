<?php
// db.php
// Abre a conexão com o MySQL usando PDO. Use conectarBanco() em qualquer
// página que precise do banco — a conexão é criada uma vez só por requisição.

function conectarBanco(): PDO
{
    static $pdo = null;

    if ($pdo !== null) {
        return $pdo;
    }

    // arquivo de configuração precisa existir (copiado a partir do .example)
    $configPath = __DIR__ . '/db-config.php';
    if (!file_exists($configPath)) {
        throw new RuntimeException('db-config.php ausente. Copie db-config.example.php para db-config.php e preencha os dados.');
    }
    $config = require $configPath;

    $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['database']};charset=utf8mb4";

    $pdo = new PDO($dsn, $config['user'], $config['password'], [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]);

    return $pdo;
}
