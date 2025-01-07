<?php
include 'header.php';
include 'config.php';

// Fetch the record to edit
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT * FROM about_me WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $aboutMe = $result->fetch_assoc();
} else {
    echo "<script>alert('Invalid ID.'); window.location.href = 'view_about_me.php';</script>";
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $location = htmlspecialchars($_POST['location']);
    $description = htmlspecialchars($_POST['description']);
    $skills = htmlspecialchars($_POST['skills']);

    $updateQuery = "UPDATE about_me SET name = ?, location = ?, description = ?, skills = ? WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ssssi", $name, $location, $description, $skills, $id);

    if ($stmt->execute()) {
        echo "<script>alert('About Me updated successfully!'); window.location.href = 'view_about_me.php';</script>";
    } else {
        echo "<script>alert('Error updating About Me.');</script>";
    }
}
?>

<div class="container-fluid">
    <div class="row">
        <?php include('sidebar.php'); ?>
        <div class="col-9 p-4">
            <h2>Edit About Me</h2>
            <form method="POST">
                <div class="form-group mb-3">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" value="<?= htmlspecialchars($aboutMe['name']); ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="location">Location</label>
                    <input type="text" name="location" class="form-control" id="location" value="<?= htmlspecialchars($aboutMe['location']); ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" id="description" rows="4" required><?= htmlspecialchars($aboutMe['description']); ?></textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="skills">Skills (comma-separated)</label>
                    <textarea name="skills" class="form-control" id="skills" rows="3" required><?= htmlspecialchars($aboutMe['skills']); ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update About Me</button>
            </form>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
