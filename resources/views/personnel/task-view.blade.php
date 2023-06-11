@extends('layouts.appTenant')

@section('content')
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Task View</h1>
            <!-- Dropdown Card -->
            <div class="card shadow mb-4">
                <!-- Card Header -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Maintenance Requests</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    @php
                        use App\Models\WorkOrder;
                        $workOrders = WorkOrder::where('personnel', session('user_fullname'))->get();
                    @endphp
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Work Order Number</th>
                                    <th>Unit Name</th>
                                    <th>Description</th>
                                    <th>Department</th>
                                    <th>Notes</th>
                                    <th>Approved By</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($workOrders as $workOrder)
                                    @php
                                        switch ($workOrder->status) {
                                            case 'Pending':
                                                $color = 'warning';
                                                $route = route('personnel.assess-maintenance', ['id' => $workOrder->id]);
                                                break;
                                            case 'In-Progress':
                                                $color = 'success';
                                                $route = route('personnel.complete-maintenance', ['id' => $workOrder->id]);
                                                break;
                                            case 'Completed':
                                                $color = 'secondary';
                                                $route = route('personnel.assess-maintenance', ['id' => $workOrder->id]);
                                                break;
                                            default:
                                                $color = 'secondary';
                                                $route = '';
                                                break;
                                        }
                                    @endphp
                                    <tr>
                                        <td>{{ $workOrder->work_order_number }}</td>
                                        <td>{{ $workOrder->unit_name }}</td>
                                        <td>{{ $workOrder->description }}</td>
                                        <td>{{ $workOrder->department }}</td>
                                        <td>{{ $workOrder->notes }}</td>
                                        <td>{{ $workOrder->approved_by_full_name }}</td>
                                        <td>
                                            <span class="badge badge-{{ $color }}">{{ $workOrder->status }}</span>
                                        </td>
                                        <td>
                                            @if ($route)
                                                <a href="{{ $route }}" class="btn btn-primary">View</a>
                                            @endif
                                        </td>
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
