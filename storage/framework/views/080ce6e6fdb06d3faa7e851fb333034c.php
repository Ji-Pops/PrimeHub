

<?php $__env->startSection('content'); ?>
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Track Request</h1>
<!-- Card -->
<div class="card shadow mb-4">
    <!-- Card Header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Maintenance Request</h6>
    </div>
    <!-- Card Body -->
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <img src="<?php echo e(asset('storage/maintenance_request_photo/' . $maintenance->photo)); ?>" class="img-fluid" alt="Maintenance Photo">
            </div>
            <div class="col-md-6">
                <h4 class="font-weight-bold"><?php echo e($maintenance->unit_name); ?></h4>
                <p><strong>Category:</strong> <?php echo e($maintenance->category); ?></p>
                <p><strong>Description:</strong></p>
                <p><?php echo e($maintenance->description); ?></p>
                <p><strong>Created:</strong> <?php echo e($maintenance->created_at); ?></p>
                <p><strong>Status:</strong> <?php echo e($maintenance->status); ?></p>
                <p><strong>Updated:</strong> <?php echo e($maintenance->updated_at); ?></p>
                <p><strong>Personnel:</strong> <?php echo e($personnel); ?></p>
                <p><strong>Remarks:</strong> <?php echo e($maintenance->remarks); ?></p>
                <p><strong>Feedback:</strong> <?php echo e($maintenance->feedback); ?></p>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <a href="<?php echo e(route('tenant.view-maintenance')); ?>" class="btn btn-primary">Back</a>
                <?php if($maintenance->status === 'Completed' && empty($maintenance->feedback)): ?>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#feedbackModal">Feedback</button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Acknowledge Modal -->
<div class="modal fade" id="feedbackModal" tabindex="-1" role="dialog" aria-labelledby="feedbackModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="feedbackModalLabel">Feedback</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>I acknowledge that I have made a maintenance request for my unit. I am aware that the maintenance personnel have fixed it and that my unit is now in good condition.</p>
                <form method="POST" action="<?php echo e(route('tenant.feedback', ['id' => $maintenance->id])); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="feedback">Feedback</label>
                        <textarea class="form-control" id="feedback" name="feedback" rows="3"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End of Acknowledge Modal -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.appTenant', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\gamev\OneDrive\Desktop\PrimeHub\PrimeHub\resources\views/tenant/track-maintenance.blade.php ENDPATH**/ ?>