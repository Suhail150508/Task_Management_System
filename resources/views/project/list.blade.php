
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
                                                    <th scope="col">Projects</th>
                                                    <th scope="col">Due Date</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Employee</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($projects as $index => $project )

                                                    <tr>
                                                        <td>{{$index + 1}}</td>
                                                        <td>
                                                            <h5 class="text-truncate font-size-14"><a href="javascript: void(0);" class="text-dark">{{$project->name}}</a></h5>
                                                            <p class="text-muted mb-0">{{$project->description}}</p>
                                                        </td>
                                                        <td>{{$project->start_date}}</td>
                                                        <td><span class="badge bg-success">{{$project->status}}</span></td>
                                                        <td>
                                                            <div class="avatar-group">
                                                                <div class="avatar-group-item">
                                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                                        {{-- <img src="assets/images/users/avatar-4.jpg" alt="" class="rounded-circle avatar-xs"> --}}
                                                                        {{-- <img src="{{ asset('storage/projects/' . $project->image) }}" alt="" class="rounded-circle avatar-xs"> --}}

                                                                        <div class="project">
                                                                            @if($project->image && \Storage::disk('public')->exists('images/' . $project->image))
                                                                                <img src="{{ asset('storage/images/' . $project->image) }}" alt="{{ $project->name }}" class="rounded-circle avatar-xs">
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
                                                                    <a class="dropdown-item" href="{{ route('projects.edit',$project->id) }}">Edit</a>
                                                                    <a class="dropdown-item" href="{{ route('projects.show',$project->id) }}">View</a>
                                                                    <a class="dropdown-item" href="{{ route('projects.delete',$project->id) }}">View</a>
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