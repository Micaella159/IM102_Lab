<?php
include 'db.php';

$sql = "SELECT
            p.id,
            p.name,
            p.description,
            p.price,
            p.stock,
            c.name AS category,
            s.name AS supplier,
            p.created_at
        FROM products p
        JOIN categories c
            ON p.category_id = c.id
        JOIN suppliers s
            ON p.supplier_id = s.id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inventory System</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            margin:20px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th, td{
            border:1px solid #ddd;
            padding:10px;
            text-align:left;
        }

        th{
            background:#007bff;
            color:white;
        }

        tr:nth-child(even){
            background:#f2f2f2;
        }
    </style>
</head>
<body>

<h2>Inventory Products</h2>

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
    </tr>

    <?php while($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?= $row['id']; ?></td>
        <td><?= $row['name']; ?></td>
        <td><?= $row['description']; ?></td>
        <td>₱<?= number_format($row['price'],2); ?></td>
        <td><?= $row['stock']; ?></td>
        <td><?= $row['category']; ?></td>
        <td><?= $row['supplier']; ?></td>
        <td><?= $row['created_at']; ?></td>
    </tr>
    <?php } ?>

</table>

</body>
</html>