<?php
include 'db.php';

$search = $_GET['search'] ?? '';
$category = $_GET['category'] ?? '';

$sql = "
SELECT
    p.id,
    p.name,
    p.description,
    p.price,
    p.stock,
    c.name AS category,
    s.name AS supplier,
    p.created_at
FROM products p
JOIN categories c ON p.category_id = c.id
JOIN suppliers s ON p.supplier_id = s.id
WHERE 1=1
";

if (!empty($search)) {
    $safeSearch = $conn->real_escape_string($search);

    $sql .= "
    AND (
        p.name LIKE '%$safeSearch%'
        OR p.description LIKE '%$safeSearch%'
    )";
}

if (!empty($category)) {
    $safeCategory = $conn->real_escape_string($category);

    $sql .= "
    AND c.name = '$safeCategory'";
}

$sql .= " ORDER BY p.id";

$products = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inventory System</title>

  <link rel="stylesheet" href="style.css">
</head>
<body>
 <?php include 'navbar.php'; ?>
<div class="container">
<h2>Inventory Products</h2>

<form method="GET">

    <div class="search-bar">

        <input
            type="text"
            name="search"
            placeholder="Search products..."
            value="<?= htmlspecialchars($search) ?>">

        <select name="category">
            <option value="">All Categories</option>

            <?php
            $categories = $conn->query("
                SELECT DISTINCT name
                FROM categories
                ORDER BY name
            ");

            while ($c = $categories->fetch_assoc()):
            ?>
                <option value="<?= $c['name'] ?>"
                    <?= $category == $c['name'] ? 'selected' : '' ?>>
                    <?= $c['name'] ?>
                </option>
            <?php endwhile; ?>
        </select>

        <button type="submit">Filter</button>

    </div>

    <div class="toolbar">
        <a href="add.php" class="btn-add">
            + Add Product
        </a>

        <a href="report.php" class="btn-report">
            📊 Reports
        </a>
    </div>

</form>
</div>
<br>

<table>
    <tr>
        <th>ID</th>
        <th>Product</th>
        <th>Description</th>
        <th>Price</th>
        <th>Stock</th>
        <th>Category</th>
        <th>Supplier</th>
        <th>Date Added</th>
        <th>Actions</th>
    </tr>

    <?php while($row = $products->fetch_assoc()) { ?>
    <tr class="<?= $row['stock'] < 20 ? 'low-stock' : '' ?>">
        <td><?= $row['id']; ?></td>
        <td><?= htmlspecialchars($row['name']); ?></td>
        <td><?= htmlspecialchars($row['description']); ?></td>
        <td>₱<?= number_format($row['price'], 2); ?></td>
        <td><?= $row['stock']; ?></td>
        <td><?= htmlspecialchars($row['category']); ?></td>
        <td><?= htmlspecialchars($row['supplier']); ?></td>
      <td><?= $row['created_at']; ?></td>
       <td class="actions">
    <a href="edit.php?id=<?= $row['id']; ?>" class="btn-edit">
        Edit
    </a>

    <a href="delete.php?id=<?= $row['id']; ?>"
       class="btn-delete"
       onclick="return confirm('Delete this product?')">
       Delete
    </a>
</td>
    </tr>
    <?php } ?>

</table>

</body>
</html>