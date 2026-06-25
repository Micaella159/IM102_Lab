<?php
require_once 'config.php';
$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validation

    if (empty($username)) {
        $errors[] = "Username is required.";
    }

    if (strlen($username) < 3) {
        $errors[] = "Username must be at least 3 characters.";
    }

    if (empty($email)) {
        $errors[] = "Email is required.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (empty($password)) {
        $errors[] = "Password is required.";
    }

    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters.";
    }

    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    // Check username exists

    $usernameEsc = mysqli_real_escape_string($conn, $username);

    $checkUser = mysqli_query(
        $conn,
        "SELECT id FROM users WHERE username='$usernameEsc'"
    );

    if (mysqli_num_rows($checkUser) > 0) {
        $errors[] = "Username already exists.";
    }

    // Check email exists

    $emailEsc = mysqli_real_escape_string($conn, $email);

    $checkEmail = mysqli_query(
        $conn,
        "SELECT id FROM users WHERE email='$emailEsc'"
    );

    if (mysqli_num_rows($checkEmail) > 0) {
        $errors[] = "Email already exists.";
    }

    // Insert

    if (empty($errors)) {

        $passwordHash = password_hash(
            $password,
            PASSWORD_DEFAULT
        );

        mysqli_query(
            $conn,
            "INSERT INTO users
            (username, email, password_hash)
            VALUES
            (
                '$usernameEsc',
                '$emailEsc',
                '$passwordHash'
            )"
        );

        header("Location: login.php?registered=1");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>User Registration</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container">

        <h2>User Registration</h2>

        <?php if (!empty($errors)): ?>
            <div class="error">
                <?php foreach ($errors as $error): ?>
                    <div><?php echo $error; ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="success">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>

        <form method="POST">

            <label>Username</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>">

            <label>Email</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">

            <label>Password</label>
            <input type="password" name="password">

            <label>Confirm Password</label>
            <input type="password" name="confirm_password">

            <button type="submit">
                Register
            </button>

        </form>

    </div>

</body>

</html>