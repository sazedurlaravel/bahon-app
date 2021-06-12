<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $tabTitle }} - {{ config('app.name') }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
  <!-- solaimanlipi font -->
  <link href="https://fonts.maateen.me/solaiman-lipi/font.css" rel="stylesheet">
  <style>
      body {
          font-family: 'SolaimanLipi', Arial, sans-serif !important;
      }
      
      .select2-container .select2-selection--single {
          height: 40px !important;
      }
  </style>
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <span class="h1"><i class="fas fa-truck mr-2"></i><b class="text-primary">{{ config('app.name') }}</b></span>
      </div>
      {{ $slot }}
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
  <!-- sweet alert -->
  <script src="{{ asset('assets/dist/js/sweetalert.min.js') }}"></script>

  <script>
    // session message
    @if (Session::has('message') AND Session::has('alert-type'))
      swal({
      title: "",
      text: "{{ Session::get('message') }}",
      icon: "{{ Session::get('alert-type') }}",
      });
    @endif
  </script>
</body>
</html>