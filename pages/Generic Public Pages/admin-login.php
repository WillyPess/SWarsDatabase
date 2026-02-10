<?php
session_start();
include_once('../../functions/functions.php');


$message = "";
$pdo = dbLink();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user = trim($_POST['username']);
    $pass = trim($_POST['password']);

    if (validate($pdo, $user, $pass)) {
        header("Location: ../Generic Private Admin Pages/admin-dashboard.php");
        exit;
    } else {
        $message = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Login | Star Wars Trilogy</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>

<header>
    <h1>Star Wars Trilogy Database</h1>
    <?php navi('inner'); ?>
</header>

<main>

    <h2>Admin Login</h2>

    <form class="login-form" method="post">

        <label>Username</label>
        <input type="text" name="username" required autofocus>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>

        <?php if (!empty($message)): ?>
            <p class="error-msg"><?php echo $message; ?></p>
        <?php endif; ?>

    </form>

</main>

<footer>
    <p>© 2025 Star Wars Database Project | Created by Willy Pessoa</p>
</footer>

</body>
</html>
