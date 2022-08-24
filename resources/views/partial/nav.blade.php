<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a href="/" class="navbar-brand ml-lg-3">
        <h1 class="m-0 text-uppercase text-primary"><i class="mr-3"></i>O-Coding</h1>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link navbar-brand " aria-current="page" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link navbar-brand " aria-current="page" href="/kategori">Kategori</a>
          </li>
          <li class="nav-item">
            <a class="nav-link navbar-brand" aria-current="page" href="/tag">Tag</a>
          </li>
        </ul>
        <form class="d-flex">
          
          <input class="form-control me-2" type="search"  placeholder="Cari " aria-label="Search">
          <button class="btn btn-outline-info" type="submit">Search</button>
         
        </form>
        @guest
        @if (Route::has('login'))
            
                <a class="nav-link" class="btn btn-outline-primary" href="{{ route('login') }}">{{ __('Login') }}</a>
           
        @endif

        @if (Route::has('register'))
            
                <a class="nav-link" class="btn btn-outline-success" href="{{ route('register') }}">{{ __('Register') }}</a>
            
        @endif
    @else
       
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        
    @endguest

       
      </div>
    </div>
  </nav>