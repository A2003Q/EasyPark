<?php $__env->startSection('content'); ?>
<div class="admin-page">
    <div class="page-header">
        <h2 class="admin-title text-center mb-4">Reservations Management</h2>
    </div>

    <div class="card shadow-sm p-4" style="background: white; border-radius: 12px; box-shadow: 0 6px 15px rgba(0,0,0,0.1);">
        <table class="table admin-table">
            <thead>
                <tr>
                    <th>Number</th>
                    <th>User</th>
                    <th>Parking</th>
                    <th>Status</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $reservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reservation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <?php echo e($loop->iteration + ($reservations->currentPage() - 1) * $reservations->perPage()); ?>

                        </td>
                        <td>
                            <?php echo e($reservation->user->name ?? 'N/A'); ?>

                        </td>
                        <td>
                            <?php echo e($reservation->parking->name ?? 'N/A'); ?>

                        </td>
                        <td>
                            <?php
                                $status = $reservation->status;
                                $bgColor = match(strtolower($status)) {
                                    'confirmed' => '#28a745',
                                    'pending' => '#ffc107',
                                    'cancelled', 'rejected' => '#dc3545',
                                    default => '#6c757d',
                                };
                            ?>
                            <span style="background: <?php echo e($bgColor); ?>; color: white; padding: 4px 10px; border-radius: 12px; font-size: 0.85rem; display: inline-block;">
                                <?php echo e(ucfirst($status)); ?>

                            </span>
                        </td>
                        <td><?php echo e($reservation->start_time); ?></td>
                        <td><?php echo e($reservation->end_time); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="pagination-wrapper mt-4">
        <?php echo e($reservations->onEachSide(1)->links('pagination::simple-tailwind')); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\DELL\Downloads\Parking-Finder2-stage4-auth-flow\resources\views/admin/reservations/index.blade.php ENDPATH**/ ?>