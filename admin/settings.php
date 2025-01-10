<?php
include 'header.php'; // Includes admin panel header
include 'config.php'; // Database connection

// Fetch current record from the home_section table
$query = "SELECT * FROM home_section LIMIT 1";
$result = $conn->query($query);
$homeSection = $result->fetch_assoc();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $title = htmlspecialchars($_POST['title']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $address = htmlspecialchars($_POST['address']);
    $facebook_link = htmlspecialchars($_POST['facebook_link']);
    $twitter_link = htmlspecialchars($_POST['twitter_link']);
    $github_link = htmlspecialchars($_POST['github_link']);
    $dribbble_link = htmlspecialchars($_POST['dribbble_link']);
    $imagePath = $homeSection['image']; // Default to existing image

    // Handle image upload
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "uploads/home/";
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true); // Create directory if not exists
        }

        $targetFile = $targetDir . basename($_FILES['image']['name']);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Validate image
        if (getimagesize($_FILES['image']['tmp_name']) === false) {
            echo "<script>alert('Uploaded file is not a valid image.');</script>";
            exit;
        }

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            echo "<script>alert('Error uploading the image.');</script>";
            exit;
        }

        $imagePath = $targetFile; // Update image path
    }

    // Insert or Update logic
    if ($homeSection) {
        // Update record
        $updateQuery = "UPDATE home_section SET name = ?, title = ?, email = ?, phone = ?, address = ?, facebook_link = ?, twitter_link = ?, github_link = ?, dribbble_link = ?, image = ? WHERE id = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("ssssssssssi", $name, $title, $email, $phone, $address, $facebook_link, $twitter_link, $github_link, $dribbble_link, $imagePath, $homeSection['id']);
    } else {
        // Add new record
        $insertQuery = "INSERT INTO home_section (name, title, email, phone, address, facebook_link, twitter_link, github_link, dribbble_link, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("ssssssssss", $name, $title, $email, $phone, $address, $facebook_link, $twitter_link, $github_link, $dribbble_link, $imagePath);
    }

    if ($stmt->execute()) {
        echo "<script>alert('Home Section saved successfully!'); window.location.href = 'settings.php';</script>";
    } else {
        echo "<script>alert('Error saving Home Section.');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
<div class="container-fluid">
    <div class="row">
        <?php include 'sidebar.php'; ?>
        <div class="col-9 p-4">
            <h2 class="mb-4">Settings - Manage Home Section</h2>
            <div class="card shadow">
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <!-- Form Title -->
                        <h4 class="text-primary mb-4">Home Section Details</h4>
                        
                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars($homeSection['name'] ?? '') ?>" placeholder="Enter your name" required>
                        </div>

                        <!-- Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" id="title" class="form-control" value="<?= htmlspecialchars($homeSection['title'] ?? '') ?>" placeholder="Enter your title" required>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars($homeSection['email'] ?? '') ?>" placeholder="Enter your email" required>
                        </div>

                        <!-- Phone -->
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control" value="<?= htmlspecialchars($homeSection['phone'] ?? '') ?>" placeholder="Enter your phone number" required>
                        </div>

                        <!-- Address -->
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea name="address" id="address" class="form-control" rows="2" placeholder="Enter your address" required><?= htmlspecialchars($homeSection['address'] ?? '') ?></textarea>
                        </div>

                        <!-- Social Media Links -->
                        <h5 class="text-secondary mt-4">Social Media Links</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="facebook_link" class="form-label">Facebook</label>
                                <input type="url" name="facebook_link" id="facebook_link" class="form-control" value="<?= htmlspecialchars($homeSection['facebook_link'] ?? '') ?>" placeholder="Enter your Facebook link">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="twitter_link" class="form-label">Twitter</label>
                                <input type="url" name="twitter_link" id="twitter_link" class="form-control" value="<?= htmlspecialchars($homeSection['twitter_link'] ?? '') ?>" placeholder="Enter your Twitter link">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="github_link" class="form-label">GitHub</label>
                                <input type="url" name="github_link" id="github_link" class="form-control" value="<?= htmlspecialchars($homeSection['github_link'] ?? '') ?>" placeholder="Enter your GitHub link">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="dribbble_link" class="form-label">Dribbble</label>
                                <input type="url" name="dribbble_link" id="dribbble_link" class="form-control" value="<?= htmlspecialchars($homeSection['dribbble_link'] ?? '') ?>" placeholder="Enter your Dribbble link">
                            </div>
                        </div>

                        <!-- Profile Image -->
                        <div class="mb-3">
                            <label for="image" class="form-label">Profile Image</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                            <?php if (!empty($homeSection['image'])): ?>
                                <img src="<?= htmlspecialchars($homeSection['image']) ?>" alt="Profile Image" class="img-fluid mt-3 rounded" style="max-height: 150px;">
                            <?php endif; ?>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg"><?= $homeSection ? 'Update' : 'Add'; ?> Home Section</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'footer.php'; ?>
