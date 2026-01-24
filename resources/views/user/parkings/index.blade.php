<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ParkEasy | Parkings</title>

  <link rel="stylesheet" href="{{ asset('landing/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('landing/css/style.css') }}">

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    body { background:#f7f7fb; }
    .pe-title{ color:#3a3a5e; font-weight:800; }
    .pe-muted{ color:#6c6c86; }
    .pe-searchbar{ background:#3a3a5e; color:#fff; border-radius:16px; padding:18px; box-shadow:0 14px 40px rgba(0,0,0,.10); }
    .pe-card{ background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 14px 40px rgba(0,0,0,.08); border:1px solid #eee; }
    .pe-btn{ background:#3a3a5e; color:#fff; border:0; border-radius:10px; font-weight:700; }
    .pe-btn:hover{ background:#2f2f4f; color:#fff; }
    .pe-btn-outline{ background:#fff; color:#3a3a5e; border:2px solid #3a3a5e; border-radius:10px; font-weight:800; }
    .pe-btn-outline:hover{ background:#ddd; color:#3a3a5e; }
    .pe-map{ height:520px; border-radius:16px; overflow:hidden; border:1px solid #e7e7ee; box-shadow:0 14px 40px rgba(0,0,0,.08); background:#fff; }
    .pe-pill{ display:inline-block; padding:6px 10px; border-radius:999px; font-weight:800; font-size:12px; }
    .pe-pill-ava{ background:#ddd; color:#3a3a5e; }
    .pe-pill-busy{ background:#bdbdbd; color:#3a3a5e; }
  </style>
</head>
<body>

@include('user.partials.nav')

<div class="container user-page-wrap">
  <div class="mb-3">
    <h2 class="pe-title mb-1">Find Parkings Near You</h2>
    <div class="pe-muted">Search by city & place, then explore results on the map.</div>
  </div>

  <div class="pe-searchbar mb-4">
    <form method="GET" action="{{ route('user.parkings.index') }}" class="row g-2 align-items-end">
      <div class="col-md-4">
        <label class="form-label mb-1">City</label>
        <select name="city_id" class="form-select">
          <option value="">All cities</option>
          @foreach($cities as $c)
            <option value="{{ $c->id }}" @selected((string)$cityId === (string)$c->id)>{{ $c->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="col-md-5">
        <label class="form-label mb-1">Place</label>
        <input type="text" class="form-control" name="place" value="{{ $place }}" placeholder="e.g. Downtown, Abdoun...">
      </div>

      <div class="col-md-3 d-grid">
        <button class="btn pe-btn" type="submit">Search</button>
      </div>
    </form>
  </div>

  <div class="row g-3">
    <div class="col-lg-5">
      @forelse($parkings as $p)
        <div class="pe-card mb-3">
          <div class="row g-0">
            <div class="col-4">
              <img src="{{ $p->image_url ? $p->image_url : asset('landing/images/img-4.png') }}"
                   alt="parking" style="width:100%;height:100%;object-fit:cover;">
            </div>
            <div class="col-8">
              <div class="p-3">
                <div class="d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fw-bold" style="color:#3a3a5e; font-size:16px;">{{ $p->name }}</div>
                    <div class="pe-muted" style="font-size:13px;">
                      {{ optional($p->city)->name }} • {{ $p->address }}
                    </div>
                  </div>

                  <span class="pe-pill {{ $p->available_spots > 0 ? 'pe-pill-ava' : 'pe-pill-busy' }}">
                    {{ $p->available_spots > 0 ? 'Available' : 'Busy' }}
                  </span>
                </div>

                <div class="mt-2 pe-muted" style="font-size:13px;">
                  Spots: <b>{{ $p->available_spots }}</b> available
                </div>

                <div class="mt-3 d-flex gap-2">
                  <a class="btn pe-btn-outline btn-sm" href="{{ route('user.parkings.show', $p->id) }}">View details</a>
                  <button class="btn pe-btn btn-sm" type="button" onclick="focusMarker({{ $p->id }})">Show on map</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      @empty
        <div class="pe-card p-4">
          <div class="pe-title">No parkings found</div>
          <div class="pe-muted">Try a different city/place.</div>
        </div>
      @endforelse

      <div class="mt-2">
        {{ $parkings->links() }}
      </div>
    </div>

    <div class="col-lg-7">
      <div id="map" class="pe-map"></div>
    </div>
  </div>
</div>

<script>
  @if(session('success'))
    Swal.fire({icon:'success', title:'Done', text:@json(session('success'))});
  @endif
  @if(session('error'))
    Swal.fire({icon:'error', title:'Oops', text:@json(session('error'))});
  @endif

  const markersData = @json($markers);
  const map = L.map('map');
  map.setView([31.9539, 35.9106], 12);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; OpenStreetMap'
  }).addTo(map);

  const markerById = {};

  markersData.forEach(p => {
    if(!p.lat || !p.lng) return;
    const m = L.marker([p.lat, p.lng]).addTo(map);
    m.bindPopup(`
      <div style="min-width:200px">
        <div style="font-weight:800;color:#3a3a5e">${p.name}</div>
        <div style="font-size:12px;color:#666">${p.address ?? ''}</div>
        <div style="margin-top:6px;font-size:12px">
          Available: <b>${p.available}</b>
        </div>
        <div style="margin-top:8px">
          <a href="${p.details_url}" style="font-weight:800;color:#3a3a5e">View details</a>
        </div>
      </div>
    `);
    markerById[p.id] = m;
  });

  function focusMarker(id){
    const m = markerById[id];
    if(!m) return;
    map.setView(m.getLatLng(), 15);
    m.openPopup();
  }

  if(navigator.geolocation){
    navigator.geolocation.getCurrentPosition(pos => {
      const lat = pos.coords.latitude, lng = pos.coords.longitude;
      L.circleMarker([lat,lng], {radius:7}).addTo(map).bindPopup("You are here");
      map.setView([lat,lng], 13);
    });
  }
</script>

<script src="{{ asset('landing/js/jquery.min.js') }}"></script>
<script src="{{ asset('landing/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
