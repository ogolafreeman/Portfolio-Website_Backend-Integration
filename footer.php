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

    // Fetch contact information
    $contactInfoQuery = "SELECT * FROM contact_info LIMIT 1";
    $contactInfoResult = $conn->query($contactInfoQuery);
    $contactInfo = $contactInfoResult->fetch_assoc();

    // Fetch social media links
    $socialLinksQuery = "SELECT * FROM social_links";
    $socialLinksResult = $conn->query($socialLinksQuery);

    // Handle contact form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $firstName = htmlspecialchars($_POST['first_name']);
        $lastName = htmlspecialchars($_POST['last_name']);
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);

        $insertMessageQuery = $conn->prepare("INSERT INTO contact_messages (first_name, last_name, email, message) VALUES (?, ?, ?, ?)");
        $insertMessageQuery->bind_param("ssss", $firstName, $lastName, $email, $message);

        if ($insertMessageQuery->execute()) {
            echo "<script>alert('Your message has been sent successfully!');</script>";
        } else {
            echo "<script>alert('There was an error sending your message. Please try again.');</script>";
        }

        $insertMessageQuery->close();
    }

    $conn->close();
?>
<footer class="mh-footer mh-footer-3">
    <div class="container-fluid">
        <div class="row section-separator">
            <div class="col-sm-12 section-title wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.2s">
                <h3>Contact Me</h3>
            </div>
            <div class="map-image image-bg col-sm-12">
                <div class="container mt-30">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 mh-footer-address">
                            <!-- Dynamic Address -->
                            <div class="col-sm-12 xs-no-padding">
                                <div class="mh-address-footer-item dark-bg shadow-1 media wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.2s">
                                    <div class="each-icon">
                                        <i class="fa fa-location-arrow"></i>
                                    </div>
                                    <div class="each-info media-body">
                                        <h4>Address</h4>
                                        <address>
                                            <?php echo $contactInfo['address']; ?>
                                        </address>
                                    </div>
                                </div>
                            </div>
                            <!-- Dynamic Email -->
                            <div class="col-sm-12 xs-no-padding">
                                <div class="mh-address-footer-item media dark-bg shadow-1 wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.4s">
                                    <div class="each-icon">
                                        <i class="fa fa-envelope-o"></i>
                                    </div>
                                    <div class="each-info media-body">
                                        <h4>Email</h4>
                                        <a href="mailto:<?php echo $contactInfo['email']; ?>"><?php echo $contactInfo['email']; ?></a>
                                    </div>
                                </div>
                            </div>
                            <!-- Dynamic Phone -->
                            <div class="col-sm-12 xs-no-padding">
                                <div class="mh-address-footer-item media dark-bg shadow-1 wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.6s">
                                    <div class="each-icon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <div class="each-info media-body">
                                        <h4>Phone</h4>
                                        <a href="callto:<?php echo $contactInfo['phone']; ?>"><?php echo $contactInfo['phone']; ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Form -->
                        <div class="col-sm-12 col-md-6 wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.2s">
                            <form method="POST" id="contactForm" class="single-form quate-form wow fadeInUp" data-toggle="validator">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <input name="first_name" class="contact-name form-control" type="text" placeholder="First Name" required>
                                    </div>
                                    <div class="col-sm-12">
                                        <input name="last_name" class="contact-email form-control" type="text" placeholder="Last Name" required>
                                    </div>
                                    <div class="col-sm-12">
                                        <input name="email" class="contact-subject form-control" type="email" placeholder="Your Email" required>
                                    </div>
                                    <div class="col-sm-12">
                                        <textarea name="message" class="contact-message form-control" rows="6" placeholder="Your Message" required></textarea>
                                    </div>
                                    <div class="btn-form col-sm-12">
                                        <button type="submit" class="btn btn-fill btn-block">Send Message</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Social Media Links -->
                        <div class="col-sm-12 mh-copyright wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.2s">
                            <ul class="social-icon">
                                <?php while ($social = $socialLinksResult->fetch_assoc()): ?>
                                    <li><a href="<?php echo $social['link']; ?>"><i class="<?php echo $social['icon_class']; ?>"></i></a></li>
                                <?php endwhile; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

  <!--
    ==============
    * JS Files *
    ==============
    -->
    
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
    <!-- jQuery -->
    <script src="assets/plugins/js/jquery.min.js"></script>
    <!-- popper -->
    <script src="assets/plugins/js/popper.min.js"></script>
    <!-- bootstrap -->
    <script src="assets/plugins/js/bootstrap.min.js"></script>
    <!-- owl carousel -->
    <script src="assets/plugins/js/owl.carousel.js"></script>
    <!-- validator -->
    <script src="assets/plugins/js/validator.min.js"></script>
    <!-- wow -->
    <script src="assets/plugins/js/wow.min.js"></script>
    <!-- mixin js-->
    <script src="assets/plugins/js/jquery.mixitup.min.js"></script>
    <!-- circle progress-->
    <script src="assets/plugins/js/circle-progress.js"></script>
    <!-- jquery nav -->
    <script src="assets/plugins/js/jquery.nav.js"></script>
    <!-- Fancybox js-->
    <script src="assets/plugins/js/jquery.fancybox.min.js"></script>
    <!-- Map api -->
    <script src="http://maps.googleapis.com/maps/api/js?v=3.exp&amp;key=AIzaSyCRP2E3BhaVKYs7BvNytBNumU0MBmjhhxc"></script>
    <!-- isotope js-->
    <script src="assets/plugins/js/isotope.pkgd.js"></script>
    <script src="assets/plugins/js/packery-mode.pkgd.js"></script>
    <!-- Custom Scripts-->
    <script src="assets/js/map-init.js"></script>
    <script src="assets/js/custom-scripts.js"></script>
</body>
</html>
