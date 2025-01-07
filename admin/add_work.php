<?php
include 'header.php';
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $position = htmlspecialchars($_POST['position']);
    $company = htmlspecialchars($_POST['company']);
    $duration = htmlspecialchars($_POST['duration']);
    $responsibilities = htmlspecialchars($_POST['responsibilities']);

    $query = "INSERT INTO work_experience (position, company, duration, responsibilities) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $position, $company, $duration, $responsibilities);

    if ($stmt->execute()) {
        echo "<script>alert('Work Experience added successfully!');</script>";
    } else {
        echo "<script>alert('Error adding Work Experience.');</script>";
    }

    $stmt->close();
}
?>
<div class="container-fluid">
    <div class="row">
        <?php include('sidebar.php'); ?>
        <div class="col-9 p-4">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h3 class="mb-0">Add Work Experience</h3>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label for="position" class="form-label">Position</label>
                            <input type="text" name="position" class="form-control" id="position" required>
                        </div>
                        <div class="mb-3">
                            <label for="company" class="form-label">Company</label>
                            <input type="text" name="company" class="form-control" id="company" required>
                        </div>
                        <div class="mb-3">
                            <label for="duration" class="form-label">Duration</label>
                            <input type="text" name="duration" class="form-control" id="duration" required>
                        </div>
                        <div class="mb-3">
                            <label for="responsibilities" class="form-label">Responsibilities</label>
                            <textarea name="responsibilities" class="form-control" id="responsibilities" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-info w-100">Add Work Experience</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
