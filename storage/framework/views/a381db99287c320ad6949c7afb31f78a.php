

<?php $__env->startSection('content'); ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Maintenance Status</h1>

    <!-- Card -->
    <div class="card shadow mb-4">
        <!-- Card Header -->
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Maintenance Request</h6>
        </div>
        <?php if(session('assignment_success_message')): ?>
            <div class="alert alert-success">
                <?php echo e(session('assignment_success_message')); ?>

            </div>
        <?php endif; ?>

        <!-- Card Body -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <img src="<?php echo e(asset('storage/' . $maintenance->maintenance_photo_path)); ?>" class="img-fluid" alt="Maintenance Photo">
                </div>
                <div class="col-md-6">
                    <h4 class="font-weight-bold"><?php echo e($maintenance->unit_name); ?></h4>
                    <p><strong>Category:</strong> <?php echo e($maintenance->category); ?></p>
                    <p><strong>Description:</strong></p>
                    <p><?php echo e($maintenance->description); ?></p>
                    <p><strong>Created:</strong> <?php echo e($maintenance->created_at); ?></p>
                    <p><strong>Status:</strong> <?php echo e($maintenance->status); ?></p>
                    <p><strong>Updated:</strong> <?php echo e($maintenance->updated_at); ?></p>
                    
                    <?php if(!empty($personnel)): ?>
                        <p><strong>Personnel:</strong> <?php echo e($personnel); ?></p>
                    <?php endif; ?>
                    
                    <?php if(!empty($maintenance->remarks)): ?>
                        <p><strong>Remarks:</strong> <?php echo e($maintenance->remarks); ?></p>
                    <?php endif; ?>
                    
                    <?php if(!empty($maintenance->feedback)): ?>
                        <p><strong>Feedback:</strong> <?php echo e($maintenance->feedback); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12">
                    <a href="<?php echo e(url('admin/maintenance-task')); ?>" class="btn btn-primary">Back</a>
                    
                    <?php if($maintenance->status === 'Open'): ?>
                        <a href="<?php echo e(route('admin.maintenance-assignment', ['id' => $maintenance->id])); ?>" class="btn btn-success">Assign Task</a>
                    <?php elseif($maintenance->status === 'cancelled'): ?>
                        <a href="view_order.php?id=<?php echo e($maintenance->id); ?>" class="btn btn-success">Work Order</a>
                    <?php elseif($maintenance->status === 'Completed' && $maintenance->acknowledge === 1): ?>
                        <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#updateModal">Close Request</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Are you sure you want to close the maintenance request?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="<?php echo e(route('admin.closeRequest', ['maintenance' => $maintenance->id])); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Modal -->
<?php $__env->stopSection(); ?>

<script>
    setTimeout(function() {
        $('.alert-success').hide();
    }, 2000);
</script>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\gamev\OneDrive\Desktop\PrimeHub\PrimeHub\resources\views/admin/maintenance-view.blade.php ENDPATH**/ ?>