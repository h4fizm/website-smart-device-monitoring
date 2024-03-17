@extends('app.main')
@section('title', 'User Account')
@section('content')

{{--Konten reportDevice --}}
<div class="page-heading" style="display: flex; flex-direction: column; align-items: left;">
    <h3>List Data Device</h3>
    <p class="text-subtitle text-muted">Create, Delete, and Edit User Account</p>
    <button class="btn btn-primary" style="width: fit-content; align-self: flex-end;"
        onclick="window.location.href='{{ route('new.add_user') }}'">+ Add User</button>
</div>

<div class="page-content">
    <section class="section">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Name User</th>
                            <th class="text-center">Email User</th> <!-- Added column for Total Devices -->
                            <th class="text-center">Created At</th>
                            <th class="text-center">Action</th> <!-- New column for Action -->
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Loop through users and display each user's information --}}
                        @foreach ($users as $key => $user)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td class="text-center">{{ $user->name }}</td>
                            <td class="text-center">{{ $user->email }}</td>
                            <td class="text-center">{{ $user->created_at->format('d M Y, H:i') }}</td>
                            <td class="text-center">
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('users.delete', $user->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger show_confirm">Delete</button>
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