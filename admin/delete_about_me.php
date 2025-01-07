<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Delete the record
    $query = "DELETE FROM about_me WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('About Me deleted successfully!'); window.location.href = 'view_about_me.php';</script>";
    } else {
        echo "<script>alert('Error deleting About Me.'); window.location.href = 'view_about_me.php';</script>";
    }
} else {
    echo "<script>alert('Invalid ID.'); window.location.href = 'view_about_me.php';</script>";
}
?>
