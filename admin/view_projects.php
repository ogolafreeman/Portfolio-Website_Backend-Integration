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
                    <h3 class="mb-0">Projects List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Category</th>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $projectsQuery = "SELECT * FROM projects";
                            $projectsResult = $conn->query($projectsQuery);

                            if ($projectsResult->num_rows > 0) {
                                while ($row = $projectsResult->fetch_assoc()) {
                                    echo "
                                    <tr>
                                        <td>{$row['category']}</td>
                                        <td>{$row['title']}</td>
                                        <td>{$row['type']}</td>
                                        <td>" . (strlen($row['description']) > 50 ? substr($row['description'], 0, 50) . '...' : $row['description']) . "</td>
                                        <td>
                                            <img src='{$row['image']}' alt='Project Image' class='img-thumbnail' style='width: 100px; height: auto;'>
                                        </td>
                                        <td>
                                            <a href='edit_project.php?id={$row['id']}' class='btn btn-warning btn-sm'>
                                                <i class='fa fa-edit'></i> Edit
                                            </a>
                                            <a href='delete_project.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete this project?');\">
                                                <i class='fa fa-trash'></i> Delete
                                            </a>
                                        </td>
                                    </tr>";
                                }
                            } else {
                                echo "
                                <tr>
                                    <td colspan='6' class='text-center text-muted'>No projects found.</td>
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
