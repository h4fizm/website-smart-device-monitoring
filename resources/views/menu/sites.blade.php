<!-- dashboard -->
@extends('app.main')
@section('title', 'Device Site List')
@section('content')

<!-- Dashboard content goes here -->
<div class="page-heading">
    <h3>{{ $site }}</h3>
</div>

<div class="page-content">
    <section class="row">
        @php
        // Example: Set $siteId to a specific value or retrieve it from somewhere
        $siteId = $siteDetails->id_sites; // Change this according to your database structure

        // Create an instance of the Device model
        $updateModel = new \App\Models\Device;

        // Retrieve the total devices for the current site
        $latestDevices = $updateModel->getLastUpdateBySiteId($siteId);
        @endphp

        <!-- Card 1 - Last Update -->
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-body d-flex align-items-center">
                    <div>
                        <h5 class="card-title font-weight-bold mb-3">Last Update :</h5>
                        <!-- Check if $latestDevices is not null before accessing its properties -->
                        @if($latestDevices)
                            <h5 class="card-text font-weight-bold" style="font-size: 25px;">{{
                                $latestDevices->updated_at ? $latestDevices->updated_at->format('d M Y, H:i') : 'No update available' }}</h5>
                        @else
                            <h5 class="card-text font-weight-bold" style="font-size: 25px;">No update available</h5>
                        @endif
                    </div>
                    <div class="ms-auto">
                        <i class="bi bi-calendar-event text-primary" style="font-size: 3rem;"></i>
                    </div>
                </div>
            </div>
        </div>

        @php
        // Example: Set $siteId to a specific value or retrieve it from somewhere
        $siteId = $siteDetails->id_sites; // Change this according to your database structure

        // Create an instance of the Device model
        $deviceModel = new \App\Models\Device;

        // Retrieve the total devices for the current site
        $totalDevices = $deviceModel->getTotalBySiteId($siteId);
        @endphp

        <!-- Card 2 - Total Device -->
        <div class="col-lg-3 mb-4">
            <div class="card">
                <div class="card-body d-flex align-items-center">
                    <div>
                        <h5 class="card-title font-weight-bold mb-3">Total Device :</h5>
                        <h5 class="card-text font-weight-bold" style="font-size: 25px;">{{ $totalDevices }}</h5>
                    </div>
                    <div class="ms-auto">
                        <i class="bi bi-router-fill text-primary" style="font-size: 3rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="row">
        @php
        // Automatically set $siteId based on the selected site
        $siteId = $siteDetails->id_sites; // Change this according to your database structure

        // Retrieve devices associated with the selected site
        $devices = \App\Models\Device::where('id_sites', $siteId)->get();
        @endphp

        <!-- Check if there are devices available -->
        @if($devices->isEmpty())
            <div class="col-lg-12 mb-4">
                <div class="alert alert-warning" role="alert">
                    No devices connected or installed for this site.
                </div>
            </div>
        @else
            <!-- Display devices -->
            @foreach($devices as $device)
                @php
                // Convert site name to slug
                $siteSlug = strtolower(str_replace(' ', '-', $site));
                @endphp

                <div class="col-lg-3 mb-4">
                    <div class="card">
                        <div class="card-body d-flex align-items-center">
                            <div>
                                <h5 class="card-title font-weight-bold mb-3">{{ $device->device_name }}</h5>
                                <h5 class="card-text font-weight-bold mb-3" style="font-size: 17px;">Status :</h5>
                                <a href="{{ route('sites.device.detail', ['site' => $siteSlug, 'deviceId' => $device->id_device]) }}"
                                    class="btn btn-primary">Detail</a>
                            </div>
                            <div class="ms-auto">
                                @if($device->status === 1)
                                <button class="btn btn-success" disabled>ON</button>
                                @else
                                <button class="btn btn-danger" disabled>OFF</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

    </section>
</div>
@endsection
