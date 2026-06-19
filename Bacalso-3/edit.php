<?php
require_once 'db.php';

$id = (int) $_GET['id'];

$productResult = $conn->query("
    SELECT *
    FROM products
    WHERE id = $id
");

$product = $productResult->fetch_assoc();

$categories = $conn->query("
    SELECT id, name
    FROM categories
    ORDER BY name
");

$suppliers = $conn->query("
    SELECT id, name
    FROM suppliers
    ORDER BY name
");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name']);
    $description = trim($_POST['description']);

    $price = (float) $_POST['price'];
    $stock = (int) $_POST['stock'];

    $category_id = (int) $_POST['category_id'];
    $supplier_id = (int) $_POST['supplier_id'];

    $name = $conn->real_escape_string($name);
    $description = $conn->real_escape_string($description);

    $sql = "
        UPDATE products
        SET
            name = '$name',
            description = '$description',
            price = $price,
            stock = $stock,
            category_id = $category_id,
            supplier_id = $supplier_id
        WHERE id = $id
    ";

    $conn->query($sql);

    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="container">
<h2>Edit Product</h2>

<form method="POST">

    <input
        type="text"
        name="name"
        value="<?= $product['name'] ?>"
        required><br><br>

    <textarea
        name="description"
        required><?= $product['description'] ?></textarea><br><br>

    <input
        type="number"
        step="0.01"
        name="price"
        value="<?= $product['price'] ?>"
        required><br><br>

    <input
        type="number"
        name="stock"
        value="<?= $product['stock'] ?>"
        required><br><br>

    <select name="category_id" required>
        <?php while($cat = $categories->fetch_assoc()): ?>
            <option
                value="<?= $cat['id'] ?>"
                <?= $cat['id'] == $product['category_id'] ? 'selected' : '' ?>>
                <?= $cat['name'] ?>
            </option>
        <?php endwhile; ?>
    </select>

    <br><br>

    <select name="supplier_id" required>
        <?php while($sup = $suppliers->fetch_assoc()): ?>
            <option
                value="<?= $sup['id'] ?>"
                <?= $sup['id'] == $product['supplier_id'] ? 'selected' : '' ?>>
                <?= $sup['name'] ?>
            </option>
        <?php endwhile; ?>
    </select>

    <br><br>

    <button type="submit">Update Product</button>

</form>