@extends('app.main')
@section('title', "Edit Site")
@section('content')

<!-- CSS Chart -->
<link rel="stylesheet" href="{{ asset('style/assets/js/style_chart.css') }}">
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Edit Site</h3>
            <p class="text-subtitle text-muted">Edit Information About Site Location.</p>
        </div>
    </div>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-right">
        <li class="breadcrumb-item"><a href="{{ route('info.list_site') }}">Site Information</a></li>
        <li class="breadcrumb-item">Edit Site</li>
    </ol>
</nav>

<section class="section">
    <div class="row">
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Form</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <!-- Display validation messages -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Display success message -->
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form id="editSiteForm" action="{{ route('sites.update', $site->id_sites) }}" method="POST"
                            class="form form-horizontal">
                            @csrf
                            @method('PUT')
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="site-name">Site Name</label>
                                    </div>
                                    <div class="col-md-8 form-group mb-4">
                                        <input type="text" id="site-name" class="form-control" name="site_name"
                                            placeholder="Site Name" value="{{ $site->name }}" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="latitude">Latitude</label>
                                    </div>
                                    <div class="col-md-8 form-group mb-4">
                                        <input type="text" id="latitude" class="form-control" name="latitude"
                                            placeholder="Latitude" value="{{ $site->latitude }}" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="longitude">Longitude</label>
                                    </div>
                                    <div class="col-md-8 form-group mb-4">
                                        <input type="text" id="longitude" class="form-control" name="longitude"
                                            placeholder="Longitude" value="{{ $site->longitude }}" required>
                                    </div>
                                    <div class="col-sm-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-3 mb-1">Update</button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div id="map" style="height: 350px; border: 1px solid #ccc; z-index: 1;"></div>
        </div>
    </div>
</section>

<!-- Leaflet JavaScript -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    // Initialize the map
    var map = L.map('map').setView([{{ $site->latitude }}, {{ $site->longitude }}], 12);
    var marker;

    // Add the tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    // Add marker for existing location
    marker = L.marker([{{ $site->latitude }}, {{ $site->longitude }}]).addTo(map);

    // Function to set latitude and longitude inputs
    function setLatLngInputs(lat, lng) {
        document.getElementById('latitude').value = lat.toFixed(6);
        document.getElementById('longitude').value = lng.toFixed(6);
    }

    // Submit form manually
    function submitForm() {
        document.getElementById('editSiteForm').submit();
    }

    // Add event listener to map to capture clicks
    map.on('click', function (e) {
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;
        if (marker) {
            map.removeLayer(marker);
        }
        marker = L.marker([lat, lng]).addTo(map);
        setLatLngInputs(lat, lng); // Update input fields
    });
</script>
@endsection
