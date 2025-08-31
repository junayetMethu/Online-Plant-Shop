<?php include("../includes/db.php"); ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $details = $_POST['details'];
    $price = $_POST['price'];

    // Image upload
    $imageName = null;
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "../uploads/";
        $imageName = time() . "_" . basename($_FILES["image"]["name"]);
        $targetFile = $targetDir . $imageName;
        move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);
    }

    $sql = "INSERT INTO products (name, details, price, image) VALUES ('$name', '$details', '$price', '$imageName')";
    $conn->query($sql);
    header("Location: view_products.php");
}
?>

<h2>Please Add Product</h2>
<form method="POST" enctype="multipart/form-data">
    Name: <input type="text" name="name" required><br>
    Details: <textarea name="details"></textarea><br>
    Price: <input type="number" name="price" step="0.01"><br>
    Picture: <input type="file" name="image"><br>
    <button type="submit">Add Product</button>
</form>
