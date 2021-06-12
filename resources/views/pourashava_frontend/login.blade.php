@extends('pourashava_frontend.layouts.app')

@section('content')

    <main>
        <div class="container">
            <div class="row UMainContain" style="margin:10px 0;">
                <div class="col-sm-6 col-lg-push-3" style="padding: 10px;">
                    @if (Session::has('message'))
                        <p class="alert alert-danger">{{ Session::get('message') }}
                        </p>
                    @endif
                    <form method="post" action="{{ route('pourashava_frontend.user.login.store', $pname) }}">
                        @csrf
                        <div class="form-group">
                            <label for="">কার্ড নাম্বার</label>
                            <input type="text" name="card_no" class="form-control @error('card_no') is-invalid @enderror"
                                placeholder="কার্ড নাম্বার" value="{{ old('card_no') }}" required autofocus>
                            @error('card_no')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">পিন নাম্বার</label>
                            <input type="password" name="pin_no" class="form-control @error('pin_no') is-invalid @enderror"
                                placeholder="পিন নাম্বার" required>
                            @error('pin_no')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-desh">লগইন করুন</button>
                    </form>
                </div>
                <div class="col-sm-3 col-lg-pull-6 ULeftContain">
                </div>
            </div>
        </div>
    </main>

@endsection
