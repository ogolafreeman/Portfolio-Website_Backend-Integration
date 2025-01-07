<?php
include 'header.php';
include 'config.php';

if (!isset($_GET['id'])) {
    echo "<script>alert('No message selected.'); window.location.href = 'view_messages.php';</script>";
    exit;
}

$id = intval($_GET['id']);
$query = "SELECT * FROM contact_messages WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$message = $result->fetch_assoc();
$stmt->close();

// Handle response submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $response = htmlspecialchars($_POST['response']);

    // Here you can send an email using PHP's `mail()` function or an email library like PHPMailer.
    $to = $message['email'];
    $subject = "Response to Your Message";
    $headers = "From: admin@example.com"; // Replace with your admin email

    if (mail($to, $subject, $response, $headers)) {
        echo "<script>alert('Response sent successfully!'); window.location.href = 'view_messages.php';</script>";
    } else {
        echo "<script>alert('Error sending response.');</script>";
    }
}
?>

<div class="container-fluid">
    <div class="row">
        <?php include('sidebar.php'); ?>
        <div class="col-9 p-4">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h3 class="mb-0">Respond to Message</h3>
                </div>
                <div class="card-body">
                    <h5>From: <?= htmlspecialchars($message['first_name'] . ' ' . $message['last_name']); ?></h5>
                    <h6>Email: <?= htmlspecialchars($message['email']); ?></h6>
                    <p><strong>Message:</strong> <?= nl2br(htmlspecialchars($message['message'])); ?></p>
                    <hr>
                    <form method="POST">
                        <div class="mb-3">
                            <label for="response" class="form-label">Your Response</label>
                            <textarea name="response" class="form-control" id="response" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Send Response</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
