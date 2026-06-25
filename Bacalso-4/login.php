<?php
require_once 'config.php';
require_once 'auth.php';

if (isLoggedIn()) {
    header("Location: index.php");
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = mysqli_real_escape_string(
        $conn,
        trim($_POST['username'])
    );

    $password = $_POST['password'];

    $result = mysqli_query(
        $conn,
        "SELECT * FROM users
         WHERE username = '$username'"
    );

    if ($user = mysqli_fetch_assoc($result)) {

        if (password_verify($password, $user['password_hash'])) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            header("Location: index.php");
            exit;
        }
    }

    $error = "Invalid username or password.";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container">

        <h2>Login</h2>

        <?php if ($error): ?>
            <div class="error">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST">

            <label>Username</label>
            <input type="text" name="username" required>

            <label>Password</label>
            <input type="password" name="password" required>

            </button>
            <button type="submit">
                Login
            </button>

            <p>
                Don't have an account?
                <a href="register.php">Register here</a>
            </p>
        </form>

    </div>

</body>

</html>