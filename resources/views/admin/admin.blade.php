@extends('layouts.app')

@section('content')
<link href="{{ asset('css/contactsStyle.css') }}" rel="stylesheet">
<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Admin&nbsp</h1>
        <a href="{{ url('admin/add-admin') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-user-plus fa-sm text-white-50"></i> Admin
        </a>
    </div>

    @if(session('updated_success_message'))
    <div class="alert alert-success">
        {{ session('updated_success_message') }}
    </div>
    @endif

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
    
    <div class="container">
        @php
            $admins = App\Models\Contact::where('user_type', 'admin')->get();
        @endphp
        @foreach ($admins as $admin)
            <div class="card custom">
                <div class="container">
                    <div class="picture-holder custom" style="background-image: url('{{ asset('storage/' . $admin->profile_picture_path) }}');"></div>
                    <h4>{{ $admin->first_name . ' ' . $admin->last_name }}</h4>
                    <div class="info">
                        <p><b>Phone:</b> {{ $admin->phone }}</p>
                        <p><b>Email:</b> {{ $admin->email }}</p>
                        <div class="buttons">
                            <a href="{{ url('admin/update-admin', ['id' => $admin->id]) }}">
                                <button class="edit-button btn btn-success" data-id="{{ $admin->id }}">Update</button>
                            </a>

                            @php
                                $user = App\Models\User::where('contact_id', $admin->id)->first();
                            @endphp

                            @if ($user)
                            <button class="delete-button btn btn-danger" data-id="{{ $admin->id }}" data-toggle="modal" data-target="#confirmDeleteModal">
                                Delete
                            </button>
                            @else
                            <a href="{{ route('admin.admin-registration', ['id' => $admin->id]) }}">
                                <button class="register-button btn btn-primary" data-id="{{ $admin->id }}">Register</button>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this contact?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="deleteContactForm" action="{{ route('admin.deleteAdmin', ['id' => $admin->id]) }}" method="POST">
                    @csrf
                    <input type="hidden" id="contactId" name="contact_id" value="">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
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
