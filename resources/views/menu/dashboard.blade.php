<!-- dashboard.blade.php -->
@extends('app.main')
@section('title', 'Dashboard Page')
@section('content')
<div class="page-heading" style="position: relative; z-index: 1;">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-10 order-md-1 order-last">
                <h3 class="mb-4">Dashboard Page</h3>
            </div>
        </div>
    </div>
    <div id="map-container" style="position: relative; height: 500px; z-index: 2;">
        <div id="map" style="height: 500px"></div>
    </div>
    <div class="card mx-auto" style="position: absolute; top: 270px; right: 10px; z-index: 3; height: 250px; width: 350px;">
    <div class="card-content">
    <div class="card-body text-center">
        <h5 class="card-title text-left mb-3" style="text-align: left;">Total Device Overall : <?php echo App\Models\Device::count(); ?></h5>
        <table class="table mx-auto">
            <thead style="font-size: small;">
                <tr>
                    <th>Sites</th>
                    <th>Total Device</th>
                </tr>
            </thead>
            <tbody>
                <?php
                use App\Models\Device;
                use App\Models\Site; // Import model Site

                // Mendapatkan semua situs
                $sites = Site::all();

                foreach ($sites as $site) {
                    $siteId = $site->id_sites;

                    // Menggunakan model Device untuk mendapatkan total perangkat pada masing-masing situs
                    $totalDevices = Device::getTotalBySiteId($siteId);

                    echo "<tr>";
                    echo "<td style='font-size: small;'>$site->name</td>";
                    echo "<td style='font-size: small;'>$totalDevices</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
    </div>
</div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    // zoom surabaya sekitar
    var map = L.map('map').setView([-7.233434, 112.734146], 12); 
     
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Fetch site data from the server (replace with actual API call)
    var sites = <?php echo json_encode(\App\Models\Site::all()); ?>;
    var devices = <?php echo json_encode(\App\Models\Device::all()); ?>;

    sites.map((site) => {
    site.devices = []
    devices.forEach((device) => {
        if(device.id_sites == site.id_sites) {
        site.devices.push(device)
        }
    })
    return site
    })

    console.log(sites)

  sites.forEach(function(site) {
    // Use Leaflet default marker
    var marker = L.marker([site.latitude, site.longitude]).addTo(map);
    var siteStr = ``;

    site.devices.map((device, index) => {
        // Menentukan warna teks berdasarkan status
        var textColor = device.status === 1 ? 'text-success' : 'text-danger';
        siteStr += `<div class="mb-2 ${textColor}">${index + 1}. <span>${device.device_name}</span> - ${device.status === 1 ? 'ON' : 'OFF'}</div>`;
    });

    var popupContent = `
        <div class="device-popup position-relative" id="${site.name}Popup" style="max-width: 280px;">
            <h6 class="font-weight-bold mb-3" style="font-size: 14px;">${site.name} Device List</h6>
            <div class="row">
                <div class="col">
                    ${siteStr}
                </div>
            </div>
            <div class="row">
                <div class="col text-end">
                    <a href="/sites/${encodeURIComponent(site.name.toLowerCase().replace(/ /g, '-'))}" class="btn btn-primary btn-md mb-1 text-white">Detail</a>
                </div>
            </div>
        </div>`;

    marker.bindPopup(popupContent)
        .on('click', function() {
            showDeviceInfo(site.name);
        });

   // Menambahkan kartu kecil di bawah marker
    var cardHTML = `
        <div class="card" style="width: 150px;">
            <div class="card-body" style="padding: 0.25rem;">
                <p class="card-text mb-0" style="font-size: 12px; text-align: center;">${site.name}</p>
            </div>
        </div>`;

    var icon = L.divIcon({
        className: 'custom-div-icon',
        html: cardHTML,
        iconSize: [10, 10], // Sesuaikan ukuran ikon dengan kebutuhan
        iconAnchor: [75, 2] // Kanan Kiri , Atas Bawah
    });


        L.marker([site.latitude, site.longitude], {icon: icon}).addTo(map);
    });

    </script>

@endsection
