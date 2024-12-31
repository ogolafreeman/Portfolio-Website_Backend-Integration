<?php include('header.php'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-3">
            <?php include('sidebar.php'); ?>
        </div>
        <div class="col-9 p-4">
            <h1>Users</h1>
            <div class="row">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>John Doe</td>
                <td>john.doe@example.com</td>
                <td>
                    <a href="#" class="btn btn-sm btn-warning">Edit</a>
                    <a href="#" class="btn btn-sm btn-danger">Delete</a>
                </td>
            </tr>
        </tbody>
    </table>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>
