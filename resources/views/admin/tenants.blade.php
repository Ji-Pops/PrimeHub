@extends('layouts.app')

@section('content')
<link href="{{ asset('css/contactsStyle.css') }}" rel="stylesheet">
<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tenant&nbsp</h1>
        <a href="{{ url('admin/add-tenant') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-user-plus fa-sm text-white-50"></i>Tenant
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
        <div id="searchResults"></div>
        @foreach ($tenants as $tenant)
            @php
                $unit = App\Models\Unit::where('contacts_tenant_id', $tenant->id)->first();
            @endphp

            <div class="card custom">
                <div class="container">
                    <div class="picture-holder custom" style="background-image: url('{{ asset('storage/' . $tenant->profile_picture_path) }}');"></div>
                    <h4>{{ $tenant->first_name . ' ' . $tenant->last_name }}</h4>
                    <div class="info">
                    @if ($unit)
                        <p><b>Unit Number:</b> {{ $unit->unit_number }}</p>
                        <p><b>Unit Name:</b> {{ $unit->unit_name }}</p>
                    @else
                        <p><b>Unit Number:</b></p>
                        <p><b>Unit Name:</b></p>
                    @endif
                    <p><b>Phone:</b> {{ $tenant->phone }}</p>
                    <p><b>Email:</b> {{ $tenant->email }}</p>
                        <div class="buttons">
                            <a href="{{ url('admin/update-tenant', ['id' => $tenant->id]) }}">
                                <button class="edit-button btn btn-success" data-id="{{ $tenant->id }}">Update</button>
                            </a>

                            @php
                                $user = App\Models\User::where('contact_id', $tenant->id)->first();
                            @endphp

                            @if ($user)
                                <button class="delete-button btn btn-danger" data-id="{{ $tenant->id }}" data-toggle="modal" data-target="#confirmDeleteModal">
                                    Delete
                                </button>
                            @else
                                <a href="{{ url('admin/user-registration', ['id' => $tenant->id]) }}">
                                    <button class="register-button btn btn-primary" data-id="{{ $tenant->id }}">Register</button>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<!-- Pagination links -->
{{ $tenants->links('pagination::bootstrap-5') }}
<script>
    const deleteButtons = document.querySelectorAll('.delete-button');
    deleteButtons.forEach(button => {
        button.addEventListener('click', () => {
            const fullName = button.closest('.card').querySelector('h4').textContent;
            const id = button.getAttribute('data-id');
            const confirmDelete = confirm(`Do you want to remove ${fullName} from contacts?`);
            if (confirmDelete) {
                window.location.href = `{{ url('delete_tenant') }}?id=${id}`;
            }
        });
    });

    // Automatically hide the success message after 2 seconds
    setTimeout(function() {
        var successMessage = document.getElementById('success-message');
        if (successMessage) {
            successMessage.style.display = 'none';
        }
    }, 2000);
</script>
@endsection

<script>
    setTimeout(function() {
        $('.alert-success').hide();
    }, 2000);
</script>
