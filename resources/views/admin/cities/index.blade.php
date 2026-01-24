@extends('admin.layout')

@section('content')
<div class="admin-page">
    <div class="page-header">
        <h2 class="admin-title text-center mb-4">Cities Management</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success text-center mb-4" style="background: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 12px; border-radius: 8px;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Add New City Button -->
    <div class="text-end mb-4">
        <a href="{{ route('admin.cities.create') }}" 
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
                @foreach($cities as $city)
                    <tr>
                        <td>
                            {{ $loop->iteration + ($cities->currentPage() - 1) * $cities->perPage() }}
                        </td>
                        <td >
                            {{ $city->name }}
                        </td>
                        <td>
                            <!-- Edit Button -->
                            <a href="{{ route('admin.cities.edit', $city) }}"
                               style="display: inline-block; background: #3a3a5e; color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 0.85rem; margin-right: 6px; transition: 0.2s;"
                               onmouseover="this.style.backgroundColor='#138496'"
                               onmouseout="this.style.backgroundColor='#17a2b8'">
                                Edit
                            </a>

                            <!-- Delete Form -->
                            <form method="POST" action="{{ route('admin.cities.destroy', $city) }}" 
                                  style="display: inline-block;" 
                                  onsubmit="return confirm('Are you sure you want to delete this city?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        style="background: #771c25; color: white; border: none; padding: 6px 12px; border-radius: 6px; cursor: pointer; font-size: 0.85rem; transition: 0.2s;"
                                        onmouseover="this.style.backgroundColor='#c82333'"
                                        onmouseout="this.style.backgroundColor='#dc3545'">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="pagination-wrapper mt-4">
        {{ $cities->onEachSide(1)->links('pagination::simple-tailwind') }}
    </div>
</div>
@endsection

