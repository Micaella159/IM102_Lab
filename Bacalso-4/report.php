<?php
require_once 'auth.php';
requireAdmin();
require_once 'config.php';

if (isset($_GET['delete_id'])) {
    $deleteId = (int) $_GET['delete_id'];
    $conn->query("DELETE FROM products WHERE id = $deleteId");
    header("Location: report.php");
    exit;
}

$sql = "
SELECT
    p.id,
    p.product_name,
    p.price,
    p.quantity,
    u.username AS added_by
FROM products p
LEFT JOIN users u ON p.added_by = u.id
ORDER BY p.product_name
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Inventory Reports</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php include 'navbar.php'; ?>

    <div class="container">
        <h2>Inventory Reports</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Added By</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']); ?></td>
                        <td><?= htmlspecialchars($row['product_name']); ?></td>
                        <td>₱<?= number_format($row['price'], 2); ?></td>
                        <td><?= htmlspecialchars($row['quantity']); ?></td>
                        <td><?= htmlspecialchars($row['added_by'] ?? 'Unknown'); ?></td>
                        <td class="table-actions">
                            <a href="edit.php?id=<?= $row['id']; ?>">Edit</a>
                            <a href="delete.php?id=<?= $row['id']; ?>"
                                onclick="return confirm('Delete this product?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</body>

</html>