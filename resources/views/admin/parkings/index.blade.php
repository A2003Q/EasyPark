@extends('admin.layout')

@section('content')
<div class="admin-page">
    <div class="page-header">
        <h2 class="admin-title text-center mb-4">Parkings Management</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success text-center mb-4" style="background: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 12px; border-radius: 8px;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Add Parking Button -->
    <div class="text-end mb-4">
        <a href="{{ route('admin.parkings.create') }}" 
           style="display: inline-block; background: linear-gradient(180deg, #1f1f2e, #3a3a5e); color: white; padding: 8px 16px; border-radius: 8px; text-decoration: none; font-weight: 600; transition: 0.3s; box-shadow: 0 4px 10px rgba(0,0,0,0.2);">
            + Add Parking
        </a>
    </div>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('admin.parkings.index') }}" 
          style="background: white; padding: 16px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); margin-bottom: 20px; display: flex; gap: 12px; flex-wrap: wrap; align-items: end;">
        <div>
            <label style="display: block; margin-bottom: 4px; font-size: 0.85rem; color: #555;">City</label>
            <select name="city_id" style="padding: 6px 10px; border: 1px solid #ccc; border-radius: 6px;">
                <option value="">All Cities</option>
                @foreach($cities as $city)
                    <option value="{{ $city->id }}" {{ request('city_id') == $city->id ? 'selected' : '' }}>
                        {{ $city->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label style="display: block; margin-bottom: 4px; font-size: 0.85rem; color: #555;">Status</label>
            <select name="is_active" style="padding: 6px 10px; border: 1px solid #ccc; border-radius: 6px;">
                <option value="">All Status</option>
                <option value="1" {{ request('is_active') === '1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ request('is_active') === '0' ? 'selected' : '' }}>Inactive</option>
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
                @foreach($parkings as $parking)
                    <tr>
                        <td>
                            {{ $loop->iteration + ($parkings->currentPage() - 1) * $parkings->perPage() }}
                        </td>
                        <td>{{ $parking->name }}</td>
                        <td>{{ $parking->city->name }}</td>
                        <td>{{ $parking->total_spots }}</td>
                        <td>{{ $parking->available_spots }}</td>
                        <td>{{ $parking->price_per_hour }} JD</td>
                        <td>
                            <span style="background: {{ $parking->is_active ? '#28a745' : '#dc3545' }}; color: white; padding: 4px 10px; border-radius: 12px; font-size: 0.85rem;">
                                {{ $parking->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.parkings.edit', $parking) }}"
                               style="display: inline-block; background: #3a3a5e; color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 0.85rem; margin-right: 6px; transition: 0.2s;"
                               onmouseover="this.style.backgroundColor='#138496'"
                               onmouseout="this.style.backgroundColor='#17a2b8'">
                                Edit
                            </a>

                            <form method="POST" action="{{ route('admin.parkings.destroy', $parking) }}" 
                                  style="display: inline-block;" 
                                  onsubmit="return confirm('Delete this parking?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        style="background: #771c25; color: white; border: none; padding: 6px 12px; border-radius: 6px; cursor: pointer; font-size: 0.85rem; transition: 0.2s;"
                                        onmouseover="this.style.backgroundColor='#c82333'"
                                        onmouseout="this.style.backgroundColor='#dc3545'">
                                    Delete
                                </button>
                            </form>
                             <button class="btn btn-sm btn-primary"
                             data-bs-toggle="modal"
                             data-bs-target="#spotsModal"
                             data-parking-id="{{ $parking->id }}"
                             data-parking-name="{{ $parking->name }}">
                             Spots
                            </button>
                        </td>
                       
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="pagination-wrapper mt-4">
        {{ $parkings->onEachSide(1)->links('pagination::simple-tailwind') }}
    </div>
</div>
<div class="modal fade" id="spotsModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Manage Spots - <span id="spotsParkingName"></span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        {{-- Add Spot --}}
        <form method="POST" action="{{ route('admin.spots.store') }}" class="row g-2 mb-3">
          @csrf
          <input type="hidden" name="parking_id" id="spotsParkingId">

          <div class="col-md-4">
            <input type="number" name="spot_number" class="form-control" placeholder="Spot number" required>
          </div>

          <div class="col-md-4">
            <select name="status" class="form-select" required>
              <option value="available">available</option>
              <option value="reserved">reserved</option>
            </select>
          </div>

          <div class="col-md-4 d-grid">
            <button class="btn btn-success">Add Spot</button>
          </div>
        </form>

    
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
  const modal = document.getElementById('spotsModal');
  modal.addEventListener('show.bs.modal', function(e){
    const btn = e.relatedTarget;
    document.getElementById('spotsParkingId').value = btn.getAttribute('data-parking-id');
    document.getElementById('spotsParkingName').textContent = btn.getAttribute('data-parking-name');
  });
});
</script>

@endsection
