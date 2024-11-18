<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit();
}

require 'db_config.php';

$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION['username']);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="dashboard">
    <h2>Welcome, <?php echo htmlspecialchars($user['full_name']); ?>!</h2>
    <div class="profile">
        <p><strong>Full Name:</strong> <?php echo htmlspecialchars($user['full_name']); ?></p>
        <p><strong>Contact Number:</strong> <?php echo htmlspecialchars($user['contact_number']); ?></p>
        <p><strong>Age:</strong> <?php echo htmlspecialchars($user['age']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
    </div>
    <a href="logout.php"><button>Logout</button></a>
</div>
</body>
</html>
