@extends('layouts.app')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">User Registration</h1>
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-7 mx-auto">
                    <div class="p-5">
                        <form class="user" action="{{ route('admin.registerAdmin') }}" method="POST" onsubmit="return validateForm()">
                            @csrf
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username" minlength="6" maxlength="16" pattern="^[a-zA-Z0-9-]+$"
                                value="{{ 'A' . '-' . $admin->first_name}}" title="Username must be at least 6 characters long and can only contain letters, numbers, and dash." required>
                                <small id="username-error" class="form-text text-danger d-none">Username cannot be empty.</small>
                            </div>
                            <div class="form-group">
                                <label for="contact_id">Select ID</label>
                                <div class="input-group">
                                    <input type="text" class="form-control ml-2 form-control-user" id="selected_id" name="contact_id" placeholder="ID" readonly value="{{ $admin->id}}">
                                    <input type="email" class="form-control ml-2 form-control-user" id="selected_email" name="email" placeholder="Enter Email"  readonly value="{{ $admin->email}}">
                                </div>
                                <small id="contact_id-error" class="form-text text-danger d-none">ID and email cannot be empty.</small>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password" required
                                    value="{{ 'Tenant.' . $admin->phone}}">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="show-password-toggle" onclick="togglePasswordVisibility()">
                                            <i class="fa fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                                <small id="password-error" class="form-text text-danger d-none">Password cannot be empty.</small>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" value="Register User" class="btn btn-primary btn-user btn-block">
                            </div>
                        </form>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
     // Toggle password visibility
     let passwordVisible = false;

    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const showPasswordToggle = document.getElementById('show-password-toggle');
        
        passwordVisible = !passwordVisible;

        if (passwordVisible) {
            passwordInput.type = 'text';
            showPasswordToggle.innerHTML = '<i class="fa fa-eye-slash"></i>';
        } else {
            passwordInput.type = 'password';
            showPasswordToggle.innerHTML = '<i class="fa fa-eye"></i>';
        }
    }
    
    // Check and validate password
    function validateForm() {
        const password = document.getElementById('password').value;
        const passwordError = document.getElementById('password-error');

        // Reset all error messages
        passwordError.classList.add('d-none');

        if (password.trim() === '') {
            passwordError.classList.remove('d-none');
            return false;
        }
    }

    // Add input event listener to input fields to reset if user input again
    const passwordInput = document.getElementById('password');

    passwordInput.addEventListener('input', () => {
        const passwordError = document.getElementById('password-error');
        passwordError.classList.add('d-none');
    });
</script>
