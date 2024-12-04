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
    <title>Signup</title>
</head>
<body>
    <h2>Sign Up</h2>
    <form method="POST">
        <label for="email">Email Address</label>
        <input type="email" name="email" required><br>

        <label for="phone">Phone Number</label>
        <input type="tel" name="phone" required><br>

        <label for="password">Password</label>
        <input type="password" name="password" required><br>

        <button type="submit">Sign Up</button>
        <?php if (isset($error)) echo "<p>$error</p>"; ?>
    </form>
</body>
</html>
