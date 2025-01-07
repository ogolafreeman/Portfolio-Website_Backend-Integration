<?php
include 'header.php';
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $location = htmlspecialchars($_POST['location']);
    $description = htmlspecialchars($_POST['description']);
    $skills = htmlspecialchars($_POST['skills']);

    $query = "INSERT INTO about_me (name, location, description, skills) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $name, $location, $description, $skills);

    if ($stmt->execute()) {
        echo "<script>alert('About Me added successfully!');</script>";
    } else {
        echo "<script>alert('Error adding About Me.');</script>";
    }

    $stmt->close();
}
?>

<div class="container-fluid">
    <div class="row">
        <?php include('sidebar.php'); ?>
        <div class="col-9 p-4">
            <h2>Add About Me</h2>
            <form method="POST">
                <div class="form-group mb-3">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" required>
                </div>
                <div class="form-group mb-3">
                    <label for="location">Location</label>
                    <input type="text" name="location" class="form-control" id="location" required>
                </div>
                <div class="form-group mb-3">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" id="description" rows="4" required></textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="skills">Skills (comma-separated)</label>
                    <textarea name="skills" class="form-control" id="skills" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Add About Me</button>
            </form>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
