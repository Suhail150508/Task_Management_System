<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Task</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            <h1 class="mb-4">Update Task</h1>

            <form id="taskForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">

                <div class="form-group">
                    <label for="title">Task Title</label>
                    <input type="text" class="form-control" name="title" placeholder="Enter Task Title" value="{{ $task_edit->title }}" required>
                </div>

                <div class="form-group">
                    <label for="description">Task Description</label>
                    <textarea class="form-control" name="description" placeholder="Enter Task Description" rows="4">{{ $task_edit->description }}</textarea>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="">Select Status</option>
                        <option value="Pending" {{ $task_edit->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="In Progress" {{ $task_edit->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="Completed" {{ $task_edit->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                    <div class="invalid-feedback">
                        Please select a status.
                    </div>
                </div>

                <div class="form-group">
                    <label>Task Dates</label>
                    <div class="input-daterange input-group" id="task-date-inputgroup">
                        <input type="text" class="form-control" placeholder="Start Date" name="start_date" value="{{ $task_edit->start_date }}" id="start_date" />
                        <input type="text" class="form-control" placeholder="End Date" name="end_date" value="{{ $task_edit->end_date }}" id="end_date" />
                        <input type="text" class="form-control" placeholder="Due Date" name="due_date" value="{{ $task_edit->due_date }}" id="due_date" />
                    </div>
                </div>

                @php
                    $users = App\Models\User::all();
                    $projects = App\Models\Project::all();
                @endphp
                
                <div class="form-group">
                    <label for="assigned_to">Assign To</label>
                    <select class="form-control" id="assigned_to" name="assigned_to" required>
                        <option value="">Select User</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ $task_edit->assigned_to == $user->id ? 'selected' : '' }}>
                                {{ $user->designation }}
                            </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Please select a user.
                    </div>
                </div>

                <div class="form-group">
                    <label for="project_id">Project</label>
                    <select class="form-control" id="project_id" name="project_id" required>
                        <option value="">Select Project</option>
                        @foreach ($projects as $project)
                            <option value="{{ $project->id }}" {{ $task_edit->project_id == $project->id ? 'selected' : '' }}>{{ $project->name }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Please select a project.
                    </div>
                </div>

                <div class="form-group">
                    <label for="image">Task Image</label>
                    <input type="file" class="form-control" name="image">
                    <small class="form-text text-muted">Upload an image (optional)</small>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update Task</button>
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

                    // Add the _method field manually to simulate a PUT request
                    formData.append('_method', 'PUT');

                    $.ajax({
                        url: '/tasks/{{ $task_edit->id }}', // Adjust URL to point to the specific task update route
                        type: 'POST', // Use POST as the actual method
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            alert('Task updated successfully!');
                            window.location.href = '/tasks';
                        },
                        error: function(xhr) {
                            alert('Error updating task: ' + xhr.responseJSON.message);
                        }
                    });
                });

            });
        </script>
    </body>

</html>
