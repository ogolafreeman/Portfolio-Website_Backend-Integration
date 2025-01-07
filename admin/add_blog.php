<?php
include 'header.php';
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = htmlspecialchars($_POST['title']);
    $content = htmlspecialchars($_POST['content']);
    $author = htmlspecialchars($_POST['author']);

    // Handle image upload
    $targetDir = "uploads/blogs/";
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true); // Create the directory if it doesn't exist
    }

    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Validate the image file
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        echo "<script>alert('File is not an image.');</script>";
        exit;
    }

    // Check file size (max 5MB)
    if ($_FILES["image"]["size"] > 5000000) {
        echo "<script>alert('File is too large.');</script>";
        exit;
    }

    // Allow specific formats
    $allowedFormats = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($imageFileType, $allowedFormats)) {
        echo "<script>alert('Only JPG, JPEG, PNG, and GIF files are allowed.');</script>";
        exit;
    }

    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        echo "<script>alert('Error uploading the image.');</script>";
        exit;
    }

    // Insert blog into the database
    $query = "INSERT INTO blog_posts (title, content, author, image) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $title, $content, $author, $targetFile);

    if ($stmt->execute()) {
        echo "<script>alert('Blog added successfully!'); window.location.href = 'view_blogs.php';</script>";
    } else {
        echo "<script>alert('Error adding blog.');</script>";
    }

    $stmt->close();
}
?>

<div class="container-fluid">
    <div class="row">
        <?php include('sidebar.php'); ?>
        <div class="col-9 p-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Add Blog</h3>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" id="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Content</label>
                            <textarea name="content" class="form-control" id="content" rows="5" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="author" class="form-label">Author</label>
                            <input type="text" name="author" class="form-control" id="author" required>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" name="image" class="form-control" id="image" accept="image/*" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Add Blog</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
