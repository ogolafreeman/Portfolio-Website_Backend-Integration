<?php
include 'header.php';
include 'config.php';

$query = "SELECT * FROM contact_messages ORDER BY submitted_at DESC";
$result = $conn->query($query);
?>

<div class="container-fluid">
    <div class="row">
        <?php include('sidebar.php'); ?>
        <div class="col-9 p-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Messages</h3>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th>Submitted At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()) { ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['first_name']); ?></td>
                                    <td><?= htmlspecialchars($row['last_name']); ?></td>
                                    <td><?= htmlspecialchars($row['email']); ?></td>
                                    <td>
                                        <div style="max-height: 100px; overflow-y: auto;">
                                            <?= nl2br(htmlspecialchars($row['message'])); ?>
                                        </div>
                                    </td>
                                    <td><?= htmlspecialchars($row['submitted_at']); ?></td>
                                    <td>
                                        <a href="respond_message.php?id=<?= $row['id']; ?>" class="btn btn-success btn-sm">Respond</a>
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
