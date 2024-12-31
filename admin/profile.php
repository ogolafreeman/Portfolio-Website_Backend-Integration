<?php
// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit;
}

// Database connection
$conn = new mysqli("localhost", "root", "", "folio");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user details from the database
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
    // Handle image upload
    $target_dir = "uploads/";  // This will be the relative path for the web server
    $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image is valid
    if (getimagesize($_FILES["profile_image"]["tmp_name"]) !== false) {
        if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
            // Update the image path in the database
            $sql = "UPDATE user SET profile_image = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $target_file, $user_id);
            $stmt->execute();
            $stmt->close();

            // Reload the page to show the new image
            header("Location: profile.php");
            exit;
        } else {
            $error_message = "Sorry, there was an error uploading your file.";
        }
    } else {
        $error_message = "File is not an image.";
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
</head>
<body>
    <?php include('header.php'); ?>

    <div class="container mt-5">
        <h1>Profile</h1>
        
        <?php if (isset($error_message)) { ?>
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($error_message); ?>
            </div>
        <?php } ?>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <img src="<?= $profile_image ? $profile_image : 'uploads/default.jpg'; ?>" class="card-img-top" alt="Profile Image">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($name); ?></h5>
                        <p class="card-text"><?= htmlspecialchars($username); ?></p>
                        <p class="card-text"><?= htmlspecialchars($email); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
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

    <?php include('footer.php'); ?>
</body>
</html>
