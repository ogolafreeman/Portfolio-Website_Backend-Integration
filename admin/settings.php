<?php include('header.php'); ?>
<div class="container mt-4">
    <h2>Settings</h2>
    <form>
        <div class="mb-3">
            <label for="appName" class="form-label">Application Name</label>
            <input type="text" class="form-control" id="appName" placeholder="Enter app name">
        </div>
        <div class="mb-3">
            <label for="appTheme" class="form-label">Theme</label>
            <select class="form-select" id="appTheme">
                <option value="light">Light</option>
                <option value="dark">Dark</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
<?php include('footer.php'); ?>
