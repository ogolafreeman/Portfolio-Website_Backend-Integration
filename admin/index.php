<?php include('header.php'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-3">
            <?php include('sidebar.php'); ?>
        </div>
        <div class="col-9 p-4">
            <h1>Welcome to the Admin Dashboard</h1>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Users</h5>
                            <p class="card-text">Manage all registered users.</p>
                            <a href="pages/users.php" class="btn btn-primary">Go to Users</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Settings</h5>
                            <p class="card-text">Adjust application settings.</p>
                            <a href="pages/settings.php" class="btn btn-primary">Go to Settings</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>
