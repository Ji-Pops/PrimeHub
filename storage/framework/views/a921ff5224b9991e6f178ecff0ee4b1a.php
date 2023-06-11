

<?php $__env->startSection('content'); ?>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Maintenance Task</h1>
            <!-- Dropdown Card -->
            <div class="card shadow mb-4">
                <!-- Card Header -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Maintenance Requests</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <!-- Filter Options -->
                        <form method="GET" action="">
                            <div class="form-group">
                                <label for="statusFilter">Filter by Status:</label>
                                <select class="form-control" id="statusFilter" name="status">
                                    <option value="" <?php echo e(($status == '') ? 'selected' : ''); ?>>All</option>
                                    <option value="open" <?php echo e(($status == 'Open') ? 'selected' : ''); ?>>Open</option>
                                    <option value="pending" <?php echo e(($status == 'Pending') ? 'selected' : ''); ?>>Pending</option>
                                    <option value="in-progress" <?php echo e(($status == 'In-Progress') ? 'selected' : ''); ?>>In Progress</option>
                                    <option value="closed" <?php echo e(($status == 'Closed') ? 'selected' : ''); ?>>Closed</option>
                                    <option value="completed" <?php echo e(($status == 'Completed') ? 'selected' : ''); ?>>Completed</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Apply Filter</button>
                        </form>
                        <!-- Table -->
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Unit Number/Unit Name</th>
                                    <th>Category</th>
                                    <th>Created</th>
                                    <th>Status</th>
                                    <th>Updated</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $maintenances ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $maintenance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    switch ($maintenance->status) {
                                        case 'Open':
                                            $color = 'success';
                                            break;
                                        case 'In-Progress':
                                            $color = 'warning';
                                            break;
                                        case 'Closed':
                                            $color = 'danger';
                                            break;
                                        case 'Completed':
                                            $color = 'secondary';
                                            break;
                                        case 'Pending':
                                            $color = 'primary';
                                            break;
                                        default:
                                            $color = 'secondary';
                                            break;
                                    }
                                ?>
                                <tr class="maintenance-row">
                                    <td><?php echo e($maintenance->unit_number); ?> <?php echo e($maintenance->unit_name); ?></td>
                                    <td><?php echo e($maintenance->category); ?></td>
                                    <td><?php echo e($maintenance->created_at); ?></td>
                                    <td><span class="badge badge-<?php echo e($color); ?>"><?php echo e($maintenance->status); ?></span></td>
                                    <td><?php echo e($maintenance->updated_at); ?></td>
                                    <td><a href="<?php echo e(route('admin.maintenance-view', ['id' => $maintenance->id])); ?>" class="btn btn-primary">View</a></td>
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
<script>
$(document).ready(function() {
    // Submit the form on status filter change
    $('#statusFilter').on('change', function() {
        $('#filterForm').submit();
    });
});
</script>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\gamev\OneDrive\Desktop\PrimeHub\PrimeHub\resources\views/admin/maintenance-task.blade.php ENDPATH**/ ?>