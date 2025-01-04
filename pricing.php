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

    // Fetch pricing data
    $pricingQuery = "SELECT * FROM pricing";
    $pricingResult = $conn->query($pricingQuery);
?>

<section class="mh-pricing" id="mh-pricing">
    <div class="">
        <div class="container">
            <div class="row section-separator">
                <div class="col-sm-12 section-title wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.2s">
                    <h3>Pricing Table</h3>
                </div>

                <?php if ($pricingResult->num_rows > 0): ?>
                    <?php while ($plan = $pricingResult->fetch_assoc()): ?>
                        <div class="col-sm-12 col-md-4">
                            <div class="mh-pricing dark-bg shadow-2 wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.3s">
                                <i class="<?php echo $plan['icon']; ?>"></i>
                                <h4><?php echo $plan['type']; ?></h4>
                                <p><?php echo $plan['description']; ?></p>
                                <h5>$<?php echo number_format($plan['price'], 2); ?></h5>
                                <ul>
                                    <?php 
                                        $features = explode(',', $plan['features']);
                                        foreach ($features as $feature): 
                                    ?>
                                        <li><?php echo trim($feature); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                <a href="#" class="btn btn-fill">Hire Me</a>
                            </div>  
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No pricing plans available.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php
    $conn->close();
?>
