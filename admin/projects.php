<?php
    include 'header.php'; // Includes admin panel header

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "folio";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_POST['add_project'])) {
        $projectCategory = htmlspecialchars($_POST['project_category']);
        $projectTitle = htmlspecialchars($_POST['project_title']);
        $projectType = htmlspecialchars($_POST['project_type']);
        $projectDescription = htmlspecialchars($_POST['project_description']);
        $projectTestimonial = htmlspecialchars($_POST['project_testimonial']);
        $projectAuthor = htmlspecialchars($_POST['testimonial_author']);
        $projectCite = htmlspecialchars($_POST['testimonial_cite']);
    
        // Handle file upload
        $targetDir = "uploads/projects/"; // Directory to store uploaded files
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true); // Create directory if not exists
        }
    
        $targetFile = $targetDir . basename($_FILES["project_image"]["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
        // Check if file is an actual image
        $check = getimagesize($_FILES["project_image"]["tmp_name"]);
        if ($check === false) {
            echo "<script>alert('File is not an image.');</script>";
            exit;
        }
    
        // Check file size (max 5MB)
        if ($_FILES["project_image"]["size"] > 5000000) {
            echo "<script>alert('Sorry, your file is too large.');</script>";
            exit;
        }
    
        // Allow certain file formats
        $allowedFormats = ["jpg", "png", "jpeg", "gif"];
        if (!in_array($imageFileType, $allowedFormats)) {
            echo "<script>alert('Only JPG, JPEG, PNG, and GIF files are allowed.');</script>";
            exit;
        }
    
        // Move the uploaded file to the server
        if (!move_uploaded_file($_FILES["project_image"]["tmp_name"], $targetFile)) {
            echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
            exit;
        }
    
        // Insert project data into the database
        $insertProjectQuery = $conn->prepare("INSERT INTO projects (category, title, type, description, image, testimonial, testimonial_author, testimonial_cite) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $insertProjectQuery->bind_param("ssssssss", $projectCategory, $projectTitle, $projectType, $projectDescription, $targetFile, $projectTestimonial, $projectAuthor, $projectCite);
    
        if ($insertProjectQuery->execute()) {
            echo "<script>alert('Project added successfully!');</script>";
        } else {
            echo "<script>alert('Error adding project.');</script>";
        }
    
        $insertProjectQuery->close();
    }
    
?>
<div class="container mt-5">
    <h2>Manage Projects</h2>

    <div class="row">
    <div class="col-md-12">
        <h3>Add New Project</h3>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="project_category">Project Category</label>
                <input type="text" name="project_category" class="form-control" id="project_category" required>
            </div>
            <div class="form-group">
                <label for="project_title">Project Title</label>
                <input type="text" name="project_title" class="form-control" id="project_title" required>
            </div>
            <div class="form-group">
                <label for="project_type">Project Type</label>
                <input type="text" name="project_type" class="form-control" id="project_type" required>
            </div>
            <div class="form-group">
                <label for="project_description">Project Description</label>
                <textarea name="project_description" class="form-control" id="project_description" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="project_image">Project Image</label>
                <input type="file" name="project_image" class="form-control" id="project_image" accept="image/*" required>
            </div>
            <div class="form-group">
                <label for="project_testimonial">Testimonial</label>
                <textarea name="project_testimonial" class="form-control" id="project_testimonial" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="testimonial_author">Testimonial Author</label>
                <input type="text" name="testimonial_author" class="form-control" id="testimonial_author">
            </div>
            <div class="form-group">
                <label for="testimonial_cite">Testimonial Cite</label>
                <input type="text" name="testimonial_cite" class="form-control" id="testimonial_cite">
            </div>
</br>
            <button type="submit" name="add_project" class="btn btn-primary">Add Project</button>
            <button href="projectlist.php" name="projectlist" class="btn btn-primary">View Project</button>
        </form> 
        </form>
    </div>
</div>

</div>