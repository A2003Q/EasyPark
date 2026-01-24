@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <h3 class="text-center mt-4 mb-5">
        Welcome, {{ auth()->user()->name }}!
    </h3>

    <!-- Dashboard Cards -->
    <div class="dashboard-row">

        <!-- Users -->
        <a href="{{ route('admin.users.index') }}" class="text-decoration-none">
            <div class="dashboard-card">
                <i class="fa fa-users"></i>
                <h4>Users</h4>
                <p>{{ $usersCount }}</p>
            </div>
        </a>

        <!-- Active Subscriptions -->
        <a href="{{ route('admin.subscriptions.index') }}" class="text-decoration-none">
            <div class="dashboard-card">
                <i class="fa fa-id-card"></i>
                <h4>Active Subscriptions</h4>
                <p>{{ $activeSubscriptions }}</p>
            </div>
        </a>

        <!-- Parkings -->
        <a href="{{ route('admin.parkings.index') }}" class="text-decoration-none">
            <div class="dashboard-card">
                <i class="fa fa-parking"></i>
                <h4>Parkings</h4>
                <p>{{ $parkingsCount }}</p>
            </div>
        </a>

        <!-- Active Reservations -->
        <a href="{{ route('admin.reservations.index') }}" class="text-decoration-none">
            <div class="dashboard-card">
                <i class="fa fa-calendar-check"></i>
                <h4>Active Reservations</h4>
                <p>{{ $activeReservations }}</p>
            </div>
        </a>

        <!-- Monthly Revenue -->
        <div class="dashboard-card">
            <i class="fa fa-chart-line"></i>
            <h4>Monthly Revenue</h4>
            <p>{{ $monthlyRevenue }} JD</p>
        </div>

        <!-- Total Revenue -->
        <div class="dashboard-card">
            <i class="fa fa-dollar-sign"></i>
            <h4>Total Revenue</h4>
            <p>{{ $totalRevenue }} JD</p>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="dashboard-charts mt-5">

        <div class="row g-4">
  
  
            <!-- Smaller Charts Below -->
            <div class="col-lg-6">
                <div class="chart-card">
                    <h5 class="chart-title">Reservations Status</h5>
                    <canvas id="reservationsChart"></canvas>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="chart-card">
                    <h5 class="chart-title">Parking Availability</h5>
                    <canvas id="parkingChart"></canvas>
                </div>
            </div>
            <!-- Monthly Revenue Chart (Large Top) -->
            <div class="col-lg-12">
                <div class="chart-card">
                    <h5 class="chart-title">Monthly Revenue</h5>
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>

        

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    /* ----------------------------- */
/* Reservations Status Chart     */
/* ----------------------------- */
const reservationsData = @json($reservationStatusCounts); // e.g. ['Active'=>40,'Completed'=>25,'Cancelled'=>10]
new Chart(document.getElementById('reservationsChart'), {
    type: 'doughnut',
    data: {
        labels: Object.keys(reservationsData),
        datasets: [{
            data: Object.values(reservationsData),
            backgroundColor: ['#3a3a5e','#50507a','#6b6b98','#8585b6'],
            borderColor: '#3a3a5e',

        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { position: 'bottom' } }
    }
});

/* ----------------------------- */
/* Parking Availability Chart    */
/* ----------------------------- */
const parkingData = @json($parkingAvailability); // e.g. ['Available'=>120,'Occupied'=>80]
new Chart(document.getElementById('parkingChart'), {
    type: 'bar',
    data: {
        labels: Object.keys(parkingData),
        datasets: [{
            data: Object.values(parkingData),
           backgroundColor: ['#3a3a5e','#50507a','#6b6b98','#8585b6'],
          borderColor: '#3a3a5e',

        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true } }
    }
});
/* ----------------------------- */
/* Monthly Revenue Chart (Line)  */
/* ----------------------------- */
const revenueData = @json($monthlyRevenueByMonth); // e.g. ['Jan' => 1200, 'Feb'=>1500 ...]
new Chart(document.getElementById('revenueChart'), {
    type: 'line',
    data: {
        labels: Object.keys(revenueData),
        datasets: [{
            label: 'Revenue (JD)',
            data: Object.values(revenueData),
            backgroundColor: '#3a3a5e',
            borderColor: '#3a3a5e',
            tension: 0.4,
            fill: true,
            pointBackgroundColor: '#28a745',
            pointBorderColor: '#28a745'
        }]
    },
    options: {
        plugins: { legend: { display: false } },
        responsive: true,
        scales: {
            y: { beginAtZero: true }
        }
    }
});


</script>
@endsection








