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

    // Fetch education details
    $educationQuery = "SELECT * FROM education";
    $educationResult = $conn->query($educationQuery);

    // Fetch work experience details
    $workQuery = "SELECT * FROM work_experience";
    $workResult = $conn->query($workQuery);
?>

<!-- ===================
        EXPERIENCES
=================== -->
<section class="mh-experince image-bg featured-img-one" id="mh-experience">
    <div class="img-color-overlay">
        <div class="container">
            <div class="row section-separator">
                <!-- Education Section -->
                <div class="col-sm-12 col-md-6">
                    <div class="mh-education">
                        <h3 class="wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.2s">Education</h3>
                        <div class="mh-education-deatils">
                            <?php if ($educationResult->num_rows > 0): ?>
                                <?php while ($edu = $educationResult->fetch_assoc()): ?>
                                    <div class="mh-education-item dark-bg wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.3s">
                                        <h4><?php echo $edu['degree']; ?> From <a href="#"><?php echo $edu['institution']; ?></a></h4>
                                        <div class="mh-eduyear"><?php echo $edu['duration']; ?></div>
                                        <p><?php echo $edu['description']; ?></p>
                                    </div>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <p>No education details found.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Work Experience Section -->
                <div class="col-sm-12 col-md-6">
                    <div class="mh-work">
                        <h3>Work Experience</h3>
                        <div class="mh-experience-deatils">
                            <?php if ($workResult->num_rows > 0): ?>
                                <?php while ($work = $workResult->fetch_assoc()): ?>
                                    <div class="mh-work-item dark-bg wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.4s">
                                        <h4><?php echo $work['position']; ?> <a href="#"><?php echo $work['company']; ?></a></h4>
                                        <div class="mh-eduyear"><?php echo $work['duration']; ?></div>
                                        <span>Responsibility :</span>
                                        <ul class="work-responsibility">
                                            <?php 
                                                $responsibilities = explode(',', $work['responsibilities']);
                                                foreach ($responsibilities as $responsibility): 
                                            ?>
                                                <li><i class="fa fa-circle"></i><?php echo trim($responsibility); ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <p>No work experience found.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
    $conn->close();
?>
