<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Favicon icon -->
    <link rel="shortcut icon" href="{{asset('style/assets/compiled/svg/favicon.svg')}}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('style.login/css/style.css')}}">
</head>

<body>
    <section class="container-fluid ">
        <div class="row vh-100">
            <!-- Pindahkan elemen ini ke sisi kiri -->
            <div class="background-style col-md-8 col-12 right-box d-flex"
                style="background-image: url('/style.login/image/login_image.png'); background-size: cover; background-position: center;">
                <div class="background-style text-white text-left m-5 p-5">
                    <h2 class="title fw-bolder my-0 mb-4">Smart Device Monitoring</h2>
                    <!-- <div class="signin-border border border-2 border-white mx-auto"></div> -->
                    <!-- <p class="fs-5 my-4">Fill up personal information and start journey with us.</p> -->
                </div>
            </div>

            <!-- Pindahkan elemen ini ke sisi kanan -->
            <div class="col-md-4 col-12 ">
                <div class="text-end">
                    <div class="fw-medium p-4 ">
                        <span class="smart fw-bold">Smart</span>
                        <span>Device Monitoring</span>
                    </div>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="px-4 sign-container mx-auto ">
                        <div class="text-center mt-5 ">
                            <h2 class="fw-bold brand fs-1 my-4">Login Users</h2>
                            <div class="mb-2 mx-auto signin-border"></div>

                            <div class="pt-4">use your email account</div>
                            <div class="position-relative my-4">
                                <input id="email" type="email"
                                    class="form-control  @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>
                                <div class="input-label position-absolute  px-2 bg-white z-1">
                                    <label for="email" class="control-label">{{ __('Email Address') }}</label>
                                </div>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="position-relative my-4">

                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">

                                <div class="input-label position-absolute px-2 bg-white z-1">
                                    <!-- <label for="password" class="control-label">Password</label> -->
                                    <label for="password" class="control-label">{{ __('Password') }}</label>

                                </div>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-between align-items-center  mx-auto">
                                <div>
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{
                                        old('remember') ? 'checked' : '' }}>
                                    <label for="check">Remember me</label>
                                </div>
                                <!-- <a href="#" class="text-reset text-decoration-none fw-bold">Forgot Password?</a> -->
                            </div>
                            <button type="submit"
                                class="btn my-5 fw-bold btn-lg sign-up rounded-5 px-5 fs-6">Login</button>
                            <div class="p-3 mt-2">
                                <a class="text-decoration-none text-reset fw-light" href="#">Copyright by Dimas 2023</a>
                                <!-- . <a class="text-decoration-none text-reset" href="#">Terms & Condtions</a> -->
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>