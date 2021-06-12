<x-user.guest-layout>
    <x-slot name="tabTitle">Login</x-slot>

    <div class="card-body">
        <p class="login-box-msg">আপনার একাউন্ট এ লগইন করুন </p>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('pourashava_frontend.user.login', $pourashava_slug) }}">
            @csrf
            <div class="input-group mb-3">
                <input type="text" name="card_no" class="form-control @error('card_no') is-invalid @enderror" placeholder="কার্ড নাম্বার" value="{{ old('card_no') }}" required autofocus>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
                @error('card_no')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input type="password" name="pin_no" class="form-control @error('pin_no') is-invalid @enderror" placeholder="পিন নাম্বার" required autocomplete="current-password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                @error('pin_no')
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
    </div>
    <!-- /.card-body -->
</x-user.guest-layout>
