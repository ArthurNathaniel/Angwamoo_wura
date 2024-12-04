<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare('SELECT * FROM customers WHERE id = ?');
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $date_of_birth = $_POST['date_of_birth'];

    // Update user profile data
    $stmt = $conn->prepare('UPDATE customers SET first_name = ?, last_name = ?, date_of_birth = ? WHERE id = ?');
    $stmt->bind_param('sssi', $first_name, $last_name, $date_of_birth, $user_id);
    $stmt->execute();

    // Handle profile picture upload
    if ($_FILES['profile_picture']['tmp_name']) {
        $profile_picture = 'uploads/' . basename($_FILES['profile_picture']['name']);
        move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profile_picture);

        $stmt = $conn->prepare('UPDATE customers SET profile_picture = ? WHERE id = ?');
        $stmt->bind_param('si', $profile_picture, $user_id);
        $stmt->execute();
    }

    header('Location: profile.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Profile</title>
</head>
<body>
    <h2>Your Profile</h2>

    <p>Phone: <?= $user['phone'] ?></p>
    <p>Email: <?= $user['email'] ?></p>
    <p>Date of Birth: <?= $user['date_of_birth'] ?></p>

    <?php if ($user['profile_picture']): ?>
        <img src="<?= $user['profile_picture'] ?>" alt="Profile Picture" width="150">
    <?php endif; ?>

    <h3>Edit Profile</h3>
    <form method="POST" enctype="multipart/form-data">
        <label for="first_name">First Name</label>
        <input type="text" name="first_name" value="<?= $user['first_name'] ?>" required><br>

        <label for="last_name">Last Name</label>
        <input type="text" name="last_name" value="<?= $user['last_name'] ?>" required><br>

        <label for="date_of_birth">Date of Birth</label>
        <input type="date" name="date_of_birth" value="<?= $user['date_of_birth'] ?>" required><br>

        <label for="profile_picture">Profile Picture</label>
        <input type="file" name="profile_picture"><br>

        <button type="submit">Update Profile</button>
    </form>
</body>
</html>
