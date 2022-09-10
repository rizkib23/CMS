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
   <li class="nav-item {{ Request::is('../index') ? 'active' : '' }}">
    <a class="nav-link" href="/dashboard">           
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
   <li class="nav-item {{ Request::is('post/admin', 'post/create', 'post/edit', 'post/detail') ? 'active' : '' }}">
       <a class="nav-link" href="/post">
           <i class="fas fa-fw fa-table"></i>
           <span>Post</span></a>
   </li>

   <!-- Nav Item - Kategori -->
   <li class="nav-item {{ Request::is('kategori/admin', 'kategori/create', 'kategori/edit') ? 'active' : '' }}">
    <a class="nav-link" href="/kategoris"> 
        <i class="fas fa-fw fa-table"></i>
           <span>Kategori</span></a>
   </li>

   <!-- Nav Item - Tag -->
   <li class="nav-item {{ Request::is('tags/admin', 'tags/create', 'tags/edit') ? 'active' : '' }}">
    <a class="nav-link" href="/tags">
           <i class="fas fa-fw fa-table"></i>
           <span>Tag</span></a>
   </li>

   <li class="nav-item {{ Request::is('tags/admin', 'tags/create', 'tags/edit') ? 'active' : '' }}">
    <a class="nav-link" href="/pengumuman">
        <i class="bi bi-calendar"></i>
           <span>Pengumuman</span></a>
   </li>

   <!-- Divider -->
   <hr class="sidebar-divider">

   <!-- Heading -->
   <div class="sidebar-heading">
       User
   </div>

   <!-- Nav Item - user -->
   <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>User</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Keterangan</h6>
            @can('manage_role')
            <a class="collapse-item" href="/roles">Role</a>
            @endcan
            <a class="collapse-item" href="/user">User</a>
        </div>
    </div>
</li>

   <!-- Divider -->
   <hr class="sidebar-divider">

   <!-- Heading -->
   <div class="sidebar-heading">
       File Manager
   </div>

   <!-- Nav Item - File Manager -->
   <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
       <a class="nav-link" href="/">
           {{-- <i class="fas fa-fw fa-chart-area"></i> --}}
           <span>Home</span></a>
   </li>

   <!-- Divider -->
   <hr class="sidebar-divider d-none d-md-block">

   <!-- Sidebar Toggler (Sidebar) -->
   <div class="text-center d-none d-md-inline">
       <button class="rounded-circle border-0" id="sidebarToggle"></button>
   </div>

</ul>
<!-- End of Sidebar -->