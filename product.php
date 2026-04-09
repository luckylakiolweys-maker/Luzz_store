<?php
include 'db.php';
$id = $_GET['id'];
$product = $conn->query("SELECT * FROM products WHERE id=$id")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title><?= $product['name'] ?></title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<a href="index.php">← Kembali</a>
<h2><?= $product['name'] ?></h2>
<img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>" style="width:300px">
<p><?= $product['description'] ?></p>
<p>Rp <?= number_format($product['price'],0,",",".") ?></p>
<form action="cart.php" method="post">
    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
    <input type="number" name="quantity" value="1" min="1">
    <button type="submit" name="add_to_cart">Tambahkan ke Keranjang</button>
</form>
</body>
</html>