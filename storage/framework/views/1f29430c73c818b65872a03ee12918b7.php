

<?php $__env->startSection('content'); ?>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Task View</h1>
            <!-- Dropdown Card -->
            <div class="card shadow mb-4">
                <!-- Card Header -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Maintenance Requests</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <?php
                        use App\Models\WorkOrder;
                        $workOrders = WorkOrder::where('personnel', session('user_fullname'))->get();
                    ?>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Work Order Number</th>
                                    <th>Unit Name</th>
                                    <th>Description</th>
                                    <th>Department</th>
                                    <th>Notes</th>
                                    <th>Approved By</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $workOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $workOrder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        switch ($workOrder->status) {
                                            case 'Pending':
                                                $color = 'warning';
                                                $route = route('personnel.assess-maintenance', ['id' => $workOrder->id]);
                                                break;
                                            case 'In-Progress':
                                                $color = 'success';
                                                $route = route('personnel.complete-maintenance', ['id' => $workOrder->id]);
                                                break;
                                            case 'Completed':
                                                $color = 'secondary';
                                                $route = route('personnel.assess-maintenance', ['id' => $workOrder->id]);
                                                break;
                                            default:
                                                $color = 'secondary';
                                                $route = '';
                                                break;
                                        }
                                    ?>
                                    <tr>
                                        <td><?php echo e($workOrder->work_order_number); ?></td>
                                        <td><?php echo e($workOrder->unit_name); ?></td>
                                        <td><?php echo e($workOrder->description); ?></td>
                                        <td><?php echo e($workOrder->department); ?></td>
                                        <td><?php echo e($workOrder->notes); ?></td>
                                        <td><?php echo e($workOrder->approved_by_full_name); ?></td>
                                        <td>
                                            <span class="badge badge-<?php echo e($color); ?>"><?php echo e($workOrder->status); ?></span>
                                        </td>
                                        <td>
                                            <?php if($route): ?>
                                                <a href="<?php echo e($route); ?>" class="btn btn-primary">View</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.appTenant', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\gamev\OneDrive\Desktop\PrimeHub\PrimeHub\resources\views/personnel/task-view.blade.php ENDPATH**/ ?>