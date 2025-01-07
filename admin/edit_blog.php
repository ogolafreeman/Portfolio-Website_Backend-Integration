<?php
include 'header.php';
include 'config.php';

if (isset($_GET['id'])) {
    $blogId = intval($_GET['id']);

    // Fetch the blog details
    $query = "SELECT * FROM blog_posts WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $blogId);
    $stmt->execute();
    $result = $stmt->get_result();
    $blog = $result->fetch_assoc();

    if (!$blog) {
        echo "<div class='alert alert-danger text-center mt-5'>Blog post not found.</div>";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = htmlspecialchars($_POST['title']);
    $content = htmlspecialchars($_POST['content']);
    $author = htmlspecialchars($_POST['author']);
    $post_date = htmlspecialchars($_POST['post_date']);
    $read_more_link = htmlspecialchars($_POST['read_more_link']);
    
    // Handle image upload
    $targetDir = "uploads/blogs/";
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true); // Create directory if it doesn't exist
    }

    $imagePath = $blog['image']; // Default to existing image
    if (!empty($_FILES['image']['name'])) {
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Validate image file
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check === false) {
            echo "<script>alert('File is not a valid image.');</script>";
            exit;
        }

        if ($_FILES["image"]["size"] > 5000000) { // 5MB max
            echo "<script>alert('Image file size is too large.');</script>";
            exit;
        }

        $allowedFormats = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($imageFileType, $allowedFormats)) {
            echo "<script>alert('Only JPG, JPEG, PNG, and GIF files are allowed.');</script>";
            exit;
        }

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $imagePath = $targetFile;

            // Delete old image file if applicable
            if (file_exists($blog['image']) && $blog['image'] !== $imagePath) {
                unlink($blog['image']);
            }
        } else {
            echo "<script>alert('Error uploading the image.');</script>";
            exit;
        }
    }

    // Update the blog in the database
    $updateQuery = "UPDATE blog_posts SET title = ?, content = ?, author = ?, post_date = ?, image = ?, read_more_link = ? WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ssssssi", $title, $content, $author, $post_date, $imagePath, $read_more_link, $blogId);

    if ($stmt->execute()) {
        echo "<script>alert('Blog updated successfully!'); window.location.href = 'view_blogs.php';</script>";
    } else {
        echo "<script>alert('Error updating blog.');</script>";
    }
}
?>

<div class="container-fluid">
    <div class="row">
        <?php include('sidebar.php'); ?>
        <div class="col-9 p-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Edit Blog Post</h3>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="title" class="form-label">Blog Title</label>
                            <input type="text" name="title" id="title" class="form-control" value="<?= htmlspecialchars($blog['title']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Content</label>
                            <textarea name="content" id="content" class="form-control" rows="5" required><?= htmlspecialchars($blog['content']); ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="author" class="form-label">Author</label>
                            <input type="text" name="author" id="author" class="form-control" value="<?= htmlspecialchars($blog['author']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="post_date" class="form-label">Post Date</label>
                            <input type="date" name="post_date" id="post_date" class="form-control" value="<?= htmlspecialchars($blog['post_date']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Blog Image</label>
                            <input type="file" name="image" id="image" class="form-control">
                            <small class="text-muted">Current Image: <a href="<?= $blog['image']; ?>" target="_blank"><?= basename($blog['image']); ?></a></small>
                        </div>
                        <div class="mb-3">
                            <label for="read_more_link" class="form-label">Read More Link</label>
                            <input type="text" name="read_more_link" id="read_more_link" class="form-control" value="<?= htmlspecialchars($blog['read_more_link']); ?>" required>
                        </div>
                        <button type="submit" class="btn btn-success">Update Blog</button>
                        <a href="view_blogs.php" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
