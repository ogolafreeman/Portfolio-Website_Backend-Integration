<?php
include 'header.php'; // Includes admin panel header
include 'config.php'; // Includes database connection

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
        <?php include('sidebar.php'); ?>
        <div class="col-9 p-4">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Manage Skills</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Technical Skills Form -->
                        <div class="col-md-6 mb-4">
                            <h4>Add Technical Skill</h4>
                            <form method="POST">
                                <div class="mb-3">
                                    <label for="technical_skill_name" class="form-label">Skill Name</label>
                                    <input type="text" name="technical_skill_name" class="form-control" id="technical_skill_name" placeholder="e.g., JavaScript" required>
                                </div>
                                <div class="mb-3">
                                    <label for="technical_skill_proficiency" class="form-label">Proficiency (%)</label>
                                    <input type="number" name="technical_skill_proficiency" class="form-control" id="technical_skill_proficiency" min="0" max="100" placeholder="e.g., 85" required>
                                </div>
                                <button type="submit" name="add_technical_skill" class="btn btn-success w-100">Add Technical Skill</button>
                            </form>
                        </div>

                        <!-- Professional Skills Form -->
                        <div class="col-md-6">
                            <h4>Add Professional Skill</h4>
                            <form method="POST">
                                <div class="mb-3">
                                    <label for="professional_skill_name" class="form-label">Skill Name</label>
                                    <input type="text" name="professional_skill_name" class="form-control" id="professional_skill_name" placeholder="e.g., Communication" required>
                                </div>
                                <div class="mb-3">
                                    <label for="professional_skill_proficiency" class="form-label">Proficiency (%)</label>
                                    <input type="number" name="professional_skill_proficiency" class="form-control" id="professional_skill_proficiency" min="0" max="100" placeholder="e.g., 90" required>
                                </div>
                                <button type="submit" name="add_professional_skill" class="btn btn-success w-100">Add Professional Skill</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
