@extends('layouts.appTenant')

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Complete Task</h1>

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
            <form method="POST" action="{{ route('personnel.completeTask', ['id' => $maintenance->id]) }}" enctype="multipart/form-data">
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
                    <label for="assessment">Assessment</label>
                    <textarea name="assessment" class="form-control" readonly>{{ $maintenance->assessment }}</textarea>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <input type="text" name="category" class="form-control" value="{{ $maintenance->category }}" readonly>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('personnel.task-view') }}" class="btn btn-primary">Back</a>
                <button type="submit" class="btn btn-success" name="accept_task">Complete</button>
            </div>
        </div>
    </div>
</div>
</form> <!-- Closing tag for the form -->
<!-- End of Main Content -->
@endsection
