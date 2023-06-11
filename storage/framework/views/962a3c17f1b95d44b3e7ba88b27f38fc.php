

<?php $__env->startSection('content'); ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">View Request</h1>
    
    <!-- Dropdown Card -->
    <div class="card shadow mb-4">
        <!-- Card Header -->
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Maintenance Request</h6>
        </div>
        
        <?php if(session('request_success_message')): ?>
            <div class="alert alert-success">
                <?php echo e(session('request_success_message')); ?>

            </div>
        <?php endif; ?>
        <!-- Card Body -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Unit Number</th>
                            <th>Unit Name</th>
                            <th>Category</th>
                            <th>Description</th>

                            <th>Status</th>
                            <th>Photos</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $maintenanceRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                // Define the color code based on the status
                                $colorCode = '';
                                switch ($request->status) {
                                    case 'Open':
                                        $colorCode = 'success';
                                        break;
                                    case 'In-Progress':
                                        $colorCode = 'warning';
                                        break;
                                    case 'Cancelled':
                                        $colorCode = 'danger';
                                        break;
                                    case 'Completed':
                                        $colorCode = 'secondary';
                                        break;
                                    default:
                                        $colorCode = 'light';
                                }
                            ?>
                            <tr>
                                <td><?php echo e($request->unit_number); ?></td>
                                <td><?php echo e($request->unit_name); ?></td>
                                <td><?php echo e($request->category); ?></td>
                                <td><?php echo e($request->description); ?></td>
                                <td><span class="badge badge-<?php echo e($colorCode); ?>"><?php echo e($request->status); ?></span></td>
                                <td><img src="<?php echo e(asset('storage/maintenance_request_photo/' . $request->photo)); ?>" width="100px" height="100px"></td>
                                <td>
                                    <a href="<?php echo e(route('tenant.track-maintenance', ['id' => $request->id])); ?>" class="btn btn-primary">View</a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End of Dropdown Card -->
<?php $__env->stopSection(); ?>
<script>
    setTimeout(function() {
    $('.alert-success').hide();
    }, 2000);
</script>

<?php echo $__env->make('layouts.appTenant', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\gamev\OneDrive\Desktop\PrimeHub\PrimeHub\resources\views/tenant/view-maintenance.blade.php ENDPATH**/ ?>