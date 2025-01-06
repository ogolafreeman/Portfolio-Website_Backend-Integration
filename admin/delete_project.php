<?php
    include 'config.php';

    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);

        $deleteQuery = "DELETE FROM projects WHERE id = ?";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "<script>alert('Project deleted successfully.'); window.location.href = 'view_projects.php';</script>";
        } else {
            echo "<script>alert('Error deleting project.');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Invalid request.'); window.location.href = 'view_projects.php';</script>";
    }

    $conn->close();
?>
