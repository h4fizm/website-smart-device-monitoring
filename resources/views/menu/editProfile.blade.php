@extends('app.main')
@section('title', 'User Profile')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>User Profile</h3>
                <p class="text-subtitle text-muted">User's can change profile information</p>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-12 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center align-items-center flex-column">
                            <div class="avatar avatar-2xl">
                                <img src="{{ asset('style/assets/compiled/jpg/1.jpg')}}" alt="Avatar"
                                    style="width: 200px; height: 200px;">
                            </div>
                            <h3 class="mt-3">{{ auth()->user()->name }}</h3>
                            <p class="text-small">{{ auth()->user()->email }}</p>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                        @endif

                        @if(session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                        @endif

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form action="{{ route('user.profile.update') }}" method="post">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Your Name"
                                    value="{{ auth()->user()->name }}">
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" name="email" id="email" class="form-control" placeholder="Your Email"
                                    value="{{ auth()->user()->email }}">
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-label">Change Password</label>
                                <div class="input-group">
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="New Password" value="{{ old('password') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation" class="form-label">Retype Password</label>
                                <div class="input-group">
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        class="form-control" placeholder="Retype New Password"
                                        value="{{ old('password_confirmation') }}">
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection