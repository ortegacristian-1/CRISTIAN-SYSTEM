<?php
declare(strict_types=1);
session_start();

$host = "localhost";
$db   = "cristian_system";
$user = "root";
$pass = "";

try {
    $pdo = new PDO(
        "mysql:host={$host};dbname={$db};charset=utf8mb4",
        $user,
        $pass,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
    );
} catch (PDOException $e) {
    exit("No se pudo conectar con MySQL. Verifica config.php y que hayas importado database.sql. Detalle: " . htmlspecialchars($e->getMessage()));
}

function h($value): string {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}
function money($value): string {
    return 'Bs ' . number_format((float)$value, 2, ',', '.');
}
function require_login(): void {
    if (empty($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }
}
