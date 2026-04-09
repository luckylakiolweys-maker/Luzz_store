<?php
session_start();
include 'db.php';

if(isset($_POST['add_to_cart'])){
    $id = $_POST['product_id'];
    $qty = $_POST['quantity'];
    if(isset($_SESSION['cart'][$id])){
        $_SESSION['cart'][$id] += $qty;
    } else {
        $_SESSION['cart'][$id] = $qty;
    }
}

if(isset($_POST['checkout'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $total = 0;
    foreach($_SESSION['cart'] as $pid => $qty){
        $p = $conn->query("SELECT price FROM products WHERE id=$pid")->fetch_assoc();
        $total += $p['price'] * $qty;
    }
    $conn->query("INSERT INTO orders (customer_name,email,address,total) VALUES ('$name','$email','$address',$total)");
    $_SESSION['cart'] = [];
    echo "<p>Pemesanan berhasil!</p>";
}

$cart_items = $_SESSION['cart'] ?? [];
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Keranjang</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Keranjang Belanja</h2>
<?php if($cart_items): ?>
<table>
<tr><th>Produk</th><th>Qty</th><th>Harga</th><th>Subtotal</th></tr>
<?php
$total = 0;
foreach($cart_items as $pid=>$qty):
    $p = $conn->query("SELECT * FROM products WHERE id=$pid")->fetch_assoc();
    $subtotal = $p['price'] * $qty;
    $total += $subtotal;
?>
<tr>
<td><?= $p['name'] ?></td>
<td><?= $qty ?></td>
<td>Rp <?= number_format($p['price'],0,",",".") ?></td>
<td>Rp <?= number_format($subtotal,0,",",".") ?></td>
</tr>
<?php endforeach; ?>
<tr><td colspan="3"><strong>Total</strong></td><td><strong>Rp <?= number_format($total,0,",",".") ?></strong></td></tr>
</table>

<h3>Checkout</h3>
<form method="post">
<input type="text" name="name" placeholder="Nama" required>
<input type="email" name="email" placeholder="Email" required>
<textarea name="address" placeholder="Alamat" required></textarea>
<button type="submit" name="checkout">Pesan Sekarang</button>
</form>

<?php else: ?>
<p>Keranjang kosong.</p>
<?php endif; ?>
<a href="index.php">← Lanjut Belanja</a>
</body>
</html>