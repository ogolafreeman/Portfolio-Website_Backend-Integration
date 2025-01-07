<?php
include 'header.php';
include 'config.php';

$query = "SELECT * FROM blog_posts ORDER BY created_at DESC";
$result = $conn->query($query);
?>

<div class="container-fluid">
    <div class="row">
        <?php include('sidebar.php'); ?>
        <div class="col-9 p-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Blogs</h3>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Author</th>
                                <th>Image</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()) { ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['title']); ?></td>
                                    <td>
                                        <div style="max-height: 100px; overflow-y: auto;">
                                            <?= nl2br(htmlspecialchars(substr($row['content'], 0, 100))); ?>...
                                        </div>
                                    </td>
                                    <td><?= htmlspecialchars($row['author']); ?></td>
                                    <td><img src="<?= htmlspecialchars($row['image']); ?>" alt="Blog Image" style="width: 100px;"></td>
                                    <td><?= htmlspecialchars($row['created_at']); ?></td>
                                    <td>
                                        <a href="edit_blog.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="delete_blog.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this blog?');">Delete</a>
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
