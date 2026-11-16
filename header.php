<?php
if (!isset($pageTitle)) $pageTitle = "Sistema";
?>
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= h($pageTitle) ?> | CRISTIAN SYSTEM</title>
<link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="layout">
<aside class="sidebar">
  <a class="brand" href="index.php"><span class="brand-icon">SIS</span><span>SYSTEM <b>INVE</b><small>VENTAS E INVENTARIO</small></span></a>
  <div class="nav-label">MENÚ PRINCIPAL</div>
  <a class="nav-item <?= basename($_SERVER['PHP_SELF'])==='index.php'?'active':'' ?>" href="index.php">▦ <span>Panel principal</span></a>
  <a class="nav-item <?= in_array(basename($_SERVER['PHP_SELF']),['products.php','product_new.php'])?'active':'' ?>" href="products.php">▤ <span>Productos</span></a>
  <a class="nav-item <?= in_array(basename($_SERVER['PHP_SELF']),['sales.php','sale_new.php'])?'active':'' ?>" href="sales.php">▣ <span>Ventas</span></a>
  <div class="sidebar-bottom"><div class="user-chip"><span class="avatar">A</span><span><?= h($_SESSION['full_name'] ?? 'Administrador') ?><small>Administrador</small></span></div><a class="logout" href="logout.php">↪ Cerrar sesión</a></div>
</aside>
<main class="main">
<header class="topbar"><span><?= h($pageTitle) ?></span><span class="top-user">● Sistema activo</span></header>
<div class="content">
