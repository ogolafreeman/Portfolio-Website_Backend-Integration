<div class="sidebar d-flex flex-column flex-shrink-0 p-3 bg-dark text-white" style="width: 280px; height: 100vh;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <i class="fa fa-rocket me-2 fs-4"></i>
        <span class="fs-4">Portfolio</span>
    </a>
    <hr class="border-secondary">
    <ul class="nav nav-pills flex-column mb-auto">
        <!-- Dashboard -->
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

        <!-- About Me Module -->
        <li>
            <a class="nav-link text-white dropdown-toggle" data-bs-toggle="collapse" href="#aboutMenu" role="button" aria-expanded="false" aria-controls="aboutMenu">
                <i class="fa fa-user me-2"></i> About Me
            </a>
            <div class="collapse <?= (in_array(basename($_SERVER['PHP_SELF']), ['add_about_me.php', 'view_about_me.php']) ? 'show' : ''); ?>" id="aboutMenu">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="add_about_me.php" class="nav-link text-white <?= basename($_SERVER['PHP_SELF']) === 'add_about_me.php' ? 'active' : ''; ?>">Add About Me</a></li>
                    <li><a href="view_about_me.php" class="nav-link text-white <?= basename($_SERVER['PHP_SELF']) === 'view_about_me.php' ? 'active' : ''; ?>">View About Me</a></li>
                </ul>
            </div>
        </li>

        <!-- Pricing Module -->
        <li>
            <a class="nav-link text-white dropdown-toggle" data-bs-toggle="collapse" href="#pricingMenu" role="button" aria-expanded="false" aria-controls="pricingMenu">
                <i class="fa fa-dollar-sign me-2"></i> Pricing
            </a>
            <div class="collapse <?= (in_array(basename($_SERVER['PHP_SELF']), ['add_pricing.php', 'view_pricing.php']) ? 'show' : ''); ?>" id="pricingMenu">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="add_pricing.php" class="nav-link text-white <?= basename($_SERVER['PHP_SELF']) === 'add_pricing.php' ? 'active' : ''; ?>">Add Pricing</a></li>
                    <li><a href="view_pricing.php" class="nav-link text-white <?= basename($_SERVER['PHP_SELF']) === 'view_pricing.php' ? 'active' : ''; ?>">View List</a></li>
                </ul>
            </div>
        </li>

        <!-- Experience Module -->
        <li>
            <a class="nav-link text-white dropdown-toggle" data-bs-toggle="collapse" href="#experienceMenu" role="button" aria-expanded="false" aria-controls="experienceMenu">
                <i class="fa fa-briefcase me-2"></i> Experience
            </a>
            <div class="collapse <?= in_array(basename($_SERVER['PHP_SELF']), ['add_education.php', 'view_education.php', 'add_work.php', 'view_work.php']) ? 'show' : ''; ?>" id="experienceMenu">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="add_education.php" class="nav-link text-white <?= basename($_SERVER['PHP_SELF']) === 'add_education.php' ? 'active' : ''; ?>">Add Education</a></li>
                    <li><a href="view_education.php" class="nav-link text-white <?= basename($_SERVER['PHP_SELF']) === 'view_education.php' ? 'active' : ''; ?>">View Education</a></li>
                    <li><a href="add_work.php" class="nav-link text-white <?= basename($_SERVER['PHP_SELF']) === 'add_work.php' ? 'active' : ''; ?>">Add Work</a></li>
                    <li><a href="view_work.php" class="nav-link text-white <?= basename($_SERVER['PHP_SELF']) === 'view_work.php' ? 'active' : ''; ?>">View Work</a></li>
                </ul>
            </div>
        </li>

        <!-- Settings -->
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
