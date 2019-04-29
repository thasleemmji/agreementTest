<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <link rel="shortcut icon" href="{{ asset('/images/favicon.png') }}">

    <title>{{ucwords(Auth::user()->name)}} | Agent Agreement System</title>
    <!-- COOMON CSS -->
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/plugins/sweet-alert/sweetalert2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/plugins/jquery-toastr/jquery.toast.min.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <!-- jQuery -->
    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <!-- jquery UI css & js -->
  </head>
<body>

{{-- Success Message --}}
@if(session('update_success'))
<div class="alert alert-success row">
    <div class="col-2"><i class="fa fa-check-circle-o"></i></div>
    <div class="col-10">{{ session('update_success') }}</div>
</div>
@endif
{{-- Error Message --}}
@if(session('update_error'))
<div class="alert alert-error row">
    <div class="col-2"><i class="fa fa-times-circle-o"></i></div>
    <div class="col-10">{{ session('update_error') }}</div>
</div>
@endif
{{-- Ajax reponse alerts --}}
<div class="alert alert-success row" id="Alertsuccess" style="display: none;">
    <div class="col-2"><i class="fa fa-check-circle-o"></i></div>
    <div class="col-10" id="Msgsuccess"></div>
</div>
<div class="alert alert-error row" id="Alerterror" style="display: none;">
    <div class="col-2"><i class="fa fa-times-circle-o"></i></div>
    <div class="col-10" id="Msgerror"></div>
</div>

<!-- Navigation Menu-->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
  <a class="navbar-brand" href="{{ url('/') }}">
    AgreementSys <span>{{ucwords(get_role_name())}}</span>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
    <ul class="navbar-nav">
      @if(isAdmin())
      <li class="nav-item">
        <a class="nav-link" href="javascript:;" data-toggle="modal" data-target="#agentsModal">Agents List</a>
      </li>
      @endif
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropdownList" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #f75565;">
          <span style="color: #fff"><i class="fa fa-user"></i> </span> {!!ucwords(Auth::user()->name)!!}
        </a>
        <div class="dropdown-menu" aria-labelledby="dropdownList">
          <a class="dropdown-item" href="javascript:;" onclick="event.preventDefault();$('#logout-form').submit();">Logout</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
        </div>
      </li>
    </ul>
  </div>
</nav>
<section class="contents">
<!-- ============================================================== -->
<!-- PAGE CONTENT GOES HERE -->
<!-- ============================================================== -->
      @yield('content')
<!-- ============================================================== -->
<!-- PAGE CONTENT GOES HERE -->
<!-- ============================================================== -->
</section>
<footer class="footer text-center fixed-bottom bg-dark">
  <div class="container">
    {{ date('Y')}} &copy; {{config('app.name')}} | <span>Developed By: <a target="_blank" href="http://thasleem.me">THASLEEM C</span></a>
  </div>
</footer>

<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->
<!-- END wrapper -->

<!-- COMMON Scripts  -->
<script type="text/javascript">
    var burl = "{{ url('/') }}";
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}});
</script>
<script src="{{ asset('/js/popper.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/plugins/sweet-alert/sweetalert2.min.js') }}"></script>
<script src="{{ asset('/plugins/jquery-toastr/jquery.toast.min.js') }}"></script>
<script src="{{ asset('/js/custom.js') }}"></script>
</body>
</html>
