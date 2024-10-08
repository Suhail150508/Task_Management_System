<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Edit User</h1>

        <form id="userForm" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" id="userId" name="userId" value="{{ $user->id }}">

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>

            </div>

            <div class="form-group">
                <label for="email">Des:</label>
                <input type="text" class="form-control" name="description" value="{{ $user->description }}" required>
            </div>

            <div class="form-group">
                <label>Project Date</label>
                <div class="input-daterange input-group" id="project-date-inputgroup">
                    <input type="date" class="form-control" name="start_date" value="{{ $user->start_date }}" placeholder="Start Date" />
                    <input type="date" class="form-control" name="end_date" value="{{ $user->end_date }}" placeholder="End Date" />
                </div>
            </div> 

            <div class="form-group">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="">Select Status</option>
                    <option value="Pending" {{ $user->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Inprogress" {{ $user->status == 'Inprogress' ? 'selected' : '' }}>Inprogress</option>
                    <option value="Completed" {{ $user->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                </select>
                <div class="invalid-feedback">
                    Please select a status.
                </div>
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" name="image" accept="image/*">
                @if($user->image)
                    <img src="/storage/images/{{ $user->image }}" width="100" height="100" alt="{{ $user->name }}" class="mt-2">
                    <small class="form-text text-muted">Current image: {{ $user->image }}</small>
                @endif
                <small class="form-text text-muted">Upload a new image (optional)</small>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Update User</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
    $(document).ready(function() {
    $('#userForm').on('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        let formData = new FormData(this);
        let userId = $('#userId').val();

        $.ajax({
            url: `/users/${userId}`, // Update URL to match your route
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                alert('User updated successfully!');
                window.location.href = "{{ route('users.index') }}";
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                if (errors) {
                    let errorMessage = 'Error updating user: ';
                    for (let field in errors) {
                        errorMessage += `${errors[field][0]} `;
                    }
                    alert(errorMessage);
                }
            }
        });
    });
});

    </script>
</body>
</html>
