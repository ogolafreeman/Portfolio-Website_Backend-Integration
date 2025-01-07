<?php
include 'header.php';
include 'config.php';

// Fetch the record to edit
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT * FROM education WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $education = $result->fetch_assoc();
} else {
    echo "<script>alert('Invalid ID.'); window.location.href = 'view_education.php';</script>";
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $degree = htmlspecialchars($_POST['degree']);
    $institution = htmlspecialchars($_POST['institution']);
    $duration = htmlspecialchars($_POST['duration']);
    $description = htmlspecialchars($_POST['description']);

    $updateQuery = "UPDATE education SET degree = ?, institution = ?, duration = ?, description = ? WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ssssi", $degree, $institution, $duration, $description, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Education Experience updated successfully!'); window.location.href = 'view_education.php';</script>";
    } else {
        echo "<script>alert('Error updating Education Experience.');</script>";
    }
}
?>

<div class="container-fluid">
    <div class="row">
        <?php include('sidebar.php'); ?>
        <div class="col-9 p-4">
            <h2>Edit Education</h2>
            <form method="POST">
                <div class="form-group mb-3">
                    <label for="degree">Degree</label>
                    <input type="text" name="degree" class="form-control" id="degree" value="<?= htmlspecialchars($education['degree']); ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="institution">Institution</label>
                    <input type="text" name="institution" class="form-control" id="institution" value="<?= htmlspecialchars($education['institution']); ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="duration">Duration</label>
                    <input type="text" name="duration" class="form-control" id="duration" value="<?= htmlspecialchars($education['duration']); ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" id="description" rows="4" required><?= htmlspecialchars($education['description']); ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update Education</button>
            </form>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
