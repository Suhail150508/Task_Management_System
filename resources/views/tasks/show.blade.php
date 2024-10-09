<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .task-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .task-header h2 {
            color: #007bff;
            margin: 0;
        }

        .badge-status {
            font-size: 0.9rem;
            padding: 5px 10px;
            border-radius: 12px;
        }

        .task-details {
            margin-bottom: 20px;
        }

        .task-details h5 {
            margin-bottom: 10px;
            font-weight: bold;
        }

        .task-image {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-top: 15px;
        }

        .btn-back {
            background-color: #6c757d;
            border: none;
            border-radius: 5px;
            color: #fff;
        }

        .btn-back:hover {
            background-color: #5a6268;
        }

        .task-info p {
            margin: 0;
        }

        .task-info p strong {
            color: #343a40;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="task-header">
            <h2>Task Details</h2>
            <span class="badge badge-status {{ strtolower($show->status) }}">
                {{ $show->status }}
            </span>
        </div>

        <div class="task-details">
            <h5>Title</h5>
            <p>{{ $show->title }}</p>
        </div>

        <div class="task-details">
            <h5>Description</h5>
            <p>{{ $show->description }}</p>
        </div>

        <div class="task-details">
            <h5>Dates</h5>
            <div class="task-info">
                <p><strong>Start Date:</strong> {{ $show->start_date }}</p>
                <p><strong>End Date:</strong> {{ $show->end_date }}</p>
                <p><strong>Due Date:</strong> {{ $show->due_date }}</p>
            </div>
        </div>

        <div class="task-details">
            <h5>Assigned To</h5>
            <p>{{ $show->user->designation }}</p>
        </div>

        <div class="task-details">
            <h5>Project</h5>
            <p>{{ $show->project->name }}</p>
        </div>

        @if ($show->image)
        <div class="task-details">
            <h5>Task Image</h5>
            <img src="{{ asset('storage/' . $show->image) }}" alt="Task Image" class="task-image">
        </div>
        @endif

        <div class="text-center mt-4">
            <a href="{{ route('tasks.index') }}" class="btn btn-back">Back to Tasks</a>
        </div>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>
</html>
