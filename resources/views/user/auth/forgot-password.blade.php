<x-admin.guest-layout>
    <x-slot name="tabTitle">Forgot Password</x-slot>

    <div class="card-body">
        <p class="login-box-msg">পাসওয়ার্ড ভুলে গেছেন? সমস্যা নাই।</p>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('admin.password.email') }}">
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
            <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">পাসওয়ার্ড পরিবর্তন করার লিঙ্ক</button>
            </div>
            <!-- /.col -->
            </div>
        </form>
        <p class="mt-3 mb-1">
            <a href="{{ route('admin.login') }}">লগইন এ ফিরে যান</a>
        </p>
    </div>
    <!-- /.login-card-body -->
</x-admin.guest-layout>
