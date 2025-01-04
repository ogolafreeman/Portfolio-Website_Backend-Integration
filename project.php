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
                        <div class="col-sm-12 mh-featured-item">
                            <div class="row">
                                <div class="col-sm-7">
                                    <div class="mh-featured-project-img shadow-2 wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.2s">
                                        <img src="<?php echo $project['image']; ?>" alt="Project Image" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="mh-featured-project-content">
                                        <h4 class="project-category wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.4s"><?php echo $project['category']; ?></h4>
                                        <h2 class="wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.5s"><?php echo $project['title']; ?></h2>
                                        <span class="wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.6s"><?php echo $project['type']; ?></span>
                                        <p class="wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.7s"><?php echo $project['description']; ?></p>
                                        <a href="#" class="btn btn-fill wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.7s">View Details</a>

                                        <?php if ($project['testimonial']): ?>
                                            <div class="mh-testimonial mh-project-testimonial wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.9s">
                                                <blockquote>
                                                    <q><?php echo $project['testimonial']; ?></q>
                                                    <cite>- <?php echo $project['testimonial_author']; ?>, <?php echo $project['testimonial_cite']; ?></cite>
                                                </blockquote>
                                            </div>
                                        <?php endif; ?>
                                    </div>
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
