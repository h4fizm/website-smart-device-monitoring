@extends('app.main')
@section('title', "$device->device_name")
@section('content')

<!-- CSS Chart -->
<link rel="stylesheet" href="{{ asset('style/assets/js/style_chart.css') }}">
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>{{ $device->device_name }}</h3>
            <p class="text-subtitle text-muted">Information Detail about Device.</p>
        </div>
    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-right">
            <li class="breadcrumb-item">Sites</li>
            <li class="breadcrumb-item"><a
                    href="{{ route('sites.index.' . strtolower(str_replace(' ', '-', $site->name))) }}">{{ $site->name
                    }}</a>
            </li> <!-- Tautan ke indeks situs -->
            <li class="breadcrumb-item">{{ $device->device_name }}</li>
        </ol>
    </nav>


</div>

<section class="section">
    <div class="row">
        @if($source)
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4>Voltage Indicator</h4>
                </div>
                <div class="card-body">
                    <!-- Circular Progress Chart for Power Meter 1 -->
                    <div class="container">
                        <div class="circular-progress">
                            <span class="progress-indicator">{{ $source->voltage }} V</span>
                            <div class="progress-value">{{ $source->voltage }} V</div>
                        </div>
                        <h2 class="text">Voltage</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4>Current Indicator</h4>
                </div>
                <div class="card-body">
                    <!-- Circular Progress Chart for Power Meter 2 -->
                    <div class="container">
                        <div class="circular-progress">
                            <span class="progress-indicator">{{ $source->current }} A</span>
                            <div class="progress-value">{{ $source->current }} A</div>
                        </div>
                        <h2 class="text">Ampere</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Power Indicator</h4>
                </div>
                <div class="card-body">
                    <!-- Circular Progress Chart for Power Meter 3 -->
                    <div class="container">
                        <div class="circular-progress">
                            <span class="progress-indicator">{{ $source->power }} W</span>
                            <div class="progress-value">{{ $source->power }}W</div>
                        </div>
                        <h2 class="text">Watt</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Temperature</h4>
                </div>
                <div class="card-body">
                    <!-- Circular Progress Chart for Power Meter 4 -->
                    <div class="container">
                        <div class="circular-progress">
                            <span class="progress-indicator">{{ $source->temperature }} C</span>
                            <div class="progress-value">{{ $source->temperature }} C</div>
                        </div>
                        <h2 class="text">Celcius</h2>
                    </div>
                </div>
            </div>
        </div>
        @php
        if (!function_exists('formatOperationTime')) {
        function formatOperationTime($seconds) {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        return sprintf("%02d Hours %02d Minutes", $hours, $minutes);
        }
        }
        @endphp
        <div class="col-md-8">
            <div class="card">
                <div class="card-body d-flex align-items-center">
                    <div>
                        <h5>Operation Time</h5>
                        <h5 class="card-text font-weight-bold" style="font-size: 35px;">
                            {{ formatOperationTime($source->operation_time) }}
                        </h5>
                    </div>
                    <div class="ms-auto">
                        <i class="bi bi-alarm-fill text-primary" style="font-size: 5rem;"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- Display charts -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- Line Chart for Power Meter -->
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4>Indicator Meter Chart</h4>
                            <div class="d-flex align-items-center">
                                <div class="dropdown">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="powerMeterChart" width="300" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4>Temperature Chart</h4>
                            <div class="d-flex align-items-center">
                                
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Line Chart for Temperature -->
                        <canvas id="temperatureChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="col-12">
            <div class="alert alert-danger" role="alert">
                No source data available for this device.
            </div>
        </div>
        @endif
    </div>
</section>
</div>

{{-- Line Chart.js --}}
<script src="{{ asset('style/assets/js/chart.js')}}"></script>
<!-- library Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('style/assets/js/linechart.js')}}"></script>
@endsection
