 <nav class="navbar navbar-expand navbar-light bg-light">
    <div class="container-fluid">
      <a href="/" class="navbar-brand ml-lg-3">
        <h1 class="m-0 text-uppercase text-primary"><i class="mr-3"></i>O-Coding</h1>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item {{ Request::is('home') ? 'active' : '' }}">
            <a class="nav-link navbar-brand" aria-current="page" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link navbar-brand" aria-current="page" href="/kategori">Kategori</a>
          </li>
        </ul>
          <ul class="navbar-nav ml-auto">
          @guest
            @if (Route::has('login'))
              <li>
                <a class="nav-link" class="btn btn-outline-primary" href="{{ route('login') }}">{{ __('Login') }}</a>
              </li>
            @endif

            @if (Route::has('register'))
              <li>
                <a class="nav-link" class="btn btn-outline-success" href="{{ route('register') }}">{{ __('Register') }}</a>
              </li>
            @endif
            @else
              
              @can('manage_dashboard')
              <li>
                <a class="nav-link" class="btn btn-outline-primary" href="/dashboard">Dashboard</a>
              </li>
              @endcan
           
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
                @if(Auth::user()->dataProfil->foto)
                <img src="{{ asset('storage/' .Auth::user()->dataProfil->foto) }}" width="30" height="30" class="rounded-circle me-2" alt=" {{ Auth::user()->name }}">
                @else
                <img src="{{ asset('img/profil.jpg') }}" class="rounded-circle me-2" width="30" height="30">
                @endif
            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('profil.index') }}">
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                Profile
            </a>
                <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    {{ __('Logout') }}
                </a>
            </div>
        
          @endguest
          </ul>
        
  </div> 
  </div>   
</nav>
<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
             {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
</div>
</div>