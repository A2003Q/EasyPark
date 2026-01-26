<?php $__env->startSection('content'); ?>
<div class="admin-page">
    <div class="page-header">
        <h2 class="admin-title text-center mb-4">Parkings Management</h2>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success text-center mb-4" style="background: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 12px; border-radius: 8px;">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <!-- Add Parking Button -->
    <div class="text-end mb-4">
        <a href="<?php echo e(route('admin.parkings.create')); ?>"
           style="display: inline-block; background: linear-gradient(180deg, #1f1f2e, #3a3a5e); color: white; padding: 8px 16px; border-radius: 8px; text-decoration: none; font-weight: 600; transition: 0.3s; box-shadow: 0 4px 10px rgba(0,0,0,0.2);">
            + Add Parking
        </a>
    </div>

    <!-- Filter Form -->
    <form method="GET" action="<?php echo e(route('admin.parkings.index')); ?>"
          style="background: white; padding: 16px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); margin-bottom: 20px; display: flex; gap: 12px; flex-wrap: wrap; align-items: end;">
        <div>
            <label style="display: block; margin-bottom: 4px; font-size: 0.85rem; color: #555;">City</label>
            <select name="city_id" style="padding: 6px 10px; border: 1px solid #ccc; border-radius: 6px;">
                <option value="">All Cities</option>
                <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($city->id); ?>" <?php echo e(request('city_id') == $city->id ? 'selected' : ''); ?>>
                        <?php echo e($city->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div>
            <label style="display: block; margin-bottom: 4px; font-size: 0.85rem; color: #555;">Status</label>
            <select name="is_active" style="padding: 6px 10px; border: 1px solid #ccc; border-radius: 6px;">
                <option value="">All Status</option>
                <option value="1" <?php echo e(request('is_active') === '1' ? 'selected' : ''); ?>>Active</option>
                <option value="0" <?php echo e(request('is_active') === '0' ? 'selected' : ''); ?>>Inactive</option>
            </select>
        </div>

        <button type="submit"
                style="background: #3a3a5e; color: white; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; font-weight: 600; transition: 0.2s;"
                onmouseover="this.style.backgroundColor='#138496'"
                onmouseout="this.style.backgroundColor='#17a2b8'">
            Filter
        </button>
    </form>

    <!-- Parkings Table -->
    <div class="card shadow-sm p-4" style="background: white; border-radius: 12px; box-shadow: 0 6px 15px rgba(0,0,0,0.1);">
        <table class="table admin-table">
            <thead>
                <tr>
                    <th>Number</th>
                    <th>Name</th>
                    <th>City</th>
                    <th>Total</th>
                    <th>Available</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php $__currentLoopData = $parkings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($loop->iteration + ($parkings->currentPage() - 1) * $parkings->perPage()); ?></td>
                        <td><?php echo e($parking->name); ?></td>
                        <td><?php echo e($parking->city->name); ?></td>
                        <td><?php echo e($parking->total_spots); ?></td>
                        <td><?php echo e($parking->available_spots); ?></td>
                        <td><?php echo e($parking->price_per_hour); ?> JD</td>
                        <td>
                            <span style="background: <?php echo e($parking->is_active ? '#28a745' : '#dc3545'); ?>; color: white; padding: 4px 10px; border-radius: 12px; font-size: 0.85rem;">
                                <?php echo e($parking->is_active ? 'Active' : 'Inactive'); ?>

                            </span>
                        </td>
                        <td>
                            <a href="<?php echo e(route('admin.parkings.edit', $parking)); ?>"
                               style="display: inline-block; background: #3a3a5e; color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 0.85rem; margin-right: 6px; transition: 0.2s;"
                               onmouseover="this.style.backgroundColor='#138496'"
                               onmouseout="this.style.backgroundColor='#17a2b8'">
                                Edit
                            </a>

                            <form method="POST" action="<?php echo e(route('admin.parkings.destroy', $parking)); ?>"
                                  style="display: inline-block;"
                                  onsubmit="return confirm('Delete this parking?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit"
                                        style="background: #771c25; color: white; border: none; padding: 6px 12px; border-radius: 6px; cursor: pointer; font-size: 0.85rem; transition: 0.2s;"
                                        onmouseover="this.style.backgroundColor='#c82333'"
                                        onmouseout="this.style.backgroundColor='#dc3545'">
                                    Delete
                                </button>
                            </form>

                            <!-- ✅ Bootstrap 5 modal trigger -->
                            <button class="btn btn-sm btn-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#spotsModal"
                                    data-parking-id="<?php echo e($parking->id); ?>"
                                    data-parking-name="<?php echo e($parking->name); ?>">
                                Spots
                            </button>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="pagination-wrapper mt-4">
        <?php echo e($parkings->onEachSide(1)->links('pagination::simple-tailwind')); ?>

    </div>
</div>

<!-- ✅ Bootstrap 5 Modal -->
<div class="modal fade" id="spotsModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Manage Spots - <span id="spotsParkingName"></span></h5>

        <!-- ✅ Bootstrap 5 close -->
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">

        
        <form id="addSpotForm" method="POST" action="<?php echo e(route('admin.spots.store')); ?>" class="row mb-3">
          <?php echo csrf_field(); ?>
          <input type="hidden" name="parking_id" id="spotsParkingId">

          <div class="col-md-4 mb-2">
            <input type="number" name="spot_number" class="form-control" placeholder="Spot number" required min="1">
          </div>

          <div class="col-md-4 mb-2">
            <select name="status" class="form-control" required>
              <option value="available">available</option>
              <option value="reserved">reserved</option>
            </select>
          </div>

          <div class="col-md-4 mb-2">
            <button type="submit" class="btn btn-success w-100">Add Spot</button>
          </div>
        </form>

        
        <div class="table-responsive">
          <table class="table table-sm align-middle">
            <thead>
              <tr>
                <th>Spot #</th>
                <th>Status</th>
                <th style="width:220px;">Actions</th>
              </tr>
            </thead>
            <tbody id="spotsTableBody">
              <tr><td colspan="3" class="text-center text-muted">No spots yet</td></tr>
            </tbody>
          </table>
        </div>

      </div>

    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const modalEl = document.getElementById('spotsModal');
  const spotsBody = document.getElementById('spotsTableBody');
  const parkingIdInput = document.getElementById('spotsParkingId');
  const parkingNameSpan = document.getElementById('spotsParkingName');
  const addForm = document.getElementById('addSpotForm');

  const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  let currentParkingId = null;

  async function loadSpots(parkingId){
    spotsBody.innerHTML = `<tr><td colspan="3" class="text-center text-muted">Loading...</td></tr>`;

    try {
      const res = await fetch(`/admin/parkings/${parkingId}/spots`, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      });

      if(!res.ok){
        spotsBody.innerHTML = `<tr><td colspan="3" class="text-center text-danger">Failed to load spots</td></tr>`;
        return;
      }

      const spots = await res.json();

      if(!spots.length){
        spotsBody.innerHTML = `<tr><td colspan="3" class="text-center text-muted">No spots yet</td></tr>`;
        return;
      }

      spotsBody.innerHTML = spots.map(s => `
        <tr data-id="${s.id}">
          <td>
            <input type="number" class="form-control form-control-sm spot_number" value="${s.spot_number}" min="1">
          </td>
          <td>
            <select class="form-control form-control-sm status">
              <option value="available" ${s.status === 'available' ? 'selected' : ''}>available</option>
              <option value="reserved" ${s.status === 'reserved' ? 'selected' : ''}>reserved</option>
            </select>
          </td>
          <td>
            <button type="button" class="btn btn-sm btn-primary spot-save">Save</button>
            <button type="button" class="btn btn-sm btn-danger spot-del">Delete</button>
          </td>
        </tr>
      `).join('');
    } catch (err) {
      console.error(err);
      spotsBody.innerHTML = `<tr><td colspan="3" class="text-center text-danger">Failed to load spots</td></tr>`;
    }
  }

  // Bootstrap 5 modal open event
  modalEl.addEventListener('show.bs.modal', (e) => {
    const btn = e.relatedTarget;
    currentParkingId = btn.getAttribute('data-parking-id');

    parkingIdInput.value = currentParkingId;
    parkingNameSpan.textContent = btn.getAttribute('data-parking-name');

    loadSpots(currentParkingId);
  });

  // Add spot (AJAX)
  addForm.addEventListener('submit', async (e) => {
    e.preventDefault();

    const formData = new FormData(addForm);

    const res = await fetch(addForm.action, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': token,
        'X-Requested-With': 'XMLHttpRequest'
      },
      body: formData
    });

    if(!res.ok){
      console.error(await res.text());
      alert('Error adding spot (check console)');
      return;
    }

    addForm.querySelector('input[name="spot_number"]').value = '';
    loadSpots(currentParkingId);
  });

  // Save/Delete (event delegation)
  spotsBody.addEventListener('click', async (e) => {
    const tr = e.target.closest('tr');
    if(!tr) return;

    const id = tr.getAttribute('data-id');

    // Save
    if(e.target.classList.contains('spot-save')){
      const spot_number = tr.querySelector('.spot_number').value;
      const status = tr.querySelector('.status').value;

    const fd = new FormData();
fd.append('spot_number', spot_number);
fd.append('status', status);

const res = await fetch(`/admin/spots/${id}`, {
  method: 'POST',
  headers: {
    'X-CSRF-TOKEN': token,
    'X-Requested-With': 'XMLHttpRequest'
  },
  body: (function(){
    // Laravel method spoofing
    fd.append('_method', 'PATCH');
    return fd;
  })()
});


      if(!res.ok){
        console.error(await res.text());
        alert('Error saving spot (check console)');
        return;
      }

      loadSpots(currentParkingId);
    }

    // Delete
    if(e.target.classList.contains('spot-del')){
      if(!confirm('Delete this spot?')) return;

     const fd = new FormData();
fd.append('_method', 'DELETE');

const res = await fetch(`/admin/spots/${id}`, {
  method: 'POST',
  headers: {
    'X-CSRF-TOKEN': token,
    'X-Requested-With': 'XMLHttpRequest'
  },
  body: fd
});


      if(!res.ok){
        console.error(await res.text());
        alert('Error deleting spot (check console)');
        return;
      }

      loadSpots(currentParkingId);
    }
  });
});
</script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\DELL\Downloads\Parking-Finder2-stage4-auth-flow\resources\views/admin/parkings/index.blade.php ENDPATH**/ ?>