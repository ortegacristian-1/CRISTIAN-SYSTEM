<?php
require_once 'config.php';
require_login();
$products = (int)$pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
$salesCount = (int)$pdo->query("SELECT COUNT(*) FROM sales")->fetchColumn();
$stock = (int)$pdo->query("SELECT COALESCE(SUM(stock),0) FROM products")->fetchColumn();
$income = (float)$pdo->query("SELECT COALESCE(SUM(total),0) FROM sales WHERE DATE(created_at)=CURDATE()")->fetchColumn();
$recent = $pdo->query("SELECT id,total,created_at FROM sales ORDER BY id DESC LIMIT 5")->fetchAll();
$pageTitle = "Panel principal";
require 'header.php';
?>
<div class="welcome">
  <div><span class="eyebrow">PANEL DE CONTROL</span><h1>Bienvenido a CRISTIAN SYSTEM</h1><p>Administra tus productos, inventario y ventas desde un solo lugar.</p></div>
  <a class="btn btn-light" href="sale_new.php">＋ Nueva venta</a>
</div>
<div class="stats">
  <div class="stat"><span>Productos registrados</span><strong><?= $products ?></strong><small>En el catálogo</small></div>
  <div class="stat"><span>Unidades en inventario</span><strong><?= $stock ?></strong><small>Stock total</small></div>
  <div class="stat"><span>Ventas realizadas</span><strong><?= $salesCount ?></strong><small>Ventas registradas</small></div>
  <div class="stat"><span>Ventas de hoy</span><strong><?= money($income) ?></strong><small>Ingresos del día</small></div>
</div>
<section class="panel">
  <div class="panel-head"><div><h2>Ventas recientes</h2><p>Últimas operaciones registradas</p></div><a href="sales.php" class="text-link">Ver todas →</a></div>
  <?php if (!$recent): ?><div class="empty">Todavía no hay ventas registradas.</div><?php else: ?>
  <div class="table-wrap"><table><thead><tr><th>N.º</th><th>Fecha</th><th>Total</th></tr></thead><tbody>
  <?php foreach($recent as $r): ?><tr><td>#<?= (int)$r['id'] ?></td><td><?= h($r['created_at']) ?></td><td><b><?= money($r['total']) ?></b></td></tr><?php endforeach; ?>
  </tbody></table></div><?php endif; ?>
</section>
<?php require 'footer.php'; ?>
