<script type="text/javascript" src="{{ asset('assets/paurashava_frontend') }}/jQuery-2.2.4/jquery.min.js"></script>
<script type="text/javascript"
    src="{{ asset('assets/paurashava_frontend') }}/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/paurashava_frontend') }}/IE9/html5shiv.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/paurashava_frontend') }}/IE9/respond.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/paurashava_frontend') }}/js/home.js"></script>

<script src="{{ asset('assets/dist/js/sweetalert.min.js') }}"></script>
<script>
    // session message
    @if (Session::has('message') and Session::has('alert-type'))
        swal({
        title: "",
        text: "{{ Session::get('message') }}",
        icon: "{{ Session::get('alert-type') }}",
        });
    @endif

</script>
@stack('script')
