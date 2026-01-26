<?php $__env->startSection('content'); ?>
<div class="admin-page">
    <div class="page-header">
        <h2 class="text-center mb-4">Edit Parking</h2>
    </div>

    <div class="card admin-card" style="max-width: 600px; margin: 0 auto; background: white; border-radius: 12px; box-shadow: 0 6px 15px rgba(0,0,0,0.1); padding: 30px;">
        <form method="POST" action="<?php echo e(route('admin.parkings.update', $parking)); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="form-group mb-4">
                <label for="city_id" style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">City</label>
                <select name="city_id" id="city_id" required
                        style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem;">
                    <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($city->id); ?>" <?php echo e($parking->city_id == $city->id ? 'selected' : ''); ?>>
                            <?php echo e($city->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="form-group mb-4">
                <label for="name" style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Name</label>
                <input type="text" id="name" name="name" value="<?php echo e(old('name', $parking->name)); ?>" required
                       style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem;">
            </div>

            <div class="form-group mb-4">
                <label for="address" style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Address</label>
                <input type="text" id="address" name="address" value="<?php echo e(old('address', $parking->address)); ?>" required
                       style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem;">
            </div>

            <div class="form-group mb-4">
                <label for="latitude" style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Latitude</label>
                <input type="text" id="latitude" name="latitude" value="<?php echo e(old('latitude', $parking->latitude)); ?>" required
                       style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem;">
            </div>

            <div class="form-group mb-4">
                <label for="longitude" style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Longitude</label>
                <input type="text" id="longitude" name="longitude" value="<?php echo e(old('longitude', $parking->longitude)); ?>" required
                       style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem;">
            </div>

            <div class="form-group mb-4">
                <label for="total_spots" style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Total Spots</label>
                <input type="number" id="total_spots" name="total_spots" value="<?php echo e(old('total_spots', $parking->total_spots)); ?>" min="1" required
                       style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem;">
            </div>

            <div class="form-group mb-4">
                <label for="available_spots" style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Available Spots</label>
                <input type="number" id="available_spots" name="available_spots" value="<?php echo e(old('available_spots', $parking->available_spots)); ?>" min="0" required
                       style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem;">
            </div>

            <div class="form-group mb-4">
                <label for="price_per_hour" style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Price / Hour (JD)</label>
                <input type="number" id="price_per_hour" name="price_per_hour" value="<?php echo e(old('price_per_hour', $parking->price_per_hour)); ?>" step="0.01" min="0" required
                       style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem;">
            </div>

            <div class="form-group mb-4">
                <label style="display: flex; align-items: center; font-weight: 600; color: #333;">
                    <input type="checkbox" name="is_active" <?php echo e(old('is_active', $parking->is_active) ? 'checked' : ''); ?>

                           style="margin-right: 10px; width: 18px; height: 18px;">
                    Active
                </label>
            </div>

            <div class="form-actions text-end">
                <button type="submit" 
                        style="background: linear-gradient(180deg, #1f1f2e, #3a3a5e); color: white; border: none; padding: 10px 24px; border-radius: 8px; font-weight: 600; cursor: pointer; transition: 0.3s; box-shadow: 0 4px 10px rgba(0,0,0,0.2);">
                    Update Parking
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\DELL\Downloads\Parking-Finder2-stage4-auth-flow\resources\views/admin/parkings/edit.blade.php ENDPATH**/ ?>