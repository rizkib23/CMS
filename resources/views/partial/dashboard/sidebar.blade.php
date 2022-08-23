<nav class="sb-sidenav accordion sb-sidenav-light bg-light" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
       <div class="nav">
          <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="/dashboard">
             <div class="sb-nav-link-icon">
                <i class="fas fa-tachometer-alt"></i>
             </div>
             Dashboard
          </a>
          <div class="sb-sidenav-menu-heading">Master</div>
 
          <a class="nav-link {{ Request::is('dashboard/post') ? 'active' : '' }}" href="/dashboard/post">
             <div class="sb-nav-link-icon">
                <i class="far fa-newspaper"></i>
             </div>
             Posts
          </a>
          <a class="nav-link {{ Request::is('/kategori', '/kategori/create') ? 'active' : '' }}" href="/kategori">
             <div class="sb-nav-link-icon">
                <i class="fas fa-bookmark"></i>
             </div>
             Categories
          </a>
          <a class="nav-link {{ Request::is('/tags', '/tags/create') ? 'active' : ''}} " href="/tags">
             <div class="sb-nav-link-icon">
                <i class="fas fa-tags"></i>
             </div>
             Tags
          </a>
          <div class="sb-sidenav-menu-heading">User permission</div>
          <a class="nav-link" href="#">
             <div class="sb-nav-link-icon">
                <i class="fas fa-user"></i>
             </div>
             User
          </a>
          <div class="sb-sidenav-menu-heading">Settings</div>
          <a class="nav-link" href="#">
             <div class="sb-nav-link-icon">
                <i class="fas fa-photo-video"></i>
             </div>
             File manager
          </a>
       </div>
    </div>
    <div class="sb-sidenav-footer">
       <div class="small">Logged in as:</div>
       <!-- show username -->
    </div>
 </nav>