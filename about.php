<?php
    // Main index file
    include 'header.php'; // Includes meta tags and stylesheets
    include('config.php'); 
    // Fetch "About Me" data
    $sql = "SELECT * FROM about_me WHERE id = 1"; // Adjust ID as needed
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $aboutData = $result->fetch_assoc();
        $name = $aboutData['name'];
        $location = $aboutData['location'];
        $description = $aboutData['description'];
        $skills = explode(',', $aboutData['skills']);
    } else {
        echo "No data found in the database!";
    }

    $conn->close();
?>

<section class="mh-about" id="mh-about">
    <div class="container">
        <div class="row section-separator">
            <div class="col-sm-12 col-md-6">
                <div class="mh-about-img shadow-2 wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.4s">
                    <img src="assets/images/ab-img.png" alt="About Image" class="img-fluid">
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="mh-about-inner">
                    <h2 class="wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.1s">About Me</h2>
                    <p class="wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.2s">
                        <?php echo $description; ?>
                    </p>
                    <div class="mh-about-tag wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.3s">
                        <ul>
                            <?php foreach ($skills as $skill) : ?>
                                <li><span><?php echo trim($skill); ?></span></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <a href="download_cv.php" class="btn btn-fill wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.4s">
                        Download CV <i class="fa fa-download"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
