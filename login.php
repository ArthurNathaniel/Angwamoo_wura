<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email_or_phone = $_POST['email_or_phone'];
    $password = $_POST['password'];

    // Check if the email or phone exists
    $stmt = $conn->prepare('SELECT * FROM customers WHERE email = ? OR phone = ?');
    $stmt->bind_param('ss', $email_or_phone, $email_or_phone);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: home.php');
        exit;
    } else {
        $error = 'Invalid credentials.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php include 'cdn.php' ?>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/signup.css">
</head>

<body>
    <div class="signup_all">
        <div class="back">
            <a href="index.php">
                <i class="fa-solid fa-arrow-left-long"></i>
            </a>
        </div>
        <div class="signup_img">
            <img src="./images/logo.png" alt="">
        </div>
        <div class="welcome_back">
            <h3>Welcome Back 👋</h3>
            <p>login to your account</p>
        </div>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>

        <form method="POST">
            <div class="forms">
                <label for="email_or_phone">Email or Phone</label>
                <input type="text" name="email_or_phone" required>
            </div>
            <div class="forms">

                <label for="password">Password</label>
                <input type="password" name="password" required>
            </div>

            <div class="forms">
                <button type="submit">Login</button>
            </div>
            <div class="forms">
            <p>Don't have an account? <a href="signup.php"><span>Sign Up</span></a></p>

            </div>
        </form>
    </div>
</body>

</html>