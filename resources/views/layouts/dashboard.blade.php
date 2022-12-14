<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
   <meta charset="utf-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
   <title>
      {{ config('app.name') }} - @yield('title')

   </title>
   <!-- my-dashboard -->
   <link rel="stylesheet" href="{{ asset('vendor/my-dashboard/css/dashboard.css') }}">
   <!-- fontawesome -->
   <script src="{{ asset('vendor/fontawesome-free/js/all.min.js') }}"></script>
   <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
</head>

<body>
   <!-- begin:navbar -->
   @include('partial.dashboard.navbar')
   <!-- end:navbar -->
   <div id="layoutSidenav">
      <div id="layoutSidenav_nav">
         <!-- begin:sidebar -->   
         @include('partial.dashboard.sidebar')      
         <!-- end:sidebar -->
      </div>
      <div id="layoutSidenav_content">
         <main>
            <div class="container-fluid">
               <h2 class="mt-2">
                  <!-- title -->
                  @yield('title')
               </h2>
               <!-- begin:breadcrumbs -->
               @yield('breadcrumbs')         
               <!-- end:breadcrumbs -->               

               <!-- begin:content -->
               @yield('content')         
               <!-- end:content -->               
            </div>
         </main>
         <!-- begin:footer -->     
         @include('partial.dashboard.footer')    
         <!-- end:footer -->   
      </div>
   </div>
   <!-- scripts -->

   <!-- jquery -->
   <script src="{{ asset('vendor/jquery/jquery-3.6.0.min.js') }}"></script>
   <!-- bootstrap bundle -->
   <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
   <!-- my-dashboard -->
   <script src="{{ asset('vendor/my-dashboard/js/dashboard.js') }}"></script>
   <script src="alert/sweetalert2.all.min.js"></script>
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
</body>

</html>