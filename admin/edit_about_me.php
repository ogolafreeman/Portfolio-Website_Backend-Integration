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
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Edit About Me</h3>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="name" value="<?= htmlspecialchars($aboutMe['name']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" name="location" class="form-control" id="location" value="<?= htmlspecialchars($aboutMe['location']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control" id="description" rows="4" required><?= htmlspecialchars($aboutMe['description']); ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="skills" class="form-label">Skills (comma-separated)</label>
                            <textarea name="skills" class="form-control" id="skills" rows="3" required><?= htmlspecialchars($aboutMe['skills']); ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Update About Me</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('footer.php'); ?>
