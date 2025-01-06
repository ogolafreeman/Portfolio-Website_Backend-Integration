<?php
    include 'header.php'; // Includes admin panel header
    

    // Database connection
    include 'config.php';

?>
<div class="container-fluid">
    <div class="row">
            <?php include('sidebar.php'); ?>
        <div class="col-9 p-4">
        <table class="table table-bordered">
    <thead>
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

        while ($row = $projectsResult->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['category']}</td>
                    <td>{$row['title']}</td>
                    <td>{$row['type']}</td>
                    <td>{$row['description']}</td>
                    <td><img src='{$row['image']}' alt='Project Image' style='width:100px;'></td>
                    <td>
                        <a href='edit_project.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                        <a href='delete_project.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete this project?');\">Delete</a>
                    </td>
                  </tr>";
        }
        ?>
    </tbody>
</table>
</div>
</div>