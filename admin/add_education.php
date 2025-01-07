<?php
include 'header.php';
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $institution = htmlspecialchars($_POST['institution']);
    $degree = htmlspecialchars($_POST['degree']);
    $year = htmlspecialchars($_POST['year']);

    $query = "INSERT INTO education_experience (institution, degree, year) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $institution, $degree, $year);

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
            <h2>Add Education</h2>
            <form method="POST">
                <div class="form-group mb-3">
                    <label for="institution">Institution</label>
                    <input type="text" name="institution" class="form-control" id="institution" required>
                </div>
                <div class="form-group mb-3">
                    <label for="degree">Degree</label>
                    <input type="text" name="degree" class="form-control" id="degree" required>
                </div>
                <div class="form-group mb-3">
                    <label for="year">Year</label>
                    <input type="text" name="year" class="form-control" id="year" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Education</button>
            </form>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
