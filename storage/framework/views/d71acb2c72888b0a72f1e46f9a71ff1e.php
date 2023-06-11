

<?php $__env->startSection('content'); ?>
<link href="<?php echo e(asset('css/dashboardStyle.css')); ?>" rel="stylesheet">
<div class="container">
    <?php if(auth()->user()->created_at == auth()->user()->updated_at): ?>
        <div class="alert alert-warning">
            Please change your password before accessing the system.
        </div>
    <?php endif; ?>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.appTenant', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\gamev\OneDrive\Desktop\PrimeHub\PrimeHub\resources\views/tenant/dashboard.blade.php ENDPATH**/ ?>