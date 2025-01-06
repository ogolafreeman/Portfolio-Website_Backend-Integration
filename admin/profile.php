<?php
// Start session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Database connection
$conn = new mysqli("localhost", "root", "", "folio");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user details
$user_id = $_SESSION['user_id'];
$sql = "SELECT name, username, email, profile_image FROM user WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($name, $username, $email, $profile_image);
$stmt->fetch();
$stmt->close();

// Handle profile image update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_image'])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validate image
    if (getimagesize($_FILES["profile_image"]["tmp_name"]) !== false) {
        if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
            $sql = "UPDATE user SET profile_image = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $target_file, $user_id);
            $stmt->execute();
            $stmt->close();

            header("Location: profile.php");
            exit;
        } else {
            $error_message = "Error uploading your file.";
        }
    } else {
        $error_message = "File is not a valid image.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .profile-card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .profile-card img {
            object-fit: cover;
            height: 250px;
        }

        .form-container {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</head>
<body>
    <?php include('header.php'); ?>

    <div class="container mt-5">
        <h1 class="mb-4">My Profile</h1>

        <?php if (isset($error_message)) { ?>
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($error_message); ?>
            </div>
        <?php } ?>

        <div class="row">
            <!-- Profile Information -->
            <div class="col-md-4">
                <div class="card profile-card">
                    <img src="<?= $profile_image ? $profile_image : 'uploads/default.jpg'; ?>" class="card-img-top" alt="Profile Image">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?= htmlspecialchars($name); ?></h5>
                        <p class="card-text">@<?= htmlspecialchars($username); ?></p>
                        <p class="card-text text-muted"><?= htmlspecialchars($email); ?></p>
                    </div>
                </div>
            </div>

            <!-- Profile Image Update Form -->
            <div class="col-md-8">
                <div class="form-container">
                    <h3>Update Profile Image</h3>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="profile_image" class="form-label">Choose a new profile image</label>
                            <input type="file" class="form-control" id="profile_image" name="profile_image" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Upload Image</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include('footer.php'); ?>
</body>
</html>
