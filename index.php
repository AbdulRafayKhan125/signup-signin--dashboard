<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="centered">
    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        require 'db_config.php';
        session_start();

        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            header("Location:dashboard.php");
            exit();
        } else {
            echo "<p style='color: red;'>Invalid username or password</p>";
        }
    }
    ?>
    <form action="" method="POST">
        <h2>Login</h2>
        <label>Username:</label>
        <input type="text" name="username" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Login</button>
    </form>
    <h4>Don't have account <a href="signup.php">signup here</a></h4>
</div>
</body>
</html>
