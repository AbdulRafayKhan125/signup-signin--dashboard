<!DOCTYPE html>
<html lang="en">
<head>
    <title>Signup</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="centered">
    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        require 'db_config.php';

        $full_name = $_POST['full_name'];
        $contact_number = $_POST['contact_number'];
        $age = $_POST['age'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $sql = "INSERT INTO users (full_name, contact_number, age, email, username, password) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssisss", $full_name, $contact_number, $age, $email, $username, $password);

        if ($stmt->execute()) {
            echo "<p style='color: green;'>Signup successful! <a href='../index.php'>Login here</a></p>";
        } else {
            echo "<p style='color: red;'>Error: " . $stmt->error . "</p>";
        }
    }
    ?>
    <form action="" method="POST">
        <h2>Signup</h2>
        <label>Full Name:</label>
        <input type="text" name="full_name" required>
        <label>Contact Number:</label>
        <input type="text" name="contact_number" required>
        <label>Age:</label>
        <input type="number" name="age" required>
        <label>Email:</label>
        <input type="email" name="email" required>
        <label>Username:</label>
        <input type="text" name="username" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Register</button>
    </form>
</div>
</body>
</html>
