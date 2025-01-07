<?php
include 'header.php';
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $type = htmlspecialchars($_POST['type']);
    $description = htmlspecialchars($_POST['description']);
    $price = htmlspecialchars($_POST['price']);
    $icon = htmlspecialchars($_POST['icon']);
    $features = htmlspecialchars($_POST['features']);

    $query = "INSERT INTO pricing (type, description, price, icon, features) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssdss", $type, $description, $price, $icon, $features);

    if ($stmt->execute()) {
        echo "<script>alert('Pricing plan added successfully!'); window.location.href = 'view_pricing.php';</script>";
    } else {
        echo "<script>alert('Error adding pricing plan.');</script>";
    }

    $stmt->close();
}
?>

<div class="container-fluid">
    <div class="row">
        <?php include('sidebar.php'); ?>
        <div class="col-9 p-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Add Pricing</h3>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label for="type" class="form-label">Plan Type</label>
                            <input type="text" name="type" class="form-control" id="type" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control" id="description" rows="4" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" step="0.01" name="price" class="form-control" id="price" required>
                        </div>
                        <div class="mb-3">
                            <label for="icon" class="form-label">Icon (Font Awesome Class)</label>
                            <input type="text" name="icon" class="form-control" id="icon" required>
                        </div>
                        <div class="mb-3">
                            <label for="features" class="form-label">Features (comma-separated)</label>
                            <textarea name="features" class="form-control" id="features" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Add Pricing Plan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
