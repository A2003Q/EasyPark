<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ParkIt | Find Your Perfect Parking Spot</title>

  <link rel="stylesheet" href="{{ asset('landing/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('landing/css/style.css') }}">
  <!-- font css -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body { 
      background: linear-gradient(135deg, #f5f7fa 0%, #e8ecf1 100%);
      font-family: 'Poppins', sans-serif;
      min-height: 100vh;
    }

    /* Logo Styles */
    .parkit-logo {
      height: 45px;
      width: auto;
      transition: transform 0.3s ease;
    }

    .parkit-logo:hover {
      transform: scale(1.05);
    }

    /* Enhanced Navbar */
    .navbar-custom {
      background: #fff;
      box-shadow: 0 4px 20px rgba(0,0,0,.08);
      padding: 12px 0;
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    .navbar-brand {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    /* Main Content */
    .user-page-wrap {
      padding: 40px 15px;
      max-width: 1400px;
      margin: 0 auto;
      padding-top: 100px;
    }

    /* Header Section */
    .page-header {
      text-align: center;
      margin-bottom: 40px;
      animation: fadeInDown 0.6s ease;
    }

    .pe-title { 
      color: #3a3a5e; 
      font-weight: 800; 
      font-size: 2.5rem;
      margin-bottom: 12px;
      line-height: 1.2;
    }

    .pe-subtitle {
      color: #6c6c86;
      font-size: 1.1rem;
      font-weight: 400;
    }

    /* Enhanced Search Bar */
    .pe-searchbar { 
      background: linear-gradient(135deg, #3a3a5e 0%, #2d2d4a 100%);
      color: #fff; 
      border-radius: 20px; 
      padding: 35px 30px;
      box-shadow: 0 20px 60px rgba(58, 58, 94, 0.3);
      animation: fadeInUp 0.6s ease;
      position: relative;
      overflow: hidden;
    }

    .pe-searchbar::before {
      content: '';
      position: absolute;
      top: -50%;
      right: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle, rgba(135, 206, 235, 0.1) 0%, transparent 70%);
      animation: rotate 20s linear infinite;
    }

    @keyframes rotate {
      from { transform: rotate(0deg); }
      to { transform: rotate(360deg); }
    }

    .pe-searchbar .form-label {
      font-weight: 600;
      font-size: 14px;
      margin-bottom: 8px;
      color: #fff;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .pe-searchbar .form-control,
    .pe-searchbar .form-select {
      border: 2px solid rgba(255,255,255,0.2);
      background: rgba(255,255,255,0.95);
      border-radius: 12px;
      padding: 12px 16px;
      font-weight: 500;
      transition: all 0.3s ease;
      position: relative;
      z-index: 1;
    }

    .pe-searchbar .form-control:focus,
    .pe-searchbar .form-select:focus {
      border-color: #416978;
      box-shadow: 0 0 0 3px rgba(135, 206, 235, 0.2);
      background: #fff;
    }

    /* Enhanced Buttons */
    .pe-btn { 
      background: linear-gradient(135deg, #87CEEB 0%, #5dade2 100%);
      color: #fff; 
      border: 0; 
      border-radius: 12px; 
      font-weight: 700;
      padding: 12px 24px;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(135, 206, 235, 0.4);
      position: relative;
      z-index: 1;
    }

    .pe-btn:hover { 
      background: linear-gradient(135deg, #5dade2 0%, #3498db 100%);
      color: #fff;
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(135, 206, 235, 0.5);
    }

    .pe-btn i {
      margin-right: 6px;
    }

    .pe-btn-outline { 
      background: #fff; 
      color: #3a3a5e; 
      border: 2px solid #3a3a5e; 
      border-radius: 10px; 
      font-weight: 700;
      padding: 8px 16px;
      transition: all 0.3s ease;
      font-size: 14px;
    }

    .pe-btn-outline:hover { 
      background: #3a3a5e; 
      color: #fff;
      transform: translateY(-2px);
      box-shadow: 0 4px 15px rgba(58, 58, 94, 0.3);
    }

    /* Enhanced Cards */
    .pe-card { 
      background: #fff; 
      border-radius: 20px; 
      overflow: hidden; 
      box-shadow: 0 10px 40px rgba(0,0,0,.08);
      border: none;
      transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      animation: fadeInUp 0.6s ease;
      position: relative;
    }

    .pe-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 20px 60px rgba(0,0,0,.15);
    }

    .pe-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(90deg, #87CEEB 0%, #5dade2 100%);
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .pe-card:hover::before {
      opacity: 1;
    }

    .parking-image {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.4s ease;
    }

    .pe-card:hover .parking-image {
      transform: scale(1.1);
    }

    .image-wrapper {
      overflow: hidden;
      position: relative;
      background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }

    .card-content {
      padding: 24px;
    }

    .parking-name {
      color: #3a3a5e;
      font-size: 18px;
      font-weight: 700;
      margin-bottom: 8px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .parking-location {
      color: #6c6c86;
      font-size: 13px;
      margin-bottom: 16px;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .parking-location i {
      color: #87CEEB;
    }

    /* Enhanced Pills/Badges */
    .pe-pill { 
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 8px 14px; 
      border-radius: 20px; 
      font-weight: 700; 
      font-size: 12px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      box-shadow: 0 2px 10px rgba(0,0,0,.1);
    }

    .pe-pill-ava { 
      background: linear-gradient(135deg, #87CEEB 0%, #5dade2 100%);
      color: #fff;
    }

    .pe-pill-busy { 
      background: linear-gradient(135deg, #bdbdbd 0%, #9e9e9e 100%);
      color: #fff;
    }

    .pe-pill i {
      font-size: 10px;
    }

    /* Spots Info */
    .spots-info {
      background: #f8f9fa;
      padding: 12px;
      border-radius: 12px;
      margin: 16px 0;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .spots-info i {
      color: #87CEEB;
      font-size: 20px;
    }

    .spots-info-text {
      flex: 1;
    }

    .spots-info-label {
      font-size: 12px;
      color: #6c6c86;
      font-weight: 500;
    }

    .spots-info-value {
      font-size: 20px;
      font-weight: 800;
      color: #3a3a5e;
    }

    /* Card Actions */
    .card-actions {
      display: flex;
      gap: 10px;
      margin-top: 16px;
    }

    .btn-map {
      background: linear-gradient(135deg, #87CEEB 0%, #5dade2 100%);
      color: #fff;
      border: none;
      border-radius: 10px;
      padding: 10px 18px;
      font-weight: 700;
      font-size: 13px;
      transition: all 0.3s ease;
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }

    .btn-map:hover {
      background: linear-gradient(135deg, #5dade2 0%, #3498db 100%);
      transform: translateY(-2px);
      box-shadow: 0 4px 15px rgba(135, 206, 235, 0.4);
    }

    /* Enhanced Map */
    .pe-map { 
      height: 600px; 
      border-radius: 20px; 
      overflow: hidden; 
      border: none;
      box-shadow: 0 20px 60px rgba(0,0,0,.12);
      background: #fff;
      animation: fadeInRight 0.6s ease;
      position: sticky;
      top: 100px;
    }

    /* Empty State */
    .empty-state {
      text-align: center;
      padding: 60px 30px;
    }

    .empty-state i {
      font-size: 80px;
      color: #87CEEB;
      margin-bottom: 24px;
      opacity: 0.5;
    }

    .empty-state .pe-title {
      font-size: 1.8rem;
      margin-bottom: 12px;
    }

    /* Animations */
    @keyframes fadeInDown {
      from {
        opacity: 0;
        transform: translateY(-30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes fadeInRight {
      from {
        opacity: 0;
        transform: translateX(30px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    /* Scrollbar Styling */
    ::-webkit-scrollbar {
      width: 10px;
    }

    ::-webkit-scrollbar-track {
      background: #f1f1f1;
    }

    ::-webkit-scrollbar-thumb {
      background: linear-gradient(135deg, #87CEEB 0%, #5dade2 100%);
      border-radius: 5px;
    }

    ::-webkit-scrollbar-thumb:hover {
      background: linear-gradient(135deg, #5dade2 0%, #3498db 100%);
    }

    /* Loading Animation */
    .loading-overlay {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(255,255,255,0.95);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 9999;
      opacity: 1;
      transition: opacity 0.3s ease;
    }

    .loading-overlay.hide {
      opacity: 0;
      pointer-events: none;
    }

    .spinner {
      width: 50px;
      height: 50px;
      border: 5px solid #f3f3f3;
      border-top: 5px solid #87CEEB;
      border-radius: 50%;
      animation: spin 1s linear infinite;
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    /* Pagination */
    .pagination {
      margin-top: 30px;
    }

    .pagination .page-link {
      color: #3a3a5e;
      border: 2px solid #e0e0e0;
      border-radius: 10px;
      margin: 0 5px;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .pagination .page-link:hover {
      background: #87CEEB;
      color: #fff;
      border-color: #87CEEB;
      transform: translateY(-2px);
    }

    .pagination .page-item.active .page-link {
      background: linear-gradient(135deg, #3a3a5e 0%, #2d2d4a 100%);
      border-color: #3a3a5e;
    }

    /* Responsive */
    @media (max-width: 991px) {
      .pe-map {
        height: 400px;
        margin-top: 30px;
        position: relative;
        top: 0;
      }

      .pe-title {
        font-size: 2rem;
      }

      .pe-searchbar {
        padding: 25px 20px;
      }
    }

    @media (max-width: 576px) {
      .pe-title {
        font-size: 1.5rem;
      }

      .card-actions {
        flex-direction: column;
      }

      .pe-btn-outline,
      .btn-map {
        width: 100%;
      }
    }

    /* Results Counter */
    .results-counter {
      background: #fff;
      padding: 16px 20px;
      border-radius: 15px;
      margin-bottom: 20px;
      box-shadow: 0 4px 15px rgba(0,0,0,.06);
      display: flex;
      align-items: center;
      gap: 12px;
      animation: fadeInUp 0.6s ease;
    }

    .results-counter i {
      color: #87CEEB;
      font-size: 24px;
    }

    .results-counter-text {
      font-weight: 600;
      color: #3a3a5e;
      font-size: 15px;
    }

    .results-counter-number {
      color: #87CEEB;
      font-weight: 800;
    }
  </style>
</head>
<body>

<!-- Loading Overlay -->
<div class="loading-overlay hide" id="loadingOverlay">
  <div class="spinner"></div>
</div>

<!-- Navbar -->
@include('landing.partials.nav')

<div class="container user-page-wrap">
  <!-- Page Header -->
  <div class="page-header">
    <h1 class="pe-title">
      <i class="fas fa-map-marked-alt" style="color: #87CEEB;"></i>
      Find Your Perfect Parking Spot
    </h1>
    <p class="pe-subtitle">Search by city and location to discover available parking near you</p>
  </div>

  <!-- Enhanced Search Bar -->
  <div class="pe-searchbar mb-4">
    <form method="GET" action="{{ route('user.parkings.index') }}" class="row g-3 align-items-end">
      <div class="col-md-4">
        <label class="form-label">
          <i class="fas fa-city"></i>
          City
        </label>
        <select name="city_id" class="form-select">
          <option value="">All cities</option>
          @foreach($cities as $c)
            <option value="{{ $c->id }}" @selected((string)$cityId === (string)$c->id)>{{ $c->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="col-md-5">
        <label class="form-label">
          <i class="fas fa-map-pin"></i>
          Location / Place
        </label>
        <input type="text" class="form-control" name="place" value="{{ $place }}" placeholder="e.g. Downtown, Abdoun, City Mall...">
      </div>

      <div class="col-md-3 d-grid">
        <button class="btn pe-btn" type="submit">
          <i class="fas fa-search"></i>
          Search Parkings
        </button>
      </div>
    </form>
  </div>

  <div class="row g-4">
    <!-- Parking List -->
    <div class="col-lg-5">
      @if($parkings->count() > 0)
        <div class="results-counter">
          <i class="fas fa-parking"></i>
          <div class="results-counter-text">
            Found <span class="results-counter-number">{{ $parkings->total() }}</span> parking spot{{ $parkings->total() > 1 ? 's' : '' }}
          </div>
        </div>
      @endif

      @forelse($parkings as $p)
        <div class="pe-card mb-3">
          <div class="row g-0">
            <div class="col-4">
              <div class="image-wrapper">
                <img src="{{ $p->image_url ? $p->image_url : asset('landing/images/img-4.png') }}"
                     alt="parking" class="parking-image">
              </div>
            </div>
            <div class="col-8">
              <div class="card-content">
                <div class="d-flex justify-content-between align-items-start mb-2">
                  <div class="parking-name">
                    <i class="fas fa-parking"></i>
                    {{ $p->name }}
                  </div>
                  <span class="pe-pill {{ $p->available_spots > 0 ? 'pe-pill-ava' : 'pe-pill-busy' }}">
                    <i class="fas fa-circle"></i>
                    {{ $p->available_spots > 0 ? 'Available' : 'Full' }}
                  </span>
                </div>

                <div class="parking-location">
                  <i class="fas fa-map-marker-alt"></i>
                  {{ optional($p->city)->name }} • {{ $p->address }}
                </div>

                <div class="spots-info">
                  <i class="fas fa-car"></i>
                  <div class="spots-info-text">
                    <div class="spots-info-label">Available Spots</div>
                    <div class="spots-info-value">{{ $p->available_spots }}</div>
                  </div>
                </div>

                <div class="card-actions">
                  <a class="btn pe-btn-outline" href="{{ route('user.parkings.show', $p->id) }}">
                    <i class="fas fa-info-circle"></i> Details
                  </a>
                  <button class="btn-map" type="button" onclick="focusMarker({{ $p->id }})">
                    <i class="fas fa-map-marked-alt"></i> Show on Map
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      @empty
        <div class="pe-card empty-state">
          <i class="fas fa-car-side"></i>
          <div class="pe-title">No Parkings Found</div>
          <div class="pe-subtitle">Try adjusting your search filters or explore different areas</div>
        </div>
      @endforelse

      <div class="mt-3">
        {{ $parkings->links() }}
      </div>
    </div>

    <!-- Map Section -->
    <div class="col-lg-7">
      <div id="map" class="pe-map"></div>
    </div>
  </div>
</div>

<script>
  // Hide loading overlay after page load
  window.addEventListener('load', function() {
    setTimeout(function() {
      document.getElementById('loadingOverlay').classList.add('hide');
    }, 500);
  });

  // SweetAlert notifications
  @if(session('success'))
    Swal.fire({
      icon: 'success', 
      title: 'Success!', 
      text: @json(session('success')),
      confirmButtonColor: '#87CEEB',
      timer: 3000
    });
  @endif
  
  @if(session('error'))
    Swal.fire({
      icon: 'error', 
      title: 'Oops!', 
      text: @json(session('error')),
      confirmButtonColor: '#3a3a5e'
    });
  @endif

  // Map initialization
  const markersData = @json($markers);
  const map = L.map('map');
  map.setView([31.9539, 35.9106], 12);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; OpenStreetMap contributors'
  }).addTo(map);

  const markerById = {};

  // Custom marker icon
  const customIcon = L.divIcon({
    className: 'custom-marker',
    html: '<div style="background: linear-gradient(135deg, #87CEEB 0%, #5dade2 100%); width: 35px; height: 35px; border-radius: 50% 50% 50% 0; transform: rotate(-45deg); border: 3px solid #fff; box-shadow: 0 4px 15px rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center;"><i class="fas fa-parking" style="color: #fff; transform: rotate(45deg); font-size: 16px;"></i></div>',
    iconSize: [35, 35],
    iconAnchor: [17, 35]
  });

  // Add markers
  markersData.forEach(p => {
    if(!p.lat || !p.lng) return;
    const m = L.marker([p.lat, p.lng], { icon: customIcon }).addTo(map);
    
    const popupContent = `
      <div style="min-width: 220px; font-family: 'Poppins', sans-serif;">
        <div style="font-weight: 800; color: #3a3a5e; font-size: 16px; margin-bottom: 8px; display: flex; align-items: center; gap: 8px;">
          <i class="fas fa-parking" style="color: #87CEEB;"></i>
          ${p.name}
        </div>
        <div style="font-size: 13px; color: #6c6c86; margin-bottom: 12px; display: flex; align-items: center; gap: 6px;">
          <i class="fas fa-map-marker-alt" style="color: #87CEEB;"></i>
          ${p.address ?? ''}
        </div>
        <div style="background: #f8f9fa; padding: 10px; border-radius: 10px; margin-bottom: 12px;">
          <div style="font-size: 12px; color: #6c6c86; margin-bottom: 4px;">Available Spots</div>
          <div style="font-size: 20px; font-weight: 800; color: #3a3a5e;">
            <i class="fas fa-car" style="color: #87CEEB; font-size: 16px;"></i>
            ${p.available}
          </div>
        </div>
        <a href="${p.details_url}" style="display: inline-block; background: linear-gradient(135deg, #3a3a5e 0%, #2d2d4a 100%); color: #fff; padding: 8px 16px; border-radius: 8px; text-decoration: none; font-weight: 700; font-size: 13px; transition: all 0.3s ease;">
          <i class="fas fa-info-circle"></i> View Details
        </a>
      </div>
    `;
    
    m.bindPopup(popupContent, {
      maxWidth: 280,
      className: 'custom-popup'
    });
    
    markerById[p.id] = m;
  });

  // Focus marker function
  function focusMarker(id){
    const m = markerById[id];
    if(!m) return;
    map.setView(m.getLatLng(), 16);
    m.openPopup();
    
    // Smooth scroll to map on mobile
    if(window.innerWidth < 992) {
      document.getElementById('map').scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
  }

  // Geolocation
  if(navigator.geolocation){
    navigator.geolocation.getCurrentPosition(pos => {
      const lat = pos.coords.latitude, lng = pos.coords.longitude;
      
      const userIcon = L.divIcon({
        className: 'user-marker',
        html: '<div style="background: #FF6B6B; width: 20px; height: 20px; border-radius: 50%; border: 4px solid #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.3); animation: pulse 2s infinite;"></div>',
        iconSize: [20, 20],
        iconAnchor: [10, 10]
      });
      
      L.marker([lat, lng], { icon: userIcon })
        .addTo(map)
        .bindPopup("<div style='font-family: Poppins; font-weight: 600; color: #3a3a5e;'><i class='fas fa-user-circle' style='color: #87CEEB;'></i> You are here</div>");
      
      map.setView([lat, lng], 13);
    });
  }

  // Add pulse animation for user marker
  const style = document.createElement('style');
  style.textContent = `
    @keyframes pulse {
      0% {
        box-shadow: 0 0 0 0 rgba(255, 107, 107, 0.7);
      }
      70% {
        box-shadow: 0 0 0 20px rgba(255, 107, 107, 0);
      }
      100% {
        box-shadow: 0 0 0 0 rgba(255, 107, 107, 0);
      }
    }
    
    .custom-popup .leaflet-popup-content-wrapper {
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }
    
    .custom-popup .leaflet-popup-tip {
      background: #fff;
    }
  `;
  document.head.appendChild(style);
</script>

<script src="{{ asset('landing/js/jquery.min.js') }}"></script>
<script src="{{ asset('landing/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
