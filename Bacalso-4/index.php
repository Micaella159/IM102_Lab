<?php
require_once 'auth.php';
requireLogin();

require_once 'config.php';
include 'navbar.php';

$search = $_GET['search'] ?? '';

$sql = "
SELECT
    p.id,
    p.product_name,
    p.description,
    p.price,
    p.quantity,
    c.name AS category,
    s.name AS supplier,
    u.username AS added_by,
    p.created_at
FROM products p
JOIN categories c ON p.category_id = c.id
JOIN suppliers s ON p.supplier_id = s.id
LEFT JOIN users u ON p.added_by = u.id
WHERE 1=1
";
$result = mysqli_query($conn, $sql);
if (!empty($search)) {
    $safeSearch = $conn->real_escape_string($search);

    $sql .= "
    AND p.product_name LIKE '%$safeSearch%'
     OR p.description LIKE '%$safeSearch%'
)
    ";
}

$sql .= " ORDER BY p.product_name";

$products = $conn->query($sql);
?>

<!DOCTYPE html>

<html>

<head>
    <title>Inventory System</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container">

        <h2>Inventory Products</h2>

        <form method="GET">

            <input type="text" name="search" placeholder="Search products..." value="<?= htmlspecialchars($search) ?>">

            <button type="submit">
                Search
            </button>

            <a href="add.php">
                + Add Product
            </a>

        </form>

    </div>

    <br>

    <table>

        <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Added By</th>
            <th>Actions</th>
        </tr>

        <?php while ($row = $products->fetch_assoc()): ?>

            <tr>

                <td><?= $row['id']; ?></td>

                <td><?= htmlspecialchars($row['product_name']); ?></td>

                <td>₱<?= number_format($row['price'], 2); ?></td>

                <td><?= $row['quantity']; ?></td>

                <td><?= htmlspecialchars($row['added_by'] ?? 'Unknown'); ?></td>

                <td>
                    <a href="edit.php?id=<?= $row['id']; ?>">Edit</a>
                    
                    <a href="delete.php?id=<?= $row['id']; ?>" onclick="return confirm('Delete this product?');">
                        Delete
                    </a>
                </td>
                </a>
                </td>

            </tr>

        <?php endwhile; ?>

    </table>

</body>

</html>