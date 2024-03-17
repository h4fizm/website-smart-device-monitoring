@extends('app.main')
@section('title', "Edit Device")
@section('content')

<!-- CSS Chart -->
<link rel="stylesheet" href="{{ asset('style/assets/js/style_chart.css') }}">
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Edit Device</h3>
            <p class="text-subtitle text-muted">Edit Information About Device.</p>
        </div>
    </div>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-right">
        <li class="breadcrumb-item"><a href="{{ route('info.list_device') }}">Device Information</a></li>
        <li class="breadcrumb-item">Edit Device</li>
    </ol>
</nav>

<section class="section">
    <div class="col-md-6 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Input Form</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    @if(Session::has('success'))
                    <div class="col-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ Session::get('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    @elseif(Session::has('error'))
                    <div class="col-12">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ Session::get('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    @elseif(Session::has('warning') && Session::get('warning') == 'Sites must be selected')
                    <div class="col-12">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{ Session::get('warning') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    @endif
                    <form id="editDeviceForm" action="{{ route('devices.update', $device->id_device) }}" method="POST"
                        class="form form-horizontal">
                        @csrf
                        @method('PUT') <!-- Add this line for PUT method -->
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="device_name">Device Name</label>
                                </div>
                                <div class="col-md-8 form-group mb-4">
                                    <input type="text" id="device_name" class="form-control" name="device_name"
                                        value="{{ $device->device_name }}" placeholder="Device Name">
                                </div>
                                <div class="col-md-4">
                                    <label for="site">Select Site</label>
                                </div>
                                <div class="col-md-8 form-group mb-4">
                                    <div class="form-group">
                                        <select name="site" class="choices form-select">
                                            <option value="" selected disabled>Select Sites</option>
                                            @foreach($sites as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
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
</section>
@endsection