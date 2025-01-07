<?php
include 'header.php';
include 'config.php';

$query = "SELECT * FROM work_experience";
$result = $conn->query($query);
?>

<div class="container-fluid">
    <div class="row">
        <?php include('sidebar.php'); ?>
        <div class="col-9 p-4">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h3 class="mb-0">Work Experience</h3>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Position</th>
                                <th>Company</th>
                                <th>Duration</th>
                                <th>Responsibilities</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()) { ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['position']); ?></td>
                                    <td><?= htmlspecialchars($row['company']); ?></td>
                                    <td><?= htmlspecialchars($row['duration']); ?></td>
                                    <td>
                                        <div style="max-height: 100px; overflow-y: auto;">
                                            <?= nl2br(htmlspecialchars($row['responsibilities'])); ?>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="edit_work.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="delete_work.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
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
