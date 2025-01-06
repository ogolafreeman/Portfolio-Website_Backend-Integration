<?php include('header.php'); ?>
<div class="container-fluid">
    <div class="row">
        <?php include('sidebar.php'); ?>

        <div class="col-9 p-4">
            <h1 class="mb-4">Welcome to the Admin Dashboard</h1>
            <div class="row g-4">
                <!-- Users Card -->
                <div class="col-md-4">
                    <div class="card shadow border-0">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="fa fa-users fa-3x text-primary"></i>
                            </div>
                            <h5 class="card-title">Users</h5>
                            <p class="card-text">Manage all registered users.</p>
                            <a href="users.php" class="btn btn-primary">Go to Users</a>
                        </div>
                    </div>
                </div>

                <!-- Settings Card -->
                <div class="col-md-4">
                    <div class="card shadow border-0">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="fa fa-cogs fa-3x text-success"></i>
                            </div>
                            <h5 class="card-title">Settings</h5>
                            <p class="card-text">Adjust application settings.</p>
                            <a href="settings.php" class="btn btn-success">Go to Settings</a>
                        </div>
                    </div>
                </div>

                <!-- Projects Card -->
                <div class="col-md-4">
                    <div class="card shadow border-0">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="fa fa-folder-open fa-3x text-warning"></i>
                            </div>
                            <h5 class="card-title">Projects</h5>
                            <p class="card-text">Manage all projects.</p>
                            <a href="projects.php" class="btn btn-warning">Go to Projects</a>
                        </div>
                    </div>
                </div>

                <!-- Skills Card -->
                <div class="col-md-4">
                    <div class="card shadow border-0">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="fa fa-lightbulb fa-3x text-info"></i>
                            </div>
                            <h5 class="card-title">Skills</h5>
                            <p class="card-text">Manage skills information.</p>
                            <a href="skills.php" class="btn btn-info">Go to Skills</a>
                        </div>
                    </div>
                </div>

                <!-- Reports Card -->
                <div class="col-md-4">
                    <div class="card shadow border-0">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="fa fa-chart-line fa-3x text-danger"></i>
                            </div>
                            <h5 class="card-title">Reports</h5>
                            <p class="card-text">View application reports.</p>
                            <a href="reports.php" class="btn btn-danger">View Reports</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>
