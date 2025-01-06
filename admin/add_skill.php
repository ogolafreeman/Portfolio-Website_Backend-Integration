<?php
    include 'header.php'; // Includes admin panel header
    

    // Database connection
    include 'config.php';

    // Handle Technical Skills Submission
    if (isset($_POST['add_technical_skill'])) {
        $techSkillName = htmlspecialchars($_POST['technical_skill_name']);
        $techSkillProficiency = htmlspecialchars($_POST['technical_skill_proficiency']);

        $insertTechSkillQuery = $conn->prepare("INSERT INTO technical_skills (skill_name, proficiency) VALUES (?, ?)");
        $insertTechSkillQuery->bind_param("si", $techSkillName, $techSkillProficiency);

        if ($insertTechSkillQuery->execute()) {
            echo "<script>alert('Technical Skill added successfully!');</script>";
        } else {
            echo "<script>alert('Error adding Technical Skill.');</script>";
        }

        $insertTechSkillQuery->close();
    }

    // Handle Professional Skills Submission
    if (isset($_POST['add_professional_skill'])) {
        $profSkillName = htmlspecialchars($_POST['professional_skill_name']);
        $profSkillProficiency = htmlspecialchars($_POST['professional_skill_proficiency']);

        $insertProfSkillQuery = $conn->prepare("INSERT INTO professional_skills (skill_name, proficiency) VALUES (?, ?)");
        $insertProfSkillQuery->bind_param("si", $profSkillName, $profSkillProficiency);

        if ($insertProfSkillQuery->execute()) {
            echo "<script>alert('Professional Skill added successfully!');</script>";
        } else {
            echo "<script>alert('Error adding Professional Skill.');</script>";
        }

        $insertProfSkillQuery->close();
    }

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-3">
            <?php include('sidebar.php'); ?>
        </div>
        <div class="col-9 p-4">
        <h2>Manage Skills</h2>
</br>
<!-- Technical Skills Form -->
<div class="row">
    
    <div class="col-md-6">
        <h3>Add Technical Skill</h3>
        <form method="POST">
            <div class="form-group">
                <label for="technical_skill_name">Skill Name</label>
                <input type="text" name="technical_skill_name" class="form-control" id="technical_skill_name" required>
            </div>
            <div class="form-group">
                <label for="technical_skill_proficiency">Proficiency (%)</label>
                <input type="number" name="technical_skill_proficiency" class="form-control" id="technical_skill_proficiency" min="0" max="100" required>
            </div>
</br>
            <button type="submit" name="add_technical_skill" class="btn btn-primary">Add Technical Skill</button>
        </form>
    </div>
     <!-- Professional Skills Form -->
     <div class="col-md-6">
            <h3>Add Professional Skill</h3>
            <form method="POST">
                <div class="form-group">
                    <label for="professional_skill_name">Skill Name</label>
                    <input type="text" name="professional_skill_name" class="form-control" id="professional_skill_name" required>
                </div>
                <div class="form-group">
                    <label for="professional_skill_proficiency">Proficiency (%)</label>
                    <input type="number" name="professional_skill_proficiency" class="form-control" id="professional_skill_proficiency" min="0" max="100" required>
                </div>
</br>
                <button type="submit" name="add_professional_skill" class="btn btn-primary">Add Professional Skill</button>
            </form>
        </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>