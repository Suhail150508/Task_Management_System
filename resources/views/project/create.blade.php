<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Project</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Datepicker CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Add Project</h1>

        <form id="userForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="userId" name="userId">

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter user name" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" name="description" placeholder="Enter description" required>
            </div>

            <div class="form-group">
                <label>Project Date</label>
                <div class="input-daterange input-group" id="project-date-inputgroup">
                    <input type="text" class="form-control" placeholder="Start Date" name="start_date" id="start_date" />
                    <input type="text" class="form-control" placeholder="End Date" name="end_date" id="end_date" />
                </div>
            </div>            

            <div class="form-group">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="">Select Status</option>
                    <option value="Pending">Pending</option>
                    <option value="Inprogress">Inprogress</option>
                    <option value="Completed">Completed</option>
                </select>
                <div class="invalid-feedback">
                    Please select a status.
                </div>
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" name="image" accept="image/*">
                <small class="form-text text-muted">Upload an image (optional)</small>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Save Project</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
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

            $('#userForm').on('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                const userId = $('#userId').val();
                const url = userId ? `/projects/${userId}` : '/projects';
                const method = userId ? 'PUT' : 'POST';

                $.ajax({
                    url: url,
                    type: method,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        alert('Project saved successfully!');
                        window.location.href = '/projects';
                    },
                    error: function(xhr) {
                        alert('Error saving project: ' + xhr.responseJSON.message);
                    }
                });
            });
        });
    </script>
</body>
</html>
