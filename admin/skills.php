<?php
    include 'header.php'; // Includes admin panel header

    // Database connection
    $servername = "localhost";
    $username = "root"; // Replace with your username
    $password = ""; // Replace with your password
    $dbname = "folio"; // Database name

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

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

<div class="container mt-5">
    
    <h2>Manage Skills</h2>

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
    <div class="mt-5">
    <h3>Existing Skills</h3>

    <!-- Display Technical Skills -->
    <h4>Technical Skills</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Skill Name</th>
                <th>Proficiency (%)</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $techSkillsQuery = "SELECT * FROM technical_skills";
            $techSkillsResult = $conn->query($techSkillsQuery);

            while ($row = $techSkillsResult->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['skill_name']}</td>
                        <td>{$row['proficiency']}%</td>
                        <td>
                            <a href='edit_skill.php?type=technical&id={$row['id']}' class='btn btn-sm btn-warning'>Edit</a>
                            <a href='delete_skill.php?type=technical&id={$row['id']}' class='btn btn-sm btn-danger' onclick=\"return confirm('Are you sure you want to delete this skill?');\">Delete</a>
                        </td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Display Professional Skills -->
    <h4>Professional Skills</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Skill Name</th>
                <th>Proficiency (%)</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $profSkillsQuery = "SELECT * FROM professional_skills";
            $profSkillsResult = $conn->query($profSkillsQuery);

            while ($row = $profSkillsResult->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['skill_name']}</td>
                        <td>{$row['proficiency']}%</td>
                        <td>
                            <a href='edit_skill.php?type=professional&id={$row['id']}' class='btn btn-sm btn-warning'>Edit</a>
                            <a href='delete_skill.php?type=professional&id={$row['id']}' class='btn btn-sm btn-danger' onclick=\"return confirm('Are you sure you want to delete this skill?');\">Delete</a>
                        </td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</div>

<?php
// Close connection after all queries and operations
$conn->close();
?>
<?php include('footer.php'); ?>
