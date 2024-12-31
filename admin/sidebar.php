<div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px; height: 100vh;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <span class="fs-4">Portfolio</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="dashboard.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'dashboard.php' ? 'active' : 'link-dark'; ?>" aria-current="page">
                Dashboard
            </a>
        </li>
        <li>
            <a href="skills.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'skills.php' ? 'active' : 'link-dark'; ?>">
                Skills
            </a>
        </li>
        <li>
            <a href="projects.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'projects.php' ? 'active' : 'link-dark'; ?>">
                Projects
            </a>
        </li>
        <li>
            <a href="experience.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'experience.php' ? 'active' : 'link-dark'; ?>">
                Experience
            </a>
        </li>
        <li>
            <a href="users.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'users.php' ? 'active' : 'link-dark'; ?>">
                Users
            </a>
        </li>
        <li>
            <a href="settings.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'settings.php' ? 'active' : 'link-dark'; ?>">
                Settings
            </a>
        </li>
    </ul>
    <hr>
    <div>
        <a href="logout.php" class="btn btn-primary btn-sm">Logout</a>
    </div>
</div>
