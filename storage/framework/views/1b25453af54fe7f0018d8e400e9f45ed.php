

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
    <div class="card-deck">
        <div class="card custom blue">
            <div class="card-body text-center">
                <i class="fas fa-user fa-3x"></i>
                <h4 class="card-title">Total Tenants: <?php echo e($total_tenants); ?></h4>
            </div>
        </div>

        <div class="card custom green">
            <div class="card-body text-center" data-toggle="collapse" data-target="#collapseContent" aria-expanded="false" aria-controls="collapseContent">
                <i class="fas fa-list-alt fa-3x"></i>
                <h4 class="card-title">Total Requests: <?php echo e($total_requests); ?></h4>
                <div id="collapseContent" class="collapse">
                    <p class="card-text">Open Requests: <?php echo e($open_requests); ?></p>
                    <p class="card-text">Pending Requests: <?php echo e($pending_requests); ?></p>
                    <p class="card-text">In-progress Requests: <?php echo e($inprogress_requests); ?></p>
                    <p class="card-text">Completed Requests: <?php echo e($completed_requests); ?></p>
                    <p class="card-text">ClosedRequests: <?php echo e($closed_requests); ?></p>
                </div>
            </div>
        </div>

        <div class="card custom red">
            <div class="card-body text-center">
                <i class="fas fa-tasks fa-3x"></i>
                <h4 class="card-title">Open Work Orders: <?php echo e($open_work_orders); ?></h4>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var cardBodyGreen = document.querySelector('.card.custom.green .card-body');

        cardBodyGreen.addEventListener('click', function() {
            var cardCustomGreen = document.querySelector('.card.custom.green');
            cardCustomGreen.classList.toggle('expanded');
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\gamev\OneDrive\Desktop\PrimeHub\PrimeHub\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>