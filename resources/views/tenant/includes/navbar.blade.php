<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>


<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">
    <!-- Notification Bell icon -->
    <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="notificationsDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bell fa-fw"></i>
            <!-- Notification count -->
            <span class="badge badge-danger badge-counter">
                @php
                    $user = auth()->user();
                    $notifications = \App\Models\Notification::where('is_read', 0)
                        ->where('notification_for', 'tenant')
                        ->where('user_id', $user->id)
                        ->orderBy('updated_at', 'desc') // Order by updated_at in descending order
                        ->get();
                    $notificationsCount = $notifications->count();
                    echo $notificationsCount;
                @endphp
            </span>
        </a>
        <!-- Dropdown - Notifications -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="notificationsDropdown">
            @foreach($notifications as $notification)
            <a class="dropdown-item" href="{{ route('tenant.view-maintenance', ['maintenance_id' => $notification->maintenance_id]) }}" data-id="{{ $notification->maintenance_id }}">
                <i class="fas fa-exclamation-circle fa-sm fa-fw mr-2 text-gray-400"></i>
                {{ $notification->message }}
            </a>
            @endforeach
            <div class="dropdown-divider"></div>
            <a class="dropdown-item text-center small text-gray-500" href="{{ route('tenant.view-maintenance') }}">View all notifications</a>
        </div>
    </li>
</ul>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ session('user_fullname') }}</span>
                <img class="img-profile rounded-circle" src="{{ asset('storage/' . session('user_profile_picture')) }}">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('tenant.change-password') }}">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Change Password
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
<!-- End of Topbar -->
