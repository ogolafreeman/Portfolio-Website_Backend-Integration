<?php
include 'header.php'; 
include 'config.php'; 
?>

<div class="container-fluid">
    <div class="row">
        <?php include('sidebar.php'); // Includes the sidebar ?>

        <!-- Main Content -->
        <div class="col-9 p-4">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Add New Project</h3>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <!-- Project Category -->
                            <div class="col-md-6 mb-3">
                                <label for="project_category" class="form-label">Project Category</label>
                                <input type="text" name="project_category" class="form-control" id="project_category" placeholder="e.g., Web Development" required>
                            </div>

                            <!-- Project Title -->
                            <div class="col-md-6 mb-3">
                                <label for="project_title" class="form-label">Project Title</label>
                                <input type="text" name="project_title" class="form-control" id="project_title" placeholder="e.g., Portfolio Website" required>
                            </div>

                            <!-- Project Type -->
                            <div class="col-md-6 mb-3">
                                <label for="project_type" class="form-label">Project Type</label>
                                <input type="text" name="project_type" class="form-control" id="project_type" placeholder="e.g., Personal, Client" required>
                            </div>

                            <!-- Project Image -->
                            <div class="col-md-6 mb-3">
                                <label for="project_image" class="form-label">Project Image</label>
                                <input type="file" name="project_image" class="form-control" id="project_image" accept="image/*" required>
                            </div>

                            <!-- Project Description -->
                            <div class="col-md-12 mb-3">
                                <label for="project_description" class="form-label">Project Description</label>
                                <textarea name="project_description" class="form-control" id="project_description" rows="4" placeholder="Describe the project..." required></textarea>
                            </div>

                            <!-- Testimonial -->
                            <div class="col-md-12 mb-3">
                                <label for="project_testimonial" class="form-label">Testimonial</label>
                                <textarea name="project_testimonial" class="form-control" id="project_testimonial" rows="3" placeholder="Include any testimonials (optional)"></textarea>
                            </div>

                            <!-- Testimonial Author -->
                            <div class="col-md-6 mb-3">
                                <label for="testimonial_author" class="form-label">Testimonial Author</label>
                                <input type="text" name="testimonial_author" class="form-control" id="testimonial_author" placeholder="e.g., John Doe">
                            </div>

                            <!-- Testimonial Cite -->
                            <div class="col-md-6 mb-3">
                                <label for="testimonial_cite" class="form-label">Testimonial Cite</label>
                                <input type="text" name="testimonial_cite" class="form-control" id="testimonial_cite" placeholder="e.g., CEO, Company">
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex justify-content-end">
                            <button type="submit" name="add_project" class="btn btn-success px-4 py-2">Add Project</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
