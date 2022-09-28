<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title','Ocoging | Blog')</title>
        <meta name="keywords" content="@yield('meta_keywords','some default keywords')">
        <meta name="description" content="@yield('meta_description','default description')">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="canonical" href="{{url()->current()}}"/>
        <link rel="icon" href="{{ asset('img/logo2.png') }}">
    <title>Ocoding | Dashboard - {{ $title }}  </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script src="{{ asset('vendor/fontawesome-free/js/all.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    {{-- sb admin --}}
    <link rel="stylesheet" href="{{ asset('css/sb-admin-2.min.css') }}">
    {{-- css:external --}}
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('dist/css/bootstrap.css') }}"> --}}
    {{-- js --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @stack('css-external')

</head>

<body id="page-top">

   <!-- Page Wrapper -->
   <div id="wrapper">

       <!-- sidebar -->
       @include('partial.dashboard.sidebar')

       <!-- Content Wrapper -->
       <div id="content-wrapper" class="d-flex flex-column">
           
           <!-- Navbar -->
           @include('partial.dashboard.navbar')
           <!-- Main Content -->
           <div id="content">
               @yield('content')
           </div>
           <!-- Footer -->
           @include('partial.dashboard.footer')

       </div>
       <!-- End of Content Wrapper -->

   </div>
   <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
  </a>

   <!-- scripts -->

   <!-- jquery -->
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
</head>

   <!-- bootstrap bundle -->
   <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
   <!-- my-dashboard -->
   <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
   <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
   {{-- alert --}}
   <script src="alert/sweetalert2.all.min.js"></script>
   @stack('javascript-external')
   {{-- javascript:internal --}}
   @stack('javascript-internal')
     <script>
      $(document).ready( function () {
          $('#myTable').DataTable();
      } );
    </script>
    {{-- data tabel --}}
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></scri>
</body>

</html>