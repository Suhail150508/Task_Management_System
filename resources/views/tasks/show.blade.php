@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Task Details</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $task->title }}</h5>
            <p class="card-text">{{ $task->description }}</p>
            <p><strong>Status:</strong> {{ $task->status }}</p>
            <p><strong>Due Date:</strong> {{ $task->due_date }}</p>
            <p><strong>Assigned To:</strong> {{ $task->user->name }}</p>

            @if ($task->image)
                <p><strong>Task Image:</strong></p>
                <img src="{{ asset('storage/' . $task->image) }}" alt="Task Image" class="img-thumbnail" width="200">
            @endif

            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">Edit Task</a>
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back to Task List</a>
        </div>
    </div>
</div>
@endsection
