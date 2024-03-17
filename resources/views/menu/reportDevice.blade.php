@extends('app.main')
@section('title', 'List Data Device')
@section('content')

{{--Konten reportDevice --}}
<div class="page-heading" style="display: flex; flex-direction: column; align-items: left;">
    <h3>List Data Device</h3>
    <p class="text-subtitle text-muted">Insert, Delete, and Edit Device</p>
    <button class="btn btn-primary" style="width: fit-content; align-self: flex-end;"
        onclick="window.location.href='{{ route('new.add_device') }}'">+ Add Device</button>
</div>

<div class="page-content">
    <section class="section">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">ID Device</th>
                            <th class="text-center">Device Location</th>
                            <th class="text-center">Last Update</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th> <!-- New column for Action -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($devices as $index => $device)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="text-center">{{ $device->device_name }}</td>
                            <td class="text-center">{{ $device->site->name ?? 'No Site Assigned' }}</td>
                            <td class="text-center">{{ $device->updated_at->format('d M Y, H:i') }}</td>
                            <td class="text-center">
                                @if($device->status === 1)
                                <span class="badge bg-success">ON</span>
                                @else
                                <span class="badge bg-danger">OFF</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('devices.edit', $device->id_device) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('devices.delete', $device->id_device) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm show_confirm">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection