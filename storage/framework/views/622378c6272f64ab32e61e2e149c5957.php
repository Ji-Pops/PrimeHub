

<?php $__env->startSection('content'); ?>
<link href="<?php echo e(asset('css/contactsStyle.css')); ?>" rel="stylesheet">
<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tenant&nbsp</h1>
        <a href="<?php echo e(url('admin/add-tenant')); ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-user-plus fa-sm text-white-50"></i>Tenant
        </a>
    </div>

    <?php if(session('updated_success_message')): ?>
        <div class="alert alert-success">
            <?php echo e(session('updated_success_message')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('added_success_message')): ?>
        <div class="alert alert-success">
            <?php echo e(session('added_success_message')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('deleted_success_message')): ?>
        <div class="alert alert-success">
            <?php echo e(session('deleted_success_message')); ?>

        </div>
    <?php endif; ?>

    <div class="container">
        <div id="searchResults"></div>
        <?php $__currentLoopData = $tenants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tenant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $unit = App\Models\Unit::where('contacts_tenant_id', $tenant->id)->first();
            ?>

            <div class="card custom">
                <div class="container">
                    <div class="picture-holder custom" style="background-image: url('<?php echo e(asset('storage/' . $tenant->profile_picture_path)); ?>');"></div>
                    <h4><?php echo e($tenant->first_name . ' ' . $tenant->last_name); ?></h4>
                    <div class="info">
                    <?php if($unit): ?>
                        <p><b>Unit Number:</b> <?php echo e($unit->unit_number); ?></p>
                        <p><b>Unit Name:</b> <?php echo e($unit->unit_name); ?></p>
                    <?php else: ?>
                        <p><b>Unit Number:</b></p>
                        <p><b>Unit Name:</b></p>
                    <?php endif; ?>
                    <p><b>Phone:</b> <?php echo e($tenant->phone); ?></p>
                    <p><b>Email:</b> <?php echo e($tenant->email); ?></p>
                        <div class="buttons">
                            <a href="<?php echo e(url('admin/update-tenant', ['id' => $tenant->id])); ?>">
                                <button class="edit-button btn btn-success" data-id="<?php echo e($tenant->id); ?>">Update</button>
                            </a>

                            <?php
                                $user = App\Models\User::where('contact_id', $tenant->id)->first();
                            ?>

                            <?php if($user): ?>
                                <button class="delete-button btn btn-danger" data-id="<?php echo e($tenant->id); ?>" data-toggle="modal" data-target="#confirmDeleteModal">
                                    Delete
                                </button>
                            <?php else: ?>
                                <a href="<?php echo e(url('admin/user-registration', ['id' => $tenant->id])); ?>">
                                    <button class="register-button btn btn-primary" data-id="<?php echo e($tenant->id); ?>">Register</button>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<!-- Pagination links -->
<?php echo e($tenants->links('pagination::bootstrap-5')); ?>

<script>
    const deleteButtons = document.querySelectorAll('.delete-button');
    deleteButtons.forEach(button => {
        button.addEventListener('click', () => {
            const fullName = button.closest('.card').querySelector('h4').textContent;
            const id = button.getAttribute('data-id');
            const confirmDelete = confirm(`Do you want to remove ${fullName} from contacts?`);
            if (confirmDelete) {
                window.location.href = `<?php echo e(url('delete_tenant')); ?>?id=${id}`;
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
<?php $__env->stopSection(); ?>

<script>
    setTimeout(function() {
        $('.alert-success').hide();
    }, 2000);
</script>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\gamev\OneDrive\Desktop\PrimeHub\PrimeHub\resources\views/admin/tenants.blade.php ENDPATH**/ ?>