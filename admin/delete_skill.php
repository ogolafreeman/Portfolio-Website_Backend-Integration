<?php
include 'config.php';
    include 'header.php'; // Includes admin panel header
    

    if (isset($_GET['type']) && isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $type = $_GET['type'];

        if ($type === 'technical') {
            $deleteQuery = "DELETE FROM technical_skills WHERE id = ?";
        } elseif ($type === 'professional') {
            $deleteQuery = "DELETE FROM professional_skills WHERE id = ?";
        } else {
            die("Invalid skill type.");
        }

        $stmt = $conn->prepare($deleteQuery);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "<script>alert('Skill deleted successfully.'); window.location.href = 'skills.php';</script>";
        } else {
            echo "<script>alert('Error deleting skill.'); window.location.href = 'skills.php';</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Invalid request.'); window.location.href = 'skills.php';</script>";
    }

    $conn->close();
?>
