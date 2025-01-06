<?php
    include 'header.php';
    include 'config.php';

    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $query = "SELECT * FROM projects WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $project = $result->fetch_assoc();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $projectCategory = htmlspecialchars($_POST['project_category']);
        $projectTitle = htmlspecialchars($_POST['project_title']);
        $projectType = htmlspecialchars($_POST['project_type']);
        $projectDescription = htmlspecialchars($_POST['project_description']);
        $projectTestimonial = htmlspecialchars($_POST['project_testimonial']);
        $projectAuthor = htmlspecialchars($_POST['testimonial_author']);
        $projectCite = htmlspecialchars($_POST['testimonial_cite']);

        // Handle image upload
        $targetDir = "uploads/projects/";
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true); // Create directory if not exists
        }

        $newImagePath = $project['image']; // Default to existing image
        if (!empty($_FILES['project_image']['name'])) {
            $targetFile = $targetDir . basename($_FILES["project_image"]["name"]);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            // Validate the image file
            $check = getimagesize($_FILES["project_image"]["tmp_name"]);
            if ($check === false) {
                echo "<script>alert('File is not an image.');</script>";
                exit;
            }

            if ($_FILES["project_image"]["size"] > 5000000) {
                echo "<script>alert('Sorry, your file is too large.');</script>";
                exit;
            }

            $allowedFormats = ["jpg", "jpeg", "png", "gif"];
            if (!in_array($imageFileType, $allowedFormats)) {
                echo "<script>alert('Only JPG, JPEG, PNG, and GIF files are allowed.');</script>";
                exit;
            }

            if (move_uploaded_file($_FILES["project_image"]["tmp_name"], $targetFile)) {
                $newImagePath = $targetFile;

                // Optionally, delete the old image file
                if (file_exists($project['image']) && $project['image'] !== $newImagePath) {
                    unlink($project['image']);
                }
            } else {
                echo "<script>alert('Error uploading the image.');</script>";
                exit;
            }
        }

        // Update project details in the database
        $updateQuery = "UPDATE projects SET category = ?, title = ?, type = ?, description = ?, image = ?, testimonial = ?, testimonial_author = ?, testimonial_cite = ? WHERE id = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("ssssssssi", $projectCategory, $projectTitle, $projectType, $projectDescription, $newImagePath, $projectTestimonial, $projectAuthor, $projectCite, $id);

        if ($stmt->execute()) {
            echo "<script>alert('Project updated successfully.'); window.location.href = 'view_projects.php';</script>";
        } else {
            echo "<script>alert('Error updating project.');</script>";
        }

        $stmt->close();
    }

    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Project</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="project_category">Project Category</label>
                <input type="text" name="project_category" class="form-control" id="project_category" value="<?php echo $project['category']; ?>" required>
            </div>
            <div class="form-group">
                <label for="project_title">Project Title</label>
                <input type="text" name="project_title" class="form-control" id="project_title" value="<?php echo $project['title']; ?>" required>
            </div>
            <div class="form-group">
                <label for="project_type">Project Type</label>
                <input type="text" name="project_type" class="form-control" id="project_type" value="<?php echo $project['type']; ?>" required>
            </div>
            <div class="form-group">
                <label for="project_description">Project Description</label>
                <textarea name="project_description" class="form-control" id="project_description" rows="4" required><?php echo $project['description']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="project_image">Project Image</label>
                <input type="file" name="project_image" class="form-control" id="project_image" accept="image/*">
                <small class="text-muted">Current Image: <?php echo basename($project['image']); ?></small>
            </div>
            <div class="form-group">
                <label for="project_testimonial">Testimonial</label>
                <textarea name="project_testimonial" class="form-control" id="project_testimonial" rows="3"><?php echo $project['testimonial']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="testimonial_author">Testimonial Author</label>
                <input type="text" name="testimonial_author" class="form-control" id="testimonial_author" value="<?php echo $project['testimonial_author']; ?>">
            </div>
            <div class="form-group">
                <label for="testimonial_cite">Testimonial Cite</label>
                <input type="text" name="testimonial_cite" class="form-control" id="testimonial_cite" value="<?php echo $project['testimonial_cite']; ?>">
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update Project</button>
        </form>
    </div>
</body>
</html>
