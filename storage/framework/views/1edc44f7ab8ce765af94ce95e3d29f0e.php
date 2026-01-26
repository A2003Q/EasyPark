<?php $__env->startSection('content'); ?>
<div class="admin-page">
    <!-- Page Header -->
    <div class="page-header">
        <h2 class="admin-title text-center mb-4">Subscriptions Management</h2>
    </div>

    <!-- Subscriptions Card -->
    <div class="card shadow-sm p-4"
         style="background: white;
                border-radius: 12px;
                box-shadow: 0 6px 15px rgba(0,0,0,0.1);">

        <table class="table admin-table">
            <thead>
                <tr>
                    <th>Number</th>
                    <th>User</th>
                    <th>Status</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                </tr>
            </thead>

            <tbody>
                <?php $__currentLoopData = $subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <?php echo e($loop->iteration + ($subscriptions->currentPage()-1) * $subscriptions->perPage()); ?>

                        </td>

                        <td>
                            <?php echo e($subscription->user->name ?? 'N/A'); ?>

                        </td>

                        <td>
                            <?php
                                $status = strtolower($subscription->status);
                                $bgColor = match($status) {
                                    'active' => '#28a745',
                                    'expired' => '#dc3545',
                                    'pending' => '#ffc107',
                                    default => '#6c757d',
                                };
                            ?>

                            <span style="
                                background: <?php echo e($bgColor); ?>;
                                color: white;
                                padding: 5px 14px;
                                border-radius: 14px;
                                font-size: 0.85rem;
                                font-weight: 600;
                                display: inline-block;
                            ">
                                <?php echo e(ucfirst($subscription->status)); ?>

                            </span>
                        </td>

                        <td>
                            <?php echo e($subscription->start_date); ?>

                        </td>

                        <td>
                            <?php echo e($subscription->end_date); ?>

                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="pagination-wrapper mt-4">
        <?php echo e($subscriptions->onEachSide(1)->links('pagination::simple-tailwind')); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\DELL\Downloads\Parking-Finder2-stage4-auth-flow\resources\views/admin/subscriptions/index.blade.php ENDPATH**/ ?>