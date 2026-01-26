<?php $__env->startSection('content'); ?>
<div class="admin-page">
    <div class="page-header">
        <h2 class="admin-title text-center mb-4">Cities Management</h2>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success text-center mb-4" style="background: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 12px; border-radius: 8px;">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <!-- Add New City Button -->
    <div class="text-end mb-4">
        <a href="<?php echo e(route('admin.cities.create')); ?>" 
           style="display: inline-block; background: linear-gradient(180deg, #1f1f2e, #3a3a5e); color: white; padding: 8px 16px; border-radius: 8px; text-decoration: none; font-weight: 600; transition: 0.3s; box-shadow: 0 4px 10px rgba(0,0,0,0.2);">
            + Add New City
        </a>
    </div>

    <!-- Cities Table -->
    <div class="card shadow-sm p-4" style="background: white; border-radius: 12px; box-shadow: 0 6px 15px rgba(0,0,0,0.1);">
        <table class="table admin-table">
            <thead >
                <tr>
                    <th>Number</th>
                    <th>City Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <?php echo e($loop->iteration + ($cities->currentPage() - 1) * $cities->perPage()); ?>

                        </td>
                        <td >
                            <?php echo e($city->name); ?>

                        </td>
                        <td>
                            <!-- Edit Button -->
                            <a href="<?php echo e(route('admin.cities.edit', $city)); ?>"
                               style="display: inline-block; background: #3a3a5e; color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 0.85rem; margin-right: 6px; transition: 0.2s;"
                               onmouseover="this.style.backgroundColor='#138496'"
                               onmouseout="this.style.backgroundColor='#17a2b8'">
                                Edit
                            </a>

                            <!-- Delete Form -->
                            <form method="POST" action="<?php echo e(route('admin.cities.destroy', $city)); ?>" 
                                  style="display: inline-block;" 
                                  onsubmit="return confirm('Are you sure you want to delete this city?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit"
                                        style="background: #771c25; color: white; border: none; padding: 6px 12px; border-radius: 6px; cursor: pointer; font-size: 0.85rem; transition: 0.2s;"
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
    <div class="pagination-wrapper mt-4">
        <?php echo e($cities->onEachSide(1)->links('pagination::simple-tailwind')); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\DELL\Downloads\Parking-Finder2-stage4-auth-flow\resources\views/admin/cities/index.blade.php ENDPATH**/ ?>