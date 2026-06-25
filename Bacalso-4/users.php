<?php
require_once 'auth.php';
requireAdmin();

require_once 'config.php';

$sql = "
SELECT
    u.id,
    u.username,
    u.email,
    u.role,
    u.created_at,
    COUNT(p.id) AS product_count
FROM users u
LEFT JOIN products p
ON u.id = p.added_by
GROUP BY u.id
ORDER BY u.username
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Users</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php include 'navbar.php'; ?>

    <h2>Users Management</h2>

    <table>

        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Products Added</th>
            <th>Joined</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()): ?>

            <tr>

                <td><?= $row['id'] ?></td>

                <td><?= htmlspecialchars($row['username']) ?></td>

                <td><?= htmlspecialchars($row['email']) ?></td>

                <td>
                    <span class="<?= $row['role'] ?>">
                        <?= ucfirst($row['role']) ?>
                    </span>
                </td>

                <td><?= $row['product_count'] ?></td>

                <td><?= $row['created_at'] ?></td>

            </tr>

        <?php endwhile; ?>

    </table>

</body>

</html>