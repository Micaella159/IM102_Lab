<?php
require_once 'db.php';

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
        INSERT INTO products
        (
            name,
            description,
            price,
            stock,
            category_id,
            supplier_id
        )
        VALUES
        (
            '$name',
            '$description',
            $price,
            $stock,
            $category_id,
            $supplier_id
        )
    ";

    $conn->query($sql);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="container">

    <h2>Add Product</h2>

    <form method="POST">

        <label>Product Name</label><br>
        <input type="text" name="name" required>
        <br><br>

        <label>Description</label><br>
        <textarea name="description" required></textarea>
        <br><br>

        <label>Price</label><br>
        <input type="number" step="0.01" name="price" required>
        <br><br>

        <label>Stock</label><br>
        <input type="number" name="stock" required>
        <br><br>

        <label>Category</label><br>
        <select name="category_id" required>
            <option value="">Select Category</option>
            <?php while($cat = $categories->fetch_assoc()): ?>
                <option value="<?= $cat['id'] ?>">
                    <?= $cat['name'] ?>
                </option>
            <?php endwhile; ?>
        </select>
        <br><br>

        <label>Supplier</label><br>
        <select name="supplier_id" required>
            <option value="">Select Supplier</option>
            <?php while($sup = $suppliers->fetch_assoc()): ?>
                <option value="<?= $sup['id'] ?>">
                    <?= $sup['name'] ?>
                </option>
            <?php endwhile; ?>
        </select>
        <br><br>

        <button type="submit">Save Product</button>
        <a href="index.php">Back</a>

    </form>

</div>

</body>
</html>