<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .navbar-brand {
            font-weight: 600;
            font-size: 1.5rem;
            letter-spacing: 0.5px;
        }

        .navbar-dark .nav-link {
            font-size: 1rem;
            color: #ffffff;
            transition: color 0.3s ease;
        }

        .navbar-dark .nav-link:hover {
            color: #f8f9fa;
            text-decoration: underline;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <!-- Logo or Title -->
        <a class="navbar-brand" href="#">Admin Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- Welcome Message -->
                <li class="nav-item">
                    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) { ?>
                        <a class="nav-link" href="profile.php">
                            <i class="fa fa-user"></i> Welcome, <?= htmlspecialchars($_SESSION['username']); ?>
                        </a>
                    <?php } else { ?>
                        <a class="nav-link" href="index.php">
                            <i class="fa fa-sign-in-alt"></i> Login
                        </a>
                    <?php } ?>
                </li>

                <!-- Logout Link -->
                <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">
                            <i class="fa fa-sign-out-alt"></i> Logout
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
