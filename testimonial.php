<?php
    include 'header.php'; // Includes meta tags and stylesheets

    // Database connection
    include('config.php'); 
    // Fetch testimonials
    $testimonialQuery = "SELECT * FROM testimonials";
    $testimonialResult = $conn->query($testimonialQuery);
?>

<!-- ===================
        Testimonials
=================== -->
<section class="mh-testimonial" id="mh-testimonial">
    <div class="home-v-img">
        <div class="container">
            <div class="row section-separator">
                <div class="col-sm-12 section-title wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.2s">
                    <h3>Client Reviews</h3>
                </div>
                <div class="col-sm-12 wow fadeInUp" id="mh-client-review" data-wow-duration="0.8s" data-wow-delay="0.3s">
                    <?php if ($testimonialResult->num_rows > 0): ?>
                        <?php while ($testimonial = $testimonialResult->fetch_assoc()): ?>
                            <div class="each-client-item">
                                <div class="mh-client-item dark-bg black-shadow-1">
                                    <img src="<?php echo $testimonial['client_image']; ?>" alt="Client Image" class="img-fluid">
                                    <p><?php echo $testimonial['review']; ?></p>
                                    <h4><?php echo $testimonial['client_name']; ?></h4>
                                    <span><?php echo $testimonial['client_title']; ?></span>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>No testimonials available at the moment.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
    $conn->close();
?>
