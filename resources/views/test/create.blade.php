<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Add User</h1>

        <form id="userForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="userId" name="userId">

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter user name" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Enter user email" required>
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" name="image" accept="image/*">
                <small class="form-text text-muted">Upload an image (optional)</small>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Save User</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#userForm').on('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                const userId = $('#userId').val();
                const url = userId ? `/users/${userId}` : '/users';
                const method = userId ? 'PUT' : 'POST';

                $.ajax({
                    url: url,
                    type: method,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        alert('User saved successfully!');
                        window.location.href = '/users';
                    },
                    error: function(xhr) {
                        alert('Error saving user: ' + xhr.responseJSON.message);
                    }
                });
            });
        });
    </script>
</body>
</html>
