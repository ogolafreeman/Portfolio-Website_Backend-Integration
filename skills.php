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

    // Fetch Technical Skills
    $techSkillsQuery = "SELECT * FROM technical_skills";
    $techSkillsResult = $conn->query($techSkillsQuery);

    // Fetch Professional Skills
    $profSkillsQuery = "SELECT * FROM professional_skills";
    $profSkillsResult = $conn->query($profSkillsQuery);
?>

<section class="mh-skills" id="mh-skills">
    <div class="home-v-img">
        <div class="container">
            <div class="row section-separator">
                <!-- Technical Skills -->
                <div class="col-sm-12 col-md-6">
                    <div class="mh-skills-inner">
                        <div class="mh-professional-skill wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.3s">
                            <h3>Technical Skills</h3>
                            <div class="each-skills">
                                <?php if ($techSkillsResult->num_rows > 0): ?>
                                    <?php while ($skill = $techSkillsResult->fetch_assoc()): ?>
                                        <div class="candidatos">
                                            <div class="parcial">
                                                <div class="info">
                                                    <div class="nome"><?php echo $skill['skill_name']; ?></div>
                                                    <div class="percentagem-num"><?php echo $skill['proficiency']; ?>%</div>
                                                </div>
                                                <div class="progressBar">
                                                    <div class="percentagem" style="width: <?php echo $skill['proficiency']; ?>%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <p>No technical skills available.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Professional Skills -->
                <div class="col-sm-12 col-md-6">
                    <div class="mh-professional-skills wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.5s">
                        <h3>Professional Skills</h3>
                        <ul class="mh-professional-progress">
                            <?php if ($profSkillsResult->num_rows > 0): ?>
                                <?php while ($skill = $profSkillsResult->fetch_assoc()): ?>
                                    <li>
                                        <div class="mh-progress mh-progress-circle" data-progress="<?php echo $skill['proficiency']; ?>"></div>
                                        <div class="pr-skill-name"><?php echo $skill['skill_name']; ?></div>
                                    </li>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <p>No professional skills available.</p>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
    $conn->close();
?>
