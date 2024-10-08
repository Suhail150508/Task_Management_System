<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Details</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Arial', sans-serif;
        }
        .project-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 25px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
        }
        .project-title {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: #333;
        }
        .project-image {
            width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 20px;
            object-fit: cover;
        }
        .project-detail {
            margin-bottom: 20px;
        }
        .project-detail strong {
            display: block;
            font-size: 0.95rem;
            margin-bottom: 5px;
            color: #555;
        }
        .badge-status {
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 0.9rem;
        }
        .btn-custom {
            padding: 10px 20px;
            font-size: 0.95rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="project-container">
            <h2 class="project-title">{{ $project->name }}</h2>

            @if($project->image)
                <img src="/storage/images/{{ $project->image }}" alt="{{ $project->name }}" class="project-image">
            @endif

            <div class="project-detail">
                <strong>Description:</strong>
                <p>{{ $project->description }}</p>
            </div>

            <div class="project-detail">
                <strong>Start Date:</strong>
                <p>{{ \Carbon\Carbon::parse($project->start_date)->format('d M, Y') }}</p>
            </div>

            <div class="project-detail">
                <strong>End Date:</strong>
                <p>{{ \Carbon\Carbon::parse($project->end_date)->format('d M, Y') }}</p>
            </div>

            <div class="project-detail">
                <strong>Status:</strong>
                <span class="badge badge-status 
                    {{ $project->status == 'Pending' ? 'badge-warning' : ($project->status == 'Inprogress' ? 'badge-info' : 'badge-success') }}">
                    {{ $project->status }}
                </span>
            </div>

            <div class="mt-4 d-flex justify-content-between">
                <a href="{{ route('projects.index') }}" class="btn btn-secondary btn-custom">Back to Projects</a>
                <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-primary btn-custom">Edit Project</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
