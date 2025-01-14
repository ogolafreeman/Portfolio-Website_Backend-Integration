<?php
include 'header.php';
include 'config.php';

$query = "SELECT * FROM education";
$result = $conn->query($query);
?>

<div class="container-fluid">
    <div class="row">
        <?php include('sidebar.php'); ?>
        <div class="col-9 p-4">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h3 class="mb-0">Education Experience</h3>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Degree</th>
                                <th>Institution</th>
                                <th>Duration</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()) { ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['degree']); ?></td>
                                    <td><?= htmlspecialchars($row['institution']); ?></td>
                                    <td><?= htmlspecialchars($row['duration']); ?></td>
                                    <td><?= htmlspecialchars($row['description']); ?></td>
                                    <td>
                                        <a href="edit_education.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="delete_education.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
