<?php
include 'navbar.php'; // Includes navigation bar

// Database connection
include('config.php'); 

// Fetch data from `home_section` table
$sql = "SELECT * FROM home_section WHERE id = 1"; // Adjust ID as needed
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $homeData = $result->fetch_assoc();
    $name = $homeData['name'];
    $title = $homeData['title'];
    $email = $homeData['email'];
    $phone = $homeData['phone'];
    $address = $homeData['address'];
    $facebook = $homeData['facebook_link'];
    $twitter = $homeData['twitter_link'];
    $github = $homeData['github_link'];
    $dribbble = $homeData['dribbble_link'];
} else {
    echo "No data found in the database!";
}

$conn->close();
?>

<!-- ===================
        Home
=================== -->
<section class="mh-home image-bg home-2-img" id="mh-home">
    <div class="img-foverlay img-color-overlay">
        <div class="container">
            <div class="row section-separator xs-column-reverse vertical-middle-content home-padding">
                <div class="col-sm-6">
                    <div class="mh-header-info">
                        <div class="mh-promo wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.1s">
                            <span>Hello I'm</span>
                        </div>
                        
                        <h2 class="wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.2s"><?php echo $name; ?></h2>
                        <h4 class="wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.3s"><?php echo $title; ?></h4>
                        
                        <ul>
                            <li class="wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.4s">
                                <i class="fa fa-envelope"></i>
                                <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
                            </li>
                            <li class="wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.5s">
                                <i class="fa fa-phone"></i>
                                <a href="callto:<?php echo $phone; ?>"><?php echo $phone; ?></a>
                            </li>
                            <li class="wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.6s">
                                <i class="fa fa-map-marker"></i>
                                <address><?php echo $address; ?></address>
                            </li>
                        </ul>
                        
                        <ul class="social-icon wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.7s">
                            <li><a href="<?php echo $facebook; ?>"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="<?php echo $twitter; ?>"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="<?php echo $github; ?>"><i class="fa fa-github"></i></a></li>
                            <li><a href="<?php echo $dribbble; ?>"><i class="fa fa-dribbble"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="hero-img wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.6s">
                        <div class="img-border">
                            <img src="assets/images/hero.png" alt="Hero Image" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
