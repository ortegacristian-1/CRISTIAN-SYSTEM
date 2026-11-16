<?php
require_once 'config.php'; require_login();
$sales=$pdo->query("SELECT s.*,u.full_name FROM sales s LEFT JOIN users u ON u.id=s.user_id ORDER BY s.id DESC")->fetchAll();
$pageTitle="Ventas"; require 'header.php';
?>
<div class="page-heading"><div><h1>Ventas</h1><p>Historial de ventas registradas.</p></div><a class="btn btn-primary" href="sale_new.php">＋ Nueva venta</a></div>
<?php if(isset($_GET['ok'])): ?><div class="alert success">La venta se registró correctamente y el inventario fue actualizado.</div><?php endif; ?>
<section class="panel"><div class="table-wrap"><table><thead><tr><th>N.º de venta</th><th>Fecha</th><th>Registrado por</th><th>Total</th></tr></thead><tbody>
<?php if(!$sales): ?><tr><td colspan="4" class="empty">Todavía no hay ventas registradas.</td></tr><?php endif; ?>
<?php foreach($sales as $s): ?><tr><td><b>#<?= (int)$s['id'] ?></b></td><td><?= h($s['created_at']) ?></td><td><?= h($s['full_name']??'Usuario eliminado') ?></td><td><b><?= money($s['total']) ?></b></td></tr><?php endforeach; ?>
</tbody></table></div></section>
<?php require 'footer.php'; ?>
