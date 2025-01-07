<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Delete the record
    $query = "DELETE FROM education WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Education Experience deleted successfully!'); window.location.href = 'view_education.php';</script>";
    } else {
        echo "<script>alert('Error deleting Education Experience.'); window.location.href = 'view_education.php';</script>";
    }
} else {
    echo "<script>alert('Invalid ID.'); window.location.href = 'view_education.php';</script>";
}
?>
