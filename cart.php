<?php
session_start();
include("includes/db.php");

if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    if (($key = array_search($remove_id, $_SESSION['cart'])) !== false) {
        unset($_SESSION['cart'][$key]);
    }
}

?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>My Cart</title>
</head>
<body>
<h2>🛒 Your Cart</h2>
<a href="index.php">⬅ Back Product</a><br><br>

<?php
if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    $ids = implode(",", $_SESSION['cart']);
    $result = $conn->query("SELECT * FROM products WHERE id IN ($ids)");
    while ($row = $result->fetch_assoc()) {
        echo "<div style='border:1px solid #ccc; padding:10px; margin:10px;'>";
        echo "<img src='uploads/{$row['image']}' width='100'><br>";
        echo "<strong>{$row['name']}</strong><br>";
        echo "৳ {$row['price']}<br>";
        echo "<a href='cart.php?remove={$row['id']}'>❌ Remove</a>";
        echo "</div>";
    }
} else {
    echo "Your Cart is Empty";
}
?>
</body>
</html>
