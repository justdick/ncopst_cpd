<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <!-- Uncomment below if you prefer to use an image logo -->
      <a href="{{route('cpd.index')}}" class="logo mr-aufto"><img src="{{asset('assets/images/logo.jpg')}}" alt="" class="img-fluid"></a>
      <h1 class="logo mr-auto"><a href="{{route('cpd.index')}}"><span>NC</span>OPST</a></h1>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
            <li class="{{request()->is('/cpd/create') ? 'active' : ''}}"><a href="{{route('cpd.index')}}">Home</a></li>
            <li class="{{request()->is('/cpd') ? 'active' : ''}}"><a href="{{route('cpd.index')}}">Registered Members</a></li>
          </ul>
      </nav>
      <!-- .nav-menu -->

      <div class="header-social-links">
        <a href="#" class="twitter"><i class="icofont-twitter"></i></a>
        <a href="#" class="facebook"><i class="icofont-facebook"></i></a>
        <a href="#" class="instagram"><i class="icofont-instagram"></i></a>
        <a href="#" class="linkedin"><i class="icofont-linkedin"></i></a>
      </div>

    </div>
  </header>
