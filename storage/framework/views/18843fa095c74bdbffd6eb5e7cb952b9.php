

<?php $__env->startSection('content'); ?>
<link href="<?php echo e(asset('css/unitStyle.css')); ?>" rel="stylesheet">
<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Units</h1>
    </div>

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

    <div class="row">
        <!-- Table Card -->
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Units</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Unit Number</th>
                                    <th>Unit Name</th>
                                    <th>Contacts Tenant ID</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($unit->unit_number); ?></td>
                                    <td><?php echo e($unit->unit_name); ?></td>
                                    <td><?php echo e($unit->contacts_tenant_id); ?></td>
                                    <td>
                                        <form action="<?php echo e(route('admin.deleteUnit', ['unit' => $unit->id])); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end mt-3">
                <?php echo e($units->links(('pagination::bootstrap-5'))); ?>

            </div>
        </div>

        <!-- Form Card -->
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Add Unit</h6>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('admin.addUnit')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label for="unit_number">Unit Number</label>
                            <input type="text" class="form-control" id="unit_number" name="unit_number" required>
                        </div>
                        <div class="form-group">
                            <label for="unit_name">Unit Name</label>
                            <input type="text" class="form-control" id="unit_name" name="unit_name">
                        </div>
                        <div class="form-group">
                            <label for="contacts_tenant_id">Tenant</label>
                            <select class="form-control" id="contacts_tenant_id" name="contacts_tenant_id">
                                <option value="" selected>Select Tenant</option>
                                <?php $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($contact->user_type === 'tenant'): ?>
                                        <option value="<?php echo e($contact->id); ?>">
                                            <?php echo e($contact->first_name); ?> <?php echo e($contact->last_name); ?>

                                        </option>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Unit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<script>
    setTimeout(function() {
    $('.alert-success').hide();
    }, 2000);
</script>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\gamev\OneDrive\Desktop\PrimeHub\PrimeHub\resources\views/admin/unit-management.blade.php ENDPATH**/ ?>