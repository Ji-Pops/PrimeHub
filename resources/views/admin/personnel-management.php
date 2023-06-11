@extends('layouts.app')

@section('content')
<link href="{{ asset('css/unitStyle.css') }}" rel="stylesheet">
<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Personnel</h1>
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
                    <h6 class="m-0 font-weight-bold text-primary">Personnel</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Department</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($personnels as $personnel)
                                <tr>
                                    <td>{{ $personnel->first_name }} {{ $personnel->last_name }}</td>
                                    <td>{{ $personnel->department }}</td>
                                    <td>{{ $personnel->phone }}</td>
                                    <td>{{ $personnel->email }}</td>
                                    <td>
                                        <form action="{{ route('admin.deletePersonnel', ['personnel' => $personnel->id]) }}" method="POST">
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
                {{ $personnels->links(('pagination::bootstrap-5')) }}
            </div>
        </div>

        <!-- Form Card -->
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Add Personnel</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.addPersonnel') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required>
                        </div>
                        <div class="form-group">
                            <label for="department">Department</label>
                            <input type="text" class="form-control" id="department" name="department">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <button type="submit" class="btn btn-primary">Add Personnel</button>
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
