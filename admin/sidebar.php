<div class="sidebar d-flex flex-column flex-shrink-0 p-3 bg-dark text-white" style="width: 280px; height: 100vh;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <i class="fa fa-rocket me-2 fs-4"></i>
        <span class="fs-4">Portfolio</span>
    </a>
    <hr class="border-secondary">
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="dashboard.php" class="nav-link text-white <?= basename($_SERVER['PHP_SELF']) === 'dashboard.php' ? 'active' : ''; ?>">
                <i class="fa fa-dashboard me-2"></i> Dashboard
            </a>
        </li>

        <!-- Skills Module -->
        <li>
            <a class="nav-link text-white dropdown-toggle" data-bs-toggle="collapse" href="#skillsMenu" role="button" aria-expanded="false" aria-controls="skillsMenu">
                <i class="fa fa-cogs me-2"></i> Skills
            </a>
            <div class="collapse <?= (in_array(basename($_SERVER['PHP_SELF']), ['add_skill.php', 'view_skills.php']) ? 'show' : ''); ?>" id="skillsMenu">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="add_skill.php" class="nav-link text-white <?= basename($_SERVER['PHP_SELF']) === 'add_skill.php' ? 'active' : ''; ?>">Add Skill</a></li>
                    <li><a href="view_skills.php" class="nav-link text-white <?= basename($_SERVER['PHP_SELF']) === 'view_skills.php' ? 'active' : ''; ?>">View List</a></li>
                </ul>
            </div>
        </li>

        <!-- Projects Module -->
        <li>
            <a class="nav-link text-white dropdown-toggle" data-bs-toggle="collapse" href="#projectsMenu" role="button" aria-expanded="false" aria-controls="projectsMenu">
                <i class="fa fa-folder me-2"></i> Projects
            </a>
            <div class="collapse <?= (in_array(basename($_SERVER['PHP_SELF']), ['add_project.php', 'view_projects.php']) ? 'show' : ''); ?>" id="projectsMenu">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="add_project.php" class="nav-link text-white <?= basename($_SERVER['PHP_SELF']) === 'add_project.php' ? 'active' : ''; ?>">Add Project</a></li>
                    <li><a href="view_projects.php" class="nav-link text-white <?= basename($_SERVER['PHP_SELF']) === 'view_projects.php' ? 'active' : ''; ?>">View List</a></li>
                </ul>
            </div>
        </li>

        <!-- Users Module -->
        <li>
            <a class="nav-link text-white dropdown-toggle" data-bs-toggle="collapse" href="#usersMenu" role="button" aria-expanded="false" aria-controls="usersMenu">
                <i class="fa fa-users me-2"></i> Users
            </a>
            <div class="collapse <?= (in_array(basename($_SERVER['PHP_SELF']), ['add_user.php', 'view_users.php']) ? 'show' : ''); ?>" id="usersMenu">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="add_user.php" class="nav-link text-white <?= basename($_SERVER['PHP_SELF']) === 'add_user.php' ? 'active' : ''; ?>">Add User</a></li>
                    <li><a href="view_users.php" class="nav-link text-white <?= basename($_SERVER['PHP_SELF']) === 'view_users.php' ? 'active' : ''; ?>">View List</a></li>
                </ul>
            </div>
        </li>

        <li>
            <a href="experience.php" class="nav-link text-white <?= basename($_SERVER['PHP_SELF']) === 'experience.php' ? 'active' : ''; ?>">
                <i class="fa fa-briefcase me-2"></i> Experience
            </a>
        </li>

        <li>
            <a href="settings.php" class="nav-link text-white <?= basename($_SERVER['PHP_SELF']) === 'settings.php' ? 'active' : ''; ?>">
                <i class="fa fa-gear me-2"></i> Settings
            </a>
        </li>
    </ul>
    <hr class="border-secondary">
    <div>
        <a href="logout.php" class="btn btn-outline-light btn-sm w-100">
            <i class="fa fa-sign-out"></i> Logout
        </a>
    </div>
</div>
