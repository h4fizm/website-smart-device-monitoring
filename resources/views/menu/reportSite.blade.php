@extends('app.main')
@section('title', 'Report Site Location')
@section('content')

{{--Konten reportDevice --}}
<div class="page-heading" style="display: flex; flex-direction: column; align-items: left;">
    <h3>List Site Location</h3>
    <p class="text-subtitle text-muted">Insert, Delete, and Edit Site Information & Location</p>
    <button class="btn btn-primary" style="width: fit-content; align-self: flex-end;"
        onclick="window.location.href='{{ route('new.add_site') }}'">+ Add Site Location</button>
</div>

<div class="page-content">
    <section class="section">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Site Name</th>
                            <th class="text-center">Total Devices</th> <!-- Added column for Total Devices -->
                            <th class="text-center">Last Update</th>
                            <th class="text-center">Action</th> <!-- New column for Action -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sites as $index => $site)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="text-center">{{ $site->name }}</td>
                            <td class="text-center">{{ $site->total_devices }}</td>
                            <td class="text-center">{{ $site->updated_at->format('d M Y, H:i') }}</td>
                            <td class="text-center">
                                <a href="{{ route('sites.edit', $site->id_sites) }}"
                                    class="btn btn-sm btn-warning">Edit</a>
                                <form id="site_form" action="{{ route('sites.delete', $site->id_sites) }}" method="POST"
                                    style="display: inline;">
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