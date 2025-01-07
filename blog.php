<?php
    include 'header.php'; // Includes meta tags and stylesheets

    // Database connection
    $servername = "localhost";
    $username = "root"; // Replace with your username
    $password = ""; // Replace with your password
    $dbname = "folio"; // Database name

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch blog posts
    $blogQuery = "SELECT * FROM blog_posts ORDER BY post_date DESC";
    $blogResult = $conn->query($blogQuery);
?>

<section class="mh-blog image-bg featured-img-two" id="mh-blog">
    <div class="img-color-overlay">
        <div class="container">
            <div class="row section-separator">
                <div class="col-sm-12 section-title wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.2s">
                    <h3>Featured Posts</h3>
                </div>

                <?php if ($blogResult->num_rows > 0): ?>
                    <?php while ($blog = $blogResult->fetch_assoc()): ?>
                        <div class="col-sm-12 col-md-4">
                            <div class="mh-blog-item dark-bg wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.3s">
                                <!-- Ensure the correct relative path -->
                                <img src="admin/<?php echo htmlspecialchars($blog['image']); ?>" alt="Blog Image" class="img-fluid">
                                <div class="blog-inner">
                                    <h2><a href="<?php echo htmlspecialchars($blog['read_more_link']); ?>"><?php echo htmlspecialchars($blog['title']); ?></a></h2>
                                    <div class="mh-blog-post-info">
                                        <ul>
                                            <li><strong>Post On</strong><a href="#"><?php echo htmlspecialchars($blog['post_date']); ?></a></li>
                                            <li><strong>By</strong><a href="#"><?php echo htmlspecialchars($blog['author']); ?></a></li>
                                        </ul>
                                    </div>
                                    <p><?php echo htmlspecialchars(substr($blog['content'], 0, 100)); ?>...</p>
                                    <a href="<?php echo htmlspecialchars($blog['read_more_link']); ?>">Read More</a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="text-center">No blog posts available at the moment.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php
    $conn->close();
?>
