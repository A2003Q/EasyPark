<?php $__env->startSection('content'); ?>
<div class="admin-page">
    <!-- Page Header -->
    <div class="page-header">
        <h2 class="admin-title text-center mb-4">Revenue Management</h2>
    </div>

    <!-- Revenue Card -->
    <div class="card shadow-sm p-4"
         style="background: white;
                border-radius: 12px;
                box-shadow: 0 6px 15px rgba(0,0,0,0.1);">

        <table class="table admin-table">
            <thead >
                <tr>
                    <th>Number</th>
                    <th>User</th>
                    <th>Source</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
            </thead>

            <tbody>
                <?php $__currentLoopData = $revenues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $revenue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr >
                        <td >
                            <?php echo e($loop->iteration + ($revenues->currentPage() - 1) * $revenues->perPage()); ?>

                        </td>

                        <td >
                          <?php echo e($revenue->reservation->user->name ?? 'N/A'); ?>


                        </td>
                         <td>
    <span class="badge bg-secondary">
        <?php echo e(ucfirst($revenue->source)); ?>

    </span>
</td>
                        <td >
                            <span style="
                                background: linear-gradient(135deg, #3a3a5e, #2f2f4f);
                                color: white;
                                padding: 6px 14px;
                                border-radius: 20px;
                                font-size: 0.85rem;
                                font-weight: 600;
                                display: inline-block;
                            ">
                                <?php echo e($revenue->amount); ?> JD
                            </span>
                        </td>

                        <td>
                            <?php echo e($revenue->created_at->format('Y-m-d H:i')); ?>

                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="pagination-wrapper mt-4">
        <?php echo e($revenues->onEachSide(1)->links('pagination::simple-tailwind')); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\DELL\Downloads\Parking-Finder2-stage4-auth-flow\resources\views/admin/revenue/index.blade.php ENDPATH**/ ?>