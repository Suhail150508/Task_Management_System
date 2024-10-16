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
        <h1 class="mb-4">Edit Project</h1>

        <form id="userForm" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" id="projectId" name="projectId" value="{{ $project->id }}">

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" value="{{ $project->name }}" required>

            </div>

            <div class="form-group">
                <label for="email">Des:</label>
                <input type="text" class="form-control" name="description" value="{{ $project->description }}" required>
            </div>

            <div class="form-group">
                <label>Project Date</label>
                <div class="input-daterange input-group" id="project-date-inputgroup">
                    <input type="date" class="form-control" name="start_date" value="{{ $project->start_date }}" placeholder="Start Date" />
                    <input type="date" class="form-control" name="end_date" value="{{ $project->end_date }}" placeholder="End Date" />
                </div>
            </div> 

            <div class="form-group">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="">Select Status</option>
                    <option value="Pending" {{ $project->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Inprogress" {{ $project->status == 'Inprogress' ? 'selected' : '' }}>Inprogress</option>
                    <option value="Completed" {{ $project->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                </select>
                <div class="invalid-feedback">
                    Please select a status.
                </div>
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" name="image" accept="image/*">
                @if($project->image)
                    <img src="/storage/images/{{ $project->image }}" width="100" height="100" alt="{{ $project->name }}" class="mt-2">
                    <small class="form-text text-muted">Current image: {{ $project->image }}</small>
                @endif
                <small class="form-text text-muted">Upload a new image (optional)</small>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Update User</button>
                <a href="{{ route('projects.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
    $(document).ready(function() {
    $('#userForm').on('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        let formData = new FormData(this);
        let projectId = $('#projectId').val();

        $.ajax({
            url: `/projects/${projectId}`, // Update URL to match your route
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                window.location.href = "{{ route('projects.index') }}";
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                if (errors) {
                    let errorMessage = 'Error updating project: ';
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
