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
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .task-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 15px;
            border-bottom: 2px solid #007bff;
            margin-bottom: 30px;
        }

        .task-header h2 {
            font-size: 1.8rem;
            color: #007bff;
            margin: 0;
        }

        .badge-status {
            font-size: 0.9rem;
            padding: 5px 10px;
            border-radius: 12px;
            color: #fff;
        }

        .badge-pending {
            background-color: #ffc107;
        }

        .badge-in-progress {
            background-color: #17a2b8;
        }

        .badge-completed {
            background-color: #28a745;
        }

        .task-details h5 {
            font-weight: bold;
            margin-bottom: 10px;
            color: #343a40;
        }

        .task-details p {
            font-size: 1rem;
            color: #6c757d;
        }

        .task-image {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-top: 15px;
        }

        .btn-back {
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            color: #fff;
        }

        .btn-back:hover {
            background-color: #0056b3;
        }

        .info-block {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="task-header">
            <h2>Task Details</h2>
            <span class="badge badge-status {{ strtolower(str_replace(' ', '-', $users->status)) }}">
                {{ $users->status }}
            </span>
        </div>

        <div class="info-block">
            <h5>Title</h5>
            <p>{{ $users->title }}</p>
        </div>

        <div class="info-block">
            <h5>Description</h5>
            <p>{{ $users->description }}</p>
        </div>

        <div class="info-block">
            <h5>Dates</h5>
            <p><strong>Start Date:</strong> {{ $users->start_date }}</p>
            <p><strong>End Date:</strong> {{ $users->end_date }}</p>
            <p><strong>Due Date:</strong> {{ $users->due_date }}</p>
        </div>

        <div class="info-block">
            <h5>Assigned To</h5>
            <p>{{ $users->designation }}</p>
        </div>

        <div class="info-block">
            <h5>Project</h5>
            <p>{{ $users->name }}</p>
        </div>

        @if ($users->image)
        <div class="info-block">
            <h5>Task Image</h5>
            <img src="{{ asset('storage/' . $users->image) }}" alt="Task Image" class="task-image">
        </div>
        @endif

        <div class="text-center mt-4">
            <a href="{{ route('users.index') }}" class="btn btn-back">Back to Tasks</a>
        </div>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
