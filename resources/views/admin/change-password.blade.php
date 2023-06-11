@extends('layouts.app')

@section('content')
<link href="{{ asset('css/dashboardStyle.css') }}" rel="stylesheet">
<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Change Password</h1>
    </div>

    <div class="card">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif

            @if(session('changed_success_message'))
                <div class="alert alert-success">
                    {{ session('changed_success_message') }}
                </div>
            @endif

            <form id="changePasswordForm" action="{{ route('admin.changePassword', ['id' => auth()->user()->id]) }}" method="POST" onsubmit="return validateForm()">
                @csrf

                <div class="form-group">
                    <label for="current_password">Current Password:</label>
                    <input type="password" name="current_password" id="current_password" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="new_password">New Password:</label>
                    <input type="password" name="new_password" id="new_password" class="form-control" required minlength="8" maxlength="16" pattern="^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[_.@#$%^&*()-+])[a-zA-Z0-9_.@#$%^&*()-+]{8,16}$" title="Password must be at least 8 characters long and must contain at least one uppercase letter, one lowercase letter, one number, and one special character.">
                </div>

                <div class="form-group">
                    <label for="confirm_password">Repeat Password:</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                </div>

                <small id="password-match-error" class="form-text text-danger d-none">Passwords do not match.</small>

                <button type="submit" class="btn btn-primary">Change Password</button>
            </form>
        </div>
    </div>
</div>
<script>
    function validateForm() {
        var newPassword = document.getElementById("new_password").value;
        var confirmPassword = document.getElementById("confirm_password").value;

        if (newPassword !== confirmPassword) {
            document.getElementById("password-match-error").classList.remove("d-none");
            return false;
        }

        return true;
    }
</script>
<script>
    setTimeout(function() {
        $('.alert-success').hide();
        $('.alert-danger').hide();
    }, 2000);
</script>
@endsection
