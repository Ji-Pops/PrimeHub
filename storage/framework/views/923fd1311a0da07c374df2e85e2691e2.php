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
                    <?php
                        $user = auth()->user();
                        $notifications = \App\Models\Notification::where('is_read', 0)
                            ->where('notification_for', 'tenant')
                            ->where('user_id', $user->id)
                            ->get();
                        $notificationsCount = $notifications->count();
                        echo $notificationsCount;
                    ?>
                </span>
            </a>
            <!-- Dropdown - Notifications -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="notificationsDropdown">
                <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a class="dropdown-item" href="<?php echo e(route('tenant.view-maintenance', ['maintenance_id' => $notification->maintenance_id])); ?>" data-id="<?php echo e($notification->maintenance_id); ?>">
                    <i class="fas fa-exclamation-circle fa-sm fa-fw mr-2 text-gray-400"></i>
                    <?php echo e($notification->message); ?>

                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-center small text-gray-500" href="<?php echo e(route('tenant.view-maintenance')); ?>">View all notifications</a>
            </div>
        </li>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo e(session('user_fullname')); ?></span>
                <img class="img-profile rounded-circle" src="<?php echo e(asset('storage/' . session('user_profile_picture'))); ?>">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?php echo e(route('tenant.change-password')); ?>">
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
<?php /**PATH C:\Users\gamev\OneDrive\Desktop\PrimeHub\PrimeHub\resources\views/personnel/includes/navbar.blade.php ENDPATH**/ ?>