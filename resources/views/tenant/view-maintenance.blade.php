@extends('layouts.appTenant')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">View Request</h1>
    
    <!-- Dropdown Card -->
    <div class="card shadow mb-4">
        <!-- Card Header -->
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Maintenance Request</h6>
        </div>
        
        @if(session('request_success_message'))
            <div class="alert alert-success">
                {{ session('request_success_message') }}
            </div>
        @endif
        <!-- Card Body -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Unit Number</th>
                            <th>Unit Name</th>
                            <th>Category</th>
                            <th>Description</th>

                            <th>Status</th>
                            <th>Photos</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($maintenanceRequests as $request)
                            @php
                                // Define the color code based on the status
                                $colorCode = '';
                                switch ($request->status) {
                                    case 'Open':
                                        $colorCode = 'success';
                                        break;
                                    case 'In-Progress':
                                        $colorCode = 'warning';
                                        break;
                                    case 'Cancelled':
                                        $colorCode = 'danger';
                                        break;
                                    case 'Completed':
                                        $colorCode = 'secondary';
                                        break;
                                    default:
                                        $colorCode = 'light';
                                }
                            @endphp
                            <tr>
                                <td>{{ $request->unit_number }}</td>
                                <td>{{ $request->unit_name }}</td>
                                <td>{{ $request->category }}</td>
                                <td>{{ $request->description }}</td>
                                <td><span class="badge badge-{{ $colorCode }}">{{ $request->status }}</span></td>
                                <td><img src="{{ asset('storage/maintenance_request_photo/' . $request->photo) }}" width="100px" height="100px"></td>
                                <td>
                                    <a href="{{ route('tenant.track-maintenance', ['id' => $request->id]) }}" class="btn btn-primary">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End of Dropdown Card -->
@endsection
<script>
    setTimeout(function() {
    $('.alert-success').hide();
    }, 2000);
</script>
