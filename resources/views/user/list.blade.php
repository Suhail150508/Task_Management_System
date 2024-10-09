
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
                                                <th scope="col" style="width: 100px">SL</th>
                                                <th scope="col">Username</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Role</th>
                                                <th scope="col">Designation</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $index => $user )

                                                <tr>
                                                    <td>{{$index + 1}}</td>
                                                    <td>
                                                        <h5 class="text-truncate font-size-14"><a href="javascript: void(0);" class="text-dark">{{$user->name}}</a></h5>
                                                  
                                                    </td>
                                                    <td> <p class="text-muted mb-0">{{$user->email}}</p>
                                                    </td>
                                                    <td>{{$user->role}}</td>
                                                    <td>
                                                        <div class="avatar-group">
                                                            <div class="avatar-group-item">
                                                                <a href="javascript: void(0);" class="d-inline-block">
                                                                    <div class="project">
                                                                        @if($user->image && \Storage::disk('public')->exists('images/' . $user->image))
                                                                            <img src="{{ asset('storage/images/' . $user->image) }}" alt="{{ $user->name }}" class="rounded-circle avatar-xs">
                                                                        @else
                                                                            <p>No image available.</p>
                                                                        @endif
                                                                    </div>
     
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <a href="#" class="dropdown-toggle card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="mdi mdi-dots-horizontal font-size-18"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="#">Action</a>
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