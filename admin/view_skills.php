<?php
    include 'header.php'; // Includes admin panel header
    

    // Database connection
    include 'config.php';

?>
<div class="container-fluid">
    <div class="row">
            <?php include('sidebar.php'); ?>
        <div class="col-9 p-4">
        <h2>View Skills</h2>
</br>
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

<?php include('footer.php'); ?>