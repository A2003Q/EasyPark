<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <h3 class="admin-title text-center mb-4">Users Management</h3>

    <?php if(session('success')): ?>
        <div class="alert alert-success text-center mb-4" style="background: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 12px; border-radius: 8px;">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="card shadow-sm p-4 mb-4">
        <table class="table admin-table">
            <thead>
                <tr>
                    <th>Number</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($loop->iteration + ($users->currentPage() - 1) * $users->perPage()); ?></td>
                        <td><?php echo e($user->name); ?></td>
                        <td><?php echo e($user->email); ?></td>
                        <td>
                            <span style="background: #3a3a5e; color: white; padding: 4px 10px; border-radius: 12px; font-size: 0.85rem;">
                                <?php echo e(ucfirst($user->role)); ?>

                            </span>
                        </td>
                        <td>
                            <form method="POST" action="<?php echo e(route('admin.users.destroy', $user)); ?>" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit"
                                        style="background:  #771c25; color: white; border: none; padding: 6px 12px; border-radius: 6px; cursor: pointer; font-size: 0.85rem; transition: 0.2s;"
                                        onmouseover="this.style.backgroundColor='#c82333'"
                                        onmouseout="this.style.backgroundColor='#dc3545'">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="pagination-wrapper d-flex justify-content-center mt-4">
        <?php echo e($users->onEachSide(1)->links('pagination::simple-tailwind')); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\DELL\Downloads\Parking-Finder2-stage4-auth-flow\resources\views/admin/users/index.blade.php ENDPATH**/ ?>