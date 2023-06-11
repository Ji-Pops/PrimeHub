

<?php $__env->startSection('content'); ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Task Assignment</h1>

    <div class="row">
        <!-- Left half of the form -->
        <div class="col-md-6">
            <!-- Card -->
            <div class="card shadow mb-4 h-100">
                <!-- Card Header -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Task Details</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('admin.maintenanceAssignmentProcess')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="id" value="<?php echo e($maintenance->id); ?>">
                        <div class="form-group">
                            <label for="unit_number">Unit Number</label>
                            <input type="text" name="unit_number" class="form-control" value="<?php echo e($maintenance->unit_number); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="unit_name">Unit Name</label>
                            <input type="text" name="unit_name" class="form-control" value="<?php echo e($maintenance->unit_name); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="request_date_created">Request Date Created</label>
                            <input type="text" name="request_date_created" class="form-control" value="<?php echo e($maintenance->created_at); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="tenant_name">Tenant's Name</label>
                            <input type="text" name="tenant_name" class="form-control" value="<?php echo e($tenant_name); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="tenant_name">Description</label>
                            <input type="text" name="description" class="form-control" value="<?php echo e($maintenance->description); ?>" readonly>
                        </div>
                </div>
            </div>
        </div>
        <!-- Right half of the form -->
        <div class="col-md-6">
            <!-- Card -->
            <div class="card shadow mb-4 h-100">
                <!-- Card Body -->
                <div class="card-body">
                    <div class="form-group">
                        <label for="category">Category</label>
                        <input type="text" name="category" class="form-control" value="<?php echo e($maintenance->category); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="notes">Notes</label>
                        <textarea name="notes" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="maintenance_personnel">Maintenance Personnel</label>
                        <select name="maintenance_personnel" class="form-control">
                            <?php $__currentLoopData = $personnel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $person): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($person->id); ?>"><?php echo e($person->first_name); ?> <?php echo e($person->last_name); ?> - <?php echo e($person->department); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="approved_by">Approved By</label>
                        <?php
                            $approved_by_fullname = session('user_fullname');
                        ?>
                        <input type="text" name="approved_by" class="form-control" value="<?php echo e($approved_by_fullname); ?>" readonly>
                    </div>
                    <div class="card-footer">
                        <a href="<?php echo e(route('admin.maintenance-view', ['id' => $maintenance->id])); ?>" class="btn btn-primary">Back</a>
                        <button type="submit" class="btn btn-success" name="create_order">Assign</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End of Main Content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\gamev\OneDrive\Desktop\PrimeHub\PrimeHub\resources\views/admin/maintenance-assignment.blade.php ENDPATH**/ ?>