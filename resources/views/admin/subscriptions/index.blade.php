@extends('admin.layout')

@section('content')
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
                @foreach($subscriptions as $subscription)
                    <tr>
                        <td>
                            {{ $loop->iteration + ($subscriptions->currentPage()-1) * $subscriptions->perPage() }}
                        </td>

                        <td>
                            {{ $subscription->user->name ?? 'N/A' }}
                        </td>

                        <td>
                            @php
                                $status = strtolower($subscription->status);
                                $bgColor = match($status) {
                                    'active' => '#28a745',
                                    'expired' => '#dc3545',
                                    'pending' => '#ffc107',
                                    default => '#6c757d',
                                };
                            @endphp

                            <span style="
                                background: {{ $bgColor }};
                                color: white;
                                padding: 5px 14px;
                                border-radius: 14px;
                                font-size: 0.85rem;
                                font-weight: 600;
                                display: inline-block;
                            ">
                                {{ ucfirst($subscription->status) }}
                            </span>
                        </td>

                        <td>
                            {{ $subscription->start_date }}
                        </td>

                        <td>
                            {{ $subscription->end_date }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="pagination-wrapper mt-4">
        {{ $subscriptions->onEachSide(1)->links('pagination::simple-tailwind') }}
    </div>
</div>
@endsection

