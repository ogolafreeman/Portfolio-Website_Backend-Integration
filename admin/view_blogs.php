<?php
include 'header.php';
include 'config.php';

// Fetch blog posts
$blogsQuery = "SELECT * FROM blog_posts ORDER BY created_at DESC";
$blogsResult = $conn->query($blogsQuery);
?>

<div class="container-fluid">
    <div class="row">
        <?php include('sidebar.php'); ?>
        <div class="col-9 p-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Blog Posts</h3>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Post Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $blogsResult->fetch_assoc()) { ?>
                                <tr>
                                    <!-- Blog Image Preview -->
                                    <td style="width: 150px;">
                                        <img src="<?= htmlspecialchars($row['image']); ?>" alt="Blog Image" class="img-fluid rounded" style="max-height: 100px;">
                                    </td>
                                    <!-- Blog Details -->
                                    <td><?= htmlspecialchars($row['title']); ?></td>
                                    <td><?= htmlspecialchars($row['author']); ?></td>
                                    <td><?= htmlspecialchars($row['post_date']); ?></td>
                                    <td>
                                        <a href="edit_blog.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="delete_blog.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this blog post?');">Delete</a>
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
