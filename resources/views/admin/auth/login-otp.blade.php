<x-admin.guest-layout>
    <x-slot name="tabTitle">Login OTP</x-slot>

    <div class="card-body">
        <p class="login-box-msg">আপনার OTP দিন</p>
        <div id='seconds-counter' class="login-box-msg"></div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <div class="alert text-center" id="errorMsg"></div>

        <form>
            @csrf
            <div class="input-group mb-3">
                <input type="hidden" name="token" value="{{ $_GET['token'] }}">
                <input type="text" name="otp" class="form-control" placeholder="OTP" value="{{ old('otp') }}"
                    required autofocus>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-sort-numeric-up"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <button id="btn-submit" type="submit" class="btn btn-primary btn-block btn-submit">সাবমিট</button>

                    <button id="spinner" type="submit" class="btn btn-primary btn-block btn-submit" disabled>
                        <span class="spinner-border spinner-border-sm"></span>
                        সাবমিট..
                    </button>
                </div>
            </div>
        </form>
    </div>
    <!-- /.card-body -->
</x-admin.guest-layout>

<script>
    document.getElementById("spinner").style.display = 'none';
    document.getElementById("errorMsg").style.display = 'none';

    var timeleft = 60;
    var downloadTimer = setInterval(function() {
        timeleft--;
        document.getElementById("seconds-counter").textContent = "আপনার OTP সময় বাকিঃ " + timeleft +
        " সেকেন্ড।";
        if (timeleft <= 0) {
            clearInterval(downloadTimer);
        }
    }, 1000);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".btn-submit").click(function(e) {
        e.preventDefault();
        document.getElementById("btn-submit").style.display = 'none';
        document.getElementById("spinner").style.display = 'block';
        document.getElementById("errorMsg").style.display = 'none';
        var token = $("input[name=token]").val();
        var otp = $("input[name=otp]").val();

        $.ajax({
            type: 'POST',
            url: "{{ route('admin.login.otp.check') }}",
            data: {
                otp: otp,
                token: token
            },
            success: function(data) {
                document.getElementById("btn-submit").style.display = 'block';
                document.getElementById("spinner").style.display = 'none';
                if (data.success) {
                    window.location.href = data.url;
                } else {
                    document.getElementById("errorMsg").classList.add('alert-danger');
                    document.getElementById("errorMsg").textContent = 'আপনি ভুল OPT দিয়েছেন, সঠিক OTP দিন।'
                    document.getElementById("errorMsg").style.display = 'block'
                }
            },
            error: function(data) {
                document.getElementById("errorMsg").classList.add('alert-danger');
                    document.getElementById("errorMsg").style.display = 'block'
                    document.getElementById("errorMsg").textContent = data.responseJSON.errors.otp
                    document.getElementById("btn-submit").style.display = 'block';
                    document.getElementById("spinner").style.display = 'none';
            }
        });
    });
</script>
