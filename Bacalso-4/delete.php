<?php
require_once 'config.php';
require_once 'auth.php';

requireAdmin();

$id = (int) ($_GET['id'] ?? 0);

$result = $conn->query("
    SELECT
        p.*,
        c.name AS category,
        s.name AS supplier
    FROM products p
    LEFT JOIN categories c ON p.category_id = c.id
    LEFT JOIN suppliers s ON p.supplier_id = s.id
    WHERE p.id = $id
");

if (!$result || $result->num_rows == 0) {
    die("Product not found.");
}

$product = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $conn->query("
        DELETE FROM products
        WHERE id = $id
    ");

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Delete Product</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php include 'navbar.php'; ?>

    <div class="container">

        <h2>Delete Product</h2>

        <p>
            <strong>Product Name:</strong>
            <?= htmlspecialchars($product['product_name']) ?>
        </p>

        <p>
            <strong>Category:</strong>
            <?= htmlspecialchars($product['category'] ?? 'N/A') ?>
        </p>

        <p>
            <strong>Supplier:</strong>
            <?= htmlspecialchars($product['supplier'] ?? 'N/A') ?>
        </p>

        <p>
            <strong>Price:</strong>
            ₱<?= number_format($product['price'], 2) ?>
        </p>

        <p>
            <strong>Quantity:</strong>
            <?= $product['quantity'] ?>
        </p>

        <p style="color:red; font-weight:bold;">
            Are you sure you want to delete this product?
        </p>

        <form method="POST">

            <button type="submit">
                Yes, Delete
            </button>

            <a href="index.php" class="btn">
                Cancel
            </a>

        </form>

    </div>

</body>

</html>