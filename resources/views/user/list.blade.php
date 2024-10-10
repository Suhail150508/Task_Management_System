
@extends('layouts.app')

@section('content')

<body data-sidebar="dark" data-layout-mode="light">

<!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">
            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">Projects List</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Projects</a></li>
                                        <li class="breadcrumb-item active">Projects List</li>
                                    </ol>
                                </div>
                                
                            </div>
                        </div>
                    </div>     
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="">
                                <div class="table-responsive">
                                    <table class="table project-list-table table-nowrap align-middle table-borderless">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="width: 100px;font-size:1rem">SL</th>
                                                <th scope="col" style="font-size:1rem">Username</th>
                                                <th scope="col" style="font-size:1rem">image</th>
                                                <th scope="col" style="font-size:1rem">Designation</th>
                                                <th scope="col" style="font-size:1rem">Highest task completed number</th>
                                                <th scope="col" style="font-size:1rem">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $index => $user )
                                            @php
                                                $task  = App\Models\Task::where('assigned_to',$user->id)->where('status','Completed')->count();
                                            @endphp
                                                <tr>
                                                    <td>{{$index + 1}}</td>
                                                    <td>
                                                        <h5 class="text-truncate font-size-14"><a href="javascript: void(0);" class="text-dark">{{$user->name}}</a></h5>
                                                  
                                                    </td>
                                                    <td>
                                                        <div class="avatar-group">
                                                            <div class="avatar-group-item">
                                                                <a href="javascript: void(0);" class="d-inline-block">
                                                                    <div class="project">
                                                                        @if($user->image)
                                                                        <img src="{{asset($user->image) }}" alt="" class="rounded-circle avatar-xs">
                                                                        @else
                                                                            <p>No image</p>
                                                                        @endif                                                                    
                                                                    </div>
     
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td> <p class="text-muted mb-0">{{$user->designation}}</p></td>
                                                    <td>{{$task}}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <a href="#" class="dropdown-toggle card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="mdi mdi-dots-horizontal font-size-18"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="#">Action</a>
                                                                <a class="dropdown-item" href="{{ route('users.edit',$user->id) }}">Edit</a>
                                                                <a class="dropdown-item" href="{{ route('users.show',$user->id) }}">View</a>
                                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this task?');">Delete</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </div> <!-- container-fluid -->
            </div>

    </div>
    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

</body>

@endsection