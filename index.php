<?php
session_start();
include("includes/db.php");

if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (!in_array($product_id, $_SESSION['cart'])) {
        $_SESSION['cart'][] = $product_id;
    }
}
?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        header {
            background: #007bff;
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header h1 {
            margin: 0;
        }
        header a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }
        .product-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
        }
        .product-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
        }
        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .product-info {
            padding: 15px;
            flex-grow: 1;
        }
        .product-info h3 {
            margin: 0 0 10px;
            font-size: 18px;
        }
        .product-price {
            color: #28a745;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .product-details {
            font-size: 14px;
            color: #555;
            margin-bottom: 15px;
        }
        .product-info form {
            margin-top: auto;
        }
        .product-info button {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        .product-info button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

<header>
    <h1>আমাদের প্রোডাক্ট</h1>
    <a href="cart.php">🛒 Cart (<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>)</a>
</header>

<div class="product-container">
<?php
$result = $conn->query("SELECT * FROM products ORDER BY id DESC");
while ($row = $result->fetch_assoc()) {
    echo "<div class='product-card'>";
    echo "<img src='uploads/{$row['image']}' alt='{$row['name']}'>";
    echo "<div class='product-info'>";
    echo "<h3>{$row['name']}</h3>";
    echo "<div class='product-price'>৳ {$row['price']}</div>";
    echo "<div class='product-details'>{$row['details']}</div>";
    echo "<form method='post'>";
    echo "<input type='hidden' name='product_id' value='{$row['id']}'>";
    echo "<button type='submit' name='add_to_cart'>Add to Cart</button>";
    echo "</form>";
    echo "</div>";
    echo "</div>";
}
?>
</div>

</body>
</html>
