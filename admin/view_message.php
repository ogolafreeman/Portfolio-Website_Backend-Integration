<?php 
include 'header.php';
include 'config.php';

if (isset($_GET['id'])) {
    $messageId = intval($_GET['id']);

    // Mark message as read
    $updateQuery = "UPDATE contact_messages SET read_status = 1 WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("i", $messageId);
    $stmt->execute();

    // Fetch message details
    $query = "SELECT * FROM contact_messages WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $messageId);
    $stmt->execute();
    $result = $stmt->get_result();
    $message = $result->fetch_assoc();
}

if (!$message) {
    echo "<div class='alert alert-danger text-center mt-5'>Message not found.</div>";
    exit;
}
?>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <?php include('sidebar.php'); ?>

        <!-- Main Content -->
        <div class="col-9 p-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Message Details</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Name:</strong> <?= htmlspecialchars($message['first_name'] . ' ' . $message['last_name']); ?></p>
                            <p><strong>Email:</strong> <a href="mailto:<?= htmlspecialchars($message['email']); ?>"><?= htmlspecialchars($message['email']); ?></a></p>
                            <p><strong>Submitted At:</strong> <?= htmlspecialchars($message['submitted_at']); ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Message:</strong></p>
                            <div class="bg-light border rounded p-3" style="max-height: 300px; overflow-y: auto;">
                                <?= nl2br(htmlspecialchars($message['message'])); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <a href="view_messages.php" class="btn btn-secondary">Back to Messages</a>
                    <a href="respond_message.php?id=<?= $message['id']; ?>" class="btn btn-success">Respond</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
