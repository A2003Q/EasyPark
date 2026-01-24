@extends('admin.layout')

@section('content')
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
                @foreach($reservations as $reservation)
                    <tr>
                        <td>
                            {{ $loop->iteration + ($reservations->currentPage() - 1) * $reservations->perPage() }}
                        </td>
                        <td>
                            {{ $reservation->user->name ?? 'N/A' }}
                        </td>
                        <td>
                            {{ $reservation->parking->name ?? 'N/A' }}
                        </td>
                        <td>
                            @php
                                $status = $reservation->status;
                                $bgColor = match(strtolower($status)) {
                                    'confirmed' => '#28a745',
                                    'pending' => '#ffc107',
                                    'cancelled', 'rejected' => '#dc3545',
                                    default => '#6c757d',
                                };
                            @endphp
                            <span style="background: {{ $bgColor }}; color: white; padding: 4px 10px; border-radius: 12px; font-size: 0.85rem; display: inline-block;">
                                {{ ucfirst($status) }}
                            </span>
                        </td>
                        <td>{{ $reservation->start_time }}</td>
                        <td>{{ $reservation->end_time }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="pagination-wrapper mt-4">
        {{ $reservations->onEachSide(1)->links('pagination::simple-tailwind') }}
    </div>
</div>
@endsection
