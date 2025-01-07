<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $query = "DELETE FROM work_experience WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Work Experience deleted successfully!'); window.location.href = 'view_work.php';</script>";
    } else {
        echo "<script>alert('Error deleting Work Experience.'); window.location.href = 'view_work.php';</script>";
    }
} else {
    echo "<script>alert('Invalid ID.'); window.location.href = 'view_work.php';</script>";
}
?>
