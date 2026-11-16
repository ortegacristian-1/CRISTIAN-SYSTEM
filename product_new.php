<?php
require_once 'config.php'; require_login();
$error='';
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $name=trim($_POST['name']??''); $description=trim($_POST['description']??'');
    $price=(float)($_POST['price']??0); $stock=(int)($_POST['stock']??0);
    if ($name==='' || $price<0 || $stock<0) $error='Completa correctamente los datos.';
    else { $s=$pdo->prepare("INSERT INTO products(name,description,price,stock) VALUES(?,?,?,?)"); $s->execute([$name,$description,$price,$stock]); header('Location: products.php'); exit; }
}
$pageTitle="Agregar producto"; require 'header.php';
?>
<div class="page-heading"><div><h1>Agregar producto</h1><p>Completa la información del nuevo producto.</p></div><a class="btn btn-light" href="products.php">← Volver</a></div>
<section class="panel form-panel"><?php if($error): ?><div class="alert error"><?= h($error) ?></div><?php endif; ?>
<form method="post" class="form-grid">
<div class="field full-field"><label>Nombre del producto</label><input name="name" required maxlength="150" placeholder="Ej. Teclado USB"></div>
<div class="field full-field"><label>Descripción</label><textarea name="description" rows="3" placeholder="Descripción opcional"></textarea></div>
<div class="field"><label>Precio (Bs)</label><input type="number" name="price" min="0" step="0.01" required></div>
<div class="field"><label>Stock inicial</label><input type="number" name="stock" min="0" step="1" required></div>
<div class="full-field"><button class="btn btn-primary" type="submit">Guardar producto</button></div>
</form></section>
<?php require 'footer.php'; ?>
