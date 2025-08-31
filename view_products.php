<?php include("../includes/db.php"); ?>

<h2>All Product</h2>
<a href="add_product.php">+ Add New Product</a><br><br>

<table border="1" cellpadding="8">
    <tr>
        <th>Picture</th>
        <th>Name</th>
        <th>Price</th>
        <th>Option</th>
    </tr>
    <?php
    $result = $conn->query("SELECT * FROM products");
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td><img src='../uploads/{$row['image']}' width='80'></td>";
        echo "<td>{$row['name']}</td>";
        echo "<td>{$row['price']}</td>";
        echo "<td><a href='delete_product.php?id={$row['id']}'>Delete</a></td>";
        echo "</tr>";
    }
    ?>
</table>
