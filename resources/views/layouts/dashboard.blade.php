<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
   <meta charset="utf-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
   <title>
      {{ config('app.name') }} - @yield('title')

   </title>
   <!-- fontawesome -->
   <script src="{{ asset('vendor/fontawesome-free/js/all.min.js') }}"></script>
   <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
   {{-- sb admin --}}
   <link rel="stylesheet" href="{{ asset('css/sb-admin-2.min.css') }}">
   {{-- css:external --}}
   <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
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
   <script src="{{ asset('vendor/jquery/jquery-3.6.0.min.js') }}"></script>
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
   const berhasil = document.querySelector('.berhasil');
   berhasil.addEventListener('submit',function(){
      Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
         }).then((result) => {
         if (result.isConfirmed) {
            Swal.fire(
               'Deleted!',
               'Your file has been deleted.',
               'success'
            )
         }
         })
         
   });
  
    </script>
     <script>
      $(document).ready( function () {
          $('#myTable').DataTable();
      } );
    </script>
    {{-- data tabel --}}
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
</body>

</html>