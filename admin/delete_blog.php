<?php
include 'config.php';

if (isset($_GET['id'])) {
    $blogId = intval($_GET['id']);

    // Fetch the blog to delete the image
    $query = "SELECT image FROM blog_posts WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $blogId);
    $stmt->execute();
    $result = $stmt->get_result();
    $blog = $result->fetch_assoc();

    if ($blog && file_exists($blog['image'])) {
        unlink($blog['image']); // Delete the image file
    }

    // Delete the blog post
    $deleteQuery = "DELETE FROM blog_posts WHERE id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $blogId);

    if ($stmt->execute()) {
        echo "<script>alert('Blog post deleted successfully!'); window.location.href = 'view_blogs.php';</script>";
    } else {
        echo "<script>alert('Error deleting blog post.'); window.location.href = 'view_blogs.php';</script>";
    }
} else {
    header("Location: view_blogs.php");
    exit;
}
?>
