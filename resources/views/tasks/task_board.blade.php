@extends('layouts.app')

@section('content')

    
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Datepicker CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">


    <body data-sidebar="dark" data-layout-mode="light">


        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Task Board</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Tasks</a></li>
                                    <li class="breadcrumb-item active">Task Board</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>

                
                
                @if ($tasks->count() >= 1)
                
                {{-- <div style="display: flex"> --}}
           
                    <div class="row">
                            <div class="col-lg-4">
                                <h4 style="background-color:aquamarine;padding:6px">Pendigns</h4>
                                @foreach ($tasks as $task)
                                    @if ($task->status == 'Pending')
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="dropdown float-end">
                                                    <a href="#" class="dropdown-toggle arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="mdi mdi-dots-vertical m-0 text-muted h5"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="{{ route('tasks.edit', $task->id) }}">Edit</a>
                                                        <a class="dropdown-item" href="{{ route('tasks.show', $task->id) }}">View</a>
                                                        <form action="{{ route('tasks.delete', $task->id) }}" method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this task?');">Delete</button>
                                                        </form>
                                                        
                                                    </div>
                                                </div> 
                
                                                <h4 class="card-title mb-4" >Pending</h4>
                                                <div id="task-1">
                                                    <div id="upcoming-task" class="pb-1 task-list">

                                                        <div class="card task-box" id="uptask-2">
                                                            <div class="card-body">
            
                                                                <div class="float-end ms-2">
                                                                    @if ($task->status == 'Pending')
                                                                        <span class="badge rounded-pill badge-soft-warning font-size-12" id="task-status">{{$task->status}}</span>
                                                                    @endif
                                                                    @if ($task->status == 'In Progress')
                                                                        <span class="badge rounded-pill badge-soft-info font-size-12" id="task-status">{{$task->status}}</span>
                                                                    @endif
                                                                    @if ($task->status == 'Completed')
                                                                        <span class="badge rounded-pill badge-soft-success font-size-12" id="task-status">{{$task->status}}</span>
                                                                    @endif
                                                                        
                                                                </div>
                                                                <div>
                                                                    <h5 class="font-size-16" style="width: 60%; height: 18px; overflow: hidden;"><a href="javascript: void(0);" class="text-dark" id="task-name">{{$task->title}}</a></h5>
                                                                    <p class="text-muted">Start Date: <span> {{ \Carbon\Carbon::parse($task->start_date)->format('d M, Y') }}</span></p>
                                                                </div>
                                                                
                                                                <p class="ps-3 mb-4 text-muted" id="">
                                                                    {{$task->description}}
                                                                </p>
                                                                
                                                                <div class="avatar-group float-start task-assigne">
                                                                    <div class="avatar-group-item">
                                                                        <a href="javascript: void(0);" class="d-inline-block" value="member-1">
                                                                            {{-- <img src="assets/images/users/avatar-1.jpg" alt="" class="rounded-circle avatar-xs"> --}}
                                                                            <img class="rounded-circle avatar-xs" src="{{asset($task->image) }}" alt="">
                                                                        </a>
                                                                    </div>

                                                                </div>
                                                                <div class="text-end">
                                                                    <p class="text-muted">Due Date: {{ \Carbon\Carbon::parse($task->start_date)->format('d M, Y') }}</p>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>

                                                    </div>

                                                    <div class="text-center d-grid">
                                                        <a href="{{route('tasks.create')}}" class="btn btn-primary waves-effect waves-light addtask-btn" ><i class="mdi mdi-plus me-1"></i> Add New</a>
                                                        {{-- <a href="javascript: void(0);" class="btn btn-primary waves-effect waves-light addtask-btn" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" data-id="#upcoming-task"><i class="mdi mdi-plus me-1"></i> Add New</a> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @endforeach
                            </div>
                            
                            <div class="col-lg-4">
                                <h4 style="background-color:aquamarine;padding:6px">In Progress</h4>
                                @foreach ($tasks as $task)
                                    @if ($task->status == 'In Progress')
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="dropdown float-end">
                                                    <a href="#" class="dropdown-toggle arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="mdi mdi-dots-vertical m-0 text-muted h5"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="{{ route('tasks.edit', $task->id) }}">Edit</a>
                                                        <a class="dropdown-item" href="{{ route('tasks.show', $task->id) }}">View</a>
                                                        <form action="{{ route('tasks.delete', $task->id) }}" method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this task?');">Delete</button>
                                                        </form>
                                                    </div>
                                                </div> 
                
                                                <h4 class="card-title mb-4">In Progress</h4>
                                                <div id="task-2">
                                                    <div id="inprogress-task" class="pb-1 task-list">
                                                        <div class="card task-box" id="intask-1">
                                                            <div class="card-body">
                                                                <div class="float-end ms-2">

                                                                    @if ($task->status == 'Pending')
                                                                    <span class="badge rounded-pill badge-soft-warning font-size-12" id="task-status">{{$task->status}}</span>
                                                                    @endif
                                                                    @if ($task->status == 'In Progress')
                                                                        <span class="badge rounded-pill badge-soft-info font-size-12" id="task-status">{{$task->status}}</span>
                                                                    @endif
                                                                    @if ($task->status == 'Completed')
                                                                        <span class="badge rounded-pill badge-soft-success font-size-12" id="task-status">{{$task->status}}</span>
                                                                    @endif

                                                                </div>
                                                                <div>
                                                                    <h5 class="font-size-15"><a href="javascript: void(0);" class="text-dark" id="task-name">{{$task->title}}</a></h5>
                                                                    <p class="text-muted">Start Date: {{ \Carbon\Carbon::parse($task->start_date)->format('d M, Y') }}</p>
                                                                </div>
                    
                                                                <p class="list-inine ps-0 mb-4">
                                                                    {{$task->description}}
                                                                </p>

                                                                <div class="avatar-group float-start task-assigne">
                                                                    <div class="avatar-group-item">
                                                                        <a href="javascript: void(0);" class="d-inline-block" value="member-7">
                                                                            {{-- <img src="assets/images/users/avatar-7.jpg" alt="" class="rounded-circle avatar-xs"> --}}
                                                                            <img src="{{asset($task->image) }}" alt="" class="rounded-circle avatar-xs">
                                                                        </a>
                                                                    </div>
                                                                    {{-- <div class="avatar-group-item">
                                                                        <a href="javascript: void(0);" class="d-inline-block" value="member-8">
                                                                            <img src="assets/images/users/avatar-8.jpg" alt="" class="rounded-circle avatar-xs">
                                                                        </a>
                                                                    </div> --}}
                                                                </div>

                                                                <div class="text-end">
                                                                    <p class="text-muted">Due Date: {{ \Carbon\Carbon::parse($task->due_date)->format('d M, Y') }}</p>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>

                                                    </div>

                                                    <div class="text-center d-grid">
                                                        <a href="{{route('tasks.create')}}" class="btn btn-primary waves-effect waves-light addtask-btn" ><i class="mdi mdi-plus me-1"></i> Add New</a>
                                                        {{-- <a href="javascript: void(0);" class="btn btn-primary waves-effect waves-light addtask-btn" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" data-id="#inprogress-task"><i class="mdi mdi-plus me-1"></i> Add New</a> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            
                            <div class="col-lg-4">
                                <h4 style="background-color:aquamarine;padding:6px">Completed</h4>
                                @foreach ($tasks as $task)
                                    @if ($task->status == 'Completed')
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="dropdown float-end">
                                                    <a href="#" class="dropdown-toggle arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="mdi mdi-dots-vertical m-0 text-muted h5"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="{{ route('tasks.edit', $task->id) }}">Edit</a>
                                                        <a class="dropdown-item" href="{{ route('tasks.show', $task->id) }}">View</a>
                                                        <form action="{{ route('tasks.delete', $task->id) }}" method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this task?');">Delete</button>
                                                        </form>
                                                    </div>
                                                </div> 
                
                                                <h4 class="card-title mb-4">Completed</h4>
                                                <div id="task-3">
                                                    <div id="complete-task" class="pb-1 task-list">
                                                        <div class="card task-box" id="cmptask-1">
                                                            <div class="card-body">
                                                                <div class="float-end ms-2">
                                                                    @if ($task->status == 'Pending')
                                                                    <span class="badge rounded-pill badge-soft-warning font-size-12" id="task-status">{{$task->status}}</span>
                                                                    @endif
                                                                    @if ($task->status == 'In Progress')
                                                                        <span class="badge rounded-pill badge-soft-info font-size-12" id="task-status">{{$task->status}}</span>
                                                                    @endif
                                                                    @if ($task->status == 'Completed')
                                                                        <span class="badge rounded-pill badge-soft-success font-size-12" id="task-status">{{$task->status}}</span>
                                                                    @endif

                                                                </div>
                                                                <div>
                                                                    <h5 class="font-size-15"><a href="javascript: void(0);" class="text-dark" id="task-name">{{$task->title}}</a></h5>
                                                                    <p class="text-muted">Start Date: {{ \Carbon\Carbon::parse($task->start_date)->format('d M, Y') }}</p>
                                                                </div>
                                                                <p>
                                                                    {{$task->description}}
                                                                </p>
                    
                                                                <div class="avatar-group float-start task-assigne">
                                                                    <div class="avatar-group-item">
                                                                        <a href="javascript: void(0);" class="d-inline-block" value="member-1">
                                                                            {{-- <img src="assets/images/users/avatar-1.jpg" alt="" class="rounded-circle avatar-xs"> --}}
                                                                            <img class="rounded-circle avatar-xs" src="{{asset($task->image) }}" alt="">
                                                                        </a>
                                                                    </div>

                                                                </div>

                                                                <div class="text-end">
                                                                    <p class="text-muted">Due Date: {{ \Carbon\Carbon::parse($task->due_date)->format('d M, Y') }}</p>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>

                                                    <div class="text-center d-grid">
                                                        <a href="{{route('tasks.create')}}" class="btn btn-primary waves-effect waves-light addtask-btn" ><i class="mdi mdi-plus me-1"></i> Add New</a>
                                                        {{-- <a href="{{route('tasks.create')}}" class="btn btn-primary waves-effect waves-light addtask-btn" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" data-id="#complete-task"><i class="mdi mdi-plus me-1"></i> Add New</a> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        
                        </div>

                    @else{
                        
                        <h2>No tasks available.</h2>
                    }
                    @endif 
                {{-- </div> --}}

            </div> 
        </div>


        <div id="modalForm" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title add-task-title">Add New Task</h5>
                        <h5 class="modal-title update-task-title" style="display: none;">Update Task</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="taskForm" action="{{route('tasks.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                
                            <div class="form-group">
                                <label for="title" class="mt-3">Task Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Enter Task Title" required>
                            </div>
                
                            <div class="form-group">
                                <label for="description" class="mt-3">Task Description</label>
                                <textarea class="form-control" name="description" placeholder="Enter Task Description" rows="4"></textarea>
                            </div>
                
                            <div class="form-group">
                                <label class="mt-3">Task Dates</label>
                                <div class="input-daterange input-group" id="task-date-inputgroup">
                                    <input type="text" class="form-control" placeholder="Start Date" name="start_date" id="start_date" />
                                    <input type="text" class="form-control" placeholder="End Date" name="end_date" id="end_date" />
                                    <input type="text" class="form-control" placeholder="Due Date" name="due_date" id="due_date" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="assigned_to" class="mt-3">Status</label>
                                <select class="form-control" name="status" required>
                                    <option value="">Select Status</option>
                                    <option value="Pending">Pending</option>
                                    <option value="In Progress">In Progress</option>
                                    <option value="Completed">Completed</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a user.
                                </div>
                            </div>
                
                            @php
                                $users = App\Models\User::all();
                                $projects = App\Models\Project::all();
                            @endphp
                
                            <div class="form-group">
                                <label for="assigned_to" class="mt-3">Assign To</label>
                                <select class="form-control" id="assigned_to" name="assigned_to" required>
                                    <option value="">Select User</option>
                                    @foreach ($users as  $user)
                                        <option value="{{$user->id}}">{{$user->designation}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Please select a user.
                                </div>
                            </div>
                
                            <div class="form-group">
                                <label for="project_id" class="mt-3">Project</label>
                                <select class="form-control" id="project_id" name="project_id" required>
                                    <option value="">Select Project</option>
                
                                    @foreach ($projects as  $project)
                                        <option value="{{$project->id}}">{{$project->name}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Please select a project.
                                </div>
                            </div>
                
                            <div class="form-group">
                                <label for="image" class="mt-3">Task Image</label>
                                <input type="file" class="form-control" name="image" accept="image/*">
                                <small class="form-text text-muted">Upload an image (optional)</small>
                            </div>
                
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Create Task</button>
                                <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>


</body>

@endsection 





<!-- resources/views/tasks/index.blade.php -->

{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tasks</h1>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary">Create Task</a>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th>Due Date</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->status }}</td>
                    <td>{{ $task->due_date }}</td>
                    <td>
                        @if($task->image)
                            <img src="{{ Storage::url($task->image) }}" alt="Image" style="width: 50px; height: 50px;">
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        <a href="{{ route('tasks.show', $task) }}" class="btn btn-info">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection --}}
