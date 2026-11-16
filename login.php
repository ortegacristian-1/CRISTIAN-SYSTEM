<?php
require_once 'config.php';
if (!empty($_SESSION['user_id'])) { header('Location: index.php'); exit; }
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $userRow = $stmt->fetch();
    if ($userRow && password_verify($password, $userRow['password'])) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = $userRow['id'];
        $_SESSION['full_name'] = $userRow['full_name'];
        header('Location: index.php'); exit;
    }
    $error = 'Usuario o contraseña incorrectos.';
}
?>
<!doctype html><html lang="es"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Acceso | CRISTIAN SYSTEM</title><link rel="stylesheet" href="assets/style.css"></head>
<body class="login-page"><form class="login-card" method="post">
<div class="login-logo">CS</div><h1>CRISTIAN <b>SYSTEM</b></h1><p>Sistema de ventas e inventario</p>
<?php if($error): ?><div class="alert error"><?= h($error) ?></div><?php endif; ?>
<label>Usuario</label><input name="username" required autofocus placeholder="Ingresa tu usuario">
<label>Contraseña</label><input type="password" name="password" required placeholder="Ingresa tu contraseña">
<button class="btn btn-primary full" type="submit">Iniciar sesión</button>
<div class="login-help">Acceso inicial: <b>admin</b> / <b>admin123</b></div>
</form></body></html>
