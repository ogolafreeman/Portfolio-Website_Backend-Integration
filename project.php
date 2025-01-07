<?php
include 'header.php'; // Includes meta tags and stylesheets

// Database connection
include('config.php');

// Fetch projects data
$projectsQuery = "SELECT * FROM projects";
$projectsResult = $conn->query($projectsQuery);
?>

<section class="mh-featured-project image-bg featured-img-one">
    <div class="img-color-overlay">
        <div class="container">
            <div class="row section-separator">
                <div class="section-title col-sm-12">
                    <h3>Featured Projects</h3>
                </div>

                <?php if ($projectsResult->num_rows > 0): ?>
                    <?php while ($project = $projectsResult->fetch_assoc()): ?>
                        <div class="col-sm-6 col-md-4 mb-4">
                            <div class="card shadow bg-dark text-white">
                                <img src="admin/<?php echo htmlspecialchars($project['image']); ?>" alt="Project Image" class="card-img-top img-fluid" style="height: 300px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($project['title']); ?></h5>
                                    <p class="card-text"><?php echo htmlspecialchars($project['description']); ?></p>
                                    <p><strong>Category:</strong> <?php echo htmlspecialchars($project['category']); ?></p>
                                    <p><strong>Type:</strong> <?php echo htmlspecialchars($project['type']); ?></p>
                                    <a href="#" class="btn btn-primary">View Details</a>

                                    <?php if (!empty($project['testimonial'])): ?>
                                        <div class="mt-3">
                                            <blockquote class="blockquote">
                                                <p class="mb-0"><?php echo htmlspecialchars($project['testimonial']); ?></p>
                                                <footer class="blockquote-footer text-white-50"><?php echo htmlspecialchars($project['testimonial_author']); ?>, <cite><?php echo htmlspecialchars($project['testimonial_cite']); ?></cite></footer>
                                            </blockquote>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="text-center">No featured projects available at the moment.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php
$conn->close();
?>
