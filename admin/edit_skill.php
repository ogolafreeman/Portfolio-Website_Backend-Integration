<?php
include 'config.php';
    include 'header.php'; // Includes admin panel header
   

    if (isset($_GET['type']) && isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $type = $_GET['type'];

        if ($type === 'technical') {
            $query = "SELECT * FROM technical_skills WHERE id = ?";
        } elseif ($type === 'professional') {
            $query = "SELECT * FROM professional_skills WHERE id = ?";
        } else {
            die("Invalid skill type.");
        }

        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $skill = $result->fetch_assoc();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $skillName = htmlspecialchars($_POST['skill_name']);
        $skillProficiency = htmlspecialchars($_POST['skill_proficiency']);

        if ($type === 'technical') {
            $updateQuery = "UPDATE technical_skills SET skill_name = ?, proficiency = ? WHERE id = ?";
        } elseif ($type === 'professional') {
            $updateQuery = "UPDATE professional_skills SET skill_name = ?, proficiency = ? WHERE id = ?";
        }

        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("sii", $skillName, $skillProficiency, $id);

        if ($updateStmt->execute()) {
            echo "<script>alert('Skill updated successfully.'); window.location.href = 'skills.php';</script>";
        } else {
            echo "<script>alert('Error updating skill.');</script>";
        }

        $updateStmt->close();
    }

    $conn->close();
?>

<!-- Edit Skill Form -->
<div class="container mt-5">
    <h2>Edit Skill</h2>
    <form method="POST">
        <div class="form-group">
            <label for="skill_name">Skill Name</label>
            <input type="text" name="skill_name" class="form-control" id="skill_name" value="<?php echo $skill['skill_name']; ?>" required>
        </div>
        <div class="form-group">
            <label for="skill_proficiency">Proficiency (%)</label>
            <input type="number" name="skill_proficiency" class="form-control" id="skill_proficiency" min="0" max="100" value="<?php echo $skill['proficiency']; ?>" required>
        </div>
</br>
        <button type="submit" class="btn btn-primary">Update Skill</button>
    </form>
</div>
