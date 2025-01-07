<?php
include 'header.php';
include 'config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT * FROM work_experience WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $work = $result->fetch_assoc();
} else {
    echo "<script>alert('Invalid ID.'); window.location.href = 'view_work.php';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $position = htmlspecialchars($_POST['position']);
    $company = htmlspecialchars($_POST['company']);
    $duration = htmlspecialchars($_POST['duration']);
    $responsibilities = htmlspecialchars($_POST['responsibilities']);

    $updateQuery = "UPDATE work_experience SET position = ?, company = ?, duration = ?, responsibilities = ? WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ssssi", $position, $company, $duration, $responsibilities, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Work Experience updated successfully!'); window.location.href = 'view_work.php';</script>";
    } else {
        echo "<script>alert('Error updating Work Experience.');</script>";
    }
}
?>

<div class="container-fluid">
    <div class="row">
        <?php include('sidebar.php'); ?>
        <div class="col-9 p-4">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h3 class="mb-0">Edit Work Experience</h3>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label for="position" class="form-label">Position</label>
                            <input type="text" name="position" class="form-control" id="position" value="<?= htmlspecialchars($work['position']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="company" class="form-label">Company</label>
                            <input type="text" name="company" class="form-control" id="company" value="<?= htmlspecialchars($work['company']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="duration" class="form-label">Duration</label>
                            <input type="text" name="duration" class="form-control" id="duration" value="<?= htmlspecialchars($work['duration']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="responsibilities" class="form-label">Responsibilities</label>
                            <textarea name="responsibilities" class="form-control" id="responsibilities" rows="4" required><?= htmlspecialchars($work['responsibilities']); ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-info w-100">Update Work Experience</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('footer.php'); ?>
