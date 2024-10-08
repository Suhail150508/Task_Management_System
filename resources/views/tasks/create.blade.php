<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Task</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Datepicker CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">

    <style>
        .form-container {
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .btn-custom {
            background-color: #007bff;
            border-color: #007bff;
            color: white;
        }
    </style>

</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Create New Task</h1>

        <form id="taskForm" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Task Title</label>
                <input type="text" class="form-control" name="title" placeholder="Enter Task Title" required>
            </div>

            <div class="form-group">
                <label for="description">Task Description</label>
                <textarea class="form-control" name="description" placeholder="Enter Task Description" rows="4"></textarea>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="">Select Status</option>
                    <option value="Pending">Pending</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Completed">Completed</option>
                </select>
                <div class="invalid-feedback">
                    Please select a status.
                </div>
            </div>

            <div class="form-group">
                <label>Task Dates</label>
                <div class="input-daterange input-group" id="task-date-inputgroup">
                    <input type="text" class="form-control" placeholder="Start Date" name="start_date" id="start_date" />
                    <input type="text" class="form-control" placeholder="End Date" name="end_date" id="end_date" />
                    <input type="text" class="form-control" placeholder="Due Date" name="due_date" id="due_date" />
                </div>
            </div>

            <div class="form-group">
                <label for="assigned_to">Assign To</label>
                <select class="form-control" id="assigned_to" name="assigned_to" required>
                    <option value="">Select User</option>
                    <!-- Populate with users dynamically -->
                </select>
                <div class="invalid-feedback">
                    Please select a user.
                </div>
            </div>

            <div class="form-group">
                <label for="project_id">Project</label>
                <select class="form-control" id="project_id" name="project_id" required>
                    <option value="">Select Project</option>
                    <!-- Populate with projects dynamically -->
                </select>
                <div class="invalid-feedback">
                    Please select a project.
                </div>
            </div>

            <div class="form-group">
                <label for="image">Task Image</label>
                <input type="file" class="form-control" name="image" accept="image/*">
                <small class="form-text text-muted">Upload an image (optional)</small>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Create Task</button>
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap Datepicker JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize the datepicker with the correct format
            $('.input-daterange').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
                orientation: "bottom auto"
            });

            $('#taskForm').on('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);

                $.ajax({
                    url: '/tasks', // Adjust URL as needed
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        alert('Task created successfully!');
                        window.location.href = '/tasks';
                    },
                    error: function(xhr) {
                        alert('Error creating task: ' + xhr.responseJSON.message);
                    }
                });
            });
        });
    </script>
</body>
</html>
