<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "folio";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);

        $deleteQuery = "DELETE FROM projects WHERE id = ?";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "<script>alert('Project deleted successfully.'); window.location.href = 'admin_projects.php';</script>";
        } else {
            echo "<script>alert('Error deleting project.');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Invalid request.'); window.location.href = 'admin_projects.php';</script>";
    }

    $conn->close();
?>
