

<?php $__env->startSection('content'); ?>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Tenant</h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Personal Information</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('admin.addTenant')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" pattern="[A-Za-z]{2,}" title="Must be at least 2 characters long. Must only contain letters." required>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" pattern="[A-Za-z]{2,}" title="Must be at least 2 characters long. Must only contain letters." required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" pattern="^[A-Za-z0-9.]+@(gmail\.com|yahoo\.com|outlook\.com|aol\.com)$" title="GMail, Yahoo! Mail, AOL, Outlook" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="tel" class="form-control" id="phone" name="phone" pattern="09\d{9}" title="Must be a valid Philippine phone number starting with (09) followed by 9 numeric numbers." required>
                        </div>
                        <div class="form-group">
                            <label for="profile_picture">Profile Picture</label>
                            <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept=".jpg, .jpeg, .png" 
                                onchange="validateProfilePicture(this)" required>
                            <small class="text-muted">Please note that only JPG (.jpg/.jpeg), PNG (.png), and GIF (.gif) formats are accepted. Maximum file size: 5MB.</small>
                            <div class="invalid-feedback">
                                Please choose a profile picture in JPG, JPEG, or PNG format, with a maximum file size of 5MB.
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Tenant</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\gamev\OneDrive\Desktop\PrimeHub\PrimeHub\resources\views/admin/add-tenant.blade.php ENDPATH**/ ?>