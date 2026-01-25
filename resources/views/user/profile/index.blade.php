<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ParkEasy | My Profile</title>

  <link rel="stylesheet" href="{{ asset('landing/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('landing/css/style.css') }}">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    .profile-bg{ min-height:100vh; position:relative; }
    .profile-bg::before{
      content:"";
      position:fixed; inset:0;
      background-image:url("{{ asset('landing/images/login-bg.jpg') }}");
      background-size:cover;
      background-position:center;
      filter: blur(10px);
      transform: scale(1.06);
      z-index:-2;
    }
    .profile-bg::after{
      content:"";
      position:fixed; inset:0;
      background: rgba(58,58,94,0.55);
      z-index:-1;
    }

    .box{
      background: rgba(255,255,255,0.95);
      border-radius:18px;
      box-shadow:0 18px 50px rgba(0,0,0,.20);
      border:1px solid rgba(255,255,255,.6);
    }

    .tab-title{ color:#3a3a5e; font-weight:900; }
    .muted{ color:#6c6c86; font-weight:700; }
    .pill{
      display:inline-block;
      padding:6px 10px;
      border-radius:999px;
      background:#3a3a5e;
      color:#fff;
      font-weight:900;
      font-size:12px;
    }

    /* Layout */
    .profile-layout{
      display:flex;
      gap:18px;
      align-items:flex-start;
    }

    /* Sidebar full height + sticky */
    .profile-sidebar{
      width:270px;
      position: sticky;
      top: 140px; /* نفس padding-top */
      height: calc(100vh - 160px);
      overflow:auto;
    }

    .side .tab-link{
      display:flex;
      align-items:center;
      gap:10px;
      padding:12px 12px;
      border-radius:12px;
      font-weight:900;
      color:#3a3a5e;
      text-decoration:none;
      cursor:pointer;
    }
    .side .tab-link:hover{ background:#ddd; }
    .side .tab-link.active{
      background:#3a3a5e;
      color:#fff;
    }

    /* Tabs */
    .profile-tab{ display:none; }
    .profile-tab.active{ display:block; }

    /* Responsive */
    @media (max-width: 992px){
      .profile-layout{ flex-direction:column; }
      .profile-sidebar{
        width:100%;
        position:relative;
        top:auto;
        height:auto;
      }
    }
  </style>
</head>
<body>

@include('user.partials.nav')

<div class="profile-bg">
  <div class="container user-page-wrap">

    <div class="profile-layout">

      {{-- Sidebar --}}
      <div class="box p-3 side profile-sidebar">
        <div class="tab-title mb-2">My Account</div>

        <a class="tab-link active" data-target="tab-info">👤 Profile Info</a>
        <a class="tab-link" data-target="tab-res">🅿️ Reservations</a>
        <a class="tab-link" data-target="tab-sub">💳 Subscription</a>

        <hr>

        <div class="muted" style="font-size:13px;">
          Edit account details in Breeze:
          <div><b>/profile</b></div>
        </div>
      </div>

      {{-- Content --}}
      <div style="flex:1;">

        {{-- Tab 1: Info --}}
        <div id="tab-info" class="box p-4 mb-4 profile-tab active">
          <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
            <div>
              <div class="tab-title">Profile Info</div>
              <div class="muted">{{ $user->email }}</div>
            </div>
            <span class="pill">{{ strtoupper($user->role ?? 'user') }}</span>
          </div>

          <hr>

          <div class="row g-3">
            <div class="col-md-6">
              <label class="muted">Name</label>
              <div class="fw-bold" style="color:#3a3a5e;">{{ $user->name }}</div>
            </div>
            <div class="col-md-6">
              <label class="muted">Email</label>
              <div class="fw-bold" style="color:#3a3a5e;">{{ $user->email }}</div>
            </div>
          </div>
        </div>

        {{-- Tab 2: Reservations --}}
        <div id="tab-res" class="box p-4 mb-4 profile-tab">
          <div class="tab-title mb-3">My Reservations</div>

          @forelse($reservations as $r)
            <div class="p-3 mb-2" style="background:#f4f4f8;border-radius:14px;">
              <div class="fw-bold" style="color:#3a3a5e;">
                {{ $r->parking->name ?? 'Parking' }}
              </div>
              <div class="muted" style="font-size:13px;">
                Spot: <b>{{ $r->spot->spot_number ?? '-' }}</b> |
                From: <b>{{ $r->start_time }}</b> |
                To: <b>{{ $r->end_time }}</b>
              </div>
            </div>
          @empty
            <div class="muted">No reservations yet.</div>
          @endforelse
        </div>

        {{-- Tab 3: Subscription --}}
<div id="tab-sub" class="box p-4 profile-tab">
  <div class="tab-title mb-3">My Subscription</div>

  @if($subscription)
    <div class="p-3" style="background:#f4f4f8;border-radius:14px;">

      <div class="row g-3">
        <div class="col-md-6">
          <div class="muted">Plan</div>
          <div class="fw-bold" style="color:#3a3a5e;">{{ strtoupper($subscription->plan) }}</div>
        </div>

        <div class="col-md-6">
          <div class="muted">Status</div>
          <div class="fw-bold" style="color:#3a3a5e;">{{ strtoupper($subscription->status) }}</div>
        </div>

        <div class="col-md-6">
          <div class="muted">Price</div>
          <div class="fw-bold" style="color:#3a3a5e;">{{ $subscription->price }} JOD</div>
        </div>

        <div class="col-md-6">
          <div class="muted">Hours Limit</div>
          <div class="fw-bold" style="color:#3a3a5e;">{{ $subscription->hours_limit }}</div>
        </div>

        <div class="col-md-6">
          <div class="muted">Hours Used</div>
          <div class="fw-bold" style="color:#3a3a5e;">{{ $subscription->hours_used }}</div>
        </div>

        <div class="col-md-6">
          <div class="muted">Days Limit</div>
          <div class="fw-bold" style="color:#3a3a5e;">{{ $subscription->days_limit }}</div>
        </div>

        <div class="col-md-6">
          <div class="muted">Days Used</div>
          <div class="fw-bold" style="color:#3a3a5e;">{{ $subscription->days_used }}</div>
        </div>

        <div class="col-md-6">
          <div class="muted">Start Date</div>
          <div class="fw-bold" style="color:#3a3a5e;">
            {{ \Carbon\Carbon::parse($subscription->start_date)->format('Y-m-d') }}
          </div>
        </div>

        <div class="col-md-6">
          <div class="muted">End Date</div>
          <div class="fw-bold" style="color:#3a3a5e;">
            {{ \Carbon\Carbon::parse($subscription->end_date)->format('Y-m-d') }}
          </div>
        </div>
      </div>

    </div>
  @else
    <div class="muted mb-3">No active subscription.</div>
    <a href="/subscriptions" class="btn pe-btn w-100">Subscribe now</a>
  @endif
</div>


      </div>
    </div>
  </div>
</div>

{{-- SweetAlert --}}
@if(session('success'))
<script>
Swal.fire({icon:'success', title:'Success', text:@json(session('success'))});
</script>
@endif
@if(session('error'))
<script>
Swal.fire({icon:'error', title:'Oops', text:@json(session('error'))});
</script>
@endif

<script src="{{ asset('landing/js/bootstrap.bundle.min.js') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const links = document.querySelectorAll('.tab-link');
  const tabs  = document.querySelectorAll('.profile-tab');

  links.forEach(link => {
    link.addEventListener('click', function () {
      links.forEach(l => l.classList.remove('active'));
      this.classList.add('active');

      tabs.forEach(t => t.classList.remove('active'));
      const target = this.dataset.target;
      document.getElementById(target).classList.add('active');
    });
  });
});
</script>

</body>
</html>


