<?php
require_once 'config.php'; require_login();
$error='';
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $quantities=$_POST['quantity']??[];
    try {
        $pdo->beginTransaction(); $total=0; $items=[];
        foreach($quantities as $id=>$qty) {
            $qty=(int)$qty; if($qty<=0) continue;
            $st=$pdo->prepare("SELECT * FROM products WHERE id=? FOR UPDATE"); $st->execute([(int)$id]); $p=$st->fetch();
            if(!$p) throw new Exception("Producto no encontrado.");
            if($p['stock']<$qty) throw new Exception("Stock insuficiente para ".$p['name'].".");
            $sub=$qty*(float)$p['price']; $total+=$sub; $items[]=[$p,$qty,$sub];
        }
        if(!$items) throw new Exception("Ingresa al menos una cantidad.");
        $st=$pdo->prepare("INSERT INTO sales(total,user_id) VALUES(?,?)"); $st->execute([$total,$_SESSION['user_id']]); $saleId=(int)$pdo->lastInsertId();
        foreach($items as [$p,$qty,$sub]) {
            $st=$pdo->prepare("INSERT INTO sale_items(sale_id,product_id,quantity,unit_price,subtotal) VALUES(?,?,?,?,?)");
            $st->execute([$saleId,$p['id'],$qty,$p['price'],$sub]);
            $st=$pdo->prepare("UPDATE products SET stock=stock-? WHERE id=?"); $st->execute([$qty,$p['id']]);
        }
        $pdo->commit(); header("Location: sales.php?ok=1"); exit;
    } catch(Throwable $e) { if($pdo->inTransaction()) $pdo->rollBack(); $error=$e->getMessage(); }
}
$products=$pdo->query("SELECT * FROM products WHERE stock>0 ORDER BY name")->fetchAll();
$pageTitle="Nueva venta"; require 'header.php';
?>
<div class="page-heading"><div><h1>Nueva venta</h1><p>Selecciona los productos y sus cantidades.</p></div><a class="btn btn-light" href="sales.php">← Volver</a></div>
<section class="panel"><?php if($error): ?><div class="alert error"><?= h($error) ?></div><?php endif; ?>
<?php if(!$products): ?><div class="empty">No hay productos con stock disponible. Registra productos primero.</div><?php else: ?>
<form method="post"><div class="table-wrap"><table><thead><tr><th>Producto</th><th>Precio</th><th>Disponible</th><th>Cantidad a vender</th></tr></thead><tbody>
<?php foreach($products as $p): ?><tr><td><b><?= h($p['name']) ?></b></td><td><?= money($p['price']) ?></td><td><?= (int)$p['stock'] ?></td><td><input class="qty-input" type="number" name="quantity[<?= (int)$p['id'] ?>]" min="0" max="<?= (int)$p['stock'] ?>" value="0"></td></tr><?php endforeach; ?>
</tbody></table></div><div class="form-actions"><button class="btn btn-primary" type="submit">Registrar venta</button></div></form><?php endif; ?>
</section>
<?php require 'footer.php'; ?>
