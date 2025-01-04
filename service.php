<?php
    include 'header.php'; // Includes meta tags and stylesheets

    // Database connection
    include('config.php'); 

    // Fetch services data
    $servicesQuery = "SELECT * FROM services";
    $servicesResult = $conn->query($servicesQuery);
?>

<!-- ===================
        SERVICES
=================== -->
<section class="mh-service">
    <div class="container">
        <div class="row section-separator">
            <div class="col-sm-12 text-center section-title wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.2s">
                <h2>What I do</h2>
            </div>

            <?php if ($servicesResult->num_rows > 0): ?>
                <?php while ($service = $servicesResult->fetch_assoc()): ?>
                    <div class="col-sm-4">
                        <div class="mh-service-item shadow-1 dark-bg wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.3s">
                            <i class="<?php echo $service['icon']; ?>"></i>
                            <h3><?php echo $service['title']; ?></h3>
                            <p><?php echo $service['description']; ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-center">No services available at the moment.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php
    $conn->close();
?>
