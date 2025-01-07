<?php
include 'header.php';
include 'config.php';

// Fetch messages
$messageQuery = "SELECT * FROM contact_messages ORDER BY read_status ASC, submitted_at DESC";
$messages = $conn->query($messageQuery);

// Handle "Mark All as Read"
if (isset($_POST['mark_all_read'])) {
    $updateAllQuery = "UPDATE contact_messages SET read_status = 1";
    $conn->query($updateAllQuery);
    header("Location: view_messages.php");
    exit;
}
?>

<div class="container-fluid">
    <div class="row">
        <?php include('sidebar.php'); ?>
        <div class="col-9 p-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Messages</h3>
                    <form method="POST">
                        <button type="submit" name="mark_all_read" class="btn btn-success btn-sm">Mark All as Read</button>
                    </form>
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
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $messages->fetch_assoc()) { ?>
                                <tr class="<?= $row['read_status'] == 0 ? 'table-warning' : ''; ?>">
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
                                        <?php if ($row['read_status'] == 0) { ?>
                                            <span class="badge bg-danger">Unread</span>
                                        <?php } else { ?>
                                            <span class="badge bg-success">Read</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a href="view_message.php?id=<?= $row['id']; ?>" class="btn btn-primary btn-sm">View</a>
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
