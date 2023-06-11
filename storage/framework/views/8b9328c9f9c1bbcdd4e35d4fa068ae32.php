

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
            <form method="POST" action="<?php echo e(route('personnel.acceptTask', ['id' => $maintenance->id])); ?>" enctype="multipart/form-data">
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
                    <label for="assessment">Assessment</label>
                    <textarea name="assessment" class="form-control" required><?php echo e(old('assessment')); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category" class="form-control">
                        <option value="Electrical - Power Outage">Electrical - Power Outage</option>
                        <option value="Electrical - Faulty Wiring">Electrical - Faulty Wiring</option>
                        <option value="Electrical - Tripping Circuit Breaker">Electrical - Tripping Circuit Breaker</option>
                        <option value="Electrical - Dim or Flickering Lights">Electrical - Dim or Flickering Lights</option>
                        <option value="Plumbing - Leaking Faucet">Plumbing - Leaking Faucet</option>
                        <option value="Plumbing - Clogged Drain">Plumbing - Clogged Drain</option>
                        <option value="Plumbing - Burst Pipe">Plumbing - Burst Pipe</option>
                        <option value="Plumbing - Low Water Pressure">Plumbing - Low Water Pressure</option>
                        <option value="Air-conditioning - Air Conditioner Not Cooling">Air-conditioning - Air Conditioner Not Cooling</option>
                        <option value="Air-conditioning - Strange Noises from the AC Unit">Air-conditioning - Strange Noises from the AC Unit</option>
                        <option value="Air-conditioning - AC Unit Leaking Water">Air-conditioning - AC Unit Leaking Water</option>
                        <option value="Air-conditioning - AC Unit Not Turning On">Air-conditioning - AC Unit Not Turning On</option>
                        <option value="Structural - Cracked Walls or Ceilings">Structural - Cracked Walls or Ceilings</option>
                        <option value="Structural - Foundation Issues">Structural - Foundation Issues</option>
                        <option value="Structural - Damaged Windows or Doors">Structural - Damaged Windows or Doors</option>
                        <option value="Structural - Flooring Problems">Structural - Flooring Problems</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="category_details">Specify</label>
                    <input type="text" name="category_details" class="form-control">
                </div>
            </div>
            <div class="card-footer">
                <a href="<?php echo e(route('personnel.task-view')); ?>" class="btn btn-primary">Back</a>
                <button type="submit" class="btn btn-success" name="accept_task">Accept</button>
            </div>
        </div>
    </div>
</div>
</form> <!-- Closing tag for the form -->
<!-- End of Main Content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.appTenant', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\gamev\OneDrive\Desktop\PrimeHub\PrimeHub\resources\views/personnel/assess-maintenance.blade.php ENDPATH**/ ?>