<?php
require_once 'auth.php';
?>

<nav class="navbar">
    <div class="nav-links">
        <a href="index.php" class="nav-link">Home</a>
        <a href="report.php" class="nav-link">Reports</a>
        <?php if (isAdmin()): ?>
            <a href="add.php" class="nav-link">Add Product</a>
            <a href="users.php" class="nav-link">Users</a>
        <?php endif; ?>
    </div>

    <div class="nav-right">
        <?php if (isLoggedIn()): ?>
            <span><?= htmlspecialchars(getUsername()); ?> (<?= htmlspecialchars($_SESSION['role']); ?>)</span>
            <a href="logout.php" class="nav-link">Logout</a>
        <?php else: ?>
            <a href="login.php" class="nav-link">Login</a>
        <?php endif; ?>
    </div>
</nav>

<hr class="nav-divider">