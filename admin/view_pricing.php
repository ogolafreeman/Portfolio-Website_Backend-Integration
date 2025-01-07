<?php
include 'header.php';
include 'config.php';

$query = "SELECT * FROM pricing";
$result = $conn->query($query);
?>

<div class="container-fluid">
    <div class="row">
        <?php include('sidebar.php'); ?>
        <div class="col-9 p-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Pricing Plans</h3>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Type</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Icon</th>
                                <th>Features</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()) { ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['type']); ?></td>
                                    <td><?= htmlspecialchars($row['description']); ?></td>
                                    <td>$<?= htmlspecialchars(number_format($row['price'], 2)); ?></td>
                                    <td><i class="<?= htmlspecialchars($row['icon']); ?>"></i></td>
                                    <td>
                                        <ul>
                                            <?php foreach (explode(',', $row['features']) as $feature) { ?>
                                                <li><?= htmlspecialchars(trim($feature)); ?></li>
                                            <?php } ?>
                                        </ul>
                                    </td>
                                    <td>
                                        <a href="edit_pricing.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="delete_pricing.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this plan?');">Delete</a>
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
