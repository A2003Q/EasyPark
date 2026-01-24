@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <h3 class="admin-title text-center mb-4">Users Management</h3>

    @if(session('success'))
        <div class="alert alert-success text-center mb-4" style="background: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 12px; border-radius: 8px;">
            {{ session('success') }}
        </div>
    @endif

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
                @foreach($users as $user)
                    <tr>
                        <td>{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span style="background: #3a3a5e; color: white; padding: 4px 10px; border-radius: 12px; font-size: 0.85rem;">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        style="background:  #771c25; color: white; border: none; padding: 6px 12px; border-radius: 6px; cursor: pointer; font-size: 0.85rem; transition: 0.2s;"
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
    <div class="pagination-wrapper d-flex justify-content-center mt-4">
        {{ $users->onEachSide(1)->links('pagination::simple-tailwind') }}
    </div>
</div>
@endsection