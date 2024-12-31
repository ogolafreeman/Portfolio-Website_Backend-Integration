<?php
// Start session to manage user login state
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "folio");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Encrypt input password using MD5

    // Query to check if user exists
    $stmt = $conn->prepare("SELECT id, name FROM user WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->bind_result($id, $name);

    if ($stmt->fetch()) {
        // Login successful, set session variables
        $_SESSION['user_id'] = $id;
        $_SESSION['user_name'] = $name;

        // Redirect to dashboard.php
        header("Location: dashboard.php");
        exit;
    } else {
        // Invalid credentials
        $error_message = "Invalid username or password!";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Login</h2>
        <?php if (isset($error_message)) { ?>
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($error_message); ?>
            </div>
        <?php } ?>
        <form method="POST" action="index.php">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
            <p class="text-center mt-3">Don't have an account? <a href="register.php">Register</a></p>
        </form>
    </div>
</body>
</html>
