<style>
.navbar {
  z-index: 9999;
}
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light navv py-3">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{ route('courses.index') }}">Courses</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('courses.index') }}" >Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item">
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('users.show', Auth::id()) }}">Profile</a>
            </li>
        </ul>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn btn-primary me-2">
          {{ __('Log Out') }}
          </button>
        </form>        
        @if(Auth::user()->role == 'admin')
            <a class="btn btn-primary me-2 mx-2 " href="{{ route('admin') }}">Admin Panel</a>
        @endif
      </div>
    </div>
  </nav>