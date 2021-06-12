<x-admin.guest-layout>
    <x-slot name="tabTitle">Login</x-slot>

    <div class="card-body">
        <p class="login-box-msg">আপনার একাউন্ট এ লগইন করুন </p>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <div class="input-group mb-3">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="ইমেইল" value="{{ old('email') }}" required autofocus>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="পাসওয়ার্ড" required autocomplete="current-password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">লগইন</button>
            </div>
            <!-- /.col -->
            </div>
        </form>

        <p class="mb-1">
            <a href="{{ route('admin.password.request') }}">পাসওয়ার্ড ভুলে গেছেন?</a>
        </p>
    </div>
    <!-- /.card-body -->
</x-admin.guest-layout>
