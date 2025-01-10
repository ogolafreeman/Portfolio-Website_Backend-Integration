<?php
require_once 'dompdf/autoload.inc.php'; // Include the Dompdf library

use Dompdf\Dompdf;

// Database connection
include('config.php');

// Fetch data from the database
$user_id = 1; // Replace with dynamic user ID if needed
$userQuery = "SELECT * FROM user WHERE id = ?";
$stmt = $conn->prepare($userQuery);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$userResult = $stmt->get_result()->fetch_assoc();

$homeQuery = "SELECT * FROM home_section LIMIT 1";
$homeResult = $conn->query($homeQuery)->fetch_assoc();

$skillsQuery = "SELECT skill_name, proficiency FROM technical_skills";
$skillsResult = $conn->query($skillsQuery);

$educationQuery = "SELECT * FROM education";
$educationResult = $conn->query($educationQuery);

$workQuery = "SELECT * FROM work_experience";
$workResult = $conn->query($workQuery);

$projectsQuery = "SELECT * FROM projects";
$projectsResult = $conn->query($projectsQuery);

// Generate HTML content
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1, h2, h3 {
            color: #333;
        }
        .section {
            margin-bottom: 20px;
        }
        .section h2 {
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        ul li {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1><?= htmlspecialchars($userResult['name']); ?> - <?= htmlspecialchars($homeResult['title']); ?></h1>
    <p>Email: <?= htmlspecialchars($homeResult['email']); ?></p>
    <p>Phone: <?= htmlspecialchars($homeResult['phone']); ?></p>
    <p>Address: <?= htmlspecialchars($homeResult['address']); ?></p>

    <div class="section">
        <h2>Skills</h2>
        <ul>
            <?php while ($skill = $skillsResult->fetch_assoc()): ?>
                <li><?= htmlspecialchars($skill['skill_name']); ?> - <?= htmlspecialchars($skill['proficiency']); ?>%</li>
            <?php endwhile; ?>
        </ul>
    </div>

    <div class="section">
        <h2>Education</h2>
        <ul>
            <?php while ($edu = $educationResult->fetch_assoc()): ?>
                <li>
                    <strong><?= htmlspecialchars($edu['degree']); ?></strong> at <?= htmlspecialchars($edu['institution']); ?><br>
                    <?= htmlspecialchars($edu['duration']); ?><br>
                    <?= htmlspecialchars($edu['description']); ?>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>

    <div class="section">
        <h2>Work Experience</h2>
        <ul>
            <?php while ($work = $workResult->fetch_assoc()): ?>
                <li>
                    <strong><?= htmlspecialchars($work['position']); ?></strong> at <?= htmlspecialchars($work['company']); ?><br>
                    <?= htmlspecialchars($work['duration']); ?><br>
                    <?= htmlspecialchars($work['responsibilities']); ?>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>

    <div class="section">
        <h2>Projects</h2>
        <ul>
            <?php while ($project = $projectsResult->fetch_assoc()): ?>
                <li>
                    <strong><?= htmlspecialchars($project['title']); ?></strong><br>
                    <?= htmlspecialchars($project['description']); ?><br>
                    <?= htmlspecialchars($project['type']); ?>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
</body>
</html>
<?php
$html = ob_get_clean();

// Create PDF
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("cv.pdf", ["Attachment" => true]);
?>
