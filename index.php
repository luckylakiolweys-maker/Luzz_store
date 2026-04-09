<?php
include 'db.php';
$result = $conn->query("SELECT * FROM products");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Toko Kopi</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Toko Kopi</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="cart.php">Keranjang</a>
    </nav>
</header>
<main>
    <h2>Daftar Produk</h2>
    <div class="products">
        <?php while($row = $result->fetch_assoc()): ?>
        <div class="product">
            <img src="<?= $row['image'] ?>" alt="<?= $row['name'] ?>">
            <h3><?= $row['name'] ?></h3>
            <p><?= $row['description'] ?></p>
            <p>Rp <?= number_format($row['price'],0,",",".") ?></p>
            <a href="product.php?id=<?= $row['id'] ?>">Detail</a>
        </div>
        <?php endwhile; ?>
    </div>
</main>
</body>
</html>