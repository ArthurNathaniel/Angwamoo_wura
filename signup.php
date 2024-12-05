<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if email or phone already exists
    $stmt = $conn->prepare('SELECT * FROM customers WHERE email = ? OR phone = ?');
    $stmt->bind_param('ss', $email, $phone);
    $stmt->execute();
    $result = $stmt->get_result();
    $existingUser = $result->fetch_assoc();

    if ($existingUser) {
        $error = 'Email or phone number already registered.';
    } else {
        // Insert new customer data
        $stmt = $conn->prepare('INSERT INTO customers (email, phone, password) VALUES (?, ?, ?)');
        $stmt->bind_param('sss', $email, $phone, $password);
        $stmt->execute();
        header('Location: login.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
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
            <p>Signup to your account</p>
        </div>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>

        <form method="POST">
            <div class="forms">
                <label for="email">Email Address</label>
                <input type="email" placeholder="Enter your email address" name="email" required>
            </div>

            <div class="forms">
                <label for="phone">Phone Number</label>
                <input type="tel" placeholder="Enter your phone number" name="phone" required>
            </div>

            <div class="forms">
                <label for="password">Password</label>
                <input type="password" placeholder="Enter your password" name="password" required>
            </div>

            <div class="forms">
                <button type="submit">Sign Up</button>
            </div>

            <div class="forms">
                <p>Have an account? <a href="login.php"><span>Login</span></a></p>
            </div>
            
        </form>

    </div>
</body>

</html>