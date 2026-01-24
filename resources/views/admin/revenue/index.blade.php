@extends('admin.layout')

@section('content')
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
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
            </thead>

            <tbody>
                @foreach($revenues as $revenue)
                    <tr >
                        <td >
                            {{ $loop->iteration + ($revenues->currentPage() - 1) * $revenues->perPage() }}
                        </td>

                        <td >
                          {{ $revenue->reservation->user->name ?? 'N/A' }}

                        </td>
                         <td>
    <span class="badge bg-secondary">
        {{ ucfirst($revenue->source) }}
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
                                {{ $revenue->amount }} JD
                            </span>
                        </td>

                        <td>
                            {{ $revenue->created_at->format('Y-m-d H:i') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="pagination-wrapper mt-4">
        {{ $revenues->onEachSide(1)->links('pagination::simple-tailwind') }}
    </div>
</div>
@endsection


