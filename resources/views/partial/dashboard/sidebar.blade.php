<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

   <!-- Sidebar - Brand -->
   <a class="sidebar-brand d-flex align-items-center justify-content-center" {{ Request::is('dashboard') ? 'active' : '' }}" href="/dashboard">
       <div class="sidebar-brand-icon rotate-n-15">
           <i class="fas fa-laugh-wink"></i>
       </div>
       <div class="sidebar-brand-text mx-3">Ocoding</div>
   </a>

   <!-- Divider -->
   <hr class="sidebar-divider my-0">

   <!-- Nav Item - Dashboard -->
   <li class="nav-item">
    <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="/dashboard">           
        <i class="fas fa-fw fa-tachometer-alt"></i>
           <span>Dashboard</span></a>
   </li>

   <!-- Divider -->
   <hr class="sidebar-divider">

   <!-- Heading -->
   <div class="sidebar-heading">
       Data
   </div>

   <!-- Nav Item - Post -->
   <li class="nav-item ">
       <a class="nav-link" href="/dashboard/#">
           <i class="fas fa-fw fa-table"></i>
           <span>Post</span></a>
   </li>

   <!-- Nav Item - Kategori -->
   <li class="nav-item ">
    <a class="nav-link {{ Request::is('dashboard/kategori') ? 'active' : '' }}" href="/dashboard/kategori"> 
        <i class="fas fa-fw fa-table"></i>
           <span>Kategori</span></a>
   </li>

   <!-- Nav Item - Tag -->
   <li class="nav-item ">
    <a class="nav-link" href="/dashboard/#">
           <i class="fas fa-fw fa-table"></i>
           <span>Tag</span></a>
   </li>

   <!-- Divider -->
   <hr class="sidebar-divider">

   <!-- Heading -->
   <div class="sidebar-heading">
       User
   </div>

   <!-- Nav Item - Charts -->
   <li class="nav-item ">
       <a class="nav-link" href="/dashboard/#">
           <i class="fas fa-fw fa-chart-area"></i>
           <span>User</span></a>
   </li>

   <!-- Divider -->
   <hr class="sidebar-divider">

   <!-- Heading -->
   <div class="sidebar-heading">
       File Manager
   </div>

   <!-- Nav Item - File Manager -->
   <li class="nav-item ">
       <a class="nav-link" href="#">
           <i class="fas fa-fw fa-chart-area"></i>
           <span>File Manager</span></a>
   </li>

   <!-- Divider -->
   <hr class="sidebar-divider d-none d-md-block">

   <!-- Sidebar Toggler (Sidebar) -->
   <div class="text-center d-none d-md-inline">
       <button class="rounded-circle border-0" id="sidebarToggle"></button>
   </div>

</ul>
<!-- End of Sidebar -->