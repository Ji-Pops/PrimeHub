@extends('layouts.app')

@section('content')
<link href="{{ asset('css/unitStyle.css') }}" rel="stylesheet">
<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Units</h1>
    </div>

    @if(session('added_success_message'))
    <div class="alert alert-success">
        {{ session('added_success_message') }}
    </div>
    @endif

    @if(session('deleted_success_message'))
    <div class="alert alert-success">
        {{ session('deleted_success_message') }}
    </div>
    @endif

    <div class="row">
        <!-- Table Card -->
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Units</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Unit Number</th>
                                    <th>Unit Name</th>
                                    <th>Contacts Tenant ID</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($units as $unit)
                                <tr>
                                    <td>{{ $unit->unit_number }}</td>
                                    <td>{{ $unit->unit_name }}</td>
                                    <td>{{ $unit->contacts_tenant_id }}</td>
                                    <td>
                                        <form action="{{ route('admin.deleteUnit', ['unit' => $unit->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end mt-3">
                {{ $units->links(('pagination::bootstrap-5')) }}
            </div>
        </div>

        <!-- Form Card -->
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Add Unit</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.addUnit') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="unit_number">Unit Number</label>
                            <input type="text" class="form-control" id="unit_number" name="unit_number" required>
                        </div>
                        <div class="form-group">
                            <label for="unit_name">Unit Name</label>
                            <input type="text" class="form-control" id="unit_name" name="unit_name">
                        </div>
                        <div class="form-group">
                            <label for="contacts_tenant_id">Tenant</label>
                            <select class="form-control" id="contacts_tenant_id" name="contacts_tenant_id">
                                <option value="" selected>Select Tenant</option>
                                @foreach($contacts as $contact)
                                    @if ($contact->user_type === 'tenant')
                                        <option value="{{ $contact->id }}">
                                            {{ $contact->first_name }} {{ $contact->last_name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Unit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    setTimeout(function() {
    $('.alert-success').hide();
    }, 2000);
</script>
