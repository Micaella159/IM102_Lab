<?php
require_once 'config.php';
require_once 'auth.php';

requireAdmin();

$id = (int) ($_GET['id'] ?? 0);

$result = $conn->query("
    SELECT *
    FROM products
    WHERE id = $id
");

if (!$result || $result->num_rows == 0) {
    die("Product not found.");
}

$product = $result->fetch_assoc();

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $product_name = trim($_POST['product_name']);
    $price = (float) $_POST['price'];
    $quantity = (int) $_POST['quantity'];

    if (
        empty($product_name) ||
        $price <= 0 ||
        $quantity < 0
    ) {
        $message = '<div class="error">Please enter valid product information.</div>';
    } else {

        $product_name = $conn->real_escape_string($product_name);

        $sql = "
        UPDATE products
        SET
            product_name = '$product_name',
            price = '$price',
            quantity = '$quantity'
        WHERE id = $id
        ";

        if ($conn->query($sql)) {
            header("Location: index.php");
            exit;
        } else {
            $message = '<div class="error">Error: ' . htmlspecialchars($conn->error) . '</div>';
        }
    }
}
?>

<!DOCTYPE html>

<html>

<head>
    <title>Edit Product</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php include 'navbar.php'; ?>

    <div class="container">

        <h2>Edit Product</h2>

        <?= $message ?>

        <form method="POST">

            <label>Product Name</label>
            <input type="text" name="product_name" value="<?= htmlspecialchars($product['product_name']) ?>" required>

            <label>Price</label>
            <input type="number" step="0.01" name="price" value="<?= $product['price'] ?>" required>

            <label>Quantity</label>
            <input type="number" name="quantity" value="<?= $product['quantity'] ?>" required>

            <button type="submit" class="btn">
                Update Product
            </button>

            <a href="index.php" class="cancel">
                Cancel
            </a>

        </form>

    </div>

</body>

</html>