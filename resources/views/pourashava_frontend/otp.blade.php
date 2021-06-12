@extends('pourashava_frontend.layouts.app')

@section("content")

<main>
    <div class="container">

        <div class="row UMainContain" style="margin:10px 0;">
            <div class="col-sm-6 col-lg-push-3" style="padding: 10px;">
                <h3 class="login-box-msg text-center">আপনার OTP দিন</h3><br>
                <div id='seconds-counter' class="login-box-msg text-center"></div>
                <div class="alert text-center" id="errorMsg"></div>
                <form>
                    <input type="hidden" name="token" value="{{ $_GET['token'] }}">
                    <label for="">ওটিপি</label>
                    <input type="text" name="otp" class="form-control" placeholder="ওটিপি"><br />

                    <button id="btn-submit" type="submit" class="btn btn-desh btn-submit">কনফার্ম করুন</button>

                    <button id="spinner" type="submit" class="btn btn-desh btn-submit" disabled>
                        <span class="spinner-border spinner-border-sm"></span>
                        কনফার্ম করুন..
                    </button>
                </form>

            </div>
            <div class="col-sm-3 col-lg-pull-6 ULeftContain">

            </div>
        </div>

    </div>
</main>

@endsection

@push('script')
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
                url: "{{route('pourashava_frontend.user.login.otp.check', $pname)}}",
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
                        document.getElementById("errorMsg").style.display = 'block'
                        document.getElementById("errorMsg").textContent = 'আপনি ভুল OPT দিয়েছেন, সঠিক OTP দিন।'
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
@endpush

