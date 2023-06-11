@extends('layouts.app')

@section('content')
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Maintenance Task</h1>
            <!-- Dropdown Card -->
            <div class="card shadow mb-4">
                <!-- Card Header -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Maintenance Requests</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <!-- Filter Options -->
                        <form method="GET" action="">
                            <div class="form-group">
                                <label for="statusFilter">Filter by Status:</label>
                                <select class="form-control" id="statusFilter" name="status">
                                    <option value="" {{ ($status == '') ? 'selected' : '' }}>All</option>
                                    <option value="open" {{ ($status == 'Open') ? 'selected' : '' }}>Open</option>
                                    <option value="pending" {{ ($status == 'Pending') ? 'selected' : '' }}>Pending</option>
                                    <option value="in-progress" {{ ($status == 'In-Progress') ? 'selected' : '' }}>In Progress</option>
                                    <option value="closed" {{ ($status == 'Closed') ? 'selected' : '' }}>Closed</option>
                                    <option value="completed" {{ ($status == 'Completed') ? 'selected' : '' }}>Completed</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Apply Filter</button>
                        </form>
                        <!-- Table -->
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Unit Number/Unit Name</th>
                                    <th>Category</th>
                                    <th>Created</th>
                                    <th>Status</th>
                                    <th>Updated</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($maintenances ?? [] as $maintenance)
                                @php
                                    switch ($maintenance->status) {
                                        case 'Open':
                                            $color = 'success';
                                            break;
                                        case 'In-Progress':
                                            $color = 'warning';
                                            break;
                                        case 'Closed':
                                            $color = 'danger';
                                            break;
                                        case 'Completed':
                                            $color = 'secondary';
                                            break;
                                        case 'Pending':
                                            $color = 'primary';
                                            break;
                                        default:
                                            $color = 'secondary';
                                            break;
                                    }
                                @endphp
                                <tr class="maintenance-row">
                                    <td>{{ $maintenance->unit_number }} {{ $maintenance->unit_name }}</td>
                                    <td>{{ $maintenance->category }}</td>
                                    <td>{{ $maintenance->created_at }}</td>
                                    <td><span class="badge badge-{{ $color }}">{{ $maintenance->status }}</span></td>
                                    <td>{{ $maintenance->updated_at }}</td>
                                    <td><a href="{{ route('admin.maintenance-view', ['id' => $maintenance->id]) }}" class="btn btn-primary">View</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
$(document).ready(function() {
    // Submit the form on status filter change
    $('#statusFilter').on('change', function() {
        $('#filterForm').submit();
    });
});
</script>