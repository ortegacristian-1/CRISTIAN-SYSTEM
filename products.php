<?php
require_once 'config.php'; require_login();
$products = $pdo->query("SELECT * FROM products ORDER BY id DESC")->fetchAll();
$pageTitle = "Productos"; require 'header.php';
?>
<div class="page-heading"><div><h1>Productos</h1><p>Registra y controla los productos de tu negocio.</p></div><a class="btn btn-primary" href="product_new.php">＋ Agregar producto</a></div>
<section class="panel"><div class="table-wrap"><table><thead><tr><th>Producto</th><th>Precio</th><th>Stock</th><th>Registro</th></tr></thead><tbody>
<?php if(!$products): ?><tr><td colspan="4" class="empty">No hay productos. Agrega el primero.</td></tr><?php endif; ?>
<?php foreach($products as $p): ?><tr><td><b><?= h($p['name']) ?></b><small class="subline"><?= h($p['description']) ?></small></td><td><?= money($p['price']) ?></td><td><span class="badge <?= $p['stock']<=5?'warning':'' ?>"><?= (int)$p['stock'] ?> unidades</span></td><td><?= h($p['created_at']) ?></td></tr><?php endforeach; ?>
</tbody></table></div></section>
<?php require 'footer.php'; ?>
