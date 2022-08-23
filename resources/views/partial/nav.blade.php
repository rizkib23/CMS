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
            <a class="nav-link navbar-brand {{ ($title === "Home")? 'active':'' }}" aria-current="page" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link navbar-brand {{ ($title === "Kategori")? 'active':'' }}" aria-current="page" href="/kategori">Kategori</a>
          </li>
          <li class="nav-item">
            <a class="nav-link navbar-brand {{ ($title === "Tag")? 'active':'' }}" aria-current="page" href="/tag">Tag</a>
          </li>
        </ul>
        <form class="d-flex">
          
          <input class="form-control me-2" type="search"  placeholder="Cari " aria-label="Search">
          <button class="btn btn-outline-info" type="submit">Search</button>
         
        </form>
        @auth

        <li>
         <form action="/logout" method="POST">
         @csrf
         <button type="submit" class="nav-link btn-outline-danger "><i class="bi bi-box-arrow-right"></i>Logout</button>
         </form>
        </li>
       
       
         @else
         <ul class="navbar-nav ms-auto">
           <li class="nav-item active">
            <a href="/login" class="nav-link btn-outline-info"><i class="bi bi-box-arrow-in-right"></i>Login</a>
           </li>
           </ul>
           @endauth
        
      </div>
    </div>
  </nav>