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
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_image'])) {
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

// Handle home section form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_home_section'])) {
    $home_name = htmlspecialchars($_POST['home_name']);
    $home_title = htmlspecialchars($_POST['home_title']);
    $home_email = htmlspecialchars($_POST['home_email']);
    $home_phone = htmlspecialchars($_POST['home_phone']);
    $home_address = htmlspecialchars($_POST['home_address']);
    $facebook_link = !empty($_POST['facebook_link']) ? htmlspecialchars($_POST['facebook_link']) : null;
    $twitter_link = !empty($_POST['twitter_link']) ? htmlspecialchars($_POST['twitter_link']) : null;
    $github_link = !empty($_POST['github_link']) ? htmlspecialchars($_POST['github_link']) : null;
    $dribbble_link = !empty($_POST['dribbble_link']) ? htmlspecialchars($_POST['dribbble_link']) : null;

    $query = "INSERT INTO home_section (name, title, email, phone, address, facebook_link, twitter_link, github_link, dribbble_link) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssssss", $home_name, $home_title, $home_email, $home_phone, $home_address, $facebook_link, $twitter_link, $github_link, $dribbble_link);

    if ($stmt->execute()) {
        $success_message = "Home section details added successfully!";
    } else {
        $error_message = "Failed to add home section details. Please try again.";
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

        <?php if (isset($success_message)) { ?>
            <div class="alert alert-success" role="alert">
                <?= htmlspecialchars($success_message); ?>
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

        <!-- Add Home Section Form -->
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="form-container">
                    <h3>Add Home Section Details</h3>
                    <form method="POST">
                        <div class="mb-3">
                            <label for="home_name" class="form-label">Name</label>
                            <input type="text" name="home_name" id="home_name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="home_title" class="form-label">Title</label>
                            <input type="text" name="home_title" id="home_title" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="home_email" class="form-label">Email</label>
                            <input type="email" name="home_email" id="home_email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="home_phone" class="form-label">Phone</label>
                            <input type="text" name="home_phone" id="home_phone" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="home_address" class="form-label">Address</label>
                            <textarea name="home_address" id="home_address" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="facebook_link" class="form-label">Facebook Link</label>
                            <input type="url" name="facebook_link" id="facebook_link" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="twitter_link" class="form-label">Twitter Link</label>
                            <input type="url" name="twitter_link" id="twitter_link" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="github_link" class="form-label">GitHub Link</label>
                            <input type="url" name="github_link" id="github_link" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="dribbble_link" class="form-label">Dribbble Link</label>
                            <input type="url" name="dribbble_link" id="dribbble_link" class="form-control">
                        </div>

                        <button type="submit" name="add_home_section" class="btn btn-primary">Add Home Section</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

