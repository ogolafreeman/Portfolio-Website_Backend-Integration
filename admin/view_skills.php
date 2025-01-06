<?php
include 'header.php'; // Includes admin panel header
include 'config.php'; // Includes database connection
?>
<div class="container-fluid">
    <div class="row">
        <?php include('sidebar.php'); // Includes the sidebar ?>
        <div class="col-9 p-4">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">View Skills</h3>
                </div>
                <div class="card-body">
                    <!-- Display Technical Skills -->
                    <h4 class="mb-4">Technical Skills</h4>
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-dark">
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

                            if ($techSkillsResult->num_rows > 0) {
                                while ($row = $techSkillsResult->fetch_assoc()) {
                                    echo "
                                    <tr>
                                        <td>{$row['skill_name']}</td>
                                        <td>{$row['proficiency']}%</td>
                                        <td>
                                            <a href='edit_skill.php?type=technical&id={$row['id']}' class='btn btn-warning btn-sm'>
                                                <i class='fa fa-edit'></i> Edit
                                            </a>
                                            <a href='delete_skill.php?type=technical&id={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete this skill?');\">
                                                <i class='fa fa-trash'></i> Delete
                                            </a>
                                        </td>
                                    </tr>";
                                }
                            } else {
                                echo "
                                <tr>
                                    <td colspan='3' class='text-center text-muted'>No technical skills found.</td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>

                    <!-- Display Professional Skills -->
                    <h4 class="mt-5 mb-4">Professional Skills</h4>
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-dark">
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

                            if ($profSkillsResult->num_rows > 0) {
                                while ($row = $profSkillsResult->fetch_assoc()) {
                                    echo "
                                    <tr>
                                        <td>{$row['skill_name']}</td>
                                        <td>{$row['proficiency']}%</td>
                                        <td>
                                            <a href='edit_skill.php?type=professional&id={$row['id']}' class='btn btn-warning btn-sm'>
                                                <i class='fa fa-edit'></i> Edit
                                            </a>
                                            <a href='delete_skill.php?type=professional&id={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete this skill?');\">
                                                <i class='fa fa-trash'></i> Delete
                                            </a>
                                        </td>
                                    </tr>";
                                }
                            } else {
                                echo "
                                <tr>
                                    <td colspan='3' class='text-center text-muted'>No professional skills found.</td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
