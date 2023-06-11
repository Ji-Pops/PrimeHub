@extends('layouts.app')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Task Assignment</h1>

    <div class="row">
        <!-- Left half of the form -->
        <div class="col-md-6">
            <!-- Card -->
            <div class="card shadow mb-4 h-100">
                <!-- Card Header -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Task Details</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.maintenanceAssignmentProcess') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $maintenance->id }}">
                        <div class="form-group">
                            <label for="unit_number">Unit Number</label>
                            <input type="text" name="unit_number" class="form-control" value="{{ $maintenance->unit_number }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="unit_name">Unit Name</label>
                            <input type="text" name="unit_name" class="form-control" value="{{ $maintenance->unit_name }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="request_date_created">Request Date Created</label>
                            <input type="text" name="request_date_created" class="form-control" value="{{ $maintenance->created_at }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="tenant_name">Tenant's Name</label>
                            <input type="text" name="tenant_name" class="form-control" value="{{ $tenant_name }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="tenant_name">Description</label>
                            <input type="text" name="description" class="form-control" value="{{ $maintenance->description }}" readonly>
                        </div>
                </div>
            </div>
        </div>
        <!-- Right half of the form -->
        <div class="col-md-6">
            <!-- Card -->
            <div class="card shadow mb-4 h-100">
                <!-- Card Body -->
                <div class="card-body">
                    <div class="form-group">
                        <label for="category">Category</label>
                        <input type="text" name="category" class="form-control" value="{{ $maintenance->category }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="notes">Notes</label>
                        <textarea name="notes" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="maintenance_personnel">Maintenance Personnel</label>
                        <select name="maintenance_personnel" class="form-control">
                            @foreach ($personnel as $person)
                                <option value="{{ $person->id }}">{{ $person->first_name }} {{ $person->last_name }} - {{ $person->department }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="approved_by">Approved By</label>
                        @php
                            $approved_by_fullname = session('user_fullname');
                        @endphp
                        <input type="text" name="approved_by" class="form-control" value="{{ $approved_by_fullname }}" readonly>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.maintenance-view', ['id' => $maintenance->id]) }}" class="btn btn-primary">Back</a>
                        <button type="submit" class="btn btn-success" name="create_order">Assign</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End of Main Content -->
@endsection
