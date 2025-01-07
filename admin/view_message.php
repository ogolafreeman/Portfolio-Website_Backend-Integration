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
    echo "Message not found.";
    exit;
}
?>

<div class="container mt-5">
    <h1>Message Details</h1>
    <p><strong>Name:</strong> <?= htmlspecialchars($message['first_name'] . ' ' . $message['last_name']); ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($message['email']); ?></p>
    <p><strong>Message:</strong></p>
    <p><?= nl2br(htmlspecialchars($message['message'])); ?></p>
    <p><strong>Submitted At:</strong> <?= htmlspecialchars($message['submitted_at']); ?></p>
    <a href="view_messages.php" class="btn btn-primary">Back to Messages</a>
</div>

<?php include('footer.php'); ?>
