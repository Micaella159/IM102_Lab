<?php
require_once 'config.php';
require_once 'auth.php';
requireAdmin();
include 'navbar.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);
    $price = (float) $_POST['price'];
    $stock = (int) $_POST['stock'];
    $category_id = (int) $_POST['category_id'];
    $supplier_id = (int) $_POST['supplier_id'];

    $added_by = $_SESSION['user_id'];

    if (
        empty($name) ||
        empty($description) ||
        empty($price) ||
        empty($stock)
    ) {
        $message = '<div class="error">All fields are required.</div>';
    } else {

        $sql = "INSERT INTO products
        (name, description, price, stock,
        category_id, supplier_id, added_by)
        VALUES
        (
        '$name',
        '$description',
        '$price',
        '$stock',
        '$category_id',
        '$supplier_id',
        '$added_by'
        )";

        if ($conn->query($sql)) {
            header("Location: index.php");
            exit;
        } else {
            $message = '<div class="error">' . htmlspecialchars($conn->error) . '</div>';
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Product</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container">

        <h1>Add Product</h1>

        <?= $message ?>

        <form method="POST">

            <label>Product Name</label>
            <input type="text" name="name" required>

            <label>Description</label>
            <textarea name="description" rows="4" required></textarea>

            <label>Price</label>
            <input type="number" name="price" step="0.01" required>

            <label>Stock</label>
            <input type="number" name="stock" required>

            <label>Category ID</label>
            <input type="number" name="category_id" required>

            <label>Supplier ID</label>
            <input type="number" name="supplier_id" required>

            <button type="submit">
                Add Product
            </button>

            <a href="index.php" class="cancel">
                Cancel
            </a>

        </form>

    </div>

</body>

</html>