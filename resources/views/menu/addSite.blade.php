@extends('app.main')
@section('title', "Add Site")
@section('content')

<!-- CSS Chart -->
<link rel="stylesheet" href="{{ asset('style/assets/js/style_chart.css') }}">
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Add Site</h3>
            <p class="text-subtitle text-muted">Add Information About New Site Location.</p>
        </div>
    </div>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-right">
        <li class="breadcrumb-item"><a href="{{ route('info.list_site') }}">Site Information</a></li>
        <li class="breadcrumb-item">Add New Sites</li>
    </ol>
</nav>

<section class="section">
    <div class="row">
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Input Form</h4>
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
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                Site added successfully!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form id="addSiteForm" action="{{ route('store_site') }}" method="POST"
                            class="form form-horizontal">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="site-name">Site Name</label>
                                    </div>
                                    <div class="col-md-8 form-group mb-4">
                                        <input type="text" id="site-name" class="form-control" name="site_name"
                                            placeholder="Site Name" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="latitude">Latitude</label>
                                    </div>
                                    <div class="col-md-8 form-group mb-4">
                                        <input type="text" id="latitude" class="form-control" name="latitude"
                                            placeholder="Latitude" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="longitude">Longitude</label>
                                    </div>
                                    <div class="col-md-8 form-group mb-4">
                                        <input type="text" id="longitude" class="form-control" name="longitude"
                                            placeholder="Longitude" required>
                                    </div>
                                    <div class="col-sm-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-3 mb-1"
                                            onclick="submitForm()">Submit</button>
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
    var map = L.map('map').setView([-7.2575, 112.7521], 12); // Posisikan di Surabaya
    var marker;

    // Add the tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    // Function to add marker
    function addMarker(latitude, longitude) {
        // Remove existing marker if exists
        if (marker) {
            map.removeLayer(marker);
        }
        marker = L.marker([latitude, longitude]).addTo(map);
    }

    // Function to set latitude and longitude inputs
    function setLatLngInputs(lat, lng) {
        document.getElementById('latitude').value = lat.toFixed(6);
        document.getElementById('longitude').value = lng.toFixed(6);
    }

    // Submit form manually
    function submitForm() {
        document.getElementById('addDeviceForm').submit();
    }

    // Add event listener to map to capture clicks
    map.on('click', function (e) {
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;
        addMarker(lat, lng);
        setLatLngInputs(lat, lng); // Update input fields
    });
</script>
@endsection
