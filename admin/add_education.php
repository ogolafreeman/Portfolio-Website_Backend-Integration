<?php
include 'header.php';
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $degree = htmlspecialchars($_POST['degree']);
    $institution = htmlspecialchars($_POST['institution']);
    $duration = htmlspecialchars($_POST['duration']);
    $description = htmlspecialchars($_POST['description']);

    $query = "INSERT INTO education (degree, institution, duration, description) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $degree, $institution, $duration, $description);

    if ($stmt->execute()) {
        echo "<script>alert('Education Experience added successfully!');</script>";
    } else {
        echo "<script>alert('Error adding Education Experience.');</script>";
    }

    $stmt->close();
}
?>

<div class="container-fluid">
    <div class="row">
        <?php include('sidebar.php'); ?>
        <div class="col-9 p-4">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h3 class="mb-0">Add Education</h3>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label for="degree" class="form-label">Degree</label>
                            <input type="text" name="degree" class="form-control" id="degree" required>
                        </div>
                        <div class="mb-3">
                            <label for="institution" class="form-label">Institution</label>
                            <input type="text" name="institution" class="form-control" id="institution" required>
                        </div>
                        <div class="mb-3">
                            <label for="duration" class="form-label">Duration</label>
                            <input type="text" name="duration" class="form-control" id="duration" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control" id="description" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Add Education</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('footer.php'); ?>
